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
        <p class="lb" style="margin-bottom:clamp(20px,2.8vw,34px)">Баку · веб · seo · smm · видео</p>
        <h1 class="disp"><span class="ln">Как ваш бренд</span><span class="ln ser duo-text">выглядит</span><span class="ln">на экране?</span></h1>
      </div>
      <div class="phone">
        <div class="screen">
          <div class="bars" aria-hidden="true"><i></i><i></i><i></i></div>
          <div class="slide">
            <img class="media" src="/images/home/reel-1.jpg" data-ph="/images/placeholder/reel-1.svg" alt="Сайт SOCAR Midstream Operations" width="608" height="2400">
            <span class="scrim"></span>
            <b>SOCAR<br>Midstream</b><small>Нефтегазовая инфраструктура</small>
          </div>
          <div class="slide">
            <img class="media" src="/images/home/reel-2.jpg" data-ph="/images/placeholder/reel-2.svg" alt="Интернет-магазин акварельных портретов YMK Watercolor" width="640" height="2400">
            <span class="scrim"></span>
            <b>YMK<br>Watercolor</b><small>Интернет-магазин · продажа за рубеж</small>
          </div>
          <div class="slide">
            <img class="media" src="/images/home/reel-3.jpg" data-ph="/images/placeholder/reel-3.svg" alt="Сайт пищевого производства Elson Group" width="640" height="2202">
            <span class="scrim"></span>
            <b>Elson<br>Group</b><small>Каталог продукции · пищевое производство</small>
          </div>
        </div>
        <span class="phone-tag">9:16 · наши работы</span>
      </div>
    </div>
    <div class="hero-foot">
      <p class="sub">Делаем сайты, поднимаем их в поиске, ведём соцсети и снимаем вертикальное видео. Шесть услуг — одна команда, один отчёт, один телефон.</p>
      <div class="hero-cta">
        <a class="btn" href="#contact">Оставить заявку</a>
        <a class="btn btn-o" href="#portfolio">Смотреть портфолио</a>
      </div>
    </div>
  </div>
</section>

<div class="mq" aria-hidden="true">
  <div class="mq-t">
    <b>Сайты</b><em>&amp;</em><b>SEO</b><em>&amp;</em><b>Почта</b><em>&amp;</em><b>Хостинг</b><em>&amp;</em><b>SMM</b><em>&amp;</em><b>Reels</b><em>&amp;</em>
    <b>Сайты</b><em>&amp;</em><b>SEO</b><em>&amp;</em><b>Почта</b><em>&amp;</em><b>Хостинг</b><em>&amp;</em><b>SMM</b><em>&amp;</em><b>Reels</b><em>&amp;</em>
  </div>
</div>

<section class="sec" id="services">
  <div class="wrap">
    <div class="shead rv">
      <h2 class="disp h2">Что делаем</h2>
      <p class="sub" style="font-size:.9rem;max-width:40ch">Услуги можно взять по отдельности, но лучший результат получается, когда они работают вместе.</p>
    </div>
    <div class="rows rv">
      <a class="row" href="<?= u('/uslugi/veb-sayty/') ?>">
        <span class="rname">Сайты</span>
        <span class="rdesc">Корпоративные сайты, интернет-магазины и лендинги. Индивидуальный дизайн, мультиязычность, понятная админка.</span>
        <span class="rmeta">10–25 дней</span>
      </a>
      <a class="row" href="<?= u('/uslugi/marketing/') ?>">
        <span class="rname">SEO</span>
        <span class="rdesc">Технический аудит, семантика, контент и ссылочный профиль. Ежемесячный отчёт по позициям.</span>
        <span class="rmeta">3–6 месяцев</span>
      </a>
      <a class="row" href="<?= u('/uslugi/podderzhka/') ?>">
        <span class="rname">Почта</span>
        <span class="rdesc">имя@вашакомпания.az. SPF, DKIM и DMARC — письма не уходят в спам. Перенос старых ящиков без потерь.</span>
        <span class="rmeta">1 день</span>
      </a>
      <a class="row" href="<?= u('/uslugi/podderzhka/') ?>">
        <span class="rname">Хостинг</span>
        <span class="rdesc">Размещение сайта и почты, еженедельные резервные копии, SSL. Домен оформляется на вас.</span>
        <span class="rmeta">абонентская</span>
      </a>
      <a class="row" href="<?= u('/uslugi/marketing/') ?>">
        <span class="rname">SMM</span>
        <span class="rdesc">Контент-план, дизайн, тексты и таргетированная реклама Meta Ads. Instagram и Facebook.</span>
        <span class="rmeta">ежемесячно</span>
      </a>
      <a class="row" href="<?= u('/uslugi/marketing/') ?>">
        <span class="rname">Видео и Reels</span>
        <span class="rdesc">Съёмка, монтаж, цветокоррекция, субтитры и моушн-графика. Вертикальный формат 9:16.</span>
        <span class="rmeta">9:16</span>
      </a>
    </div>
  </div>
</section>

<section class="sec" id="portfolio" style="padding-top:0">
  <div class="wrap">
    <div class="shead rv">
      <h2 class="disp h2">Портфолио</h2>
      <p class="lb">избранное · всего 49 проектов</p>
    </div>
    <div class="works rv">
      <a class="work" href="https://qarabagh.shop" target="_blank" rel="noopener">
        <div class="cover w1"><img class="media" src="/images/home/work-1.jpg" data-ph="/images/placeholder/work-1.svg" alt="Официальный интернет-магазин ФК «Карабах»" loading="lazy" width="1200" height="750"><b class="ph-only">Спорт</b></div>
        <h3>Официальный магазин ФК «Карабах»</h3>
        <div class="wmeta"><span>Интернет-магазин</span><b>qarabagh.shop</b></div>
      </a>
      <a class="work" href="https://lynkco.az" target="_blank" rel="noopener">
        <div class="cover w2"><img class="media" src="/images/home/work-2.jpg" data-ph="/images/placeholder/work-2.svg" alt="Сайт официального дистрибьютора Lynk &amp; Co в Азербайджане" loading="lazy" width="1200" height="750"><b class="ph-only">Авто</b></div>
        <h3>Lynk &amp; Co Азербайджан</h3>
        <div class="wmeta"><span>Официальный дистрибьютор</span><b>lynkco.az</b></div>
      </a>
      <a class="work" href="https://marshal.az" target="_blank" rel="noopener">
        <div class="cover w3"><img class="media" src="/images/home/work-3.jpg" data-ph="/images/placeholder/work-3.svg" alt="Сайт таксопарка Marshal, партнёра Uber" loading="lazy" width="1200" height="750"><b class="ph-only">Такси</b></div>
        <h3>Marshal — партнёр Uber</h3>
        <div class="wmeta"><span>Сайт таксопарка</span><b>marshal.az</b></div>
      </a>
      <a class="work" href="https://grandmoto.az" target="_blank" rel="noopener">
        <div class="cover w4"><img class="media" src="/images/home/work-4.jpg" data-ph="/images/placeholder/work-4.svg" alt="Сайт дистрибьютора мотоциклов Grandmoto" loading="lazy" width="1200" height="750"><b class="ph-only">Мото</b></div>
        <h3>Grandmoto</h3>
        <div class="wmeta"><span>Дистрибьютор мотоциклов</span><b>grandmoto.az</b></div>
      </a>
      <a class="work" href="https://store.az" target="_blank" rel="noopener">
        <div class="cover w5"><img class="media" src="/images/home/work-5.jpg" data-ph="/images/placeholder/work-5.svg" alt="Интернет-магазин компьютерной техники Store.az" loading="lazy" width="1200" height="750"><b class="ph-only">Техника</b></div>
        <h3>Store.az</h3>
        <div class="wmeta"><span>Магазин техники</span><b>store.az</b></div>
      </a>
      <a class="work" href="https://flower.az" target="_blank" rel="noopener">
        <div class="cover w6"><img class="media" src="/images/home/work-6.jpg" data-ph="/images/placeholder/work-6.svg" alt="Интернет-магазин цветов Flower.az" loading="lazy" width="1200" height="750"><b class="ph-only">Цветы</b></div>
        <h3>Flower.az</h3>
        <div class="wmeta"><span>Доставка цветов</span><b>flower.az</b></div>
      </a>
    </div>
  </div>
</section>

<section class="sec" id="reels" style="padding-top:0">
  <div class="wrap">
    <div class="shead rv">
      <h2 class="disp h2">Вертикальный <span class="ser">формат</span></h2>
      <p class="lb">9:16 · 1080×1920</p>
    </div>
    <div class="vf rv">
      <figure class="vf-mon">
        <div class="vf-scr" id="vfScr" role="tabpanel" aria-label="Разметка вертикального кадра">
          <img class="vf-shot" id="vfShot" src="/images/demo/shot-1.svg" alt="" width="1080" height="1920">
          <div class="vf-osd" aria-hidden="true"><span class="vf-stby"><i></i><em id="vfState">stby</em></span><span>9:16</span></div>
          <div class="vf-bars" id="vfBars" aria-hidden="true"><i></i><i></i><i></i></div>
          <div class="vf-zone top"><span>шапка площадки</span></div>
          <div class="vf-safe">
            <span class="vf-guide" aria-hidden="true"></span>
            <span class="vf-corners" aria-hidden="true"></span>
            <p class="vf-lb">безопасная зона</p>
            <b class="vf-now" id="vfNow" aria-live="polite">Открытия и события</b>
            <p class="vf-cc" id="vfCC">снимаем в день события</p>
            <span class="vf-dim" aria-hidden="true">1080 px · 65% высоты кадра</span>
          </div>
          <div class="vf-zone bot"><span>подпись, кнопки, звук</span></div>
          <span class="vf-tc" aria-hidden="true">00:00:00:00</span>
        </div>
        <figcaption>Кадры демонстрационные. Треть вертикального кадра забирает интерфейс площадки — поэтому субтитры и смысл держим в безопасной зоне, а кадр планируем заранее, а не обрезаем из готового видео.</figcaption>
      </figure>

      <div class="vf-side">
        <p class="lb">что снимаем</p>
        <ul class="vf-list" id="vfList" role="tablist" aria-label="Форматы съёмки">
          <li role="presentation"><button type="button" class="vfr" role="tab" aria-selected="true" aria-controls="vfScr" data-img="/images/demo/shot-1.svg" data-vid="/images/demo/shot-1.mp4" data-poster="/images/demo/shot-1-poster.jpg" data-sub="снимаем в день события|режем под ритм площадки|субтитры вшиваем в кадр"><i>01</i><b>Открытия и события</b><span>Открытие точки, выставка, конференция, годовщина.</span></button></li>
          <li role="presentation"><button type="button" class="vfr" role="tab" aria-selected="false" aria-controls="vfScr" data-img="/images/demo/shot-2.svg" data-vid="/images/demo/shot-2.mp4" data-poster="/images/demo/shot-2-poster.jpg" data-sub="снимаем на территории|крупные планы работы|показываем масштаб"><i>02</i><b>Объект и производство</b><span>Съёмка на территории: цех, склад, стройка, автопарк, торговый зал.</span></button></li>
          <li role="presentation"><button type="button" class="vfr" role="tab" aria-selected="false" aria-controls="vfScr" data-img="/images/demo/shot-3.svg" data-vid="/images/demo/shot-3.mp4" data-poster="/images/demo/shot-3-poster.jpg" data-sub="специалист говорит в кадр|показываем процесс|сложное объясняем просто"><i>03</i><b>Услуга и специалист</b><span>Разговор в кадре плюс процесс работы: клиника, салон, сервис, тренер.</span></button></li>
          <li role="presentation"><button type="button" class="vfr" role="tab" aria-selected="false" aria-controls="vfScr" data-img="/images/demo/shot-4.svg" data-vid="/images/demo/shot-4.mp4" data-poster="/images/demo/shot-4-poster.jpg" data-sub="товар крупно и в деле|фактура и детали|обложка под ленту"><i>04</i><b>Товар и коллекция</b><span>Предметная съёмка: новая коллекция, поступление, сезон, витрина.</span></button></li>
        </ul>
        <div>
          <p class="lb" style="margin-bottom:12px">что получает клиент</p>
          <div class="stack vf-get">
            <i>Готовый ролик 9:16</i><i>Вшитые субтитры</i><i>Обложка для ленты</i><i>Исходники съёмки</i>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="band">
  <div class="bcell"><b>2017</b><span>год основания студии</span></div>
  <div class="bcell"><b data-count="49">49</b><span>проектов в портфолио</span></div>
  <div class="bcell"><b data-count="6">6</b><span>направлений в одном подряде</span></div>
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
        <span class="cap ph-only">MGuliyev Studio · Баку, с 2017 года</span>
      </div>
      <div class="rv">
        <p class="lb" style="margin-bottom:18px">О студии</p>
        <p class="about-lead">MGuliyev Studio работает в Баку с 2017 года — и остаётся с проектами после запуска, потому что именно тогда начинается самое важное.</p>
        <p class="sub" style="margin-top:20px">Начинали с разработки на WordPress, сейчас закрываем весь цифровой контур бизнеса: домен и хостинг, корпоративная почта, сайт, продвижение в поиске, соцсети и вертикальное видео. Шесть направлений, один подрядчик, один отчёт.</p>
        <p class="sub">Обычно сайт делает один исполнитель, хостинг продаёт второй, почту настраивал третий, а соцсети ведёт четвёртый — и при первой же поломке они выясняют между собой, чья это зона. Мы держим контур целиком, поэтому выяснять не с кем.</p>
        <p class="sub">Работаем без прослойки из менеджеров: вы говорите напрямую с теми, кто делает. Проектов в работе намеренно немного — каждый ведётся годами, а не сдаётся и забывается.</p>
        <div class="princ">
          <div><h4>Доступы ваши</h4><p>Домен, хостинг и админка оформляются на вас или вашу компанию — не на студию.</p></div>
          <div><h4>Проект, а не человек</h4><p>Структура, доступы и решения записаны. Исполнитель внутри студии может смениться — для вас ничего не меняется.</p></div>
          <div><h4>Отчёт по графику</h4><p>Трафик, позиции, охваты и состояние сервера — раз в месяц, а не по вашему напоминанию.</p></div>
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
    <h2 class="disp h2 rv" style="margin-bottom:clamp(24px,3.2vw,44px)">Как <span class="ser">работаем</span></h2>
    <div class="steps rv">
      <div class="st"><div class="st-top"><b>01</b><svg class="st-ico" viewBox="0 0 24 24" aria-hidden="true"><rect x="4.5" y="3" width="15" height="18" rx="2"></rect><path d="M8 8h8M8 12h8M8 16h5"></path></svg></div><h4>Бриф</h4><p>Разбираем бизнес, конкурентов и текущий сайт. Фиксируем аудиторию и цель проекта.</p></div>
      <div class="st"><div class="st-top"><b>02</b><svg class="st-ico" viewBox="0 0 24 24" aria-hidden="true"><rect x="9" y="3" width="6" height="5" rx="1"></rect><rect x="3" y="16" width="6" height="5" rx="1"></rect><rect x="15" y="16" width="6" height="5" rx="1"></rect><path d="M12 8v3.5M6 16v-4.5h12V16"></path></svg></div><h4>Структура</h4><p>Карта сайта, семантика и прототип согласовываются до того, как написана первая строка кода.</p></div>
      <div class="st"><div class="st-top"><b>03</b><svg class="st-ico" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="16" rx="2"></rect><path d="M3 9h18M9 9v11"></path></svg></div><h4>Дизайн</h4><p>Макет под фирменный стиль. Десктоп и мобильный утверждаются отдельно.</p></div>
      <div class="st"><div class="st-top"><b>04</b><svg class="st-ico" viewBox="0 0 24 24" aria-hidden="true"><path d="m8 7-5 5 5 5M16 7l5 5-5 5M13.5 5l-3 14"></path></svg></div><h4>Разработка</h4><p>Вёрстка, интеграции, настройка скорости и безопасности.</p></div>
      <div class="st"><div class="st-top"><b>05</b><svg class="st-ico" viewBox="0 0 24 24" aria-hidden="true"><path d="M13 4h7v7M20 4l-8 8"></path><path d="M18 14v4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4"></path></svg></div><h4>Запуск</h4><p>Тесты, перенос домена и почты, подключение аналитики и Search Console.</p></div>
      <div class="st"><div class="st-top"><b>06</b><svg class="st-ico" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3 4.5 6v5.5c0 4.3 3.1 8.3 7.5 9.5 4.4-1.2 7.5-5.2 7.5-9.5V6L12 3Z"></path><path d="m9 12 2.2 2.2L15.5 10"></path></svg></div><h4>Поддержка</h4><p>Ежемесячные обновления, бэкапы, контент и отчёт. Здесь работа не заканчивается.</p></div>
    </div>
  </div>
</section>

<section class="sec" id="price" style="padding-top:0">
  <div class="wrap">
    <div class="shead rv">
      <h2 class="disp h2">Цены</h2>
      <p class="sub" style="font-size:.88rem;max-width:42ch">Указаны стартовые суммы. Точное предложение — через 24 часа после брифа.</p>
    </div>
    <div class="plist rv">
      <div class="pr"><h3>Старт</h3><p>1–5 страниц · адаптив · базовое SEO · домен на год · 3 месяца хостинга</p><span class="amt">₼700<small>от</small></span></div>
      <div class="pr"><h3>Бизнес</h3><p>10–20 страниц · 3 языка · блог · расширенное SEO · Cloudflare</p><span class="amt">₼1 190<small>от</small></span></div>
      <div class="pr"><h3>Премиум</h3><p>WooCommerce · онлайн-оплата · интеграция со складом · скорость 90+</p><span class="amt">₼1 800<small>от</small></span></div>
      <div class="pr"><h3>Reels-подписка</h3><p>8 вертикальных видео в месяц · съёмка, монтаж, субтитры, контент-план · Instagram и TikTok</p><span class="amt">₼690<small>в месяц</small></span></div>
    </div>
    <p class="note rv">Во всех пакетах: первый месяц технической поддержки и подключение корпоративной почты — бесплатно.</p>
  </div>
</section>

<section class="sec" id="blog" style="padding-top:0">
  <div class="wrap">
    <div class="shead rv">
      <h2 class="disp h2">Блог</h2>
      <a class="pill" href="<?= u('/blog/') ?>">Все статьи</a>
    </div>
    <?php $arts = articles(); ?>
    <div class="posts rv">
      <?php foreach ($arts as $a): ?>
      <article class="post">
        <div class="pm"><span><?= htmlspecialchars($a['rubric']) ?></span><span><?= htmlspecialchars($a['date']) ?> · <?= (int)$a['read'] ?> мин</span></div>
        <h3><a href="<?= u('/blog/' . $a['slug'] . '/') ?>"><?= htmlspecialchars($a['title']) ?></a></h3>
        <p><?= htmlspecialchars($a['desc']) ?></p>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="sec" id="faq" style="padding-top:0">
  <div class="wrap">
    <h2 class="disp h2 rv" style="margin-bottom:clamp(20px,2.8vw,36px)">Вопросы</h2>
    <div class="faq rv">
      <details open><summary>На кого оформляются домен и хостинг?</summary><p>Всегда на вас или вашу компанию. Все доступы передаются при сдаче проекта — вы в любой момент можете уйти к другой команде и ничего не потеряете.</p></details>
      <details><summary>Можно ли перенести существующий сайт?</summary><p>Да. Переносим сайт, базу, почтовые ящики и DNS-записи. Время переключения согласовываем заранее — обычно ночью, чтобы не останавливать работу.</p></details>
      <details><summary>Когда будет результат от SEO?</summary><p>Эффект технических правок виден через 2–4 недели, устойчивые позиции по конкурентным запросам — через 3–6 месяцев. Каждый месяц присылаем отчёт с конкретными цифрами.</p></details>
      <details><summary>Кто снимает Reels?</summary><p>Съёмка в пределах Баку — наш оператор, по месячному графику. Если снимаете сами, можно взять только монтаж.</p></details>
      <details><summary>Как происходит оплата?</summary><p>50% в начале работ, 50% при сдаче. Абонентские услуги — помесячно или за год.</p></details>
    </div>
  </div>
</section>

<section class="sec" id="contact" style="background:var(--off);border-top:1px solid var(--line)">
  <div class="wrap">
    <p class="lb rv" style="margin-bottom:clamp(18px,2.4vw,32px)">Расскажите о проекте</p>
    <a class="mailto rv" href="mailto:info@mguliyev.com">info@mguliyev.com</a>
    <div class="cgrid rv">
      <div class="cg"><em>Телефон</em><a href="tel:+994552155363">+994 55 215 53 63</a></div>
      <div class="cg"><em>Instagram</em><a href="#">@mguliyev.studio</a></div>
      <div class="cg"><em>Адрес</em><span>Баку, Азербайджан</span></div>
      <div class="cg"><em>Часы работы</em><span>пн–пт · 10:00–19:00</span></div>
    </div>
    <form class="rv" id="lead" method="post" action="/send.php">
      <?php /* Ловушка для ботов: человек этого поля не видит и не заполнит.
             Рядом отметка времени — мгновенная отправка выдаёт автомат. */ ?>
      <input type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true"
             style="position:absolute;left:-9999px;width:1px;height:1px;opacity:0">
      <input type="hidden" name="ts" value="<?= time() ?>">
      <input type="hidden" name="back" value="<?= htmlspecialchars(I18n::u(I18n::path()), ENT_QUOTES) ?>">
      <div><label for="fn">Имя</label><input id="fn" name="name" autocomplete="name" required></div>
      <div><label for="fp">Телефон / WhatsApp</label><input id="fp" name="phone" type="tel" autocomplete="tel" placeholder="+994 __ ___ __ __" required></div>
      <div><label for="fs">Услуга</label>
        <select id="fs" name="service"><option>Сайт</option><option>SEO</option><option>Корпоративная почта</option><option>Хостинг</option><option>SMM</option><option>Видео и Reels</option><option>Комплекс</option></select>
      </div>
      <div><label for="fb">Примерный бюджет</label>
        <select id="fb" name="budget"><option>до ₼500</option><option>₼500 – ₼1 500</option><option>₼1 500 – ₼3 000</option><option>от ₼3 000</option></select>
      </div>
      <div class="full"><label for="fm">Коротко о задаче</label><textarea id="fm" name="message" placeholder="Сфера бизнеса, ссылка на текущий сайт, что хотите получить…"></textarea></div>
      <div class="full" style="display:flex;align-items:center;gap:22px;flex-wrap:wrap"><button class="btn" type="submit">Отправить</button><p class="status" id="lead-status" role="status"><?= isset($_GET['sent']) ? htmlspecialchars(t('form.ok')) : (isset($_GET['error']) ? htmlspecialchars(t('form.error')) : '') ?></p></div>
    </form>
  </div>
</section>
</main>
<?php include __DIR__ . '/../app/partials/foot.php'; ?>
