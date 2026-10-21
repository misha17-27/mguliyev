<?php
/* Статьи блога: перевод (English).

   Накладка на app/data/articles.php: по адресу статьи — те же поля,
   что в оригинале. Перевод сделан с русского и сверен дважды: по
   смыслу (ни одного добавленного или потерянного факта, числа и
   записи DNS — дословно) и по языку. Нет статьи здесь — она
   показывается по-русски и на этом языке не индексируется. */

return [
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
