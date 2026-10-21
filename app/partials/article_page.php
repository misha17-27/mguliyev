<?php
/* Страница статьи блога целиком. Файл статьи в public/blog/<адрес>/
   задаёт только $slug и подключает этот.

   Раньше у каждой статьи был свой файл с одной и той же логикой, и в
   каждом стояло «статья только на русском». Теперь языки статьи
   определяются по данным: на каком языке есть текст, там она и есть.
   Добавили перевод в панели — статья появилась в hreflang и в карте
   сайта сама, без правки файлов. */
require __DIR__ . '/../bootstrap.php';

$current = 'blog';
$ogType  = 'article';

$art = null;
foreach (articles() as $a) {
    if ($a['slug'] === $slug) { $art = $a; break; }
}

if ($art === null) {
    http_response_code(404);
    $title       = I18n::raw('blog.nf') . ' — MGuliyev Studio';
    $description = I18n::raw('blog.nf');
    $robots      = 'noindex, follow';
    include __DIR__ . '/head.php';
    ?>
<main id="top">
<section class="sec">
  <div class="wrap">
    <h1 class="disp h2"><?= t('blog.nf') ?></h1>
    <p class="lb" style="margin-top:24px"><a href="<?= u('/blog/') ?>">← <?= t('blog.all') ?></a></p>
  </div>
</section>
</main>
<?php
    include __DIR__ . '/foot.php';
    return;
}

/* ?: а не ??: поле из панели приходит пустой строкой, а не null,
   и ?? пропускал её — страница получала пустой <title>, то есть
   в выдаче вместо заголовка стоял адрес. seoTitle и seoDesc здесь
   только на языке страницы (см. articles()): стёрли их в панели —
   берём заголовок статьи, а не текст для поиска с другого языка. */
$title       = ($art['seoTitle'] ?? '') !== '' ? $art['seoTitle'] : ($art['title'] . ' — MGuliyev Studio');
$description = ($art['seoDesc']  ?? '') !== '' ? $art['seoDesc']  : $art['desc'];

/* Языки, на которых у статьи есть текст. Объявлять в hreflang перевод,
   которого нет, — прямая ошибка для поисковика. А открытая на таком
   языке статья показывает русский текст под чужим адресом, поэтому
   в индекс она не идёт. */
$langOnly = [];
foreach (articles_canon() as $c) {
    if ($c['slug'] !== $slug) continue;
    foreach (langs() as $l) {
        if (!empty($c['body'][$l])) $langOnly[] = $l;
    }
}
if (!$langOnly) $langOnly = [deflang()];
if (!in_array(lang(), $langOnly, true)) $robots = 'noindex, follow';

/* Крошки для разметки schema.org: «Блог» над заголовком и сама статья. */
$crumbs = [[I18n::raw('nav.blog'), '/blog/'], [$art['title'], null]];

include __DIR__ . '/head.php';
include __DIR__ . '/article.php';
include __DIR__ . '/foot.php';
