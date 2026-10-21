<?php
/* Данные сайта: три слоя и две формы.

   СЛОИ, снизу вверх:
     1. app/data/*.php        — русский оригинал, источник правды в репозитории
     2. app/lang/<язык>/*.php — переводы, тоже в репозитории
     3. ~/site-data/*.json    — правки из панели управления, вне деплоя

   Третий слой перекрывает первые два целиком: панель умеет добавлять и
   удалять записи, а накладка «только непустые поля» удаление выразить не
   может. Пока панель ничего не сохранила, файла в хранилище нет, и сайт
   работает ровно на файлах репозитория. Направления услуг и статьи
   панель не заводит и не удаляет — у них список записей из репозитория,
   а из хранилища только содержимое.

   ДВЕ ФОРМЫ:
     *_canon() — все языки сразу: ['name' => ['ru' => …, 'az' => …, 'en' => …]].
                 В этой форме данные правит панель и в ней же лежат в JSON.
     works(), catalog(), packs(), articles() — текущий язык и ровно та форма
                 массива, которую шаблоны читали всегда. Поэтому добавление
                 панели не потребовало правок ни в одном файле страницы.

   ПОЧЕМУ АДРЕСАЦИЯ ПО КЛЮЧУ, А НЕ ПО НОМЕРУ. Накладки перевода и записи
   хранилища находят свою запись по slug группы, домену проекта и ключу
   пакета. Список проектов меняется чаще всего остального, и привязка
   к позиции в массиве рассыпалась бы при первой же правке из панели. */

require_once __DIR__ . '/i18n.php';

/** Список языков сайта. */
function langs(): array
{
    return I18n::$cfg['languages'] ?? ['ru'];
}

/** Основной язык: его значения лежат в app/data/ и служат запасным вариантом. */
function deflang(): string
{
    return I18n::$cfg['default_lang'] ?? 'ru';
}

/** Накладка перевода из app/lang/<язык>/<имя>.php. */
function overlay(string $name, ?string $lang = null): array
{
    $lang = $lang ?? I18n::$lang;
    if ($lang === deflang()) return [];
    $p = __DIR__ . '/lang/' . $lang . '/' . $name . '.php';
    return is_file($p) ? (array) require $p : [];
}

/** Значение из набора по языкам. Нет перевода — отдаём основной язык:
    непереведённая карточка должна показывать русский текст, а не пустоту. */
function tr($m, ?string $lang = null): string
{
    if (is_string($m)) return $m;
    if (!is_array($m)) return '';
    $lang = $lang ?? I18n::$lang;
    foreach ([$lang, deflang()] as $l) {
        if (isset($m[$l]) && is_string($m[$l]) && $m[$l] !== '') return $m[$l];
    }
    /* Других языков не перебираем. Пустой русский бывает нарочно —
       «чего нет в пакете» не заполнено, адрес убран, — и тогда на русской
       странице должна быть пустота, а не азербайджанский текст. Записи
       без русского панель не создаёт: новое заводится на русском. */
    return '';
}

/** Набор по языкам из русского значения и накладок: ['ru' => …, 'az' => …]. */
function by_lang(string $ru, array $ovs, string ...$path): array
{
    $out = [];
    foreach (langs() as $l) {
        if ($l === deflang()) { $out[$l] = $ru; continue; }
        $v = $ovs[$l] ?? null;
        foreach ($path as $k) {
            $v = is_array($v) && isset($v[$k]) ? $v[$k] : null;
        }
        $out[$l] = is_string($v) ? $v : '';
    }
    return $out;
}

/* ====================================================================
   КАНОНИЧЕСКИЙ ВИД: все языки сразу. Этим пользуется панель управления.
   ==================================================================== */

/** Портфолио: группы по отраслям, внутри проекты. */
function works_canon(): array
{
    $s = Store::read('works.json');
    if (is_array($s) && isset($s[0]['slug'], $s[0]['projects'])) return works_seo_fill($s);

    $base = require __DIR__ . '/data/works.php';
    $ovs  = [];
    foreach (langs() as $l) $ovs[$l] = overlay('works', $l);

    $out = [];
    foreach ($base as $g) {
        $slug = $g[2];
        $pr = [];
        foreach ($g[3] as $w) {
            $pr[] = [
                'domain'   => $w[0],
                'desc'     => by_lang($w[1], $ovs, $slug, 'projects', $w[0]),
                'image'    => $w[2] ?? null,
                'archived' => !empty($w[3]),
            ];
        }
        $out[] = [
            'slug'     => $slug,
            'name'     => by_lang($g[0], $ovs, $slug, 'name'),
            'desc'     => by_lang($g[1], $ovs, $slug, 'desc'),
            'projects' => $pr,
        ];
    }
    return works_seo_fill($out);
}

/** Заголовки и описания для поиска из app/data/works_seo.php и галереи
    из app/data/works_gallery.php — там, где своих нет. Берётся только то,
    чего в записи нет совсем: значение, сохранённое в панели (даже пустое),
    главнее файла. Так тексты и снимки доходят и до сайта, у которого
    портфолио уже сохранено из панели. */
function works_seo_fill(array $groups): array
{
    static $seo = null, $gal = null;
    if ($seo === null) {
        $f = __DIR__ . '/data/works_seo.php';
        $seo = is_file($f) ? (array) require $f : [];
        $f = __DIR__ . '/data/works_gallery.php';
        $gal = is_file($f) ? (array) require $f : [];
    }
    if ($gal) {
        foreach ($groups as &$g) {
            foreach ($g['projects'] as &$w) {
                if (!array_key_exists('gallery', $w) && isset($gal[$w['domain'] ?? ''])) {
                    $w['gallery'] = (array)$gal[$w['domain']];
                }
            }
            unset($w);
        }
        unset($g);
    }
    if (!$seo) return $groups;
    foreach ($groups as &$g) {
        $r = $seo[$g['slug'] ?? ''] ?? null;
        if (!is_array($r)) continue;
        foreach ((array)($r['seo'] ?? []) as $l => $v) {
            if (!isset($g['seo'][$l]) && is_array($v)) $g['seo'][$l] = $v;
        }
        foreach ($g['projects'] as &$w) {
            foreach ((array)($r['projects'][$w['domain'] ?? ''] ?? []) as $l => $v) {
                if (!isset($w['seo'][$l]) && is_array($v)) $w['seo'][$l] = $v;
            }
        }
        unset($w);
    }
    unset($g);
    return $groups;
}

/** Каталог услуг: четыре направления, внутри услуги.

    Список направлений — из репозитория, а не из хранилища. Направление
    заводит разработчик вместе с файлом страницы, панель его не добавляет
    и не удаляет. Если брать список из сохранённого файла, новое
    направление после первой же правки из панели не видно нигде, а его
    страница сыпется предупреждениями; убранное — так и висит в списке
    и в карте сайта. Из хранилища берётся только содержимое направления. */
function catalog_canon(): array
{
    $base = require __DIR__ . '/data/catalog.php';
    $ovs  = [];
    foreach (langs() as $l) $ovs[$l] = overlay('catalog', $l);

    $out = [];
    foreach ($base as $slug => $cat) {
        $items = [];
        foreach ($cat['items'] as $i => $it) {
            $items[] = [
                'name' => by_lang($it[0], $ovs, $slug, 'items', (string)$i, '0'),
                'desc' => by_lang($it[1], $ovs, $slug, 'items', (string)$i, '1'),
            ];
        }
        $out[$slug] = [
            'title' => by_lang($cat['title'], $ovs, $slug, 'title'),
            'h1'    => by_lang($cat['h1'],    $ovs, $slug, 'h1'),
            'lead'  => by_lang($cat['lead'],  $ovs, $slug, 'lead'),
            'items' => $items,
        ];
    }

    $s = Store::read('catalog.json');
    if (is_array($s)) {
        foreach ($out as $slug => $cat) {
            $rec = $s[$slug] ?? null;
            if (is_array($rec) && is_array($rec['items'] ?? null)) $out[$slug] = $rec + $cat;
        }
    }
    return $out;
}

/** Пакеты на странице цен. */
function packs_canon(): array
{
    $s = Store::read('packs.json');
    if (is_array($s) && isset($s[0]['key'], $s[0]['name'])) return $s;

    $base = require __DIR__ . '/data/packs.php';
    $ovs  = [];
    foreach (langs() as $l) $ovs[$l] = overlay('packs', $l);

    /* Индексы накладки повторяют позиции в базовом массиве:
       1 — название, 3 — приписка к сумме, 4 — состав, 5 — кому, 6 — чего нет. */
    $out = [];
    foreach ($base as $p) {
        $k = $p[0];
        $out[] = [
            'key'     => $k,
            'name'    => by_lang($p[1],        $ovs, $k, '1'),
            'sum'     => $p[2],
            'note'    => by_lang($p[3],        $ovs, $k, '3'),
            'parts'   => by_lang($p[4],        $ovs, $k, '4'),
            'who'     => by_lang($p[5],        $ovs, $k, '5'),
            'missing' => by_lang($p[6] ?? '',  $ovs, $k, '6'),
        ];
    }
    return $out;
}

/** Статьи блога. Текст статьи существует на своём языке; список на других
    языках показывает только те статьи, у которых перевод есть. */
function articles_canon(): array
{
    $repo = articles_repo();

    /* Состав и порядок — из репозитория: статью заводит разработчик вместе
       с файлом страницы, панель статьи не создаёт и не удаляет. Брать
       список из хранилища значило бы, что статья, добавленная после
       первой правки в панели, отдаёт 404 и не видна даже в панели.
       Статью, убранную из репозитория, по той же причине не показываем.
       Файла ещё нет — записи всё равно проходят через цикл ниже: метка
       _langs должна попасть в файл с первым же сохранением панели. */
    $saved = [];
    $s = Store::read('articles.json');
    if (is_array($s) && isset($s[0]['slug'], $s[0]['body'])) {
        foreach ($s as $a) {
            if (is_array($a) && isset($a['slug'])) $saved[$a['slug']] = $a;
        }
    }

    /* Сохранённое из панели главнее репозитория, и пустая строка в нём
       значит «стёрли», а не «не было»: иначе ни очистить заголовок для
       поиска, ни снять перевод нельзя — репозиторий вернёт их на место.
       Из репозитория берём только то, чего в записи нет вовсе, и язык,
       на котором пусто всё до единого поля, — если текста на нём у записи
       не было никогда. Так выглядит файл, сохранённый, когда переводов
       статей ещё не было: by_lang() пишет пустые az и en, и без этого
       переводы на сайт не попали бы никогда.
       По самим полям «не было» от «сняли целиком» не отличить, поэтому
       языки, на которых у записи бывал текст, копятся в _langs. В файл
       метка уходит со следующим сохранением панели: та записывает этот
       список целиком. Метка только растёт — пересчитанная заново, она
       потеряла бы снятый язык, и он вернулся бы из репозитория. */
    $fields = ['rubric', 'title', 'desc', 'lead', 'end', 'seoTitle', 'seoDesc', 'body'];
    $def = deflang();
    $out = [];
    foreach ($repo as $r) {
        $a = $saved[$r['slug']] ?? $r;

        foreach ($r as $k => $v) {
            if (!array_key_exists($k, $a)) $a[$k] = $v;
        }
        $had = [];
        foreach ((is_array($a['_langs'] ?? null) ? $a['_langs'] : []) as $x) {
            if (in_array($x, langs(), true)) $had[] = $x;
        }
        foreach (langs() as $l) {
            $blank = $l !== $def && !in_array($l, $had, true);
            foreach ($fields as $f) {
                if ($blank && !empty($a[$f][$l])) $blank = false;
            }
            foreach ($fields as $f) {
                if (is_array($a[$f]) && ($blank || !array_key_exists($l, $a[$f]))) {
                    $a[$f][$l] = $r[$f][$l];
                }
                if (!empty($a[$f][$l])) $had[] = $l;
            }
        }
        $a['_langs'] = array_values(array_intersect(langs(), $had));
        $out[] = $a;
    }
    return $out;
}

/** Статьи из файлов репозитория: оригинал и накладки переводов. */
function articles_repo(): array
{
    $base = require __DIR__ . '/data/articles.php';
    $ovs  = [];
    foreach (langs() as $l) $ovs[$l] = overlay('articles', $l);

    $out = [];
    foreach ($base as $a) {
        $sl = $a['slug'];
        $body = [];
        foreach (langs() as $l) {
            if ($l === deflang()) { $body[$l] = $a['body']; continue; }
            $b = $ovs[$l][$sl]['body'] ?? null;
            $body[$l] = is_array($b) ? $b : [];
        }
        $out[] = [
            'slug'     => $sl,
            'date'     => $a['date'],
            'read'     => (int)$a['read'],
            'rubric'   => by_lang($a['rubric'],   $ovs, $sl, 'rubric'),
            'title'    => by_lang($a['title'],    $ovs, $sl, 'title'),
            'desc'     => by_lang($a['desc'],     $ovs, $sl, 'desc'),
            'lead'     => by_lang($a['lead'],     $ovs, $sl, 'lead'),
            'end'      => by_lang($a['end'],      $ovs, $sl, 'end'),
            'seoTitle' => by_lang($a['seoTitle'] ?? '', $ovs, $sl, 'seoTitle'),
            'seoDesc'  => by_lang($a['seoDesc']  ?? '', $ovs, $sl, 'seoDesc'),
            'body'     => $body,
        ];
    }
    return $out;
}

/** Строки интерфейса и страниц: ключ → значения по языкам. */
function texts_canon(): array
{
    $out = [];
    foreach (langs() as $l) {
        $p = __DIR__ . '/lang/' . $l . '.php';
        $d = is_file($p) ? (array) require $p : [];
        foreach ($d as $k => $v) {
            if (is_string($v)) $out[$k][$l] = $v;
        }
    }
    /* Правки панели — накладкой: ключи, добавленные разработчиком в словарь
       после последнего сохранения, должны остаться видны. */
    $ov = Store::read('texts.json');
    if ($ov) {
        foreach ($ov as $k => $byLang) {
            if (!is_array($byLang)) continue;
            foreach ($byLang as $l => $v) {
                if (in_array($l, langs(), true) && is_string($v)) $out[$k][$l] = $v;
            }
        }
    }
    /* Пустые значения у неосновных языков оставляем: панель показывает их
       как незаполненные, а сайт на их месте берёт русский. */
    foreach ($out as $k => $v) {
        foreach (langs() as $l) $out[$k][$l] = $v[$l] ?? '';
    }
    return $out;
}

/** Заголовки и описания страниц для поиска: страница → язык → title/description. */
function seo_canon(): array
{
    $out = require __DIR__ . '/data/seo.php';
    $ov  = Store::read('seo.json');
    if ($ov) {
        foreach ($ov as $page => $byLang) {
            if (!is_array($byLang)) continue;
            foreach ($byLang as $l => $m) {
                if (!in_array($l, langs(), true) || !is_array($m)) continue;
                foreach (['title', 'description'] as $f) {
                    if (isset($m[$f]) && is_string($m[$f]) && $m[$f] !== '') {
                        $out[$page][$l][$f] = $m[$f];
                    }
                }
            }
        }
    }
    return $out;
}

/* ====================================================================
   ЧТО ВИДЯТ ШАБЛОНЫ: текущий язык, прежняя форма массива.
   ==================================================================== */

/** Сколько проектов в портфолио и у скольких снимок сайта. Числа в текстах
    берутся отсюда: вписанные руками, они расходились с портфолио —
    на странице «О студии» стояло 49 при 55 проектах. */
function works_count(): array
{
    $c = ['n' => 0, 'covers' => 0];
    foreach (works_canon() as $g) {
        foreach ($g['projects'] as $w) {
            $c['n']++;
            if (!empty($w['image'])) $c['covers']++;
        }
    }
    return $c;
}

/** Портфолио: [[название, описание, slug, [[домен, описание, обложка, архив?]]]] */
function works(): array
{
    $out = [];
    foreach (works_canon() as $g) {
        $pr = [];
        foreach ($g['projects'] as $w) {
            $pr[] = [$w['domain'], tr($w['desc']), $w['image'] ?? null, !empty($w['archived'])];
        }
        $out[] = [tr($g['name']), tr($g['desc']), $g['slug'], $pr];
    }
    return $out;
}

/** Каталог: slug => ['title','h1','lead','items' => [[название, описание]]] */
function catalog(): array
{
    $out = [];
    foreach (catalog_canon() as $slug => $cat) {
        $items = [];
        foreach ($cat['items'] as $it) {
            $items[] = [tr($it['name']), tr($it['desc'])];
        }
        $out[$slug] = [
            'title' => tr($cat['title']),
            'h1'    => tr($cat['h1']),
            'lead'  => tr($cat['lead']),
            'items' => $items,
        ];
    }
    return $out;
}

/** Пакеты: [[ключ, название, сумма, приписка, состав, кому, чего нет]] */
function packs(): array
{
    $out = [];
    foreach (packs_canon() as $p) {
        $out[] = [$p['key'], tr($p['name']), $p['sum'], tr($p['note']),
                  tr($p['parts']), tr($p['who']), tr($p['missing'])];
    }
    return $out;
}

/** Статьи: прежняя ассоциативная форма с текстом на текущем языке.

    Заголовок и описание для поиска — только на языке страницы, без
    русского запасного: пусто — страница статьи соберёт их из заголовка
    и описания, как обещает подсказка в панели. Русский заголовок для
    поиска на азербайджанской странице — это чужой язык в выдаче. */
function articles(): array
{
    $own = static fn($m): string => is_array($m) && is_string($m[I18n::$lang] ?? null) ? $m[I18n::$lang] : '';
    $out = [];
    foreach (articles_canon() as $a) {
        $body = $a['body'][I18n::$lang] ?? [];
        if (!$body) $body = $a['body'][deflang()] ?? [];
        $out[] = [
            'slug'     => $a['slug'],
            'date'     => $a['date'],
            'read'     => $a['read'],
            'rubric'   => tr($a['rubric']),
            'title'    => tr($a['title']),
            'desc'     => tr($a['desc']),
            'lead'     => tr($a['lead']),
            'end'      => tr($a['end']),
            'seoTitle' => $own($a['seoTitle'] ?? null),
            'seoDesc'  => $own($a['seoDesc'] ?? null),
            'body'     => $body,
        ];
    }
    return $out;
}

/* ====================================================================
   НАСТРОЙКИ: контакты, ссылки, цены. Одно значение на весь сайт.
   ==================================================================== */

/** Описание всех полей: значение по умолчанию, подпись, подсказка, группа.
    Из него же панель строит форму. */
function settings_meta(): array
{
    return require __DIR__ . '/data/settings.php';
}

/** Значения на всех языках: у переводимого поля — набор по языкам,
    у остальных — строка. Значения по умолчанию, поверх — правки из панели.
    Этим пользуется панель; сайт читает settings(). */
function settings_canon(): array
{
    $def = deflang();
    $ov  = Store::read('settings.json') ?? [];
    $out = [];
    foreach (settings_meta() as $k => $m) {
        $base = $m['v'] ?? '';
        $v    = $ov[$k] ?? null;

        if (empty($m['i18n'])) {
            $out[$k] = is_string($v) ? $v : (is_array($base) ? tr($base, $def) : (string)$base);
            continue;
        }

        $d = is_array($base) ? $base : [$def => (string)$base];
        $set = [];
        foreach (langs() as $l) {
            if (is_array($v)) {
                $set[$l] = is_string($v[$l] ?? null) ? $v[$l] : '';
            } elseif (is_string($v)) {
                /* Сохранено, когда поле ещё не было переводимым: это русский
                   текст. Переводы по умолчанию годятся, только если русский
                   не меняли, — иначе они описывали бы уже другое. */
                $set[$l] = $l === $def ? $v : ($v === (string)($d[$def] ?? '') ? (string)($d[$l] ?? '') : '');
            } else {
                $set[$l] = (string)($d[$l] ?? '');
            }
        }
        $out[$k] = $set;
    }
    return $out;
}

/** Значения на языке страницы. Пустой перевод — русский текст. */
function settings(?string $lang = null): array
{
    static $cache = [];
    $lang = $lang ?? I18n::$lang;
    if (isset($cache[$lang])) return $cache[$lang];

    $out = [];
    foreach (settings_canon() as $k => $v) {
        $out[$k] = is_array($v) ? tr($v, $lang) : $v;
    }
    return $cache[$lang] = $out;
}

/** Значение настройки. Пусто — пустая строка, решение принимает вызывающий. */
function s(string $key): string
{
    return settings()[$key] ?? '';
}

/** Значение или видимая пометка.

    Пометка — намеренная часть сайта: пока мы не знаем адрес офиса или цену
    продления, посетитель видит «[УТОЧНИТЬ: …]», а не выдуманные данные и не
    пустое место, из которого непонятно, забыли мы или так и задумано.
    Заполнили поле в панели — пометка исчезла, править шаблон не нужно. */
function sv(string $key): string
{
    $v = s($key);
    if ($v !== '') return $v;
    $ask = settings_meta()[$key]['ask'] ?? $key;
    return '[УТОЧНИТЬ: ' . $ask . ']';
}

/** Заполнена ли настройка — когда от этого зависит, рисовать ли блок целиком. */
function has_s(string $key): bool
{
    return s($key) !== '';
}

/** Адрес для href. Пустая строка, если значение не похоже на безопасный адрес.

    В поле формы можно вписать javascript:… — подставлять такое в ссылку
    нельзя. Отдельно отбрасываем адрес, начинающийся с двух косых черт:
    //example.com выглядит как путь внутри сайта, а ведёт на чужой домен,
    подставляя текущую схему. Это и есть самая незаметная ошибка в таких
    проверках, поэтому она стоит до проверки на одиночную косую. */
function su(string $key): string
{
    $v = trim(s($key));
    if ($v === '') return '';
    if (strpos($v, '//') === 0 || strpos($v, "\\") !== false) return '';
    if ($v[0] === '/' || $v[0] === '#') return $v;
    $sch = strtolower((string)parse_url($v, PHP_URL_SCHEME));
    return in_array($sch, ['http', 'https', 'mailto', 'tel'], true) ? $v : '';
}

/** Телефон в виде, пригодном для tel: — только цифры и плюс. */
function tel_href(string $key = 'phone'): string
{
    $v = preg_replace('/[^0-9+]/', '', s($key)) ?? '';
    return $v === '' ? '' : 'tel:' . $v;
}

/** Ссылка на переписку в WhatsApp из номера. */
function wa_href(): string
{
    $v = preg_replace('/[^0-9]/', '', s('whatsapp')) ?? '';
    return $v === '' ? '' : 'https://wa.me/' . $v;
}

/* ====================================================================
   ПОРТФОЛИО КАК СТРАНИЦЫ: у отрасли и у проекта свой адрес.

     /portfolio/                     все работы
     /portfolio/logistika/           отрасль
     /portfolio/logistika/itas-az/   проект

   Адрес проекта собирается из домена: он и так уникален, и по нему
   проект находят переводы. Отдельное поле «адрес» значило бы ещё одну
   вещь, которую можно испортить, — а сменить домен приходится редко.

   Адрес разбирается из пути запроса, а не из параметров: так его нельзя
   подменить хвостом ?c=… и получить одну страницу под чужим адресом.

   Сменили домен — адрес страницы сменился. Прежний остаётся у проекта
   в 'aliases' и ведёт на новый постоянным редиректом: на старый адрес
   уже могли сослаться, и поисковик успел его запомнить.
   ==================================================================== */

/** Адрес проекта из домена: itas.az -> itas-az. */
function project_slug(string $domain): string
{
    $s = strtolower(trim($domain));
    $s = preg_replace('~[^a-z0-9]+~', '-', $s) ?? '';
    return trim($s, '-');
}

/** Адрес страницы портфолио на нужном языке. */
function portfolio_url(?string $cat = null, ?string $proj = null, ?string $lang = null): string
{
    $p = '/portfolio/' . ($cat !== null && $cat !== '' ? $cat . '/' : '')
       . ($proj !== null && $proj !== '' ? $proj . '/' : '');
    return u($p, $lang);
}

/** Что открыто: [отрасль, проект] из пути текущей страницы. */
function portfolio_route(): array
{
    $p = I18n::path();                               // уже без языкового префикса
    if (!preg_match('~^/portfolio/(?:([a-z0-9-]+)/)?(?:([a-z0-9-]+)/)?$~', $p, $m)) {
        return [null, null];
    }
    return [($m[1] ?? '') !== '' ? $m[1] : null, ($m[2] ?? '') !== '' ? $m[2] : null];
}

/** Найти отрасль и проект в каноническом виде.

    Проект ищется по всем отраслям, а не только по той, что в адресе:
    если его перенесли в другую отрасль, старая ссылка должна вести
    на новый адрес, а не в никуда. Где он оказался — в 'cat'. */
function portfolio_find(?string $cat, ?string $proj = null): array
{
    $out = ['group' => null, 'project' => null, 'cat' => null, 'slug' => null];
    $old = null;
    foreach (works_canon() as $g) {
        if ($proj !== null) {
            foreach ($g['projects'] as $w) {
                $s = project_slug($w['domain']);
                if ($s === $proj) {
                    return ['group' => $g, 'project' => $w, 'cat' => $g['slug'], 'slug' => $s];
                }
                /* Прежний адрес проекта. Ищем до конца: если тот же адрес
                   уже стал НЫНЕШНИМ у другого проекта, отдаём его. */
                if ($old === null && in_array($proj, (array)($w['aliases'] ?? []), true)) {
                    $old = ['group' => $g, 'project' => $w, 'cat' => $g['slug'], 'slug' => $s];
                }
            }
        } elseif ($g['slug'] === $cat) {
            return ['group' => $g, 'project' => null, 'cat' => $g['slug'], 'slug' => null];
        }
    }
    return $old ?? $out;
}

/** Страница проекта по домену на языке страницы. Нет такого проекта —
    список портфолио: ссылка с главной не должна вести в 404. */
function project_page(string $domain, ?string $lang = null): string
{
    $f = portfolio_find(null, project_slug($domain));
    return $f['project'] !== null ? portfolio_url($f['cat'], $f['slug'], $lang) : portfolio_url(null, null, $lang);
}

/** Галерея проекта: [['src' => …, 'w' => …, 'h' => …], …] — только файлы,
    которые на сайте есть, с настоящими размерами (для width/height: без
    них страница прыгала бы, пока снимки догружаются). */
function project_gallery(array $w): array
{
    $root = rtrim((string)($_SERVER['DOCUMENT_ROOT'] ?? ''), '/\\');
    $out  = [];
    foreach ((array)($w['gallery'] ?? []) as $src) {
        if (!is_string($src) || !preg_match('~^/images/[A-Za-z0-9._/-]+$~', $src) || strpos($src, '..') !== false) continue;
        $size = $root !== '' ? @getimagesize($root . $src) : false;
        if ($root !== '' && !$size) continue;
        $out[] = ['src' => $src, 'w' => (int)($size[0] ?? 1000), 'h' => (int)($size[1] ?? 1600)];
    }
    return $out;
}

/** Обложка проекта: снимок сайта или отраслевая подложка. */
function project_cover(array $w, array $g): string
{
    return !empty($w['image']) ? $w['image'] : group_cover($g['slug']);
}

/** Подложка отрасли. Своя есть только у отраслей из репозитория:
    отрасли, добавленной из панели, рисовать её некому, и ссылка вела бы
    на несуществующий файл — пустая серая карточка у каждого проекта.
    Тогда берём одну из общих подложек, всегда одну и ту же для отрасли. */
function group_cover(string $slug): string
{
    static $seen = [];
    $rel  = '/images/groups/' . $slug . '.svg';
    $root = rtrim((string)($_SERVER['DOCUMENT_ROOT'] ?? ''), '/\\');
    if ($root === '') return $rel;
    $seen[$slug] = $seen[$slug] ?? is_file($root . $rel);
    return $seen[$slug] ? $rel : '/images/placeholder/work-' . (crc32($slug) % 6 + 1) . '.svg';
}

/* Ширина карточки в сетке .works (style.css): одна колонка до 480px,
   две до 900, дальше три в контейнере до 1232px. */
const COVER_SIZES = '(max-width:480px) 92vw, (max-width:900px) 46vw, (max-width:1320px) 30vw, 400px';

/** Атрибуты srcset и sizes из уменьшенных WebP-копий обложки (их делает
    tools/make-images.php). Обложка 1200×750 в сетке видна на ~376 CSS px —
    телефон тянул втрое больше нужного. Копий нет — пустая строка, остаётся
    один src: у загруженных из панели картинок и у SVG-подложек их не бывает,
    и ссылка на них дала бы 404. */
function cover_srcset(string $src, string $sizes = COVER_SIZES): string
{
    $base = preg_replace('~\.jpe?g$~i', '', $src);
    $root = rtrim((string)($_SERVER['DOCUMENT_ROOT'] ?? ''), '/\\');
    if ($base === $src || $root === '') return '';
    $out = [];
    foreach ([480, 800, 1200] as $w) {
        if (!is_file($root . $base . '-' . $w . '.webp')) return '';
        $out[] = $base . '-' . $w . '.webp ' . $w . 'w';
    }
    return ' srcset="' . htmlspecialchars(implode(', ', $out), ENT_QUOTES) . '"'
         . ' sizes="' . htmlspecialchars($sizes, ENT_QUOTES) . '"';
}

/** Адрес стиля или скрипта с версией по времени файла. Меняется файл —
    меняется адрес, поэтому их можно кешировать на год (public/.htaccess):
    ни Cloudflare, ни браузер не отдадут старую копию после выкладки. */
function asset_url(string $rel): string
{
    $root = rtrim((string)($_SERVER['DOCUMENT_ROOT'] ?? ''), '/\\');
    $t = $root !== '' && is_file($root . $rel) ? filemtime($root . $rel) : false;
    return $t ? $rel . '?v=' . $t : $rel;   // нет файла — без версии, а не «?v=»
}

/** Заголовок и описание для поиска — свои, если заданы в панели,
    иначе собранные из того, что о странице известно. Собираются из
    строк словаря, поэтому на каждом языке — своя фраза, а не перевод
    русской подстановкой. */
function portfolio_seo(array $g, ?array $w = null, ?string $lang = null): array
{
    $lang = $lang ?? I18n::$lang;
    $own  = $w !== null ? ($w['seo'][$lang] ?? []) : ($g['seo'][$lang] ?? []);
    $name = tr($w !== null ? $w['desc'] : $g['name'], $lang);

    if ($w !== null) {
        $vars = ['name' => $name, 'domain' => $w['domain'], 'cat' => tr($g['name'], $lang)];
        $tt = ['portfolio.p_title', 'portfolio.p_title2'];
        $td = ['portfolio.p_desc', 'portfolio.p_desc2'];
    } else {
        $n = count($g['projects']);
        $vars = ['name' => $name, 'desc' => tr($g['desc'], $lang), 'n' => $n,
                 'u' => plural($n, 'units.project', $lang)];
        $tt = ['portfolio.c_title', 'portfolio.c_title2'];
        $td = ['portfolio.c_desc', 'portfolio.c_desc2'];
    }

    return [
        'title'       => ($own['title'] ?? '') !== '' ? $own['title'] : seo_fit($tt, $vars, 60, $lang),
        'description' => ($own['description'] ?? '') !== '' ? $own['description'] : seo_fit($td, $vars, 158, $lang),
        'own'         => ($own['title'] ?? '') !== '' || ($own['description'] ?? '') !== '',
    ];
}

/** Строка для выдачи, уложенная в длину: заголовок до 60 знаков,
    описание до 158. Длиннее поисковик обрезает сам — и режет с конца,
    то есть первым теряется название студии или домен, по которым
    страницу в выдаче и узнают.

    Шаблоны — от полного к короткому, берётся первый, что поместился.
    Не поместился и самый короткий — укорачиваем название по границе
    слова: оно в начале строки, и обрезанное многоточием читается. */
function seo_fit(array $keys, array $vars, int $max, string $lang): string
{
    $fill = static function (string $key, array $v) use ($lang): string {
        $s = I18n::rawIn($key, $lang);
        foreach ($v as $k => $x) $s = str_replace('{' . $k . '}', (string)$x, $s);
        return trim(preg_replace('~\s+~u', ' ', $s) ?? $s);
    };

    $s = '';
    foreach ($keys as $k) {
        $s = $fill($k, $vars);
        if (mb_strlen($s) <= $max) return $s;
    }

    $name = (string)($vars['name'] ?? '');
    $keep = mb_strlen($name) - (mb_strlen($s) - $max) - 1;   // место под многоточие
    if ($keep < 12) return $s;                                // резать нечего — пусть режет поисковик
    $part = mb_substr($name, 0, $keep);
    $sp   = mb_strrpos($part, ' ');
    if ($sp !== false && $sp > $keep / 2) $part = mb_substr($part, 0, $sp);
    $vars['name'] = rtrim($part, " ,.;:—-") . '…';
    return $fill((string)end($keys), $vars);
}

/* ====================================================================
   РАЗМЕТКА SCHEMA.ORG: один JSON-LD на страницу.

   Без неё поисковик угадывает сам: как называется студия, какой у неё
   логотип и телефон, когда вышла статья, где страница стоит в разделе.

   В разметке только то, что уже есть в репозитории и в настройках.
   Адреса нет, пока его не вписали в панели; отзывов и рейтингов нет
   вовсе. Выдуманное здесь поисковик покажет в выдаче как наши слова.
   ==================================================================== */

/** Граф для страницы: студия и сайт — везде, остальное — где есть.
    $ctx: canonical, desc (описание страницы), page ($page страницы),
    crumbs ([[имя, путь без префикса языка | null у текущей], …]),
    art (запись articles(), только у статьи). */
function schema_graph(array $ctx): array
{
    $cfg   = I18n::$cfg;
    $base  = rtrim($cfg['site_url'], '/');
    $orgId = $base . '/#organization';
    $canon = (string)($ctx['canonical'] ?? '');
    $page  = (string)($ctx['page'] ?? '');

    /* Логотип — квадратный значок: логотип из шапки белый и на белом фоне
       выдачи пропал бы. Год основания — тот же, что в footer.tagline и в
       описаниях data/seo.php: меняется вместе с ними. */
    $org = [
        '@type'        => 'Organization',
        '@id'          => $orgId,
        'name'         => $cfg['site_name'],
        'url'          => $base . '/',
        'logo'         => ['@type' => 'ImageObject', 'url' => $base . '/icon-512.png', 'width' => 512, 'height' => 512],
        'image'        => $base . $cfg['og_image'],
        'description'  => t_raw('footer.tagline'),
        'foundingDate' => '2017',
    ];
    /* (string): substr('', 4) в PHP 7.4 — false, а не пустая строка. */
    $tel = (string)substr(tel_href(), 4);                    // tel:+994… -> +994…
    if ($tel !== '') $org['telephone'] = $tel;
    if (s('email') !== '') $org['email'] = s('email');
    /* Город — тот, что и так написан в подвале. Улица — только вписанная
       в панели: с ней студия становится местной организацией, а без неё
       поисковик такую разметку не принимает. */
    $org['address'] = ['@type' => 'PostalAddress',
                       'addressLocality' => trim(explode(',', t_raw('footer.city'))[0]),
                       'addressCountry' => 'AZ'];
    if (has_s('address')) {
        $org['@type'] = 'ProfessionalService';
        $org['address']['streetAddress'] = s('address');
    }
    $same = array_values(array_filter([su('instagram'), su('facebook'), su('tiktok')],
                         static fn($u) => strpos($u, 'http') === 0));
    if ($same) $org['sameAs'] = $same;

    $graph = [$org, [
        '@type'      => 'WebSite',
        '@id'        => $base . '/#website',
        'url'        => $base . '/',
        'name'       => $cfg['site_name'],
        'inLanguage' => $cfg['languages'],
        'publisher'  => ['@id' => $orgId],
    ]];

    /* Направление услуг: страница задаёт $page = slug каталога. Крошки
       у него те же, что видны на странице: «Услуги» и название. */
    $svc    = $page !== '' ? (catalog()[$page] ?? null) : null;
    $crumbs = $ctx['crumbs'] ?? [];
    if (!$crumbs && $svc !== null) {
        $crumbs = [[t_raw('nav.services'), '/uslugi/'], [$svc['title'], null]];
    }

    if ($crumbs) {
        $items = [['@type' => 'ListItem', 'position' => 1, 'name' => $cfg['site_name'], 'item' => $base . u('/')]];
        foreach ($crumbs as $i => [$name, $path]) {
            $items[] = ['@type' => 'ListItem', 'position' => $i + 2, 'name' => (string)$name,
                        'item' => $path !== null ? $base . u($path) : $canon];
        }
        $graph[] = ['@type' => 'BreadcrumbList', '@id' => $canon . '#breadcrumb', 'itemListElement' => $items];
    }

    /* Статья. Автор — студия: имени автора в данных нет, и придумывать
       его не будем. Дата правки не хранится — dateModified не пишем. */
    if (!empty($ctx['art'])) {
        $a = $ctx['art'];
        $post = [
            '@type'            => 'BlogPosting',
            '@id'              => $canon . '#article',
            'mainEntityOfPage' => $canon,
            'headline'         => $a['title'],
            'description'      => $a['desc'],
            'inLanguage'       => lang(),
            'articleSection'   => $a['rubric'],
            'timeRequired'     => 'PT' . (int)$a['read'] . 'M',
            'image'            => $base . $cfg['og_image'],
            'author'           => ['@id' => $orgId],
            'publisher'        => ['@id' => $orgId],
        ];
        $d = DateTime::createFromFormat('!d.m.Y', (string)$a['date']);
        if ($d) $post['datePublished'] = $d->format('Y-m-d');
        $graph[] = $post;
    }

    /* Услуга и её состав — из каталога, поэтому переводы и правки из
       панели попадают сюда сами. Цен нет: у пунктов каталога их нет,
       а пакеты с ценами — это страница /tseny/. */
    if ($svc !== null) {
        $offers = [];
        foreach ($svc['items'] as [$n, $desc]) {
            if ($n === '') continue;
            $offers[] = ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => $n, 'description' => $desc]];
        }
        $graph[] = [
            '@type'           => 'Service',
            '@id'             => $canon . '#service',
            'name'            => $svc['h1'] !== '' ? $svc['h1'] : $svc['title'],
            'serviceType'     => $svc['title'],
            'description'     => (string)($ctx['desc'] ?? '') !== '' ? (string)$ctx['desc'] : $svc['lead'],
            'url'             => $canon,
            'provider'        => ['@id' => $orgId],
            'hasOfferCatalog' => ['@type' => 'OfferCatalog', 'name' => $svc['title'], 'itemListElement' => $offers],
        ];
    }

    return ['@context' => 'https://schema.org', '@graph' => $graph];
}

/** Готовый тег. Строки правятся из панели: JSON_HEX_TAG не даёт «</script>»
    в заголовке статьи закрыть тег, а битый UTF-8 не обнуляет всю разметку. */
function schema_tag(array $ctx): string
{
    $json = json_encode(schema_graph($ctx), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        | JSON_HEX_TAG | JSON_HEX_AMP | JSON_INVALID_UTF8_SUBSTITUTE);
    return $json === false ? '' : '<script type="application/ld+json">' . $json . "</script>\n";
}
