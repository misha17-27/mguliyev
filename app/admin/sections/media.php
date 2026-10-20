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

   Загруженное лежит в public/images/uploads/. Выкладка туда не лезет:
   она копирует файлы поверх, но ничего не удаляет. */

$e   = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$DIR = dirname(__DIR__, 3) . '/public/images/uploads';
$WEB = '/images/uploads';
$MAX = 6 * 1024 * 1024;        // картинка
$MAX_VIDEO = 40 * 1024 * 1024; // видео: вертикальный ролик столько и весит

/* Распознанный тип -> расширение. Список закрытый: что не здесь, то не картинка. */
$TYPES = [
    IMAGETYPE_JPEG => 'jpg',
    IMAGETYPE_PNG  => 'png',
    IMAGETYPE_WEBP => 'webp',
    IMAGETYPE_GIF  => 'gif',
];

/** Видео по содержимому файла.

    getimagesize для видео не годится, поэтому читаем метку формата
    в самом начале файла — её ставит кодировщик, и подделать её так,
    чтобы файл при этом остался исполняемым, нельзя.

    У mp4 на позиции 4 стоит слово ftyp (это заголовок контейнера ISO BMFF),
    у webm в самом начале — четыре байта EBML. Проверяем именно их,
    а не расширение: расширение пишет отправитель. */
function media_video_ext(string $path): ?string
{
    $fh = @fopen($path, 'rb');
    if (!$fh) return null;
    $head = (string)fread($fh, 12);
    fclose($fh);

    if (strlen($head) >= 12 && substr($head, 4, 4) === 'ftyp') return 'mp4';
    if (substr($head, 0, 4) === "\x1A\x45\xDF\xA3") return 'webm';
    return null;
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $what = post_one($_POST['do'] ?? '');

    /* ----------------------------------------------------------- удаление */
    if ($what === 'del') {
        $name = post_one($_POST['name'] ?? '');
        /* Имя сверяем целиком, а не «очищаем»: так ../ не пролезет ни в каком виде. */
        if (preg_match('~^[a-z0-9][a-z0-9._-]{0,80}\.(jpe?g|png|webp|gif|mp4|webm)$~', $name)
            && is_file($DIR . '/' . $name)) {
            @unlink($DIR . '/' . $name);
            admin_flash('Файл удалён. Если он стоял в карточке проекта, там снова будет отраслевая подложка.');
        } else {
            admin_flash('Такого файла нет.', 'err');
        }
        admin_go(admin_url('media'));
    }

    /* ---------------------------------------------------------- загрузка */
    $f = $_FILES['file'] ?? null;

    if (!$f || !is_array($f) || ($f['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        admin_flash('Файл не выбран.', 'warn');
    } elseif (($f['error'] ?? 0) === UPLOAD_ERR_INI_SIZE || ($f['error'] ?? 0) === UPLOAD_ERR_FORM_SIZE) {
        admin_flash('Файл крупнее, чем разрешает сервер. Уменьшите или сожмите снимок.', 'err');
    } elseif (($f['error'] ?? 0) !== UPLOAD_ERR_OK) {
        admin_flash('Файл не дошёл целиком. Попробуйте ещё раз.', 'err');
    } elseif (!is_uploaded_file($f['tmp_name'])) {
        admin_flash('Это не загруженный файл.', 'err');
    } elseif (($vext = media_video_ext($f['tmp_name'])) !== null && (int)$f['size'] > $MAX_VIDEO) {
        admin_flash('Видео больше ' . (int)($MAX_VIDEO / 1048576) . ' МБ. Сожмите перед загрузкой: '
                  . 'вертикальный ролик на минуту столько не весит.', 'err');
    } elseif ($vext === null && (int)$f['size'] > $MAX) {
        admin_flash('Файл больше ' . (int)($MAX / 1048576) . ' МБ. Снимок сайта столько не весит — сохраните в JPEG.', 'err');
    } else {
        $info = $vext === null ? @getimagesize($f['tmp_name']) : null;
        $type = is_array($info) ? (int)($info[2] ?? 0) : 0;

        /* Проверки размеров — только для картинок: у видео их без разбора
           контейнера не узнать, а метки формата в начале файла достаточно.
           Каждое условие начинается с $vext === null именно поэтому:
           видео проходит мимо них и попадает прямо в сохранение. */
        if ($vext === null && !isset($TYPES[$type])) {
            admin_flash('Это не картинка и не видео в понятном формате. Нужен JPEG, PNG, WebP, GIF, '
                      . 'MP4 или WebM. SVG не принимаем: внутри него бывает исполняемый код.', 'err');
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

/* Где какие снимки используются — чтобы было видно, что можно удалять. */
$used = [];
foreach (works_canon() as $g) {
    foreach ($g['projects'] as $w) {
        if (!empty($w['image'])) $used[basename($w['image'])] = $w['domain'];
    }
}

$writable = is_dir($DIR) ? is_writable($DIR) : is_writable(dirname($DIR));

admin_head('media');
?>

<?php if (!$writable): ?>
  <div class="flash err">Папка <b class="mono"><?= $e($WEB) ?></b> недоступна на запись.
     В cPanel → File Manager → Permissions поставьте 755.</div>
<?php endif; ?>

<div class="panel">
  <h3>Загрузить картинку</h3>
  <p class="muted">JPEG, PNG, WebP или GIF до <?= (int)($MAX / 1048576) ?> МБ;
     MP4 или WebM до <?= (int)($MAX_VIDEO / 1048576) ?> МБ.
     SVG не принимаем: внутри него бывает исполняемый код, и при открытии
     по прямой ссылке он выполнится в домене сайта.
     Формат определяется по содержимому файла, а не по расширению.</p>

  <form method="post" action="<?= $e(admin_url('media')) ?>" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <?php /* Подсказка PHP о размере — по большему из пределов. PHP проверяет
             её ДО того, как мы узнаём, видео это или картинка, и с пределом
             для картинок отбивал бы любое видео крупнее 6 МБ. Точная
             проверка по типу файла идёт дальше, на сервере. */ ?>
    <input type="hidden" name="MAX_FILE_SIZE" value="<?= max($MAX, $MAX_VIDEO) ?>">
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
        $who  = $used[$f['name']] ?? null;
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
            <?php if ($who): ?><br><span class="pill">стоит у <?= $e($who) ?></span><?php endif; ?>
          </div>
          <form method="post" action="<?= $e(admin_url('media')) ?>"
                data-confirm="Удалить <?= $e($f['name']) ?><?= $who ? ' — он стоит в карточке ' . $e($who) : '' ?>?">
            <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
            <input type="hidden" name="do" value="del">
            <input type="hidden" name="name" value="<?= $e($f['name']) ?>">
            <button class="btn ghost sm" type="submit" style="width:100%">Удалить</button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php admin_foot(); ?>
