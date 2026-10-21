<?php
/* Маршрутизатор для локального сервера: php -S localhost:5173 -t public router.php

   Встроенный сервер PHP не читает .htaccess, поэтому языковой префикс
   приходится снимать здесь — ровно так же, как это делает Apache на боевом.
   На сервере этот файл не нужен и не используется. */

/* Как Apache: правила сравниваются с раскодированным путём, где двойные
   косые склеены. Иначе локально такие адреса отдавали 404, а на боевом —
   страницу, и разница в поведении была не видна до выкладки. */
$path = preg_replace('~/{2,}~', '/', rawurldecode((string)parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

/* Строка запроса — в каждый редирект, как у Apache: иначе метки рекламы
   (?utm_…) терялись на первом же переходе. Берётся из адреса как есть,
   так же, как в app/bootstrap.php. */
$q  = strpos($_SERVER['REQUEST_URI'], '?');
$qs = $q !== false && $q + 1 < strlen($_SERVER['REQUEST_URI']) ? substr($_SERVER['REQUEST_URI'], $q) : '';

/* Путь не должен выводить за public/. После раскодирования %2F и %5C
   становятся косыми, и /..%2Fapp%2Fconfig.php запускал любой .php на
   диске: браузер такой адрес сам не сокращает, и его может запросить
   любая открытая страница, пока работает локальный сервер. Обе косые —
   на Windows обратная тоже разделитель. */
if (strpos($path, "\0") !== false || preg_match('~(^|[/\\\\])\.\.([/\\\\]|$)~', $path)) {
    http_response_code(404);
    echo 'Not found';
    return true;
}

/* Панель — вне языков, как и на боевом сервере (см. public/.htaccess).
   Префиксов может быть и несколько: на боевом /az/az/admin/ после
   повторного прохода правил тоже попадает под это правило. */
if (preg_match('#^(/(az|en))+/admin(/|$)#', $path)) {
    http_response_code(404);
    echo 'Not found';
    return true;
}

/* Портфолио и карта сайта — как в public/.htaccess. */
if (preg_match('#^(/(?:az|en))?/portfolio/([a-z0-9-]+)(?:/([a-z0-9-]+))?$#', $path, $pm)) {
    header('Location: ' . $path . '/' . $qs, true, 301);    // без косой — на адрес с ней
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
    header('Location: ' . $path . '/' . $qs, true, 301);
    return true;
}

/* Корень языка без косой: /az -> /az/, как правило ^(az|en)$ в .htaccess. */
if (preg_match('#^/(az|en)$#', $path)) {
    header('Location: ' . $path . '/' . $qs, true, 301);
    return true;
}

/* Снимаются все префиксы, а не один: Apache после [L] прогоняет
   переписанный адрес по правилам ещё раз, и у /az/az/tseny/ уходят оба,
   язык — от последнего. Так страница доходит до app/bootstrap.php, который
   уводит такой адрес на чистый, и это видно локально, как на боевом. */
$pre = '';
while (preg_match('#^/(az|en)(/.*)?$#', $path, $m)) {
    $_SERVER['SITE_LANG'] = $m[1];
    putenv('SITE_LANG=' . $m[1]);
    $pre .= '/' . $m[1];
    $path = ($m[2] ?? '') !== '' ? $m[2] : '/';
}

$root = rtrim($_SERVER['DOCUMENT_ROOT'], '/\\');
$file = $root . str_replace('/', DIRECTORY_SEPARATOR, $path);

/* Хвост после имени скрипта: /tseny/index.php/x/. Apache отдаёт такой
   адрес самому скрипту, а bootstrap.php уводит его на чистый; здесь был
   404, и проверить эту нормализацию локально было нельзя. */
if (!file_exists($file) && preg_match('~^(.*?\.php)/~', $path, $pt)) {
    $file = $root . str_replace('/', DIRECTORY_SEPARATOR, $pt[1]);
}

if (is_dir($file)) {
    /* Каталог без косой — как mod_dir на боевом: редирект на адрес с ней. */
    if (substr($path, -1) !== '/') {
        header('Location: ' . $pre . $path . '/' . $qs, true, 301);
        return true;
    }
    $file = rtrim($file, '/\\') . DIRECTORY_SEPARATOR . 'index.php';
}

/* Вторая страховка от выхода за public/: настоящий путь файла — с
   раскрытыми ссылками и точками — обязан лежать внутри корня сайта. */
$real = realpath($file);
$base = realpath($root);
$inside = $real !== false && $base !== false
    && strpos($real, rtrim($base, '/\\') . DIRECTORY_SEPARATOR) === 0;

if ($inside && is_file($file)) {
    if (strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'php') {
        require $file;
        return true;
    }
    return false;   // статику сервер отдаёт сам
}

http_response_code(404);
echo 'Not found';
return true;
