<?php
/* Панель управления: основа.

   ВХОД ОДИН. Все страницы панели открываются через public/admin/index.php
   с параметром section. Поэтому проверка входа, разовый ключ формы и
   заголовки стоят в одном месте, и ни один раздел нельзя открыть в обход:
   файлов разделов в корне сайта просто нет, они лежат здесь, выше корня.

   ПЕРВЫЙ ВХОД. Пароля в репозитории нет и быть не может. Пока нет файла
   с учётной записью, панель показывает страницу начальной настройки, но
   просит код из файла ~/site-data/setup-code.txt. Этот файл виден только
   через cPanel File Manager или SSH, то есть тому, у кого уже есть доступ
   к серверу. Так между выкладкой и первым входом нет окна, в которое
   учётную запись мог бы занять случайный посетитель. */

require_once __DIR__ . '/../i18n.php';
require_once __DIR__ . '/../content.php';
require_once __DIR__ . '/../security.php';
require_once __DIR__ . '/../turnstile.php';

const ADMIN_SESSION_IDLE  = 7200;    // 2 часа без действий
const ADMIN_SESSION_MAX   = 43200;   // 12 часов всего
const ADMIN_LOGIN_LIMIT   = 5;       // попыток
const ADMIN_LOGIN_WINDOW  = 900;     // в течение 15 минут
const ADMIN_LOGIN_LOCK    = 900;     // потом закрыто на 15 минут
const ADMIN_PW_MIN        = 12;      // знаков в пароле

/* ------------------------------------------------------------------ сессия */

function admin_boot(): void
{
    $cfg = require __DIR__ . '/../config.php';
    I18n::boot($cfg);

    /* Папка сессий — в хранилище, вне корня сайта. По умолчанию PHP кладёт
       их в общий временный каталог, где на виртуальном хостинге их видят
       соседние аккаунты. */
    $sdir = Store::dir() . '/sessions';
    if (!is_dir($sdir)) @mkdir($sdir, 0770, true);
    if (is_dir($sdir) && is_writable($sdir)) session_save_path($sdir);

    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https'
        || ($_SERVER['HTTP_CF_VISITOR'] ?? '') !== '' && strpos($_SERVER['HTTP_CF_VISITOR'], 'https') !== false;

    ini_set('session.use_strict_mode', '1');   // не принимать чужой номер сессии
    ini_set('session.use_only_cookies', '1');
    ini_set('session.gc_maxlifetime', (string)ADMIN_SESSION_MAX);
    session_name('mgadmin');
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/admin/',               // cookie не уходит на страницы сайта
        'secure'   => $https,
        'httponly' => true,                    // недоступна скриптам
        'samesite' => 'Lax',                   // не уходит при запросе с чужого сайта
    ]);
    session_start();
    attempts_sweep_due();

    /* Срок жизни сессии: и по бездействию, и общий. Вкладка, забытая
       открытой на чужом ноутбуке, перестаёт быть входом в панель. */
    $now = time();
    if (!empty($_SESSION['uid'])) {
        $idle = $now - (int)($_SESSION['seen'] ?? 0);
        $age  = $now - (int)($_SESSION['born'] ?? 0);
        if ($idle > ADMIN_SESSION_IDLE || $age > ADMIN_SESSION_MAX) {
            admin_logout();
            admin_flash('Сессия истекла. Войдите заново.', 'warn');
        }
    }
    $_SESSION['seen'] = $now;

    header('X-Frame-Options: DENY');
    header('X-Content-Type-Options: nosniff');
    header('Referrer-Policy: no-referrer');
    header('Cache-Control: no-store, no-cache, must-revalidate, private');
    /* Политика та же, что у сайта, из одной константы: её значение всё
       равно перебивает public/.htaccess, а разойдясь, две политики дали бы
       пересечение — то есть сломали бы то, что разрешено одной из них.
       Здесь заголовок нужен страховкой на случай, когда .htaccess не читается. */
    header('Content-Security-Policy: ' . CSP_POLICY);
}

/* ------------------------------------------------------- учётная запись */

function admin_auth(): ?array
{
    $d = Store::read('auth.json');
    return (is_array($d) && !empty($d['hash']) && !empty($d['email'])) ? $d : null;
}

function admin_user(): ?array
{
    if (empty($_SESSION['uid'])) return null;
    $a = admin_auth();
    /* Привязка к записи, а не к одному полю: сменили почту — сессия
       недействительна, потому что uid считается из текущего хэша. */
    return ($a && hash_equals(admin_uid($a), (string)$_SESSION['uid'])) ? $a : null;
}

function admin_uid(array $auth): string
{
    return substr(hash('sha256', $auth['email'] . '|' . $auth['hash']), 0, 32);
}

function admin_login(array $auth): void
{
    session_regenerate_id(true);               // прежний номер сессии больше не годен
    $_SESSION['uid']  = admin_uid($auth);
    $_SESSION['born'] = time();
    $_SESSION['seen'] = time();
    $_SESSION['lang'] = I18n::$cfg['default_lang'] ?? 'ru';
    unset($_SESSION['csrf']);                  // новый ключ для новой сессии
    csrf_token();
}

function admin_logout(): void
{
    $flash = $_SESSION['flash'] ?? null;
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', [
            'expires'  => time() - 42000,
            'path'     => $p['path'],
            'secure'   => $p['secure'],
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }
    session_regenerate_id(true);
    if ($flash) $_SESSION['flash'] = $flash;
}

/* --------------------------------------------------- начальная настройка */

/** Код для первого входа. Лежит в файле, который видно только с сервера. */
function admin_setup_code(): string
{
    $p = Store::dir() . '/setup-code.txt';
    if (is_file($p)) {
        $raw = (string)file_get_contents($p);
        if (preg_match('/\b([A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4})\b/', $raw, $m)) {
            return $m[1];
        }
    }

    /* Файла нет или он испорчен — создаём новый код. */
    $abc = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';   // без похожих знаков: 0/O, 1/I
    $parts = [];
    for ($i = 0; $i < 3; $i++) {
        $s = '';
        for ($j = 0; $j < 4; $j++) $s .= $abc[random_int(0, strlen($abc) - 1)];
        $parts[] = $s;
    }
    $code = implode('-', $parts);

    if (!is_dir(Store::dir())) @mkdir(Store::dir(), 0770, true);
    @file_put_contents($p, "Код для первого входа в панель управления сайтом.\n\n"
        . "    " . $code . "\n\n"
        . "Откройте https://" . ($_SERVER['HTTP_HOST'] ?? 'mguliyev.com') . "/admin/\n"
        . "и введите этот код вместе с почтой и паролем, которые хотите задать.\n\n"
        . "После создания учётной записи файл можно удалить — он больше не нужен.\n"
        . "Если файл удалить до первого входа, панель создаст новый код.\n");
    @chmod($p, 0640);
    return $code;
}

function admin_setup_done(): void
{
    @unlink(Store::dir() . '/setup-code.txt');
}

/* ------------------------------------------------------------- сообщения */

function admin_flash(string $text, string $kind = 'ok'): void
{
    $_SESSION['flash'] = ['text' => $text, 'kind' => $kind];
}

/** Черновик формы: то, что человек вписал, когда сохранение не удалось.

    Без него любая ошибка — устаревшая вкладка, пустое обязательное поле,
    занятый адрес — уводила на страницу, заново собранную из хранилища,
    и всё вписанное пропадало. Предупреждение о несохранённых правках при
    этом молчит: оно снимается в момент отправки формы.

    Ключ — экран, на который вернётся человек (раздел и запись, язык).
    Черновик живёт до первой отрисовки этого экрана. Держим не больше
    пяти: брошенные черновики не должны копиться в сессии. */
function admin_draft_keep(string $key, array $data): void
{
    $all = (array)($_SESSION['drafts'] ?? []);
    unset($all[$key]);
    $all[$key] = $data;
    $_SESSION['drafts'] = array_slice($all, -5, null, true);
}

/** Забрать черновик экрана (один раз). Нет — null. */
function admin_draft_take(string $key): ?array
{
    $d = $_SESSION['drafts'][$key] ?? null;
    unset($_SESSION['drafts'][$key]);
    return is_array($d) ? $d : null;
}

function admin_take_flash(): ?array
{
    $f = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return is_array($f) ? $f : null;
}

/* --------------------------------------------------------------- адреса */

/** Адрес раздела панели. */
function admin_url(string $section = 'dashboard', array $q = []): string
{
    $q = ['section' => $section] + $q;
    return '/admin/index.php?' . http_build_query($q);
}

/** Уйти на другой адрес и прекратить работу. 303 — чтобы повторное
    нажатие «обновить» не отправляло форму заново. */
function admin_go(string $url): void
{
    header('Location: ' . $url, true, 303);
    exit;
}

/** Язык, в котором редактор сейчас правит тексты. */
function admin_lang(): string
{
    $l = $_SESSION['lang'] ?? null;
    return in_array($l, langs(), true) ? $l : deflang();
}

function admin_set_lang(string $l): void
{
    if (in_array($l, langs(), true)) $_SESSION['lang'] = $l;
}

/* ----------------------------------------------------------- проверка POST */

/** Любой POST обязан прийти со своей страницы и со своим ключом.
    Иначе — отказ: это или чужая форма, или устаревшая вкладка. */
function admin_check_post(): void
{
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') return;

    if (!origin_ok(I18n::$cfg['site_url'] ?? '')) {
        http_response_code(403);
        exit('Запрос пришёл с другого адреса.');
    }
    if (!csrf_ok($_POST['_csrf'] ?? null)) {
        http_response_code(403);
        exit('Ключ формы не совпал. Откройте страницу заново и повторите.');
    }
}

/** Проверка, что хранилище доступно на запись: иначе панель молча
    не сохраняла бы правки, а это худшее поведение для редактора. */
function admin_store_problem(): ?string
{
    if (Store::dir() === '') return 'Не задан путь к хранилищу (data_dir в app/config.php).';
    if (!Store::writable()) return 'Папка ' . Store::dir() . ' недоступна на запись. Правки сохраняться не будут.';
    return null;
}

/* ------------------------------------------------- разбор форм разделов */

/** Набор значений по языкам из поля формы вида name[ru], name[az], name[en].
    Всё, что пришло, чистится одинаково: панель — это ввод от человека,
    и доверять ему нельзя ни в одном поле. */
function post_langs($src, bool $multiline = false): array
{
    $src = is_array($src) ? $src : [];
    $out = [];
    foreach (langs() as $l) {
        $out[$l] = clean_text(is_string($src[$l] ?? null) ? $src[$l] : '', $multiline);
    }
    return $out;
}

/** Одиночное поле. */
function post_one($v, bool $multiline = false): string
{
    return clean_text(is_string($v) ? $v : '', $multiline);
}

/** Адрес картинки: только путь внутри сайта и только из разрешённых папок.
    Иначе в карточку проекта можно вписать картинку с чужого сервера —
    это и утечка адресов посетителей, и чужой контроль над тем, что видно. */
function post_image($v): ?string
{
    $v = post_one($v);
    if ($v === '') return null;

    /* Полный адрес своего же сайта — частая вставка из браузера:
       https://mguliyev.com/images/… превращаем в /images/…. Чужой
       адрес не принимаем: картинка должна лежать на этом сайте. */
    $host = (string)parse_url((string)(I18n::$cfg['site_url'] ?? ''), PHP_URL_HOST);
    if ($host !== '' && preg_match('~^https?://(?:www\.)?' . preg_quote(preg_replace('~^www\.~', '', $host), '~') . '(/.*)$~i', $v, $m)) {
        $v = $m[1];
    }

    $v = '/' . ltrim(str_replace("\\", '/', $v), '/');
    if (strpos($v, '..') !== false) return null;
    /* gif — потому что раздел «Изображения» его принимает и выдаёт путь. */
    return preg_match('~^/images/[A-Za-z0-9._/-]+\.(jpe?g|png|webp|gif|svg|avif)$~i', $v) ? $v : null;
}

/** Ключ записи: латиница, цифры, дефис. Используется в адресах и в JSON,
    поэтому всё остальное отбрасываем, а не пытаемся угадать. */
function post_slug($v, string $fallback = ''): string
{
    $v = mb_strtolower(post_one($v));
    $v = preg_replace('~[^a-z0-9-]+~u', '-', $v) ?? '';
    $v = trim(preg_replace('~-{2,}~', '-', $v) ?? '', '-');
    return $v !== '' ? $v : $fallback;
}

/** Домен проекта: без схемы, без слэша, строчными. */
function post_domain($v): string
{
    $v = mb_strtolower(post_one($v));
    $v = preg_replace('~^https?://~', '', $v) ?? $v;
    $v = rtrim(explode('/', $v)[0], '.');
    /* Настоящий домен: метки через точку и зона из букв (или xn-- для
       кириллических). Без точки проходили опечатки вроде «itasaz», и на
       сайте появлялась ссылка https://itasaz — а домен «new» вдобавок
       совпадал со служебным адресом формы нового проекта. */
    return preg_match('~^(?=.{3,80}$)(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[a-z]{2,}|xn--[a-z0-9-]+)$~', $v) ? $v : '';
}

/** Отметка о правке: что и когда правили, и кто.

    Нужна списку страниц: без неё колонка «правилось» показывала бы
    прочерк всегда, и непонятно, трогали страницу вообще или нет.
    Пишем только факт правки — ни что именно изменилось, ни прежних
    значений: это уже журнал версий, а для него нужен другой механизм. */
function admin_note_edit(string $what): void
{
    $d = Store::read('edits.json') ?? [];
    $u = admin_user();
    $d[$what] = ['at' => time(), 'by' => (string)($u['email'] ?? '')];

    /* Записей не больше трёхсот: файл читается при каждой отрисовке
       списка, и расти ему незачем. */
    if (count($d) > 300) {
        uasort($d, static fn($a, $b) => (int)$b['at'] <=> (int)$a['at']);
        $d = array_slice($d, 0, 300, true);
    }
    Store::write('edits.json', $d);
    Store::forget('edits.json');
}

/** Не обрезал ли PHP форму на подходе.

    У PHP есть предел max_input_vars (обычно 1000). Полей больше — лишние
    МОЛЧА отбрасываются, без ошибки и без предупреждения. Для редактора это
    выглядит так: поправил строку внизу длинной формы, нажал сохранить,
    получил «Сохранено» — и правки нет. Второй раз человек уже не поверит
    панели ни в чём.

    Поэтому форма объявляет, сколько полей отправляет, скрытым полем
    В САМОМ НАЧАЛЕ: отбрасываются последние, значит объявление доедет
    всегда. Сравниваем с тем, что пришло.

    Сейчас самая большая форма — страница «Главная», 489 полей, запас
    двукратный. Проверка нужна на вырост: строк со временем станет больше,
    и узнать об этом надо от панели, а не от заказчика. */
function admin_form_truncated(int $got): ?string
{
    $want = (int)($_POST['_fields'] ?? 0);
    if ($want <= 0 || $got >= $want) return null;

    $limit = (int)ini_get('max_input_vars');
    return 'Форма пришла не целиком: отправлено ' . $want . ' полей, принято ' . $got
         . '. Сервер обрезает формы длиннее ' . ($limit ?: 1000) . ' полей. '
         . 'Часть правок НЕ СОХРАНЕНА. Правьте по частям — или попросите '
         . 'разработчика поднять max_input_vars в настройках PHP.';
}

/** Сколько полей реально пришло в наборе вида name[ключ][язык]. */
function admin_count_fields($in): int
{
    if (!is_array($in)) return 0;
    $n = 0;
    foreach ($in as $v) {
        $n += is_array($v) ? count($v) : 1;
    }
    return $n;
}

/** Не устарела ли форма: правил ли кто-то этот файл, пока она была открыта.

    Сценарий, от которого защищает: вкладку открыли утром, днём правили
    из другой вкладки или с телефона, вечером нажали «Сохранить» в первой —
    и она вернула всё к утреннему состоянию. Оба раза панель сказала бы
    «Сохранено», и дневная работа пропала бы молча.

    У сайта с одним редактором это редкость, но цена срабатывания — одно
    нажатие «обновить», а цена отказа — потерянный день. */
function admin_stale(string $rel): bool
{
    $was = (string)($_POST['_ver'] ?? '');
    return $was !== '' && $was !== Store::stamp($rel);
}

/** Скрытое поле с меткой версии — ставится в форму рядом с ключом. */
function admin_ver_field(string $rel): string
{
    return '<input type="hidden" name="_ver" value="'
         . htmlspecialchars(Store::stamp($rel), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '">';
}
