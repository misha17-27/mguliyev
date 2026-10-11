<?php
$page = 'contacts';
$current = 'contact';
include __DIR__ . '/../../app/partials/head.php';
?>
<main id="top">
<section class="sec">
  <div class="wrap">
    <div class="shead">
      <h1 class="disp h2">Контакты</h1>
      <p class="lb">Баку · GMT+4</p>
    </div>

    <div class="cgrid" style="margin-top:0;border-top:0;padding-top:0">
      <div class="cg"><em>Почта</em><a href="mailto:info@mguliyev.com">info@mguliyev.com</a></div>
      <div class="cg"><em>Телефон</em><a href="tel:+994552155363">+994 55 215 53 63</a></div>
      <div class="cg"><em>Часы работы</em><span>пн–пт · 10:00–19:00</span></div>
      <div class="cg"><em>Где</em><span>Баку, Азербайджан</span></div>
    </div>
    <p class="note">[УТОЧНИТЬ: WhatsApp на этом же номере? Тогда добавим кнопку со ссылкой wa.me] · [УТОЧНИТЬ: адрес офиса, если к вам можно приехать]</p>

    <div style="margin-top:clamp(40px,5vw,68px)">
      <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:18px">Куда писать по какому поводу</h2>
      <div class="steps" style="margin-top:0">
        <div class="st">
          <h4>Новый проект</h4>
          <p>На почту или через форму ниже. Чем конкретнее задача, тем точнее первое предложение.</p>
        </div>
        <div class="st">
          <h4>Текущий сайт</h4>
          <p>Поломка, правки, вопрос по хостингу или почте — на тот же адрес, указав в теме домен.
            Так письмо не потеряется среди новых заявок.</p>
        </div>
        <div class="st">
          <h4>Сотрудничество</h4>
          <p>Подряд, партнёрство, резюме — туда же, с пометкой в теме.</p>
        </div>
      </div>
    </div>

    <div class="about" style="margin-top:clamp(40px,5vw,68px)">
      <div>
        <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:16px">Что приложить к первому письму</h2>
        <p class="sub" style="font-size:.9rem;margin-bottom:14px">Чтобы ответить по делу с первого раза, хватит пяти строк.</p>
        <ul class="plain">
          <li>Чем занимается компания и кто ваш клиент.</li>
          <li>Ссылка на текущий сайт и соцсети, если они есть.</li>
          <li>Что не устраивает сейчас — или что нужно сделать с нуля.</li>
          <li>Два-три сайта, которые вам нравятся, и чем именно.</li>
          <li>Срок и примерный диапазон бюджета.</li>
        </ul>
        <p class="sub" style="font-size:.88rem;margin-top:14px">Бюджет спрашиваем не чтобы подогнать
          под него цену, а чтобы не предлагать лишнего.</p>
      </div>
      <div>
        <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:16px">Что происходит после заявки</h2>
        <ul class="plain">
          <li>Читаем и задаём уточняющие вопросы — письмом или звонком, как вам удобнее.</li>
          <li>Присылаем предложение: состав работ, этапы и сумма. В течение суток после брифа.</li>
          <li>Если всё устраивает — 50% в начале работ и 50% при сдаче. Абонентские услуги помесячно или за год.</li>
        </ul>
        <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin:26px 0 16px">Языки и география</h2>
        <p class="sub" style="font-size:.9rem">Сайт пока на русском, азербайджанская и английская
          версии в работе. Среди проектов есть сайты для клиентов в Венгрии, Австрии, Канаде,
          на Кипре и в Украине.</p>
      </div>
    </div>

    <div id="zayavka" style="margin-top:clamp(44px,5vw,72px);padding-top:clamp(24px,3vw,36px);border-top:1px solid var(--line)">
      <h2 class="disp h2">Оставить заявку</h2>
      <form id="lead" style="margin-top:clamp(24px,3vw,38px)">
        <div><label for="fn">Имя</label><input id="fn" name="name" autocomplete="name" required></div>
        <div><label for="fp">Телефон / WhatsApp</label><input id="fp" name="phone" type="tel" autocomplete="tel" placeholder="+994 __ ___ __ __" required></div>
        <div><label for="fs">Направление</label>
          <select id="fs" name="service"><option>Веб-сайты</option><option>Дизайн</option><option>Цифровой маркетинг</option><option>Техническая поддержка</option><option>Не определился</option></select>
        </div>
        <div><label for="fb">Примерный бюджет</label>
          <select id="fb" name="budget"><option>до ₼700</option><option>₼700 – ₼1 500</option><option>₼1 500 – ₼3 000</option><option>от ₼3 000</option></select>
        </div>
        <div class="full"><label for="fm">Коротко о задаче</label><textarea id="fm" name="message" placeholder="Сфера бизнеса, ссылка на текущий сайт, что хотите получить…"></textarea></div>
        <div class="full" style="display:flex;align-items:center;gap:22px;flex-wrap:wrap"><button class="btn" type="submit">Отправить</button><p class="status" id="lead-status" role="status"></p></div>
      </form>
    </div>
  </div>
</section>
</main>
<?php include __DIR__ . '/../../app/partials/foot.php'; ?>
