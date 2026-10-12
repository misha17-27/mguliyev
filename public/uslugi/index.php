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
      <h1 class="disp h2">Услуги</h1>
      <p class="lb">4 направления · 24 услуги</p>
    </div>
    <p class="sub">Услуги можно взять по отдельности. Но когда домен, сайт, поиск и соцсети
      ведёт один подрядчик, не нужно сводить между собой разных исполнителей
      и выяснять, на чьей стороне поломка.</p>

    <?php $catalog = catalog(); ?>
    <div class="rows" style="margin-top:clamp(28px,4vw,52px)">
      <?php foreach ($catalog as $slug => $cat): ?>
      <a class="row" href="<?= u('/uslugi/' . $slug . '/') ?>">
        <span class="rname"><?= $cat['title'] ?></span>
        <span class="rdesc"><?= $cat['lead'] ?></span>
        <span class="rmeta">6 услуг</span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</main>
<?php include __DIR__ . '/../../app/partials/foot.php'; ?>
