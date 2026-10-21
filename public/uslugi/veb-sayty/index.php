<?php
require __DIR__ . '/../../../app/bootstrap.php';
$page = 'veb-sayty';
$current = 'services';
include __DIR__ . '/../../../app/partials/head.php';
$catalog = catalog();
$cat = $catalog['veb-sayty'];
$wc = works_count();   // число проектов и снимков — из данных портфолио, не из текста

/* Главная посадочная по коммерческой цели студии. Цифры 49/48/36 и суммы
   пакетов повторяются в app/data/seo.php и на /tseny/ — при изменении править
   вместе, иначе сниппет в поиске разойдётся со страницей.
   В style.css у абзацев margin:0, поэтому отбивка между блоками задаётся
   обёртками, а не полями у текста. */
$gap = 'margin-top:clamp(40px,5vw,68px)';
$h2  = 'font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:16px';
$lnk = 'color:var(--duo-b)';
?>
<main id="top">
<section class="sec">
  <div class="wrap">
    <p class="lb"><a href="<?= u('/uslugi/') ?>"><?= t('web.t1') ?></a></p>
    <h1 class="disp h2" style="margin-block:18px 20px"><?= e($cat['h1'] !== '' ? $cat['h1'] : $cat['title']) ?></h1>
    <p class="sub"><?= t('web.t2') ?></p>
    <p style="margin-top:clamp(24px,3vw,34px);display:flex;flex-wrap:wrap;gap:12px">
      <a class="btn" href="<?= u('/kontakty/') ?>"><?= t('web.t3') ?></a>
      <a class="btn btn-o" href="<?= u('/portfolio/') ?>"><?= t('web.t4') ?></a>
    </p>
  </div>
</section>

<section class="band">
  <div class="bcell"><b data-count="6">6</b><span><?= t('web.t5') ?></span></div>
  <div class="bcell"><b>10–25</b><span><?= t('web.t6') ?></span></div>
  <div class="bcell"><b>₼700</b><span><?= t('web.t7') ?></span></div>
</section>

<section class="sec">
  <div class="wrap">

    <div class="shead">
      <h2 class="disp" style="<?= $h2 ?>"><?= t('web.t8') ?></h2>
      <p class="lb"><?= t('web.t9') ?></p>
    </div>
    <p class="sub"><?= t('web.t10') ?></p>

    <div class="rows" style="margin-top:clamp(24px,3vw,38px)">
      <?php foreach ($cat['items'] as $i => $it): ?>
      <a class="row" href="<?= u('/kontakty/') ?>">
        <span class="rname"><?= e($it[0]) ?></span>
        <span class="rdesc"><?= e($it[1]) ?></span>
        <span class="rmeta"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></span>
      </a>
      <?php endforeach; ?>
    </div>

    <p class="sub" style="margin-top:clamp(20px,2.6vw,30px);font-size:.9rem"><?= t('web.t11') ?></p>

    <div style="<?= $gap ?>">
      <h2 class="disp" style="<?= $h2 ?>"><?= t('web.t12') ?></h2>
      <p class="sub"><?= t('web.t13') ?></p>
      <div class="stack">
        <i><?= t('web.t14') ?></i><i><?= t('web.t15') ?></i><i><?= t('web.t16') ?></i>
        <i><?= t('web.t17') ?></i><i><?= t('web.t18') ?></i>
      </div>
      <p class="sub" style="margin-top:clamp(22px,2.8vw,30px)"><?= t('web.t19') ?></p>
      <ul class="plain" style="margin-top:clamp(20px,2.4vw,26px)">
        <li><?= t('web.t20') ?></li>
        <li><?= t('web.t21') ?></li>
        <li><?= t('web.t22') ?></li>
        <li><?= t('web.t23') ?></li>
      </ul>
      <p class="sub" style="margin-top:clamp(18px,2.2vw,24px);font-size:.9rem"><?= t('web.t24') ?> <a href="<?= u('/tseny/') ?>" style="<?= $lnk ?>"><?= t('web.t25') ?></a>.</p>
    </div>

    <div style="<?= $gap ?>">
      <h2 class="disp" style="<?= $h2 ?>"><?= t('web.t26') ?></h2>
      <p class="sub"><?= tn('web.t27', ['n' => $wc['n'], 'u' => plural($wc['n'], 'units.project'), 'm' => $wc['covers']]) ?></p>
      <p style="margin-top:clamp(20px,2.4vw,28px)">
        <a class="btn btn-o" href="<?= u('/portfolio/') ?>"><?= t('web.t28') ?></a></p>
    </div>

    <div style="<?= $gap ?>">
      <h2 class="disp" style="<?= $h2 ?>"><?= t('web.t29') ?></h2>
      <p class="sub"><?= t('web.t30') ?></p>
      <ul class="plain" style="margin-top:clamp(20px,2.4vw,26px);max-width:64ch">
        <li><b><?= t('web.t31') ?></b> <?= t('web.t32') ?></li>
        <li><b><?= t('web.t33') ?></b> <?= t('web.t34') ?></li>
        <li><b><?= t('web.t35') ?></b> <?= t('web.t36') ?></li>
      </ul>
      <p class="sub" style="margin-top:clamp(18px,2.2vw,24px)"><?= t('web.t37') ?></p>
      <p style="margin-top:clamp(20px,2.4vw,28px)">
        <a class="btn btn-o" href="<?= u('/tseny/') ?>"><?= t('web.t38') ?></a></p>
    </div>

    <div style="<?= $gap ?>">
      <h2 class="disp" style="<?= $h2 ?>"><?= t('web.t39') ?></h2>
      <div class="faq">
        <details><summary><?= t('web.t40') ?></summary>
          <p><?= t('web.t41') ?></p></details>
        <details><summary><?= t('web.t42') ?></summary>
          <p><?= t('web.t43') ?>
            <a href="<?= u('/uslugi/marketing/') ?>" style="<?= $lnk ?>"><?= t('web.t44') ?></a><?= t('web.t45') ?></p></details>
        <details><summary><?= t('web.t46') ?></summary>
          <p><?= t('web.t47') ?></p></details>
        <details><summary><?= t('web.t48') ?></summary>
          <p><?= t('web.t49') ?></p></details>
        <details><summary><?= t('web.t50') ?></summary>
          <p><?= t('web.t51') ?></p></details>
      </div>
    </div>

    <div style="margin-top:clamp(44px,5vw,72px);padding-top:clamp(24px,3vw,36px);border-top:1px solid var(--line)">
      <h2 class="disp h2"><?= t('web.t52') ?></h2>
      <p class="sub" style="margin-top:16px"><?= t('web.t53') ?></p>
      <p style="margin-top:22px;display:flex;flex-wrap:wrap;gap:12px">
        <a class="btn" href="<?= u('/kontakty/') ?>"><?= t('web.t54') ?></a>
        <a class="btn btn-o" href="<?= e(tel_href()) ?>"><?= e(sv('phone')) ?></a></p>
    </div>

  </div>
</section>
</main>
<?php include __DIR__ . '/../../../app/partials/foot.php'; ?>
