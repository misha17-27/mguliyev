<?php
/* Статьи блога: перевод (Azərbaycan dili).

   Накладка на app/data/articles.php: по адресу статьи — те же поля,
   что в оригинале. Перевод сделан с русского и сверен дважды: по
   смыслу (ни одного добавленного или потерянного факта, числа и
   записи DNS — дословно) и по языку. Нет статьи здесь — она
   показывается по-русски и на этом языке не индексируется. */

return [
    'korporativnyj-sajt-kakie-stranicy-nuzhny' => [
        'seoTitle' => 'Korporativ sayt: hansı səhifələr lazımdır və onlarda nə olur',
        'seoDesc'  => 'Şirkət üçün sayt: ana səhifə, xidmətlər, layihələr, şirkət haqqında, əlaqə, məxfilik siyasəti. Hər birində nə olur, nə dərhal lazımdır, nə gözləyə bilər.',
        'title'    => 'Korporativ sayta hansı səhifələr lazımdır və hər birində nə olmalıdır',
        'desc'     => 'Şirkətin saytı hansı səhifələrdən ibarətdir, nə olmadan saytı işə salmağa dəyməz, nə gözləyə bilər, menyu və müraciət forması necə qurulur və məzmuna kim cavabdehdir.',
        'rubric'   => 'Saytlar',
        'lead'     => 'Bakıda şirkət üçün sayt hazırlanması demək olar ki, həmişə podratçının sualı ilə başlayır: hansı bölmələr olacaq? Cavab olaraq çox vaxt rəqibin saytına link və ya on bəndlik siyahı göndərirlər — həm də bu bəndlərin yarısını dolduracaq heç nə yoxdur. Sonra menyuda yeganə yazısı olan «Xəbərlər» və bir dənə də vakansiyası olmayan «Vakansiyalar» qalır, müştərilər isə yenə də ünvanı dəqiqləşdirmək üçün zəng edir. Gəlin araşdıraq: korporativ sayta hansı səhifələr lazımdır, hər birində nə olmalıdır, nəyi dərhal işə salmaq lazımdır və nə gözləyə bilər.',
        'body'     => [
            ['Korporativ sayta hansı səhifələr lazımdır', 'Xidmət satan şirkət üçün əsas dəst demək olar ki, dəyişmir:

— ana səhifə;
— xidmətlər: ümumi siyahı və hər istiqamət üçün ayrıca səhifə;
— layihələr və ya iş nümunələri;
— şirkət haqqında;
— əlaqə;
— məxfilik siyasəti.

Bunlara texniki 404 səhifəsi əlavə olunur — onu işləməyən linklə gələn və ya ünvanı səhv yazan şəxs görür. Orada qısa izah və ana səhifəyə, xidmətlərə və əlaqə səhifəsinə linklər kifayətdir.

Ana səhifə, xidmətlər, əlaqə və məxfilik siyasəti olmadan saytı işə salmağa dəyməz. «Şirkət haqqında» səhifəsi qısa ola bilər, amma mütləq olmalıdır. Fotolar və təsvirlər hələ toplanmayıbsa, layihələri bir az sonra əlavə etmək olar: saytı bircə şəkildən ibarət bölmə ilə işə salmaqdansa, həmin bölmə olmadan işə salmaq yaxşıdır. Xəbərlər, bloq, vakansiyalar, suallar və cavablar onlar üçün material toplanana və bu bölmələrlə məşğul olacaq adam tapılana qədər gözləyə bilər. Boş bölmə ümumiyyətlə olmayan bölmədən pisdir: o, saytı heç kimin yeniləmədiyini göstərir.'],
            ['Ana səhifə və menyu: təqdimat yox, yol ayrıcı', 'Ana səhifəni müxtəlif məqsədləri olan insanlar açır. Biri nə ilə məşğul olduğunuzu anlamaq istəyir, digəri telefon nömrəsini axtarır, üçüncüsü tövsiyə ilə gəlib və şirkətin həqiqətən mövcud olub-olmadığını yoxlayır. Ona görə də ana səhifə missiya haqqında uzun hekayə yox, yol ayrıcıdır.

Birinci ekranda nə etdiyiniz, kimin üçün və harada etdiyiniz barədə bir cümlə olur: «dinamik inkişaf edən şirkət» yox, «Bakıda restoran və ofislər üçün ventilyasiya quraşdırılması». Yanında — telefon və əlaqə düyməsi. Aşağıda — xidmət səhifələrinə linkləri olan istiqamətlər, bir neçə layihə, şirkət haqqında qısa blok və əlaqə məlumatları.

Menyu saytın strukturunu təkrarlayır və bölmələri adi sözlərlə adlandırır: «Xidmətlər», «Layihələr», «Şirkət haqqında», «Əlaqə». Kompüterdə onu üç zolaqlı ikonun arxasında gizlətməyə dəyməz. Nielsen Norman Group-un 2016-cı il tədqiqatında istifadəçilər gizli menyuya görünən və ya qismən görünən menyudan daha az müraciət ediblər və müəlliflərin nəticəsinə görə, kompüterdə gizli naviqasiya telefondakından daha çox zərər verir. Şirkətin telefon nömrəsi hər səhifənin yuxarı hissəsində olur. Səhifənin aşağı hissəsində isə əsas linklər təkrarlanır, həmçinin əlaqə məlumatları, rekvizitlər və məxfilik siyasətinə link yerləşdirilir.'],
            ['Xidmətlər: bir səhifə — bir istiqamət', 'Bütün xidmətlər bir səhifədə siyahı şəklində toplanıbsa, insan uzun siyahıda öz sətrini axtarmalı olur. Axtarış sistemi isə bir xidmət barədə sorğuya bu ümumi siyahıdan başqa heç nə göstərə bilmir.

İşlək sxem belədir: bütün istiqamətlərin qısa təsviri ilə siyahı səhifəsi və oradan hər istiqamət üçün ayrıca səhifə. Həmin səhifədə işə nəyin daxil olduğu və nəyin daxil olmadığı, işin addım-addım necə getdiyi, müddət və qiymətin nədən asılı olduğu, müştəridən nə tələb olunduğu, bu xidmət üzrə nümunələr və əlaqə forması yer alır.

Səhifə ünvanlarını oxunaqlı edirlər: /page.php?id=17 əvəzinə /xidmetler/ventilyasiya-qurasdirilmasi/. Google axtarış optimallaşdırmasının (SEO) əsaslarına dair bələdçisində ünvana insanlar üçün faydalı sözlər daxil etməyi məsləhət görür: təsadüfi identifikatorlar toplusu ziyarətçiyə heç nə demir, ünvanın hissələri isə axtarış nəticələrində naviqasiya zənciri kimi göstərilə bilər.'],
            ['Layihələr və «Şirkət haqqında»: zəngdən əvvəl nəyi yoxlayırlar', 'Tanımadığı şirkətə zəng etməzdən əvvəl insan onun həqiqətən mövcud olduğuna və artıq oxşar işlər gördüyünə əmin olmaq istəyir. Qiymətləndiricilər — Google-un tapşırığı ilə axtarış nəticələrinin keyfiyyətini qiymətləndirən insanlar — üçün hazırlanmış təlimatda bu, açıq deyilir: sayta kimin cavabdeh olduğu aydın olmalıdır, əksər saytlarda isə sahib barədə məlumat «Haqqımızda» və «Əlaqə» səhifələrində yerləşir.

Layihə səhifəsində nə görüldüyü, kimin üçün, harada və nə vaxt görüldüyü göstərilir, real işin fotoları verilir. Ətraflı təsvir edilmiş bir neçə layihə izahsız qalereyadan daha inandırıcıdır. Müştərinin adını çəkməzdən və loqosunu göstərməzdən əvvəl ondan razılıq alın və müqaviləni yoxlayın: orada məxfilik barədə bənd ola bilər.

«Şirkət haqqında» səhifəsində tam hüquqi ad, təsis ili, nə ilə məşğul olduğunuz və harada yerləşdiyiniz, şirkətə kimin rəhbərlik etdiyi və orada kimlərin çalışdığı göstərilir: adlar, vəzifələr, real fotolar. Əməkdaşın adı və şəkli də fərdi məlumatdır, ona görə də dərc üçün razılığı hər birindən əvvəlcədən almaq daha yaxşıdır. Lisenziya və sertifikatları onları yoxlamağa imkan verən nömrələri ilə göstərirlər. Komanda fotoları əvəzinə stok şəkillər şirkət barədə heç nə demir.'],
            ['Əlaqə və müraciət forması', 'Əlaqə səhifəsində bunlar olmalıdır:

— oriyentir və xəritə ilə ünvan, biznes mərkəzindəki ofis üçün isə mərtəbə və ora necə çatmaq olar;
— telefon nömrələri tel: linkləri şəklində — mobil telefondan nömrəni bir toxunuşla yığmaq mümkün olsun deyə;
— wa.me/994XXXXXXXXX şəklində WhatsApp linki: nömrə beynəlxalq formatda, «+», boşluq, mötərizə, defis və operator kodundan əvvəlki sıfır olmadan;
— şirkətin domenində e-poçt ünvanı;
— iş saatları;
— rekvizitlər: hüquqi ad və VÖEN.

Formanı qısa edirlər: ad, telefon, şərh. Hər artıq sahə onu doldurmamaq üçün daha bir səbəbdir. Sahənin adı görünən qalmalıdır: Nielsen Norman Group sahənin içində yerləşən və yazmağa başlayanda yox olan ipucunun daxil edilmiş məlumatı yoxlamağa və düzəltməyə niyə mane olduğunu ətraflı izah edir. Telefon sahəsi type="tel" kimi işarələnir — mobil brauzerlər adətən onun üçün nömrə yığma klaviaturasını göstərir. Ad və telefon sahələrinə name və tel dəyərləri ilə autocomplete atributu verilir: brauzer məlumatları özü doldura biləcək, WCAG 2.2 əlçatanlıq standartının 1.3.5 meyarı isə belə sahələrin təyinatının proqram vasitəsilə müəyyən edilə bilməsini tələb edir.

Göndərdikdən sonra insan müraciətin qəbul olunduğunu və onunla nə vaxt əlaqə saxlanılacağını görməlidir. Müraciətləri bir nəfərin şəxsi poçt qutusuna deyil, əməkdaş məzuniyyətdə olanda da görüləcəyi yerə yönəltmək məqsədəuyğundur. Saytdan gələn məktubların spama düşməməsi üçün domendə SPF, DKIM və DMARC tənzimlənməlidir — onlar barədə ayrıca məqalə var. Saytın hər yenilənməsindən sonra isə formanı test müraciəti ilə yoxlayırlar: işləməyən forma bunu özü xəbər verməyəcək.'],
            ['Məxfilik siyasəti — hətta bircə forma olsa belə', 'Ad və telefon soruşan müraciət forması artıq fərdi məlumatların toplanması deməkdir. Azərbaycanda bu, 11 may 2010-cu il tarixli 998-IIIQ nömrəli «Fərdi məlumatlar haqqında» Qanunla tənzimlənir. Qanun fərdi məlumat dedikdə şəxsin kimliyini birbaşa və ya dolayısı ilə müəyyən etməyə imkan verən istənilən məlumatı nəzərdə tutur — müraciətdəki ad və telefon nömrəsi bu tərifə uyğun gəlir.

Qanunun 8-ci maddəsi məlumatların toplanmasına və emalına razılığa həsr olunub. Yazılı razılıqda göstərilənlər sırasında maddə məlumatları kimin topladığını, hansı məqsədlə, məhz hansı məlumatların toplandığını və onlarla nə edildiyini, razılığın qüvvədə olma müddətini və onun geri götürülməsi şərtlərini sadalayır. 2024-cü ildə əlavə edilmiş 8.6-cı bənddə nəzərdə tutulur ki, qanunda göstərilən istisnalar nəzərə alınmaqla, razılıq Elektron Hökumət İnformasiya Sistemi vasitəsilə mərkəzləşdirilmiş qaydada alınır və geri götürülür. Bütün bunların saytdakı formaya necə tətbiq ediləcəyinə tərtibatçı yox, hüquqşünas qərar verir. Saytın vəzifəsi — siyasətin mətni üçün səhifə və hər formanın yanında, eləcə də səhifənin aşağı hissəsində ona link.

Servislərin də öz tələbləri var. Google Analytics-in istifadə şərtləri sayt sahibindən məxfilik siyasəti dərc etməyi və orada cookie fayllarından istifadə barədə məlumat verməyi tələb edir. Xəritələr, onlayn çatlar və reklam pikselləri də ziyarətçilərin məlumatlarını alır və hər servisin öz şərtləri var. Sayta qoşulan hər şeyin siyahısını əvvəlcədən tərtib etmək daha yaxşıdır: hüquqşünas siyasəti məhz həmin siyahıya əsasən yazır.'],
            ['Saytı kim məzmunla doldurur', 'Korporativ saytın hazırlanmasında iş iki hissəyə bölünür. Tərtibatçı struktura, səhifə şablonlarına və onların rahat redaktə edilməsinə cavabdehdir. Faktları isə yalnız şirkət bilir: xidmətlərin siyahısı və hər birinin hüdudları, real layihələr, əməkdaşların adları, rekvizitlər, lisenziya nömrələri. Mətnləri kopirayter yaza bilər, amma onları həmin xidmətlərə görə müştərilər qarşısında cavab verən şəxs yoxlamalıdır.

Mətn və fotolar olmadan səhifə maketi hələ sayt deyil, ona görə də materialları dizaynla paralel toplamaq rahatdır, ondan sonra yox. Sadə cədvəl kömək edir: bütün səhifələr, hər birinə cavabdeh şəxs və status — mətn, foto, razılaşdırılıb. Saytı işə salmazdan əvvəl hər səhifəni açıb sonadək oxuyurlar ki, işləyən sayta müvəqqəti «yer tutucu» mətn düşməsin.

Saytı işə saldıqdan sonra əməkdaşlardan kimin onu idarə edəcəyi ayrıca həll edilir: layihələr əlavə etmək, telefonları dəyişmək, köhnəlmiş xidmətləri silmək. İdarəetmə panelinin, domenin və hostinqin login və parolları təkcə podratçıda deyil, şirkətin özündə saxlanılır.'],
        ],
        'end'      => 'Korporativ sayt bir neçə səhifəyə söykənir və onların hər biri ziyarətçinin bir sualına cavab verir: siz kimsiniz, nə edirsiniz, artıq nə etmisiniz, sizinlə necə əlaqə saxlamaq olar və ziyarətçinin məlumatları ilə nə olacaq. Qalanı material və onunla məşğul olacaq adam tapıldıqca əlavə olunur. Öz saytınızı yoxlamaq asandır: onu telefondan açın və lazımi xidməti, ünvanı və bir toxunuşla zəng edə biləcəyiniz nömrəni tapmağa çalışın.',
    ],
    'internet-magazin-chto-nuzhno-do-zapuska' => [
        'seoTitle' => 'İnternet mağaza yaratmaq: işə salınana qədər nə hazırlamalı',
        'seoDesc'  => 'Kataloq, foto, qiymət və qalıqlar, sifarişin rəsmiləşdirilməsi, kartla ödəniş, çatdırılma, məktublar və qaytarma: onlayn mağaza açılana qədər nəyi yoxlamalı.',
        'title'    => 'İnternet mağaza yaratmaq: ilk sifarişə qədər nə hazır olmalıdır',
        'desc'     => 'Kataloq və məhsul məlumatları, fotolar, anbar qalıqları, sifarişin rəsmiləşdirilməsi, bank vasitəsilə ödəniş, çatdırılma, sifariş məktubları və qaytarma qaydaları — işə salmazdan əvvəl nəyi yoxlamalı.',
        'rubric'   => 'Saytlar',
        'lead'     => 'Dizayn təsdiqlənib, ana səhifə hazırdır, amma saytın açılışı artıq üçüncü həftədir ki, təxirə salınır. Məhsulların yarısının fotosu yoxdur, qiymətlər mühasibin cədvəlində qalır, bank qaytarma şərtləri yazılmış səhifə istəyir, şənbə günü sifarişləri kimin qəbul edəcəyinə isə hələ heç kim qərar verməyib. İnternet mağazanın hazırlanması çox vaxt koda deyil, onun ətrafındakı məlumatlara və proseslərə ilişib qalır. Gəlin baxaq: ilk sifarişə qədər nə hazır olmalıdır və hər bəndi özünüz necə yoxlaya bilərsiniz.',
        'body'     => [
            ['Kataloq: internet mağazanın yaradılması nədən başlayır', 'Kataloqu məhsulların anbarda necə düzüldüyünə görə deyil, alıcının necə axtardığına görə qururlar. «Mətbəx → Tavalar» yolu alıcı üçün təchizatçının adını daşıyan bölmədən daha anlaşıqlıdır. Hər məhsulun bir əsas kateqoriyası olur; onu başqa yerdə də göstərmək lazımdırsa, bunu məhsul kartının surəti ilə deyil, seçmə və ya link vasitəsilə edirlər.

Məhsullar barədə məlumatları işə başlamazdan əvvəl bir cədvəldə toplamaq rahatdır — sonra onu mağazaya idxal yolu ilə yükləyirlər. Hər məhsul üçün eyni sahələr toplusu lazımdır:
— məhsulun tanındığı ad;
— artikul — saytın anbar uçotu ilə tutuşdurulduğu daxili kod;
— qiymət;
— filtrlər üçün xüsusiyyətlər: ölçü, rəng, material, güc;
— çatdırılmanın qiyməti onlardan asılıdırsa, çəki və qabarit ölçüləri;
— istehsalçı təyin edibsə, GTIN ştrix-kodu.

Filtrlərin bir texniki incəliyi var: onların hər kombinasiyası ayrıca səhifə ünvanı yarada bilər və belə ünvanların sayı tez bir zamanda çox artır. Google tərtibatçılar üçün sənədlərində iki yol təsvir edir. Filtrlənmiş səhifələr axtarışda lazım deyilsə, robots.txt faylında onların skan edilməsini bağlayırlar. Lazımdırsa — parametrləri & işarəsi ilə ayırır, filtrləri ünvanda sabit ardıcıllıqla saxlayır, içində bircə məhsul olmayan kombinasiyalar üçün isə server 404 xətası qaytarır.'],
            ['Fotolar: bütün kataloq üçün vahid standart', 'Çəkilişə hər şeydən əvvəl başlamağa dəyər: məhsul kartları, bannerlər və reklam ondan asılıdır. Təkcə kəskinlik deyil, eynilik də vacibdir: eyni fon, kadrın eyni nisbətləri, oxşar rakurs. Bir tavanın ağ fonda, yanındakının isə mətbəx masasının üstündə çəkildiyi kataloq elanlar lövhəsinə bənzəyir.

Məhsulları Google Shopping-də göstərmək planlaşdırılırsa, Merchant Center tələblərini əvvəlcədən yoxlayın. Google elan edib ki, 31 yanvar 2027-ci il tarixindən istənilən məhsulun şəkli ən azı 500 × 500 piksel olmalıdır, tövsiyə olunan ölçü isə 1500 × 1500 və daha böyükdür. Əsas şəkildə su nişanları, çərçivələr və «Satın al» çağırışı kimi reklam yazıları olmamalıdır. «Foto tezliklə» və ya «Şəkil yoxdur» kimi yer tutucular da qəbul edilmir.

Orijinalları tam ölçüdə saxlayın, sayta isə sıxılmış versiyaları verin: ağır şəkillər səhifələrin yüklənməsini yavaşladır. Google-un saytın sürətini necə qiymətləndirdiyi barədə bloqda ayrıca məqalə var.'],
            ['Qiymətlər və qalıqlar: sayt rəqəmləri haradan götürür', 'Əsas sual qiymət və məhsulun mövcudluğu barədə doğru məlumatın harada saxlanmasıdır. Uçot proqramında bir rəqəm, saytda isə başqa rəqəm varsa, mağaza artıq olmayan məhsulu artıq qüvvədə olmayan qiymətə satır.

Variantlar adətən belədir:
— qiymətlər və qalıqlar birbaşa saytın panelində aparılır — anbar kiçikdirsə və yalnız sayt satırsa, uyğundur;
— sayt müəyyən qrafik üzrə uçot sistemindən ixrac edilmiş məlumatları götürür — fayl şəklində və ya API vasitəsilə;
— uçot sistemi hər satışdan sonra dəyişiklikləri sayta özü göndərir.

Bir anbarın satış kanalları nə qədər çoxdursa — mağaza, sosial şəbəkələr, sayt, — onların nə qədər tez-tez məlumat mübadiləsi etməsi bir o qədər vacibdir. Saytın stokda olmayan məhsulla nə edəcəyini də əvvəlcədən həll edin: onu gizlədir, «Stokda yoxdur» qeydi ilə göstərir, yoxsa ön sifariş qəbul edir.

Ayrıca hal — qiyməti olmayan məhsullar. «Qiymət sorğu ilə» yazısı insanlara aydındır, amma Google axtarışında məhsul nəticələri üçün səhifənin nişanlanmasında sıfırdan böyük qiymət, valyuta isə ISO 4217 standartı üzrə üç hərfli kodla göstərilməlidir. Manat üçün bu, AZN-dir.'],
            ['Səbət, sifarişin rəsmiləşdirilməsi və çatdırılma', 'İnternet mağazaların istifadə rahatlığını araşdıran Baymard Institute ABŞ-dakı alıcılar arasında sifarişin rəsmiləşdirilməsini niyə yarımçıq qoyduqları barədə sorğu dərc edir. Ən çox rast gəlinən səbəb həddən artıq yüksək əlavə xərclərdir: çatdırılma, vergilər, rüsumlar. Digər səbəblər sırasında ləng çatdırılma, kart məlumatlarını daxil edərkən sayta etibar etməmək, hesab yaratmaq tələbi, çox uzun rəsmiləşdirmə və əlverişsiz qaytarma şərtləri var.

Buradan praktik minimum çıxır:
— sifarişi qeydiyyatdan keçmədən rəsmiləşdirmək olur, hesab yaratmaq isə alışdan sonra təklif edilir;
— çatdırılmanın qiyməti son addımdan əvvəl görünür, yekun məbləğdə sürpriz kimi peyda olmur;
— formada yalnız lazımi sahələr var: ad, telefon, ünvan, çatdırılma və ödəniş üsulu;
— göndərdikdən sonra insan sifarişin nömrəsini və aydın növbəti addımı görür.

Çatdırılmanı konkret qaydalarla təsvir edirlər: hansı rayonlar və şəhərlər, hər zonanın qiyməti nə qədərdir, alıcının sifarişi özünün götürməsi mümkündürmü, axşam və ya istirahət günü verilən sifariş nə vaxt gətiriləcək. Çatdırılmanın qiyməti çəkidən asılıdırsa, çəki hər məhsul kartında olmalıdır, əks halda sayt onu hesablaya bilməyəcək. Sifarişin rəsmiləşdirilməsini təkcə noutbukdan deyil, telefondan da keçin: siçanla asanlıqla doldurulan sahə kiçik ekranda klaviaturanın altında gizlənə bilər.'],
            ['Ekvayer bank vasitəsilə onlayn ödəniş', 'Saytda kartla ödəniş qəbul etmək üçün ekvayer bankla müqavilə lazımdır. Bankla danışıqlara sayt hazırlanıb qurtarandan sonra deyil, hazırlanma ilə paralel başlamaq məqsədəuyğundur: qoşulmanın öz sənədləri, yoxlamaları və müddətləri var.

Ödəniş çox vaxt belə qurulur: alıcı bankın ödəniş səhifəsinə keçir və ya onu daxili pəncərədə görür, kart məlumatlarını orada daxil edir, sayt isə yalnız nəticəni alır. Belə sxem üçün ödəniş kartlarının təhlükəsizlik standartı PCI DSS sadələşdirilmiş özünüqiymətləndirmə anketi olan SAQ A-nı nəzərdə tutur. Şərt budur: ödəniş səhifəsi bütövlükdə PCI DSS-ə uyğunluğunu təsdiqləmiş provayderdən gəlməlidir; onun heç olmasa bir elementini sizin saytınız verirsə, bu variant uyğun deyil. Daxili pəncərə istifadə olunduqda isə mağaza əlavə olaraq saytının skriptlər vasitəsilə hücumlardan qorunduğunu təsdiqləyir. Ödənişin SMS-dəki kodla və ya bank tətbiqində təsdiqlənməsi, bir qayda olaraq, 3-D Secure-dur: alıcını mağaza deyil, kartı buraxmış bank yoxlayır.

Tərtibatçıdan dəqiqləşdirməyə dəyən iki məqam:
— sifarişin statusu alıcının «Təşəkkür edirik» səhifəsinə qayıtmasına görə deyil, ödəniş sisteminin mağazanın serverinə göndərdiyi bildirişə görə dəyişir: insan ödəniş edib səhifəyə keçməzdən əvvəl bağlantını itirə bilər;
— eyni ödəniş barədə təkrar bildiriş ikinci sifariş yaratmır və məhsulu anbardan iki dəfə silmir.

İşə salmazdan əvvəl, bankın test rejimi varsa, sifarişi bu rejimdə sınaqdan keçirin, sonra isə bir real alış edin və onun məbləğini tam geri qaytarın.'],
            ['Bildirişlər və əməkdaşlar üçün giriş hüquqları', 'İşə salmazdan əvvəl hansı mesajların kimə göndəriləcəyini yazıb müəyyənləşdirin:
— alıcıya: sifarişin nömrəsi və tərkibi ilə təsdiq, statusun dəyişməsi, kuryerə təhvil;
— menecerə: yeni sifariş və daxil olan ödəniş, üstəlik, istirahət günlərində də izlənilən kanala;
— anbara və ya kuryerə: nəyi yığmaq və hara aparmaq lazımdır.

Məktublar mağazanın domenindəki ünvandan getməlidir, domendə isə SPF, DKIM və DMARC tənzimlənməlidir — əks halda sifariş təsdiqləri spama düşə bilər. Bu yazılar barədə ətraflı — bloqdakı ayrıca məqalədə.

İdarə panelində hər əməkdaşın öz hesabı və yalnız ona lazım olan hüquqları olur: menecer sifarişlərin statusunu dəyişir, kontent-menecer məhsul kartlarını redaktə edir, tam giriş isə bir-iki nəfərdədir. Hamı üçün ümumi login olanda qiyməti kimin dəyişdiyini anlamaq olmur, işdən çıxmış əməkdaşın girişini isə qalanların parolunu dəyişmədən bağlamaq mümkün olmur. Veb-tətbiqlərin əsas risklərinin siyahısı olan OWASP Top 10:2025 minimal imtiyazlar prinsipinin pozulmasını girişə nəzarətdəki tipik səhv adlandırır — bu kateqoriya siyahıda birinci yerdədir. Platforma iki faktorlu autentifikasiyanı dəstəkləyirsə, onu aktivləşdirin.'],
            ['Qaytarma qaydaları, məxfilik və əlaqə məlumatları', 'Bu səhifələri çox vaxt son gün yazırlar, halbuki həm tərəddüd edən alıcıların qərarları, həm də ödəniş sistemlərinin tələbləri onlardan asılıdır. Məsələn, Visa qaydaları tələb edir ki, internet mağazanın saytında dəstək xidmətinin əlaqə vasitəsi (e-poçt və ya telefon), alıcı ilə yazışma üçün ünvan və satıcının ölkəsi göstərilsin. Ölkəni birbaşa sifarişin rəsmiləşdirilməsi zamanı göstərirlər — bunun üçün ayrıca səhifəyə link kifayət etmir. Mağaza qaytarmanı məhdudlaşdırırsa, şərtlər alışın son təsdiqindən əvvəl açıqlanmalı və alıcının razılığı alınmalıdır — qutuya işarə qoymaqla və ya düymə ilə. Qaydalar səhifəsinə link də yolveriləndir, bir şərtlə ki, bu razılığın tərkibinə daxil olsun.

Minimal dəst:
— ödəniş və çatdırılma şərtləri;
— qaytarma və dəyişdirmə qaydaları: müddətlər, məhsulun vəziyyəti, geri göndərmənin xərcini kim ödəyir, pul karta necə qaytarılır;
— məxfilik siyasəti: hansı məlumatları toplayırsınız, nə üçün və kimə ötürürsünüz — məsələn, kuryer xidmətinə;
— satıcının rekvizitləri və əlaqə məlumatları.

Məcburi bəndləri istehlakçı hüquqlarının müdafiəsi və fərdi məlumatlar haqqında yerli qanunvericilik müəyyən edir, ona görə də mətnləri başqasının saytından köçürmək deyil, hüquqşünasla razılaşdırmaq lazımdır.'],
        ],
        'end'      => 'Kod işə salınmanın ən çox proqnozlaşdırıla bilən hissəsidir. İnternet mağazanı açar təhvil sifariş etsəniz belə, məhsul məlumatları, qiymətlər, bankla müqavilə və qaytarma qaydaları sizin üzərinizdə qalır. Bakıda internet mağazanın hazırlanmasına yenicə başlayırsınızsa, məhsul cədvəlindən və bankla danışıqdan başlayın, işə salmazdan əvvəl isə test sifarişini özünüz keçin — məhsul kartından təsdiq məktubuna qədər.',
    ],
    'lending-ili-mnogostranichnyj-sajt' => [
        'seoTitle' => 'Lendinq və ya sayt: xidmət biznesi üçün hansını seçməli',
        'seoDesc'  => 'Birsəhifəli sayt (landing page) nə vaxt kifayətdir, hər xidmətə nə vaxt ayrı səhifə lazımdır. Xidmət saytında səhifə, müraciət forması və əlaqə necə qurulur.',
        'title'    => 'Lendinq və ya sayt: xidmət satırsınızsa, hansını seçməli',
        'desc'     => 'Birsəhifəli sayt bir təklif və reklam üçün uyğundur, amma bir neçə xidmət üzrə axtarışda zəif işləyir. Hansını nə vaxt seçmək lazım olduğunu və xidmət səhifəsinin necə qurulduğunu araşdırırıq.',
        'rubric'   => 'Saytlar',
        'lead'     => 'Bir neçə xidmət göstərirsiniz — deyək ki, kondisionerlərin quraşdırılması, təmiri və təmizlənməsi. Bir tanışınız lendinq hazırlatmağı məsləhət görür, digəri isə bölmələri olan tam dəyərli sayt lazım olduğunu deyir. Əslində «lendinq, yoxsa sayt» seçimi zövqdən və ekranların sayından deyil, insanların sizə haradan gələcəyindən asılıdır: reklam linki ilə, yoxsa axtarışdan. Gəlin görək, bir səhifə nə vaxt kifayət edir, hər xidmətə nə vaxt ayrıca səhifə lazımdır, xidmət səhifəsinin özü, müraciət forması və əlaqə vasitələri isə necə qurulmalıdır.',
        'body'     => [
            ['Lendinq çoxsəhifəli saytdan nə ilə fərqlənir', 'Lendinq — başqa sözlə landing page və ya birsəhifəli sayt — bir təklifə və bir hərəkətə həsr olunmuş tək səhifədir: zəng etmək, yazmaq, müraciət göndərmək. Lendinqdə menyu varsa, onun bəndləri yeni səhifələr açmır, elə həmin səhifəni sürüşdürür.

Çoxsəhifəli sayt başqa cür qurulub: hər xidmətin öz ünvanı var, məsələn, saytiniz.az/xidmetler/qurasdirma/ və saytiniz.az/xidmetler/temir/. Ana səhifə bölmələrə aparır, axtarışdan və ya reklamdan gələn adam isə çox vaxt ana səhifədən yan keçərək birbaşa lazım olan xidmətin səhifəsinə düşür.

Qarışıqlığı reklam da artırır. Google Ads-də elanın apardığı istənilən səhifəyə hədəf səhifə və ya landing page deyilir: onun ünvanı elanda son URL kimi göstərilir. Bu, ayrıca lendinq də ola bilər, adi saytdakı xidmət səhifəsi də.

Beləliklə, əsas fərq uzunluqda və ya dizaynda deyil, ünvanların sayındadır: birsəhifəli saytın bir ünvanı olur, çoxsəhifəli saytın isə hər xidmət üçün bir ünvanı. Qalan demək olar ki, hər şey bundan asılıdır.'],
            ['Birsəhifəli sayt nə vaxt kifayət edir', 'Təklif tək olanda və insan onu özü tapmayıb, ona yönləndirildikdə bir səhifə yaxşı işləyir. Tipik hallar:
— tək bir xidmət göstərirsiniz və ya bir məhsulu irəlilədirsiniz;
— ziyarətçilər link vasitəsilə gəlir: reklamdan, Instagram-dan, e-poçt göndərişindən, vərəqədəki QR-koddan;
— tam dəyərli sayt qurmazdan əvvəl yeni istiqamətə tələbatı tez yoxlamaq lazımdır;
— təklifin müddəti var: aksiya, kursa qəbul, tədbir.

Reklam üçün səhifənin elanla üst-üstə düşməsi vacibdir. Google Ads-in açar sözlərə verdiyi keyfiyyət göstəricisinin üç komponentindən biri hədəf səhifənin keyfiyyətidir: səhifə elana klikləyənlər üçün nə dərəcədə relevant və faydalıdır. Bir xidmətə həsr olunmuş lendinq insana məhz klikləyərkən axtardığı şeyi göstərir.

Çətinliklər xidmət bir neçə olanda başlayır. Quraşdırma, təmir və təmizlik haqqında elanlar eyni ilk ekrana aparır və insan lazım olan bloku özü axtarmalı olur.'],
            ['Lendinq və ya sayt: axtarış bunu necə görür', 'Axtarış sistemi nəticələrdə saytları deyil, ayrı-ayrı səhifələri göstərir və hər nəticənin öz başlığı olur. Google-un bu başlığı tərtib edərkən istifadə etdiyi mənbələrdən biri səhifənin title teqidir. Google hər səhifəyə məhz onun məzmununu təsvir edən, təkrarlanan mətni olmayan ayrıca title verməyi tövsiyə edir. Birsəhifəli saytda isə title birdir və hər şeyi birdən təsvir etməli olur.

Lövbər linkləri bu problemi həll etmir. Məsələn, saytiniz.az/#temir ünvanı elə həmin səhifədir: Google-un sözlərinə görə, axtarış bir qayda olaraq URL fraqmentlərini, yəni ünvanın # işarəsindən sonrakı hissəsini dəstəkləmir. «Təmir» bloku bundan indeksdə ayrıca səhifəyə çevrilməyəcək.

İnsanlar isə konkret axtarır: «kondisioner təmizlənməsi», «kondisionerin evdə təmiri», «split sistemin quraşdırılması». Hər sorğunun arxasında öz sualları dayanır. Hər şeydən bir az danışan səhifə nəticələrdə bütövlükdə həmin mövzuya həsr olunmuş səhifələrlə rəqabət aparmalı olacaq. Buradan sadə qayda çıxır: müştərilər sizi axtarışda müxtəlif xidmətlər üzrə tapırsa, hər xidmətə ayrıca səhifə lazımdır.'],
            ['Xidmət saytı: bir səhifə — bir xidmət', 'Xidmət saytının strukturu adətən üç səviyyəyə sığır: ana səhifə, siyahısı olan «Xidmətlər» bölməsi və ayrı-ayrı xidmətlərin səhifələri. Hər səhifə bir əsas sorğuya və onun yaxın ifadələrinə cavab verir: «kondisioner quraşdırılması» və «split sistemin montajı» — bir səhifə, təmir — başqa səhifə.

Ünvanları rəqəmlərdən yox, sözlərdən qurmaq daha yaxşıdır: saytiniz.az/xidmetler/kondisioner-qurasdirilmasi/ həm insana, həm də axtarış sisteminə aydındır. Google da məhz bunu tövsiyə edir: uzun identifikatorlar əvəzinə oxunaqlı sözlər, sözlər arasında isə alt xətt deyil, defis.

Həmin səhifələr reklam üçün də yararlıdır. Son URL hər elanda göstərilir, ona görə də təmir haqqında elanları təmir səhifəsinə, quraşdırma haqqında elanları isə quraşdırma səhifəsinə yönləndirmək olar. Bunun üçün hər kampaniyaya ayrıca lendinq lazım deyil.

Keçməyə dəyməyən bir sərhəd də var. Google-un spam qaydaları oxşar sorğular üçün yaradılmış səhifələri dorvey adlandırır. Nümunələr arasında eyni yerə aparan ayrı-ayrı şəhərlər və ya regionlar üçün səhifələr, eləcə də aydın sayt strukturu əvəzinə demək olar ki, eyni olan səhifələr var. Eyni mətnli «Kondisioner təmiri Yasamalda», «…Nəsimidə» səhifələri bu təsvirə yaxındır. Xidmətin öz məzmunu olanda — proses, suallar, qiymət — ona ayrıca səhifə ayırmaq özünü doğruldur.'],
            ['Xidmət səhifəsi nədən ibarətdir', 'Yaxşı xidmət səhifəsi sualları insanda yarandığı ardıcıllıqla cavablandırır. Blokların tərkibi adətən belədir:
— xidməti insanların onu axtardığı sözlərlə adlandıran və işlədiyiniz yeri göstərən başlıq;
— ilk ekran: nə edirsiniz, kimin üçün və sürüşdürmədən görünən əlaqə düyməsi;
— xidmətə nələr daxildir və nələr daxil deyil;
— iş necə gedir: müraciətdən nəticəyə qədər addımlar;
— qiymət və ya onun nədən asılı olduğu;
— məhz bu xidmət üzrə görülmüş işlərin nümunələri;
— tez-tez verilən suallara cavablar;
— əlaqə məlumatları və müraciət forması, onların altında isə qonşu xidmətlərə linklər.

Telefonda səhifə uzun lentə çevrilir, ona görə də zəng və ya mesaj düyməsini ekranın aşağısına bərkitmək məntiqlidir: belə olduqda o, sürüşdürmənin istənilən dərinliyində görünür. Hər blokun da öz vəzifəsi olmalıdır: bloklar bir-birini təkrarlayırsa, səhifə sadəcə uzanır.'],
            ['Müraciət forması: hansı sahələr həqiqətən lazımdır', 'Xidmətə müraciət üçün adətən iki sahə kifayətdir: ad və telefon. Hər növbəti sahə insanın elə indi cavab verməli olduğu daha bir sualdır. Ünvanı, texnikanın modelini, rahat vaxtı söhbət zamanı dəqiqləşdirmək daha asandır.

Özünüzün asanlıqla yoxlaya biləcəyiniz texniki detallar:
— telefon sahəsinə tel tipi lazımdır: bu tip üçün mobil brauzer nömrə yığmaq üçün klaviatura göstərə bilər;
— name, tel və email dəyərləri olan autocomplete atributu brauzerə yadda saxlanmış hansı məlumatları daxil etməli olduğunu bildirir;
— tel tipi nömrənin formatını yoxlamır, ona görə də yoxlama serverdə aparılmalıdır və o, nömrəni həm +994, həm də 0 ilə başlayan, boşluqlu və boşluqsuz şəkildə qəbul etməlidir;
— hər sahənin görünən etiketi olmalıdır və sahənin içindəki boz mətn onu əvəz etmir: W3C-nin qeyd etdiyi kimi, insan yazmağa başlayan kimi bu mətn yox olur, ekran oxuyan proqramlar isə onu etiket saymır.

Göndərdikdən sonra insan müraciətin çatdığını və bundan sonra nə olacağını görməlidir — məsələn, ona nə vaxt geri zəng ediləcəyini. Siz isə müraciəti mütləq görəcəyiniz yerə almalısınız: poçta və dublikat olaraq messencerə və ya CRM-ə. Formanı startdan sonra və saytdakı hər düzəlişdən sonra yoxlayın. Müraciətlər məktubla gəlirsə, domenin poçtu isə tənzimlənməyibsə, onların spama düşmək riski var — SPF, DKIM və DMARC haqqında bloqda ayrıca məqalə var.'],
            ['Telefon, WhatsApp və digər əlaqə üsulları', 'Forma hər kəsə uyğun gəlmir: kimsə elə indi zəng etmək istəyir, kimsə yazıb cavabı sonra almaq. Ona görə də formanın yanında qısa yollar lazımdır.

Telefon nömrəsi tel:+99412XXXXXXX şəklində link kimi tərtib olunur — smartfonda ona bir toxunuş bu nömrəyə zəng etməyi təklif edir. Belə linkdə nömrə əvvəlində plus olan beynəlxalq formatda yazılır. Oxunaqlılıq üçün standart defislərə, nöqtələrə və mötərizələrə icazə verir, boşluqlara isə yox.

WhatsApp üçün wa.me/nömrə şəklində link var. Nömrə tam şəkildə beynəlxalq formatda göstərilir, lakin plus, əvvəldəki sıfırlar, mötərizələr və defislər olmadan: 050 XXX XX XX nömrəsi wa.me/99450XXXXXXX olur. Linkə URL üçün kodlaşdırılmış hazır mesaj mətni ilə ?text= parametrini əlavə etmək olar — məsələn, xidmətin adı ilə. Bu mətn çatın yazı sahəsində görünəcək, insan onu özü göndərəcək və əgər silməsə, onun hansı səhifədən gəldiyini dərhal anlayacaqsınız.

Müştərilər sizin yanınıza gəlirsə, ünvanı, xəritəni və iş saatlarını əlavə edin. Yalnız həqiqətən cavab verdiyiniz kanalları göstərin: mesajların həftələrlə oxunmamış qaldığı messencerə link heç olmamasından da pisdir.'],
        ],
        'end'      => 'Lendinqlə sayt arasında seçimi büdcə və ya dəb deyil, müştərilərin mənbəyi müəyyən edir. Bir təklif və linklərdən gələn trafik — bir səhifə kifayətdir; bir neçə xidmət və axtarış — hər birinə öz ünvanı və başlığı olan ayrıca səhifə lazımdır. Bunlardan hansında olursa olsun, insan nə ilə məşğul olduğunuzu dərhal anlamalı və sizinlə özünə rahat olan yolla əlaqə saxlamalıdır: zənglə, mesajla və ya qısa forma vasitəsilə.',
    ],
    'mnogoyazychnyj-sajt-az-ru-en' => [
        'seoTitle' => 'Çoxdilli sayt: az, ru və en versiyaları necə qurulur',
        'seoDesc'  => 'Azərbaycan, rus və ingilis dillərində sayt: ünvanlar, hreflang, dil dəyişdiricisi, title tərcüməsi, şriftlərdə və URL-də ə, ğ hərfləri.',
        'title'    => 'Çoxdilli sayt: Azərbaycan, rus və ingilis dillərində versiyalar necə qurulur',
        'desc'     => 'Üç dildə sayt necə qurulmalıdır ki, Google lazımi versiyanı göstərsin, ziyarətçi isə çaşıb qalmasın: ünvanlar, hreflang, dil dəyişdiricisi, tərcümə və Azərbaycan hərfləri.',
        'rubric'   => 'Saytlar',
        'lead'     => 'Öz saytınızda xidmət səhifəsini rus dilində oxuyursunuz, English düyməsini basırsınız — və ana səhifəyə düşürsünüz. Rusca sorğuya Google Azərbaycan dilindəki versiyanı göstərir, ingilis versiyasında isə düymələrin yarısı rus dilində qalıb. Bunlar dillərin hazır versiyanın üzərinə, aralarındakı əlaqələr düşünülmədən əlavə edildiyi çoxdilli saytın əlamətləridir. Gəlin görək, Azərbaycan, rus və ingilis dillərində sayt həm texniki, həm də redaksiya baxımından necə işləməlidir: ünvanlar, hreflang, dil dəyişdiricisi, tərcümə, axtarış üçün başlıqlar, tərcüməsi olmayan səhifələr və ə, ğ hərfləri.',
        'body'     => [
            ['Çoxdilli sayt ayrıca ünvanlardan başlayır', 'Əsas qayda: səhifənin hər dil versiyasının öz daimi ünvanı olur. Məsələn, example.com/az/xidmetler/, example.com/ru/uslugi/ və example.com/en/services/. Google hər dil üçün ayrıca URL-dən istifadəni birbaşa tövsiyə edir və eyni ünvanda dili cookie faylları və ya brauzer ayarları vasitəsilə dəyişməyi məsləhət görmür.

Google-un axtarış robotu standart olaraq ABŞ-a aid kimi müəyyən edilən IP ünvanlarından daxil olur və Accept-Language başlığını ötürmür — sayt dili məhz bu başlığa görə təxmin edə bilərdi. Versiya avtomatik seçilirsə, Google bütün dil versiyalarını deyil, yalnız bir hissəsini skan edib indeksləyə bilər.

Ünvanları qurmağın variantları:
— bir domendə alt qovluqlar: /az/, /ru/, /en/ — qurmaq və saxlamaq asandır;
— az.example.com kimi subdomenlər — mümkündür, amma ünvandan bunun dil, yoxsa ölkə olduğu həmişə aydın olmur;
— ?lang=en kimi parametr — Google-un variantlar müqayisəsində bu üsul tövsiyə edilməyən kimi qeyd olunub.

Eyni səbəbdən ziyarətçini IP ünvanına və ya brauzerin dilinə görə avtomatik olaraq başqa versiyaya yönləndirmək də məsləhət deyil. Google bundan qaçmağı tövsiyə edir: belə yönləndirmələr versiyaların bir hissəsini həm insanlardan, həm də axtarış sistemindən gizlədə bilər. Bakıda telefonunun interfeysi ingilis dilində olan biri tamamilə rus dilindəki səhifəni axtara bilər.'],
            ['hreflang versiyaları bir-biri ilə necə əlaqələndirir', 'Sonra axtarış sisteminə bildirmək lazımdır ki, /ru/uslugi/ və /az/xidmetler/ müxtəlif dillərdə eyni səhifədir. Bunun üçün hreflang atributundan istifadə olunur. Onu səhifənin kodunda link teqləri ilə, HTTP başlıqları ilə və ya sitemap.xml faylında göstərirlər. Google üçün bu üsulların fərqi yoxdur, biri kifayətdir.

Google Search Central sənədlərindəki qaydalar:
— hər versiya özü də daxil olmaqla bütün dil versiyalarını sadalayır;
— istinadlar qarşılıqlıdır: rus səhifəsi ingilis səhifəsini göstərirsə, ingilis səhifəsi də rus səhifəsini göstərməlidir, əks halda Google bu cütü nəzərə almayacaq;
— ünvanlar /en/services/ şəklində deyil, https:// ilə birlikdə tam yazılır;
— dil kodu ISO 639-1 üzrə yazılır: az, ru, en; istəyə görə defislə ölkə kodu əlavə olunur (az-AZ), amma dil kodu olmadan ölkə kodu işləmir;
— x-default dəyəri dili variantların heç biri ilə üst-üstə düşməyən hər kəs üçün ehtiyat səhifəni təyin edir — məsələn, dil seçimi səhifəsini.

Başqa bir səhv rel=canonical-ın üç versiyanın hamısında Azərbaycan versiyasını göstərməsidir. Google kanonik səhifəni eyni dildə göstərməyi xahiş edir: rus versiyası özünə, ingilis versiyası da özünə istinad edir.

Google səhifənin dilini hreflang-a və ya lang atributuna görə yox, görünən mətnə görə müəyyən edir. hreflang-ın vəzifəsi başqadır — artıq tapılmış versiyalar arasından insana axtarış nəticələrində lazım olanı göstərmək.'],
            ['Dil dəyişdiricisi eyni səhifəyə aparır', 'Dil dəyişdiricisindəki səhvi ziyarətçi dərhal görür: xidmət haqqında Azərbaycan dilində oxuyurdu, «Русский» düyməsini basdı və ana səhifəyə düşdü.

Düzgün variant budur: dəyişdiricinin hər linki cari səhifənin tərcüməsinə aparır. Bunun üçün saytın idarəetmə sistemində səhifələr bir-biri ilə əlaqələndirilməlidir: xidmətin rus səhifəsinin Azərbaycan və ingilis dillərində cütü olur. hreflang da elə bu əlaqədən qurulur və onda dəyişdirici ilə işarələmə arasında uyğunsuzluq yaranmır.

W3C — veb standartlarını hazırlayan konsorsium — nə tövsiyə edir:
— digər dillərə linkləri tərcüməsi olan hər səhifədə və görünən yerdə yerləşdirirlər;
— dilin adını həmin dilin özündə yazırlar: Azərbaycanca, Русский, English — cari versiyanı oxuya bilməyən insan öz dilini tanımalıdır;
— dili bildirmək üçün bayraqlardan istifadə etmirlər: bayraq sadə tərcüməyə yox, müxtəlif ölkələr üçün nəzərdə tutulmuş versiyalara uyğundur. İngilis və rus dillərində bir çox ölkədə danışırlar.

Seçimi yadda saxlamaq olar ki, növbəti səhifələr eyni dildə açılsın. Amma yadda saxlamaq lazım olan saytın təxmini deyil, insanın qərarıdır.'],
            ['Tərcümə: insan, maşın, yoxsa hər ikisi', 'Google-un spam qaydalarında tərcümə avtomatik transformasiyalar sırasında çəkilir — onların köməyi ilə hazır mətndən oxucuya heç bir faydası olmayan səhifələr kütləvi şəkildə hazırlanır. Pozuntu, hansı üsulla hazırlanmasından asılı olmayaraq, məhz belə səhifələrin özü sayılır: alət deyil, nəticə qiymətləndirilir.

Praktikada maşın tərcüməsi qaralama kimi yararlıdır, son variant kimi isə zəifdir. O, terminləri qarışdıra, tərcümə edilməməli olan adı tərcümə edə bilər və sizin sahənizdə necə danışmağın qəbul olunduğunu bilmir. İşlək sxem belədir: qaralama və mövzunu bilən dil daşıyıcısının redaktəsi. Təkrarlanan sözlər üçün ümumi terminlər lüğəti faydalıdır: şirkətin adı, xidmətlər, vəzifələr, müqavilələrdəki ifadələr.

Ziyarətçinin gördüyü hər şeyi tərcümə etmək lazımdır, təkcə əsas mətni yox:
— menyu, düymələr və saytın aşağı hissəsi;
— formalar, sahələrdəki ipucları və xəta mesajları;
— müraciətdən sonra gələn təsdiq məktubları;
— şəkillərin alternativ mətni;
— 404 səhifəsi və hüquqi mətnlər.

Google səhifədə, naviqasiya da daxil olmaqla, bir dil saxlamağı və tərcümələri yan-yana yerləşdirməməyi məsləhət görür. Rusca menyunun altındakı ingiliscə mətn tərcümə deyil, qarışıqdır.

İnsanların hər dildə hansı sözlərlə axtardığı tərcümə deyil, axtarış sorğuları üzərində ayrıca işdir.'],
            ['Hər dildə axtarış üçün başlıqlar', 'Səhifənin axtarış üçün başlığı (title teqi) və təsviri (meta description) saytdakı qalan hər şey kimi onun mətnidir. Onlar əsas versiyadan olduğu kimi saxlanılmır, səhifə ilə birlikdə tərcümə olunur.

Google-un bu barədə birbaşa qaydası var: title səhifənin əsas məzmunu ilə eyni dildə və eyni yazı sistemində yazılır. Onlar üst-üstə düşmürsə, Google axtarış nəticələrində sizin başlığınızın yerinə səhifəyə daha yaxşı uyğun gələn başqa mətn göstərə bilər. İngilis səhifəsində rusca title — məhz belə haldır.

Hərfi tərcümə də ən yaxşı variant deyil. Başlıq məzmunu təsvir etməli və həmin dildə axtaran üçün təbii səslənməlidir. Eyni prinsip ünvanlara da aiddir: Google URL-də auditoriyanın dilindəki sözlərdən istifadə etməyi məsləhət görür. Ona görə də ingilis versiyasında /en/services/ ünvanı /en/uslugi/ ünvanından yaxşıdır.'],
            ['Tərcüməsi olmayan səhifələrlə nə etməli', 'Üç dildə saytda bütün versiyalar nadir hallarda eyni vaxtda hazır olur. Məsələn, ingilis versiyası geri qala bilər və səhifələrin bir hissəsi hələlik yalnız rus və Azərbaycan dillərində olur.

Ən pis variant ingilis ünvanı yaradıb oraya rus mətnini və ya «tərcümə tezliklə əlavə olunacaq» yazılı müvəqqəti səhifəni qoymaqdır. Səhifənin əsas məzmunu tərcümə olunmayıbsa, Google dil versiyalarını dublikat sayır.

Normal qayda belədir:
1. Tərcüməsi olmayan səhifə bu dil versiyasında sadəcə olmur.
2. hreflang-da yalnız mövcud versiyalar sadalanır. Üç dil əvəzinə iki dildən ibarət dəst normal vəziyyətdir: Google bir-birinə istinad edən səhifələri emal edir.
3. Belə səhifədə dil dəyişdiricisi ya əlçatan olmayan dili göstərmir, ya da lazımi versiyanın ana səhifəsinə aparır və bunu açıq şəkildə bildirir.
4. Tərcümə hazır olanda onu səhifənin bütün versiyalarının işarələməsinə eyni anda əlavə edirlər.

Bloq və ya xəbərlər üç dildə çıxmağa borclu deyil. Yalnız rus dilində olan məqalə, özünü tərcümə kimi qələmə vermirsə, normal məqalədir.'],
            ['ə, ğ, ı və İ hərfləri: şriftlər, böyük hərflər və ünvanlar', 'Şrift. ə, ğ, ş və İ hərfləri hər şriftdə olmur. Google Fonts şriftləri simvol dəstlərinə bölür və bu hərflər əsas latin dəstinə yox, genişləndirilmiş latın əlifbası dəsti olan latin-ext-ə daxildir. Yalnız əsas dəsti qoşsanız və ya bu işarələri olmayan şrift seçsəniz, brauzer çatışmayan hərfləri başqa şriftdən götürəcək və «xidmətlər» sözü iki fərqli şriftdən yığılacaq. Saytda istifadə olunan bütün şrift variantlarını yoxlayın. Saytda qiymətlər varsa, eyni yoxlamaya manat işarəsini — ₼ — də əlavə edin.

Böyük hərflər. Azərbaycan dilində iki cüt var: nöqtəli i və İ, nöqtəsiz ı və I. CSS-in text-transform xassəsi bunu yalnız səhifənin dili — lang=az atributu — göstərildikdə və brauzer bu qaydanı dəstəklədikdə nəzərə alır. Bu olmadan böyük hərflərlə yığılmış «Qiymətlər» menyu bəndi «QİYMƏTLƏR» əvəzinə «QIYMƏTLƏR» kimi görünəcək. lang atributu ekran oxuyucu proqramlara da lazımdır: onlar tələffüz qaydalarını ona görə seçirlər. Buna görə də WCAG əlçatanlıq standartı səhifənin dilini kodda göstərməyi tələb edir.

Ünvanlar. Azərbaycan dilindəki ünvanlar üçün iki yol var: xüsusi hərflər olmadan transliterasiya (/az/xidmetler/) və ya orijinal yazılış (/az/xidmətlər/). Google hər ikisinə yol verir. Amma əsas latın əlifbasından kənar hərflər ünvanda kodlaşdırılır: texniki cəhətdən /az/xidmətlər/ — /az/xidm%C9%99tl%C9%99r/ deməkdir və kod daxilindəki linklərdə Google ünvanı məhz belə yazmağı məsləhət görür. Hansı yolu seçsəniz də, bütün saytda ona sadiq qalın.'],
        ],
        'end'      => 'Çoxdilli sayt tərcümə düyməsi olan bir sayt deyil, öz ünvanları, başlıqları və mətnləri olan üç əlaqəli versiyadır. Aralarındakı əlaqəni hreflang və dil dəyişdiricisi qurur, keyfiyyəti isə tərcümə edən və mətni yoxlayan insanlar təmin edir. Öz saytınızı bir dəqiqəyə yoxlaya bilərsiniz: istənilən daxili səhifəni açın, dili dəyişin və hara düşdüyünüzə, brauzer tabındakı başlığın hansı dildə olduğuna baxın.',
    ],
    'brif-na-razrabotku-sajta' => [
        'seoTitle' => 'Sayt sifariş etmək üçün nə hazırlamalı: çek-list və brif',
        'seoDesc'  => 'Məqsəd, səhifələr, mətn və fotolar, nümunələr, dillər, domen və girişlər: sayt üçün brifdən əvvəl nə toplamalı və brif texniki tapşırıqdan nə ilə fərqlənir.',
        'title'    => 'Sayt sifariş etməzdən əvvəl nə hazırlamalı: brif, materiallar və girişlər',
        'desc'     => 'Sayt sifariş etməzdən əvvəl praktik çek-list: nəyi əvvəlcədən həll edib toplamalı, brif texniki tapşırıqdan nə ilə fərqlənir və hansı girişlər şirkətdə qalmalıdır.',
        'rubric'   => 'Saytlar',
        'lead'     => 'Sayt sifariş etmək qərarına gəldiniz, podratçıya yazdınız və cavab olaraq bir neçə səhifəlik anket aldınız. Sualların bir qismi aydındır, bir qismi yox, bəzilərinin cavabını isə yalnız çoxdan işdən çıxmış əməkdaş bilirdi. Onları sonraya saxlasanız, layihə yenə də dayanacaq — sadəcə daha gec: maket hazır olanda, mətnlər, fotolar və domenə giriş isə olmayanda. Gəlin baxaq: podratçı ilə ilk söhbətdən əvvəl nəyi toplamaq lazımdır, sayt hazırlanması üçün brif texniki tapşırıqdan nə ilə fərqlənir və hansı girişlər şirkətdə qalmalıdır.',
        'body'     => [
            ['Brif və texniki tapşırıq: fərq nədədir', 'Bu iki sənədi tez-tez qarışdırırlar, halbuki onlar fərqli suallara cavab verir.

Brif — sizin bildiklərinizdir: şirkətə sayt nə üçün lazımdır, onun müştəriləri kimlərdir, hansı materiallar artıq var, müddət və büdcə üzrə hansı məhdudiyyətlər mövcuddur. Onu sifarişçi doldurur, bəzən görüşdə icraçı ilə birlikdə. Sayt hazırlanması üçün brif texniki bilik tələb etmir — yalnız sizin yerinizə heç kimin qəbul etməyəcəyi qərarlar tələb edir.

Sayt üçün texniki tapşırıq isə nəyin görüləcəyini təsvir edir: səhifələrin, funksiyaların, formaların, dillərin, qoşulan servislərin siyahısını, idarə panelinə dair tələbləri. Onu adətən brif əsasında icraçı yazır, siz isə razılaşdırırsınız. Sonra iş, bir qayda olaraq, məhz texniki tapşırığa əsasən qəbul edilir, ona görə də onu diqqətlə oxumağa dəyər: orada olmayan hər şeyi təhvil zamanı yenidən müzakirə etmək lazım gələcək.

Brif nə qədər ətraflı olsa, tapşırıqda bir o qədər az təxmin olar. Aşağıda brifə məhz nələrin daxil edilməli olduğuna baxaq.'],
            ['Sayt nə üçündür və ora kim gələcək', '«Sayt olsun deyə» məqsədi icraçıya heç nə demir. Ziyarətçinin hansı hərəkətinin sizin üçün əsas olduğunu müəyyənləşdirmək daha faydalıdır: müraciət göndərmək, zəng etmək, WhatsApp-a yazmaq, kataloqu endirmək və ya şirkətin mövcud olduğuna və fəaliyyət göstərdiyinə əmin olmaq — məsələn, tenderdən əvvəl.

Sonra gələcək insanları təsvir edin. Yaşı və cinsi yox, sizə münasibətdə kim olduqlarını: iri şirkətin satınalma mütəxəssisi, təmirdən çıxmış mənzilin sahibi, xarici tərəfdaş. Onlar hansı dildə axtarır, hansı cihazdan daxil olur, əlaqə saxlamazdan əvvəl nəyi öyrənməlidirlər.

Yaxşı mənbə — öz zəngləriniz və yazışmalarınızdır. Müştərilərin ən çox verdiyi sualları yazın: müddətlər, zəmanət, hüquqi şəxslərlə işləyirsinizmi, nümunələr varmı. Bu siyahıdan sonradan həm səhifə mətnləri, həm də sual-cavab bölməsi yaranır.'],
            ['Səhifələrin siyahısı, mətnlər və fotolar', 'Korporativ sayta hansı səhifələrin lazım olduğu ayrıca mövzudur. Brif üçün qaralama siyahı kifayətdir: hansı bölmələri görürsünüz, hər birində nə olmalıdır və onun üçün materialı kim verir. Bunu üç sütunlu cədvəldə toplamaq rahatdır: səhifə, məzmun, məsul şəxs.

Mətnlərlə bağlı əvvəlcədən bir şeyi həll edin: onları siz yazırsınız, yoxsa icraçı. Əgər siz yazırsınızsa, qaralamaları messencer yazışmalarında deyil, bir sənəddə toplayın. Səhvə yer olmayan məlumatları ayrıca hazırlayın: hüquqi ad, ünvan, telefonlar, iş qrafiki, saytda lazımdırsa, rekvizitlər.

Şəkillərlə bağlı üç qayda var:

— fotoları çatda deyil, orijinal halında ötürün — fayl, arxiv və ya bulud qovluğu vasitəsilə: məsələn, WhatsApp-ın yardım mərkəzi açıq şəkildə xəbərdarlıq edir ki, göndərilərkən media fayllar adətən sıxılır və keyfiyyət orijinaldan aşağı ola bilər;
— loqo vektor formatında lazımdır — adətən SVG, EPS və ya PDF, — e-poçt imzasındakı şəkil kimi yox;
— axtarışda tapılan şəkildə © işarəsinin olmaması onu sərbəst götürmək olar demək deyil.

Son bəndi izah etmək lazımdır. Azərbaycanın da qoşulduğu Bern konvensiyası müəllif hüququnun qorunmasını hər hansı rəsmiyyətdən asılı etməyə yol vermir: bunun üçün nə işarə, nə də qeydiyyat lazımdır. Google Şəkillərdə nəticələri istifadə hüquqlarına görə filtrləmək olar, amma Google özü də istifadədən əvvəl lisenziyanın dəqiq şərtlərini yoxlamağı tövsiyə edir — onlar barədə məlumat şəklin altındakı keçid ilə açılır.'],
            ['Bəyəndiyiniz nümunələr və rəqiblər', 'Bəyəndiyiniz sayta izahsız keçid az şey verir. Sayt fotoları ilə xoşunuza gələ bilər, icraçı isə qərara gələcək ki, sizə menyunun eyni strukturu lazımdır. Ona görə də hər nümunəyə xüsusilə nəyi bəyəndiyiniz barədə bir-iki sətir əlavə edin: menyu necə qurulub, layihələr necə göstərilib, fotoların xarakteri necədir, mətnlər nə qədər qısa yazılıb, müraciət forması necə görünür.

Əks siyahı da az faydalı deyil — başqalarının saytlarında sizi nə qıcıqlandırır. Qəfil açılan pəncərələr, xırda şrift, öz-özünə dəyişən slaydlar, axtarmalı olduğunuz telefon nömrəsi: belə qeydlər lazımsız variantları dərhal kənarlaşdırır.

Nümunələri mütləq öz sahənizdən götürmək lazım deyil. Rəqibləri isə ayrıca yazmağa dəyər: bir neçə yerli və, əgər varsa, bir-iki xarici. Hər biri üçün qeyd edin: onlarda nə yaxşı edilib, nə çatışmır və siz onlardan nə ilə fərqlənirsiniz. Rəqibin saytı müqayisə üçün materialdır, köçürmək üçün nümunə deyil: onun mətnləri və fotoları da kiməsə məxsusdur.'],
            ['Dillər, inteqrasiyalar və saytı kim aparacaq', 'Saytın hansı dillərdə lazım olduğunu, bütün səhifələrin tam tərcümə olunub-olunmayacağını və tərcüməni kimin edəcəyini göstərin. Hansısa dil «sonra» əlavə olunacaqsa, bunu dərhal deyin: onu əvvəlcədən strukturda nəzərə almaq hazır sayta sonradan daxil etməkdən asandır.

İnteqrasiyalar — saytın əlaqələndirilməli olduğu hər şeydir. Sadalayın:

— formadan gələn müraciətlər hara düşür: hansı e-poçt ünvanına, hansı CRM-ə və ya messencerə, əməkdaşlardan kimə;
— WhatsApp düyməsində və saytın başlığında kimin nömrəsi göstəriləcək;
— hansı analitika və reklam servislərini qoşmaq lazımdır;
— xəritə, onlayn ödəniş, uçot proqramından məlumat ixracı — əgər lazımdırsa.

Ayrıca sual — işə salındıqdan sonra saytı kim yeniləyəcək. Konkret insanın adını çəkin və onun nəyi dəyişəcəyini deyin: xəbərlər, layihələr, vakansiyalar, qiymətlər. İdarə panelinin necə olmalı olduğu bundan asılıdır. Belə əməkdaşa ümumi administrator parolu deyil, məhdud hüquqlarla öz hesabı lazımdır. Məsələn, WordPress-də administratordan başqa redaktor, müəllif, iştirakçı və abunəçi rolları var: redaktor materialları, o cümlədən başqalarının materiallarını dərc edir və redaktə edir, amma plaginləri quraşdırmır və saytın ayarlarını dəyişmir.'],
            ['Domen, hostinq və girişlər: şirkətdə nə qalmalıdır', 'Domenin niyə şirkətə məxsus olmalı olduğu ayrıca söhbətdir. Burada — sifarişdən əvvəl nəyi yoxlamaq və təhvil zamanı nəyi almaq lazımdır.

Domen artıq varsa, aydınlaşdırın: registratorda onun sahibi kimi kim göstərilib və şəxsi kabinetə giriş kimdədir. Açıq WHOIS bu suala cavab verməyə bilər: .com kimi ümumi zonalardakı domenlər üçün ICANN qaydaları registratora sahibin adını gizlətməyə imkan verir. Kabinetin özündə baxmaq daha etibarlıdır. Belə domenin başqa registratora köçürülməsi registratorun sahibə verdiyi avtorizasiya kodu ilə aparılır. Sahib keçmiş podratçıdırsa, köçürmə ondan asılı olacaq.

Hostinqi də şirkətin adına rəsmiləşdirib şirkət adından ödəmək, icraçıya isə istifadəçi kimi giriş vermək daha yaxşıdır. Google servisləri ilə də eyni qayda: Search Console-da istifadəçiləri yalnız resursun sahibi əlavə edə və silə bilər, Google Analytics-də isə istifadəçiləri yalnız «Administrator» rolu idarə edə bilər. Deməli, sahib və administrator şirkətin hesabı olmalıdır: icraçıya girişi siz verirsiniz, əksinə yox.

Təhvil zamanı şirkətdə bunlar qalmalıdır:

— registratorun kabinetinə və hostinq panelinə giriş;
— saytın idarə panelində administrator hesabı;
— fayllara və verilənlər bazasına giriş və ya heç olmasa bu girişin kimdə olduğu barədə aydın təsəvvür;
— Search Console-da sahib, Analytics-də administrator hüquqları;
— dizaynın mənbə faylları və uzadılma tarixləri göstərilməklə ödənişli plaginlərin və servislərin siyahısı.

Parollar ümumi çatda mesajla deyil, parol meneceri vasitəsilə ötürülür. İcraçı artıq saytla işləmirsə, parollar dəyişdirilir.'],
            ['Çek-list: sayt sifariş etməzdən əvvəl nə toplamalı', 'Yuxarıda sadalananların hamısı bir səhifəyə sığır. Onu ilk görüşdən əvvəl podratçıya göndərmək və ya sadəcə özünüz bənd-bənd nəzərdən keçirmək olar:

1. Saytın məqsədi və ziyarətçinin əsas hərəkəti.
2. Müştəriləriniz kimdir və onlar ən çox nə soruşur.
3. Materiallara cavabdeh şəxslər göstərilmiş qaralama səhifə siyahısı.
4. Mətnlər və ya onları kimin yazacağı barədə qərar.
5. Fotoların orijinalları və vektor formatında loqo.
6. Nəyi bəyənib, nəyi bəyənmədiyiniz izah edilmiş nümunələr.
7. Rəqiblər və onlardan nə ilə fərqləndiyiniz.
8. Dillər və tərcüməni kimin etdiyi.
9. Müraciətlər hara düşür və hansı servisləri qoşmaq lazımdır.
10. Saytı kim və hansı hüquqlarla yeniləyəcək.
11. Şirkətin adına rəsmiləşdirilmiş domen, hostinq və analitika.'],
        ],
        'end'      => 'Sayt sifarişinə hazırlıq texniki iş deyil, onsuz da qəbul etməli olacağınız qərarlar toplusudur — sadəcə daha gec və tələsik. İlk söhbətdən əvvəl nə qədər çox bənd həll olunsa, texniki tapşırıq bir o qədər dəqiq alınar, təhvil zamanı isə mübahisə bir o qədər az olar. Domenə, hostinqə və analitikaya girişləri isə saytı kimin hazırlamasından asılı olmayaraq ilk gündən şirkətdə saxlamaq lazımdır.',
    ],
    'logotip-chto-dolzhno-byt-v-komplekte' => [
        'seoTitle' => 'Loqo hazırlanması: hansı faylları almalısınız',
        'seoDesc'  => 'Şirkət üçün loqo sifarişi: hazır dəstə nə daxildir — vektor, versiyalar, HEX, RGB, CMYK və Pantone, favikon — və qəbuldan əvvəl nişanı necə yoxlamaq olar.',
        'title'    => 'Loqo hazırlanması: təhvil verilən dəstdə hansı fayllar və versiyalar olmalıdır',
        'desc'     => 'Yazıları konturlara çevrilmiş vektor, üfüqi və şaquli versiyalar, ayrıca nişan, ekran və çap üçün rəng kodları, favikon — və işi qəbul etməzdən əvvəl beş yoxlama.',
        'rubric'   => 'Dizayn',
        'lead'     => 'Loqo təsdiqlənib, dizayner iki fayl göndərib: logo.png və logo.jpg. Bir ay sonra mətbəə «vektor» istəyir, lövhəni hazırlayan şirkət — «konturlar», sayt tərtibatçısı isə brauzer tabı üçün ikon. Müəllif artıq cavab vermir və nişanı şəkildən yenidən çəkirlər. Loqo hazırlanması təsdiqlənmiş eskizlə yox, müəllifsiz də işləmək mümkün olan fayllar dəsti ilə başa çatır. Gəlin baxaq, bu dəstə nələr daxildir və işi qəbul etməzdən əvvəl loqonu necə yoxlamaq olar.',
        'body'     => [
            ['Vektor fayl — loqo hazırlanmasının əsas nəticəsi', 'Şirkət üçün istənilən loqonu iki üsulla saxlamaq olar. Rastr şəkil — PNG və ya JPEG — sabit ölçülü nöqtələr şəbəkəsidir: onu bannerə və ya lövhəyə qədər dartıb böyütsəniz, kənarları pilləli və ya bulanıq olacaq. Vektor fayl isə nöqtələri deyil, konturların təsvirini saxlayır, ona görə də onu lap binanın fasadı boyda böyütmək olar — xətlər yenə də aydın qalacaq.

Adətən üç əsas fayl olur:

— SVG — W3C konsorsiumunun açıq formatı; onu brauzerlər anlayır və sayta məhz o gedir;
— PDF — onu mətbəə də, dizayn proqramları olmayan istənilən kompüter də aça bilər;
— AI — nişan Adobe Illustrator-da çəkilibsə, onun iş faylı; o, növbəti dizaynerə lazım olacaq.

Hər üçü üçün ümumi şərt: yazılar konturlara çevrilib, yəni hərflər adi fiqurlara dönüb. Mətn «canlı» qalıbsa və şrift fayla daxil edilməyibsə, həmin şrift olmayan kompüterdə proqram onu başqası ilə əvəz edəcək — və şirkətin adı elə mətbəədəcə görkəmini dəyişəcək.

Vektorun həqiqi olduğunu özünüz yoxlaya bilərsiniz. PDF-i açın və miqyası ən azı 800%-ə qədər böyüdün: hərflərin kənarları hamar qalmalıdır. SVG-ni Notepad-də açın. İçində image teqi varsa, xüsusən data:image ilə başlayan uzun sətirlə, qarşınızdakı vektor deyil, vektor qabığına salınmış rastr şəkildir.'],
            ['Üfüqi, şaquli və ayrıca nişan', 'Bir kompozisiya hər yerə yaramır. Saytın başlığı, firma blankı, girişin üstündəki lövhə — uzun və ensiz yerlərdir. Avatar, stiker, beyc isə kvadratdır. Buna görə də bir neçə versiya olmalıdır:

— üfüqi: nişan solda, ad sağda;
— şaquli: nişan yuxarıda, ad onun altında;
— yazısız nişan — avatar, saytın ikonu, iş geyimi üzərində tikmə üçün;
— lazım olarsa — nişansız, yalnız yazı.

Ayrıca nişan yoxdursa və loqo stilizə edilmiş addan ibarətdirsə, kvadrat yerlər üçün adətən ilk hərf və ya monoqram əsasında versiya hazırlanır. Bunu sonradan ikon xatirinə tələsik uydurmaqdansa, hazırlanma mərhələsində düşünmək daha yaxşıdır.

Hər versiya əsas fayldakı formatlarda ayrıca fayllar şəklində göndərilir. Üfüqi variant vektorda varsa, şaquli isə yalnız PNG-dədirsə, dəst yarımçıqdır.'],
            ['Rəngli, qara və ağ versiyalar', 'Loqo həmişə rəngdə tətbiq olunmur. Metal üzərində qravirovka, qabartma, lazerlə kəsmə, möhür, paketlərdə birrəngli çap, kassa çekləri — bunlar adətən bir rəngdir. Belə hallar üçün monoxrom versiya lazımdır: bütün nişan bir rəngdə, qradiyent və yarımtonlar olmadan.

Tərs, yaxud inversiya versiyası tünd fon üçün açıq rəngli loqodur. Bu, həmişə sadəcə ağ rənglə doldurma deyil. Nişanda daxili detallar varsa, inversiya zamanı açıq və tünd hissələr yerini dəyişir və təsvir başqa cür oxuna bilər. Belə yerləri dizayner əl ilə düzəldir və hazır fayl təqdim edir.

Rəng üzrə minimum dəst: tamrəngli, qara və ağ versiyalar. Loqoda qradiyent varsa, onsuz, düz rənglərlə hazırlanmış versiya da lazımdır.'],
            ['Rənglər: ekran üçün HEX və RGB, çap üçün CMYK və Pantone', '«Korporativ göy rəng» kodları olmayana qədər heç nə ifadə etmir. Ekran və kağız rəngi müxtəlif yollarla yaradır, ona görə də kodlar bir neçədir.

RGB ekrandakı rəngi qırmızı, yaşıl və göyün qarışığı kimi təsvir edir. HEX eyni RGB yazısının on altılıq formada ifadəsidir, məsələn, #1A4F8B; onu saytın koduna yazırlar. CMYK adi tamrəngli çapın dörd boyasıdır: mavi, purpur, sarı və qara.

RGB-dən CMYK-ya avtomatik çevirmə həmişə alınmır. Ekranın bəzi parlaq rəngləri çap boyaları ilə əldə edilmir və Illustrator ilə Photoshop belə rəngin çap qamutundan kənara çıxdığı barədə xəbərdarlıq edir. Buna görə də CMYK dəyərlərini maketi mətbəəyə təhvil verməzdən bir gün əvvəl konvertasiya ilə almaq əvəzinə, onları əvvəlcədən seçib sınaq çapında yoxlamaq daha yaxşıdır.

Pantone ilə vəziyyət başqadır. Bu, dörd boyanın qarışığı deyil, lazımi çalarda əvvəlcədən qarışdırılmış boyadır: mətbəə onu nömrəsinə görə sifariş edir və ya Pantone reseptinə əsasən özü qarışdırır. Belə rəng korporativ çaları dəqiq təkrarlamaq lazım olanda göstərilir — məsələn, qablaşdırmada, blanklarda, firma paketlərində. Pantone nömrəsinin sonunda C və ya U hərfi ola bilər — örtüklü və örtüksüz kağız üçün; eyni rəng müxtəlif kağızda nəzərəçarpacaq dərəcədə fərqli görünür. Pantone-u ekrana baxaraq seçmək etibarlı deyil: çalar çap olunmuş rəng yelpiyi ilə tutuşdurulur.'],
            ['Minimal ölçü və qoruyucu sahə', 'Brendbuk sifariş etməmisinizsə belə, loqoya iki qayda əlavə olunmalıdır.

Minimal ölçü — loqonun yerləşdirilə biləcəyi ən kiçik endir: daha kiçik ölçüdə nazik xətlər və yazı bir-birinə qarışır. Adətən onu ekran üçün piksellə, çap üçün isə millimetrlə ayrıca göstərirlər. Çox kiçik ölçülər üçün bəzən sadələşdirilmiş versiya hazırlanır — nazik detallar olmadan və ya yazısız.

Qoruyucu sahə loqonun ətrafındakı boş məkandır: ora mətn, vərəqin kənarı və başqa loqolar daxil olmamalıdır. Onu millimetrlə deyil, loqonun öz elementi ilə, məsələn, baş hərfin hündürlüyü ilə təyin etmək rahatdır: onda qayda istənilən miqyasda işləyir.

Versiyaları, rəngləri və hər iki qaydanı PDF-in bir-iki səhifəsində yerləşdirmək olar — bu, loqonun bir növ pasportudur. Palitra, şriftlər və yolverilməz istifadə nümunələri olan tam brendbuk isə ayrıca sənəddir.'],
            ['PNG və sayt üçün ikonlar', 'Rastr nüsxələr ona görə lazımdır ki, vektoru hər yerdə qəbul etmirlər: messencerlər, sosial şəbəkələr, məktublardakı imzalar, bir çox sayt konstruktoru. PNG şəffaflığı dəstəkləyir, JPEG isə yox, ona görə də JPEG-də şəffaf fon əvəzinə həmişə bütöv düzbucaqlı olacaq. PNG-ləri şəffaf fonda, bir neçə ölçüdə, hər versiya və hər rəng üçün eksport edirlər.

Brauzer tabındakı ikon — favikon — ayrıca məsələdir. Adətən onun ölçüsü 16×16 pikseldir və ora yalnız yazısız nişan sığır, çox vaxt da sadələşdirilmiş şəkildə. Sayt üçün kiçik fayllar dəsti lazımdır:

— 48×48 pikseldən böyük kvadrat PNG — Google axtarış nəticələrindəki ikon üçün məhz belə ölçü tövsiyə edir;
— favicon.ico — Windows ikonlarının formatı; bir faylda bir neçə ölçü saxlamaq olar və Google bu formatı da qəbul edir;
— apple-touch-icon — iPhone və iPad-in əsas ekranındakı qısayol üçün ikon; Apple sənədlərindəki nümunədə iPhone üçün bu, 180×180 piksellik PNG-dir;
— manifest üçün 192×192 və 512×512 piksellik ikonlar — sayt tətbiq kimi quraşdırıla bilirsə, Chromium əsaslı brauzerlər onları tələb edir.

SVG ikon əlavə etməyə də dəyər: Chrome, Edge və Firefox onu göstərir, Safari isə 26-cı versiyadan başlayaraq. Amma Google-un axtarışdakı ikon üçün qəbul etdiyi formatların siyahısında SVG yoxdur, ona görə də o, qalan faylları əvəz etmir.'],
            ['Qəbul etməzdən əvvəl loqonu necə yoxlamaq olar', 'Yoxlama üçün dizayn proqramları lazım deyil.

1. Kiçildin. Nişanı ekranda brauzer tabındakı ikon boyda sıxın, sonra loqonu qələm və ya vizit kartındakı kimi təxminən 2 sm enində çap edin. Ad oxunurmu, nişan seçilirmi?
2. Rəngi çıxarın. Loqonu adi ağ-qara printerdə çap edin. Yaxşı nişan rəngə söykənmir, siluetindən tanınır.
3. Fotonun üstünə qoyun. Loqonu açıq və tünd fotoşəklin, həmçinin ala-bəzək fonun üzərinə yerləşdirin. Rəngli versiyanın itdiyi yerdə ağ və ya qara versiya köməyə gəlməlidir.
4. Dairəyə yerləşdirin. Avatar qoyacağınız yerdə çərçivə dairəvidirsə, nişanın künclərinin kəsilib-kəsilmədiyini yoxlayın.
5. Faylları başqasının kompüterində açın. PDF və SVG dizayn proqramları və korporativ şrift olmadan açılmalı, PNG-nin fonu şəffaf olmalı, faylların adları isə müəllifsiz də anlaşılmalıdır.

Bakıda və ya başqa şəhərdə loqo sifarişi verməyə hazırlaşanda bu məqalədəki faylların siyahısını iş başlamazdan əvvəl müqaviləyə və ya texniki tapşırığa yazın. Onda nəyin təhvil verilmiş iş sayılacağı əvvəlcədən bəlli olur.'],
        ],
        'end'      => 'Hazır loqo şəkil deyil, dəstdir: yazıları konturlara çevrilmiş vektor, bir neçə kompozisiya, rəngli, qara və ağ versiyalar, ekran və çap üçün rəng kodları, minimal ölçü, qoruyucu sahə, PNG və sayt üçün ikonlar. Onu dizaynersiz də yoxlamaq olar: kiçiltmək, rəngsizləşdirmək, fotonun üstünə qoymaq, dairəyə yerləşdirmək və başqasının kompüterində açmaq. Loqo beş yoxlamanın hamısından keçirsə, işi qəbul etmək olar.',
    ],
    'brendbuk-chto-v-nyom-dolzhno-byt' => [
        'seoTitle' => 'Brendbuk və korporativ üslub: içində nə var, kimə lazımdır',
        'seoDesc'  => 'Brendbuka nə daxildir: loqo qaydaları, kodları ilə palitra, şriftlər, şəbəkə, foto üslubu. Brend bələdçisindən mətbəə, SMM və sayt tərtibatçısı nə götürür.',
        'title'    => 'Kiçik şirkət üçün brendbuk: içində nə olmalıdır və ondan necə istifadə edirlər',
        'desc'     => 'Loqo korporativ üslubdan və brendbukdan nə ilə fərqlənir, qısa brend bələdçisinə hansı bölmələr lazımdır və ondan mətbəə, SMM mütəxəssisi və sayt tərtibatçısı nə götürür.',
        'rubric'   => 'Dizayn',
        'lead'     => 'Vizit kartlarını bir mətbəədə, sərgi üçün banneri başqasında çap etdiriblər, Instagram-dakı postları isə üçüncü bir nəfər hazırlayır. Hamısını yan-yana qoyun: göy rəngin üç fərqli çalarda olduğu üzə çıxacaq, bannerdəki loqo bir az yastılanıb, postlardakı şrift isə korporativ şriftə yalnız oxşayır. Podratçıların heç biri qəsdən səhv etməyib — sadəcə onlara qaydalar verilməyib. Brendbuk da elə bir dəfə yazıya alınmış belə qaydalardır. Gəlin görək, o, loqodan və korporativ üslubdan nə ilə fərqlənir, içində nə olmalıdır və ondan mətbəə, SMM mütəxəssisi və sayt tərtibatçısı nə götürür.',
        'body'     => [
            ['Loqo, korporativ üslub və brendbuk: fərq nədədir', 'Loqo — şirkətin nişanı və adının yazılışıdır. Ən çox diqqət çəkən element olsa da, tək bir elementdir.

Korporativ üslub, yaxud vizual identika, loqonun rənglər, şriftlər, qrafik elementlər və fotoşəkillərin üslubu ilə bərabər daxil olduğu sistemdir. Üslub bütöv olanda şirkəti hətta loqonun kadra düşmədiyi fotoşəkildən də tanıyırlar.

Brendbuk bu sistemin yazıya alındığı sənəddir: qaydalar, ölçülər, kodlar və nümunələr. Terminologiya burada vahid deyil. Çox vaxt brendbuk dedikdə brend platformasını — missiyanı, dəyərləri, ünsiyyət tonunu — da əhatə edən böyük sənəd nəzərdə tutulur. Yalnız vizual qaydalardan ibarət qısa sənədi brend bələdçisi və ya gaydlayn, yalnız loqoya aid lap qısa sənədi isə logobuk adlandırırlar. Sənədin adı onun məzmunu qədər vacib deyil.

Kiçik şirkətə adətən qısa brend bələdçisi kifayət edir — istənilən podratçıya göndərilə bilən bir PDF fayl. Belə sənəd olmadan korporativ üslubun hazırlanması məntiqini yalnız müəllifin bildiyi fayllarla dolu bir qovluqla başa çatır. Dizayner və ya podratçı dəyişən kimi üslub elə ilk yeni maketdən dağılmağa başlayır.'],
            ['Loqo: versiyalar, qoruyucu sahə və qadağalar', 'Birinci bölmə loqodan necə istifadə etməli və necə istifadə etməməli olduğunu təsvir edir.

— Versiyalar: əsas versiya, üfüqi və şaquli kompozisiya, adı olmayan ayrıca nişan.
— Rəng variantları: tamrəngli, birrəngli tünd və tünd fon üçün ağ. Birrəngli variant qravirovka, qabartma basma, bir boya ilə çap və ağ-qara sənədlər üçün lazımdır.
— Qoruyucu sahə — loqonun ətrafında mətnin və digər elementlərin girmədiyi boş sahədir. Onu millimetrlə deyil, loqonun öz ölçüsünə nisbətdə, məsələn, bir hərfin hündürlüyü ilə təyin edirlər: onda qayda həm vizit kartında, həm də lövhədə eyni cür işləyir.
— Minimal ölçü — ayrıca: çap üçün millimetrlə, ekran üçün piksellə. Loqo bundan kiçik olsa, xırda detallar bir-birinə qarışır.

Bölmənin ən faydalı səhifəsi — yolverilməz istifadə. Orada üstündən xətt çəkilmiş nümunələr toplanır: loqo dartılıb və ya sıxılıb, döndərilib, başqa rəngə boyanıb, ona kölgə və ya kontur əlavə olunub, ad başqa şriftlə yığılıb, elementlərin yeri dəyişdirilib, loqo altlıq olmadan ala-bəzək fotoşəklin üstünə qoyulub. Belə səhifəni qaydaları oxumadan bir baxışdan başa düşürlər.'],
            ['Rənglər: bir çalar — bir neçə kod', '«Bizim göy» sözləri nə çap maşınına, nə də monitora heç nə demir. Palitradakı hər rəngi hər mühit üçün ayrıca kodlarla yazırlar:

— HEX və RGB — ekran üçün: sayt, sosial şəbəkələr, təqdimatlar. HEX #0B5FA5 şəklində yazılışdır: burada on altılıq rəqəmlərin üç cütü qırmızı, yaşıl və göy kanalları təyin edir.
— CMYK — dörd boya ilə çap üçün: vizit kartları, vərəqələr, kataloqlar.
— Pantone — rəng tirajdan tiraja eyni qalmalı olduqda, hazır qarışdırılmış boya ilə çap üçün: paketlər, qablaşdırma, blanklar.
— RAL — boya və örtüklər üçün: lövhə, fasad, metal, interyer. RAL özü boya istehsal etmir — bu, çalarlar etalonudur, boyanı isə onun nömrəsinə görə istehsalçılar hazırlayır.

Pantone kodlarının suffiksi var və o, kağızı bildirir: C — örtüklü, U — örtüksüz kağız. Örtüksüz kağız boyanı daha çox hopdurur, ona görə də eyni nömrə onun üzərində başqa cür görünür. Şirkət hər iki növ kağızda çap etdirirsə, palitrada hər iki variant göstərilir.

CMYK dəyərlərini HEX-dən avtomatik çevirmə ilə almaq məsləhət deyil: proqram çap edilə bilən ən yaxın çaları qoyacaq və o, həmişə lazım olan çalar olmur. Hətta Pantone da öz rəngləri üçün yalnız ən yaxın CMYK analoqlarını verir. Dəyərləri sınaq çapında seçir və yoxlayırlar.

Palitraya həmçinin nisbətlər lazımdır — hansı rəng əsas, hansı aksent, hansıları fon və mətn üçün neytraldır — və kontrast yoxlaması. Saytdakı mətn korporativ rənglə yığılıbsa, WCAG-in 1.4.3 meyarına görə kontrast adi mətn üçün 4,5:1-dən, iri mətn üçün isə 3:1-dən az olmamalıdır. 18 punktdan, qalın şriftlə isə 14 punktdan başlayan mətn iri sayılır — CSS-də bu, təxminən 24 və 18,5 pikseldir. Loqo bu tələbdən azaddır, düymələrdəki və menyudakı mətn isə yox. Ağ fonda solğun çalarlar çox vaxt yoxlamadan keçmir və mətn üçün palitraya eyni rəngin daha tünd variantı əlavə edilir.'],
            ['Şriftlər: kiril, Azərbaycan latın əlifbası və lisenziya', 'Adətən bir-iki şrift kifayət edir: başlıqlar və əsas mətn üçün. Onlara Word sənədləri, cədvəllər və məktublar üçün sistem əvəzləyicisi — demək olar ki, hər kompüterdə quraşdırılmış standart şrift — əlavə olunur.

Bakıdakı şirkət üçün şrift seçərkən mütləq yoxlanılmalı bir məqam var: şriftdə həm kiril, həm də bütün Azərbaycan latın əlifbası olmalıdır — təkcə əsas hərflər deyil, ç, ə, ğ, ı, İ, ö, ş, ü də. Şriftin təsvirindəki «latın» qeydi buna zəmanət vermir, ən sadəsi Azərbaycanca mətn yığıb baxmaqdır. Şriftdə hərf yoxdursa, brauzer onu başqa şriftdən götürəcək və sözün içində qalınlığı və hündürlüyü fərqli simvol peyda olacaq.

İkinci məsələ lisenziyadır. Kommersiya şrift studiyalarında şrifti maketlər üçün kompüterə quraşdırmaq lisenziyası ilə saytda istifadə lisenziyası çox vaxt ayrıca satılır, veb-lisenziyanın qiyməti isə tez-tez ayda səhifə baxışlarının sayına görə hesablanır. SIL Open Font License altında yayılan şriftlərdən çapda, loqoda və saytda ayrıca icazə və ödəniş olmadan istifadə etmək olar. Google Fonts hazırda yeni şriftləri yalnız bu lisenziya ilə qəbul edir. Brendbukda şriftin haradan götürüldüyü və lisenziyanın nələri əhatə etdiyi qeyd olunur.

Sonra yığım qaydaları gəlir: hansı qalınlıq və üslublardan istifadə olunur, başlıqların və mətnin ölçüləri bir-birinə necə nisbətdədir, sətirlərarası interval və düzləndirmə necədir.'],
            ['Şəbəkə, boşluqlar və təsvirlərin üslubu', 'Modul şəbəkəsi tipik formatlarda sütunları və kənar sahələri təyin edir, boşluqlar isə vahid addıma bölünən ölçülərdə götürülür. Mənası praktikdir: addımı və şəbəkəni bilən podratçı hər xırdalığı razılaşdırmadan yeni maketi əvvəlkilərə oxşar hazırlayacaq. Loqonun daimi yeri də bura aiddir — məsələn, vərəqələrdə və slaydlarda həmişə sol yuxarı künc.

Qrafik elementlər — loqo olmadan da tanınan şeylərdir: patern, rəngli bloklar, xətlər, xarakterik forma. Üslubda ikonlar varsa, onlar da təsvir olunur: konturlu, yoxsa doldurulmuş, xəttin qalınlığı nə qədərdir, künclər yumrulanıbmı.

Təsvirlərin üslubunu sözlə ifadə etmək hamısından çətindir, ona görə də burada «belə» və «belə yox» nümunələri işə yarayır. İsti və ya soyuq işıq, kadrda insanlar, yoxsa yalnız əşyalar, fon — canlı interyer, yoxsa birrəngli, emal — təbii, yoxsa kontrastlı. Bu bölmə olmasa, hər yeni podratçı fotoşəkilləri öz zövqünə görə gətirəcək və sosial şəbəkələrdəki lent kollaja çevriləcək.'],
            ['Brend daşıyıcılarında nümunələr', 'Son bölmə qaydaları işdə — şirkətin həqiqətən istifadə etdiyi daşıyıcılarda göstərir:

— vizit kartı və korporativ blank;
— elektron məktubda imza;
— sosial şəbəkələr üçün avatar və post şablonu;
— təqdimatın titul slaydı və tipik slaydı;
— lövhə, forma geyimi, nəqliyyat və ya qablaşdırma — əgər bunlar varsa.

Hər şeyi çəkməyə ehtiyac yoxdur. Pərakəndə heç nə satmayan şirkətə korporativ paket lazım olmayacaq, menecerlərin hər gün istifadə etdiyi Word-dakı kommersiya təklifi şablonu isə daha faydalı olacaq. Hər nümunə həm də yoxlama rolunu oynayır: qaydanı real daşıyıcıya tətbiq etmək alınmırsa, onu yenidən yazmaq lazımdır.'],
            ['Mətbəə, SMM və sayt tərtibatçısı brendbukdan necə istifadə edir', 'Hər podratçıya brendbukdan özünə lazım olan hissə gərəkdir.

Mətbəəyə kağıza uyğun suffiksli CMYK və Pantone, vektor loqo, minimal ölçü və qoruyucu sahə lazımdır. Maketləri ona PDF formatında, şriftləri fayla yerləşdirilmiş və ya əyrilərə çevrilmiş halda verirlər. Şrift fayla yerləşdirilməyibsə və faylın açıldığı kompüterdə quraşdırılmayıbsa, proqram onu başqası ilə əvəz edəcək və hərflərin forması üst-üstə düşməyəcək.

SMM mütəxəssisinə post şablonları, HEX-də palitra, şriftlər, loqonun fotoşəkillərin üzərində yerləşdirilməsi qaydaları və foto üslubunun nümunələri lazımdır. Avatar ayrıca məsələdir: Facebook səhifənin profil şəklini dairəvi kəsir və loqonun uzun üfüqi versiyası orada xırda görünəcək. Avatar üçün nişan və ya dairənin kənarına qədər ehtiyat boşluq saxlanmış kompakt versiya lazımdır.

Sayt tərtibatçısına stillərdə dəyişənlərə çevirəcəyi HEX kodları, veb-lisenziyalı şriftlər, şəbəkənin və boşluqların addımı, SVG formatında loqo və favikonun kiçik kvadratında oxunan nişan lazımdır. Azərbaycan dilindəki sayt üçün isə bir incəlik var: başlıqlar CSS vasitəsilə böyük hərflərə çevrilirsə, HTML kodunda səhifənin dili göstərilməlidir. Dil qaydalarını dəstəkləyən brauzer az qeydi olduqda i hərfini İ-yə çevirəcək. Bu qeyd olmasa, nöqtəsiz I alınacaq, Azərbaycan dilində isə bu, başqa hərfin — ı-nın böyük formasıdır. Brauzerlərdə dəstək fərqlidir, ona görə də nəticəni gözlə yoxlamaq lazımdır.'],
        ],
        'end'      => 'Kiçik şirkətin brendbuku qalın kitab deyil, istənilən podratçının sizin iştirakınız olmadan üslubunuzu təkrarlaya biləcəyi qaydalar toplusudur: qadağaları ilə birlikdə loqo, hər mühit üçün kodlarla rənglər, lisenziyası və lazımi hərfləri yoxlanılmış şriftlər, şəbəkə, foto üslubu və nümunələr. Özünüzünkünü yoxlamaq asandır: onu yeni bir insana verin və ilk maketə qədər neçə sual verəcəyini sayın.',
    ],
    'dizajn-kataloga-dlya-pechati-i-pdf' => [
        'seoTitle' => 'Kataloq dizaynı: çapa hazırlıq və poçt üçün PDF',
        'seoDesc'  => 'Çap üçün kataloq və poçt üçün kataloq — iki ayrı PDF. Səhifələr, kəsim payı, CMYK, foto ayırdetməsi, şriftlər və PDF/X: çapa verməzdən əvvəl nəyi yoxlamalı.',
        'title'    => 'Məhsul kataloqunun dizaynı: çapdan və poçtla göndərişdən əvvəl nəyi yoxlamalı',
        'desc'     => 'Mətbəə və poçt göndərişi üçün məhsul kataloqu niyə iki ayrı fayldır: dördə bölünən səhifə sayı, kəsim payı, CMYK, fotoların ayırdetmə qabiliyyəti, şriftlər və PDF/X.',
        'rubric'   => 'Dizayn',
        'lead'     => 'Məhsul kataloqu səhifələnib, ekranda hər şey səliqəli görünür. Mətbəə isə faylı geri qaytarır: kəsim payı yoxdur, fotolar RGB-dədir, səhifə sayı da otuzdur, halbuki skoba ilə cildləmə üçün dördə bölünən say lazımdır. Eyni PDF-i müştəriyə poçtla göndərmək də alınmır — faylın həcmi çox böyükdür. Kataloq dizaynı təkcə modul tor, fotolar və qiymətlər deyil, həm də tələbləri fərqli olan iki texniki fayldır. Gəlin görək, kataloqu çapa verməzdən və poçtla göndərməzdən əvvəl nəyi yoxlamaq lazımdır.',
        'body'     => [
            ['Kataloq dizaynı səhifələrin sayından başlayır', 'Nazik kataloqlar adətən skoba ilə cildlənir: vərəqləri ortadan qatlayır, bir-birinin içinə qoyur və qat xətti boyunca məftil skoba ilə bərkidirlər. Qatlanmış bir vərəq dörd səhifə verir. Buna görə də üz qabığı daxil olmaqla səhifələrin ümumi sayı dördə bölünməlidir: 8, 12, 16, 20 və s. Maketdə 30 səhifə varsa, ya onu 32-yə çatdırmaq, ya da 28-ə qədər ixtisar etmək lazım gələcək.

Səhifələri planlaşdırma mərhələsində saymaq lazımdır: üz qabığına, mündəricata, bölmələrə və əlaqə məlumatlarına neçə səhifə gedəcək. Hazır səhifələmədə iki səhifə əlavə etmək və ya çıxarmaq onlardan sonra gələn hər şeyi sürüşdürmək deməkdir.

Skoba ilə cildləmədə blokun qalınlığının həddi var və bu hədd kağızdan asılıdır — dəqiq rəqəmi mətbəə deyəcək. Səhifələrin sürüşməsi də var, ingilisdilli tələblərdə ona creep deyilir: qatlananda blokun ortasındakı vərəqlər xarici vərəqlərdən daha çox çölə çıxır və kəsimdən sonra onların xarici kənar boşluqları daralır. Nazik kataloqda bu, demək olar ki, hiss olunmur, qalın kataloqda isə sürüşməni səhifələrin çap vərəqinə düzülməsi mərhələsində kompensasiya edirlər — mətbəədən bunu edib-etmədiyini soruşun. Sizdən yalnız bir şey tələb olunur: vacib elementləri xarici kənara sıxışdırmayın.

Qalın kataloqlar üçün daha çox tikişsiz yapışqanlı cildləmə seçilir. Orada səhifələrin sayı adətən sadəcə cüt olmalıdır, amma daxili kənar boşluğun bir hissəsi kötüyə gedir. Tipik tövsiyələrdən biri mətni daxili kənara 10 mm-dən yaxın yerləşdirməməkdir.'],
            ['Kəsim payı və təhlükəsiz kənar boşluqlar', 'Mətbəə daha böyük formatlı vərəqdə çap edir, sonra isə tirajı kəsir. Kəsim zamanı kiçik kənarlaşmaya yol verilir, buna görə də səhifənin kənarına qədər çatmalı olan hər şeyi — fonu, bütöv səhifəlik fotonu, rəngli bloku — kəsim xəttindən kənara uzadırlar. Bu ehtiyata kəsim payı (bleed) deyilir. Ən çox hər tərəfdən 3 mm istəyirlər, amma başqa dəyərlərə də rast gəlinir.

Nümunə: ISO 216 standartına görə A4 formatı 210 × 297 mm-dir. Hər tərəfdən 3 mm kəsim payı ilə faylda səhifə 216 × 303 mm alınır, kəsim nişanları isə harada kəsmək lazım olduğunu göstərir.

Səhifənin içində əks qayda işləyir — təhlükəsiz zona. Mətni, səhifə nömrələrini, loqonu və qiymətləri kəsim xəttindən aralı saxlayırlar: tipik tələb ən azı 3 mm, daha yaxşısı isə 5 mm-dir. Daha yaxında olan hər şey bıçaq azacıq sürüşəndə kəsilə bilər.

Kataloqu çap üçün səhifələyərkən tez-tez yol verilən səhv: fon kəsim payının kənarına qədər deyil, düz səhifənin kənarına qədər çəkilib. Bıçaq bir az sürüşən kimi kənarda nazik ağ zolaq qalacaq.'],
            ['CMYK və RGB: kağızda rəng niyə başqa cür görünür', 'Ekran rəngi işıqdan — qırmızı, yaşıl və göy işığın birləşməsindən (RGB) əmələ gətirir. Çap maşını isə dörd boyadan: mavi, al-qırmızı, sarı və qaradan (CMYK). Çapın rəng diapazonu ümumilikdə monitorunkundan dardır: parlaq yaşıl və göy rənglər kağızda daha sönük çıxır.

Buna görə də çap üçün kataloq CMYK-da hazırlanır, bu modelə keçid isə ICC profili ilə — konkret çap şəraitini təsvir edən faylla aparılır. Məsələn, örtüklü kağızda ofset çap üçün ümumi boya örtüyü həddi 300% olan standart PSO Coated v3 profili (FOGRA51 məlumatları) var. Başqa kağız üçün başqa profil lazımdır və məhz hansının lazım olduğu mətbəəyə veriləcək ilk sualdır.

Hansı rənglərin diapazona sığmayacağı hələ çevirmədən əvvəl görünür: Photoshop-da onları View — Gamut Warning əmri işıqlandırır. Yoxlama View — Proof Setup-da seçilmiş profilə görə aparılır. Korporativ rəngin kağızda necə çıxması vacibdirsə, avtomatik çevirməyə güvənmək əvəzinə onu əvvəlcədən CMYK-da və ya ayrıca xüsusi boya (spot rəng) kimi təyin etmək daha yaxşıdır.

Qara rəngin ayrıca qaydası var. Xırda mətn yalnız qara boya ilə çap olunur: 100% K, digər boyalar qarışdırılmadan. Tərkibli qara bir neçə boya ilə çap olunur və çap zamanı boyaların azacıq üst-üstə düşməməsi belə hərflərin kənarlarını bulanıqlaşdırır. RGB-də təyin edilmiş qara profil ilə çevriləndə adətən elə dörd boyanın qarışığına çevrilir.'],
            ['Çap üçün fotoların ayırdetmə qabiliyyəti', 'Mətbəələrin tipik tələbi son ölçüdə düym başına 300 pikseldir (ppi; tələblərdə çox vaxt dpi yazılır). Faylın xassələrindəki rəqəm özlüyündə heç nə ifadə etmir: vacib olan, fotonun səhifədə yerləşdiyi yerdə bir düymə neçə piksel düşməsidir.

Hesablamaq asandır. Eni 1200 piksel olan foto 300 ppi-də 4 düym — təxminən 10 sm yer tutacaq. Kəsim payı ilə birlikdə A4-ün bütün eni boyunca şəkil üçün (216 mm, təxminən 8,5 düym) endə təxminən 2550 piksel lazımdır. Təchizatçının saytından və ya messencerdən götürülən şəkillər çox vaxt bundan kiçik olur və kağızda bulanıq, yaxud gözə çarpan kvadratcıqlarla çıxacaq.

Proqramda böyütmək detal əlavə etmir: iki dəfə dartılmış foto düym başına iki dəfə az piksel alır. InDesign-da bunu Links panelində görmək olar: Effective PPI parametri səhifədəki miqyası nəzərə almaqla ayırdetmə qabiliyyətini göstərir.

Loqoları, sxemləri və ikonları vektor formatında yerləşdirmək daha yaxşıdır — onlar istənilən ölçüdə aydın çap olunur.'],
            ['Şriftlər: fayla daxil edin və lisenziyanı yoxlayın', 'Mətbəənin kompüterində şrift yoxdursa və o, PDF-ə daxil edilməyibsə, proqram onu başqası ilə əvəz edəcək — sözlərin sətirdən-sətrə keçirilməsi, qiymətlər və başlıqlar yerindən oynayacaq. Buna görə də çap faylında bütün şriftlər daxil edilir, PDF/X standartı isə bunu birbaşa tələb edir.

Hər şrifti daxil etmək olmur. OpenType şrift faylında fsType sahəsi var, istehsalçı orada daxil etmə hüquqlarını göstərir. Restricted License dəyəri o deməkdir ki, şrifti hüquq sahibinin icazəsi olmadan daxil etmək olmaz və spesifikasiyaya əməl edən proqramlar onu daxil etməyəcək. Lisenziyanı faylları təhvil verdiyiniz gün yox, səhifələməyə başlamazdan əvvəl yoxlamaq lazımdır.

Hazır PDF Acrobat-da və ya pulsuz Acrobat Reader-də yoxlanılır: File — Properties menyusu, Fonts tabı. Hər şriftin yanında Embedded və ya Embedded Subset qeydi olmalıdır. Bəzi mətbəələr şriftləri daxil etmək əvəzinə mətni konturlara çevirməyi xahiş edir. Sizdən bunu istəsələr, maketin redaktə edilə bilən mətnli surətini saxlayın: konturlara çevrilmiş mətndə yazı səhvini artıq sadəcə yenidən yazmaqla düzəltmək olmayacaq.'],
            ['Çap üçün kataloqun səhifələnməsi: PDF/X nədir', 'PDF/X faylların çapa ötürülməsi üçün ISO 15930 standartlar ailəsidir. Bu, məhdudiyyətləri olan adi PDF-dir: içində mətbəənin sizin nəzərdə tutduğunuzdan fərqli oxuya biləcəyi heç nə olmamalıdır.

Tələblərdə ən çox iki versiyaya rast gəlinir:

— PDF/X-1a: yalnız CMYK və spot rənglər, şəffaflıq ixrac zamanı düzləşdirilir;
— PDF/X-4 (ISO 15930-7): canlı şəffaflığa, qatlara və ICC profilli rənglərə, o cümlədən RGB-yə icazə verir.

Hansının lazım olduğu mətbəənin texniki tələblərində göstərilir. InDesign-da hər iki versiya standart ixrac ayarları arasında var.

PDF/X-də olmayacaq şey isə linklərdir. PDF/X standartları səhifənin çap sahəsində annotasiyalara icazə vermir, PDF-dəki kliklənən link isə texniki baxımdan elə annotasiyadır. InDesign-da PDF/X standartı seçildiyi müddətdə Hyperlinks qutucuğu əlçatan olmur.

Faylın özünə tipik tələblər: səhifələr iki səhifəlik açılışla deyil, tək-tək, ardıcıllıqla, kəsim payı və kəsim nişanları ilə. Bəzi mətbəələr üz qabığını açılış şəklində təqdim etməyi xahiş edir — bunu da əvvəlcədən dəqiqləşdirmək lazımdır.'],
            ['Poçt və sayt üçün PDF', 'Müştərilər üçün fayl həmin səhifələmədən, amma başqa ayarlarla hazırlanır:

— rəng sRGB-də, yəni ekranlar və veb üçün standart rəng məkanında;
— fotolar azaldılmış ayırdetmə qabiliyyəti ilə və sıxılmış halda: ekranda 300 ppi-lik ehtiyat lazım deyil, faylı isə ağırlaşdırır;
— kəsim payı və kəsim nişanları olmadan;
— telefona, poçta, sayta və məhsul səhifələrinə aparan işlək linklərlə.

InDesign-da bunun üçün Smallest File Size adlı standart ayar var. Adobe-nin təsvirinə görə, o, veb, poçt və daxili şəbəkə üçün nəzərdə tutulub: rəngi sRGB-yə çevirir, şəkilləri sıxır və onların ayırdetmə qabiliyyətini azaldır, şriftləri daxil edir. Adobe bu variantı çap üçün tövsiyə etmir. İxracdan əvvəl Hyperlinks qutucuğunun işarələndiyini yoxlayın, ixracdan sonra isə hər linki əl ilə açıb yoxlayın.

Yüngül fayl poçt limitlərinə görə lazımdır. Şəxsi Gmail hesabından 25 MB-dan çox qoşma göndərmək olmur; fayllar daha ağırdırsa, Gmail onları məktubdan çıxaracaq və əvəzinə Google Diskə link əlavə edəcək. Google Workspace iş hesablarında limitləri administrator təyin edir. Alıcının poçtunun da daxil olan məktublar üçün öz həddi var və onu əvvəlcədən bilmirsiniz. Kataloqu sayta yerləşdirib link göndərmək daha etibarlıdır: fayl poçt serverində ilişib qalmayacaq, qiymətlər yenilənəndə isə onu eyni ünvanda əvəz etmək kifayət edəcək.'],
        ],
        'end'      => 'Bir məhsul kataloqu sonda demək olar ki, həmişə iki fayl verir: mətbəə üçün CMYK-da, kəsim payı ilə ağır PDF/X və ekran üçün sRGB-də, linkləri olan yüngül PDF. Yuxarıdakı rəqəmlər geniş yayılmış tələblərdir, qanun deyil: profili, kəsim payını, PDF/X versiyasını və üz qabığının necə təqdim olunacağını konkret mətbəə müəyyən edir. Mətbəədən texniki tələbləri səhifələməyə başlamazdan əvvəl istəyin — onda ilk imtinadan sonra maketi yenidən işləmək lazım gəlməyəcək.',
    ],
    'dizajn-dlya-socsetej-razmery-i-shablony' => [
        'seoTitle' => 'Instagram dizaynı: ölçülər, post və stories şablonları',
        'seoDesc'  => 'Instagram və Facebook hansı post, stories və örtük ölçülərini qəbul edir, profildə önizləmə necə kəsilir və şirkətə post və stories şablonları niyə lazımdır.',
        'title'    => 'Sosial şəbəkələr üçün dizayn: Instagram və Facebook formatları, örtüklər və şablonlar',
        'desc'     => 'Instagram və Facebook hazırda hansı nisbət və ölçüləri qəbul edir, profil şəbəkəsi önizləmələri necə kəsir və post və stories şablonları niyə vaxta qənaət edir.',
        'rubric'   => 'Dizayn',
        'lead'     => 'Lentdə post səliqəli görünür, profildə isə başlığın kənarları kəsilib. Şəbəkədə videonun örtüyündən üzün yarısı qalıb. Stories post üçün hazırlanmış şəkildən yığılıb — yuxarıda və aşağıda boş zolaqlar əmələ gəlib. Hər həftə isə kimsə şəklin hansı ölçüdə olmalı olduğunu yenidən axtarır. Gəlin baxaq: Instagram və Facebook hazırda hansı formatları qəbul edir, profil şəbəkəsi önizləmələri necə kəsir və sosial şəbəkələr üçün dizaynı post və stories şablonları toplusuna necə çevirmək olar.',
        'body'     => [
            ['Lentdəki postlar: Instagram hansı nisbətləri qəbul edir', 'Əvvəlcə bir qeyd-şərt: platformalar ölçüləri tətbiqlərin yenilənmələri ilə birlikdə dəyişir. Aşağıdakı rəqəmlər 2026-cı ilin oktyabrında Instagram və Facebook-un yardım mərkəzləri, həmçinin Meta-nın reklam təlimatı ilə tutuşdurulub.

Instagram-ın yardım mərkəzinə görə, eni 320-dən 1080 pikselə qədər olan foto, tərəflərinin nisbəti 1,91:1 ilə 3:4 arasındadırsa, ilkin ayırdetmə qabiliyyətində saxlanılır. En 1080 piksel olduqda bu, hündürlüyün 566-dan 1440-a qədər olması deməkdir. Başqa nisbətli foto icazə verilən nisbətə qədər kəsilir. Eni 320 pikseldən dar olan şəkli platforma bu enə qədər böyüdür, 1080-dən geniş olanı isə 1080-ə qədər kiçildir.

Buradan dörd işlək ölçü çıxır:

— 1080×1080 — kvadrat, 1:1;
— 1080×1350 — şaquli, 4:5;
— 1080×1440 — şaquli, 3:4, lent üçün ən hündür variant;
— 1080×566 — üfüqi, 1,91:1.

Eyni endə şaquli format telefon ekranında daha çox yer tutur — onun xeyrinə əsas arqument budur. 4:5 ilə 3:4 arasında seçim reklamdan asılıdır. Meta-nın reklam təlimatında Instagram və Facebook lentləri üçün ayırdetmə qabiliyyəti 1440×1800 piksel olan 4:5 formatı tövsiyə olunur, Instagram lentindəki reklam üçün isə 4:5 həm də icazə verilən ən uzunsov nisbətdir. Post təşviqə gedə bilərsə, onu elə əvvəldən 4:5-də hazırlamaq daha rahatdır: bir maket həm lentə, həm də reklama yarayacaq.'],
            ['Profil şəbəkəsi: post açılmadan əvvəl nə görünür', '2025-ci ilin yanvarında Instagram profilin kvadrat şəbəkəsini şaquli şəbəkə ilə əvəz edib. İndi oradakı önizləmələrin nisbəti 3:4-dür və onlar standart olaraq mərkəz saxlanılmaqla kəsilir, postun özü isə açılanda bütöv göstərilir. Belə çıxır ki, hər dərcin iki versiyası var: lentdə tam, profildə isə kəsilmiş.

İlkin maketin pikselləri ilə hesablasaq, itki belədir:

— 3:4 post (1080×1440) şəbəkədə kəsilmədən göstərilir;
— 4:5 post (1080×1350) hər yandan təxminən 34 piksel itirir;
— 1080×1080 kvadrat soldan da, sağdan da 135 piksel, yəni enin dörddə birini itirir;
— 1,91:1 üfüqi formatdan enin yarısından azı qalır;
— 9:16 videonun kadrı (1080×1920) yuxarıdan da, aşağıdan da 240 piksel itirir.

Buradan şəbəkə dəyişdikdən sonra Instagram dizaynının əsas qaydası çıxır: başlığı, üzü, məhsulu və loqonu mərkəzi 3:4 zonasında saxlayın. Kvadrat üçün bu, ortada eni 810 piksel olan zolaq, 9:16 kadr üçün isə mərkəzdə 1080×1440 ölçülü düzbucaqlıdır.

Artıq dərc olunmuş postun önizləməsini düzəltmək olar: Instagram şəklin hansı hissəsinin şəbəkə çərçivəsinə düşəcəyini seçməyə imkan verən ayar əlavə edib. Profildə karuselin birinci slaydı göstərilir — örtük rolunu da elə o oynayır.'],
            ['Stories və Reels: 9:16 kadr', 'Instagram və Facebook-da stories və Reels nisbəti 9:16 olan tam ekranlı şaquli formatlardır. En 1080 piksel olduqda bu, 1080×1920 deməkdir. Meta-nın reklam təlimatında stories və Reels üçün 1440×2560 tövsiyə olunur — eyni nisbət, ayırdetmə qabiliyyəti üzrə ehtiyatla.

Post şəklini stories-də olduğu kimi istifadə etməmək daha yaxşıdır. Kvadrat və ya 4:5 şaquli ekranın yalnız bir hissəsini tutacaq, üzərindəki mətn isə xırdalaşacaq. Stories postun kiçildilmiş surəti deyil, öz şablonunda hazırlanan ayrıca maketdir.

Şaquli kadrın bir hissəsini interfeys örtür. Reklam məqsədli stories və Reels üçün Meta yuxarıda hündürlüyün təxminən 14%-ni, aşağıda 35%-ni, hər iki yanda isə enin 6%-ni mətn və loqodan boş saxlamağı məsləhət görür — orada onları profil nişanı və fəaliyyətə çağırış düyməsi örtə bilər. Kadrın üstündə konkret olaraq nəyin yerləşdiyi şaquli videoda təhlükəsiz zona haqqında ayrıca məqalədə ətraflı izah olunub. Şablon üçün bu zonaları köməkçi xətlərlə qeyd etmək kifayətdir ki, qiymət və ya ünvan düymələrin altında qalmasın.'],
            ['Örtüklər və avatarlar: kiçik sahə, gözə çarpan səhvlər', 'Reels örtüyü videonun kadrlarından seçilir və ya ayrıca şəkil kimi yüklənir. Yüklənən örtük üçün Instagram-ın yardım mərkəzi 420×654 piksel tövsiyə edir — bu, təxminən 1:1,55 nisbətidir. Profil şəbəkəsində həm belə örtük, həm də videodan götürülmüş kadr yuxarısı və aşağısı kəsilməklə 3:4 çərçivədə göstərilir. Ona görə də başlığı və əsas obyekti hündürlüyə görə ortada yerləşdirirlər.

Seçilmiş stories (Highlights) örtükləri Instagram profilində kiçik dairələr şəklində göstərilir. Belə dairədə xırda mətn oxunmur — bütün sıra üçün vahid üslubda sadə ikona işləyir.

Hər iki platformada profil fotosu dairə şəklində kəsilir. Facebook-un yardım mərkəzi səhifənin profil fotosunu 320×320 piksel ölçüdə yükləməyi məsləhət görür; kompüterdə o, 176×176, smartfonda isə 196×196 ölçüdə göstərilir. Xırda yazısı olan tam loqo belə dairədə itib-batır, ona görə də avatar üçün adətən loqonun simvolunu və ya qısaldılmış variantını götürürlər.

Ən çox incəlik tələb edən Facebook səhifəsinin örtük şəklidir. Yardım mərkəzinə görə, o, ən azı 400×150 piksel olmalıdır, ən tez isə sRGB-də, 851×315 piksel ölçüdə və 100 KB-dan yüngül JPG faylı kimi yüklənir. Kompüterdə və telefonda onu müxtəlif nisbətlərdə, sol kənara düzləndirilmiş şəkildə göstərirlər, sol hissəni isə qismən profil fotosu örtür — telefonda o, örtük şəklinin üstünə təxminən 40 piksel çıxır. Deməli, mətni və loqonu mərkəzə yaxın yerləşdirir, kənarları isə itirilməsinə heyif olmayan fona ayırırlar.'],
            ['Karusellər: bir nisbət və ümumi maket toru', 'Bir Instagram dərcinə 20-yə qədər foto və video yığmaq olar. Oriyentasiya — kvadrat, şaquli və ya üfüqi — hamısı üçün bir dəfə seçilir: Instagram-ın yardım mərkəzinə görə, ayrı-ayrı slaydlar üçün fərqli oriyentasiya təyin etmək olmur. Başqa nisbətli slaydları kadrlamaq lazım gələcək, ona görə də hamısını elə əvvəldən eyni ölçüdə hazırlayırlar.

Vahidliyin ikinci tərəfi vizualdır. İnsan slaydları vərəqləyir və hərəkət etməməli olan hər şey yerində durmalıdır: kənar boşluqlar, başlığın mövqeyi, loqo, slaydın nömrəsi. İkinci slayddakı başlıq birincidəkindən bir neçə piksel aşağıdadırsa, vərəqləyəndə bu, titrəmə kimi görünür. Ona görə də karusel şablonunda adətən bir neçə slayd növü əvvəlcədən hazırlanır: örtük, mətnli slayd, fotolu slayd, əlaqə məlumatları olan son slayd.

Slayddan slayda keçən bütöv fonu bir uzun kətan kimi yığır və düz slaydın eninə görə kəsirlər: bir neçə piksellik səhv birləşmə yerində pillə kimi görünür.'],
            ['Sosial şəbəkələr üçün dizaynı niyə şablonlara yığmağa dəyər', 'Şablon olmadan hər dərcə boş kətandan başlanır: ölçü yada salınır, şrift seçilir, loqo o yan-bu yana çəkilir. Bir dəfə qəbul edilmiş qərarlar hər həftə əl ilə təkrarlanır və hər təkrarda lentin vahid üslubu bir az da pozulur.

Şablon dəyişməməli olanı sabitləyir:

— hər format üçün kətanın ölçüsü: post, karusel slaydı, stories, Reels örtüyü;
— köməkçi xətlər şəklində kənar boşluqlar və təhlükəsiz zonalar;
— mətn üslubları: başlıq, əsas mətn, şəkilaltı yazı;
— rənglər və loqonun yeri;
— foto üçün çərçivələr və onların kadrlanma qaydaları.

Onda yeni dərc sıfırdan dizayn deyil, mətnin və fotonun dəyişdirilməsidir. Belə faylı dizaynla məşğul olmayan əməkdaş da apara bilər.

Azərbaycan və rus dillərində dərc edirsinizsə, şablon hər iki dilə tab gətirməlidir. Eyni ifadə iki dildə fərqli uzunluqda olur: bir sətirlik başlıq ikinci dildə iki sətrə keçir və buna yer elə əvvəldən ayrılır. Şrifti ayrıca yoxlayın: Azərbaycan əlifbasında Ə, Ğ, Ç, Ş, Ö, Ü, həmçinin nöqtəsiz I və nöqtəli İ var. Bu hərflər bütün şriftlərdə, xüsusən dekorativ şriftlərdə olmur və onda onların yerində başqa şriftin simvolları və ya boş düzbucaqlılar peyda olur. Şrifti təsdiqləməzdən əvvəl bütün bu hərflərin olduğu bir ifadə yazın.'],
            ['Fayl formatları və dərcdən əvvəl yoxlama', 'Meta-nın reklam təlimatında təsvirlər üçün JPG və PNG göstərilib. JPG fotoşəkillər üçün uyğundur. PNG itkisiz sıxır və mətnin və loqonun kəskin kənarlarını daha yaxşı saxlayır — Facebook-un yardım mərkəzi onu loqo və ya mətn olan profil fotoları və örtük şəkilləri üçün birbaşa tövsiyə edir. Rəng profili — sRGB: onu da həmin yardım mərkəzi göstərir.

Video üçün həmin təlimatda MP4 və MOV, H.264 sıxılması və 128 kbit/s-dən başlayan AAC stereo səs göstərilib.

Şablonların özünü redaktə edilə bilən şəkildə — qatlar, üslublar və şriftlərlə — onlarla işlədiyiniz redaktorda saxlayın: Figma, Canva və ya Photoshop. JPG və PNG ixrac nəticəsidir, mənbə fayl deyil.

Dərcdən əvvəl maketə telefonda baxın: lentdə və profil şəbəkəsində necə görünür, kiçik ekranda mətn oxunurmu, vacib nəsə kəsilən hissədə qalmayıb ki.'],
        ],
        'end'      => 'Sosial şəbəkələr üçün dizayn post ideyasından yox, düzgün kətandan başlayır: lent üçün 4:5 və ya 3:4, stories və Reels üçün 9:16, profil şəbəkəsinə düşəcək hər şey üçün mərkəzi 3:4 zonası. Bu qərarlar bir dəfə qəbul edilir və post və stories şablonlarına daxil edilir, sonra isə yalnız mətn və foto dəyişir. Altı ayda bir ölçüləri platformaların yardım mərkəzləri ilə tutuşdurun.',
    ],
    '3d-vizualizaciya-tovara-vmesto-fotosemki' => [
        'seoTitle' => '3D vizuallaşdırma, yoxsa fotoçəkiliş: hansını seçməli',
        'seoDesc'  => 'Əşya vizuallaşdırması nə vaxt fotoçəkilişdən rahatdır, nə vaxt fotoşəkil daha yaxşıdır, dizaynerə nə verməli, sayt və çap üçün hansı faylları təhvil almalı.',
        'title'    => 'Məhsulun 3D vizuallaşdırması, yoxsa fotoçəkiliş: nəyi seçməli və nə hazırlamalı',
        'desc'     => 'Məhsulun 3D renderi nə vaxt fotoçəkilişi əvəz edir, nə vaxt yox: dizaynerə hansı ilkin məlumatlar lazımdır, sayt, artırılmış reallıq və çap üçün isə hansı faylları təhvil almaq gərəkdir.',
        'rubric'   => 'Dizayn',
        'lead'     => 'Yeni məhsul xətti anbara yalnız bir-iki aydan sonra gələcək, sayt və kataloq isə elə indi lazımdır. Ya da kreslonun on üzlük variantı var və hər birini çəkmək studiyaya on kreslo aparmaq deməkdir. Belə hallarda adətən 3D vizuallaşdırma təklif edirlər: məhsulun təsvirini çəkmirlər, rəqəmsal model əsasında qururlar. Gəlin görək, bu nə vaxt həqiqətən çəkilişdən rahatdır, nə vaxt fotoşəkil daha dürüst və daha sadədir, dizayner üçün nə hazırlamalı və sonda hansı faylları təhvil almalı.',
        'body'     => [
            ['3D vizuallaşdırma fotoçəkilişdən nə ilə fərqlənir', 'Fotoqraf kameranın qarşısında olanı çəkir. 3D vizuallaşdırmada isə kameranın qarşısında heç nə yoxdur. Dizayner ölçülərə əsasən məhsulun rəqəmsal modelini qurur, materiallara xüsusiyyətlər verir — rəng, parıltı, pürüzlülük, şəffaflıq, — virtual işığı və kameranı yerləşdirir. Proqram işığın səthlərdən necə əks olunduğunu hesablayır və təsvir yaradır. Buna da render deyilir.

Əsas fərq də buradan irəli gəlir. Fotosessiya birdəfəlikdir: yeni rakurs və ya başqa rəng yenidən məhsul, işıq və fotoqraf deməkdir. Model isə bir dəfə hazırlanır, sonra ondan istənilən kadrı almaq olur: başqa bucaq, başqa rəng, başqa fon, detalın iri planı, kəsik.

Bunun əks tərəfi də var. Fotoşəkil mövcud olan əşyanı göstərir. Render isə nə təsvir olunubsa, onu göstərir. Qeyri-dəqiq çertyoj, təxmini rəng və ya uydurulmuş faktura şəklə keçəcək və şəkil inandırıcı görünəcək. Ona görə də əşya vizuallaşdırmasının keyfiyyəti təkcə dizaynerdən deyil, onun alacağı ilkin məlumatlardan da asılıdır.'],
            ['Məhsulun 3D dizaynı nə vaxt çəkilişdən daha əlverişlidir', 'Bəzi hallarda model, demək olar ki, həmişə üstün gəlir.

— Məhsul hələ yoxdur. Sayt, kataloq və dilerlər üçün təqdimat istehsaldan sonra deyil, onunla paralel hazırlanır.
— Variantlar çoxdur. Model birdir, üzlüyün rəngi, korpusun örtüyü və ya etiket isə materialı və ya teksturanı əvəz etməklə dəyişdirilir. Məhsul elanları üçün bu, həm də tələbdir: Google Merchant Center hamısı üçün bir ümumi şəkil deyil, hər variant üçün ayrıca təsvir istəyir.
— Qablaşdırma. Qutunun və ya etiketin maketini modelin üzərinə qoyur və tiraj çapa getməzdən əvvəl onun qatlanma xətləri və tillər üzərində necə yerləşdiyinə baxırlar. Qutular mətbəədən yolda olarkən həmin kadrlarla məhsulu saytda göstərmək olar.
— Səhnələr və interyerlər. Mebeli, işıqlandırma cihazlarını, santexnikanı, bəzək materiallarını mövcud olmayan otağa yerləşdirmək olar — məkan icarəsi və daşınma olmadan.
— Vahid kataloq. Bütün məhsullar üçün eyni işıq, rakurs və miqyas. Bir il sonra yeni məhsulu həmin səhnəyə qoyurlar və o, ümumi sıradan seçilmir.
— Kənardan görünməyənlər. Kəsik, daxili quruluş, hissələrin ayrılmış görünüşü — bunu fotoşəkillə göstərmək çətin və ya mümkünsüzdür.'],
            ['Fotoşəkil nə vaxt renderdən yaxşıdır', 'Məhsul artıq anbardadırsa, variantlar azdırsa və ağ fonda adi məhsul kartı lazımdırsa, çəkiliş, bir qayda olaraq, daha sadədir. Sıfırdan modelləşdirmə o zaman özünü doğruldur ki, sonra modeldən çoxlu kadr alınacaq.

Canlı faktura həlledici olan yerdə də fotoşəkil daha güclüdür: yemək, içkilər, dəridə krem, insanın əynində parça. Kadrda insanlar olanda da — jest, emosiya, geyimin əyində necə durması. Bunu 3D-də yaratmaq olar, amma bu, əşyanı göstərməkdən xeyli çətindir.

Platformaların qaydaları ayrıca məsələdir. Google Merchant Center tələb edir ki, əsas təsvir məhz satılan məhsulu aydın göstərsin, fiziki məhsulu əks etdirməyən maketləri və illüstrasiyaları isə qadağan edir. Təsvirlərə dair tələblərdə fotorealistik renderlər barədə birbaşa heç nə deyilmir, ona görə də renderi elanda və ya marketpleysdə əsas təsvir kimi qoymazdan əvvəl konkret platformanın qaydalarını oxuyun. Generativ süni intellektlə yaradılmış şəkillər üçün Google-un ayrıca tələbi var: faylda təsvirin generasiya olunduğunu bildirən metaməlumatlar olmalıdır və onları silmək olmaz. 3D proqramındakı render sizin təyin etdiyiniz həndəsə və materiallar əsasında hesablanır. Əgər fonu və ya detalları neyroşəbəkə tamamlayıbsa, platformanın belə kadrlara münasibətini yoxlayın.

Çox vaxt ikisini birləşdirmək daha məqsədəuyğundur: əsas kadr üçün fotoşəkil, rəng variantları, səhnələr və kəsiklər üçün isə renderlər.'],
            ['Əşya vizuallaşdırması üçün nə hazırlamaq lazımdır', 'İlkin məlumatlar nə qədər dəqiq olsa, düzəlişlər bir o qədər az olar, şəkil isə məhsula bir o qədər yaxın olar.

— Həndəsə. Ən yaxşısı məmulatın layihələndirildiyi proqramdan 3D modeldir: həmin proqramın öz formatında və ya STEP (ISO 10303) formatında — CAD sistemləri arasında məmulat haqqında məlumat mübadiləsi formatında. Model yoxdursa, ölçüləri göstərilmiş DWG, DXF və ya PDF çertyojları. Çertyoj da yoxdursa, ölçmək və hər tərəfdən fotoşəklini çəkmək mümkün olan nümunə.
— Materiallar. Hər detal üçün: nədən hazırlanıb, matdır, yoxsa parlaq, hamardır, yoxsa fakturalı. Rəng istehsalatın istifadə etdiyi kataloq üzrə kodla, məsələn, RAL və ya Pantone ilə, daha yaxşısı isə fiziki nümunə ilə: eyni rəng müxtəlif monitorlarda fərqli görünür, nümunəni isə ekranın yanına qoymaq olar.
— Qrafika. Loqo və yazılar vektor formatında. Qablaşdırma üçün mətbəədən və ya qablaşdırma istehsalçısından qutunun açılmış sxemi və hazır çap maketi.
— Referenslər. İşığına, fonuna və əhval-ruhiyyəsinə görə xoşunuza gələn bir neçə şəkil və xoşunuza gəlməyən bir-iki şəkil. Bu, üslubu sözlə izah etməkdən daha tez və daha dəqiqdir.
— Kadrların siyahısı. Hansı rakurslar, hansı variantlar, şəkillər harada və hansı ölçüdə istifadə olunacaq.

Tez-tez rast gəlinən problem STL fayllarıdır. Onları 3D çap üçün ixrac edirlər və onlar yalnız üçbucaqlardan yığılmış səthi təsvir edir; formatın standartında rəng və material yoxdur. Üçbucaqlar şəbəkəsi kobud ixrac olunubsa, hamar əyrilər iri planda nəzərə çarpan tillərə çevrilir. Əsas kimi STL yararlıdır, amma materialları yenidən təyin etmək, bəzən isə səthləri də yenidən qurmaq lazım gələcək.'],
            ['Yenidən işləməmək üçün necə razılaşdırmalı', 'Rahat ardıcıllıq belədir: formadan detallara doğru, hər addımda təsdiqlə.

1. Boz model. Materialsız, neytral işıqda təsvir. Burada yalnız həndəsəni yoxlayırlar: proporsiyaları, radiusları, düymələrin, tikişlərin, bərkidicilərin yerini. Yaddaşa görə deyil, çertyoj və nümunə ilə tutuşdurun.
2. Materiallar və rəng. Forma təsdiqləndikdən sonra materiallar təyin olunur. Rəngi yaxşı işıqda və bir neçə ekranda, o cümlədən telefonda fiziki nümunə ilə müqayisə edirlər.
3. İşıq, fon və kompozisiya. Son addım kadrların təsdiqlənmiş siyahı üzrə qurulmasıdır.

Həndəsəni birinci addımda düzəltmək bir modeli düzəltmək deməkdir. Onu son kadrlardan sonra düzəltmək isə bütün kadrları yenidən hesablamaq deməkdir.

Sonda nə alacağınızı əvvəlcədən razılaşdırın: yalnız təsvirləri, yoxsa həm də modeli və səhnə fayllarını. Bir il sonra yeni rəng və ya yeni rakurs lazım olsa, mənbə faylları olmadan onu yenidən qurmaq lazım gələcək.'],
            ['Sayt və çap üçün hansı formatları təhvil almalı', 'Sayt üçün. Rəng fəzası sRGB-dir: CSS spesifikasiyasına görə brauzer daxili profili olmayan təsvirləri məhz sRGB kimi qəbul edir. Formatlar: WebP və ya AVIF, ehtiyat variant kimi JPEG. Məhsul şəffaf fonda lazımdırsa, JPEG yaramır: onda alfa-kanal yoxdur, PNG, WebP və AVIF-də isə var. Məhsul elanları üçün Google ən azı 1500×1500 piksel ölçüsündə təsvirlər tövsiyə edir. Merchant Center-in formatlar siyahısında AVIF yoxdur, ora JPEG, PNG və ya WebP verilir.

3D baxış və artırılmış reallıq üçün. Sayt üçün model glTF formatında və ya onun binar versiyası olan GLB-də verilir. Bu, açıq formatdır, onun 2.0 versiyası 2022-ci ildən ISO/IEC 12113 beynəlxalq standartı kimi təsbit olunub. Android-də 3D və artırılmış reallıq baxış vasitəsi olan Scene Viewer da məhz bu formatı oxuyur; Google belə modelləri 10 MB həddində saxlamağı tövsiyə edir. iPhone və iPad-də Safari-dən artırılmış reallığı AR Quick Look açır və ona USDZ formatında fayl lazımdır. Hər iki platformada «öz otağınızda baxın» düyməsi lazımdırsa, hər iki formatı istəyin.

Çap üçün. Ayırdetmə qabiliyyəti çapın son ölçüsünə əsasən hesablanır. Mətbəələrin geniş yayılmış tələbi düym başına 300 pikseldir: bütöv A4 vərəqini (210×297 mm) tutan şəkil üçün 2480×3508 piksel lazımdır. Uzaqdan baxılan iri formatlar üçün tələblər daha aşağıdır. Dəqiq rəqəmləri, rəng rejimini və profili mətbəə deyəcək. Master faylı isə hər halda RGB-də saxlayın. Ekranın bəzi doymuş rəngləri CMYK-da təkrarlanmır: çevirmə zamanı onlar sürüşür və əks çevirmə ilə onları geri qaytarmaq olmur. Ona görə də qablaşdırma və kataloq üçün sınaq çapı sifariş etməyə dəyər.'],
        ],
        'end'      => 'Render fotoşəkildən nə yaxşı, nə də pisdir — o, başqa vəzifələri həll edir: hələ mövcud olmayanı istənilən rəngdə və istənilən səhnədə, bütün kataloq üçün eyni şəkildə göstərmək. Onun dəqiqliyi ilkin məlumatların dəqiqliyinə bərabərdir, ona görə də sizin tərəfinizdən əsas iş çertyojlar, material nümunələri və kadrların siyahısıdır. Və təkcə şəkilləri deyil, modeli də təhvil alın: növbəti kadrlar ondan qurulur.',
    ],
    'seo-prodvizhenie-s-chego-nachat' => [
        'seoTitle' => 'Saytın SEO ilə irəlilədilməsi: Google-da nədən başlamalı',
        'seoDesc'  => 'Search Console, indeksləmə, sitemap.xml və robots.txt, başlıqlar və daxili linklər: SEO audit nədən başlayır, Google-da irəlilətmə niyə dərhal nəticə vermir.',
        'title'    => 'Şirkət saytının Google-da SEO ilə irəlilədilməsi nədən başlayır',
        'desc'     => 'SEO audit və saytın irəlilədilməsi nədən başlayır: Search Console, indeksləmə, sitemap.xml və robots.txt, başlıqlar, daxili linklər və nəticənin niyə dərhal görünmədiyi.',
        'rubric'   => 'Marketinq',
        'lead'     => 'Şirkətin saytı bir ildən artıqdır ki, işləyir, amma Google-da onu yalnız şirkətin adı ilə tapırlar, xidmətin adı ilə isə tapmırlar. İlk fikir saytın SEO ilə irəlilədilməsini və ya heç olmasa auditi sifariş etməkdir. Amma bu işin nədən başladığını özünüz də yoxlaya bilərsiniz: Google səhifələriniz barədə bilirmi, onlardan hansıları indeksə düşüb və insan axtarış nəticələrində nə görür. Gəlin əsas məsələləri sıra ilə araşdıraq — Search Console-dan tutmuş effekti niyə həftələrlə və aylarla gözləmək lazım gəldiyinə qədər.',
        'body'     => [
            ['Search Console: Google saytınızı necə görür', 'Google Search Console pulsuz servisdir: Google orada sayt sahibinə onun saytını necə gördüyünü göstərir. Axtarışa düşmək üçün orada qeydiyyatdan keçmək vacib deyil. Amma onsuz sayta yalnız içəridən baxırsınız, ona görə də SEO auditə onun hesabatlarından başlamaq məntiqlidir.

Sayt iki növ resursdan biri kimi əlavə olunur:

— «Domen resursu» bütün subdomenləri və protokolları əhatə edir: www ilə və onsuz, http və https. Ona sahiblik yalnız domenin DNS-ində yazı ilə təsdiqlənir;
— «URL prefiksli resurs» yalnız göstərilən hissə ilə başlayan ünvanları əhatə edir, protokol da daxil olmaqla. Onu başqa üsullarla da təsdiqləmək olar: saytın kök qovluğundakı HTML faylı, ana səhifədəki meta teq, Google Analytics və ya Google Tag Manager kodu ilə.

DNS-ə girişiniz varsa, domen resursu daha rahatdır: ünvanın bütün variantları üzrə məlumatlar bir yerə toplanır. Təsdiqdən sonra yazını, faylı və ya meta teqi silməyin: Search Console onları tapa bilməsə, təsdiqlənmiş hüquqlarınız bir müddət sonra qüvvədən düşəcək.

Başlanğıcda ən faydalısı axtarış nəticələrində effektivlik hesabatıdır. O, saytın hansı sorğular üzrə və hansı səhifələrlə axtarışda göründüyünü göstərir: göstərmələr, kliklər, CTR və orta mövqe. Search Console məlumatları son 16 ay üçün saxlayır.'],
            ['Hansı səhifələr indeksə düşüb', 'Cavab səhifələrin indekslənməsi hesabatındadır. O, saytın Google-a məlum olan ünvanlarını iki qrupa bölür: «İndekslənib» və «İndekslənməyib». Axtarış nəticələrində yalnız indeksdə olan görünə bilər.

İkinci qrup özlüyündə narahatlıq üçün səbəb deyil: indeksə bütün ünvanlar deyil, yalnız kanonik ünvanlar — səhifələrin əsas versiyaları düşməlidir. «Yönləndirməsi olan səhifə» və ya «Canonical teqi olan alternativ səhifə» normal səbəblərdir. Vacib olan başqadır: indekslənməyənlər arasında müraciət gətirməli olan səhifələr — xidmətlər, kataloq, əlaqə — varmı.

Nəyi araşdırmağa dəyər:

— «Aşkarlanıb, indekslənməyib» — Google ünvanı bilir, amma onu hələ skan etməyib;
— «Səhifə skan edilib, amma hələ indekslənməyib» — səhifə oxunub, amma indeksə daxil edilməyib;
— «Tapılmadı (404)» əslində başqa ünvana köçmüş səhifədədirsə — yeni ünvana daimi 301 yönləndirməsi lazımdır;
— «Yalançı 404 xətası» — səhifə ziyarətçiyə heç nə tapılmadığını bildirir, amma server 404 kodu qaytarmır.

Ayrıca bir ünvanı URL yoxlama alətində açmaq olar: orada Google-un səhifəni sonuncu dəfə nə vaxt skan etdiyi və onun hansı variantını kanonik seçdiyi görünür. «İndeksləməni tələb et» düyməsi Google-dan səhifəni yenidən skan etməyi xahiş edir. Bu, indeksə düşməyə zəmanət vermir, eyni ünvan üçün təkrar sorğular isə skan etməni sürətləndirmir. Xəta düzəldiləndə hesabatda «Düzəlişi yoxla» düyməsini basın: yoxlama adətən təxminən iki həftə, bəzən daha çox çəkir.'],
            ['sitemap.xml və robots.txt: iki xidməti fayl', 'sitemap.xml axtarışda görmək istədiyiniz ünvanların siyahısıdır. Google üçün bu, əmr deyil, ipucudur: xəritə bütün ünvanların skan edilməsinə və indekslənməsinə zəmanət vermir. Ünvanlar tam şəkildə, protokol və domenlə birlikdə göstərilir; bir faylda ən çoxu 50 000 ünvan və sıxılmamış halda 50 MB ola bilər. Google priority və changefreq sahələrinə məhəl qoymur, lastmod tarixini isə yalnız o, səhifənin son əhəmiyyətli dəyişikliyi ilə daim üst-üstə düşəndə nəzərə alır. Təxminən 500 səhifəyə qədər olan və bütün vacib səhifələrinə link verilmiş kiçik sayta xəritə heç lazım olmaya da bilər, baxmayaraq ki, əksər hallarda o, faydalıdır. Onu Sitemap faylları hesabatı vasitəsilə göndərmək olar — orada Google-un onu alıb-almadığı və xəta tapıb-tapmadığı görünür.

robots.txt saytın kök qovluğunda yerləşən və robotlara hansı ünvanları skan edə biləcəklərini deyən fayldır. Əsas yanlış təsəvvür budur: robots.txt səhifələri Google-dan silmir. Orada bağlanmış, amma haradasa linki olan ünvan nəticələrdə görünə bilər — sadəcə təsvirsiz. Səhifənin axtarışda olmaması üçün noindex (meta teq və ya HTTP başlığı) və ya parol lazımdır. Burada da bir tələ var: səhifə robots.txt-də bağlanıbsa, robot onun noindex-ini görməyəcək.

Sayt işə düşən kimi brauzerdə domeniniz/robots.txt ünvanını açın. User-agent: * sətrindən sonra gələn Disallow: / sətri axtarış robotlarına bütün saytı skan etməyi qadağan edir. Onu saytın test nüsxəsinə qoyurlar və saytı işə salanda silməyi unutmaq asandır.'],
            ['Axtarış nəticələrində başlıq və təsvir', 'Link-başlığı və onun altındakı bir-iki sətri Google avtomatik formalaşdırır.

Başlıq üçün o, mətni bir neçə mənbədən götürür: title teqi, h1 başlığı, og:title meta teqi, səhifənin özündəki linklərin mətni və ona aparan linklər. Uzunluq üçün sərt limit yoxdur, uzun başlıq kəsilir — adətən ekranın eninə görə. Birbaşa idarə etdiyiniz isə title teqidir:

— hər səhifənin məhz onu təsvir edən öz title teqi olmalıdır;
— dəqiqləşdirməsiz «Ana səhifə» və ya «Xidmətlər» olmasın;
— şirkətin adı qısa, əvvəldə və ya sonda, ayırıcı işarə ilə;
— açar sözlər sadalanmadan.

Təsviri Google əsasən səhifənin mətnindən tərtib edir, description meta teqindən isə o, səhifəni daha dəqiq təsvir edəndə istifadə edir. Burada da uzunluq limiti yoxdur, artıq hissə kəsilir. Hər səhifənin öz təsviri olmalı və o, sözlər yığını kimi deyil, cümlə kimi oxunmalıdır. Google keywords meta teqindən ümumiyyətlə istifadə etmir.'],
            ['Bir sorğu — bir səhifə', 'Bir xidmət həm ana səhifədə, həm xidmətlər səhifəsində, həm də daha bir-iki oxşar mətndə təsvir olunanda Google belə səhifələri bir qrupda birləşdirir və onlardan birini — ən dolğun və faydalı hesab etdiyini kanonik seçir. Qalanları daha seyrək skan edilir. Öz variantınızı canonical teqi ilə göstərə bilərsiniz, amma Google üçün bu, qayda deyil, ipucudur.

Dublikatlar özlüyündə Google-un qaydalarını pozmur, amma hansı səhifənin göstəriləcəyini artıq siz seçməyəcəksiniz. Ona görə də hər sorğunun ona digərlərindən daha yaxşı cavab verən bir səhifəsi olmalıdır. Məsələn, blogdakı məqalə «bu necə qurulub» sualına cavab verir, xidmət səhifəsi isə «haradan sifariş etmək olar» sualına.

Ayrıca risk şəhərlər üçün açılan səhifələrdir. Ziyarətçini eyni səhifəyə aparan «Bakıda xidmət», «Sumqayıtda xidmət», «Gəncədə xidmət» səhifələrini Google spam qaydalarında dorvey səhifələrinə nümunə kimi göstərir. Saytın sıralanmaq istədiyi şəhər və regionların siyahısından ibarət mətn blokunu isə — açar sözlərlə həddindən artıq doldurmaya nümunə kimi. Bakıda işləyirsinizsə, şəhərin adını başlıqda, mətndə və əlaqə məlumatlarında təbii şəkildə çəkin, ayrıca klon səhifələr yaratmadan.'],
            ['Daxili linklər və sürət', 'Google səhifələri əsasən artıq skan etdiyi səhifələrdəki linklər vasitəsilə tapır. Ona görə də hər vacib səhifəyə saytın ən azı bir başqa səhifəsindən link aparmalıdır. Daxili linki olmayan və sitemap.xml-də də yer almayan səhifə gözdən kənarda qala bilər.

Link əsl link olmalıdır: href atributu olan a elementi. Basanda başqa səhifəni skriptlə açan düymələri və blokları Google etibarlı şəkildə tanıya bilmir. Linkin mətni onun hara apardığını deməlidir: «korporativ saytların hazırlanması», «ətraflı» və ya «bura basın» yox. Amma ora bütün açar sözləri yazmağa da dəyməz.

Sürət vacibdir, amma əsas amil deyil. Ayrıca məqalədə ətraflı izah olunan Core Web Vitals metrikaları sıralamada nəzərə alınır, lakin səhifənin rahatlığında hər şey ideal olmasa belə, Google ən relevant cavabı göstərəcək. Mobil versiya barədə də: Google saytı məhz onun əsasında indeksləyir və sıralayır, buna görə də telefondakı mətnlər və başlıqlar kompüterdəkilərlə eyni olmalıdır.'],
            ['Saytın SEO ilə irəlilədilməsi niyə dərhal nəticə vermir', 'Google axtarışı üç mərhələdə işləyir: skan etmə, indeksləmə və nəticələrdə göstərmə. Hər səhifə üç mərhələnin hamısından keçmir və Google onların heç birinə zəmanət vermir. Sorğudan sonra skan etmə bir neçə gündən bir neçə həftəyə qədər çəkə bilər. Google özü yazır ki, bəzi dəyişikliklər axtarışda bir neçə saata, digərləri isə bir neçə aya əks olunur, effekti isə ən azı bir neçə həftə keçəndən sonra qiymətləndirmək məsləhətdir.

Sürətləndirməni satın almaq olmaz: Google nə daha tez-tez skan etmə, nə də adi nəticələrdə daha yüksək mövqelər üçün pul almır. Bakıda Google-da irəlilətməni birinci yerə zəmanətlə təklif edirlərsə, bu, ehtiyatlı olmaq üçün səbəbdir: Google-un sözlərinə görə, birinci yerə heç kim zəmanət verə bilməz.'],
        ],
        'end'      => 'SEO açar sözlərdən deyil, Google-un saytı sizin nəzərdə tutduğunuz kimi görməsindən başlayır: lazımi səhifələr indeksdədir, artıq səhifələr düzgün bağlanıb, hər səhifənin öz başlığı, öz sorğusu və ona aparan daxili linklər var. Bunların çoxunu Search Console-da özünüz yoxlaya bilərsiniz. Düzəlişlərin effektini isə həftələr və aylar ərzində, müqayisə oluna bilən dövrlər üzrə göstərmələri və klikləri tutuşdurmaqla qiymətləndirirlər.',
    ],
    'semanticheskoe-yadro-na-treh-yazykah' => [
        'seoTitle' => 'Semantik nüvə: üç dildə açar sözlərin seçilməsi',
        'seoDesc'  => 'Sayt üçün açar sözləri Azərbaycan, rus və ingilis dillərində necə toplamaq olar: sorğuları haradan götürmək, «в Баку» və «Bakıda», ə və ğ olmadan yazılış.',
        'title'    => 'Azərbaycanda sayt üçün semantik nüvə: üç dil və ə, ğ olmadan yazılan sorğular',
        'desc'     => 'Sorğuları haradan götürmək, kommersiya sorğularını informasiya sorğularından necə ayırmaq, «Bakıda» və «bakida» ilə nə etmək və açar sözləri üçdilli saytın səhifələri üzrə necə bölüşdürmək olar.',
        'rubric'   => 'Marketinq',
        'lead'     => 'Sayt üçün açar sözləri seçməyə başlayırsınız və elə ilk addımda bir suala ilişib qalırsınız: hansı dildə? Biri «ремонт кондиционеров в Баку» axtarır, digəri — «kondisioner təmiri», üçüncüsü eyni sözləri Azərbaycan hərfləri olmadan yığır, dördüncüsü isə ingiliscə yazır. Semantik nüvə bu dördünün hamısını nəzərə almalıdır, əks halda sayt axtaranların yalnız bir hissəsinə cavab verəcək. Gəlin araşdıraq: sorğuları haradan götürmək, kommersiya sorğularını informasiya sorğularından necə ayırmaq, «в Баку» və «Bakıda» ilə nə etmək və bütün bunları səhifələr üzrə necə bölüşdürmək olar.',
        'body'     => [
            ['Semantik nüvə nədir və ondan nə gözləməli', 'Semantik nüvə insanların sizin satdığınız şeyi axtararkən yazdığı sorğuların cədvəlidir; burada hər qrupun qarşısında saytın hansı səhifəsinin ona cavab verdiyi qeyd olunur. Bu, mətnə yerləşdirilməli sözlərin siyahısı deyil, plandır: hansı səhifələr lazımdır və hər biri nədən bəhs edir.

Ona görə də nüvəni saytın strukturundan və mətnlərindən əvvəl toplayırlar. Əvvəlcə menyunu çəkib, sonra ona uyğun sözlər seçsəniz, sorğuların bir hissəsinə cavab verəcək səhifənin olmadığı, iki səhifənin isə eyni şeyə iddia etdiyi üzə çıxa bilər.

Google-un yeni başlayanlar üçün bələdçisi oxucularınızın axtarışda işlətdiyi sözlər barədə düşünməyi məsləhət görür: mövzunu yaxşı bilən insanla bu sahədə təzə olan biri eyni sorğunu fərqli cür ifadə edəcək. Amma elə orada deyilir ki, hər variantı qabaqcadan təxmin etməyə ehtiyac yoxdur: mətndə dəqiq sözlər olmasa belə, Google-un sistemləri səhifənin sorğu ilə necə əlaqəli olduğunu anlayır. Google isə keywords metateqindən ümumiyyətlə istifadə etmir. Beləliklə, nüvə axtarış sisteminə ünvanlanmış mesaj deyil, sizin üçün iş alətidir.'],
            ['Açar sözlərin seçilməsi: sorğuları haradan götürməli', 'Mənbə bir neçədir və onların hər biri mənzərənin yalnız bir hissəsini verir.

Açar sözlər planlayıcısı (Keyword Planner) Google Ads-in daxilindədir. Google onu pulsuz adlandırır, amma yardım bölməsində qeyd olunur ki, hətta əsas funksiyaları açmaq üçün hesabın qurulmasını başa çatdırmaq və ödəniş məlumatlarını göstərmək lazımdır. Planlayıcıya bir neçə söz və ya istənilən saytın, məsələn, rəqibin saytının ünvanını vermək olar — o, həmin saytın məzmununa əsasən sorğular seçəcək. Məkan kimi «Azərbaycan»ı seçin. Dil məsələsi daha mürəkkəbdir: Azərbaycan dili Google Ads-in dillər siyahısında yoxdur, ona görə də dili məhdudlaşdırmamaq və nəticələri əl ilə təhlil etmək daha yaxşıdır.

Planlayıcının rəqəmləri barədə iki qeyd. «Aylıq orta axtarış sayı» (Avg. monthly searches) göstəricisini Google açar söz üçün onun yaxın variantları ilə birlikdə hesablayır. «Rəqabət səviyyəsi» (Competition) isə bu söz üzrə neçə reklamçının reklam göstərdiyini digər sözlərlə müqayisədə əks etdirir. Bu, reklam göstəricisidir, adi axtarış nəticələrinə düşməyin çətinliyi deyil.

Google Search Console artıq baş verənləri göstərir. Effektivlik hesabatında saytın axtarışda çıxdığı sorğuları, klikləri və orta mövqeyi görmək olar; məlumatları ölkəyə görə filtrləmək mümkündür. Nadir sorğuları — iki-üç ay ərzində ən çoxu bir neçə onlarla insanın verdiyi sorğuları — Google məxfilik naminə cədvəldə göstərmir.

Axtarış təklifləri real sorğuları əks etdirir. Onlara dil, məkan, mövzuya olan cari maraq və sizin əvvəlki axtarışlarınız təsir edir, ona görə də onlara inkognito pəncərəsində baxın. Təkliflər axtarış həcmini əvəz etmir: Google açıq şəkildə yazır ki, onlar sadəcə mövzu üzrə ən çox verilən sorğular deyil.

Rəqiblər. Axtarış nəticələrində artıq yer tutanların menyuları, xidmət səhifələrinin başlıqları və qiymət siyahıları bazarın sizin xidmətlərinizi necə adlandırdığını göstərir.

Və heç bir alətdə olmayan mənbə: müştərilərin sizə müraciətlərində və messencerlərdə özlərinin işlətdiyi sözlər.'],
            ['Üç dil və bir sorğunun bir neçə yazılışı', 'Azərbaycan əlifbasında 32 hərf var və onlardan yeddisi — ç, ə, ğ, ı, ö, ş, ü — ingilis klaviaturasında yoxdur. Telefonda Azərbaycan klaviatura düzümü aktiv deyilsə, insan bacardığı kimi yazır: ə əvəzinə e, ı əvəzinə i, ğ əvəzinə g, ş əvəzinə s. «Bakıda kondisioner təmiri» sorğusu «bakida kondisioner temiri» şəklini alır. Sizin üçün bu, bir sorğudur, amma alətlərdən ixrac etdiyiniz siyahılarda o, iki-üç yazılışda qarşınıza çıxa bilər.

Bununla nə etməli:

— axtarış təkliflərini hər iki yazılış üzrə yoxlayın: onlar üst-üstə düşməyə bilər;
— Search Console-da sorğuları sözün kökünə görə hər iki variantda filtrləyin, məsələn, «temir» və «təmir»;
— planlayıcının müxtəlif yazılışlar üzrə rəqəmlərini toplamayın: Google Ads diakritik işarəsiz yazılışları yaxın variantlara aid edə bilər və onda onlar artıq bir rəqəmdə nəzərə alınmış olur;
— hər yazılış üçün ayrıca səhifə yaratmayın.

Dillərlə də vəziyyət oxşardır. Rus dilindəki nüvəni Azərbaycan dilinə tərcümə etsəniz, tərcüməçinin sözlərini alırsınız, bu sözlər isə insanların axtarışda işlətdiyi sözlərlə üst-üstə düşməyə bilər. Ona görə də Azərbaycan və ingilis hissələrini eyni mənbələrdən yenidən toplayırlar. Saytın dil versiyalarını texniki cəhətdən bir-biri ilə necə əlaqələndirmək ayrıca mövzudur; nüvə üçün vacib olan odur ki, hər versiyanın öz sorğu siyahısı var.'],
            ['Lokal modifikatorlar: «в Баку», «Bakıda», «Baku»', 'Qiymətləndiricilər, yəni Google-un tapşırığı ilə axtarış nəticələrinin keyfiyyətini dəyərləndirən insanlar üçün hazırlanmış təlimatda sorğudakı şəhər açıq göstərilmiş məkan adlanır: insan nəticənin ona harada lazım olduğunu birbaşa deyir. «Ремонт кондиционеров в Баку», «Bakıda kondisioner təmiri», «air conditioner repair Baku» — belə sorğuları nüvədə ayrıca sətirlər kimi saxlamağa dəyər.

Amma çoxları şəhəri ümumiyyətlə yazmır. İnsan harada olduğunu göstərməyibsə, Google yerli nəticələr üçün onun məkanı barədə bildiklərinə əsaslanır. Bakıda «Bakı» sözü olmadan verilən sorğu bu sözlə verilən sorğu qədər yerli ola bilər, planlayıcının «Bakıda» variantı üzrə rəqəmi isə tələbatın yalnız bir hissəsini təsvir edir.

Şəhərin adını saytda təbii səsləndiyi yerlərdə işlətmək yerinə düşür: xidmət səhifəsinin başlığında və mətnində, ünvanda, əlaqə məlumatlarında. Nəyi etməyə dəyməz: görünmək istədiyiniz bütün rayon və şəhərləri futerdə sadalamaq və eyni müraciət formasına aparan, demək olar ki, eyni olan «Yasamalda kondisioner təmiri», «Sumqayıtda…», «Gəncədə…» səhifələrini çoxaltmaq. Google-un spam qaydalarında birincisi açar sözlərin həddindən artıq çox işlədilməsinə (keyword stuffing), ikincisi isə doorway səhifələrinə nümunə kimi göstərilib. Şəhər üçün ayrıca səhifə orada həqiqətən fərqli təklif olanda özünü doğruldur: öz ünvanı, öz müddətləri, öz şərtləri.'],
            ['Kommersiya, yoxsa informasiya sorğusu', 'Qiymətləndiricilər üçün təlimat sorğuya dörd niyyət növü baxımından yanaşmağı təklif edir: öyrənmək (Know), nəyisə etmək (Do), konkret sayta keçmək (Website) və harasa şəxsən getmək (Visit-in-person). Bir sorğunun bir neçə niyyəti ola bilər. Nüvə üçün iki növdən ibarət sadələşdirilmiş sxem kifayətdir.

Kommersiya sorğusu — insan sifariş verməyə, almağa və ya zəng etməyə hazırdır. Onu «цена», «заказать», «купить», «qiymət», «sifariş», «price» sözləri, həmçinin xidmətin adının şəhərlə birlikdə işlənməsi ələ verir. Belə sorğu xidmət və ya məhsul səhifəsinə aparır.

İnformasiya sorğusu — insan məsələni başa düşmək istəyir: «как выбрать кондиционер для квартиры», «kondisioner necə seçilir», «how to choose an air conditioner». Ona qiymət siyahısı yox, məqalə lazımdır. Belə sorğuda xidmət səhifəsi verilən suala deyil, başqa suala cavab verir.

Sərhəd bəzən bulanıq olur: həmin təlimatda deyilir ki, bir çox sorğu dəqiq bir növə sığmır. Ən asan yol axtarış nəticələrinə baxmaqdır. Birinci səhifədə xəritə və şirkət saytları varsa, sorğu kommersiya xarakterlidir. Məqalələr, videolar və forumlar varsa — informasiya xarakterlidir. Qarışıqdırsa — hansının çox olduğuna baxın və hansı səhifə ilə cavab verməyə hazır olduğunuza qərar verin.'],
            ['Qruplaşdırma: hansı sorğular eyni səhifədə yaşayır', 'Toplanmış sorğuları səhifələr üzrə bölüşdürmək lazımdır. İşlək qayda belədir: bir qrupa niyyəti eyni olan və Google-un oxşar səhifələr dəsti göstərdiyi sorğular düşür.

Bunu əl ilə yoxlayırlar. İki sorğunu növbə ilə daxil edin və axtarış nəticələrinin birinci səhifələrini müqayisə edin. Orada əsasən eyni ünvanlar varsa, hər iki sorğuya bir səhifə ilə cavab vermək olar. Nəticələr fərqlidirsə, iki səhifə lazımdır.

Sonda belə sütunları olan cədvəl alınır:

— sorğu;
— dil və yazılış;
— növ: kommersiya və ya informasiya;
— ona cavab verən səhifə;
— mənbə: planlayıcı, Search Console, axtarış təklifləri, rəqiblər, müştərilər.

Hər qrup bir səhifəyə təhkim olunur. Saytın iki səhifəsi eyni qrupa iddia edirsə, onlardan hansını göstərməyə Google özü qərar verir və bu, sizin seçəcəyiniz səhifə olmaya bilər.'],
            ['Saytı işə saldıqdan sonra nüvəni necə yoxlamalı', 'Sayt axtarışda görünməyə başlayana qədər nüvə fərziyyə olaraq qalır. Search Console-da məlumat toplandıqdan sonra effektivlik hesabatını açın, onu lazım olan səhifəyə görə filtrləyin və bu səhifənin hansı sorğular üzrə göstərildiyinə baxın.

Nəyə baxmalı:

— xidmət səhifəsi informasiya sorğuları üzrə göstərilir — bu suala cavab verəcək məqalə lazımdır;
— cədvəldə olmayan yazılışlar və ifadələr peyda olub — onları nüvəyə, təbii səsləndiyi yerlərdə isə mətnə də əlavə edin;
— bir sorğu üzrə iki səhifəniz göstərilir — qruplaşdırmaya yenidən baxın.

Bu yoxlamanı bir neçə aydan bir təkrarlayın: xidmətləriniz də, insanların onlar barədə necə soruşduğu da dəyişir.'],
        ],
        'end'      => 'Azərbaycanda sayt üçün semantik nüvə bir siyahı deyil: bu, üç dil, bir neçə yazılış və hər sorğunun yanında niyyət qeydidir. Onu planlayıcıdan, Search Console-dan, axtarış təkliflərindən, rəqiblərin saytlarından və müştərilərin öz sözlərindən toplayır, axtarış nəticələri ilə isə yoxlayırlar. Nüvənin dəyəri sətirlərin sayında deyil, hər sorğu qrupunun ona cavab verən bir səhifəsinin olmasındadır.',
    ],
    'google-ads-dlya-malogo-biznesa' => [
        'seoTitle' => 'Google Ads ayarları: biznes üçün axtarış kampaniyası',
        'seoDesc'  => 'Google-da kontekst reklamı necə qurulub: struktur, uyğunluq növləri, mənfi sözlər, coğrafiya, dil, müraciətlərin, zənglərin və WhatsApp keçidlərinin uçotu.',
        'title'    => 'Google Ads ayarları: kiçik biznes üçün axtarış kampaniyası necə qurulur',
        'desc'     => 'Kampaniyanın strukturu, uyğunluq növləri, mənfi açar sözlər, coğrafiya və müraciətlərin uçotu: Google-da reklama büdcə xərcləməzdən əvvəl nələri yoxlamaq lazımdır.',
        'rubric'   => 'Marketinq',
        'lead'     => 'Google-da reklamı işə saldınız, iki həftədə xeyli məbləğ xərcləndi, kabinetdə kliklər və nümayişlər var, telefon isə əvvəlki qədər çalır. Reklamın göstərildiyi sorğular arasında «vakansiyalar», «pulsuz» və başqa şəhərlərin adları çıxır. Çox vaxt səbəb reklamın özündə deyil, Google Ads ayarlarındadır: kampaniya necə qurulub, hansı sorğular üzrə göstərilməsinə icazə verilib və kabinet hansı klikin müraciətlə bitdiyini bilirmi. Gəlin kiçik biznes üçün axtarış kampaniyasını ardıcıllıqla — strukturdan büdcəyə qədər — araşdıraq.',
        'body'     => [
            ['Google Ads ayarları strukturdan başlayır', 'Google Ads hesabı kampaniyalardan, kampaniyalar isə reklam qruplarından ibarətdir. Kampaniya büdcəni, təklif strategiyasını, coğrafiyanı və nümayiş şəbəkələrini müəyyən edir. Qrup açar sözləri və onlara aid reklamları birləşdirir, buna görə də hər qrup insanın bir sualına cavab verməlidir.

Kiçik biznes üçün işlək sxem sadədir: bir xidmət — bir qrup. Kondisionerlərin təmiri və quraşdırılması fərqli açar sözləri, reklamları və sayt səhifələri olan iki ayrı qrupdur. Xidmətə ayrıca büdcə və ya ayrıca coğrafiya lazımdırsa, onu ayrıca kampaniyaya çıxarırlar.

Kampaniyanın ayarlarında şəbəkələr üçün iki qeyd xanası var: Google-un axtarış partnyorları və Display şəbəkəsi. Birincisi digər axtarış platformalarında, ikincisi isə insanın həmin anda heç nə axtarmadığı saytlarda və tətbiqlərdə nümayişlər əlavə edir. Hər iki xananı ilkin dəyərlərə güvənmədən özünüz yoxlayın.'],
            ['Uyğunluq növləri: söz nə qədər geniş yozulur', 'Google Ads-də açar söz dəqiq sətir deyil, reklamın hansı sorğular üzrə göstərilə biləcəyinə dair göstərişdir. Onun nə qədər geniş yozulacağını uyğunluq növü müəyyən edir:

— geniş, heç bir işarəsiz: açar sözlə əlaqəli sorğular, hətta sözlərin özü onlarda olmasa belə;
— ifadə uyğunluğu, dırnaq içində, məsələn "kondisioner təmiri": ifadənin mənasını ehtiva edən sorğular, o cümlədən daha konkret olanlar;
— dəqiq, kvadrat mötərizədə, məsələn [kondisioner təmiri]: eyni mənalı və ya eyni niyyətli sorğular.

Geniş uyğunluq ilkin olaraq seçilir və Google-un yardım mərkəzi vurğulayır ki, onu ağıllı təklif strategiyaları — konversiyalardan öyrənən strategiyalarla birlikdə istifadə etmək lazımdır. Müraciətlər barədə məlumat hələ yoxdursa və büdcə kiçikdirsə, ifadə və dəqiq uyğunluqla başlamaq daha ağlabatandır, geniş uyğunluğu isə konversiyalar artıq hesablananda sınamaq olar.

Ayrıca AI Max-ı yoxlayın — bu, axtarış kampaniyasının üzərində işləyən ayarlar toplusudur: o, sorğuların seçimini genişləndirir, saytın materialları əsasında başlıqlar və təsvirlər tərtib edir və insanı saytın başqa səhifəsinə göndərə bilər. Google-un yardım mərkəzinə görə, yeni axtarış kampaniyalarında o, ilkin olaraq aktivdir, ona görə də başlanğıcda ona ehtiyac olub-olmadığına şüurlu qərar verin.'],
            ['Mənfi açar sözlər: ilk klikdən əvvəl nəyi kəsmək lazımdır', 'Mənfi açar sözlər içində keçdikləri sorğular üzrə nümayişi qadağan edir. Onların da üç uyğunluq növü var: geniş — sorğuda mənfi ifadənin bütün sözləri istənilən ardıcıllıqla varsa, onu bloklayır; ifadə — sözlər eyni ardıcıllıqla yan-yana dayanırsa; dəqiq — yalnız artıq söz olmadan tam üst-üstə düşəndə.

Əsas tələ: mənfi açar sözlər yaxın variantlara şamil edilmir. Google-un yardım mərkəzi bildirir ki, sinonimləri, tək və cəm formalarını özünüz əlavə etməlisiniz; avtomatik olaraq yalnız böyük-kiçik hərf və yazı səhvləri nəzərə alınır. Söz formaları çox olan Azərbaycan və rus dilləri üçün bu vacibdir: mənfi «vakansiya» sözü «vakansiyası» formasını bağlamayacaq.

Əsas siyahını işə salmazdan əvvəl tərtib edirlər:

— «vakansiya», «vakansiyalar», «iş» — insan xidmət yox, iş axtarır;
— «pulsuz», «öz əlinlə», «yüklə» — insan icraçı axtarmır;
— işləmədiyiniz şəhərlər və rayonlar.

Sonra siyahını axtarış sorğuları hesabatı əsasında tamamlayırlar: o, hansı real sorğular üzrə nümayişlər və kliklər olduğunu göstərir. Bəzi nadir sorğuları Google məxfilik səbəbindən hesabata daxil etmir. İlk həftələrdə bu hesabatı müntəzəm açın.'],
            ['Bakıda kontekst reklamı: coğrafiya və dil', 'Coğrafiya kampaniya səviyyəsində təyin olunur: ölkə, şəhər və ya başqa ərazi, nöqtə ətrafında radius. Daha vacib olan isə başqa şeydir: reklamı məhz kimə göstərmək. İlkin variant — Google da məhz onu tövsiyə edir — «mövcudluq və ya maraq»dır: reklamı seçilmiş yerdə olan və ya oraya müntəzəm gələnlər, həmçinin bu yerə maraq göstərənlər, məsələn, onu sorğularında qeyd edənlər görür. İkinci variant — «yalnız mövcudluq» — yalnız birinciləri saxlayır.

Uzaqdan maraq turizm və ya daşınmaz əmlak üçün faydalı ola bilər, amma Bakıdakı emalatxana, klinika və ya şəhərdaxili çatdırılma üçün başqa ölkədəki insan çətin ki, sifariş gətirsin. Üstəlik, Google yeri siqnalların məcmusuna görə müəyyən edir və yüz faiz dəqiqliyə zəmanət vermir.

Dillə bağlı qaydalar isə dəyişir. Google Ads yardım mərkəzinə görə, 2026-cı ilin sentyabrından axtarış kampaniyalarında dil ayarı ləğv edilir: reklamlar mətnlərinin dilinə və istifadəçinin başa düşdüyü dilə görə seçilir, üstünlük isə sorğunun dilində olan reklama verilir. Müştərilər xidmətinizi Azərbaycan, rus və ingilis dillərində axtarırsa, hər dil üçün ayrıca açar sözlər, reklamlar və sayt səhifəsi lazımdır — bunları ayrı-ayrı qruplarda saxlamaq daha rahatdır.'],
            ['Reklam, aktivlər və klikin apardığı səhifə', 'Axtarış reklamı indi adaptivdir: siz hər biri 30 simvola qədər olan 15-ə qədər başlıq və hər biri 90 simvola qədər olan 4-ə qədər təsvir verirsiniz, sistem isə onlardan kombinasiyalar qurur və eyni anda üçdən çox başlıq və ikidən çox təsvir göstərmir. Google reklamçıların əksəriyyətinə başlıqları mövqelərə bərkitməyi tövsiyə etmir: bu, kombinasiyaların sayını azaldır. Başlıqlar arasında qrupun açar ifadəsinin, xidmətin mahiyyətinin və işlədiyiniz rayonun olması məqsədəuyğundur.

Aktivlər — əvvəlki genişləndirmələr indi belə adlanır — reklama saytın bölmələrinə keçidlər, dəqiqləşdirici qeydlər, telefon, ünvan, qiymətlər və şəkillər əlavə edir. Hətta təsdiqlənmiş aktiv də yalnız sistem ondan fayda proqnozlaşdıranda və reklamın mövqeyi buna imkan verəndə göstərilir.

Sonra klik insanı səhifəyə aparır və həmin səhifə reklamın vəd etdiyini davam etdirməlidir. İnsan kondisioner quraşdırılmasını axtarırdısa, quraşdırma haqqında səhifəyə düşməlidir: reklamın dilində, ilk ekranda şərtlər, telefon və WhatsApp düyməsi ilə. Google bunu keyfiyyət balında nəzərə alır — bu, açar sözün 1-dən 10-a qədər qiymətləndirməsidir və üç komponentdən ibarətdir: gözlənilən CTR, reklamın relevantlığı və açılış səhifəsinin keyfiyyəti. Bu, auksionun giriş məlumatı deyil, diaqnostika vasitəsidir, amma komponentlərə baxaraq zəif yeri görmək olur.'],
            ['Konversiyaların izlənməsi: onsuz optimallaşdırma kor-koranədir', 'Konversiyaların izlənməsi olmadan kabinet nümayişləri, klikləri və xərci görür, amma hansı klikin müraciətlə bitdiyini bilmir. Qrupları və açar sözləri nəticəyə görə müqayisə etmək mümkün olmur, konversiyalara yönəlmiş təklif strategiyaları üçün isə Google-un yardım mərkəzi izləməni məcburi şərt adlandırır.

Adətən üç hərəkət kifayətdir:

1. Formanın göndərilməsi — «Təşəkkür edirik» səhifəsinin yüklənməsinə və ya uğurlu göndərmə hadisəsinə görə.
2. Saytda telefon nömrəsinə basılması — səhifənin yüklənməsinə görə deyil, tel: linkinə klikə görə.
3. WhatsApp-a keçid — wa.me linkində eyni mexanizm.

Reklamın özündən gələn zənglərlə iş daha mürəkkəbdir. Zəngləri və onların müddətini Google Ads öz yönləndirmə nömrələri vasitəsilə uçota alır, Azərbaycan isə bu məqalə yazılan zaman onların mövcud olduğu ölkələrin siyahısında yoxdur. Onlarsız sistem zəng düyməsinə basılmasını görür, danışığın özünü isə görmür.

Müraciətlər üçün Google-un yardım mərkəzi hər klikə bir konversiya hesablamağı məsləhət görür ki, formanın təkrar göndərilməsi yeni müştəri kimi görünməsin. Həmçinin hansı hərəkətlərin əsas kimi qeyd olunduğunu yoxlayın: «Konversiyalar» sütununa məhz onlar düşür və təkliflərin təyin edilməsində də məhz onlardan istifadə olunur.

Telefona və ya WhatsApp-a basmaq hələ müraciət deyil: insan çatı açıb heç nə yazmaya da bilərdi. Belə basmalar əsas kimi qeyd olunubsa, strategiya məhz onları əldə etməyə çalışacaq. Bu konversiyaları müntəzəm olaraq real müraciətlərin sayı ilə tutuşdurun.'],
            ['Büdcəni necə hesablamalı', 'Google Ads-də gündəlik büdcə sərt tavan deyil, orta göstəricidir. Ayrı-ayrı günlərdə kampaniya iki gündəlik büdcəyə qədər xərcləyə bilər, amma bir ay ərzində sizdən gündəlik büdcənin 30,4 mislindən çox tutulmayacaq. Buna görə planlaşdırmanı aylıq məbləğdən aparmaq rahatdır: onu 30,4-ə bölün.

Klikin qiyməti üçün oriyentiri açar söz planlayıcısı verir. O, hər söz üçün seçilmiş coğrafiyada səhifənin yuxarısında nümayiş üçün təklif diapazonunu göstərir: aşağı hədd reklamçıların əvvəllər ödədiyi məbləğlərin təxminən 20-ci persentili, yuxarı hədd isə təxminən 80-ci persentilidir. Gündəlik büdcəni bu dəyərlərə bölün — gündəlik kliklərin sayı üçün kobud qiymətləndirmə alacaqsınız.

Bütün xidmətlər üzrə gündə cəmi bir neçə klik alınırsa, ən gəlirli bir-iki xidməti saxlayın və pulu bütün siyahıya səpələmək əvəzinə onlar üzrə məlumat toplayın. Konversiyaları maksimuma çatdırmağa yönəlmiş strategiya gündəlik büdcəni tam xərcləməyə çalışır, buna görə büdcənin həcmi sistemin proqnozu deyil, sizin qərarınızdır.

Konversiyalar toplandıqca əsas göstərici ortaya çıxacaq — kampaniyalar və qruplar üzrə bir müraciətin dəyəri. Büdcəni müraciətin daha ucuz başa gəldiyi kampaniyalara keçirirlər, müraciət gətirmədən pul xərcləyən açar sözləri və sorğuları isə söndürür və ya mənfi açar sözlərə əlavə edirlər.'],
        ],
        'end'      => 'Google-da reklam mürəkkəb arxitektura tələb etmir, amma oradakı hər ayar ilkin vəziyyətdə qalmamalı, şüurlu şəkildə seçilməlidir: uyğunluq növü, nümayiş şəbəkələri, yer parametri, AI Max. Ən əsası isə müraciətlərin izlənməsi işə salınmadan əvvəl qurulur, sonra yox: onsuz nəyin işlədiyinə dair istənilən nəticə təxmin olaraq qalır.',
    ],
    'kontent-plan-dlya-instagram-kompanii' => [
        'seoTitle' => 'Instagram üçün kontent planı: şirkət hesabını necə aparmaq',
        'seoDesc'  => 'Biznes üçün Instagram idarəçiliyi və SMM: şirkətin kontent planı necə qurulur — məqsəd, rubrikalar, formatlar, tezlik, təqvim, statistika, sayta linklər.',
        'title'    => 'Şirkətin Instagram hesabı üçün kontent planı necə tərtib olunur',
        'desc'     => 'Məqsəd, rubrikalar, formatlar, gücünüz çatan tezlik və təqvim: biznes üçün Instagram idarəçiliyini necə qurmaq və nəticəni statistika və UTM etiketləri ilə necə yoxlamaq olar.',
        'rubric'   => 'Marketinq',
        'lead'     => 'Şirkətin Instagram hesabını açdınız, ilk iki həftə hər gün paylaşım etdiniz, sonra isə postlar ayda bir dəfə çıxmağa başladı — kiminsə vaxtı olanda. Mövzular tükənib, nəyin işə yaradığını heç kim xatırlamır, profildən sayta isə demək olar ki, keçən yoxdur. Adətən məsələ alqoritmlərdə deyil: hesabın planı, paylaşımların isə vəzifəsi yoxdur. SMM-də bunun üçün sadə və işlək alət var — kontent planı. Gəlin görək, Instagram üçün kontent planı necə tərtib olunur: məqsəd, rubrikalar, formatlar, gücünüz çatan tezlik, təqvim, statistika və saytla əlaqə.',
        'body'     => [
            ['Əvvəlcə məqsəd, sonra post ideyaları', 'Biznes üçün Instagram idarəçiliyi şəxsi blogdan bir cəhətinə görə fərqlənir: hər paylaşımın görməli olduğu bir iş var. Ona görə də plan ideyalar siyahısı ilə deyil, bu suala cavabla başlayır: insan postu gördükdən sonra nə baş verməlidir?

Şirkət üçün variantlar adətən belədir:
— sizi hələ tanımayan insanlar sizi görməlidir;
— izləyicilər direct-ə yazmalı, zəng etməli və ya saytda müraciət qoymalıdır;
— sizi axtarışda və ya xəritədə tapan insan profili açmalı və şirkətin işlədiyinə, ona etibar etmək olacağına əmin olmalıdır.

Yaxın üç ay üçün bir əsas məqsəd seçin və onu konkret hərəkətlə bir cümlədə yazın: «insan qiymətlə bağlı sualla direct-ə yazır» və ya «xidmət səhifəsinə keçir». Hər məqsədin statistikada öz göstəricisi var — buna aşağıda qayıdacağıq. Məqsəd olmadan postun uğurlu olub-olmadığı bəlli deyil: bəyənmələr xoşdur, amma onlar müraciət deyil.'],
            ['Rubrikalar: ideyalar tükənəndə nə haqqında yazmalı', 'Rubrika — hesabın dəfələrlə qayıtdığı daimi mövzudur. Başlanğıc üçün beşi kifayətdir:
— məhsul: nə satırsınız, o nədən ibarətdir, variantlar bir-birindən nə ilə fərqlənir və necə seçməli;
— proses: iş necə görülür, müraciətdən sonra nə baş verir, hər mərhələ nə qədər çəkir;
— insanlar: zənglərə kim cavab verir, işi kim görür, obyektə kim gələcək;
— suallara cavablar: müştərilərin direct-də və telefonda soruşduqları;
— sübutlar: hazır işlər, müştərilərin göstərməyə icazə verdiyi rəylər, sertifikatlar, zəmanət şərtləri.

Suallara cavablar üçün mövzuların ən yaxşı mənbəyi müştərilərlə son bir aydakı yazışmadır. Təkrarlanan sualları yazıb çıxarın — bir neçə həftəlik paylaşım siyahısı hazırdır. Rubrikalar olanda «bu gün nə paylaşaq» sualı başqa suala çevrilir: «siyahıdan növbəti hansı bəndi götürürük».

Rubrikaları növbələşdirin ki, biri digərlərini sıxışdırıb çıxarmasın. Yalnız məhsul və qiymətlərdən ibarət hesab qiymət siyahısı kimi oxunur, yalnız komandadan ibarət hesab isə korporativ albom kimi.'],
            ['Reels, karusellər və hekayələr: hansı format hansı vəzifə üçün', 'Üç əsas formatın auditoriyası fərqlidir və nəyi harada paylaşmaq bundan asılıdır.

Reels — sizi hələ izləməyən insanlara çatmaq üsuludur. Instagram-ın özünün dediyinə görə, insanın Reels-də gördüklərinin böyük hissəsi onun izləmədiyi hesabların videolarıdır. Sıralama zamanı ən vacib proqnozlar arasında Instagram videonun başqalarına göndərilməsi, sonadək baxılması və bəyənilməsi ehtimalını göstərir. Aşağı ayırdetmə qabiliyyətli, su nişanlı və ya çərçivəli, səssiz, əsasən mətndən ibarət, həmçinin artıq Instagram-da dərc olunmuş videoları Instagram daha az göstərir. Reels videosu 20 dəqiqəyə qədər ola bilər, lakin üç dəqiqədən uzun videoları Instagram yeni auditoriyaya tövsiyə etmir.

Karusel — bir paylaşımda 20-yə qədər foto və video. O, təlimatlar, müqayisələr və təhlillər üçün uyğundur: insan slaydları ardıcıllıqla vərəqləyir və postu yadda saxlaya bilər. Karuselin içindəki video Reels sayılmır və Reels tabına düşmür.

Hekayələri əsasən izləyiciləriniz görür: hekayələr lentini Instagram insanın izlədiyi hesablardan, üstəlik reklamdan toplayır. Hekayələr 24 saatdan sonra yox olur, lakin onları profildə «Highlights» bölməsinə bərkitmək olar. Bu, gündəlik iş prosesi, sorğular, xatırlatmalar və linklər üçün yerdir.

Buradan sadə bölgü çıxır: «suallara cavablar»ı karusel və qısa Reels videoları ilə, «proses»i hekayələrlə, «sübutlar»ı isə lentdə karusel və sonradan «Highlights»-a bərkidilən hekayə ilə vermək rahatdır.'],
            ['Nə qədər paylaşmalı: davam etdirə biləcəyiniz tezlik', 'Hamı üçün düzgün olan universal tezlik yoxdur, başqalarının normaları isə sizin resurslarınız barədə heç nə demir. Hesablamanı vaxtdan aparmaq lazımdır.

Hər formatdan iki-üç paylaşım hazırlayın və hər şeyə əslində nə qədər vaxt getdiyini ölçün: ideya, çəkiliş, montaj, mətn, razılaşdırma. Bunu həftəlik paylaşım sayına vurun və əlinizdə olan saatlarla müqayisə edin. Uyğun gəlmirsə, keyfiyyəti yox, sayı azaldın.

Sabit ritm sıçrayışlardan daha faydalıdır: iki həftədən sonra kəsiləcək gündəlik postlardansa, bir il boyu davam etdirə biləcəyiniz həftədə iki paylaşım yaxşıdır. Ritm sabit olanda ayları bir-biri ilə müqayisə etmək, deməli, nəyin işlədiyini görmək mümkündür.

İki vərdiş kömək edir. Birincisi — toplu çəkiliş: bir çəkilişdə bir neçə Reels videosu və hekayə üçün material yazmaq. İkincisi — bir-iki həftəlik hazır paylaşım ehtiyatı saxlamaq ki, məzuniyyət və ya qəfil iş yükü planı sıfırlamasın. Hekayələr bu hesablamaya demək olar ki, daxil deyil: onlar iş gedişində, mürəkkəb montaj olmadan hazırlanır.'],
            ['Instagram üçün kontent planı praktikada necə görünür', 'Kontent planı Google Sheets və ya Excel-də adi cədvəldir. Bir sətir — bir paylaşım, sütunlar isə belədir:
— paylaşımın tarixi və vaxtı;
— rubrika;
— format: Reels, karusel və ya hekayə;
— bir cümlə ilə mövzu;
— məqsəd və gözlədiyiniz hərəkət;
— paylaşım hara aparır: direct, telefon, saytın səhifəsi;
— status: ideya, çəkilib, montaj olunub, dərc olunub;
— məsul şəxs.

Bir ayı qabaqcadan ümumi cizgilərlə, yaxın iki həftəni isə ətraflı, mətnlərlə planlaşdırırlar. Hər həftədə xəbərlər üçün boş yer saxlayın: ehtiyat yeri olmayan plan ilk gözlənilməz hadisədə pozulur.

Hazır paylaşımları əl ilə dərc etmək mütləq deyil. Açıq hesab Instagram tətbiqində foto, karusel və Reels videolarını planlaşdıra bilər — gündə 25 paylaşıma qədər və 30 gündən çox qabağa olmamaq şərtilə. Hekayələri kompüterdə Meta Business Suite-də planlaşdırmaq olar. Nəzərə alın: məhsul nişanları və birgə paylaşımlar planlaşdırılmış kontentlə hələlik işləmir.'],
            ['Instagram statistikasında nəyə baxmalı', 'Statistika pulsuzdur və istənilən açıq hesab üçün əlçatandır — tətbiqdə və instagram.com saytında. Hesab üzrə xülasəyə son 90 gün daxilində istənilən dövr üçün baxmaq olar, ayrıca paylaşımın statistikası isə iki ilə qədər əlçatan qalır. İzləyicilər haqqında məlumatlar — coğrafiya, yaş, aktivlik saatları — izləyicilərin sayı ən azı 100 olanda görünür.

Əsas göstəricilər (mötərizədə — ingilisdilli interfeysdəki adları):
— «Baxışlar» (Views) — kontent neçə dəfə işə salınıb və ya ekranda göstərilib; bir nəfər bir neçə baxış verə bilər;
— «Tamaşaçılar» (Viewers) — neçə unikal hesab kontenti ən azı bir dəfə görüb;
— «Qarşılıqlı əlaqələr» (Interactions) — bəyənmələr, şərhlər, yadda saxlamalar, repostlar;
— «Profildə fəaliyyət» (Profile activity) — paylaşımdan sonra insanlar nə edib: profilə keçib, izləməyə başlayıb, saytın linkinə klikləyib;
— Reels videoları üçün — baxış vaxtı, orta baxış vaxtı və videonun gətirdiyi yeni izləyicilərin sayı.

Hər məqsədin öz göstəricisi var. Yeni insanlar — tamaşaçılar və Reels videolarının gətirdiyi yeni izləyicilər. Müraciətlər — profildə fəaliyyət, linklərə kliklər və direct-ə gələn mesajlar (onları əl ilə saymaq daha asandır). Etibar — yadda saxlamalar, repostlar və hekayələrə cavablar.

Ayda bir dəfə rəqəmləri planın saxlandığı həmin cədvələ köçürün və ayrı-ayrı postları deyil, rubrikaları və formatları müqayisə edin: bir post təsadüfən işləyə bilər, bir rubrikanın on postu isə artıq tendensiya göstərir. Nəzərə alın ki, metriklərin bir hissəsini Instagram özü təxmini adlandırır. Yeni ideyanı əvvəlcə sınaq Reels videosu ilə yoxlamaq olar: onu sizi izləməyənlərə göstərirlər. Açıq peşəkar hesab üçün bu funksiya 200 izləyicidən başlayaraq əlçatandır.'],
            ['Instagram-ı saytla necə əlaqələndirmək', 'Instagram-da sayta link iki yerdə qoyulur: profildə beşə qədər ünvan göstərmək olar, hekayələrdə isə «Link» stikeri var. Post mətnlərindəki kliklənən linkləri Meta 2026-cı ilin martında sınaqdan keçirməyə başlayıb, özü də yalnız Meta Verified-in ödənişli abunəçiləri üçün — planı onlar üzərində qurmaq hələ tezdir.

Linki ana səhifəyə deyil, paylaşımın davamı olan səhifəyə yönəldin: xidmət haqqında post — həmin xidmətin səhifəsinə, seçim haqqında karusel — kataloqa və ya qiymətlər bölməsinə. Profildə bir neçə link varsa, birinci yerə başqa sosial şəbəkələri deyil, əsas istiqamətlərinizi və rahat əlaqə üsulunu qoyun.

Keçidləri Google Analytics-də görmək üçün linklərə UTM etiketləri əlavə edin. Google həmişə üç parametri göstərməyi tövsiyə edir: utm_source — mənbə, utm_medium — kanal, utm_campaign — kampaniya və ya rubrika. Məsələn: domeniniz/xidmetler/?utm_source=instagram&utm_medium=social&utm_campaign=bio. Dəyərlər hərf registrinə həssasdır: hesabat «instagram» və «Instagram» dəyərlərini iki fərqli mənbə kimi göstərəcək, ona görə də qəbul edilmiş adları elə kontent planının özündə yazmaq yaxşıdır. Keçidlər «Acquisition → Traffic acquisition» (trafikin cəlb edilməsi) hesabatında görünür.'],
        ],
        'end'      => 'Instagram üçün kontent planı gözəl şəkillərdən ibarət şəbəkə deyil, hər paylaşımın rubrikası, formatı, məqsədi və apardığı ünvan olan cədvəldir. Bir məqsəddən və həqiqətən davam etdirə biləcəyiniz tezlikdən başlayın. Ayda bir dəfə planı Instagram statistikası və UTM etiketlərinin məlumatları ilə tutuşdurun — onda növbəti nə paylaşmaq barədə qərarlar başqalarının məsləhətlərinə deyil, sizin rəqəmlərinizə əsaslanacaq.',
    ],
    'teksty-dlya-sajta-kak-pisat-stranicu-uslugi' => [
        'seoTitle' => 'Xidmət səhifələri üçün SEO mətnlər: nə yazmaq, nədən qaçmaq',
        'seoDesc'  => 'Xidmət səhifəsi üçün SEO mətni necə yazmalı: başlıqda şəhər, işlərin tərkibi, mərhələlər, qiymətlər, FAQ, sübutlar — və açar söz spamı niyə zərərlidir.',
        'title'    => 'Sayt üçün mətnlər: tapılan və başa düşülən xidmət səhifəsini necə yazmalı',
        'desc'     => 'Xidmət səhifəsinin mətnini necə yazmalı: xidmət və şəhər adı olan başlıq, işlərin tərkibi, mərhələlər, qiymətlər, etirazlara cavablar, sübutlar — və Google açar söz spamı barədə nə deyir.',
        'rubric'   => 'Marketinq',
        'lead'     => 'Xidmət səhifəsini çox vaxt «SEO mətn» kimi sifariş edirlər: bir neçə ekranlıq yekpare mətn, hər abzasda «Bakıda mühasibat xidmətləri» ifadəsi, aşağıda isə şəhər və rayonların siyahısı. Belə mətni oxumaq çətindir, hər iki üsul isə Google-un spam qaydalarında açıq şəkildə adlanır. Axtarışdan gələn insan başqa şeyi anlamaq istəyir: ona lazım olanı məhz siz edirsinizmi, bunun qiyməti neçəyədir və bundan sonra nə etməli. Gəlin görək, xidmət səhifəsində sayt üçün mətnlər nədən ibarətdir, açar sözlərin yeri haradadır və Google-un sənədləri belə səhifələr barədə nə deyir.',
        'body'     => [
            ['Bir səhifə — bir xidmət', 'Tez-tez rast gəlinən sxem: hər şeyin — şirkətin qeydiyyatından auditə qədər — sütun şəklində sadalandığı, hər bəndə iki cümlə düşən vahid «Xidmətlər» səhifəsi. O, heç bir konkret sorğuya doğru-dürüst cavab vermir: audit axtaran insan audit barədə hər şeyi öyrənmək istəyir, onu siyahıda bir sətir kimi tapmaq yox.

Axtarış vasitəsilə satmaq istədiyiniz hər xidmətin öz ünvanı, başlığı və mətni olan ayrıca səhifəsi olmalıdır. Ümumi «Xidmətlər» səhifəsi qalır, amma mündəricat rolunu oynayır: bir-iki cümlə və ətraflı səhifəyə link. Hər səhifəyə hansı sorğuları bağlamaq lazım olduğunu semantik nüvə göstərir — onu yazmağa oturmazdan əvvəl toplayırlar.

Əks ifrat da zərərlidir: yalnız şəhər adının dəyişdiyi on-a yaxın səhifə — «Bakıda mühasibatlıq», «Sumqayıtda mühasibatlıq», «Gəncədə mühasibatlıq». Google-un spam qaydalarında dorvey səhifələrin nümunəsi kimi ziyarətçini eyni yerə aparan ayrı-ayrı şəhərlər üçün səhifələr və bir-birinə bənzəyən çoxlu səhifə göstərilib. Şəhər üçün ayrıca səhifə o zaman məna kəsb edir ki, onda özünəməxsus məlumat olsun: ofisin ünvanı, müştərinin yanına gediş şərtləri, müddətlər.'],
            ['Başlıq: xidmət və şəhər, şüarsız', 'Səhifənin əsas başlığı — H1 teqi — xidməti müştərinin adlandıracağı kimi adlandırır, yerli bazarda işləyirsinizsə, şəhəri də. «Bakıda kiçik biznesə mühasibat xidməti» həm insana, həm də axtarış sisteminə səhifənin nədən bəhs etdiyini deyir. «Rəqəmlər dünyasında etibarlı tərəfdaşınız» isə heç nə demir.

Google-un faydalı kontent barədə təlimatında özünüyoxlama sualları arasında başlıqla bağlı iki sual var: başlıq məzmunun təsviredici və faydalı xülasəsini verirmi və şişirtməyə yol vermirmi. Axtarış nəticəsinin başlığını isə Google təkcə title teqindən deyil, həm də səhifənin əsas görünən başlığından, H1-dən və digər nəzərəçarpan mətndən götürür.

Title teqinin özü H1-dən fərqlənə bilər, amma eyni şeydən bəhs etməlidir. Google onu təsviredici və qısa etməyi, şablon təkrarlara və açar söz yığınına yol verməməyi, şirkətin adını isə əvvələ və ya sona — defis, iki nöqtə və ya şaquli xətlə ayıraraq — qoymağı məsləhət görür. Sənədlərdə uzunluq məhdudiyyəti yoxdur, amma uzun başlıq axtarış nəticələrində kəsiləcək, adətən ekranın eninə görə.'],
            ['Nələr daxildir, iş necə gedir və neçəyə başa gəlir', 'Səhifəni məhz bu bloklar üçün açırlar.

Xidmətin tərkibi — siyahı şəklində və konkret hərəkətlərlə: nə edirsiniz, müştəri nəticədə nə alır, nə xidmətə daxil deyil və ayrıca ödənilir. Sonuncu bəndi çox vaxt buraxırlar, halbuki sonradan mübahisələr məhz ondan çıxır.

Proses — ardıcıl addımlar və hər addımda müştəridən nə tələb olunduğu: sənədlər, giriş icazələri, qərarlar. Addımların adi müddətləri varsa, onları göstərin, müddətlər həcmdən asılıdırsa — konkret olaraq nədən asılı olduğunu izah edin.

Qiymətlər — ideal halda konkret məbləğ və ya qiymət aralığı. Qiymət fərdi hesablanırsa, onun nədən formalaşdığını yazın: işin həcmi, təcililik, əməkdaşların sayı, səhifələrin sayı — sizin sahənizə nə aiddirsə. İzahsız «qiymət sorğu əsasında» ifadəsi insanı siz ona uyğun gəlib-gəlmədiyinizi anlamazdan əvvəl artıq bir addım atmağa məcbur edir.

Müştərinin sözləri ilə yazın — Google-un başlanğıc təlimatı da səhifənizi hansı sözlərlə axtaracaqları barədə düşünməyi məsləhət görür. Müştərilər «mühasibatlığın aparılması» deyirsə, sizdə isə «uçotun autsorsinqi» qəbul olunubsa, səhifədə hər ikisi olmalıdır — vergüllə sadalanan siyahı kimi yox, normal cümlələrdə.'],
            ['Etirazlara cavablar və sübutlar', 'Sual-cavab bloku real söhbətlərdən toplanır: telefonla, messencerlərdə, müqavilədən əvvəlki görüşdə nə soruşurlar. Kiçik şirkətlərlə işləyirsinizmi, ilin ortasından başlamaq olarmı, müddətlər pozulsa nə olacaq, səhvə görə kim cavabdehdir. Hər cavab — qısa və konkret.

Bu sualların axtarış nəticələrində açılan blok şəklində görünəcəyinə artıq ümid bağlamağa dəyməz. 2023-cü ilin avqustunda Google belə genişləndirilmiş nəticələri yalnız tanınmış nüfuzlu dövlət və tibb saytları üçün saxladı, 2026-cı il mayın 7-dən isə onları ümumiyyətlə göstərməyi dayandırdı. Bu bloku axtarış nəticələrindəki nişan üçün deyil, insanlar üçün yazın.

Sübutlar — oxucunun özünün yoxlaya biləcəyi şeylərdir:
— linklər və ya real obyektlərin fotoları ilə görülmüş işlər;
— lisenziyalar, sertifikatlar, peşəkar təşkilatlara üzvlük — nömrələri ilə;
— işi görəcək insanların adları və rolları;
— ofisin ünvanı və şirkətin rekvizitləri;
— sonradan müqavilədə əks olunacaq zəmanət şərtləri.

Rəylərlə daha ehtiyatlı olun. Öz saytınızdakı rəylərə görə axtarış nəticələrində reytinq ulduzları görünməyəcək: Google-un qaydalarına görə, təşkilat özü barədə rəylərə özü nəzarət edirsə, onun LocalBusiness və ya Organization-ın başqa tipi ilə nişanlanmış səhifələri belə göstərilməyə iddia edə bilməz. Oxucu üçün rəylərin sizin iştirakınız olmadan yazıldığı platformaya link daha inandırıcıdır — məsələn, şirkətin Google Xəritələrdəki profilinə.'],
            ['Fəaliyyətə çağırış və rahat struktur', 'Səhifə aydın növbəti addımla bitməlidir, uzun səhifə isə onu daha əvvəl də təklif etməlidir, məsələn, qiymətlərdən sonra. Addım bir və konkret olmalıdır: zəng etmək, messencerdə yazmaq, formanı göndərmək. Smartfonda telefon nömrəsinə toxunanda nömrəyığma açılmalıdır. Yanında isə müraciətdən sonra nə olacağı: kim cavab verəcək, nə müddətə, müştəridən nə tələb olunacaq.

Struktur sözlərdən az vacib deyil. Hələ 1997-ci ildə Yakob Nilsen yazırdı ki, veb-səhifələri nadir hallarda söz-söz oxuyurlar: onlara göz gəzdirir, ayrı-ayrı söz və cümlələri seçib götürürlər. Qaydalar da buradan çıxır:
— alt başlıq söz oyunu etmir, blokun məzmununu adlandırır;
— bir abzasda bir fikir;
— sadalamalar siyahı şəklində verilir;
— əsas məqam blokun əvvəlində, təfərrüatlar sonra.

Google-un başlanğıc təlimatına görə, başlıq səviyyələrinin ardıcıllığı axtarışa təsir etmir, amma məntiqli iyerarxiya ekran oxuyucu proqramlarından istifadə edənlərə kömək edir — ona görə də ona riayət etməyə dəyər.'],
            ['SEO mətnlərdə açar söz spamı niyə zərərlidir', 'Kopiraytinqdə açar ifadəni mümkün qədər tez-tez yerləşdirmək vərdişi hələ də yaşayır. Google-da bu, spam qaydalarının ayrıca bəndidir — keyword stuffing, yəni sıralamaya təsir etmək cəhdi ilə səhifəni açar sözlərlə və ya rəqəmlərlə doldurmaq. Qaydaların özündən nümunələr:
— əhəmiyyətli əlavə dəyəri olmayan telefon nömrələri siyahıları;
— səhifənin sıralanmağa çalışdığı şəhər və regionların sadalandığı mətn blokları;
— eyni söz və ifadələrin o qədər tez-tez təkrarlanması ki, qeyri-təbii səslənir.

İkinci bənd səhifənin aşağısındakı tanış «Bakıda, Sumqayıtda, Gəncədə, Xırdalanda işləyirik…» sətrinin dəqiq təsviridir. Bu şəhərlərə həqiqətən gedirsinizsə, gediş şərtlərini adi cümlə ilə yazın. Gizli mətn — ağ fonda ağ, sıfır ölçülü şriftlə, şəklin arxasında — həmin qaydalarda ayrıca bənd kimi təsvir olunub.

Həcm normativi də yoxdur. Google-un başlanğıc təlimatında deyilir ki, mətnin uzunluğu özlüyündə sıralamaya təsir etmir, eyni sözlərin dəfələrlə təkrarlanması isə, hətta müxtəlif formalarda olsa belə, oxucunu yorur. Keywords meta teqindən Google ümumiyyətlə istifadə etmir. Açar ifadə üçün təbii yerlər kifayətdir: başlıq, ilk abzas, alt başlıqlardan biri. Qalan hissədə mətləbdən yazın.'],
            ['Google sayt üçün mətnlərdən nə gözləyir', '2024-cü ilin martında faydalı kontent sistemi Google-un əsas sıralama sistemlərinin bir hissəsinə çevrildi. Sənədlərdə prinsip birbaşa ifadə olunub: kontent axtarış nəticələrini manipulyasiya etmək üçün deyil, ilk növbədə insanlar üçün yaradılmalıdır.

Faydalı kontent barədə təlimatda xidmət səhifəsini də yoxlamaq üçün rahat olan üç sual var:
— Kim? Google oxucunun gözlədiyi yerdə müəllif barədə etibarlı məlumat verməyi məsləhət görür; xidmət səhifəsində bu, işi kimin görəcəyi sualına cavabdır.
— Necə? Materialın necə hazırlandığını anlamaq oxucu üçün faydalıdır.
— Niyə? Üçündən ən vacibi. Mətn hər şeydən əvvəl axtarışdan gələn ziyarətlər üçün yazılırsa, bu, Google sistemlərinin təşviq etməyə çalışdığı şeylə üst-üstə düşmür.

Həmin təlimata görə, axtarış sistemi üçün yazılmış mətnin əlamətlərindən biri budur: oxuduqdan sonra insan daha yaxşı məlumat üçün yenidən axtarışa qayıtmalı olur. Müştəri xidmətin qiymətini öyrənmək üçün səhifənizdən çıxıb gedibsə, məhz həmin haldır.

Google-un sənədlərinə görə, generativ süni intellekt mövzunu öyrənmək və öz mətninizin strukturunu qurmaq üçün faydalı ola bilər. Amma oxucuya fayda vermədən çoxlu səhifə generasiya etmək miqyaslı kontentdən sui-istifadə qaydasını poza bilər.'],
        ],
        'end'      => 'Yaxşı xidmət səhifəsi müştərinin onsuz da verəcəyi suallara cavab verir: nə edirsiniz, necə, neçəyə və bundan sonra nə etməli. Açar sözlər orada hər cümlədə deyil, təbii olduqları yerdə dayanır. Özünüzü yoxlamaq sadədir: səhifəni sizi ilk dəfə görən insanın gözü ilə oxuyun və hansı suallara cavab vermədiyini qeyd edin.',
    ],
    'kak-vybrat-hosting-dlya-sajta-kompanii' => [
        'seoTitle' => 'Şirkət saytı üçün hostinq: ödənişdən əvvəl nəyi yoxlamalı',
        'seoDesc'  => 'Sayt üçün hostinq seçimi: hesab kimin adınadır, server harada yerləşir, PHP versiyaları, ehtiyat nüsxədən bərpa, limitlər və uzatma qiyməti.',
        'title'    => 'Şirkət saytı üçün hostinqi necə seçmək olar: ödənişdən əvvəl nəyi yoxlamalı',
        'desc'     => 'Hesab kimin adına açılıb, server harada yerləşir, hansı PHP və verilənlər bazası versiyaları var, ehtiyat nüsxəni necə qaytarmaq olar və ikinci il neçəyə başa gəlir: hostinqdə ödənişdən əvvəl nəyi yoxlamalı.',
        'rubric'   => 'Dəstək',
        'lead'     => 'Sayt artıq açılmır, onu yerləşdirmiş podratçı isə cavab vermir. Provayderə yazırsınız və öyrənirsiniz ki, hesab podratçının adınadır və onunla bağlı məsələləri yalnız o özü həll edə bilər. Nəhayət, girişi geri qaytara biləndə qalanı da üzə çıxır: sonuncu ehtiyat nüsxə bir neçə ay əvvəl çıxarılıb, uzatma isə birinci ildən nəzərəçarpacaq dərəcədə bahadır. Bunların demək olar ki, hamısını ödənişdən əvvəl görmək olardı. Gəlin araşdıraq, şirkət saytı üçün hostinqi necə seçmək lazımdır: hesabın sahibi və serverin yerindən tutmuş xırda şriftlə yazılan limitlərə və ikinci ilin qiymətinə qədər.',
        'body'     => [
            ['Hostinq hesabı kimə məxsusdur', 'Birinci sual texniki deyil: hesab kimin adına açılıb. Çox vaxt saytı podratçı yerləşdirir — öz hesabında və ya reseller tarifində: siz ona ödəyirsiniz, o isə provayderə. Hər şey qaydasında işlədikcə fərq hiss olunmur. Podratçı yoxa çıxanda və ya yollarınız ayrılanda nə panelə girişiniz olur, nə də provayderlə müqaviləniz: provayder hesabın sahibi ilə iş görür, sahib isə siz deyilsiniz.

Necə olmalıdır:
— hesab şirkətin adına qeydiyyatdan keçib, profildə onun məlumatları göstərilib;
— giriş və parolun bərpası üçün ünvan ümumi iş poçt qutusudur, əməkdaşın və ya proqramçının şəxsi poçtu deyil;
— iki faktorlu autentifikasiya aktivləşdirilib;
— podratçı ayrıca giriş vasitəsilə işləyir və bu girişi əsas parolu dəyişmədən bağlamaq mümkündür.

Daha bir tələ. Parolun bərpası üçün poçt qutusu elə həmin hostinqdədirsə, hesab bloklananda, məsələn, ödəniş edilmədiyi üçün, poçt da saytla birlikdə sönəcək və parolu sıfırlamaq üçün məktub gəlib çatmayacaq. Bu ünvanı hostinqdən kənarda saxlamaq daha yaxşıdır.'],
            ['Server harada yerləşir: Bakıda, yoxsa Avropada', 'Azərbaycanda şirkət saytı üçün hostinq seçirsinizsə, növbəti sual serverin fiziki olaraq harada yerləşməsidir. Brauzerin hər sorğusu serverə qədər gedib-qayıdır və yol nə qədər uzundursa, ziyarətçi cavabın ilk baytını bir o qədər uzun gözləyir. Bu gözləmə LCP-nin birinci tərkib hissəsidir. LCP — səhifənin əsas məzmununun ekranda nə vaxt göründüyünü göstərən Core Web Vitals metrikasıdır.

İlk bayta qədər vaxtın özü (TTFB) Core Web Vitals-a daxil deyil, amma Google onun üçün oriyentir verir: 0,8 saniyəyə qədər — yaxşı, 1,8 saniyədən çox — pis.

Satın almadan əvvəl necə yoxlamaq olar: provayderdən test IP ünvanı və ya test saytı istəyin və ofisdən komanda sətrində bu ünvana ping və tracert əmrlərini icra edin. Ping siqnalın serverə gedib-qayıtma vaxtını göstərəcək, tracert isə trafikin hansı qovşaqlardan keçdiyini. İşləyən saytda gözləmə vaxtını brauzerin tərtibatçı alətlərində görmək olar: Network paneli, səhifənin özünə edilən sorğu, Timing tabı və serverin cavabını gözləmə sətri.

Axtarış baxımından serverin yeri zəif arqumentdir: Google-un yardım materiallarında deyilir ki, o, saytın hansı auditoriya üçün olduğuna işarə edə bilər, amma həlledici siqnal deyil.

Sayt şəxsi məlumatlar — müraciətlər, sifarişlər, anketlər — toplayırsa, ayrıca sual yaranır. Hostinq seçməzdən əvvəl hüquqşünasdan soruşun: fəaliyyət sahəniz üçün bu məlumatların harada saxlanılmalı olduğuna dair tələblər varmı.'],
            ['PHP və verilənlər bazası versiyaları', 'WordPress, bir çox digər CMS kimi, PHP üzərində MySQL və ya MariaDB verilənlər bazası ilə işləyir. Hər versiyanın dəstək müddəti var və bu müddət bitəndən sonra onun üçün təhlükəsizlik düzəlişləri buraxılmır. Təzə versiyaları olmayan hostinq normal yeniləmək mümkün olmayan sayt deməkdir.

2026-cı il oktyabrın sonuna vəziyyət belədir:
— PHP: 8.2, 8.3, 8.4 və 8.5 budaqları dəstəklənir, amma 8.2-nin təhlükəsizlik dəstəyi 2026-cı il dekabrın 31-də başa çatır, 8.1 və ondan köhnə versiyalar isə artıq düzəliş almır;
— MySQL: 8.0 versiyasının dəstəyi 2026-cı ilin aprelində başa çatıb, uzunmüddətli budaqlar — 8.4 və 9.7;
— MariaDB: 10.6-nın icma dəstəyi 2026-cı ilin iyulunda başa çatıb, uzunmüddətli 10.11, 11.4, 11.8 və 12.3 budaqları isə dəstəklənməyə davam edir.

Bu siyahı tez köhnəlir: qrafikə görə 2026-cı il noyabrın 19-da PHP 8.6 çıxır, aktual tarixləri isə layihələrin özləri dərc edir.

PHP versiyasını paneldə hər sayt üçün ayrıca özünüz dəyişə bilməyiniz də vacibdir. Onda yeni budağa keçid siyahıdan seçim etməkdən ibarət olur, kodda nəsə pozularsa, əvvəlki versiyanı qaytarmaq da bir o qədər asandır. Konkret CMS-in tələbləri onun saytında dərc olunub: məsələn, WordPress PHP 8.3 və ya daha yeni versiyanı tövsiyə edir.'],
            ['Sayt üçün hostinqə nə daxildir: sertifikat və poçt', 'Pulsuz HTTPS sertifikatını hostinq paneli sizin iştirakınız olmadan buraxmalı və yeniləməlidir. Let’s Encrypt sertifikatları standart olaraq 90 günlük verilir, 2027-ci ildən isə bu müddət qısaldılmağa başlayacaq, ona görə də onları əl ilə yeniləmək real seçim deyil.

Tarifə daxil olan poçt rahatdır: domeninizdə poçt qutularını ayrıca almaq lazım gəlmir. Əvvəlcədən dəqiqləşdirin:
— tarifə neçə poçt qutusu və hansı həcmdə daxildir;
— bir saatda göndərilən məktubların sayına məhdudiyyət varmı;
— domen üçün SPF, DKIM və DMARC yazılarını tənzimləmək mümkündürmü — bu yazılar olmadan şirkətin məktublarının spama düşmə riski var.

Bu rahatlığın tərs tərəfi də var. Poçt və sayt eyni serverdə yerləşirsə, saytın sındırılması poçta da zərbə vurur: skript spam göndərməyə başlayır, serverin ünvanı qara siyahılara düşür və onunla birlikdə müştərilərə göndərdiyiniz məktublar da bloklana bilər. Buna görə də şirkətin poçtunu ayrıca poçt xidmətində saxlamaq, hostinqdən isə yalnız sayt üçün istifadə etmək olar.'],
            ['Ehtiyat nüsxələr və onlardan bərpa', 'Tarifin təsvirindəki «gündəlik ehtiyat nüsxələr» sətri az şey deyir. Nüsxənin faydası ondan saytı nə qədər tez və kənar köməksiz qaytarmağın mümkün olması ilə ölçülür. Ödənişdən əvvəl soruşun:
— nüsxələr neçə gün saxlanılır və problem dərhal hiss olunmayıbsa, bir həftə əvvəlki nüsxəni götürmək olarmı;
— onlar harada saxlanılır — həmin serverdə, yoxsa ayrıca saxlama yerində;
— saytı paneldən özünüz və hissə-hissə bərpa edə bilərsinizmi: ayrıca fayllar, verilənlər bazası, poçt qutusu;
— dəstək xidmətinə sorğu ilə bərpa ödənişlidirmi;
— tam nüsxəni özünüzə endirə bilərsinizmi.

Sonuncu bənd göründüyündən daha vacibdir. Problem provayderin özündə və ya hesabdadırsa, provayderdəki nüsxələr kömək etməyəcək. ABŞ-ın kibertəhlükəsizlik agentliyi CISA-nın saytındakı ehtiyat nüsxələmə üzrə qısa təlimatda bu, 3-2-1 qaydası kimi ifadə olunub: vacib faylın üç nüsxəsi — əsas və iki ehtiyat nüsxə, iki müxtəlif növ daşıyıcıda, onlardan biri şirkətin binasından kənarda. Sayt üçün mahiyyət eynidir: hostinqdəki nüsxələr üstəgəl hostinqlə bağlı olmayan saxlama yerinə müntəzəm ixrac.

Və bərpanı ən azı bir dəfə əvvəlcədən yoxlayın — məsələn, nüsxəni test subdomenində yerləşdirin. Heç kimin ondan heç vaxt heç nə bərpa etmədiyi nüsxə sığorta deyil, fərziyyədir.'],
            ['Xırda şriftlə yazılan limitlər', 'Disk həcmi ən çox gözə çarpan limitdir. Sadəcə dəqiqləşdirin ki, poçt və ehtiyat nüsxələr ona daxildirmi. Sonra daha üç şeyi yoxlayın.

Inode-lar — hesabdakı fayl və qovluqların sayı. Linux-da hər faylın öz inode-u var və virtual hostinqdə onların sayı tariflə məhdudlaşdırıla bilər. Poçt Maildir formatında saxlanılırsa, hər məktub ayrıca fayldır. Minlərlə xırda fayldan ibarət keşi olan sayt və illərlə spam yığan poçt qutusu diskdə boş yer olduğu halda bu limitə çata bilər və onda yeni faylları və məktubları sadəcə saxlamağa yer qalmır.

Prosessor, operativ yaddaş və proseslər. Virtual hostinqdə sayt serveri başqaları ilə bölüşür və onun resurs payı məhduddur. Məsələn, belə məhdudiyyətlər üçün sistemlərdən biri olan CloudLinux-da prosessor və ya disk əməliyyatları limitinə dirənmək saytı yavaşıdır, yaddaş və ya proses çatışmazlığı 500 və 503 xətalarına, skriptlərə eyni vaxtda müraciətlərin sayının aşılması isə 508 xətasına səbəb olur. Sayt pik saatlarda ləngiyirsə və ya çökürsə, ilk növbədə paneldəki resurs statistikasına baxın.

«Limitsiz» sözü. Fiziki olaraq limitsiz server olmur. Bu söz tarifin adında yazılıbsa, istifadə qaydalarında əslində nəyin məhdudlaşdırıldığını tapın və rəqəmləri yazılı şəkildə bildirmələrini xahiş edin.'],
            ['Dəstək və ikinci ilin qiyməti', 'Dəstək xidmətini qəza günü deyil, satın almadan əvvəl yoxlayırlar. Texniki sual verin — PHP versiyaları və ya nüsxədən bərpa barədə — və baxın, nə vaxt cavab verəcəklər və cavab mahiyyət üzrə olacaqmı. Bunu axşam və ya istirahət günü edin: nasazlıqlar iş qrafikinə baxmır.

Nəyi dəqiqləşdirməli:
— əlaqə kanalları: tiketlər, çat, telefon və onlar gecə-gündüz işləyirmi;
— dəstək xidməti hansı dillərdə cavab verir;
— dəstəyə nə daxildir: nüsxəni bərpa etməyə və poçtla bağlı məsələni həll etməyə kömək edəcəklərmi, yoxsa cavab «server işləyir» sözləri ilə bitəcək.

İndi isə qiymət. Birinci dövr nəzərəçarpacaq dərəcədə ucuzdursa, bu, xidmətin qiyməti deyil, giriş endirimidir. Eyni tarifin uzadılma qiymətini tapın və iki-üç illik xərci hesablayın. Yalnız birinci dövrdə nəyin pulsuz olduğunu ayrıca öyrənin: domen, sertifikat, ehtiyat nüsxələr, ayrılmış IP ünvanı. Ödəniş xarici valyutadadırsa, məzənnəni nəzərə alın. Və öyrənin ki, provayder şirkətin adına hesab-faktura təqdim edirmi və onu necə ödəmək olar.'],
        ],
        'end'      => 'Hostinqi birinci ilin qiymətinə və «limitsiz» sözünə görə deyil, hesabın sizin olub-olmamasına, versiyaların təzə olub-olmamasına, nüsxəni özünüz qaytara bilib-bilməməyinizə və uzatmanın neçəyə başa gəldiyinə görə seçirlər. Bütün bunları ödənişdən əvvəl yoxlamaq olar: dəstəyə məktubla, ping əmri ilə və tarif səhifəsini diqqətlə oxumaqla. Belə yoxlama tələsik köçməkdən daha az vaxt aparır.',
    ],
    'domen-az-ili-com-kak-oformit-na-kompaniyu' => [
        'seoTitle' => '.az domen qeydiyyatı: şirkətin adına rəsmiləşdirmə və uzatma',
        'seoDesc'  => 'Domen almaq: .az ilə .com fərqi, domeni niyə şirkətin adına rəsmiləşdirmək lazımdır, sahibi whois.az və RDAP ilə necə yoxlamalı, vaxtında uzadılmasa nə olur.',
        'title'    => 'Domen qeydiyyatı: .az, yoxsa .com, kimin adına rəsmiləşdirməli və ünvanı necə itirməməli',
        'desc'     => '.az, .com və .com.az arasında necə seçim etmək, domen niyə şirkətə məxsus olmalıdır, sahibi harada yoxlamaq olar və müddət bitdikdən sonra ünvanla nə baş verir.',
        'rubric'   => 'Dəstək',
        'lead'     => 'Saytı vaxtilə tanış bir proqramçı işə salıb və domeni öz adına rəsmiləşdirib — belə daha tez idi. İndi siz podratçını dəyişirsiniz və məlum olur ki, saytın və poçtun ünvanı formal olaraq zənglərə cavab verməyən bir şəxsə məxsusdur. Başqa cür də olur: uzatma üçün kartın müddəti bitib, registratorun məktubları işdən çıxmış əməkdaşın qutusuna gəlirdi və bir səhər həm sayt, həm də poçt işləməz oldu. Gəlin görək, .az domeni .com-dan nə ilə fərqlənir, domen qeydiyyatı kimin adına olmalıdır, sahibi necə yoxlamaq olar və müddət bitəndən sonra nə baş verir.',
        'body'     => [
            ['.az, .com və .com.az arasında fərq nədir', 'Texniki baxımdan hər üç ünvan eyni cür işləyir. Fərq domenin tabe olduğu qaydalarda və onun axtarış sisteminə verdiyi siqnaldadır.

.az domeni Azərbaycanın milli domen zonasıdır. Onun qaydaları Nazirlər Kabinetinin 25 fevral 2019-cu il tarixli 63 nömrəli qərarı ilə təsdiq edilib. .az domenləri akkreditə olunmuş registratorlar vasitəsilə qeydiyyata alınır: onların siyahısı whois.az saytında «Registrator» bölməsində dərc olunub və reyestrin dəqiqləşdirdiyi kimi, rezidentlər .az domenlərini yalnız bu registratorların saytlarında alırlar. Sahib həm hüquqi, həm də fiziki şəxs ola bilər.

.com.az ayrıca zona deyil, com.az daxilində üçüncü səviyyəli ünvandır. .az qaydaları com.az, net.az, org.az, biz.az və daha bir neçə zonanı ümumi istifadə zonalarına aid edir, ona görə də .com.az-a eyni qaydalar şamil olunur.

.com ümumi təyinatlı beynəlxalq zonadır (gTLD). Onun qaydalarını dövlət deyil, ICANN müəyyən edir: onlar gTLD reyestrləri və akkreditə olunmuş registratorlarla bağlanmış müqavilələrdə əksini tapıb. Aşağıda bəhs olunan uzatma, silinmə və transfer müddətləri ICANN qaydalarıdır. .az kimi milli zonalar üçün ICANN qeydiyyat qaydaları müəyyən etmir: onları ölkənin özündə təyin edirlər.

Axtarış baxımından fərq belədir. Google milli domeni saytın konkret ölkə üçün nəzərdə tutulduğunun güclü siqnalı adlandırır — amma yalnız bir ölkə üçün. .com-un heç bir ölkəyə bağlılığı yoxdur və Google auditoriyanı başqa əlamətlərə görə müəyyən edir: hreflang nişanlanması, dil və valyuta, səhifələrdəki yerli ünvan və telefonlar, yerli saytlardan gələn linklər, şirkət profili. Yalnız Azərbaycanda işləyirsinizsə, .az bunu gücləndirir. Xaricə də satırsınızsa, .com daha çevikdir. Hər iki ünvanı qeydiyyata alıb əsas ünvana yönləndirmə qurmaq da olar: həm də adı başqası tutmayacaq.'],
            ['Domen qeydiyyatı icraçının deyil, şirkətin adına', 'Domen onun pulunu ödəyənə və ya saytı hazırlayana deyil, sahib kimi qeyd olunmuş şəxsə — registranta məxsusdur. İcraçı ilə şifahi razılaşmalar bu qeyddə əks olunmur.

.az qaydalarına görə hüquqi şəxs üçün registrator şirkətin tam adını, vergi ödəyicisinin eyniləşdirmə nömrəsini (VÖEN), rəhbərin və ya nümayəndənin məlumatlarını tələb edir. Sahibi yalnız sahibin özünün, onun qanuni nümayəndəsinin və ya varisinin yazılı müraciəti ilə və yalnız yeni qeydiyyat müqaviləsi bağlamaqla dəyişmək olar. Domen frilanserin adına rəsmiləşdirilibsə, qaydalara görə onu şirkətin adına yalnız frilanserin özü keçirə bilər.

.com-da da məntiq eynidir: uzatma xatırlatmaları sahibə gedir, transfer kodu onun sorğusu ilə verilir, sahibin dəyişdirilməsi isə ayrıca prosedurdur.

İkinci səviyyə də var — registratordakı hesab. Sahib kimi şirkət göstərilə bilər, amma domeni uzatmağı və ya DNS yazılarını dəyişməyi yalnız kabinetin parolu olan şəxs bacaracaq. Ona görə də üç şeyi yoxlamağa dəyər:
— domenin sahibi şirkətinizdir və ya biznesin sahibi kimi şəxsən sizsiniz;
— əlaqə ünvanı əməkdaşın və ya podratçının şəxsi poçtu deyil, bir neçə nəfərin oxuduğu qutudur;
— registratorun kabinetinə giriş şirkətdədir, podratçıya isə o yalnız tapşırıq müddətinə verilir.

Əlaqə ünvanını başqa domendə saxlamaq daha yaxşıdır. Domen söndürüləndə onun üzərindəki poçt gəlməz olur, onunla birlikdə registratorun məktubları da.'],
            ['Domenin kimin adına rəsmiləşdirildiyini necə yoxlamaq olar', '.com və digər ümumi təyinatlı domenlər üçün köhnə WHOIS protokolu əvəzlənib: 28 yanvar 2025-ci ildən qeydiyyat məlumatlarının əsas mənbəyi RDAP-dır. Yoxlamaq üçün lookup.icann.org ünvanındakı rəsmi ICANN alətindən istifadə etmək rahatdır.

Cavabda bunları görəcəksiniz:
— domenə xidmət göstərən registrator;
— qeydiyyat və müddətin bitmə tarixləri;
— statuslar, məsələn clientTransferProhibited — registratorun qoyduğu transfer qadağası;
— ad serverləri, yəni DNS zonasının harada yerləşdiyi.

Sahibin adı və əlaqə məlumatları açıq cavabda gizlədilə bilər: ICANN qaydalarına görə, məlumatların qorunması haqqında qanun bunu tələb edirsə, onlar mütləq gizlədilməlidir, digər hallarda isə gizlədilə bilər. Təşkilatın adı sahib buna razılıq veribsə, dərc olunur. Tam mənzərə registratorun kabinetindədir: orada sahib kimi kimin qeyd olunduğu və bildirişlərin hansı ünvana getdiyi görünür.

.az üçün ICANN alətinə ümid bağlamağa dəyməz: IANA-nın kök bazasında bu zona üçün nə RDAP, nə də WHOIS serveri göstərilib. Zonanın qaydaları domenin vəziyyətini milli administratorun saytı olan whois.az-da öyrənməyi təklif edir. Reyestr yazır ki, domenlərə görə məsul şəxslər barədə məlumatlar hamı üçün açıqdır, amma sahibin kim olduğunun ən etibarlı təsdiqi qeydiyyat müqaviləsi və registratordakı kabinetdir.'],
            ['Uzatma və avtomatik uzatma', 'Domeni həmişəlik almaq olmur. Qeydiyyat müəyyən müddətə rəsmiləşdirilir: .az-da bir ildən on ilə qədər, ödəniş isə illər üzrə hesablanır. Sonra domeni uzatmaq lazımdır.

.az qaydalarına görə registrator müddətin bitməsi barədə ən geci bir ay əvvəl xəbərdarlıq edir — sahibin poçtuna məktubla və (və ya) onun hesabında bildirişlə. .com üçün ICANN qaydaları iki xatırlatma tələb edir: təxminən bir ay və təxminən bir həftə əvvəl, domen uzadılmayıbsa, müddət bitdikdən sonrakı beş gün ərzində isə daha birini. Hamısı sahibin əlaqə ünvanına gedir. Orada işdən çıxmış əməkdaşın qutusu göstərilibsə, xatırlatmalar formal olaraq göndərilib, amma onları heç kim oxumayıb.

ICANN-ın məlumatına görə, avtomatik uzatmanı registratorların əksəriyyəti təklif edir. .az qaydalarında o xatırlanmır — belə xidmətin olub-olmadığını öz registratorunuzdan dəqiqləşdirin. Avtomatik uzatma unutmaq riskini aradan qaldırır, amma başqa risk yaradır: bağlı olduğu kartın müddəti bitir və ya kart bloklanır, ödəniş keçmir. Nə etməyə dəyər:
— avtomatik uzatma varsa, onu aktivləşdirmək və hansı kartın bağlandığını, onun hansı aya qədər qüvvədə olduğunu yoxlamaq;
— domeni birdən bir neçə illik uzatmaq;
— bitmə tarixini bir nəfərin telefonuna deyil, şirkətin ümumi təqviminə daxil etmək;
— ildə bir dəfə kabinetdə müddəti, əlaqə məlumatlarını və sahibi tutuşdurmaq.'],
            ['Müddət bitəndə nə baş verir', '.com və digər gTLD-lər üçün qaydanı ICANN qaydaları, təfərrüatları isə registratorla bağlanmış müqavilə müəyyən edir.

1. Müddət bitən kimi registrator uzatma üçün vaxt verə bilər — 1 gündən 45 günə qədər. Elə bu dövrdə, onun şərtlərində belə yazılıbsa, domeni hərraca çıxara bilərlər.
2. Domeni hələ uzatmaq mümkün olduğu müddətdə registrator onun DNS-ini söndürməyə borcludur — ən azı silinmədən əvvəlki son səkkiz gün ərzində. Domendəki sayt və poçt işləməz olur.
3. Silinmədən sonra reyestr bərpa üçün 30 gün verir — Redemption Grace Period. Domeni hələ qaytarmaq olar, amma registrator bərpaya görə ayrıca ödəniş almaq hüququna malikdir.
4. Bundan sonra domen daha beş gün pendingDelete statusunda qalır, sonra isə onu istənilən şəxs qeydiyyata ala bilər.

.az-da sxem daha qısadır. Sahib müddət bitənədək uzatma sorğusuna cavab verməyibsə, domenə texniki xidmət dayandırılır. Qaydalardakı tərifə görə bu o deməkdir ki, DNS cavab vermir, sayt və poçt isə əlçatmaz olur. Bundan sonra 30 gün ərzində ödəniş edilməsə, qeydiyyat ləğv olunur. Ləğvdən sonra ayrıca bərpa dövrünü zonanın qaydaları təsvir etmir. Dayandırılmanın səbəbi aradan qaldırılarsa, qaydalara görə registrator xidməti 24 saat ərzində bərpa edir.'],
            ['Başqa registratora transfer və avtorizasiya kodu', 'Sahibi dəyişmədən registratoru dəyişmək olar. .com üçün transfer avtorizasiya kodu ilə təsdiqlənir — ona auth code, EPP kodu və ya AuthInfo da deyirlər. Kodu hazırkı registrator verir: ya sahib onu kabinetdə özü əldə edir, ya da registrator sorğu əsasında kodu beş təqvim günü ərzində verməyə borcludur. Eyni müddətdə sorğu ilə transfer qadağası — clientTransferProhibited statusu da götürülür.

Əvvəlcədən nəyi bilmək vacibdir:
— registrator domenin qeydiyyatından və ya əvvəlki transferdən sonrakı ilk 60 gün ərzində transferdən imtina edə bilər;
— sahib dəyişdikdən sonra transfer 60 gün bloklanır, baxmayaraq ki, registrator bu bloklamadan əvvəlcədən imtina etməyə icazə verə bilər;
— gələcək qeydiyyat müddəti ödənilməyib deyə registrator transferdən imtina edə bilməz;
— transfer qeydiyyatı bir il uzadır, lakin qalan ümumi müddət on ili keçə bilməz.

2026-cı ilin iyununda ICANN şurası transfer qaydalarına yenidən baxılması üzrə tövsiyələri təsdiqləyib. Qərarda tətbiq müddətləri göstərilməyib, ona görə də hələlik qaydaların hazırkı redaksiyası qüvvədədir.

.az üçün qaydalar sahibin registratoru sərbəst seçmək hüququnu təsbit edir, amma keçid qaydasını təsvir etmir. Proseduru və tələb olunan sənədləri hazırkı və yeni registratordan dəqiqləşdirmək lazımdır.'],
        ],
        'end'      => 'Hostinq və dizayndan fərqli olaraq domeni sadəcə yenidən düzəltmək olmur: vizit kartları, lövhələr və poçt bir ada bağlıdır. Qayda sadədir: sahib — şirkət, kabinet — onun nəzarəti altında, uzatma — vaxt ehtiyatı ilə və işlək əlaqə ünvanına. Hər üç bəndi bir neçə dəqiqəyə yoxlamaq olar: lookup.icann.org və ya whois.az-ı, bir də registratorun kabinetini açın.',
    ],
    'tehnicheskaya-podderzhka-sajta-chto-vhodit' => [
        'seoTitle' => 'Saytın texniki dəstəyi və xidməti: nələr daxildir',
        'seoDesc'  => 'CMS və plagin yeniləmələri, PHP dəstəyinin müddəti, sertifikatlar, ehtiyat nüsxələr və monitorinq: sayta texniki qulluğa nə daxildir və hər ay nəyi yoxlamalı.',
        'title'    => 'Saytın texniki dəstəyi: ona nələr daxildir və saytlar onsuz niyə sıradan çıxır',
        'desc'     => 'Yeniləmələr, PHP versiyaları, sertifikatlar, ehtiyat nüsxələr, monitorinq və formalar: sayta texniki qulluq nədən ibarətdir və hansı tarixləri təqvimdə saxlamaq lazımdır. Aylıq yoxlama siyahısı ilə.',
        'rubric'   => 'Dəstək',
        'lead'     => 'Sayt iki il əvvəl hazırlanıb və o vaxtdan bəri heç kim ona toxunmayıb: işləyir ki, işləyir. Sonra bir gün formadan müraciətlər gəlmir, brauzer əsas səhifənin yerinə xəbərdarlıq göstərir və ya hostinqdə PHP versiyası dəyişdirildikdən sonra sayt xəta ilə açılır. Bu nasazlıqların heç biri qəfildən baş vermir: sertifikatın müddəti və PHP dəstəyinin sonu əvvəlcədən məlumdur, işləməyən formanı isə sadə aylıq yoxlama üzə çıxarır. Gəlin görək, saytın texniki dəstəyi nədən ibarətdir, hansı tarixləri təqvimdə saxlamağa dəyər və ayda bir dəfə nəyi yoxlamaq lazımdır.',
        'body'     => [
            ['İşləyən sayta texniki dəstək niyə lazımdır', 'Saytın kodu özü-özlüyündə xarab olmur. Onun ətrafındakı hər şey dəyişir: serverdəki PHP versiyası, brauzerlər, sertifikatlara qoyulan tələblər, plaginlər və onlarda aşkarlanan zəifliklər. Yenilənməyən sayt bu mühitdən getdikcə daha çox geri qalır — bir gün nəsə sıradan çıxana qədər.

Saytın xidməti dedikdə yeni funksiyaların hazırlanması deyil, məqsədi heç nəyin baş verməməsi olan müntəzəm iş nəzərdə tutulur. Nəticəsi demək olar ki, görünmür, elə buna görə də onu təxirə salırlar.

İşi üç qrupa bölmək rahatdır:

— planlı: yeniləmələr, ehtiyat nüsxələr, formaların və monitorinqin yoxlanılması;
— müddətə görə: PHP dəstəyinin bitməsi, sertifikatın və domenin uzadılması;
— hadisəyə görə: sayt açılmır, sındırılma, yeniləmədən sonra xəta, mətnə təcili düzəliş.'],
            ['CMS-in, freymvorkun və plaginlərin yenilənməsi', 'Misal üçün WordPress-i — saytın idarəetmə sistemini (CMS) götürək: onda zəifliklər əsasən nüvədə deyil, genişlənmələrdə tapılır. Patchstack şirkətinin 2025-ci il üzrə hesabatına görə, yeni zəifliklərin 91%-i plaginlərin, 9%-i temaların payına düşüb, nüvədə isə cəmi altı zəiflik tapılıb və hamısı aşağı prioritetlidir. Eyni məlumatlara görə, zəifliklərin 46%-i ictimaiyyətə açıqlandığı anadək tərtibatçıdan düzəliş almayıb. Nəticə: «Yenilə» düyməsini basmaq kifayət deyil. Tərtibatçının çoxdan yeniləmədiyi plagini əvəz etmək və ya silmək daha yaxşıdır.

3.7 versiyasından başlayaraq WordPress nüvənin kiçik yeniləmələrini özü quraşdırır, 5.6 versiyasından başlayaraq yeni quraşdırmalarda isə böyük yeniləmələri də. Plaginlər və temalar yalnız xüsusi hallarda avtomatik yenilənir; qalan hallarda avtoyeniləməni hər plagin və tema üçün ayrıca, əl ilə aktivləşdirirlər.

Freymvorkların öz qrafiki var. Laravel-in hər əsas versiyası 18 ay ərzində xəta düzəlişləri, iki il ərzində isə təhlükəsizlik düzəlişləri alır. Laravel 11 üçün dəstək 12 mart 2026-cı ildə başa çatıb: onun üzərində qurulmuş sayt işləyir, amma artıq təhlükəsizlik düzəlişləri almayacaq.

Yeniləmə qaydası istənilən sistem üçün eynidir: təzə ehtiyat nüsxə, saytın test nüsxəsində yeniləmə, əsas səhifələrin və formaların yoxlanılması və yalnız bundan sonra — işlək sayt.'],
            ['PHP versiyası: müddətlər illər əvvəlcədən məlumdur', 'WordPress, Laravel və sıfırdan yazılmış bir çox sayt PHP üzərində işləyir. Dilin aktual versiyalarının həyat dövrü eynidir: xətaların və zəifliklərin düzəldildiyi iki illik tam dəstək və yalnız kritik zəifliklər üçün düzəlişlərin buraxıldığı daha iki il. Bundan sonra versiya artıq yenilənmir. Tarixlər php.net saytında dərc olunur:

— PHP 8.1 — dəstək 31 dekabr 2025-ci ildə başa çatıb;
— PHP 8.2 — təhlükəsizlik düzəlişləri 31 dekabr 2026-cı ilədək;
— PHP 8.3 — 31 dekabr 2027-ci ilədək;
— PHP 8.4 — 31 dekabr 2028-ci ilədək;
— PHP 8.5 — 31 dekabr 2029-cu ilədək.

7.4 və 8.0 versiyaları dəstəksiz daha əvvəl qalıb: 28 noyabr 2022-ci və 26 noyabr 2023-cü ildə. WordPress hazırda PHP 8.3 və ya daha yeni versiyanı tövsiyə edir.

Hostinq panelində yeni versiyaya keçmək üçün çox vaxt bir klik kifayətdir, amma köhnə kod və tərk edilmiş plaginlər onda işləməyə bilər: səhifənin yerinə xəta və ya boş ekran görünəcək. Ona görə də keçidi əvvəlcə saytın nüsxəsində yoxlayırlar. Cari versiya hostinq panelində görünür, WordPress-də isə «Alətlər → Sayt sağlamlığı» bölməsində.'],
            ['Sertifikat və domen: uzadılma avtomatik olmalıdır', 'Sertifikatın müddəti bitibsə, brauzer saytın yerinə təhlükəli bağlantı barədə xəbərdarlıq göstərir. Səhifəyə keçmək üçün ziyarətçi bu xəbərdarlığı bilərəkdən yan keçməli olacaq.

Sertifikatların qüvvədə olma müddətini CA/Browser Forum-un — sertifikatlaşdırma mərkəzlərini və brauzer tərtibatçılarını birləşdirən təşkilatın qaydaları qısaldır. 15 mart 2026-cı ildən verilən sertifikatlar 200 gündən, 15 mart 2027-ci ildən — 100 gündən, 15 mart 2029-cu ildən isə 47 gündən çox qüvvədə olmur. Pulsuz sertifikatlaşdırma mərkəzi Let’s Encrypt 10 fevral 2027-ci ildən standart olaraq 90 günlük sertifikatlardan 64 günlük sertifikatlara keçir.

Sertifikatı ildə bir dəfə əl ilə uzatmaq artıq mümkün deyil. Uzadılma avtomatik tənzimlənir, texniki qulluq zamanı isə avtomatikanın işə düşdüyü yoxlanılır. Let’s Encrypt sertifikatı sabit sayda gündən sonra deyil, təxminən müddətin üçdə ikisi keçəndə uzatmağı məsləhət görür. Bitmə tarixini brauzerdə görmək olar: ünvanın solundakı nişana basın və sertifikat barədə məlumatı açın.

Domenlə də vəziyyət eynidir: uzatma xatırlatması çoxdan işdən çıxmış əməkdaşın ünvanına gedə bilər. Qeydiyyatın bitmə tarixini və registratordakı əlaqə ünvanını sertifikatla birlikdə yoxlamağa dəyər.'],
            ['Heç vaxt bərpa edilməmiş ehtiyat nüsxə', 'CMS üzərində qurulmuş saytın nüsxəsi iki hissədən ibarətdir: fayllar (kod, şəkillər, sənədlər) və verilənlər bazası (səhifələrin mətnləri, müraciətlər, ayarlar). Biri digəri olmadan saytı bərpa etməyəcək.

Hostinqin çıxardığı nüsxələr faydalıdır, amma saytın özü ilə eyni hesabdan idarə olunur. Hesab bloklanarsa, sındırılarsa və ya ona giriş itirilərsə, nüsxələr də saytla birlikdə əlçatmaz olacaq. Böyük Britaniyanın Milli Kibertəhlükəsizlik Mərkəzi (NCSC) oflayn nüsxəni əsas şəbəkədən ayrı və ya ehtiyat nüsxələr üçün bulud xidmətində saxlamağı məsləhət görür və «3-2-1» qaydasını misal gətirir: ən azı üç nüsxə, iki cihazda, biri — başqa yerdə.

Həmin tövsiyədə unudulması asan olan bir bənd də var: nüsxələri müntəzəm yoxlamaq və onlardan necə bərpa olunacağını əvvəlcədən bilmək. Praktikada nüsxəni test subdomenində yerləşdirir, əsas və daxili səhifələri açır, admin panelinə daxil olur, test müraciəti göndərirlər. Nəsə işə düşməsə, bu, sındırılma günü deyil, sakit bir gündə üzə çıxacaq.

Cavabını bilməyə dəyən daha iki sual: son nüsxə nə vaxt çıxarılıb və neçə gün geriyə qayıtmaq mümkündür. Sayt üç həftə əvvəl sındırılıbsa, nüsxələr isə yalnız bir həftəlik saxlanılırsa, onların hamısında artıq yad kod var.'],
            ['Səssizcə sıradan çıxanlar: əlçatanlıq, formalar, düzəlişlər', 'Sayt yarım gün açılmaya bilər, sahibi isə bundan müştəridən xəbər tutar. Əlçatanlığın xarici monitorinqi bir neçə dəqiqədən bir saytı açır və sayt cavab vermədikdə bildiriş göndərir. Belə servislərin pulsuz tarifləri var.

İkinci siqnal mənbəyi Google Search Console-dur (saytı servisdə bir dəfə təsdiqləmək lazımdır). «Təhlükəsizlik problemləri» hesabatında Google saytın sındırıldığını, zərərli proqram təminatı yaydığını və ya fişinq üçün istifadə olunduğunu aşkar etdikdə bu barədə xəbər verir. Belə səhifələr axtarış nəticələrində xüsusi işarə ala, brauzer isə saytın yerinə xəbərdarlıq göstərə bilər.

Ən səssiz sıradan çıxan formalardır. Sayt açılır, ziyarətçi «Təşəkkür edirik» yazısını görür, məktub isə heç kimə çatmır. Səbəb formanın özündən kənarda ola bilər: formanın məktub göndərdiyi poçt qutusunun parolu dəyişdirilib, sayt başqa hostinqə köçürülüb, DNS yazıları dəyişdirilib. Məktublar çatır, amma spama düşürsə, SPF, DKIM və DMARC yazılarını yoxlamağa dəyər — onlara ayrıca məqalə həsr olunub. Etibarlı yoxlama yalnız birdir: test müraciəti göndərmək və məktubu gözləmək.

Kiçik düzəlişlər də texniki qulluğun bir hissəsidir: yeni telefon nömrəsi və ya ünvan, qiymətlər, iş saatları, köhnəlmiş aksiya banneri. Hər biri bir neçə dəqiqə çəkir, amma onlara heç kim cavabdeh deyilsə, yanlış məlumat saytda aylarla qalır.'],
            ['Reaksiya müddəti və aylıq yoxlama siyahısı', 'Bakıda saytın texniki dəstəyi barədə — podratçı ilə və ya ştatda olan mütəxəssislə — razılaşarkən aşağıdakıları yazılı şəkildə təsbit edin:

— reaksiya müddəti və düzəliş müddəti: birincisi problemlə məşğul olmağa başlanıldığını, ikincisi isə onun həll edildiyini bildirir;
— nə təcili sayılır (sayt açılmır, sındırılma, formalar və ya ödəniş işləmir) və iş vaxtından kənar təcili hal barədə necə xəbər vermək lazımdır;
— hostinqə, domen registratoruna, DNS-ə, admin panelinə və poçta giriş kimdədir: hesablar şirkətin adına açılıb, podratçı ona verilmiş giriş vasitəsilə işləyir;
— aylıq işlərə nə daxildir, nə isə ayrıca ödənilir.

Aylıq yoxlama siyahısını özünüz apara və ya hesabat şəklində ala bilərsiniz:

1. Nüvəni, plaginləri, temanı və ya asılılıqları yeniləyin — əvvəlcə nüsxədə.
2. PHP versiyasını php.net-dəki tarixlərlə tutuşdurun.
3. Sertifikatın və domen qeydiyyatının müddətini yoxlayın.
4. Təzə ehtiyat nüsxənin olduğunu və hostinqdən kənarda saxlanıldığını yoxlayın; qrafikə uyğun olaraq onu test subdomenində bərpa edin.
5. Hər formadan test müraciəti göndərin və məktubu gözləyin.
6. Monitorinq tarixçəsinə və Search Console-dakı «Təhlükəsizlik problemləri» hesabatına baxın.
7. Toplanmış məzmun düzəlişlərini edin.'],
        ],
        'end'      => 'Texniki qulluq saytı daha yaxşı etmir — onun daha pis olmasına imkan vermir. Bu məqalədəki nasazlıqların çoxunun əvvəlcədən bilinə bilən tarixi var: PHP dəstəyinin sonu, sertifikatın müddəti, domenin uzadılması. Bu tarixlər təqvimə yazılıbsa, ehtiyat nüsxə isə heç olmasa bir dəfə bərpa edilibsə, belə nasazlıqlar qəfil olmaqdan çıxır.',
    ],
    'perenos-sajta-na-drugoj-hosting-bez-prostoya' => [
        'seoTitle' => 'Saytın başqa hostinqə köçürülməsi: fasiləsiz, addım-addım',
        'seoDesc'  => 'Saytın miqrasiyası və fasiləsiz köçürmə: nəyi nəzərə almalı, TTL-i niyə öncədən azaltmalı, nüsxəni hosts ilə necə yoxlamalı və DNS dəyişəndə poçtu itirməməli.',
        'title'    => 'Saytın başqa hostinqə köçürülməsi: fasiləsiz və poçtu itirmədən necə köçmək olar',
        'desc'     => 'Saytı, verilənlər bazasını və poçtu yeni serverə necə köçürmək olar ki, ziyarətçilər köçü hiss etməsin: siyahıya alma, TTL, hosts vasitəsilə yoxlama, DNS-in dəyişdirilməsi və köhnə hostinqin taleyi.',
        'rubric'   => 'Dəstək',
        'lead'     => 'Hostinq darısqal və ya bahalı olub, texniki dəstək cavab verməyi dayandırıb — və siz köçmək qərarına gəlmisiniz. Uğursuz köç adətən belə görünür: faylları kopyalayırlar, DNS-i dəyişirlər, bir gün sonra isə məlum olur ki, poçt gəlmir, formadan göndərilən müraciətlər çatmır, bir-iki sifariş isə köhnə serverdəki bazada qalıb. Saytın başqa hostinqə köçürülməsi qovluğun kopyalanması deyil, müəyyən ardıcıllıqla atılan bir neçə addımdır. Gəlin onları bir-bir nəzərdən keçirək — siyahıya almadan köhnə hostinqi bağlamaq mümkün olan günə qədər — ki, saytın köçü fasiləsiz keçsin.',
        'body'     => [
            ['Siyahıya alma: hostinqdə əslində nələr var', 'Saytın miqrasiyası kopyalamadan yox, siyahıdan başlayır. Hostinqdə saytın özündən başqa, yalnız sıradan çıxanda yada düşən şeylər də var:

— saytın faylları, o cümlədən gizli fayllar, məsələn, yönləndirmə qaydaları olan .htaccess;
— bir və ya bir neçə verilənlər bazası və onlara giriş üçün istifadəçi adı ilə parolun yazıldığı konfiqurasiya faylı;
— domendəki poçt qutuları;
— domenə hostinqin DNS serverləri xidmət göstərirsə, DNS zonası;
— cədvəl üzrə icra olunan tapşırıqlar (cron): məlumat ixracı, göndərişlər, ehtiyat nüsxələr;
— SSL sertifikatı;
— PHP versiyası və onun genişlənmələri, subdomenlər, yönləndirmələr.

DNS zonasının nüsxəsini son sətrinə qədər bütövlükdə saxlayın. Xüsusilə TXT yazılarını: onlarda poçt üçün SPF, DKIM və DMARC (onlar haqqında bloqda ayrıca məqalə var), həmçinin servislərin təsdiq kodları saxlanılır. Məsələn, Google Search Console kodun yerində olub-olmadığını vaxtaşırı yoxlayır. Belə yazıları itirsəniz, sayt açılacaq, amma poçtda və servislərdə nasazlıqlar başlayacaq.

İşçilərin poçtu necə qəbul etdiyini də öyrənin. IMAP-dan istifadə edəndə məktublar serverdə saxlanılır və onları köçürmək lazımdır. POP3-də isə proqram məktubları kompüterə endirir və ayarlardan asılı olaraq onları ya serverdən silir, ya da orada nüsxələrini saxlayır — qutularda nə olduğunu yoxlayın. Proqramların ayarlarını köç zamanı hər halda dəyişmək lazım gələcək.'],
            ['TTL: köçdən bir-iki gün əvvəl DNS-ə niyə toxunmaq lazımdır', 'İnsan saytı açanda onun provayderinin DNS serveri saytın serverinin ünvanını öyrənir və cavabı yazının özündə göstərilən müddət ərzində yadda saxlayır — bu, saniyələrlə verilən TTL (time to live) sahəsidir. «DNS-in yayılması» adlandırılan proses əslində yadda saxlanılmış köhnə cavabların müddətinin bitməsini gözləməkdir.

TTL 86 400 saniyə (bir sutka) olduqda keçiddən sonra ziyarətçilərin bir hissəsi hələ bir sutkaya qədər köhnə serverə düşəcək. Buna görə TTL əvvəlcədən azaldılır. Cloudflare miqrasiya üzrə tövsiyələrində 300 saniyəni (beş dəqiqə) geniş yayılmış qısa dəyər kimi göstərir və TTL-i ən azı 24–48 saat əvvəl, daha yaxşısı isə hazırkı ən uzun TTL-dən az olmayan müddət əvvəl azaltmağı məsləhət görür. Köç günü artıq gecdir: yazını yadda saxlamış keşlər onu köhnə TTL-ə əsasən saxlayır.

TTL dəyişəcək bütün yazılarda azaldılır: domenin A yazıları, www, AAAA, poçt da köçürsə — MX və ya poçt serverinin yazıları.

İki məhdudiyyət var. Ölçmələr göstərir ki, DNS rezolverlərinin bir hissəsi yazıları müəyyən olunduğundan daha uzun saxlayır: qısa TTL keçid dövrünü qısaldır, amma onu tamamilə aradan qaldırmır. Hostinqlə birlikdə domenin DNS serverləri (NS yazıları) də dəyişirsə, onların saxlanma müddətini domen zonasının reyestri təyin edir və siz onu azalda bilməzsiniz: .com üçün bu, 172 800 saniyə, yəni iki sutkadır. Addımları ayırmaq daha etibarlıdır: əvvəlcə yazıların tam nüsxəsi ilə DNS zonasını, sonra isə yalnız A yazısını dəyişərək saytı köçürmək.'],
            ['Saytın başqa hostinqə köçürülməsi və hosts vasitəsilə yoxlama', 'Texniki baxımdan köçürmə faylların kopyalanması, bazanın idxalı və konfiqurasiyanın düzəldilməsidir: yeni hostinqdə bazanın adı, istifadəçi adı və parol demək olar ki, həmişə başqa olur. PHP-nin eyni versiyasını və ya uyğunluğu dəqiq bilinən versiyasını quraşdırın.

Nüsxəni DNS dəyişdirilməmişdən əvvəl və əsl domen altında yoxlamaq lazımdır. Bunun üçün hosts faylı var: orada hansı domenə hansı IP ünvanının uyğun gəldiyi əl ilə göstərilir və kompüter DNS-dən əvvəl ona etibar edir. Windows-da bu, C:\\Windows\\System32\\drivers\\etc\\hosts faylıdır və onu yalnız administrator hüquqları ilə redaktə etmək olar; macOS və Linux-da — /etc/hosts. İki sətir əlavə edin: yeni serverin IP ünvanı, boşluq və domen — www-siz və www ilə. Sonra Windows-da ipconfig /flushdns əmrini icra edin və brauzeri yenidən başladın. İndi siz yeni serveri görürsünüz, qalan hamı isə köhnəsini.

Hostinqin verdiyi müvəqqəti texniki ünvan bu iş üçün daha az yararlıdır. Bəzi CMS-lər saytın ünvanını bazada saxlayır — WordPress-də bunlar siteurl və home parametrləridir — və müvəqqəti ünvanda linklər, şəkillər və admin panelinə giriş əsas domenə, yəni köhnə serverə aparır.

HTTPS-lə bağlı kiçik çətinlik yaranacaq: Let\'s Encrypt HTTP-01 yoxlaması zamanı nəzarət faylını domen üzrə sorğulayır, domen isə hələ köhnə serverə yönəlib. İki çıxış yolu var: sertifikatı DNS-01 yoxlaması (_acme-challenge TXT yazısı) ilə buraxmaq və ya mövcud sertifikatı gizli açarla birlikdə köçürmək.

Əsas səhifələri gəzin, admin panelinə daxil olun, formanı göndərin, şəkil yükləyin. Yoxlamadan sonra hosts faylındakı sətirləri silin.'],
            ['Keçiddən əvvəl dəyişikliklərin dondurulması', 'Bazanın kopyalanması ilə DNS-in dəyişdirilməsi arasında sayt yaşamağa davam edir: müraciətlər və sifarişlər gəlir, xəbərlər dərc olunur. Bunların hamısı köhnə bazaya düşür, nüsxəyə isə yox.

Ona görə də köç müddətinə dondurma barədə razılaşın: heç kim məzmunu redaktə etmir və fayl yükləmir. Keçidi ən sakit saatlarda etmək daha yaxşıdır — onları analitikada görmək olar. Keçiddən bilavasitə əvvəl bazanın təzə nüsxəsini götürün, onu yeni serverə test bazasının üzərinə yükləyin və yeni fayllar yaranıbsa, onları da köçürün.

Yeni serverdə cron tapşırıqlarını keçid anında işə salın və elə həmin an köhnə serverdə söndürün — əks halda göndəriş və ya məlumat ixracı iki dəfə gedəcək.

Keşlərin müddəti bitənə qədər ziyarətçilərin bir hissəsi köhnə serverə düşür və onların müraciətləri köhnə bazaya gedir. Buna görə keçiddən dərhal sonra orada texniki işlər səhifəsi qoyun və ya bir neçə gün ərzində köhnə bazanı və müraciətlər üçün poçt qutusunu yoxlayın.'],
            ['DNS-in dəyişdirilməsi və poçt: MX yazıları və poçt qutuları', 'Keçid zamanı domenin A yazısı və www üçün yazı dəyişdirilir. AAAA yazısını da — serverin IPv6 ünvanını — yoxlayın: o, köhnə hostinqdən qalıbsa, IPv6 ilə daxil olan ziyarətçilər oraya düşməyə davam edəcək. Yeni serverdə IPv6 yoxdursa, bu yazını silin.

Poçtla bağlı iki ssenari var. Poçt Google Workspace və ya Microsoft 365 kimi xarici servisdədirsə, MX yazılarına toxunmayın: sayt harada olursa olsun, məktublar oraya gedir.

Poçt qutuları köhnə hostinqdə idisə, ardıcıllıq belədir:

1. Yeni serverdə eyni poçt qutularını yaradın.
2. Məzmunu IMAP vasitəsilə köçürün, məsələn, imapsync proqramı ilə: təkrar işə salınanda o, dublikat yaratmır.
3. MX yazısını yeni serverə yönləndirin — və ya MX ona istinad edirsə, mail.domeniniz A yazısını.
4. Keşlərin müddəti bitəndə sinxronizasiyanı bir daha işə salın: göndərənlərdə köhnə MX yadda saxlanıldığı müddətdə məktubların bir hissəsi köhnə qutulara gəlir.
5. Poçt proqramlarında və telefonlarda köhnə hostinqin ünvanı göstərilibsə, gələn və gedən poçt serverlərini dəyişin.

Poçt köçürüldükdən sonra SPF və DKIM-i yeni serverə uyğun yeniləmək lazımdır, əks halda məktublar spama düşməyə başlaya bilər. Bu, saytın özünün göndərdiyi məktublara da aiddir: formalardan gələn müraciətlər birbaşa veb-serverdən göndərilirsə, poçt xarici servisdə olsa belə, serverin yeni ünvanı SPF-də olmalıdır.'],
            ['Köçdən sonra nələri yoxlamalı', 'İctimai DNS serverlərinin nə cavab verdiyini komanda sətrindən görmək olar: nslookup domeniniz 8.8.8.8 əmri Google Public DNS-dən, nslookup domeniniz 1.1.1.1 isə Cloudflare-dən soruşacaq. Cavabda yeni IP varsa, deməli, bu rezolver artıq keçib. Google-da ilişib qalmış köhnə cavabı Google Public DNS-in keş təmizləmə səhifəsində sıfırlamaq olar.

Sonra qısa yoxlama siyahısı:

— sayt www ilə də, www-siz də açılır, http-dən https-ə yönləndirilir, sertifikat etibarlıdır;
— əsas səhifələr, axtarış və admin paneli işləyir;
— formadan göndərilən müraciət ünvana çatır;
— iş qutusundan göndərilən məktub xarici qutuya, məsələn, Gmail-ə çatır və əksinə;
— cron tapşırıqları icra olunub — bunu jurnaldan və ya nəticədən görmək olar;
— yoxlama müddətinə indeksləmə qadağası qoyulmuşdusa, o, robots.txt-də və CMS ayarlarında qalmayıb.

Hər şey sabit işləyəndə TTL-i əvvəlki dəyərlərinə qaytarın.'],
            ['Köhnə hostinqi nə vaxt söndürmək olar', 'Köç günü yox. Köhnə server işlədikcə o, sığortadır: yenisində nəsə sıradan çıxsa, A yazısına əvvəlki IP-ni qaytarmaq kifayətdir və TTL qısa olduqda geri qayıtmaq da keçid qədər tez başa çatacaq. Bu halda yeni serverin artıq qəbul etdiyi sifarişləri əl ilə geri köçürmək lazım gələcək.

Oriyentir köhnə serverin jurnallarıdır. Giriş jurnalında ziyarətçilər, köhnə poçt qutularında isə yeni məktublar artıq görünməyəndə daha bir neçə gün gözləyin, faylların, bazanın və poçtun tam nüsxəsini götürün və yalnız bundan sonra xidməti bağlayın.

Poçtla bağlı bir incəlik var. Poçt serverinin qısa müddətli əlçatmazlığı, bir qayda olaraq, məktubların itməsinə gətirib çıxarmır: göndərən tərəf məktubu növbədə saxlayır və cəhdləri təkrarlayır, SMTP standartı isə ən azı 4–5 gün təslim olmamağı tövsiyə edir. Silinmiş qutu isə başqa məsələdir: «belə alıcı yoxdur» cavabı qətidir və məktub dərhal göndərənə qaytarılır. Buna görə köhnə serverdəki poçt qutuları ən sonda silinir.'],
        ],
        'end'      => 'Fasiləsiz köçürmə sürətə deyil, addımların ardıcıllığına söykənir: siyahıya alma, TTL-in əvvəlcədən azaldılması, hosts vasitəsilə yoxlama, dondurma, keçid, yoxlama və yalnız bundan sonra köhnə hostinqin bağlanması. Saytın itdiyi dərhal görünür, TXT yazısının, məktubun və ya son müraciətin itməsini isə çox vaxt yalnız bir neçə gün sonra sezirlər — ona görə də məhz onları iki dəfə yoxlamağa dəyər.',
    ],
    'ssl-sertifikat-dlya-sajta-https' => [
        'seoTitle' => 'Sayt üçün SSL sertifikatı: HTTPS, pulsuz, yoxsa ödənişli',
        'seoDesc'  => 'Sayta HTTPS niyə lazımdır, DV-nin OV və EV-dən fərqi nədir, pulsuz Let\'s Encrypt SSL nə vaxt bəs edir və sertifikatlar niyə getdikcə tez-tez yenilənməlidir.',
        'title'    => 'Sayt üçün SSL sertifikatı: HTTPS nəyə lazımdır və pulsuz sertifikat ödənişlidən nə ilə fərqlənir',
        'desc'     => 'HTTPS sayta və ziyarətçilərə nə verir, DV, OV və EV əslində nə ilə fərqlənir, pulsuz Let\'s Encrypt nə vaxt kifayətdir və niyə artıq avtomatik yeniləmə olmadan keçinmək mümkün deyil.',
        'rubric'   => 'Dəstək',
        'lead'     => 'Müştəri yazır ki, saytınıza keçəndə Chrome xəbərdarlıq göstərib və həqiqətən davam etmək istəyib-istəmədiyini soruşub. Ya da sayt açılır, amma ünvanın solunda «Təhlükəsiz deyil» yazısı durur — telefon nömrəsi istədiyiniz formanın düz üstündə. Hər iki halda səbəb eynidir: saytın işlək SSL sertifikatı yoxdur — ya onu quraşdırmayıblar, ya da müddəti bitib və yeniləyən olmayıb. Gəlin görək, HTTPS hətta təqdimat saytına niyə lazımdır, sertifikatlar nə ilə fərqlənir, pulsuz sertifikat nə vaxt kifayətdir və 2026-cı ildən onların verilməsi qaydalarında nə dəyişib.',
        'body'     => [
            ['Oğurlanası heç nə olmayan sayta HTTPS niyə lazımdır', 'HTTPS — şifrələnmiş TLS bağlantısının içində işləyən HTTP protokoludur. Sertifikatları vərdiş üzrə SSL adlandırırlar — çoxdan yerini TLS-ə vermiş köhnə protokolun adı ilə. Sertifikat brauzerə onun məhz sizin domeninizlə əlaqə qurduğunu sübut edir və bağlantını şifrələməyə imkan verir.

Sertifikat olmadan ziyarətçinin formaya yazdığı hər şey — ad, telefon, müraciətin mətni — açıq mətn kimi ötürülür. Onu istənilən aralıq qovşaqda, kafedəki Wi-Fi-dan tutmuş provayderin avadanlığına qədər, oxumaq, səhifənin özünü isə dəyişdirmək olar — məsələn, ona yad reklam yerləşdirmək.

Brauzerlər buna getdikcə daha sərt yanaşır. Chrome 2018-ci ildən http ilə açılan hər səhifəni «Təhlükəsiz deyil» yazısı ilə işarələyir. 2026-cı ilin sentyabrında çıxan 154-cü versiyadan başlayaraq isə HTTPS-siz ictimai sayta ilk dəfə daxil olmazdan əvvəl standart olaraq icazə soruşur. İnsanın müntəzəm daxil olduğu saytlarda xəbərdarlıq təkrarlanmır, amma yeni ziyarətçi — məsələn, reklamdan gələn — onu ilk növbədə görəcək.

Bundan başqa, brauzerin bir sıra imkanları yalnız HTTPS ilə işləyir: geolokasiya, push-bildirişlər, kamera və mikrofona giriş, service worker vasitəsilə oflayn rejim.'],
            ['HTTPS Google-da nəyi dəyişir', '2014-cü ildə Google HTTPS-i sıralama siqnalı elan etdi və dərhal qeyd etdi ki, bu siqnal çox zəifdir. Hazırkı sənədlər daha açıq danışır: səhifə təcrübəsinin aspektlərindən sıralama sistemləri Core Web Vitals-dan istifadə edir, HTTPS də daxil olmaqla qalanları isə mövqeləri birbaşa yüksəltmir.

Praktik əhəmiyyəti başqa yerdədir. Səhifə həm http, həm də https ilə açılırsa, Google əsas versiya kimi https versiyasını seçməyə üstünlük verir — əgər onunla hər şey qaydasındadırsa. Sənədlər ayrıca xəbərdarlıq edir: etibarsız sertifikat və https-dən geri http-yə yönləndirmələr axtarış sistemini http-yə üstünlük verməyə vadar edir. Beləliklə, müddəti bitmiş sertifikat iki tərəfdən zərbə vurur: ziyarətçi xəta görür, axtarış sistemi isə ziddiyyətli siqnallar alır.

Düzgün sxem belədir: saytın https ilə bir ünvanı olur, qalan bütün variantlardan — http ilə, www ilə və ya www-suz — bu ünvana daimi 301 yönləndirməsi qurulur. Google hansı səhifələri HTTPS ilə görür və qalanlarına nə mane olur — bunu Search Console-dakı HTTPS hesabatı göstərir.'],
            ['Sayta hansı SSL sertifikatı lazımdır: DV, OV, yoxsa EV', 'Sertifikatın növü şifrələmənin nə qədər davamlı olduğunu göstərmir — bunu açar və serverin ayarları müəyyən edir. O, sertifikatlaşdırma mərkəzinin sertifikatı verməzdən əvvəl nəyi yoxladığını göstərir.

— DV (Domain Validated) — yalnız domenin idarə olunması təsdiqlənir: məsələn, siz sayta fayl və ya DNS-ə yazı yerləşdirmisiniz. Sertifikatda şirkətin adı olmadan yalnız domen göstərilir. Avtomatik, bir neçə dəqiqəyə verilir.
— OV (Organization Validated) — mərkəz əlavə olaraq təşkilatın mövcud olduğunu yoxlayır və onun adını və yerləşdiyi yeri sertifikata daxil edir. Sənədlər və vaxt tələb olunur.
— EV (Extended Validation) — CA/Browser Forum-un ayrıca qaydaları üzrə daha ciddi yoxlama: hüquqi status, ünvan, sifarişçinin səlahiyyətləri.

Əvvəllər EV-yə ünvan sətrində şirkətin adı görünsün deyə pul ödəyirdilər. 2019-cu ildə Chrome (77-ci versiya) və Firefox (70-ci versiya) onu oradan çıxardı. 2023-cü ildən Chrome qıfılı da göstərmir — onun yerində saytın ayarlarının neytral nişanı durur. OV və ya EV sertifikatındakı şirkət adı indi yalnız sertifikat barədə məlumatlarda görünür.

Şirkət saytı və ya internet mağazası üçün adətən DV kifayətdir. OV və ya EV bank, ödəniş tərəfdaşı və ya sahənizin qaydaları bunu açıq şəkildə tələb etdikdə lazımdır.'],
            ['Pulsuz SSL: Let\'s Encrypt ödənişli sertifikatdan nə ilə fərqlənir', 'Let\'s Encrypt sertifikatları pulsuz verən qeyri-kommersiya sertifikatlaşdırma mərkəzidir. Brauzerlər onlara ödənişli DV sertifikatları qədər etibar edir. Məhdudiyyətlər var, amma onlar etibarlılıqla bağlı deyil:

— yalnız DV: mərkəz OV və EV vermir və verməyi planlaşdırmır;
— bütün subdomenləri birdən əhatə edən sertifikat (*.domeniniz) yalnız DNS yazısı vasitəsilə yoxlama zamanı verilir;
— qısa müddət: hazırda standart olaraq 90 gündür və bu müddət qısalacaq;
— dəstək: icma forumu və sənədlər.

Qısa müddət çatışmazlıq deyil, bilərəkdən seçilmiş yanaşmadır: sertifikatın verilməsini və yenilənməsini ACME protokolu ilə işləyən proqram insan iştirakı olmadan həyata keçirir. Bir çox hostinq panelində bu artıq quraşdırılıb və bir ayarla işə salınır. Bununla belə, bəzi hostinq provayderləri qoşulmaya görə kiçik ödəniş alır.

Ödənişli sertifikat OV və ya EV lazım olanda, sertifikat ACME-ni dəstəkləməyən avadanlığa və ya servisə quraşdırılanda, yaxud konkret mərkəzin dəstəyi vacib olanda özünü doğruldur. Ödənişli DV-ni «daha etibarlıdır deyə» almağın mənası yoxdur: şifrələmə də, brauzerin etibarı da eynidir.'],
            ['Sertifikatların ömrü niyə getdikcə qısalır', 'İctimai TLS sertifikatlarının maksimal müddətini CA/Browser Forum — sertifikatlaşdırma mərkəzlərini və brauzer tərtibatçılarını birləşdirən qurum — müəyyən edir. 2025-ci ilin aprelində forum mərhələli qısaltmanı təsdiqlədi və ilk addım artıq qüvvədədir:

— 15 mart 2026-cı ilədək verilənlər — ən çoxu 398 gün;
— 15 mart 2026-cı ildən — ən çoxu 200 gün;
— 15 mart 2027-ci ildən — ən çoxu 100 gün;
— 15 mart 2029-cu ildən — ən çoxu 47 gün.

Eyni zamanda mərkəzin domen yoxlamasından təkrar istifadə edə biləcəyi müddət də qısalır: 2029-cu ilin martından — 10 gün.

İllik sertifikatlar artıq verilmir, «bir illik» və ya «üç illik» alış isə əslində abunəlikdir: sertifikatın özünü təxminən altı ayda bir, 2027-ci ilin martından isə üç ayda bir yenidən buraxıb quraşdırmaq lazım gələcək.

Let\'s Encrypt bu qrafikdən öndə gedir: 10 fevral 2027-ci ildən sertifikatlar standart olaraq 64 günlük, 16 fevral 2028-ci ildən isə 45 günlük veriləcək. Sərt təyin olunmuş 60 günlük intervalla yeniləmək artıq kifayət etməyəcək: mərkəz sertifikatı müddətinin təxminən üçdə ikisi keçəndə yeniləməyi, yaxud yeniləmə anının seçimini ARI adlı ACME genişlənməsi vasitəsilə mərkəzin özünə həvalə etməyi məsləhət görür. 2025-ci ilin iyunundan Let\'s Encrypt sertifikatın müddətinin bitmək üzrə olması barədə məktub göndərmir — müddəti siz və ya monitorinq sisteminiz izləməlidir.

Sertifikatınızın müddətinə brauzerdə baxmaq olar: ünvanın solundakı nişan, sonra bağlantı və sertifikat barədə məlumatlar.'],
            ['Qarışıq məzmun: sertifikat var, səhifə isə işləmir', 'HTTPS-ə keçiddən sonra tez-tez rast gəlinən mənzərə: sertifikat quraşdırılıb, amma səhifənin bir hissəsi işləmir. Bu, qarışıq məzmundur — səhifənin özü https ilə gəlib, amma nəyisə http ilə yükləyir.

Brauzer onunla müxtəlif cür davranır:
— adi şəkilləri, audio və videonu özü https ilə yükləməyə çalışır; həmin ünvanda fayl yoxdursa, o sadəcə görünməyəcək;
— skriptlər, stillər, şriftlər və daxil edilmiş freymlər — xəritə, video, vidjet — http ilə olduqda tamamilə bloklanır.

İkinci halda səhifə səssizcə sınır: maket sürüşür, ofisin göstərildiyi xəritə yüklənmir, formanın düyməsi işləmir. Bunu axtarış sistemi də görür: Google-un sənədlərinə görə, https səhifəsi şəkillərdən başqa nəyisə http ilə yükləyirsə, əsas versiya kimi http versiyası seçilə bilər.

Mənbə demək olar ki, həmişə eynidir — şablonda, CMS-in verilənlər bazasında, köhnə mətnlərdə və vidjet kodlarındakı http:// ilə başlayan ünvanlar. Onları tapmağa tərtibatçı konsolu kömək edir: F12 klavişi, bloklanan hər şeyin sadalandığı Console tabı. Problemi ünvanları https ilə əvəz etməklə həll edirlər, yoxlamaları söndürməklə yox.'],
            ['HSTS: brauzer bir daha http-ni sınamasın deyə', 'Saytın http-dən https-ə yönləndirilməsi tam qoruma vermir: http ilə sorğu yenə də açıq gedir və onu ələ keçirmək olar. Təkrar ziyarətlərdə bu boşluğu HSTS bağlayır — serverin https ilə ötürdüyü Strict-Transport-Security başlığı. Onu aldıqdan sonra brauzer müəyyən müddət ərzində (max-age parametri, saniyələrlə) domeninizin ünvanlarını özü https-ə çevirir və http-ni sınamır. includeSubDomains parametri ilə qayda subdomenlərə də şamil olunur.

Bunun əks tərəfi də var: HSTS olan domendə sertifikat xətası baş verəndə brauzer ziyarətçiyə «yenə də keçid et» düyməsini basmağa imkan vermir. Sertifikatın müddəti bitib — sayt əlçatmazdır. Ona görə də HSTS-i yeniləmə artıq avtomatlaşdırılanda işə salırlar və kiçik max-age ilə başlayıb onu mərhələlərlə artırırlar.

Lap birinci ziyarəti də qorumaq üçün domeni Chrome-a daxil edilmiş əvvəlcədən yükləmə siyahısına əlavə edirlər; digər iri brauzerlərin siyahıları da ona əsaslanır. Tələblər: ən azı bir il (31 536 000 saniyə) olan max-age, includeSubDomains, preload direktivi və bütün subdomenlərdə HTTPS. Siyahıdan çıxmaq mümkündür, amma dəyişiklik istifadəçilərə aylarla, brauzer yeniləmələri ilə birlikdə çatır. Hansısa subdomendə sertifikatı olmayan köhnə sistem işləyirsə, əvvəlcədən yükləmə ilə tələsməmək daha yaxşıdır.'],
        ],
        'end'      => 'Bu gün SSL sertifikatı birdəfəlik alış deyil, prosesdir: sertifikatın verilməsi, avtomatik yenilənməsi və yeniləmənin həqiqətən baş tutduğuna nəzarət. Şirkət saytlarının əksəriyyəti üçün pulsuz DV sertifikatı kifayətdir — əgər onu təqvimində xatırlatma olan insan deyil, proqram yeniləyirsə. Üç şeyi yoxlayın: hazırkı sertifikatın müddəti nə vaxt bitir, onu konkret olaraq nə yeniləyir və səhifələrdə qarışıq məzmun varmı.',
    ],
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
