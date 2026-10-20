<?php
/* Заголовки и описания страниц для поиска.

   Ключ верхнего уровня — идентификатор страницы ($page в файле страницы),
   внутри — язык. Пока заполнен только ru; когда появятся az и en, переводы
   добавляются сюда же, а не по одиннадцати файлам.
   Если перевода нет, шапка берёт русский вариант.

   Ориентиры: title до ~60 знаков (в выдаче обрезается примерно на 580 px),
   description 120–158. Все строки уникальны по сайту.

   Главная цель сайта — разработка сайтов, поэтому головной коммерческий
   запрос отдан странице uslugi/veb-sayty, а главная берёт запрос выбора
   подрядчика. Так две страницы стоят на разных ступенях воронки и не
   отбирают друг у друга показы.

   В строках есть цифры: ₼700 / ₼1 190 / ₼1 800, сроки 10–25 дней и 3–6
   месяцев, 55 проектов и 34 снимков. При изменении прайса или
   портфолио их надо поправить и здесь — иначе сниппет разойдётся со страницей. */
return [
    'home' => [
        'ru' => ['title' => 'Веб-студия в Баку: сайт под ключ — MGuliyev Studio',
                 'description' => 'Сайты и интернет-магазины в Баку с 2017 года: 55 проекта в портфолио, срок 10–25 дней, пакеты от ₼700. Рядом дизайн, продвижение и поддержка.'],
        'az' => ['title' => 'Bakıda veb-studiya: açar təhvili sayt — MGuliyev Studio',
                 'description' => 'Bakıda 2017-ci ildən sayt və internet mağazalar: portfolioda 55 layihə, müddət 10–25 gün, paketlər ₼700-dən. Dizayn, irəlilətmə və dəstək də var.'],
        'en' => ['title' => 'Baku Web Design Studio: Turnkey Websites — MGuliyev Studio',
                 'description' => 'Websites and online stores in Baku since 2017: 55 projects in the portfolio, 10–25 days, packages from ₼700. Design, promotion and support too.'],
    ],
    'uslugi' => [
        'ru' => ['title' => 'Услуги веб-студии в Баку: сайты, дизайн, продвижение',
                 'description' => 'Четыре направления и 24 услуги: создание сайтов и магазинов, дизайн, SEO и реклама, хостинг с почтой. Что входит в каждое и с чего начать.'],
        'az' => ['title' => 'Bakıda veb-studiya xidmətləri: sayt, dizayn, SEO',
                 'description' => 'Dörd istiqamət və 24 xidmət: sayt və mağaza hazırlanması, dizayn, SEO və reklam, hostinq və poçt. Hər birinə nə daxildir və nədən başlamalı.'],
        'en' => ['title' => 'Web Design Services in Baku: Websites, SEO, Support',
                 'description' => 'Four areas and 24 services: website and online store development, design, SEO and ads, hosting with email. What each includes and where to start.'],
    ],
    'veb-sayty' => [
        'ru' => ['title' => 'Разработка сайтов и интернет-магазинов в Баку, от ₼700',
                 'description' => 'Корпоративные сайты, магазины, сайты услуг и объявлений, туристические и персональные: шесть типов. Срок 10–25 дней, от ₼700, админка для менеджера.'],
        'az' => ['title' => 'Bakıda sayt və internet mağaza hazırlanması, ₼700-dən',
                 'description' => 'Korporativ saytlar, mağazalar, xidmət və elan saytları, turizm və şəxsi saytlar: altı tip. Müddət 10–25 gün, ₼700-dən, menecer üçün idarə paneli.'],
        'en' => ['title' => 'Website & Online Store Development in Baku, from ₼700',
                 'description' => 'Corporate, service, travel and personal sites, online stores and classified ads: six types. 10–25 days, from ₼700, an admin panel your manager can handle.'],
    ],
    'dizayn' => [
        'ru' => ['title' => 'Логотип и фирменный стиль в Баку — MGuliyev Studio',
                 'description' => 'Знак, палитра и шрифты, а затем всё, что из них собирается: брендбук, дизайн каталога, посты для соцсетей, motion-ролики и 3D-визуализация.'],
        'az' => ['title' => 'Bakıda loqo və korporativ üslub — MGuliyev Studio',
                 'description' => 'Nişan, palitra və şriftlər, sonra isə onlardan yığılan hər şey: brendbuk, kataloq dizaynı, sosial şəbəkə postları, motion video və 3D vizualizasiya.'],
        'en' => ['title' => 'Logo and Brand Identity Design in Baku — MGuliyev Studio',
                 'description' => 'A mark, palette and typefaces, then everything built from them: brand book, catalogue design, social media posts, motion graphics and 3D visualisation.'],
    ],
    'marketing' => [
        'ru' => ['title' => 'Продвижение сайта в Баку: SEO, Google Ads и соцсети',
                 'description' => 'SEO в Google, поисковая и торговая реклама, Instagram и Facebook, стратегия, тексты и съёмка. Устойчивый результат в поиске — 3–6 месяцев.'],
        'az' => ['title' => 'Bakıda saytın irəlilədilməsi: SEO, Google Ads, SMM',
                 'description' => 'Google-da SEO, axtarış və ticarət reklamı, Instagram və Facebook, strategiya, mətnlər və çəkiliş. Axtarışda davamlı nəticə — 3–6 ay.'],
        'en' => ['title' => 'Website Promotion in Baku: SEO, Google Ads, Social Media',
                 'description' => 'SEO for Google, search and shopping ads, Instagram and Facebook, strategy, copy, photo and video shoots. Stable results in search take 3–6 months.'],
    ],
    'podderzhka' => [
        'ru' => ['title' => 'Поддержка сайта, хостинг и корпоративная почта в Баку',
                 'description' => 'Размещение сайта и почты, SSL, еженедельные резервные копии, домен на ваше имя, ящик за один день. Первый месяц поддержки — бесплатно.'],
        'az' => ['title' => 'Bakıda sayt dəstəyi, hostinq və korporativ poçt',
                 'description' => 'Saytın və poçtun yerləşdirilməsi, SSL, həftəlik ehtiyat nüsxələr, domen sizin adınıza, poçt qutusu bir günə. Dəstəyin ilk ayı — ödənişsiz.'],
        'en' => ['title' => 'Website Support, Hosting and Business Email in Baku',
                 'description' => 'Hosting for your site and email, SSL, weekly backups, the domain in your name, a mailbox in one day. The first month of support is free.'],
    ],
    'portfolio' => [
        'ru' => ['title' => 'Примеры сайтов студии из Баку: портфолио с 2017 года',
                 'description' => '55 проектов в шести отраслях, у каждой своя страница: логистика, торговля, авто, стройка, промышленность и услуги. У 34 — снимки самих сайтов.'],
        'az' => ['title' => 'Portfolio: 2017-ci ildən Bakıda hazırladığımız saytlar',
                 'description' => '55 layihə altı sahədə, hər sahənin öz səhifəsi var: logistika, ticarət, avto, tikinti, sənaye və xidmətlər. 34 layihədə saytın öz şəkli var.'],
        'en' => ['title' => 'Website Examples from a Baku Studio: Portfolio since 2017',
                 'description' => '55 projects in six sectors, each with its own page: logistics, retail, automotive, construction, manufacturing and services. 34 show the live sites.'],
    ],
    'about' => [
        'ru' => ['title' => 'Кто делает ваш сайт: веб-студия в Баку с 2017 года',
                 'description' => 'Веб-студия в Баку с 2017 года: четыре направления и 24 услуги. Говорите напрямую с теми, кто делает, а домен, хостинг и доступы оформляются на вас.'],
        'az' => ['title' => 'Saytınızı kim hazırlayır: Bakıda veb-studiya, 2017-ci ildən',
                 'description' => 'Bakıda 2017-ci ildən veb-studiya: dörd istiqamət və 24 xidmət. İşi görənlərlə birbaşa danışırsınız, domen, hostinq və girişlər sizin adınıza olur.'],
        'en' => ['title' => 'Who Builds Your Site: Baku Web Design Studio since 2017',
                 'description' => 'Web design studio in Baku since 2017: four areas, 24 services. You talk to the people doing the work; the domain, hosting and logins are in your name.'],
    ],
    'price' => [
        'ru' => ['title' => 'Сколько стоит сайт в Баку: пакеты от ₼700 и что входит',
                 'description' => 'Старт от ₼700, Бизнес от ₼1 190, Премиум от ₼1 800: что входит в любой пакет, что оплачивается отдельно и как платить — 50% в начале, 50% при сдаче.'],
        'az' => ['title' => 'Bakıda sayt qiyməti: paketlər ₼700-dən və nə daxildir',
                 'description' => 'Start ₼700-dən, Biznes ₼1 190-dan, Premium ₼1 800-dən: hər paketə nə daxildir, nə ayrıca ödənilir və ödəniş qaydası — 50% əvvəl, 50% təhvildə.'],
        'en' => ['title' => 'How Much a Website Costs in Baku: Packages from ₼700',
                 'description' => 'Start from ₼700, Business from ₼1 190, Premium from ₼1 800: what every package includes, what costs extra and how to pay — 50% upfront, 50% on delivery.'],
    ],
    'blog' => [
        'ru' => ['title' => 'Блог веб-студии: почта, скорость сайта и видео 9:16',
                 'description' => 'Три разбора для владельца сайта: почему письма уходят в спам, что Google считает быстрым и как устроен кадр 9:16. Только проверяемая техника.'],
        'az' => ['title' => 'Veb-studiya bloqu: poçt, saytın sürəti və 9:16 video',
                 'description' => 'Sayt sahibi üçün üç təhlil: məktublar niyə spama düşür, Google nəyi sürətli sayır və 9:16 kadr necə qurulur. Yalnız yoxlanıla bilən üsullar.'],
        'en' => ['title' => 'Web Design Studio Blog: Email, Site Speed, 9:16 Video',
                 'description' => 'Three walkthroughs for site owners: why email lands in spam, what Google counts as fast and how a 9:16 frame works. Verifiable technique only.'],
    ],
    'contacts' => [
        'ru' => ['title' => 'Контакты студии в Баку: телефон, почта и часы работы',
                 'description' => 'Телефон +994 55 215 53 63, info@mguliyev.com, пн–пт 10:00–19:00. Форма заявки, пять строк для первого письма и ответ в течение 24 часов.'],
        'az' => ['title' => 'Bakı studiyası ilə əlaqə: telefon, poçt, iş saatları',
                 'description' => 'Telefon +994 55 215 53 63, info@mguliyev.com, B.e–Cümə 10:00–19:00. Müraciət forması, ilk məktub üçün beş sətir və 24 saat ərzində cavab.'],
        'en' => ['title' => 'Contact Our Studio in Baku: Phone, Email, Hours',
                 'description' => 'Phone +994 55 215 53 63, info@mguliyev.com, Mon–Fri 10:00–19:00. A request form, five lines for a first message and a reply within 24 hours.'],
    ],
];
