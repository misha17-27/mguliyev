<?php
/* Накладка каталога услуг. Форма повторяет app/data/catalog.php;
   чего здесь нет — берётся из русского. */

return [
    'veb-sayty' => [
        'title' => 'Websites',
        'h1'    => 'Website and online store development in Baku',
        'lead'  => 'A brochure site, an online store or a classified-ads platform — with the structure, the layout and an admin panel your manager can handle.',
        'items' => [
            ['Corporate websites', 'A company site: services, projects, team, contacts.'],
            ['Online stores', 'Catalogue, cart, online payment, feeds and inventory.'],
            ['Service websites', 'Pages for specific services with a request form.'],
            ['Classified-ad sites', 'A platform where users post the listings themselves.'],
            ['Travel websites', 'Destinations, tours and a booking request.'],
            ['Personal websites', 'A personal site for a specialist or expert.'],
        ],
    ],
    'dizayn' => [
        'title' => 'Design',
        'h1'    => 'Logo, brand identity and design',
        'lead'  => 'A mark, a palette, typefaces and rules — and then everything built from them: a catalogue, posts, a clip, a 3D scene.',
        'items' => [
            ['Logo', 'A mark and its versions for different media.'],
            ['Brand book', 'The rules: colours, typefaces, spacing, what not to do.'],
            ['Catalogue design', 'Your products laid out for print and PDF.'],
            ['Social media design', 'Templates for posts, stories and covers.'],
            ['AI and motion graphics', 'Animation and video made without filming.'],
            ['3D design', 'Product visualisation and scenes.'],
        ],
    ],
    'marketing' => [
        'title' => 'Digital marketing',
        'h1'    => 'Website promotion: search, ads, social media',
        'lead'  => 'We bring people in from search, ads and social media — and use the numbers to see which channel pays off.',
        'items' => [
            ['SEO for Google', 'Technical audit, keyword research, content, links.'],
            ['Google Ads', 'Search and Shopping campaigns, remarketing.'],
            ['SMM', 'Running Instagram and Facebook, content plan.'],
            ['Marketing strategy', 'Positioning, audiences, channels.'],
            ['Copywriting and content', 'Copy for the site, newsletters and social media.'],
            ['Photo and video shoots', 'Shoots for the site and social media, including 9:16.'],
        ],
    ],
    'podderzhka' => [
        'title' => 'Technical support',
        'h1'    => 'Website support, hosting and business email',
        'lead'  => 'The server, the domain and the email are our job: we watch the load, update the site and answer when something breaks.',
        'items' => [
            ['Hosting', 'Hosting for the site and email, weekly backups, SSL.'],
            ['Domains', 'Registration and renewal in your name.'],
            ['Business email', 'name@yourcompany.az, SPF, DKIM, DMARC.'],
            ['Site support and updates', 'Updates, edits, fixing failures.'],
            ['Management and content entry', 'We add products, articles and pages.'],
            ['Servers and migration', 'Moving the site and email, switchover on schedule.'],
        ],
    ],
];
