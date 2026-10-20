<?php
/* Данные сайта: три слоя и две формы.

   СЛОИ, снизу вверх:
     1. app/data/*.php        — русский оригинал, источник правды в репозитории
     2. app/lang/<язык>/*.php — переводы, тоже в репозитории
     3. ~/site-data/*.json    — правки из панели управления, вне деплоя

   Третий слой перекрывает первые два целиком: панель умеет добавлять и
   удалять записи, а накладка «только непустые поля» удаление выразить не
   может. Пока панель ничего не сохранила, файла в хранилище нет, и сайт
   работает ровно на файлах репозитория.

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
    if (is_array($s) && isset($s[0]['slug'], $s[0]['projects'])) return $s;

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
    return $out;
}

/** Каталог услуг: четыре направления, внутри услуги. */
function catalog_canon(): array
{
    $s = Store::read('catalog.json');
    if (is_array($s) && $s) {
        $first = reset($s);
        if (is_array($first) && isset($first['items'])) return $s;
    }

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
    $s = Store::read('articles.json');
    if (is_array($s) && isset($s[0]['slug'], $s[0]['body'])) return $s;

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

/** Статьи: прежняя ассоциативная форма с текстом на текущем языке. */
function articles(): array
{
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
            'seoTitle' => tr($a['seoTitle']),
            'seoDesc'  => tr($a['seoDesc']),
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

/** Текущие значения: значения по умолчанию, поверх — правки из панели. */
function settings(): array
{
    static $out = null;
    if ($out !== null) return $out;

    $out = [];
    foreach (settings_meta() as $k => $m) $out[$k] = (string)($m['v'] ?? '');

    $ov = Store::read('settings.json');
    if ($ov) {
        foreach ($ov as $k => $v) {
            if (isset($out[$k]) && is_string($v)) $out[$k] = $v;
        }
    }
    return $out;
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
