<?php
/* Pricing packages overlay. Keys match app/data/packs.php.
   Indexes follow the same shape: 1 — name, 3 — note next to the amount,
   4 — what is included, 5 — who it suits, 6 — what is not included.
   The amount itself (2) is not translated. */

return [
    'start' => [
        1 => 'Start',
        3 => 'from',
        4 => '1–5 pages · phone and tablet layouts · basic SEO · domain for a year · 3 months of hosting',
        5 => 'For a small business that currently has a social media profile instead of a website. A workshop, a practice, a local shop — where people need to find you, understand you and call.',
        6 => 'Several languages, a blog, a catalogue with payments.',
    ],
    'business' => [
        1 => 'Business',
        3 => 'from',
        4 => '10–20 pages · 3 languages · blog · extended SEO · Cloudflare',
        5 => 'For a company with a catalogue of services or products and customers in several languages. The three languages are usually Azerbaijani, Russian and English, but you choose the set.',
        6 => 'A cart, online payments and warehouse integration.',
    ],
    'premium' => [
        1 => 'Premium',
        3 => 'from',
        4 => 'WooCommerce · online payments · warehouse integration · speed 90+',
        5 => 'For a store with a real warehouse and a flow of orders — where a manager should not retype stock by hand, and a buyer should pay on the site rather than “ask us in DMs”.',
    ],
    'reels' => [
        1 => 'Reels subscription',
        3 => 'per month',
        4 => '8 vertical videos a month · filming · editing · subtitles · content plan · Instagram and TikTok',
        5 => 'For a business that needs regular vertical video. You get a finished 9:16 clip, burned-in subtitles, a cover for the feed and the raw footage — the footage stays with you.',
    ],
];
