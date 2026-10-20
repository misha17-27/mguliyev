<?php
require __DIR__ . '/../../app/bootstrap.php';
$page = 'blog';
$current = 'blog';
include __DIR__ . '/../../app/partials/head.php';
$arts = articles();
?>
<main id="top">
<section class="sec">
  <div class="wrap">
    <div class="shead">
      <h1 class="disp h2"><?= t('blog.t1') ?></h1>
      <p class="lb"><?= tp(count($arts), 'blog.count_p') ?></p>
    </div>
    <p class="sub"><?= t('blog.t2') ?></p>
    <?php if (lang() !== 'ru'): ?>
      <p class="note" style="margin-top:14px"><?= htmlspecialchars(t('blog.ru_only')) ?></p>
    <?php endif; ?>
    <div class="posts" style="margin-top:clamp(28px,4vw,52px)">
      <?php foreach ($arts as $a): ?>
      <article class="post">
        <div class="pm"><span><?= htmlspecialchars($a['rubric']) ?></span><span><?= e($a['date']) ?> · <?= tn('blog.read', ['n' => (int)$a['read']]) ?></span></div>
        <h3><a href="<?= u('/blog/' . $a['slug'] . '/') ?>"><?= htmlspecialchars($a['title']) ?></a></h3>
        <p><?= htmlspecialchars($a['desc']) ?></p>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</main>
<?php include __DIR__ . '/../../app/partials/foot.php'; ?>
