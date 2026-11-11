<?php
require __DIR__ . '/../../../app/bootstrap.php';
$page = 'podderzhka';
$current = 'services';
include __DIR__ . '/../../../app/partials/head.php';
$cat = catalog()['podderzhka'];
/* Цифры и обещания — те же, что на главной, в ценах и контактах
   (home.t26–t29, home.t117, home.t121–t124, price.t4–t11, contacts.t13).
   Цифры полосы — копии из этих строк (svc.pd.*, источник в комментарии
   в app/lang): меняются вместе. Отбивки — обёртками, как на «Веб-сайтах». */
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
  </div>
</section>

<section class="band">
  <div class="bcell"><b class="w"><?= t('home.t27') ?></b><span><?= t('svc.pd.b1l') ?></span></div>
  <div class="bcell"><b class="w"><?= t('svc.pd.b2v') ?></b><span><?= t('svc.pd.b2l') ?></span></div>
  <div class="bcell"><b class="w"><?= t('svc.pd.b3v') ?></b><span><?= t('svc.pd.b3l') ?></span></div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="rows">
      <?php foreach ($cat['items'] as $i => $it): ?>
      <a class="row" href="<?= u('/kontakty/') ?>">
        <span class="rname"><?= e($it[0]) ?></span>
        <span class="rdesc"><?= e($it[1]) ?></span>
        <span class="rmeta"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></span>
      </a>
      <?php endforeach; ?>
    </div>

    <div style="<?= $gap ?>">
      <h2 class="disp" style="<?= $h2 ?>"><?= t('svc.pd.h1') ?></h2>
      <ul class="plain" style="max-width:64ch">
        <li><b><?= t('home.t28') ?>.</b> <?= t('home.t29') ?></li>
        <li><b><?= t('home.t25') ?>.</b> <?= t('home.t26') ?></li>
      </ul>
    </div>

    <div style="<?= $gap ?>">
      <h2 class="disp" style="<?= $h2 ?>"><?= t('price.t4') ?></h2>
      <ul class="plain" style="max-width:64ch">
        <li><?= t('price.t5') ?></li>
        <li><?= t('price.t7') ?></li>
        <li><?= t('price.t8') ?></li>
      </ul>
    </div>

    <div style="<?= $gap ?>">
      <h2 class="disp" style="<?= $h2 ?>"><?= t('price.t9') ?></h2>
      <ul class="plain" style="max-width:64ch">
        <li><?= t('price.t10') ?><?php if (s('price_renewal') !== ''): ?> <span class="note"><?= e(s('price_renewal')) ?></span><?php endif; ?></li>
        <li><?= t('price.t11') ?><?php if (s('price_support') !== ''): ?> <span class="note"><?= e(s('price_support')) ?></span><?php endif; ?></li>
      </ul>
    </div>

    <div style="<?= $gap ?>">
      <h2 class="disp" style="<?= $h2 ?>"><?= t('svc.pd.h2') ?></h2>
      <p class="sub"><?= t('contacts.t3') ?>: <a href="mailto:<?= e(s('email')) ?>"><?= e(sv('email')) ?></a></p>
      <p class="sub" style="margin-top:12px"><?= t('contacts.t13') ?></p>
      <p style="margin-top:clamp(20px,2.4vw,28px)">
        <a class="btn btn-o" href="<?= u('/kontakty/') ?>"><?= t('svc.pd.contacts') ?></a></p>
    </div>

    <div style="<?= $gap ?>">
      <h2 class="disp" style="<?= $h2 ?>"><?= t('web.t39') ?></h2>
      <div class="faq">
        <details><summary><?= t('home.t121') ?></summary><p><?= t('home.t122') ?></p></details>
        <details><summary><?= t('home.t123') ?></summary><p><?= t('home.t124') ?></p></details>
        <details><summary><?= t('price.t21') ?></summary><p><?= t('price.t22') ?></p></details>
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
<?php $svcSlug = 'podderzhka'; include __DIR__ . '/../../../app/partials/related_articles.php'; ?>
</main>
<?php include __DIR__ . '/../../../app/partials/foot.php'; ?>
