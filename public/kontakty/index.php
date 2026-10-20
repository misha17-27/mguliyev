<?php
require __DIR__ . '/../../app/bootstrap.php';
$page = 'contacts';
$current = 'contact';
include __DIR__ . '/../../app/partials/head.php';
?>
<main id="top">
<section class="sec">
  <div class="wrap">
    <div class="shead">
      <h1 class="disp h2"><?= t('contacts.t1') ?></h1>
      <p class="lb"><?= t('contacts.t2') ?></p>
    </div>

    <div class="cgrid" style="margin-top:0;border-top:0;padding-top:0">
      <div class="cg"><em><?= t('contacts.t3') ?></em><a href="mailto:<?= e(s('email')) ?>"><?= e(sv('email')) ?></a></div>
      <div class="cg"><em><?= t('contacts.t4') ?></em><a href="<?= e(tel_href()) ?>"><?= e(sv('phone')) ?></a></div>
      <div class="cg"><em><?= t('contacts.t5') ?></em><span><?= t('contacts.t6') ?></span></div>
      <div class="cg"><em><?= t('contacts.t7') ?></em><span><?= t('contacts.t8') ?></span></div>
    </div>
    <?php /* WhatsApp и адрес: кнопка и строка появляются, когда поля
           заполнены в панели. Пока пусто — видимая пометка. */ ?>
    <?php if (wa_href() !== '' || has_s('address')): ?>
      <p style="margin-top:18px">
        <?php if (wa_href() !== ''): ?>
          <a class="btn btn-o" href="<?= e(wa_href()) ?>" target="_blank" rel="noopener">WhatsApp</a>
        <?php endif; ?>
        <?php if (has_s('address')): ?>
          <span class="note" style="margin-left:12px"><?= e(s('address')) ?></span>
        <?php endif; ?>
      </p>
    <?php else: ?>
      <p class="note"><?= e(sv('whatsapp')) ?> · <?= e(sv('address')) ?></p>
    <?php endif; ?>

    <div style="margin-top:clamp(40px,5vw,68px)">
      <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:18px"><?= t('contacts.t9') ?></h2>
      <div class="steps" style="margin-top:0">
        <div class="st">
          <h4><?= t('contacts.t10') ?></h4>
          <p><?= t('contacts.t11') ?></p>
        </div>
        <div class="st">
          <h4><?= t('contacts.t12') ?></h4>
          <p><?= t('contacts.t13') ?></p>
        </div>
        <div class="st">
          <h4><?= t('contacts.t14') ?></h4>
          <p><?= t('contacts.t15') ?></p>
        </div>
      </div>
    </div>

    <div class="about" style="margin-top:clamp(40px,5vw,68px)">
      <div>
        <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:16px"><?= t('contacts.t16') ?></h2>
        <p class="sub" style="font-size:.9rem;margin-bottom:14px"><?= t('contacts.t17') ?></p>
        <ul class="plain">
          <li><?= t('contacts.t18') ?></li>
          <li><?= t('contacts.t19') ?></li>
          <li><?= t('contacts.t20') ?></li>
          <li><?= t('contacts.t21') ?></li>
          <li><?= t('contacts.t22') ?></li>
        </ul>
        <p class="sub" style="font-size:.88rem;margin-top:14px"><?= t('contacts.t23') ?></p>
      </div>
      <div>
        <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:16px"><?= t('contacts.t24') ?></h2>
        <ul class="plain">
          <li><?= t('contacts.t25') ?></li>
          <li><?= t('contacts.t26') ?></li>
          <li><?= t('contacts.t27') ?></li>
        </ul>
        <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin:26px 0 16px"><?= t('contacts.t28') ?></h2>
        <p class="sub" style="font-size:.9rem"><?= t('contacts.t29') ?></p>
      </div>
    </div>

    <div id="zayavka" style="margin-top:clamp(44px,5vw,72px);padding-top:clamp(24px,3vw,36px);border-top:1px solid var(--line)">
      <h2 class="disp h2"><?= t('contacts.t30') ?></h2>
      <form id="lead" method="post" action="/send.php" style="margin-top:clamp(24px,3vw,38px)">
      <?php /* Ловушка для ботов: человек этого поля не видит и не заполнит.
             Рядом отметка времени — мгновенная отправка выдаёт автомат. */ ?>
      <input type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true"
             style="position:absolute;left:-9999px;width:1px;height:1px;opacity:0">
      <input type="hidden" name="ts" value="<?= time() ?>">
      <input type="hidden" name="back" value="<?= htmlspecialchars(I18n::u(I18n::path()), ENT_QUOTES) ?>">
        <div><label for="fn"><?= t('contacts.t31') ?></label><input id="fn" name="name" autocomplete="name" required></div>
        <div><label for="fp"><?= t('contacts.t32') ?></label><input id="fp" name="phone" type="tel" autocomplete="tel" placeholder="+994 __ ___ __ __" required></div>
        <div><label for="fs"><?= t('contacts.t33') ?></label>
          <select id="fs" name="service"><option><?= t('contacts.t34') ?></option><option><?= t('contacts.t35') ?></option><option><?= t('contacts.t36') ?></option><option><?= t('contacts.t37') ?></option><option><?= t('contacts.t38') ?></option></select>
        </div>
        <div><label for="fb"><?= t('contacts.t39') ?></label>
          <select id="fb" name="budget"><option><?= t('contacts.t40') ?></option><option>₼700 – ₼1 500</option><option>₼1 500 – ₼3 000</option><option><?= t('contacts.t41') ?></option></select>
        </div>
        <div class="full"><label for="fm"><?= t('contacts.t42') ?></label><textarea id="fm" name="message" placeholder="<?= t('contacts.t44') ?>"></textarea></div>
        <?php /* Проверка «человек ли это». Виджет сам кладёт в форму скрытое
                 поле с токеном, поэтому и отправка через fetch, и обычная
                 отправка формы работают без правок в скрипте. Нет ключей
                 в панели — нет и виджета, форма работает как прежде. */ ?>
        <?php if (ts_on()): ?>
          <div class="full"><?= ts_widget('lead') ?></div>
          <noscript><p class="status" style="color:var(--duo-b)"><?= e(t('form.captcha_nojs')) ?></p></noscript>
        <?php endif; ?>
        <div class="full" style="display:flex;align-items:center;gap:22px;flex-wrap:wrap"><button class="btn" type="submit"><?= t('contacts.t43') ?></button><p class="status" id="lead-status" role="status"><?= isset($_GET['sent']) ? htmlspecialchars(t('form.ok')) : (isset($_GET['error']) ? htmlspecialchars(t('form.error')) : '') ?></p></div>
      </form>
    </div>
  </div>
</section>
</main>
<?php include __DIR__ . '/../../app/partials/foot.php'; ?>
