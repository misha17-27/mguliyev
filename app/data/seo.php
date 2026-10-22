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
   месяцев, 53 проекта и 33 снимка. При изменении прайса или
   портфолио их надо поправить и здесь — иначе сниппет разойдётся со страницей. */
return [
    'home' => [
        'ru' => ['title' => 'Веб-студия в Баку — MGuliyev Studio: сайты, SEO, поддержка',
                 'description' => 'Сайты под ключ с 2017 года: от структуры и дизайна до запуска. 53 проекта в Азербайджане и за рубежом, срок 10–25 дней, пакеты от ₼700, SEO и поддержка.'],
        'az' => ['title' => 'Bakıda veb-studiya: açar təhvili sayt — MGuliyev Studio',
                 'description' => 'Bakıda 2017-ci ildən sayt və internet mağazaları: portfolioda 53 layihə, müddət 10–25 gün, paketlər ₼700-dən. Dizayn, irəlilətmə və dəstək də var.'],
        'en' => ['title' => 'Baku Web Design Studio: Turnkey Websites — MGuliyev Studio',
                 'description' => 'Websites and online stores in Baku since 2017: 53 projects in the portfolio, 10–25 days, packages from ₼700. Design, promotion and support too.'],
    ],
    'uslugi' => [
        'ru' => ['title' => 'Услуги веб-студии: сайты, логотип, SEO и хостинг в Баку',
                 'description' => 'Четыре направления и 24 услуги: разработка сайтов и магазинов, логотип и фирменный стиль, SEO и Google Ads, хостинг и почта. Можно взять одну услугу.'],
        'az' => ['title' => 'Bakıda veb-studiya xidmətləri: sayt, dizayn, SEO',
                 'description' => 'Dörd istiqamət və 24 xidmət: sayt və mağaza hazırlanması, dizayn, SEO və reklam, hostinq və poçt. Hər birinə nə daxildir və nədən başlamalı.'],
        'en' => ['title' => 'Web Design Services in Baku: Websites, SEO, Support',
                 'description' => 'Four areas and 24 services: website and online store development, design, SEO and ads, hosting with email. What each includes and where to start.'],
    ],
    'veb-sayty' => [
        'ru' => ['title' => 'Создание сайтов в Баку под ключ — от ₼700, 10–25 дней',
                 'description' => 'Сайты и интернет-магазины под ключ: структура, дизайн, админка, запуск. Лендинги, корпоративные сайты и магазины на русском, азербайджанском и английском.'],
        'az' => ['title' => 'Bakıda sayt və internet mağaza hazırlanması, ₼700-dən',
                 'description' => 'Korporativ saytlar, mağazalar, xidmət və elan saytları, turizm və şəxsi saytlar: altı tip. Müddət 10–25 gün, ₼700-dən, menecer üçün idarə paneli.'],
        'en' => ['title' => 'Website & Online Store Development in Baku, from ₼700',
                 'description' => 'Corporate, service, travel and personal sites, online stores and classified ads: six types. 10–25 days, from ₼700, an admin panel your manager can handle.'],
    ],
    'dizayn' => [
        'ru' => ['title' => 'Разработка логотипа и фирменного стиля в Баку',
                 'description' => 'Логотип, палитра и шрифты, затем брендбук, дизайн каталога для печати и PDF, шаблоны постов и сторис, motion-ролики и 3D. Можно заказать без сайта.'],
        'az' => ['title' => 'Bakıda loqo və korporativ üslub — MGuliyev Studio',
                 'description' => 'Nişan, palitra və şriftlər, sonra isə onlardan yığılan hər şey: brendbuk, kataloq dizaynı, sosial şəbəkə postları, motion video və 3D vizualizasiya.'],
        'en' => ['title' => 'Logo and Brand Identity Design in Baku — MGuliyev Studio',
                 'description' => 'A mark, palette and typefaces, then everything built from them: brand book, catalogue design, social media posts, motion graphics and 3D visualisation.'],
    ],
    'marketing' => [
        'ru' => ['title' => 'SEO-продвижение сайтов в Баку: Google Ads и SMM',
                 'description' => 'SEO в Google: аудит, семантика, контент, ссылки. Google Ads, ведение Instagram и Facebook. Отчёт каждый месяц, устойчивые позиции — через 3–6 месяцев.'],
        'az' => ['title' => 'Bakıda saytın irəlilədilməsi: SEO, Google Ads, SMM',
                 'description' => 'Google-da SEO, axtarış və ticarət reklamı, Instagram və Facebook, strategiya, mətnlər və çəkiliş. Axtarışda davamlı nəticə — 3–6 ay.'],
        'en' => ['title' => 'Website Promotion in Baku: SEO, Google Ads, Social Media',
                 'description' => 'SEO for Google, search and shopping ads, Instagram and Facebook, strategy, copy, photo and video shoots. Stable results in search take 3–6 months.'],
    ],
    'podderzhka' => [
        'ru' => ['title' => 'Техподдержка сайта в Баку: хостинг, домен, почта',
                 'description' => 'Обслуживание сайта после запуска: хостинг с SSL и еженедельными копиями, домен на ваше имя, почта на домене с SPF, DKIM и DMARC, перенос сайта и почты.'],
        'az' => ['title' => 'Bakıda sayt dəstəyi, hostinq və korporativ poçt',
                 'description' => 'Saytın və poçtun yerləşdirilməsi, SSL, həftəlik ehtiyat nüsxələr, domen sizin adınıza, poçt qutusu bir günə. Dəstəyin ilk ayı — ödənişsiz.'],
        'en' => ['title' => 'Website Support, Hosting and Business Email in Baku',
                 'description' => 'Hosting for your site and email, SSL, weekly backups, the domain in your name, a mailbox in one day. The first month of support is free.'],
    ],
    'portfolio' => [
        'ru' => ['title' => 'Портфолио и примеры сайтов: 53 работы студии из Баку',
                 'description' => 'Сайты, сделанные под ключ для компаний Азербайджана и других стран: логистика, магазины, авто, стройка, промышленность, услуги. Примеры по отраслям.'],
        'az' => ['title' => 'Sayt hazırlanması: Bakıda veb-studiyanın işləri | MGuliyev',
                 'description' => 'MGuliyev Studio 2017-ci ildən Bakıda şirkətlər üçün sayt hazırlayır. Sahələr üzrə nümunələr: logistika, ticarət, avto, tikinti və əmlak, sənaye, xidmətlər.'],
        'en' => ['title' => 'Website Development in Baku: Our Work Since 2017 | MGuliyev',
                 'description' => 'Websites built by MGuliyev Studio in Baku since 2017 for companies in Azerbaijan and abroad: logistics, retail, cars, construction, B2B and services.'],
    ],
    'about' => [
        'ru' => ['title' => 'Кто делает ваш сайт: MGuliyev Studio, Баку, с 2017 года',
                 'description' => 'Делаем сайты в Баку с 2017 года и остаёмся с проектом после запуска. Вы говорите напрямую с теми, кто делает, а домен, хостинг и админка оформляются на вас.'],
        'az' => ['title' => 'Saytınızı kim hazırlayır: Bakıda veb-studiya, 2017-ci ildən',
                 'description' => 'Bakıda 2017-ci ildən veb-studiya: dörd istiqamət və 24 xidmət. İşi görənlərlə birbaşa danışırsınız, domen, hostinq və girişlər sizin adınıza olur.'],
        'en' => ['title' => 'Who Builds Your Site: Baku Web Design Studio since 2017',
                 'description' => 'Web design studio in Baku since 2017: four areas, 24 services. You talk to the people doing the work; the domain, hosting and logins are in your name.'],
    ],
    'price' => [
        'ru' => ['title' => 'Сколько стоит сайт в Баку: цены от ₼700 и что входит',
                 'description' => 'Цены на сайты в манатах: Старт от ₼700, Бизнес от ₼1 190, Премиум от ₼1 800. Что входит в пакет, что считается отдельно, оплата: 50% в начале, 50% при сдаче.'],
        'az' => ['title' => 'Bakıda sayt qiyməti: paketlər ₼700-dən və nə daxildir',
                 'description' => 'Start ₼700-dən, Biznes ₼1 190-dan, Premium ₼1 800-dən: hər paketə nə daxildir, nə ayrıca ödənilir və ödəniş qaydası — 50% əvvəl, 50% təhvildə.'],
        'en' => ['title' => 'How Much a Website Costs in Baku: Packages from ₼700',
                 'description' => 'Start from ₼700, Business from ₼1 190, Premium from ₼1 800: what every package includes, what costs extra and how to pay — 50% upfront, 50% on delivery.'],
    ],
    'blog' => [
        'ru' => ['title' => 'Блог веб-студии: почта в спаме, скорость сайта, 9:16',
                 'description' => 'Разборы для владельцев сайтов: почему письма компании попадают в спам, как Google оценивает скорость сайта и где безопасная зона вертикального видео 9:16.'],
        'az' => ['title' => 'Veb-studiya bloqu: poçt, saytın sürəti və 9:16 video',
                 'description' => 'Sayt sahibi üçün üç təhlil: məktublar niyə spama düşür, Google nəyi sürətli sayır və 9:16 kadr necə qurulur. Yalnız yoxlanıla bilən üsullar.'],
        'en' => ['title' => 'Web Design Studio Blog: Email, Site Speed, 9:16 Video',
                 'description' => 'Three walkthroughs for site owners: why email lands in spam, what Google counts as fast and how a 9:16 frame works. Verifiable technique only.'],
    ],
    'contacts' => [
        'ru' => ['title' => 'Контакты MGuliyev Studio в Баку: телефон, почта, заявка',
                 'description' => 'Телефон +994 55 215 53 63, info@mguliyev.com, пн–пт 10:00–19:00. Опишите задачу в форме заявки — ответим в течение 24 часов и пришлём предложение после брифа.'],
        'az' => ['title' => 'Bakı studiyası ilə əlaqə: telefon, poçt, iş saatları',
                 'description' => 'Telefon +994 55 215 53 63, info@mguliyev.com, B.e.–Cümə 10:00–19:00. Müraciət forması, ilk məktub üçün beş sətir və 24 saat ərzində cavab.'],
        'en' => ['title' => 'Contact Our Studio in Baku: Phone, Email, Hours',
                 'description' => 'Phone +994 55 215 53 63, info@mguliyev.com, Mon–Fri 10:00–19:00. A request form, five lines for a first message and a reply within 24 hours.'],
    ],
];
