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

    <p class="lb" style="margin-top:clamp(34px,4vw,54px)"><a href="<?= u('/blog/') ?>">← <?= t('blog.all') ?></a></p>
  </div>
</article>
</main>
