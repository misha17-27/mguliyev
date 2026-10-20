<?php
/* Общий загрузчик. Подключается первой строкой каждой страницы — до того,
   как страница возьмёт данные или подключит шапку.

   Порядок важен: язык надо определить раньше, чем кто-то запросит каталог
   или список статей, иначе данные успеют прийти на русском и перевод
   на них уже не наложится. */

$cfg = require __DIR__ . '/config.php';
require_once __DIR__ . '/i18n.php';
require_once __DIR__ . '/security.php';
I18n::boot($cfg);
require_once __DIR__ . '/content.php';
require_once __DIR__ . '/turnstile.php';

/* ОДНА СТРАНИЦА — ОДИН АДРЕС.

   Сервер прощает адресу лишнее: /tseny//, /tsen%79/ и /tseny/index.php/x/
   открывают ту же страницу. Apache сравнивает правила с уже раскодированным
   путём, где двойные косые склеены, а страница видит адрес таким, каким его
   прислали, — и ставила его же в canonical. Выходила одна страница под
   многими адресами, и /portfolio/logistik%61/ вместо 404 показывал всё
   портфолио. Такие адреса уводим на чистый постоянным редиректом.

   Только для чтения страниц: отправку формы перенаправлять нельзя —
   браузер повторил бы её уже GET-запросом, без данных. */
if (in_array($_SERVER['REQUEST_METHOD'] ?? 'GET', ['GET', 'HEAD'], true)) {
    $uri   = (string)($_SERVER['REQUEST_URI'] ?? '/');
    $q     = strpos($uri, '?');
    $raw   = $q === false ? $uri : substr($uri, 0, $q);
    $clean = preg_replace('~/{2,}~', '/', rawurldecode($raw)) ?? $raw;

    /* Хвост после имени скрипта: /tseny/index.php/x/ -> /tseny/.
       Ищем его в самом пути, а не в PATH_INFO: серверы заполняют
       PATH_INFO по-разному, встроенный сервер PHP — даже для обычного
       /portfolio/logistika/, и такой адрес уезжал бы на /portfolio. */
    if (preg_match('~^(.*?/)index\.php/~', $clean, $m)) {
        $clean = $m[1];
    } elseif (preg_match('~^(.*?\.php)/~', $clean, $m)) {
        $clean = $m[1];
    }

    if ($clean !== $raw && preg_match('~^/[A-Za-z0-9/._-]*$~', $clean)) {
        header('Location: ' . $clean . ($q === false ? '' : substr($uri, $q)), true, 301);
        exit;
    }
    unset($uri, $q, $raw, $clean, $m);
}

/* Политика безопасности содержимого — страховкой из PHP.

   Основная стоит в public/.htaccess и перебивает эту: так устроен
   mod_headers, и это правильно — ослабить политику из PHP нельзя.
   Но если .htaccess не читается вовсе (сменили корень сайта, поставили
   nginx), без этой строки у страниц не было бы политики ВООБЩЕ.
   Значение одно и то же, из константы, поэтому две одинаковые политики
   дают ту же самую. */
if (!headers_sent()) {
    header('Content-Security-Policy: ' . CSP_POLICY);
}
