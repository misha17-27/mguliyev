<?php
/* Данные с переводом.

   Русский лежит в app/data/ и считается источником. Переводы — накладки
   в app/lang/<язык>/: они повторяют ту же форму, но могут быть неполными.
   Чего в накладке нет, берётся из русского, поэтому один непереведённый
   проект не обнуляет карточку, а показывает русское описание.

   Накладка каталога повторяет форму data/catalog.php.
   Накладка портфолио адресуется по slug группы и по домену проекта,
   а не по порядковому номеру: список проектов меняется, и привязка
   к позиции в массиве рассыпалась бы при первой же правке. */

require_once __DIR__ . '/i18n.php';

function overlay(string $name): array
{
    if (I18n::$lang === (I18n::$cfg['default_lang'] ?? 'ru')) return [];
    $p = __DIR__ . '/lang/' . I18n::$lang . '/' . $name . '.php';
    return is_file($p) ? (array) require $p : [];
}

/** Каталог услуг: 4 направления по 6 услуг. */
function catalog(): array
{
    $base = require __DIR__ . '/data/catalog.php';
    $ov   = overlay('catalog');
    if (!$ov) return $base;

    foreach ($base as $slug => &$cat) {
        $o = $ov[$slug] ?? null;
        if (!$o) continue;
        foreach (['title', 'h1', 'lead'] as $k) {
            if (!empty($o[$k])) $cat[$k] = $o[$k];
        }
        foreach ($cat['items'] as $i => &$it) {
            if (!empty($o['items'][$i][0])) $it[0] = $o['items'][$i][0];
            if (!empty($o['items'][$i][1])) $it[1] = $o['items'][$i][1];
        }
        unset($it);
    }
    unset($cat);
    return $base;
}

/** Портфолио: группы по отраслям, внутри проекты. */
function works(): array
{
    $base = require __DIR__ . '/data/works.php';
    $ov   = overlay('works');
    if (!$ov) return $base;

    foreach ($base as &$g) {
        $slug = $g[2];                       // 'logistika', 'torgovlya', ...
        $o = $ov[$slug] ?? null;
        if (!$o) continue;
        if (!empty($o['name'])) $g[0] = $o['name'];
        if (!empty($o['desc'])) $g[1] = $o['desc'];
        foreach ($g[3] as &$w) {
            $d = $o['projects'][$w[0]] ?? null;   // ключ — домен проекта
            if ($d) $w[1] = $d;
        }
        unset($w);
    }
    unset($g);
    return $base;
}

/** Статьи блога. Переводов пока нет: у статьи свой язык, и список
    на других языках показывает только те, что на нём существуют. */
function articles(): array
{
    $all = require __DIR__ . '/data/articles.php';
    $ov  = overlay('articles');
    if (!$ov) return $all;

    foreach ($all as &$a) {
        $o = $ov[$a['slug']] ?? null;
        if (!$o) continue;
        foreach ($o as $k => $v) { if ($v !== '' && $v !== null) $a[$k] = $v; }
    }
    unset($a);
    return $all;
}

/** Пакеты на странице цен. Накладка адресуется по ключу пакета. */
function packs(): array
{
    $base = require __DIR__ . '/data/packs.php';
    $ov   = overlay('packs');
    if (!$ov) return $base;
    foreach ($base as &$p) {
        $o = $ov[$p[0]] ?? null;
        if (!$o) continue;
        foreach ([1, 3, 4, 5, 6] as $i) {
            if (!empty($o[$i])) $p[$i] = $o[$i];
        }
    }
    unset($p);
    return $base;
}
