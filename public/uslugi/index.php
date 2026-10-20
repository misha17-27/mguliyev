<?php
require __DIR__ . '/../../app/bootstrap.php';
$page = 'uslugi';
$current = 'services';
include __DIR__ . '/../../app/partials/head.php';
?>
<main id="top">
<section class="sec">
  <div class="wrap">
    <div class="shead">
      <h1 class="disp h2"><?= t('uslugi.t1') ?></h1>
      <p class="lb"><?= t('uslugi.t2') ?></p>
    </div>
    <p class="sub"><?= t('uslugi.t3') ?></p>

    <?php $catalog = catalog(); ?>
    <div class="rows" style="margin-top:clamp(28px,4vw,52px)">
      <?php foreach ($catalog as $slug => $cat): ?>
      <a class="row" href="<?= u('/uslugi/' . $slug . '/') ?>">
        <span class="rname"><?= e($cat['title']) ?></span>
        <span class="rdesc"><?= e($cat['lead']) ?></span>
        <span class="rmeta"><?= t('uslugi.t4') ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</main>
<?php include __DIR__ . '/../../app/partials/foot.php'; ?>
