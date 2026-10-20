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

<?php /* Значок вкладки. Знак — буква M из логотипа: надпись целиком
         на 16 пикселях превращается в серую полосу.
         Пути без языкового префикса: файлы одни на все языки.
         .ico браузер просит сам, но объявляем его явно — иначе при
         заданном svg часть браузеров за ним вообще не идёт. */ ?>
<link rel="icon" href="/favicon.ico" sizes="32x32">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="manifest" href="/site.webmanifest">
<meta name="theme-color" content="#0A0A0A">

<link rel="canonical" href="<?= $esc($canonical) ?>">
<?php foreach ($langOnly as $l): ?>
<link rel="alternate" hreflang="<?= $esc($l) ?>" href="<?= $esc($abs($l)) ?>">
<?php endforeach; ?>
<link rel="alternate" hreflang="x-default" href="<?= $esc($abs($cfg['default_lang'])) ?>">
<meta property="og:type" content="<?= $esc($ogType) ?>">
<meta property="og:site_name" content="<?= $esc($cfg['site_name']) ?>">
<meta property="og:locale" content="<?= $esc($cfg['locales'][I18n::$lang] ?? 'ru_RU') ?>">
<?php foreach ($langOnly as $l): if ($l === I18n::$lang) continue; ?>
<meta property="og:locale:alternate" content="<?= $esc($cfg['locales'][$l]) ?>">
<?php endforeach; ?>
<meta property="og:url" content="<?= $esc($canonical) ?>">
<meta property="og:title" content="<?= $esc($title) ?>">
<meta property="og:description" content="<?= $esc($description) ?>">
<meta property="og:image" content="<?= $esc($cfg['site_url'] . $cfg['og_image']) ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Alumni+Sans:wght@600;700;800&amp;family=Cormorant+Garamond:ital,wght@1,500;1,600&amp;family=Golos+Text:wght@400;500;600&amp;display=swap">
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<div class="tl" id="tl">
  <span class="tl-rec" aria-hidden="true"><i></i>rec</span>
  <div class="tl-bar">
    <span class="tl-fill" id="tlFill"></span>
    <nav class="tl-marks" id="tlMarks" aria-label="<?= $esc(t('nav.sections')) ?>"></nav>
    <span class="tl-head" id="tlHead"></span>
  </div>
  <span class="tl-time" id="tlTime" aria-hidden="true">00:00 / 00:00</span>
</div>

<header class="nav">
  <div class="wrap nav-in">
    <a class="wm" href="<?= $esc(u('/')) ?>" aria-label="<?= $esc(t('nav.home')) ?>"><img src="/images/brand/guliyev-white-logo.svg" alt="MGuliyev Studio" width="838" height="346"></a>
    <nav class="menu">
      <a href="<?= $esc(u('/uslugi/')) ?>"<?= $cur('services') ?>><?= $esc(t('nav.services')) ?></a>
      <a href="<?= $esc(u('/portfolio/')) ?>"<?= $cur('portfolio') ?>><?= $esc(t('nav.portfolio')) ?></a>
      <a href="<?= $esc(u('/o-studii/')) ?>"<?= $cur('about') ?>><?= $esc(t('nav.about')) ?></a>
      <a href="<?= $esc(u('/tseny/')) ?>"<?= $cur('price') ?>><?= $esc(t('nav.price')) ?></a>
      <a href="<?= $esc(u('/blog/')) ?>"<?= $cur('blog') ?>><?= $esc(t('nav.blog')) ?></a>
      <a href="<?= $esc(u('/kontakty/')) ?>"<?= $cur('contact') ?>><?= $esc(t('nav.contacts')) ?></a>
    </nav>
    <div class="nav-right">
      <nav class="lang" aria-label="<?= $esc(t('nav.language')) ?>">
        <?php foreach ($cfg['languages'] as $l): $on = $l === I18n::$lang; ?>
          <?php if ($on): ?><span aria-current="true"><?= $esc($cfg['lang_label'][$l]) ?></span>
          <?php else: ?><a href="<?= $esc(($cfg['prefix'][$l] ?? '') . $path) ?>" hreflang="<?= $esc($l) ?>"><?= $esc($cfg['lang_label'][$l]) ?></a><?php endif; ?>
        <?php endforeach; ?>
      </nav>
      <a class="pill nav-cta" href="<?= $esc(u('/kontakty/')) ?>"><i></i><?= $esc(t('cta.discuss')) ?></a>
      <button class="burger" id="burger" type="button" aria-label="<?= $esc(t('nav.open_menu')) ?>" data-open="<?= $esc(t('nav.open_menu')) ?>" data-close="<?= $esc(t('nav.close_menu')) ?>" aria-expanded="false" aria-controls="drawer"><span></span><span></span></button>
    </div>
  </div>
</header>

<div class="drawer" id="drawer">
  <nav>
      <a href="<?= $esc(u('/uslugi/')) ?>"<?= $cur('services') ?>><?= $esc(t('nav.services')) ?></a>
      <a href="<?= $esc(u('/portfolio/')) ?>"<?= $cur('portfolio') ?>><?= $esc(t('nav.portfolio')) ?></a>
      <a href="<?= $esc(u('/o-studii/')) ?>"<?= $cur('about') ?>><?= $esc(t('nav.about')) ?></a>
      <a href="<?= $esc(u('/tseny/')) ?>"<?= $cur('price') ?>><?= $esc(t('nav.price')) ?></a>
      <a href="<?= $esc(u('/blog/')) ?>"<?= $cur('blog') ?>><?= $esc(t('nav.blog')) ?></a>
      <a href="<?= $esc(u('/kontakty/')) ?>"<?= $cur('contact') ?>><?= $esc(t('nav.contacts')) ?></a>
  </nav>
  <div class="drawer-foot">
    <nav class="lang" aria-label="<?= $esc(t('nav.language')) ?>">
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
