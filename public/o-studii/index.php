<?php
$page = 'about';
$current = 'about';
include __DIR__ . '/../../app/partials/head.php';
$catalog = require __DIR__ . '/../../app/data/catalog.php';
?>
<main id="top">
<section class="sec">
  <div class="wrap">
    <div class="shead">
      <h1 class="disp h2">О студии</h1>
      <p class="lb">Баку · с 2017 года</p>
    </div>
    <p class="about-lead" style="margin-top:8px">MGuliyev Studio работает в Баку с 2017 года —
      и остаётся с проектами после запуска, потому что именно тогда начинается самое важное.</p>
    <p class="sub" style="margin-top:22px">Делаем сайты, рисуем айдентику, продвигаем в поиске и соцсетях,
      держим домены, хостинг и корпоративную почту. В портфолио 49 проектов — от нефтегазовой
      инфраструктуры до магазина тортов.</p>
    <p class="sub">Работаем без прослойки из менеджеров: вы говорите напрямую с теми, кто делает.
      Проектов в работе намеренно немного — каждый ведётся годами, а не сдаётся и забывается.</p>

    <div style="margin-top:clamp(40px,5vw,68px)">
      <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:16px">Откуда четыре направления</h2>
      <p class="sub">Студия начала в 2017 году с разработки на WordPress. Остальное добавлялось
        по одному направлению — не ради строчки в прайсе, а потому что сайт без хостинга, почты,
        поиска и контента остаётся файлом на сервере.</p>
      <p class="sub">Сегодня это четыре группы и двадцать четыре услуги в них. Любую можно взять
        отдельно. Но когда домен, сайт, поиск и соцсети ведёт один подрядчик, не нужно сводить
        между собой разных исполнителей и выяснять, на чьей стороне поломка.</p>
    </div>

    <div class="rows" style="margin-top:clamp(30px,4vw,48px)">
      <?php foreach ($catalog as $slug => $cat): ?>
      <a class="row" href="/uslugi/<?= $slug ?>/">
        <span class="rname"><?= $cat['title'] ?></span>
        <span class="rdesc"><?= implode(' · ', array_map(fn($i) => $i[0], $cat['items'])) ?></span>
        <span class="rmeta">6 услуг</span>
      </a>
      <?php endforeach; ?>
    </div>

    <div class="band" style="margin-top:clamp(40px,5vw,68px)">
      <div class="bcell"><b>2017</b><span>год основания студии</span></div>
      <div class="bcell"><b>49</b><span>проектов в портфолио</span></div>
      <div class="bcell"><b>24</b><span>услуги в четырёх направлениях</span></div>
    </div>

    <div style="margin-top:clamp(40px,5vw,68px)">
      <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:20px">Как устроена работа</h2>
      <div class="princ" style="margin-top:0">
        <div>
          <h4>Доступы оформляются на вас</h4>
          <p>Домен, панель хостинга и права администратора на сайте принадлежат вам или вашей
            компании с первого дня, а не студии. Решите работать с другими — забираете всё и уходите.</p>
        </div>
        <div>
          <h4>Проект, а не человек</h4>
          <p>Структура, доступы и решения по проекту записаны. Исполнитель внутри студии может
            смениться — для вас ничего не меняется.</p>
        </div>
        <div>
          <h4>Отчёт по графику</h4>
          <p>Трафик, позиции, охваты и состояние сервера — раз в месяц, а не по вашему напоминанию.</p>
        </div>
      </div>
    </div>

    <div style="margin-top:clamp(40px,5vw,68px)">
      <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:16px">Инструменты</h2>
      <p class="sub" style="font-size:.9rem">Мы не подбираем новый инструмент под каждый заказ.
        Стек выбран так, чтобы сайт можно было передать другой команде и она разобралась в нём без нас.</p>
      <div class="stack" style="margin-top:18px">
        <i>WordPress</i><i>WooCommerce</i><i>Elementor</i><i>ACF</i><i>WPML</i><i>Yoast SEO</i><i>Figma</i><i>Photoshop</i><i>Illustrator</i><i>Google Analytics</i><i>Search Console</i><i>Cloudflare</i><i>Premiere Pro</i><i>After Effects</i><i>Meta Business Suite</i>
      </div>
    </div>

    <div style="margin-top:clamp(40px,5vw,68px)">
      <h2 class="disp" style="font-size:clamp(1.4rem,2.6vw,1.9rem);margin-bottom:16px">Как ведём проект</h2>
      <p class="sub">Путь от брифа до поддержки — шесть шагов, и он одинаковый для сайта на пять
        страниц и для магазина с интеграцией склада. Разобрали его на главной:
        <a href="/#process" style="color:var(--duo-b)">как работаем</a>.</p>
    </div>

    <div style="margin-top:clamp(44px,5vw,72px);padding-top:clamp(24px,3vw,36px);border-top:1px solid var(--line)">
      <h2 class="disp h2">Расскажите о проекте</h2>
      <p class="sub" style="margin-top:16px">Чем занимается бизнес и что не устраивает сейчас.
        Этого достаточно, чтобы начать.</p>
      <p style="margin-top:22px"><a class="btn" href="/kontakty/">Связаться</a>
        <a class="btn btn-o" href="/portfolio/" style="margin-left:10px">Смотреть портфолио</a></p>
    </div>
  </div>
</section>
</main>
<?php include __DIR__ . '/../../app/partials/foot.php'; ?>
