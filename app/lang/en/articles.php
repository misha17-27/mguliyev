<?php
/* Статьи блога: перевод (English).

   Накладка на app/data/articles.php: по адресу статьи — те же поля,
   что в оригинале. Перевод сделан с русского и сверен дважды: по
   смыслу (ни одного добавленного или потерянного факта, числа и
   записи DNS — дословно) и по языку. Нет статьи здесь — она
   показывается по-русски и на этом языке не индексируется. */

return [
    'korporativnyj-sajt-kakie-stranicy-nuzhny' => [
        'seoTitle' => 'Corporate website: the pages you need and what goes on each',
        'seoDesc'  => 'The pages a business website in Baku needs: home, services, projects, about, contacts, privacy policy. What goes on each, what to launch with, what can wait.',
        'title'    => 'Which pages a corporate website needs and what should be on each',
        'desc'     => 'What pages make up a company website, what not to launch without, what can wait, how to set up the menu and the enquiry form, and who is responsible for the content.',
        'rubric'   => 'Websites',
        'lead'     => 'Company website development in Baku almost always begins with a question from the contractor: what sections will it have? The answer is often a link to a competitor’s site or a list of ten or so items, half of which you have no content for. Then the menu ends up with “News” holding a single post and “Vacancies” with no vacancies, and customers still phone to check the address. Let’s look at which pages a corporate website needs, what should be on each, what to launch with straight away and what can wait.',
        'body'     => [
            ['Which pages a corporate website needs', 'For a company that sells services, the basic set hardly changes:

— home page;
— services: an overview list and a separate page for each service area;
— projects or examples of work;
— about the company;
— contacts;
— privacy policy.

Add to these a utility page, the 404 — the one people see when they follow a broken link or mistype the address. A short explanation and links to the home page, services and contacts are all it needs.

Do not launch without the home page, services, contacts and the privacy policy. The “About the company” page can be short, but it has to be there. Projects can be added a little later if the photos and descriptions have not been collected yet: it is better to launch without the section than with a section of just one picture. News, a blog, vacancies and a questions-and-answers section can wait until there is material for them and someone to keep them going. An empty section is worse than a missing one: it tells visitors that nobody updates the site.'],
            ['The home page and menu: a crossroads, not a presentation', 'People open the home page with different goals. One wants to understand what you do, another is looking for a phone number, a third has come on a recommendation and is checking whether the company exists. So the home page is a crossroads, not a long story about your mission.

The first screen carries one sentence about what you do, for whom and where: not “a dynamically developing company” but “ventilation installation for restaurants and offices in Baku”. Next to it go a phone number and a contact button. Below come your service areas with links to the service pages, a few projects, a short block about the company and contact details.

The menu mirrors the structure of the site and names the sections in ordinary words: “Services”, “Projects”, “About the company”, “Contacts”. On a computer it should not be tucked away behind a three-line icon. In a 2016 Nielsen Norman Group study, people used hidden menus less often than visible or partly visible ones, and the authors concluded that hidden navigation does more harm on desktop than on a phone. The company’s phone number goes in the header of every page. The footer repeats the main links and carries the contact details, legal details and a link to the privacy policy.'],
            ['Services: one page per service area', 'If all your services are gathered in a list on one page, visitors have to hunt for their line in a long list. And a search engine has nothing to show for a query about a single service except that general list.

The approach that works is a list page with every service area and a short description of each, leading to a separate page for each one. That page covers what is included in the work and what is not, how it goes step by step, what the timeline and price depend on, what is needed from the client, examples for that service and a contact form.

Page addresses are made readable: /services/ventilation-installation/ instead of /page.php?id=17. In its SEO Starter Guide, Google advises putting words in the URL that are useful to people: a string of random identifiers tells a visitor nothing, and parts of the URL may appear in search results as breadcrumbs.'],
            ['Projects and “About the company”: what people check before they call', 'Before phoning a company they do not know, people want to be sure it exists and has done similar work before. The guidelines for search quality raters — the people who assess the quality of search results on Google’s behalf — say it plainly: it should be clear who is responsible for the website, and on most sites information about the owner is on the “About us” and “Contact us” pages.

A project page shows what was done, for whom, where and when, with photos of the real work. A few projects with details are more convincing than a gallery with no captions. Before you name a client and show their logo, ask for their consent and check the contract: it may contain a confidentiality clause.

The “About the company” page gives the full legal name, the year the company was founded, what you do and where you are, who runs the company and who works there: names, job titles, real photos. An employee’s name and photo are personal data too, so it is best to get each person’s consent to publication in advance. Licences and certificates are shown with numbers that allow them to be verified. Stock photos in place of team photos say nothing about the company.'],
            ['Contacts and the enquiry form', 'The contacts page should have:

— the address with a landmark and a map, and for an office in a business centre, the floor and how to get there;
— phone numbers as tel: links, so that the number can be dialled with one tap on a mobile;
— a WhatsApp link in the form wa.me/994XXXXXXXXX: the number in international format, without the “+”, spaces, brackets, hyphens or the zero before the operator code;
— an email address on the company’s domain;
— working hours;
— legal details: the legal name and VÖEN.

Keep the form short: name, phone, comment. Every extra field is one more reason not to fill it in. Field labels should stay visible: Nielsen Norman Group explains in detail why a hint inside the field that disappears as you type makes it harder to check and correct what you have entered. The phone field is marked up as type="tel" — mobile browsers usually show a number keypad for it. The name and phone fields are given the autocomplete attribute with the values name and tel: the browser can then fill in the details itself, and success criterion 1.3.5 of the WCAG 2.2 accessibility standard requires that the purpose of such fields can be determined programmatically.

After submitting, the person should see that the enquiry has been received and when they will be contacted. Enquiries are best sent not to one person’s mailbox but somewhere they will be seen even while that employee is on holiday. To keep emails from the website out of spam, the domain needs SPF, DKIM and DMARC set up — there is a separate article about them. And after every website update, the form is checked with a test enquiry: a broken form will not tell you it is broken.'],
            ['A privacy policy, even if you have only one form', 'An enquiry form that asks for a name and phone number already means collecting personal data. In Azerbaijan this is governed by the Law “On Personal Data” No. 998-IIIQ of 11 May 2010. It defines personal data as any information that makes it possible to identify a person directly or indirectly — and the name and phone number from an enquiry fall under that definition.

Article 8 of the law deals with consent to the collection and processing of data. Among the things a written consent states, it lists who is collecting the data, for what purpose, exactly which data and what is done with it, how long the consent is valid and the conditions for withdrawing it. Paragraph 8.6, added in 2024, provides that, with the exceptions set out in the law, consent is obtained and withdrawn centrally through the Electronic Government Information System. How to apply all this to a form on a website is for a lawyer to decide, not a developer. The website’s job is to have a page for the policy text and a link to it next to every form and in the footer.

Services have their own requirements too. The Google Analytics terms of use oblige the site owner to publish a privacy policy and disclose the use of cookies in it. Maps, live chats and advertising pixels also receive visitor data, and each service has its own terms. It is best to draw up a list of everything connected to the site in advance: that list is what the lawyer writes the policy from.'],
            ['Who fills the site with content', 'In corporate website development, the work splits into two parts. The developer is responsible for the structure, the page templates and making them easy to edit. Only the company knows the facts: the list of services and where each one ends, real projects, employees’ names, legal details, licence numbers. A copywriter can write the texts, but they should be checked by whoever answers to clients for those services.

Page layouts with no text or photos are not yet a website, so it makes sense to gather the materials alongside the design rather than afterwards. A simple table helps: every page, who is responsible for each one and its status — text, photos, approved. Before launch, every page is opened and read in full so that no temporary placeholder text ends up on the live site.

Separately, decide which member of staff will look after the site after launch: adding projects, changing phone numbers, removing outdated services. Logins and passwords for the control panel, the domain and the hosting are kept by the company, not only by the contractor.'],
        ],
        'end'      => 'A corporate website rests on a handful of pages, and each one answers its own visitor question: who you are, what you do, what you have already done, how to reach you and what will happen to their data. Everything else is added once there is material for it and someone to look after it. Checking your own site is simple: open it on a phone and try to find the service you need, the address and a number you can call with one tap.',
    ],
    'internet-magazin-chto-nuzhno-do-zapuska' => [
        'seoTitle' => 'Online store development: what to prepare before launch',
        'seoDesc'  => 'Catalogue, photos, prices and stock, checkout, card payments, delivery, emails and returns policy: what to check before your ecommerce website goes live.',
        'title'    => 'Building an online store: what must be ready before the first order',
        'desc'     => 'The catalogue and product data, photos, stock levels, checkout, payment through a bank, delivery, order emails and the returns policy — what to check before launch.',
        'rubric'   => 'Websites',
        'lead'     => 'The design has been approved and the home page is ready, but the launch has been pushed back for the third week running. Half the products have no photos, the prices live in the accountant’s spreadsheet, the bank is asking for a page with the returns policy, and nobody has decided who will take orders on Saturday. More often than not, building an online store is held up not by the code but by the data and the processes around it. Let’s look at what has to be ready before the first order and how to check each item yourself.',
        'body'     => [
            ['The catalogue: where building an online store begins', 'A catalogue is built around how the customer searches, not around how the products are laid out in the warehouse. The path “Kitchen → Frying pans” makes more sense to a customer than a section named after a supplier. Each product has one main category; if it needs to appear somewhere else as well, that is done with a collection or a link, not with a copy of the product page.

It helps to gather the product data into one spreadsheet before work begins — later it is imported into the store. Every item needs the same set of fields:
— the name people recognise the product by;
— the SKU — the internal code the site uses to match its data against the warehouse;
— the price;
— attributes for filters: size, colour, material, power;
— weight and dimensions, if the delivery cost depends on them;
— the GTIN barcode, if the manufacturer has assigned one.

Filters come with a technical catch: every combination of them can produce a separate page address, and the number of these addresses quickly becomes very large. Google’s documentation for developers describes two approaches. If you do not need the filtered pages in search, block them from crawling in robots.txt. If you do need them, separate the parameters with the & character, keep the filters in the address in a consistent order, and have the server return a 404 error for combinations that contain no products at all.'],
            ['Photos: one standard for the whole catalogue', 'Photography is worth starting before anything else: product pages, banners and ads all depend on it. Sharpness matters, but so does consistency: the same background, the same frame proportions, a similar angle. A catalogue where one frying pan is shot on a white background and the one next to it on a kitchen table looks like a classifieds board.

If you plan to show your products in Google Shopping, check the Merchant Center requirements in advance. Google has announced that from 31 January 2027 the image of any product must be at least 500 × 500 pixels, and it recommends 1500 × 1500 or more. The main image must not have watermarks, borders or promotional text such as a “Buy” call to action. Placeholders like “Photo coming soon” or “No image” are not accepted either.

Keep the originals at full size and serve compressed versions on the site: heavy images slow pages down. There is a separate article on the blog about how Google assesses website speed.'],
            ['Prices and stock: where the site gets its figures', 'The main question is where the truth about price and availability is kept. If the accounting system shows one figure and the site another, the store sells things it does not have at prices that no longer apply.

The options are usually these:
— prices and stock are kept directly in the site’s admin panel — this works if the warehouse is small and the site is the only sales channel;
— the site picks up an export from the accounting system on a schedule — as a file or via an API;
— the accounting system itself sends changes to the site after every sale.

The more sales channels share one warehouse — a physical shop, social media, the website — the more it matters how often they exchange data. Decide in advance, too, what the site does with an item that is out of stock: hides it, shows it marked “Out of stock” or takes pre-orders.

Products without a price are a separate case. A “Price on request” label makes sense to people, but for product results in Google Search the page markup must contain a price greater than zero, with the currency given as a three-letter ISO 4217 code. For the manat, that is AZN.'],
            ['Basket, checkout and delivery', 'Baymard Institute, which researches the usability of online stores, publishes a survey of shoppers in the US on why they abandon checkout. The most common reason is extra costs that are too high: delivery, taxes, fees. Others include slow delivery, not trusting the site with card details, being required to create an account, a checkout that is too long and an unsatisfactory returns policy.

This gives a practical minimum:
— an order can be placed without registering, and an account is offered after the purchase;
— the delivery cost is visible before the last step rather than turning up in the total as a surprise;
— the form has only the fields that are needed: name, phone, address, delivery method and payment method;
— after submitting, the customer sees an order number and a clear next step.

Delivery is described with specific rules: which districts and cities, what each zone costs, whether customers can collect in person, and when an order placed in the evening or at the weekend will arrive. If the delivery price depends on weight, the weight must be on every product page, otherwise the site cannot calculate it. And go through checkout on a phone, not just on a laptop: a field that is easy to fill in with a mouse may be hidden under the keyboard on a small screen.'],
            ['Online payments through an acquiring bank', 'To accept card payments on the site, you need a contract with an acquiring bank. It is worth starting the conversation with the bank in parallel with development, not after it: getting connected involves its own paperwork, checks and timelines.

Most often payment works like this: the customer goes to the bank’s payment page or sees it in an embedded window, enters their card details there, and the site receives only the result. For this setup, the payment card security standard PCI DSS provides a simplified self-assessment questionnaire, SAQ A. The condition is that the entire payment page comes from a provider that has confirmed PCI DSS compliance; if even one element of it is served by your site, this option does not apply. With an embedded window, the store also has to confirm that its site is protected against script-based attacks. Confirming a payment with a code from an SMS or in the banking app is, as a rule, 3-D Secure: the customer is verified by the bank that issued the card, not by the store.

Two things worth checking with your developer:
— the order status changes on the notification that the payment system sends to the store’s server, not when the customer returns to the “Thank you” page: a person may pay and lose their connection before they get there;
— a repeat notification about the same payment does not create a second order or deduct the item from stock twice.

Before launch, put an order through the bank’s test mode, if it has one, and then make one real purchase and refund it in full.'],
            ['Notifications and staff access', 'Before launch, set out which messages go out and to whom:
— to the customer: a confirmation with the order number and contents, status changes, handover to the courier;
— to the manager: a new order and a received payment, sent to a channel that someone reads at weekends too;
— to the warehouse or the courier: what to pick and where to deliver it.

Emails must go out from an address on the store’s domain, and the domain must have SPF, DKIM and DMARC set up — otherwise order confirmations risk ending up in spam. These records are covered in detail in a separate article on the blog.

In the admin panel, each member of staff has their own account and only the permissions they need: a manager changes order statuses, a content manager edits product pages, and full access is held by one or two people. With one shared login for everyone, you cannot tell who changed a price, and you cannot lock out someone who has left without changing the password for everyone else. The OWASP Top 10:2025, the list of the main risks to web applications, names violating the principle of least privilege as a typical access control failure — the category that comes first on the list. If the platform supports two-factor authentication, turn it on.'],
            ['Returns policy, privacy and contact details', 'These pages are often written on the last day, even though both the decisions of hesitant customers and the requirements of payment systems depend on them. For example, Visa’s rules require an online store’s website to show a customer service contact (email or phone), an address for correspondence with the customer and the seller’s country. The country is shown right in the checkout process — a link to a separate page is not enough for that. If the store restricts returns, the terms must be disclosed before the final confirmation of the purchase and the customer’s agreement obtained — with a tick box or a button. A link to the policy page is acceptable if it is part of that agreement.

The minimum set:
— payment and delivery terms;
— the returns and exchange policy: time limits, the condition of the goods, who pays for return shipping, how the money goes back to the card;
— the privacy policy: what data you collect, why, and who you pass it to — for example, the courier service;
— the seller’s company details and contacts.

The mandatory points are set by local consumer protection and personal data legislation, so the texts should be agreed with a lawyer rather than copied from someone else’s site.'],
        ],
        'end'      => 'The code is the most predictable part of a launch. Even if you order a turnkey online store, the product data, prices, the bank contract and the returns policy remain your responsibility. If you are just starting online store development in Baku, begin with the product spreadsheet and a conversation with the bank, and before launch go through a test order yourself — from the product page to the confirmation email.',
    ],
    'lending-ili-mnogostranichnyj-sajt' => [
        'seoTitle' => 'Landing page or website: what a service business needs',
        'seoDesc'  => 'Landing page vs multi-page site: when one page is enough and when each service needs its own. How to set up a service page, request form and contacts.',
        'title'    => 'Landing page or website: which to choose if you sell services',
        'desc'     => 'A one-page site suits a single offer and advertising, but does poorly in search across several services. We look at when to choose which and how to structure a service page.',
        'rubric'   => 'Websites',
        'lead'     => 'You offer several services — say, installing, repairing and cleaning air conditioners. One acquaintance tells you to get a landing page; another says you need a proper website with sections. In practice, the choice of “landing page or website” comes down not to taste or the number of screens but to where people will come to you from: through an advertising link or from search. Let’s look at when one page is enough, when each service needs its own, and how to structure the service page itself, the request form and the contact details.',
        'body'     => [
            ['How a landing page differs from a multi-page site', 'A landing page, also known as a one-page site, is a single page built around one offer and one action: call, write, send a request. If a landing page has a menu, its items do not open new pages; they scroll the same one.

A multi-page site works differently: each service has its own address, for example yoursite.az/services/installation/ and yoursite.az/services/repair/. The home page leads to the sections, while someone coming from search or an ad often lands straight on the page for the service they need, bypassing the home page.

Advertising adds to the confusion. In Google Ads, a landing page is any page an ad leads to: its address is entered in the ad as the final URL. It can be a standalone landing page, or it can be a service page on an ordinary website.

So the main difference is not length or design but the number of addresses: a one-page site has one, a multi-page site has one for each service. Almost everything else depends on that.'],
            ['When a one-page site is enough', 'One page works well when there is a single offer and people are brought to it rather than finding it themselves. Typical cases:
— you offer one service or promote one product;
— visitors arrive via a link: from an ad, Instagram, a newsletter, a QR code on a flyer;
— you need to test demand for a new line of business quickly before building a full website;
— the offer has a deadline: a promotion, enrolment for a course, an event.

For advertising, the page needs to match the ad. Of the three components of the Quality Score that Google Ads assigns to keywords, one is landing page experience: how relevant and useful the page is to the people who clicked the ad. A landing page about a single service shows people exactly what they clicked for.

The difficulties begin when there are several services. Ads for installation, repair and cleaning all lead to the same first screen, and people have to find the block they need on their own.'],
            ['Landing page or website: how search sees it', 'A search engine shows individual pages in its results, not websites, and each result has its own title. One of the sources Google uses to create it is the page’s title tag. Google advises giving each page its own title that describes that page’s content specifically, without repeated text. A one-page site has a single title, and it has to describe everything at once.

Anchor links do not solve the problem. An address like yoursite.az/#repair is the same page: according to Google, search generally does not support URL fragments, that is, the part of the address after the # sign. That will not turn the “Repair” block into a separate page in the index.

Meanwhile, people search for specific things: “air conditioner cleaning”, “air conditioner repair at home”, “split system installation”. Each query comes with its own questions. A page that covers a bit of everything will have to compete in the results with pages devoted entirely to that topic. Hence a simple rule: if customers find you in search for different services, each service needs its own page.'],
            ['A service business website: one page, one service', 'The structure of a service website usually fits into three levels: the home page, a “Services” section with a list, and pages for individual services. Each page answers one main query and its close variants: “air conditioner installation” and “split system fitting” go on one page, repair on another.

Addresses are better built from words than from numbers: yoursite.az/services/air-conditioner-installation/ makes sense to both people and search engines. That is exactly what Google recommends: readable words instead of long IDs, with hyphens between words rather than underscores.

The same pages work for advertising too. The final URL is set in each ad, so ads about repair can lead to the repair page and ads about installation to the installation page. You do not need a separate landing page for each campaign.

There is a line you should not cross. Google’s spam policies call pages created for similar search queries doorway pages. Examples include pages for individual cities or regions that all lead to the same place, and near-identical pages instead of a clear site structure. Pages such as “Air conditioner repair in Yasamal” and “…in Nasimi” with the same text come close to that description. A page of its own is justified when the service has its own content: the process, the questions, the price.'],
            ['What a service page is made of', 'A good service page answers questions in the order in which they occur to people. The set of blocks is usually as follows:
— a heading that names the service in the words people use to search for it, and the place where you work;
— the first screen: what you do, for whom, and a contact button that is visible without scrolling;
— what the service includes and what it does not;
— how the work goes: the steps from request to result;
— the price, or what it depends on;
— examples of completed work for this particular service;
— answers to frequently asked questions;
— contact details and a request form, with links to related services below them.

On a phone the page turns into one long scroll, so it makes sense to pin the call or message button to the bottom of the screen: that way it is visible however far down someone scrolls. And each block should have its own job: if the blocks repeat one another, the page simply gets longer.'],
            ['The request form: which fields you really need', 'For a service request, two fields are usually enough: name and phone number. Each additional field is one more question the person has to answer right now. The address, the equipment model and a convenient time are easier to clarify in conversation.

Technical details that are easy to check yourself:
— the phone field needs the tel type: for it, a mobile browser can show a keypad for dialling numbers;
— the autocomplete attribute with the values name, tel and email tells the browser which saved details to fill in;
— the tel type does not check the number’s format, so validation is needed on the server, and it must accept numbers starting with either +994 or 0, with or without spaces;
— each field needs a visible label, and grey text inside the field does not replace it: as the W3C points out, it disappears as soon as someone starts typing, and screen readers do not treat it as a label.

After sending, the person should see that the request has arrived and what happens next — for example, when they will get a call back. And you should receive it somewhere you are sure to see it: by email, with a copy sent to a messenger or CRM. Check the form after launch and after every change to the site. If requests arrive as emails and the domain’s email is not set up, they risk ending up in spam — there is a separate article on the blog about SPF, DKIM and DMARC.'],
            ['Phone, WhatsApp and other ways to get in touch', 'A form does not suit everyone: some people want to call right now, others want to write and get an answer later. So next to the form you need quicker routes.

The phone number is set up as a link of the form tel:+99412XXXXXXX — on a smartphone, a single tap on it offers to call that number. The number in such a link is written in international format with a plus at the start. For readability the standard allows hyphens, dots and brackets, but not spaces.

For WhatsApp there is a link of the form wa.me/number. The number is given in full international format, but without the plus, leading zeros, brackets or hyphens: 050 XXX XX XX becomes wa.me/99450XXXXXXX. You can add a ?text= parameter to the link with a pre-written, URL-encoded message — for example, with the name of the service. This text will appear in the chat’s input field, the person will send it themselves, and if they do not delete it, you will know straight away which page they came from.

If customers come to you, add your address, a map and your opening hours. And list only the channels you actually respond on: a link to a messenger where messages sit unread for weeks is worse than no link at all.'],
        ],
        'end'      => 'The choice between a landing page and a website is decided not by budget or fashion but by where your customers come from. One offer and traffic from links — one page is enough; several services and search — each one needs its own page with its own address and title. And on any of them, people should understand straight away what you do and get in touch in the way that suits them: by phone, by message or through a short form.',
    ],
    'mnogoyazychnyj-sajt-az-ru-en' => [
        'seoTitle' => 'Multilingual website: setting up az, ru and en versions',
        'seoDesc'  => 'A website in Azerbaijani, Russian and English: URLs, hreflang, the language switcher, translated titles and the letters ə and ğ in fonts and URLs.',
        'title'    => 'Multilingual website: how to set up Azerbaijani, Russian and English versions',
        'desc'     => 'How to build a website in three languages so that Google shows the right version and visitors do not get lost: URLs, hreflang, the language switcher, translation and Azerbaijani letters.',
        'rubric'   => 'Websites',
        'lead'     => 'You are reading a service page on your own website in Russian, you click English — and end up on the home page. For a Russian-language search Google shows the Azerbaijani version, and in the English version half the buttons are still in Russian. These are the signs of a multilingual website where the languages were added on top of a finished version without thinking through how they connect. Let’s look at how a website in Azerbaijani, Russian and English should work, both technically and editorially: URLs, hreflang, the language switcher, translation, titles for search, pages without a translation and the letters ə and ğ.',
        'body'     => [
            ['A multilingual website starts with separate URLs', 'The main rule: each language version of a page has its own permanent URL. For example, example.com/az/xidmetler/, example.com/ru/uslugi/ and example.com/en/services/. Google explicitly recommends separate URLs for each language and advises against switching the language at the same address using cookies or browser settings.

By default, Google’s crawler visits from IP addresses that are identified as being in the US, and it does not send the Accept-Language header that a site could use to guess the language. If the version is chosen automatically, Google may not crawl and index all of the language versions.

Ways to structure the URLs:
— subfolders on one domain: /az/, /ru/, /en/ — easy to set up and maintain;
— subdomains such as az.example.com — acceptable, but the address does not always make it clear whether it stands for a language or a country;
— a parameter such as ?lang=en — in Google’s comparison of the options, this approach is marked as not recommended.

For the same reason, it is best not to redirect visitors automatically to another version based on their IP address or browser language. Google advises against it: redirects like these can hide some of the versions from both people and the search engine. Someone in Baku whose phone interface is in English may well be looking for the Russian page.'],
            ['How hreflang links the versions together', 'Next, the search engine needs to be told that /ru/uslugi/ and /az/xidmetler/ are the same page in different languages. That is what the hreflang attribute is for. It is specified with link tags in the page’s code, with HTTP headers or in the sitemap.xml file. For Google these methods are equivalent; one is enough.

The rules from the Google Search Central documentation:
— each version lists all the language versions, including itself;
— the links are reciprocal: if the Russian page points to the English one, the English page must point to the Russian one, otherwise Google will ignore that pair;
— URLs are written in full, with https://, not as /en/services/;
— the language code follows ISO 639-1: az, ru, en; you can optionally add a country code after a hyphen (az-AZ), but a country code without a language does not work;
— the x-default value sets a fallback page for everyone whose language does not match any of the options — a language selection page, for example.

Another mistake is when rel=canonical on all three versions points to the Azerbaijani one. Google asks for the canonical page to be in the same language: the Russian version points to itself, and the English version points to itself.

Google determines a page’s language from its visible text, not from hreflang or the lang attribute. hreflang has a different job: to show the person in the search results the right version out of those already found.'],
            ['The language switcher leads to the same page', 'A visitor notices a faulty switcher straight away: they were reading about a service in Azerbaijani, clicked “Русский” and ended up on the home page.

The right way is for each link in the switcher to lead to the translation of the current page. For that, pages have to be linked in the content management system: the Russian service page has a counterpart in Azerbaijani and in English. hreflang is built from the same links, and then the switcher and the markup do not contradict each other.

What the W3C — the consortium that develops web standards — recommends:
— put links to the other languages on every page that has a translation, and in a prominent place;
— write each language’s name in that language: Azərbaycanca, Русский, English — someone who cannot read the current version should still recognise their own language;
— do not use flags to indicate languages: a flag suits versions for different countries, not a simple translation. English and Russian are spoken in many countries.

The choice can be remembered so that the next pages open in the same language. But what should be remembered is the person’s decision, not the site’s guess.'],
            ['Translation: human, machine or both', 'Google’s spam policies mention translation among the automated transformations used to mass-produce pages from existing text that are of no use to the reader. It is the pages themselves that count as the violation, however they were made: what is judged is the result, not the tool.

In practice, machine translation is fine as a draft and poor as the final version. It can mix up terms, translate a name that should not be translated, and it does not know how people in your industry actually talk. A workable approach is a draft followed by proofreading from a native speaker who knows the subject. For recurring words, a shared glossary helps: the company name, services, job titles, wording from contracts.

You need to translate everything the visitor sees, not just the main text:
— the menu, buttons and footer;
— forms, field hints and error messages;
— confirmation emails sent after an enquiry;
— alt text for images;
— the 404 page and legal texts.

Google advises keeping a single language on a page, navigation included, and not placing translations side by side. English text under a Russian menu is a mix, not a translation.

Which words people search with in each language is a separate piece of work on search queries, not translation.'],
            ['Search titles in every language', 'A page’s title for search (the title tag) and its description (meta description) are as much part of the site’s text as everything else. They are translated along with the page, not left over from the main version.

Google has an explicit rule on this: the title is written in the same language and script as the page’s main content. If they do not match, Google may show some other text in the search results instead of your title, one that better matches the page. A Russian title on an English page is exactly that case.

A word-for-word translation is not the best option either. The title should describe the content and sound natural to someone searching in that language. The same principle applies to URLs: Google advises using words in the audience’s language in the URL. That is why, on the English version, /en/services/ is better than /en/uslugi/.'],
            ['What to do with pages that have no translation', 'On a website in three languages, all the versions are rarely ready at the same time. The English one, for example, may lag behind, with some pages existing for now only in Russian and Azerbaijani.

The worst option is to create an English URL and put Russian text there, or a “translation coming soon” placeholder. Google treats language versions as duplicates if the main content of the page has been left untranslated.

The sensible order is this:
1. A page without a translation simply does not exist in that language version.
2. hreflang lists only the versions that exist. A set of two languages instead of three is a normal situation: Google processes the pages that point to each other.
3. On such a page the switcher either does not show the unavailable language or leads to the home page of the right version and says so plainly.
4. When the translation appears, it is added to the markup of all versions of the page at once.

A blog or a news section does not have to come out in three languages. An article that exists only in Russian is a perfectly normal article, as long as it does not pass itself off as a translation.'],
            ['The letters ə, ğ, ı and İ: fonts, capitals and URLs', 'Fonts. Not every font has the letters ə, ğ, ş and İ. Google Fonts splits fonts into character subsets, and these letters belong to the extended Latin subset, latin-ext, not to the basic latin subset. If you load only the basic subset or choose a font without these characters, the browser will take the missing letters from another font, and the word “xidmətlər” will be pieced together from two different typefaces. Check every weight and style used on the site. If the site shows prices, add the manat sign ₼ to the same check.

Capitals. Azerbaijani has two pairs: i and İ with a dot, ı and I without. The CSS text-transform property takes this into account only if the page’s language is specified — the lang=az attribute — and the browser supports this rule. Without it, the menu item “Qiymətlər” set in capitals will turn into “QIYMƏTLƏR” instead of “QİYMƏTLƏR”. Screen readers need the lang attribute too: they use it to choose pronunciation rules. That is why the WCAG accessibility standard requires the page’s language to be specified in the code.

URLs. Azerbaijani URLs can go one of two ways: transliteration without the special letters (/az/xidmetler/) or the original spelling (/az/xidmətlər/). Google accepts both. But letters outside basic Latin are encoded in a URL: technically, /az/xidmətlər/ is /az/xidm%C9%99tl%C9%99r/, and Google advises writing the address exactly that way in links within the code. Whichever way you choose, stick to it across the whole site.'],
        ],
        'end'      => 'A multilingual website is not one site with a translate button but three linked versions, each with its own URLs, titles and texts. hreflang and the switcher set up the links between them; the quality comes from the people who translate and proofread. You can check your own site in a minute: open any inner page, switch the language and see where you end up and what language the title in the browser tab is in.',
    ],
    'brif-na-razrabotku-sajta' => [
        'seoTitle' => 'Before you order a website: checklist and design brief',
        'seoDesc'  => 'Goals, pages, copy and photos, examples, languages, domain and access: what to gather for a website design brief and how it differs from website requirements.',
        'title'    => 'What to prepare before you order a website: brief, materials and access',
        'desc'     => 'A practical checklist before you order a website: what to decide and gather in advance, how a brief differs from a technical specification and which access the company should keep.',
        'rubric'   => 'Websites',
        'lead'     => 'You have decided to order a website, written to a contractor and received a questionnaire several pages long in reply. Some of the questions are clear, some are not, and the answers to a few were known only to an employee who left long ago. If you put them off, the project will stall anyway — just later, when the mock-up is ready but there is no copy, no photos and no access to the domain. Let’s look at what to gather before your first conversation with a contractor, how a website design brief differs from a technical specification and which access should stay with the company.',
        'body'     => [
            ['Brief and technical specification: what’s the difference', 'These two documents are often confused, although they answer different questions.

The brief is what you know: why the company needs a website, who its customers are, what materials already exist and what constraints there are on timing and budget. The client fills it in, sometimes together with the developer at a meeting. A website design brief requires no technical knowledge — only decisions that nobody else will make for you.

The technical specification — the website requirements document — describes what will be built: the list of pages, features, forms, languages and connected services, and the requirements for the admin panel. It is usually written by the developer on the basis of the brief, and you approve it. The work is then, as a rule, accepted against the specification, so it is worth reading carefully: anything that is not in it will have to be discussed all over again at handover.

The more detailed the brief, the less guesswork in the specification. Below is what exactly is worth putting into it.'],
            ['What the website is for and who will visit it', 'A goal of “so that we have a website” tells the developer nothing. It is more useful to decide which visitor action matters most to you: sending an enquiry, calling, messaging you on WhatsApp, downloading the catalogue or making sure the company exists and is operating — for example, before a tender.

Then describe the people who will come. Not their age and gender, but who they are in relation to you: a procurement manager at a large company, the owner of a flat after a renovation, a foreign partner. What language they search in, what device they use, what they need to find out before getting in touch.

A good source is your own calls and messages. Write down the questions customers ask most often: timescales, warranty, whether you work with businesses, whether there are samples. This list later turns into both the page copy and a questions-and-answers section.'],
            ['The list of pages, copy and photos', 'Which pages a corporate website needs is a separate topic. For the brief, a rough list is enough: which sections you have in mind, what should go on each one and who supplies the material for it. It is convenient to put this into a three-column table: page, content, person responsible.

With the copy, decide one thing in advance: whether you are writing it or the developer is. If it is you, collect the drafts in one document rather than in messenger chats. Separately, prepare the details that leave no room for mistakes: the legal name, address, phone numbers, working hours, and company and bank details if they are needed on the site.

There are three rules for images:

— send photos as originals — as files, an archive or through a cloud folder, not in a chat: WhatsApp’s help centre, for example, warns outright that media files are usually compressed when sent and the quality may end up lower than the original;
— the logo is needed in a vector format — usually SVG, EPS or PDF — not as a picture from an email signature;
— if an image from a search has no © symbol, that does not mean you are free to use it.

The last point needs explaining. The Berne Convention, which Azerbaijan has also joined, does not allow copyright protection to depend on any formalities: it requires neither the symbol nor registration. In Google Images you can filter results by usage rights, but Google itself advises checking the exact licence terms before using an image — details of the licence open via the link under the image.'],
            ['Examples you like, and competitors', 'A link to a website you like, without an explanation, does not tell anyone much. You might like the site for its photos, while the developer decides you want the same menu structure. So add a line or two to each example about what exactly you like: how the menu works, how projects are presented, the style of the photos, how short the copy is, what the enquiry form looks like.

The opposite list is just as useful — what annoys you on other people’s sites. Pop-ups, small print, slides that change on their own, a phone number you have to hunt for: comments like these immediately rule out options you do not need.

The examples do not have to come from your industry. Competitors, though, are worth listing separately: a few local ones and, if there are any, a couple from abroad. For each one, note what they have done well, what is missing and how you differ from them. A competitor’s website is material for comparison, not a template to copy: its copy and photos belong to someone too.'],
            ['Languages, integrations and who will run the site', 'State which languages the site is needed in, whether every page is translated in full and who does the translation. If a language is going to be added “later”, say so straight away: building it into the structure is easier than fitting it into a finished site.

Integrations are everything the site has to be connected to. List:

— where enquiries from the form go: to which email address, which CRM or messenger, and to which member of staff;
— whose number goes on the WhatsApp button and in the site header;
— which analytics and advertising services need to be connected;
— a map, online payment, an export from your accounting software, if they are needed.

A separate question is who will update the site after launch. Name a specific person and what they will change: news, projects, vacancies, prices. That determines what the admin panel needs to be like. This person needs their own account with limited permissions, not a shared administrator password. WordPress, for example, has Editor, Author, Contributor and Subscriber roles as well as Administrator: an editor publishes and edits content, including other people’s, but does not install plugins or change the site’s settings.'],
            ['Domain, hosting and access: what the company should keep', 'Why the domain should belong to the company is a separate discussion. Here is what to check before you order and what to receive at handover.

If you already have a domain, find out who is listed as its owner with the registrar and who has access to the account dashboard. A public WHOIS lookup may not answer this: for domains in generic zones such as .com, ICANN rules allow the registrar to hide the owner’s name. It is more reliable to look in the account itself. Transferring such a domain to another registrar requires an authorisation code, which the registrar issues to the owner. If the owner is a former contractor, the move will depend on them.

Hosting is also best registered to and paid for by the company, with the developer given access as a user. The same goes for Google services: in Search Console only the property owner can add and remove users, and in Google Analytics only the “Administrator” role can manage users. So the owner and administrator should be the company’s account: you grant access to the developer, not the other way round.

At handover the company should be left with:

— access to the registrar account and the hosting control panel;
— an administrator account in the site’s admin panel;
— access to the files and the database, or at least a clear idea of who has it;
— owner rights in Search Console and administrator rights in Analytics;
— the design source files and a list of paid plugins and services with their renewal dates.

Passwords are shared through a password manager, not as a message in a group chat. If the developer no longer works on the site, the passwords are changed.'],
            ['Checklist: what to gather before you order a website', 'Everything listed above fits on a single page. You can send it to a contractor before the first meeting or simply go through it yourself:

1. The purpose of the site and the main visitor action.
2. Who your customers are and what they ask most often.
3. A rough list of pages with the people responsible for materials.
4. The copy, or a decision on who writes it.
5. Original photos and the logo in vector format.
6. Examples, with notes on what you like and what you do not.
7. Competitors and how you differ from them.
8. Languages and who translates.
9. Where enquiries go and which services to connect.
10. Who will update the site and with what permissions.
11. The domain, hosting and analytics, registered to the company.'],
        ],
        'end'      => 'Preparing to order a website is not technical work but a set of decisions you will have to make anyway — only later and in a hurry. The more items are settled before the first conversation, the more accurate the technical specification will be and the fewer disputes there will be at handover. And access to the domain, hosting and analytics should stay with the company from day one, whoever builds the site.',
    ],
    'logotip-chto-dolzhno-byt-v-komplekte' => [
        'seoTitle' => 'Company logo design: which files you should receive',
        'seoDesc'  => 'Before you order a logo: what the set should include — vector, versions, HEX, RGB, CMYK and Pantone colours, a favicon — and how to check it before sign-off.',
        'title'    => 'Logo design: which files and versions the finished set should include',
        'desc'     => 'Vector files with the text converted to outlines, horizontal and vertical versions, the mark on its own, colour codes for screen and print, a favicon — and five checks before you accept the work.',
        'rubric'   => 'Design',
        'lead'     => 'The logo has been approved, and the designer sends two files: logo.png and logo.jpg. A month later the printer asks for “a vector”, the sign maker wants “outlines” and the web developer needs an icon for the browser tab — but the designer no longer replies, so the mark gets redrawn from the picture. Logo design does not end with an approved sketch; it ends with a set of files you can work with without the designer. Let’s look at what that set includes and how to check a logo before you accept the work.',
        'body'     => [
            ['The vector file: the main outcome of logo design', 'Any company logo can be saved in one of two ways. A raster image — PNG or JPEG — is a fixed-size grid of dots: stretch it across a banner or a sign and the edges turn jagged or blurry. A vector file stores not dots but a description of the outlines, so it can be enlarged even to the size of a building’s facade and the lines stay crisp.

There are usually three master files:

— SVG — an open format from the W3C consortium; browsers understand it, and it is the one that goes on the website;
— PDF — a printer can open it, and so can any computer without design software;
— AI — the Adobe Illustrator working file, if the mark was drawn in it; the next designer will need it.

All three share one condition: the text has been converted to outlines, meaning the letters have been turned into ordinary shapes. If the text is left live and the font is not embedded in the file, a computer without that font will substitute a different one — and the company name will change typeface right there at the printer’s.

You can check for yourself that the vector is genuine. Open the PDF and zoom in to 800% or more: the edges of the letters should stay smooth. Open the SVG in Notepad. If there is an image tag inside, especially one with a long string starting with data:image, what you are looking at is a raster image in a vector wrapper, not a vector.'],
            ['Horizontal, vertical and the mark on its own', 'One layout does not work everywhere. A website header, a letterhead, a sign above the entrance are long, narrow spaces. An avatar, a sticker, a badge are square. So there should be several versions:

— horizontal: the mark on the left, the name on the right;
— vertical: the mark on top, the name below it;
— the mark without any text — for an avatar, the website icon, embroidery on uniforms;
— if needed, the text alone without the mark.

If there is no separate mark and the logo is a stylised name, square spaces usually get a version based on the first letter or a monogram. It is better to think this through at the design stage than to come up with something in a hurry later for the sake of an icon.

Each version is sent as separate files in the same formats as the master. If the horizontal version comes as a vector but the vertical one only as a PNG, the set is not finished.'],
            ['Colour, black and white versions', 'A logo is not always reproduced in colour. Engraving on metal, embossing, laser cutting, a stamp, single-colour printing on carrier bags, till receipts — these are usually one colour. For cases like these you need a monochrome version: the whole mark in a single colour, with no gradients or halftones.

A reversed, or inverted, version is a light logo for a dark background. It is not always just a white fill. If the mark has internal details, inverting it swaps light and dark, and the design may read differently. The designer corrects these areas by hand and hands over a finished file.

The minimum colour set: a full-colour version, a black one and a white one. If the logo contains a gradient, you also need a flat version without it.'],
            ['Colours: HEX and RGB for screen, CMYK and Pantone for print', '“Our brand blue” means nothing until it has codes. Screens and paper produce colour differently, so there are several codes.

RGB describes a colour on screen as a mix of red, green and blue. HEX is the same RGB value written in hexadecimal, for example #1A4F8B; this is what goes into the website’s code. CMYK is the four inks of ordinary full-colour printing: cyan, magenta, yellow and black.

Automatic conversion from RGB to CMYK does not always work. Some bright screen colours cannot be reproduced with printing inks, and Illustrator and Photoshop warn that such a colour falls outside the print gamut. So it is better to choose the CMYK values in advance and check them on a test print, rather than getting them by conversion the day before the artwork goes to the printer.

Pantone is a different matter. It is not a mix of four inks but an ink premixed to the exact shade: the printer orders it by number or mixes it in-house using the Pantone formula. This kind of colour is specified when the brand shade has to be reproduced precisely — for example, on packaging, letterheads and branded bags. A Pantone number can carry a C or U suffix — for coated and uncoated paper — and the same colour looks noticeably different on different paper. Choosing a Pantone colour on screen is unreliable: the shade is checked against a printed swatch book.'],
            ['Minimum size and clear space', 'Even if you did not order a brand book, a logo should come with two rules.

The minimum size is the smallest width at which the logo may be used: any smaller and the thin lines and the text run together. It is usually given separately for screen, in pixels, and for print, in millimetres. For very small sizes a simplified version is sometimes made — without the fine details or without the lettering.

Clear space is the empty area around the logo that text, the edge of the page and other logos must stay out of. It is convenient to define it not in millimetres but through an element of the logo itself, such as the height of a capital letter: that way the rule works at any scale.

The versions, the colours and both rules can fit on one or two pages of a PDF — a kind of passport for the logo. A full brand book with the palette, typefaces and examples of incorrect use is a separate document.'],
            ['PNG files and icons for the website', 'Raster copies are needed because not every place accepts vectors: messaging apps, social media, email signatures, many website builders. PNG supports transparency and JPEG does not, so a JPEG will always have a solid rectangle instead of a transparent background. Exports are made as PNGs on a transparent background, in several sizes, for each version and each colour.

The icon in the browser tab — the favicon — is a separate task. It is usually 16×16 pixels, and only the mark without the text fits there, often in a simplified form. A website needs a small set of files:

— a square PNG larger than 48×48 pixels — the size Google recommends for the icon in search results;
— favicon.ico — the Windows icon format; one file can hold several sizes, and Google accepts this format too;
— apple-touch-icon — the icon for a home screen shortcut on iPhone and iPad; in the example in Apple’s documentation for iPhone it is a 180×180 pixel PNG;
— 192×192 and 512×512 pixel icons for the manifest — Chromium-based browsers require them if the site can be installed as an app.

It is also worth adding an SVG icon: Chrome, Edge and Firefox display it, and Safari does from version 26 onwards. But SVG is not on the list of formats Google accepts for the icon in search, so it does not replace the other files.'],
            ['How to check a logo before you accept it', 'You do not need design software for these checks.

1. Shrink it. Scale the mark down on screen to the size of a browser-tab icon, then print the logo about 2 cm wide, as it would appear on a pen or a business card. Can you read the name and make out the mark?
2. Take away the colour. Print the logo on an ordinary black-and-white printer. A good mark is recognisable by its silhouette rather than relying on colour.
3. Put it on a photo. Place the logo on a light photo, a dark photo and a busy background. Wherever the colour version gets lost, the white or black one should come to the rescue.
4. Fit it into a circle. If the frame is round wherever you will use it as an avatar, check whether the corners of the mark get cut off.
5. Open the files on someone else’s computer. The PDF and SVG should open without design software and without the brand font, the PNGs should have a transparent background, and the file names should make sense without the designer.

When you are ready to order a logo in Baku or anywhere else, write the list of files from this article into the contract or the brief before work begins. That way it is clear from the outset what counts as finished work.'],
        ],
        'end'      => 'A finished logo is not a picture but a set: vector files with the text converted to outlines, several layouts, colour, black and white versions, colour codes for screen and print, a minimum size, clear space, PNGs and icons for the website. You can check it without a designer: shrink it, take away the colour, put it on a photo, fit it into a circle and open it on someone else’s computer. If the logo passes all five checks, you can accept the work.',
    ],
    'brendbuk-chto-v-nyom-dolzhno-byt' => [
        'seoTitle' => 'Brand book and corporate identity: contents and who needs it',
        'seoDesc'  => 'What goes into a brand book: logo rules, colour codes, fonts, grid, photo style. And what printers, SMM and web developers take from brand guidelines.',
        'title'    => 'A brand book for a small company: what it should contain and how it is used',
        'desc'     => 'How a logo differs from a corporate identity and a brand book, which sections short brand guidelines need, and what the printer, the SMM specialist and the web developer take from them.',
        'rubric'   => 'Design',
        'lead'     => 'Your business cards were printed at one print shop, the exhibition banner at another, and a third person makes your Instagram posts. Lay everything side by side: the blue turns out to be three different shades, the logo on the banner is slightly squashed, and the font in the posts only looks like the brand one. None of the contractors got it wrong on purpose — they simply were not given any rules. A brand book is exactly that: rules written down once. Let’s look at how it differs from a logo and a corporate identity, what it should contain and what the printer, the SMM specialist and the web developer take from it.',
        'body'     => [
            ['Logo, corporate identity and brand book: what’s the difference', 'A logo is the symbol and the way the company’s name is written. One element, even if it is the most noticeable one.

A corporate identity, or visual identity, is a system in which the logo sits on equal terms with the colours, fonts, graphic elements and the style of photography. When the identity is coherent, people recognise the company even from a photo where the logo did not make it into the frame.

A brand book is the document in which this system is written down: rules, sizes, codes and examples. The terminology is loose. A brand book is often taken to mean a large document that also covers the brand platform — mission, values, tone of voice. A short document covering only the visual rules is called brand guidelines, and a very short one, covering only the logo, a logo book. The name matters less than the content.

A small company usually needs no more than short guidelines — a single PDF that can be sent to any contractor. Without such a document, developing a corporate identity ends in a folder of files whose logic only the author knows. As soon as the designer or contractor changes, the identity starts to come apart with the very first new layout.'],
            ['The logo: versions, clear space and what not to do', 'The first section describes how the logo should be used and how it must not be.

— Versions: the primary one, horizontal and vertical layouts, and the symbol on its own without the name.
— Colour variants: full colour, single-colour dark and white for dark backgrounds. The single-colour version is needed for engraving, embossing, one-colour printing and black-and-white documents.
— Clear space is the empty area around the logo that text and other elements must not enter. It is set as a proportion of the logo itself, for example the height of one letter, rather than in millimetres: that way the rule works the same on a business card and on a sign.
— Minimum size — separately for print in millimetres and for screen in pixels. Any smaller and the fine details merge together.

The most useful page in the section is incorrect usage. It collects crossed-out examples: the logo stretched or squashed, rotated, recoloured, with a shadow or an outline, the name set in a different font, elements rearranged, the logo placed on a busy photo with no backing. A page like this is understood at a glance, without reading the rules.'],
            ['Colours: one shade, several codes', 'The words “our blue” mean nothing to a printing press or to a monitor. Each colour in the palette is written down with codes for each medium:

— HEX and RGB — for screens: the website, social media, presentations. HEX is a notation like #0B5FA5, where three pairs of hexadecimal digits set the red, green and blue channels.
— CMYK — for four-colour printing: business cards, leaflets, catalogues.
— Pantone — for spot-colour printing, when the colour has to match from one print run to the next: carrier bags, packaging, letterheads.
— RAL — for paint and coatings: the sign, the façade, metal, interiors. RAL itself does not make paint — it is a reference standard for shades, and manufacturers make paint to its numbers.

Pantone codes have a suffix, and it indicates the paper: C is coated, U is uncoated. Uncoated paper absorbs more ink, so the same number looks different on it. If a company prints on both types of paper, the palette gives both versions.

CMYK should not be obtained by automatic conversion from HEX: the software will substitute the nearest printable shade, and it is not always the one you need. Even Pantone gives only the closest CMYK equivalents for its colours. The values are chosen and checked on a proof print.

The palette also needs proportions — which colour is primary, which is the accent and which are the neutrals for backgrounds and text — and a contrast check. If text on the website is set in a brand colour, WCAG success criterion 1.4.3 requires a contrast of at least 4.5:1 for normal text and 3:1 for large text. Large text means 18 points and above, or 14 points and above in bold — roughly 24 and 18.5 pixels in CSS. The logo is exempt from this requirement; text on buttons and in menus is not. Pale shades on a white background often fail the check, so a darker version of the same colour is added to the palette for text.'],
            ['Fonts: Cyrillic, the Azerbaijani Latin alphabet and the licence', 'One or two fonts are usually enough: one for headings and one for body text. To these you add a system fallback — a standard font installed on almost any computer — for Word documents, spreadsheets and emails.

For a company in Baku there is one check you cannot skip when choosing a font: it must contain both Cyrillic and the full Azerbaijani Latin alphabet — not just the basic letters but also ç, ə, ğ, ı, İ, ö, ş, ü. A note saying “Latin” in the font description does not guarantee this; it is simpler to type some Azerbaijani text and look. If a letter is missing from the font, the browser will take it from another font, and a character of a different weight and height will appear in the middle of the word.

The second question is the licence. With commercial type foundries, the licence to install a font on a computer for layouts and the licence to use it on a website are often sold separately, and a web licence is frequently priced by the number of page views per month. Fonts under the SIL Open Font License can be used in print, in a logo and on a website without separate permission or payment. It is the only licence under which Google Fonts currently accepts new fonts. The brand book records where the font came from and what the licence covers.

Next come the typesetting rules: which weights and styles are used, how heading and text sizes relate to each other, and what line spacing and alignment to use.'],
            ['Grid, spacing and image style', 'The grid sets the columns and margins for standard formats, and spacing is made a multiple of a single step. The point is practical: a contractor who knows the step and the grid will make a new layout look like the previous ones without every detail having to be agreed. This also covers a fixed position for the logo — for example, always the top left corner on leaflets and slides.

Graphic elements are what people recognise without the logo: a pattern, colour blocks, lines, a distinctive shape. If the identity includes icons, they are described too: outline or filled, how thick the line is, whether the corners are rounded.

Image style is the hardest thing to describe in words, so this is where “do” and “don’t” examples work. Warm or cool light, people in the shot or only objects, a background that is a real interior or a plain one, processing that is natural or high-contrast. Without this section every new contractor will bring photos to their own taste, and your social media feed will turn into a collage.'],
            ['Examples on real items', 'The last section shows the rules at work — on the items the company actually uses:

— a business card and a letterhead;
— an email signature;
— an avatar and a post template for social media;
— a title slide and a standard slide for presentations;
— signage, uniforms, vehicles or packaging — if the company has them.

There is no need to design everything. A branded carrier bag is no use to a company that sells nothing at retail, while a Word template for a commercial proposal, which the managers use every day, will prove more useful. Each example also serves as a test: if a rule cannot be applied to a real item, it should be rewritten.'],
            ['How the printer, the SMM specialist and the web developer use the brand book', 'Each contractor needs something different from the brand book.

The printer needs CMYK and Pantone with the suffix for the paper, the logo in vector format, the minimum size and the clear space. Layouts are sent to them as PDFs with the fonts embedded in the file or converted to outlines. If a font is not embedded and is not installed on the computer where the file is opened, the software will substitute another one, and the letterforms will not match.

The SMM specialist needs post templates, the palette in HEX, the fonts, rules for placing the logo over photos and examples of the photo style. The avatar is a separate matter: Facebook crops a page’s profile picture into a circle, and a long horizontal version of the logo will end up tiny inside it. The avatar needs the symbol or a compact version with a margin to the edge of the circle.

The web developer needs the HEX codes, which they will turn into variables in the stylesheets, fonts with a web licence, the grid and spacing step, the logo in SVG and a symbol that is legible in the small square of a favicon. And one detail for a site in Azerbaijani: if headings are converted to capitals with CSS, the page language must be specified in the markup. With the az tag, a browser that supports language-specific rules will turn i into İ. Without it you get a dotless I, which in Azerbaijani is the capital form of a different letter — ı. Support varies between browsers, so it is worth checking the result with your own eyes.'],
        ],
        'end'      => 'A small company’s brand book is not a thick book but a set of rules that lets any contractor reproduce your identity without you: the logo with its don’ts, colours in codes for each medium, fonts with a checked licence and all the letters you need, the grid, the photo style and examples. Checking yours is simple: give it to someone new and count how many questions they ask before their first layout.',
    ],
    'dizajn-kataloga-dlya-pechati-i-pdf' => [
        'seoTitle' => 'Catalogue design: preparing for print and a PDF for email',
        'seoDesc'  => 'A print-ready catalogue and a catalogue for email are two different PDFs. Pages, bleed, CMYK, photo resolution, fonts and PDF/X: what to check before print.',
        'title'    => 'Product catalogue design: what to check before printing and emailing',
        'desc'     => 'Why a product catalogue for the printer and one for email are two different files: page counts in multiples of four, bleed, CMYK, photo resolution, fonts and PDF/X.',
        'rubric'   => 'Design',
        'lead'     => 'The product catalogue is laid out, and on screen everything looks neat. Then the printer sends the file back: there is no bleed, the photos are in RGB, and there are thirty pages, although saddle stitching needs a number divisible by four. Emailing the same PDF to a client does not work either — it is too large. Catalogue design is not only the grid, the photos and the prices; it is also two technical files with different requirements. Let’s look at what to check before the catalogue goes to the printer and out by email.',
        'body'     => [
            ['Catalogue design starts with the page count', 'Thin catalogues are usually saddle stitched: the sheets are folded in half, nested inside one another and stapled with wire along the fold. One folded sheet gives you four pages. So the total number of pages, cover included, must be divisible by four: 8, 12, 16, 20 and so on. If the layout has 30 pages, you will have to either go up to 32 or cut down to 28.

It pays to count at the planning stage: how many pages the cover, the contents, the sections and the contact details will take. Adding or removing two pages in a finished layout means shifting everything that comes after them.

Saddle stitching has a limit on how thick the stack can be, and it depends on the paper — the printer will give you the exact figure. There is also page shift, known in print specifications as creep: when folded, the sheets in the middle of the stack stick out further than the outer ones, so after trimming their outer margins end up narrower. In a thin catalogue this is barely noticeable; in a thick one the shift is compensated for during imposition — ask whether your printer does this. Only one thing is required of you: do not push anything important up against the outer edge.

Thick catalogues are more often perfect bound, with the pages glued at the spine rather than sewn. Here the page count usually just has to be even, but part of the inner margin disappears into the spine. One typical recommendation is to keep text no closer than 10 mm to the inner edge.'],
            ['Bleed and safe margins', 'The printer prints on a larger sheet and then trims the whole run. Cutting has a small tolerance, so anything that should reach the edge of the page — a background, a full-page photo, a block of colour — is extended past the trim line. This extra area is called bleed. The most common request is 3 mm on each side, but other values occur too.

An example: under the ISO 216 standard, A4 is 210 × 297 mm. With 3 mm of bleed on each side, the page in the file comes out at 216 × 303 mm, and crop marks show where to cut.

Inside the page the opposite rule applies — the safe zone. Text, page numbers, the logo and prices are kept away from the trim line: the typical requirement is at least 3 mm, preferably 5 mm. Anything closer may be cut off if the blade shifts slightly.

A common mistake when laying out a catalogue for print: the background stops exactly at the edge of the page rather than at the edge of the bleed. If the blade shifts even a little, a thin white strip is left along the edge.'],
            ['CMYK and RGB: why colour looks different on paper', 'A screen builds colour out of light — red, green and blue (RGB). A printing press builds it out of four inks: cyan, magenta, yellow and black (CMYK). The colour gamut of print is generally narrower than a monitor’s: bright greens and blues come out more subdued on paper.

That is why a catalogue for print is prepared in CMYK, and it is converted using an ICC profile — a file that describes specific printing conditions. For offset printing on coated paper, for example, there is the standard PSO Coated v3 profile (FOGRA51 data) with a total ink coverage limit of 300%. A different paper needs a different profile, and which one is the first question to ask the printer.

You can see which colours will fall outside the gamut before you convert: in Photoshop the View — Gamut Warning command highlights them. The check is made against the profile selected in View — Proof Setup. If your brand colour matters on paper, it is better to define it in advance in CMYK or as a spot colour than to rely on automatic conversion.

Black has a rule of its own. Small text is printed in black ink alone: 100% K, with none of the other inks mixed in. Rich black is printed with several inks, and the slightest misregistration on press gives the letters fuzzy edges. Black defined in RGB usually turns into exactly that — a mix of all four inks — when converted through the profile.'],
            ['Photo resolution for print', 'The standard printers’ requirement is 300 pixels per inch (ppi; specifications often say dpi) at final size. The number in the file properties means nothing on its own: what matters is how many pixels per inch there are where the photo sits on the page.

The maths is simple. A photo 1200 pixels wide at 300 ppi will take up 4 inches — about 10 cm. For a picture across the full width of an A4 page with bleed (216 mm, roughly 8.5 inches) you need about 2550 pixels across. Images from a supplier’s website or a messaging app are often smaller, and on paper they will come out soft or visibly blocky.

Enlarging an image in software adds no detail: a photo stretched to twice its size gets half as many pixels per inch. In InDesign you can see this in the Links panel: Effective PPI shows the resolution with the scale on the page taken into account.

Logos, diagrams and icons are best placed as vector graphics — they print sharply at any size.'],
            ['Fonts: embed them and check the licence', 'If the printer’s computer does not have the font and it is not embedded in the PDF, the software will substitute another one — and the hyphenation, prices and headings will shift. That is why every font is embedded in a print file, and the PDF/X standard explicitly requires it.

Not every font can be embedded. An OpenType font file has an fsType field in which the font’s maker sets the embedding permissions. The value Restricted License means the font may not be embedded without the rights holder’s permission, and software that follows the specification will not embed it. It is worth checking the licence before you start the layout, not on the day you hand the files over.

You can check the finished PDF in Acrobat or the free Acrobat Reader: the File — Properties menu, Fonts tab. Each font should be marked Embedded or Embedded Subset. Some printers ask for text to be converted to outlines instead of embedding fonts. If you are asked to do this, keep a copy of the layout with live text: once text is in outlines, a typo can no longer be fixed simply by retyping.'],
            ['Laying out a print-ready catalogue: what PDF/X is', 'PDF/X is the ISO 15930 family of standards for sending files to print. It is an ordinary PDF with restrictions: it must contain nothing that the printer could read differently from what you intended.

Two versions come up most often in specifications:

— PDF/X-1a: CMYK and spot colours only, transparency is flattened on export;
— PDF/X-4 (ISO 15930-7): allows live transparency, layers and colours with ICC profiles, including RGB.

Which one you need is stated in the printer’s technical specifications. In InDesign both versions are among the standard export presets.

What a PDF/X file will not have is links. The PDF/X standards do not allow annotations in the printed area of the page, and a clickable link in a PDF is technically an annotation. In InDesign, while a PDF/X standard is selected, the Hyperlinks checkbox is unavailable.

Typical requirements for the file itself: single pages rather than spreads, in order, with bleed and crop marks. Some printers ask for the cover to be supplied as a spread — this, too, is something to check in advance.'],
            ['A PDF for email and the website', 'The file for clients is exported from the same layout, but with different settings:

— colour in sRGB, the standard colour space for screens and the web;
— photos at a lower resolution and compressed: on screen there is no need for 300 ppi of headroom, and it only adds to the file size;
— no bleed or crop marks;
— working links to your phone number, email, website and product pages.

InDesign has a standard preset for this, Smallest File Size. According to Adobe’s description, it is designed for the web, email and intranets: it converts colour to sRGB, compresses and downsamples images, and embeds fonts. Adobe does not recommend this option for print. Before exporting, check that the Hyperlinks checkbox is ticked, and after exporting, click through every link by hand.

A small file is needed because of email limits. A personal Gmail account lets you send no more than 25 MB of attachments; if the files are larger, Gmail removes them from the email and inserts a Google Drive link instead. In Google Workspace work accounts, the limits are set by the administrator. And the recipient’s mail service has its own limit on incoming emails, which you cannot know in advance. It is more reliable to put the catalogue on your website and send a link: the file will not get stuck on a mail server, and when prices change you only need to replace it at the same address.'],
        ],
        'end'      => 'One product catalogue almost always ends up as two files: a large CMYK PDF/X with bleed for the printer and a small sRGB PDF with links for the screen. The figures above are common requirements, not hard rules: the profile, the bleed, the PDF/X version and how the cover is supplied are decided by the individual printer. Ask the printer for its technical specifications before you start the layout — then you will not have to redo the artwork after the first rejection.',
    ],
    'dizajn-dlya-socsetej-razmery-i-shablony' => [
        'seoTitle' => 'Social media design: sizes and Instagram post templates',
        'seoDesc'  => 'Which post, stories and cover sizes Instagram and Facebook accept, how the profile grid crops previews and why a company needs post and stories templates.',
        'title'    => 'Social media design: Instagram and Facebook formats, covers and templates',
        'desc'     => 'Which aspect ratios and sizes Instagram and Facebook currently accept, how the profile grid crops previews and why post and stories templates save time.',
        'rubric'   => 'Design',
        'lead'     => 'A post looks neat in the feed, but in the profile the edges of the heading are cut off. All that is left of a video’s cover in the grid is half a face. A story was put together from a post image — and empty bands appeared at the top and bottom. And every week someone looks up all over again what size the image should be. Let’s look at which formats Instagram and Facebook accept today, how the profile grid crops previews and how to turn social media design into a set of post and stories templates.',
        'body'     => [
            ['Feed posts: which aspect ratios Instagram accepts', 'First, a caveat: the platforms change sizes along with app updates. The figures below were checked against Instagram’s help centre, Facebook’s help centre and Meta’s ads guide in October 2026.

According to Instagram’s help centre, a photo between 320 and 1080 pixels wide is kept at its original resolution if its aspect ratio is between 1.91:1 and 3:4. At a width of 1080 pixels, that means a height of 566 to 1440. A photo with any other aspect ratio is cropped to a supported one. An image narrower than 320 pixels is enlarged to that width, and one wider than 1080 is scaled down to 1080.

That gives four working sizes:

— 1080×1080 — square, 1:1;
— 1080×1350 — portrait, 4:5;
— 1080×1440 — portrait, 3:4, the tallest option for the feed;
— 1080×566 — landscape, 1.91:1.

At the same width, a portrait image takes up more of a phone screen — that is the main argument in its favour. The choice between 4:5 and 3:4 depends on advertising. Meta’s ads guide recommends 4:5 at 1440×1800 pixels for Instagram and Facebook feeds, and for ads in the Instagram feed 4:5 is also the tallest aspect ratio allowed. If a post might be promoted, it is easier to make it 4:5 from the start: one layout will work for both the feed and the ad.'],
            ['The profile grid: what people see before they open a post', 'In January 2025 Instagram replaced the square profile grid with a portrait one. Previews in it now have a 3:4 aspect ratio and are cropped to the centre by default, while the post itself is shown in full when opened. So every post has two versions: the full one in the feed and the cropped one in the profile.

How much is lost, in pixels of the original layout:

— a 3:4 post (1080×1440) appears in the grid uncropped;
— a 4:5 post (1080×1350) loses about 34 pixels on each side;
— a 1080×1080 square loses 135 pixels on both the left and the right, a quarter of its width;
— a 1.91:1 landscape image keeps less than half its width;
— a 9:16 video frame (1080×1920) loses 240 pixels at both the top and the bottom.

That gives the main rule of Instagram design since the grid change: keep the heading, faces, the product and the logo inside the central 3:4 area. For a square, that is a strip 810 pixels wide down the middle; for a 9:16 frame, a 1080×1440 rectangle in the centre.

You can adjust the preview of a post that is already published: Instagram has added a setting for choosing which part of the image goes into the grid frame. For a carousel, the profile shows the first slide — so that slide works as its cover.'],
            ['Stories and Reels: the 9:16 frame', 'Stories and Reels on Instagram and Facebook are full-screen vertical formats with a 9:16 aspect ratio. At a width of 1080 pixels, that is 1080×1920. Meta’s ads guide recommends 1440×2560 for stories and Reels — the same ratio with extra resolution in reserve.

It is better not to carry a post image over to stories as it is. A square or 4:5 image will fill only part of the vertical screen, and the text on it will get smaller. A story is a separate layout in its own template, not a shrunk copy of a post.

Part of the vertical frame is covered by the interface. For stories and Reels ads, Meta advises keeping roughly 14% of the height at the top, 35% at the bottom and 6% of the width on each side free of text and logos — that is where the profile icon and the call-to-action button may cover them. What exactly sits on top of the frame is explained in detail in a separate article on the safe zone in vertical video. For a template, it is enough to mark these zones with guides so that the price or address does not end up under the buttons.'],
            ['Covers and profile pictures: small areas, obvious mistakes', 'A Reels cover is either picked from the video’s frames or uploaded as a separate image. For an uploaded cover, Instagram’s help centre recommends 420×654 pixels — an aspect ratio of about 1:1.55. In the profile grid, both a cover like this and a frame taken from the video are shown in a 3:4 frame, with the top and bottom cut off. That is why the heading and the main subject go in the middle of the height.

Story highlight covers appear in an Instagram profile as small circles. Small text in a circle like that cannot be read; what works is a simple icon in one style for the whole row.

On both platforms the profile picture is cropped to a circle. Facebook’s help centre advises uploading a Page profile picture at 320×320 pixels; on a computer it is displayed at 176×176, on a smartphone at 196×196. A full logo with small lettering gets lost in a circle like that, so for a profile picture people usually use the logo mark or a shortened version.

The Facebook Page cover photo is the fussiest of all. According to the help centre, it must be at least 400×150 pixels, and it loads fastest as an sRGB JPG at 851×315 pixels and under 100 KB. On computers and phones it is shown in different aspect ratios, aligned to the left edge, and the left part is partly covered by the profile picture — on a phone it overlaps the cover by about 40 pixels. So text and the logo go nearer the centre, and the edges are left to background you will not mind losing.'],
            ['Carousels: one aspect ratio, one layout grid', 'You can combine up to 20 photos and videos in a single Instagram post. The orientation — square, portrait or landscape — is chosen once for all of them: according to Instagram’s help centre, you cannot set a different one for individual slides. Slides with other aspect ratios will have to be cropped, so they are all prepared at the same size from the very start.

The other side of consistency is visual. People swipe through the slides, and everything that is not supposed to move has to stay put: the margins, the position of the heading, the logo, the slide number. If the heading on the second slide sits a few pixels lower than on the first, it looks like a jitter when swiping. That is why a carousel template usually has several slide types ready in advance: a cover, a text slide, a photo slide and a final slide with contact details.

A continuous background that runs from one slide to the next is built as a single long canvas and cut exactly at the slide width: an error of a few pixels shows up as a step at the join.'],
            ['Why social media design is worth building into templates', 'Without templates, every post starts from a blank canvas: remembering the size, choosing a font, nudging the logo around. Decisions made once are repeated by hand every week, and with each repetition the feed grows less consistent.

A template fixes what should not change:

— the canvas size for each format: post, carousel slide, story, Reels cover;
— margins and safe zones as guides;
— text styles: heading, body text, caption;
— colours and the position of the logo;
— photo frames and the rules for cropping them.

A new post then means swapping the text and photos, not designing from scratch. A file like this can be maintained by an employee who does not do design.

If you publish in Azerbaijani and Russian, the template has to cope with both languages. The same phrase can be a different length in each: a one-line heading runs to two lines in the second language, and room for that is built in from the start. Check the font separately: the Azerbaijani alphabet has Ə, Ğ, Ç, Ş, Ö and Ü, as well as the dotless I and the dotted İ. Not every font has these letters, especially decorative ones, and then characters from another font or empty rectangles appear in their place. Type a phrase containing all of these letters before you approve the font.'],
            ['File formats and checks before publishing', 'For images, Meta’s ads guide lists JPG and PNG. JPG suits photographs. PNG compresses without loss and keeps the sharp edges of text and logos better — Facebook’s help centre specifically recommends it for profile pictures and cover photos with a logo or text. The colour profile is sRGB: the same help centre names it.

For video, the same guide lists MP4 and MOV, H.264 compression and stereo AAC audio at 128 kbps or higher.

Keep the templates themselves in editable form — with layers, styles and fonts — in the editor you work with them in: Figma, Canva or Photoshop. JPG and PNG are exports, not source files.

Before publishing, look at the layout on a phone: how it appears in the feed and in the profile grid, whether the text is legible on a small screen, and whether anything important has been cropped off.'],
        ],
        'end'      => 'Social media design starts not with the idea for a post but with the right canvas: 4:5 or 3:4 for the feed, 9:16 for stories and Reels, and the central 3:4 area for everything that will appear in the profile grid. These decisions are made once and built into post and stories templates; after that, only the text and photos change. Every six months, check the sizes against the platforms’ help centres.',
    ],
    '3d-vizualizaciya-tovara-vmesto-fotosemki' => [
        'seoTitle' => '3D product visualisation or photography: which to choose',
        'seoDesc'  => 'When CGI instead of photography makes sense and when a photo is better, what to give the designer and which files to take for the website and print.',
        'title'    => '3D product visualisation or a photo shoot: what to choose and what to prepare',
        'desc'     => 'When a 3D product render replaces a photo shoot and when it does not: what source data the designer needs and which files to take for your website, augmented reality and print.',
        'rubric'   => 'Design',
        'lead'     => 'The new range will only reach the warehouse in a couple of months, but the website and the catalogue are needed now. Or an armchair comes in ten or so upholstery options, and photographing each one means taking ten or so armchairs to the studio. In cases like these, the usual suggestion is 3D visualisation: the product image is not photographed but built from a digital model. Let’s look at when this really is more convenient than a shoot, when a photograph is more honest and simpler, what to prepare for the designer and which files to take at the end.',
        'body'     => [
            ['How 3D visualisation differs from a photo shoot', 'A photographer captures what is in front of the camera. In 3D visualisation there is nothing in front of the camera. The designer builds a digital model of the product to its dimensions, gives the materials their properties — colour, gloss, roughness, transparency — and sets up virtual lights and a camera. The software calculates how light bounces off the surfaces and produces an image. That image is what is called a render.

This is where the main difference lies. A photo shoot is a one-off: a new angle or a different colour means the product, the lighting and the photographer all over again. A model is made once, and after that you can get any shot you like from it: a different angle, a different colour, a different background, a close-up of a detail, a cross-section.

There is a flip side. A photograph shows an object that exists. A render shows whatever has been described. An inaccurate drawing, an approximate colour or an invented texture will carry over into the picture, and it will look convincing. So the quality of a product visualisation depends not only on the designer but also on the source data they are given.'],
            ['When 3D product rendering is more convenient than a shoot', 'There are situations in which the model wins almost every time.

— The product does not exist yet. The website, the catalogue and the dealer presentation are prepared in parallel with production, not after it.
— Lots of variants. There is one model, and the upholstery colour, the finish of the body or the label are changed by swapping a material or a texture. For product ads this is also a requirement: Google Merchant Center asks for a separate image for each variant, not one shared shot for all of them.
— Packaging. The box or label artwork is applied to the model, and you can see how it sits over the folds and edges before the print run. The same shots can show the product on the website while the boxes are on their way from the printer.
— Scenes and interiors. Furniture, lighting, bathroom fittings and finishing materials can be placed in a room that does not exist, with no venue hire and no delivery.
— A consistent catalogue. The same lighting, angle and scale for every item. A new item a year later goes into the same scene and does not look out of place.
— What cannot be seen from the outside. A cross-section, the inner workings, an exploded view of the parts — this is difficult or impossible to show in a photograph.'],
            ['When a photograph is better than a render', 'If the product is already in the warehouse, there are only a few variants and you need a standard product listing on a white background, a shoot is usually simpler. Modelling from scratch pays off when you will later get a lot of shots out of the model.

Photography is also stronger where real texture is what counts: food, drinks, cream on skin, fabric on a person. And where there are people in the frame — a gesture, an emotion, the way a garment fits. It is possible to reproduce this in 3D, but noticeably harder than showing an object.

Platform rules are a separate matter. Google Merchant Center requires the main image to clearly show the exact product being sold and prohibits mock-ups and illustrations that do not depict the physical product. The image requirements say nothing directly about photorealistic renders, so before using a render as the main image in an ad or on a marketplace, read the rules of that particular platform. For images created with generative AI, Google has a separate requirement: the file must contain metadata stating that the image was generated, and that metadata must not be removed. A render from 3D software is calculated from the geometry and materials that you specified. But if a neural network painted in the background or details, check how the platform treats such images.

It often makes more sense to combine the two: a photograph for the main shot, renders for the colour variants, scenes and cross-sections.'],
            ['What to prepare for a product visualisation', 'The more accurate the source data, the fewer the revisions and the closer the picture is to the product.

— Geometry. Best of all is a 3D model from the software the product was designed in: in its native format or in STEP (ISO 10303), the format for exchanging product data between CAD systems. If there is no model, dimensioned drawings in DWG, DXF or PDF. If there are no drawings either, a sample that can be measured and photographed from every side.
— Materials. For each part: what it is made of, matt or glossy, smooth or textured. Colour as a code from the catalogue your production uses, such as RAL or Pantone — or better still, a physical sample: the same colour looks different on different monitors, but a sample can be put next to the screen.
— Graphics. The logo and lettering in vector format. For packaging, the dieline from the printer or packaging manufacturer and the print-ready artwork.
— References. A few images you like for their lighting, background and mood, and a couple you do not. This is quicker and more precise than describing a style in words.
— A shot list. Which angles, which variants, where the images will be used and at what size.

A common problem is STL files. They are exported for 3D printing and describe only a surface made up of triangles; the format standard has no colours or materials. If the mesh was exported coarsely, smooth curves turn into facets that are visible in close-up. STL will do as a starting point, but the materials will have to be set up again, and sometimes the surfaces rebuilt as well.'],
            ['How to sign off without redoing work', 'A convenient order is from shape to details, with approval at each step.

1. Grey model. An image with no materials, under neutral lighting. It is used to check the geometry only: proportions, radii, the position of buttons, seams and fasteners. Compare it with the drawing and the sample, not from memory.
2. Materials and colour. Once the shape is approved, materials are assigned. The colour is compared with the physical sample in good light and on several screens, including a phone.
3. Lighting, background and composition. The final step is staging the shots according to the approved list.

Fixing the geometry at the first step means correcting one model. Fixing it after the final shots means re-rendering every shot.

Agree in advance on what you will receive at the end: only the images, or the model and scene files as well. If a new colour or a new angle is needed a year later, without the source files it will have to be built again.'],
            ['Which formats to take for the website and for print', 'For the website. The colour space is sRGB: under the CSS specification, the browser treats images without an embedded profile as sRGB. Formats: WebP or AVIF with a JPEG fallback. If you need the product on a transparent background, JPEG will not do: it has no alpha channel, whereas PNG, WebP and AVIF do. For product ads Google recommends images of at least 1500×1500 pixels. AVIF is not on Merchant Center’s list of formats; for that you supply JPEG, PNG or WebP.

For 3D viewing and augmented reality. The model for the website is supplied in glTF or its binary version, GLB — an open format whose version 2.0 has been an international standard, ISO/IEC 12113, since 2022. It is also the format read by Scene Viewer, the 3D and augmented reality viewer on Android; Google recommends keeping such models within 10 MB. On iPhone and iPad, augmented reality from Safari is opened by AR Quick Look, which needs a file in USDZ format. If you want a “view in your room” button on both platforms, ask for both formats.

For print. Resolution is calculated from the final size of the print. A common requirement from printers is 300 pixels per inch: an image covering a full A4 sheet (210×297 mm) needs 2480×3508 pixels. For large formats viewed from a distance the requirements are lower. The printer will give you the exact figures, colour mode and profile. Either way, keep the master file in RGB. Some saturated on-screen colours cannot be reproduced in CMYK: they shift during conversion, and converting back will not restore them. That is why it is worth ordering a printed proof for packaging and catalogues.'],
        ],
        'end'      => 'A render is neither better nor worse than a photograph — it does a different job: showing what does not exist yet, in any colour and in any scene, consistently across the whole catalogue. It is only as accurate as the source data, so the main work on your side is the drawings, the material samples and the shot list. And take not just the images but the model too: the next shots are built from it.',
    ],
    'seo-prodvizhenie-s-chego-nachat' => [
        'seoTitle' => 'SEO for a website: where to start with Google',
        'seoDesc'  => 'Where an SEO audit starts: Search Console, indexing, sitemap.xml, robots.txt, titles and internal links — and why Google search optimisation takes time.',
        'title'    => 'Where Google SEO for a company website begins',
        'desc'     => 'Where an SEO audit and website optimisation begin: Search Console, indexing, sitemap.xml and robots.txt, titles, internal links and why results take time to show.',
        'rubric'   => 'Marketing',
        'lead'     => 'A company website has been live for more than a year, but people find it on Google only when they search for the company’s name, not the name of the service. The first thought is to commission SEO for the website, or at least an audit. But you can check the things this work starts with yourself: whether Google knows about your pages, which of them have made it into the index and what people see in the search results. Let’s go through the basics in order — from Search Console to why you have to wait weeks and months for an effect.',
        'body'     => [
            ['Search Console: how Google sees your website', 'Google Search Console is a free service in which Google shows site owners how it sees their website. You do not have to sign up for it to appear in search. But without it you only see your site from the inside, so it makes sense to start an SEO audit with its reports.

You add a site as one of two types of property:

— A “Domain” property covers all subdomains and protocols: with and without www, http and https. Ownership can only be verified with a record in the domain’s DNS;
— A “URL prefix” property covers only the addresses that begin with the prefix you specify, including the protocol. It can also be verified in other ways: with an HTML file in the site’s root, a meta tag on the home page, or your Google Analytics or Google Tag Manager code.

If you have access to DNS, a Domain property is more convenient: data for every version of the address is collected in one place. Do not remove the record, file or meta tag after verification: if Search Console can no longer find it, your verification will lapse after a while.

To begin with, the most useful report is the Performance report for Search results. It shows the queries for which the site appeared in search and the pages that appeared, with impressions, clicks, CTR and average position. Search Console keeps data for the last 16 months.'],
            ['Which pages are in the index', 'The answer is in the Page indexing report. It splits the addresses on your site that Google knows about into two groups: “Indexed” and “Not indexed”. Only what is in the index can appear in search results.

The second group is not a cause for alarm in itself: not every address should be indexed, only the canonical ones — the main versions of pages. “Page with redirect” or “Alternate page with proper canonical tag” are normal reasons. What matters is something else: whether the non-indexed list includes pages that should be bringing in enquiries — services, the catalogue, contacts.

What is worth looking into:

— “Discovered – currently not indexed” — Google knows the address but has not crawled it yet;
— “Crawled – currently not indexed” — the page has been read but not added to the index;
— “Not found (404)” on a page that has actually moved — it needs a permanent 301 redirect to the new address;
— “Soft 404” — the page tells the visitor that nothing was found, but the server does not return a 404 code.

You can open an individual address in the URL Inspection tool: it shows when Google last crawled the page and which version of it was chosen as canonical. The “Request indexing” button asks Google to crawl the page again. This does not guarantee it will be indexed, and requesting the same address repeatedly does not speed up crawling. Once an error is fixed, click “Validate fix” in the report: validation usually takes about two weeks, sometimes longer.'],
            ['sitemap.xml and robots.txt: two technical files', 'sitemap.xml is a list of the addresses you want to see in search. For Google it is a hint, not a command: a sitemap does not guarantee that every address will be crawled and indexed. Addresses are given in full, with the protocol and domain; one file can hold no more than 50,000 addresses and 50 MB uncompressed. Google ignores the priority and changefreq fields, and it only takes the lastmod date into account if it consistently matches the page’s last significant change. A small site of up to about 500 pages, where everything important is linked to, may not even need a sitemap, although in most cases it is useful. You can submit it through the Sitemaps report, which shows whether Google has received it and whether it found any errors.

robots.txt is a file in the site’s root that tells robots which addresses they may crawl. The biggest misconception: robots.txt does not remove pages from Google. An address blocked in it that is linked to from somewhere can still appear in the results — just without a description. To keep a page out of search, you need noindex (a meta tag or an HTTP header) or a password. And here is the trap: if a page is blocked in robots.txt, the robot will not see its noindex.

Right after launch, open yourdomain/robots.txt in a browser. The line Disallow: / after User-agent: * stops search robots from crawling the entire site. It is put on the test copy of a site, and it is easy to forget to remove it at launch.'],
            ['The title and description in search results', 'Google generates the title link and the couple of lines beneath it automatically.

For the title it draws on several sources: the title tag, the h1 heading, the og:title meta tag, the text of links on the page itself and of links that point to it. There is no hard length limit; a long title is truncated, usually to fit the width of the screen. What you control directly is the title tag:

— every page has its own title that describes that page specifically;
— no “Home” or “Services” on their own;
— the company name kept short, at the beginning or the end, set off with a separator;
— no lists of keywords.

Google builds the description mostly from the page’s text, and uses the description meta tag when it describes the page more accurately. There is no length limit here either; anything extra is cut off. Each page should have its own description, and it should read as a sentence, not a string of words. Google does not use the keywords meta tag at all.'],
            ['One page per query', 'When one service is described on the home page, on the services page and in a couple of similar texts besides, Google groups those pages together and picks one as canonical — the one it considers the most complete and useful. The others are crawled less often. You can indicate your preferred version with a canonical tag, but to Google this is a hint, not a rule.

Duplicates do not break Google’s rules in themselves, but it will no longer be you who chooses which page to show. So each query should have one page that answers it better than the rest. For example, a blog article answers the question “how does this work”, while a service page answers “where can I order it”.

City pages are a separate risk. Pages such as “service in Baku”, “service in Sumgait” and “service in Ganja” that all lead the visitor to the same page are cited in Google’s spam policies as an example of doorway pages. And a block of text listing the cities and regions a site wants to rank for is cited as an example of keyword stuffing. If you work in Baku, it is natural to mention the city in the title, the text and the contact details, without separate clone pages.'],
            ['Internal links and speed', 'Google finds pages mainly by following links from pages it has already crawled. So every important page should be linked to from at least one other page on the site. A page with no internal links that is not in sitemap.xml either risks going unnoticed.

A link has to be a real one: an a element with an href attribute. Google cannot reliably recognise buttons and blocks that open another page with a script when clicked. The link text should say where it leads: “corporate website development”, not “read more” or “click here”. But there is no need to cram every keyword into it either.

Speed matters, but it is not the main thing. The Core Web Vitals metrics, covered in a separate article, are taken into account in ranking, but Google will still show the most relevant answer even if the page’s usability is not perfect. And a word on the mobile version: Google indexes and ranks a site based on it, so the text and headings on a phone should be the same as on a computer.'],
            ['Why SEO for a website does not deliver results straight away', 'Google Search works in three stages: crawling, indexing and serving results. Not every page goes through all three, and Google guarantees none of them. Crawling after a request can take anything from a few days to a few weeks. Google itself says that some changes show up in search within a few hours and others within a few months, and that you should wait at least a few weeks before assessing the effect.

You cannot pay to speed things up: Google does not charge for more frequent crawling or for higher positions in the regular results. If someone offers Google search optimisation in Baku with a guaranteed first place, treat that as a warning sign: according to Google, no one can guarantee a first place.'],
        ],
        'end'      => 'SEO does not start with keywords; it starts with Google seeing the site the way you intended: the right pages in the index, the unwanted ones excluded properly, and every page with its own title, its own query and internal links pointing to it. You can check most of this yourself in Search Console. And the effect of changes is judged over weeks and months, by comparing impressions and clicks across comparable periods.',
    ],
    'semanticheskoe-yadro-na-treh-yazykah' => [
        'seoTitle' => 'Keyword research: a keyword list in three languages',
        'seoDesc'  => 'How to build a keyword list for a website in Azerbaijani, Russian and English: where to find search queries, “в Баку” and “Bakıda”, spelling without ə and ğ.',
        'title'    => 'A keyword list for a website in Azerbaijan: three languages and queries without ə and ğ',
        'desc'     => 'Where to find search queries, how to tell commercial ones from informational ones, what to do about “Bakıda” and “bakida”, and how to spread keywords across the pages of a site in three languages.',
        'rubric'   => 'Marketing',
        'lead'     => 'You sit down to pick keywords for your website and immediately run into a question: in which language? One person searches in Russian for “ремонт кондиционеров в Баку”, another in Azerbaijani for “kondisioner təmiri”, a third types the same thing without the Azerbaijani letters, and a fourth searches in English. Your keyword list has to account for all four, or the site will answer only some of the people searching. Let’s look at where to find search queries, how to tell commercial ones from informational ones, what to do about “в Баку” and “Bakıda”, and how to spread all of this across your pages.',
        'body'     => [
            ['What a keyword list is and what to expect from it', 'A keyword list is a table of the search queries people use to look for what you sell, with a note of which page on the site answers each group. It is not a set of words to work into your copy but a plan: which pages you need and what each one is about.

That is why the keyword list is put together before the site structure and the copy. If you draw up the menu first and then look for words to fit it, you may find that some queries have no page to answer them while two pages compete for the same thing.

Google’s SEO Starter Guide advises thinking about the words your readers search with: someone who knows the subject well and a newcomer will phrase a query differently. But the same guide says you don’t need to anticipate every variation: Google’s systems understand how a page relates to a query even when the exact words are not in the text. And Google does not use the keywords meta tag at all. So the keyword list is a working tool for you, not a message to the search engine.'],
            ['Keyword research: where to find search queries', 'There are several sources, and each gives you only part of the picture.

Keyword Planner is built into Google Ads. Google calls it free, but its Help Centre notes that to unlock even the basic features you need to finish setting up your account and enter your payment details. You can give the planner a few words or the address of any website, a competitor’s for example, and it will suggest queries based on that site’s content. Set the location to “Azerbaijan”. Language is trickier: Azerbaijani is not on the list of Google Ads languages, so it is better not to restrict the language and to sort through the results by hand.

Two caveats about the planner’s figures. Google calculates “Avg. monthly searches” for a keyword together with its close variants. And “Competition” shows how many advertisers showed ads on that keyword compared with other keywords. It is an advertising metric, not a measure of how hard it is to get into the regular search results.

Google Search Console shows what is already happening. The Performance report lists the queries the site appeared for in search, the clicks and the average position; you can filter the data by country. Rare queries — those searched by no more than a few dozen people over two or three months — are left out of the table by Google for privacy reasons.

Search suggestions reflect real queries. They are influenced by language, location, current interest in a topic and your own past searches, so look at them in an incognito window. They are no substitute for search volume: Google says plainly that they are not simply the most common queries on a topic.

Competitors. The menus, service page headings and price lists of those already in the search results show what the market calls your services.

And a source you won’t find in any tool: the words your customers themselves use when they write to you in enquiries and messaging apps.'],
            ['Three languages and several spellings of one query', 'The Azerbaijani alphabet has 32 letters, and seven of them — ç, ə, ğ, ı, ö, ş, ü — are not on an English keyboard. If someone has not switched on the Azerbaijani keyboard layout on their phone, they type as best they can: e instead of ə, i instead of ı, g instead of ğ, s instead of ş. “Bakıda kondisioner təmiri” becomes “bakida kondisioner temiri”. To you it is one query, but in exported data it can turn up in two or three spellings.

What to do about it:

— check search suggestions for both spellings: they may differ;
— in Search Console, filter queries by the word stem in both versions, for example “temir” and “təmir”;
— do not add up the planner’s figures for different spellings: Google Ads may count spellings without diacritics as close variants, in which case they are already included in a single figure;
— do not create a separate page for each spelling.

It is a similar story with languages. Translating a Russian keyword list into Azerbaijani gives you the translator’s words, not necessarily the ones people search with. That is why the Azerbaijani and English parts are put together from scratch, from the same sources. How to link the language versions of a site to each other technically is a separate topic; what matters for the keyword list is that each version has its own list of queries.'],
            ['Local modifiers: “в Баку”, “Bakıda”, “Baku”', 'The guidelines for raters — people who assess the quality of search results on Google’s behalf — call a city in a query an explicit location: the person is saying outright where they want the result. “Ремонт кондиционеров в Баку”, “Bakıda kondisioner təmiri”, “air conditioner repair Baku” — queries like these are worth keeping as separate rows in your keyword list.

But many people do not type a city at all. If someone has not said where they are, Google relies on what it knows about their location for local results. A query without “Baku” made in Baku can be just as local as one with it, and the planner’s figure for the “in Baku” variant describes only part of the demand.

A city belongs on the site where it reads naturally: in the heading and text of a service page, in the address, in the contact details. What you should not do: list every district and town you would like to appear in within the footer, and churn out near-identical pages — “air conditioner repair in Yasamal”, “…in Sumgayit”, “…in Ganja” — that all lead to the same enquiry form. Google’s spam policies give the first as an example of keyword stuffing and the second as an example of doorway pages. A separate page for a city is justified when it genuinely offers something different: its own address, its own timescales, its own terms.'],
            ['Commercial or informational query', 'The rater guidelines suggest looking at a query through four types of intent: to find something out (Know), to do something (Do), to reach a particular website (Website) and to go somewhere in person (Visit-in-person). A single query can have more than one. For a keyword list, a simplified two-type scheme is enough.

A commercial query means the person is ready to order, buy or call. It gives itself away with words such as “цена”, “заказать”, “купить”, “qiymət”, “sifariş”, “price”, and also with a service name combined with a city. A query like this leads to a service or product page.

An informational query means the person wants to understand something: “как выбрать кондиционер для квартиры”, “kondisioner necə seçilir”, “how to choose an air conditioner”. They need an article, not a price list. For a query like this, a service page answers the wrong question.

The line can be blurred: the same guidelines say that many queries do not fit neatly into a single type. The easiest check is the search results. If the first page shows a map and company websites, the query is commercial. If it shows articles, videos and forums, it is informational. If it is a mix, see which there is more of and decide which page you are prepared to answer it with.'],
            ['Grouping: which queries belong on one page', 'The queries you have collected need to be distributed across pages. A working rule: a group contains queries with the same intent for which Google shows a similar set of pages.

You check this by hand. Search for two queries one after the other and compare the first pages of results. If they mostly show the same addresses, one page can answer both queries. If the results differ, you need two pages.

What you end up with is a table with these columns:

— query;
— language and spelling;
— type: commercial or informational;
— the page that answers it;
— source: planner, Search Console, suggestions, competitors, customers.

Each group is assigned to one page. If two pages on the site compete for the same group, Google decides which one to show, and it may not be the one you would have chosen.'],
            ['How to check your keyword list after launch', 'Until the site starts appearing in search, the keyword list remains a hypothesis. Once data has built up in Search Console, open the Performance report, filter it by the page you need and see which queries it appears for.

What to look for:

— a service page is appearing for informational queries — you need an article that answers that question;
— spellings and phrasings that are not in your table have appeared — add them to the keyword list and, where it reads naturally, to the text;
— two of your pages appear for the same query — rethink the grouping.

Repeat this check every few months: your services change, and so does the way people ask about them.'],
        ],
        'end'      => 'A keyword list for a website in Azerbaijan is not one list but three languages, several spellings and an intent label on every query. It is built from the planner, Search Console, search suggestions, competitors’ websites and your customers’ own words, and checked against the search results. Its value lies not in the number of rows but in every group of queries having one page that answers it.',
    ],
    'google-ads-dlya-malogo-biznesa' => [
        'seoTitle' => 'Google Ads setup: search ads for small business',
        'seoDesc'  => 'Pay-per-click advertising on Google: campaign structure, match types, negative keywords, location, language and tracking enquiries, calls and WhatsApp clicks.',
        'title'    => 'Google Ads setup: how a search campaign for a small business works',
        'desc'     => 'Campaign structure, match types, negative keywords, location and enquiry tracking: what to check in your Google ads before you spend your budget on them.',
        'rubric'   => 'Marketing',
        'lead'     => 'You launched ads on Google, a noticeable sum went in two weeks, the account shows clicks and impressions, and the phone rings no more than it did before. Among the searches your ads appeared for are “jobs”, “free” and the names of other cities. Most of the time the cause is not advertising as such but the Google Ads setup: how the campaign is built, which searches it is allowed to appear for and whether the account knows which click ended in an enquiry. Let’s go through a search campaign for a small business step by step — from structure to budget.',
        'body'     => [
            ['Google Ads setup starts with structure', 'A Google Ads account is made up of campaigns, and campaigns are made up of ad groups. The campaign sets the budget, the bid strategy, the location and the networks the ads run on. An ad group brings together keywords and the ads that go with them, so each group should answer one question a person has.

For a small business the working scheme is simple: one service, one ad group. Air conditioner repair and air conditioner installation are two groups with different keywords, ads and website pages. If a service needs its own budget or its own location, it is moved into a separate campaign.

The campaign settings have two network tick boxes: Google search partners and the Display Network. The first adds impressions on other search sites, the second on websites and apps where the person is not searching for anything at that moment. Check both boxes yourself rather than relying on the defaults.'],
            ['Match types: how broadly a keyword is read', 'A keyword in Google Ads is not an exact string but an instruction about which searches the ad may be shown for. How broadly it is interpreted is set by the match type:

— broad, with no symbols: searches related to the keyword, even if the words themselves are not in them;
— phrase, in quotation marks, for example "air conditioner repair": searches that include the meaning of the phrase, including more specific ones;
— exact, in square brackets, for example [air conditioner repair]: searches with the same meaning or intent.

Broad match is the default, and Google’s help pages stress that it should be combined with Smart Bidding — strategies that learn from conversions. While there is no data on enquiries yet and the budget is small, it makes more sense to start with phrase and exact match and to try broad once conversions are already being counted.

Check AI Max separately — a set of settings that sits on top of a search campaign: it widens the range of searches matched, writes headlines and descriptions from your website content and can send a person to a different page of the site. According to Google’s help pages, it is switched on by default in new search campaigns, so make a conscious decision about whether you need it at the start.'],
            ['Negative keywords: what to rule out before the first click', 'Negative keywords stop your ad from showing for searches that contain them. They also come in three match types: broad blocks a search if it contains all the words of the negative phrase in any order; phrase blocks it if the words appear together in the same order; exact blocks it only on a full match with no extra words.

The main trap: negative keywords do not extend to close variants. Google’s help pages say you have to add synonyms and singular and plural forms yourself; only letter case and misspellings are taken into account automatically. This matters for Russian and Azerbaijani, which have so many word forms: the Russian negative keyword “бесплатно” (“free”) will not block “бесплатный”, the adjective form of the same word.

The basic list is drawn up before launch:

— “vacancy”, “vacancies”, “job” — the person is looking for work, not a service;
— “free”, “DIY”, “download” — the person is not looking for someone to do the job;
— cities and districts where you do not work.

After that, the list is topped up from the search terms report: it shows which actual searches triggered impressions and clicks. Google leaves some rare searches out of the report for privacy reasons. Open it regularly during the first few weeks.'],
            ['Pay-per-click advertising in Baku: location and language', 'Location is set at campaign level: a country, a city or another area, or a radius around a point. What matters more is who exactly sees the ads. The default option, which Google also recommends, is presence or interest: the ads are seen by people who are in or regularly in the chosen location, and by people who have shown interest in it, for example by mentioning it in their searches. The second option, presence only, keeps just the first group.

Interest from afar can be useful for tourism or property, but for a workshop, a clinic or a delivery service in Baku, someone in another country is unlikely to bring in an order. Besides, Google works out location from a combination of signals and does not guarantee 100% accuracy.

With language, the rules are changing. According to Google Ads Help, from September 2026 the language setting is being removed from search campaigns: ads are matched by the language of their text and the language the user understands, and priority goes to the ad in the language of the search. If customers look for your service in Azerbaijani, Russian and English, each language needs its own keywords, ads and website page — and it is easier to keep them in separate ad groups.'],
            ['The ad, assets and the page the click leads to', 'A search ad is now responsive: you provide up to 15 headlines of up to 30 characters each and up to 4 descriptions of up to 90 characters each, and the system builds combinations from them, showing no more than three headlines and two descriptions at a time. Google advises most advertisers against pinning headlines to positions, as this reduces the number of combinations. Among the headlines it is worth having the ad group’s key phrase, what the service is and the area you cover.

Assets — the new name for what used to be called extensions — add links to sections of the site, callouts, a phone number, an address, prices and images to the ad. Even an approved asset is shown only when the system predicts it will help and the ad’s position allows it.

Then the click leads to a page, and that page has to follow through on what the ad promised. If someone searched for air conditioner installation, they should land on a page about installation, in the language of the ad, with the terms, the phone number and a WhatsApp button above the fold. Google takes this into account in Quality Score — a rating of a keyword from 1 to 10 with three components: expected CTR, ad relevance and landing page experience. It is a diagnostic tool, not an input into the auction, but the components show where the weak spot is.'],
            ['Conversion tracking: without it you are optimising blind', 'Without conversion tracking, the account sees impressions, clicks and spend, but does not know which click ended in an enquiry. You cannot compare ad groups and keywords by results, and for bid strategies aimed at conversions Google’s help pages call tracking a requirement.

Three actions are usually enough:

1. A form submission — tracked by the “Thank you” page loading or by a successful submission event.
2. A tap on the phone number on the website — tracked by a click on the tel: link, not by a page load.
3. A click through to WhatsApp — the same mechanism on the wa.me link.

Calls from the ad itself are trickier. Google Ads records calls and their duration through its own forwarding numbers, and at the time of writing Azerbaijan is not on the list of countries where these are available. Without them the system sees the call button being pressed, but not the conversation itself.

For enquiries, Google’s help pages recommend counting one conversion per click, so that a form submitted a second time does not look like a new customer. And check which actions are marked as primary: they are the ones that go into the “Conversions” column and are used for bidding.

A tap on the phone number or WhatsApp is not yet an enquiry: the person may have opened the chat and not written anything. If taps like these are marked as primary, the strategy will chase exactly those. Regularly check these conversions against the actual number of enquiries.'],
            ['How to work out the budget', 'The daily budget in Google Ads is an average, not a hard ceiling. On a given day a campaign can spend up to twice its daily budget, but over a month you will not be charged more than 30.4 times the daily amount. So it is easier to plan from the monthly figure: divide it by 30.4.

Keyword Planner gives you a guide to the cost per click. For each keyword it shows a top-of-page bid range in the location you have chosen: the low end is roughly the 20th percentile of what advertisers have paid in the past, the high end roughly the 80th. Divide your daily budget by these figures and you get a rough estimate of clicks per day.

If all your services together come to only a few clicks a day, keep the one or two most profitable and gather data on them rather than spreading the money across the whole list. A strategy that maximises conversions tries to spend the whole daily budget, so its size is your decision, not the system’s forecast.

Once conversions build up, the key metric appears: cost per enquiry by campaign and ad group. Budget is moved to the campaigns where enquiries come cheaper, and keywords and searches that spend money without bringing in enquiries are switched off or added as negative keywords.'],
        ],
        'end'      => 'Google advertising does not need a complex structure, but every setting in it has to be chosen rather than left at its default: the match type, the networks, the location option, AI Max. Most importantly, enquiry tracking is set up before launch, not after: without it, any conclusions about what works remain guesswork.',
    ],
    'kontent-plan-dlya-instagram-kompanii' => [
        'seoTitle' => 'Instagram content plan: managing a business Instagram',
        'seoDesc'  => 'Social media marketing for a company: building an Instagram content plan — goal, pillars, formats, realistic frequency, calendar, Insights and website links.',
        'title'    => 'How to build an Instagram content plan for a company',
        'desc'     => 'Goal, content pillars, formats, a frequency you can sustain and a calendar: how to organise managing a business Instagram and check the results with Insights and UTM tags.',
        'rubric'   => 'Marketing',
        'lead'     => 'The company set up an Instagram account, posted every day for the first two weeks, and then posts started going out once a month — whenever someone found the time. The topics have run out, nobody remembers what worked, and hardly anyone clicks through from the profile to the website. The problem is usually not the algorithm: the account has no plan, and the posts have no job to do. Social media marketing has a simple, practical tool for this — the content plan. Let’s look at how to build an Instagram content plan: the goal, content pillars, formats, a realistic frequency, the calendar, Insights and the link to your website.',
        'body'     => [
            ['Goal first, post ideas second', 'Managing a business Instagram differs from running a personal blog in one way: every post has a job it needs to do. So the plan starts not with a list of ideas but with an answer to the question: what should happen after someone has seen the post?

For a company, the options are usually these:
— people who do not know about you yet should see you;
— followers should send you a DM, call or submit an enquiry on the website;
— someone who found you through search or on a map should open the profile and be reassured that the company is up and running and can be trusted.

Choose one main goal for the next three months and write it down in one sentence with a specific action: “the person sends a DM asking about the price” or “goes to the service page”. Each goal has its own metric in Insights — we will come back to that below. Without a goal you cannot tell whether a post worked: likes are nice, but they are not enquiries.'],
            ['Content pillars: what to post when the ideas run out', 'A content pillar is a recurring theme the account returns to again and again. Five are enough to start with:
— product: what you sell, what it is made of, how the options differ and how to choose;
— process: how the work is done, what happens after an enquiry, how long each stage takes;
— people: who answers the phone, who does the work, who will come out to the site;
— answers to questions: what customers ask in DMs and over the phone;
— proof: finished work, reviews that customers have agreed to let you show, certificates, warranty terms.

The best source of topics for answers to questions is the last month of correspondence with customers. Write down the questions that keep coming up, and you have a list of posts for several weeks. With pillars in place, the question “what shall we post today?” turns into a different one: “which item on the list do we take next?”

Rotate the pillars so that one does not crowd out the rest. An account with nothing but products and prices reads like a price list, and one with nothing but the team reads like a company photo album.'],
            ['Reels, carousels and stories: which format for which job', 'The three main formats reach different audiences, and that determines what to publish where.

Reels are the way to reach people who do not follow you yet. According to Instagram itself, most of what a person sees in Reels comes from accounts they do not follow. Among the most important predictions in ranking, Instagram names the likelihood that a reel will be reshared, watched to the end and liked. Instagram shows reels less often if they are low-resolution, carry watermarks or borders, have no sound, consist mainly of text, or have already been posted on Instagram. A reel can be up to 20 minutes long, but Instagram does not recommend reels longer than three minutes to new audiences.

A carousel holds up to 20 photos and videos in a single post. It suits how-tos, comparisons and breakdowns: people swipe through the slides in order and can save the post. A video inside a carousel does not count as a reel and does not appear in the Reels tab.

Stories are seen mainly by your followers: Instagram fills the row of stories from accounts the person follows, plus ads. Stories disappear after 24 hours, but you can pin them to your profile as Highlights. This is the place for day-to-day work, polls, reminders and links.

That gives a simple split: “answers to questions” work well as carousels and short reels, “process” as stories, and “proof” as a carousel in the feed plus a story that is later pinned to Highlights.'],
            ['How often to post: a frequency you can sustain', 'There is no universally right frequency, and other people’s norms tell you nothing about your own resources. Work it out from your time.

Make two or three posts in each format and time how long the whole thing really takes: the idea, filming, editing, the copy, approvals. Multiply that by the number of posts per week and compare it with the hours you have. If it does not add up, cut the quantity, not the quality.

A steady rhythm is more useful than bursts: two posts a week that you can keep up for a year are better than daily posts that stop after two weeks. With a steady rhythm you can compare one month with another, and that means seeing what works.

Two habits help. The first is batch filming: recording material for several reels and stories in one session. The second is keeping a buffer of ready posts for a week or two, so that a holiday or a crunch at work does not wipe out the plan. Stories hardly figure in this calculation: they are made as the work goes on, without complicated editing.'],
            ['What an Instagram content plan looks like in practice', 'A content plan is an ordinary spreadsheet in Google Sheets or Excel. One row is one post, and the columns are:
— publication date and time;
— content pillar;
— format: reel, carousel or story;
— the topic in one sentence;
— the goal and the action you expect;
— where the post leads: DMs, phone, a page on the website;
— status: idea, filmed, edited, published;
— the person responsible.

The month ahead is mapped out broadly, and the next two weeks in detail, with the copy. Leave free space in every week for news: a plan with no slack falls apart at the first emergency.

You do not have to publish finished posts by hand. A public account can schedule photos, carousels and reels in the Instagram app — up to 25 posts a day and no more than 30 days ahead. Stories can be scheduled in Meta Business Suite on a computer. Bear in mind that product tags and collaborative posts do not yet work with scheduled content.'],
            ['What to look at in Instagram Insights', 'Insights are free and available to any public account — in the app and on instagram.com. You can view the account overview for any period within the last 90 days, while insights for an individual post remain available for up to two years. Follower data — location, age, most active times — appears once you have at least 100 followers.

The main metrics, under the names the app uses:
— Views — how many times content was played or displayed on screen; one person can account for several views;
— Viewers — how many unique accounts saw the content at least once;
— Interactions — likes, comments, saves, shares;
— Profile activity — what people did after seeing the post: visited the profile, followed, tapped the website link;
— for reels — watch time, average watch time and the number of follows the reel brought in.

Each goal has its own metric. New people — viewers and the follows brought in by reels. Enquiries — profile activity, link taps and DMs (these are easier to count by hand). Trust — saves, shares and replies to stories.

Once a month, copy the figures into the same spreadsheet that holds the plan and compare pillars and formats rather than individual posts: one post can do well by chance, but ten posts from the same pillar already show a trend. Bear in mind that Instagram itself describes some metrics as estimates. A new idea can be tested first with a trial reel: it is shown to people who do not follow you. The feature is available to public professional accounts with 200 or more followers.'],
            ['How to link Instagram to your website', 'There are two places to put a link to your website on Instagram: you can add up to five links to your profile, and stories have a Link sticker. Meta started testing clickable links in post captions in March 2026, and only for paying Meta Verified subscribers — it is too early to build a plan around them.

Link not to the home page but to the page that continues the post: a post about a service to that service’s page, a carousel about choosing to the catalogue or the pricing section. If your profile has several links, put your main lines of business and a convenient way to get in touch first, not your other social networks.

To see the visits in Google Analytics, add UTM tags to your links. Google recommends always setting three parameters: utm_source for the source, utm_medium for the channel and utm_campaign for the campaign or content pillar. For example: yourdomain/services/?utm_source=instagram&utm_medium=social&utm_campaign=bio. The values are case-sensitive: the report will show instagram and Instagram as two different sources, so it is worth writing the agreed names straight into the content plan. The visits appear in the Acquisition → Traffic acquisition report.'],
        ],
        'end'      => 'An Instagram content plan is not a grid of pretty pictures but a spreadsheet in which every post has a content pillar, a format, a goal and an address it leads to. Start with one goal and a frequency you can genuinely sustain. Once a month, check the plan against Instagram Insights and your UTM data — then decisions about what to post next will rest on your own figures, not on other people’s advice.',
    ],
    'teksty-dlya-sajta-kak-pisat-stranicu-uslugi' => [
        'seoTitle' => 'SEO copywriting for service pages: what to write and avoid',
        'seoDesc'  => 'How to write service page copy: a heading with your city, the scope of work, the steps, prices, FAQ and proof — and why keyword stuffing hurts.',
        'title'    => 'Website copywriting: how to write a service page people find and understand',
        'desc'     => 'How to write the copy for a service page: a heading with the service and the city, the scope of work, the steps, prices, answers to objections and proof — and what Google says about keyword stuffing.',
        'rubric'   => 'Marketing',
        'lead'     => 'A service page is often commissioned as an “SEO text”: several screens of solid text in which the phrase “accounting services in Baku” appears in every paragraph, with a list of cities and districts at the bottom. It is awkward to read, and both techniques are named outright in Google’s spam policies. A person arriving from search wants to understand something else: whether you do exactly what they need, how much it costs and what to do next. Let’s look at what website copy on a service page is made of, where keywords belong and what Google’s documentation says about such pages.',
        'body'     => [
            ['One page, one service', 'A common set-up: a single “Services” page that lists everything in a column — from company registration to audit — with two sentences per item. It does not properly answer any specific query: someone looking for an audit needs to learn everything about the audit, not find it as one line in a list.

Every service you want to sell through search gets its own page, with its own address, heading and copy. The general “Services” page stays, but it works as a table of contents: a couple of phrases and a link to the detailed page. Which queries to assign to each page is shown by keyword research — it is done before you sit down to write.

The opposite extreme does harm too: a dozen pages — “accounting in Baku”, “accounting in Sumgait”, “accounting in Ganja” — where only the city name changes. Google’s spam policies give, as examples of doorways, pages for individual cities that funnel visitors to one place, and multiple pages that are similar to one another. A separate page for a city makes sense when it has something of its own: an office address, terms for on-site visits, timescales.'],
            ['Heading: the service and the city, no slogans', 'The page’s main heading, the H1 tag, names the service the way a customer would name it and, if you work locally, the city as well. “Accounting support for small businesses in Baku” tells both the person and the search engine what the page is about. “Your reliable partner in the world of numbers” tells them nothing.

Among the self-assessment questions in Google’s guidance on helpful content, two are about the heading: does it provide a descriptive, helpful summary of the content, and does it avoid exaggeration. And Google takes the title of a search result not only from the title tag but also from the main visible heading, the H1 and other prominent text on the page.

The title itself can differ from the H1, but it should say the same thing. Google advises making it descriptive and concise, without boilerplate repetition or keyword stuffing, and putting the company name at the start or the end, separated by a hyphen, a colon or a vertical bar. The documentation sets no length limit, but a long title will be truncated in search results, usually to fit the width of the screen.'],
            ['What is included, how the work goes and what it costs', 'These blocks are the reason people open the page.

The scope of the service — as a list of concrete actions: what you do, what the client gets at the end, and what is not included and is paid for separately. The last point is often skipped, even though that is exactly where disputes grow from later on.

The process — the steps in order and what is needed from the client at each one: documents, access, decisions. If the steps have typical timescales, state them; if the timescales depend on the volume of work, explain what exactly they depend on.

Prices — ideally a specific amount or a range. If the price is calculated individually, write what it is made up of: the volume of work, urgency, the number of employees, the number of pages — whatever applies in your line of business. The phrase “price on request” with no explanation makes a person take an extra step before they have understood whether you are right for them.

Write in your customers’ words — Google’s starter guide also advises thinking about the words people would use to search for your page. If customers say “bookkeeping” and you are used to saying “outsourced accounting”, both should appear on the page — in normal sentences, not as a comma-separated list.'],
            ['Answers to objections and proof', 'The questions-and-answers block is built from real conversations: what people ask on the phone, in messaging apps, at the meeting before the contract is signed. Do you work with small companies, can you start in the middle of the year, what happens if deadlines are missed, who is responsible for a mistake. Each answer is short and to the point.

It is no longer worth counting on these questions appearing in search results as an expandable block. In August 2023 Google limited these rich results to well-known, authoritative government and health websites, and from 7 May 2026 it stopped showing them altogether. Write this block for people, not for a badge in search results.

Proof is whatever the reader can check for themselves:
— completed work, with links or photographs of real jobs;
— licences, certificates, membership of professional bodies — with numbers;
— the names and roles of the people who will do the work;
— the office address and the company’s registration details;
— the guarantee terms that will later appear in the contract.

Be more careful with reviews. Reviews on your own website will not earn you rating stars in search results: under Google’s rules, if an organisation controls the reviews about itself, its pages with LocalBusiness or other Organization-type markup are not eligible for that display. A link to a platform where reviews are left without your involvement is more convincing for the reader — for example, to the company’s profile on Google Maps.'],
            ['Call to action and an easy-to-scan structure', 'The page should end with a clear next step, and a long page should offer it earlier as well, for example after the prices. One step, and a specific one: call, write in a messaging app, send the form. On a smartphone, tapping the phone number should open the dialler. Next to it, say what happens after the enquiry: who will reply, how soon, what will be needed from the client.

Structure matters as much as the words. As far back as 1997, Jakob Nielsen wrote that people rarely read web pages word by word: they scan them, picking out individual words and sentences. Hence the rules:
— a subheading names what the block contains rather than playing with words;
— one idea per paragraph;
— lists are set out as lists;
— the main point comes at the start of the block, the details after it.

According to Google’s starter guide, the order of heading levels does not affect search, but a logical hierarchy helps people who use screen readers — so it is worth sticking to.'],
            ['Why keyword stuffing in SEO copy does harm', 'Copywriting still has a habit of working the key phrase in as often as possible. For Google this is a separate item in its spam policies — keyword stuffing, filling a page with keywords or numbers in an attempt to influence rankings. Examples from the policies themselves:
— lists of phone numbers without substantial added value;
— blocks of text listing the cities and regions a page is trying to rank for;
— repeating the same words and phrases so often that it sounds unnatural.

The second item is an exact description of the familiar line at the bottom of the page: “We work in Baku, Sumgait, Ganja, Khirdalan…”. If you really do travel to these cities, describe the terms in an ordinary sentence. Hidden text — white on white, a zero font size, behind an image — is covered as a separate item in the same policies.

There is no set length either. Google’s starter guide says that the length of a text does not in itself affect rankings, and that repeating the same words many times, even in different forms, tires the reader. Google does not use the keywords meta tag at all. A key phrase needs only its natural places: the heading, the first paragraph, one of the subheadings. Beyond that, write about the work itself.'],
            ['What Google expects from website copy', 'In March 2024 the helpful content system became part of Google’s core ranking systems. The documentation states the principle plainly: content should be created primarily for people, not to manipulate search results.

Google’s guidance on helpful content has three questions that also work well for checking a service page:
— Who? Google advises giving reliable information about the author wherever the reader would expect it; on a service page, that means saying who will do the work.
— How? It helps the reader to understand how the material was produced.
— Why? The most important of the three. If the text is written above all to attract visits from search, that runs counter to what Google’s systems seek to reward.

One sign of text written for a search engine, according to the same guidance: after reading it, a person has to go back to search for better information. If a customer has left your page to find out what the service costs, that is exactly this case.

Generative AI, according to Google’s documentation, can be useful for researching a topic and building the structure of your own text. But generating many pages without adding value for the reader may violate the policy on scaled content abuse.'],
        ],
        'end'      => 'A good service page answers the questions the customer will ask anyway: what you do, how, for how much and what to do next. Keywords sit in it where they are natural, not in every sentence. Checking yourself is simple: read the page through the eyes of someone who is seeing you for the first time, and note which questions it has left unanswered.',
    ],
    'kak-vybrat-hosting-dlya-sajta-kompanii' => [
        'seoTitle' => 'Choosing web hosting for a business website: what to check',
        'seoDesc'  => 'Choosing hosting in Azerbaijan: whose name the account is in, where the server is, PHP versions, backup restores, limits and the renewal price.',
        'title'    => 'How to choose hosting for a business website: what to check before you pay',
        'desc'     => 'Whose name the account is in, where the server is, which PHP and database versions are on offer, how to restore a backup and what the second year costs: what to check with a host before you pay.',
        'rubric'   => 'Support',
        'lead'     => 'Your website has stopped loading, and the contractor who hosted it is not answering. You write to the provider and find out that the account is in the contractor’s name and only they can deal with it. When you finally manage to get access back, the rest comes to light: the last backup was made several months ago, and renewal costs noticeably more than the first year did. Almost all of this could have been spotted before you paid. Let’s look at how to choose hosting for a business website: from who owns the account and where the server is to the limits in the small print and the price for the second year.',
        'body'     => [
            ['Who owns the hosting account', 'The first question is not a technical one: whose name is the account in? Often a contractor hosts the site — on their own account or on a reseller plan, where you pay them and they pay the provider. While everything works, you cannot see the difference. When the contractor disappears or you part ways, you have neither access to the control panel nor a contract with the provider: the provider deals with the account holder, and that is not you.

How it should be:
— the account is registered to the company, and the profile has the company’s details;
— the address used to log in and recover the password is a shared work mailbox, not the personal email of an employee or a developer;
— two-factor authentication is switched on;
— the contractor works through separate access that can be revoked without changing the main password.

One more trap. If the mailbox for password recovery is on the same hosting, then when the account is suspended, for example for non-payment, email goes down along with the website, and the password reset email will not arrive. It is better to keep this address outside the hosting.'],
            ['Where the server is: Baku or Europe', 'If you are choosing hosting for a business website in Azerbaijan, the next question is where the server physically sits. Every browser request travels to the server and back, and the longer the route, the longer the visitor waits for the first byte of the response. This wait is the first component of LCP, the Core Web Vitals metric that shows when the main content of the page appears on screen.

Time to first byte (TTFB) is not itself part of Core Web Vitals, but Google does give a benchmark for it: up to 0.8 seconds is good, over 1.8 seconds is poor.

How to check before you buy: ask the provider for a test IP address or a test site, and from your office run ping and tracert to that address at the command prompt. Ping shows how long a signal takes to reach the server and come back, and tracert shows which nodes the traffic passes through. For a site that is already live, you can see the wait in the browser’s developer tools: the Network panel, the request for the page itself, the Timing tab and the row showing the wait for the server’s response.

For search, the server’s location is a weak argument: Google’s help documentation says it can hint at which audience a site is meant for, but it is not a deciding signal.

There is a separate question if the website collects personal data — enquiries, orders, questionnaires. Before choosing a host, ask a lawyer whether your sector has requirements on where this data must be stored.'],
            ['PHP and database versions', 'WordPress, like many other CMSs, runs on PHP with a MySQL or MariaDB database. Every version has a support period, after which no more security fixes are released for it. Hosting without up-to-date versions means a website you cannot update properly.

What is current as of the end of October 2026:
— PHP: branches 8.2, 8.3, 8.4 and 8.5 are supported, though security support for 8.2 ends on 31 December 2026, and 8.1 and anything older no longer get fixes;
— MySQL: support for version 8.0 ended in April 2026, and the long-term branches are 8.4 and 9.7;
— MariaDB: community support for 10.6 ended in July 2026, while the long-term branches 10.11, 11.4, 11.8 and 12.3 are still supported.

This list goes out of date quickly: PHP 8.6 is scheduled for release on 19 November 2026, and the projects themselves publish the current dates.

It also matters whether you can switch the PHP version yourself in the panel, separately for each site. Then moving to a new branch is just a choice from a list, and if something in the code breaks, it is just as easy to switch back. The requirements of a particular CMS are published on its website: WordPress, for example, recommends PHP 8.3 or newer.'],
            ['What comes with website hosting: certificate and email', 'A free HTTPS certificate should be issued and renewed by the hosting panel without any action on your part. Let’s Encrypt certificates are issued for 90 days by default, and from 2027 this period will start to be shortened, so renewing them by hand is not an option.

Email included in the plan is convenient: you do not have to buy mailboxes on your domain separately. Check in advance:
— how many mailboxes the plan includes and how large they are;
— whether there is a limit on the number of emails sent per hour;
— whether you can set up SPF, DKIM and DMARC for the domain — without these records, the company’s emails risk landing in spam.

This convenience has a downside. If email and the website live on the same server, a hacked website hits email too: a script starts sending spam, the server’s address ends up on blacklists, and your emails to clients can be blocked along with it. That is why the company’s email can be kept with a separate email service, and the hosting used only for the website.'],
            ['Backups and how to restore from them', 'The line “daily backups” in a plan description says very little. A backup is only as useful as how quickly, and without outside help, you can bring the website back from it. Ask before you pay:
— how many days backups are kept, and whether you can take one from a week ago if the problem was not noticed straight away;
— where they are stored — on the same server or in separate storage;
— whether you can restore the site yourself from the panel, and in parts: just the files, just the database or a single mailbox;
— whether a restore requested through support is charged for;
— whether you can download a full backup and keep it yourself.

The last point matters more than it seems. Backups held by the provider will not help if the problem is with the provider itself or with the account. A backup guide on the website of CISA, the US cybersecurity agency, puts this as the 3-2-1 rule: three copies of an important file — the primary and two backups, on two different types of media, with one of them kept outside the company’s building. For a website the idea is the same: backups at the host plus a regular export to storage that has nothing to do with the hosting.

And test a restore in advance at least once — for example, deploy a backup on a test subdomain. A backup that nobody has ever restored anything from is an assumption, not insurance.'],
            ['The limits in the small print', 'Disk space is the most visible limit. Just check whether email and backups count towards it. After that, check three more things.

Inodes — the number of files and folders in the account. Every file in Linux has its own inode, and on shared hosting the plan may limit how many you can have. If email is stored in Maildir format, every email is a separate file. A website with a cache of thousands of small files and a mailbox that has been piling up spam for years can hit this limit while there is still free disk space, and then there is simply nowhere to save new files and emails.

CPU, memory and processes. On shared hosting a website shares the server with others, and its share of resources is limited. In CloudLinux, for example, one of the systems used to enforce such limits, hitting the CPU or disk operations limit slows the site down, running short of memory or processes causes 500 and 503 errors, and exceeding the number of simultaneous connections to scripts causes a 508 error. If the site slows down or goes down at peak times, the first thing to look at is the resource statistics in the panel.

The word “unlimited”. Physically unlimited servers do not exist. If the word is in the name of the plan, find out from the terms of use what is actually limited, and ask for the figures in writing.'],
            ['Support and the second-year price', 'Support is tested before you buy, not on the day of an outage. Ask a technical question — about PHP versions or restoring from a backup — and see when they reply and whether the answer actually addresses it. Do this in the evening or at the weekend: websites do not break on schedule.

What to check:
— the contact channels: tickets, chat, phone, and whether they work around the clock;
— which languages support answers in;
— what support covers: will they help restore a backup and sort out email, or will the answer stop at “the server is working”.

Now the price. If the first period is noticeably cheaper, that is an introductory discount, not the price of the service. Find the renewal price for the same plan and work out the cost over two or three years. Separately, find out what is free only in the first period: the domain, the certificate, backups, a dedicated IP. If you pay in a foreign currency, take the exchange rate into account. And find out whether the provider issues invoices to a company and how they can be paid.'],
        ],
        'end'      => 'Hosting should be chosen not by the first-year price or the word “unlimited”, but by whether the account is yours, whether the versions are up to date, whether you can restore a backup yourself and what renewal costs. All of this can be checked before you pay: with an email to support, a ping command and a careful read of the plan’s page. A check like this takes less time than a rushed move to a new host.',
    ],
    'domen-az-ili-com-kak-oformit-na-kompaniyu' => [
        'seoTitle' => 'Domain registration for your company: .az, .com, renewal',
        'seoDesc'  => 'How a .az domain differs from .com, why to register a domain to your company, how to check the owner via whois.az and RDAP, and what happens if it lapses.',
        'title'    => 'Domain registration: .az or .com, who should own it and how not to lose it',
        'desc'     => 'How to choose between .az, .com and .com.az, why the domain should belong to the company, where to check the owner and what happens to the address once the term runs out.',
        'rubric'   => 'Support',
        'lead'     => 'Years ago a developer you knew launched the website and registered the domain in their own name — it was quicker that way. Now you are changing contractors and find out that the address of your website and email formally belongs to someone who does not answer the phone. It can happen another way, too: the card used for renewal expired, the registrar’s emails were going to the mailbox of an employee who had left, and one morning both the website and the email stopped working. Let’s look at how a .az domain differs from .com, whose name the domain registration should be in, how to check the owner and what happens once the term runs out.',
        'body'     => [
            ['How .az, .com and .com.az differ', 'Technically, all three addresses work the same way. What differs is the rules the domain lives by and the signal it sends to search engines.

The .az domain is Azerbaijan’s national zone. Its rules were approved by Cabinet of Ministers Resolution No. 63 of 25 February 2019. Domains in .az are registered through accredited registrars: the list is published on whois.az in the “Registrar” section, and, as the registry points out, residents buy .az domains only on those registrars’ websites. The owner can be either a legal entity or an individual.

.com.az is not a separate zone but a third-level address within com.az. The .az rules class com.az, net.az, org.az, biz.az and several other zones as public-use zones, so the same rules apply to .com.az.

.com is an international generic zone (gTLD). Its rules are set not by a government but by ICANN: they are written into the agreements with gTLD registries and accredited registrars. The renewal, deletion and transfer deadlines covered below are ICANN rules. ICANN does not set registration rules for national zones such as .az: those are set within the country itself.

For search, the difference is this. Google calls a national domain a strong signal that a website is intended for a specific country — but only one. A .com is not tied to any country, and Google works out the audience from other signals: hreflang markup, language and currency, local addresses and phone numbers on the pages, links from local websites, the company profile. If you work only in Azerbaijan, .az reinforces that. If you also sell abroad, .com is more flexible. You can also register both addresses and set up a redirect to the main one: that way nobody else can take the name either.'],
            ['Register the domain to your company, not to the contractor', 'A domain belongs not to whoever paid for it, nor to whoever built the website, but to whoever is recorded as the owner — the registrant. Verbal agreements with a contractor are not reflected in that record.

Under the .az rules, for a legal entity the registrar asks for the company’s full name, its taxpayer identification number (VÖEN) and the details of its director or representative. The owner can be changed only on a written request from the owner, their legal representative or heir, and only through a new registration agreement. If the domain is registered to a freelancer, under the rules only the freelancer can re-register it in the company’s name.

With .com the logic is the same: renewal reminders go to the owner, the transfer code is issued at their request, and changing the owner is a separate procedure.

There is a second layer as well — the account with the registrar. The company may be listed as the owner, but only whoever has the password to the account will be able to renew the domain or change the DNS records. So there are three things worth checking:
— the domain owner is your company, or you personally as the owner of the business;
— the contact address is a mailbox that several people read, not the personal email of an employee or contractor;
— access to the registrar account stays with the company, and a contractor gets it for the duration of a task.

It is better to keep the contact address on a different domain. When the domain is switched off, email on it stops arriving, and the registrar’s emails along with it.'],
            ['How to check who a domain is registered to', 'For .com and other generic domains, the old WHOIS protocol has been replaced: since 28 January 2025, RDAP has been the main source of registration data. The easiest place to check is ICANN’s official tool at lookup.icann.org.

In the response you will see:
— the registrar that manages the domain;
— the registration and expiry dates;
— statuses, for example clientTransferProhibited — a transfer lock set by the registrar;
— the name servers, that is, where the DNS zone is hosted.

The owner’s name and contact details may be hidden in the public response: ICANN rules require them to be hidden where data protection law demands it, and allow them to be hidden in other cases. The organisation’s name is published if the owner has agreed to it. The full picture is in the registrar account: there you can see who is recorded as the owner and which address the notifications go to.

For .az, do not count on the ICANN tool: the IANA root database lists neither an RDAP nor a WHOIS server for the zone. The zone’s rules suggest checking a domain’s status on whois.az, the website of the national administrator. The registry says that information about the people responsible for domains is publicly available, but the most reliable proof of who the owner is remains the registration agreement and the account with the registrar.'],
            ['Renewal and auto-renewal', 'You cannot buy a domain forever. A registration is taken out for a fixed term: in .az, from one year to ten years, with payment calculated by the year. After that, the domain has to be renewed.

Under the .az rules, the registrar gives notice that the term is ending no later than a month in advance — by email to the owner and/or by a message in their account. For .com, ICANN rules require two reminders, roughly a month and roughly a week ahead, and one more within five days after expiry if the domain has not been renewed. All of them go to the owner’s contact address. If that is the mailbox of an employee who has left, the reminders were formally sent, but nobody read them.

According to ICANN, most registrars offer auto-renewal. The .az rules do not mention it — check with your registrar whether the service exists. Auto-renewal removes the risk of forgetting but adds another one: the card it is linked to expires or gets blocked, and the payment does not go through. What is worth doing:
— turn on auto-renewal if it is available, and check which card is linked to it and until what month that card is valid;
— renew the domain for several years at once;
— put the expiry date in the company’s shared calendar, not on one person’s phone;
— once a year, check the term, the contact details and the owner in the account.'],
            ['What happens when the term runs out', 'For .com and other gTLDs, the procedure is set by ICANN rules, and the details by the agreement with the registrar.

1. Straight after expiry, the registrar may allow time for renewal — from 1 to 45 days. During the same period, if its terms say so, the domain may be put up for auction.
2. While the domain can still be renewed, the registrar must switch off its DNS — for at least the last eight days before deletion. The website and email on the domain stop working.
3. After deletion, the registry allows 30 days for restoration — the Redemption Grace Period. The domain can still be recovered, but the registrar is entitled to charge a separate restoration fee.
4. The domain then spends another five days with pendingDelete status, after which anyone can register it.

In .az the process is shorter. If the owner has not responded to the renewal request before the term ends, technical servicing of the domain stops. By the definition in the rules, this means DNS stops responding and the website and email become unavailable. If payment is not made within 30 days after that, the registration is cancelled. The zone’s rules do not describe a separate restoration period after cancellation. If the reason for the suspension is resolved, under the rules the registrar resumes servicing within 24 hours.'],
            ['Transferring to another registrar and the authorisation code', 'You can change registrar without changing the owner. For .com, a transfer is confirmed with an authorisation code — also called an auth code, EPP code or AuthInfo. The code is issued by the current registrar: either the owner gets it from the account themselves, or the registrar must provide it on request within five calendar days. The transfer lock — the clientTransferProhibited status — is removed on request within the same period.

What is worth knowing in advance:
— the registrar may refuse a transfer within the first 60 days after the domain was registered or after a previous transfer;
— after a change of owner, transfers are locked for 60 days, although the registrar may let you opt out of this lock in advance;
— the registrar cannot refuse a transfer because a future registration period has not been paid for;
— a transfer extends the registration by one year, but the total remaining term cannot exceed ten years.

In June 2026 the ICANN Board approved recommendations for revising the transfer rules. The decision does not set implementation dates, so the current version of the rules still applies for now.

For .az, the rules give the owner the right to choose a registrar freely, but do not describe how the switch works. Check the procedure and the documents with both the current and the new registrar.'],
        ],
        'end'      => 'Unlike hosting and design, a domain cannot simply be made again: business cards, signage and email are all tied to one name. The rule is simple: the owner is the company, the account is under its control, and renewal is done with time to spare and to a contact address that is actually read. You can check all three in a few minutes: open lookup.icann.org or whois.az, and the registrar account.',
    ],
    'tehnicheskaya-podderzhka-sajta-chto-vhodit' => [
        'seoTitle' => 'Website technical support: what maintenance includes',
        'seoDesc'  => 'CMS and plugin updates, PHP support dates, certificates, backups and monitoring: what website maintenance involves and what to check every month.',
        'title'    => 'Website technical support: what it includes and why sites break without it',
        'desc'     => 'Updates, PHP versions, certificates, backups, monitoring and forms: what website maintenance consists of and which dates to keep in your calendar. With a monthly checklist.',
        'rubric'   => 'Support',
        'lead'     => 'The website was built two years ago, and nobody has touched it since: it works, and that’s good enough. Then one day enquiries from the form stop arriving, the browser shows a warning instead of the home page, or, after a PHP version change on the hosting, the site opens with an error. None of these failures happens out of the blue: the certificate’s expiry date and the end of PHP support are known in advance, and a broken form is caught by a simple monthly check. Let’s look at what website technical support consists of, which dates are worth keeping in your calendar and what to check once a month.',
        'body'     => [
            ['Why a website needs technical support if it works', 'A website’s code does not go bad on its own. Everything around it changes: the PHP version on the server, browsers, certificate requirements, plugins and the vulnerabilities found in them. A site that is not updated falls further and further behind this environment until one day something breaks.

Website maintenance is not building new features but regular work whose goal is for nothing to happen. The result is almost invisible, which is exactly why it gets put off.

The work divides conveniently into three groups:

— scheduled: updates, backups, checking forms and monitoring;
— date-driven: the end of PHP support, renewing the certificate and the domain;
— event-driven: the site will not open, a hack, an error after an update, an urgent text change.'],
            ['Updates to the CMS, framework and plugins', 'Take WordPress, a content management system (CMS): its vulnerabilities are found mainly not in the core but in extensions. According to Patchstack’s report for 2025, 91% of new vulnerabilities were in plugins and 9% in themes, while only six were found in the core, all of them low priority. According to the same data, 46% of vulnerabilities had no fix from the developer by the time they were publicly disclosed. The conclusion: clicking “Update” is not enough. A plugin that its developer has not updated for a long time is better replaced or removed.

Since version 3.7, WordPress has installed minor core updates by itself, and on new installations since version 5.6 major ones as well. Plugins and themes update themselves only in special cases; otherwise, automatic updates are switched on by hand, for each plugin and theme.

Frameworks have their own schedule. Each major version of Laravel gets bug fixes for 18 months and security fixes for two years. For Laravel 11, support ended on 12 March 2026: a site built on it still works, but will receive no more security fixes.

The order of updating is the same for any system: a fresh backup, an update on a test copy of the site, a check of the key pages and forms, and only then the live site.'],
            ['PHP version: the dates are known years ahead', 'WordPress, Laravel and many sites built from scratch run on PHP. Current versions of the language share the same cycle: two years of full support, when bugs and vulnerabilities are fixed, and another two years when only fixes for critical vulnerabilities are released. After that, the version is no longer updated. The dates are published on php.net:

— PHP 8.1 — support ended on 31 December 2025;
— PHP 8.2 — security fixes until 31 December 2026;
— PHP 8.3 — until 31 December 2027;
— PHP 8.4 — until 31 December 2028;
— PHP 8.5 — until 31 December 2029.

Versions 7.4 and 8.0 lost support even earlier: on 28 November 2022 and 26 November 2023. WordPress currently recommends PHP 8.3 or newer.

In the hosting panel, switching to a new version often takes one click, but old code and abandoned plugins may not work on it: instead of the page you get an error or a blank screen. That is why the switch is tested on a copy of the site first. The current version is shown in the hosting panel, and in WordPress under “Tools → Site Health”.'],
            ['Certificate and domain: renewal should happen by itself', 'If the certificate has expired, the browser shows a warning about an insecure connection instead of the site. To reach the page, a visitor has to deliberately bypass it.

Certificate lifetimes are being shortened by the rules of the CA/Browser Forum, a body that brings together certificate authorities and browser developers. Certificates issued from 15 March 2026 are valid for no more than 200 days, from 15 March 2027 for no more than 100 days, and from 15 March 2029 for no more than 47 days. From 10 February 2027 the free certificate authority Let’s Encrypt is moving by default from 90-day certificates to 64-day ones.

Renewing a certificate by hand once a year is no longer possible. Renewal is set up to run automatically, and maintenance checks that the automation has worked. Let’s Encrypt advises renewing a certificate at roughly two thirds of its lifetime rather than after a fixed number of days. You can see the expiry date in the browser: click the icon to the left of the address and open the certificate details.

The same goes for the domain: the renewal reminder may go to the address of an employee who left long ago. The registration expiry date and the contact address at the registrar are worth checking together with the certificate.'],
            ['A backup that has never been restored', 'A backup of a CMS-based site has two parts: the files (code, images, documents) and the database (page text, enquiries, settings). One without the other will not restore the site.

Backups made by the hosting provider are useful, but they are managed from the same account as the site itself. If the account is blocked or hacked, or access to it is lost, the backups become unavailable along with the site. The UK’s National Cyber Security Centre (NCSC) advises keeping an offline backup separate from the main network or in a cloud backup service, and cites the “3-2-1” rule: at least three copies, on two devices, one of them in another location.

The same guidance contains a point that is easy to forget: check backups regularly and know in advance how to restore from them. In practice, the backup is deployed to a test subdomain, then you open the home page and inner pages, log in to the admin panel and send a test enquiry. If something does not come back up, you find out on a quiet day, not on the day of a hack.

Two more questions you should know the answer to: when was the last backup made, and how many days back can you roll back? If the site was hacked three weeks ago but backups are kept for only a week, all of them already contain someone else’s code.'],
            ['What breaks quietly: uptime, forms, edits', 'A site can be down for half a day, and the owner finds out about it from a customer. External uptime monitoring opens the site every few minutes and sends a notification if it does not respond. Such services have free plans.

The second source of signals is Google Search Console (the site needs to be verified in the service once). In the “Security issues” report, Google tells you if it has detected that the site has been hacked, is distributing malware or is being used for phishing. Such pages may be flagged in search results, and the browser may show a warning instead of the site.

Forms break most quietly of all. The site opens, the visitor sees “Thank you”, but the email reaches no one. The cause may lie outside the form itself: the password was changed for the mailbox the form sends emails through, the site moved to another hosting provider, the DNS records were changed. If emails arrive but land in spam, it is worth checking the SPF, DKIM and DMARC records — there is a separate article about them. There is only one reliable check: send a test enquiry and wait for the email.

Small edits are part of maintenance too: a new phone number or address, prices, opening hours, an outdated promotion banner. Each takes minutes, but if no one is responsible for them, incorrect information stays on the site for months.'],
            ['Response time and a monthly checklist', 'When you agree on website support in Baku — with a contractor or an in-house specialist — put the following in writing:

— response time and resolution time: the first means someone has taken on the problem, the second that it has been solved;
— what counts as urgent (the site will not open, a hack, forms or payments not working) and how to report something urgent outside working hours;
— who holds access to the hosting, the domain registrar, DNS, the admin panel and email: the accounts are in the company’s name, and the contractor works through the access it has been given;
— what is included in the monthly work and what is paid for separately.

You can keep the monthly checklist yourself or receive it as a report:

1. Update the core, plugins, theme or dependencies — on a copy first.
2. Check the PHP version against the dates on php.net.
3. Check the expiry dates of the certificate and the domain registration.
4. Check that a fresh backup exists and is stored outside the hosting; on schedule, restore it on a test subdomain.
5. Send a test enquiry through every form and wait for the email.
6. Review the monitoring history and the “Security issues” report in Search Console.
7. Make the content edits that have piled up.'],
        ],
        'end'      => 'Upkeep does not make a website better — it keeps it from getting worse. Many of the failures in this article have a date that can be known in advance: the end of PHP support, the certificate’s expiry, the domain renewal. If these dates are in the calendar and the backup has been restored at least once, such failures stop being sudden.',
    ],
    'perenos-sajta-na-drugoj-hosting-bez-prostoya' => [
        'seoTitle' => 'Website migration to new hosting: no downtime, step by step',
        'seoDesc'  => 'How to move a site without downtime: what to consider first, why lower TTL early, how to test the copy via hosts and not lose email when DNS changes.',
        'title'    => 'Moving a website to new hosting: how to switch without downtime or losing email',
        'desc'     => 'How to move a website, its database and email to a new server without visitors noticing: an inventory, TTL, testing via hosts, switching DNS and what becomes of the old hosting.',
        'rubric'   => 'Support',
        'lead'     => 'Your hosting has become cramped or expensive, support has stopped answering — and you have decided to move. A move that goes wrong usually looks like this: the files are copied, DNS is switched over, and a day later it turns out that email is not arriving, enquiries from the website form are not getting through and a couple of orders are stuck in the database on the old server. Moving a website to new hosting is not a matter of copying a folder but of several steps taken in a set order. Let’s go through them one at a time, from the inventory to the day you can close the old hosting, so that the site moves without downtime.',
        'body'     => [
            ['The inventory: what actually lives on your hosting', 'A website migration starts with a list, not with copying. Besides the site itself, your hosting holds things people only remember when they break:

— the site’s files, including hidden ones such as .htaccess with its redirect rules;
— one or more databases, plus the configuration file with the username and password for them;
— the mailboxes on the domain;
— the DNS zone, if the domain is served by the hosting provider’s DNS servers;
— scheduled tasks (cron): data exports, newsletters, backups;
— the SSL certificate;
— the PHP version and its extensions, subdomains, redirects.

Save a copy of the DNS zone in full, down to the last line. Especially the TXT records: they hold SPF, DKIM and DMARC for email (there is a separate article about them in this blog) and verification codes for various services. Google Search Console, for example, checks from time to time that its code is still in place. Lose records like these and the site will still open, but email and services will start to fail.

Find out, too, how your staff collect their email. With IMAP, messages are stored on the server, and they need to be moved. With POP3, the email program downloads messages to the computer and, depending on its settings, either deletes them from the server or leaves copies there — check what is in the mailboxes. Either way, the programs’ settings will have to be changed during the move.'],
            ['TTL: why touch DNS a couple of days before the move', 'When someone opens a website, their provider’s DNS server looks up the server’s address and remembers the answer for the period set in the record itself — this is the TTL (time to live) field, in seconds. What is called “DNS propagation” is really just waiting for the old stored answers to expire.

With a TTL of 86,400 seconds (one day), some visitors will keep reaching the old server for up to a day after the switch. That is why TTL is lowered in advance. In its migration guidance, Cloudflare names 300 seconds (five minutes) as a common short value and advises lowering TTL at least 24–48 hours ahead — or, better, at least as far ahead as the longest current TTL. On moving day it is too late: caches that have stored the record keep it for the old TTL.

Lower the TTL on every record that is going to change: the domain’s A records, www, AAAA and, if email is moving too, MX or the mail server’s records.

There are two limitations. Measurements show that some resolvers keep records longer than they should: a short TTL shortens the transition period but does not eliminate it. And if the domain’s DNS servers (NS records) change along with the hosting, how long they are cached is set by the registry for the domain zone, and you cannot lower it: for .com it is 172,800 seconds, two days. It is safer to split the steps: first move the DNS zone with a full copy of the records, then the site, changing only the A record.'],
            ['Moving the site to new hosting and testing it via hosts', 'Technically, the move consists of copying the files, importing the database and editing the configuration: the database name, username and password on the new hosting are almost always different. Set up the same PHP version, or one you know for certain is compatible.

The copy has to be tested before DNS is switched, and under the real domain. That is what the hosts file is for: in it you specify by hand which IP address belongs to which domain, and the computer trusts it before DNS. On Windows it is C:\\Windows\\System32\\drivers\\etc\\hosts, and you can only edit it with administrator rights; on macOS and Linux it is /etc/hosts. Add two lines: the new server’s IP address, a space and the domain — once without www and once with it. Then, on Windows, run ipconfig /flushdns and restart the browser. Now you see the new server, while everyone else still sees the old one.

The temporary technical address the hosting provider gives you is less suitable. Some CMSs store the site’s address in the database — in WordPress these are the siteurl and home options — and on the temporary address the links, images and admin login lead to the main domain, that is, to the old server.

HTTPS will cause a hitch: during the HTTP-01 check, Let\'s Encrypt requests a verification file via the domain, and the domain still points to the old server. There are two ways round it: issue the certificate using the DNS-01 check (a TXT record called _acme-challenge), or move the existing certificate together with its private key.

Go through the key pages, log in to the admin panel, submit a form, upload an image. Once you have finished testing, delete the lines from hosts.'],
            ['Freezing changes before the switch', 'Between copying the database and switching DNS, the site carries on living: enquiries and orders come in, news gets published. All of it lands in the old database, not in the copy.

So agree on a freeze for the duration of the move: nobody edits content or uploads files. It is best to switch during the quietest hours — your analytics will show you when they are. Right before the switch, take a fresh copy of the database, load it onto the new server over the test one, and copy across any new files that have appeared.

Turn on the cron jobs on the new server at the moment of the switch, and turn them off on the old one at the same time — otherwise a newsletter or data export will go out twice.

While caches expire, some visitors still reach the old server, and their enquiries go into the old database. So straight after the switch, either put a maintenance page up there or check the old database and the enquiries mailbox for a few days.'],
            ['Switching DNS and email: MX records and mailboxes', 'The switch changes the domain’s A record and the record for www. Check AAAA too — the server’s IPv6 address: if it is left over from the old hosting, visitors on IPv6 will keep landing there. If the new server has no IPv6, delete it.

For email there are two scenarios. If it is with an external service such as Google Workspace or Microsoft 365, leave the MX records alone: messages go there wherever the site happens to be.

If the mailboxes were on the old hosting, the order is as follows:

1. Create the same mailboxes on the new server.
2. Move their contents over IMAP, for example with the imapsync tool: it does not create duplicates when you run it again.
3. Point the MX record at the new server — or the A record for mail.yourdomain, if that is what the MX points to.
4. Once the caches have expired, run the sync again: as long as senders still have the old MX stored, some messages arrive in the old mailboxes.
5. Change the incoming and outgoing mail servers in email programs and on phones, if they name the old hosting’s address.

After email has moved, SPF and DKIM need updating for the new server, or messages may start landing in spam. This also applies to emails the site sends itself: if form enquiries go out directly from the web server, its new address must be in SPF, even when email lives with an external service.'],
            ['What to check after the move', 'You can see what public DNS servers are returning from the command line: nslookup yourdomain 8.8.8.8 asks Google Public DNS, and nslookup yourdomain 1.1.1.1 asks Cloudflare. If the answer shows the new IP, that resolver has switched over. A stale old answer stuck at Google can be cleared on the Google Public DNS cache-flush page.

Then a short checklist:

— the site opens with and without www, redirects from http to https, and the certificate is valid;
— the key pages, search and the admin panel work;
— an enquiry from the form reaches its recipient;
— an email from a work mailbox reaches an external one, such as Gmail, and back;
— the cron jobs have run — judging by the log or by the result;
— no indexing ban has been left in robots.txt or the CMS settings, if one was switched on for the testing period.

Once everything is stable, put the TTL back to its previous values.'],
            ['When you can switch off the old hosting', 'Not on moving day. As long as the old server is running, it is your safety net: if something breaks on the new one, you only need to put the previous IP back in the A record, and with a short TTL the rollback will be as quick as the switch. Any orders the new server has already taken will then have to be moved back by hand.

Let the old server’s logs guide you. When visitors stop showing up in the access log and new messages stop arriving in the old mailboxes, wait a few more days, take a full copy of the files, database and email, and only then cancel the service.

Email has one subtlety. A mail server being briefly unavailable does not, as a rule, mean lost messages: the sender keeps the message in a queue and keeps retrying, and the SMTP standard recommends not giving up for at least 4–5 days. A deleted mailbox is a different matter: the reply “no such recipient” is final, and the message goes straight back to the sender. That is why the mailboxes on the old server are deleted last.'],
        ],
        'end'      => 'A move without downtime rests on the order of the steps, not on speed: inventory, TTL lowered in advance, testing via hosts, a freeze, the switch, checks and only then closing the old hosting. A missing website is obvious straight away, but a missing TXT record, email or last enquiry is often noticed only a few days later — which is why those are the things to check twice.',
    ],
    'ssl-sertifikat-dlya-sajta-https' => [
        'seoTitle' => 'SSL certificate for a website: HTTPS, free or paid',
        'seoDesc'  => 'Why a website needs HTTPS, how DV differs from OV and EV, when a free SSL certificate from Let\'s Encrypt will do and why renewals are getting more frequent.',
        'title'    => 'SSL certificate for a website: why HTTPS matters and how free differs from paid',
        'desc'     => 'What HTTPS gives a website and its visitors, how DV, OV and EV actually differ, when a free Let\'s Encrypt certificate is enough and why you can no longer do without automatic renewal.',
        'rubric'   => 'Support',
        'lead'     => 'A client writes to say that when they went to your website, Chrome showed a warning and asked whether they really wanted to continue. Or the site opens, but “Not secure” sits to the left of the address — right above the form where you ask for a phone number. In both cases the cause is the same: the site has no working SSL certificate — either it was never installed, or it expired and there was no one to renew it. Let’s look at why even a simple brochure site needs HTTPS, how certificates differ, when a free one is enough and what has changed in the rules for issuing them since 2026.',
        'body'     => [
            ['Why HTTPS matters for a site with nothing to steal', 'HTTPS is the HTTP protocol running inside an encrypted TLS connection. Certificates are still called SSL out of habit — after the old protocol that TLS replaced long ago. A certificate proves to the browser that it really is talking to your domain, and lets the connection be encrypted.

Without one, everything a visitor types into a form — their name, phone number, the text of their enquiry — travels as plain text. It can be read at any point along the way, from café Wi-Fi to the provider’s equipment, and the page itself can be tampered with — for example, by inserting someone else’s ads into it.

Browsers are getting stricter about this. Since 2018 Chrome has labelled every page opened over http as “Not secure”. And since version 154, released in September 2026, it asks for permission by default before the first visit to a public site without HTTPS. On sites a person visits regularly the warning does not come up again, but a new visitor — say, one who arrived from an ad — will see it first thing.

On top of that, a number of browser features only work over HTTPS: geolocation, push notifications, camera and microphone access, and offline mode via a service worker.'],
            ['What HTTPS changes in Google', 'In 2014 Google announced HTTPS as a ranking signal, making clear from the outset that it was a very weak one. Its current documentation is more direct: of the page experience aspects, the ranking systems use Core Web Vitals, while the rest, HTTPS included, do not directly improve rankings.

The practical significance lies elsewhere. If a page is available over both http and https, Google prefers to treat the https version as the main one — provided there is nothing wrong with it. The documentation specifically warns that an invalid certificate and redirects from https back to http make the search engine prefer http. So an expired certificate hits you from two sides: the visitor sees an error, and search gets conflicting signals.

The right set-up: the site has a single https address, and every other variant — http, with or without www — has a permanent 301 redirect to that address. The HTTPS report in Search Console shows which pages Google sees over HTTPS and what is holding back the rest.'],
            ['Which SSL certificate a website needs: DV, OV or EV', 'The certificate type tells you not how strong the encryption is — that depends on the key and the server settings — but what the certificate authority checked before issuing it.

— DV (Domain Validated) — only control of the domain is confirmed: for example, you placed a file on the website or a record in DNS. The certificate shows only the domain, without the company name. It is issued automatically, within minutes.
— OV (Organization Validated) — the authority also checks that the organisation exists and adds its name and location to the certificate. This takes documents and time.
— EV (Extended Validation) — a stricter check under separate CA/Browser Forum rules: legal status, address, and the authority of the person placing the order.

People used to pay for EV to get the company name in the address bar. In 2019 Chrome (version 77) and Firefox (version 70) removed it from there. Since 2023 Chrome has not shown the padlock either — in its place is a neutral site settings icon. The company name from an OV or EV certificate is now visible only in the certificate details.

For a company website or an online store, DV is usually enough. OV or EV are needed when a bank, a payment partner or the rules of your industry explicitly require them.'],
            ['Free SSL: how Let\'s Encrypt differs from a paid certificate', 'Let\'s Encrypt is a non-profit certificate authority that issues certificates free of charge. Browsers trust them just as they trust paid DV certificates. There are limitations, but they have nothing to do with reliability:

— DV only: it does not issue OV or EV and has no plans to;
— a certificate covering all subdomains at once (*.yourdomain) is issued only with validation via a DNS record;
— a short lifetime: currently 90 days by default, and it will get shorter;
— support: a community forum and documentation.

The short lifetime is not a flaw but a deliberate design: the certificate is issued and renewed by software using the ACME protocol, with no human involved. Many hosting control panels already have this built in, and it is switched on with a single setting. That said, some hosting providers charge a small fee to enable it.

A paid certificate makes sense if you need OV or EV, if the certificate is going onto equipment or a service that does not support ACME, or if support from a specific authority matters to you. There is no point buying a paid DV certificate “because it is more reliable”: the encryption and browser trust are the same.'],
            ['Why certificate lifetimes keep getting shorter', 'The maximum lifetime of public TLS certificates is set by the CA/Browser Forum — a body that brings together certificate authorities and browser makers. In April 2025 the forum approved a phased reduction, and the first step is already in force:

— issued before 15 March 2026 — no more than 398 days;
— from 15 March 2026 — no more than 200 days;
— from 15 March 2027 — no more than 100 days;
— from 15 March 2029 — no more than 47 days.

At the same time, the period during which an authority can reuse a domain validation is also being cut: from March 2029 it will be 10 days.

One-year certificates are no longer issued, and buying one “for a year” or “for three years” is really a subscription: the certificate itself will have to be reissued and reinstalled roughly every six months, and from March 2027 every three months.

Let\'s Encrypt is ahead of the curve: from 10 February 2027 its certificates will be issued for 64 days by default, and from 16 February 2028 for 45. Renewing on a fixed 60-day interval will no longer be enough: the authority advises renewing a certificate at about two thirds of its lifetime, or leaving it to the authority itself to choose the moment through an ACME extension called ARI. Since June 2025 Let\'s Encrypt has not sent emails warning that a certificate is about to expire — keeping an eye on the expiry date is up to you or your monitoring.

You can check your certificate’s expiry date in the browser: click the icon to the left of the address, then the connection and certificate details.'],
            ['Mixed content: the certificate is there, but the page is broken', 'A common sight after switching to HTTPS: the certificate is installed, but part of the page does not work. This is mixed content — the page itself arrived over https, but it loads something over http.

The browser treats it in different ways:
— ordinary images, audio and video it tries to load over https on its own; if the file is not at that address, it simply will not appear;
— scripts, stylesheets, fonts and embedded frames — a map, a video, a widget — are blocked outright over http.

In the second case the page breaks silently: the layout falls apart, the map showing your office does not load, the form button does nothing. Search notices this too: according to Google’s documentation, if an https page loads anything other than images over http, the http version may become the main one.

The source is almost always the same — http:// addresses in the template, the CMS database, old texts and widget embed codes. The developer console helps you find them: press F12 and open the Console tab, which lists everything that was blocked. The fix is to change the addresses to https, not to switch the checks off.'],
            ['HSTS: so the browser stops trying http', 'A redirect from http to https does not give full protection: the http request still goes out unencrypted and can be intercepted. On repeat visits this gap is closed by HSTS — the Strict-Transport-Security header, which the server sends over https. Once it has received it, the browser itself rewrites your domain’s addresses to https for a set period (the max-age parameter, in seconds) and does not try http. With the includeSubDomains parameter the rule also applies to subdomains.

The flip side: if there is a certificate error on a domain with HSTS, the browser does not let the visitor click “proceed anyway”. The certificate has expired — the site is unreachable. That is why HSTS is switched on once renewal is already automated, starting with a small max-age and increasing it in stages.

To protect the very first visit as well, the domain is added to the preload list built into Chrome; the lists of other major browsers are based on it too. The requirements: a max-age of at least a year (31,536,000 seconds), includeSubDomains, the preload directive and HTTPS on every subdomain. You can leave the list, but the change takes months to reach users, arriving with browser updates. If an old system without a certificate lives on one of your subdomains, it is better to hold off on preloading.'],
        ],
        'end'      => 'Today an SSL certificate is not a one-off purchase but a process: issuance, automatic renewal and checking that the renewal actually worked. For most company websites a free DV certificate is enough, provided it is renewed by software rather than by a person with a reminder in their calendar. Check three things: when your current certificate expires, what exactly renews it, and whether there is any mixed content on your pages.',
    ],
    'pochemu-pisma-kompanii-uhodyat-v-spam' => [
        'seoTitle' => 'Why emails land in spam: SPF, DKIM and DMARC',
        'seoDesc'  => 'Three DNS records behind proposals and invoices that never arrive: what they mean and how to check your own domain in five minutes.',
        'title'    => 'Why your company’s emails land in spam: SPF, DKIM and DMARC',
        'desc'     => 'SPF, DKIM and DMARC in plain language: what these DNS records are, why you need them and how to check in five minutes whether your company’s emails actually arrive.',
        'rubric'   => 'Email and domains',
        'lead'     => 'You sent a proposal and got no reply. A week later the client says they never saw the email. It is sitting in their “Spam” folder — along with your invoice, contract and reply to the request they sent through your website. Most of the time the problem is not the text of the email or the attachment. It is three short lines that are missing from your domain’s settings. Let’s look at what these lines are and how to check yours.',
        'body'     => [
            ['What a DNS record is and where it lives', 'A domain is more than a website address. It is also a set of technical details about your company that servers all over the world read. The set is called a DNS zone, and the individual lines in it are DNS records.

DNS stands for “Domain Name System”. In essence it is a directory: given a domain name, it hands machines the data they need. One record says which server the website is on. Another says where to deliver incoming mail. A third is just text that anyone can read; records like that are called TXT records. SPF, DKIM and DMARC are exactly that: TXT records. Not software, not settings in your email program, but a few lines of text in the domain’s zone.

The zone lives wherever the domain is managed: in the registrar’s panel, with the hosting provider or in the service that the website’s traffic goes through. Whoever has access to that panel can edit the records. Changes do not spread across the internet instantly — it takes anything from a few minutes to a few hours.

Missing records used to be tolerated. Now the big email services, including Gmail and Yahoo, require every sender to have at least SPF or DKIM. And those who send large volumes need DMARC as well.'],
            ['SPF: a list of who may send email in your name', 'SPF (Sender Policy Framework) is a list of the servers that are allowed to send mail on behalf of your domain.

The logic is simple. The receiving server sees an email “from your company”, looks at which address it came from and checks your DNS zone: is this sender on the list? If it is, the check passes. If not, the email is suspicious.

The record looks something like this: v=spf1 include:_spf.example.com ~all. First comes the version, then the allowed senders (usually via include: — “take the list from such-and-such provider”), and at the end, what to do with everyone else: ~all means “treat as suspicious”, -all means “treat as forged”. This is an assessment, not a command: the receiving side decides for itself what to do with such an email — which is exactly why you also need DMARC, covered below.

There are two places where people trip up most often. First: a domain must have only one SPF record. Two records do not merge into one — the check breaks entirely. Second: when all the include: entries are expanded, the standard allows no more than ten DNS lookups. Go over the limit and the result counts as an error. The limit is easy to hit if your business email, newsletters and CRM are with different providers.

An important detail: SPF checks the sender’s technical address, not the name the recipient sees in the “From” field. SPF on its own does nothing to stop the visible field from being forged — that is DMARC’s job.'],
            ['DKIM: a signature that cannot be forged', 'DKIM (DomainKeys Identified Mail) is a digital signature on an email.

The mail server has a pair of keys. The private key is kept on the server and never leaves it. The public key you publish in DNS. When it sends an email, the server uses the private key to sign the headers and the text. The recipient takes the public key from your zone and checks the signature.

The check answers two questions at once: did the email really come from your infrastructure, and did anyone rewrite it on the way? If someone swaps the subject, a link or the bank details in the text while the email is in transit, the signature will no longer match.

The record lives at an address like selector._domainkey.yourdomain, where selector is a label your email provider gives you. There can be several labels: one for business email, a second for the newsletter service, a third for the CRM. The key itself is usually generated by the provider; all you have to do is copy the value they give you into DNS.'],
            ['DMARC: what to do with an email that fails the check', 'SPF and DKIM only answer the question “does it match or not”. They do not say what to do with an email that does not match — the receiving side decides as it sees fit. DMARC is how you tell it what to do.

The record sits at _dmarc.yourdomain and in its minimal form looks like this: v=DMARC1; p=none; rua=mailto:address-for-reports. The key parameter here is p, the policy:

— p=none — do nothing, just send reports;
— p=quarantine — send to spam;
— p=reject — refuse on arrival, the email will not get through at all.

DMARC’s second job is to tie the checks to the address the recipient actually sees. The domain in the “From” field must match the domain that passed SPF or DKIM (one of the two is enough). This is called alignment, and it closes the very gap that stops SPF alone from protecting against forgery.

Do not start with p=reject. Start with p=none and an address for reports: for a few weeks you simply watch who is sending email in your name. A couple of forgotten sources almost always turn up — the accounts department, the contact form, an old newsletter. You set them up, and only then tighten the policy. The reports arrive in a machine-readable format; they are either analysed by hand or uploaded to a specialised service.'],
            ['Why a personal Gmail account is a bad sender address', 'It is a common situation: the website is on the company’s domain, but emails go out from an address like company.baku@gmail.com.

Technically, this fails on every count. The domain in the address is gmail.com, not yours. So all three checks apply to Google’s domain, not to your business. You do not set up SPF, DKIM or DMARC for this address — the email service controls them. You build up no sender reputation on your own domain, you cannot set a policy, and you do not protect your domain from forgery. On top of that, there is the practical side: the mailbox is tied to a person, not to the company, and it leaves when they do.

Another case is when a business address has been added to a personal mailbox using the feature that lets you send mail under another name. The “From” field shows your domain, but the email goes out through someone else’s servers. The email is signed with the email service’s domain, there is no alignment with your domain, and under a strict policy an email like that is the first to suffer. The recipient also often sees a note next to the name saying which service the email was sent through.'],
            ['How to check your email in five minutes', 'The most reliable way is to look at an email through the recipient’s eyes.

1. Send an email from your work address to any Gmail mailbox — your personal one will do.
2. Open the email in a browser, click the three dots in the top right corner of the email and choose “Show original”.
3. The tab that opens will have a table at the top: SPF, DKIM, DMARC and the result for each — PASS or FAIL.

Three PASS results mean the basics are in order. Any FAIL or dash means there is something to fix. In Outlook and other email programs you look for the same thing in the message source, in the Authentication-Results line.

You can also look at the records themselves directly. At the Windows command prompt, the command nslookup -type=txt yourdomain will show the SPF record, among other things, and nslookup -type=txt _dmarc.yourdomain will show the DMARC policy. An empty response means there is no record.

There are online checking services too, but it is easier to start with Gmail: it shows you the real verdict on a real email, not theory.'],
        ],
        'end'      => 'These three records will not make your emails more interesting or replace a clear offer. They solve a different problem: making sure the email arrives and looks like an email from the company, not like someone trying to pass themselves off as the company. They are set up once, checked in five minutes, and all they cost is access to the DNS panel.

If you do not have access to the panel, the records were inherited from a previous contractor, or the check shows FAIL and it is not clear why, sorting this out is a one-off job, not an endless process. Setting up business email on a domain is part of what MGuliyev Studio does alongside website development.',
    ],
    'core-web-vitals-lcp-inp-cls' => [
        'seoTitle' => 'Core Web Vitals: what Google considers a fast website',
        'seoDesc'  => 'LCP, INP and CLS in plain English: what each metric measures and why a test on your laptop and data from real visitors disagree.',
        'title'    => 'What Google considers a fast website',
        'desc'     => 'LCP, INP and CLS in plain English: what each metric measures and how a lab test differs from real-visitor data.',
        'rubric'   => 'Speed and SEO',
        'lead'     => 'You type your site’s address into PageSpeed Insights and get three abbreviations, a few coloured bars and a score you are not sure how to read. Let’s look at what these letters actually mean, why the report from your laptop and Google’s report on your visitors show different things, and why the mobile column almost always looks worse.',
        'body'     => [
            ['Three questions instead of one number', '“Load time” as a single number says little. A page can show its header within a second and leave the main block empty for another three. It can look ready and still not respond to taps or clicks.

So Google split perceived speed into three questions. Did the main content appear on screen quickly? Does the page respond quickly to an action? Does the content stay in place, or does it jump around under your finger? The answers to these questions are the Core Web Vitals — LCP, INP and CLS.

How the assessment is calculated matters. It is based not on a single measurement but on Chrome data from real visitors over a rolling 28-day window, and what counts is not the average but the 75th percentile: the threshold that three quarters of visits fall within. One caveat: it really is Chrome only. Safari and Firefox are not part of this data set, and neither are visitors on iPhones — even if they have Chrome installed. So the report describes part of your audience, not all of it. Mobile and desktop visits are assessed separately.

It does affect search rankings, but as a secondary factor rather than the main one: how relevant the content is matters more than speed. Sales, on the other hand, are directly affected by speed — some visitors leave before they even see your offer.'],
            ['LCP: when the page looks ready', 'LCP (Largest Contentful Paint) measures the time from the start of loading to the moment the largest visible block appears on screen. Usually that is the main photo, a banner or a large heading. For the visitor, this is the moment the page starts to feel ready.

Thresholds: up to 2.5 seconds is good, over 4 seconds is poor, and anything in between “needs improvement”. A reminder: it is the 75th percentile that is assessed, not one lucky measurement.

The least obvious part: more often than not, it is not the image’s file size that eats up the time. First the server has to respond. Then the browser has to find out that the image exists at all — and it may be hidden in the stylesheets, inserted by a slider script or waiting for a font to load. The file transfer itself often turns out to be the smaller part of the interval. That is why the advice “compress your images” sometimes does not move LCP at all.'],
            ['INP: does the page respond to a tap?', 'INP (Interaction to Next Paint) replaced the earlier FID metric in March 2024. It measures the delay between a visitor’s action — a click, a tap, a key press — and the moment something changes on screen in response. Scrolling and hovering the cursor are not counted.

INP does not take the average delay over a visit; it takes one of the worst. The logic is simple: people do not remember ten quick taps, they remember the one where the page froze.

Thresholds: up to 200 milliseconds is good, over 500 milliseconds is poor.

The cause of a poor INP is almost always the same — heavy JavaScript. The browser runs it on a single thread, and while the script for a chat widget, analytics or a carousel is running, the tap waits its turn. For a business, it looks like this: a visitor presses “Send”, nothing happens, so they press it again. Duplicate requests in your inbox are a good reason to look at this metric.'],
            ['CLS: does the content jump around?', 'CLS (Cumulative Layout Shift) measures how much the content moves after it has already appeared. It is not measured in time; it is a unitless value: up to 0.1 is good, above 0.25 is poor.

Where the shifts come from: images and banners without set dimensions, embedded widgets and ads that load later and push blocks apart, a late font that changes the height of the text, a pop-up cookie banner, a notification inserted on top of the page.

This costs money quite literally: a person aims for a button, the layout shifts at that very moment, and their finger lands on the link next to it. On a phone, where elements sit close together, this happens more often.

There is one more detail. In real-visitor data, shifts are tracked the whole time the page is open — not just in the first few seconds. But what goes into the assessment is not the total for the visit but the worst burst: shifts that follow one another are grouped into a window no longer than five seconds, and the largest of these windows is what counts. A carousel that jolts the layout a minute after the page opens will also end up in the assessment — if its burst turns out to be the worst.'],
            ['The lab and real life: why the reports don’t match', 'A lab measurement is a single run on a set device, at a set network speed, with no real person involved. Lighthouse, which is built into the browser, works this way, and so does the test-result section in PageSpeed Insights. The result is repeatable, and it is handy for “before and after” comparisons.

Field data is what your visitors actually experienced: their phones, their connections, their browser extensions. This is what the Core Web Vitals assessment is based on, and it is what ends up in the Search Console report.

That is where the confusing discrepancies come from.

A lab test simply cannot measure INP — that takes a real tap. Instead it shows an indirect indicator: the total time the browser was blocked by scripts. Lab CLS is calculated only over the loading period, while field CLS covers the whole visit. And the overall score from 0 to 100 in the lab report is not Core Web Vitals but a summary of lab metrics.

If a site does not get much traffic, there may not be enough field data, and Google will show either data for the domain as a whole or nothing at all. Then all you have left is the lab.

The rule is simple: field data tells you whether there is a problem, and the lab tells you what is causing it.'],
            ['Why the mobile result is worse than the desktop one', 'This is not a fault in the test but several causes adding up.

The processor. A typical phone runs JavaScript noticeably slower than a laptop, and parsing and executing scripts is most of the work when a page opens. The same script costs a phone several times more.

The connection. A mobile network has high and unpredictable latency, even when the advertised speed is good. Every extra request to the server costs more than it does over a wired connection.

Heat and battery. Under load a phone lowers its processor clock speed, and the second half of the page load runs slower than the first.

The screen. On a narrow screen the main image takes up the full width, and more often than not it is this image that becomes the largest element that LCP measures. On desktop the image and the text share the space.

And the content is the same. Many sites send a phone exactly the same scripts and the same images as a large screen.

On top of that, Google assesses sites primarily by their mobile version. A poor mobile result is, quite simply, your result.'],
            ['What to do about it, step by step', 'First look at the field data, not the score. Mobile, not desktop.

If LCP is red, work out what is holding up the main block: the server response, an image discovered too late, a font.

If INP is red, look for unnecessary scripts and third-party widgets.

If CLS is red, set dimensions for all images and reserve space for anything that loads later.

And keep the scale in mind. The difference between 2 and 3 seconds in LCP is a matter of tuning how the page loads. The difference between 2 and 8 seconds is usually architecture: a theme stuffed with plugins, or a server that responds only every other time.'],
        ],
        'end'      => 'A fast site, as Google sees it, is three answers in a row. The main content appeared quickly (LCP). The page responded to a tap without a pause (INP). Nothing jumped under your finger (CLS). They are checked against real visitors, on mobile devices and across three quarters of visits — not against one lucky measurement on a fast laptop.

If the report for your site is red and the cause is unclear, that is a separate job: read the field data, reproduce the problem in the lab, find the source of the delay and rebuild whatever is causing it. Analysing the speed of existing sites and building new ones with these metrics in mind is part of what MGuliyev Studio does.',
    ],
    'vertikalnoe-video-bezopasnaya-zona' => [
        'seoTitle' => 'Vertical 9:16 video: where the safe zone is in the frame',
        'seoDesc'  => 'Where the platform’s header and buttons cover the frame, why cropping a horizontal video does not work and why you should burn subtitles into the video.',
        'title'    => 'Vertical video: what the interface covers',
        'desc'     => 'The 9:16 format: where the platform’s interface covers the frame, why cropping a horizontal video does not work and what burned-in subtitles are for.',
        'rubric'   => 'Digital marketing',
        'lead'     => 'The video is finished, and on the monitor everything is in place. But on a phone half of the on-screen title has slipped under the account name, the logo in the corner is covered by the “share” button, and the price, the whole point of the shoot, is legible only now and then. The frame has not gone anywhere — it is hidden under the platform’s interface. Let’s look at which parts of a vertical frame do not belong to you and what that means for filming and editing.',
        'body'     => [
            ['You see the whole frame, but not all of it is yours to use', 'A vertical video has a 9:16 aspect ratio, usually 1080×1920 pixels. The video opens full screen, and the app’s elements are drawn on top of it, like glass over a photograph. And you lose space in two ways at once. The interface covers part of the frame. And the screen of a modern phone is taller than 9:16 — to fill it completely, the app scales the frame up and cuts off the left and right edges. So you need a margin for more than just the buttons.

At the top sits the header: the feed tabs and search, with the status bar showing the time and battery level above them. At the bottom are the account name, the description text with its “more” button, the line showing the audio track and the app’s own navigation bar. Down the right runs a vertical column of buttons: like, comments, send, avatar.

What you are left with is the middle of the frame, shifted slightly to the left. That is where you put the face, the product, the subtitles and everything else without which the video makes no sense. Add to that the front-camera cut-out and the gesture bar at the bottom: their sizes differ between phone models, so you need a margin at both ends.'],
            ['The safe zone: a rule of thumb and a caveat', 'The safe zone is the part of the frame that the interface does not cover on any phone. The platforms publish exact values in their guidelines, but these change along with app updates: tabs move, the description block gets taller, new buttons appear. There is no point memorising percentages; it is more useful to keep a rule of thumb in mind and check for yourself.

The rule of thumb is this: if the video is going into several feeds at once, treat the top tenth of the frame, the bottom quarter and the strip on the right where the column of buttons sits as taken — these are the areas that almost every platform covers. Keep everything that carries meaning — the face, the text, the logo, the price, the address — inside the rectangle that is left.

Checking takes a couple of minutes. Upload the video as a draft or to a private account and watch it on a phone, ideally on both a small one and a large one. Another way: take a screenshot of someone else’s video in the feed and lay it over your edit as a semi-transparent layer, like a mask. This is more accurate than any percentages — you see exactly the interface your viewers see.'],
            ['Why cropping a horizontal video does not save you', 'First, the arithmetic. If you take a 16:9 frame and cut a full-height vertical frame out of it, you are left with about 31% of the width. With standard Full HD, 1920×1080, that is roughly 608×1080 pixels. To bring a fragment like that up to 1080×1920, it has to be stretched 1.8 times — the picture goes soft, and small text and fine details blur.

Composition is an even bigger problem than the maths. In a horizontal frame what matters is spread across the width: two people in shot, the product to one side, the subject’s name caption in the lower third. A vertical crop keeps one of the two, cuts off the product and puts the caption exactly where the platform will draw the description. Automatic face-based reframing helps on static shots, but at the cuts the crop starts to jump around.

If you do have to shoot horizontally — say, the same footage is going on the website — shoot in 4K. A vertical crop from a 3840×2160 frame gives 1215×2160 pixels: after scaling down to 1080×1920 you still have sharpness to spare. It is a workable compromise, but not a substitute for shooting for vertical.'],
            ['Subtitles: burned-in versus the platform’s own', 'Platforms can recognise speech and show captions by themselves. But those subtitles are not under your control: the platform decides where they go and in what font, the viewer can switch them off, and when you re-upload the video to another social network they do not carry over — the speech is recognised all over again there. Accuracy is uneven too: names, company names and phrases that mix languages are recognised noticeably worse than ordinary speech.

Burned-in subtitles are text baked into the picture itself during editing. You set the font, the size and the position, place the lines inside the safe zone and know they will look the same everywhere. Feeds are often watched with the sound off — on public transport, in a meeting, late in the evening — and a burned-in line remains the only way to get the point across.

The trade-off is inflexibility: text like this cannot be switched off, and it cannot be translated without rebuilding the video. And if the platform adds its own captions on top of yours, there will be two layers of text on screen, so it is worth turning off automatic subtitles when publishing wherever that setting exists. As for styling, a simple rule works: one or two lines, large, with high contrast against the background.'],
            ['What changes when you shoot for vertical from the start', 'It is not about turning the camera on its side. A narrow, tall frame holds attention differently: close-ups and medium shots read well, while a wide shot on a palm-sized screen turns into a busy jumble of tiny details. The subject is usually placed slightly above and a little to the left of centre — so that the bottom and the right-hand strip are left for the interface.

In a vertical frame the background is barely visible: there is no room left on either side of the subject. So what matters is what is directly behind them, and the far corners of the set do not need to be prepared. Sound, on the other hand, matters more: people watch on a phone, often on the move, and clear speech is more important than a neat picture.

Spare resolution has to be planned at the shooting stage. Recording in vertical 4K — 2160×3840 — lets you reframe, zoom in or straighten the horizon later while still keeping a full 1080×1920 without stretching. While you are at it, think about the cover. In the Instagram profile grid the preview is now vertical, 3:4, rather than square as it used to be. Your 9:16 frame will be cropped at the top and bottom there — so keep what matters in the cover frame closer to the centre.'],
            ['A quick check before publishing', 'Watch the finished video on a phone, not on a monitor, and if possible not only on your own phone: a screen you are used to forgives what a fresh pair of eyes will notice straight away.

Run through this checklist. The subtitles are entirely inside the safe zone. The logo and contact details are not under the buttons. The key text does not slide under the right-hand column with the likes. The first second makes sense without sound. The file is 9:16, 1080×1920 or larger, with no black bars at the top and bottom: they appear when a horizontal frame is simply fitted into a vertical canvas, and the platform does not remove them — the interface will still sit on top of the empty rectangles.'],
        ],
        'end'      => 'The vertical format is not a horizontal one turned on its side. The top, the bottom and the right-hand strip of the frame are taken up by the platform’s interface, and everything the video was shot for sits in the middle. The rest follows from that: shooting for 9:16 from the start instead of cropping, spare resolution, burned-in subtitles for watching without sound and a mandatory check on a phone before publishing.

If you have no time to deal with framing, safe zones and subtitles, you can hand over vertical filming and editing entirely — at MGuliyev Studio this is part of the photo and video shoot service for social media.',
    ],
];
