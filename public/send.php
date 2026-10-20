<?php
/* Приём заявки.

   Работает двумя путями: со скриптом — fetch и ответ JSON, без скрипта —
   обычная отправка формы и возврат на страницу с ?sent=1. Второй путь важнее,
   чем кажется: заявка не должна теряться из-за того, что у человека
   не выполнился JavaScript.

   Защита от ботов без внешних сервисов и без капчи:
     — поле-ловушка, скрытое от человека: заполнено — значит бот;
     — время заполнения: форма, отправленная быстрее трёх секунд, не человеческая;
     — ограничение частоты по адресу: не чаще одной заявки в минуту.
   Это не останавливает целевой спам, но отсекает основную массу переборщиков. */

require __DIR__ . '/../app/bootstrap.php';
require __DIR__ . '/../app/security.php';
require __DIR__ . '/../app/mailer.php';

$cfg  = I18n::$cfg;
$ajax = strtolower($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'fetch';

/* Куда вернуть посетителя. Значение приходит из формы, то есть снаружи,
   и без проверки это открытый редирект: достаточно подставить чужой адрес,
   чтобы наш домен уводил на него. Принимаем только путь внутри сайта:
   начинается с одного слэша, без схемы, без второго слэша в начале. */
$back = (string)($_POST['back'] ?? '');
if ($back === '' || $back[0] !== '/' || strpos($back, '//') === 0 || strpos($back, "\\") !== false) {
    $back = u('/kontakty/');
}
$back = strtok($back, '?#');

function finish(bool $ok, string $key, string $back, bool $ajax): void
{
    if ($ajax) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['ok' => $ok, 'message' => t($key)], JSON_UNESCAPED_UNICODE);
        exit;
    }
    $sep = strpos($back, '?') === false ? '?' : '&';
    header('Location: ' . $back . $sep . ($ok ? 'sent=1' : 'error=1') . '#contact', true, 303);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    finish(false, 'form.error', $back, $ajax);
}

/* Ловушка и время заполнения */
if (trim((string)($_POST['website'] ?? '')) !== '') {
    finish(true, 'form.ok', $back, $ajax);          // боту отвечаем «принято» и молчим
}
/* Метка времени обязательна. Раньше её отсутствие проверку просто
   отключало: достаточно было не прислать поле. Теперь нет метки —
   нет и заявки; настоящая форма присылает её всегда.
   Верхняя граница нужна против заранее заготовленных меток. */
$ts  = (int)($_POST['ts'] ?? 0);
$now = time();
if ($ts <= 0 || $now - $ts < 3 || $now - $ts > 86400) {
    finish(false, 'form.spam', $back, $ajax);
}

/* Частота по адресу.

   Адрес берём через client_ip(): сайт стоит за Cloudflare, и REMOTE_ADDR
   здесь — это всегда адрес Cloudflare, один на всех. Ограничение по нему
   либо не работает вовсе, либо запирает сразу всех посетителей.

   Метка лежит в хранилище, а не в общей временной папке сервера: на
   виртуальном хостинге её содержимое видят соседние аккаунты. */
$lock = 'locks/lead-' . ip_key('lead') . '.json';
$prev = Store::read($lock);
if ($prev && $now - (int)($prev['last'] ?? 0) < 60) {
    finish(false, 'form.often', $back, $ajax);
}

$name  = trim((string)($_POST['name'] ?? ''));
$phone = trim((string)($_POST['phone'] ?? ''));
if ($name === '' || $phone === '') {
    finish(false, 'form.required', $back, $ajax);
}

$clean = static fn(string $s, int $max): string =>
    mb_substr(preg_replace('/[\r\n]+/u', ' ', strip_tags($s)), 0, $max);

$fields = [
    'Имя'      => $clean($name, 120),
    'Телефон'  => $clean($phone, 60),
    'Услуга'   => $clean((string)($_POST['service'] ?? ''), 80),
    'Бюджет'   => $clean((string)($_POST['budget'] ?? ''), 80),
    'Задача'   => mb_substr(strip_tags((string)($_POST['message'] ?? '')), 0, 4000),
    'Язык'     => I18n::$lang,
    'Страница' => $clean((string)($_POST['back'] ?? ''), 200),
];

$body = '';
foreach ($fields as $k => $v) {
    if ($v !== '') $body .= $k . ': ' . $v . "\n";
}
/* Адрес в письме — настоящий адрес посетителя, а не адрес Cloudflare:
   иначе во всех заявках стоял бы один и тот же, и толку от него нет. */
$body .= "\n" . date('d.m.Y H:i') . ' · ' . client_ip();

/* Отправляем через app/mailer.php: он сам решит, идти через SMTP
   (если ящик настроен в панели) или через встроенную mail(). Заголовки
   и кодирование кириллицы собраны там же — в одном месте на весь сайт. */
$mail = mail_cfg();
$to   = $mail['to'] !== '' ? $mail['to'] : ($cfg['form']['to'] ?? '');

$res = mail_send(
    $to,
    ($cfg['form']['subject'] ?? 'Заявка с сайта') . ': ' . $fields['Имя'],
    $body
    /* Обратного адреса нет: форма собирает имя и телефон, почту не
       спрашивает. Появится поле почты — сюда добавится reply_to,
       и «Ответить» в почтовой программе будет попадать заказчику. */
);
$sent = $res['ok'];

if (!$sent) {
    /* Заявка дороже тишины. Если письмо не ушло, человек всё равно
       оставил свои данные, и потерять их бесследно нельзя: кладём
       в хранилище и пишем причину в журнал ошибок сервера. */
    error_log('Заявка не отправлена: ' . $res['error']);
    Store::write('leads/' . date('Y-m-d-His') . '-' . bin2hex(random_bytes(3)) . '.json', [
        'at'     => date('d.m.Y H:i'),
        'fields' => $fields,
        'error'  => $res['error'],
    ]);
}
Store::write($lock, ['last' => $now]);
if (random_int(1, 50) === 1) attempts_sweep('lead', 3600);

finish((bool)$sent, $sent ? 'form.ok' : 'form.error', $back, $ajax);
