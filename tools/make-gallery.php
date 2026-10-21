<?php
/* Галереи страниц проектов из снимков в _source/portfolio-screenshots/.

   Запуск из корня репозитория: php tools/make-gallery.php
   Нужен PHP с GD (png, jpeg, webp). На сервер этот файл не попадает:
   деплой копирует только app/ и public/.

   Что делает:
   — в папке проекта берёт снимки страниц и макеты, кроме обложки (uz*.jpg —
     она уже стоит карточкой) и копий файлов;
   — снимок главной страницы ставит первым, остальные — по имени;
   — уменьшает до 1000 px по ширине; у полностраничных снимков (они бывают
     по десять тысяч пикселей в высоту) берёт верх — до 1600 px: на странице
     проекта нужен вид сайта, а не прокрутка на десять экранов;
   — пишет public/images/works/gallery/<домен>/NN.webp и список в
     app/data/works_gallery.php.

   Только настоящие снимки сайтов заказчиков; папок для проектов, которых
   нет в data/works.php, не трогаем. */

ini_set('memory_limit', '2048M');
$ROOT = dirname(__DIR__);
$SRC  = $ROOT . '/_source/portfolio-screenshots';
$OUT  = $ROOT . '/public/images/works/gallery';
const MAX_W = 1000;
const MAX_H = 1600;
const Q     = 78;

/* Папки, названные не по домену. */
$ALIAS = ['166' => '166temizlik.az', 'argflex' => 'argflex.co.uk', 'metalist' => 'metalist.az',
          'sleepanbed,ru' => 'sleepandbed.hu'];

$domains = [];
foreach (require $ROOT . '/app/data/works.php' as $g) foreach ($g[3] as $w) $domains[$w[0]] = true;

function load_image(string $f)
{
    $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
    if ($ext === 'png')  return @imagecreatefrompng($f);
    if ($ext === 'webp') return @imagecreatefromwebp($f);
    if ($ext === 'jpg' || $ext === 'jpeg') return @imagecreatefromjpeg($f);
    return false;
}

$list = [];
$bytes = 0;
foreach (scandir($SRC) as $dir) {
    if ($dir[0] === '.' || !is_dir("$SRC/$dir")) continue;
    $dom = $ALIAS[$dir] ?? $dir;
    if (!isset($domains[$dom])) { echo "  пропуск: $dir — такого проекта в портфолио нет\n"; continue; }

    $files = [];
    foreach (scandir("$SRC/$dir") as $f) {
        if (!preg_match('~\.(png|jpe?g|webp)$~i', $f)) continue;
        if (preg_match('~^uz(-\d+)?\.jpe?g$~i', $f)) continue;          // обложка — уже на карточке
        if (strpos($f, 'копия') !== false) continue;                      // копии одного и того же
        $files[] = $f;
    }
    /* Главная — первой: у снимка главной нет имени раздела после домена
       (screencapture-itas-az-2024-…), у остальных есть (…-elaqe-2024-…). */
    $isHome = static fn(string $f): bool => (bool)preg_match('~^screencapture-~i', $f)
        && !preg_match('~-(elaqe|haqqimizda|about|contact|shop|mehsullar|terefdaslar|markalar|istehsal|ixrac)~i', $f);
    usort($files, static function ($a, $b) use ($isHome) {
        if ($isHome($a) !== $isHome($b)) return $isHome($a) ? -1 : 1;
        return strnatcasecmp($a, $b);
    });

    @mkdir("$OUT/$dom", 0755, true);
    foreach (glob("$OUT/$dom/*.webp") ?: [] as $old) unlink($old);
    $n = 0;
    foreach ($files as $f) {
        $im = load_image("$SRC/$dir/$f");
        if (!$im) { echo "  не читается: $dir/$f\n"; continue; }
        $w = imagesx($im); $h = imagesy($im);
        $k = min(1, MAX_W / $w);
        $nw = (int)round($w * $k);
        $nh = (int)min(MAX_H, round($h * $k));
        $srcH = (int)round($nh / $k);
        $out = imagecreatetruecolor($nw, $nh);
        imagecopyresampled($out, $im, 0, 0, 0, 0, $nw, $nh, $w, $srcH);
        $n++;
        $name = sprintf('%02d.webp', $n);
        imagewebp($out, "$OUT/$dom/$name", Q);
        $bytes += filesize("$OUT/$dom/$name");
        $list[$dom][] = '/images/works/gallery/' . $dom . '/' . $name;
        unset($im, $out);
    }
    printf("  %-20s %d\n", $dom, $n);
}

ksort($list);
$php = "<?php\n/* Галереи страниц проектов: снимки сайтов заказчиков по порядку.\n"
     . "   Собирается tools/make-gallery.php из _source/portfolio-screenshots/ — руками\n"
     . "   не править. В панели у проекта своя галерея, если её там задали. */\n\nreturn [\n";
foreach ($list as $dom => $imgs) {
    $php .= '    ' . var_export($dom, true) . " => [\n";
    foreach ($imgs as $p) $php .= '        ' . var_export($p, true) . ",\n";
    $php .= "    ],\n";
}
$php .= "];\n";
file_put_contents($ROOT . '/app/data/works_gallery.php', $php);
printf("Проектов с галереей: %d, снимков: %d, вес: %.1f МБ\n", count($list), array_sum(array_map('count', $list)), $bytes / 1048576);
