<?php
/* Отправка писем: через SMTP или через mail().

   ПОЧЕМУ ВООБЩЕ SMTP. Функция mail() отдаёт письмо локальному sendmail,
   и дальше судьба письма от нас не зависит. На виртуальном хостинге это
   обычно значит одно из двух: письмо не уходит вовсе, либо уходит с
   адреса сервера и попадает в спам, потому что не проходит проверку SPF.
   Отправка через настоящий почтовый ящик решает обе беды: письмо уходит
   от имени ящика, который действительно существует на домене.

   ПОЧЕМУ СВОЙ КЛИЕНТ, А НЕ БИБЛИОТЕКА. В проекте нет composer и нет ни
   одной зависимости — это сознательное решение: сайт разворачивается
   копированием файлов. Протокол SMTP для нашей задачи — десяток команд,
   и написать его целиком честнее, чем тащить ради этого пакетный менеджер.

   ЧТО ЗДЕСЬ ВАЖНО НЕ СЛОМАТЬ:
   - перевод строки в SMTP всегда \r\n, и только он;
   - ответ сервера бывает многострочным: «250-ВОЗМОЖНОСТЬ» продолжается,
     «250 ВОЗМОЖНОСТЬ» заканчивает. Читать одну строку — ошибка, после
     которой клиент разъезжается с сервером на всю сессию;
   - после STARTTLS команду EHLO надо повторить: до шифрования сервер
     объявляет один набор возможностей, после — другой;
   - в заголовки письма нельзя пускать перевод строки из формы, иначе
     через поле «имя» дописывают свои заголовки и рассылают спам;
   - пароль не должен попасть в журнал обмена, который показывается
     в панели.
*/

require_once __DIR__ . '/store.php';

/** Настройки почты: файл панели, поверх — значения из config.php. */
function mail_cfg(): array
{
    static $c = null;
    if ($c !== null) return $c;

    $cfg = I18n::$cfg['form'] ?? [];
    $d = Store::read('mail.json') ?? [];

    $c = [
        'transport' => in_array($d['transport'] ?? '', ['smtp', 'mail'], true) ? $d['transport'] : 'mail',
        'to'        => (string)($d['to'] ?? ($cfg['to'] ?? '')),
        'host'      => (string)($d['host'] ?? ''),
        'port'      => (int)($d['port'] ?? 465),
        'enc'       => in_array($d['enc'] ?? '', ['ssl', 'tls', 'none'], true) ? $d['enc'] : 'ssl',
        'user'      => (string)($d['user'] ?? ''),
        'pass'      => (string)($d['pass'] ?? ''),
        'from'      => (string)($d['from'] ?? ''),
        'from_name' => (string)($d['from_name'] ?? (I18n::$cfg['site_name'] ?? '')),
    ];

    /* Отправитель по умолчанию — тот же ящик, через который отправляем:
       почти все почтовые службы запрещают слать от чужого имени. */
    if ($c['from'] === '') $c['from'] = $c['user'];
    if ($c['from'] === '' && !empty($cfg['from'])) {
        $c['from'] = mail_addr_of((string)$cfg['from']);
        if ($c['from_name'] === '') $c['from_name'] = mail_name_of((string)$cfg['from']);
    }
    return $c;
}

/** Настроен ли SMTP настолько, чтобы им можно было пользоваться. */
function mail_smtp_ready(array $c = null): bool
{
    $c = $c ?? mail_cfg();
    return $c['transport'] === 'smtp' && $c['host'] !== '' && $c['port'] > 0 && $c['from'] !== '';
}

/** Адрес из строки вида «Имя <a@b.c>». */
function mail_addr_of(string $s): string
{
    return preg_match('~<([^>]+)>~', $s, $m) ? trim($m[1]) : trim($s);
}

/** Имя из строки вида «Имя <a@b.c>». */
function mail_name_of(string $s): string
{
    return preg_match('~^\s*(.*?)\s*<~', $s, $m) ? trim($m[1], " \t\"") : '';
}

/** Значение для заголовка письма: перевод строки вырезаем.

    Это не придирка. Если в «имя» из формы попадёт перевод строки, всё,
    что идёт после него, сервер прочитает как новый заголовок — и через
    форму заявки с сайта начнут рассылать письма куда угодно. */
function mail_header_safe(string $s): string
{
    return trim(str_replace(["\r", "\n", "\0"], ' ', $s));
}

/** Заголовок с кириллицей. Голый UTF-8 в заголовке недопустим,
    поэтому кодируем по RFC 2047 и режем на куски: строка заголовка
    длиннее 76 знаков разрешена не везде. */
function mail_encode_header(string $s): string
{
    $s = mail_header_safe($s);
    if ($s === '' || preg_match('~^[\x20-\x7E]*$~', $s)) return $s;

    $out = [];
    $chunk = '';
    foreach (preg_split('~~u', $s, -1, PREG_SPLIT_NO_EMPTY) as $ch) {
        /* Режем по БАЙТАМ, а не по знакам: кириллица — два байта на знак,
           и 42 знака давали 84 байта, то есть 112 знаков base64 — больше
           разрешённых 75 на одно закодированное слово. 45 байт дают ровно
           60 знаков base64, с обёрткой =?UTF-8?B?…?= — 72. Знак при этом
           не разрезается: проверка стоит до того, как его добавить. */
        if (strlen($chunk) + strlen($ch) > 45) {
            $out[] = '=?UTF-8?B?' . base64_encode($chunk) . '?=';
            $chunk = '';
        }
        $chunk .= $ch;
    }
    if ($chunk !== '') $out[] = '=?UTF-8?B?' . base64_encode($chunk) . '?=';
    return implode("\r\n ", $out);
}

/** Отправка письма.

    Возвращает ['ok' => bool, 'error' => string, 'via' => 'smtp'|'mail',
    'log' => string[]]. Журнал обмена нужен панели: без него «не
    отправилось» — это сообщение, с которым ничего нельзя сделать. */
function mail_send(string $to, string $subject, string $text, array $o = []): array
{
    $c = mail_cfg();
    $to = mail_header_safe($to);

    if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
        return ['ok' => false, 'error' => 'Адрес получателя записан неверно.', 'via' => '-', 'log' => []];
    }

    $fromAddr = mail_addr_of($o['from'] ?? $c['from']);
    $fromName = mail_header_safe($o['from_name'] ?? $c['from_name']);
    $replyTo  = isset($o['reply_to']) ? mail_addr_of(mail_header_safe($o['reply_to'])) : '';

    if (!filter_var($fromAddr, FILTER_VALIDATE_EMAIL)) {
        return ['ok' => false, 'error' => 'Адрес отправителя не задан или записан неверно. '
            . 'Заполните его в панели, раздел «Почта».', 'via' => '-', 'log' => []];
    }

    $from = $fromName !== ''
        ? mail_encode_header($fromName) . ' <' . $fromAddr . '>'
        : $fromAddr;

    $headers = [
        'From: ' . $from,
        'To: ' . $to,
        'Subject: ' . mail_encode_header($subject),
        'Date: ' . date('r'),
        'Message-ID: <' . bin2hex(random_bytes(12)) . '@' . (parse_url(I18n::$cfg['site_url'] ?? '', PHP_URL_HOST) ?: 'localhost') . '>',
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'Content-Transfer-Encoding: base64',
    ];
    if ($replyTo !== '' && filter_var($replyTo, FILTER_VALIDATE_EMAIL)) {
        /* Отвечать надо заказчику, а не служебному ящику, с которого ушло письмо. */
        $headers[] = 'Reply-To: ' . $replyTo;
    }

    $body = chunk_split(base64_encode($text), 76, "\r\n");

    if (mail_smtp_ready($c)) {
        return smtp_send($c, $fromAddr, $to, $headers, $body);
    }

    /* Запасной путь: встроенная отправка. Заголовки ей отдаём без
       From/To/Subject — их она ставит сама из своих аргументов. */
    $h = array_values(array_filter($headers, static fn($x) =>
        stripos($x, 'To: ') !== 0 && stripos($x, 'Subject: ') !== 0));

    $ok = @mail($to, mail_encode_header($subject), $body, implode("\r\n", $h));
    return [
        'ok'    => $ok,
        'error' => $ok ? '' : 'Встроенная отправка письма отказала. На виртуальном хостинге '
            . 'это обычное дело — настройте отправку через SMTP в разделе «Почта».',
        'via'   => 'mail',
        'log'   => ['Использована встроенная функция mail(), обмена с сервером нет.'],
    ];
}

/* ====================================================================
   Клиент SMTP
   ==================================================================== */

/** Чтение ответа сервера целиком.

    Ответ бывает многострочным: строки с дефисом после кода продолжаются,
    строка с пробелом после кода — последняя. Прочитать только первую —
    значит на следующей команде получить чужой ответ и разъехаться
    с сервером на всю сессию. */
function smtp_read($fp, array &$log): array
{
    $lines = [];
    /* Потолок на число строк: сервер, присылающий бесконечный ответ
       с дефисом, иначе держал бы процесс и раздувал журнал до предела
       памяти. Настоящий EHLO — это десяток строк. */
    $guard = 0;
    while (++$guard <= 100) {
        $line = fgets($fp, 1024);
        if ($line === false) {
            $m = stream_get_meta_data($fp);
            $log[] = '<<< нет ответа' . (!empty($m['timed_out']) ? ' (истекло время ожидания)' : '');
            return ['code' => 0, 'lines' => $lines];
        }
        $line = rtrim($line, "\r\n");
        $log[] = '<<< ' . $line;
        $lines[] = $line;
        /* Четвёртый знак: дефис — продолжение, пробел или конец — финал. */
        if (strlen($line) < 4 || $line[3] !== '-') break;
    }
    return ['code' => (int)substr($lines[count($lines) - 1] ?? '', 0, 3), 'lines' => $lines];
}

/** Отправка команды. $hide прячет содержимое в журнале — для пароля. */
function smtp_say($fp, string $cmd, array &$log, bool $hide = false): void
{
    $log[] = '>>> ' . ($hide ? '… (скрыто)' : $cmd);
    fwrite($fp, $cmd . "\r\n");
}

function smtp_send(array $c, string $fromAddr, string $to, array $headers, string $body): array
{
    $log = [];
    $fail = static function (string $msg) use (&$log) {
        return ['ok' => false, 'error' => $msg, 'via' => 'smtp', 'log' => $log];
    };

    /* Имя узла из настроек, без схемы и без мусора: оно идёт прямо
       в адрес соединения. */
    $host = preg_replace('~^[a-z]+://~i', '', trim($c['host']));
    $host = preg_replace('~[^A-Za-z0-9._:-]~', '', (string)$host);
    if ($host === '') return $fail('Не задан адрес почтового сервера.');

    $scheme = $c['enc'] === 'ssl' ? 'ssl://' : 'tcp://';
    $ctx = stream_context_create(['ssl' => [
        'verify_peer'       => true,
        'verify_peer_name'  => true,
        'SNI_enabled'       => true,
        'peer_name'         => $host,
    ]]);

    $log[] = '— соединяюсь: ' . $scheme . $host . ':' . $c['port'];
    $fp = @stream_socket_client($scheme . $host . ':' . $c['port'], $errno, $errstr, 15,
        STREAM_CLIENT_CONNECT, $ctx);

    if (!$fp) {
        return $fail('Не удалось соединиться с ' . $host . ':' . $c['port']
            . ($errstr !== '' ? ' — ' . $errstr : '')
            . '. Проверьте адрес сервера, порт и шифрование. Частая причина: '
            . 'хостинг закрывает исходящие соединения на почтовые порты — '
            . 'тогда это открывается в поддержке хостинга.');
    }
    stream_set_timeout($fp, 15);

    $r = smtp_read($fp, $log);
    if ($r['code'] !== 220) { fclose($fp); return $fail('Сервер не поздоровался (ожидался код 220).'); }

    /* Представляемся своим доменом: по нему часть серверов решает,
       принимать ли письмо вообще. */
    $me = parse_url(I18n::$cfg['site_url'] ?? '', PHP_URL_HOST) ?: 'localhost';

    smtp_say($fp, 'EHLO ' . $me, $log);
    $r = smtp_read($fp, $log);
    if ($r['code'] !== 250) { fclose($fp); return $fail('Сервер не принял приветствие EHLO.'); }

    if ($c['enc'] === 'tls') {
        smtp_say($fp, 'STARTTLS', $log);
        $r = smtp_read($fp, $log);
        if ($r['code'] !== 220) { fclose($fp); return $fail('Сервер отказался переходить на шифрование (STARTTLS).'); }

        $crypto = STREAM_CRYPTO_METHOD_TLS_CLIENT;
        if (defined('STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT')) {
            $crypto = STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT;
            if (defined('STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT')) {
                $crypto |= STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT;
            }
        }
        if (!@stream_socket_enable_crypto($fp, true, $crypto)) {
            fclose($fp);
            return $fail('Не удалось включить шифрование. Обычно дело в сертификате сервера '
                . 'или в том, что на этом порту ждут сразу SSL — попробуйте порт 465 '
                . 'и шифрование SSL/TLS.');
        }
        $log[] = '— шифрование включено';

        /* После STARTTLS сервер объявляет другой набор возможностей,
           поэтому EHLO обязателен заново. */
        smtp_say($fp, 'EHLO ' . $me, $log);
        $r = smtp_read($fp, $log);
        if ($r['code'] !== 250) { fclose($fp); return $fail('Сервер не принял EHLO после включения шифрования.'); }
    }

    /* Какие способы входа сервер вообще предлагает. */
    $caps = strtoupper(implode(' ', $r['lines']));

    if ($c['user'] !== '' && $c['pass'] !== '') {
        if (strpos($caps, 'AUTH') === false) {
            $log[] = '— сервер не предлагает вход по паролю, пробую всё равно';
        }

        if (strpos($caps, 'PLAIN') !== false) {
            smtp_say($fp, 'AUTH PLAIN ' . base64_encode("\0" . $c['user'] . "\0" . $c['pass']), $log, true);
            $r = smtp_read($fp, $log);
        } else {
            smtp_say($fp, 'AUTH LOGIN', $log);
            $r = smtp_read($fp, $log);
            if ($r['code'] === 334) {
                smtp_say($fp, base64_encode($c['user']), $log);
                $r = smtp_read($fp, $log);
            }
            if ($r['code'] === 334) {
                smtp_say($fp, base64_encode($c['pass']), $log, true);
                $r = smtp_read($fp, $log);
            }
        }

        if ($r['code'] !== 235) {
            fclose($fp);
            return $fail('Сервер не принял пароль. Для Gmail и Яндекса нужен не обычный '
                . 'пароль от ящика, а отдельный пароль приложения — он создаётся '
                . 'в настройках безопасности почты.');
        }
        $log[] = '— вход выполнен';
    }

    smtp_say($fp, 'MAIL FROM:<' . $fromAddr . '>', $log);
    $r = smtp_read($fp, $log);
    if ($r['code'] !== 250) {
        fclose($fp);
        return $fail('Сервер не принял адрес отправителя ' . $fromAddr
            . '. Обычно он должен совпадать с ящиком, через который отправляем.');
    }

    smtp_say($fp, 'RCPT TO:<' . $to . '>', $log);
    $r = smtp_read($fp, $log);
    if ($r['code'] !== 250 && $r['code'] !== 251) {
        fclose($fp);
        return $fail('Сервер не принял адрес получателя ' . $to . '.');
    }

    smtp_say($fp, 'DATA', $log);
    $r = smtp_read($fp, $log);
    if ($r['code'] !== 354) { fclose($fp); return $fail('Сервер не готов принять текст письма.'); }

    /* Точка в начале строки завершает письмо, поэтому собственную точку
       в начале строки полагается удваивать. Для base64 это невозможно,
       но правило общее и пусть будет: завтра тело станет другим. */
    $data = implode("\r\n", $headers) . "\r\n\r\n" . $body;
    $data = preg_replace('~^\.~m', '..', $data);
    fwrite($fp, $data . "\r\n.\r\n");
    $log[] = '>>> [текст письма, ' . strlen($data) . ' байт] + точка';

    $r = smtp_read($fp, $log);
    if ($r['code'] !== 250) { fclose($fp); return $fail('Сервер не принял письмо.'); }

    smtp_say($fp, 'QUIT', $log);
    smtp_read($fp, $log);
    fclose($fp);

    return ['ok' => true, 'error' => '', 'via' => 'smtp', 'log' => $log];
}
