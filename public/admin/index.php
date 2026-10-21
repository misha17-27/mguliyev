<?php
/* Единственная точка входа в панель управления.

   Все разделы открываются через ?section=…, а их код лежит в ../../app/admin/
   — выше корня сайта. Поэтому раздел невозможно открыть в обход проверки
   входа: по адресу его файла просто нет. Имя раздела сверяется со списком,
   а не подставляется в путь, поэтому ?section=../../config тоже ничего не даст. */

require __DIR__ . '/../../app/admin/boot.php';
require __DIR__ . '/../../app/admin/layout.php';

/* Корень сайта — папка, в которой лежит admin/. В репозитории это public/,
   на сервере ~/public_html, а код панели — в ~/app, рядом, а не внутри.
   Поэтому загрузки и снимки ищутся отсюда, а не от папки с кодом:
   путь от app/ на сервере вёл в ~/public, которой нет. */
define('ADMIN_WEBROOT', dirname(__DIR__));

/** Предел из php.ini в байтах: «8M» → 8388608. 0 — предела нет. */
function admin_ini_bytes(string $key): int
{
    $v = trim((string)ini_get($key));
    $n = (int)$v;
    switch (strtolower(substr($v, -1))) {
        case 'g': $n *= 1024;   // без break: гигабайт — это 1024 мегабайта, и так далее
        case 'm': $n *= 1024;
        case 'k': $n *= 1024;
    }
    return max(0, $n);
}

/** Размер для человека: «8 МБ», «512 КБ». */
function admin_size(int $bytes): string
{
    return $bytes >= 1048576 ? (int)floor($bytes / 1048576) . ' МБ' : max(1, (int)floor($bytes / 1024)) . ' КБ';
}

/** Сколько сервер примет в одном файле: меньшее из upload_max_filesize
    (на файл) и post_max_size (на весь запрос). 0 — предела нет. */
function admin_upload_cap(): int
{
    $cap = 0;
    foreach ([admin_ini_bytes('upload_max_filesize'), admin_ini_bytes('post_max_size')] as $lim) {
        if ($lim > 0) $cap = $cap > 0 ? min($cap, $lim) : $lim;
    }
    return $cap;
}

/* Поля с паролями и секретными ключами: account — current, password,
   password2; mail — pass; security — secret. Отложенная форма их не
   хранит (см. ниже, у страницы входа). */
const ADMIN_SECRET_FIELDS = ['current', 'password', 'password2', 'pass', 'secret'];

/* Отложенные формы. Форма, отправленная в истёкшую сессию, лежит в файле
   сессии на диске до входа. Пределы — чтобы этим нельзя было забивать
   диск: число форм, их общий размер и срок. */
const ADMIN_RESUME_MAX   = 5;
const ADMIN_RESUME_BYTES = 524288;      // 512 КБ на все отложенные формы вместе
const ADMIN_RESUME_TTL   = 86400;       // сутки

/** Отложенные формы: номер => {uid, at, section, q, lang, fields, secret}.
    С $uid — только формы этого редактора: форму из чужой сессии не
    показываем и не отправляем. Старше суток — не показываем вовсе. */
function admin_resume_all(?string $uid = null): array
{
    $out = [];
    foreach ((array)($_SESSION['resume'] ?? []) as $id => $r) {
        if (!is_array($r) || !is_string($r['section'] ?? null) || !is_array($r['fields'] ?? null)) continue;
        if ((int)($r['at'] ?? 0) < time() - ADMIN_RESUME_TTL) continue;
        if ($uid !== null && !hash_equals((string)($r['uid'] ?? ''), $uid)) continue;
        $out[(string)$id] = $r;
    }
    return $out;
}

/** Отложить форму до входа. Вернёт её номер, или null, если она одна
    больше предела. Самые давние формы сверх предела вытесняются. */
function admin_resume_keep(array $r): ?string
{
    if (strlen(serialize($r)) > ADMIN_RESUME_BYTES) return null;
    $all = admin_resume_all();
    /* Буква впереди: номер из одних цифр PHP превратил бы в числовой ключ. */
    $id = 'r' . bin2hex(random_bytes(6));
    $all[$id] = $r;
    while (count($all) > ADMIN_RESUME_MAX || strlen(serialize($all)) > ADMIN_RESUME_BYTES) {
        array_shift($all);
    }
    $_SESSION['resume'] = $all;
    return $id;
}

/** Убрать отложенную форму. */
function admin_resume_forget(string $id): void
{
    unset($_SESSION['resume'][$id]);
}

/** Поля формы плоским списком: ['t[web.t45][az]' => '…']. Так их можно
    снова вывести в форму, и PHP разберёт их в тот же массив. */
function admin_flat_fields(array $a, string $pre = ''): array
{
    $out = [];
    foreach ($a as $k => $v) {
        $name = $pre === '' ? (string)$k : $pre . '[' . $k . ']';
        if (is_array($v)) $out += admin_flat_fields($v, $name);
        else $out[$name] = (string)$v;
    }
    return $out;
}

/** Служебное поле формы — ключ версии, число полей, подсказка PHP
    о размере файла. Их не показываем: вписанного в них нет. */
function admin_service_field(string $name): bool
{
    return strncmp($name, '_', 1) === 0 || strncmp($name, 'MAX_FILE_SIZE', 13) === 0;
}

$isPost  = ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
$section = (string)($_GET['section'] ?? 'dashboard');
$known   = array_keys(admin_sections());

/* Прочие параметры адреса — запись, которую правят. Отбор тот же, что
   у переключателя языка в layout.php. */
$q = [];
foreach ($_GET as $qk => $qv) {
    if ($qk === 'section' || $qk === 'lang' || !is_string($qv)
        || !preg_match('~^[a-z_]{1,20}$~', (string)$qk)) continue;
    $q[$qk] = $qv;
}
$back = admin_url(in_array($section, $known, true) ? $section : 'dashboard', $q);

/* Запрос больше post_max_size. Такой PHP выбрасывает целиком: ни полей,
   ни файла, ни ключа формы. Проверка ключа отвечала голым 403 «Ключ формы
   не совпал», и человек повторял ту же загрузку, не понимая, что дело
   в размере. Поэтому размер проверяется раньше ключа. */
$postCap = admin_ini_bytes('post_max_size');
$tooBig  = $isPost && !$_POST && !$_FILES && $postCap > 0
        && (int)($_SERVER['CONTENT_LENGTH'] ?? 0) > $postCap;
/* У загрузки называем предел на файл, а не на запрос: при upload_max_filesize
   меньше post_max_size файл, сжатый «под 8 МБ», отбился бы снова. */
$tooBigMsg = stripos((string)($_SERVER['CONTENT_TYPE'] ?? ''), 'multipart/form-data') === 0
    ? 'Файл больше, чем принимает сервер: не больше ' . admin_size(admin_upload_cap()) . '. '
      . 'Ничего не сохранено — PHP отбросил запрос целиком. Сожмите файл или попросите '
      . 'разработчика поднять upload_max_filesize и post_max_size в настройках PHP.'
    : 'Отправленное больше, чем принимает сервер: не больше ' . admin_size($postCap) . ' за раз. '
      . 'Ничего не сохранено — PHP отбросил запрос целиком. Сожмите файл или попросите '
      . 'разработчика поднять post_max_size в настройках PHP.';

if ($tooBig && headers_sent()) {
    /* При включённом display_errors и без буфера вывода PHP печатает
       предупреждение о размере раньше заголовков: ни сессии, ни переадресации
       уже не будет. Говорим здесь же — страница без оформления, но с причиной. */
    echo '<!doctype html><meta charset="utf-8"><title>Слишком большой файл</title>'
       . '<p>' . e($tooBigMsg) . '</p><p><a href="' . e($back) . '">Вернуться в панель</a></p>';
    exit;
}

admin_boot();

/* Выход — только POST со своим ключом: иначе чужая картинка с адресом
   /admin/index.php?section=logout выкидывала бы редактора из панели. */
if ($section === 'logout') {
    /* Именно POST, а не «проверить ключ, если он есть». admin_check_post()
       на GET не проверяет ничего, и без этой строки чужая страница с
       <img src="…?section=logout"> выкидывала бы редактора из панели. */
    if (!$isPost) {
        admin_go(admin_url(admin_user() ? 'dashboard' : 'login'));
    }
    /* Сессия уже кончилась — выходить не из чего. Иначе «Выйти» на вкладке,
       пролежавшей ночь, давало голое 403 про ключ формы. */
    if (!admin_user()) admin_go(admin_url('login'));
    admin_check_post();
    admin_logout();
    admin_flash('Вы вышли из панели.');
    admin_go(admin_url('login'));
}

/* Нет учётной записи — только начальная настройка, что бы ни запросили. */
if (!admin_auth()) {
    require __DIR__ . '/../../app/admin/sections/setup.php';
    exit;
}

/* Не вошёл — только страница входа. */
if (!admin_user()) {
    /* Форма раздела пришла, а входа уже нет: сессия истекла (два часа без
       действий или двенадцать всего), браузер перезапускали, файл сессии
       убрали. Раньше такой запрос попадал на страницу входа, её проверка
       ключа отвечала голым 403 «Ключ формы не совпал» — и всё вписанное,
       иногда статья за два часа, пропадало.

       Теперь отправленное откладывается в сессию, а после входа панель
       возвращает на тот же раздел и показывает его с кнопкой «Отправить
       ещё раз». Само оно НЕ сохраняется: ключ формы проверить уже нечем,
       и чужая страница могла бы так подсунуть свои поля.

       Откладывается только форма из браузера, где истёк вход редактора
       (admin_boot() оставляет в сессии отметку, чей это был вход, —
       см. admin_expired()), со своего адреса и в пределах размера. Иначе любой посетитель мог бы
       складывать в файлы сессий что угодно, а после входа редактор увидел
       бы это как «свои» правки. С чужого сайта cookie сессии не придёт
       вовсе (SameSite=Lax). */
    if ($isPost && $section !== 'login') {
        $uid = admin_expired();
        if ($tooBig) {
            admin_flash($tooBigMsg . ' Вдобавок истекла сессия — войдите заново.', 'err');
            admin_go(admin_url('login'));
        }
        if ($uid === '' || !in_array($section, $known, true) || !origin_ok(I18n::$cfg['site_url'] ?? '')) {
            admin_flash('Сессия истекла, и отправленное не сохранено. Войдите заново и повторите.', 'warn');
            admin_go(admin_url('login'));
        }

        $post = $_POST;
        unset($post['_csrf'], $post['_resume']);
        /* Пароли и секретные ключи не откладываем: файл сессии лежит на
           диске открытым текстом, а экран отложенной формы показывает поля
           как есть. Запоминаем только, какие из них были вписаны, — их
           спросят заново. Пустой пароль почты и пустой секрет капчи значат
           «оставить прежний», так что повторной отправке это не мешает. */
        $secret = [];
        foreach (ADMIN_SECRET_FIELDS as $k) {
            if (isset($post[$k]) && is_string($post[$k]) && $post[$k] !== '') $secret[] = $k;
            unset($post[$k]);
        }
        /* Поля — плоским списком в том порядке, в каком пришли: порядок
           строк формы — это порядок пакетов и услуг на сайте. */
        $fields = [];
        $typed  = false;
        foreach (admin_flat_fields($post) as $name => $v) {
            $fields[] = [(string)$name, $v];
            if (!admin_service_field((string)$name) && trim($v) !== '') $typed = true;
        }
        /* Учётную запись не откладываем вовсе: кроме паролей в ней только
           почта, а без текущего пароля её форма всё равно не пройдёт. */
        if ($section === 'account') $typed = false;
        $hadFile = false;
        foreach ($_FILES as $fv) {
            if (is_array($fv) && ($fv['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) $hadFile = true;
        }

        $id = $typed ? admin_resume_keep([
            'uid'     => $uid,
            'at'      => time(),
            'section' => $section,
            'q'       => $q,
            'lang'    => admin_lang(),
            'fields'  => $fields,
            'secret'  => $secret,
        ]) : null;

        /* Первый экран после входа — этот раздел, а если форма отложена, —
           она сама. */
        $_SESSION['resume_land'] = ['section' => $section, 'q' => $q + ($id !== null ? ['resume' => $id] : []),
                                    'lang' => admin_lang()];
        admin_flash('Сессия истекла, и правки не сохранились. '
            . ($id !== null
                ? 'Но вписанное не пропало: войдите заново — панель покажет отправленное, '
                  . 'его останется проверить и отправить ещё раз.'
                : ($typed
                    ? 'Отложить их до входа не вышло: форма слишком большая. Войдите заново и внесите правки снова.'
                    : 'Войдите заново — панель откроет тот же раздел.'))
            . ($id !== null && $secret ? ' Пароли и секретные ключи в сессии не храним — их придётся вписать заново.' : '')
            . ($hadFile ? ' Файл придётся выбрать заново: файлы в сессии не хранятся.' : ''), 'warn');
        admin_go(admin_url('login'));
    }
    require __DIR__ . '/../../app/admin/sections/login.php';
    exit;
}

/* Переключатель языка в верхней строке. Запоминаем в сессии, чтобы при
   переходе между разделами язык не сбрасывался. */
if (isset($_GET['lang'])) {
    admin_set_lang((string)$_GET['lang']);
    $q = $_GET;
    unset($q['lang']);
    admin_go('/admin/index.php?' . http_build_query($q ?: ['section' => 'dashboard']));
}

if (!in_array($section, $known, true)) $section = 'dashboard';

if ($tooBig) {
    admin_flash($tooBigMsg, 'err');
    admin_go(admin_url($section, $q));
}

admin_check_post();

/* Отложенное при истёкшей сессии (см. выше, у страницы входа).

   Экран отложенной формы открывается только по её номеру (?resume=…):
   после входа панель ведёт на последнюю, остальные — ссылками с неё.
   Другие записи раздела открываются как обычно — раньше отложенная форма
   перехватывала любую статью раздела. «Отправить ещё раз» и «Не нужно» —
   кнопки формы с её ключом, поэтому чужая ссылка их не нажмёт. */
$land = $_SESSION['resume_land'] ?? null;
if (is_array($land) && !$isPost) {
    unset($_SESSION['resume_land']);
    if (in_array($land['section'] ?? '', $known, true)) {
        admin_set_lang((string)($land['lang'] ?? ''));
        admin_go(admin_url($land['section'], (array)($land['q'] ?? [])));
    }
}

$mine = admin_resume_all((string)($_SESSION['uid'] ?? ''));
if ($isPost) {
    $rid = is_string($_POST['_resume'] ?? null) ? $_POST['_resume'] : '';
    if ($rid !== '') admin_resume_forget($rid);
    $drop = is_string($_POST['_resume_drop'] ?? null) ? $_POST['_resume_drop'] : '';
    if ($drop !== '') {
        admin_resume_forget($drop);
        unset($q['resume']);
        admin_flash('Отложенные правки убраны.');
        admin_go(admin_url($section, $q));
    }
} elseif (is_string($_GET['resume'] ?? null)) {
    $rid = $_GET['resume'];
    unset($q['resume']);
    if (!isset($mine[$rid])) {
        admin_flash('Этих отложенных правок уже нет — их отправили или убрали.', 'warn');
        admin_go(admin_url($section, $q));
    }
    /* Язык — тот, на котором форму заполняли: иначе подписи и переводы
       на экране раздела после отправки разошлись бы с отправленным. */
    admin_set_lang((string)($mine[$rid]['lang'] ?? ''));
    admin_resume_page($rid, $mine[$rid], $mine);
    exit;
}

$file = __DIR__ . '/../../app/admin/sections/' . $section . '.php';
if (!is_file($file)) {
    $section = 'dashboard';
    $file = __DIR__ . '/../../app/admin/sections/dashboard.php';
}
require $file;

/** Экран отложенной формы. Поля идут в том порядке, в каком были
    отправлены: заполненные — видимыми для проверки и копирования,
    служебные и пустые — скрытыми. Повторная отправка повторяет исходную
    в точности, и проверка устаревшей вкладки в разделе срабатывает так же,
    как сработала бы тогда. */
function admin_resume_page(string $id, array $r, array $pending): void
{
    $q = (array)$r['q'];
    unset($q['resume']);
    $shownN = 0;
    foreach ((array)$r['fields'] as $f) {
        if (is_array($f) && !admin_service_field((string)$f[0]) && trim((string)$f[1]) !== '') $shownN++;
    }
    /* Прочие отложенные формы — ссылками: после входа панель ведёт только
       на последнюю, и про остальные иначе не узнать. */
    $others = [];
    $titles = admin_sections();
    foreach ($pending as $k => $o) {
        if ($k === $id) continue;
        $oq = (array)$o['q'];
        unset($oq['resume']);
        $others[] = [
            'href'  => admin_url($o['section'], $oq + ['resume' => $k]),
            'label' => '«' . ($titles[$o['section']][0] ?? $o['section']) . '»'
                     . ($oq ? ' — ' . implode(', ', array_map('strval', $oq)) : '')
                     . ' (' . strtoupper((string)($o['lang'] ?? '')) . ')',
        ];
    }

    admin_head($r['section']);
    ?>
<div class="flash warn" role="status">Сессия истекла, пока заполнялась форма, и она не сохранилась.
  Ниже — всё, что было отправлено. Проверьте и отправьте ещё раз — или уберите эти правки.</div>

<form method="post" action="<?= e(admin_url($r['section'], $q)) ?>">
  <input type="hidden" name="_csrf" value="<?= e(csrf_token()) ?>">
  <input type="hidden" name="_resume" value="<?= e($id) ?>">
  <div class="panel">
    <h3>Отправленное</h3>
    <details<?= $shownN <= 30 ? ' open' : '' ?>>
      <summary class="muted">Заполненные поля — <?= $shownN ?></summary>
      <?php $i = 0; foreach ((array)$r['fields'] as $f):
        if (!is_array($f)) continue;
        $name = (string)$f[0]; $v = (string)$f[1];
        if (admin_service_field($name) || trim($v) === ''): ?>
        <input type="hidden" name="<?= e($name) ?>" value="<?= e($v) ?>">
      <?php else: $i++;
        $rows = min(14, max(2, substr_count($v, "\n") + 1 + intdiv(mb_strlen($v), 90))); ?>
        <label for="rs<?= $i ?>" class="mono"><?= e($name) ?></label>
        <?php /* Перевод строки сразу после тега: первый браузер съедает,
                 и текст, начинающийся с пустой строки, не теряет её. */ ?>
        <textarea id="rs<?= $i ?>" name="<?= e($name) ?>" rows="<?= $rows ?>" readonly>
<?= e($v) ?></textarea>
      <?php endif; endforeach; ?>
    </details>
    <?php /* Вписанные пароли и ключи в сессии не хранились — спрашиваем здесь.
             Пустое поле в почте и капче значит «оставить прежний». */
    foreach ((array)($r['secret'] ?? []) as $j => $name): if (!is_string($name)) continue; ?>
      <label for="rp<?= (int)$j ?>"><span class="mono"><?= e($name) ?></span>
        <span class="hint">впишите заново: пароли и секретные ключи в сессии не храним; пусто — останется прежний</span></label>
      <input type="password" id="rp<?= (int)$j ?>" name="<?= e($name) ?>" class="mono" autocomplete="new-password">
    <?php endforeach; ?>
    <div class="btnrow">
      <button class="btn" type="submit">Отправить ещё раз</button>
    </div>
  </div>
</form>

<form method="post" action="<?= e(admin_url($r['section'], $q)) ?>" style="margin-top:12px">
  <input type="hidden" name="_csrf" value="<?= e(csrf_token()) ?>">
  <input type="hidden" name="_resume_drop" value="<?= e($id) ?>">
  <button class="btn ghost" type="submit">Убрать эти правки и открыть раздел</button>
</form>

<?php if ($others): ?>
  <p class="muted" style="margin-top:16px">Отложены и другие формы:
    <?php foreach ($others as $k => $o): ?><?= $k ? ', ' : '' ?><a href="<?= e($o['href']) ?>"><?= e($o['label']) ?></a><?php endforeach; ?>.</p>
<?php endif; ?>
    <?php
    admin_foot();
}
