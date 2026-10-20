<?php
/* Маршрутизатор для локального сервера: php -S localhost:5173 -t public router.php

   Встроенный сервер PHP не читает .htaccess, поэтому языковой префикс
   приходится снимать здесь — ровно так же, как это делает Apache на боевом.
   На сервере этот файл не нужен и не используется. */

/* Как Apache: правила сравниваются с раскодированным путём, где двойные
   косые склеены. Иначе локально такие адреса отдавали 404, а на боевом —
   страницу, и разница в поведении была не видна до выкладки. */
$path = preg_replace('~/{2,}~', '/', rawurldecode((string)parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

/* Панель — вне языков, как и на боевом сервере (см. public/.htaccess). */
if (preg_match('#^/(az|en)/admin(/|$)#', $path)) {
    http_response_code(404);
    echo 'Not found';
    return true;
}

/* Портфолио и карта сайта — как в public/.htaccess. */
if (preg_match('#^(/(?:az|en))?/portfolio/([a-z0-9-]+)(?:/([a-z0-9-]+))?$#', $path, $pm)) {
    header('Location: ' . $path . '/', true, 301);    // без косой — на адрес с ней
    return true;
}
if ($path === '/sitemap.xml') {
    require __DIR__ . '/public/sitemap.php';
    return true;
}
if (preg_match('#^(?:/(az|en))?/portfolio/[a-z0-9-]+/([a-z0-9-]+/)?$#', $path, $pm)) {
    if (($pm[1] ?? '') !== '') {
        $_SERVER['SITE_LANG'] = $pm[1];
        putenv('SITE_LANG=' . $pm[1]);
    }
    require __DIR__ . '/public/portfolio/' . (($pm[2] ?? '') !== '' ? 'project.php' : 'index.php');
    return true;
}

/* Раздел на другом языке без косой — как правило в .htaccess. */
if (preg_match('#^/(az|en)/([a-z0-9-]+(?:/[a-z0-9-]+)*)$#', $path)) {
    header('Location: ' . $path . '/', true, 301);
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
    /* Каталог без косой — как mod_dir на боевом: редирект на адрес с ней. */
    if (substr($path, -1) !== '/') {
        header('Location: ' . (isset($m[1]) ? '/' . $m[1] : '') . $path . '/', true, 301);
        return true;
    }
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
