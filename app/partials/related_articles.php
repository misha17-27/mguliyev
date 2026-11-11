<?php
/* Статьи блога по теме услуги — внизу страницы направления.

   Страница услуги ссылается на свои статьи, статья — на услугу (блок
   «Услуга студии по теме» под ней). Без этой связки статьи висели
   отдельно: из услуг на них не было ни одной ссылки, и поисковику
   было не видно, к какой услуге они относятся.

   Ждёт $svcSlug — направление каталога (veb-sayty, dizayn, …). Статей
   по нему нет — блока нет. */
$related = array_values(array_filter(articles(), static fn($a) => ($a['service'] ?? '') === ($svcSlug ?? '')));
if (!$related) return;
$related = array_slice($related, 0, 6);
?>
<section class="sec" style="padding-top:0">
  <div class="wrap">
    <div class="shead">
      <h2 class="disp h2"><?= t('blog.related') ?></h2>
      <a class="pill" href="<?= u('/blog/') ?>"><?= t('blog.all') ?></a>
    </div>
    <div class="posts">
      <?php foreach ($related as $a): ?>
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
