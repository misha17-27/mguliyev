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

/** Ключ отложенной формы — экран, куда она шла: раздел, запись, язык. */
function admin_resume_key(string $section, array $q, string $lang): string
{
    unset($q['resume']);
    return $section . '?' . http_build_query($q) . '|' . $lang;
}

/** Отложенные формы, ещё не разобранные: ключ => {section, q, lang, post, secret}. */
function admin_resume_all(): array
{
    $out = [];
    foreach ((array)($_SESSION['resume'] ?? []) as $k => $r) {
        if (is_array($r) && is_string($r['section'] ?? null) && is_array($r['post'] ?? null)) $out[$k] = $r;
    }
    return $out;
}

/** Отложить форму до входа. У каждого экрана своя ячейка: две вкладки,
    отправленные в истёкшую сессию одна за другой, делили одну, и вторая
    молча стирала первую — хотя обеим обещали, что вписанное не пропало.
    Не больше пяти, как черновики. Вернёт название раздела, чью форму
    пришлось вытеснить, или ''. */
function admin_resume_keep(array $r): string
{
    $all = admin_resume_all();
    $key = admin_resume_key($r['section'], $r['q'], $r['lang']);
    unset($all[$key]);
    $all[$key] = $r;
    $lost = '';
    if (count($all) > 5) {
        $old  = reset($all);
        $lost = admin_sections()[$old['section']][0] ?? $old['section'];
    }
    $_SESSION['resume'] = array_slice($all, -5, null, true);
    return $lost;
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
        $typed = false;
        /* Учётную запись не откладываем вовсе: кроме паролей в ней только
           почта, а без текущего пароля её форма всё равно не пройдёт. */
        if ($section !== 'account') {
            foreach (admin_flat_fields($post) as $name => $v) {
                if (admin_service_field($name)) continue;
                if (trim($v) !== '') { $typed = true; break; }
            }
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
            /* Первый экран после входа — этот раздел. */
            $_SESSION['resume_land'] = ['section' => $section, 'q' => $q, 'lang' => admin_lang()];
            $lost = $typed ? admin_resume_keep([
                'section' => $section,
                'q'       => $q,
                'lang'    => admin_lang(),
                'post'    => $post,
                'secret'  => $secret,
            ]) : '';
            admin_flash('Сессия истекла, и правки не сохранились. '
                . ($typed
                    ? 'Но вписанное не пропало: войдите заново — панель откроет тот же раздел '
                      . 'и покажет отправленное, его останется проверить и отправить ещё раз.'
                    : 'Войдите заново — панель откроет тот же раздел.')
                . ($secret ? ' Пароли и секретные ключи в сессии не храним — их придётся вписать заново.' : '')
                . ($hadFile ? ' Файл придётся выбрать заново: файлы в сессии не хранятся.' : '')
                . ($lost !== '' ? ' Самая давняя из отложенных форм (раздел «' . $lost . '») вытеснена: '
                                  . 'больше пяти панель не держит.' : ''), 'warn');
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
   Отправка формы на тот же экран — значит, решение принято. */
$land = $_SESSION['resume_land'] ?? null;
if (is_array($land) && !$isPost) {
    unset($_SESSION['resume_land']);
    if (in_array($land['section'] ?? '', $known, true)) {
        admin_set_lang((string)($land['lang'] ?? ''));
        admin_go(admin_url($land['section'], (array)($land['q'] ?? [])));
    }
}
if ($pending = admin_resume_all()) {
    $key = admin_resume_key($section, $q, admin_lang());
    if ($isPost) {
        unset($_SESSION['resume'][$key]);
    } elseif (($q['resume'] ?? '') === 'drop') {
        unset($_SESSION['resume'][$key], $q['resume']);
        admin_go(admin_url($section, $q));
    } else {
        /* Свой экран, а если открыт раздел без записи — последняя
           отложенная форма этого раздела на текущем языке. На другом
           языке её не показываем: отправка ушла бы не в тот язык. */
        $mine = $pending[$key] ?? null;
        if (!$mine) {
            foreach (array_reverse($pending) as $r) {
                if ($r['section'] === $section && ($r['lang'] ?? '') === admin_lang()) { $mine = $r; break; }
            }
        }
        if ($mine) {
            admin_resume_page($mine, $pending);
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
function admin_resume_page(array $r, array $pending): void
{
    $shown = $hidden = [];
    foreach (admin_flat_fields((array)$r['post']) as $name => $v) {
        if (!admin_service_field($name) && trim($v) !== '') $shown[$name] = $v; else $hidden[$name] = $v;
    }
    $q = (array)$r['q'];
    unset($q['resume']);
    /* Прочие отложенные формы — ссылками: после входа панель ведёт только
       на последнюю, и про остальные иначе не узнать. */
    $others = [];
    $titles = admin_sections();
    foreach ($pending as $k => $o) {
        if ($k === admin_resume_key($r['section'], $q, (string)($r['lang'] ?? ''))) continue;
        $others[] = [
            'href'  => admin_url($o['section'], (array)$o['q'] + ['lang' => (string)($o['lang'] ?? '')]),
            'label' => '«' . ($titles[$o['section']][0] ?? $o['section']) . '»'
                     . ($o['q'] ? ' — ' . implode(', ', array_map('strval', (array)$o['q'])) : '')
                     . ' (' . strtoupper((string)($o['lang'] ?? '')) . ')',
        ];
    }

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
    <?php /* Вписанные пароли и ключи в сессии не хранились — спрашиваем здесь.
             Пустое поле в почте и капче значит «оставить прежний». */
    foreach ((array)($r['secret'] ?? []) as $j => $name): if (!is_string($name)) continue; ?>
      <label for="rp<?= (int)$j ?>"><span class="mono"><?= e($name) ?></span>
        <span class="hint">впишите заново: пароли и секретные ключи в сессии не храним; пусто — останется прежний</span></label>
      <input type="password" id="rp<?= (int)$j ?>" name="<?= e($name) ?>" class="mono" autocomplete="new-password">
    <?php endforeach; ?>
    <div class="btnrow">
      <button class="btn" type="submit">Отправить ещё раз</button>
      <a class="btn ghost" href="<?= e(admin_url($r['section'], $q + ['resume' => 'drop'])) ?>">Открыть раздел без этих правок</a>
    </div>
    <?php if ($others): ?>
      <p class="muted">Отложены и другие формы:
        <?php foreach ($others as $k => $o): ?><?= $k ? ', ' : '' ?><a href="<?= e($o['href']) ?>"><?= e($o['label']) ?></a><?php endforeach; ?>.</p>
    <?php endif; ?>
  </div>
</form>
    <?php
    admin_foot();
}
