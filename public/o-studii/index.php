<?php
require __DIR__ . '/../../app/bootstrap.php';
$page = 'about';
$current = 'about';
include __DIR__ . '/../../app/partials/head.php';
$catalog = catalog();
$wc = works_count();   // число проектов — из данных портфолио, не из текста
?>
<main id="top">
<section class="sec">
  <div class="wrap">
    <div class="shead">
      <h1 class="disp h2"><?= t('about.t1') ?></h1>
      <p class="lb"><?= t('about.t2') ?></p>
    </div>
    <p class="about-lead" style="margin-top:8px"><?= t('about.t3') ?></p>
    <p class="sub" style="margin-top:22px"><?= tn('about.t4', ['n' => $wc['n'], 'u' => plural($wc['n'], 'units.project')]) ?></p>
    <p class="sub"><?= t('about.t5') ?></p>

    <div style="margin-top:clamp(40px,5vw,68px)">
      <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:16px"><?= t('about.t6') ?></h2>
      <p class="sub"><?= t('about.t7') ?></p>
      <p class="sub"><?= t('about.t8') ?></p>
    </div>

    <div class="rows" style="margin-top:clamp(30px,4vw,48px)">
      <?php foreach ($catalog as $slug => $cat): ?>
      <a class="row" href="<?= u('/uslugi/' . $slug . '/') ?>">
        <span class="rname"><?= e($cat['title']) ?></span>
        <span class="rdesc"><?= e(implode(' · ', array_map(fn($i) => $i[0], $cat['items']))) ?></span>
        <span class="rmeta"><?= t('about.t9') ?></span>
      </a>
      <?php endforeach; ?>
    </div>

    <div class="band" style="margin-top:clamp(40px,5vw,68px)">
      <div class="bcell"><b>2017</b><span><?= t('about.t10') ?></span></div>
      <div class="bcell"><b><?= $wc['n'] ?></b><span><?= t('about.t11') ?></span></div>
      <div class="bcell"><b>24</b><span><?= t('about.t12') ?></span></div>
    </div>

    <div style="margin-top:clamp(40px,5vw,68px)">
      <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:20px"><?= t('about.t13') ?></h2>
      <div class="princ" style="margin-top:0">
        <div>
          <h3><?= t('about.t14') ?></h3>
          <p><?= t('about.t15') ?></p>
        </div>
        <div>
          <h3><?= t('about.t16') ?></h3>
          <p><?= t('about.t17') ?></p>
        </div>
        <div>
          <h3><?= t('about.t18') ?></h3>
          <p><?= t('about.t19') ?></p>
        </div>
      </div>
    </div>

    <div style="margin-top:clamp(40px,5vw,68px)">
      <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:16px"><?= t('about.t20') ?></h2>
      <p class="sub" style="font-size:.9rem"><?= t('about.t21') ?></p>
      <div class="stack" style="margin-top:18px">
        <i>WordPress</i><i>WooCommerce</i><i>Elementor</i><i>ACF</i><i>WPML</i><i>Yoast SEO</i><i>Figma</i><i>Photoshop</i><i>Illustrator</i><i>Google Analytics</i><i>Search Console</i><i>Cloudflare</i><i>Premiere Pro</i><i>After Effects</i><i>Meta Business Suite</i>
      </div>
    </div>

    <div style="margin-top:clamp(40px,5vw,68px)">
      <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:16px"><?= t('about.t22') ?></h2>
      <p class="sub"><?= t('about.t23') ?>
        <a href="<?= u('/') ?>#process"><?= t('about.t24') ?></a>.</p>
    </div>

    <div style="margin-top:clamp(44px,5vw,72px);padding-top:clamp(24px,3vw,36px);border-top:1px solid var(--line)">
      <h2 class="disp h2"><?= t('about.t25') ?></h2>
      <p class="sub" style="margin-top:16px"><?= t('about.t26') ?></p>
      <p style="margin-top:22px"><a class="btn" href="<?= u('/kontakty/') ?>"><?= t('about.t27') ?></a>
        <a class="btn btn-o" href="<?= u('/portfolio/') ?>" style="margin-left:10px"><?= t('about.t28') ?></a></p>
    </div>
  </div>
</section>
</main>
<?php include __DIR__ . '/../../app/partials/foot.php'; ?>
