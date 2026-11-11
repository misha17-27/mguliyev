<?php
require __DIR__ . '/../../../app/bootstrap.php';
$page = 'marketing';
$current = 'services';
include __DIR__ . '/../../../app/partials/head.php';
$cat = catalog()['marketing'];
/* Reels-подписка — из пакетов на странице цен: сумма и состав правятся
   там же, в панели, и здесь не расходятся с ценами. */
$reels = null;
foreach (packs() as $p) if ($p[0] === 'reels') $reels = $p;
/* Цифры и обещания — те же, что на главной и в ценах (home.t23–t24,
   home.t125–t128, price.t12–t13, price.t19–t20). Цифры полосы — копии
   из этих строк (svc.mk.*, источник в комментарии в app/lang): меняются
   вместе. Отбивки — обёртками, как на «Веб-сайтах». */
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
  <div class="bcell"><b class="w"><?= t('svc.mk.b1v') ?></b><span><?= t('svc.mk.b1l') ?></span></div>
  <div class="bcell"><b class="w"><?= t('home.t24') ?></b><span><?= t('svc.mk.b2l') ?></span></div>
  <div class="bcell"><b class="w"><?= t('svc.mk.b3v') ?></b><span><?= t('svc.mk.b3l') ?></span></div>
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
      <h2 class="disp" style="<?= $h2 ?>"><?= t('svc.mk.h1') ?></h2>
      <p class="sub"><b>SEO.</b> <?= t('home.t23') ?></p>
      <ul class="plain" style="margin-top:clamp(20px,2.4vw,26px);max-width:64ch">
        <li><?= t('price.t12') ?></li>
        <li><?= t('price.t13') ?></li>
      </ul>
    </div>

    <?php if ($reels !== null): ?>
    <div style="<?= $gap ?>">
      <h2 class="disp" style="<?= $h2 ?>"><?= t('svc.mk.h2') ?></h2>
      <p class="sub"><b><?= e($reels[1]) ?></b> — <?= e($reels[2]) ?> <?= e($reels[3]) ?></p>
      <p class="sub" style="margin-top:12px"><?= e($reels[4]) ?></p>
      <?php if ($reels[5] !== ''): ?><p class="sub" style="margin-top:12px"><?= e($reels[5]) ?></p><?php endif; ?>
      <p style="margin-top:clamp(20px,2.4vw,28px)">
        <a class="btn btn-o" href="<?= u('/tseny/') ?>"><?= t('web.t38') ?></a></p>
    </div>
    <?php endif; ?>

    <div style="<?= $gap ?>">
      <h2 class="disp" style="<?= $h2 ?>"><?= t('web.t39') ?></h2>
      <div class="faq">
        <details><summary><?= t('home.t125') ?></summary><p><?= t('home.t126') ?></p></details>
        <details><summary><?= t('home.t127') ?></summary><p><?= t('home.t128') ?></p></details>
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
<?php $svcSlug = 'marketing'; include __DIR__ . '/../../../app/partials/related_articles.php'; ?>
</main>
<?php include __DIR__ . '/../../../app/partials/foot.php'; ?>
