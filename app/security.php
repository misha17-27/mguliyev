<?php
/* Общие функции безопасности: адрес посетителя, разовые ключи форм,
   ограничение числа попыток. Нужны и панели управления, и форме заявки,
   поэтому лежат отдельно, а не внутри одной из них. */

require_once __DIR__ . '/store.php';

/** Адрес посетителя.

    Сайт стоит за Cloudflare, поэтому REMOTE_ADDR — это всегда адрес
    Cloudflare, один и тот же для всех. Ограничение числа попыток по нему
    либо не работает вовсе, либо блокирует всех сразу. Настоящий адрес
    Cloudflare кладёт в CF-Connecting-IP.

    ОГОВОРКА. Заголовок можно подделать, если обратиться к серверу напрямую,
    минуя Cloudflare. Полностью это закрывается только на стороне сервера:
    либо список адресов Cloudflare в правилах доступа, либо Authenticated
    Origin Pulls. До этого худшее, что даёт подделка, — обход собственного
    ограничения попыток; подняться в правах или подменить чужую сессию
    через этот заголовок нельзя, он нигде больше не используется. */
function client_ip(): string
{
    $cf = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? '';
    if ($cf !== '' && filter_var($cf, FILTER_VALIDATE_IP)) return $cf;

    $ra = $_SERVER['REMOTE_ADDR'] ?? '';
    return filter_var($ra, FILTER_VALIDATE_IP) ? $ra : '0.0.0.0';
}

/** Ключ для файла счётчика: адрес в имени файла использовать нельзя. */
function ip_key(string $salt = ''): string
{
    return substr(hash('sha256', client_ip() . '|' . $salt), 0, 32);
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
function csrf_ok(?string $given): bool
{
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
