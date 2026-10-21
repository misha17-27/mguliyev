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
$tooBigMsg = 'Отправленное больше, чем принимает сервер: не больше ' . admin_size($postCap) . ' за раз. '
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
       и чужая страница могла бы так подсунуть свои поля. По той же причине
       откладывается только запрос со своего адреса и со своей cookie
       сессии — с чужого сайта браузер её не пришлёт (SameSite=Lax). */
    if ($isPost && $section !== 'login') {
        if (!origin_ok(I18n::$cfg['site_url'] ?? '')) {
            http_response_code(403);
            exit('Запрос пришёл с другого адреса.');
        }
        $post = $_POST;
        unset($post['_csrf']);
        $typed = false;
        foreach (admin_flat_fields($post) as $name => $v) {
            if (admin_service_field($name)) continue;
            if (trim($v) !== '') { $typed = true; break; }
        }
        $hadFile = false;
        foreach ($_FILES as $fv) {
            if (is_array($fv) && ($fv['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) $hadFile = true;
        }

        if ($tooBig) {
            admin_flash($tooBigMsg . ' Вдобавок истекла сессия — войдите заново.', 'err');
        } elseif (!in_array($section, $known, true) || !isset($_COOKIE[session_name()])) {
            admin_flash('Сессия истекла, и отправленное не сохранено. Войдите заново и повторите.', 'warn');
        } else {
            $_SESSION['resume'] = [
                'section' => $section,
                'q'       => $q,
                'lang'    => admin_lang(),
                'post'    => $typed ? $post : null,
                'land'    => true,
            ];
            admin_flash('Сессия истекла, и правки не сохранились. '
                . ($typed
                    ? 'Но вписанное не пропало: войдите заново — панель откроет тот же раздел '
                      . 'и покажет отправленное, его останется проверить и отправить ещё раз.'
                    : 'Войдите заново — панель откроет тот же раздел.')
                . ($hadFile ? ' Файл придётся выбрать заново: файлы в сессии не хранятся.' : ''), 'warn');
        }
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

/* Отложенное при истёкшей сессии (см. выше, у страницы входа). Первый
   экран после входа — тот раздел, где сессия кончилась, и там вместо
   раздела отправленное: «Отправить ещё раз» или «Открыть без них».
   Любая отправка формы в этом разделе — значит, решение принято. */
$resume = $_SESSION['resume'] ?? null;
if (is_array($resume) && in_array($resume['section'] ?? '', $known, true)) {
    if (!empty($resume['land']) && !$isPost) {
        $_SESSION['resume']['land'] = false;
        if (($resume['post'] ?? null) === null) unset($_SESSION['resume']);
        admin_set_lang((string)($resume['lang'] ?? ''));
        admin_go(admin_url($resume['section'], (array)$resume['q']));
    }
    if ($resume['section'] === $section) {
        if ($isPost) {
            unset($_SESSION['resume']);
        } elseif (($q['resume'] ?? '') === 'drop') {
            unset($_SESSION['resume'], $q['resume']);
            admin_go(admin_url($section, $q));
        } elseif (is_array($resume['post'] ?? null)) {
            admin_resume_page($resume, $q);
            exit;
        }
    }
}

$file = __DIR__ . '/../../app/admin/sections/' . $section . '.php';
if (!is_file($file)) {
    $section = 'dashboard';
    $file = __DIR__ . '/../../app/admin/sections/dashboard.php';
}
require $file;

/** Экран отложенной формы. Поля, где что-то вписано, видны и выделяются
    для копирования, служебные (ключ версии, число полей) идут скрытыми —
    повторная отправка повторяет исходную в точности, и проверка
    устаревшей вкладки в разделе срабатывает так же, как сработала бы тогда. */
function admin_resume_page(array $r, array $q): void
{
    $shown = $hidden = [];
    foreach (admin_flat_fields((array)$r['post']) as $name => $v) {
        if (!admin_service_field($name) && trim($v) !== '') $shown[$name] = $v; else $hidden[$name] = $v;
    }
    unset($q['resume']);

    admin_head($r['section']);
    ?>
<div class="flash warn" role="status">Сессия истекла, пока заполнялась форма, и она не сохранилась.
  Ниже — всё, что было отправлено. Проверьте и отправьте ещё раз — или откройте раздел без этих правок.</div>

<form method="post" action="<?= e(admin_url($r['section'], (array)$r['q'])) ?>">
  <input type="hidden" name="_csrf" value="<?= e(csrf_token()) ?>">
  <?php foreach ($hidden as $name => $v): ?>
    <input type="hidden" name="<?= e($name) ?>" value="<?= e($v) ?>">
  <?php endforeach; ?>
  <div class="panel">
    <h3>Отправленное</h3>
    <details<?= count($shown) <= 30 ? ' open' : '' ?>>
      <summary class="muted">Заполненные поля — <?= count($shown) ?></summary>
      <?php $i = 0; foreach ($shown as $name => $v): $i++;
        $rows = min(14, max(2, substr_count($v, "\n") + 1 + intdiv(mb_strlen($v), 90))); ?>
        <label for="rs<?= $i ?>" class="mono"><?= e($name) ?></label>
        <?php /* Перевод строки сразу после тега: первый браузер съедает,
                 и текст, начинающийся с пустой строки, не теряет её. */ ?>
        <textarea id="rs<?= $i ?>" name="<?= e($name) ?>" rows="<?= $rows ?>" readonly>
<?= e($v) ?></textarea>
      <?php endforeach; ?>
    </details>
    <div class="btnrow">
      <button class="btn" type="submit">Отправить ещё раз</button>
      <a class="btn ghost" href="<?= e(admin_url($r['section'], $q + ['resume' => 'drop'])) ?>">Открыть раздел без этих правок</a>
    </div>
  </div>
</form>
    <?php
    admin_foot();
}
