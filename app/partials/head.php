<?php
/* Общая шапка. Страница задаёт $page (или $title и $description) и $current
   до подключения. Необязательно: $ogType ('website' по умолчанию, 'article'
   для статей), $langOnly — список языков, на которых страница существует. */
/* Язык и данные уже подняты в app/bootstrap.php — шапка только рисует. */
$cfg = I18n::$cfg;

/* Заголовок и описание страница задаёт одним способом: либо ставит $page и
   берёт их из data/seo.php (так у всех обычных страниц), либо прописывает
   $title и $description сама (так у статей — их тексты живут в articles.php).
   Явно заданное всегда важнее.
   seo_canon() — это data/seo.php плюс правки из панели управления. */
$seo = seo_canon();
$m   = $seo[$page ?? ''][I18n::$lang] ?? $seo[$page ?? ''][$cfg['default_lang']] ?? [];

$title       = $title       ?? $m['title']       ?? t('seo.fallback.title');
$description = $description ?? $m['description'] ?? t('seo.fallback.desc');
$current     = $current     ?? '';
$ogType      = $ogType      ?? 'website';

/* На каких языках страница реально существует. По умолчанию на всех:
   словарь откатывается на русский, поэтому пустых страниц не бывает.
   Статьи блога могут сузить список — ссылаться на несуществующий перевод
   это прямая ошибка для поисковика. */
$langOnly = $langOnly ?? $cfg['languages'];

$path      = I18n::path();
$abs       = static fn(string $l) => $cfg['site_url'] . ($cfg['prefix'][$l] ?? '') . $path;
$canonical = $abs(I18n::$lang);

$esc = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES);
$cur = static fn(string $k) => $current === $k ? ' aria-current="page"' : '';
?>
<!DOCTYPE html>
<html lang="<?= $esc(I18n::$lang) ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $esc($title) ?></title>
<meta name="description" content="<?= $esc($description) ?>">
<?php /* Закрыть страницу от индексации — например, «не найдено»:
         ответ 404 поисковик и так не возьмёт, но метатег страхует
         на случай, когда страницу отдадут с кодом 200 по ошибке. */ ?>
<?php if (!empty($robots)): ?><meta name="robots" content="<?= $esc($robots) ?>">
<?php endif; ?>

<?php /* Значок вкладки. Знак — буква M из логотипа: надпись целиком
         на 16 пикселях превращается в серую полосу.
         Пути без языкового префикса: файлы одни на все языки.
         .ico браузер просит сам, но объявляем его явно — иначе при
         заданном svg часть браузеров за ним вообще не идёт. */ ?>
<link rel="icon" href="/favicon.ico?v=3" sizes="32x32">
<link rel="icon" href="/favicon.svg?v=3" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png?v=3">
<link rel="manifest" href="/site.webmanifest">
<meta name="theme-color" content="#0A0A0A">

<link rel="canonical" href="<?= $esc($canonical) ?>">
<?php foreach ($langOnly as $l): ?>
<link rel="alternate" hreflang="<?= $esc($l) ?>" href="<?= $esc($abs($l)) ?>">
<?php endforeach; ?>
<link rel="alternate" hreflang="x-default" href="<?= $esc($abs($cfg['default_lang'])) ?>">
<meta property="og:type" content="<?= $esc($ogType) ?>">
<?php /* Дата статьи — машиночитаемо: на странице она только текстом. */
      if ($ogType === 'article' && !empty($art['date']) && ($pd = DateTime::createFromFormat('!d.m.Y', (string)$art['date']))): ?>
<meta property="article:published_time" content="<?= $pd->format('Y-m-d') ?>">
<?php endif; ?>
<meta property="og:site_name" content="<?= $esc($cfg['site_name']) ?>">
<meta property="og:locale" content="<?= $esc($cfg['locales'][I18n::$lang] ?? 'ru_RU') ?>">
<?php foreach ($langOnly as $l): if ($l === I18n::$lang) continue; ?>
<meta property="og:locale:alternate" content="<?= $esc($cfg['locales'][$l]) ?>">
<?php endforeach; ?>
<meta property="og:url" content="<?= $esc($canonical) ?>">
<meta property="og:title" content="<?= $esc($title) ?>">
<meta property="og:description" content="<?= $esc($description) ?>">
<?php /* Картинку для соцсетей страница может задать сама: у проекта
         портфолио это снимок его сайта, а не общая обложка студии —
         ссылка на проект в мессенджере должна показывать проект. */
$og = !empty($ogImage) ? $ogImage : $cfg['og_image'];
$ogAbs = preg_match('~^https?://~', $og) ? $og : $cfg['site_url'] . $og; ?>
<meta property="og:image" content="<?= $esc($ogAbs) ?>">
<?php /* Размер — из самого файла, у любой картинки: без него соцсети при
         первой отправке ссылки иногда не показывают превью. Раньше его
         писали только у общей обложки, и снимок проекта уходил без размера. */
$ogFile = rtrim((string)($_SERVER['DOCUMENT_ROOT'] ?? ''), '/\\') . $og;
$ogDim  = !preg_match('~^https?://~', $og) && is_file($ogFile) ? @getimagesize($ogFile) : false;
if ($ogDim): ?>
<meta property="og:image:width" content="<?= (int)$ogDim[0] ?>">
<meta property="og:image:height" content="<?= (int)$ogDim[1] ?>">
<?php endif; ?>
<meta name="twitter:card" content="summary_large_image">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Alumni+Sans:wght@600;700;800&amp;family=Cormorant+Garamond:ital,wght@1,500;1,600&amp;family=Golos+Text:wght@400;500;600&amp;display=swap">
<?php /* В Golos Text у ğ/Ğ нет бреве, а ə/Ə нет вовсе. Эти четыре буквы
         берём из Onest — близкого по рисунку гротеска. text= урезает шрифт
         до них; G и g Google оставляет в наборе как основу ğ/Ğ, поэтому на
         /az/ они тоже из Onest, остальной текст — Golos (см. style.css).
         Отдельной ссылкой: text= в общей ссылке урезал бы и остальные шрифты. */
      if (I18n::$lang === 'az'): ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600&amp;text=%C4%9E%C4%9F%C6%8F%C9%99&amp;display=swap">
<?php endif; ?>
<link rel="stylesheet" href="<?= $esc(asset_url('/assets/css/style.css')) ?>">
<?php /* Скрипта капчи здесь нет: его подключает app.js, когда человек
         подходит к форме. В шапке он грузился на каждой странице, в том
         числе без формы, а на главной виджет при загрузке тянул сотни
         килобайт ради формы в самом низу. Вход в панель зовёт ts_script() сам. */ ?>
<?php /* Разметка schema.org (schema_graph() в app/content.php). Блок данных,
         а не скрипт: браузер его не исполняет, политике содержимого он не
         мешает. Страницам вне индекса — 404, статье без перевода — не нужна. */
      if (empty($robots)) echo schema_tag([
          'canonical' => $canonical, 'desc' => $description, 'page' => $page ?? '',
          'crumbs' => $crumbs ?? [], 'art' => $ogType === 'article' ? ($art ?? null) : null,
      ]); ?>
</head>
<body>
<?php /* Первая остановка Tab: без неё до содержимого было десять ссылок шапки на каждой странице. */ ?>
<a class="skip" href="#top"><?= t('nav.skip') ?></a>
<div class="tl" id="tl">
  <span class="tl-rec" aria-hidden="true"><i></i>rec</span>
  <div class="tl-bar">
    <span class="tl-fill" id="tlFill"></span>
    <?php /* Подписи меток и шаблон их названия — из словаря: метки строит
             скрипт, и без этого на /az/ и /en/ они были бы русскими. */
          $tlTitles = json_encode([
              'services' => t_raw('nav.services'), 'portfolio' => t_raw('nav.portfolio'), 'reels' => 'Reels',
              'about' => t_raw('nav.about'), 'process' => t_raw('nav.process'), 'price' => t_raw('nav.price'),
              'blog' => t_raw('nav.blog'), 'faq' => t_raw('footer.faq'), 'contact' => t_raw('nav.contacts'),
          ], JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE) ?: ''; ?>
    <nav class="tl-marks" id="tlMarks" aria-label="<?= t('nav.sections') ?>" data-titles="<?= $esc($tlTitles) ?>" data-go="<?= t('nav.go_to') ?>"></nav>
    <span class="tl-head" id="tlHead"></span>
  </div>
  <span class="tl-time" id="tlTime" aria-hidden="true">00:00 / 00:00</span>
</div>

<header class="nav">
  <div class="wrap nav-in">
    <a class="wm" href="<?= $esc(u('/')) ?>" aria-label="<?= t('nav.home') ?>"><img src="/images/brand/guliyev-white-logo.svg" alt="MGuliyev Studio" width="838" height="346"></a>
    <nav class="menu">
      <a href="<?= $esc(u('/uslugi/')) ?>"<?= $cur('services') ?>><?= t('nav.services') ?></a>
      <a href="<?= $esc(u('/portfolio/')) ?>"<?= $cur('portfolio') ?>><?= t('nav.portfolio') ?></a>
      <a href="<?= $esc(u('/o-studii/')) ?>"<?= $cur('about') ?>><?= t('nav.about') ?></a>
      <a href="<?= $esc(u('/tseny/')) ?>"<?= $cur('price') ?>><?= t('nav.price') ?></a>
      <a href="<?= $esc(u('/blog/')) ?>"<?= $cur('blog') ?>><?= t('nav.blog') ?></a>
      <a href="<?= $esc(u('/kontakty/')) ?>"<?= $cur('contact') ?>><?= t('nav.contacts') ?></a>
    </nav>
    <div class="nav-right">
      <nav class="lang" aria-label="<?= t('nav.language') ?>">
        <?php foreach ($cfg['languages'] as $l): $on = $l === I18n::$lang; ?>
          <?php if ($on): ?><span aria-current="true"><?= $esc($cfg['lang_label'][$l]) ?></span>
          <?php else: ?><a href="<?= $esc(($cfg['prefix'][$l] ?? '') . $path) ?>" hreflang="<?= $esc($l) ?>"><?= $esc($cfg['lang_label'][$l]) ?></a><?php endif; ?>
        <?php endforeach; ?>
      </nav>
      <a class="pill nav-cta" href="<?= $esc(u('/kontakty/')) ?>"><i></i><?= t('cta.discuss') ?></a>
      <button class="burger" id="burger" type="button" aria-label="<?= t('nav.open_menu') ?>" data-open="<?= t('nav.open_menu') ?>" data-close="<?= t('nav.close_menu') ?>" aria-expanded="false" aria-controls="drawer"><span></span><span></span></button>
    </div>
  </div>
</header>

<div class="drawer" id="drawer">
  <nav>
      <a href="<?= $esc(u('/uslugi/')) ?>"<?= $cur('services') ?>><?= t('nav.services') ?></a>
      <a href="<?= $esc(u('/portfolio/')) ?>"<?= $cur('portfolio') ?>><?= t('nav.portfolio') ?></a>
      <a href="<?= $esc(u('/o-studii/')) ?>"<?= $cur('about') ?>><?= t('nav.about') ?></a>
      <a href="<?= $esc(u('/tseny/')) ?>"<?= $cur('price') ?>><?= t('nav.price') ?></a>
      <a href="<?= $esc(u('/blog/')) ?>"<?= $cur('blog') ?>><?= t('nav.blog') ?></a>
      <a href="<?= $esc(u('/kontakty/')) ?>"<?= $cur('contact') ?>><?= t('nav.contacts') ?></a>
  </nav>
  <div class="drawer-foot">
    <nav class="lang" aria-label="<?= t('nav.language') ?>">
      <?php foreach ($cfg['languages'] as $l): $on = $l === I18n::$lang; ?>
        <?php if ($on): ?><span aria-current="true"><?= $esc($cfg['lang_label'][$l]) ?></span>
        <?php else: ?><a href="<?= $esc(($cfg['prefix'][$l] ?? '') . $path) ?>" hreflang="<?= $esc($l) ?>"><?= $esc($cfg['lang_label'][$l]) ?></a><?php endif; ?>
      <?php endforeach; ?>
    </nav>
    <a href="<?= $esc(tel_href()) ?>"><?= $esc(sv('phone')) ?></a>
    <a href="mailto:<?= $esc(s('email')) ?>"><?= $esc(sv('email')) ?></a>
    <span style="color:var(--dim);font-size:.72rem;letter-spacing:.16em;text-transform:uppercase"><?= $esc(sv('hours')) ?></span>
  </div>
</div>
