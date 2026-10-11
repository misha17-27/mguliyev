<?php
$slug = 'pochemu-pisma-kompanii-uhodyat-v-spam';
/* Заголовок и описание берём из data/articles.php — это единственный источник.
   Раньше те же строки лежали ещё и здесь, и разошлись бы при первой правке. */
foreach (require __DIR__ . '/../../../app/data/articles.php' as $a) {
    if ($a['slug'] !== $slug) continue;
    $title       = $a['seoTitle'] ?? ($a['title'] . ' — MGuliyev Studio');
    $description = $a['seoDesc']  ?? $a['desc'];
    break;
}
$current = 'blog';
$ogType = 'article';
include __DIR__ . '/../../../app/partials/head.php';
include __DIR__ . '/../../../app/partials/article.php';
include __DIR__ . '/../../../app/partials/foot.php';
