<?php
require __DIR__ . '/../../app/bootstrap.php';
$page = 'price';
$current = 'price';
include __DIR__ . '/../../app/partials/head.php';

$packs = [
    ['Старт', '₼700', 'от',
     '1–5 страниц · адаптив под телефон и планшет · базовое SEO · домен на год · 3 месяца хостинга',
     'Небольшому бизнесу, у которого сейчас вместо сайта профиль в соцсетях. Мастерская, кабинет, локальная точка, частная практика — там, где нужно, чтобы вас нашли, поняли и позвонили.',
     'Нескольких языков, блога, каталога с оплатой.'],
    ['Бизнес', '₼1 190', 'от',
     '10–20 страниц · 3 языка · блог · расширенное SEO · Cloudflare',
     'Компании с каталогом услуг или продукции и клиентами на нескольких языках. Три языка обычно азербайджанский, русский и английский, но набор выбираете вы.',
     'Корзины, онлайн-оплаты и работы со складом.'],
    ['Премиум', '₼1 800', 'от',
     'WooCommerce · онлайн-оплата · интеграция со складом · скорость 90+',
     'Магазину с реальным складом и потоком заказов — там, где менеджер не должен вручную переписывать остатки, а покупатель должен платить на сайте, а не «уточните в директе».',
     ''],
    ['Reels-подписка', '₼690', 'в месяц',
     '8 вертикальных видео в месяц · съёмка · монтаж · субтитры · контент-план · Instagram и TikTok',
     'Бизнесу, которому нужно регулярное вертикальное видео. На руки вы получаете готовый ролик 9:16, вшитые субтитры, обложку для ленты и исходники съёмки — исходники остаются у вас.',
     ''],
];
?>
<main id="top">
<section class="sec">
  <div class="wrap">
    <div class="shead">
      <h1 class="disp h2"><?= t('price.t1') ?></h1>
      <p class="lb"><?= t('price.t2') ?></p>
    </div>
    <p class="sub"><?= t('price.t3') ?></p>

    <div class="plist" style="margin-top:clamp(30px,4vw,54px)">
      <?php foreach ($packs as $p): ?>
      <div class="pr">
        <h3><?= $p[0] ?></h3>
        <p><?= $p[3] ?></p>
        <span class="amt"><?= $p[1] ?><small><?= $p[2] ?></small></span>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="steps" style="margin-top:clamp(40px,5vw,68px)">
      <?php foreach ($packs as $p): ?>
      <div class="st">
        <h4><?= $p[0] ?></h4>
        <p><?= $p[4] ?></p>
        <?php if ($p[5]): ?><p style="margin-top:10px;color:var(--dim)">Чего нет: <?= $p[5] ?></p><?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="about" style="margin-top:clamp(44px,5vw,72px)">
      <div>
        <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:16px"><?= t('price.t4') ?></h2>
        <ul class="plain">
          <li><?= t('price.t5') ?></li>
          <li><?= t('price.t6') ?></li>
          <li><?= t('price.t7') ?></li>
          <li><?= t('price.t8') ?></li>
        </ul>
      </div>
      <div>
        <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:16px"><?= t('price.t9') ?></h2>
        <ul class="plain">
          <li><?= t('price.t10') ?> <span class="note">[УТОЧНИТЬ: цена продления]</span></li>
          <li><?= t('price.t11') ?> <span class="note">[УТОЧНИТЬ: цена в месяц]</span></li>
          <li><?= t('price.t12') ?> <span class="note">[УТОЧНИТЬ: цены]</span></li>
          <li><?= t('price.t13') ?></li>
          <li><?= t('price.t14') ?> <span class="note">[УТОЧНИТЬ: цены]</span></li>
        </ul>
      </div>
    </div>

    <div style="margin-top:clamp(40px,5vw,68px)">
      <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:16px"><?= t('price.t15') ?></h2>
      <p class="sub"><?= t('price.t16') ?></p>
      <p class="note" style="margin-top:14px">[УТОЧНИТЬ: способы оплаты — перевод, карта, наличные]</p>
    </div>

    <div class="faq" style="margin-top:clamp(40px,5vw,68px)">
      <details open><summary><?= t('price.t17') ?></summary>
        <p><?= t('price.t18') ?></p></details>
      <details><summary><?= t('price.t19') ?></summary>
        <p><?= t('price.t20') ?></p></details>
      <details><summary><?= t('price.t21') ?></summary>
        <p><?= t('price.t22') ?></p></details>
      <details><summary><?= t('price.t23') ?></summary>
        <p><?= t('price.t24') ?></p></details>
    </div>

    <div style="margin-top:clamp(44px,5vw,72px);padding-top:clamp(24px,3vw,36px);border-top:1px solid var(--line)">
      <h2 class="disp h2"><?= t('price.t25') ?></h2>
      <p class="sub" style="margin-top:16px"><?= t('price.t26') ?></p>
      <p style="margin-top:22px"><a class="btn" href="<?= u('/kontakty/') ?>"><?= t('price.t27') ?></a></p>
    </div>
  </div>
</section>
</main>
<?php include __DIR__ . '/../../app/partials/foot.php'; ?>
