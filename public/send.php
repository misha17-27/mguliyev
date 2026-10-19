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
$ts = (int)($_POST['ts'] ?? 0);
if ($ts > 0 && time() - $ts < 3) {
    finish(false, 'form.spam', $back, $ajax);
}

/* Частота по адресу */
$ip   = $_SERVER['REMOTE_ADDR'] ?? '0';
$lock = sys_get_temp_dir() . '/mg-lead-' . md5($ip);
if (is_file($lock) && time() - (int)filemtime($lock) < 60) {
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
$body .= "\n" . date('d.m.Y H:i') . ' · ' . $ip;

$to      = $cfg['form']['to'];
$subject = $cfg['form']['subject'] . ': ' . $fields['Имя'];
$headers = implode("\r\n", [
    'From: ' . $cfg['form']['from'],
    'Content-Type: text/plain; charset=UTF-8',
    'X-Mailer: mguliyev-site',
]);

$sent = @mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $body, $headers);
@touch($lock);

finish((bool)$sent, $sent ? 'form.ok' : 'form.error', $back, $ajax);
