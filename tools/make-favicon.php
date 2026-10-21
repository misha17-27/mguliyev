<?php
/* Значки сайта и панели из знака-шестиугольника.

   Знак берётся из логотипа public/images/brand/guliyev-black-logo.svg —
   это последний контур файла, слева от букв. Он собран только из прямых
   (M, L, H, l, h, z), два подконтура: внешний и внутренний, между ними
   тонкая полоса — отсюда «двойные линии» знака.

   Значок — точно как знак в логотипе, на всех размерах и одинаковый
   для сайта и панели: так попросил заказчик. На 16 пикселях тонкие
   двойные линии выглядят светлее, чем на большом рисунке, — это цена
   точности; утолщённый вариант сливал их в сплошные полосы.

   Растр — средствами GD: рисуем вдевятеро крупнее и уменьшаем с
   пересчётом, иначе края без сглаживания. */

/* Запуск из корня репозитория: php tools/make-favicon.php
   Нужен PHP с GD. На сервер этот файл не попадает: деплой копирует
   только app/ и public/. */
$ROOT = dirname(__DIR__);
$logo = file_get_contents($ROOT . '/public/images/brand/guliyev-black-logo.svg');
preg_match_all('~<path[^>]*\sd="([^"]+)"~s', $logo, $m);
$D = preg_replace('~\s+~', ' ', trim(end($m[1])));

/** Разбор контура из прямых в подконтуры с абсолютными координатами. */
function subpaths(string $d): array
{
    preg_match_all('~[A-Za-z]|-?\d*\.?\d+~', $d, $t);
    $t = $t[0]; $i = 0; $n = count($t);
    $x = $y = 0.0; $cmd = ''; $out = []; $cur = [];
    $num = static function () use (&$t, &$i): float { return (float)$t[$i++]; };
    while ($i < $n) {
        if (ctype_alpha($t[$i])) $cmd = $t[$i++];
        switch ($cmd) {
            case 'M': case 'm':
                if ($cur) $out[] = $cur;
                $a = $num(); $b = $num();
                [$x, $y] = $cmd === 'm' ? [$x + $a, $y + $b] : [$a, $b];
                $cur = [[$x, $y]];
                $cmd = $cmd === 'm' ? 'l' : 'L';
                break;
            case 'L': $x = $num(); $y = $num(); $cur[] = [$x, $y]; break;
            case 'l': $x += $num(); $y += $num(); $cur[] = [$x, $y]; break;
            case 'H': $x = $num(); $cur[] = [$x, $y]; break;
            case 'h': $x += $num(); $cur[] = [$x, $y]; break;
            case 'V': $y = $num(); $cur[] = [$x, $y]; break;
            case 'v': $y += $num(); $cur[] = [$x, $y]; break;
            case 'Z': case 'z': $x = $cur[0][0]; $y = $cur[0][1]; break;
            default: throw new RuntimeException('кривая в знаке: ' . $cmd);
        }
    }
    if ($cur) $out[] = $cur;
    return $out;
}

$SUB = subpaths($D);
$xs = $ys = [];
foreach ($SUB as $sp) foreach ($sp as [$px, $py]) { $xs[] = $px; $ys[] = $py; }
$BOX = ['x' => min($xs), 'y' => min($ys), 'w' => max($xs) - min($xs), 'h' => max($ys) - min($ys)];

/** Посадка знака в квадрат стороны $size: масштаб и сдвиг. */
function fit(array $BOX, float $size, float $pad): array
{
    $k = $size * (1 - 2 * $pad) / $BOX['w'];
    return [$k, ($size - $BOX['w'] * $k) / 2 - $BOX['x'] * $k, ($size - $BOX['h'] * $k) / 2 - $BOX['y'] * $k];
}

function hexrgb(string $h): array
{
    return [hexdec(substr($h, 1, 2)), hexdec(substr($h, 3, 2)), hexdec(substr($h, 5, 2))];
}

/** Растр: фон, полоса между подконтурами, обводка толщиной $extra (в единицах логотипа). */
function render(array $SUB, array $BOX, int $size, float $extra, float $pad, string $bg, string $fg)
{
    $S = 9;
    $w = $size * $S;
    [$k, $ox, $oy] = fit($BOX, $w, $pad);
    $im = imagecreatetruecolor($w, $w);
    $cb = imagecolorallocate($im, ...hexrgb($bg));
    $cf = imagecolorallocate($im, ...hexrgb($fg));
    imagefilledrectangle($im, 0, 0, $w, $w, $cb);

    $poly = [];
    foreach ($SUB as $sp) {
        $p = [];
        foreach ($sp as [$px, $py]) { $p[] = (int)round($px * $k + $ox); $p[] = (int)round($py * $k + $oy); }
        $poly[] = $p;
    }
    /* Внешний подконтур — цветом знака, внутренний вырезаем цветом фона. */
    imagefilledpolygon($im, $poly[0], $cf);
    for ($j = 1; $j < count($poly); $j++) imagefilledpolygon($im, $poly[$j], $cb);

    /* Утолщение: обводка обоих подконтуров и круги в вершинах, чтобы
       на углах не было зазубрин. */
    $t = (int)round($extra * $k);
    if ($t > 0) {
        imagesetthickness($im, $t);
        foreach ($poly as $p) {
            $cnt = count($p) / 2;
            for ($q = 0; $q < $cnt; $q++) {
                $a = $q * 2; $b = (($q + 1) % $cnt) * 2;
                imageline($im, $p[$a], $p[$a + 1], $p[$b], $p[$b + 1], $cf);
                imagefilledellipse($im, $p[$a], $p[$a + 1], $t, $t, $cf);
            }
        }
        imagesetthickness($im, 1);
    }

    $out = imagecreatetruecolor($size, $size);
    imagecopyresampled($out, $im, 0, 0, 0, 0, $size, $size, $w, $w);
    imagedestroy($im);
    return $out;
}

function png($im): string { ob_start(); imagepng($im, null, 9); return (string)ob_get_clean(); }

/** .ico — оглавление и PNG внутри (так можно с Windows Vista). */
function ico(array $images): string
{
    $out = pack('vvv', 0, 1, count($images));
    $off = 6 + 16 * count($images);
    $blobs = '';
    foreach ($images as $s => $data) {
        $out .= pack('CCCCvvVV', $s >= 256 ? 0 : $s, $s >= 256 ? 0 : $s, 0, 0, 1, 32, strlen($data), $off);
        $off += strlen($data);
        $blobs .= $data;
    }
    return $out . $blobs;
}

/** SVG для вкладки: вектор, полоса утолщена обводкой. */
function svg(string $D, array $BOX, float $extra, float $pad, string $bg, string $fg): string
{
    [$k, $ox, $oy] = fit($BOX, 512, $pad);
    return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" role="img" aria-label="MGuliyev Studio">'
        . '<title>MGuliyev Studio</title>'
        . '<rect width="512" height="512" fill="' . $bg . '"/>'
        . '<path transform="translate(' . round($ox, 2) . ',' . round($oy, 2) . ') scale(' . round($k, 4) . ')"'
        . ' d="' . $D . '" fill="' . $fg . '" fill-rule="evenodd"'
        . ($extra > 0 ? ' stroke="' . $fg . '" stroke-width="' . $extra . '" stroke-linejoin="round"' : '') . '/>'
        . '</svg>';
}

/* Утолщение и поля по размерам: чем мельче, тем толще полоса. */
$PLAN = [16 => [0, .05], 32 => [0, .06], 48 => [0, .07], 180 => [0, .09], 192 => [0, .09], 512 => [0, .09]];
$THEMES = [
    'site'  => ['dir' => $ROOT . '/public',              'bg' => '#FFFFFF', 'fg' => '#0A0A0A'],
    'admin' => ['dir' => $ROOT . '/public/admin/assets', 'bg' => '#FFFFFF', 'fg' => '#0A0A0A'],
];

foreach ($THEMES as $who => $th) {
    $r = [];
    foreach ($PLAN as $s => [$extra, $pad]) {
        if ($who === 'admin' && $s > 180) continue;
        $im = render($SUB, $BOX, $s, $extra, $pad, $th['bg'], $th['fg']);
        $r[$s] = png($im);
        imagedestroy($im);
    }
    file_put_contents($th['dir'] . '/favicon.svg', svg($D, $BOX, 0, .06, $th['bg'], $th['fg']));
    file_put_contents($th['dir'] . '/favicon.ico', ico([16 => $r[16], 32 => $r[32], 48 => $r[48]]));
    file_put_contents($th['dir'] . '/apple-touch-icon.png', $r[180]);
    if ($who === 'site') {
        file_put_contents($th['dir'] . '/icon-192.png', $r[192]);
        file_put_contents($th['dir'] . '/icon-512.png', $r[512]);
    }
    echo "  $who: favicon.svg, favicon.ico (16/32/48), apple-touch-icon.png"
       . ($who === 'site' ? ', icon-192.png, icon-512.png' : '') . "\n";
}
printf("  знак: %d подконтура, %.1f × %.1f\n", count($SUB), $BOX['w'], $BOX['h']);
