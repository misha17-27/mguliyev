<?php
/* Заголовки и описания для поиска: страницы категорий и проектов портфолио.

   Акцент — разработка сайтов: каждая строка говорит, что студия сделала
   сайт для компании этой сферы. Только факты из data/works.php — чем
   занимается заказчик, домен, отрасль; ни функций сайта, ни результатов,
   которых мы не знаем. Заголовок до 60 знаков, описание 120–158.

   Значения из панели главнее этих: файл заполняет только те языки, которых
   у записи в панели нет совсем (см. works_seo_fill() в app/content.php).
   Ключи — адрес категории и домен проекта. */

return [
    'logistika' => [
        'seo' => [
            'ru' => ['title' => 'Сайт для логистической компании в Баку: примеры работ', 'description' => 'Сайты под ключ для экспедитора, таможенного брокера, курьерской службы, таксопарка, трансферов и переездов в Торонто: заявки, калькулятор доставки, карты.'],
            'az' => ['title' => 'Logistika şirkətləri üçün sayt hazırlanması | MGuliyev', 'description' => 'Logistika və daşıma şirkətləri üçün saytların hazırlanması: gömrük, anbar, kuryerlər, taksi və transferlər. MGuliyev Studio, Bakıda veb-studiya.'],
            'en' => ['title' => 'Logistics and transport website development | MGuliyev', 'description' => 'MGuliyev Studio, a web studio in Baku, develops websites for logistics and transport: customs, warehousing, couriers, taxi and transfers.'],
        ],
        'projects' => [
            'caucasuscl.com' => [
                'ru' => ['title' => 'Сайт таможенного брокера в Баку — caucasuscl.com', 'description' => 'Таможенный брокер Caucasus Customs and Logistics из Баку: семь услуг, новости и ответы о таможне, ссылки на госорганы, форма, карта и русская версия.'],
                'az' => ['title' => 'caucasuscl.com: gömrük və logistika şirkətinin saytı', 'description' => 'Gömrük rəsmiləşdirilməsi və logistika xidmətləri göstərən şirkət üçün caucasuscl.com saytını hazırlamışıq. MGuliyev Studio — Bakıda veb-studiya.'],
                'en' => ['title' => 'Customs and logistics website development: caucasuscl.com', 'description' => 'The website of caucasuscl.com, a customs clearance and logistics company, was built by MGuliyev Studio in Baku. Have a look and ask us for a website.'],
            ],
            'azshipping.az' => [
                'ru' => ['title' => 'Сайт для грузоперевозок в Баку — azshipping.az', 'description' => 'Англоязычный сайт экспедитора AZSHIPPING из Баку: страницы авто-, авиа-, морских и ж/д перевозок, проектных грузов и таможни, запрос цены, форма отклика.'],
                'az' => ['title' => 'azshipping.az — yükdaşıma şirkəti üçün sayt | MGuliyev', 'description' => 'Yükdaşıma şirkəti azshipping.az üçün sayt hazırlanması — MGuliyev Studio portfoliosundan layihə. Bakıda sizin biznesiniz üçün də sayt hazırlayırıq.'],
                'en' => ['title' => 'Web design for azshipping.az, a freight transport company', 'description' => 'azshipping.az is a freight transport company, and its website was developed by MGuliyev Studio, a Baku web studio. Need a site for your logistics business?'],
            ],
            'marshal.az' => [
                'ru' => ['title' => 'Сайт таксопарка-партнёра Uber в Баку — marshal.az', 'description' => 'Таксопарк Marshal подключает водителей к Uber: анкета на первом экране, страница для курьеров Uber delivery, заявка на свой автопарк, контакты с картой.'],
                'az' => ['title' => 'marshal.az — Uber tərəfdaşı taksi parkının saytı | MGuliyev', 'description' => 'Uber tərəfdaşı olan taksi parkı üçün marshal.az saytını yaratmışıq. MGuliyev Studio Bakıda saytların hazırlanması ilə məşğuldur. Öz saytınızı sifariş edin.'],
                'en' => ['title' => 'marshal.az: taxi fleet website by MGuliyev Studio', 'description' => 'MGuliyev Studio in Baku built the website for marshal.az, a taxi fleet and Uber partner. View the project and order a website for your own company.'],
            ],
            'moverteam.ca' => [
                'ru' => ['title' => 'Сайт компании по переездам в Торонто — moverteam.ca', 'description' => 'MoverTeam, переезды в Торонто и GTA: форма «откуда — куда» на первом экране, квартирные, офисные и междугородние переезды, список городов, фото автопарка.'],
                'az' => ['title' => 'Köçürmə xidməti üçün sayt hazırlanması: moverteam.ca', 'description' => 'Köçürmələrin təşkili ilə məşğul olan moverteam.ca şirkətinin saytını MGuliyev Studio hazırlayıb. Bakıdakı veb-studiyanın layihəsinə baxın, sayt sifariş edin.'],
                'en' => ['title' => 'moverteam.ca: moving company website development', 'description' => 'Website development for moverteam.ca, a moving services company. The site was designed and built by MGuliyev Studio, a web studio in Baku. See the project.'],
            ],
            'kuryer.net' => [
                'ru' => ['title' => 'Сайт курьерской службы с калькулятором — kuryer.net', 'description' => 'Курьерская служба из Баку: расчёт стоимости отправки на сайте, отслеживание посылки, пакеты Sadə, Medium и Premium со скидкой, страница партнёров.'],
                'az' => ['title' => 'kuryer.net — kuryer xidmətinin saytı | MGuliyev Studio', 'description' => 'Kuryer xidməti üçün kuryer.net saytı MGuliyev Studio tərəfindən hazırlanıb. Şirkətiniz üçün də sayt lazımdırsa, Bakıdakı studiyamıza yazın.'],
                'en' => ['title' => 'Courier service website kuryer.net | web studio in Baku', 'description' => 'kuryer.net is a courier service, and MGuliyev Studio in Baku developed its website. Looking for website development for your delivery business? Contact us.'],
            ],
            'alizadehgroup.net' => [
                'ru' => ['title' => 'Сайт для трансферов из аэропорта — alizadehgroup.net', 'description' => 'Alizadeh Group: трансферы в аэропорт и между городами с условиями заказа, автопарк Mercedes от Viano до S-class, подбор отелей и ресторанов, форма заявки.'],
                'az' => ['title' => 'Transfer şirkətinin saytı: alizadehgroup.net | MGuliyev', 'description' => 'alizadehgroup.net — transferlər və korporativ daşımalarla məşğul olan şirkətin saytı. Onu Bakı veb-studiyası MGuliyev Studio yaradıb. Layihə ilə tanış olun.'],
                'en' => ['title' => 'Transfer company website alizadehgroup.net | MGuliyev', 'description' => 'For alizadehgroup.net, a transfer and corporate transport company, MGuliyev Studio in Baku developed the website. See the work and get a site of your own.'],
            ],
            'dlc.az' => [
                'ru' => ['title' => 'Сайт для складского комплекса — dlc.az', 'description' => 'MGuliyev Studio сделала сайт складского комплекса dlc.az под ключ: структура, дизайн, разработка и запуск. Сейчас сайт не открывается, проект в портфолио.'],
                'az' => ['title' => 'dlc.az: anbar kompleksi üçün sayt | MGuliyev Studio', 'description' => 'dlc.az anbar kompleksi üçün hazırladığımız saytdır və portfolioda arxiv layihəsi kimi qalır. MGuliyev Studio Bakıda logistika şirkətlərinə saytlar hazırlayır.'],
                'en' => ['title' => 'dlc.az: warehouse complex website — MGuliyev Studio', 'description' => 'MGuliyev Studio, a Baku web studio, developed the website for dlc.az, a warehouse complex. The project is kept in the studio\'s logistics portfolio.'],
            ],
        ],
    ],
    'torgovlya' => [
        'seo' => [
            'ru' => ['title' => 'Примеры интернет-магазинов: сайты для торговли и опта', 'description' => 'Магазины с каталогом, корзиной и фильтрами: техника и книги в Азербайджане, опт обуви в Одессе (сайт на русском), матрасы в Будапеште, ковры в Вене.'],
            'az' => ['title' => 'Mağaza və ticarət şirkətləri üçün sayt hazırlanması', 'description' => 'Kitab, texnika, ayaqqabı və döşək mağazaları üçün saytların hazırlanması — Avstriya, Macarıstan və Ukrayna bazarları da daxil olmaqla. MGuliyev Studio, Bakı.'],
            'en' => ['title' => 'Website development for stores and retail | MGuliyev', 'description' => 'MGuliyev Studio in Baku builds store websites, from books and electronics to shoes and mattresses, including sites for Austria, Hungary and Ukraine.'],
        ],
        'projects' => [
            'store.az' => [
                'ru' => ['title' => 'Сайт магазина компьютерной техники — store.az', 'description' => 'Магазин компьютерной техники: восемь разделов от ПК до игровых устройств, таблица характеристик в карточке, сравнение, избранное, цены в манатах.'],
                'az' => ['title' => 'store.az — texnika mağazası üçün sayt | MGuliyev', 'description' => 'store.az texnika mağazasıdır, saytını isə Bakıdakı veb-studiya MGuliyev Studio hazırlayıb. Layihəyə baxın və şirkətiniz üçün sayt sifariş edin.'],
                'en' => ['title' => 'store.az: electronics store website | MGuliyev', 'description' => 'MGuliyev Studio, a web studio in Baku, built the website of store.az, an electronics store. See the project and order a similar site for your business.'],
            ],
            'avantaj.az' => [
                'ru' => ['title' => 'Сайт магазина телефонов — avantaj.az | MGuliyev Studio', 'description' => 'Сайт магазина телефонов avantaj.az сделан MGuliyev Studio под ключ: структура, дизайн, разработка и запуск. Другие магазины — в разделе «Магазины и торговля».'],
                'az' => ['title' => 'Telefon mağazasının saytı: avantaj.az | MGuliyev Studio', 'description' => 'avantaj.az — telefon mağazası. Mağazanın saytı Bakıda, MGuliyev Studio veb-studiyasında hazırlanıb. Mağazanız üçün də sayt lazımdırsa, bizə müraciət edin.'],
                'en' => ['title' => 'avantaj.az: website development for a phone store', 'description' => 'MGuliyev Studio in Baku developed the avantaj.az site for a phone store. Take a look at the project and request a website for your own shop.'],
            ],
            'bookmart.az' => [
                'ru' => ['title' => 'Разработка сайта книжного магазина в Баку — bookmart.az', 'description' => 'Книжный магазин в Баку: учебники и художественная литература, поиск, корзина и WhatsApp в карточке книги, разделы «Заказать книгу», «Продать» и «Издать».'],
                'az' => ['title' => 'bookmart.az: kitab mağazası üçün sayt hazırlanması', 'description' => 'Kitab mağazası bookmart.az üçün saytı Bakı veb-studiyası MGuliyev Studio hazırlayıb. Portfolioda layihə ilə tanış olun və mağazanız üçün sayt hazırlatın.'],
                'en' => ['title' => 'Bookstore website design: bookmart.az | MGuliyev', 'description' => 'The bookmart.az bookstore website was designed and built by MGuliyev Studio, a web studio in Baku. Have a look at the project and plan a site for your store.'],
            ],
            'vanilla.az' => [
                'ru' => ['title' => 'Сайт для заказа тортов с выбором начинки — vanilla.az', 'description' => 'Бенто-торты на заказ: в карточке выбор размера на 1–2 или 3–4 персоны, бисквита и начинки, форма заказа с датой и фото торта, вход в аккаунт, лента Instagram.'],
                'az' => ['title' => 'Sifarişlə tortlar üçün sayt hazırlanması: vanilla.az', 'description' => 'vanilla.az — sifarişlə tortlar. Bu biznesin saytını MGuliyev Studio Bakıda hazırlayıb. Öz biznesiniz üçün sayt istəyirsinizsə, bizimlə əlaqə saxlayın.'],
                'en' => ['title' => 'vanilla.az: website for a custom cake business', 'description' => 'Web design for vanilla.az, a business that makes custom cakes, by MGuliyev Studio in Baku. See the work and order a website for your brand.'],
            ],
            'tomobuv.com.ua' => [
                'ru' => ['title' => 'Сайт оптового магазина обуви на русском — tomobuv.com.ua', 'description' => 'Сайт на русском для оптового магазина обуви из Одессы: цена за пару и за ящик, фильтры по бренду и цене, личный кабинет, сравнение, покупка в 1 клик.'],
                'az' => ['title' => 'tomobuv.com.ua — ayaqqabı mağazasının saytı | MGuliyev', 'description' => 'tomobuv.com.ua ayaqqabı mağazasıdır. Mağazanın saytını Bakıda fəaliyyət göstərən MGuliyev Studio veb-studiyası hazırlayıb. Layihəyə portfolioda baxın.'],
                'en' => ['title' => 'tomobuv.com.ua: shoe store website — MGuliyev Studio', 'description' => 'The website of the shoe store tomobuv.com.ua was developed by MGuliyev Studio, a web design studio in Baku. Explore the project and get a site of your own.'],
            ],
            'mozahome.com' => [
                'ru' => ['title' => 'Сайт магазина товаров для дома в Вене — mozahome.com', 'description' => 'Магазин товаров для дома в Вене: ковры по стилям и размерам, кровати и матрасы, раздел для B2B-партнёров, блог, версии на английском и немецком, цены в евро.'],
                'az' => ['title' => 'mozahome.com: ev malları saytı, Avstriya | MGuliyev Studio', 'description' => 'mozahome.com — Avstriyada ev üçün mallar. Bu ticarət layihəsinin saytını Bakıdakı MGuliyev Studio hazırlayıb. Xarici bazar üçün sayt lazımdırsa, bizə yazın.'],
                'en' => ['title' => 'Austrian home goods website: mozahome.com | MGuliyev', 'description' => 'MGuliyev Studio, a Baku web studio, built mozahome.com for a home goods business in Austria. Browse the project and order a website for your company.'],
            ],
            'mattress.hu' => [
                'ru' => ['title' => 'Сайт продавца матрасов в Будапеште — mattress.hu', 'description' => 'Матрасы, подушки и одеяла в Будапеште: подбор матраса по размеру кровати от 90×200 до 180×200 см, корзина, личный кабинет, версии на венгерском и английском.'],
                'az' => ['title' => 'mattress.hu: Macarıstanda döşəklər üçün sayt | MGuliyev', 'description' => 'Macarıstanda döşəklər — mattress.hu. Saytı Bakıda veb-studiya MGuliyev Studio hazırlayıb. Layihəyə baxın və öz saytınızın hazırlanmasını bizə həvalə edin.'],
                'en' => ['title' => 'mattress.hu: website for a mattress seller in Hungary', 'description' => 'Website development for mattress.hu, a mattress business in Hungary, by MGuliyev Studio from Baku. View the project and order a site for your business.'],
            ],
            'sleepandbed.hu' => [
                'ru' => ['title' => 'Сайт Sleep & Bed: матрасы и подушки — sleepandbed.hu', 'description' => 'Sleep & Bed, Будапешт: шесть категорий каталога, фильтры по цене, высоте и размеру, корзина, страница о компании с видео и форма связи. Сайт на английском.'],
                'az' => ['title' => 'sleepandbed.hu — döşək və yataq dəstləri saytı | MGuliyev', 'description' => 'sleepandbed.hu Macarıstanda döşəklər və yataq dəstləri təklif edir. Saytı Bakıdakı veb-studiya MGuliyev Studio hazırlayıb. Layihə ilə portfolioda tanış olun.'],
                'en' => ['title' => 'sleepandbed.hu: web design for a mattress and bedding seller', 'description' => 'MGuliyev Studio in Baku designed sleepandbed.hu, the website of a Hungarian seller of mattresses and bed linen. See the work and discuss your own site.'],
            ],
            'ymkwatercolor.com' => [
                'ru' => ['title' => 'Сайт-магазин портретов акварелью по фото — ymkwatercolor.com', 'description' => 'Акварельные портреты по фото: люди, питомцы, дома, машины, лодки. Сайт на английском: фильтр по цене, рамка как доп. услуга, отзывы с фото работ, онлайн-чат.'],
                'az' => ['title' => 'Akvarel portretlər üçün sayt: ymkwatercolor.com | MGuliyev', 'description' => 'ymkwatercolor.com — sifarişlə akvarel portretlər. Bu layihənin saytını Bakıda MGuliyev Studio hazırlayıb. İşə baxın və öz biznesiniz üçün sayt sifariş edin.'],
                'en' => ['title' => 'ymkwatercolor.com: website for custom watercolor portraits', 'description' => 'MGuliyev Studio, a web studio in Baku, developed ymkwatercolor.com for a business offering custom watercolor portraits. See the project and order a site.'],
            ],
            'from-dubai.com' => [
                'ru' => ['title' => 'Сайт продажи техники из Дубая — from-dubai.com', 'description' => 'Сайт from-dubai.com для компании, которая продаёт технику из Дубая. Разработан под ключ: структура, дизайн, разработка и запуск сайта выполнены студией.'],
                'az' => ['title' => 'Dubaydan texnika: from-dubai.com saytı | MGuliyev Studio', 'description' => 'from-dubai.com Dubaydan texnika təklif edir. Saytını Bakıda yerləşən MGuliyev Studio veb-studiyası hazırlayıb. Bənzər sayt üçün bizə müraciət edin.'],
                'en' => ['title' => 'from-dubai.com: web design for an electronics seller', 'description' => 'MGuliyev Studio in Baku developed the from-dubai.com website for a seller of electronics from Dubai. Look through the project and plan a site of your own.'],
            ],
            'dutyfreegroup.az' => [
                'ru' => ['title' => 'Сайт компании duty free — dutyfreegroup.az (архив)', 'description' => 'Сайт dutyfreegroup.az для компании из сферы duty free студия сделала под ключ. Сейчас сайт не открывается, проект сохранён в портфолио в разделе торговли.'],
                'az' => ['title' => 'Duty free ticarəti: dutyfreegroup.az saytı | MGuliyev', 'description' => 'Duty free ticarəti üçün dutyfreegroup.az saytını Bakıdakı MGuliyev Studio hazırlayıb. Sayt hazırda açılmır, layihə portfolioda arxiv işləri sırasındadır.'],
                'en' => ['title' => 'dutyfreegroup.az: duty-free retail website | MGuliyev', 'description' => 'Website development for dutyfreegroup.az, a duty-free business, by MGuliyev Studio, a web studio in Baku. A retail project in the studio\'s portfolio.'],
            ],
        ],
    ],
    'avto' => [
        'seo' => [
            'ru' => ['title' => 'Сайт для автосалона и автобизнеса в Баку: примеры', 'description' => 'Сайты дистрибьюторов Lynk & Co и мотоциклов, каталог запчастей для спецтехники, доска объявлений, автосервис, прокат авто в Баку и пригон из США.'],
            'az' => ['title' => 'Avto və moto şirkətləri üçün sayt hazırlanması | MGuliyev', 'description' => 'Avto və moto distribyutorları, ehtiyat hissələri, icarə və servis şirkətləri üçün saytların hazırlanması — Bakıdakı MGuliyev Studio veb-studiyasının işləri.'],
            'en' => ['title' => 'Websites for car and motorcycle businesses | MGuliyev', 'description' => 'Website development for car and motorcycle businesses by MGuliyev Studio in Baku: distributors, spare parts, rental, service, US imports and classifieds.'],
        ],
        'projects' => [
            'lynkco.az' => [
                'ru' => ['title' => 'Сайт официального дистрибьютора Lynk & Co — lynkco.az', 'description' => 'Сайт дистрибьютора Lynk & Co в Азербайджане: модель 03 с выбором цвета кузова и интерьером с подсказками, запись на тест-драйв 01, 03 или 05.'],
                'az' => ['title' => 'lynkco.az — Lynk & Co rəsmi distribyutoru üçün sayt', 'description' => 'lynkco.az Lynk & Co-nun rəsmi distribyutorunun saytıdır. Onu Bakıdakı MGuliyev Studio veb-studiyası hazırlayıb. Layihəyə baxın və öz saytınızı sifariş edin.'],
                'en' => ['title' => 'lynkco.az: website for the official Lynk & Co distributor', 'description' => 'MGuliyev Studio, a web studio in Baku, developed the lynkco.az website for the official Lynk & Co distributor. See the project and order your own site.'],
            ],
            'grandmoto.az' => [
                'ru' => ['title' => 'Сайт дистрибьютора мотоциклов в Баку — grandmoto.az', 'description' => 'Дистрибьютор мотоциклов, ATV и UTV в Баку: каталог по брендам, магазин шлемов, одежды и аксессуаров с корзиной, сервисный центр, версии на az и en.'],
                'az' => ['title' => 'Sayt hazırlanması: grandmoto.az, motosiklet distribyutoru', 'description' => 'Motosiklet distribyutoru grandmoto.az üçün saytı Bakıda MGuliyev Studio hazırlayıb. Layihə ilə tanış olun və şirkətiniz üçün sayt sifariş edin.'],
                'en' => ['title' => 'grandmoto.az — motorcycle distributor web design | MGuliyev', 'description' => 'Web design and development for grandmoto.az, a motorcycle distributor, by MGuliyev Studio from Baku. Explore the project and plan a website of your own.'],
            ],
            'bestsol.az' => [
                'ru' => ['title' => 'Сайт-каталог запчастей для спецтехники — bestsol.az', 'description' => 'BestSol продаёт зубья ковшей, адаптеры, пальцы и ножи бульдозера: каталог с OEM-кодами, запрос по детали вместо корзины, бренды CAT, IVECO, Volvo, HOWO.'],
                'az' => ['title' => 'bestsol.az: ağır texnika hissələri saytının hazırlanması', 'description' => 'bestsol.az ağır texnika üçün ehtiyat hissələri sahəsində çalışır. Şirkətin saytını Bakıda fəaliyyət göstərən MGuliyev Studio veb-studiyası hazırlayıb.'],
                'en' => ['title' => 'bestsol.az: heavy machinery parts website | MGuliyev Studio', 'description' => 'Website development for bestsol.az, a company dealing in spare parts for heavy machinery. MGuliyev Studio, a web studio in Baku, designed and built it.'],
            ],
            'avtobutik.az' => [
                'ru' => ['title' => 'Лендинг для пригона авто из США — avtobutik.az', 'description' => 'Сайт о покупке машин на аукционах США: сравнение цены с местным рынком на примере Ford Fusion, форма запроса стоимости, порядок подбора автомобиля.'],
                'az' => ['title' => 'avtobutik.az: ABŞ-dan avtomobil çatdırılması üçün sayt', 'description' => 'ABŞ-dan avtomobil seçimi və çatdırılması ilə məşğul olan avtobutik.az şirkəti üçün saytı Bakıdakı MGuliyev Studio veb-studiyası hazırlayıb.'],
                'en' => ['title' => 'avtobutik.az — website for car sourcing from the USA', 'description' => 'MGuliyev Studio in Baku created the avtobutik.az website for a company that sources and delivers cars from the USA. View the project and order a website.'],
            ],
            'avtoehtiyat.com' => [
                'ru' => ['title' => 'Сайт объявлений об автозапчастях в Баку — avtoehtiyat.com', 'description' => 'Доска объявлений о запчастях: поиск по марке, модели и состоянию, разделы шин, масел и аккумуляторов, регистрация для частных продавцов и магазинов.'],
                'az' => ['title' => 'avtoehtiyat.com: ehtiyat hissəsi elan saytının hazırlanması', 'description' => 'avtoehtiyat.com avtomobil ehtiyat hissələrinin satış elanları platformasıdır. Elan saytını Bakıdakı MGuliyev Studio hazırlayıb. Layihəyə portfolioda baxın.'],
                'en' => ['title' => 'avtoehtiyat.com: car parts classifieds website development', 'description' => 'MGuliyev Studio, a Baku web studio, built avtoehtiyat.com, a classifieds website for car parts. See the work and order a website for your own project.'],
            ],
            'avtok1ub.az' => [
                'ru' => ['title' => 'Сайт автосервиса: замена масла и ремонт — avtok1ub.az', 'description' => 'Avtoklub — сеть автосервисов в Азербайджане, главная услуга — замена масла. Сайт под ключ: список работ, страница филиалов, онлайн-запись на сервис.'],
                'az' => ['title' => 'avtok1ub.az — avtoservis saytının hazırlanması | MGuliyev', 'description' => 'Yağ dəyişimi və avtoservis xidməti göstərən avtok1ub.az üçün sayt hazırlanması. Layihə Bakıdakı MGuliyev Studio veb-studiyasının portfoliosundadır.'],
                'en' => ['title' => 'avtok1ub.az — car service website by MGuliyev Studio', 'description' => 'Web design and development of avtok1ub.az, the site of a car service that does oil changes. Built by MGuliyev Studio in Baku. Need a website like this one?'],
            ],
            'carclub.az' => [
                'ru' => ['title' => 'Сайт проката авто в Баку с русской версией — carclub.az', 'description' => 'Прокат машин в Баку: каталог с характеристиками авто, запрос через WhatsApp и форму. Сайт на русском, азербайджанском, английском и арабском.'],
                'az' => ['title' => 'carclub.az — avtomobil icarəsi şirkəti üçün sayt | MGuliyev', 'description' => 'carclub.az avtomobil icarəsi ilə məşğuldur. Şirkətin saytını Bakıda MGuliyev Studio hazırlayıb. Layihəyə baxın və biznesiniz üçün sayt sifariş edin.'],
                'en' => ['title' => 'carclub.az: car rental website by a Baku web studio', 'description' => 'carclub.az is a car rental service, and MGuliyev Studio in Baku developed its website. Take a look at the project and order a website for your company.'],
            ],
            'roveltrading.az' => [
                'ru' => ['title' => 'Сайт поставщика аккумуляторов и масел — roveltrading.az', 'description' => 'Rovel Trading в Баку: аккумуляторы, масла, шины, зарядные и тестовые устройства. На сайте — продукция, сферы применения по группам товаров, бренды.'],
                'az' => ['title' => 'roveltrading.az: akkumulyator və təkər şirkəti üçün sayt', 'description' => 'roveltrading.az akkumulyator, yağ və təkər distribyutorudur. Onun saytını Bakıdakı veb-studiya MGuliyev Studio hazırlayıb. Layihə ilə tanış olun.'],
                'en' => ['title' => 'roveltrading.az: battery, oil and tyre business website', 'description' => 'MGuliyev Studio developed the roveltrading.az website for a business dealing in batteries, oils and tyres. See this project in our Baku web studio portfolio.'],
            ],
        ],
    ],
    'stroyka' => [
        'seo' => [
            'ru' => ['title' => 'Сайт для строительной компании и недвижимости: примеры', 'description' => 'Сайты под ключ для подрядчиков, кровельщиков, инженерных компаний, производителя мебели, столяров из Лондона и недвижимости на Кипре. Есть русские версии.'],
            'az' => ['title' => 'Tikinti və daşınmaz əmlak üçün sayt hazırlanması | MGuliyev', 'description' => 'Podratçı, mühəndislik, dam örtüyü, interyer, mebel və daşınmaz əmlak şirkətləri üçün hazırladığımız saytlar. MGuliyev Studio — Bakıda veb-studiya.'],
            'en' => ['title' => 'Construction and real estate website development | MGuliyev', 'description' => 'MGuliyev Studio, a web studio in Baku, builds websites for construction and real estate: contractors, engineering, roofing, interiors and furniture.'],
        ],
        'projects' => [
            'arka.az' => [
                'ru' => ['title' => 'Сайт строительной компании в Баку — arka.az | MGuliyev', 'description' => 'Строительная компания ARKA İnşaat из Баку: шесть услуг от проектирования до бассейнов и мебели, портфолио по типам объектов, партнёры, форма и карта.'],
                'az' => ['title' => 'Tikinti və dizayn şirkəti arka.az üçün sayt | MGuliyev', 'description' => 'arka.az tikinti və dizaynla məşğuldur. Şirkətin saytını Bakıdakı MGuliyev Studio veb-studiyası hazırlayıb. Layihəyə baxın və öz saytınızı sifariş edin.'],
                'en' => ['title' => 'arka.az: website for a construction and design firm', 'description' => 'MGuliyev Studio, a web studio in Baku, developed the arka.az website for a construction and design company. See the project and order a site for your firm.'],
            ],
            'damchi.az' => [
                'ru' => ['title' => 'Сайт на русском для кровельной компании в Баку — damchi.az', 'description' => 'Кровельная компания из Баку: фальцевая и черепичная кровля, фасады, водостоки, продажа материалов из Европы. Сайт на русском, есть версии az и en.'],
                'az' => ['title' => 'damchi.az: dam örtüyü işləri üçün sayt hazırlanması', 'description' => 'Dam örtüyü işləri görən damchi.az şirkətinin saytını MGuliyev Studio hazırlayıb — Bakıda veb-studiya. Tikinti biznesiniz üçün də sayt lazımdırsa, bizə yazın.'],
                'en' => ['title' => 'damchi.az: roofing company website — MGuliyev Studio', 'description' => 'MGuliyev Studio in Baku designed and built damchi.az, the website of a roofing company. Take a look at the project and order a website for your business.'],
            ],
            'agrosport.az' => [
                'ru' => ['title' => 'Сайт компании по спортивным газонам — agrosport.az', 'description' => 'AgroSport, Баку: натуральные покрытия для футбольных полей, ландшафтный дизайн, обслуживание и консультации. Страница проектов, версии на en и az.'],
                'az' => ['title' => 'agrosport.az — idman infrastrukturu şirkətinin saytı', 'description' => 'agrosport.az idman infrastrukturu sahəsində fəaliyyət göstərir. Bu şirkət üçün saytı Bakı veb-studiyası MGuliyev Studio yaradıb. Portfolioda layihəyə baxın.'],
                'en' => ['title' => 'agrosport.az: sports infrastructure website | MGuliyev', 'description' => 'Web design and development for agrosport.az, a sports infrastructure company, by MGuliyev Studio in Baku. Have a look at the work and plan a site of your own.'],
            ],
            'lifeonisland.com' => [
                'ru' => ['title' => 'Сайт агентства недвижимости на Кипре — lifeonisland.com', 'description' => 'Агентство недвижимости на Северном Кипре: каталог жилых комплексов, страница об острове с картой, услуги, контакты. Четыре языка, в том числе русский.'],
                'az' => ['title' => 'lifeonisland.com: Kiprdə daşınmaz əmlak saytı | MGuliyev', 'description' => 'Kiprdə daşınmaz əmlaka həsr olunmuş lifeonisland.com saytını Bakıdakı MGuliyev Studio yaradıb. Əmlak biznesiniz üçün sayt lazımdırsa, bizə müraciət edin.'],
                'en' => ['title' => 'lifeonisland.com: Cyprus property website | MGuliyev', 'description' => 'MGuliyev Studio in Baku built lifeonisland.com, a website about property in Cyprus. Explore the project and get a real estate website for your company.'],
            ],
            'metalist.az' => [
                'ru' => ['title' => 'Сайт-каталог ворот и рольставней — metalist.az | MGuliyev', 'description' => 'Каталог ворот: секционные, откатные, сэндвич-панельные, металлические и жалюзийные, а также двери, перила, окна и шлагбаумы. Архивный проект студии.'],
                'az' => ['title' => 'metalist.az — darvaza və rolet şirkətinin saytı | MGuliyev', 'description' => 'metalist.az darvazalar və roletlərlə məşğul olur. Şirkətin saytını Bakıdakı MGuliyev Studio hazırlayıb; layihə portfolioda arxiv işi kimi saxlanılır.'],
                'en' => ['title' => 'metalist.az: gates and roller shutters website', 'description' => 'Website for metalist.az, a gates and roller shutters business, designed and built by MGuliyev Studio, a Baku web studio. Part of the studio\'s portfolio.'],
            ],
            'whitestone.com.az' => [
                'ru' => ['title' => 'Сайт жилого комплекса — whitestone.com.az | MGuliyev', 'description' => 'Сайт жилого комплекса на домене whitestone.com.az сделан в MGuliyev Studio под ключ: структура, дизайн, разработка, запуск. Сейчас сайт недоступен.'],
                'az' => ['title' => 'whitestone.com.az: yaşayış kompleksi üçün sayt | MGuliyev', 'description' => 'Yaşayış kompleksi üçün whitestone.com.az saytı Bakıdakı veb-studiya MGuliyev Studio tərəfindən hazırlanıb. Bu iş portfolioda arxiv layihəsi kimi göstərilir.'],
                'en' => ['title' => 'whitestone.com.az: residential complex website', 'description' => 'Website development for whitestone.com.az, a residential complex, carried out by MGuliyev Studio in Baku. A real estate project in the studio\'s portfolio.'],
            ],
            'tce.az' => [
                'ru' => ['title' => 'Сайт проектно-строительной компании — tce.az | MGuliyev', 'description' => 'Turan Construction and Engineering, Баку: проектирование, строительно-монтажные работы, поставка оборудования, сервис. Проекты, партнёры, форма и карта.'],
                'az' => ['title' => 'tce.az saytının hazırlanması — layihələndirmə və tikinti', 'description' => 'tce.az layihələndirmə və tikinti-quraşdırma işləri görür. Onun saytını MGuliyev Studio hazırlayıb — Bakıda saytların hazırlanması ilə məşğul olan veb-studiya.'],
                'en' => ['title' => 'tce.az — design and construction company website', 'description' => 'tce.az handles design and construction works, and MGuliyev Studio, a web studio in Baku, developed its website. See the project and order a site like it.'],
            ],
            'ceng.az' => [
                'ru' => ['title' => 'Сайт поставщика инженерных систем в Баку — ceng.az', 'description' => 'Caspian Engineering Group из Баку: инженерные системы и поставка оборудования, проектирование, строительство. Галерея, список объектов, партнёры, контакты.'],
                'az' => ['title' => 'ceng.az — mühəndislik sistemləri şirkəti üçün sayt', 'description' => 'Mühəndislik sistemləri və avadanlıq təchizatı ilə məşğul olan ceng.az şirkətinin saytını Bakıdakı MGuliyev Studio yaradıb. Layihə ilə tanış olun.'],
                'en' => ['title' => 'ceng.az: engineering systems company website | MGuliyev', 'description' => 'Website development for ceng.az, an engineering systems and equipment supply company. Built by MGuliyev Studio, Baku. See the work and request a site.'],
            ],
            'arginterior.co.uk' => [
                'ru' => ['title' => 'Сайт столярной компании в Лондоне — arginterior.co.uk', 'description' => 'ARG Interior, Лондон: столярные работы, мебель и кухни на заказ, деревянные полы. Секторы, проекты, этапы работы и заявка с выбором бюджета. На английском.'],
                'az' => ['title' => 'arginterior.co.uk — Londondakı interyer şirkətinin saytı', 'description' => 'Londonda dülgərlik və interyer işləri görən arginterior.co.uk şirkətinin saytı Bakıda, MGuliyev Studio veb-studiyasında hazırlanıb. Layihəyə baxın.'],
                'en' => ['title' => 'arginterior.co.uk: London interior fit-out website', 'description' => 'MGuliyev Studio, a Baku web studio, built the website of arginterior.co.uk, a carpentry and interior fit-out business in London. See this web design project.'],
            ],
            'mybel.az' => [
                'ru' => ['title' => 'Сайт мебели на заказ в Баку с русской версией — mybel.az', 'description' => 'MYBEL Concept, Баку: мебель на заказ и интерьеры для отелей, ресторанов и домов. Десять услуг от дизайна до сдачи, заявка, версии на русском, az и en.'],
                'az' => ['title' => 'mybel.az — fərdi mebel şirkəti üçün sayt | MGuliyev', 'description' => 'mybel.az fərdi mebel və interyer həlləri təklif edir. Saytını Bakıda işləyən veb-studiya MGuliyev Studio hazırlayıb. Mebel biznesiniz üçün sayt sifariş edin.'],
                'en' => ['title' => 'mybel.az: bespoke furniture website — MGuliyev Studio', 'description' => 'Web design and development for mybel.az, a bespoke furniture and interiors company, by MGuliyev Studio in Baku. Order a website for your furniture business.'],
            ],
        ],
    ],
    'promyshlen' => [
        'seo' => [
            'ru' => ['title' => 'Корпоративный сайт для производства и B2B: примеры', 'description' => 'Сайты под ключ для нефтегаза, агрохолдинга, дистрибьютора напитков, магазина стоматологического оборудования, консалтинга и поставщика шлангов в Лондоне.'],
            'az' => ['title' => 'Sənaye və B2B şirkətləri üçün sayt hazırlanması | MGuliyev', 'description' => 'Neft-qaz, aqrar sektor, distribusiya, sənaye komponentləri, tibbi avadanlıq və konsaltinq üçün saytların hazırlanması. MGuliyev Studio — Bakıda veb-studiya.'],
            'en' => ['title' => 'Industrial and B2B Website Development | MGuliyev', 'description' => 'Websites for industry and B2B: oil and gas, agriculture, distribution, industrial components, medical equipment and consulting. MGuliyev Studio, Baku.'],
        ],
        'projects' => [
            'itas.az' => [
                'ru' => ['title' => 'Сайт поставщика промышленных материалов в Баку — itas.az', 'description' => 'Сайт под ключ для ITAS, поставщика промышленных материалов в Баку: каталог из 12 групп товаров, бренды-партнёры, форма заявки, карта, версии на az и en.'],
                'az' => ['title' => 'itas.az — sənaye materialları təchizatçısının saytı', 'description' => 'ITAS üçün sayt açar təhvil hazırlanıb: sənaye materialları və avadanlıq kataloqu, tərəfdaş brendlər, əlaqə forması, AZ və EN versiyaları.'],
                'en' => ['title' => 'itas.az: website for an industrial supplier | MGuliyev', 'description' => 'Turnkey website for ITAS, a Baku supplier of industrial materials and equipment: product catalog, partner brands, contact form and AZ/EN versions.'],
            ],
            'socarmidstream.az' => [
                'ru' => ['title' => 'Корпоративный сайт нефтегазовой компании — socarmidstream.az', 'description' => 'Сайт SOCAR Midstream Operations, оператора экспортных нефтепроводов: разделы об инфраструктуре, проектах, социальных инвестициях, карьере, версии en и az.'],
                'az' => ['title' => 'socarmidstream.az — neft-qaz infrastrukturu saytı', 'description' => 'SOCAR-ın neft-qaz infrastrukturu ilə bağlı socarmidstream.az saytı Bakıdakı MGuliyev Studio veb-studiyası tərəfindən hazırlanıb. Layihəyə baxın.'],
                'en' => ['title' => 'socarmidstream.az: Oil and Gas Website | MGuliyev', 'description' => 'The socarmidstream.az website for SOCAR oil and gas infrastructure, developed by MGuliyev Studio, a web studio in Baku. See the project and order a site.'],
            ],
            'elson-group.com' => [
                'ru' => ['title' => 'Сайт агрохолдинга с каталогом продукции — elson-group.com', 'description' => 'Агрохолдинг ELSON Group из Баку: четыре бренда, страницы производства и экспорта, каталог мясной продукции и кожи с поиском, форма заявки, карта, WhatsApp.'],
                'az' => ['title' => 'elson-group.com: aqroholdinq üçün sayt | MGuliyev', 'description' => 'Məhsul ixracı ilə məşğul olan aqroholdinq üçün elson-group.com saytını Bakıda MGuliyev Studio hazırlayıb. Portfolioda işə baxın və oxşar sayt sifariş edin.'],
                'en' => ['title' => 'elson-group.com: Website for an Agricultural Holding', 'description' => 'Web design and development for elson-group.com, an agricultural holding that exports its produce. The site was built by MGuliyev Studio in Baku. Take a look.'],
            ],
            'marsoverseas.az' => [
                'ru' => ['title' => 'Сайт дистрибьютора напитков в Азербайджане — marsoverseas.az', 'description' => 'Сайт производителя и дистрибьютора напитков Mars Overseas: бренды по типам — газировка, соки, холодный чай, вода, — страница бренда Sandora, вакансии.'],
                'az' => ['title' => 'marsoverseas.az — içki distribusiyası üçün sayt', 'description' => 'marsoverseas.az içkilərin distribusiyası ilə məşğul olur. Şirkətin saytını Bakıda MGuliyev Studio hazırlayıb. Siz də sayt sifariş edə bilərsiniz.'],
                'en' => ['title' => 'marsoverseas.az: Beverage Distributor Website', 'description' => 'Website development for marsoverseas.az, a beverage distribution company, by MGuliyev Studio, a Baku web studio. Need a site for your business? Order one.'],
            ],
            'armada.az' => [
                'ru' => ['title' => 'Магазин стоматологического оборудования в Баку — armada.az', 'description' => 'Armada из Баку продаёт оборудование для стоматологических клиник и лабораторий: 4 раздела каталога, скидки в ₼, корзина, избранное, «Академия», техсервис.'],
                'az' => ['title' => 'armada.az: tibbi avadanlıq şirkətinin veb-saytı | MGuliyev', 'description' => 'armada.az klinika və laboratoriyalar üçün avadanlıq sahəsində çalışır. Veb-saytını Bakıda sayt hazırlanması ilə məşğul olan MGuliyev Studio yaradıb.'],
                'en' => ['title' => 'armada.az: Clinic and Lab Equipment Website | MGuliyev', 'description' => 'The armada.az website for a company offering equipment for clinics and laboratories, designed and built by MGuliyev Studio in Baku. See it in our portfolio.'],
            ],
            'argflex.co.uk' => [
                'ru' => ['title' => 'Сайт поставщика шлангов и хомутов в Лондоне — argflex.co.uk', 'description' => 'Arg Flex Ltd из Лондона продаёт резиновые и ПВХ-шланги и хомуты: каталог с ценами в фунтах без НДС, варианты товара, корзина, кнопка запроса, форма и карта.'],
                'az' => ['title' => 'argflex.co.uk — rezin və plastik məmulatlar saytı', 'description' => 'Britaniyada rezin və plastik məmulatlar sahəsində çalışan şirkət üçün argflex.co.uk saytını Bakıdan MGuliyev Studio hazırlayıb. Layihə ilə tanış olun.'],
                'en' => ['title' => 'argflex.co.uk: Web Design for a Rubber and Plastics Firm', 'description' => 'MGuliyev Studio, a web studio in Baku, built the argflex.co.uk website for a UK business in rubber and plastic products. View this web design project.'],
            ],
            'amec.az' => [
                'ru' => ['title' => 'Сайт морского и инженерного консалтинга в Баку — amec.az', 'description' => 'AMEC — морской и инженерный консалтинг: услуги, страницы продуктов с кнопками «Поделиться», проекты Oil & Gas с FEM-анализом, сайт на английском языке.'],
                'az' => ['title' => 'amec.az — dəniz və mühəndislik konsaltinqi saytı', 'description' => 'Dəniz və mühəndislik konsaltinqi ilə məşğul olan amec.az şirkəti üçün veb-saytı MGuliyev Studio işləyib hazırlayıb. Öz şirkətiniz üçün də sayt sifariş edin.'],
                'en' => ['title' => 'amec.az: Website for a Marine and Engineering Consultancy', 'description' => 'A website for amec.az, a marine and engineering consulting firm, developed by Baku web studio MGuliyev Studio. Order a website for your own company.'],
            ],
            'smeltd.az' => [
                'ru' => ['title' => 'Сайт бизнес-консалтинга с разделом бизнес-планов — smeltd.az', 'description' => 'SME из Баку консультирует предпринимателей: бизнес-планы под программы финансирования, тренинги, бухгалтерия, регистрация ООО, блог, FAQ, кнопка WhatsApp.'],
                'az' => ['title' => 'smeltd.az — konsaltinq şirkətinin saytı | MGuliyev', 'description' => 'smeltd.az konsaltinq şirkətinin saytıdır, MGuliyev Studio tərəfindən hazırlanıb. Studiya Bakıda B2B şirkətləri üçün sayt hazırlanması ilə məşğul olur.'],
                'en' => ['title' => 'smeltd.az: Website Development for a Consulting Firm', 'description' => 'MGuliyev Studio in Baku designed and developed the smeltd.az website for a consulting company. Planning a business website? See the project and contact us.'],
            ],
            'azeco.az' => [
                'ru' => ['title' => 'Сайт агрокомпании из Гусарского района — azeco.az', 'description' => 'Овощеводство в Гусарском районе: страницы сортов картофеля и капусты с галереями, версии на русском, азербайджанском и английском. Сайт сейчас не открывается.'],
                'az' => ['title' => 'azeco.az: Qusarda tərəvəzçilik üçün sayt | MGuliyev', 'description' => 'Qusar rayonunda tərəvəzçiliklə məşğul olan azeco.az üçün veb-saytı MGuliyev Studio yaradıb. Layihə Bakıdakı veb-studiyanın portfoliosundadır.'],
                'en' => ['title' => 'azeco.az: Website for a Vegetable Grower in Qusar', 'description' => 'The azeco.az website for a vegetable-growing business in Qusar district was developed by MGuliyev Studio, a web studio in Baku. A project in our portfolio.'],
            ],
            'enemay.com' => [
                'ru' => ['title' => 'Сайт консалтинга и карьерного центра в Баку — enemay.com', 'description' => 'ENEMAY из Баку: бухучёт, налоги, аудит, кадры, аутсорсинг, учебные программы, вакансии с поиском и фильтрами, подписка на новости. Сайт сейчас не открывается.'],
                'az' => ['title' => 'enemay.com — maliyyə konsaltinqi üçün sayt hazırlanması', 'description' => 'Maliyyə konsaltinqi və karyera mərkəzi olan enemay.com üçün sayt Bakıdakı MGuliyev Studio tərəfindən hazırlanıb. Portfolioda arxiv layihəsi kimi göstərilir.'],
                'en' => ['title' => 'enemay.com: Financial Consulting and Career Center Website', 'description' => 'Website development for enemay.com, a financial consulting and career center, by MGuliyev Studio in Baku. An archived project in our web design portfolio.'],
            ],
            'alfalat.com' => [
                'ru' => ['title' => 'Сайт юридической и налоговой компании в Баку — alfalat.com', 'description' => 'ALFA LAT, Баку: право, бухучёт и налоги. 11 практик, форма бесплатной консультации, новости, команда, версии en и az. Сайт сейчас не открывается.'],
                'az' => ['title' => 'alfalat.com — hüquq və vergi konsaltinqi saytı', 'description' => 'alfalat.com — hüquq və vergi konsaltinqi ilə məşğul olan şirkətin saytı. Onu Bakıda MGuliyev Studio hazırlayıb, layihə hazırda portfolioda arxivdədir.'],
                'en' => ['title' => 'alfalat.com: Legal and Tax Consulting Website | MGuliyev', 'description' => 'MGuliyev Studio, a web studio in Baku, designed and built the website for alfalat.com, a legal and tax consulting firm. A past project in our portfolio.'],
            ],
            'cenofex.ai' => [
                'ru' => ['title' => 'Сайт консалтинга по автоматизации и ИИ — cenofex.ai', 'description' => 'Консалтинг Cenofex по автоматизации и внедрению ИИ: направления услуг, технологические партнёры, готовые решения для финансов, налогов и HR, версии en и az.'],
                'az' => ['title' => 'cenofex.ai — süni intellekt konsaltinqi üçün sayt', 'description' => 'cenofex.ai avtomatlaşdırma və süni intellekt üzrə konsaltinq şirkətidir. Şirkət üçün saytı MGuliyev Studio veb-studiyası yaradıb. Layihəyə baxın.'],
                'en' => ['title' => 'cenofex.ai: Website for an AI and Automation Consultancy', 'description' => 'Website for cenofex.ai, a consultancy in automation and AI adoption, developed by MGuliyev Studio in Baku. View the project and order a site for your firm.'],
            ],
        ],
    ],
    'uslugi' => [
        'seo' => [
            'ru' => ['title' => 'Примеры сайтов для сферы услуг: пилатес, химчистка, клининг', 'description' => 'Пилатес-студия с тремя центрами, химчистка с ценами на услуги, клининг с русской версией, музыкальная школа в Чикаго, сайт врача-уролога. Под ключ.'],
            'az' => ['title' => 'Xidmət və sağlamlıq sahəsi üçün sayt hazırlanması | MGuliyev', 'description' => 'MGuliyev Studio Bakıda pilates studiyası, kimyəvi təmizləmə, klininq, musiqi məktəbi, təlim, həkim və ictimai birlik üçün saytlar hazırlayıb. İşlərə baxın.'],
            'en' => ['title' => 'Website development for services and health | MGuliyev', 'description' => 'Websites for a Pilates studio, dry cleaning, cleaning services, a music school, training, a doctor and a public project, built by MGuliyev Studio in Baku.'],
        ],
        'projects' => [
            'pilatesbaku.az' => [
                'ru' => ['title' => 'Сайт для пилатес-студии в Баку — pilatesbaku.az', 'description' => 'Сайт сети студий Baku Pilates Center: три центра на главной, фотогалереи залов, раздел об оборудовании Reformer, контакты с Google-картой.'],
                'az' => ['title' => 'pilatesbaku.az — pilates studiyası üçün sayt | MGuliyev', 'description' => 'Pilates studiyası üçün pilatesbaku.az saytını Bakı veb-studiyası MGuliyev Studio hazırlayıb. Layihəyə baxın və öz studiyanız üçün sayt sifariş edin.'],
                'en' => ['title' => 'pilatesbaku.az: Pilates studio website — MGuliyev Studio', 'description' => 'MGuliyev Studio, a web studio in Baku, developed the pilatesbaku.az website for a Pilates studio. See the project and order a website for your business.'],
            ],
            'drymatic.az' => [
                'ru' => ['title' => 'Сайт химчистки с ценами и корзиной — drymatic.az', 'description' => 'DryMatic в Баку: химчистка, прачечная, крашение текстиля и кожи, ателье. Карточки услуг с ценой в AZN, корзина, FAQ, онлайн-чат, карта филиала.'],
                'az' => ['title' => 'Kimyəvi təmizləmə üçün sayt hazırlanması: drymatic.az', 'description' => 'Kimyəvi təmizləmə ilə məşğul olan sifarişçi üçün drymatic.az saytını Bakıda MGuliyev Studio yaradıb. Biznesiniz üçün də sayt hazırlaya bilərik.'],
                'en' => ['title' => 'Dry cleaning website development: drymatic.az | MGuliyev', 'description' => 'drymatic.az is a dry cleaning business, and its website was built by MGuliyev Studio, a web studio in Baku. Take a look and order a site for your company.'],
            ],
            '166temizlik.az' => [
                'ru' => ['title' => 'Сайт клининговой компании в Баку — 166temizlik.az', 'description' => 'Клининг 166 Təmizlik: пакеты уборки на 4 и 8 часов с ценами, карта обслуживания по Азербайджану, слайдер «до/после», форма связи, русская версия.'],
                'az' => ['title' => 'Klininq xidmətləri saytı: 166temizlik.az — MGuliyev Studio', 'description' => '166temizlik.az klininq xidmətləri göstərir, saytını isə Bakıdakı MGuliyev Studio işləyib hazırlayıb. Şirkətiniz üçün sayt lazımdırsa, layihəni müzakirə edək.'],
                'en' => ['title' => '166temizlik.az: web design for a cleaning company | MGuliyev', 'description' => 'The 166temizlik.az website for a cleaning services company, developed by MGuliyev Studio in Baku. Need a site like this? Order one for your company.'],
            ],
            'kvsdosi.com' => [
                'ru' => ['title' => 'Сайт музыкальной школы в Чикаго — kvsdosi.com', 'description' => 'Сайт на английском для музыкальной школы в Чикаго: индивидуальные, групповые и онлайн-уроки, азербайджанские народные инструменты, лагеря, аренда.'],
                'az' => ['title' => 'Musiqi məktəbi saytının hazırlanması — kvsdosi.com', 'description' => 'kvsdosi.com musiqi məktəbinin saytıdır, onu Bakıdakı MGuliyev Studio veb-studiyası yaradıb. Bu iş portfolioda arxiv layihəsi kimi saxlanılır.'],
                'en' => ['title' => 'kvsdosi.com: music school website by MGuliyev Studio', 'description' => 'Music school website development: MGuliyev Studio in Baku built kvsdosi.com. The site no longer opens, but the project remains in our portfolio.'],
            ],
            'mtt.az' => [
                'ru' => ['title' => 'Сайт HR-консалтинга и подбора персонала — mtt.az', 'description' => 'HR-консалтинг MTT в Баку, сайт на английском: каталог консультантов с поиском, вакансии с поиском по словам и локации, страница подготовки к HRCI.'],
                'az' => ['title' => 'HRCI sertifikasiyasına hazırlıq saytı: mtt.az | MGuliyev', 'description' => 'HRCI sertifikasiyasına hazırlıq üzrə mtt.az saytını MGuliyev Studio yaradıb. Bakıdakı veb-studiyanın bu işi portfolioda arxiv qeydi ilə saxlanılır.'],
                'en' => ['title' => 'mtt.az — website for HRCI certification training | MGuliyev', 'description' => 'mtt.az offers preparation for HRCI certification, and MGuliyev Studio developed its website. The site is offline now, but the work stays in our portfolio.'],
            ],
            'xaliqrzayev.com' => [
                'ru' => ['title' => 'Сайт врача-уролога с записью на приём — xaliqrzayev.com', 'description' => 'Одностраничный сайт уролога-андролога: обследования и операции для взрослых и детей, образование врача, кнопки звонка и WhatsApp, онлайн-запись.'],
                'az' => ['title' => 'Uroloq həkim üçün sayt hazırlanması — xaliqrzayev.com', 'description' => 'Uroloq həkimin xaliqrzayev.com saytı Bakıdakı MGuliyev Studio veb-studiyasının işidir. Həkim və ya klinika üçün sayt lazımdırsa, bizə yazın.'],
                'en' => ['title' => 'Website for a urologist: xaliqrzayev.com — MGuliyev Studio', 'description' => 'Our Baku web studio, MGuliyev Studio, built xaliqrzayev.com, a urologist\'s practice website. Have a look at the project and order a website of your own.'],
            ],
            'itkin.az' => [
                'ru' => ['title' => 'Сайт реестра пропавших без вести — itkin.az', 'description' => 'Сайт общественного объединения «Qarabağ İtkin Ailələri»: список пропавших без вести, статистика, документы, истории и фото, мероприятия, az и en.'],
                'az' => ['title' => 'İtkin düşmüş şəxslər reyestri saytı — itkin.az | MGuliyev', 'description' => 'itkin.az — ictimai birliyin itkin düşmüş şəxslər reyestri. Saytı Bakıda MGuliyev Studio yaradıb. Təşkilatınızın saytını da bizə sifariş edə bilərsiniz.'],
                'en' => ['title' => 'itkin.az: website for a public association — MGuliyev Studio', 'description' => 'itkin.az is a public association\'s registry of missing persons. Its website was developed by MGuliyev Studio, a web studio in Baku.'],
            ],
        ],
    ],
];
