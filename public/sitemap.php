<?php
/* Карта сайта для поисковиков: /sitemap.xml.

   Собирается из данных, а не пишется руками. Раньше она была статичным
   файлом с пометкой «обновляется вручную»; с отраслями и проектами
   портфолио это больше полутора сотен адресов на трёх языках, и ручная
   карта отставала бы от сайта с первой же правки в панели.

   У каждого адреса перечислены все языковые версии: так поисковик видит
   их одной группой, а не тремя похожими страницами. Статьи блога есть
   только по-русски — для них версий на других языках не объявляем:
   заявлять поисковику переводы, которых нет, — прямая ошибка. */
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

/* Дата изменения — только та, что относится к самой странице. Дата
   файла хранилища не годится: перестановка двух проектов стрелкой
   «обновляла» бы разом все полторы сотни адресов, и поисковик, увидев,
   что даты не совпадают с правками, перестал бы им верить вовсе.
   Панель ставит дату отрасли и проекту, когда правят именно их;
   где её нет — дату не пишем совсем. */
$day = static fn($v): ?string => is_string($v) && preg_match('~^\d{4}-\d{2}-\d{2}$~', $v) ? $v : null;

/* [путь, языки, приоритет, дата изменения] */
$urls = [];
foreach (['/', '/uslugi/', '/portfolio/', '/tseny/', '/o-studii/', '/kontakty/', '/blog/'] as $p) {
    $urls[] = [$p, $langs, $p === '/' ? '1.0' : '0.8', null];
}
foreach (catalog_canon() as $slug => $c) {
    $urls[] = ['/uslugi/' . $slug . '/', $langs, '0.8', null];
}
foreach (works_canon() as $g) {
    $urls[] = ['/portfolio/' . $g['slug'] . '/', $langs, '0.7', $day($g['updated'] ?? null)];
    foreach ($g['projects'] as $w) {
        $urls[] = ['/portfolio/' . $g['slug'] . '/' . project_slug($w['domain']) . '/', $langs, '0.5',
                   $day($w['updated'] ?? null)];
    }
}
foreach (articles_canon() as $a) {
    /* Только языки, на которых у статьи есть текст. */
    $has = array_values(array_filter($langs, static fn($l) => !empty($a['body'][$l])));
    if (!$has) $has = [deflang()];
    $d = DateTime::createFromFormat('d.m.Y', (string)$a['date']);
    $urls[] = ['/blog/' . $a['slug'] . '/', $has, '0.6', $d ? $d->format('Y-m-d') : null];
}

$x = static fn(string $s): string => htmlspecialchars($s, ENT_XML1 | ENT_QUOTES, 'UTF-8');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'
   . ' xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";

foreach ($urls as [$path, $ls, $prio, $mod]) {
    foreach ($ls as $l) {
        echo "  <url>\n";
        echo '    <loc>' . $x($abs($path, $l)) . "</loc>\n";
        if ($mod) echo '    <lastmod>' . $x($mod) . "</lastmod>\n";
        echo '    <priority>' . $prio . "</priority>\n";
        if (count($ls) > 1) {
            foreach ($ls as $alt) {
                echo '    <xhtml:link rel="alternate" hreflang="' . $x($alt) . '" href="'
                   . $x($abs($path, $alt)) . "\"/>\n";
            }
            echo '    <xhtml:link rel="alternate" hreflang="x-default" href="'
               . $x($abs($path, deflang())) . "\"/>\n";
        }
        echo "  </url>\n";
    }
}
echo "</urlset>\n";
