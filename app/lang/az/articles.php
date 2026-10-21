<?php
/* Статьи блога: перевод (Azərbaycan dili).

   Накладка на app/data/articles.php: по адресу статьи — те же поля,
   что в оригинале. Перевод сделан с русского и сверен дважды: по
   смыслу (ни одного добавленного или потерянного факта, числа и
   записи DNS — дословно) и по языку. Нет статьи здесь — она
   показывается по-русски и на этом языке не индексируется. */

return [
    'pochemu-pisma-kompanii-uhodyat-v-spam' => [
        'seoTitle' => 'Məktublar niyə spama düşür: SPF, DKIM və DMARC',
        'seoDesc'  => 'Kommersiya təkliflərinin və hesab-fakturaların çatmamasına səbəb olan üç DNS yazısı: onlar nə deməkdir və öz domeninizi beş dəqiqəyə necə yoxlamaq olar.',
        'title'    => 'Şirkətin məktubları niyə spama düşür: SPF, DKIM və DMARC',
        'desc'     => 'SPF, DKIM və DMARC sadə dillə: DNS-dəki bu yazılar nədir, nəyə lazımdır və şirkətinizin məktublarının ünvana çatıb-çatmadığını beş dəqiqəyə necə yoxlamaq olar.',
        'rubric'   => 'Poçt və domenlər',
        'lead'     => 'Kommersiya təklifi göndərdiniz, amma cavab gəlmədi. Bir həftə sonra müştəri deyir ki, məktubu görməyib. Məktub onun «Spam» qovluğundadır — hesab-faktura, müqavilə və saytdan gələn müraciətə cavabla birlikdə. Çox vaxt səbəb nə məktubun mətnində, nə də qoşmadadır. Səbəb domeninizin ayarlarında olmayan üç qısa sətirdədir. Gəlin görək, bu sətirlər nədir və onları öz domeninizdə necə yoxlamaq olar.',
        'body'     => [
            ['DNS yazısı nədir və harada yerləşir', 'Domen yalnız saytın ünvanı deyil. Bu, həm də şirkətiniz barədə texniki məlumatlar toplusudur və onu bütün dünyadakı serverlər oxuyur. Bu topluya DNS zonası, içindəki ayrı-ayrı sətirlərə isə DNS yazıları deyilir.

DNS «domen adları sistemi» deməkdir. Mahiyyətcə bu, soraq kitabçasıdır: domen adına görə kompüterlərə lazımi məlumatları verir. Bir yazı saytın hansı serverdə yerləşdiyini göstərir. Digəri — daxil olan poçtun hara çatdırılmalı olduğunu. Üçüncüsü sadəcə mətndir və onu hər kəs oxuya bilər; belə yazılar TXT adlanır. SPF, DKIM və DMARC məhz TXT yazılarıdır. Bunlar proqram və ya poçt proqramının ayarları deyil, domen zonasındakı bir neçə sətir mətndir.

Zona domenə xidmət göstərilən yerdə saxlanılır: registratorun panelində, hostinq provayderində və ya saytın trafikinin keçdiyi servisdə. Yazıları bu panelə girişi olan şəxs dəyişə bilər. Dəyişikliklər internetdə dərhal yayılmır — bir neçə dəqiqədən bir neçə saata qədər vaxt aparır.

Əvvəllər bu yazıların olmamasına göz yumurdular. İndi isə Gmail və Yahoo da daxil olmaqla iri poçt xidmətləri bütün göndərənlərdən ən azı SPF və ya DKIM tələb edir. Böyük həcmdə məktub göndərənlərdən isə üstəlik DMARC da.'],
            ['SPF: sizin adınızdan yazmağa icazəsi olanların siyahısı', 'SPF (Sender Policy Framework) — domeninizin adından poçt göndərməyə icazə verilmiş serverlərin siyahısıdır.

Məntiq sadədir. Qəbul edən server «şirkətinizdən» gələn məktubu görür, onun hansı ünvandan gəldiyinə baxır və DNS zonanıza nəzər salır: bu göndərən siyahıda varmı? Varsa — yoxlamadan keçdi. Yoxdursa — məktub şübhəlidir.

Yazı təxminən belə görünür: v=spf1 include:_spf.example.com ~all. Əvvəlcə versiya, sonra icazəli göndərənlər (adətən include: vasitəsilə — «siyahını filan provayderdən götür»), sonda isə qalan bütün göndərənlərlə nə etməli: ~all «şübhəli say», -all isə «saxta say» deməkdir. Bu, əmr deyil, qiymətləndirmədir: belə məktubla nə edəcəyinə qəbul edən tərəf özü qərar verir — elə buna görə də sonra DMARC lazım olacaq.

Ən çox rast gəlinən səhvlər iki məqamla bağlıdır. Birincisi: domenin yalnız bir SPF yazısı olmalıdır. İki yazı birləşmir — yoxlama bütövlükdə pozulur. İkincisi: bütün include: ifadələri açılarkən standarta görə DNS-ə ən çox on müraciət edilə bilər. Limiti keçdinizsə, nəticə xəta sayılır. Korporativ poçt, göndərişlər və CRM müxtəlif provayderlərdədirsə, bu limitə çatmaq asandır.

Vacib məqam: SPF göndərənin xidməti ünvanını yoxlayır, insanın «Kimdən» sahəsində gördüyü adı yox. Görünən sahənin saxtalaşdırılmasına SPF tək başına mane olmur — bununla DMARC məşğul olur.'],
            ['DKIM: saxtalaşdırıla bilməyən imza', 'DKIM (DomainKeys Identified Mail) — məktubun rəqəmsal imzasıdır.

Poçt serverinin bir cüt açarı var. Gizli açar serverdə saxlanılır və heç yerə ötürülmür. Açıq açarı isə siz DNS-də dərc edirsiniz. Məktubu göndərərkən server başlıqları və mətni gizli açarla imzalayır. Alıcı açıq açarı zonanızdan götürür və imzanı yoxlayır.

Yoxlama eyni anda iki suala cavab verir: məktub həqiqətən sizin infrastrukturunuzdan göndərilib və yolda onu dəyişdirməyiblər. Kimsə yolda mövzunu, linki və ya mətndəki bank rekvizitlərini dəyişsə, imza artıq uyğun gəlməyəcək.

Yazı selector._domainkey.domeniniz şəklindəki ünvanda yerləşir — burada selector poçt provayderinin verdiyi etiketdir. Bir neçə etiket ola bilər: biri korporativ poçt, ikincisi göndəriş servisi, üçüncüsü CRM üçün. Açarın özünü adətən provayder yaradır, sizə yalnız verilən dəyəri DNS-ə kopyalamaq qalır.'],
            ['DMARC: yoxlamadan keçməyən məktubla nə etməli', 'SPF və DKIM yalnız «uyğun gəldi, ya yox» sualına cavab verir. Uyğun gəlməyən məktubla nə etmək lazım olduğunu demirlər — qəbul edən tərəf öz bildiyi kimi qərar verir. DMARC bu barədə sizin təlimatınızdır.

Yazı _dmarc.domeniniz ünvanında yerləşir və ən sadə halda belə görünür: v=DMARC1; p=none; rua=mailto:hesabatlar-üçün-ünvan. Burada əsas parametr p — siyasətdir:

— p=none — heç bir tədbir görməmək, yalnız hesabat göndərmək;
— p=quarantine — spama göndərmək;
— p=reject — girişdə rədd etmək, məktub ümumiyyətlə çatmayacaq.

DMARC-ın ikinci vəzifəsi yoxlamaları insanın gördüyü ünvanla əlaqələndirməkdir. «Kimdən» sahəsindəki domen SPF və ya DKIM yoxlamasından keçmiş domenlə üst-üstə düşməlidir (ikisindən biri kifayətdir). Buna uyğunlaşdırma deyilir və o, tək SPF-in saxta məktublardan qorumamasına səbəb olan həmin boşluğu bağlayır.

İşə p=reject ilə başlamaq məsləhət deyil. Əvvəlcə p=none və hesabatlar üçün ünvan: bir neçə həftə ərzində sadəcə sizin adınızdan kimin məktub göndərdiyini izləyirsiniz. Demək olar ki, həmişə bir-iki unudulmuş mənbə üzə çıxır — mühasibatlıq, əks əlaqə forması, köhnə göndəriş. Onları tənzimləyirlər və yalnız bundan sonra siyasəti sərtləşdirirlər. Hesabatlar maşınla oxunan formatda gəlir, onları ya əl ilə təhlil edirlər, ya da ixtisaslaşmış servisə yükləyirlər.'],
            ['Şəxsi Gmail niyə göndərən ünvanı kimi uğursuz seçimdir', 'Geniş yayılmış vəziyyət: sayt şirkətin domenindədir, məktublar isə company.baku@gmail.com kimi ünvandan göndərilir.

Texniki baxımdan burada hər şey yanlışdır. Ünvandakı domen sizinki deyil, gmail.com-dur. Deməli, hər üç yoxlama sizin biznesinizə deyil, Google-un domeninə aiddir. Bu ünvan üçün nə SPF-i, nə DKIM-i, nə də DMARC-ı siz tənzimləyirsiniz — onları poçt xidməti idarə edir. Öz domeninizdə göndərən reputasiyası toplamırsınız, siyasət təyin edə bilmirsiniz, domeni saxtalaşdırmadan qorumursunuz. Üstəlik gündəlik tərəfi də var: poçt qutusu şirkətə deyil, insana bağlıdır və o gedəndə qutu da onunla gedir.

Ayrıca hal — şəxsi qutuya korporativ ünvan başqa ad altında göndərmə funksiyası vasitəsilə əlavə ediləndə. «Kimdən» sahəsində sizin domeniniz görünür, məktub isə başqasının serverləri üzərindən gedir. Bu zaman imza poçt xidmətinin domeni adından qoyulur, sizin domeninizlə uyğunlaşdırma olmur və sərt siyasətdə belə məktub ilk zərbəni alır. Üstəlik alıcı tez-tez adın yanında məktubun hansı servis vasitəsilə göndərildiyi barədə qeyd görür.'],
            ['Poçtunuzu beş dəqiqəyə necə yoxlamaq olar', 'Ən dürüst üsul məktuba alıcının gözü ilə baxmaqdır.

1. İş ünvanından istənilən Gmail qutusuna, lap öz şəxsi qutunuza belə məktub göndərin.
2. Məktubu brauzerdə açın, məktubun sağ yuxarı küncündəki üç nöqtəyə basın və «Orijinalı göstərin» bəndini seçin.
3. Açılan tabın yuxarısında kiçik cədvəl olacaq: SPF, DKIM, DMARC və hər biri üzrə nəticə — PASS və ya FAIL.

Üç PASS — əsas ayarlar qaydasındadır. İstənilən FAIL və ya tire — düzəldiləsi nəsə var. Outlook və digər poçt proqramlarında eyni şeyi məktubun mənbə kodunda, Authentication-Results sətrində axtarmaq lazımdır.

Yazıların özünə birbaşa da baxmaq olar. Windows-un komanda sətrində nslookup -type=txt domeniniz əmri digər məlumatlarla yanaşı SPF-i, nslookup -type=txt _dmarc.domeniniz isə DMARC siyasətini göstərəcək. Cavab boşdursa, deməli, yazı yoxdur.

Yoxlama üçün veb-servislər də var, amma Gmail-dən başlamaq daha asandır: o, nəzəriyyəni deyil, real məktub üzrə real hökmü göstərir.'],
        ],
        'end'      => 'Üç yazı məktubları daha maraqlı etməyəcək və aydın təklifi əvəz etməyəcək. Onlar başqa məsələni həll edir: məktub ünvana çatsın və şirkətin məktubu kimi görünsün, kiminsə özünü şirkət kimi qələmə vermək cəhdi kimi yox. Bir dəfə tənzimlənir, beş dəqiqəyə yoxlanılır, tələb etdiyi isə yalnız DNS panelinə girişdir.

Panelə girişiniz yoxdursa, yazılar əvvəlki podratçıdan miras qalıbsa və ya yoxlama FAIL göstərirsə, amma səbəbi aydın deyilsə — bu, sonsuz proses deyil, birdəfəlik işdir. Domen üçün poçtun tənzimlənməsi MGuliyev Studio-nun sayt hazırlanması ilə yanaşı məşğul olduğu işlərin bir hissəsidir.',
    ],
    'core-web-vitals-lcp-inp-cls' => [
        'seoTitle' => 'Core Web Vitals: Google hansı saytı sürətli hesab edir',
        'seoDesc'  => 'LCP, INP və CLS sadə dillə: hər metrika nəyi ölçür və noutbukunuzdan aparılan testlə real ziyarətçilərin məlumatları niyə üst-üstə düşmür.',
        'title'    => 'Google hansı saytı sürətli hesab edir',
        'desc'     => 'LCP, INP və CLS sadə dillə: hər metrika nəyi ölçür, laboratoriya testi real ziyarətçilərin məlumatlarından nə ilə fərqlənir.',
        'rubric'   => 'Sürət və SEO',
        'lead'     => 'Saytın ünvanını PageSpeed Insights-a daxil edirsiniz və qarşınıza üç abbreviatura, bir neçə rəngli zolaq və necə oxunacağı bəlli olmayan bal çıxır. Gəlin araşdıraq: bu hərflərin arxasında nə dayanır, noutbukunuzdan alınan hesabatla Google-un ziyarətçiləriniz barədə hesabatı niyə fərqli şeylər göstərir və mobil sütun niyə demək olar ki, həmişə daha pis görünür.',
        'body'     => [
            ['Bir rəqəm yerinə üç sual', '«Yüklənmə vaxtı» vahid rəqəm kimi az şey deyir. Səhifə öz yuxarı hissəsini bir saniyədə göstərə, əsas blokun yerini isə daha üç saniyə boş saxlaya bilər. Hazır görünə, amma basanda reaksiya verməyə bilər.

Ona görə də Google sürət hissini üç suala bölüb. Əsas hissə ekranda tez göründümü? Səhifə ziyarətçinin hərəkətinə tez cavab verirmi? Məzmun yerində durur, yoxsa barmağın altında sıçrayır? Core Web Vitals — LCP, INP və CLS — elə bu suallara verilən cavablardır.

Qiymətləndirmənin necə aparıldığı vacibdir. Bir ölçmə deyil, real ziyarətçilərdən toplanan Chrome məlumatları 28 günlük sürüşən pəncərə üzrə götürülür, həm də orta göstəriciyə deyil, 75-ci persentilə baxılır: bu, ziyarətlərin dörddə üçünün sığdığı həddir. Bir qeyd: söhbət məhz Chrome-dan gedir. Safari və Firefox bu məlumat toplusuna daxil olmur, iPhone-dan gələn ziyarətçilər də — hətta onlarda Chrome quraşdırılıbsa belə. Yəni hesabat auditoriyanızın hamısını deyil, bir hissəsini təsvir edir. Mobil və desktop ziyarətləri ayrıca qiymətləndirilir.

Axtarışa bunun təsiri var, amma əsas amil kimi yox, əlavə arqument kimi: məzmunun relevantlığı sürətdən daha vacibdir. Satışlara isə sürət birbaşa təsir edir — ziyarətçilərin bir hissəsi təklifinizi görməmiş çıxıb gedir.'],
            ['LCP: səhifə nə vaxt hazır görünür', 'LCP (Largest Contentful Paint, «ən böyük elementin göstərilməsi») yüklənmənin başlanğıcından ekranda görünən bloklardan ən böyüyünün peyda olduğu ana qədər keçən vaxtı ölçür. Adətən bu, əsas foto, banner və ya iri başlıqdır. İnsan üçün bu, səhifənin hazır görünməyə başladığı andır.

Hədlər: 2,5 saniyəyə qədər — yaxşı, 4 saniyədən çox — pis, arada — «təkmilləşdirmə tələb edir». Xatırladıram: uğurlu bir ölçmə deyil, 75-ci persentil qiymətləndirilir.

Burada ən gözlənilməz məqam budur: vaxtı əksər hallarda şəklin həcmi aparmır. Əvvəlcə server cavab verməlidir. Sonra brauzer ümumiyyətlə bu şəklin mövcud olduğunu öyrənməlidir — şəkil isə stillərdə gizlənə, slayder skripti ilə yerləşdirilə və ya şriftin yüklənməsini gözləyə bilər. Faylın özünün ötürülməsi çox vaxt bu intervalın daha kiçik hissəsi olur. Ona görə də «şəkilləri sıxın» məsləhəti bəzən LCP-ni heç yerindən tərpətmir.'],
            ['INP: basdığınızda səhifə cavab verirmi', 'INP (Interaction to Next Paint, «növbəti göstərilməyə qədər cavab») 2024-cü ilin martında əvvəlki FID metrikasını əvəz edib. O, ziyarətçinin hərəkəti — klik, toxunuş, klavişə basma — ilə buna cavab olaraq ekranda nəyinsə dəyişdiyi an arasındakı gecikməni ölçür. Sürüşdürmə və kursorun üzərinə gətirilməsi nəzərə alınmır.

Ziyarət ərzindəki orta gecikmə deyil, ən pis gecikmələrdən biri götürülür. Məntiq sadədir: insan on cəld kliki deyil, donub qalan birini yadda saxlayır.

Hədlər: 200 millisaniyəyə qədər — yaxşı, 500 millisaniyədən çox — pis.

Pis INP-nin səbəbi demək olar ki, həmişə eynidir — ağır JavaScript. Brauzer onu tək axında icra edir və çat vidjetinin, analitikanın və ya karuselin skripti işləyərkən klik öz növbəsini gözləyir. Biznes baxımından bu belə görünür: ziyarətçi «Göndər» düyməsini basır, heç nə baş vermir, o bir daha basır. Poçtda təkrarlanan müraciətlər bu metrikaya baxmaq üçün yaxşı səbəbdir.'],
            ['CLS: məzmun yerindən sıçramırmı', 'CLS (Cumulative Layout Shift, «maketin sürüşməsi») məzmunun artıq göründükdən sonra nə qədər yerini dəyişdiyini ölçür. Bu, vaxt deyil, ölçüsüz kəmiyyətdir: 0,1-ə qədər — yaxşı, 0,25-dən yuxarı — pis.

Sürüşmələr haradan yaranır: ölçüləri təyin edilməmiş şəkillər və bannerlər, sonradan yüklənib blokları aralayan yerləşdirilmiş vidjetlər və reklam, mətnin hündürlüyünü dəyişən gec yüklənən şrift, cookie barədə açılan zolaq, səhifənin üstünə əlavə edilən bildiriş.

Pul sözün həqiqi mənasında itir: insan düyməni nişan alır, maket elə bu an sürüşür, barmaq qonşu linkə düşür. Elementlərin sıx yerləşdiyi telefonda bu daha tez-tez baş verir.

Daha bir incəlik var. Real ziyarətçilərin məlumatlarında sürüşmələr səhifə açıq qaldığı bütün müddət ərzində izlənir — yalnız ilk saniyələrdə yox. Amma qiymətləndirməyə ziyarət ərzindəki cəm deyil, ən pis sıçrayış düşür: ardıcıl gələn sürüşmələr müddəti beş saniyədən çox olmayan pəncərədə toplanır və belə pəncərələrdən ən ağırı hesaba alınır. Səhifə açıldıqdan bir dəqiqə sonra maketi yerindən oynadan karusel də qiymətləndirməyə düşəcək — əgər ən pis sıçrayış onunku olarsa.'],
            ['Laboratoriya və real şərait: hesabatlar niyə üst-üstə düşmür', 'Laboratoriya ölçməsi təyin olunmuş cihazda, təyin olunmuş şəbəkə sürəti ilə, canlı insan olmadan aparılan bir dəfəlik yoxlamadır. Brauzerə quraşdırılmış Lighthouse və PageSpeed Insights-da test nəticəsi olan bölmə belə işləyir. Nəticəni təkrarlamaq mümkündür, onu «əvvəl və sonra» müqayisə etmək rahatdır.

Sahə məlumatları isə ziyarətçilərinizin tərəfində əslində baş verənlərdir: onların telefonları, onların bağlantısı, onların brauzerindəki genişlənmələr. Core Web Vitals qiymətləndirməsinin əsasında məhz onlar dayanır və Search Console hesabatına da onlar düşür.

Çaşdıran uyğunsuzluqlar da buradan yaranır.

Laboratoriya testi prinsipcə INP-ni ölçə bilməz — bunun üçün canlı insanın kliki lazımdır. Onun yerinə dolayı əlamət göstərilir: brauzerin skriptlər tərəfindən bloklandığı ümumi vaxt. Laboratoriyada CLS yalnız yüklənmə müddəti üçün, sahə məlumatlarında isə bütün ziyarət üçün hesablanır. Laboratoriya hesabatındakı 0-dan 100-ə qədər ümumi bal da Core Web Vitals deyil, laboratoriya göstəricilərinin xülasəsidir.

Saytın trafiki azdırsa, sahə məlumatları kifayət qədər toplanmaya bilər və Google ya bütövlükdə domen üzrə məlumatları göstərəcək, ya da heç nə göstərməyəcək. Onda yalnız laboratoriya qalır.

Qayda sadədir: sahə məlumatları «problem varmı» sualına cavab verir, laboratoriya isə «nəyə görə» sualına.'],
            ['Mobil nəticə niyə desktop nəticəsindən pisdir', 'Bu, testin xətası deyil, bir neçə səbəbin cəmidir.

Prosessor. Tipik telefon JavaScript-i noutbukdan nəzərəçarpacaq dərəcədə yavaş icra edir, skriptlərin təhlili və icrası isə səhifə açılarkən görülən əsas işdir. Eyni skript telefona bir neçə dəfə baha başa gəlir.

Bağlantı. Mobil şəbəkə elan olunmuş sürət yaxşı olsa belə, böyük və gözlənilməz gecikmə verir. Serverə hər artıq sorğu naqilli bağlantıdakından daha baha başa gəlir.

İstilik və batareya. Yük altında telefon prosessorun tezliyini aşağı salır və yüklənmənin ikinci yarısı birincisindən yavaş gedir.

Ekran. Dar ekranda əsas şəkil bütün eni tutur və çox vaxt LCP-nin ölçdüyü həmin ən böyük element məhz o olur. Desktopda isə yeri şəkil ilə mətn bölüşür.

Və eyni məzmun. Bir çox sayt böyük ekrana göndərdiyi skriptlərin və şəkillərin tam eynisini telefona da göndərir.

Buna onu da əlavə edin ki, Google saytları ilk növbədə mobil versiyaya görə qiymətləndirir. Pis mobil nəticə elə sizin nəticənizdir.'],
            ['Bununla nə etməli — sıra ilə', 'Əvvəlcə bala yox, sahə məlumatlarına baxın. Mobil göstəricilərə, desktopa yox.

LCP qırmızıdırsa — əsas blokun görünməsini nəyin ləngitdiyini araşdırın: serverin cavabı, gec aşkarlanan şəkil, şrift.

INP qırmızıdırsa — artıq skriptləri və üçüncü tərəf vidjetlərini axtarın.

CLS qırmızıdırsa — bütün şəkillərin ölçülərini təyin edin və sonradan yüklənənlər üçün yer ayırın.

Və fərqin miqyasını yadda saxlayın. LCP-də 2 və 3 saniyə arasındakı fərq səhifənin yüklənməsi üzərində işdir. 2 və 8 saniyə arasındakı fərq isə adətən arxitekturadır: plaginlərlə doldurulmuş tema, ya da gah cavab verən, gah verməyən server.'],
        ],
        'end'      => 'Google-un nəzərində sürətli sayt ardıcıl verilən üç cavabdır. Əsas hissə tez göründü (LCP). Basanda səhifə ləngimədən cavab verdi (INP). Əlin altında heç nə sıçramadı (CLS). Bunlar sürətli noutbukdan aparılmış bir uğurlu ölçmə ilə deyil, real ziyarətçilər, mobil cihazlar və ziyarətlərin dörddə üçü üzrə yoxlanılır.

Saytınız üzrə hesabat qırmızıdırsa, səbəbi isə aydın deyilsə, bu, ayrıca işdir: sahə məlumatlarını oxumaq, problemi laboratoriyada təkrarlamaq, gecikmənin mənbəyini tapmaq və onu yaradan hissəni yenidən qurmaq. Mövcud saytların sürətinin təhlili və yeni saytların bu metrikalar nəzərə alınaraq yığılması MGuliyev Studio-nun məşğul olduğu işlərin bir hissəsidir.',
    ],
    'vertikalnoe-video-bezopasnaya-zona' => [
        'seoTitle' => 'Şaquli video 9:16: kadrda təhlükəsiz zona haradadır',
        'seoDesc'  => 'Platformanın başlığı və düymələri kadrın harasını örtür, üfüqi videonu kəsmək niyə nəticə vermir və altyazıları nə üçün birbaşa videoya yazmaq lazımdır.',
        'title'    => 'Şaquli video: interfeys nəyi örtür',
        'desc'     => '9:16 formatı: platformanın interfeysi kadrın harasını örtür, üfüqi videonu kəsmək niyə nəticə vermir və kadra yazılmış altyazılar nə üçün lazımdır.',
        'rubric'   => 'Rəqəmsal marketinq',
        'lead'     => 'Video hazırdır, monitorda hər şey yerindədir. Telefonda isə titrin yarısı hesabın adının altına düşüb, küncdəki loqonu «paylaş» düyməsi örtüb, qiymət isə — hər şey elə onun üçün çəkilmişdi — güclə oxunur. Kadr heç yerə itməyib: o, platformanın interfeysinin altında qalıb. Gəlin baxaq: şaquli kadrın hansı hissələri sizə məxsus deyil və bundan çəkiliş və montaj üçün hansı nəticələr çıxır.',
        'body'     => [
            ['Kadr bütöv görünür, amma hamısı sizin ixtiyarınızda deyil', 'Şaquli videoda tərəflərin nisbəti 9:16-dır, ölçüsü adətən 1080×1920 pikseldir. Video bütün ekrana açılır, tətbiqin elementləri isə onun üzərində göstərilir — fotoşəklin üstündəki şüşə kimi. Bu zaman eyni anda iki itki yaranır. İnterfeys kadrın bir hissəsini örtür. Müasir telefonun ekranı isə 9:16-dan hündürdür — onu tam doldurmaq üçün tətbiq kadrı böyüdür və onun sol və sağ kənarlarını kəsir. Ehtiyat yer təkcə düymələr üçün lazım deyil.

Yuxarıda başlıq yerləşir: lentin tabları, axtarış, onların üstündə isə saat və batareya səviyyəsi göstərilən sistem sətri. Aşağıda — hesabın adı, «daha çox» düyməli təsvir mətni, səs sətri və tətbiqin öz naviqasiya paneli. Sağda düymələrdən ibarət şaquli sütun yerləşir: bəyənmə, şərhlər, göndərmə, avatar.

Sizə kadrın bir az sola sürüşmüş ortası qalır. Üzü, məhsulu, altyazıları və onsuz videonun anlaşılmadığı hər şeyi məhz ora yerləşdirirlər. Buna ön kamera üçün kəsiyi və aşağıdakı jest zolağını da əlavə edin: onların ölçüləri müxtəlif telefon modellərində fərqlidir, ona görə də ehtiyat yer hər iki tərəfdə lazımdır.'],
            ['Təhlükəsiz zona: oriyentir və qeyd-şərt', 'Təhlükəsiz zona kadrın heç bir telefonda interfeysin örtmədiyi hissəsidir. Dəqiq ölçüləri platformalar öz təlimatlarında dərc edir, amma onlar tətbiqlərin yenilənməsi ilə birlikdə dəyişir: tablar yerini dəyişir, təsvir bloku hündürləşir, yeni düymələr peyda olur. Faizləri əzbərləməyin mənası yoxdur — oriyentiri yadda saxlayıb gözlə yoxlamaq daha faydalıdır.

Oriyentir belədir: video eyni anda bir neçə lentə gedəcəksə, kadrın yuxarı onda birini, aşağı dörddə birini və düymələr sütunu üçün sağ zolağı tutulmuş sayın — bu, demək olar ki, hər yerdə örtülən kəsişmə sahəsidir. Məna daşıyan hər şeyi — üzü, yazıları, loqonu, qiyməti, ünvanı — qalan düzbucaqlının içində saxlayın.

Yoxlama bir-iki dəqiqə çəkir. Videonu qaralamaya və ya qapalı hesaba yükləyin və telefonda baxın — mümkünsə, həm kiçik, həm də böyük telefonda. İkinci üsul: lentdə başqasının videosunun skrinşotunu çəkin və onu montajın üstünə yarımşəffaf qat kimi, maska olaraq qoyun. Bu, istənilən faizdən daha dəqiqdir — izləyicilərinizin gördüyü həmin interfeysi siz də görürsünüz.'],
            ['Üfüqi videonu kəsmək niyə çıxış yolu deyil', 'Əvvəlcə hesablama. 16:9 kadr götürüb ondan tam hündürlükdə şaquli kadr kəssəniz, enin təxminən 31%-i qalacaq. Adi Full HD 1920×1080-də bu, təxminən 608×1080 pikseldir. Belə fraqmenti 1080×1920-yə çatdırmaq üçün onu 1,8 dəfə dartıb böyütmək lazımdır — görüntü kəskinliyini itirir, xırda mətn və detallar bulanıqlaşır.

Kompozisiya isə hesabdan da çox zərər çəkir. Üfüqi kadrda məna en boyunca paylanıb: kadrda iki nəfər, kənarda məhsul, aşağı üçdə birdə qəhrəmanın titri. Şaquli kəsik iki nəfərdən birini saxlayacaq, məhsulu kəsib atacaq, titri isə düz platformanın təsviri göstərəcəyi yerə aparacaq. Üzlərə görə avtomatik kadrlama sakit planlarda kömək edir, amma montaj keçidlərində çərçivə sıçramağa başlayır.

Əgər yenə də üfüqi çəkmək lazımdırsa — deyək ki, eyni material sayta da yerləşdiriləcək, — 4K-da çəkin. 3840×2160 kadrdan şaquli kəsik 1215×2160 piksel verir: 1080×1920-yə qədər kiçildildikdən sonra kəskinlik ehtiyatı qalır. Bu, işlək kompromisdir, amma şaquli format üçün çəkilişi əvəz etmir.'],
            ['Kadra yazılmış altyazılar və platformanın altyazıları', 'Platformalar nitqi tanıyıb altyazıları özləri göstərə bilirlər. Amma bu altyazılar sizin nəzarətinizdə deyil: onların harada yerləşdiyinə və hansı şriftlə göstərildiyinə platforma qərar verir, izləyici onları söndürə bilər, videonu başqa sosial şəbəkəyə yenidən yükləyəndə isə onlar köçürülmür — orada nitq yenidən tanınır. Tanınmanın dəqiqliyi də sabit deyil: insan adları, şirkət adları və dillərin qarışdığı ifadələr adi nitqdən nəzərəçarpacaq dərəcədə pis tanınır.

Kadra yazılmış altyazılar montajda görüntünün özünə birdəfəlik yazılan mətndir. Şrifti, ölçünü və mövqeyi siz təyin edirsiniz, sətirləri təhlükəsiz zonanın içinə yerləşdirirsiniz və bilirsiniz ki, onlar hər yerdə eyni görünür. Lentə çox vaxt səssiz baxırlar — nəqliyyatda, görüşdə, axşam gec saatlarda — və kadra yazılmış sətir fikri çatdırmağın yeganə yolu olaraq qalır.

Bunun bədəli çevikliyin olmamasıdır: belə mətni videonu yenidən montaj etmədən nə söndürmək, nə də tərcümə etmək olar. Platforma öz altyazılarını sizinkilərin üstünə əlavə etsə, ekranda iki qat mətn olacaq, buna görə dərc edərkən avtomatik altyazıları belə parametr olan platformalarda söndürmək məqsədəuyğundur. Tərtibat üçün sadə qayda var: bir-iki sətir, iri hərflər, fonla yüksək kontrast.'],
            ['Birbaşa şaquli format üçün çəkəndə nə dəyişir', 'Məsələ kameranı çevirməkdə deyil. Dar və hündür kadr diqqəti başqa cür saxlayır: iri və orta planlar yaxşı seçilir, ümumi plan isə ovuc boyda ekranda xırda bir qarmaqarışıqlığa çevrilir. Qəhrəman adətən mərkəzdən bir az yuxarıda və oxdan bir qədər solda dayanır — aşağı hissə və sağ zolaq interfeysə qalsın deyə.

Şaquli kadrda fon, demək olar ki, görünmür: qəhrəmanın yanlarında yer qalmır. Deməli, qəhrəmanın düz arxasında nə olduğu vacibdir, çəkiliş məkanının uzaq künclərini isə hazırlamamaq da olar. Bunun əvəzinə səsin rolu artır: telefondan, çox vaxt yolda baxırlar və aydın eşidilən nitq səliqəli görüntüdən daha vacibdir.

Ayırdetmə qabiliyyəti üzrə ehtiyat hələ çəkiliş mərhələsində planlaşdırılır. Şaquli 4K formatında — 2160×3840 — çəkiliş sonradan dartmadan, 1080×1920 hüdudunda qalaraq kadrlamanı dəyişməyə, yaxınlaşdırmağa və ya üfüqü düzəltməyə imkan verir. Eyni zamanda örtük barədə də düşünün. Instagram profilindəki postlar şəbəkəsində önizləmə artıq əvvəlki kimi kvadrat deyil, şaquli — 3:4-dür. 9:16 kadrınız orada yuxarıdan və aşağıdan kəsiləcək, buna görə kadrda əsas olanı mərkəzə yaxın saxlayın.'],
            ['Dərcdən əvvəl qısa yoxlama', 'Hazır videoya monitorda yox, telefonda baxın və imkan olarsa, təkcə özünüzünkündə yox: öyrəşdiyiniz ekranda yad gözün dərhal sezəcəyi şeylər nəzərdən qaçır.

Siyahını bir-bir yoxlayın. Altyazılar tamamilə təhlükəsiz zonanın içindədir. Loqo və əlaqə məlumatları düymələrin altında deyil. Əsas yazı bəyənmə düyməsi olan sağ sütunun altına girmir. Birinci saniyə səssiz də anlaşılır. Fayl — 9:16, 1080×1920 və ya daha böyük, yuxarıda və aşağıda qara zolaqlar olmadan: onlar üfüqi kadrı sadəcə şaquli kətana yerləşdirəndə yaranır və platforma onları silmir — boş düzbucaqlıların üstünə yenə də interfeys düşəcək.'],
        ],
        'end'      => 'Şaquli format döndərilmiş üfüqi format deyil. Kadrın yuxarısını, aşağısını və sağ zolağını platformanın interfeysi tutur, video nəyin xatirinə çəkilibsə, hamısı isə ortada yerləşir. Qalanı da buradan irəli gəlir: kəsmək əvəzinə birbaşa 9:16 üçün çəkiliş, ayırdetmə qabiliyyəti üzrə ehtiyat, səssiz baxış üçün kadra yazılmış altyazılar və dərcdən əvvəl mütləq telefonda baxış.

Kadrlama, təhlükəsiz zonalar və altyazılarla məşğul olmağa vaxtınız yoxdursa, şaquli format üçün çəkilişi və montajı bütövlükdə həvalə edə bilərsiniz — MGuliyev Studio-da bu, sosial şəbəkələr üçün foto və video çəkiliş xidmətinin bir hissəsidir.',
    ],
];
