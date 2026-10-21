<?php
/* Накладка пакетов. Ключи — те же, что в app/data/packs.php.
   Индексы повторяют форму: 1 — название, 3 — приписка к сумме,
   4 — состав, 5 — кому подходит, 6 — чего нет. Сумма (2) не переводится.
   Приписка — слово «başlanğıc», как на главной, а не окончание -dan/-dən:
   окончание зависит от последнего слова числа (₼1 190-dan, но ₼700-dən),
   а сумму меняют в панели, не трогая перевод. */

return [
    'start' => [
        1 => 'Start',
        3 => 'başlanğıc',
        4 => '1–5 səhifə · telefon və planşetə uyğunlaşma · baza SEO · bir illik domen · 3 ay hostinq',
        5 => 'Hazırda sayt əvəzinə sosial şəbəkə profili olan kiçik biznes üçün. Emalatxana, kabinet, yerli nöqtə, özəl praktika — sizi tapsınlar, başa düşsünlər və zəng etsinlər.',
        6 => 'Bir neçə dil, bloq, ödənişli kataloq.',
    ],
    'business' => [
        1 => 'Biznes',
        3 => 'başlanğıc',
        4 => '10–20 səhifə · 3 dil · bloq · genişləndirilmiş SEO · Cloudflare',
        5 => 'Xidmət və ya məhsul kataloqu olan, müştəriləri bir neçə dildə danışan şirkətlər üçün. Üç dil adətən Azərbaycan, rus və ingilis dilidir, amma dəsti siz seçirsiniz.',
        6 => 'Səbət, onlayn ödəniş və anbarla iş.',
    ],
    'premium' => [
        1 => 'Premium',
        3 => 'başlanğıc',
        4 => 'WooCommerce · onlayn ödəniş · anbarla inteqrasiya · sürət 90+',
        5 => 'Real anbarı və sifariş axını olan mağaza üçün — menecer qalıqları əl ilə köçürməməli, alıcı isə «direct-də dəqiqləşdirin» deyil, saytda ödəməlidir.',
    ],
    'reels' => [
        1 => 'Reels abunəliyi',
        3 => 'ayda',
        4 => 'Ayda 8 şaquli video · çəkiliş · montaj · altyazılar · kontent planı · Instagram və TikTok',
        5 => 'Müntəzəm şaquli video lazım olan biznes üçün. Əlinizə hazır 9:16 video, kadra yazılmış altyazılar, lent üçün örtük və çəkilişin ilkin materialları keçir — ilkin materiallar sizdə qalır.',
    ],
];
