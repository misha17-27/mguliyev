<?php
require __DIR__ . '/../app/bootstrap.php';
$page = 'home';
$current = '';
include __DIR__ . '/../app/partials/head.php';
?>
<main id="top">
<section class="hero">
  <div class="wrap">
    <div class="hgrid">
      <div>
        <p class="lb" style="margin-bottom:clamp(20px,2.8vw,34px)"><?= t('home.t1') ?></p>
        <h1 class="disp"><span class="ln"><?= t('home.t2') ?></span><span class="ln ser duo-text"><?= t('home.t3') ?></span><span class="ln"><?= t('home.t4') ?></span></h1>
      </div>
      <div class="phone">
        <div class="screen">
          <div class="bars" aria-hidden="true"><i></i><i></i><i></i></div>
          <div class="slide">
            <img class="media" src="/images/home/reel-1.jpg" data-ph="/images/placeholder/reel-1.svg" alt="<?= t('home.t150') ?>" width="608" height="2400">
            <span class="scrim"></span>
            <b>SOCAR<br>Midstream</b><small><?= t('home.t5') ?></small>
          </div>
          <div class="slide">
            <img class="media" src="/images/home/reel-2.jpg" data-ph="/images/placeholder/reel-2.svg" alt="<?= t('home.t151') ?>" width="640" height="2400">
            <span class="scrim"></span>
            <b>YMK<br>Watercolor</b><small><?= t('home.t6') ?></small>
          </div>
          <div class="slide">
            <img class="media" src="/images/home/reel-3.jpg" data-ph="/images/placeholder/reel-3.svg" alt="<?= t('home.t152') ?>" width="640" height="2202">
            <span class="scrim"></span>
            <b>Elson<br>Group</b><small><?= t('home.t7') ?></small>
          </div>
        </div>
        <?php /* Остановка ролика и бегущей строки (WCAG 2.2.2). Скрыта, пока её
                 не покажет скрипт: без него кнопка ничего бы не делала. */ ?>
        <button type="button" class="hero-pp" id="heroPP" hidden aria-pressed="false" aria-label="<?= t('home.motion_pause') ?>"></button>
        <span class="phone-tag"><?= t('home.t8') ?></span>
      </div>
    </div>
    <div class="hero-foot">
      <p class="sub"><?= t('home.t9') ?></p>
      <div class="hero-cta">
        <a class="btn" href="#contact"><?= t('home.t10') ?></a>
        <a class="btn btn-o" href="#portfolio"><?= t('home.t11') ?></a>
      </div>
    </div>
  </div>
</section>

<div class="mq" aria-hidden="true">
  <div class="mq-t">
    <b><?= t('home.t12') ?></b><em>&amp;</em><b>SEO</b><em>&amp;</em><b><?= t('home.t13') ?></b><em>&amp;</em><b><?= t('home.t14') ?></b><em>&amp;</em><b>SMM</b><em>&amp;</em><b>Reels</b><em>&amp;</em>
    <b><?= t('home.t15') ?></b><em>&amp;</em><b>SEO</b><em>&amp;</em><b><?= t('home.t16') ?></b><em>&amp;</em><b><?= t('home.t17') ?></b><em>&amp;</em><b>SMM</b><em>&amp;</em><b>Reels</b><em>&amp;</em>
  </div>
</div>

<section class="sec" id="services">
  <div class="wrap">
    <div class="shead rv">
      <h2 class="disp h2"><?= t('home.t18') ?></h2>
      <p class="sub" style="font-size:.9rem;max-width:40ch"><?= t('home.t19') ?></p>
    </div>
    <div class="rows rv">
      <a class="row" href="<?= u('/uslugi/veb-sayty/') ?>">
        <span class="rname"><?= t('home.t20') ?></span>
        <span class="rdesc"><?= t('home.t21') ?></span>
        <span class="rmeta"><?= t('home.t22') ?></span>
      </a>
      <a class="row" href="<?= u('/uslugi/marketing/') ?>">
        <span class="rname">SEO</span>
        <span class="rdesc"><?= t('home.t23') ?></span>
        <span class="rmeta"><?= t('home.t24') ?></span>
      </a>
      <a class="row" href="<?= u('/uslugi/podderzhka/') ?>">
        <span class="rname"><?= t('home.t25') ?></span>
        <span class="rdesc"><?= t('home.t26') ?></span>
        <span class="rmeta"><?= t('home.t27') ?></span>
      </a>
      <a class="row" href="<?= u('/uslugi/podderzhka/') ?>">
        <span class="rname"><?= t('home.t28') ?></span>
        <span class="rdesc"><?= t('home.t29') ?></span>
        <span class="rmeta"><?= t('home.t30') ?></span>
      </a>
      <a class="row" href="<?= u('/uslugi/marketing/') ?>">
        <span class="rname">SMM</span>
        <span class="rdesc"><?= t('home.t31') ?></span>
        <span class="rmeta"><?= t('home.t32') ?></span>
      </a>
      <a class="row" href="<?= u('/uslugi/marketing/') ?>">
        <span class="rname"><?= t('home.t33') ?></span>
        <span class="rdesc"><?= t('home.t34') ?></span>
        <span class="rmeta">9:16</span>
      </a>
    </div>
  </div>
</section>

<section class="sec" id="portfolio" style="padding-top:0">
  <div class="wrap">
    <div class="shead rv">
      <h2 class="disp h2"><?= t('home.t35') ?></h2>
      <?php $wc = works_count(); /* число проектов — из данных портфолио, не из текста */ ?>
      <p class="lb"><?= tn('home.t36', ['n' => $wc['n'], 'u' => plural($wc['n'], 'units.project')]) ?></p>
    </div>
    <?php /* alt у обложек пустой: название и домен уже в тексте ссылки,
             с подписью диктор читал их дважды. */ ?>
    <div class="works rv">
      <a class="work" href="https://elson-group.com" target="_blank" rel="noopener">
        <div class="cover w1"><img class="media" src="/images/works/elson-group.com.jpg" data-ph="/images/placeholder/work-1.svg" alt="" loading="lazy" width="1200" height="750"><b class="ph-only"><?= t('home.t37') ?></b></div>
        <h3>Elson Group</h3>
        <div class="wmeta"><span><?= t('home.t38') ?></span><b>elson-group.com</b></div>
      </a>
      <a class="work" href="https://lynkco.az" target="_blank" rel="noopener">
        <div class="cover w2"><img class="media" src="/images/home/work-2.jpg" data-ph="/images/placeholder/work-2.svg" alt="" loading="lazy" width="1200" height="750"><b class="ph-only"><?= t('home.t39') ?></b></div>
        <h3><?= t('home.t40') ?></h3>
        <div class="wmeta"><span><?= t('home.t41') ?></span><b>lynkco.az</b></div>
      </a>
      <a class="work" href="https://marshal.az" target="_blank" rel="noopener">
        <div class="cover w3"><img class="media" src="/images/home/work-3.jpg" data-ph="/images/placeholder/work-3.svg" alt="" loading="lazy" width="1200" height="750"><b class="ph-only"><?= t('home.t42') ?></b></div>
        <h3><?= t('home.t43') ?></h3>
        <div class="wmeta"><span><?= t('home.t44') ?></span><b>marshal.az</b></div>
      </a>
      <a class="work" href="https://grandmoto.az" target="_blank" rel="noopener">
        <div class="cover w4"><img class="media" src="/images/home/work-4.jpg" data-ph="/images/placeholder/work-4.svg" alt="" loading="lazy" width="1200" height="750"><b class="ph-only"><?= t('home.t45') ?></b></div>
        <h3>Grandmoto</h3>
        <div class="wmeta"><span><?= t('home.t46') ?></span><b>grandmoto.az</b></div>
      </a>
      <a class="work" href="https://store.az" target="_blank" rel="noopener">
        <div class="cover w5"><img class="media" src="/images/home/work-5.jpg" data-ph="/images/placeholder/work-5.svg" alt="" loading="lazy" width="1200" height="750"><b class="ph-only"><?= t('home.t47') ?></b></div>
        <h3>Store.az</h3>
        <div class="wmeta"><span><?= t('home.t48') ?></span><b>store.az</b></div>
      </a>
      <a class="work" href="https://ymkwatercolor.com" target="_blank" rel="noopener">
        <div class="cover w6"><img class="media" src="/images/works/ymkwatercolor.com.jpg" data-ph="/images/placeholder/work-6.svg" alt="" loading="lazy" width="1200" height="750"><b class="ph-only"><?= t('home.t49') ?></b></div>
        <h3>YMK Watercolor</h3>
        <div class="wmeta"><span><?= t('home.t50') ?></span><b>ymkwatercolor.com</b></div>
      </a>
    </div>
  </div>
</section>

<section class="sec" id="reels" style="padding-top:0">
  <div class="wrap">
    <div class="shead rv">
      <h2 class="disp h2"><?= t('home.t51') ?> <span class="ser"><?= t('home.t52') ?></span></h2>
      <p class="lb">9:16 · 1080×1920</p>
    </div>
    <div class="vf rv">
      <figure class="vf-mon">
        <div class="vf-scr" id="vfScr" role="tabpanel" aria-label="<?= t('home.t159') ?>">
          <img class="vf-shot" id="vfShot" src="/images/demo/shot-1.svg" alt="" width="1080" height="1920">
          <?php /* aria-hidden — на подписях, а не на всей строке: скрипт кладёт сюда
                   кнопку паузы, и внутри скрытого от диктора блока она была бы безымянной. */ ?>
          <div class="vf-osd" data-pause="<?= t('home.demo_pause') ?>"><span class="vf-stby" aria-hidden="true"><i></i><em id="vfState">stby</em></span><span aria-hidden="true">9:16</span></div>
          <div class="vf-bars" id="vfBars" aria-hidden="true"><i></i><i></i><i></i></div>
          <div class="vf-zone top"><span><?= t('home.t53') ?></span></div>
          <div class="vf-safe">
            <span class="vf-guide" aria-hidden="true"></span>
            <span class="vf-corners" aria-hidden="true"></span>
            <p class="vf-lb"><?= t('home.t54') ?></p>
            <b class="vf-now" id="vfNow" aria-live="polite"><?= t('home.t55') ?></b>
            <p class="vf-cc" id="vfCC"><?= t('home.t56') ?></p>
            <span class="vf-dim" aria-hidden="true"><?= t('home.t57') ?></span>
          </div>
          <div class="vf-zone bot"><span><?= t('home.t58') ?></span></div>
          <span class="vf-tc" aria-hidden="true">00:00:00:00</span>
        </div>
        <figcaption><?= t('home.t59') ?></figcaption>
      </figure>

      <div class="vf-side">
        <p class="lb"><?= t('home.t60') ?></p>
        <ul class="vf-list" id="vfList" role="tablist" aria-label="<?= t('home.t160') ?>">
          <li role="presentation"><button type="button" class="vfr" role="tab" aria-selected="true" aria-controls="vfScr" data-img="/images/demo/shot-1.svg" data-vid="/images/demo/shot-1.mp4" data-poster="/images/demo/shot-1-poster.jpg" data-sub="<?= t('home.sub1') ?>"><i>01</i><b><?= t('home.t61') ?></b><span><?= t('home.t62') ?></span></button></li>
          <li role="presentation"><button type="button" class="vfr" role="tab" aria-selected="false" aria-controls="vfScr" data-img="/images/demo/shot-2.svg" data-vid="/images/demo/shot-2.mp4" data-poster="/images/demo/shot-2-poster.jpg" data-sub="<?= t('home.sub2') ?>"><i>02</i><b><?= t('home.t63') ?></b><span><?= t('home.t64') ?></span></button></li>
          <li role="presentation"><button type="button" class="vfr" role="tab" aria-selected="false" aria-controls="vfScr" data-img="/images/demo/shot-3.svg" data-vid="/images/demo/shot-3.mp4" data-poster="/images/demo/shot-3-poster.jpg" data-sub="<?= t('home.sub3') ?>"><i>03</i><b><?= t('home.t65') ?></b><span><?= t('home.t66') ?></span></button></li>
          <li role="presentation"><button type="button" class="vfr" role="tab" aria-selected="false" aria-controls="vfScr" data-img="/images/demo/shot-4.svg" data-vid="/images/demo/shot-4.mp4" data-poster="/images/demo/shot-4-poster.jpg" data-sub="<?= t('home.sub4') ?>"><i>04</i><b><?= t('home.t67') ?></b><span><?= t('home.t68') ?></span></button></li>
        </ul>
        <div>
          <p class="lb" style="margin-bottom:12px"><?= t('home.t69') ?></p>
          <div class="stack vf-get">
            <i><?= t('home.t70') ?></i><i><?= t('home.t71') ?></i><i><?= t('home.t72') ?></i><i><?= t('home.t73') ?></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="band">
  <div class="bcell"><b>2017</b><span><?= t('home.t74') ?></span></div>
  <div class="bcell"><b data-count="<?= $wc['n'] ?>"><?= $wc['n'] ?></b><span><?= t('home.t75') ?></span></div>
  <div class="bcell"><b data-count="6">6</b><span><?= t('home.t76') ?></span></div>
</section>

<section class="sec" id="about">
  <div class="wrap">
    <div class="about">
      <div class="studio-shot rv">
        <?php /* Снимка студии пока нет, и запрос за ним давал 404 на каждой загрузке.
                 Появится images/studio.jpg — вернуть сюда:
                 <img class="media" src="/images/studio.jpg" alt="Фотография студии MGuliyev Studio, Баку"
                      loading="lazy" width="900" height="900">
                 До тех пор блок показывает подложку .wall с логотипом — так и задумано. */ ?>
        <div class="wall ph-only" aria-hidden="true"><img src="/images/brand/guliyev-white-logo.svg" alt="" width="838" height="346" loading="lazy"></div>
        <span class="cap ph-only"><?= t('home.t77') ?></span>
      </div>
      <div class="rv">
        <?php /* Заголовок, а не подпись: иначе при переходе по заголовкам блок
                 «О студии» не находился, а принципы попадали под «Вертикальный формат». */ ?>
        <h2 class="lb" style="margin-bottom:18px"><?= t('home.t78') ?></h2>
        <p class="about-lead"><?= t('home.t79') ?></p>
        <p class="sub" style="margin-top:20px"><?= t('home.t80') ?></p>
        <p class="sub"><?= t('home.t81') ?></p>
        <p class="sub"><?= t('home.t82') ?></p>
        <div class="princ">
          <div><h3><?= t('home.t83') ?></h3><p><?= t('home.t84') ?></p></div>
          <div><h3><?= t('home.t85') ?></h3><p><?= t('home.t86') ?></p></div>
          <div><h3><?= t('home.t87') ?></h3><p><?= t('home.t88') ?></p></div>
        </div>
        <div class="stack">
          <i>WordPress</i><i>WooCommerce</i><i>Elementor</i><i>ACF</i><i>WPML</i><i>Yoast SEO</i><i>Figma</i><i>Photoshop</i><i>Illustrator</i><i>Google Analytics</i><i>Search Console</i><i>Cloudflare</i><i>Premiere Pro</i><i>After Effects</i><i>Meta Business Suite</i>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="sec" id="process" style="padding-top:0">
  <div class="wrap">
    <h2 class="disp h2 rv" style="margin-bottom:clamp(24px,3.2vw,44px)"><?= t('home.t89') ?> <span class="ser"><?= t('home.t90') ?></span></h2>
    <div class="steps rv">
      <div class="st"><div class="st-top"><b>01</b><svg class="st-ico" viewBox="0 0 24 24" aria-hidden="true"><rect x="4.5" y="3" width="15" height="18" rx="2"></rect><path d="M8 8h8M8 12h8M8 16h5"></path></svg></div><h3><?= t('home.t91') ?></h3><p><?= t('home.t92') ?></p></div>
      <div class="st"><div class="st-top"><b>02</b><svg class="st-ico" viewBox="0 0 24 24" aria-hidden="true"><rect x="9" y="3" width="6" height="5" rx="1"></rect><rect x="3" y="16" width="6" height="5" rx="1"></rect><rect x="15" y="16" width="6" height="5" rx="1"></rect><path d="M12 8v3.5M6 16v-4.5h12V16"></path></svg></div><h3><?= t('home.t93') ?></h3><p><?= t('home.t94') ?></p></div>
      <div class="st"><div class="st-top"><b>03</b><svg class="st-ico" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="16" rx="2"></rect><path d="M3 9h18M9 9v11"></path></svg></div><h3><?= t('home.t95') ?></h3><p><?= t('home.t96') ?></p></div>
      <div class="st"><div class="st-top"><b>04</b><svg class="st-ico" viewBox="0 0 24 24" aria-hidden="true"><path d="m8 7-5 5 5 5M16 7l5 5-5 5M13.5 5l-3 14"></path></svg></div><h3><?= t('home.t97') ?></h3><p><?= t('home.t98') ?></p></div>
      <div class="st"><div class="st-top"><b>05</b><svg class="st-ico" viewBox="0 0 24 24" aria-hidden="true"><path d="M13 4h7v7M20 4l-8 8"></path><path d="M18 14v4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4"></path></svg></div><h3><?= t('home.t99') ?></h3><p><?= t('home.t100') ?></p></div>
      <div class="st"><div class="st-top"><b>06</b><svg class="st-ico" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3 4.5 6v5.5c0 4.3 3.1 8.3 7.5 9.5 4.4-1.2 7.5-5.2 7.5-9.5V6L12 3Z"></path><path d="m9 12 2.2 2.2L15.5 10"></path></svg></div><h3><?= t('home.t101') ?></h3><p><?= t('home.t102') ?></p></div>
    </div>
  </div>
</section>

<section class="sec" id="price" style="padding-top:0">
  <div class="wrap">
    <div class="shead rv">
      <h2 class="disp h2"><?= t('home.t103') ?></h2>
      <p class="sub" style="font-size:.88rem;max-width:42ch"><?= t('home.t104') ?></p>
    </div>
    <div class="plist rv">
      <div class="pr"><h3><?= t('home.t105') ?></h3><p><?= t('home.t106') ?></p><span class="amt">₼700<small><?= t('home.t107') ?></small></span></div>
      <div class="pr"><h3><?= t('home.t108') ?></h3><p><?= t('home.t109') ?></p><span class="amt">₼1 190<small><?= t('home.t110') ?></small></span></div>
      <div class="pr"><h3><?= t('home.t111') ?></h3><p><?= t('home.t112') ?></p><span class="amt">₼1 800<small><?= t('home.t113') ?></small></span></div>
      <div class="pr"><h3><?= t('home.t114') ?></h3><p><?= t('home.t115') ?></p><span class="amt">₼690<small><?= t('home.t116') ?></small></span></div>
    </div>
    <p class="note rv"><?= t('home.t117') ?></p>
  </div>
</section>

<section class="sec" id="blog" style="padding-top:0">
  <div class="wrap">
    <div class="shead rv">
      <h2 class="disp h2"><?= t('home.t118') ?></h2>
      <a class="pill" href="<?= u('/blog/') ?>"><?= t('home.t119') ?></a>
    </div>
    <?php $arts = articles(); ?>
    <div class="posts rv">
      <?php foreach ($arts as $a): ?>
      <article class="post">
        <div class="pm"><span><?= htmlspecialchars($a['rubric']) ?></span><span><?= date_h((string)$a['date']) ?> · <?= tn('blog.read', ['n' => (int)$a['read']]) ?></span></div>
        <h3><a href="<?= u('/blog/' . $a['slug'] . '/') ?>"><?= htmlspecialchars($a['title']) ?></a></h3>
        <p><?= htmlspecialchars($a['desc']) ?></p>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="sec" id="faq" style="padding-top:0">
  <div class="wrap">
    <h2 class="disp h2 rv" style="margin-bottom:clamp(20px,2.8vw,36px)"><?= t('home.t120') ?></h2>
    <div class="faq rv">
      <details open><summary><?= t('home.t121') ?></summary><p><?= t('home.t122') ?></p></details>
      <details><summary><?= t('home.t123') ?></summary><p><?= t('home.t124') ?></p></details>
      <details><summary><?= t('home.t125') ?></summary><p><?= t('home.t126') ?></p></details>
      <details><summary><?= t('home.t127') ?></summary><p><?= t('home.t128') ?></p></details>
      <details><summary><?= t('home.t129') ?></summary><p><?= t('home.t130') ?></p></details>
    </div>
  </div>
</section>

<section class="sec" id="contact" style="background:var(--off);border-top:1px solid var(--line)">
  <div class="wrap">
    <h2 class="lb rv" id="lead-h" style="margin-bottom:clamp(18px,2.4vw,32px)"><?= t('home.t131') ?></h2>
    <?php /* lang="en": адрес набран заглавными, и на /az/ i превращалась в İ */ ?>
    <a class="mailto rv" lang="en" href="mailto:<?= e(s('email')) ?>"><?= e(sv('email')) ?></a>
    <div class="cgrid rv">
      <div class="cg"><em><?= t('home.t132') ?></em><a href="<?= e(tel_href()) ?>"><?= e(sv('phone')) ?></a></div>
      <?php /* Ссылка появляется, только когда адрес профиля задан: ссылка
           в никуда хуже отсутствия ссылки. */ ?>
      <div class="cg"><em>Instagram</em><?php if (su('instagram') !== ''): ?><a href="<?= e(su('instagram')) ?>" target="_blank" rel="noopener me"><?= e(s('instagram_name') !== '' ? s('instagram_name') : su('instagram')) ?></a><?php else: ?><span><?= e(sv('instagram')) ?></span><?php endif; ?></div>
      <div class="cg"><em><?= t('home.t133') ?></em><span><?= t('home.t134') ?></span></div>
      <?php /* Часы — из настройки панели, как в меню: копия в словаре с ней расходилась. */ ?>
      <div class="cg"><em><?= t('home.t135') ?></em><span><?= e(sv('hours')) ?></span></div>
    </div>
    <?php /* Адрес с префиксом языка: send.php узнаёт язык только из адреса,
             и без префикса ответы и пометка языка в заявке были русскими. */ ?>
    <form class="rv" id="lead" aria-labelledby="lead-h" method="post" action="<?= e(u('/send.php')) ?>" data-retry="<?= t('form.retry') ?>">
      <?php /* Ловушка для ботов: человек этого поля не видит и не заполнит.
             Рядом отметка времени — мгновенная отправка выдаёт автомат. */ ?>
      <input type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true"
             style="position:absolute;left:-9999px;width:1px;height:1px;opacity:0">
      <input type="hidden" name="ts" value="<?= time() ?>">
      <input type="hidden" name="back" value="<?= htmlspecialchars(I18n::u(I18n::path()), ENT_QUOTES) ?>">
      <div><label for="fn"><?= t('home.t137') ?></label><input id="fn" name="name" autocomplete="name" required></div>
      <div><label for="fp"><?= t('home.t138') ?></label><input id="fp" name="phone" type="tel" autocomplete="tel" placeholder="+994 __ ___ __ __" required></div>
      <div><label for="fs"><?= t('home.t139') ?></label>
        <select id="fs" name="service"><option><?= t('home.t140') ?></option><option>SEO</option><option><?= t('home.t141') ?></option><option><?= t('home.t142') ?></option><option>SMM</option><option><?= t('home.t143') ?></option><option><?= t('home.t144') ?></option></select>
      </div>
      <div><label for="fb"><?= t('home.t145') ?></label>
        <select id="fb" name="budget"><option><?= t('home.t146') ?></option><option>₼500 – ₼1 500</option><option>₼1 500 – ₼3 000</option><option><?= t('home.t147') ?></option></select>
      </div>
      <div class="full"><label for="fm"><?= t('home.t148') ?></label><textarea id="fm" name="message" placeholder="<?= t('home.t161') ?>"></textarea></div>
      <?php /* Проверка «человек ли это». Виджет сам кладёт в форму скрытое
               поле с токеном, поэтому и отправка через fetch, и обычная
               отправка формы работают без правок в скрипте. */ ?>
      <?php if (ts_on()): ?>
        <div class="full"><?= ts_widget('lead', 'dark') ?></div>
        <noscript><p class="status" style="color:var(--duo-b)"><?= t('form.captcha_nojs') ?></p></noscript>
      <?php endif; ?>
      <div class="full" style="display:flex;align-items:center;gap:22px;flex-wrap:wrap"><button class="btn" type="submit"><?= t('home.t149') ?></button><p class="status" id="lead-status" role="status"><?= isset($_GET['sent']) ? t('form.ok') : (isset($_GET['error']) ? t('form.error') : '') ?></p></div>
    </form>
  </div>
</section>
</main>
<?php include __DIR__ . '/../app/partials/foot.php'; ?>
