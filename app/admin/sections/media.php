<?php
/* Изображения: загрузка снимков сайтов и прочих картинок.

   ЗАГРУЗКА ФАЙЛОВ — САМОЕ ОПАСНОЕ МЕСТО ЛЮБОЙ ПАНЕЛИ, поэтому здесь
   несколько рубежей, и ни один не полагается на имя файла:

   1. Тип определяется по содержимому (getimagesize), а не по расширению
      и не по заголовку из браузера: и то и другое пишет отправитель.
   2. Имя на диске собираем сами, из разрешённых знаков и расширения,
      которое следует из распознанного типа. Присланное имя не используется
      нигде, кроме подсказки. Поэтому «счёт.php.jpg» физически не может
      оказаться на диске под своим именем.
   3. SVG не принимаем вовсе. Внутри него бывает скрипт, и при открытии
      файла по прямой ссылке он выполняется в домене сайта.
   4. Папка /images/ отдельным .htaccess запрещает исполнение чего угодно —
      на случай, если первые три рубежа кто-то обойдёт.

   Загруженное лежит в images/uploads/ корня сайта: в репозитории это
   public/images/uploads/, на сервере ~/public_html/images/uploads/.
   Выкладка туда не лезет: она копирует файлы поверх, но ничего не удаляет. */

$e   = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
/* От корня сайта, а не от папки с кодом: на сервере код в ~/app, и путь
   от него вёл в ~/public — мимо сайта. Портфолио проверяет снимки от того же корня. */
$DIR = ADMIN_WEBROOT . '/images/uploads';
$WEB = '/images/uploads';

/* Предел самого сервера: upload_max_filesize на файл, post_max_size на весь
   запрос. Обещать больше нельзя — PHP отобьёт файл раньше наших проверок,
   а страница при этом говорила бы «до 40 МБ». */
$SERVER = admin_upload_cap();
$cap = static fn(int $own) => $SERVER > 0 ? min($own, $SERVER) : $own;
$MAX = $cap(6 * 1024 * 1024);         // картинка
$MAX_VIDEO = $cap(40 * 1024 * 1024);  // видео: вертикальный ролик столько и весит

/* Распознанный тип -> расширение. Список закрытый: что не здесь, то не картинка. */
$TYPES = [
    IMAGETYPE_JPEG => 'jpg',
    IMAGETYPE_PNG  => 'png',
    IMAGETYPE_WEBP => 'webp',
    IMAGETYPE_GIF  => 'gif',
];

/* Марки контейнера ISO BMFF, под которыми пишется видео MP4. Тот же
   контейнер носят и снимки AVIF и HEIC, и звук M4A, и ролики QuickTime:
   по одному слову ftyp всё это сохранялось как .mp4 и не играло. */
const MEDIA_MP4_BRANDS = ['isom', 'iso2', 'iso4', 'iso5', 'iso6', 'mp41', 'mp42',
                          'avc1', 'dash', 'M4V ', 'M4VH', 'M4VP', 'MSNV'];
/* Марки снимков AVIF и HEIC в том же контейнере. */
const MEDIA_STILL_BRANDS = ['avif', 'avis', 'heic', 'heix', 'hevc', 'hevx', 'mif1', 'msf1'];
/* Звук в том же контейнере. Он объявляет совместимость с isom и mp42,
   поэтому отсеивается по основной марке — раньше совместимых. */
const MEDIA_AUDIO_BRANDS = ['M4A ', 'M4B ', 'M4P ', 'F4A ', 'F4B '];

/** Первые 64 байта файла: по ним виден формат, а у MP4 — и список марок. */
function media_head(string $path): string
{
    $fh = @fopen($path, 'rb');
    if (!$fh) return '';
    $head = (string)fread($fh, 64);          // хватает на заголовок ftyp со списком марок
    fclose($fh);
    return $head;
}

/** Марка контейнера ISO BMFF (байты 8–11); '' — файл не в нём. */
function media_brand(string $head): string
{
    return strlen($head) >= 12 && substr($head, 4, 4) === 'ftyp' ? substr($head, 8, 4) : '';
}

/** Видео MP4: основная марка из списка — или, если основная своя
    (камеры пишут XAVC, телефоны — свои), совместимая из списка.
    Звук и снимки отсеиваются по основной марке. */
function media_is_mp4(string $head): bool
{
    $major = media_brand($head);
    if ($major === '' || $major === 'qt  ' || in_array($major, MEDIA_STILL_BRANDS, true)
        || in_array($major, MEDIA_AUDIO_BRANDS, true)) {
        return false;
    }
    if (in_array($major, MEDIA_MP4_BRANDS, true)) return true;
    /* Совместимые марки — после основной и номера версии (с байта 16)
       до конца блока ftyp, по четыре байта. */
    $size = (int)(unpack('N', substr($head, 0, 4))[1] ?? 0);
    $end  = min($size > 0 ? $size : strlen($head), strlen($head));
    for ($i = 16; $i + 4 <= $end; $i += 4) {
        if (in_array(substr($head, $i, 4), MEDIA_MP4_BRANDS, true)) return true;
    }
    return false;
}

/** Видео по содержимому файла.

    getimagesize для видео не годится, поэтому читаем метку формата
    в самом начале файла — её ставит кодировщик, и подделать её так,
    чтобы файл при этом остался исполняемым, нельзя.

    У mp4 на позиции 4 стоит слово ftyp (это заголовок контейнера ISO BMFF),
    за ним марка — и она должна быть видео. У webm в самом начале — четыре
    байта EBML. Проверяем именно их, а не расширение: расширение пишет отправитель. */
function media_video_ext(string $head): ?string
{
    if (media_is_mp4($head)) return 'mp4';
    if (substr($head, 0, 4) === "\x1A\x45\xDF\xA3") return 'webm';
    return null;
}

/* Где какие файлы стоят. Сверяем путь целиком, а не имя: снимок
   разработчика /images/works/x.jpg и загруженный /images/uploads/x.jpg —
   разные файлы. Нужно и списку, и удалению. */
$used = [];
foreach (works_canon() as $g) {
    foreach ($g['projects'] as $w) {
        if (empty($w['image'])) continue;
        /* post_image() пропускает и /images//uploads/x.png, и /images/./uploads/x.png,
           и файл по ним находится. Без приведения такой путь не совпал бы
           со списком, и стоящий в карточке файл удалился бы. */
        $k = preg_replace('~/(?:\./)+~', '/', preg_replace('~/{2,}~', '/', (string)$w['image']) ?? '') ?? '';
        $used[$k][] = $w['domain'];
    }
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $what = post_one($_POST['do'] ?? '');

    /* ----------------------------------------------------------- удаление */
    if ($what === 'del') {
        $name = post_one($_POST['name'] ?? '');
        /* Имя сверяем целиком, а не «очищаем»: так ../ не пролезет ни в каком виде. */
        if (!preg_match('~^[a-z0-9][a-z0-9._-]{0,80}\.(jpe?g|png|webp|gif|mp4|webm)$~', $name)
            || !is_file($DIR . '/' . $name)) {
            admin_flash('Такого файла нет.', 'err');
        } elseif ($who = $used[$WEB . '/' . $name] ?? []) {
            /* Стоящий в карточке не удаляем. Путь в проекте остался бы, и на
               сайте вместо снимка была бы пустая рамка (подложка не вернётся:
               путь-то есть), а сохранить проект было бы нельзя, пока снимок
               не убран, — даже ради перевода. */
            admin_flash('Файл ' . $name . ' стоит в карточке ' . implode(', ', array_unique($who))
                . '. Сначала поменяйте или очистите поле «Снимок» в Портфолио, потом удаляйте.', 'err');
        } elseif (!@unlink($DIR . '/' . $name)) {
            admin_flash('Файл не удалился. Проверьте права на папку ' . $WEB . '.', 'err');
        } else {
            admin_flash('Файл удалён.');
        }
        admin_go(admin_url('media'));
    }

    /* ---------------------------------------------------------- загрузка */
    $f = $_FILES['file'] ?? null;
    $NOT_MEDIA = 'Это не картинка и не видео в понятном формате. Нужен JPEG, PNG, WebP, GIF, '
               . 'MP4 или WebM. SVG не принимаем: внутри него бывает исполняемый код.';

    if (!$f || !is_array($f) || ($f['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        admin_flash('Файл не выбран.', 'warn');
    } elseif (($f['error'] ?? 0) === UPLOAD_ERR_INI_SIZE || ($f['error'] ?? 0) === UPLOAD_ERR_FORM_SIZE) {
        admin_flash('Файл крупнее, чем принимает сервер: не больше ' . admin_size(max($MAX, $MAX_VIDEO))
                  . '. Сожмите его перед загрузкой.', 'err');
    } elseif (($f['error'] ?? 0) !== UPLOAD_ERR_OK) {
        admin_flash('Файл не дошёл целиком. Попробуйте ещё раз.', 'err');
    } elseif (!is_uploaded_file($f['tmp_name'])) {
        admin_flash('Это не загруженный файл.', 'err');
    /* Марка контейнера — раньше проверок размера. Иначе MOV, HEIC или M4A
       крупнее предела для картинок получали «сохраните в JPEG», ролик тоже,
       а свои сообщения ниже не показывались почти никогда: MOV редко
       бывает меньше 6 МБ. */
    } elseif (($brand = media_brand($head = media_head($f['tmp_name']))) === 'qt  ') {
        admin_flash('Это ролик QuickTime (MOV), а панель принимает MP4 или WebM. '
                  . 'Сохраните ролик в одном из них.', 'err');
    } elseif (in_array($brand, MEDIA_STILL_BRANDS, true)) {
        admin_flash('Это снимок AVIF или HEIC, а панель принимает JPEG, PNG, WebP или GIF. '
                  . 'Сохраните снимок в одном из них.', 'err');
    } elseif ($brand !== '' && !media_is_mp4($head)) {
        /* Тот же контейнер, но не видео: звук M4A и прочее. Картинкой он тоже быть не может. */
        admin_flash($NOT_MEDIA, 'err');
    } elseif (($vext = media_video_ext($head)) !== null && (int)$f['size'] > $MAX_VIDEO) {
        admin_flash('Видео больше ' . admin_size($MAX_VIDEO) . '. Сожмите перед загрузкой: '
                  . 'вертикальный ролик на минуту столько не весит.', 'err');
    } elseif ($vext === null && (int)$f['size'] > $MAX) {
        admin_flash('Файл больше ' . admin_size($MAX) . '. Снимок сайта столько не весит — сохраните в JPEG.', 'err');
    } else {
        $info = $vext === null ? @getimagesize($f['tmp_name']) : null;
        $type = is_array($info) ? (int)($info[2] ?? 0) : 0;

        /* Проверки размеров — только для картинок: у видео их без разбора
           контейнера не узнать, а метки формата в начале файла достаточно.
           Каждое условие начинается с $vext === null именно поэтому:
           видео проходит мимо них и попадает прямо в сохранение. */
        if ($vext === null && !isset($TYPES[$type])) {
            admin_flash($NOT_MEDIA, 'err');
        } elseif ($vext === null && ((int)$info[0] < 60 || (int)$info[1] < 60)) {
            admin_flash('Картинка меньше 60 пикселей по стороне — для снимка сайта это ошибка.', 'err');
        } elseif ($vext === null && ((int)$info[0] > 6000 || (int)$info[1] > 6000)) {
            admin_flash('Картинка больше 6000 пикселей по стороне. Уменьшите перед загрузкой.', 'err');
        } else {
            $ext = $vext ?? $TYPES[$type];

            /* Имя собираем сами. Подсказка — домен проекта или исходное имя,
               но из неё остаются только разрешённые знаки. */
            $hint = post_one($_POST['name'] ?? '');
            if ($hint === '') $hint = (string)($f['name'] ?? '');
            $hint = pathinfo($hint, PATHINFO_FILENAME);
            $base = mb_strtolower($hint);
            $base = preg_replace('~[^a-z0-9.-]+~u', '-', $base) ?? '';
            $base = trim(preg_replace('~-{2,}~', '-', $base) ?? '', '-.');
            if ($base === '' || !preg_match('~^[a-z0-9]~', $base)) {
                $base = 'image-' . date('Ymd') . '-' . bin2hex(random_bytes(3));
            }
            $base = mb_substr($base, 0, 70);

            if (!is_dir($DIR) && !@mkdir($DIR, 0755, true) && !is_dir($DIR)) {
                admin_flash('Папка ' . $WEB . ' не создаётся. Проверьте права.', 'err');
                admin_go(admin_url('media'));
            }

            /* Не затираем молча чужой файл: к имени добавляется номер. */
            $name = $base . '.' . $ext;
            $n = 2;
            while (is_file($DIR . '/' . $name)) {
                $name = $base . '-' . $n . '.' . $ext;
                $n++;
                if ($n > 200) { $name = $base . '-' . bin2hex(random_bytes(3)) . '.' . $ext; break; }
            }

            if (@move_uploaded_file($f['tmp_name'], $DIR . '/' . $name)) {
                @chmod($DIR . '/' . $name, 0644);
                admin_flash('Загружено. Путь для карточки проекта: ' . $WEB . '/' . $name);
            } else {
                admin_flash('Не удалось записать файл. Проверьте права на папку ' . $WEB . '.', 'err');
            }
        }
    }
    admin_go(admin_url('media'));
}

/* ------------------------------------------------------------- отрисовка */
$files = [];
foreach (glob($DIR . '/*.{jpg,jpeg,png,webp,gif,mp4,webm}', GLOB_BRACE) ?: [] as $p) {
    $files[] = ['name' => basename($p), 'size' => (int)@filesize($p), 'time' => (int)@filemtime($p)];
}
usort($files, static fn($a, $b) => $b['time'] <=> $a['time']);

$writable = is_dir($DIR) ? is_writable($DIR) : is_writable(dirname($DIR));

admin_head('media');
?>

<?php if (!$writable): ?>
  <div class="flash err">Папка <b class="mono"><?= $e($WEB) ?></b> недоступна на запись.
     В cPanel → File Manager → Permissions поставьте 755.</div>
<?php endif; ?>

<div class="panel">
  <h3>Загрузить картинку</h3>
  <p class="muted">JPEG, PNG, WebP или GIF до <?= $e(admin_size($MAX)) ?>;
     MP4 или WebM до <?= $e(admin_size($MAX_VIDEO)) ?>.
     SVG не принимаем: внутри него бывает исполняемый код, и при открытии
     по прямой ссылке он выполнится в домене сайта.
     Формат определяется по содержимому файла, а не по расширению.</p>
  <?php if ($SERVER > 0 && $SERVER < 40 * 1024 * 1024): ?>
    <p class="muted">Сервер сейчас принимает файлы не больше <?= $e(admin_size($SERVER)) ?>
       (upload_max_filesize и post_max_size в настройках PHP) — отсюда и пределы выше.
       Чтобы загружать ролики крупнее, попросите разработчика поднять оба значения.</p>
  <?php endif; ?>

  <form method="post" action="<?= $e(admin_url('media')) ?>" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <?php /* Подсказка PHP о размере — по большему из пределов. PHP проверяет
             её ДО того, как мы узнаём, видео это или картинка, и с пределом
             для картинок отбивал бы любое видео крупнее 6 МБ. Точная
             проверка по типу файла идёт дальше, на сервере. Оба предела
             уже урезаны до того, что пропустит сам сервер. */ ?>
    <input type="hidden" name="MAX_FILE_SIZE" value="<?= (int)max($MAX, $MAX_VIDEO) ?>">
    <div class="row">
      <div>
        <label for="file">Изображение или видео</label>
        <input type="file" id="file" name="file"
               accept="image/jpeg,image/png,image/webp,image/gif,video/mp4,video/webm" required>
      </div>
      <div>
        <label for="name">Как назвать <span class="hint">обычно домен проекта; пусто — возьмём имя файла</span></label>
        <input type="text" id="name" name="name" class="mono" placeholder="example.az">
      </div>
    </div>
    <div class="btnrow"><button class="btn" type="submit"<?= $writable ? '' : ' disabled' ?>>Загрузить</button></div>
  </form>
</div>

<div class="panel">
  <h3>Загруженные — <?= count($files) ?></h3>
  <?php if (!$files): ?>
    <p class="muted">Пока пусто. Снимки сайтов, которые уже стоят в портфолио,
       лежат в папке разработчика <b class="mono">/images/works/</b> и правятся
       вместе с кодом — здесь их нет и удалить их отсюда нельзя.</p>
  <?php else: ?>
    <p class="muted">Кликните по пути под картинкой, чтобы скопировать его,
       и вставьте в поле «Снимок» в разделе Портфолио.
       Ролики в карточку проекта не встают — карточка показывает только
       картинку. Видео нужно для страниц и статей, его ставит разработчик.</p>
    <div class="grid-media" style="margin-top:14px">
      <?php foreach ($files as $f):
        $path = $WEB . '/' . $f['name'];
        $who  = implode(', ', array_unique($used[$path] ?? []));
      ?>
        <div class="media-item">
          <?php if (preg_match('~\.(mp4|webm)$~i', $f['name'])): ?>
            <?php /* preload="metadata": грузим первый кадр, а не весь ролик —
                     иначе страница со списком тянет десятки мегабайт. */ ?>
            <video src="<?= $e($path) ?>" preload="metadata" muted playsinline
                   controls style="display:block;width:100%;aspect-ratio:16/10;
                   object-fit:cover;background:var(--ink)"></video>
          <?php else: ?>
            <img src="<?= $e($path) ?>" alt="" loading="lazy">
          <?php endif; ?>
          <div class="m">
            <button type="button" class="copypath" data-copy="<?= $e($path) ?>"
                    title="Кликните, чтобы скопировать путь"><?= $e($path) ?></button>
            <?= $e(round($f['size'] / 1024)) ?> КБ · <?= $e(date('d.m.Y', $f['time'])) ?>
            <?php if ($who !== ''): ?><br><span class="pill">стоит у <?= $e($who) ?></span><?php endif; ?>
          </div>
          <?php if ($who !== ''): ?>
            <?php /* Стоящий в карточке не удаляется (см. удаление выше) — кнопка
                     говорит об этом сразу, а не после нажатия. */ ?>
            <button class="btn ghost sm" type="button" disabled style="width:100%"
                    title="Сначала поменяйте или очистите поле «Снимок» в Портфолио">Удалить нельзя: в карточке</button>
          <?php else: ?>
          <form method="post" action="<?= $e(admin_url('media')) ?>"
                data-confirm="Удалить <?= $e($f['name']) ?>?">
            <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
            <input type="hidden" name="do" value="del">
            <input type="hidden" name="name" value="<?= $e($f['name']) ?>">
            <button class="btn ghost sm" type="submit" style="width:100%">Удалить</button>
          </form>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php admin_foot(); ?>
