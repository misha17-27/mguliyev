<?php
/* Cloudflare Turnstile: проверка «человек ли это» на формах сайта и на входе в панель.

   КЛЮЧИ ЗАДАЮТСЯ В ПАНЕЛИ. Нет ключей — нет капчи, и всё работает ровно
   как раньше. Это не запасной вариант, а нормальное состояние: сайт должен
   жить и до того, как владелец заведёт виджет в Cloudflare.

   НИ ОДНОГО ВСТРОЕННОГО СКРИПТА. Виджет ставится «неявной отрисовкой»:
   в разметке только <div class="cf-turnstile" data-sitekey="…">, а api.js
   сам находит его и рисует. Поэтому политика script-src остаётся без
   'unsafe-inline' — это главное, ради чего на сайте нет ни одного
   встроенного скрипта, и терять это из-за капчи было бы глупо.

   ТОКЕН ЕДЕТ САМ. Виджет вставляет в форму скрытое поле
   cf-turnstile-response. FormData подхватывает его вместе с остальными,
   поэтому отправка через fetch работает без единой правки в app.js,
   и обычная отправка формы — тоже.

   ЧТО ПРОВЕРЯЕМ НА СЕРВЕРЕ, КРОМЕ success. Токен выдаётся на любом домене
   из списка виджета, поэтому сверяем hostname — иначе токен, полученный
   на другой разрешённой странице, годится и для нашей формы. И сверяем
   action: без него токен с формы заявки подошёл бы ко входу в панель.

   ПОВЕДЕНИЕ ПРИ НЕДОСТУПНОСТИ CLOUDFLARE. Транспортный сбой — таймаут,
   нет сети, не разобрался ответ — пропускаем и помечаем заявку. Доводы:
   цена отказа это потерянный заказчик, который не придёт второй раз;
   вызвать недоступность снаружи нельзя, это исходящее соединение нашего
   сервера; и главное — ловушка, метка времени и ограничение частоты
   никуда не делись, то есть пропуск возвращает нас к сегодняшнему уровню
   защиты, а не к нулевому. Решённый отказ (success:false) не пропускается
   никогда — это уже не сбой, а ответ.
*/

require_once __DIR__ . '/store.php';
require_once __DIR__ . '/security.php';

const TS_API      = 'https://challenges.cloudflare.com/turnstile/v0/api.js';
const TS_VERIFY   = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
const TS_HOST     = 'https://challenges.cloudflare.com';
const TS_MAX_TOKEN = 2048;   // документированный предел длины токена
const TS_TIMEOUT  = 4;       // секунд на обращение к Cloudflare
const TS_CONNECT  = 3;       // из них на установление соединения

/* Почему так мало. Это ожидание видит посетитель, стоя над отправленной
   формой, и оно удваивается повтором. При 8+5 секундах с повтором форма
   молчала бы до 16 секунд — за это время человек нажимает «отправить»
   второй раз или уходит. 4+3 с одним повтором дают не больше 9. */

/** Ключи виджета. Секретный ключ наружу не отдаётся нигде, кроме запроса
    к Cloudflare: он лежит в хранилище вне корня сайта. */
function ts_cfg(): array
{
    static $c = null;
    if ($c !== null) return $c;

    $d = Store::read('security.json') ?? [];
    $site   = trim((string)($d['site'] ?? ''));
    $secret = (string)($d['secret'] ?? '');

    $c = [
        'site'   => $site,
        'secret' => $secret,
        /* Капча включена только когда есть ОБА ключа. С одним она либо
           нарисуется и не проверится, либо наоборот — и то и другое хуже,
           чем её отсутствие. */
        'on'     => $site !== '' && $secret !== '',
    ];
    return $c;
}

function ts_on(): bool
{
    return ts_cfg()['on'];
}

/** Стоят ли сейчас тестовые ключи Cloudflare.

    Они документированы и нужны, чтобы проверить встройку до того, как
    заведён настоящий виджет. Но вести себя с ними надо иначе: тестовый
    ключ отвечает hostname «example.com», и обычная сверка домена отбила бы
    даже успешную проверку. Это выяснилось прогоном против настоящего
    Cloudflare — по виду кода такое не видно.

    Длины не совпадают не случайно: у site key 24 знака, у secret — 35. */
function ts_is_test(): bool
{
    $c = ts_cfg();
    return (bool)preg_match('~^[123]x0{20}[A-Z]{2}$~', $c['site'])
        || (bool)preg_match('~^[123]x0{31}AA$~', $c['secret']);
}

/** Подключение api.js. Самохостить нельзя: документация прямо запрещает
    проксировать и кешировать этот файл — при выходе обновлений виджет
    перестанет работать. */
function ts_script(): string
{
    if (!ts_on()) return '';
    return '<script src="' . TS_API . '" async defer></script>';
}

/** Контейнер виджета. Ставится ВНУТРЬ <form>, иначе скрытое поле с токеном
    в форму не попадёт.

    $action помечает, с какой формы пришёл токен; на сервере мы его
    сверяем, и токен от формы заявки не подойдёт ко входу в панель. */
function ts_widget(string $action, string $theme = 'auto'): string
{
    if (!ts_on()) return '';
    $e = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $action = preg_replace('~[^a-z0-9_-]~', '', strtolower($action)) ?: 'form';

    return '<div class="cf-turnstile" data-sitekey="' . $e(ts_cfg()['site']) . '"'
         . ' data-action="' . $e($action) . '"'
         . ' data-theme="' . $e(in_array($theme, ['light', 'dark', 'auto'], true) ? $theme : 'auto') . '"'
         . ' data-size="flexible"></div>';
}

/** Наш домен для сверки с полем hostname в ответе.
    Приходит то голый домен, то www — поэтому www отрезаем с обеих сторон,
    иначе строгое сравнение начнёт отбивать половину посетителей. */
function ts_bare_host(string $h): string
{
    $h = strtolower(trim($h));
    $h = preg_replace('~^https?://~', '', $h) ?? $h;
    $h = explode('/', $h)[0];
    $h = preg_replace('~:\d+$~', '', $h) ?? $h;
    return strpos($h, 'www.') === 0 ? substr($h, 4) : $h;
}

/** Запрос к Cloudflare. Отдаёт ['net' => bool, 'data' => array|null, 'why' => string].
    net=false означает «не доехали», а не «не прошли» — разница принципиальная. */
function ts_ask(array $post): array
{
    $body = http_build_query($post);

    if (function_exists('curl_init')) {
        $ch = curl_init(TS_VERIFY);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $body,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => TS_TIMEOUT,
            CURLOPT_CONNECTTIMEOUT => TS_CONNECT,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/x-www-form-urlencoded'],
        ]);
        $raw  = curl_exec($ch);
        $code = (int)curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        $err  = curl_error($ch);
        curl_close($ch);

        if ($raw === false) return ['net' => false, 'data' => null, 'why' => 'сеть: ' . $err];

        /* Код ответа НЕ решает, доехали мы или нет. На неверный секретный ключ
           Cloudflare отвечает 400 — но с нормальным телом
           {"success":false,"error-codes":["invalid-input-secret"]}. Если считать
           это сбоем сети, сработает пропуск по недоступности, и капча будет
           молча пропускать всех, показывая в панели «включена». Разбор тела
           ниже сам решит: разобралось — это ответ, не разобралось — сбой. */
        if ($code !== 200 && $code !== 400) {
            return ['net' => false, 'data' => null, 'why' => 'ответ ' . $code];
        }
    } else {
        /* Запасной путь: на части хостингов cURL не собран. */
        if (!ini_get('allow_url_fopen')) {
            return ['net' => false, 'data' => null, 'why' => 'нет ни cURL, ни allow_url_fopen'];
        }
        $ctx = stream_context_create([
            'http' => [
                'method'        => 'POST',
                'header'        => "Content-Type: application/x-www-form-urlencoded\r\n",
                'content'       => $body,
                'timeout'       => TS_TIMEOUT,
                'ignore_errors' => true,
                'protocol_version' => 1.1,
            ],
            'ssl' => ['verify_peer' => true, 'verify_peer_name' => true],
        ]);
        $raw = @file_get_contents(TS_VERIFY, false, $ctx);
        if ($raw === false) return ['net' => false, 'data' => null, 'why' => 'сеть: запрос не прошёл'];

        /* Тот же разбор кода, что и у cURL: с ignore_errors=true тело
           приходит и при 400, и путь должен вести себя одинаково —
           иначе поведение капчи зависит от того, собран ли на хостинге cURL. */
        $code = 0;
        foreach ($http_response_header ?? [] as $h) {
            if (preg_match('~^HTTP/\S+\s+(\d{3})~', $h, $m)) $code = (int)$m[1];
        }
        if ($code !== 0 && $code !== 200 && $code !== 400) {
            return ['net' => false, 'data' => null, 'why' => 'ответ ' . $code];
        }
    }

    $d = json_decode((string)$raw, true);
    if (!is_array($d)) return ['net' => false, 'data' => null, 'why' => 'ответ не разобрался'];
    return ['net' => true, 'data' => $d, 'why' => ''];
}

/** Проверка токена.

    Возвращает:
      ok      — пускать или нет
      skipped — пропущено из-за недоступности Cloudflare, а не проверено
      codes   — коды от Cloudflare плюс наши пометки
      bucket  — 'visitor' | 'config' | 'outage': кто виноват и что писать
      note    — строка для письма и журнала

    bucket нужен, чтобы не гонять посетителя по кругу: при нашей же ошибке
    в настройках винить его сообщением «пройдите проверку заново» бессмысленно,
    сколько бы он ни проходил. */
function ts_verify($token, string $action, bool $failOpen = true): array
{
    if (!ts_on()) {
        return ['ok' => true, 'skipped' => false, 'codes' => [], 'bucket' => 'off', 'note' => ''];
    }

    /* Тип не объявляем: поле приходит из формы, а туда можно прислать
       cf-turnstile-response[]=x, и объявленный ?string уронил бы приём
       заявки с ошибкой 500 — на публичном адресе, без всякого входа. */
    $token = is_string($token) ? $token : '';
    if ($token === '') {
        return ['ok' => false, 'skipped' => false, 'codes' => ['missing-input-response'],
                'bucket' => 'visitor', 'note' => 'токен не прислан'];
    }
    if (strlen($token) > TS_MAX_TOKEN) {
        /* Дешёвый отсев до сетевого запроса: длина токена документирована. */
        return ['ok' => false, 'skipped' => false, 'codes' => ['invalid-input-response'],
                'bucket' => 'visitor', 'note' => 'токен длиннее допустимого'];
    }

    $c = ts_cfg();

    /* Один и тот же ключ на обе попытки: иначе повтор после сетевого сбоя
       упрётся в одноразовость токена и вернёт timeout-or-duplicate. */
    $idem = sprintf('%08x-%04x-4%03x-%04x-%012x',
        random_int(0, 0xffffffff), random_int(0, 0xffff), random_int(0, 0xfff),
        random_int(0x8000, 0xbfff), random_int(0, 0xffffffffffff));

    $post = [
        'secret'          => $c['secret'],
        'response'        => $token,
        'remoteip'        => client_ip(),
        'idempotency_key' => $idem,
    ];

    $r = ts_ask($post);
    /* Повтор один раз: и при сетевом сбое, и при internal-error —
       документация прямо говорит, что его можно повторить. */
    $retry = !$r['net']
        || (is_array($r['data']) && empty($r['data']['success'])
            && in_array('internal-error', (array)($r['data']['error-codes'] ?? []), true));
    if ($retry) {
        usleep(300000);
        $r = ts_ask($post);
    }

    if (!$r['net']) {
        $note = 'Cloudflare недоступен (' . $r['why'] . ')';
        error_log('Turnstile: ' . $note);
        return ['ok' => $failOpen, 'skipped' => true, 'codes' => ['transport'],
                'bucket' => 'outage', 'note' => $note];
    }

    $d     = $r['data'];
    $codes = array_values(array_filter((array)($d['error-codes'] ?? []), 'is_string'));

    if (empty($d['success'])) {
        $config = array_intersect($codes, [
            'missing-input-secret', 'invalid-input-secret', 'bad-request',
            'invalid-widget-id', 'invalid-parsed-secret',
        ]);
        $bucket = $config ? 'config' : 'visitor';
        if ($bucket === 'config') {
            error_log('Turnstile настроен неверно: ' . implode(', ', $codes));
        }
        return ['ok' => false, 'skipped' => false, 'codes' => $codes,
                'bucket' => $bucket, 'note' => 'проверка не пройдена: ' . implode(', ', $codes)];
    }

    /* Токен настоящий. Осталось убедиться, что он с нашей страницы
       и с нужной формы: Cloudflare этого за нас не делает. */
    $gotHost = ts_bare_host((string)($d['hostname'] ?? ''));

    /* Сверяем с адресом из app/config.php, а НЕ с заголовком Host.
       Host присылает клиент: обратившись к серверу напрямую, мимо
       Cloudflare, его можно поставить любым — и сверка, опирающаяся
       на него, сверяет подделку с подделкой. Адрес в настройках
       клиенту недоступен. */
    $cfgHost = ts_bare_host((string)(I18n::$cfg['site_url'] ?? ''));

    /* На тестовых ключах Cloudflare отвечает hostname «example.com» —
       сверять его с нашим доменом бессмысленно, иначе проверка встройки
       тестовой парой всегда проваливалась бы. */
    if (!ts_is_test() && $cfgHost !== '' && $gotHost !== '' && $gotHost !== $cfgHost) {
        error_log('Turnstile: токен выдан на ' . $gotHost . ', а сайт — ' . $cfgHost);
        return ['ok' => false, 'skipped' => false, 'codes' => ['hostname-mismatch'],
                'bucket' => 'visitor', 'note' => 'токен выдан на другом домене: ' . $gotHost];
    }

    $want = preg_replace('~[^a-z0-9_-]~', '', strtolower($action)) ?: 'form';
    $got  = (string)($d['action'] ?? '');

    /* Сверка строгая: пустое значение раньше её отключало, а это дыра.
       Site Key публичный и виден в разметке; на своей странице можно
       поставить виджет с ним и БЕЗ data-action — пустой action проходил
       бы и на форме заявки, и на входе в панель. Исключение одно:
       тестовые ключи Cloudflare action не возвращают вовсе. */
    if (!ts_is_test() && $got !== $want) {
        error_log('Turnstile: токен от формы «' . $got . '», ожидалась «' . $want . '»');
        return ['ok' => false, 'skipped' => false, 'codes' => ['action-mismatch'],
                'bucket' => 'visitor', 'note' => 'токен от другой формы: ' . $got];
    }

    return ['ok' => true, 'skipped' => false, 'codes' => [], 'bucket' => 'ok', 'note' => ''];
}

/** Ключ словаря для сообщения посетителю.

    Отдаём именно ключ, а не готовый текст: сообщения формы переводятся
    на три языка, и перевод берёт на себя тот, кто выводит.

    Текст зависит от того, кто виноват. При нашей же ошибке в настройках
    писать «пройдите проверку заново» — издевательство: сколько бы
    посетитель её ни проходил, не поможет. */
function ts_message(array $res): string
{
    if ($res['bucket'] === 'config')  return 'form.captcha_broken';
    if (in_array('timeout-or-duplicate', $res['codes'], true)) return 'form.captcha_stale';
    return 'form.captcha_failed';
}
