<?php
/* Маршрутизатор для локального сервера: php -S localhost:5173 -t public router.php

   Встроенный сервер PHP не читает .htaccess, поэтому языковой префикс
   приходится снимать здесь — ровно так же, как это делает Apache на боевом.
   На сервере этот файл не нужен и не используется. */

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

/* Панель — вне языков, как и на боевом сервере (см. public/.htaccess). */
if (preg_match('#^/(az|en)/admin(/|$)#', $path)) {
    http_response_code(404);
    echo 'Not found';
    return true;
}

if (preg_match('#^/(az|en)(/.*)?$#', $path, $m)) {
    $_SERVER['SITE_LANG'] = $m[1];
    putenv('SITE_LANG=' . $m[1]);
    $path = ($m[2] ?? '') !== '' ? $m[2] : '/';
}

$root = rtrim($_SERVER['DOCUMENT_ROOT'], '/\\');
$file = $root . str_replace('/', DIRECTORY_SEPARATOR, $path);

if (is_dir($file)) {
    $file = rtrim($file, '/\\') . DIRECTORY_SEPARATOR . 'index.php';
}

if (is_file($file)) {
    if (strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'php') {
        require $file;
        return true;
    }
    return false;   // статику сервер отдаёт сам
}

http_response_code(404);
echo 'Not found';
return true;
