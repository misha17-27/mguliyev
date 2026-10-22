<?php
/* Карта сайта для поисковиков: /sitemap.xml.

   Собирается из данных, а не пишется руками. Раньше она была статичным
   файлом с пометкой «обновляется вручную»; с отраслями и проектами
   портфолио это больше полутора сотен адресов на трёх языках, и ручная
   карта отставала бы от сайта с первой же правки в панели.

   Формат — простой список адресов, только <loc>, как у caucasuscl.com:
   каждая страница подряд на всех языках, на которых она есть. Языковые
   связи страниц (hreflang) объявлены в <head> самих страниц — поисковику
   этого достаточно, дублировать их здесь незачем. Приоритет и дату
   изменения не пишем: Google их не использует или не доверяет им.
   Статья блога попадает в карту только на тех языках, где у неё есть
   текст: объявлять перевод, которого нет, — ошибка. */
require __DIR__ . '/../app/bootstrap.php';

header('Content-Type: application/xml; charset=utf-8');
/* Поисковику карту отдавать свежей, но не пересобирать на каждый запрос
   бота: час — разумный срок для сайта, который правят руками. */
header('Cache-Control: public, max-age=3600');

$cfg   = I18n::$cfg;
$base  = rtrim($cfg['site_url'], '/');
$langs = langs();

/** Абсолютный адрес страницы на языке. */
$abs = static fn(string $path, string $l): string => $base . u($path, $l);

/* [путь, языки] */
$urls = [];
foreach (['/', '/uslugi/', '/portfolio/', '/tseny/', '/o-studii/', '/kontakty/', '/blog/'] as $p) {
    $urls[] = [$p, $langs];
}
foreach (catalog_canon() as $slug => $c) {
    $urls[] = ['/uslugi/' . $slug . '/', $langs];
}
foreach (works_canon() as $g) {
    $urls[] = ['/portfolio/' . $g['slug'] . '/', $langs];
    foreach ($g['projects'] as $w) {
        $urls[] = ['/portfolio/' . $g['slug'] . '/' . project_slug($w['domain']) . '/', $langs];
    }
}
foreach (articles_canon() as $a) {
    /* Только языки, на которых у статьи есть текст. */
    $has = array_values(array_filter($langs, static fn($l) => !empty($a['body'][$l])));
    if (!$has) $has = [deflang()];
    $urls[] = ['/blog/' . $a['slug'] . '/', $has];
}

$x = static fn(string $s): string => htmlspecialchars($s, ENT_XML1 | ENT_QUOTES, 'UTF-8');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "
";
foreach ($urls as [$path, $ls]) {
    foreach ($ls as $l) {
        echo "  <url>
    <loc>" . $x($abs($path, $l)) . "</loc>
  </url>
";
    }
}
echo "</urlset>
";
