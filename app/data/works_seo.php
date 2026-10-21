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
            'ru' => ['title' => 'Разработка сайтов для логистических компаний | MGuliyev', 'description' => 'Разработка сайтов для логистики и перевозок: контейнеры, таможня, склад, курьеры, такси и трансферы. Смотрите проекты MGuliyev Studio, веб-студии в Баку.'],
            'az' => ['title' => 'Logistika şirkətləri üçün sayt hazırlanması | MGuliyev', 'description' => 'Logistika və daşıma şirkətləri üçün saytların hazırlanması: konteynerlər, gömrük, anbar, kuryerlər, taksi və transferlər. MGuliyev Studio, Bakıda veb-studiya.'],
            'en' => ['title' => 'Logistics and transport website development | MGuliyev', 'description' => 'MGuliyev Studio, a web studio in Baku, develops websites for logistics and transport: containers, customs, warehousing, couriers, taxi and transfers.'],
        ],
        'projects' => [
            'itas.az' => [
                'ru' => ['title' => 'itas.az — сайт для контейнерных перевозок | MGuliyev', 'description' => 'Компания itas.az занимается контейнерными перевозками. Сайт для неё разработала веб-студия MGuliyev Studio в Баку. Смотрите проект и закажите свой сайт.'],
                'az' => ['title' => 'itas.az — konteyner daşımaları üçün sayt hazırlanması', 'description' => 'Konteyner daşımaları ilə məşğul olan şirkət üçün itas.az saytını Bakıdakı MGuliyev Studio hazırlayıb. Layihəyə baxın və şirkətiniz üçün sayt sifariş edin.'],
                'en' => ['title' => 'itas.az: website for a container shipping company | MGuliyev', 'description' => 'The website for itas.az, a container shipping company, was developed by MGuliyev Studio, a Baku web studio. See the project and order your own website.'],
            ],
            'caucasuscl.com' => [
                'ru' => ['title' => 'Создание сайта для таможенной компании caucasuscl.com', 'description' => 'Создание сайта для caucasuscl.com — компании, которая занимается таможенным оформлением и логистикой. Проект MGuliyev Studio, веб-студии в Баку.'],
                'az' => ['title' => 'caucasuscl.com: gömrük və logistika şirkətinin saytı', 'description' => 'Gömrük rəsmiləşdirilməsi və logistika xidmətləri göstərən şirkət üçün caucasuscl.com saytını hazırlamışıq. MGuliyev Studio — Bakıda veb-studiya.'],
                'en' => ['title' => 'Customs and logistics website development: caucasuscl.com', 'description' => 'The website of caucasuscl.com, a customs clearance and logistics company, was built by MGuliyev Studio in Baku. Have a look and ask us for a website.'],
            ],
            'azshipping.az' => [
                'ru' => ['title' => 'Сайт для грузоперевозок azshipping.az — MGuliyev Studio', 'description' => 'Сайт для azshipping.az, компании в сфере грузоперевозок, разработала бакинская веб-студия MGuliyev Studio. Посмотрите проект и закажите сайт для бизнеса.'],
                'az' => ['title' => 'azshipping.az — yükdaşıma şirkəti üçün sayt | MGuliyev', 'description' => 'Yükdaşıma şirkəti azshipping.az üçün sayt hazırlanması — MGuliyev Studio portfoliosundan layihə. Bakıda sizin biznesiniz üçün də sayt hazırlayırıq.'],
                'en' => ['title' => 'Web design for azshipping.az, a freight transport company', 'description' => 'azshipping.az is a freight transport company, and its website was developed by MGuliyev Studio, a Baku web studio. Need a site for your logistics business?'],
            ],
            'marshal.az' => [
                'ru' => ['title' => 'marshal.az — разработка сайта таксопарка | MGuliyev', 'description' => 'marshal.az — таксопарк и партнёр Uber. Сайт компании разработан в MGuliyev Studio, веб-студии в Баку. Смотрите проект и закажите разработку сайта.'],
                'az' => ['title' => 'marshal.az — Uber tərəfdaşı taksi parkının saytı | MGuliyev', 'description' => 'Uber tərəfdaşı olan taksi parkı üçün marshal.az saytını yaratmışıq. MGuliyev Studio Bakıda saytların hazırlanması ilə məşğuldur. Öz saytınızı sifariş edin.'],
                'en' => ['title' => 'marshal.az: taxi fleet website by MGuliyev Studio', 'description' => 'MGuliyev Studio in Baku built the website for marshal.az, a taxi fleet and Uber partner. View the project and order a website for your own company.'],
            ],
            'moverteam.ca' => [
                'ru' => ['title' => 'moverteam.ca — веб-сайт компании по переездам | MGuliyev', 'description' => 'moverteam.ca занимается организацией переездов. Веб-студия MGuliyev Studio из Баку создала для компании сайт — работа представлена в портфолио студии.'],
                'az' => ['title' => 'Köçürmə xidməti üçün sayt hazırlanması: moverteam.ca', 'description' => 'Köçürmələrin təşkili ilə məşğul olan moverteam.ca şirkətinin saytını MGuliyev Studio hazırlayıb. Bakıdakı veb-studiyanın layihəsinə baxın, sayt sifariş edin.'],
                'en' => ['title' => 'moverteam.ca: moving company website development', 'description' => 'Website development for moverteam.ca, a moving services company. The site was designed and built by MGuliyev Studio, a web studio in Baku. See the project.'],
            ],
            'kuryer.net' => [
                'ru' => ['title' => 'kuryer.net — создание сайта курьерской службы', 'description' => 'Сайт курьерской службы kuryer.net создан в MGuliyev Studio. Веб-студия из Баку разрабатывает сайты для бизнеса, и этот проект — часть её портфолио.'],
                'az' => ['title' => 'kuryer.net — kuryer xidmətinin saytı | MGuliyev Studio', 'description' => 'Kuryer xidməti üçün kuryer.net saytı MGuliyev Studio tərəfindən hazırlanıb. Şirkətiniz üçün də sayt lazımdırsa, Bakıdakı studiyamıza yazın.'],
                'en' => ['title' => 'Courier service website kuryer.net | web studio in Baku', 'description' => 'kuryer.net is a courier service, and MGuliyev Studio in Baku developed its website. Looking for website development for your delivery business? Contact us.'],
            ],
            'alizadehgroup.net' => [
                'ru' => ['title' => 'alizadehgroup.net — сайт для трансферов от MGuliyev Studio', 'description' => 'alizadehgroup.net организует трансферы и корпоративные перевозки. Разработка сайта — MGuliyev Studio, веб-студия в Баку. Закажите сайт для своей компании.'],
                'az' => ['title' => 'Transfer şirkətinin saytı: alizadehgroup.net | MGuliyev', 'description' => 'alizadehgroup.net — transferlər və korporativ daşımalarla məşğul olan şirkətin saytı. Onu Bakı veb-studiyası MGuliyev Studio yaradıb. Layihə ilə tanış olun.'],
                'en' => ['title' => 'Transfer company website alizadehgroup.net | MGuliyev', 'description' => 'For alizadehgroup.net, a transfer and corporate transport company, MGuliyev Studio in Baku developed the website. See the work and get a site of your own.'],
            ],
            'dlc.az' => [
                'ru' => ['title' => 'Разработка сайта складского комплекса dlc.az (архив)', 'description' => 'MGuliyev Studio, веб-студия в Баку, разработала сайт для складского комплекса dlc.az. Сейчас сайт не открывается, проект сохранён в портфолио студии.'],
                'az' => ['title' => 'dlc.az: anbar kompleksi üçün sayt | MGuliyev Studio', 'description' => 'dlc.az anbar kompleksi üçün hazırladığımız saytdır və portfolioda arxiv layihəsi kimi qalır. MGuliyev Studio Bakıda logistika şirkətlərinə saytlar hazırlayır.'],
                'en' => ['title' => 'dlc.az: warehouse complex website — MGuliyev Studio', 'description' => 'MGuliyev Studio, a Baku web studio, developed the website for dlc.az, a warehouse complex. The project is kept in the studio\'s logistics portfolio.'],
            ],
        ],
    ],
    'torgovlya' => [
        'seo' => [
            'ru' => ['title' => 'Создание сайтов для магазинов и торговли — MGuliyev Studio', 'description' => 'Разработка сайтов для магазинов и торговли: от книг и техники до обуви и матрасов, включая рынки Австрии, Венгрии и Украины. Веб-студия MGuliyev Studio, Баку.'],
            'az' => ['title' => 'Mağaza və ticarət şirkətləri üçün sayt hazırlanması', 'description' => 'Kitab, texnika, ayaqqabı və döşək mağazaları üçün saytların hazırlanması — Avstriya, Macarıstan və Ukrayna bazarları da daxil olmaqla. MGuliyev Studio, Bakı.'],
            'en' => ['title' => 'Website development for stores and retail | MGuliyev', 'description' => 'MGuliyev Studio in Baku builds store websites, from books and electronics to shoes and mattresses, including sites for Austria, Hungary and Ukraine.'],
        ],
        'projects' => [
            'store.az' => [
                'ru' => ['title' => 'store.az — сайт магазина техники | MGuliyev Studio', 'description' => 'Веб-студия MGuliyev Studio в Баку разработала сайт store.az для магазина техники. Смотрите проект и закажите сайт для своей компании.'],
                'az' => ['title' => 'store.az — texnika mağazası üçün sayt | MGuliyev', 'description' => 'store.az texnika mağazasıdır, saytını isə Bakıdakı veb-studiya MGuliyev Studio hazırlayıb. Layihəyə baxın və şirkətiniz üçün sayt sifariş edin.'],
                'en' => ['title' => 'store.az: electronics store website | MGuliyev', 'description' => 'MGuliyev Studio, a web studio in Baku, built the website of store.az, an electronics store. See the project and order a similar site for your business.'],
            ],
            'avantaj.az' => [
                'ru' => ['title' => 'avantaj.az: создание сайта для магазина телефонов', 'description' => 'Сайт avantaj.az для магазина телефонов создала MGuliyev Studio из Баку. Разрабатываем сайты для торговли — напишите нам, чтобы обсудить ваш проект.'],
                'az' => ['title' => 'Telefon mağazasının saytı: avantaj.az | MGuliyev Studio', 'description' => 'avantaj.az — telefon mağazası. Mağazanın saytı Bakıda, MGuliyev Studio veb-studiyasında hazırlanıb. Mağazanız üçün də sayt lazımdırsa, bizə müraciət edin.'],
                'en' => ['title' => 'avantaj.az: website development for a phone store', 'description' => 'MGuliyev Studio in Baku developed the avantaj.az site for a phone store. Take a look at the project and request a website for your own shop.'],
            ],
            'bookmart.az' => [
                'ru' => ['title' => 'Сайт книжного магазина bookmart.az | MGuliyev Studio', 'description' => 'MGuliyev Studio разработала сайт для книжного магазина bookmart.az. Наша веб-студия в Баку создаёт сайты для магазинов и торговых компаний — закажите свой.'],
                'az' => ['title' => 'bookmart.az: kitab mağazası üçün sayt hazırlanması', 'description' => 'Kitab mağazası bookmart.az üçün saytı Bakı veb-studiyası MGuliyev Studio hazırlayıb. Portfolioda layihə ilə tanış olun və mağazanız üçün sayt hazırlatın.'],
                'en' => ['title' => 'Bookstore website design: bookmart.az | MGuliyev', 'description' => 'The bookmart.az bookstore website was designed and built by MGuliyev Studio, a web studio in Baku. Have a look at the project and plan a site for your store.'],
            ],
            'vanilla.az' => [
                'ru' => ['title' => 'vanilla.az — разработка сайта о тортах на заказ', 'description' => 'vanilla.az делает торты на заказ, а сайт для этого бизнеса разработала MGuliyev Studio, веб-студия из Баку. Сделаем сайт и для вашего дела.'],
                'az' => ['title' => 'Sifarişlə tortlar üçün sayt hazırlanması: vanilla.az', 'description' => 'vanilla.az — sifarişlə tortlar. Bu biznesin saytını MGuliyev Studio Bakıda hazırlayıb. Öz biznesiniz üçün sayt istəyirsinizsə, bizimlə əlaqə saxlayın.'],
                'en' => ['title' => 'vanilla.az: website for a custom cake business', 'description' => 'Web design for vanilla.az, a business that makes custom cakes, by MGuliyev Studio in Baku. See the work and order a website for your brand.'],
            ],
            'tomobuv.com.ua' => [
                'ru' => ['title' => 'tomobuv.com.ua — сайт для магазина обуви | MGuliyev', 'description' => 'Магазин обуви tomobuv.com.ua получил сайт от MGuliyev Studio — веб-студии в Баку, которая создаёт сайты для торговли. Смотрите работу в портфолио.'],
                'az' => ['title' => 'tomobuv.com.ua — ayaqqabı mağazasının saytı | MGuliyev', 'description' => 'tomobuv.com.ua ayaqqabı mağazasıdır. Mağazanın saytını Bakıda fəaliyyət göstərən MGuliyev Studio veb-studiyası hazırlayıb. Layihəyə portfolioda baxın.'],
                'en' => ['title' => 'tomobuv.com.ua: shoe store website — MGuliyev Studio', 'description' => 'The website of the shoe store tomobuv.com.ua was developed by MGuliyev Studio, a web design studio in Baku. Explore the project and get a site of your own.'],
            ],
            'mozahome.com' => [
                'ru' => ['title' => 'mozahome.com: сайт о товарах для дома, Австрия', 'description' => 'MGuliyev Studio из Баку разработала сайт mozahome.com для торговли товарами для дома в Австрии. Сайты для магазинов делаем и за рубежом — смотрите проект.'],
                'az' => ['title' => 'mozahome.com: ev malları saytı, Avstriya | MGuliyev Studio', 'description' => 'mozahome.com — Avstriyada ev üçün mallar. Bu ticarət layihəsinin saytını Bakıdakı MGuliyev Studio hazırlayıb. Xarici bazar üçün sayt lazımdırsa, bizə yazın.'],
                'en' => ['title' => 'Austrian home goods website: mozahome.com | MGuliyev', 'description' => 'MGuliyev Studio, a Baku web studio, built mozahome.com for a home goods business in Austria. Browse the project and order a website for your company.'],
            ],
            'mattress.hu' => [
                'ru' => ['title' => 'mattress.hu — создание сайта о матрасах, Венгрия', 'description' => 'Сайт mattress.hu для продажи матрасов в Венгрии создан веб-студией MGuliyev Studio из Баку. Обсудим разработку сайта и для вашей компании.'],
                'az' => ['title' => 'mattress.hu: Macarıstanda döşəklər üçün sayt | MGuliyev', 'description' => 'Macarıstanda döşəklər — mattress.hu. Saytı Bakıda veb-studiya MGuliyev Studio hazırlayıb. Layihəyə baxın və öz saytınızın hazırlanmasını bizə həvalə edin.'],
                'en' => ['title' => 'mattress.hu: website for a mattress seller in Hungary', 'description' => 'Website development for mattress.hu, a mattress business in Hungary, by MGuliyev Studio from Baku. View the project and order a site for your business.'],
            ],
            'sleepandbed.hu' => [
                'ru' => ['title' => 'Разработка сайта sleepandbed.hu: матрасы и бельё', 'description' => 'Матрасы и постельное бельё в Венгрии — для этого бизнеса MGuliyev Studio, веб-студия в Баку, разработала сайт sleepandbed.hu. Закажите сайт и для себя.'],
                'az' => ['title' => 'sleepandbed.hu — döşək və yataq dəstləri saytı | MGuliyev', 'description' => 'sleepandbed.hu Macarıstanda döşəklər və yataq dəstləri təklif edir. Saytı Bakıdakı veb-studiya MGuliyev Studio hazırlayıb. Layihə ilə portfolioda tanış olun.'],
                'en' => ['title' => 'sleepandbed.hu: web design for a mattress and bedding seller', 'description' => 'MGuliyev Studio in Baku designed sleepandbed.hu, the website of a Hungarian seller of mattresses and bed linen. See the work and discuss your own site.'],
            ],
            'ymkwatercolor.com' => [
                'ru' => ['title' => 'ymkwatercolor.com — сайт об акварельных портретах', 'description' => 'Сайт ymkwatercolor.com об акварельных портретах на заказ разработан в бакинской веб-студии MGuliyev Studio. Расскажите о своей задаче, и мы предложим сайт.'],
                'az' => ['title' => 'Akvarel portretlər üçün sayt: ymkwatercolor.com | MGuliyev', 'description' => 'ymkwatercolor.com — sifarişlə akvarel portretlər. Bu layihənin saytını Bakıda MGuliyev Studio hazırlayıb. İşə baxın və öz biznesiniz üçün sayt sifariş edin.'],
                'en' => ['title' => 'ymkwatercolor.com: website for custom watercolor portraits', 'description' => 'MGuliyev Studio, a web studio in Baku, developed ymkwatercolor.com for a business offering custom watercolor portraits. See the project and order a site.'],
            ],
            'from-dubai.com' => [
                'ru' => ['title' => 'from-dubai.com — сайт для продажи техники из Дубая', 'description' => 'MGuliyev Studio, веб-студия из Баку, создала сайт from-dubai.com для компании, которая предлагает технику из Дубая. Нужен сайт для магазина? Свяжитесь с нами.'],
                'az' => ['title' => 'Dubaydan texnika: from-dubai.com saytı | MGuliyev Studio', 'description' => 'from-dubai.com Dubaydan texnika təklif edir. Saytını Bakıda yerləşən MGuliyev Studio veb-studiyası hazırlayıb. Bənzər sayt üçün bizə müraciət edin.'],
                'en' => ['title' => 'from-dubai.com: web design for an electronics seller', 'description' => 'MGuliyev Studio in Baku developed the from-dubai.com website for a seller of electronics from Dubai. Look through the project and plan a site of your own.'],
            ],
            'dutyfreegroup.az' => [
                'ru' => ['title' => 'dutyfreegroup.az — сайт компании duty free | MGuliyev', 'description' => 'Проект в портфолио MGuliyev Studio: веб-студия в Баку разработала сайт dutyfreegroup.az для компании в сфере duty free. Сейчас проект в архиве.'],
                'az' => ['title' => 'Duty free ticarəti: dutyfreegroup.az saytı | MGuliyev', 'description' => 'Duty free ticarəti üçün dutyfreegroup.az saytını Bakıdakı MGuliyev Studio hazırlayıb. Sayt hazırda açılmır, layihə portfolioda arxiv işləri sırasındadır.'],
                'en' => ['title' => 'dutyfreegroup.az: duty-free retail website | MGuliyev', 'description' => 'Website development for dutyfreegroup.az, a duty-free business, by MGuliyev Studio, a web studio in Baku. A retail project in the studio\'s portfolio.'],
            ],
        ],
    ],
    'avto' => [
        'seo' => [
            'ru' => ['title' => 'Разработка сайтов для авто- и мотобизнеса | MGuliyev', 'description' => 'Создание сайтов для дистрибьюторов, компаний по запчастям, проката, автосервисов, пригона авто из США и площадок объявлений. Портфолио MGuliyev Studio, Баку.'],
            'az' => ['title' => 'Avto və moto şirkətləri üçün sayt hazırlanması | MGuliyev', 'description' => 'Avto və moto distribyutorları, ehtiyat hissələri, icarə və servis şirkətləri üçün saytların hazırlanması — Bakıdakı MGuliyev Studio veb-studiyasının işləri.'],
            'en' => ['title' => 'Websites for car and motorcycle businesses | MGuliyev', 'description' => 'Website development for car and motorcycle businesses by MGuliyev Studio in Baku: distributors, spare parts, rental, service, US imports and classifieds.'],
        ],
        'projects' => [
            'lynkco.az' => [
                'ru' => ['title' => 'lynkco.az — сайт дистрибьютора Lynk & Co | MGuliyev', 'description' => 'Сайт lynkco.az для официального дистрибьютора Lynk & Co разработала веб-студия MGuliyev Studio в Баку. Смотрите проект и закажите сайт для своей компании.'],
                'az' => ['title' => 'lynkco.az — Lynk & Co rəsmi distribyutoru üçün sayt', 'description' => 'lynkco.az Lynk & Co-nun rəsmi distribyutorunun saytıdır. Onu Bakıdakı MGuliyev Studio veb-studiyası hazırlayıb. Layihəyə baxın və öz saytınızı sifariş edin.'],
                'en' => ['title' => 'lynkco.az: website for the official Lynk & Co distributor', 'description' => 'MGuliyev Studio, a web studio in Baku, developed the lynkco.az website for the official Lynk & Co distributor. See the project and order your own site.'],
            ],
            'grandmoto.az' => [
                'ru' => ['title' => 'Создание сайта дистрибьютора мотоциклов: grandmoto.az', 'description' => 'grandmoto.az — сайт дистрибьютора мотоциклов, созданный командой MGuliyev Studio из Баку. Обсудите с нами разработку сайта для своего мотобизнеса.'],
                'az' => ['title' => 'Sayt hazırlanması: grandmoto.az, motosiklet distribyutoru', 'description' => 'Motosiklet distribyutoru grandmoto.az üçün saytı Bakıda MGuliyev Studio hazırlayıb. Layihə ilə tanış olun və şirkətiniz üçün sayt sifariş edin.'],
                'en' => ['title' => 'grandmoto.az — motorcycle distributor web design | MGuliyev', 'description' => 'Web design and development for grandmoto.az, a motorcycle distributor, by MGuliyev Studio from Baku. Explore the project and plan a website of your own.'],
            ],
            'bestsol.az' => [
                'ru' => ['title' => 'Разработка сайта bestsol.az: запчасти для тяжёлой техники', 'description' => 'Сайт bestsol.az для компании, которая занимается запчастями для тяжёлой техники. Его разработала MGuliyev Studio — веб-студия в Баку. Проект в портфолио.'],
                'az' => ['title' => 'bestsol.az: ağır texnika hissələri saytının hazırlanması', 'description' => 'bestsol.az ağır texnika üçün ehtiyat hissələri sahəsində çalışır. Şirkətin saytını Bakıda fəaliyyət göstərən MGuliyev Studio veb-studiyası hazırlayıb.'],
                'en' => ['title' => 'bestsol.az: heavy machinery parts website | MGuliyev Studio', 'description' => 'Website development for bestsol.az, a company dealing in spare parts for heavy machinery. MGuliyev Studio, a web studio in Baku, designed and built it.'],
            ],
            'avtobutik.az' => [
                'ru' => ['title' => 'Сайт avtobutik.az: подбор и доставка авто из США', 'description' => 'MGuliyev Studio из Баку сделала сайт avtobutik.az для компании, которая подбирает и доставляет автомобили из США. Смотрите проект в нашем портфолио.'],
                'az' => ['title' => 'avtobutik.az: ABŞ-dan avtomobil çatdırılması üçün sayt', 'description' => 'ABŞ-dan avtomobil seçimi və çatdırılması ilə məşğul olan avtobutik.az şirkəti üçün saytı Bakıdakı MGuliyev Studio veb-studiyası hazırlayıb.'],
                'en' => ['title' => 'avtobutik.az — website for car sourcing from the USA', 'description' => 'MGuliyev Studio in Baku created the avtobutik.az website for a company that sources and delivers cars from the USA. View the project and order a website.'],
            ],
            'avtoehtiyat.com' => [
                'ru' => ['title' => 'avtoehtiyat.com — сайт объявлений о продаже автозапчастей', 'description' => 'avtoehtiyat.com — площадка объявлений о продаже автозапчастей. Сайт разработан в MGuliyev Studio (Баку). Нужна похожая площадка? Напишите нам.'],
                'az' => ['title' => 'avtoehtiyat.com: ehtiyat hissəsi elan saytının hazırlanması', 'description' => 'avtoehtiyat.com avtomobil ehtiyat hissələrinin satış elanları platformasıdır. Elan saytını Bakıdakı MGuliyev Studio hazırlayıb. Layihəyə portfolioda baxın.'],
                'en' => ['title' => 'avtoehtiyat.com: car parts classifieds website development', 'description' => 'MGuliyev Studio, a Baku web studio, built avtoehtiyat.com, a classifieds website for car parts. See the work and order a website for your own project.'],
            ],
            'avtok1ub.az' => [
                'ru' => ['title' => 'Сайт для автосервиса и замены масла — avtok1ub.az', 'description' => 'Сайт avtok1ub.az для автосервиса, где меняют масло, — работа веб-студии MGuliyev Studio в Баку. Закажите у нас сайт для своего автосервиса.'],
                'az' => ['title' => 'avtok1ub.az — avtoservis saytının hazırlanması | MGuliyev', 'description' => 'Yağ dəyişimi və avtoservis xidməti göstərən avtok1ub.az üçün sayt hazırlanması. Layihə Bakıdakı MGuliyev Studio veb-studiyasının portfoliosundadır.'],
                'en' => ['title' => 'avtok1ub.az — car service website by MGuliyev Studio', 'description' => 'Web design and development of avtok1ub.az, the site of a car service that does oil changes. Built by MGuliyev Studio in Baku. Need a website like this one?'],
            ],
            'carclub.az' => [
                'ru' => ['title' => 'carclub.az: создание сайта для аренды автомобилей', 'description' => 'Создание сайта carclub.az для компании по аренде автомобилей. Разработка — MGuliyev Studio, Баку. Посмотрите проект и закажите сайт для своего проката.'],
                'az' => ['title' => 'carclub.az — avtomobil icarəsi şirkəti üçün sayt | MGuliyev', 'description' => 'carclub.az avtomobil icarəsi ilə məşğuldur. Şirkətin saytını Bakıda MGuliyev Studio hazırlayıb. Layihəyə baxın və biznesiniz üçün sayt sifariş edin.'],
                'en' => ['title' => 'carclub.az: car rental website by a Baku web studio', 'description' => 'carclub.az is a car rental service, and MGuliyev Studio in Baku developed its website. Take a look at the project and order a website for your company.'],
            ],
            'roveltrading.az' => [
                'ru' => ['title' => 'Сайт roveltrading.az — аккумуляторы, масла и шины', 'description' => 'Для компании roveltrading.az, которая работает с аккумуляторами, маслами и шинами, сайт создала MGuliyev Studio. Разрабатываем сайты для автобизнеса в Баку.'],
                'az' => ['title' => 'roveltrading.az: akkumulyator və təkər şirkəti üçün sayt', 'description' => 'roveltrading.az akkumulyator, yağ və təkər distribyutorudur. Onun saytını Bakıdakı veb-studiya MGuliyev Studio hazırlayıb. Layihə ilə tanış olun.'],
                'en' => ['title' => 'roveltrading.az: battery, oil and tyre business website', 'description' => 'MGuliyev Studio developed the roveltrading.az website for a business dealing in batteries, oils and tyres. See this project in our Baku web studio portfolio.'],
            ],
        ],
    ],
    'stroyka' => [
        'seo' => [
            'ru' => ['title' => 'Разработка сайтов: стройка и недвижимость | MGuliyev', 'description' => 'Создание сайтов для подрядчиков, инженерных, кровельных, мебельных и интерьерных компаний, жилого комплекса и недвижимости за рубежом. MGuliyev Studio, Баку.'],
            'az' => ['title' => 'Tikinti və daşınmaz əmlak üçün sayt hazırlanması | MGuliyev', 'description' => 'Podratçı, mühəndislik, dam örtüyü, interyer, mebel və daşınmaz əmlak şirkətləri üçün hazırladığımız saytlar. MGuliyev Studio — Bakıda veb-studiya.'],
            'en' => ['title' => 'Construction and real estate website development | MGuliyev', 'description' => 'MGuliyev Studio, a web studio in Baku, builds websites for construction and real estate: contractors, engineering, roofing, interiors and furniture.'],
        ],
        'projects' => [
            'arka.az' => [
                'ru' => ['title' => 'Сайт arka.az: строительство и дизайн | MGuliyev', 'description' => 'MGuliyev Studio, веб-студия в Баку, разработала сайт arka.az для компании, которая занимается строительством и дизайном. Смотрите проект в портфолио.'],
                'az' => ['title' => 'Tikinti və dizayn şirkəti arka.az üçün sayt | MGuliyev', 'description' => 'arka.az tikinti və dizaynla məşğuldur. Şirkətin saytını Bakıdakı MGuliyev Studio veb-studiyası hazırlayıb. Layihəyə baxın və öz saytınızı sifariş edin.'],
                'en' => ['title' => 'arka.az: website for a construction and design firm', 'description' => 'MGuliyev Studio, a web studio in Baku, developed the arka.az website for a construction and design company. See the project and order a site for your firm.'],
            ],
            'damchi.az' => [
                'ru' => ['title' => 'damchi.az — создание сайта для кровельной компании', 'description' => 'Сайт damchi.az для компании, выполняющей кровельные работы, создала MGuliyev Studio из Баку. Закажите у нас разработку сайта для своей строительной фирмы.'],
                'az' => ['title' => 'damchi.az: dam örtüyü işləri üçün sayt hazırlanması', 'description' => 'Dam örtüyü işləri görən damchi.az şirkətinin saytını MGuliyev Studio hazırlayıb — Bakıda veb-studiya. Tikinti biznesiniz üçün də sayt lazımdırsa, bizə yazın.'],
                'en' => ['title' => 'damchi.az: roofing company website — MGuliyev Studio', 'description' => 'MGuliyev Studio in Baku designed and built damchi.az, the website of a roofing company. Take a look at the project and order a website for your business.'],
            ],
            'agrosport.az' => [
                'ru' => ['title' => 'Разработка сайта agrosport.az: спортивная инфраструктура', 'description' => 'Для компании agrosport.az, работающей в сфере спортивной инфраструктуры, сайт разработала бакинская веб-студия MGuliyev Studio. Смотрите проект.'],
                'az' => ['title' => 'agrosport.az — idman infrastrukturu şirkətinin saytı', 'description' => 'agrosport.az idman infrastrukturu sahəsində fəaliyyət göstərir. Bu şirkət üçün saytı Bakı veb-studiyası MGuliyev Studio yaradıb. Portfolioda layihəyə baxın.'],
                'en' => ['title' => 'agrosport.az: sports infrastructure website | MGuliyev', 'description' => 'Web design and development for agrosport.az, a sports infrastructure company, by MGuliyev Studio in Baku. Have a look at the work and plan a site of your own.'],
            ],
            'lifeonisland.com' => [
                'ru' => ['title' => 'Создание сайта lifeonisland.com: недвижимость на Кипре', 'description' => 'Сайт lifeonisland.com создан в MGuliyev Studio (Баку) для бизнеса в сфере недвижимости на Кипре. Нужен похожий сайт для вашей компании? Напишите нам.'],
                'az' => ['title' => 'lifeonisland.com: Kiprdə daşınmaz əmlak saytı | MGuliyev', 'description' => 'Kiprdə daşınmaz əmlaka həsr olunmuş lifeonisland.com saytını Bakıdakı MGuliyev Studio yaradıb. Əmlak biznesiniz üçün sayt lazımdırsa, bizə müraciət edin.'],
                'en' => ['title' => 'lifeonisland.com: Cyprus property website | MGuliyev', 'description' => 'MGuliyev Studio in Baku built lifeonisland.com, a website about property in Cyprus. Explore the project and get a real estate website for your company.'],
            ],
            'metalist.az' => [
                'ru' => ['title' => 'Сайт metalist.az: ворота и рольставни — MGuliyev Studio', 'description' => 'Ворота и рольставни — сфера работы metalist.az. Сайт этой компании создала MGuliyev Studio, веб-студия из Баку. Сейчас это архивный проект в портфолио.'],
                'az' => ['title' => 'metalist.az — darvaza və rolet şirkətinin saytı | MGuliyev', 'description' => 'metalist.az darvazalar və roletlərlə məşğul olur. Şirkətin saytını Bakıdakı MGuliyev Studio hazırlayıb; layihə portfolioda arxiv işi kimi saxlanılır.'],
                'en' => ['title' => 'metalist.az: gates and roller shutters website', 'description' => 'Website for metalist.az, a gates and roller shutters business, designed and built by MGuliyev Studio, a Baku web studio. Part of the studio\'s portfolio.'],
            ],
            'whitestone.com.az' => [
                'ru' => ['title' => 'whitestone.com.az — сайт жилого комплекса | MGuliyev', 'description' => 'Создание сайта whitestone.com.az для жилого комплекса — работа MGuliyev Studio, студии веб-разработки из Баку. Проект сохранён в портфолио как архивный.'],
                'az' => ['title' => 'whitestone.com.az: yaşayış kompleksi üçün sayt | MGuliyev', 'description' => 'Yaşayış kompleksi üçün whitestone.com.az saytı Bakıdakı veb-studiya MGuliyev Studio tərəfindən hazırlanıb. Bu iş portfolioda arxiv layihəsi kimi göstərilir.'],
                'en' => ['title' => 'whitestone.com.az: residential complex website', 'description' => 'Website development for whitestone.com.az, a residential complex, carried out by MGuliyev Studio in Baku. A real estate project in the studio\'s portfolio.'],
            ],
            'tce.az' => [
                'ru' => ['title' => 'tce.az — сайт проектно-строительной компании | MGuliyev', 'description' => 'Сайт tce.az разработан в MGuliyev Studio для компании, которая ведёт проектирование и строительно-монтажные работы. Создаём сайты для строителей в Баку.'],
                'az' => ['title' => 'tce.az saytının hazırlanması — layihələndirmə və tikinti', 'description' => 'tce.az layihələndirmə və tikinti-quraşdırma işləri görür. Onun saytını MGuliyev Studio hazırlayıb — Bakıda saytların hazırlanması ilə məşğul olan veb-studiya.'],
                'en' => ['title' => 'tce.az — design and construction company website', 'description' => 'tce.az handles design and construction works, and MGuliyev Studio, a web studio in Baku, developed its website. See the project and order a site like it.'],
            ],
            'ceng.az' => [
                'ru' => ['title' => 'Сайт инженерной компании ceng.az — MGuliyev Studio', 'description' => 'Сайт ceng.az разработала веб-студия MGuliyev Studio в Баку. Профиль компании — инженерные системы и поставка оборудования. Закажите сайт для своего бизнеса.'],
                'az' => ['title' => 'ceng.az — mühəndislik sistemləri şirkəti üçün sayt', 'description' => 'Mühəndislik sistemləri və avadanlıq təchizatı ilə məşğul olan ceng.az şirkətinin saytını Bakıdakı MGuliyev Studio yaradıb. Layihə ilə tanış olun.'],
                'en' => ['title' => 'ceng.az: engineering systems company website | MGuliyev', 'description' => 'Website development for ceng.az, an engineering systems and equipment supply company. Built by MGuliyev Studio, Baku. See the work and request a site.'],
            ],
            'arginterior.co.uk' => [
                'ru' => ['title' => 'arginterior.co.uk: сайт для столярной компании в Лондоне', 'description' => 'Разработка сайта arginterior.co.uk для лондонской компании, которая занимается столярными работами и интерьером. Сделано в MGuliyev Studio, Баку.'],
                'az' => ['title' => 'arginterior.co.uk — Londondakı interyer şirkətinin saytı', 'description' => 'Londonda dülgərlik və interyer işləri görən arginterior.co.uk şirkətinin saytı Bakıda, MGuliyev Studio veb-studiyasında hazırlanıb. Layihəyə baxın.'],
                'en' => ['title' => 'arginterior.co.uk: London interior fit-out website', 'description' => 'MGuliyev Studio, a Baku web studio, built the website of arginterior.co.uk, a carpentry and interior fit-out business in London. See this web design project.'],
            ],
            'mybel.az' => [
                'ru' => ['title' => 'Разработка сайта mybel.az: мебель на заказ | MGuliyev', 'description' => 'Компания mybel.az предлагает мебель на заказ и интерьерные решения, а её сайт разработала веб-студия MGuliyev Studio в Баку. Обсудим сайт для вашего бизнеса?'],
                'az' => ['title' => 'mybel.az — fərdi mebel şirkəti üçün sayt | MGuliyev', 'description' => 'mybel.az fərdi mebel və interyer həlləri təklif edir. Saytını Bakıda işləyən veb-studiya MGuliyev Studio hazırlayıb. Mebel biznesiniz üçün sayt sifariş edin.'],
                'en' => ['title' => 'mybel.az: bespoke furniture website — MGuliyev Studio', 'description' => 'Web design and development for mybel.az, a bespoke furniture and interiors company, by MGuliyev Studio in Baku. Order a website for your furniture business.'],
            ],
        ],
    ],
    'promyshlen' => [
        'seo' => [
            'ru' => ['title' => 'Разработка сайтов для промышленности и B2B | MGuliyev', 'description' => 'Разработка сайтов для нефтегаза, агробизнеса, дистрибуции, промышленных комплектующих, медоборудования и консалтинга — веб-студия MGuliyev Studio в Баку.'],
            'az' => ['title' => 'Sənaye və B2B şirkətləri üçün sayt hazırlanması | MGuliyev', 'description' => 'Neft-qaz, aqrar sektor, distribusiya, sənaye komponentləri, tibbi avadanlıq və konsaltinq üçün saytların hazırlanması. MGuliyev Studio — Bakıda veb-studiya.'],
            'en' => ['title' => 'Industrial and B2B Website Development | MGuliyev', 'description' => 'Websites for industry and B2B: oil and gas, agriculture, distribution, industrial components, medical equipment and consulting. MGuliyev Studio, Baku.'],
        ],
        'projects' => [
            'socarmidstream.az' => [
                'ru' => ['title' => 'socarmidstream.az — сайт о нефтегазовой инфраструктуре SOCAR', 'description' => 'Сайт socarmidstream.az о нефтегазовой инфраструктуре SOCAR — разработка веб-студии MGuliyev Studio в Баку. Смотрите проект и закажите сайт для своей компании.'],
                'az' => ['title' => 'socarmidstream.az — neft-qaz infrastrukturu saytı', 'description' => 'SOCAR-ın neft-qaz infrastrukturu ilə bağlı socarmidstream.az saytı Bakıdakı MGuliyev Studio veb-studiyası tərəfindən hazırlanıb. Layihəyə baxın.'],
                'en' => ['title' => 'socarmidstream.az: Oil and Gas Website | MGuliyev', 'description' => 'The socarmidstream.az website for SOCAR oil and gas infrastructure, developed by MGuliyev Studio, a web studio in Baku. See the project and order a site.'],
            ],
            'elson-group.com' => [
                'ru' => ['title' => 'elson-group.com: создание сайта агрохолдинга | MGuliyev', 'description' => 'Веб-студия MGuliyev Studio из Баку создала сайт elson-group.com для агрохолдинга, который занимается экспортом продукции. Смотрите работу в портфолио.'],
                'az' => ['title' => 'elson-group.com: aqroholdinq üçün sayt | MGuliyev', 'description' => 'Məhsul ixracı ilə məşğul olan aqroholdinq üçün elson-group.com saytını Bakıda MGuliyev Studio hazırlayıb. Portfolioda işə baxın və oxşar sayt sifariş edin.'],
                'en' => ['title' => 'elson-group.com: Website for an Agricultural Holding', 'description' => 'Web design and development for elson-group.com, an agricultural holding that exports its produce. The site was built by MGuliyev Studio in Baku. Take a look.'],
            ],
            'marsoverseas.az' => [
                'ru' => ['title' => 'Сайт для дистрибуции напитков — marsoverseas.az | MGuliyev', 'description' => 'Сайт marsoverseas.az для компании, которая занимается дистрибуцией напитков, разработан бакинской веб-студией MGuliyev Studio. Посмотрите, что получилось.'],
                'az' => ['title' => 'marsoverseas.az — içki distribusiyası üçün sayt', 'description' => 'marsoverseas.az içkilərin distribusiyası ilə məşğul olur. Şirkətin saytını Bakıda MGuliyev Studio hazırlayıb. Siz də sayt sifariş edə bilərsiniz.'],
                'en' => ['title' => 'marsoverseas.az: Beverage Distributor Website', 'description' => 'Website development for marsoverseas.az, a beverage distribution company, by MGuliyev Studio, a Baku web studio. Need a site for your business? Order one.'],
            ],
            'armada.az' => [
                'ru' => ['title' => 'Сайт armada.az: оборудование для клиник и лабораторий', 'description' => 'Веб-студия MGuliyev Studio в Баку разработала сайт armada.az для компании, которая работает с оборудованием для клиник и лабораторий. Смотрите проект.'],
                'az' => ['title' => 'armada.az: tibbi avadanlıq şirkətinin veb-saytı | MGuliyev', 'description' => 'armada.az klinika və laboratoriyalar üçün avadanlıq sahəsində çalışır. Veb-saytını Bakıda sayt hazırlanması ilə məşğul olan MGuliyev Studio yaradıb.'],
                'en' => ['title' => 'armada.az: Clinic and Lab Equipment Website | MGuliyev', 'description' => 'The armada.az website for a company offering equipment for clinics and laboratories, designed and built by MGuliyev Studio in Baku. See it in our portfolio.'],
            ],
            'argflex.co.uk' => [
                'ru' => ['title' => 'argflex.co.uk: сайт о резиновых и пластиковых изделиях', 'description' => 'Сайт argflex.co.uk для британской компании в сфере резиновых и пластиковых изделий — разработка веб-студии MGuliyev Studio из Баку. Оцените работу.'],
                'az' => ['title' => 'argflex.co.uk — rezin və plastik məmulatlar saytı', 'description' => 'Britaniyada rezin və plastik məmulatlar sahəsində çalışan şirkət üçün argflex.co.uk saytını Bakıdan MGuliyev Studio hazırlayıb. Layihə ilə tanış olun.'],
                'en' => ['title' => 'argflex.co.uk: Web Design for a Rubber and Plastics Firm', 'description' => 'MGuliyev Studio, a web studio in Baku, built the argflex.co.uk website for a UK business in rubber and plastic products. View this web design project.'],
            ],
            'amec.az' => [
                'ru' => ['title' => 'amec.az — сайт для морского и инженерного консалтинга', 'description' => 'MGuliyev Studio, веб-студия в Баку, создала сайт amec.az для компании, которая занимается морским и инженерным консалтингом. Закажите сайт и для своей фирмы.'],
                'az' => ['title' => 'amec.az — dəniz və mühəndislik konsaltinqi saytı', 'description' => 'Dəniz və mühəndislik konsaltinqi ilə məşğul olan amec.az şirkəti üçün veb-saytı MGuliyev Studio işləyib hazırlayıb. Öz şirkətiniz üçün də sayt sifariş edin.'],
                'en' => ['title' => 'amec.az: Website for a Marine and Engineering Consultancy', 'description' => 'A website for amec.az, a marine and engineering consulting firm, developed by Baku web studio MGuliyev Studio. Order a website for your own company.'],
            ],
            'smeltd.az' => [
                'ru' => ['title' => 'Сайт консалтинговой компании smeltd.az | MGuliyev Studio', 'description' => 'Сайт smeltd.az для консалтинговой компании создала бакинская веб-студия MGuliyev Studio. Посмотрите работу и закажите сайт для своего бизнеса.'],
                'az' => ['title' => 'smeltd.az — konsaltinq şirkətinin saytı | MGuliyev', 'description' => 'smeltd.az konsaltinq şirkətinin saytıdır, MGuliyev Studio tərəfindən hazırlanıb. Studiya Bakıda B2B şirkətləri üçün sayt hazırlanması ilə məşğul olur.'],
                'en' => ['title' => 'smeltd.az: Website Development for a Consulting Firm', 'description' => 'MGuliyev Studio in Baku designed and developed the smeltd.az website for a consulting company. Planning a business website? See the project and contact us.'],
            ],
            'azeco.az' => [
                'ru' => ['title' => 'azeco.az: сайт для овощеводства в Гусарском районе', 'description' => 'Сайт azeco.az для компании, занимающейся овощеводством в Гусарском районе, разработала веб-студия MGuliyev Studio в Баку. Проект в портфолио студии.'],
                'az' => ['title' => 'azeco.az: Qusarda tərəvəzçilik üçün sayt | MGuliyev', 'description' => 'Qusar rayonunda tərəvəzçiliklə məşğul olan azeco.az üçün veb-saytı MGuliyev Studio yaradıb. Layihə Bakıdakı veb-studiyanın portfoliosundadır.'],
                'en' => ['title' => 'azeco.az: Website for a Vegetable Grower in Qusar', 'description' => 'The azeco.az website for a vegetable-growing business in Qusar district was developed by MGuliyev Studio, a web studio in Baku. A project in our portfolio.'],
            ],
            'enemay.com' => [
                'ru' => ['title' => 'enemay.com — сайт финансового консалтинга | MGuliyev', 'description' => 'Создание сайта enemay.com для финансового консалтинга и карьерного центра — работа веб-студии MGuliyev Studio из Баку. Проект в портфолио студии.'],
                'az' => ['title' => 'enemay.com — maliyyə konsaltinqi üçün sayt hazırlanması', 'description' => 'Maliyyə konsaltinqi və karyera mərkəzi olan enemay.com üçün sayt Bakıdakı MGuliyev Studio tərəfindən hazırlanıb. Portfolioda arxiv layihəsi kimi göstərilir.'],
                'en' => ['title' => 'enemay.com: Financial Consulting and Career Center Website', 'description' => 'Website development for enemay.com, a financial consulting and career center, by MGuliyev Studio in Baku. An archived project in our web design portfolio.'],
            ],
            'alfalat.com' => [
                'ru' => ['title' => 'alfalat.com: сайт юридического и налогового консалтинга', 'description' => 'Разработка сайта alfalat.com для компании юридического и налогового консалтинга — работа MGuliyev Studio, веб-студии в Баку. Проект в портфолио.'],
                'az' => ['title' => 'alfalat.com — hüquq və vergi konsaltinqi saytı', 'description' => 'alfalat.com — hüquq və vergi konsaltinqi ilə məşğul olan şirkətin saytı. Onu Bakıda MGuliyev Studio hazırlayıb, layihə hazırda portfolioda arxivdədir.'],
                'en' => ['title' => 'alfalat.com: Legal and Tax Consulting Website | MGuliyev', 'description' => 'MGuliyev Studio, a web studio in Baku, designed and built the website for alfalat.com, a legal and tax consulting firm. A past project in our portfolio.'],
            ],
            'cenofex.ai' => [
                'ru' => ['title' => 'cenofex.ai — сайт консалтинга по внедрению ИИ | MGuliyev', 'description' => 'Сайт cenofex.ai для компании, которая консультирует по автоматизации и внедрению ИИ, разработала MGuliyev Studio — веб-студия в Баку. Закажите свой сайт.'],
                'az' => ['title' => 'cenofex.ai — süni intellekt konsaltinqi üçün sayt', 'description' => 'cenofex.ai avtomatlaşdırma və süni intellekt üzrə konsaltinq şirkətidir. Şirkət üçün saytı MGuliyev Studio veb-studiyası yaradıb. Layihəyə baxın.'],
                'en' => ['title' => 'cenofex.ai: Website for an AI and Automation Consultancy', 'description' => 'Website for cenofex.ai, a consultancy in automation and AI adoption, developed by MGuliyev Studio in Baku. View the project and order a site for your firm.'],
            ],
        ],
    ],
    'uslugi' => [
        'seo' => [
            'ru' => ['title' => 'Разработка сайтов: услуги и здоровье — MGuliyev Studio', 'description' => 'Создание сайтов для сферы услуг и здоровья: пилатес, химчистка, клининг, школа музыки, обучение, врач, общественный проект. Работы MGuliyev Studio, Баку.'],
            'az' => ['title' => 'Xidmət və sağlamlıq sahəsi üçün sayt hazırlanması | MGuliyev', 'description' => 'MGuliyev Studio Bakıda pilates studiyası, kimyəvi təmizləmə, klininq, musiqi məktəbi, təlim, həkim və ictimai birlik üçün saytlar hazırlayıb. İşlərə baxın.'],
            'en' => ['title' => 'Website development for services and health | MGuliyev', 'description' => 'Websites for a Pilates studio, dry cleaning, cleaning services, a music school, training, a doctor and a public project, built by MGuliyev Studio in Baku.'],
        ],
        'projects' => [
            'pilatesbaku.az' => [
                'ru' => ['title' => 'Сайт для студии пилатеса pilatesbaku.az | MGuliyev', 'description' => 'Веб-студия MGuliyev Studio в Баку разработала сайт pilatesbaku.az для студии пилатеса. Посмотрите проект и закажите сайт для своей студии.'],
                'az' => ['title' => 'pilatesbaku.az — pilates studiyası üçün sayt | MGuliyev', 'description' => 'Pilates studiyası üçün pilatesbaku.az saytını Bakı veb-studiyası MGuliyev Studio hazırlayıb. Layihəyə baxın və öz studiyanız üçün sayt sifariş edin.'],
                'en' => ['title' => 'pilatesbaku.az: Pilates studio website — MGuliyev Studio', 'description' => 'MGuliyev Studio, a web studio in Baku, developed the pilatesbaku.az website for a Pilates studio. See the project and order a website for your business.'],
            ],
            'drymatic.az' => [
                'ru' => ['title' => 'Создание сайта химчистки drymatic.az | MGuliyev', 'description' => 'Сайт химчистки drymatic.az создан веб-студией MGuliyev Studio в Баку. Студия делает сайты для сферы услуг — закажите сайт для своей компании.'],
                'az' => ['title' => 'Kimyəvi təmizləmə üçün sayt hazırlanması: drymatic.az', 'description' => 'Kimyəvi təmizləmə ilə məşğul olan sifarişçi üçün drymatic.az saytını Bakıda MGuliyev Studio yaradıb. Biznesiniz üçün də sayt hazırlaya bilərik.'],
                'en' => ['title' => 'Dry cleaning website development: drymatic.az | MGuliyev', 'description' => 'drymatic.az is a dry cleaning business, and its website was built by MGuliyev Studio, a web studio in Baku. Take a look and order a site for your company.'],
            ],
            '166temizlik.az' => [
                'ru' => ['title' => 'Разработка сайта для клининга 166temizlik.az | MGuliyev', 'description' => 'Сайт 166temizlik.az о клининговых услугах разработала команда MGuliyev Studio из Баку. Нужен сайт для вашего бизнеса? Оставьте заявку веб-студии.'],
                'az' => ['title' => 'Klininq xidmətləri saytı: 166temizlik.az — MGuliyev Studio', 'description' => '166temizlik.az klininq xidmətləri göstərir, saytını isə Bakıdakı MGuliyev Studio işləyib hazırlayıb. Şirkətiniz üçün sayt lazımdırsa, layihəni müzakirə edək.'],
                'en' => ['title' => '166temizlik.az: web design for a cleaning company | MGuliyev', 'description' => 'The 166temizlik.az website for a cleaning services company, developed by MGuliyev Studio in Baku. Need a site like this? Order one for your company.'],
            ],
            'kvsdosi.com' => [
                'ru' => ['title' => 'Сайт для музыкальной школы kvsdosi.com | MGuliyev', 'description' => 'Создание сайта для школы музыки kvsdosi.com — работа веб-студии MGuliyev Studio в Баку. Проект сохранён в портфолио как пример сайта для обучения.'],
                'az' => ['title' => 'Musiqi məktəbi saytının hazırlanması — kvsdosi.com', 'description' => 'kvsdosi.com musiqi məktəbinin saytıdır, onu Bakıdakı MGuliyev Studio veb-studiyası yaradıb. Bu iş portfolioda arxiv layihəsi kimi saxlanılır.'],
                'en' => ['title' => 'kvsdosi.com: music school website by MGuliyev Studio', 'description' => 'Music school website development: MGuliyev Studio in Baku built kvsdosi.com. The site no longer opens, but the project remains in our portfolio.'],
            ],
            'mtt.az' => [
                'ru' => ['title' => 'mtt.az: сайт о подготовке к сертификации HRCI | MGuliyev', 'description' => 'Сайт mtt.az о подготовке к сертификации HRCI разработала MGuliyev Studio, веб-студия в Баку. Проект в портфолио — пример сайта для сферы обучения.'],
                'az' => ['title' => 'HRCI sertifikasiyasına hazırlıq saytı: mtt.az | MGuliyev', 'description' => 'HRCI sertifikasiyasına hazırlıq üzrə mtt.az saytını MGuliyev Studio yaradıb. Bakıdakı veb-studiyanın bu işi portfolioda arxiv qeydi ilə saxlanılır.'],
                'en' => ['title' => 'mtt.az — website for HRCI certification training | MGuliyev', 'description' => 'mtt.az offers preparation for HRCI certification, and MGuliyev Studio developed its website. The site is offline now, but the work stays in our portfolio.'],
            ],
            'xaliqrzayev.com' => [
                'ru' => ['title' => 'Разработка сайта врача-уролога xaliqrzayev.com | MGuliyev', 'description' => 'xaliqrzayev.com — сайт врача-уролога, разработанный MGuliyev Studio, веб-студией в Баку. Смотрите проект и закажите сайт для своей практики.'],
                'az' => ['title' => 'Uroloq həkim üçün sayt hazırlanması — xaliqrzayev.com', 'description' => 'Uroloq həkimin xaliqrzayev.com saytı Bakıdakı MGuliyev Studio veb-studiyasının işidir. Həkim və ya klinika üçün sayt lazımdırsa, bizə yazın.'],
                'en' => ['title' => 'Website for a urologist: xaliqrzayev.com — MGuliyev Studio', 'description' => 'Our Baku web studio, MGuliyev Studio, built xaliqrzayev.com, a urologist\'s practice website. Have a look at the project and order a website of your own.'],
            ],
            'itkin.az' => [
                'ru' => ['title' => 'Сайт реестра пропавших без вести itkin.az — MGuliyev Studio', 'description' => 'itkin.az — сайт общественного объединения с реестром пропавших без вести. Разработку сайта выполнила MGuliyev Studio, веб-студия в Баку.'],
                'az' => ['title' => 'İtkin düşmüş şəxslər reyestri saytı — itkin.az | MGuliyev', 'description' => 'itkin.az — ictimai birliyin itkin düşmüş şəxslər reyestri. Saytı Bakıda MGuliyev Studio yaradıb. Təşkilatınızın saytını da bizə sifariş edə bilərsiniz.'],
                'en' => ['title' => 'itkin.az: website for a public association — MGuliyev Studio', 'description' => 'itkin.az is a public association\'s registry of missing persons. Its website was developed by MGuliyev Studio, a web studio in Baku.'],
            ],
        ],
    ],
];
