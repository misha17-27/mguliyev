<?php
/* Портфолио: все работы (/portfolio/) и отдельная отрасль (/portfolio/logistika/).

   Один шаблон на оба адреса: страница отрасли — это то же портфолио,
   только с одной отраслью в сетке, своим заголовком и своим описанием
   для поиска. Отрасль определяется по пути запроса, а не по параметру:
   так одну страницу нельзя открыть под чужим адресом хвостом ?c=….

   Отрасли раньше работали фильтром на скрипте: кнопка прятала лишние
   карточки, а адрес оставался прежним. У отфильтрованного вида не было
   ни своего адреса, ни своего заголовка — поисковику он не существовал.
   Теперь у каждой отрасли своя страница. */
require __DIR__ . '/../../app/bootstrap.php';
$current = 'portfolio';

[$catSlug] = portfolio_route();
$groups = works_canon();
$cat = null;

/* Адрес, который маршрут не разобрал, — это не «все работы». Сюда его
   может прислать сервер, если в адресе что-то, что сервер прощает, а
   разбор здесь — нет. Показать под ним всё портфолио значило бы завести
   ещё одну страницу-двойник. */
$lost = $catSlug === null && I18n::path() !== '/portfolio/';

if ($catSlug !== null || $lost) {
    $cat = $lost ? null : portfolio_find($catSlug)['group'];
    if ($cat === null) {
        /* Нет такой отрасли — честный 404, а не пустая сетка с кодом 200:
           иначе поисковик сочтёт любой выдуманный адрес настоящей страницей. */
        http_response_code(404);
        $title = I18n::raw('portfolio.nf_h') . ' — MGuliyev Studio';
        $description = I18n::raw('portfolio.nf_p');
        $robots = 'noindex, follow';
        include __DIR__ . '/../../app/partials/head.php';
        ?>
<main id="top">
<section class="sec">
  <div class="wrap">
    <p class="lb"><a href="<?= e(portfolio_url()) ?>"><?= t('portfolio.crumb') ?></a></p>
    <h1 class="disp h2" style="margin-top:14px"><?= t('portfolio.nf_h') ?></h1>
    <p class="sub" style="margin-top:16px"><?= t('portfolio.nf_p') ?></p>
    <p style="margin-top:24px"><a class="btn" href="<?= e(portfolio_url()) ?>"><?= t('portfolio.all_works') ?></a></p>
  </div>
</section>
</main>
<?php
        include __DIR__ . '/../../app/partials/foot.php';
        exit;
    }
    $seo = portfolio_seo($cat);
    $title = $seo['title'];
    $description = $seo['description'];
} else {
    $page = 'portfolio';
}

include __DIR__ . '/../../app/partials/head.php';

/* Проекты в сетке: все или одной отрасли. */
$items = [];
foreach ($groups as $g) {
    if ($cat !== null && $g['slug'] !== $cat['slug']) continue;
    foreach ($g['projects'] as $w) $items[] = [$g, $w];
}

$shown = 0; $dead = 0; $covers = 0;
foreach ($groups as $g) {
    foreach ($g['projects'] as $w) {
        $shown++;
        if (!empty($w['archived'])) $dead++;
        if (!empty($w['image'])) $covers++;
    }
}
$total = $shown;

/* Склонение живёт в app/i18n.php: правила у трёх языков разные,
   и формы хранятся в словаре, а не в шаблоне. */
$unit = static fn(int $n): string => plural($n, 'units.project');
?>
<main id="top">
<section class="sec">
  <div class="wrap">
    <?php if ($cat !== null): ?>
      <p class="lb"><a href="<?= e(portfolio_url()) ?>"><?= t('portfolio.crumb') ?></a></p>
    <?php endif; ?>
    <div class="shead">
      <h1 class="disp h2"><?= $cat !== null ? e(tr($cat['name'])) : t('portfolio.t1') ?></h1>
      <p class="lb"><?= $cat !== null
        ? tn('portfolio.in_cat', ['n' => count($items), 'u' => $unit(count($items))])
        : tn('portfolio.since', ['n' => $total, 'u' => $unit($total)]) ?></p>
    </div>

    <?php if ($cat !== null): ?>
      <p class="sub"><?= e(tr($cat['desc'])) ?></p>
      <?php
      /* Текст отрасли из панели — абзацами. Пусто — ничего не выводим:
         выдумывать вступление за заказчика не будем. */
      $intro = tr($cat['intro'] ?? []);
      if ($intro !== ''):
        foreach (preg_split('/\n\s*\n/u', $intro) as $para): ?>
          <p class="sub" style="margin-top:14px"><?= nl2br(e(trim($para))) ?></p>
      <?php endforeach; endif; ?>
    <?php else: ?>
      <p class="sub"><?= t('portfolio.t2') ?></p>
    <?php endif; ?>

    <?php /* Отрасли — ссылками на свои страницы. Текущая отмечена
             aria-current: читалка с экрана объявит, где человек находится. */ ?>
    <nav class="wnav" aria-label="<?= t('portfolio.t12') ?>">
      <a class="wf<?= $cat === null ? ' is-on' : '' ?>" href="<?= e(portfolio_url()) ?>"<?= $cat === null ? ' aria-current="page"' : '' ?>>
        <?= t('portfolio.t3') ?> <i><?= $total ?></i></a>
      <?php foreach ($groups as $g): $on = $cat !== null && $g['slug'] === $cat['slug']; ?>
        <a class="wf<?= $on ? ' is-on' : '' ?>" href="<?= e(portfolio_url($g['slug'])) ?>"<?= $on ? ' aria-current="page"' : '' ?>>
          <?= e(tr($g['name'])) ?> <i><?= count($g['projects']) ?></i></a>
      <?php endforeach; ?>
    </nav>

    <div class="works" id="wgrid" style="margin-top:clamp(24px,3vw,38px)">
      <?php foreach ($items as [$g, $w]):
        $isDead = !empty($w['archived']);
        $name   = tr($w['desc']);
      ?>
      <a class="work<?= $isDead ? ' work-dead' : '' ?>" href="<?= e(portfolio_url($g['slug'], project_slug($w['domain']))) ?>">
        <div class="cover">
          <img class="media" src="<?= e(project_cover($w, $g)) ?>" alt="<?= e($name) ?> — <?= e($w['domain']) ?>"
               loading="lazy" width="1200" height="750">
          <?php if ($isDead): ?><span class="work-badge"><?= t('portfolio.t4') ?></span><?php endif; ?>
        </div>
        <h3><?= e($name) ?></h3>
        <div class="wmeta"><span><?= e(tr($g['name'])) ?></span><b><?= e($w['domain']) ?></b></div>
      </a>
      <?php endforeach; ?>
    </div>

    <?php if ($cat === null): ?>
    <div style="margin-top:clamp(48px,6vw,84px);display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:clamp(20px,3vw,40px)">
      <div>
        <h2 class="disp" style="font-size:clamp(1.3rem,2.4vw,1.7rem);margin-bottom:12px"><?= t('portfolio.t6') ?></h2>
        <p class="sub" style="font-size:.9rem"><?= tp($dead, 'portfolio.arch_p') ?></p>
      </div>
      <div>
        <h2 class="disp" style="font-size:clamp(1.3rem,2.4vw,1.7rem);margin-bottom:12px"><?= t('portfolio.t7') ?></h2>
        <p class="sub" style="font-size:.9rem"><?= tn('portfolio.list_p', ['n' => $shown]) ?></p>
      </div>
      <div>
        <h2 class="disp" style="font-size:clamp(1.3rem,2.4vw,1.7rem);margin-bottom:12px"><?= t('portfolio.t8') ?></h2>
        <p class="sub" style="font-size:.9rem"><?= tp($covers, 'portfolio.covers_p', ['m' => $shown - $covers]) ?></p>
      </div>
    </div>
    <?php endif; ?>

    <div style="margin-top:clamp(44px,5vw,72px);padding-top:clamp(24px,3vw,36px);border-top:1px solid var(--line)">
      <h2 class="disp h2"><?= t('portfolio.t9') ?></h2>
      <p class="sub" style="margin-top:16px"><?= t('portfolio.t10') ?></p>
      <p style="margin-top:22px"><a class="btn" href="<?= u('/kontakty/') ?>"><?= t('portfolio.t11') ?></a></p>
    </div>
  </div>
</section>
</main>
<?php include __DIR__ . '/../../app/partials/foot.php'; ?>
