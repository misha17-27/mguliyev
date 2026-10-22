<?php
/* Проекты по отраслям. Заказчик первым делом ищет «делали ли вы такое же»,
   поэтому группируем по сфере бизнеса, а не по типу сайта.
   На странице раздела сетка плоская, а группы работают фильтром.

   Формат проекта: [домен, описание, обложка|null, мёртвый?]
   Обложка null — берётся отраслевая подложка группы. Появится скриншот —
   положите его в /images/works/<домен>.jpg и укажите здесь, затем
   запустите php tools/make-images.php — он сделает WebP-копии для srcset.
   Исходные снимки клиентских сайтов лежат в _portfolio-src/ — эта папка
   намеренно вне сайта и на хостинг не выкладывается. */

return [
    ['Логистика и перевозки', 'Грузоперевозки, таможня, склад, курьеры, такси, переезды и трансферы.', 'logistika', [
        ['caucasuscl.com',    'Таможенное оформление и логистика',  '/images/works/caucasuscl.com.jpg'],
        ['azshipping.az',     'Грузоперевозки',                     '/images/works/azshipping.az.jpg'],
        ['marshal.az',        'Таксопарк, партнёр Uber',            '/images/home/work-3.jpg'],
        ['moverteam.ca',      'Организация переездов',              '/images/works/moverteam.ca.jpg'],
        ['kuryer.net',        'Курьерская служба',                  '/images/works/kuryer.net.jpg'],
        ['alizadehgroup.net', 'Трансферы и корпоративные перевозки', '/images/works/alizadehgroup.net.jpg'],
        ['dlc.az',            'Складской комплекс',                 null, true],
    ]],
    ['Магазины и торговля', 'От книг и техники до обуви и матрасов, включая рынки Австрии, Венгрии и Украины.', 'torgovlya', [
        ['store.az',          'Магазин техники',                     '/images/home/work-5.jpg'],
        ['avantaj.az',        'Магазин телефонов',                   null],
        ['bookmart.az',       'Магазин книг',                        '/images/works/bookmart.az.jpg'],
        ['vanilla.az',        'Торты на заказ',                      '/images/works/vanilla.az.jpg'],
        ['tomobuv.com.ua',    'Магазин обуви',                       '/images/works/tomobuv.com.ua.jpg'],
        ['mozahome.com',      'Товары для дома, Австрия',            null],
        ['mattress.hu',       'Матрасы, Венгрия',                    null],
        ['sleepandbed.hu',    'Матрасы и постельное бельё, Венгрия', '/images/works/sleepandbed.hu.jpg'],
        ['ymkwatercolor.com', 'Акварельные портреты на заказ',       '/images/works/ymkwatercolor.com.jpg'],
        ['from-dubai.com',    'Техника из Дубая',                    null],
        ['dutyfreegroup.az',  'Duty free',                           null, true],
    ]],
    ['Авто и мото', 'Дистрибьюторы, запчасти, аренда, сервис, пригон из США и площадка объявлений.', 'avto', [
        ['lynkco.az',       'Официальный дистрибьютор Lynk & Co', '/images/home/work-2.jpg'],
        ['grandmoto.az',    'Дистрибьютор мотоциклов',                '/images/home/work-4.jpg'],
        ['bestsol.az',      'Запчасти для тяжёлой техники',           '/images/works/bestsol.az.jpg'],
        ['avtobutik.az',    'Подбор и доставка автомобилей из США',   '/images/works/avtobutik.az.jpg'],
        ['avtoehtiyat.com', 'Объявления о продаже автозапчастей',     null],
        ['avtok1ub.az',     'Замена масла, автосервис',               null],
        ['carclub.az',          'Аренда автомобилей',                                null],
        ['roveltrading.az',     'Аккумуляторы, масла и шины',                        null],
    ]],
    ['Стройка и недвижимость', 'Подрядчики, инженерия, кровля, интерьеры и мебель, жилой комплекс и недвижимость за рубежом.', 'stroyka', [
        ['arka.az',           'Строительство и дизайн',    '/images/works/arka.az.jpg'],
        ['damchi.az',         'Кровельные работы',         null],
        ['agrosport.az',      'Спортивная инфраструктура', null],
        ['lifeonisland.com',  'Недвижимость на Кипре',     '/images/works/lifeonisland.com.jpg'],
        ['metalist.az',       'Ворота и рольставни',       '/images/works/metalist.az.jpg', true],
        ['whitestone.com.az', 'Жилой комплекс',            null, true],
        ['tce.az',              'Проектирование и строительно-монтажные работы',     null],
        ['ceng.az',             'Инженерные системы и поставка оборудования',        null],
        ['arginterior.co.uk',   'Столярные работы и интерьер, Лондон',               null],
        ['mybel.az',            'Мебель на заказ и интерьерные решения',             null],
    ]],
    ['Промышленность и B2B', 'Нефтегаз, агро, дистрибуция, промышленные комплектующие, медоборудование и консалтинг.', 'promyshlen', [
        ['socarmidstream.az', 'Нефтегазовая инфраструктура SOCAR',         null],
        ['elson-group.com',   'Агрохолдинг, экспорт продукции',            '/images/works/elson-group.com.jpg'],
        ['marsoverseas.az',   'Дистрибуция напитков',                      '/images/works/marsoverseas.az.jpg'],
        ['armada.az',         'Оборудование для клиник и лабораторий',     '/images/works/armada.az.jpg'],
        ['argflex.co.uk',     'Резиновые и пластиковые изделия, Британия', '/images/works/argflex.co.uk.jpg'],
        ['amec.az',           'Морской и инженерный консалтинг',           '/images/works/amec.az.jpg'],
        ['smeltd.az',         'Консалтинг',                                '/images/works/smeltd.az.jpg'],
        ['azeco.az',          'Овощеводство, Гусарский район',             '/images/works/azeco.az.jpg', true],
        ['enemay.com',        'Финансовый консалтинг и карьерный центр',   '/images/works/enemay.com.jpg', true],
        ['alfalat.com',       'Юридический и налоговый консалтинг',        '/images/works/alfalat.com.jpg', true],
        ['cenofex.ai',          'Консалтинг: автоматизация и внедрение ИИ',          null],
        ['itas.az',           'Поставка промышленных материалов и оборудования', '/images/works/itas.az.jpg'],
    ]],
    ['Услуги и здоровье', 'Пилатес, химчистка, клининг, музыкальная школа, обучение, приём врача и общественный проект.', 'uslugi', [
        ['pilatesbaku.az', 'Студия пилатеса',                '/images/works/pilatesbaku.az.jpg'],
        ['drymatic.az',    'Химчистка',                      '/images/works/drymatic.az.jpg'],
        ['166temizlik.az', 'Клининговые услуги',             '/images/works/166temizlik.az.jpg'],
        ['kvsdosi.com',    'Школа музыки',                   '/images/works/kvsdosi.com.jpg', true],
        ['mtt.az',         'Подготовка к сертификации HRCI', '/images/works/mtt.az.jpg', true],
        ['xaliqrzayev.com',     'Сайт врача-уролога',                                null],
        ['itkin.az',            'Реестр пропавших без вести, общественное объединение', null],
    ]],
];
