<?php
/* Общая шапка. Страница задаёт $title, $description и $current до подключения.
   Необязательно: $ogType ('website' по умолчанию, 'article' для статей). */
$cfg = require __DIR__ . '/../config.php';

/* Заголовок и описание страница задаёт одним способом: либо ставит $page и
   берёт их из data/seo.php (так у всех обычных страниц), либо прописывает
   $title и $description сама (так у статей — их тексты живут в articles.php).
   Явно заданное всегда важнее. */
$seo = require __DIR__ . '/../data/seo.php';
$m   = $seo[$page ?? ''][$cfg['lang']] ?? $seo[$page ?? '']['ru'] ?? [];

$title       = $title       ?? $m['title']       ?? 'MGuliyev Studio — веб-студия в Баку';
$description = $description ?? $m['description'] ?? 'Сайты и интернет-магазины, дизайн, продвижение и поддержка. Баку, с 2017 года.';
$current     = $current     ?? '';
$ogType      = $ogType      ?? 'website';

/* Канонический адрес: берём путь запроса без строки параметров и приводим
   к виду со слэшем на конце — именно так страницы и связаны между собой. */
$path = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
if ($path === '' || substr($path, -9) === 'index.php') $path = rtrim($path, 'index.php');
if (substr($path, -1) !== '/') $path .= '/';
$canonical = $cfg['site_url'] . $path;

$esc = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES);
?>
<!DOCTYPE html>
<html lang="<?= $esc($cfg['lang']) ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $esc($title) ?></title>
<meta name="description" content="<?= $esc($description) ?>">
<link rel="canonical" href="<?= $esc($canonical) ?>">
<?php /* Альтернативные языки выводим, только когда они действительно есть:
         ссылка на несуществующий перевод — прямая ошибка для поисковика. */
if (count($cfg['languages']) > 1): foreach ($cfg['languages'] as $l): ?>
<link rel="alternate" hreflang="<?= $esc($l) ?>" href="<?= $esc($cfg['site_url'] . ($l === 'ru' ? '' : '/' . $l) . $path) ?>">
<?php endforeach; ?>
<link rel="alternate" hreflang="x-default" href="<?= $esc($cfg['site_url'] . $path) ?>">
<?php endif; ?>
<meta property="og:type" content="<?= $esc($ogType) ?>">
<meta property="og:site_name" content="<?= $esc($cfg['site_name']) ?>">
<meta property="og:locale" content="<?= $esc($cfg['locales'][$cfg['lang']] ?? 'ru_RU') ?>">
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
    <nav class="tl-marks" id="tlMarks" aria-label="Разделы страницы"></nav>
    <span class="tl-head" id="tlHead"></span>
  </div>
  <span class="tl-time" id="tlTime" aria-hidden="true">00:00 / 00:00</span>
</div>

<header class="nav">
  <div class="wrap nav-in">
    <a class="wm" href="/" aria-label="MGuliyev Studio — на главную"><img src="/images/brand/guliyev-white-logo.svg" alt="MGuliyev Studio" width="838" height="346"></a>
    <nav class="menu">
      <a href="/uslugi/"<?= $current === 'services' ? ' aria-current="page"' : '' ?>>Услуги</a>
      <a href="/portfolio/"<?= $current === 'portfolio' ? ' aria-current="page"' : '' ?>>Портфолио</a>
      <a href="/o-studii/"<?= $current === 'about' ? ' aria-current="page"' : '' ?>>О студии</a>
      <a href="/tseny/"<?= $current === 'price' ? ' aria-current="page"' : '' ?>>Цены</a>
      <a href="/blog/"<?= $current === 'blog' ? ' aria-current="page"' : '' ?>>Блог</a>
      <a href="/kontakty/"<?= $current === 'contact' ? ' aria-current="page"' : '' ?>>Контакты</a>
    </nav>
    <div class="nav-right">
      <?php /* Переключатель вернём, когда появятся /az/ и /en/: сейчас обе ссылки вели в 404. */ ?>
      <a class="pill nav-cta" href="/kontakty/"><i></i>Обсудить проект</a>
      <button class="burger" id="burger" type="button" aria-label="Открыть меню" aria-expanded="false" aria-controls="drawer"><span></span><span></span></button>
    </div>
  </div>
</header>

<div class="drawer" id="drawer">
  <nav>
      <a href="/uslugi/"<?= $current === 'services' ? ' aria-current="page"' : '' ?>>Услуги</a>
      <a href="/portfolio/"<?= $current === 'portfolio' ? ' aria-current="page"' : '' ?>>Портфолио</a>
      <a href="/o-studii/"<?= $current === 'about' ? ' aria-current="page"' : '' ?>>О студии</a>
      <a href="/tseny/"<?= $current === 'price' ? ' aria-current="page"' : '' ?>>Цены</a>
      <a href="/blog/"<?= $current === 'blog' ? ' aria-current="page"' : '' ?>>Блог</a>
      <a href="/kontakty/"<?= $current === 'contact' ? ' aria-current="page"' : '' ?>>Контакты</a>
  </nav>
  <div class="drawer-foot">
    <a href="tel:+994552155363">+994 55 215 53 63</a>
    <a href="mailto:info@mguliyev.com">info@mguliyev.com</a>
    <span style="color:var(--dim);font-size:.72rem;letter-spacing:.16em;text-transform:uppercase">Баку · пн–пт 10:00–19:00</span>
  </div>
</div>
