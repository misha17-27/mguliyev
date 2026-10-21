<?php
/* Страница проекта: /portfolio/logistika/itas-az/.

   НА СТРАНИЦЕ ТОЛЬКО ТО, ЧТО ИЗВЕСТНО. Чем занимается заказчик, снимок
   сайта, отрасль, ссылка на сайт. Рассказ о задаче и о том, что было
   сделано, выводится, только если его вписали в панели: выдумывать
   кейс за заказчика — это ровно то, чего на этом сайте нет нигде.

   Если проект перенесли в другую отрасль или сменили ему домен, старый
   адрес ведёт на новый постоянным редиректом: на старый уже могли
   сослаться, и поисковик должен перенести вес страницы, а не потерять его.

   Редирект — с коротким сроком в кеше браузера. Постоянный редирект без
   срока браузер помнит вечно, и если проект вернут обратно, у того, кто
   видел первый переезд, адреса будут гонять его по кругу. Поисковику
   срок не мешает: для него 301 всё равно постоянный. */
require __DIR__ . '/../../app/bootstrap.php';
$current = 'portfolio';

[$catSlug, $projSlug] = portfolio_route();
$f = portfolio_find($catSlug, $projSlug);

if ($f['project'] !== null && ($f['cat'] !== $catSlug || $f['slug'] !== $projSlug)) {
    header('Cache-Control: max-age=3600');
    header('Location: ' . portfolio_url($f['cat'], $f['slug']), true, 301);
    exit;
}

if ($f['project'] === null) {
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

$g = $f['group'];
$w = $f['project'];
$isDead = !empty($w['archived']);
$name   = tr($w['desc']);
$cname  = tr($g['name']);
$text   = tr($w['text'] ?? []);

$seo = portfolio_seo($g, $w);
$title = $seo['title'];
$description = $seo['description'];
/* Картинка для соцсетей — снимок проекта. Без снимка обложкой служит
   отраслевая подложка в SVG, а соцсети SVG не показывают: ссылка ушла бы
   без превью. Тогда берём общую обложку студии. */
$ogImage = !empty($w['image']) && !preg_match('~\.svg$~i', $w['image']) ? $w['image'] : null;
/* Крошки для разметки schema.org — те же, что видны над заголовком. */
$crumbs = [[I18n::raw('portfolio.crumb'), '/portfolio/'], [$cname, '/portfolio/' . $g['slug'] . '/'],
           [$name !== '' ? $name : $w['domain'], null]];

include __DIR__ . '/../../app/partials/head.php';

/* Соседи по отрасли — до шести, без самого проекта. Сначала те, у кого
   есть снимок сайта: карточка с подложкой выглядит пустой. */
$more = array_values(array_filter($g['projects'], static fn($x) => $x['domain'] !== $w['domain']));
usort($more, static fn($a, $b) => (empty($a['image']) <=> empty($b['image'])));
$more = array_slice($more, 0, 6);
?>
<main id="top">
<section class="sec">
  <div class="wrap">
    <p class="lb">
      <a href="<?= e(portfolio_url()) ?>"><?= t('portfolio.crumb') ?></a>
      <span aria-hidden="true"> / </span>
      <a href="<?= e(portfolio_url($g['slug'])) ?>"><?= e($cname) ?></a>
    </p>

    <div class="shead" style="margin-top:14px">
      <div>
        <?php /* lang="en": заглавные на /az/ превращали i домена в İ */ ?>
        <p class="lb" lang="en" style="margin-bottom:10px"><?= e($w['domain']) ?></p>
        <h1 class="disp h2"><?= e($name) ?></h1>
      </div>
      <?php if (!$isDead): ?>
        <a class="btn" href="<?= e('https://' . $w['domain']) ?>" target="_blank" rel="noopener"><?= t('portfolio.visit') ?> ↗</a>
      <?php endif; ?>
    </div>

    <?php /* Подпись — только у настоящего снимка сайта (то же условие, что
             в project_cover()). Отраслевая подложка — фон, а не сайт заказчика. */ ?>
    <?php /* Обложка — LCP страницы, отсюда fetchpriority. Ширина — во весь
             контейнер (до 1232px), а не карточка сетки: свой sizes. */
          $cover = project_cover($w, $g); ?>
    <div class="cover" style="border-radius:16px;overflow:hidden;margin-top:clamp(8px,1.4vw,18px)">
      <img class="media" src="<?= e($cover) ?>"<?= cover_srcset($cover, '(max-width:1320px) 92vw, 1232px') ?> alt="<?= !empty($w['image']) ? e($name . ' — ' . $w['domain']) : '' ?>"
           fetchpriority="high" width="1200" height="750" style="display:block;width:100%;height:auto">
    </div>

    <dl style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:18px 32px;margin:clamp(24px,3vw,40px) 0 0">
      <div>
        <dt class="lb"><?= t('portfolio.f_industry') ?></dt>
        <dd style="margin:8px 0 0"><a href="<?= e(portfolio_url($g['slug'])) ?>"><?= e($cname) ?></a></dd>
      </div>
      <div>
        <dt class="lb"><?= t('portfolio.f_site') ?></dt>
        <dd style="margin:8px 0 0">
          <?php if ($isDead): ?>
            <?= e($w['domain']) ?> · <?= t('portfolio.t4') ?>
          <?php else: ?>
            <a href="<?= e('https://' . $w['domain']) ?>" target="_blank" rel="noopener"><?= e($w['domain']) ?> ↗</a>
          <?php endif; ?>
        </dd>
      </div>
    </dl>

    <?php if ($isDead): ?>
      <p class="sub" style="margin-top:22px"><?= t('portfolio.archived') ?></p>
    <?php endif; ?>

    <?php if ($text !== ''): ?>
      <div style="margin-top:clamp(28px,3.4vw,48px);max-width:760px">
        <?php foreach (preg_split('/\n\s*\n/u', $text) as $para): ?>
          <p class="sub" style="margin:0 0 14px"><?= nl2br(e(trim($para))) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if ($more): ?>
      <div style="margin-top:clamp(48px,6vw,84px)">
        <h2 class="disp" style="font-size:clamp(1.3rem,2.4vw,1.7rem);margin-bottom:clamp(16px,2vw,26px)">
          <?= e(str_replace('{cat}', $cname, t_raw('portfolio.more'))) ?></h2>
        <div class="works">
          <?php foreach ($more as $x): $xn = tr($x['desc']); $xd = !empty($x['archived']); ?>
            <a class="work<?= $xd ? ' work-dead' : '' ?>" href="<?= e(portfolio_url($g['slug'], project_slug($x['domain']))) ?>">
              <?php /* alt пустой: название и домен уже в тексте ссылки */ ?>
              <div class="cover">
                <img class="media" src="<?= e(project_cover($x, $g)) ?>"<?= cover_srcset(project_cover($x, $g)) ?> alt=""
                     loading="lazy" width="1200" height="750">
                <?php if ($xd): ?><span class="work-badge"><?= t('portfolio.t4') ?></span><?php endif; ?>
              </div>
              <h3><?= e($xn) ?></h3>
              <div class="wmeta"><span><?= e($cname) ?></span><b lang="en"><?= e($x['domain']) ?></b></div>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>

    <div style="margin-top:clamp(44px,5vw,72px);padding-top:clamp(24px,3vw,36px);border-top:1px solid var(--line)">
      <h2 class="disp h2"><?= t('portfolio.cta_h') ?></h2>
      <p class="sub" style="margin-top:16px"><?= t('portfolio.cta_p') ?></p>
      <p style="margin-top:22px;display:flex;gap:12px;flex-wrap:wrap">
        <a class="btn" href="<?= u('/kontakty/') . '#zayavka' ?>"><?= t('portfolio.cta_btn') ?></a>
        <a class="btn btn-o" href="<?= e(portfolio_url()) ?>"><?= t('portfolio.all_works') ?></a>
      </p>
    </div>
  </div>
</section>
</main>
<?php include __DIR__ . '/../../app/partials/foot.php'; ?>
