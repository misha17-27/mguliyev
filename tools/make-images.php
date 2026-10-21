<?php
/* Уменьшенные копии картинок в WebP — рядом с исходными JPEG.

   Обложки работ — 1200×750, а в сетке на телефоне они видны на ~376 CSS px;
   кадры ролика первого экрана — 608–640 px в ширину при экране в 180–242 px.
   Браузер выбирает копию по srcset, исходный JPEG остаётся запасным src
   (и для браузеров без WebP, и на случай, если копий нет).

   Запуск из корня репозитория: php tools/make-images.php
   Нужен PHP с GD и WebP. Пересобирается только то, у чего JPEG новее копии,
   поэтому после замены JPEG скрипт нужно запустить снова — иначе браузер
   продолжит получать старый снимок из WebP. На сервер файл не попадает:
   деплой копирует только app/ и public/. */

$IMG = dirname(__DIR__) . '/public/images';

/* [шаблон исходников, ширины копий (null — тот же размер), качество].
   Ширины обложек — под сетку в 1–3 колонки и большую обложку проекта
   (cover_srcset() в app/content.php ждёт ровно эти три); кадров ролика —
   под экран «телефона» при плотности 1,75–3 (sizes в public/index.php). */
$JOBS = [
    [$IMG . '/works/*.jpg',             [480, 800, 1200], 78],
    [$IMG . '/home/work-*.jpg',         [480, 800, 1200], 78],
    [$IMG . '/home/reel-*.jpg',         [360, 540],       78],
    [$IMG . '/demo/shot-*-poster.jpg',  [null],           75],
];

if (!function_exists('imagewebp')) {
    fwrite(STDERR, "GD без WebP: копии не сделать\n");
    exit(1);
}

$made = $kept = 0;
foreach ($JOBS as [$glob, $widths, $q]) {
    foreach (glob($glob) ?: [] as $src) {
        $base = substr($src, 0, -4);
        $im = null;
        foreach ($widths as $w) {
            $dst = $base . ($w ? '-' . $w : '') . '.webp';
            if (is_file($dst) && filemtime($dst) >= filemtime($src)) { $kept++; continue; }

            $im = $im ?: imagecreatefromjpeg($src);
            if (!$im) { fwrite(STDERR, "не читается: $src\n"); continue 2; }
            $sw = imagesx($im); $sh = imagesy($im);
            $w  = $w ? min($w, $sw) : $sw;
            $h  = (int)round($sh * $w / $sw);

            /* imagecopyresampled, а не imagescale: она усредняет пиксели,
               и мелкий текст на снимке сайта при уменьшении в 2,5 раза
               не рассыпается лесенкой. */
            $out = imagecreatetruecolor($w, $h);
            imagecopyresampled($out, $im, 0, 0, 0, 0, $w, $h, $sw, $sh);
            imagewebp($out, $dst, $q);
            $out = null;
            printf("%s  %d×%d  %d → %d Б\n", basename($dst), $w, $h, filesize($src), filesize($dst));
            $made++;
        }
        /* Без imagedestroy(): с PHP 8 она ничего не делает, а в 8.5 устарела.
           Картинка освобождается, как только на неё не остаётся ссылок. */
        $im = null;
    }
}
echo "Готово: новых $made, без изменений $kept\n";
