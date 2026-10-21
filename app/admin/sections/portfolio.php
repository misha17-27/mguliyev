<?php
/* Портфолио: проекты и категории (отрасли), у каждого — своя страница на сайте.

   ПРОЕКТЫ И КАТЕГОРИИ — ОТДЕЛЬНО, как записи и рубрики в WordPress:
     ?section=portfolio                    все проекты одним списком
     ?section=portfolio&cat=logistika      те же, только одной категории (и порядок)
     ?section=portfolio&p=new              добавить проект
     ?section=portfolio&p=itas-az          проект: всё, что видно на его странице
     ?section=portfolio&view=cats          категории: список и «Добавить категорию»
     ?section=portfolio&g=logistika        категория: название, текст, SEO

   Раньше проекты были видны только изнутри отрасли: чтобы найти проект,
   надо было помнить, в какой он отрасли. Теперь главный экран — все
   проекты сразу, с поиском и колонкой «Категория».

   На сайте категория называется «отрасль» — так она и подписана на
   страницах портфолио. В панели это одно и то же.

   ЯЗЫК — ТОТ, ЧТО ВЫБРАН ВВЕРХУ. Тексты правятся на одном языке за раз,
   под переводом виден русский оригинал. Сохранение меняет только этот
   язык, остальные остаются как были. Язык приходит вместе с формой, а не
   берётся из сессии: сессия общая для всех вкладок, и переключение языка
   в одной вкладке иначе сохранило бы форму другой поверх русского текста.

   НОВОЕ ЗАВОДИТСЯ НА РУССКОМ. Отрасль или проект без русского названия —
   это пустой заголовок на русском сайте и запасной текст ни для кого.
   Поэтому формы добавления всегда русские, а переводы — после.

   ЧТО ЗАЩИЩЕНО:
   — метка версии: вкладка, открытая утром, не откатит дневные правки;
   — запись под блокировкой: два сохранения не перепутаются;
   — домен проверяется на пустоту и повторы ВО ВСЕХ отраслях, потому что
     из него собирается адрес страницы проекта;
   — проект удаляется только кнопкой «Удалить» с подтверждением.

   Признак «архив» не удаляет проект. Домен может не открываться, но работа
   была сделана, и из портфолио она не исчезает — вместо ссылки пометка. */

$e   = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$L   = admin_lang();
$DEF = deflang();

/** Найти номера отрасли и проекта в каноническом массиве. */
function pf_locate(array $groups, string $g, ?string $p = null): array
{
    foreach ($groups as $gi => $grp) {
        if ($p === null) {
            if ($grp['slug'] === $g) return [$gi, null];
            continue;
        }
        foreach ($grp['projects'] as $pi => $w) {
            if (project_slug($w['domain']) === $p) return [$gi, $pi];
        }
    }
    return [null, null];
}

/** Все адреса проектов, кроме одного: для проверки повторов. */
function pf_slugs(array $groups, ?string $except = null): array
{
    $out = [];
    foreach ($groups as $g) {
        foreach ($g['projects'] as $w) {
            $s = project_slug($w['domain']);
            if ($s !== $except) $out[$s] = $g['slug'];
        }
    }
    return $out;
}

/* ================================================================ запись */
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $what = post_one($_POST['do'] ?? '');
    $gs   = post_slug($_POST['g'] ?? '');
    $ps   = post_slug($_POST['p'] ?? '');
    /* Новый проект выбирает категорию в самой форме. */
    if ($what === 'add-project') $gs = post_slug($_POST['move_to'] ?? '');

    /* Куда вернуться, если сохранение не удалось: на тот же экран. */
    switch ($what) {
        case 'add-project':  $back = admin_url('portfolio', ['p' => 'new']); break;
        case 'save-project':
        case 'del-project':  $back = admin_url('portfolio', ['p' => $ps]); break;
        case 'save-group':   $back = admin_url('portfolio', ['g' => $gs]); break;
        case 'move':         $back = admin_url('portfolio', ['cat' => $gs]); break;
        default:             $back = admin_url('portfolio', ['view' => 'cats']);
    }

    /* Язык правки — из самой формы. См. комментарий в начале файла. */
    $L = post_one($_POST['lang'] ?? '');
    if (in_array($what, ['add-group', 'save-group', 'add-project', 'save-project'], true)) {
        if (!in_array($L, langs(), true)) {
            admin_flash('НЕ СОХРАНЕНО: форма пришла без языка правки — похоже, страница '
                . 'устарела. Обновите её и внесите изменения заново.', 'err');
            admin_go($back);
        }
        if (($what === 'add-group' || $what === 'add-project') && $L !== $DEF) {
            admin_flash('НЕ СОХРАНЕНО: новые категории и проекты заводятся на русском — '
                . 'он основа для переводов. Переводы добавляются после.', 'err');
            admin_go($back);
        }
    }

    /* Ошибка не должна стирать то, что человек успел вписать: форма
       откроется снова с его текстом. Хранится до следующей отрисовки. */
    $keep = static function () use ($what, $gs, $ps, $L): void {
        $f = [];
        foreach (['name', 'slug', 'desc', 'intro', 'domain', 'move_to', 'image', 'archived',
                  'text', 'seo_title', 'seo_desc'] as $k) {
            if (isset($_POST[$k]) && is_string($_POST[$k])) $f[$k] = post_one($_POST[$k], true);
        }
        $_SESSION['pf_draft'] = ['do' => $what, 'g' => $gs, 'p' => $ps, 'lang' => $L, 'f' => $f];
    };

    if (admin_stale('works.json')) {
        admin_flash('Портфолио правили из другого места, пока эта страница была открыта. '
            . 'Чтобы не затереть ту правку, сохранение отменено: обновите страницу '
            . 'и внесите изменения заново.', 'err');
        admin_go($back);
    }

    $err = null;
    $msg = 'Сохранено.';
    $go  = $back;

    $ok = Store::update('works.json', function (array $groups) use ($what, $gs, $ps, $L, &$err, &$msg, &$go) {
        /* Хранилище пустое — начинаем с данных репозитория. */
        if (!$groups) $groups = works_canon();

        /* Дата правки — для карты сайта: поисковику сообщаем, что страница
           менялась, только когда менялась именно она. */
        $today = date('Y-m-d');

        /* ---------------------------------------------- новая категория */
        if ($what === 'add-group') {
            $name = post_one($_POST['name'] ?? '');
            $k    = post_slug($_POST['slug'] ?? '');
            if ($name === '' || $k === '') { $err = 'Нужны и название, и адрес латиницей.'; return null; }
            foreach ($groups as $g) if ($g['slug'] === $k) { $err = 'Категория с адресом «' . $k . '» уже есть.'; return null; }
            $desc = post_one($_POST['desc'] ?? '', true);
            $groups[] = ['slug' => $k, 'name' => [$L => $name], 'desc' => $desc !== '' ? [$L => $desc] : [],
                         'projects' => [], 'updated' => $today];
            $msg = 'Категория «' . $name . '» добавлена. Её страница: /portfolio/' . $k . '/ — '
                 . 'она появится на сайте, когда в ней будут проекты.';
            $go  = admin_url('portfolio', ['view' => 'cats']);
            return $groups;
        }

        /* Проект ищется по адресу во всех категориях: экран проекта знает
           только его адрес, а не категорию. */
        [$gi, $pi] = pf_locate($groups, $gs, ($what === 'save-project' || $what === 'del-project'
            || $what === 'move') ? $ps : null);
        if ($gi === null) {
            $err = $what === 'add-project'
                ? 'Выберите категорию проекта.'
                : 'Категория или проект не найдены — возможно, их изменили из другой вкладки.';
            return null;
        }

        /* ------------------------------------------ порядок категорий */
        if ($what === 'move-group') {
            $to = post_one($_POST['dir'] ?? '') === 'up' ? $gi - 1 : $gi + 1;
            if (isset($groups[$to])) [$groups[$gi], $groups[$to]] = [$groups[$to], $groups[$gi]];
            $msg = 'Порядок категорий изменён — так они идут и на сайте.';
            $go  = admin_url('portfolio', ['view' => 'cats']);
            return $groups;
        }

        /* --------------------------------------------- удалить категорию */
        if ($what === 'del-group') {
            if (count($groups) < 2) { $err = 'Нельзя удалить последнюю категорию: проектам негде будет быть.'; return null; }
            /* Проекты не удаляются вместе с категорией, а переходят в
               выбранную — как записи удалённой рубрики в WordPress. Удалить
               проекты целиком — отдельное и осознанное действие. */
            $n = count($groups[$gi]['projects']);
            $name = tr($groups[$gi]['name'], deflang());
            if ($n > 0) {
                $to = post_slug($_POST['move_to'] ?? '');
                [$ti] = pf_locate($groups, $to);
                if ($ti === null || $ti === $gi) { $err = 'Выберите, в какую категорию перейдут её проекты.'; return null; }
                foreach ($groups[$gi]['projects'] as $w) $groups[$ti]['projects'][] = $w;
                $groups[$ti]['updated'] = $today;
                $msg = 'Категория «' . $name . '» удалена. Её проекты (' . $n . ') перешли в «'
                     . tr($groups[$ti]['name'], deflang()) . '»; их прежние адреса ведут на новые сами.';
            } else {
                $msg = 'Категория «' . $name . '» удалена.';
            }
            array_splice($groups, $gi, 1);
            $go = admin_url('portfolio', ['view' => 'cats']);
            return $groups;
        }

        /* ------------------------------------------ текст и SEO отрасли */
        if ($what === 'save-group') {
            $name = post_one($_POST['name'] ?? '');
            if ($L === deflang() && $name === '') { $err = 'У отрасли должно быть русское название.'; return null; }
            $groups[$gi]['name'][$L]  = $name;
            $groups[$gi]['desc'][$L]  = post_one($_POST['desc'] ?? '', true);
            $groups[$gi]['intro'][$L] = post_one($_POST['intro'] ?? '', true);
            $groups[$gi]['seo'][$L]   = [
                'title'       => post_one($_POST['seo_title'] ?? ''),
                'description' => post_one($_POST['seo_desc'] ?? '', true),
            ];
            $groups[$gi]['updated'] = $today;
            $msg = 'Категория сохранена (' . strtoupper($L) . ').';
            return $groups;
        }

        /* --------------------------------------------- порядок проектов */
        if ($what === 'move') {
            if ($pi === null) { $err = 'Проект не найден.'; return null; }
            $to = post_one($_POST['dir'] ?? '') === 'up' ? $pi - 1 : $pi + 1;
            $list = &$groups[$gi]['projects'];
            if (isset($list[$to])) [$list[$pi], $list[$to]] = [$list[$to], $list[$pi]];
            unset($list);
            $groups[$gi]['updated'] = $today;
            $msg = 'Порядок изменён — так проекты идут и на сайте.';
            $go  = admin_url('portfolio', ['cat' => $groups[$gi]['slug']]);
            return $groups;
        }

        /* ---------------------------------------------- удалить проект */
        if ($what === 'del-project') {
            if ($pi === null) { $err = 'Проект не найден.'; return null; }
            $dom = $groups[$gi]['projects'][$pi]['domain'];
            array_splice($groups[$gi]['projects'], $pi, 1);
            $groups[$gi]['updated'] = $today;
            $msg = 'Проект ' . $dom . ' удалён. Его страница больше не открывается.';
            $go  = admin_url('portfolio');
            return $groups;
        }

        /* ---------------------------------- новый или изменённый проект */
        if ($what === 'save-project' || $what === 'add-project') {
            if ($what === 'save-project' && $pi === null) { $err = 'Проект не найден.'; return null; }

            $dom = post_domain($_POST['domain'] ?? '');
            if ($dom === '') { $err = 'Домен пустой или записан неверно — например, itas.az.'; return null; }

            $slug  = project_slug($dom);
            $taken = pf_slugs($groups, $what === 'save-project' ? $ps : null);
            if (isset($taken[$slug])) {
                /* Проверка по ВСЕМ отраслям: из домена собирается адрес страницы,
                   и два проекта с одним адресом открывали бы одну страницу. */
                $err = 'Проект с адресом /' . $slug . '/ уже есть в категории «' . $taken[$slug] . '».';
                return null;
            }

            $desc = post_one($_POST['desc'] ?? '');
            if ($L === deflang() && $desc === '') {
                $err = 'Напишите по-русски, чем занимается заказчик: это заголовок страницы проекта.';
                return null;
            }

            /* Неверный путь к снимку — отказ, а не тихая замена на «снимка
               нет»: иначе опечатка в пути молча стирала бы стоящий снимок. */
            $imgIn = post_one($_POST['image'] ?? '');
            $img   = post_image($imgIn);
            if ($imgIn !== '' && $img === null) {
                $err = 'Путь к снимку не подходит: нужен путь внутри сайта вида /images/works/' . $dom
                     . '.jpg (jpg, png, webp, gif, svg или avif). Снимок оставлен прежним.';
                return null;
            }
            $root = ADMIN_WEBROOT;   // тот же корень, куда кладёт загрузки раздел «Изображения»
            if ($img !== null && $root !== '' && !is_file($root . $img)) {
                $err = 'Файла ' . $img . ' на сайте нет. Загрузите его в разделе «Изображения» '
                     . 'и скопируйте путь оттуда. Снимок оставлен прежним.';
                return null;
            }

            $w = $what === 'save-project' ? $groups[$gi]['projects'][$pi] : ['desc' => []];

            /* Сменили домен — сменился адрес страницы. Прежний остаётся
               у проекта и ведёт на новый, см. portfolio_find(). */
            $was = $what === 'save-project' ? project_slug($w['domain']) : null;
            $al  = (array)($w['aliases'] ?? []);
            if ($was !== null && $was !== $slug) $al[] = $was;
            $al  = array_values(array_unique(array_diff($al, [$slug])));
            if ($al) $w['aliases'] = $al; else unset($w['aliases']);

            $w['domain']   = $dom;
            $w['image']    = $img;
            $w['archived'] = !empty($_POST['archived']);
            $w['updated']  = $today;
            $w['desc'][$L] = $desc;
            $w['text'][$L] = post_one($_POST['text'] ?? '', true);
            $w['seo'][$L]  = [
                'title'       => post_one($_POST['seo_title'] ?? ''),
                'description' => post_one($_POST['seo_desc'] ?? '', true),
            ];

            /* Отрасль можно сменить. Адрес страницы при этом меняется,
               и со старого сайт сам ведёт на новый — см. portfolio/project.php. */
            $to = post_slug($_POST['move_to'] ?? $gs);
            [$ti] = pf_locate($groups, $to);
            if ($ti === null) $ti = $gi;

            if ($what === 'save-project') {
                if ($ti === $gi) {
                    $groups[$gi]['projects'][$pi] = $w;
                } else {
                    array_splice($groups[$gi]['projects'], $pi, 1);
                    $groups[$ti]['projects'][] = $w;
                }
            } else {
                $groups[$ti]['projects'][] = $w;
            }
            $groups[$gi]['updated'] = $today;
            $groups[$ti]['updated'] = $today;

            $newG = $groups[$ti]['slug'];
            $msg  = ($what === 'add-project' ? 'Проект добавлен. ' : 'Проект сохранён (' . strtoupper($L) . '). ')
                  . 'Страница: /portfolio/' . $newG . '/' . $slug . '/';
            if ($was !== null && ($was !== $slug || $ti !== $gi)) {
                $msg .= ' Адрес страницы сменился — прежний ведёт на новый сам.';
            }
            $go   = admin_url('portfolio', ['p' => $slug]);
            return $groups;
        }

        $err = 'Неизвестное действие.';
        return null;
    });

    if ($err !== null) {
        $keep();
        admin_flash('НЕ СОХРАНЕНО: ' . $err, 'err');
        admin_go($back);
    }
    if ($ok) {
        admin_note_edit('portfolio:' . $gs);
        admin_flash($msg);
        admin_go($go);
    }
    admin_flash('Не удалось записать. Проверьте место на диске и права на папку ' . Store::dir(), 'err');
    admin_go($back);
}

/* ============================================================= отрисовка */
$groups = works_canon();
$gs   = post_slug($_GET['g'] ?? '');
$ps   = is_string($_GET['p'] ?? null) ? $_GET['p'] : '';
$ps   = $ps === 'new' ? 'new' : post_slug($ps);
$cat  = post_slug($_GET['cat'] ?? '');
$view = ($_GET['view'] ?? '') === 'cats' ? 'cats' : '';

/* Категория по адресу: номер в массиве или null. */
$catIndex = static function (string $slug) use ($groups): ?int {
    foreach ($groups as $i => $g) if ($g['slug'] === $slug) return $i;
    return null;
};

/* Что открыто. Проект ищется по адресу во всех категориях. */
$grp = $prj = null;
if ($ps !== '' && $ps !== 'new') {
    [$gi, $pi] = pf_locate($groups, '', $ps);
    if ($gi === null) {
        admin_flash('Проекта с адресом «' . $ps . '» нет — возможно, его удалили или сменили домен.', 'warn');
        admin_go(admin_url('portfolio'));
    }
    $grp = $groups[$gi];
    $prj = $grp['projects'][$pi];
} elseif ($gs !== '') {
    $gi = $catIndex($gs);
    if ($gi === null) {
        admin_flash('Категории «' . $gs . '» нет.', 'warn');
        admin_go(admin_url('portfolio', ['view' => 'cats']));
    }
    $grp = $groups[$gi];
}
if ($cat !== '' && $catIndex($cat) === null) $cat = '';

/* Новый проект заполняется на русском, какой бы язык ни был выбран. */
$topL = $L;
if ($ps === 'new') $L = $DEF;

/* Текст, вписанный перед ошибкой сохранения: вернуть его в форму. */
$draft = $_SESSION['pf_draft'] ?? null;
unset($_SESSION['pf_draft']);
$df = static function (string $do, ?string $g, ?string $p) use ($draft, &$L): ?array {
    if (!is_array($draft) || ($draft['do'] ?? '') !== $do || ($draft['lang'] ?? '') !== $L) return null;
    if ($g !== null && ($draft['g'] ?? '') !== $g) return null;
    if ($p !== null && ($draft['p'] ?? '') !== $p) return null;
    return (array)($draft['f'] ?? []);
};

$isT = $L !== $DEF;
$ph  = $isT ? ' placeholder="пусто — на сайте будет русский текст"' : '';

/** Поле на текущем языке с русским оригиналом под ним. */
$field = static function (string $name, array $vals, string $label, array $o = []) use ($e, $L, $DEF, $isT, $ph) {
    $v   = (string)($vals[$L] ?? '');
    $src = (string)($vals[$DEF] ?? '');
    echo '<label>' . $e($label) . (!empty($o['hint']) ? ' <span class="hint">' . $e($o['hint']) . '</span>' : '') . '</label>';
    $p   = !empty($o['ph']) ? ' placeholder="' . $e($o['ph']) . '"' : $ph;
    $max = !empty($o['max']) ? ' data-max="' . (int)$o['max'] . '"' : '';
    if (!empty($o['area'])) {
        $rows = (int)($o['rows'] ?? max(3, min(12, (int)ceil(mb_strlen($src !== '' ? $src : $v) / 110) + 2)));
        echo '<textarea name="' . $e($name) . '" rows="' . $rows . '"' . $max . $p . '>' . $e($v) . '</textarea>';
    } else {
        echo '<input type="text" name="' . $e($name) . '" value="' . $e($v) . '"' . $max . $p . '>';
    }
    if ($isT && $src !== '') echo '<div class="src"><b>' . $e(strtoupper($DEF)) . ':</b> ' . nl2br($e($src)) . '</div>';
};

/* В списках и заголовках — текст на языке, выбранном вверху. Нет перевода —
   русский и пометка: на сайте на этом языке будет он же. Раньше списки
   всегда были русскими, и переключение языка в них ничего не меняло. */
$txt = static fn(array $vals): string => (string)(($vals[$L] ?? '') !== '' ? $vals[$L] : ($vals[$DEF] ?? ''));
$inL = static fn(array $vals): string => admin_in_lang($vals);   // см. app/admin/layout.php

/** Заполнен ли свой заголовок для поиска на текущем языке. */
$hasSeo = static fn(array $x): bool => ($x['seo'][$L]['title'] ?? '') !== '';

/** Скрытые поля, общие для всех форм раздела. */
$hidden = static function (string $do, array $more = []) use ($e): void {
    echo '<input type="hidden" name="_csrf" value="' . $e(csrf_token()) . '">';
    echo admin_ver_field('works.json');
    echo '<input type="hidden" name="do" value="' . $e($do) . '">';
    foreach ($more as $k => $v) echo '<input type="hidden" name="' . $e($k) . '" value="' . $e($v) . '">';
};

$total = 0;
foreach ($groups as $g) $total += count($g['projects']);

admin_head('portfolio');

/* ================================================== 1. ПРОЕКТ (правка/новый) */
if ($prj !== null || $ps === 'new'):
    $isNew = $prj === null;
    $w = $prj ?? ['domain' => '', 'desc' => [], 'image' => null, 'archived' => false, 'text' => [], 'seo' => []];
    $slug = $isNew ? '' : project_slug($w['domain']);
    $auto = $isNew ? ['title' => '', 'description' => ''] : portfolio_seo($grp, $w, $L);
    /* Категория: у нового — та, из списка которой пришли, иначе первая. */
    $moveTo = $grp !== null ? $grp['slug'] : ($cat !== '' ? $cat : ($groups[0]['slug'] ?? ''));

    $d = $isNew ? $df('add-project', null, null) : $df('save-project', null, $slug);
    if ($d !== null) {
        $w['domain']   = $d['domain'] ?? $w['domain'];
        $w['image']    = ($d['image'] ?? '') !== '' ? $d['image'] : null;
        $w['archived'] = !empty($d['archived']);
        $w['desc'][$L] = $d['desc'] ?? '';
        $w['text'][$L] = $d['text'] ?? '';
        $w['seo'][$L]  = ['title' => $d['seo_title'] ?? '', 'description' => $d['seo_desc'] ?? ''];
        $moveTo = $d['move_to'] ?? $moveTo;
    }
?>
  <p style="margin:0 0 16px;display:flex;gap:8px;flex-wrap:wrap">
    <a class="btn ghost sm" href="<?= $e(admin_url('portfolio')) ?>">← Все проекты</a>
    <?php if ($grp !== null): ?>
      <a class="btn ghost sm" href="<?= $e(admin_url('portfolio', ['cat' => $grp['slug']])) ?>">Проекты категории «<?= $e($txt($grp['name'])) ?>»</a>
    <?php endif; ?>
  </p>

  <form method="post" action="<?= $e(admin_url('portfolio')) ?>" data-guard="1">
    <?php $hidden($isNew ? 'add-project' : 'save-project', ['g' => $grp['slug'] ?? '', 'p' => $slug, 'lang' => $L]); ?>

    <div class="panel">
      <h3><?= $isNew ? 'Новый проект' : $inL($w['desc']) ?>
        <span class="lg full" style="vertical-align:3px;margin-left:6px"><?= $e(strtoupper($L)) ?></span></h3>
      <?php if (!$isNew): ?>
        <p class="muted" style="margin-top:6px">Страница:
          <span class="path"><?= $e(portfolio_url($grp['slug'], $slug, $L)) ?></span>
          · язык переключается вверху, справа</p>
      <?php elseif ($topL !== $DEF): ?>
        <p class="muted" style="margin-top:6px">Новый проект заполняется на русском — он основа
          для переводов. Перевод на <?= $e(strtoupper($topL)) ?> — сразу после сохранения.</p>
      <?php endif; ?>

      <div class="row">
        <div>
          <label>Домен <span class="hint">из него собирается адрес страницы; при смене прежний адрес ведёт на новый</span></label>
          <input type="text" name="domain" class="mono" value="<?= $e($w['domain']) ?>" placeholder="example.az" required>
        </div>
        <div>
          <label>Категория <span class="hint">при смене прежний адрес ведёт на новый</span></label>
          <select name="move_to">
            <?php foreach ($groups as $g): ?>
              <option value="<?= $e($g['slug']) ?>"<?= $g['slug'] === $moveTo ? ' selected' : '' ?>><?= $e($txt($g['name'])) ?></option>
            <?php endforeach; ?>
          </select>
          <p class="muted" style="margin-top:6px"><a href="<?= $e(admin_url('portfolio', ['view' => 'cats'])) ?>">Категории</a> — добавить новую или поправить название.</p>
        </div>
      </div>

      <?php $field('desc', $w['desc'], 'Чем занимается заказчик',
          ['hint' => 'это заголовок страницы проекта и подпись карточки']); ?>

      <div class="row">
        <div>
          <label>Снимок сайта <span class="hint">путь внутри сайта; пусто — подложка категории</span></label>
          <input type="text" name="image" class="mono" value="<?= $e($w['image'] ?? '') ?>"
                 placeholder="/images/works/<?= $e($w['domain'] !== '' ? $w['domain'] : 'example.az') ?>.jpg">
          <p class="muted" style="margin-top:6px">Загрузить снимок — в разделе
            <a href="<?= $e(admin_url('media')) ?>">«Изображения»</a>, путь копируется кликом.</p>
        </div>
        <div>
          <?php if (!empty($w['image'])): ?>
            <label>Сейчас стоит</label>
            <img src="<?= $e($w['image']) ?>" alt="" style="display:block;width:100%;max-width:340px;aspect-ratio:16/10;object-fit:cover;border-radius:10px;border:1px solid var(--line)">
          <?php endif; ?>
        </div>
      </div>

      <label class="check">
        <input type="checkbox" name="archived" value="1"<?= !empty($w['archived']) ? ' checked' : '' ?>>
        Архив — сайт не открывается: ссылку не ставим, проект остаётся в портфолио
      </label>
    </div>

    <div class="panel">
      <h3>Текст страницы</h3>
      <p class="muted">Что было за задача и что сделали. Абзацы разделяйте пустой строкой.
         Пусто — на странице будут только снимок, категория и ссылка: придумывать рассказ
         о проекте за заказчика мы не будем.</p>
      <?php $field('text', $w['text'] ?? [], 'Текст', ['area' => true, 'rows' => 7]); ?>
    </div>

    <div class="panel">
      <h3>SEO</h3>
      <p class="muted">Пусто — подставится собранное автоматически, оно показано серым в поле.</p>
      <?php
      $field('seo_title', array_map(static fn($x) => $x['title'] ?? '', $w['seo'] ?? []), 'Заголовок в выдаче и на вкладке',
          ['max' => 60, 'hint' => 'до 60 знаков', 'ph' => $auto['title']]);
      $field('seo_desc', array_map(static fn($x) => $x['description'] ?? '', $w['seo'] ?? []), 'Описание под заголовком',
          ['area' => true, 'rows' => 3, 'max' => 158, 'hint' => 'до 158 знаков', 'ph' => $auto['description']]);
      ?>
    </div>

    <div class="btnrow">
      <button class="btn" type="submit"><?= $isNew ? 'Добавить проект' : 'Сохранить' ?></button>
      <a class="btn ghost" href="<?= $e(admin_url('portfolio', $grp !== null ? ['cat' => $grp['slug']] : [])) ?>">Отменить</a>
      <?php if (!$isNew): ?>
        <a class="btn ghost" href="<?= $e(portfolio_url($grp['slug'], $slug, $L)) ?>" target="_blank" rel="noopener">Открыть страницу ↗</a>
      <?php endif; ?>
    </div>
  </form>

  <?php if (!$isNew): ?>
  <form method="post" action="<?= $e(admin_url('portfolio')) ?>" style="margin-top:26px"
        data-confirm="Удалить проект <?= $e($w['domain']) ?>? Его страница перестанет открываться, восстановить будет нечем.">
    <?php $hidden('del-project', ['g' => $grp['slug'], 'p' => $slug]); ?>
    <button class="btn red sm" type="submit">Удалить проект</button>
  </form>
  <?php endif; ?>

<?php
/* ========================================================== 2. КАТЕГОРИЯ */
elseif ($grp !== null):
    $n = count($grp['projects']);
    $auto = portfolio_seo($grp, null, $L);

    $d = $df('save-group', $grp['slug'], null);
    if ($d !== null) {
        $grp['name'][$L]  = $d['name'] ?? '';
        $grp['desc'][$L]  = $d['desc'] ?? '';
        $grp['intro'][$L] = $d['intro'] ?? '';
        $grp['seo'][$L]   = ['title' => $d['seo_title'] ?? '', 'description' => $d['seo_desc'] ?? ''];
    }
?>
  <p style="margin:0 0 16px;display:flex;gap:8px;flex-wrap:wrap">
    <a class="btn ghost sm" href="<?= $e(admin_url('portfolio', ['view' => 'cats'])) ?>">← Все категории</a>
    <a class="btn ghost sm" href="<?= $e(admin_url('portfolio', ['cat' => $grp['slug']])) ?>">Проекты этой категории — <?= $n ?></a>
  </p>

  <form method="post" action="<?= $e(admin_url('portfolio')) ?>" data-guard="1">
    <?php $hidden('save-group', ['g' => $grp['slug'], 'lang' => $L]); ?>

    <div class="panel">
      <h3><?= $inL($grp['name']) ?>
        <span class="lg full" style="vertical-align:3px;margin-left:6px"><?= $e(strtoupper($L)) ?></span></h3>
      <p class="muted" style="margin-top:6px">Страница категории:
        <span class="path"><?= $e(portfolio_url($grp['slug'], null, $L)) ?></span>
        · язык переключается вверху, справа</p>

      <?php
      $field('name', $grp['name'], 'Название', ['hint' => 'заголовок страницы и кнопка в портфолио']);
      $field('desc', $grp['desc'], 'Коротко', ['area' => true, 'rows' => 2, 'hint' => 'под заголовком страницы']);
      $field('intro', $grp['intro'] ?? [], 'Текст страницы категории',
          ['area' => true, 'rows' => 5, 'hint' => 'необязательно; абзацы — через пустую строку']);
      ?>
    </div>

    <div class="panel">
      <h3>SEO</h3>
      <p class="muted">Пусто — подставится собранное автоматически, оно показано серым в поле.</p>
      <?php
      $field('seo_title', array_map(static fn($x) => $x['title'] ?? '', $grp['seo'] ?? []), 'Заголовок в выдаче и на вкладке',
          ['max' => 60, 'hint' => 'до 60 знаков', 'ph' => $auto['title']]);
      $field('seo_desc', array_map(static fn($x) => $x['description'] ?? '', $grp['seo'] ?? []), 'Описание под заголовком',
          ['area' => true, 'rows' => 3, 'max' => 158, 'hint' => 'до 158 знаков', 'ph' => $auto['description']]);
      ?>
    </div>

    <div class="btnrow">
      <button class="btn" type="submit">Сохранить категорию</button>
      <a class="btn ghost" href="<?= $e(portfolio_url($grp['slug'], null, $L)) ?>" target="_blank" rel="noopener">Открыть страницу ↗</a>
    </div>
  </form>

  <?php if (count($groups) > 1): ?>
  <div class="panel" style="margin-top:26px">
    <h3>Удалить категорию</h3>
    <form method="post" action="<?= $e(admin_url('portfolio')) ?>"
          data-confirm="Удалить категорию «<?= $e($txt($grp['name'])) ?>»? Её страница перестанет открываться.">
      <?php $hidden('del-group', ['g' => $grp['slug']]); ?>
      <?php if ($n > 0): ?>
        <p class="muted">Проекты не удаляются вместе с категорией: её <?= $n ?> <?= $n === 1 ? 'проект перейдёт' : 'проекта или больше перейдут' ?>
           в выбранную категорию, а их прежние адреса будут вести на новые.</p>
        <label>Куда перенести проекты</label>
        <select name="move_to" required>
          <option value="">— выберите категорию —</option>
          <?php foreach ($groups as $g): if ($g['slug'] === $grp['slug']) continue; ?>
            <option value="<?= $e($g['slug']) ?>"><?= $e($txt($g['name'])) ?> (<?= count($g['projects']) ?>)</option>
          <?php endforeach; ?>
        </select>
      <?php else: ?>
        <p class="muted">В категории нет проектов.</p>
      <?php endif; ?>
      <div class="btnrow"><button class="btn red sm" type="submit">Удалить категорию</button></div>
    </form>
  </div>
  <?php endif; ?>

<?php
/* ======================================================== 3. КАТЕГОРИИ */
elseif ($view === 'cats'):
    $d = $df('add-group', null, null) ?? [];
?>
  <div class="split">
    <div class="panel" id="dobavit">
      <h3>Добавить категорию</h3>
      <?php if ($L !== $DEF): ?>
        <p class="muted">Новая категория заводится на русском — он основа для переводов.
           Перевести название можно сразу после, на странице категории.</p>
      <?php endif; ?>
      <form method="post" action="<?= $e(admin_url('portfolio')) ?>">
        <?php $hidden('add-group', ['lang' => $DEF]); ?>
        <label for="cat-name">Название <span class="pill grey"><?= $e(strtoupper($DEF)) ?></span></label>
        <input type="text" id="cat-name" name="name" value="<?= $e($d['name'] ?? '') ?>" placeholder="Образование и курсы" required>
        <p class="muted" style="margin-top:6px">Так категория называется на сайте.</p>

        <label for="cat-slug">Адрес</label>
        <input type="text" id="cat-slug" name="slug" class="mono" value="<?= $e($d['slug'] ?? '') ?>" placeholder="obrazovanie" required>
        <p class="muted" style="margin-top:6px">Латиницей, цифрами и дефисом: станет /portfolio/адрес/.</p>

        <label for="cat-desc">Описание <span class="hint">необязательно</span></label>
        <textarea id="cat-desc" name="desc" rows="3"><?= $e($d['desc'] ?? '') ?></textarea>
        <p class="muted" style="margin-top:6px">Строка под заголовком страницы категории.</p>

        <div class="btnrow"><button class="btn" type="submit">Добавить категорию</button></div>
      </form>
    </div>

    <div class="panel">
      <?php admin_list_head(count($groups), 'Категорий'); ?>
      <div class="tablewrap">
        <table class="list">
          <tr>
            <th class="pic">Обложка</th><th>Название</th><th>Адрес</th><th>Проектов</th>
            <th>SEO</th><th>Языки</th><th class="right"></th>
          </tr>
          <?php foreach ($groups as $i => $g):
            $n = count($g['projects']);
            $fill = [];
            foreach (langs() as $l) $fill[$l] = ($g['name'][$l] ?? '') !== '' ? 1 : 0;
          ?>
          <tr>
            <td class="pic"><?= admin_thumb(group_cover($g['slug']), '') ?></td>
            <td><a href="<?= $e(admin_url('portfolio', ['g' => $g['slug']])) ?>"><b class="clamp"><?= $inL($g['name']) ?></b></a>
                <span class="muted clamp"><?= $e($txt($g['desc'])) ?></span></td>
            <td><span class="path" title="<?= $e('/portfolio/' . $g['slug'] . '/') ?>">/portfolio/<?= $e($g['slug']) ?>/</span></td>
            <td><a href="<?= $e(admin_url('portfolio', ['cat' => $g['slug']])) ?>"><b><?= $n ?></b></a></td>
            <td><?= admin_dot($hasSeo($g), 'свой заголовок для поиска') ?></td>
            <td><?= admin_lang_badges($fill, '/portfolio/' . $g['slug'] . '/') ?></td>
            <td class="right"><div class="acts">
              <a class="btn sm" href="<?= $e(admin_url('portfolio', ['g' => $g['slug']])) ?>">Изменить</a>
              <?php foreach (['up' => '↑', 'down' => '↓'] as $dir => $arrow):
                $edge = $dir === 'up' ? $i === 0 : $i === count($groups) - 1; ?>
                <form method="post" action="<?= $e(admin_url('portfolio')) ?>">
                  <?php $hidden('move-group', ['dir' => $dir, 'g' => $g['slug']]); ?>
                  <button class="btn sm" type="submit" title="<?= $dir === 'up' ? 'Выше' : 'Ниже' ?>"<?= $edge ? ' disabled' : '' ?>><?= $arrow ?></button>
                </form>
              <?php endforeach; ?>
              <a class="btn sm" href="<?= $e(portfolio_url($g['slug'], null, $L)) ?>" target="_blank" rel="noopener" title="Открыть страницу на <?= $e(strtoupper($L)) ?>">↗</a>
            </div></td>
          </tr>
          <?php endforeach; ?>
        </table>
      </div>
      <p class="muted" style="margin-top:12px">Порядок категорий — тот же, что в портфолио на сайте.
         Удалить категорию можно на её странице: проекты при этом переходят в другую.</p>
    </div>
  </div>

<?php
/* ===================================================== 4. ВСЕ ПРОЕКТЫ */
else:
    /* Строки списка: все проекты в порядке сайта или одной категории. */
    $rows = [];
    foreach ($groups as $g) {
        if ($cat !== '' && $g['slug'] !== $cat) continue;
        foreach ($g['projects'] as $pi => $w) $rows[] = [$g, $w, $pi, count($g['projects'])];
    }
    $catName = $cat !== '' ? $txt($groups[$catIndex($cat)]['name']) : '';
?>
  <div class="panel">
    <?php admin_list_head(count($rows), $cat !== '' ? 'Проектов в категории' : 'Проектов', 'Добавить проект',
        admin_url('portfolio', array_filter(['p' => 'new', 'cat' => $cat]))); ?>

    <nav class="chips" aria-label="Категории">
      <a href="<?= $e(admin_url('portfolio')) ?>"<?= $cat === '' ? ' class="on" aria-current="true"' : '' ?>>Все <span><?= $total ?></span></a>
      <?php foreach ($groups as $g): ?>
        <a href="<?= $e(admin_url('portfolio', ['cat' => $g['slug']])) ?>"<?= $cat === $g['slug'] ? ' class="on" aria-current="true"' : '' ?>><?= $e($txt($g['name'])) ?> <span><?= count($g['projects']) ?></span></a>
      <?php endforeach; ?>
    </nav>

    <div class="row" style="align-items:end;margin-top:6px">
      <div>
        <label for="texts-filter">Поиск по названию и домену</label>
        <input type="search" id="texts-filter" placeholder="например, itas или перевозки" autocomplete="off">
      </div>
      <div><p class="muted" id="texts-count" aria-live="polite" style="margin:0 0 10px"></p></div>
    </div>

    <?php if ($cat === ''): ?>
      <p class="muted">Порядок проектов меняется стрелками внутри категории — откройте её выше.</p>
    <?php endif; ?>

    <div class="tablewrap">
      <table class="list">
        <tr>
          <th class="num">№</th><th class="pic">Снимок</th><th>Проект</th><th>Категория</th>
          <th>Адрес страницы</th><th>Текст</th><th>SEO</th><th>Языки</th><th class="right"></th>
        </tr>
        <?php foreach ($rows as $i => [$g, $w, $pi, $cnt]):
          $slug = project_slug($w['domain']);
          $fill = [];
          foreach (langs() as $l) $fill[$l] = ($w['desc'][$l] ?? '') !== '' ? 1 : 0;
          $hay  = mb_strtolower($txt($w['desc']) . ' ' . tr($w['desc'], $DEF) . ' ' . $w['domain'] . ' ' . $txt($g['name']));
        ?>
        <tr data-text-row="<?= $e($hay) ?>">
          <td class="num"><?= admin_num($i) ?></td>
          <td class="pic"><?= admin_thumb(project_cover($w, $g), $w['domain']) ?></td>
          <td><a href="<?= $e(admin_url('portfolio', ['p' => $slug])) ?>"><b class="clamp"><?= $inL($w['desc']) ?></b></a>
              <span class="muted"><?= $e($w['domain']) ?><?= !empty($w['archived']) ? ' · <span class="pill grey">архив</span>' : '' ?></span></td>
          <td><a href="<?= $e(admin_url('portfolio', ['cat' => $g['slug']])) ?>"><?= $e($txt($g['name'])) ?></a></td>
          <td><span class="path" title="<?= $e('/portfolio/' . $g['slug'] . '/' . $slug . '/') ?>">…/<?= $e($slug) ?>/</span></td>
          <td><?= admin_dot(($w['text'][$L] ?? '') !== '', 'текст страницы') ?></td>
          <td><?= admin_dot($hasSeo($w), 'свой заголовок для поиска') ?></td>
          <td><?= admin_lang_badges($fill, '/portfolio/' . $g['slug'] . '/' . $slug . '/') ?></td>
          <td class="right"><div class="acts">
            <a class="btn sm" href="<?= $e(admin_url('portfolio', ['p' => $slug])) ?>">Изменить</a>
            <?php if ($cat !== ''): foreach (['up' => '↑', 'down' => '↓'] as $dir => $arrow):
              $edge = $dir === 'up' ? $pi === 0 : $pi === $cnt - 1; ?>
              <form method="post" action="<?= $e(admin_url('portfolio')) ?>">
                <?php $hidden('move', ['dir' => $dir, 'g' => $g['slug'], 'p' => $slug]); ?>
                <button class="btn sm" type="submit" title="<?= $dir === 'up' ? 'Выше' : 'Ниже' ?>"<?= $edge ? ' disabled' : '' ?>><?= $arrow ?></button>
              </form>
            <?php endforeach; endif; ?>
            <a class="btn sm" href="<?= $e(portfolio_url($g['slug'], $slug, $L)) ?>" target="_blank" rel="noopener" title="Открыть страницу на <?= $e(strtoupper($L)) ?>">↗</a>
          </div></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <?php if (!$rows): ?>
      <p class="muted" style="margin-top:12px">В этой категории пока нет проектов.</p>
    <?php endif; ?>
  </div>
<?php endif; ?>

<?php admin_foot(); ?>
