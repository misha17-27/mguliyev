<?php
/* «Не найдено» для любого адреса, которого на сайте нет. Её отдаёт сервер
   (ErrorDocument в public/.htaccess) и локальный router.php.

   Язык — из самого адреса. Метка SITE_LANG из .htaccess сюда приходит
   после двух внутренних переходов как REDIRECT_REDIRECT_SITE_LANG,
   и I18n::detect() её не видит; REQUEST_URI при этом — исходный адрес. */
if (preg_match('~^/(az|en)(?:[/?]|$)~', (string)($_SERVER['REQUEST_URI'] ?? ''), $nfm)) {
    $_SERVER['SITE_LANG'] = $nfm[1];
}
require __DIR__ . '/../app/bootstrap.php';
http_response_code(404);
$title       = I18n::raw('nf.h') . ' — MGuliyev Studio';
$description = I18n::raw('nf.p');
$robots      = 'noindex, follow';
include __DIR__ . '/../app/partials/head.php';
?>
<main id="top">
<section class="sec">
  <div class="wrap">
    <h1 class="disp h2"><?= t('nf.h') ?></h1>
    <p class="sub" style="margin-top:16px"><?= t('nf.p') ?></p>
    <p style="margin-top:24px;display:flex;flex-wrap:wrap;gap:12px">
      <a class="btn" href="<?= e(u('/')) ?>"><?= t('nf.home') ?></a>
      <a class="btn btn-o" href="<?= e(u('/uslugi/')) ?>"><?= t('nav.services') ?></a>
      <a class="btn btn-o" href="<?= e(u('/portfolio/')) ?>"><?= t('nav.portfolio') ?></a>
      <a class="btn btn-o" href="<?= e(u('/kontakty/')) ?>"><?= t('nav.contacts') ?></a>
    </p>
  </div>
</section>
</main>
<?php include __DIR__ . '/../app/partials/foot.php';
