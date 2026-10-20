<?php
/* Общие функции безопасности: адрес посетителя, разовые ключи форм,
   ограничение числа попыток. Нужны и панели управления, и форме заявки,
   поэтому лежат отдельно, а не внутри одной из них. */

require_once __DIR__ . '/store.php';

/* Политика безопасности содержимого — одна на сайт и на панель.

   ПОЧЕМУ ЗДЕСЬ, А НЕ ТОЛЬКО В .htaccess. Заголовок из PHP до браузера
   не доезжает: Header always set из public/.htaccess перебивает его.
   Под FPM — заменой в той же таблице заголовков, под mod_php — тем, что
   браузер получает две политики и применяет их пересечение. Поэтому
   ослабить политику из PHP невозможно в принципе, и правка обязана быть
   в .htaccess. Значение здесь нужно для двух других вещей: оно идёт
   страховкой, когда .htaccess не читается вовсе (сменили корень сайта,
   поставили nginx), и его показывает раздел «Безопасность», сверяя с тем,
   что реально пришло в заголовке.

   ЗНАЧЕНИЕ ОБЯЗАНО СОВПАДАТЬ СО СТРОКОЙ В public/.htaccess ДОСЛОВНО.
   Если они разойдутся, браузер под mod_php получит две разные политики
   и применит самую строгую из них — то есть сломается то, что по одной
   из строк разрешено. Раздел «Безопасность» в панели это показывает.

   Хосты challenges.cloudflare.com нужны капче Turnstile: script-src для
   api.js, frame-src для окна проверки (без неё цепочка frame-src →
   child-src → default-src 'self' запрещает чужой iframe), connect-src
   страховкой. 'unsafe-inline' для скриптов НЕ нужен: виджет ставится
   неявной отрисовкой, без единого встроенного скрипта. Хосты стоят
   в политике всегда, даже когда капча выключена: .htaccess не умеет
   читать настройки из хранилища, а разрешённый, но не используемый
   источник сам по себе ничего не открывает. */
const CSP_POLICY = "default-src 'self'; script-src 'self' https://challenges.cloudflare.com; frame-src https://challenges.cloudflare.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data:; media-src 'self'; connect-src 'self' https://challenges.cloudflare.com; form-action 'self'; frame-ancestors 'none'; base-uri 'self'; object-src 'none'";

/* Сети Cloudflare. Взяты с https://www.cloudflare.com/ips-v4 и ips-v6
   20.10.2026. Меняются редко, несколько раз в год; если Cloudflare добавит
   сеть, а здесь её не будет, ограничение попыток начнёт считать всех
   посетителей за одного — не дыра, но повод обновить список. */
const CF_NETS_V4 = [
    '173.245.48.0/20',  '103.21.244.0/22', '103.22.200.0/22', '103.31.4.0/22',
    '141.101.64.0/18',  '108.162.192.0/18', '190.93.240.0/20', '188.114.96.0/20',
    '197.234.240.0/22', '198.41.128.0/17', '162.158.0.0/15',  '104.16.0.0/13',
    '104.24.0.0/14',    '172.64.0.0/13',   '131.0.72.0/22',
];
const CF_NETS_V6 = [
    '2400:cb00::/32', '2606:4700::/32', '2803:f800::/32', '2405:b500::/32',
    '2405:8100::/32', '2a06:98c0::/29', '2c0f:f248::/32',
];

/** Входит ли адрес в сеть вида 10.0.0.0/8. Работает и для IPv6:
    сравниваем двоичные представления по первым N битам. */
function ip_in_net(string $ip, string $cidr): bool
{
    [$net, $bits] = array_pad(explode('/', $cidr, 2), 2, null);
    $bits = (int)$bits;

    $a = @inet_pton($ip);
    $b = @inet_pton($net);
    if ($a === false || $b === false || strlen($a) !== strlen($b)) return false;

    $whole = intdiv($bits, 8);
    $rest  = $bits % 8;

    if ($whole > 0 && strncmp($a, $b, $whole) !== 0) return false;
    if ($rest === 0) return true;
    if (!isset($a[$whole], $b[$whole])) return false;

    $mask = chr(0xFF << (8 - $rest) & 0xFF);
    return (($a[$whole] & $mask) === ($b[$whole] & $mask));
}

/** Пришёл ли запрос от самого Cloudflare. */
function from_cloudflare(): bool
{
    $ra = $_SERVER['REMOTE_ADDR'] ?? '';
    if (!filter_var($ra, FILTER_VALIDATE_IP)) return false;

    $nets = strpos($ra, ':') !== false ? CF_NETS_V6 : CF_NETS_V4;
    foreach ($nets as $n) {
        if (ip_in_net($ra, $n)) return true;
    }
    return false;
}

/** Адрес посетителя.

    Сайт стоит за Cloudflare, поэтому REMOTE_ADDR — это адрес Cloudflare,
    один и тот же для всех. Ограничение числа попыток по нему либо
    не работает вовсе, либо блокирует всех сразу. Настоящий адрес
    Cloudflare кладёт в CF-Connecting-IP.

    НО ДОВЕРЯТЬ ЭТОМУ ЗАГОЛОВКУ МОЖНО НЕ ВСЕГДА. Обратившись к серверу
    напрямую, минуя Cloudflare, его можно поставить любым — и присылать
    в каждом запросе новый. Тогда счётчик попыток входа не сработает
    никогда: каждая попытка выглядит как первая с нового адреса.
    Раньше именно так и было.

    Поэтому заголовок принимается, только если сам запрос пришёл из сети
    Cloudflare. Пришёл откуда-то ещё — берём REMOTE_ADDR, который
    подделать нельзя: это адрес на другом конце соединения. */
function client_ip(): string
{
    $cf = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? '';
    if ($cf !== '' && filter_var($cf, FILTER_VALIDATE_IP) && from_cloudflare()) {
        return $cf;
    }

    $ra = $_SERVER['REMOTE_ADDR'] ?? '';
    return filter_var($ra, FILTER_VALIDATE_IP) ? $ra : '0.0.0.0';
}

/** Ключ для файла счётчика: адрес в имени файла использовать нельзя. */
function ip_key(string $salt = ''): string
{
    $ip = client_ip();

    /* IPv6 считаем по сети /64, а не по адресу целиком.

       Абоненту обычно выдают всю сеть /64 — это 2^64 адресов, и сменить
       адрес внутри неё можно в каждом запросе. Счётчик по полному адресу
       видел бы каждую попытку пароля как первую с нового адреса и не
       срабатывал бы никогда. Сеть /64 — это и есть «один абонент». */
    if (strpos($ip, ':') !== false) {
        $bin = @inet_pton($ip);
        if ($bin !== false && strlen($bin) === 16) {
            $ip = bin2hex(substr($bin, 0, 8)) . '::/64';
        }
    }
    return substr(hash('sha256', $ip . '|' . $salt), 0, 32);
}

/* --------------------------------------------------------------------
   Ограничение числа попыток.

   Счётчик — файл в хранилище. База не нужна, а файловая метка переживает
   перезапуск PHP, в отличие от счётчика в памяти процесса.
   -------------------------------------------------------------------- */

/** Сколько попыток уже сделано и когда снимется запрет.
    Возвращает ['tries' => int, 'until' => int]; until в прошлом — запрета нет. */
function attempts_get(string $bucket, string $key): array
{
    $d = Store::read('locks/' . $bucket . '-' . $key . '.json');
    return [
        'tries' => (int)($d['tries'] ?? 0),
        'until' => (int)($d['until'] ?? 0),
    ];
}

/** Записать неудачную попытку. После $limit попыток в окне $window
    закрываем на $lock секунд. */
function attempts_fail(string $bucket, string $key, int $limit, int $window, int $lock): int
{
    attempts_sweep_due();
    $rel = 'locks/' . $bucket . '-' . $key . '.json';
    $d = Store::read($rel) ?? [];
    $now = time();

    /* Окно истекло — считаем заново, иначе одна ошибка месяц назад
       складывалась бы с ошибкой сегодня. */
    $first = (int)($d['first'] ?? 0);
    if ($first === 0 || $now - $first > $window) {
        $first = $now;
        $tries = 0;
    } else {
        $tries = (int)($d['tries'] ?? 0);
    }
    $tries++;

    Store::write($rel, [
        'first' => $first,
        'tries' => $tries,
        'until' => $tries >= $limit ? $now + $lock : 0,
        'last'  => $now,
    ]);
    return $tries;
}

/** Снять счётчик: вызывается после успеха. */
function attempts_clear(string $bucket, string $key): void
{
    $rel = 'locks/' . $bucket . '-' . $key . '.json';
    @unlink(Store::path($rel));
    Store::forget($rel);
}

/** Подмести старые счётчики, если с прошлого раза прошло десять минут.

    Раньше подметание запускалось случайно, раз в 20–50 запросов. Под
    перебором файлы появлялись быстрее, чем исчезали: один запрос с нового
    адреса — один файл, и папка съедала место и лимит файлов на хостинге.

    Теперь подметание по времени, а не по случаю: не чаще раза в десять
    минут, но обязательно. Значит в папке никогда не бывает больше, чем
    набежало за десять минут плюс срок жизни счётчиков. */
function attempts_sweep_due(): void
{
    $mark = Store::dir() . '/locks/swept.txt';
    $last = is_file($mark) ? (int)@filemtime($mark) : 0;
    if (time() - $last < 600) return;

    if (!is_dir(dirname($mark))) @mkdir(dirname($mark), 0770, true);
    @touch($mark);

    /* Сроки подобраны по самому долгому окну каждого счётчика:
       что старше, то уже ничего не ограничивает. */
    attempts_sweep('login',    3600);
    attempts_sweep('setup',    3600);
    attempts_sweep('account',  3600);
    attempts_sweep('mailtest', 3600);
    attempts_sweep('cap',      1800);
    attempts_sweep('lead',      600);

    /* Сессии панели. Каждый заход на /admin/ без входа создаёт файл
       сессии — для ключа формы на странице входа он нужен. Встроенная
       уборка PHP на многих хостингах выключена (gc_probability = 0),
       и без этих строк папка росла бы от каждого бота, заглянувшего
       по адресу /admin/. Срок — общий срок жизни сессии, 12 часов. */
    $sd = Store::dir() . '/sessions';
    if (is_dir($sd)) {
        $now = time();
        foreach (glob($sd . '/sess_*') ?: [] as $f) {
            if ($now - (int)@filemtime($f) > 43200) @unlink($f);
        }
    }
}

/** Удалить просроченные счётчики. Вызывается изредка, чтобы папка
    не росла бесконечно от перебора по разным адресам. */
function attempts_sweep(string $bucket, int $olderThan = 86400): void
{
    $dir = Store::dir() . '/locks';
    if (!is_dir($dir)) return;
    $now = time();
    foreach (glob($dir . '/' . $bucket . '-*.json') ?: [] as $f) {
        if ($now - (int)@filemtime($f) > $olderThan) @unlink($f);
    }
}

/* --------------------------------------------------------------------
   Разовый ключ формы (CSRF).

   Без него чужая страница может отправить форму от имени вошедшего
   редактора: браузер приложит к запросу его cookie сессии.
   -------------------------------------------------------------------- */

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

/** Сравнение постоянное по времени: обычное == отвечает тем быстрее,
    чем раньше расходятся строки, и по времени ответа ключ подбирается. */
function csrf_ok($given): bool
{
    /* Тип не объявляем: поле можно прислать массивом (_csrf[]=x), и
       объявленный ?string ронял бы любую страницу панели с ошибкой 500
       раньше, чем дело дойдёт до проверки. */
    return is_string($given) && !empty($_SESSION['csrf'])
        && hash_equals($_SESSION['csrf'], $given);
}

/** Проверка источника запроса вторым рубежом: браузер присылает Origin
    при любом POST с другой страницы. Заголовок из браузера не подделать.

    Сверяем с адресом, по которому пришёл сам запрос, а не с адресом из
    настроек. Иначе проверка ломается всюду, где эти адреса расходятся:
    при заходе через www, на локальном сервере, на тестовом поддомене.
    Адрес из настроек принимается дополнительно — на случай, когда перед
    сайтом стоит прокси и Host подменён. */
function origin_ok(string $siteUrl = ''): bool
{
    $o = $_SERVER['HTTP_ORIGIN'] ?? '';

    /* Заголовка нет вовсе — старый браузер или запрос не из браузера.
       Значение «null» — страница с непрозрачным источником: песочница
       внутри iframe, открытый локальный файл, переход через редирект.

       В обоих случаях полагаемся на разовый ключ формы. Он и есть основная
       защита: чужая страница не может его прочитать, ей мешает тот же
       запрет междоменного чтения. Проверка Origin — второй рубеж, и
       отказывать из-за её отсутствия значит ломать работу в нормальных
       браузерах, ничего не выигрывая: подделать ключ это всё равно
       не помогает. Так же советует и OWASP. */
    if ($o === '' || $o === 'null') return true;

    $host = parse_url($o, PHP_URL_HOST);
    if (!is_string($host) || $host === '') return false;

    $ok = [];
    $self = (string)($_SERVER['HTTP_HOST'] ?? '');
    if ($self !== '') {
        /* У Host бывает порт, у Origin его parse_url уже отрезал. */
        $ok[] = preg_replace('/:\d+$/', '', $self);
    }
    if ($siteUrl !== '') {
        $h = parse_url($siteUrl, PHP_URL_HOST);
        if (is_string($h) && $h !== '') {
            $ok[] = $h;
            $ok[] = strpos($h, 'www.') === 0 ? substr($h, 4) : 'www.' . $h;
        }
    }
    foreach ($ok as $h) {
        if ($h !== '' && strcasecmp($host, (string)$h) === 0) return true;
    }
    return false;
}

/** Текст от человека: убрать управляющие символы, нормализовать переводы
    строк, проверить кодировку. Битый UTF-8 ломает и JSON, и экранирование. */
function clean_text(?string $s, bool $multiline = false): string
{
    $s = (string)$s;
    if (!mb_check_encoding($s, 'UTF-8')) {
        $s = mb_convert_encoding($s, 'UTF-8', 'UTF-8');
    }
    $s = str_replace(["\r\n", "\r"], "\n", $s);
    /* Убираем всё управляющее, кроме перевода строки и табуляции. */
    $s = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $s) ?? '';
    if (!$multiline) $s = str_replace("\n", ' ', $s);
    /* Невидимые символы, которыми прячут текст в редакторе. */
    $s = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}\x{2060}]/u', '', $s) ?? '';
    return trim($s);
}
