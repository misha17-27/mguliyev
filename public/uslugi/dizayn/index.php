<?php
require __DIR__ . '/../../../app/bootstrap.php';
$page = 'dizayn';
$current = 'services';
include __DIR__ . '/../../../app/partials/head.php';
?>
<main id="top">
<section class="sec">
  <div class="wrap">
    <?php
      $catalog = catalog();
      $cat = $catalog['dizayn'];
    ?>
    <p class="lb"><a href="<?= u('/uslugi/') ?>">Услуги</a></p>
    <h1 class="disp h2" style="margin-block:18px 20px"><?= $cat['h1'] ?? $cat['title'] ?></h1>
    <p class="sub"><?= $cat['lead'] ?></p>

    <div class="rows" style="margin-top:clamp(28px,4vw,52px)">
      <?php foreach ($cat['items'] as $i => $it): ?>
      <a class="row" href="<?= u('/kontakty/') ?>">
        <span class="rname"><?= $it[0] ?></span>
        <span class="rdesc"><?= $it[1] ?></span>
        <span class="rmeta"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</main>
<?php include __DIR__ . '/../../../app/partials/foot.php'; ?>
