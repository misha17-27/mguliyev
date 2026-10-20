<?php
require __DIR__ . '/../../../app/bootstrap.php';
$slug = 'vertikalnoe-video-bezopasnaya-zona';
/* Заголовок и описание берём из data/articles.php — это единственный источник.
   Раньше те же строки лежали ещё и здесь, и разошлись бы при первой правке. */
foreach (articles() as $a) {
    if ($a['slug'] !== $slug) continue;
    /* ?: а не ??: поле из панели приходит пустой строкой, а не null,
       и ?? пропускал её — страница получала пустой <title>, то есть
       в выдаче вместо заголовка стоял адрес. */
    $title       = ($a['seoTitle'] ?? '') !== '' ? $a['seoTitle'] : ($a['title'] . ' — MGuliyev Studio');
    $description = ($a['seoDesc']  ?? '') !== '' ? $a['seoDesc']  : $a['desc'];
    break;
}
$current = 'blog';
$ogType = 'article';
/* Статья существует только на русском: заявлять в hreflang переводы,
   которых нет, — прямая ошибка для поисковика. */
$langOnly = ['ru'];
include __DIR__ . '/../../../app/partials/head.php';
include __DIR__ . '/../../../app/partials/article.php';
include __DIR__ . '/../../../app/partials/foot.php';
