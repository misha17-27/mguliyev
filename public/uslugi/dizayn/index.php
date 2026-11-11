<?php
require __DIR__ . '/../../../app/bootstrap.php';
$page = 'dizayn';
$current = 'services';
include __DIR__ . '/../../../app/partials/head.php';
$cat = catalog()['dizayn'];
/* Факты — те же, что в ценах (price.t9, price.t14, price.t19–t20,
   web.t50–t51): своих страница не вводит. Отбивки — обёртками, как на «Веб-сайтах». */
$gap = 'margin-top:clamp(40px,5vw,68px)';
$h2  = 'font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:16px';
?>
<main id="top">
<section class="sec">
  <div class="wrap">
    <p class="lb"><a href="<?= u('/uslugi/') ?>"><?= t('nav.services') ?></a></p>
    <h1 class="disp h2" style="margin-block:18px 20px"><?= e($cat['h1'] !== '' ? $cat['h1'] : $cat['title']) ?></h1>
    <p class="sub"><?= e($cat['lead']) ?></p>
    <p style="margin-top:clamp(24px,3vw,34px);display:flex;flex-wrap:wrap;gap:12px">
      <a class="btn" href="<?= u('/kontakty/') . '#zayavka' ?>"><?= t('web.t3') ?></a>
      <a class="btn btn-o" href="<?= u('/tseny/') ?>"><?= t('web.t38') ?></a>
    </p>

    <div class="rows" style="margin-top:clamp(28px,4vw,52px)">
      <?php foreach ($cat['items'] as $i => $it): ?>
      <a class="row" href="<?= u('/kontakty/') ?>">
        <span class="rname"><?= e($it[0]) ?></span>
        <span class="rdesc"><?= e($it[1]) ?></span>
        <span class="rmeta"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></span>
      </a>
      <?php endforeach; ?>
    </div>

    <div style="<?= $gap ?>">
      <h2 class="disp" style="<?= $h2 ?>"><?= t('price.t9') ?></h2>
      <p class="sub"><?= t('price.t14') ?><?php if (s('price_design') !== ''): ?> <span class="note"><?= e(s('price_design')) ?></span><?php endif; ?></p>
    </div>

    <div style="<?= $gap ?>">
      <h2 class="disp" style="<?= $h2 ?>"><?= t('web.t39') ?></h2>
      <div class="faq">
        <details><summary><?= t('price.t19') ?></summary><p><?= t('price.t20') ?></p></details>
        <details><summary><?= t('web.t50') ?></summary><p><?= t('web.t51') ?></p></details>
      </div>
    </div>

    <div style="margin-top:clamp(44px,5vw,72px);padding-top:clamp(24px,3vw,36px);border-top:1px solid var(--line)">
      <h2 class="disp h2"><?= t('web.t52') ?></h2>
      <p class="sub" style="margin-top:16px"><?= t('web.t53') ?></p>
      <p style="margin-top:22px;display:flex;flex-wrap:wrap;gap:12px">
        <a class="btn" href="<?= u('/kontakty/') . '#zayavka' ?>"><?= t('web.t54') ?></a>
        <a class="btn btn-o" href="<?= e(tel_href()) ?>"><?= e(sv('phone')) ?></a></p>
    </div>
  </div>
</section>
<?php $svcSlug = 'dizayn'; include __DIR__ . '/../../../app/partials/related_articles.php'; ?>
</main>
<?php include __DIR__ . '/../../../app/partials/foot.php'; ?>
