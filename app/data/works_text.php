<?php
/* Тексты страниц проектов портфолио: ru — основа, az и en — перевод.

   Факты — только проверяемые: чем занимается заказчик (data/works.php),
   что видно на снимках сайта (app/data/works_gallery.php) и то, что
   все сайты студия сделала под ключ и с настройкой SEO (со слов владельца). Без придуманных
   результатов, сроков и цифр; каждый текст сверен со снимками.

   Текст из панели главнее этого: файл заполняет только языки, которых
   у проекта в панели нет совсем (works_seo_fill() в app/content.php). */

return [
    'ccs.com.az' => [
        'ru' => 'Cost Control Services — бакинская компания, которая с конца 2021 года помогает ресторанам, кафе, лаунжам и отелям держать затраты под контролем: налаживает финансовый учёт и готовит ежемесячные отчёты P&L, считает себестоимость блюд по технологическим картам, наводит порядок в закупках и на складе, выстраивает внутренний контроль. Сайт рассказывает об этих услугах владельцам заведений и собирает заявки на консультацию.

MGuliyev Studio создала сайт с нуля под ключ: структура, дизайн, разработка, настройка SEO и запуск. На главной — ключевые цифры компании, шесть направлений услуг во вкладках, логотипы 18 брендов-клиентов, блок о контроле питания на чемпионате мира по тхэквондо 2023 года в Баку, превью роликов из TikTok со ссылкой на профиль и лента Instagram. Там же и на странице «Услуги» работает калькулятор себестоимости: он считает фудкост блюда и маржу с порции, а также подсказывает цену, при которой блюдо укладывается в целевой фудкост. Форма заявки отправляет обращение и сразу открывает WhatsApp с готовым сообщением, а плавающая кнопка WhatsApp видна на каждой странице. Помимо главной, на сайте пять страниц: «О нас», «Услуги», «Клиенты», «Вопросы» и «Контакты» — все на азербайджанском, русском и английском. У каждой страницы на всех трёх языках свои заголовок и описание для поиска, а в карте сайта собраны все языковые версии.',
        'az' => 'Cost Control Services — 2021-ci ilin sonundan bəri restoran, kafe, lounge və otellərə xərcləri nəzarətdə saxlamağa kömək edən Bakı şirkətidir. Şirkət maliyyə uçotunu qurur, aylıq P&L hesabatları hazırlayır, yeməklərin maya dəyərini texnoloji kartlar əsasında hesablayır, həmçinin satınalma, inventar və daxili nəzarəti qaydaya salır. Sayt bu xidmətləri müəssisə sahiblərinə izah edir və konsultasiya üçün müraciət etməyə imkan verir.

MGuliyev Studio saytı sıfırdan, açar təhvil hazırlayıb: struktur, dizayn, proqramlaşdırma, SEO ayarları və işə salınma. Ana səhifədə şirkətin əsas rəqəmləri, açılan bölmələr şəklində altı xidmət istiqaməti, 18 müştəri brendinin loqoları, 2023-cü ildə Bakıda keçirilən Taekvondo üzrə Dünya Çempionatında qida nəzarəti haqqında blok, profilə keçidli TikTok video önizləmələri və Instagram paylaşımları yer alır. Həmin səhifədə və «Xidmətlər» səhifəsində maya dəyəri kalkulyatoru da var: yeməyin food cost faizini, porsiya başına marjanı və hədəf faizə uyğun satış qiymətini hesablayır. Konsultasiya forması göndərildikdə müraciət qəbul olunur və WhatsApp dərhal hazır mesajla açılır, WhatsApp düyməsi isə hər səhifədə görünür. Ana səhifədən başqa «Haqqımızda», «Xidmətlər», «Müştərilər», «Suallar» və «Əlaqə» səhifələri var. Sayt Azərbaycan, rus və ingilis dillərində işləyir. Bütün səhifələrin hər üç dildə axtarış sistemləri üçün öz başlığı və təsviri var, sayt xəritəsi də yaradılıb.',
        'en' => 'Cost Control Services is a Baku-based company that has been helping restaurants, cafés, lounges and hotels keep their costs under control since late 2021. It sets up financial accounting, prepares monthly P&L reports, calculates dish costs from recipe cards and brings order to purchasing, inventory and internal control. The website explains these services to venue owners and collects consultation requests.

MGuliyev Studio built the site from scratch on a turnkey basis: structure, design, development, SEO setup and launch. The home page features the company\'s key figures, tabs for its six service areas, the logos of 18 client brands, a section on its food quality control at the 2023 World Taekwondo Championships in Baku, TikTok video previews linking to the profile, and an Instagram feed. The home and Services pages also carry a food cost calculator that works out a dish\'s food cost percentage, the margin per portion and the selling price needed to reach a target food cost set by the user. The consultation form submits the request and immediately opens WhatsApp with a pre-filled message, and a floating WhatsApp button appears on every page. Besides the home page, there are “About us”, “Services”, “Clients”, “FAQ” and “Contact” pages, and the whole site is available in Azerbaijani, Russian and English. Every page has its own meta title and description in all three languages, and an XML sitemap is in place.',
    ],
    'itas.az' => [
        'ru' => 'ITAS (Intercontinental trading and supply) — бакинская компания, которая поставляет промышленные материалы и оборудование. Сайт показывает, какие группы товаров можно заказать и с какими производителями работает поставщик, и помогает сразу отправить запрос.

Проект выполнен под ключ: структура, дизайн, разработка, настройка SEO и запуск. В разделе «Продукция» 12 групп товаров — от стали и сварочных материалов до насосов, клапанов, HVAC и вентиляции. Есть страницы «О нас» и «Партнёры» с логотипами брендов, контакты с формой обращения под защитой reCAPTCHA и картой Google, плавающие кнопки WhatsApp и почты. Флажки в шапке переключают сайт на азербайджанский или английский.',
        'az' => 'ITAS (Intercontinental trading and supply) — sənaye materialları və avadanlıqları tədarük edən Bakı şirkətidir. Sayt hansı məhsul qruplarını sifariş etməyin mümkün olduğunu və tədarükçünün hansı istehsalçılarla işlədiyini göstərir, həmçinin dərhal sorğu göndərməyə kömək edir.

Layihə açar təhvil şəklində icra olunub: struktur, dizayn, hazırlanma, SEO ayarları və işə salınma. «Məhsullar» bölməsində 12 məhsul qrupu var — poladdan və qaynaq materiallarından nasoslara, klapanlara, HVAC və ventilyasiyaya qədər. «Haqqımızda» səhifəsi, brend loqoları olan «Tərəfdaşlar» səhifəsi, reCAPTCHA ilə qorunan müraciət forması və Google xəritəsi olan əlaqə səhifəsi, WhatsApp və poçt üçün üzən düymələr var. Saytın başlığındakı bayraqlar onu Azərbaycan və ya ingilis dilinə keçirir.',
        'en' => 'ITAS (Intercontinental trading and supply) is a Baku-based company that supplies industrial materials and equipment. The website shows which product groups can be ordered and which manufacturers the supplier works with, and helps visitors send an inquiry right away.

The project was done turnkey: structure, design, development, SEO setup and launch. The "Products" section covers 12 product groups, from steel and welding materials to pumps, valves, HVAC and ventilation. There are "About us" and "Partners" pages with brand logos, a contact page with a reCAPTCHA-protected inquiry form and a Google map, and floating WhatsApp and email buttons. Flags in the header switch the site to Azerbaijani or English.',
    ],
    'caucasuscl.com' => [
        'ru' => 'Caucasus Customs and Logistics — таможенный брокер из Баку. Компания оформляет таможенные декларации, готовит документы для импорта и экспорта, получает сертификаты и разрешения госорганов, забирает грузы с таможенного склада, а также занимается логистикой, консалтингом и консигнацией.

Мы сделали сайт под ключ — от структуры и дизайна до разработки и запуска. При разработке было настроено и SEO. Семь услуг собраны на отдельной странице, в ленте новостей — сообщения о таможенных правилах и разборы в формате «вопрос — ответ», а меню «Полезные ссылки» ведёт на Государственный таможенный комитет и другие ведомства. Есть блок с логотипами клиентов, форма обращения с reCAPTCHA и карта. Сайт работает на азербайджанском и русском: переключатель языков стоит в меню.',
        'az' => 'Caucasus Customs and Logistics — Bakıda fəaliyyət göstərən gömrük brokeridir. Şirkət gömrük bəyannamələrini tərtib edir, idxal və ixrac üçün sənədləri hazırlayır, dövlət orqanlarından sertifikat və icazələr alır, yükləri gömrük anbarından təhvil alır, həmçinin logistika, konsaltinq və konsiqnasiya ilə məşğul olur.

Saytı açar təhvil yaratdıq — struktur və dizayndan hazırlanma və işə salınmaya qədər. Hazırlanma zamanı SEO da tənzimlənib. Yeddi xidmət ayrıca səhifədə toplanıb, xəbər lentində gömrük qaydaları barədə məlumatlar və «sual — cavab» formatında izahlar dərc olunur, «Faydalı linklər» menyusu isə Dövlət Gömrük Komitəsinə və digər qurumlara aparır. Müştəri loqoları olan blok, reCAPTCHA ilə müraciət forması və xəritə var. Sayt Azərbaycan və rus dillərində işləyir: dil dəyişdiricisi menyudadır.',
        'en' => 'Caucasus Customs and Logistics is a customs broker from Baku. The company files customs declarations, prepares import and export documents, obtains certificates and permits from government agencies, collects cargo from the customs warehouse, and also handles logistics, consulting and consignment.

We built the website turnkey, from structure and design to development and launch. SEO was set up during development as well. The seven services are gathered on a separate page, the news feed carries updates on customs rules and question-and-answer explainers, and the "Useful links" menu leads to the State Customs Committee and other agencies. There is a block of client logos, an inquiry form with reCAPTCHA and a map. The site runs in Azerbaijani and Russian, with the language switcher in the menu.',
    ],
    'azshipping.az' => [
        'ru' => 'AZSHIPPING — бакинская компания, которая организует международные и местные грузоперевозки. Сайт на английском рассказывает о видах перевозок и помогает клиенту сразу запросить стоимость.

Студия разработала сайт под ключ: структура, дизайн, разработка, запуск. При разработке было настроено и SEO. У шести услуг — автомобильных, авиа-, морских и железнодорожных перевозок, проектных грузов и таможенного оформления — свои страницы с боковым меню услуг; на страницах авиа- и автоперевозок есть перечень решений и форма «Send Request». В верхней панели — кнопка «Request a quote». В разделе Careers соискатель может отправить отклик, а на странице контактов есть форма с reCAPTCHA и карта Google.',
        'az' => 'AZSHIPPING — beynəlxalq və yerli yükdaşımaları təşkil edən Bakı şirkətidir. İngilis dilindəki sayt daşıma növləri barədə məlumat verir və müştəriyə dərhal qiymət sorğusu göndərməyə kömək edir.

Studiya saytı açar təhvil yaradıb: struktur, dizayn, hazırlanma, SEO ayarları, işə salınma. Altı xidmətin — avtomobil, hava, dəniz və dəmir yolu daşımalarının, layihə yüklərinin və gömrük rəsmiləşdirilməsinin — xidmətlərin yan menyusu olan öz səhifələri var; hava və avtomobil daşımaları səhifələrində həllərin siyahısı və «Send Request» forması yerləşir. Yuxarı paneldə «Request a quote» düyməsi var. Careers bölməsində namizəd öz müraciətini göndərə bilər, əlaqə səhifəsində isə reCAPTCHA ilə forma və Google xəritəsi var.',
        'en' => 'AZSHIPPING is a Baku-based company that organizes international and local freight transportation. The English-language website explains the types of transportation and helps clients request a price right away.

The studio developed the website turnkey: structure, design, development, launch. SEO was set up during development as well. Each of the six services (road, air, sea and rail freight, project cargo and customs clearance) has its own page with a side menu of services; the air and road freight pages include a list of solutions and a "Send Request" form. The top bar has a "Request a quote" button. In the Careers section, job seekers can submit an application, and the contact page has a form with reCAPTCHA and a Google map.',
    ],
    'marshal.az' => [
        'ru' => 'Marshal — бакинский таксопарк и партнёр Uber. Сайт нацелен на набор: он нужен, чтобы водители такси, курьеры на собственном мотоцикле и владельцы нескольких машин оставили заявку на подключение к Uber.

Работа выполнена под ключ: структура, дизайн, разработка, настройка SEO и запуск. На первом экране — короткая анкета «Uber sürücüsü ol» («Стань водителем Uber»), ниже блок преимуществ и форма «Bizə qoşul» с выбором вида услуги. Отдельные страницы: Uber partner, Uber delivery с условиями подключения для курьеров и «Öz avtoparkını yarat» («Создай свой автопарк») с формой, где указывают число автомобилей. На странице контактов — форма, адрес и карта Google, в подвале повторяются кнопки заявок.',
        'az' => 'Marshal — Bakıdakı taksi parkı və Uber tərəfdaşıdır. Sayt işə cəlb üçün nəzərdə tutulub: onun vəzifəsi taksi sürücülərinin, öz motosikleti ilə işləyən kuryerlərin və bir neçə avtomobili olan sahiblərin Uber-ə qoşulmaq üçün müraciət göndərməsidir.

İş açar təhvil şəklində görülüb: struktur, dizayn, hazırlanma, SEO ayarları və işə salınma. İlk ekranda qısa «Uber sürücüsü ol» anketi, aşağıda üstünlüklər bloku və xidmət növünün seçildiyi «Bizə qoşul» forması yerləşir. Ayrıca səhifələr: Uber partner, kuryerlər üçün qoşulma şərtləri olan Uber delivery və avtomobillərin sayının qeyd olunduğu forması olan «Öz avtoparkını yarat». Əlaqə səhifəsində forma, ünvan və Google xəritəsi var, saytın aşağı hissəsində müraciət düymələri təkrarlanır.',
        'en' => 'Marshal is a Baku taxi fleet and Uber partner. The website is built for recruitment: its job is to get taxi drivers, couriers with their own motorcycle and owners of several cars to apply to join Uber.

The work was done turnkey: structure, design, development, SEO setup and launch. The first screen features a short questionnaire, "Uber sürücüsü ol" ("Become an Uber driver"), followed by a block of benefits and a "Bizə qoşul" form where visitors choose the type of service. Separate pages: Uber partner, Uber delivery with the onboarding terms for couriers, and "Öz avtoparkını yarat" ("Create your own fleet") with a form for entering the number of cars. The contact page has a form, an address and a Google map, and the footer repeats the application buttons.',
    ],
    'moverteam.ca' => [
        'ru' => 'MoverTeam — компания по переездам из Торонто, которая работает по Большому Торонто (GTA) в Канаде. Англоязычный сайт нужен, чтобы клиент сразу оставил заявку на переезд и увидел, какие услуги и города обслуживает компания.

Студия из Баку сделала этот сайт под ключ — от структуры и дизайна до разработки и запуска. При разработке было настроено и SEO. На первом экране форма «откуда / куда» с reCAPTCHA для запроса стоимости. Описаны три направления — квартирный, офисный и междугородний переезд — и что входит в каждый переезд. Есть страница Location с картой Канады и списком городов GTA, фотогалерея автопарка, карта Google, плавающие кнопки звонка и WhatsApp, мобильная версия.',
        'az' => 'MoverTeam — Kanadada, Böyük Toronto (GTA) ərazisində işləyən Toronto köçürmə şirkətidir. İngilisdilli sayt müştərinin dərhal köçürmə üçün müraciət göndərməsi və şirkətin hansı xidmətləri göstərdiyini, hansı şəhərlərdə işlədiyini görməsi üçün lazımdır.

Bakıdakı studiya bu saytı açar təhvil yaradıb — struktur və dizayndan hazırlanma və işə salınmaya qədər. Hazırlanma zamanı SEO da tənzimlənib. İlk ekranda qiymət sorğusu üçün reCAPTCHA ilə «haradan / haraya» forması var. Üç istiqamət — mənzil, ofis və şəhərlərarası köçürmə — və hər köçürməyə nələrin daxil olduğu təsvir edilib. Kanada xəritəsi və GTA şəhərlərinin siyahısı olan Location səhifəsi, avtoparkın foto qalereyası, Google xəritəsi, zəng və WhatsApp üçün üzən düymələr, mobil versiya var.',
        'en' => 'MoverTeam is a Toronto moving company that serves the Greater Toronto Area (GTA) in Canada. The English-language website is designed so that clients can submit a moving request right away and see which services and cities the company covers.

The Baku-based studio built this website turnkey, from structure and design to development and launch. SEO was set up during development as well. The first screen has a "from / to" form with reCAPTCHA for requesting a quote. Three lines of service are described (apartment, office and long-distance moving) along with what each move includes. There is a Location page with a map of Canada and a list of GTA cities, a photo gallery of the fleet, a Google map, floating call and WhatsApp buttons, and a mobile version.',
    ],
    'kuryer.net' => [
        'ru' => 'Kuryer.net — курьерская служба с офисом в центре Баку: доставляет письма и посылки по городу и стране, а через зарубежных партнёров — международную экспресс-почту. Сайт нужен, чтобы клиент сам посчитал стоимость, вызвал курьера и проследил отправление.

Сайт разработан под ключ: структура, дизайн, разработка, запуск. При разработке было настроено и SEO. Главный инструмент — калькулятор отправки: адрес, вид услуги, отметки срочной доставки по Баку и доставки-сюрприза, итог в AZN. На главной есть и поле отслеживания отправления. У услуг — от срочной доставки до цветов и приглашений — есть отдельные страницы. Для регулярных отправок предусмотрены пакеты со скидкой 10, 15 и 20%, а ещё на сайте есть страница партнёров и мобильная версия.',
        'az' => 'Kuryer.net — ofisi Bakının mərkəzində yerləşən kuryer xidmətidir: məktub və bağlamaları şəhər və ölkə üzrə, xarici tərəfdaşlar vasitəsilə isə beynəlxalq ekspress poçtu çatdırır. Sayt müştərinin qiyməti özü hesablaması, kuryer çağırması və göndərişi izləməsi üçün lazımdır.

Sayt açar təhvil şəklində yaradılıb: struktur, dizayn, hazırlanma, SEO ayarları, işə salınma. Əsas alət göndəriş kalkulyatorudur: ünvan, xidmət növü, Bakı üzrə təcili çatdırılma və sürpriz çatdırılma seçimləri, yekun məbləğ AZN ilə. Ana səhifədə göndərişin izlənməsi üçün sahə də var. Xidmətlərin — təcili çatdırılmadan gül və dəvətnamələrə qədər — ayrıca səhifələri var. Müntəzəm göndərişlər üçün 10, 15 və 20% endirimli paketlər nəzərdə tutulub, saytda həmçinin tərəfdaşlar səhifəsi və mobil versiya var.',
        'en' => 'Kuryer.net is a courier service with an office in central Baku: it delivers letters and parcels across the city and the country and, through partners abroad, international express mail. The website lets clients calculate the cost themselves, call a courier and track a shipment.

The website was developed turnkey: structure, design, development, launch. SEO was set up during development as well. The main tool is the shipping calculator: address, type of service, checkboxes for urgent delivery within Baku and surprise delivery, and the total in AZN. The home page also has a shipment tracking field. Services, from urgent delivery to flowers and invitations, have their own pages. For regular shipments there are packages with 10, 15 and 20% discounts, and the site also has a partners page and a mobile version.',
    ],
    'alizadehgroup.net' => [
        'ru' => 'Alizadeh Group — азербайджанская компания, которая занимается трансферами и корпоративными перевозками: возит пассажиров в аэропорт и из аэропорта, между городами и помогает бизнес-клиентам с отелями, турами, ресторанами и шопингом. Сайт описывает эти услуги и принимает заявки.

Мы сделали сайт под ключ: структура, дизайн, разработка, настройка SEO и запуск. У трансфера в аэропорт и междугороднего трансфера свои страницы с условиями заказа, списком того, что есть в машине, и автопарком: Mercedes Viano, V-class, Sprinter, E-class и S-class. Раздел «Корпоративный консалтинг» рассказывает о подборе отелей, туров, ресторанов и мест для шопинга. Есть страницы «О нас» и «Преимущества», форма заявки с reCAPTCHA и переключатель языка.',
        'az' => 'Alizadeh Group — transferlər və korporativ daşımalarla məşğul olan Azərbaycan şirkətidir: sərnişinləri hava limanına və hava limanından, şəhərlər arasında daşıyır, biznes müştərilərinə isə otel, tur, restoran və alış-veriş məsələlərində kömək edir. Sayt bu xidmətləri təsvir edir və müraciətləri qəbul edir.

Saytı açar təhvil yaratdıq: struktur, dizayn, hazırlanma, SEO ayarları və işə salınma. Hava limanı transferi və şəhərlərarası transfer üçün ayrıca səhifələr var: onlarda sifariş şərtləri, avtomobildə nələrin olduğunun siyahısı və avtopark — Mercedes Viano, V-class, Sprinter, E-class və S-class — göstərilib. «Korporativ məsləhət» bölməsi otel, tur, restoran və alış-veriş yerlərinin seçilməsindən bəhs edir. «Haqqımızda» və «Üstünlüklərimiz» səhifələri, reCAPTCHA ilə müraciət forması və dil dəyişdiricisi var.',
        'en' => 'Alizadeh Group is an Azerbaijani company that provides transfers and corporate transportation: it takes passengers to and from the airport and between cities, and helps business clients with hotels, tours, restaurants and shopping. The website describes these services and accepts requests.

We built the website turnkey: structure, design, development, SEO setup and launch. Airport transfer and intercity transfer each have their own page with booking terms, a list of what is in the car, and the fleet: Mercedes Viano, V-class, Sprinter, E-class and S-class. The "Corporate consulting" section covers choosing hotels, tours, restaurants and shopping spots. There are "About us" and "Advantages" pages, a request form with reCAPTCHA and a language switcher.',
    ],
    'dlc.az' => [
        'ru' => 'dlc.az — сайт складского комплекса. Проект входит в раздел «Логистика и перевозки» вместе с сайтами экспедитора azshipping.az, таможенного брокера caucasuscl.com и курьерской службы kuryer.net.

Студия разработала этот сайт под ключ: структура, дизайн, разработка, настройка SEO и запуск. Сейчас dlc.az не открывается, но проект остаётся в портфолио студии.',
        'az' => 'dlc.az — anbar kompleksinin saytıdır. Layihə «Logistika və daşımalar» bölməsinə ekspeditor şirkəti azshipping.az, gömrük brokeri caucasuscl.com və kuryer xidməti kuryer.net saytları ilə birlikdə daxildir.

Studiya bu saytı açar təhvil yaradıb: struktur, dizayn, hazırlanma, SEO ayarları və işə salınma. Hazırda dlc.az açılmır, amma layihə studiyanın portfoliosunda qalır.',
        'en' => 'dlc.az is the website of a warehouse complex. The project belongs to the "Logistics and transport" section, together with the websites of freight forwarder azshipping.az, customs broker caucasuscl.com and courier service kuryer.net.

The studio developed this website turnkey: structure, design, development, SEO setup and launch. dlc.az is currently offline, but the project remains in the studio\'s portfolio.',
    ],
    'store.az' => [
        'ru' => 'store.az — магазин компьютерной техники. В каталоге восемь разделов: компьютеры, ноутбуки, комплектующие, внешние накопители, мониторы, аксессуары, принтеры и игровые устройства. Цены на сайте указаны в манатах.

Студия сделала сайт под ключ: структура, дизайн, разработка, настройка SEO и запуск. На главной — баннер, разделы каталога плитками и блок новинок. В карточке товара — галерея фото, кнопка «В корзину», таблица характеристик, сравнение, список желаний и похожие товары. В мобильной версии внизу экрана закреплена панель со сравнением, корзиной и личным кабинетом.',
        'az' => 'store.az — kompüter texnikası mağazasıdır. Kataloqda səkkiz bölmə var: kompüterlər, noutbuklar, komplektləşdiricilər, xarici yaddaş qurğuları, monitorlar, aksesuarlar, printerlər və oyun qurğuları. Saytda qiymətlər manatla göstərilir.

Studiya saytı açar təhvil hazırlayıb: struktur, dizayn, proqramlaşdırma, SEO ayarları və işə salınma. Ana səhifədə — banner, plitələr şəklində kataloq bölmələri və yeniliklər bloku. Məhsul kartında — foto qalereyası, «Səbətə» düyməsi, xüsusiyyətlər cədvəli, müqayisə, istək siyahısı və oxşar məhsullar. Mobil versiyada ekranın aşağısında müqayisə, səbət və şəxsi kabinet olan panel sabitlənib.',
        'en' => 'store.az is a computer equipment store. Its catalogue has eight sections: computers, laptops, components, external storage, monitors, accessories, printers and gaming devices. Prices on the site are given in manats.

The studio built the site on a turnkey basis: structure, design, development, SEO setup and launch. The home page has a banner, the catalogue sections as tiles and a new arrivals block. The product page has a photo gallery, an “Add to cart” button, a specifications table, comparison, a wishlist and similar products. On mobile, a bar with comparison, the cart and the user account is pinned to the bottom of the screen.',
    ],
    'avantaj.az' => [
        'ru' => 'avantaj.az — сайт магазина телефонов. Проект относится к разделу портфолио «Магазины и торговля», где собраны сделанные MGuliyev Studio сайты магазинов компьютерной техники, книг, оптовой обуви, матрасов и товаров для дома.

Этот сайт студия разработала под ключ: все этапы работы, от структуры и дизайна до разработки и запуска, выполнила MGuliyev Studio. При разработке было настроено и SEO.',
        'az' => 'avantaj.az — telefon mağazasının saytıdır. Layihə portfolionun «Mağazalar və ticarət» bölməsinə aiddir; burada MGuliyev Studio-nun kompüter texnikası, kitab, topdan ayaqqabı, döşək və ev üçün mallar mağazaları üçün hazırladığı saytlar toplanıb.

Studiya bu saytı açar təhvil hazırlayıb: strukturdan və dizayndan tutmuş proqramlaşdırma və işə salınmaya qədər bütün iş mərhələlərini MGuliyev Studio yerinə yetirib. Hazırlanma zamanı SEO da tənzimlənib.',
        'en' => 'avantaj.az is the website of a phone store. The project belongs to the “Stores and retail” section of the portfolio, which brings together the store websites MGuliyev Studio has made for computer equipment, books, wholesale shoes, mattresses and home goods.

The studio developed this site on a turnkey basis: every stage of the work, from structure and design to development and launch, was done by MGuliyev Studio. SEO was set up during development as well.',
    ],
    'bookmart.az' => [
        'ru' => 'bookmart.az — книжный магазин в Баку. Здесь продают пособия для госслужбы, учебники для разных ступеней образования и художественную литературу.

Сайт сделан под ключ — от структуры и дизайна до разработки и запуска. При разработке было настроено и SEO. В шапке — поиск, меню разделов и пункты «Заказать книгу», «Продать книгу», «Издать книгу» и «Подготовительные курсы». В карточке книги — цена в манатах, кнопки «В корзину» и WhatsApp, описание и похожие издания. На главной — слайдер со спецпредложениями и подборки по темам, в мобильной версии — плавающие кнопки звонка и WhatsApp.',
        'az' => 'bookmart.az — Bakıda kitab mağazasıdır. Burada dövlət qulluğu üçün vəsaitlər, müxtəlif təhsil pillələri üçün dərsliklər və bədii ədəbiyyat satılır.

Sayt açar təhvil hazırlanıb — strukturdan və dizayndan proqramlaşdırma və işə salınmaya qədər. Hazırlanma zamanı SEO da tənzimlənib. Saytın yuxarı hissəsində — axtarış, bölmələr menyusu və «Kitab sifariş et», «Kitab sat», «Kitab nəşr et» və «Hazırlıq kursları» bəndləri. Kitab kartında — manatla qiymət, «Səbətə» və WhatsApp düymələri, təsvir və oxşar nəşrlər. Ana səhifədə — xüsusi təkliflərlə slayder və mövzular üzrə seçmələr, mobil versiyada isə zəng və WhatsApp üçün üzən düymələr.',
        'en' => 'bookmart.az is a bookstore in Baku. It sells study guides for the civil service, textbooks for different levels of education and fiction.

The site was built on a turnkey basis, from structure and design to development and launch. SEO was set up during development as well. The header has search, a section menu and the items “Order a book”, “Sell a book”, “Publish a book” and “Preparatory courses”. The book page shows the price in manats, “Add to cart” and WhatsApp buttons, a description and similar titles. The home page has a slider with special offers and themed selections; the mobile version has floating call and WhatsApp buttons.',
    ],
    'vanilla.az' => [
        'ru' => 'Vanilla Cake делает торты на заказ. Сайт vanilla.az построен вокруг каталога бенто-тортов: клиент выбирает торт, настраивает его под себя и оставляет заявку на нужную дату.

Студия разработала сайт под ключ: структура, дизайн, разработка, настройка SEO и запуск. В карточке торта — цена в манатах, выбор размера (на 1–2 или 3–4 персоны), бисквита и начинки, вкладки с описанием и условиями доставки и оплаты. В форме заказа указывают имя, телефон, вид торта, дату, email и сообщение, к ней можно приложить фото желаемого торта. Есть вход и регистрация, страница «Состав» с фото тортов в разрезе, FAQ, лента Instagram и кнопка WhatsApp.',
        'az' => 'Vanilla Cake sifarişlə tortlar hazırlayır. vanilla.az saytı bento-tortlar kataloqu üzərində qurulub: müştəri tortu seçir, onu özünə uyğunlaşdırır və lazım olan tarixə sifariş göndərir.

Studiya saytı açar təhvil hazırlayıb: struktur, dizayn, proqramlaşdırma, SEO ayarları və işə salınma. Tort kartında — manatla qiymət, ölçü (1–2 və ya 3–4 nəfərlik), biskvit və içlik seçimi, təsvir, eləcə də çatdırılma və ödəniş şərtləri olan vərəqlər. Sifariş formasında ad, telefon, tortun növü, tarix, e-poçt və mesaj göstərilir, formaya arzu olunan tortun fotosunu da əlavə etmək olar. Saytda giriş və qeydiyyat, kəsilmiş tortların fotoları ilə «Tərkib» səhifəsi, FAQ, Instagram lenti və WhatsApp düyməsi var.',
        'en' => 'Vanilla Cake makes cakes to order. The vanilla.az site is built around a catalogue of bento cakes: the customer chooses a cake, customises it and leaves a request for the date they need.

The studio developed the site on a turnkey basis: structure, design, development, SEO setup and launch. The cake page shows the price in manats, a choice of size (for 1–2 or 3–4 people), sponge and filling, and tabs with a description and the delivery and payment terms. The order form asks for a name, phone number, type of cake, date, email and message, and a photo of the desired cake can be attached to it. There is login and registration, a “Composition” page with photos of the cakes in cross-section, an FAQ, an Instagram feed and a WhatsApp button.',
    ],
    'tomobuv.com.ua' => [
        'ru' => 'tomobuv — оптовый магазин обуви из Одессы: детская, подростковая, мужская и женская обувь продаётся ящиками. Сайт на русском языке рассчитан на частных предпринимателей и владельцев магазинов, которые закупают обувь партиями.

MGuliyev Studio сделала сайт под ключ: от структуры каталога и дизайна до разработки и запуска. При разработке было настроено и SEO. В карточке товара видны цена за пару и за ящик, число пар в ящике и наличие, рядом — кнопка «Купить в 1 клик». Каталог фильтруется по цене и бренду, есть указатель брендов по алфавиту, сравнение, избранное, просмотренные товары, личный кабинет и страница контактов с картой.',
        'az' => 'tomobuv — Odessadan topdan ayaqqabı mağazasıdır: uşaq, yeniyetmə, kişi və qadın ayaqqabıları yeşiklərlə satılır. Rus dilindəki sayt ayaqqabını partiyalarla alan fərdi sahibkarlar və mağaza sahibləri üçün nəzərdə tutulub.

MGuliyev Studio saytı açar təhvil hazırlayıb: kataloqun strukturu və dizayndan proqramlaşdırma və işə salınmaya qədər. Hazırlanma zamanı SEO da tənzimlənib. Məhsul kartında bir cütün və bir yeşiyin qiyməti, yeşikdəki cütlərin sayı və mövcudluq görünür, yanında — «Купить в 1 клик» («1 kliklə al») düyməsi. Kataloq qiymətə və brendə görə filtrlənir; brendlərin əlifba üzrə göstəricisi, müqayisə, seçilmişlər, baxılmış məhsullar, şəxsi kabinet və xəritəli əlaqə səhifəsi var.',
        'en' => 'tomobuv is a wholesale shoe store from Odesa: children’s, teen, men’s and women’s shoes are sold by the box. The Russian-language site is aimed at individual entrepreneurs and store owners who buy shoes in bulk.

MGuliyev Studio built the site on a turnkey basis: from the catalogue structure and design to development and launch. SEO was set up during development as well. The product page shows the price per pair and per box, the number of pairs in a box and availability, with a “Buy in 1 click” button next to them. The catalogue can be filtered by price and brand, and there is an alphabetical brand index, comparison, favourites, recently viewed products, a user account and a contacts page with a map.',
    ],
    'mozahome.com' => [
        'ru' => 'MozaHome — магазин товаров для дома в Австрии. Сейчас на главной странице mozahome.com представлены ковры разных стилей, кровати и матрасы, «умная» мебель и аксессуары для дома, а в подвале указан адрес магазина и склада в Вене.

Сайт студия сделала под ключ: структура, дизайн, разработка, настройка SEO и запуск. В текущей версии есть каталог ковров по стилям и подбор по размеру, корзина, избранное и личный кабинет, раздел для B2B-партнёров, блог, страницы с FAQ и условиями возврата. Сайт работает на английском и немецком, цены указаны в евро.',
        'az' => 'MozaHome — Avstriyada ev üçün mallar mağazasıdır. Hazırda mozahome.com saytının ana səhifəsində müxtəlif üslublarda xalçalar, çarpayılar və döşəklər, «ağıllı» mebel və ev aksesuarları təqdim olunub, saytın aşağı hissəsində isə Vyanadakı mağazanın və anbarın ünvanı göstərilib.

Studiya saytı açar təhvil hazırlayıb: struktur, dizayn, proqramlaşdırma, SEO ayarları və işə salınma. Hazırkı versiyada üslublar üzrə xalça kataloqu və ölçüyə görə seçim, səbət, seçilmişlər və şəxsi kabinet, B2B tərəfdaşlar üçün bölmə, bloq, FAQ və geri qaytarma şərtləri səhifələri var. Sayt ingilis və alman dillərində işləyir, qiymətlər avro ilə göstərilib.',
        'en' => 'MozaHome is a home goods store in Austria. The mozahome.com home page currently features rugs in various styles, beds and mattresses, “smart” furniture and home accessories, and the footer gives the address of the store and warehouse in Vienna.

The studio built the site on a turnkey basis: structure, design, development, SEO setup and launch. The current version has a catalogue of rugs by style with selection by size, a cart, favourites and a user account, a section for B2B partners, a blog, and pages with an FAQ and the returns policy. The site is in English and German, with prices in euros.',
    ],
    'mattress.hu' => [
        'ru' => 'mattress.hu — продажа матрасов и постельных принадлежностей в Будапеште. На текущей главной странице — матрасы с независимыми пружинами и из пены, подушки, одеяла и текстиль для ванной.

Проект сделан под ключ: от структуры и дизайна до разработки и запуска. При разработке было настроено и SEO. Сейчас на сайте есть переключатель языков (венгерский и английский), быстрый подбор матраса по размеру кровати — от 90×200 до 180×200 см, корзина, избранное, личный кабинет, страница с формой заявки для партнёров и цены в форинтах.',
        'az' => 'mattress.hu — Budapeştdə döşəklərin və yataq ləvazimatlarının satışı. Hazırkı ana səhifədə — müstəqil yaylı və köpük döşəklər, yastıqlar, yorğanlar və vanna otağı üçün tekstil.

Layihə açar təhvil hazırlanıb: strukturdan və dizayndan proqramlaşdırma və işə salınmaya qədər. Hazırlanma zamanı SEO da tənzimlənib. Hazırda saytda dil dəyişdiricisi (macar və ingilis dilləri), çarpayının ölçüsünə görə döşəyin sürətli seçimi — 90×200-dən 180×200 sm-ə qədər, səbət, seçilmişlər, şəxsi kabinet, tərəfdaşlar üçün müraciət forması olan səhifə və forintlə qiymətlər var.',
        'en' => 'mattress.hu sells mattresses and bedding in Budapest. The current home page features pocket spring and foam mattresses, pillows, duvets and bathroom textiles.

The project was built on a turnkey basis: from structure and design to development and launch. SEO was set up during development as well. The site now has a language switcher (Hungarian and English), a quick mattress finder by bed size, from 90×200 to 180×200 cm, a cart, favourites, a user account, a page with an application form for partners, and prices in forints.',
    ],
    'sleepandbed.hu' => [
        'ru' => 'Sleep & Bed — продавец матрасов и постельных принадлежностей в Будапеште: матрасы, наматрасники, защитные чехлы, подушки, одеяла и детские одеяла. Сайт на английском языке знакомит с брендом и ведёт покупателя в каталог.

Сайт сделан под ключ: структура, дизайн, разработка, запуск. При разработке было настроено и SEO. Каталог разбит на шесть категорий, товары фильтруются по цене, высоте матраса и размеру, вид сетки и число товаров на странице переключаются. Есть корзина, личный кабинет, страница «О нас» с текстом о компании и видео, контакты с формой и reCAPTCHA, ссылки на соцсети и статьи блога в подвале.',
        'az' => 'Sleep & Bed — Budapeştdə döşək və yataq ləvazimatları satıcısıdır: döşəklər, döşəküstülər, qoruyucu üzlüklər, yastıqlar, yorğanlar və uşaq yorğanları. İngilis dilindəki sayt brendi təqdim edir və alıcını kataloqa yönləndirir.

Sayt açar təhvil hazırlanıb: struktur, dizayn, proqramlaşdırma, SEO ayarları, işə salınma. Kataloq altı kateqoriyaya bölünüb, məhsullar qiymətə, döşəyin hündürlüyünə və ölçüyə görə filtrlənir, şəbəkə görünüşünü və səhifədəki məhsulların sayını dəyişmək olur. Səbət, şəxsi kabinet, şirkət haqqında mətn və video olan «Haqqımızda» səhifəsi, forma və reCAPTCHA ilə əlaqə səhifəsi, saytın aşağı hissəsində isə sosial şəbəkələrə keçidlər və bloq məqalələri var.',
        'en' => 'Sleep & Bed sells mattresses and bedding in Budapest: mattresses, mattress toppers, protective covers, pillows, duvets and children’s duvets. The English-language site introduces the brand and leads shoppers to the catalogue.

The site was built on a turnkey basis: structure, design, development, launch. SEO was set up during development as well. The catalogue is divided into six categories; products can be filtered by price, mattress height and size, and the grid view and the number of products per page can be switched. There is a cart, a user account, an “About us” page with text about the company and a video, contacts with a form and reCAPTCHA, and social media links and blog posts in the footer.',
    ],
    'ymkwatercolor.com' => [
        'ru' => 'YMK Watercolor пишет акварельные портреты по фотографиям: людей, пар, семей, детей и питомцев, а также домов, машин, лодок и мотоциклов. Сайт на английском языке устроен как магазин: каталог портретов с ценами в долларах, корзина и избранное.

Студия сделала сайт под ключ — структура, дизайн, разработка, настройка SEO и запуск. В магазине — категории портретов, фильтр по цене и дополнительные услуги: добавить человека, рамка и улучшенная рамка. Есть страница отзывов с фото готовых работ, «О нас» с художниками и командой, контакты с формой и часами работы, онлайн-чат и логотипы платёжных систем в подвале.',
        'az' => 'YMK Watercolor fotoşəkillər əsasında akvarel portretlər çəkir: insanlar, cütlüklər, ailələr, uşaqlar və ev heyvanları, eləcə də evlər, avtomobillər, qayıqlar və motosikletlər. İngilis dilindəki sayt mağaza kimi qurulub: qiymətləri dollarla göstərilən portret kataloqu, səbət və seçilmişlər.

Studiya saytı açar təhvil hazırlayıb — struktur, dizayn, proqramlaşdırma, SEO ayarları və işə salınma. Mağazada — portret kateqoriyaları, qiymət filtri və əlavə xidmətlər: insan əlavə etmək, çərçivə və təkmilləşdirilmiş çərçivə. Hazır işlərin fotoları ilə rəylər səhifəsi, rəssamlar və komanda haqqında «Haqqımızda» səhifəsi, forma və iş saatları olan əlaqə səhifəsi, onlayn çat və saytın aşağı hissəsində ödəniş sistemlərinin loqoları var.',
        'en' => 'YMK Watercolor paints watercolour portraits from photos: of people, couples, families, children and pets, as well as houses, cars, boats and motorcycles. The English-language site works as a store: a catalogue of portraits with prices in dollars, a cart and favourites.

The studio built the site on a turnkey basis: structure, design, development, SEO setup and launch. The store has portrait categories, a price filter and add-on services: adding a person, a frame and an upgraded frame. There is a reviews page with photos of finished work, an “About us” page with the artists and the team, contacts with a form and opening hours, an online chat and payment system logos in the footer.',
    ],
    'dutyfreegroup.az' => [
        'ru' => 'dutyfreegroup.az — сайт компании из сферы duty free, то есть торговли беспошлинными товарами. Проект относится к разделу «Магазины и торговля» портфолио студии.

Студия сделала этот сайт под ключ: структура, дизайн, разработка, настройка SEO и запуск. Сайт сейчас не открывается, поэтому ссылки на него нет. Работа была сделана, и проект остаётся в портфолио.',
        'az' => 'dutyfreegroup.az — duty free, yəni rüsumsuz malların ticarəti sahəsində fəaliyyət göstərən şirkətin saytıdır. Layihə studiyanın portfoliosunun «Mağazalar və ticarət» bölməsinə aiddir.

Studiya bu saytı açar təhvil hazırlayıb: struktur, dizayn, proqramlaşdırma, SEO ayarları və işə salınma. Sayt hazırda açılmır, ona görə də ona keçid verilmir. İş görülüb və layihə portfolioda qalır.',
        'en' => 'dutyfreegroup.az is the website of a company in the duty free business, that is, the sale of duty-free goods. The project belongs to the “Stores and retail” section of the studio’s portfolio.

The studio built this site on a turnkey basis: structure, design, development, SEO setup and launch. The site is currently not opening, so there is no link to it. The work was done, and the project remains in the portfolio.',
    ],
    'lynkco.az' => [
        'ru' => 'lynkco.az — сайт официального дистрибьютора Lynk & Co в Азербайджане. Он знакомит покупателей с моделями бренда и собирает заявки на тест-драйв. Сайт оформлен в тёмной гамме, с крупными фотографиями машин.

Сайт сделан под ключ: структура, дизайн, разработка, настройка SEO и запуск. На главной стоят слайдеры с моделями 03 и 01 и кнопка тест-драйва. Страница Lynk & Co 03 рассказывает о машине по блокам: задние фонари, выбор цвета кузова, интерьер с точками-подсказками, система помощи водителю. На странице тест-драйва покупатель выбирает модель 01, 03 или 05 и заполняет форму с reCAPTCHA. Есть мобильная версия.',
        'az' => 'lynkco.az — Lynk & Co-nun Azərbaycandakı rəsmi distribyutorunun saytıdır. Sayt alıcıları brendin modelləri ilə tanış edir və sınaq yürüşü üçün müraciətləri toplayır. Sayt tünd rənglərdə, avtomobillərin iri fotoşəkilləri ilə tərtib olunub.

Sayt açar təhvil hazırlanıb: struktur, dizayn, proqramlaşdırma, SEO ayarları və işə salınma. Ana səhifədə 03 və 01 modelləri ilə slayderlər və sınaq yürüşü düyməsi yerləşir. Lynk & Co 03 səhifəsi avtomobili bloklar üzrə təqdim edir: arxa işıqlar, kuzov rənginin seçimi, izah nöqtələri olan interyer, sürücüyə yardım sistemi. Sınaq yürüşü səhifəsində alıcı 01, 03 və ya 05 modelini seçir və reCAPTCHA olan formu doldurur. Mobil versiya var.',
        'en' => 'lynkco.az is the website of the official Lynk & Co distributor in Azerbaijan. It introduces buyers to the brand\'s models and collects test drive requests. The site uses a dark color scheme, with large photos of the cars.

The site was built turnkey: structure, design, development, SEO setup and launch. The home page has sliders with the 03 and 01 models and a test drive button. The Lynk & Co 03 page presents the car block by block: the taillights, the body color picker, the interior with hint hotspots, and the driver assistance system. On the test drive page, the buyer chooses the 01, 03 or 05 model and fills out a form with reCAPTCHA. There is a mobile version.',
    ],
    'grandmoto.az' => [
        'ru' => 'GrandMoto — дистрибьютор мотоциклов в Баку. На сайте grandmoto.az покупатель выбирает мотоцикл или квадроцикл по бренду, подбирает шлем и экипировку и находит отдельные телефоны отдела продаж, отдела запчастей и сервисного центра.

Студия сделала сайт под ключ — от структуры и дизайна до разработки и запуска. При разработке было настроено и SEO. Сейчас в меню есть разделы «Мотоциклы», «ATV & UTV», «Бренды», «Сервисный центр» и «Продукция». В «Продукции» собраны шлемы, одежда и аксессуары с ценами в манатах; есть корзина, избранное и личный кабинет. На главной стоит слайдер, в шапке — поиск и переключатель языков AZ/EN.',
        'az' => 'GrandMoto — Bakıda motosiklet distribyutorudur. grandmoto.az saytında alıcı brendə görə motosiklet və ya kvadrosikl seçir, özünə uyğun dəbilqə və ekipirovka tapır, satış şöbəsinin, ehtiyat hissələri şöbəsinin və servis mərkəzinin ayrıca telefon nömrələrini də burada tapır.

Studiya saytı açar təhvil hazırlayıb — strukturdan və dizayndan proqramlaşdırma və işə salınmaya qədər. Hazırlanma zamanı SEO da tənzimlənib. Hazırda menyuda «Motorcycle», «ATV & UTV», «Brendlər», «Servis mərkəzi» və «Məhsullar» bölmələri var. «Məhsullar» bölməsində qiymətləri manatla göstərilən dəbilqələr, geyim və aksesuarlar toplanıb; səbət, istək siyahısı və şəxsi kabinet var. Ana səhifədə slayder, saytın başlığında isə axtarış və AZ/EN dil dəyişdiricisi yerləşir.',
        'en' => 'GrandMoto is a motorcycle distributor in Baku. On grandmoto.az, a buyer chooses a motorcycle or an ATV by brand, picks a helmet and riding gear, and finds separate phone numbers for the sales department, the parts department and the service center.

The studio built the site turnkey, from structure and design to development and launch. SEO was set up during development as well. The menu now has the sections “Motorcycles”, “ATV & UTV”, “Brands”, “Service Center” and “Products”. “Products” brings together helmets, clothing and accessories with prices in manats; there is a cart, favorites and a personal account. The home page has a slider, and the header has search and an AZ/EN language switcher.',
    ],
    'bestsol.az' => [
        'ru' => 'BestSol Group продаёт в Азербайджане запчасти и фильтры для спецтехники и грузовиков: зубья ковшей, адаптеры, пальцы, ножи бульдозера, детали для конвейерных линий. Сайт bestsol.az работает как каталог: клиент находит нужную деталь и отправляет запрос.

Сайт сделан под ключ, от структуры и дизайна до разработки и запуска. При разработке было настроено и SEO. В каталоге четыре раздела. В карточке товара есть галерея фото, OEM-номер, совместимые пальцы и адаптеры, кнопка «Отправить запрос» и кнопки «Поделиться». Корзины нет: покупатель пишет запрос по конкретной детали. Отдельно сделаны раздел «Направления деятельности» и страницы «Бренды» (CAT, IVECO, Volvo, HOWO) и «Партнёры». Контакты стоят в подвале, есть мобильная версия.',
        'az' => 'BestSol Group Azərbaycanda xüsusi texnika və yük maşınları üçün ehtiyat hissələri və filtrlər satır: kova dişləri, adapterlər, bağlantı pimləri, buldozer bıçaqları, konveyer xətləri üçün hissələr. bestsol.az saytı kataloq kimi işləyir: müştəri lazım olan hissəni tapır və sorğu göndərir.

Sayt açar təhvil hazırlanıb — strukturdan və dizayndan proqramlaşdırma və işə salınmaya qədər. Hazırlanma zamanı SEO da tənzimlənib. Kataloqda dörd bölmə var. Məhsul kartında foto qalereyası, OEM nömrəsi, uyğun gələn bağlantı pimləri və adapterlər, «Sorğu göndər» düyməsi və «Paylaş» düymələri var. Səbət yoxdur: alıcı konkret hissə üzrə sorğu yazır. Ayrıca «Fəaliyyət sahələri» bölməsi, həmçinin «Markalar» (CAT, IVECO, Volvo, HOWO) və «Partnyorlar» səhifələri hazırlanıb. Əlaqə məlumatları saytın alt hissəsində verilib, mobil versiya var.',
        'en' => 'BestSol Group sells parts and filters for heavy machinery and trucks in Azerbaijan: bucket teeth, adapters, pins, bulldozer cutting edges and parts for conveyor lines. The bestsol.az website works as a catalog: a customer finds the part they need and sends a request.

The site was built turnkey, from structure and design to development and launch. SEO was set up during development as well. The catalog has four sections. The product page has a photo gallery, the OEM number, compatible pins and adapters, a “Send request” button and “Share” buttons. There is no cart: the buyer sends a request for a specific part. There is also a separate “Areas of activity” section, plus “Brands” (CAT, IVECO, Volvo, HOWO) and “Partners” pages. The contacts are in the footer, and there is a mobile version.',
    ],
    'avtoehtiyat.com' => [
        'ru' => 'avtoehtiyat.com — площадка объявлений о продаже автозапчастей, в контактах указан Баку. Продают на ней частные лица и магазины. Покупатель ищет деталь сам или оставляет заявку, которую получают зарегистрированные магазины.

Проект сделан под ключ: структура, дизайн, разработка, запуск. При разработке было настроено и SEO. Сейчас на сайте есть поиск с фильтрами по марке, модели и состоянию (новое или б/у). Объявления разбиты на разделы: запчасти, масла и жидкости, шины и диски, аккумуляторы, авто на разбор. Есть каталог магазинов, избранное и кнопка «Разместить объявление». Зарегистрироваться можно как частное лицо или как магазин, а в форме заказа детали можно указать VIN.',
        'az' => 'avtoehtiyat.com — avtomobil ehtiyat hissələrinin satışı üzrə elan platformasıdır, əlaqə məlumatlarında Bakı göstərilib. Burada fərdi şəxslər və mağazalar satış edir. Alıcı hissəni özü axtarır və ya müraciət göndərir, bu müraciəti qeydiyyatdan keçmiş mağazalar alır.

Layihə açar təhvil hazırlanıb: struktur, dizayn, proqramlaşdırma, SEO ayarları, işə salınma. Hazırda saytda marka, model və vəziyyətə (yeni və ya işlənmiş) görə filtrləri olan axtarış var. Elanlar bölmələrə ayrılıb: ehtiyat hissələri, yağ və mayelər, təkər və disklər, akkumulyatorlar, sökülən avtomobillər. Mağazalar kataloqu, seçilmişlər və «Elan yerləşdir» düyməsi var. Fərdi şəxs və ya mağaza kimi qeydiyyatdan keçmək olar, hissə sifarişi formasında isə VIN-i göstərmək mümkündür.',
        'en' => 'avtoehtiyat.com is a classifieds platform for selling auto parts; Baku is listed in its contacts. Both private individuals and stores sell on it. A buyer searches for a part on their own or leaves a request that goes to registered stores.

The project was built turnkey: structure, design, development, launch. SEO was set up during development as well. The site now has search with filters by make, model and condition (new or used). Listings are divided into sections: parts, oils and fluids, tires and wheels, batteries, cars for parts. There is a catalog of stores, favorites and a “Post an ad” button. You can sign up as a private individual or as a store, and the part order form lets you enter a VIN.',
    ],
    'avtoklub.com' => [
        'ru' => 'Avtoklub — сеть автосервисов в Азербайджане. Главная услуга — замена масла. Кроме неё сервис меняет технические жидкости, ремонтирует трансмиссию, делает диагностику, обслуживает кондиционеры и аккумуляторы.

Сайт разработан под ключ: структура, дизайн, разработка, настройка SEO и запуск. В меню есть разделы «Услуги», «Филиалы», «Сертификаты» и «Контакты», а также онлайн-запись на обслуживание и личный кабинет клиента. Сайт на азербайджанском языке.',
        'az' => 'Avtoklub — Azərbaycanda avtoservislər şəbəkəsidir. Əsas xidmət yağ dəyişməsidir. Bundan əlavə servis texniki mayeləri dəyişir, transmissiyanı təmir edir, diaqnostika aparır, kondisionerlərə və akkumulyatorlara xidmət göstərir.

Sayt açar təhvil hazırlanıb: struktur, dizayn, proqramlaşdırma, SEO ayarları və işə salınma. Menyuda «Xidmətlər», «Filiallar», «Sertifikatlar» və «Əlaqə» bölmələri, həmçinin xidmətə onlayn rezervasiya və müştərinin şəxsi kabineti var. Sayt Azərbaycan dilindədir.',
        'en' => 'Avtoklub is a chain of auto service centers in Azerbaijan. Its main service is oil changes. Besides that, it changes vehicle fluids, repairs transmissions, runs diagnostics, and services air conditioners and batteries.

The site was built turnkey: structure, design, development, SEO setup and launch. The menu has the sections “Services”, “Branches”, “Certificates” and “Contacts”, plus online booking for service and a customer account. The site is in Azerbaijani.',
    ],
    'carclub.az' => [
        'ru' => 'Carclub — прокат автомобилей в Баку: седаны, внедорожники и минивэны. Сайт carclub.az помогает выбрать машину и связаться с компанией по телефону, в WhatsApp или через форму заявки.

Проект сделан под ключ: структура, дизайн, разработка, настройка SEO и запуск. В каталоге у каждой машины указаны тип кузова, марка, модель, год, объём двигателя, коробка передач и тип топлива. В карточке есть кнопка «Подробнее» и ссылка на WhatsApp. На главной показаны преимущества компании и форма заявки. Сайт работает на четырёх языках: русском, азербайджанском, английском и арабском.',
        'az' => 'Carclub — Bakıda avtomobil icarəsi: sedanlar, yolsuzluq avtomobilləri və minivenlər. carclub.az saytı avtomobil seçməyə və şirkətlə telefonla, WhatsApp-da və ya müraciət forması vasitəsilə əlaqə saxlamağa kömək edir.

Layihə açar təhvil hazırlanıb: struktur, dizayn, proqramlaşdırma, SEO ayarları və işə salınma. Kataloqda hər avtomobil üçün kuzov tipi, marka, model, il, mühərrikin həcmi, sürətlər qutusu və yanacaq növü göstərilib. Avtomobilin kartında «Daha ətraflı» düyməsi və WhatsApp linki var. Ana səhifədə şirkətin üstünlükləri və müraciət forması yerləşir. Sayt dörd dildə işləyir: rus, Azərbaycan, ingilis və ərəb dillərində.',
        'en' => 'Carclub is a car rental company in Baku: sedans, SUVs and minivans. The carclub.az website helps you choose a car and contact the company by phone, on WhatsApp or through a request form.

The project was built turnkey: structure, design, development, SEO setup and launch. In the catalog, each car lists its body type, make, model, year, engine size, transmission and fuel type. The car card has a “More details” button and a WhatsApp link. The home page shows the company\'s advantages and a request form. The site works in four languages: Russian, Azerbaijani, English and Arabic.',
    ],
    'roveltrading.az' => [
        'ru' => 'Rovel Trading — азербайджанская компания международной группы Rovel Trading Company с офисом в Баку. Она продаёт аккумуляторы, масла и технические жидкости, шины, зарядные и тестовые устройства разных брендов.

Студия сделала сайт под ключ: структура, дизайн, разработка, запуск. При разработке было настроено и SEO. Сейчас в меню есть пункты «О компании», «Продукция», «Сферы деятельности», «Бренды» и «Контакты». В «Сферах деятельности» отдельно описано применение аккумуляторов, масел и шин, а также зарядные и тестовые устройства. На странице брендов собраны производители, с которыми работает компания. Сайт на азербайджанском языке.',
        'az' => 'Rovel Trading — beynəlxalq Rovel Trading Company qrupuna daxil olan, ofisi Bakıda yerləşən Azərbaycan şirkətidir. Şirkət müxtəlif brendlərin akkumulyatorlarını, yağlarını və texniki mayelərini, təkərlərini, şarj və test cihazlarını satır.

Studiya saytı açar təhvil hazırlayıb: struktur, dizayn, proqramlaşdırma, SEO ayarları, işə salınma. Hazırda menyuda «Haqqımızda», «Məhsullar», «Fəaliyyət sahələri», «Brendlər» və «Əlaqə» bəndləri var. «Fəaliyyət sahələri» bölməsində akkumulyatorların, yağların və təkərlərin istifadəsi, həmçinin şarj və test cihazları ayrıca təsvir olunub. Brendlər səhifəsində şirkətin əməkdaşlıq etdiyi istehsalçılar toplanıb. Sayt Azərbaycan dilindədir.',
        'en' => 'Rovel Trading is an Azerbaijani company within the international Rovel Trading Company group, with an office in Baku. It sells batteries, oils and technical fluids, tires, chargers and testers from various brands.

The studio built the site turnkey: structure, design, development, launch. SEO was set up during development as well. The menu now has the items “About the company”, “Products”, “Fields of activity”, “Brands” and “Contacts”. The “Fields of activity” section separately describes how batteries, oils and tires are used, as well as chargers and testers. The brands page brings together the manufacturers the company works with. The site is in Azerbaijani.',
    ],
    'arka.az' => [
        'ru' => 'ARKA İnşaat — строительная компания из Баку: проектирование, строительство и ремонт частных домов, квартир и коммерческих объектов, ландшафтные проекты. Сайт показывает заказчику направления работ и готовые объекты и даёт быстрый способ связаться.

Студия сделала сайт под ключ — структура, дизайн, разработка, настройка SEO и запуск. В меню — «О компании», «Портфолио» с разделами по типам объектов, «Услуги» и «Партнёры». Шесть услуг, от архитектурного проектирования до строительства бассейнов и мебельных работ, вынесены карточками на главную. На странице контактов — форма, адрес и карта. Есть кнопки WhatsApp и звонка и мобильная версия.',
        'az' => 'ARKA İnşaat — Bakıda fəaliyyət göstərən tikinti şirkətidir: fərdi evlərin, mənzillərin və ticarət obyektlərinin layihələndirilməsi, tikintisi və təmiri, landşaft layihələri. Sayt sifarişçiyə iş istiqamətlərini və hazır obyektləri göstərir, şirkətlə tez əlaqə saxlamağa imkan verir.

Studiya saytı açar təhvil yaradıb — struktur, dizayn, hazırlanma və işə salma. Hazırlanma zamanı SEO da tənzimlənib. Menyuda «Şirkət haqqında», obyekt növləri üzrə bölmələri olan «Portfolio», «Xidmətlər» və «Partnyorlar» var. Memarlıq layihələndirməsindən hovuz tikintisinə və mebel işlərinə qədər altı xidmət ana səhifədə kartlar şəklində təqdim olunub. Əlaqə səhifəsində forma, ünvan və xəritə var. Saytda WhatsApp və zəng düymələri, eləcə də mobil versiya mövcuddur.',
        'en' => 'ARKA İnşaat is a construction company from Baku: design, construction and renovation of private houses, apartments and commercial properties, plus landscape projects. The website shows clients the company’s areas of work and its completed projects and gives them a quick way to get in touch.

The studio built the website turnkey — structure, design, development, SEO setup and launch. The menu has “About the company”, “Portfolio” with sections by property type, “Services” and “Partners”. Six services, from architectural design to swimming pool construction and furniture work, are shown as cards on the home page. The contact page has a form, an address and a map. There are WhatsApp and call buttons and a mobile version.',
    ],
    'damchi.az' => [
        'ru' => 'damchi.az — сайт кровельной компании из Баку: фальцевая и черепичная кровля, облицовка фасадов. Компания также продаёт кровельные и фасадные материалы европейских производителей.

MGuliyev Studio сделала сайт под ключ — от структуры и дизайна до разработки и запуска. При разработке было настроено и SEO. Основная версия сайта на русском языке, есть переключение на азербайджанский и английский. В меню разделы «Материалы», «Галерея», «Видео» и «Контакты», отдельные страницы рассказывают о фальцевой и черепичной кровле, вентилируемом фасаде, дымниках, шпилях, водосточных системах и изоляции. На странице контактов — форма обратной связи, есть также WhatsApp и ссылки на соцсети.',
        'az' => 'damchi.az — Bakıdakı dam örtüyü şirkətinin saytıdır: fals və kirəmit dam örtüyü, fasadların üzlənməsi. Şirkət həmçinin Avropa istehsalçılarının dam örtüyü və fasad materiallarını satır.

MGuliyev Studio saytı açar təhvil yaradıb — strukturdan və dizayndan tutmuş hazırlanma və işə salmaya qədər. Hazırlanma zamanı SEO da tənzimlənib. Saytın əsas versiyası rus dilindədir, Azərbaycan və ingilis dillərinə keçid də var. Menyuda «Materiallar», «Qalereya», «Video» və «Əlaqə» bölmələri yer alır, ayrı-ayrı səhifələr fals və kirəmit dam örtüyündən, ventilyasiya olunan fasaddan, baca üstlərindən, şpillərdən, nov sistemlərindən və izolyasiyadan bəhs edir. Əlaqə səhifəsində əks əlaqə forması var, bundan başqa WhatsApp və sosial şəbəkələrə keçidlər də mövcuddur.',
        'en' => 'damchi.az is the website of a roofing company from Baku: standing seam and tile roofing and facade cladding. The company also sells roofing and facade materials from European manufacturers.

MGuliyev Studio built the website turnkey — from structure and design to development and launch. SEO was set up during development as well. The main version of the site is in Russian, and it can be switched to Azerbaijani and English. The menu has the “Materials”, “Gallery”, “Video” and “Contacts” sections, and separate pages cover standing seam and tile roofing, ventilated facades, chimney caps, spires, gutter systems and insulation. The contact page has a feedback form, and there is also WhatsApp and links to social media.',
    ],
    'agrosport.az' => [
        'ru' => 'AgroSport — бакинская компания в сфере спортивной инфраструктуры: натуральные покрытия для футбольных полей, их обслуживание, ландшафтный дизайн и экспертные консультации. Сайт рассказывает о компании клубам, федерациям и владельцам спортивных объектов.

Над сайтом студия работала под ключ: от структуры и дизайна до разработки и запуска. При разработке было настроено и SEO. В меню — «О нас», «Услуги» с подстраницами (обслуживание, натуральные покрытия, ландшафт, консультации), «Наши проекты» и «Контакты». На главной собраны блоки услуг и проектов, в подвале — телефон, почта и адрес в Баку. Основная версия сайта на английском, есть азербайджанская.',
        'az' => 'AgroSport — idman infrastrukturu sahəsində çalışan Bakı şirkətidir: futbol meydançaları üçün təbii örtüklər, onlara texniki qulluq, landşaft dizaynı və ekspert məsləhətləri. Sayt şirkəti klublara, federasiyalara və idman obyektlərinin sahiblərinə tanıdır.

Studiya sayt üzərində açar təhvil prinsipi ilə işləyib: strukturdan və dizayndan tutmuş hazırlanma və işə salmaya qədər. Hazırlanma zamanı SEO da tənzimlənib. Menyuda «Haqqımızda», alt səhifələri olan «Xidmətlər» (texniki qulluq, təbii örtüklər, landşaft, məsləhətlər), «Layihələrimiz» və «Əlaqə» var. Ana səhifədə xidmət və layihə blokları toplanıb, saytın alt hissəsində telefon, e-poçt və Bakıdakı ünvan göstərilib. Saytın əsas versiyası ingilis dilindədir, Azərbaycan versiyası da var.',
        'en' => 'AgroSport is a Baku company in sports infrastructure: natural surfaces for football fields and their maintenance, landscape design and expert consulting. The website introduces the company to clubs, federations and owners of sports facilities.

The studio worked on the website turnkey: from structure and design to development and launch. SEO was set up during development as well. The menu has “About us”, “Services” with subpages (maintenance, natural surfaces, landscape, consulting), “Our projects” and “Contact us”. The home page brings together blocks of services and projects, and the footer has a phone number, an email address and an address in Baku. The main version of the site is in English, and there is an Azerbaijani one.',
    ],
    'lifeonisland.com' => [
        'ru' => 'Life On Island — агентство недвижимости на Северном Кипре. Сайт знакомит покупателей с жилыми комплексами на острове и рассказывает о самом Северном Кипре: где он находится и почему там выбирают жильё.

MGuliyev Studio разработала сайт под ключ — структура, дизайн, разработка, запуск. При разработке было настроено и SEO. Есть каталог проектов с карточками жилых комплексов, страницы «О компании», «О Северном Кипре» с картой острова и «Наши услуги», контакты с адресом, кнопки соцсетей и WhatsApp, мобильная версия. Сейчас у сайта есть русская версия, а также азербайджанская, английская и турецкая.',
        'az' => 'Life On Island — Şimali Kiprdə daşınmaz əmlak agentliyidir. Sayt alıcıları adadakı yaşayış kompleksləri ilə tanış edir və Şimali Kiprin özü barədə danışır: onun harada yerləşdiyini və niyə orada mənzil seçdiklərini.

MGuliyev Studio saytı açar təhvil hazırlayıb — struktur, dizayn, hazırlanma, işə salma. Hazırlanma zamanı SEO da tənzimlənib. Saytda yaşayış komplekslərinin kartları ilə layihələr kataloqu, «Şirkət haqqında», adanın xəritəsi olan «Şimali Kipr haqqında» və «Xidmətlərimiz» səhifələri, ünvan göstərilən əlaqə səhifəsi, sosial şəbəkə və WhatsApp düymələri, mobil versiya var. Hazırda saytın rus versiyası, həmçinin Azərbaycan, ingilis və türk versiyaları mövcuddur.',
        'en' => 'Life On Island is a real estate agency in Northern Cyprus. The website introduces buyers to residential complexes on the island and tells them about Northern Cyprus itself: where it is and why people choose to buy a home there.

MGuliyev Studio developed the website turnkey — structure, design, development, launch. SEO was set up during development as well. There is a project catalog with cards for the residential complexes, the pages “About the company”, “About Northern Cyprus” with a map of the island and “Our services”, contacts with an address, social media and WhatsApp buttons, and a mobile version. The site currently has a Russian version, as well as Azerbaijani, English and Turkish ones.',
    ],
    'metalist.az' => [
        'ru' => 'Metalist работает с воротами и рольставнями, а также предлагает входные двери, перила, окна, шлагбаумы и изделия на заказ. Сайт задуман как каталог: посетитель выбирает тип ворот и переходит к нужной группе товаров.

Структуру каталога, дизайн, разработку и запуск взяла на себя студия — сайт сделан под ключ. При разработке было настроено и SEO. Ворота разбиты на пять групп, на главной есть выбор ворот и подборка товаров, сбоку — меню-иконки разделов и кнопка звонка. Отдельные страницы — «О нас», «Партнёры» и «Контакты» с картой, часами работы и кнопкой обратного звонка. Сейчас сайт не открывается, проект остаётся в портфолио.',
        'az' => 'Metalist darvazalar və roletlərlə işləyir, həmçinin giriş qapıları, məhəccərlər, pəncərələr, şlaqbaumlar və sifarişlə məmulatlar təklif edir. Sayt kataloq kimi düşünülüb: ziyarətçi darvaza növünü seçir və lazımi məhsul qrupuna keçir.

Kataloqun strukturunu, dizaynı, hazırlanmanı və işə salmanı studiya öz üzərinə götürüb — sayt açar təhvil hazırlanıb. Hazırlanma zamanı SEO da tənzimlənib. Darvazalar beş qrupa bölünüb, ana səhifədə darvaza seçimi və məhsul toplusu var, yan tərəfdə bölmələrin ikonlardan ibarət menyusu və zəng düyməsi yerləşir. Ayrıca səhifələr — «Haqqımızda», «Partnyorlar» və xəritə, iş saatları və geri zəng düyməsi olan «Əlaqə». Hazırda sayt açılmır, layihə portfolioda qalır.',
        'en' => 'Metalist works with gates and roller shutters and also offers entrance doors, railings, windows, boom barriers and custom-made products. The website is designed as a catalog: a visitor picks a type of gate and goes to the relevant product group.

The studio took on the catalog structure, design, development, SEO setup and launch — the website was built turnkey. Gates are split into five groups; the home page has a gate selector and a selection of products, and on the side there is an icon menu of sections and a call button. Separate pages are “About us”, “Partners” and “Contacts” with a map, opening hours and a callback button. The website does not open at the moment; the project stays in the portfolio.',
    ],
    'whitestone.com.az' => [
        'ru' => 'Whitestone — жилой комплекс, для которого MGuliyev Studio сделала сайт на домене whitestone.com.az. Другие работы для подрядчиков, инженерных компаний и агентства недвижимости собраны в разделе «Стройка и недвижимость».

Сайт разработан под ключ: структура, дизайн, разработка, настройка SEO и запуск. Сейчас сайт комплекса недоступен, но работа остаётся в портфолио студии.',
        'az' => 'Whitestone — yaşayış kompleksidir, MGuliyev Studio onun üçün whitestone.com.az domenində sayt hazırlayıb. Podratçılar, mühəndislik şirkətləri və daşınmaz əmlak agentliyi üçün digər işlər «Tikinti və daşınmaz əmlak» bölməsində toplanıb.

Sayt üzərində iş açar təhvil aparılıb: struktur, dizayn, hazırlanma və işə salma. Hazırlanma zamanı SEO da tənzimlənib. Kompleksin saytı hazırda əlçatan deyil, lakin iş studiyanın portfoliosunda qalır.',
        'en' => 'Whitestone is a residential complex for which MGuliyev Studio built a website on the domain whitestone.com.az. Other work for contractors, engineering companies and a real estate agency is collected in the “Construction and real estate” section.

The website was developed turnkey: structure, design, development, SEO setup and launch. The complex’s website is currently unavailable, but the work stays in the studio’s portfolio.',
    ],
    'tce.az' => [
        'ru' => 'Turan Construction and Engineering (TCE) — бакинская компания, которая ведёт проектирование и строительно-монтажные работы, поставляет оборудование и обслуживает объекты после сдачи.

Сайт создан под ключ — структура, дизайн, разработка, настройка SEO и запуск. На главной — карточки проектов, раздел «О компании», шесть причин работать с компанией, четыре направления услуг со ссылками на страницу услуг, логотипы партнёров и призыв обсудить проект. На странице контактов — форма заявки, карта, телефон, адрес в Баку и часы работы. Сайт на азербайджанском языке.',
        'az' => 'Turan Construction and Engineering (TCE) — layihələndirmə və tikinti-quraşdırma işləri aparan, avadanlıq təchiz edən və obyektlərə təhvildən sonra xidmət göstərən Bakı şirkətidir.

Sayt açar təhvil yaradılıb — struktur, dizayn, hazırlanma və işə salma. Hazırlanma zamanı SEO da tənzimlənib. Ana səhifədə layihə kartları, «Haqqımızda» bölməsi, şirkətlə işləmək üçün altı səbəb, xidmətlər səhifəsinə keçidləri olan dörd xidmət istiqaməti, partnyorların loqoları və layihəni müzakirə etməyə çağırış var. Əlaqə səhifəsində müraciət forması, xəritə, telefon, Bakıdakı ünvan və iş saatları yer alır. Sayt Azərbaycan dilindədir.',
        'en' => 'Turan Construction and Engineering (TCE) is a Baku company that carries out design, construction and installation work, supplies equipment and services facilities after handover.

The website was built turnkey — structure, design, development, SEO setup and launch. The home page has project cards, an “About the company” section, six reasons to work with the company, four service areas linking to the services page, partner logos and a call to discuss a project. The contact page has a request form, a map, a phone number, an address in Baku and opening hours. The website is in Azerbaijani.',
    ],
    'ceng.az' => [
        'ru' => 'Caspian Engineering Group (CENG) — бакинская компания в сфере инженерных систем и поставки оборудования. На сайте она также указывает проектирование, строительство и послепродажный сервис.

Студия выполнила работу под ключ: структура, дизайн, разработка, запуск. При разработке было настроено и SEO. На главной — слайдер, раздел «О компании», галерея, блок преимуществ со счётчиками, список проектов со ссылками на подробные страницы и логотипы партнёров. В подвале — телефон, адрес в Баку и ссылки на LinkedIn, Instagram и WhatsApp. Сайт на азербайджанском языке.',
        'az' => 'Caspian Engineering Group (CENG) — mühəndislik sistemləri və avadanlıq təchizatı sahəsində çalışan Bakı şirkətidir. Saytda şirkət həmçinin layihələndirməni, tikintini və satışdan sonrakı servisi qeyd edir.

Studiya işi açar təhvil yerinə yetirib: struktur, dizayn, hazırlanma, işə salma. Hazırlanma zamanı SEO da tənzimlənib. Ana səhifədə slayder, «Haqqımızda» bölməsi, qalereya, sayğaclı üstünlüklər bloku, ətraflı səhifələrə keçidləri olan layihələr siyahısı və partnyorların loqoları var. Saytın alt hissəsində telefon, Bakıdakı ünvan, həmçinin LinkedIn, Instagram və WhatsApp keçidləri yerləşir. Sayt Azərbaycan dilindədir.',
        'en' => 'Caspian Engineering Group (CENG) is a Baku company working in engineering systems and equipment supply. On its website it also lists design, construction and after-sales service.

The studio did the work turnkey: structure, design, development, launch. SEO was set up during development as well. The home page has a slider, an “About the company” section, a gallery, a block of advantages with counters, a list of projects linking to detailed pages, and partner logos. The footer has a phone number, an address in Baku and links to LinkedIn, Instagram and WhatsApp. The website is in Azerbaijani.',
    ],
    'arginterior.co.uk' => [
        'ru' => 'ARG Interior — столярная компания из Лондона: плотницкие и столярные работы, изделия по индивидуальным чертежам, монтаж кухонь, укладка деревянных полов, мебель на заказ. Компания работает с коммерческими, жилыми, гостиничными и медицинскими объектами в Лондоне и на юго-востоке Англии.

Сайт на английском языке сделан под ключ — от структуры и дизайна до разработки и запуска. При разработке было настроено и SEO. В меню — «Услуги» и «Секторы» с подстраницами, «Проекты», «О компании», «Контакты» и кнопка запроса цены. На главной — шесть направлений, примеры работ, четыре этапа работы с заказчиком и форма заявки с выбором сектора и бюджета.',
        'az' => 'ARG Interior — Londonda fəaliyyət göstərən xarratlıq şirkətidir: dülgərlik və xarratlıq işləri, fərdi çertyojlar əsasında məmulatlar, mətbəxlərin quraşdırılması, taxta döşəmələrin döşənməsi, sifarişlə mebel. Şirkət London və Cənub-Şərqi İngiltərədəki kommersiya, yaşayış, otel və tibbi obyektlərlə işləyir.

İngilisdilli sayt açar təhvil yaradılıb — strukturdan və dizayndan tutmuş hazırlanma və işə salmaya qədər. Hazırlanma zamanı SEO da tənzimlənib. Menyuda alt səhifələri olan «Xidmətlər» və «Sektorlar», «Layihələr», «Şirkət haqqında», «Əlaqə» və qiymət sorğusu düyməsi var. Ana səhifədə altı istiqamət, iş nümunələri, sifarişçi ilə işin dörd mərhələsi və sektoru və büdcəni seçmək imkanı olan müraciət forması yer alır.',
        'en' => 'ARG Interior is a joinery company from London: carpentry and joinery, items made to custom drawings, kitchen fitting, wood floor laying and custom furniture. The company works with commercial, residential, hotel and healthcare properties in London and the southeast of England.

The English-language website was built turnkey — from structure and design to development and launch. SEO was set up during development as well. The menu has “Services” and “Sectors” with subpages, “Projects”, “About”, “Contact” and a “Request a quote” button. The home page has six service areas, examples of work, four stages of working with a client and a request form with a choice of sector and budget.',
    ],
    'mybel.az' => [
        'ru' => 'MYBEL Concept — бакинская компания, которая проектирует и изготавливает мебель на заказ и делает интерьерные решения для отелей, ресторанов и частных домов.

Структура, дизайн, разработка, настройка SEO и запуск — сайт сделан под ключ. Есть русская, азербайджанская и английская версии. В меню — «О компании», «Проекты», «Услуги» и «Контакты». На главной — избранные проекты, десять услуг от дизайна мебели и 3D-визуализации до финальной сдачи и блок «Получите предложение для вашего проекта» с кнопкой заявки.',
        'az' => 'MYBEL Concept — sifarişlə mebel layihələndirən və istehsal edən, otellər, restoranlar və fərdi evlər üçün interyer həlləri hazırlayan Bakı şirkətidir.

Struktur, dizayn, hazırlanma və işə salma — sayt açar təhvil yaradılıb. Hazırlanma zamanı SEO da tənzimlənib. Saytın rus, Azərbaycan və ingilis versiyaları var. Menyuda «Şirkət haqqında», «Layihələr», «Xidmətlər» və «Əlaqə» yer alır. Ana səhifədə seçilmiş layihələr, mebel dizaynı və 3D vizualizasiyadan yekun təhvilə qədər on xidmət, həmçinin müraciət düyməsi olan «Layihəniz üçün təklif alın» bloku var.',
        'en' => 'MYBEL Concept is a Baku company that designs and makes custom furniture and creates interior solutions for hotels, restaurants and private homes.

Structure, design, development, SEO setup and launch — the website was built turnkey. There are Russian, Azerbaijani and English versions. The menu has “About”, “Projects”, “Services” and “Contact”. The home page shows featured projects, ten services from furniture design and 3D visualization to final handover, and a “Get a quote for your project” block with a request button.',
    ],
    'socarmidstream.az' => [
        'ru' => 'socarmidstream.az — корпоративный сайт SOCAR Midstream Operations. Компания занимается нефтетранспортной инфраструктурой Азербайджана, в том числе экспортными нефтепроводами и транзитом нефти. Сайт рассказывает о компании, её объектах, проектах и социальных инвестициях.

MGuliyev Studio разработала сайт под ключ: структура, дизайн, разработка, настройка SEO и запуск. Сейчас в меню сайта есть разделы «О нас», «Инфраструктура», «Операции и проекты», «Социальные инвестиции», «Карьера», «Медиа» и «Контакты». На главной странице — новости, поиск по сайту и переключатель языков EN/AZ.',
        'az' => 'socarmidstream.az — SOCAR Midstream Operations şirkətinin korporativ saytıdır. Şirkət Azərbaycanın neft nəqli infrastrukturu, o cümlədən ixrac neft kəmərləri və neftin tranziti ilə məşğul olur. Sayt şirkət, onun obyektləri, layihələri və sosial investisiyaları haqqında məlumat verir.

MGuliyev Studio saytı açar təhvil hazırlayıb: struktur, dizayn, hazırlanma və işə salma. Hazırlanma zamanı SEO da tənzimlənib. Hazırda sayt menyusunda «Haqqımızda», «İnfrastruktur», «Əməliyyatlar və layihələr», «Sosial investisiyalar», «Karyera», «Media» və «Əlaqə» bölmələri var. Ana səhifədə xəbərlər, sayt üzrə axtarış və EN/AZ dil dəyişdiricisi yerləşir.',
        'en' => 'socarmidstream.az is the corporate website of SOCAR Midstream Operations. The company works with Azerbaijan\'s oil transportation infrastructure, including export oil pipelines and oil transit. The site tells visitors about the company, its facilities, projects and social investments.

MGuliyev Studio developed the site turnkey: structure, design, development, SEO setup and launch. The site menu currently has “About us”, “Infrastructure”, “Operations and projects”, “Social investments”, “Careers”, “Media” and “Contact” sections. The home page features news, site search and an EN/AZ language switcher.',
    ],
    'elson-group.com' => [
        'ru' => 'ELSON Group — агрохолдинг из Баку. Компания выпускает мясную продукцию и субпродукты, обрабатывает кожу и делает корм для собак, а продаёт всё это и в Азербайджане, и на экспорт. Сайт представляет четыре бренда — Brotein, Chewtopia, ElsonFarm и Bakuleather — и ведёт покупателя к каталогу и контактам.

Студия сделала сайт под ключ, от структуры и дизайна до разработки и запуска. При разработке было настроено и SEO. Есть страницы «О компании», «Бренды», «Производство» и «Экспорт». Каталог разделён на мясную продукцию и обработку кожи, в нём есть сортировка и постраничный вывод, а в шапке — поиск по товарам и выбор языка. На странице контактов — карта, форма запроса и кнопка WhatsApp.',
        'az' => 'ELSON Group — Bakıda yerləşən aqroholdinqdir. Şirkət ət məhsulları və subməhsullar istehsal edir, dəri emal edir və itlər üçün yem hazırlayır, bütün bunları isə həm Azərbaycanda satır, həm də ixrac edir. Sayt dörd brendi — Brotein, Chewtopia, ElsonFarm və Bakuleather — təqdim edir və alıcını kataloqa və əlaqə məlumatlarına yönləndirir.

Studiya saytı açar təhvil hazırlayıb — strukturdan və dizayndan tutmuş hazırlanma və işə salmaya qədər. Hazırlanma zamanı SEO da tənzimlənib. Saytda «Şirkət haqqında», «Brendlər», «İstehsal» və «İxrac» səhifələri var. Kataloq ət məhsulları və dəri emalı bölmələrinə ayrılıb, burada sıralama və səhifələmə var, yuxarı hissədə isə məhsullar üzrə axtarış və dil seçimi yerləşir. Əlaqə səhifəsində xəritə, sorğu forması və WhatsApp düyməsi var.',
        'en' => 'ELSON Group is an agricultural holding from Baku. The company produces meat products and offal, processes leather and makes dog food, and sells all of it both in Azerbaijan and for export. The site presents four brands — Brotein, Chewtopia, ElsonFarm and Bakuleather — and guides buyers to the catalog and contact details.

The studio built the site turnkey, from structure and design to development and launch. SEO was set up during development as well. There are “About the company”, “Brands”, “Production” and “Export” pages. The catalog is split into meat products and leather processing, with sorting and pagination, and the header has product search and a language selector. The contact page has a map, a request form and a WhatsApp button.',
    ],
    'marsoverseas.az' => [
        'ru' => 'Mars Overseas — азербайджанская компания, которая производит и продаёт соки, газированные и негазированные напитки. Сайт рассказывает о компании и её брендах, а ещё помогает набирать сотрудников.

Сайт сделан под ключ: структуру, дизайн, разработку, настройку SEO и запуск взяла на себя MGuliyev Studio. На главной — баннер с акцией, блок о компании, приглашение в команду и логотипы брендов. Раздел «Бренды» сгруппирован по типам: газированные напитки, соки, холодный чай, вода. У брендов есть свои страницы, например у Sandora. Есть страницы «О компании», «Карьера» с блоком активных вакансий и «Контакты» с отдельными телефонами для продаж и общих вопросов, а также переключатель языка. Сайт адаптирован под смартфоны.',
        'az' => 'Mars Overseas — şirələr, qazlı və qazsız içkilər istehsal edən və satan Azərbaycan şirkətidir. Sayt şirkət və onun brendləri haqqında məlumat verir, həmçinin kadr cəlbinə kömək edir.

Sayt açar təhvil yaradılıb: strukturu, dizaynı, hazırlanmanı və işə salmanı MGuliyev Studio öz üzərinə götürüb. Hazırlanma zamanı SEO da tənzimlənib. Ana səhifədə kampaniya banneri, şirkət haqqında blok, komandaya dəvət və brendlərin loqotipləri var. «Brendlər» bölməsi növlər üzrə qruplaşdırılıb: qazlı içkilər, şirələr, soyuq çay, su. Brendlərin öz səhifələri var, məsələn, Sandora-nın. Həmçinin «Şirkət haqqında», aktiv vakansiyalar bloku olan «Karyera» və satış və ümumi suallar üçün ayrıca telefon nömrələri olan «Əlaqə» səhifələri, eləcə də dil dəyişdiricisi var. Sayt smartfonlar üçün adaptivdir.',
        'en' => 'Mars Overseas is an Azerbaijani company that produces and sells juices and carbonated and non-carbonated drinks. The site tells visitors about the company and its brands, and also helps it recruit staff.

The site was built turnkey: MGuliyev Studio took on the structure, design, development, SEO setup and launch. The home page has a promotional banner, a section about the company, an invitation to join the team and brand logos. The “Brands” section is grouped by type: carbonated drinks, juices, iced tea and water. Brands have their own pages, Sandora for example. There are “About the company” and “Careers” pages, the latter with a block of open vacancies, a “Contact” page with separate phone numbers for sales and general questions, and a language switcher. The site is adapted for smartphones.',
    ],
    'armada.az' => [
        'ru' => 'Armada — компания из Баку, которая поставляет оборудование и материалы для стоматологов и зубных техников. Сайт работает как магазин и одновременно рассказывает о компании: о стоматологической академии, техническом сервисе и вакансиях.

MGuliyev Studio разработала сайт под ключ: структура, дизайн, разработка, настройка SEO и запуск. В каталоге четыре раздела — «Клиника», «Лабораторные принадлежности», «Хирургия» и «Мебель». На главной — новинки и товары со скидкой: цены в манатах, выбор количества и кнопка «В корзину». В шапке — поиск, личный кабинет, избранное, корзина и выбор языка. Есть страницы «О компании», «Бренды», «Академия» с фотогалереей, «Технический сервис», «Вакансии» и контакты с картой и формой обращения.',
        'az' => 'Armada — stomatoloqlar və diş texnikləri üçün avadanlıq və materiallar tədarük edən Bakı şirkətidir. Sayt mağaza kimi işləyir və eyni zamanda şirkət, onun stomatologiya akademiyası, texniki servisi və vakansiyaları barədə məlumat verir.

MGuliyev Studio saytı açar təhvil hazırlayıb: struktur, dizayn, hazırlanma və işə salma. Hazırlanma zamanı SEO da tənzimlənib. Kataloqda dörd bölmə var — «Klinika», «Laboratoriya ləvazimatları», «Cərrahiyyə» və «Mebel». Ana səhifədə yeni məhsullar və endirimli mallar göstərilir: qiymətlər manatla, miqdar seçimi və «Səbətə» düyməsi. Yuxarı hissədə axtarış, şəxsi kabinet, seçilmişlər, səbət və dil seçimi yerləşir. Saytda «Şirkət haqqında», «Brendlər», foto qalereyalı «Akademiya», «Texniki servis», «Vakansiyalar» səhifələri, həmçinin xəritə və müraciət forması olan əlaqə səhifəsi var.',
        'en' => 'Armada is a Baku company that supplies equipment and materials for dentists and dental technicians. The site works as an online store and at the same time tells visitors about the company: its dental academy, technical service and vacancies.

MGuliyev Studio developed the site turnkey: structure, design, development, SEO setup and launch. The catalog has four sections: “Clinic”, “Laboratory supplies”, “Surgery” and “Furniture”. The home page shows new arrivals and discounted products, with prices in manats, a quantity selector and an “Add to cart” button. The header has search, a personal account, favorites, a cart and a language selector. There are “About the company”, “Brands”, “Academy” (with a photo gallery), “Technical service” and “Vacancies” pages, plus a contact page with a map and an inquiry form.',
    ],
    'argflex.co.uk' => [
        'ru' => 'Arg Flex Ltd — компания из Лондона, которая продаёт резиновые и пластиковые изделия: шланги для воды, топлива, масла и газов, а также хомуты к ним. Сайт на английском языке нужен, чтобы покупатель нашёл нужный шланг, увидел цену и отправил запрос.

Студия из Баку сделала этот сайт под ключ — от структуры и дизайна до запуска. При разработке было настроено и SEO. В магазине три группы товаров: хомуты, шланги из ПВХ и полиуретана, резиновые шланги. У части позиций есть варианты и цены в фунтах без НДС. В шапке — корзина, кнопка «Send Request», поиск, телефон, почта и адрес. На странице контактов — часы работы, форма с reCAPTCHA и карта Google; есть раздел «О компании».',
        'az' => 'Arg Flex Ltd — rezin və plastik məmulatlar satan London şirkətidir: su, yanacaq, yağ və qazlar üçün şlanqlar, həmçinin onlar üçün xamutlar. İngilisdilli sayt alıcının lazım olan şlanqı tapması, qiymətini görməsi və sorğu göndərməsi üçün nəzərdə tutulub.

Bakıdakı studiya bu saytı açar təhvil hazırlayıb — strukturdan və dizayndan işə salmaya qədər. Hazırlanma zamanı SEO da tənzimlənib. Mağazada üç məhsul qrupu var: xamutlar, PVC və poliuretan şlanqlar, rezin şlanqlar. Mövqelərin bir qismində variantlar və funtla ƏDV-siz qiymətlər göstərilir. Yuxarı hissədə səbət, «Send Request» düyməsi, axtarış, telefon, e-poçt və ünvan yerləşir. Əlaqə səhifəsində iş saatları, reCAPTCHA ilə qorunan forma və Google xəritəsi var; «Şirkət haqqında» bölməsi də mövcuddur.',
        'en' => 'Arg Flex Ltd is a London company that sells rubber and plastic products: hoses for water, fuel, oil and gases, as well as clamps for them. The English-language site is there so that a buyer can find the right hose, see the price and send a request.

The Baku studio built this site turnkey — from structure and design to launch. SEO was set up during development as well. The store has three product groups: clamps, PVC and polyurethane hoses, and rubber hoses. Some items have variants and prices in pounds excluding VAT. The header has a cart, a “Send Request” button, search, a phone number, email and address. The contact page has opening hours, a form with reCAPTCHA and a Google map; there is also an “About the company” section.',
    ],
    'amec.az' => [
        'ru' => 'Azerbaijan Marine and Engineering Consultants (AMEC) — компания из Баку, которая консультирует морскую и офшорную отрасль: проводит инспекции и техническую экспертизу, оказывает инженерные услуги. Сайт на английском языке показывает заказчикам услуги, продукты и выполненные проекты.

Под ключ, то есть со структурой, дизайном, разработкой, настройкой SEO и запуском, сайт сделала MGuliyev Studio. На главной — блок «О нас», услуги (например, marine warranty surveys) и карточки продуктов. У продуктов, например у судна ARK ELITE 70, есть отдельные страницы с описанием и кнопками, чтобы поделиться ссылкой в Facebook, LinkedIn и WhatsApp. В разделе проектов есть категория «Oil & Gas» с карточками работ и постраничной навигацией. В подвале — ссылки на новости, события, карьеру и фотогалерею.',
        'az' => 'Azerbaijan Marine and Engineering Consultants (AMEC) — dəniz və ofşor sahəsinə məsləhət xidmətləri göstərən Bakı şirkətidir: inspeksiyalar və texniki ekspertiza aparır, mühəndislik xidmətləri təqdim edir. İngilisdilli sayt sifarişçilərə xidmətləri, məhsulları və icra olunmuş layihələri göstərir.

Saytı açar təhvil, yəni strukturu, dizaynı, hazırlanması, SEO ayarları və işə salınması ilə birlikdə MGuliyev Studio yaradıb. Ana səhifədə «Haqqımızda» bloku, xidmətlər (məsələn, marine warranty surveys) və məhsul kartları var. Məhsulların, məsələn ARK ELITE 70 gəmisinin, təsviri və linki Facebook, LinkedIn və WhatsApp-da paylaşmaq üçün düymələri olan ayrıca səhifələri var. Layihələr bölməsində iş kartları və səhifə naviqasiyası olan «Oil & Gas» kateqoriyası var. Saytın alt hissəsində xəbərlərə, tədbirlərə, karyeraya və foto qalereyaya keçidlər yerləşir.',
        'en' => 'Azerbaijan Marine and Engineering Consultants (AMEC) is a Baku company that provides consulting to the marine and offshore industry: it carries out inspections and technical assessments and provides engineering services. The English-language site shows clients its services, products and completed projects.

The site was built turnkey — that is, structure, design, development, SEO setup and launch — by MGuliyev Studio. The home page has an “About us” block, services (marine warranty surveys, for example) and product cards. Products such as the ARK ELITE 70 vessel have their own pages with a description and buttons for sharing the link on Facebook, LinkedIn and WhatsApp. The projects section has an “Oil & Gas” category with project cards and pagination. The footer links to news, events, careers and a photo gallery.',
    ],
    'smeltd.az' => [
        'ru' => 'SME («Sahibkarın Məsləhət Evi») — консалтинговая компания из Баку, которая работает с предпринимателями, в том числе с малым и средним бизнесом. Она готовит бизнес-планы и инвестиционные проекты, оказывает бухгалтерские услуги, помогает зарегистрировать ООО и проводит тренинги. Сайт объясняет эти услуги и собирает заявки.

Студия разработала сайт под ключ: структура, дизайн, разработка, настройка SEO и запуск. В разделе «Бизнес-план» услуги разбиты по программам финансирования, отдельно вынесены примеры бизнес-планов. Есть разделы «Тренинги», «Услуги», «Блог», «Референсы» с логотипами компаний, FAQ и «Контакты». Форма запроса стоит в подвале страниц, а в мобильной версии внизу есть кнопки WhatsApp и звонка.',
        'az' => 'SME («Sahibkarın Məsləhət Evi») — sahibkarlarla, o cümlədən kiçik və orta bizneslə işləyən Bakı konsaltinq şirkətidir. Şirkət biznes-planlar və investisiya layihələri hazırlayır, mühasibat xidmətləri göstərir, MMC-nin qeydiyyatına kömək edir və təlimlər keçirir. Sayt bu xidmətləri izah edir və müraciətləri toplayır.

Studiya saytı açar təhvil hazırlayıb: struktur, dizayn, hazırlanma və işə salma. Hazırlanma zamanı SEO da tənzimlənib. «Biznes-plan» bölməsində xidmətlər maliyyələşdirmə proqramları üzrə bölünüb, biznes-plan nümunələri isə ayrıca verilib. Saytda «Təlimlər», «Xidmətlər», «Bloq», şirkət loqotipləri olan «Referanslar», FAQ və «Əlaqə» bölmələri var. Sorğu forması səhifələrin alt hissəsində yerləşir, mobil versiyada isə aşağıda WhatsApp və zəng düymələri var.',
        'en' => 'SME (“Sahibkarın Məsləhət Evi”) is a Baku consulting company that works with entrepreneurs, including small and medium-sized businesses. It prepares business plans and investment projects, provides accounting services, helps register LLCs and runs training sessions. The site explains these services and collects requests.

The studio developed the site turnkey: structure, design, development, SEO setup and launch. In the “Business plan” section, services are broken down by funding program, and sample business plans are shown separately. There are “Training”, “Services”, “Blog”, “References” (with company logos), FAQ and “Contact” sections. The request form sits in the page footer, and the mobile version has WhatsApp and call buttons at the bottom.',
    ],
    'azeco.az' => [
        'ru' => 'Azeco — компания из Гусарского района, которая выращивает картофель и капусту в высокогорной зоне. Сайт рассказывал о хозяйстве и его сортах на трёх языках: кроме азербайджанской и английской, у него была русская версия.

MGuliyev Studio сделала сайт под ключ: структура, дизайн, разработка, настройка SEO и запуск. В меню «Продукция» у каждого сорта своя страница с описанием и фотогалереей: картофель Anna Koroleva и Manifest, капуста Aqressor. Есть раздел «О компании», контакты с формой и картой, переключатель AZ/EN/RU и мобильная версия. Сейчас сайт не открывается, проект остаётся в портфолио.',
        'az' => 'Azeco — Qusar rayonunda, yüksək dağlıq zonada kartof və kələm yetişdirən şirkətdir. Sayt təsərrüfat və onun sortları haqqında üç dildə məlumat verirdi: Azərbaycan və ingilis versiyalarından əlavə, onun rus versiyası da var idi.

MGuliyev Studio saytı açar təhvil hazırlayıb: struktur, dizayn, hazırlanma və işə salma. Hazırlanma zamanı SEO da tənzimlənib. «Məhsullar» menyusunda hər sortun təsviri və foto qalereyası olan öz səhifəsi var: Anna Koroleva və Manifest kartofu, Aqressor kələmi. Saytda «Şirkət haqqında» bölməsi, forma və xəritə ilə əlaqə səhifəsi, AZ/EN/RU dəyişdiricisi və mobil versiya da var. Hazırda sayt açılmır, layihə portfolioda qalır.',
        'en' => 'Azeco is a company from the Gusar district that grows potatoes and cabbage in a highland zone. The site told visitors about the farm and its varieties in three languages: besides Azerbaijani and English, it had a Russian version.

MGuliyev Studio built the site turnkey: structure, design, development, SEO setup and launch. In the “Products” menu, each variety has its own page with a description and a photo gallery: Anna Koroleva and Manifest potatoes and Aqressor cabbage. There is an “About the company” section, a contact page with a form and a map, an AZ/EN/RU switcher and a mobile version. The site does not open at the moment; the project stays in the portfolio.',
    ],
    'enemay.com' => [
        'ru' => 'ENEMAY Financial Consulting and Career Center — компания из Баку, которая консультирует организации и частных лиц по бухучёту, налогам, аудиту и кадрам, а также проводит обучение. Сайт объединял услуги, учебные программы и раздел карьеры.

Сайт разработан под ключ — от структуры и дизайна до запуска. При разработке было настроено и SEO. В разделе «Услуги» десять направлений с описаниями, в «Обучении» — учебные программы, например по бухгалтерскому учёту. В «Карьере» — вакансии с поиском по словам и городу, фильтры по типу занятости и программа стажировки. На главной — видео о компании и карусель партнёров, в подвале — подписка на новости; есть кнопка WhatsApp и английская версия. Сейчас сайт не открывается, проект остаётся в портфолио.',
        'az' => 'ENEMAY Financial Consulting and Career Center — təşkilatlara və fiziki şəxslərə mühasibat uçotu, vergilər, audit və kadr məsələləri üzrə məsləhət verən, həmçinin təlimlər keçirən Bakı şirkətidir. Sayt xidmətləri, tədris proqramlarını və karyera bölməsini bir yerdə birləşdirirdi.

Sayt açar təhvil hazırlanıb — strukturdan və dizayndan işə salmaya qədər. Hazırlanma zamanı SEO da tənzimlənib. «Xidmətlər» bölməsində təsvirləri ilə birlikdə on istiqamət, «Təlim» bölməsində isə tədris proqramları var, məsələn, mühasibat uçotu üzrə. «Karyera» bölməsində söz və şəhər üzrə axtarışı olan vakansiyalar, məşğulluq növü üzrə filtrlər və təcrübə proqramı yerləşir. Ana səhifədə şirkət haqqında video və tərəfdaşların karuseli, alt hissədə isə xəbərlərə abunə var; WhatsApp düyməsi və ingilis versiyası da mövcuddur. Hazırda sayt açılmır, layihə portfolioda qalır.',
        'en' => 'ENEMAY Financial Consulting and Career Center is a Baku company that advises organizations and individuals on accounting, taxes, audit and HR, and also provides training. The site brought together its services, training programs and a careers section.

The site was developed turnkey — from structure and design to launch. SEO was set up during development as well. The “Services” section covers ten areas with descriptions, and “Training” has training programs, for example in accounting. “Careers” has vacancies with search by keyword and city, filters by employment type, and an internship program. The home page has a video about the company and a partner carousel, and the footer has a newsletter subscription; there is a WhatsApp button and an English version. The site does not open at the moment; the project stays in the portfolio.',
    ],
    'alfalat.com' => [
        'ru' => 'ALFA LAT — компания из Баку, которая ведёт юридическую, бухгалтерскую и налоговую практику: корпоративное право, регистрация бизнеса, налоги, трудовое и таможенное право, споры. Сайт на английском и азербайджанском рассчитан в том числе на иностранных партнёров, работающих в Азербайджане.

Студия сделала сайт под ключ: структура, дизайн, разработка, настройка SEO и запуск. На главной — обращение управляющего партнёра, 11 направлений практики со ссылками на подробные страницы и форма бесплатной консультации с выбором услуги. Кнопка «Free consultation», телефон и часы работы вынесены в шапку. Есть разделы «Новости», «Обновления», «Команда», «Join us», «О компании» и «Контакты». Сейчас сайт не открывается, проект остаётся в портфолио.',
        'az' => 'ALFA LAT — hüquq, mühasibat və vergi praktikası ilə məşğul olan Bakı şirkətidir: korporativ hüquq, biznesin qeydiyyatı, vergilər, əmək və gömrük hüququ, mübahisələr. İngilis və Azərbaycan dillərindəki sayt, o cümlədən, Azərbaycanda fəaliyyət göstərən xarici tərəfdaşlar üçün nəzərdə tutulub.

Studiya saytı açar təhvil hazırlayıb: struktur, dizayn, hazırlanma və işə salma. Hazırlanma zamanı SEO da tənzimlənib. Ana səhifədə idarəedici tərəfdaşın müraciəti, ətraflı səhifələrə keçidləri olan 11 praktika istiqaməti və xidmət seçimi ilə ödənişsiz konsultasiya forması var. «Free consultation» düyməsi, telefon və iş saatları yuxarı hissəyə çıxarılıb. Saytda «Xəbərlər», «Yeniləmələr», «Komanda», «Join us», «Şirkət haqqında» və «Əlaqə» bölmələri var. Hazırda sayt açılmır, layihə portfolioda qalır.',
        'en' => 'ALFA LAT is a Baku company with a legal, accounting and tax practice: corporate law, business registration, taxes, labor and customs law, and disputes. The site, in English and Azerbaijani, is aimed at an audience that includes foreign partners working in Azerbaijan.

The studio built the site turnkey: structure, design, development, SEO setup and launch. The home page has a message from the managing partner, 11 practice areas linking to detailed pages, and a free consultation form with a choice of service. The “Free consultation” button, phone number and working hours are placed in the header. There are “News”, “Updates”, “Team”, “Join us”, “About the company” and “Contact” sections. The site does not open at the moment; the project stays in the portfolio.',
    ],
    'cenofex.ai' => [
        'ru' => 'Cenofex — консалтинговая компания, которая помогает бизнесу с цифровой трансформацией: автоматизацией процессов и внедрением ИИ. Свою роль компания описывает как внешний центр компетенций (Center of Excellence) для клиентов.

MGuliyev Studio разработала сайт под ключ: структура, дизайн, разработка, настройка SEO и запуск. Сейчас на главной есть блоки «Кто мы», «Что мы делаем» и «Технологии» с логотипами технологических партнёров, раздел готовых решений для финансов, налогов и HR, форма обратной связи и ссылка на WhatsApp. Сайт работает на английском и азербайджанском.',
        'az' => 'Cenofex — biznesə rəqəmsal transformasiyada, yəni proseslərin avtomatlaşdırılmasında və süni intellektin tətbiqində kömək edən konsaltinq şirkətidir. Şirkət öz rolunu müştərilər üçün xarici səriştə mərkəzi (Center of Excellence) kimi təsvir edir.

MGuliyev Studio saytı açar təhvil hazırlayıb: struktur, dizayn, hazırlanma və işə salma. Hazırlanma zamanı SEO da tənzimlənib. Hazırda ana səhifədə «Biz kimik», «Nə edirik» və texnoloji tərəfdaşların loqotipləri ilə «Texnologiyalar» blokları, maliyyə, vergilər və HR üçün hazır həllər bölməsi, əks əlaqə forması və WhatsApp linki var. Sayt ingilis və Azərbaycan dillərində işləyir.',
        'en' => 'Cenofex is a consulting company that helps businesses with digital transformation: process automation and AI adoption. The company describes its role as an external center of competence (Center of Excellence) for its clients.

MGuliyev Studio developed the site turnkey: structure, design, development, SEO setup and launch. The home page currently has “Who we are”, “What we do” and “Technologies” blocks with logos of technology partners, a section of ready-made solutions for finance, tax and HR, a feedback form and a WhatsApp link. The site is in English and Azerbaijani.',
    ],
    'pilatesbaku.az' => [
        'ru' => 'Baku Pilates Center — сеть пилатес-студий в Баку. В сеть входят три центра: Pilates Baku и два клуба Pilates Club. Сайт помогает выбрать удобный центр, посмотреть залы и оборудование и связаться со студией.

MGuliyev Studio сделала сайт под ключ: структура, дизайн, разработка, настройка SEO и запуск. На главной — первый экран со слоганом, блок «О нас» и карточки центров. На странице центров — фотогалереи залов и кнопки связи, в разделе оборудования показан Reformer. Есть страница контактов с телефонами, адресом и Google-картой, ссылки на Facebook, Instagram и YouTube, мобильная версия.',
        'az' => 'Baku Pilates Center — Bakıda pilates studiyaları şəbəkəsidir. Şəbəkəyə üç mərkəz daxildir: Pilates Baku və iki Pilates Club klubu. Sayt əlverişli mərkəzi seçməyə, zallara və avadanlığa baxmağa və studiya ilə əlaqə saxlamağa kömək edir.

MGuliyev Studio saytı açar təhvil şəklində hazırlayıb: struktur, dizayn, hazırlanma, SEO ayarları və işə salınma. Ana səhifədə şüarla birinci ekran, «Haqqımızda» bloku və mərkəzlərin kartları var. Mərkəzlər səhifəsində zalların foto qalereyaları və əlaqə düymələri yerləşir, avadanlıq bölməsində Reformer göstərilib. Telefonlar, ünvan və Google xəritəsi olan əlaqə səhifəsi, Facebook, Instagram və YouTube linkləri, mobil versiya da var.',
        'en' => 'Baku Pilates Center is a chain of Pilates studios in Baku. The chain includes three centers: Pilates Baku and two Pilates Club locations. The website helps visitors choose a convenient center, see the rooms and equipment, and get in touch with the studio.

MGuliyev Studio built the website turnkey: structure, design, development, SEO setup and launch. The home page has a hero section with the slogan, an “About Us” block and cards for the centers. The centers page has photo galleries of the rooms and contact buttons, and the equipment section features the Reformer. There is a contacts page with phone numbers, the address and a Google Map, links to Facebook, Instagram and YouTube, and a mobile version.',
    ],
    'drymatic.az' => [
        'ru' => 'DryMatic — химчистка в Баку. Компания предлагает химчистку, прачечную, крашение текстиля и кожи и услуги ателье. На сайте клиент видит цену услуги и может сразу её заказать.

Сайт разработан под ключ — от структуры и дизайна до запуска. При разработке было настроено и SEO. В меню разделы «О компании», «Услуги», «Партнёры», FAQ и «Контакты». У услуг есть карточки с ценой в AZN, кнопкой заказа, кнопками «поделиться» и блоком похожих услуг, в шапке корзина. На главной слайдер, преимущества и логотипы партнёров. Есть онлайн-чат, мобильная версия и страница контактов с адресом филиала, часами работы и картой.',
        'az' => 'DryMatic — Bakıda kimyəvi təmizləmə xidmətidir. Şirkət kimyəvi təmizləmə, camaşırxana, tekstilin və dərinin boyanması və atelye xidmətləri təklif edir. Saytda müştəri xidmətin qiymətini görür və onu dərhal sifariş edə bilir.

Sayt açar təhvil şəklində hazırlanıb — strukturdan və dizayndan işə salınmaya qədər. Hazırlanma zamanı SEO da tənzimlənib. Menyuda «Şirkət haqqında», «Xidmətlər», «Partnyorlar», FAQ və «Əlaqə» bölmələri var. Hər xidmətin AZN ilə qiyməti, sifariş düyməsi, «paylaş» düymələri və oxşar xidmətlər bloku olan kartı var, saytın yuxarı hissəsində səbət yerləşir. Ana səhifədə slayder, üstünlüklər və partnyorların loqotipləri var. Onlayn çat, mobil versiya və filialın ünvanı, iş saatları və xəritəsi olan əlaqə səhifəsi də var.',
        'en' => 'DryMatic is a dry cleaner in Baku. The company offers dry cleaning, laundry, textile and leather dyeing, and tailoring services. On the website, customers see the price of a service and can order it right away.

The website was developed turnkey, from structure and design to launch. SEO was set up during development as well. The menu has “About the Company”, “Services”, “Partners”, FAQ and “Contacts” sections. Each service has a card with the price in AZN, an order button, share buttons and a block of similar services, and there is a cart in the header. The home page has a slider, advantages and partner logos. There is an online chat, a mobile version and a contacts page with the branch address, opening hours and a map.',
    ],
    '166temizlik.az' => [
        'ru' => '166 Təmizlik — клининговая компания из Баку: уборка жилья, офисов и загородных домов. Сайт сразу показывает пакеты и цены и ведёт к заказу. У сайта есть русская версия.

MGuliyev Studio выполнила проект под ключ: структура, дизайн, разработка, запуск. При разработке было настроено и SEO. На главной — слайдер со спецпредложениями, пакеты уборки на 4 и 8 часов с ценой за 1, 2 или 3 дня в неделю, примечания о том, что входит в цену, а что нет, карта обслуживания по Азербайджану и слайдер «до/после». В шапке кнопка заказа и переключатель на русский язык, в меню есть галерея. На странице контактов — форма обратной связи и кнопка WhatsApp.',
        'az' => '166 Təmizlik — Bakıdakı klininq şirkətidir: mənzillərin, ofislərin və bağ evlərinin təmizlənməsi. Sayt paketləri və qiymətləri dərhal göstərir və sifarişə aparır. Saytın rus dilində versiyası var.

MGuliyev Studio layihəni açar təhvil şəklində icra edib: struktur, dizayn, hazırlanma, SEO ayarları, işə salınma. Ana səhifədə xüsusi təkliflər slayderi, həftədə 1, 2 və ya 3 gün üçün qiyməti göstərilən 4 və 8 saatlıq təmizlik paketləri, qiymətə nəyin daxil olduğu və nəyin daxil olmadığı barədə qeydlər, Azərbaycan üzrə xidmət xəritəsi və «əvvəl/sonra» slayderi var. Saytın yuxarı hissəsində sifariş düyməsi və rus dilinə keçid, menyuda isə qalereya var. Əlaqə səhifəsində əks əlaqə forması və WhatsApp düyməsi yerləşir.',
        'en' => '166 Təmizlik is a cleaning company in Baku that cleans homes, offices and country houses. The website shows the packages and prices up front and leads straight to an order. The website has a Russian version.

MGuliyev Studio delivered the project turnkey: structure, design, development, launch. SEO was set up during development as well. The home page has a slider with special offers, 4- and 8-hour cleaning packages priced for 1, 2 or 3 days a week, notes on what is and isn\'t included in the price, a service map across Azerbaijan and a “before/after” slider. The header has an order button and a switch to Russian, and the menu includes a gallery. The contacts page has a feedback form and a WhatsApp button.',
    ],
    'kvsdosi.com' => [
        'ru' => 'KVS Do Si Music Learning Center — музыкальная школа в Чикаго (США), сайт на английском. Школа учит игре на инструментах, знакомит с азербайджанскими народными инструментами, ведёт ансамблевые программы и занятия композицией, проводит летние и каникулярные лагеря и сдаёт инструменты в аренду.

Сайт сделан под ключ: структура, дизайн, разработка, настройка SEO и запуск. На главной — кнопки «Get Started» и «Meet The Teachers» и карточки семи направлений, на странице уроков — индивидуальные, групповые и онлайн-занятия. Есть разделы «About Us», галерея, вакансии, блог и контакты, мобильная версия. Сейчас сайт не открывается, но проект остаётся в портфолио.',
        'az' => 'KVS Do Si Music Learning Center — Çikaqoda (ABŞ) musiqi məktəbidir, sayt ingilis dilindədir. Məktəb musiqi alətlərində ifa etməyi öyrədir, Azərbaycan xalq çalğı alətləri ilə tanış edir, ansambl proqramları və bəstəkarlıq dərsləri aparır, yay və tətil düşərgələri keçirir və alətləri icarəyə verir.

Sayt açar təhvil şəklində yaradılıb: struktur, dizayn, hazırlanma, SEO ayarları və işə salınma. Ana səhifədə «Get Started» və «Meet The Teachers» düymələri və yeddi istiqamətin kartları, dərslər səhifəsində isə fərdi, qrup və onlayn məşğələlər var. «About Us», qalereya, vakansiyalar, bloq və əlaqə bölmələri, mobil versiya da var. Hazırda sayt açılmır, lakin layihə portfolioda qalır.',
        'en' => 'KVS Do Si Music Learning Center is a music school in Chicago (USA); the website is in English. The school teaches students to play instruments, introduces them to Azerbaijani folk instruments, runs ensemble programs and composition classes, holds summer and school-break camps, and rents out instruments.

The website was built turnkey: structure, design, development, SEO setup and launch. The home page has “Get Started” and “Meet The Teachers” buttons and cards for seven programs, and the lessons page covers individual, group and online classes. There are “About Us”, gallery, job openings, blog and contacts sections, and a mobile version. The website is currently down, but the project remains in the portfolio.',
    ],
    'mtt.az' => [
        'ru' => 'MTT (More Than Trust) — компания из Баку: HR-консалтинг, подбор персонала и подготовка к сертификации HRCI (aPHRi, PHRi, SPHRi). Сайт на английском.

MGuliyev Studio разработала сайт под ключ — от структуры до запуска. При разработке было настроено и SEO. На сайте есть каталог консультантов с фотографиями и поиском, вакансии с поиском по ключевым словам и локации, страница HRCI с документами для скачивания и раздел «Who we are» с карточками выпускников. В боковом меню — ссылки на LinkedIn и Instagram. Сейчас сайт не открывается, проект остаётся в портфолио.',
        'az' => 'MTT (More Than Trust) — Bakıdakı şirkətdir: HR-konsaltinq, kadr seçimi və HRCI sertifikasiyasına (aPHRi, PHRi, SPHRi) hazırlıq. Sayt ingilis dilindədir.

MGuliyev Studio saytı açar təhvil şəklində hazırlayıb — strukturdan işə salınmaya qədər. Hazırlanma zamanı SEO da tənzimlənib. Saytda fotoşəkilləri və axtarışı olan məsləhətçilər kataloqu, açar sözlər və məkan üzrə axtarışı olan vakansiyalar, yükləmək üçün sənədləri olan HRCI səhifəsi və məzunların kartları ilə «Who we are» bölməsi var. Yan menyuda LinkedIn və Instagram linkləri yerləşir. Hazırda sayt açılmır, layihə portfolioda qalır.',
        'en' => 'MTT (More Than Trust) is a Baku company offering HR consulting, recruitment and preparation for HRCI certification (aPHRi, PHRi, SPHRi). The website is in English.

MGuliyev Studio developed the website turnkey, from structure to launch. SEO was set up during development as well. The website has a directory of consultants with photos and search, job openings with search by keyword and location, an HRCI page with downloadable documents and a “Who we are” section with graduate cards. The side menu has links to LinkedIn and Instagram. The website is currently down; the project remains in the portfolio.',
    ],
    'xaliqrzayev.com' => [
        'ru' => 'Сайт врача — уролога-андролога, который обследует и оперирует взрослых и детей. Здесь рассказано, какие обследования и операции проводит врач, и можно записаться на приём.

Проект выполнен под ключ: структура, дизайн, разработка, настройка SEO и запуск. На текущей версии это одна страница на азербайджанском с разделами «Haqqımda», «Diaqnostika», «Cərrahiyyə», «Təhsil» и «Əlaqə». Списки обследований и операций разделены для взрослых и детей. Есть сведения об образовании врача, кнопки звонка и WhatsApp и форма онлайн-записи, которая отправляет заявку в WhatsApp.',
        'az' => 'Böyükləri və uşaqları müayinə və əməliyyat edən uroloq-androloq həkimin saytı. Burada həkimin hansı müayinə və əməliyyatları apardığı izah olunur və qəbula yazılmaq mümkündür.

Layihə açar təhvil şəklində icra olunub: struktur, dizayn, hazırlanma, SEO ayarları və işə salınma. Hazırkı versiyada bu, «Haqqımda», «Diaqnostika», «Cərrahiyyə», «Təhsil» və «Əlaqə» bölmələri olan Azərbaycan dilində bir səhifədir. Müayinə və əməliyyatların siyahıları böyüklər və uşaqlar üçün ayrılıb. Həkimin təhsili haqqında məlumat, zəng və WhatsApp düymələri və müraciəti WhatsApp-a göndərən onlayn qəbula yazılma forması var.',
        'en' => 'The website of a urologist-andrologist who examines and operates on adults and children. It explains which examinations and surgeries the doctor performs, and visitors can book an appointment.

The project was completed turnkey: structure, design, development, SEO setup and launch. The current version is a single page in Azerbaijani with the sections “Haqqımda”, “Diaqnostika”, “Cərrahiyyə”, “Təhsil” and “Əlaqə”. The lists of examinations and surgeries are split into adults and children. There is information about the doctor\'s education, call and WhatsApp buttons, and an online booking form that sends the request to WhatsApp.',
    ],
    'itkin.az' => [
        'ru' => 'itkin.az — сайт общественного объединения «Qarabağ İtkin Ailələri». В объединение входят семьи людей, пропавших без вести в Карабахских войнах. На сайте опубликован список пропавших и рассказано о работе объединения.

MGuliyev Studio сделала сайт под ключ: структура, дизайн, разработка, настройка SEO и запуск. На текущей версии есть список пропавших без вести, статистика по Первой и Второй Карабахским войнам, международные документы и национальное законодательство, раздел «Медиа» с историями жизни, библиотекой и фото, мероприятия и контакты. Сайт работает на азербайджанском и английском.',
        'az' => 'itkin.az — «Qarabağ İtkin Ailələri» ictimai birliyinin saytıdır. Birliyə Qarabağ müharibələrində itkin düşmüş şəxslərin ailələri daxildir. Saytda itkin düşənlərin siyahısı dərc olunub və birliyin fəaliyyəti haqqında məlumat verilir.

MGuliyev Studio saytı açar təhvil şəklində hazırlayıb: struktur, dizayn, hazırlanma, SEO ayarları və işə salınma. Hazırkı versiyada itkin düşmüş şəxslərin siyahısı, Birinci və İkinci Qarabağ müharibələri üzrə statistika, beynəlxalq sənədlər və milli qanunvericilik, həyat hekayələri, kitabxana və fotolar olan «Media» bölməsi, tədbirlər və əlaqə var. Sayt Azərbaycan və ingilis dillərində işləyir.',
        'en' => 'itkin.az is the website of the public association “Qarabağ İtkin Ailələri”. The association brings together families of people who went missing in the Karabakh wars. The website publishes a list of the missing and describes the association\'s work.

MGuliyev Studio built the website turnkey: structure, design, development, SEO setup and launch. The current version has a list of missing persons, statistics on the First and Second Karabakh Wars, international documents and national legislation, a “Media” section with life stories, a library and photos, events and contacts. The website is available in Azerbaijani and English.',
    ],
];
