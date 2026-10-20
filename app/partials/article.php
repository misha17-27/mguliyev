<?php
/* Рендер одной статьи. Страница задаёт $slug до подключения. */
$all = articles();
$art = null;
foreach ($all as $a) { if ($a['slug'] === $slug) { $art = $a; break; } }
if (!$art) { http_response_code(404); echo '<main class="sec"><div class="wrap"><h1 class="disp h2">Статья не найдена</h1></div></main>'; return; }
?>
<main id="top">
<article class="sec art">
  <div class="wrap">
    <p class="lb"><a href="<?= u('/blog/') ?>"><?= htmlspecialchars(t('nav.blog')) ?></a> · <?= htmlspecialchars($art['rubric']) ?></p>
    <h1 class="disp h2" style="margin-block:18px 16px"><?= htmlspecialchars($art['title']) ?></h1>
    <p class="art-meta"><?= e($art['date']) ?> · <?= tn('blog.read_full', ['n' => (int)$art['read']]) ?></p>
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

    <p class="lb" style="margin-top:clamp(34px,4vw,54px)"><a href="<?= u('/blog/') ?>">← <?= htmlspecialchars(t('blog.all')) ?></a></p>
  </div>
</article>
</main>
