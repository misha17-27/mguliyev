<?php
/* Портфолио: отрасли и проекты, у каждого — своя страница на сайте.

   ТРИ ВИДА:
     ?section=portfolio                    список отраслей
     ?section=portfolio&g=logistika        отрасль: её текст, SEO и список проектов
     ?section=portfolio&g=logistika&p=…    проект: всё, что видно на его странице

   Раньше отрасль правилась одной формой со всеми проектами сразу — до
   семисот полей, и чтобы поправить описание одного проекта, приходилось
   отправлять все. Теперь у проекта своя форма, как у страницы на сайте.

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
    $back = admin_url('portfolio', array_filter(['g' => $gs, 'p' => $what === 'add-project' ? 'new' : $ps]));

    /* Язык правки — из самой формы. См. комментарий в начале файла. */
    $L = post_one($_POST['lang'] ?? '');
    if (in_array($what, ['add-group', 'save-group', 'add-project', 'save-project'], true)) {
        if (!in_array($L, langs(), true)) {
            admin_flash('НЕ СОХРАНЕНО: форма пришла без языка правки — похоже, страница '
                . 'устарела. Обновите её и внесите изменения заново.', 'err');
            admin_go($back);
        }
        if (($what === 'add-group' || $what === 'add-project') && $L !== $DEF) {
            admin_flash('НЕ СОХРАНЕНО: новые отрасли и проекты заводятся на русском — '
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

        /* ------------------------------------------------ новая отрасль */
        if ($what === 'add-group') {
            $name = post_one($_POST['name'] ?? '');
            $k    = post_slug($_POST['slug'] ?? '');
            if ($name === '' || $k === '') { $err = 'Нужны и название, и адрес латиницей.'; return null; }
            foreach ($groups as $g) if ($g['slug'] === $k) { $err = 'Отрасль с адресом «' . $k . '» уже есть.'; return null; }
            $groups[] = ['slug' => $k, 'name' => [$L => $name], 'desc' => [], 'projects' => [], 'updated' => $today];
            $msg = 'Отрасль добавлена. Её страница: /portfolio/' . $k . '/';
            $go  = admin_url('portfolio', ['g' => $k]);
            return $groups;
        }

        [$gi, $pi] = pf_locate($groups, $gs, ($what === 'save-project' || $what === 'del-project'
            || $what === 'move') ? $ps : null);
        if ($gi === null) { $err = 'Отрасль или проект не найдены — возможно, их изменили из другой вкладки.'; return null; }

        /* ---------------------------------------------- удалить отрасль */
        if ($what === 'del-group') {
            if (count($groups) < 2) { $err = 'Нельзя удалить последнюю отрасль: портфолио останется пустым.'; return null; }
            $n = count($groups[$gi]['projects']);
            array_splice($groups, $gi, 1);
            $msg = 'Отрасль удалена вместе с проектами: ' . $n . '.';
            $go  = admin_url('portfolio');
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
            $msg = 'Отрасль сохранена (' . strtoupper($L) . ').';
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
            $msg = 'Порядок изменён.';
            $go  = admin_url('portfolio', ['g' => $gs]);
            return $groups;
        }

        /* ---------------------------------------------- удалить проект */
        if ($what === 'del-project') {
            if ($pi === null) { $err = 'Проект не найден.'; return null; }
            $dom = $groups[$gi]['projects'][$pi]['domain'];
            array_splice($groups[$gi]['projects'], $pi, 1);
            $groups[$gi]['updated'] = $today;
            $msg = 'Проект ' . $dom . ' удалён. Его страница больше не открывается.';
            $go  = admin_url('portfolio', ['g' => $gs]);
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
                $err = 'Проект с адресом /' . $slug . '/ уже есть в отрасли «' . $taken[$slug] . '».';
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
            $go   = admin_url('portfolio', ['g' => $newG, 'p' => $slug]);
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
$gs  = post_slug($_GET['g'] ?? '');
$ps  = (string)($_GET['p'] ?? '');
$ps  = $ps === 'new' ? 'new' : post_slug($ps);
[$gi, $pi] = $gs !== '' ? pf_locate($groups, $gs, $ps !== '' && $ps !== 'new' ? $ps : null) : [null, null];
$grp = $gi !== null ? $groups[$gi] : null;
$prj = ($grp !== null && $pi !== null) ? $grp['projects'][$pi] : null;

/* Новый проект заполняется на русском, какой бы язык ни был выбран. */
$topL = $L;
if ($grp !== null && $prj === null && $ps === 'new') $L = $DEF;

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

/** Заполнен ли свой заголовок для поиска на текущем языке. */
$hasSeo = static fn(array $x): bool => ($x['seo'][$L]['title'] ?? '') !== '';

admin_head('portfolio');

/* ------------------------------------------------------- 1. ОТРАСЛИ */
if ($grp === null):
?>
  <div class="note">
    У каждой отрасли и у каждого проекта своя страница на сайте — со своим
    заголовком и описанием для поиска. Пока их не заполнили, они собираются
    сами из названия, домена и отрасли.
  </div>

  <div class="panel">
    <?php admin_list_head(count($groups), 'Отраслей', 'Добавить отрасль', '#dobavit'); ?>
    <div class="tablewrap">
      <table class="list">
        <tr>
          <th class="num">№</th><th class="pic">Обложка</th><th>Отрасль</th><th>Адрес</th>
          <th>Проектов</th><th>SEO</th><th>Языки</th><th class="right"></th>
        </tr>
        <?php foreach ($groups as $i => $g):
          $n = count($g['projects']);
          $a = count(array_filter($g['projects'], static fn($w) => !empty($w['archived'])));
          $fill = [];
          foreach (langs() as $l) $fill[$l] = ($g['name'][$l] ?? '') !== '' ? 1 : 0;
        ?>
        <tr>
          <td class="num"><?= admin_num($i) ?></td>
          <td class="pic"><?= admin_thumb(group_cover($g['slug']), '') ?></td>
          <td><b class="clamp"><?= $e(tr($g['name'], $DEF)) ?></b>
              <span class="muted clamp"><?= $e(tr($g['desc'], $DEF)) ?></span></td>
          <td><span class="path" title="<?= $e('/portfolio/' . $g['slug'] . '/') ?>">/portfolio/<?= $e($g['slug']) ?>/</span></td>
          <td><b><?= $n ?></b><?= $a ? ' <span class="pill grey">' . $a . ' в архиве</span>' : '' ?></td>
          <td><?= admin_dot($hasSeo($g), 'свой заголовок для поиска') ?></td>
          <td><?= admin_lang_badges($fill, '/portfolio/' . $g['slug'] . '/') ?></td>
          <td class="right"><div class="acts">
            <a class="btn sm" href="<?= $e(admin_url('portfolio', ['g' => $g['slug']])) ?>">Изменить</a>
            <a class="btn sm" href="<?= $e(portfolio_url($g['slug'], null, $DEF)) ?>" target="_blank" rel="noopener">Открыть ↗</a>
          </div></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>

  <?php $d = $df('add-group', null, null) ?? []; ?>
  <div class="panel" id="dobavit">
    <h3>Добавить отрасль</h3>
    <?php if ($L !== $DEF): ?>
      <p class="muted">Новая отрасль заводится на русском — он основа для переводов.
         Перевести название можно сразу после, на странице отрасли.</p>
    <?php endif; ?>
    <form method="post" action="<?= $e(admin_url('portfolio')) ?>">
      <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
      <?= admin_ver_field('works.json') ?>
      <input type="hidden" name="do" value="add-group">
      <input type="hidden" name="lang" value="<?= $e($DEF) ?>">
      <div class="row">
        <div>
          <label>Название <span class="pill grey"><?= $e(strtoupper($DEF)) ?></span></label>
          <input type="text" name="name" value="<?= $e($d['name'] ?? '') ?>" placeholder="Образование и курсы">
        </div>
        <div>
          <label>Адрес <span class="hint">латиницей: станет /portfolio/адрес/</span></label>
          <input type="text" name="slug" class="mono" value="<?= $e($d['slug'] ?? '') ?>" placeholder="obrazovanie">
        </div>
      </div>
      <div class="btnrow"><button class="btn" type="submit">Добавить</button></div>
    </form>
  </div>

<?php
/* ----------------------------------------------- 2. ПРОЕКТ (правка/новый) */
elseif ($prj !== null || $ps === 'new'):
    $isNew = $prj === null;
    $w = $prj ?? ['domain' => '', 'desc' => [], 'image' => null, 'archived' => false, 'text' => [], 'seo' => []];
    $slug = $isNew ? '' : project_slug($w['domain']);
    $auto = $isNew ? ['title' => '', 'description' => ''] : portfolio_seo($grp, $w, $L);
    $moveTo = $grp['slug'];

    $d = $isNew ? $df('add-project', $grp['slug'], null) : $df('save-project', $grp['slug'], $slug);
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
    <a class="btn ghost sm" href="<?= $e(admin_url('portfolio')) ?>">← Все отрасли</a>
    <a class="btn ghost sm" href="<?= $e(admin_url('portfolio', ['g' => $grp['slug']])) ?>">← <?= $e(tr($grp['name'], $DEF)) ?></a>
  </p>

  <form method="post" action="<?= $e(admin_url('portfolio')) ?>" data-guard="1">
    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <?= admin_ver_field('works.json') ?>
    <input type="hidden" name="do" value="<?= $isNew ? 'add-project' : 'save-project' ?>">
    <input type="hidden" name="g" value="<?= $e($grp['slug']) ?>">
    <input type="hidden" name="p" value="<?= $e($slug) ?>">
    <input type="hidden" name="lang" value="<?= $e($L) ?>">

    <div class="panel">
      <h3><?= $isNew ? 'Новый проект' : $e(tr($w['desc'], $DEF)) ?>
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
          <label>Отрасль</label>
          <select name="move_to">
            <?php foreach ($groups as $g): ?>
              <option value="<?= $e($g['slug']) ?>"<?= $g['slug'] === $moveTo ? ' selected' : '' ?>><?= $e(tr($g['name'], $DEF)) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <?php $field('desc', $w['desc'], 'Чем занимается заказчик',
          ['hint' => 'это заголовок страницы проекта и подпись карточки']); ?>

      <div class="row">
        <div>
          <label>Снимок сайта <span class="hint">путь внутри сайта; пусто — отраслевая подложка</span></label>
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
         Пусто — на странице будут только снимок, отрасль и ссылка: придумывать рассказ
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
      <a class="btn ghost" href="<?= $e(admin_url('portfolio', ['g' => $grp['slug']])) ?>">Отменить</a>
      <?php if (!$isNew): ?>
        <a class="btn ghost" href="<?= $e(portfolio_url($grp['slug'], $slug, $L)) ?>" target="_blank" rel="noopener">Открыть страницу ↗</a>
      <?php endif; ?>
    </div>
  </form>

  <?php if (!$isNew): ?>
  <form method="post" action="<?= $e(admin_url('portfolio')) ?>" style="margin-top:26px"
        data-confirm="Удалить проект <?= $e($w['domain']) ?>? Его страница перестанет открываться, восстановить будет нечем.">
    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <?= admin_ver_field('works.json') ?>
    <input type="hidden" name="do" value="del-project">
    <input type="hidden" name="g" value="<?= $e($grp['slug']) ?>">
    <input type="hidden" name="p" value="<?= $e($slug) ?>">
    <button class="btn red sm" type="submit">Удалить проект</button>
  </form>
  <?php endif; ?>

<?php
/* --------------------------------------------------------- 3. ОТРАСЛЬ */
else:
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
  <p style="margin:0 0 16px"><a class="btn ghost sm" href="<?= $e(admin_url('portfolio')) ?>">← Все отрасли</a></p>

  <form method="post" action="<?= $e(admin_url('portfolio')) ?>" data-guard="1">
    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <?= admin_ver_field('works.json') ?>
    <input type="hidden" name="do" value="save-group">
    <input type="hidden" name="g" value="<?= $e($grp['slug']) ?>">
    <input type="hidden" name="lang" value="<?= $e($L) ?>">

    <div class="panel">
      <h3><?= $e(tr($grp['name'], $DEF)) ?>
        <span class="lg full" style="vertical-align:3px;margin-left:6px"><?= $e(strtoupper($L)) ?></span></h3>
      <p class="muted" style="margin-top:6px">Страница:
        <span class="path"><?= $e(portfolio_url($grp['slug'], null, $L)) ?></span>
        · язык переключается вверху, справа</p>

      <?php
      $field('name', $grp['name'], 'Название отрасли', ['hint' => 'заголовок страницы и кнопка в портфолио']);
      $field('desc', $grp['desc'], 'Коротко', ['area' => true, 'rows' => 2, 'hint' => 'под заголовком страницы']);
      $field('intro', $grp['intro'] ?? [], 'Текст страницы отрасли',
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
      <button class="btn" type="submit">Сохранить отрасль</button>
      <a class="btn ghost" href="<?= $e(portfolio_url($grp['slug'], null, $L)) ?>" target="_blank" rel="noopener">Открыть страницу ↗</a>
    </div>
  </form>

  <div class="panel" style="margin-top:26px">
    <?php admin_list_head($n, 'Проектов в отрасли', 'Добавить проект',
        admin_url('portfolio', ['g' => $grp['slug'], 'p' => 'new'])); ?>
    <div class="tablewrap">
      <table class="list">
        <tr>
          <th class="num">№</th><th class="pic">Снимок</th><th>Проект</th><th>Адрес страницы</th>
          <th>Текст</th><th>SEO</th><th>Языки</th><th class="right"></th>
        </tr>
        <?php foreach ($grp['projects'] as $i => $w):
          $slug = project_slug($w['domain']);
          $fill = [];
          foreach (langs() as $l) $fill[$l] = ($w['desc'][$l] ?? '') !== '' ? 1 : 0;
        ?>
        <tr>
          <td class="num"><?= admin_num($i) ?></td>
          <td class="pic"><?= admin_thumb(project_cover($w, $grp), $w['domain']) ?></td>
          <td><b class="clamp"><?= $e(tr($w['desc'], $DEF)) ?></b>
              <span class="muted"><?= $e($w['domain']) ?><?= !empty($w['archived']) ? ' · <span class="pill grey">архив</span>' : '' ?></span></td>
          <td><span class="path" title="<?= $e('/portfolio/' . $grp['slug'] . '/' . $slug . '/') ?>">…/<?= $e($slug) ?>/</span></td>
          <td><?= admin_dot(($w['text'][$L] ?? '') !== '', 'текст страницы') ?></td>
          <td><?= admin_dot($hasSeo($w), 'свой заголовок для поиска') ?></td>
          <td><?= admin_lang_badges($fill, '/portfolio/' . $grp['slug'] . '/' . $slug . '/') ?></td>
          <td class="right"><div class="acts">
            <a class="btn sm" href="<?= $e(admin_url('portfolio', ['g' => $grp['slug'], 'p' => $slug])) ?>">Изменить</a>
            <?php foreach (['up' => '↑', 'down' => '↓'] as $dir => $arrow):
              $edge = $dir === 'up' ? $i === 0 : $i === $n - 1; ?>
              <form method="post" action="<?= $e(admin_url('portfolio')) ?>">
                <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
                <?= admin_ver_field('works.json') ?>
                <input type="hidden" name="do" value="move">
                <input type="hidden" name="dir" value="<?= $dir ?>">
                <input type="hidden" name="g" value="<?= $e($grp['slug']) ?>">
                <input type="hidden" name="p" value="<?= $e($slug) ?>">
                <button class="btn sm" type="submit" title="<?= $dir === 'up' ? 'Выше' : 'Ниже' ?>"<?= $edge ? ' disabled' : '' ?>><?= $arrow ?></button>
              </form>
            <?php endforeach; ?>
            <a class="btn sm" href="<?= $e(portfolio_url($grp['slug'], $slug, $DEF)) ?>" target="_blank" rel="noopener" title="Открыть страницу">↗</a>
          </div></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>

  <form method="post" action="<?= $e(admin_url('portfolio')) ?>" style="margin-top:26px"
        data-confirm="Удалить отрасль «<?= $e(tr($grp['name'], $DEF)) ?>» вместе с <?= $n ?> проектами? Их страницы перестанут открываться, восстановить будет нечем.">
    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <?= admin_ver_field('works.json') ?>
    <input type="hidden" name="do" value="del-group">
    <input type="hidden" name="g" value="<?= $e($grp['slug']) ?>">
    <button class="btn red sm" type="submit">Удалить отрасль вместе с проектами</button>
  </form>
<?php endif; ?>

<?php admin_foot(); ?>
