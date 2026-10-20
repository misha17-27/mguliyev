<?php
require __DIR__ . '/../../app/bootstrap.php';
$page = 'portfolio';
$current = 'portfolio';
include __DIR__ . '/../../app/partials/head.php';
$groups = works();

$shown = 0; $dead = 0; $covers = 0;
foreach ($groups as $g) {
    $shown += count($g[3]);
    foreach ($g[3] as $w) {
        if (!empty($w[3])) $dead++;
        if (!empty($w[2])) $covers++;
    }
}
/* Число берётся из данных, а не вписывается руками: раньше оно разъезжалось
   со страницей при каждом изменении списка. Показываем всё, что знаем. */
$total = $shown;

/* Сетка одна на все проекты, а отрасли работают фильтром поверх неё:
   при заходе заказчик должен увидеть объём целиком, и только потом сужать. */
$items = [];
foreach ($groups as $i => $g) {
    foreach ($g[3] as $w) { $items[] = [$i, $g, $w]; }
}

/* Склонение после числа: 1 проект, 2 проекта, 5 проектов. */
function pl($n, $one, $few, $many) {
    $n = abs($n) % 100; $d = $n % 10;
    if ($n > 10 && $n < 20) return $many;
    if ($d > 1 && $d < 5)   return $few;
    if ($d === 1)           return $one;
    return $many;
}
?>
<main id="top">
<section class="sec">
  <div class="wrap">
    <div class="shead">
      <h1 class="disp h2"><?= t('portfolio.t1') ?></h1>
      <p class="lb">с 2017 года · <?= $total ?> <?= pl($total, 'проект', 'проекта', 'проектов') ?></p>
    </div>
    <p class="sub"><?= t('portfolio.t2') ?></p>

    <nav class="wnav" aria-label="<?= t('portfolio.t12') ?>">
      <button type="button" class="wf is-on" data-f="all" aria-pressed="true"><?= t('portfolio.t3') ?> <i><?= $shown ?></i></button>
      <?php foreach ($groups as $i => $g): ?>
        <button type="button" class="wf" data-f="g<?= $i ?>" aria-pressed="false"><?= $g[0] ?> <i><?= count($g[3]) ?></i></button>
      <?php endforeach; ?>
    </nav>

    <p class="wf-live lb" role="status" aria-live="polite">Показаны все <?= $shown ?> <?= pl($shown, 'проект', 'проекта', 'проектов') ?></p>

    <div class="works" id="wgrid">
      <?php foreach ($items as $it):
        list($gi, $g, $w) = $it;
        $isDead = !empty($w[3]);
        $img = $w[2] ?: '/images/groups/' . $g[2] . '.svg';
        $tag = $isDead ? 'div' : 'a';
      ?>
      <<?= $tag ?> class="work<?= $isDead ? ' work-dead' : '' ?>" data-g="g<?= $gi ?>"<?= $isDead ? '' : ' href="https://' . $w[0] . '" target="_blank" rel="noopener"' ?>>
        <div class="cover">
          <img class="media" src="<?= $img ?>" alt="<?= strip_tags($w[1]) ?> — <?= $w[0] ?>" loading="lazy" width="1200" height="750">
          <?php if ($isDead): ?><span class="work-badge"><?= t('portfolio.t4') ?></span><?php endif; ?>
        </div>
        <h3><?= $w[1] ?></h3>
        <div class="wmeta"><span><?= $g[0] ?></span><b><?= $w[0] ?></b></div>
      </<?= $tag ?>>
      <?php endforeach; ?>
    </div>

    <p class="wf-none sub" hidden><?= t('portfolio.t5') ?></p>

    <div style="margin-top:clamp(48px,6vw,84px);display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:clamp(20px,3vw,40px)">
      <div>
        <h2 class="disp" style="font-size:clamp(1.3rem,2.4vw,1.7rem);margin-bottom:12px"><?= t('portfolio.t6') ?></h2>
        <p class="sub" style="font-size:.9rem"><?= $dead ?> <?= pl($dead, 'домен', 'домена', 'доменов') ?>
          сейчас не <?= pl($dead, 'открывается', 'открываются', 'открываются') ?> или <?= pl($dead, 'отдаёт', 'отдают', 'отдают') ?>
          пустую страницу. Мы не убираем такие проекты из портфолио — работа была сделана. Но и ссылку не ставим:
          вместо неё пометка «архив». Заработает сайт — вернём ссылку.</p>
      </div>
      <div>
        <h2 class="disp" style="font-size:clamp(1.3rem,2.4vw,1.7rem);margin-bottom:12px"><?= t('portfolio.t7') ?></h2>
        <p class="sub" style="font-size:.9rem">Все <?= $shown ?>, которые мы готовы показать поимённо:
          с доменом и строкой о сфере деятельности. Список пополняется —
          проект попадает сюда, когда проверены адрес и чем занимается заказчик,
          а не когда его просто вспомнили.</p>
      </div>
      <div>
        <h2 class="disp" style="font-size:clamp(1.3rem,2.4vw,1.7rem);margin-bottom:12px"><?= t('portfolio.t8') ?></h2>
        <p class="sub" style="font-size:.9rem">У <?= $covers ?> <?= pl($covers, 'проекта', 'проектов', 'проектов') ?>
          стоят снимки самих сайтов, у остальных <?= $shown - $covers ?> — отраслевая подложка.
          Скриншоты добавляются по одному, без правки вёрстки.</p>
      </div>
    </div>

    <div style="margin-top:clamp(44px,5vw,72px);padding-top:clamp(24px,3vw,36px);border-top:1px solid var(--line)">
      <h2 class="disp h2"><?= t('portfolio.t9') ?></h2>
      <p class="sub" style="margin-top:16px"><?= t('portfolio.t10') ?></p>
      <p style="margin-top:22px"><a class="btn" href="<?= u('/kontakty/') ?>"><?= t('portfolio.t11') ?></a></p>
    </div>
  </div>
</section>
</main>
<?php include __DIR__ . '/../../app/partials/foot.php'; ?>
