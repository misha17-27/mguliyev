<?php
$page = 'blog';
$current = 'blog';
include __DIR__ . '/../../app/partials/head.php';
$arts = require __DIR__ . '/../../app/data/articles.php';
?>
<main id="top">
<section class="sec">
  <div class="wrap">
    <div class="shead">
      <h1 class="disp h2">Блог</h1>
      <p class="lb"><?= count($arts) ?> статьи</p>
    </div>
    <p class="sub">Разбираем то, о чём чаще всего спрашивают на брифах. Без кейсов и обещаний — только техника, которую можно проверить самому.</p>
    <div class="posts" style="margin-top:clamp(28px,4vw,52px)">
      <?php foreach ($arts as $a): ?>
      <article class="post">
        <div class="pm"><span><?= htmlspecialchars($a['rubric']) ?></span><span><?= htmlspecialchars($a['date']) ?> · <?= (int)$a['read'] ?> мин</span></div>
        <h3><a href="/blog/<?= $a['slug'] ?>/"><?= htmlspecialchars($a['title']) ?></a></h3>
        <p><?= htmlspecialchars($a['desc']) ?></p>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</main>
<?php include __DIR__ . '/../../app/partials/foot.php'; ?>
