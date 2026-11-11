<?php
/* Рендер одной статьи. Подключает app/partials/article_page.php:
   он уже нашёл статью ($art) и ответил 404, если её нет. */
if (empty($art)) return;
?>
<main id="top">
<article class="sec art">
  <div class="wrap">
    <p class="lb"><a href="<?= u('/blog/') ?>"><?= t('nav.blog') ?></a> · <?= htmlspecialchars($art['rubric']) ?></p>
    <h1 class="disp h2" style="margin-block:18px 16px"><?= htmlspecialchars($art['title']) ?></h1>
    <p class="art-meta"><?= date_h((string)$art['date']) ?> · <?= tn('blog.read_full', ['n' => (int)$art['read']]) ?></p>
    <?php if (!empty($art['cover'])): $cv = $art['cover']; ?>
      <figure class="art-fig">
        <img src="<?= e($cv['image']) ?>"<?= cover_srcset($cv['image'], '(max-width:1100px) 92vw, 1040px') ?> alt=""
             width="1200" height="750" fetchpriority="high">
        <figcaption><?= t('blog.photo') ?>: <a href="<?= e($cv['url']) ?>" target="_blank" rel="noopener nofollow"><?= e($cv['author']) ?></a> / Unsplash</figcaption>
      </figure>
    <?php endif; ?>
    <p class="art-lead"><?= nl2br(htmlspecialchars($art['lead'])) ?></p>

    <?php foreach ($art['body'] as $s): ?>
      <h2 class="art-h2"><?= htmlspecialchars($s[0]) ?></h2>
      <?php foreach (preg_split('/\n\n+/u', $s[1]) as $para): ?>
        <p class="art-p"><?= nl2br(htmlspecialchars(trim($para))) ?></p>
      <?php endforeach; ?>
    <?php endforeach; ?>

    <div class="art-end">
      <?php foreach (preg_split('/\n\n+/u', $art['end']) as $para): ?>
        <p class="art-p"><?= nl2br(htmlspecialchars(trim($para))) ?></p>
      <?php endforeach; ?>
    </div>

    <?php /* Статья про услугу студии — ссылка на её страницу. Только на
             направление из каталога: адрес не берётся из текста как есть. */
          $svc = catalog()[$art['service'] ?? ''] ?? null; ?>
    <?php if ($svc !== null): ?>
      <p class="art-svc"><span><?= t('blog.svc') ?></span>
        <a href="<?= u('/uslugi/' . $art['service'] . '/') ?>"><?= htmlspecialchars($svc['title']) ?> →</a></p>
    <?php endif; ?>

    <p class="lb" style="margin-top:clamp(34px,4vw,54px)"><a href="<?= u('/blog/') ?>">← <?= t('blog.all') ?></a></p>
  </div>
</article>

<?php /* «Читайте также» — три статьи по той же услуге: читатель уходит не
         с сайта, а в соседнюю тему, и между статьями есть ссылки, по которым
         поисковик видит, что они об одном. */
      $same = ($art['service'] ?? '') === '' ? [] : array_values(array_filter($arts ?? articles(),
          static fn($a) => ($a['service'] ?? '') === $art['service']));
      /* Следующие за этой, по кругу: так у каждой статьи направления есть
         входящие ссылки, а не только у первых трёх. */
      $more = [];
      $pos  = array_search($art['slug'], array_column($same, 'slug'), true);
      if ($pos !== false) {
          for ($k = 1; $k < min(4, count($same)); $k++) $more[] = $same[($pos + $k) % count($same)];
      } ?>
<?php if ($more): ?>
<section class="sec" style="padding-top:0">
  <div class="wrap">
    <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:clamp(18px,2.4vw,28px)"><?= t('blog.more') ?></h2>
    <div class="posts">
      <?php foreach ($more as $a): ?>
      <article class="post">
        <?php if (!empty($a['cover'])): ?>
          <a class="post-img" href="<?= u('/blog/' . $a['slug'] . '/') ?>" tabindex="-1" aria-hidden="true"><img src="<?= e($a['cover']['image']) ?>"<?= cover_srcset($a['cover']['image']) ?> alt="" loading="lazy" width="1200" height="750"></a>
        <?php endif; ?>
        <div class="pm"><span><?= htmlspecialchars($a['rubric']) ?></span><span><?= date_h((string)$a['date']) ?> · <?= tn('blog.read', ['n' => (int)$a['read']]) ?></span></div>
        <h3><a href="<?= u('/blog/' . $a['slug'] . '/') ?>"><?= htmlspecialchars($a['title']) ?></a></h3>
        <p><?= htmlspecialchars($a['desc']) ?></p>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>
</main>
