<?php
/* Портфолио: проекты и категории (отрасли), у каждого — своя страница на сайте.

   ПРОЕКТЫ И КАТЕГОРИИ — ОТДЕЛЬНО, как записи и рубрики в WordPress:
     ?section=portfolio                    все проекты одним списком
     ?section=portfolio&cat=logistika      те же, только одной категории (и порядок)
     ?section=portfolio&p=new              добавить проект
     ?section=portfolio&p=itas-az          проект: всё, что видно на его странице
     ?section=portfolio&view=cats          категории: список и «Добавить категорию»
     ?section=portfolio&view=drafts        черновики: проекты, скрытые с сайта
     ?section=portfolio&view=trash         корзина
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
   — удалённый проект сначала лежит в корзине: его можно восстановить,
     а насовсем он удаляется через PF_TRASH_DAYS дней (pf_trash_expire);
   — черновик виден только в панели, на сайте его нет (works_site()).

   ПОРЯДОК — ПО ДАТЕ ДОБАВЛЕНИЯ, новые первыми (works_by_date()). У старых
   проектов даты нет, их порядок по-прежнему задают стрелки.

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

/** Загруженный снимок для галереи проекта: проверка, уменьшение и WebP
    в images/uploads/gallery/<адрес проекта>/. Вернёт [путь, ошибка].

    Тип — по содержимому файла, а не по имени. Уменьшение — как у снимков
    из репозитория (tools/make-gallery.php): до 1000 px по ширине, у очень
    длинных — верх до 1600 px. Папка uploads — та, что деплой создаёт
    пустой и не перезаписывает: файлы панели не пропадут при выкладке. */
function pf_gallery_upload(array $f, string $slug): array
{
    $code = (int)($f['error'] ?? UPLOAD_ERR_NO_FILE);
    if ($code === UPLOAD_ERR_NO_FILE) return [null, null];
    $name = (string)($f['name'] ?? 'файл');
    if ($code === UPLOAD_ERR_INI_SIZE || $code === UPLOAD_ERR_FORM_SIZE) {
        return [null, '«' . $name . '» больше, чем принимает сервер'];
    }
    if ($code !== UPLOAD_ERR_OK || !is_uploaded_file((string)($f['tmp_name'] ?? ''))) {
        return [null, '«' . $name . '» не дошёл целиком'];
    }
    $info = @getimagesize($f['tmp_name']);
    $load = [IMAGETYPE_JPEG => 'imagecreatefromjpeg', IMAGETYPE_PNG => 'imagecreatefrompng',
             IMAGETYPE_WEBP => 'imagecreatefromwebp'][$info[2] ?? 0] ?? null;
    if ($load === null || !function_exists($load) || !function_exists('imagewebp')) {
        return [null, '«' . $name . '» — не JPEG, PNG или WebP'];
    }
    [$w, $h] = [(int)$info[0], (int)$info[1]];
    if ($w < 200 || $h < 120 || $w * $h > 60000000) {
        return [null, '«' . $name . '»: размер ' . $w . '×' . $h . ' не подходит для галереи'];
    }
    @ini_set('memory_limit', '512M');          // полностраничный снимок — десятки мегабайт в памяти
    $im = @$load($f['tmp_name']);
    if (!$im) return [null, '«' . $name . '» не читается как картинка'];
    $k  = min(1, 1000 / $w);
    $nw = (int)round($w * $k);
    $nh = (int)min(1600, round($h * $k));
    $out = imagecreatetruecolor($nw, $nh);
    imagefill($out, 0, 0, imagecolorallocate($out, 255, 255, 255));   // прозрачное в PNG — на белом
    imagecopyresampled($out, $im, 0, 0, 0, 0, $nw, $nh, $w, (int)round($nh / $k));
    $dir = ADMIN_WEBROOT . '/images/uploads/gallery/' . $slug;
    if (!is_dir($dir) && !@mkdir($dir, 0755, true) && !is_dir($dir)) {
        return [null, 'папка images/uploads/gallery недоступна на запись'];
    }
    $file = date('Ymd-His') . '-' . bin2hex(random_bytes(3)) . '.webp';
    if (!@imagewebp($out, $dir . '/' . $file, 80)) return [null, '«' . $name . '» не записался на диск'];
    return ['/images/uploads/gallery/' . $slug . '/' . $file, null];
}

/* Сколько дней проект лежит в корзине, прежде чем удалиться насовсем. */
const PF_TRASH_DAYS = 30;

/** Удалить проект насовсем: его домен и прежние адреса — в список удалённых
    категории (иначе проект из репозитория вернулся бы сам, см.
    works_merge_new()), снимки галереи, загруженные панелью, — в $files:
    их стирают с диска после записи. */
function pf_forget(array &$g, array $w, array &$files): void
{
    $gone = (array)($g['gone'] ?? []);
    foreach (array_merge([(string)($w['domain'] ?? '')], (array)($w['aliases'] ?? [])) as $d) {
        if ($d !== '' && !in_array($d, $gone, true)) $gone[] = $d;
    }
    $g['gone'] = $gone;
    foreach ((array)($w['gallery'] ?? []) as $gp) {
        if (is_string($gp) && strpos($gp, '/images/uploads/gallery/') === 0) $files[] = $gp;
    }
}

/** Срок в корзине вышел: пометке 'trashed' больше PF_TRASH_DAYS дней. Дата не
    читается — срок не вышел: насовсем удаляем только то, о чём точно
    известно, что пора. */
function pf_trash_expired(array $w, ?int $now = null): bool
{
    if (empty($w['trashed'])) return false;
    $at = strtotime((string)$w['trashed']);
    return $at !== false && $at <= ($now ?? time()) - PF_TRASH_DAYS * 86400;
}

/** Корзина: проекты, пролежавшие там дольше PF_TRASH_DAYS, удаляются
    насовсем. Вызывается при каждом сохранении портфолио в панели —
    отдельного расписания на хостинге нет. Вернёт, сколько удалено. */
function pf_trash_expire(array &$groups, array &$files): int
{
    $n = 0;
    foreach (array_keys($groups) as $gi) {
        $keep = [];
        foreach ((array)($groups[$gi]['projects'] ?? []) as $w) {
            if (!pf_trash_expired($w)) { $keep[] = $w; continue; }
            pf_forget($groups[$gi], $w, $files);
            $n++;
        }
        $groups[$gi]['projects'] = $keep;
    }
    return $n;
}

/** Стереть загруженные панелью снимки удалённых насовсем проектов — кроме
    тех, что ещё стоят у какого-нибудь проекта (и в корзине тоже): в галерее
    или обложкой (её можно вписать путём к любому снимку). Пути сравниваем
    приведёнными, как в разделе «Изображения»: /images//x и /images/./x —
    тот же файл. */
function pf_unlink_unused(array $files, array $groups): void
{
    if (!$files) return;
    $norm = static fn(string $p): string => (string)preg_replace('~/(?:\./)+~', '/', (string)preg_replace('~/{2,}~', '/', $p));
    $used = [];
    foreach ($groups as $g) {
        foreach ((array)($g['projects'] ?? []) as $w) {
            foreach ((array)($w['gallery'] ?? []) as $gp) $used[$norm((string)$gp)] = true;
            if (!empty($w['image'])) $used[$norm((string)$w['image'])] = true;
        }
    }
    foreach (array_unique($files) as $gp) {
        $gp = $norm((string)$gp);
        if (isset($used[$gp]) || strpos($gp, '..') !== false || strpos($gp, '/images/uploads/gallery/') !== 0) continue;
        if (is_file(ADMIN_WEBROOT . $gp)) @unlink(ADMIN_WEBROOT . $gp);
    }
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
        /* Массовые действия возвращают в тот же список: все, категория или черновики. */
        case 'bulk':         $back = admin_url('portfolio', array_filter([
                                 'cat'  => post_slug($_POST['from_cat'] ?? ''),
                                 'view' => post_one($_POST['from_view'] ?? '') === 'drafts' ? 'drafts' : '']));
                             break;
        case 'trash':        $back = admin_url('portfolio', ['view' => 'trash']); break;
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
        foreach (['name', 'slug', 'desc', 'intro', 'domain', 'move_to', 'image', 'archived', 'branding', 'draft', 'added',
                  'text', 'seo_title', 'seo_desc'] as $k) {
            if (isset($_POST[$k]) && is_string($_POST[$k])) $f[$k] = post_one($_POST[$k], true);
        }
        /* Галерея: порядок и отметки «Удалить». Загруженные файлы в черновик
           не попадут — их выбирают заново. */
        foreach (['gallery_list', 'gallery_del'] as $k) {
            if (is_array($_POST[$k] ?? null)) {
                $f[$k] = array_values(array_filter(array_map(static fn($x) => is_string($x) ? post_image($x) : null,
                    array_slice($_POST[$k], 0, 200))));
            }
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

    /* Новые снимки галереи — до записи и без замка: уменьшение большого
       снимка занимает время. Не сохранится проект — загруженное удалим. */
    $galNew = $galNotes = $galDrop = [];
    if (($what === 'save-project' || $what === 'add-project') && isset($_POST['gallery_form'])
        && is_array($_FILES['gallery_new']['name'] ?? null)) {
        $up = $_FILES['gallery_new'];
        $gslug = project_slug(post_domain($_POST['domain'] ?? '')) ?: ($ps !== '' ? $ps : 'proekt');
        foreach ($up['name'] as $i => $nm) {
            [$path, $why] = pf_gallery_upload([
                'name' => $nm, 'tmp_name' => $up['tmp_name'][$i] ?? '', 'error' => $up['error'][$i] ?? UPLOAD_ERR_NO_FILE,
            ], $gslug);
            if ($path !== null) $galNew[] = $path;
            if ($why !== null) $galNotes[] = $why;
        }
    }

    $purge = [];   // снимки проектов, удалённых насовсем, — стереть после записи
    $ok = Store::update('works.json', function (array $groups) use ($what, $gs, $ps, $L, $galNew, &$galDrop, &$purge, &$err, &$msg, &$go) {
        /* Хранилище пустое — начинаем с данных репозитория. Иначе добавляем
           проекты, заведённые в репозитории позже, — как их видит сайт. */
        $groups = $groups ? works_merge_new($groups) : works_canon();
        pf_trash_expire($groups, $purge);

        /* Дата правки — для карты сайта: поисковику сообщаем, что страница
           менялась, только когда менялась именно она. */
        $today = date('Y-m-d');

        /* ------------------------- отмеченные в списке: черновик, сайт, корзина */
        if ($what === 'bulk') {
            $act = post_one($_POST['act'] ?? '');
            $sel = [];
            foreach ((array)($_POST['sel'] ?? []) as $x) if (is_string($x) && ($x = post_slug($x)) !== '') $sel[$x] = true;
            if (!in_array($act, ['draft', 'publish', 'trash'], true)) { $err = 'Выберите, что сделать с отмеченными.'; return null; }
            if (!$sel) { $err = 'Отметьте хотя бы один проект.'; return null; }
            $done = [];
            foreach (array_keys($sel) as $s) {
                [$gi, $pi] = pf_locate($groups, '', $s);
                if ($gi === null || !empty($groups[$gi]['projects'][$pi]['trashed'])) continue;
                $w = $groups[$gi]['projects'][$pi];
                if ($act === 'trash') {
                    /* Проект остаётся на своём месте в списке, только с пометкой:
                       восстановленный, он встанет туда же, где стоял. */
                    $groups[$gi]['projects'][$pi]['trashed'] = date('Y-m-d H:i:s');
                } elseif ($act === 'draft') {
                    $groups[$gi]['projects'][$pi]['draft'] = true;
                } else {
                    unset($groups[$gi]['projects'][$pi]['draft']);
                }
                $groups[$gi]['updated'] = $today;
                $done[] = $w['domain'];
            }
            if (!$done) { $err = 'Отмеченных проектов уже нет — возможно, их изменили из другой вкладки.'; return null; }
            $list = implode(', ', $done);
            $msg = [
                'draft'   => 'В черновики (' . count($done) . '): ' . $list . '. На сайте их больше не видно, в панели они остались.',
                'publish' => 'Опубликовано (' . count($done) . '): ' . $list . '.',
                'trash'   => 'В корзину (' . count($done) . '): ' . $list . '. Через ' . PF_TRASH_DAYS
                           . ' дней они удалятся сами, до тех пор их можно восстановить.',
            ][$act];
            return $groups;
        }

        /* ------------------------------------- корзина: вернуть или удалить */
        if ($what === 'trash') {
            $act = post_one($_POST['act'] ?? '');
            $sel = [];
            foreach ((array)($_POST['sel'] ?? []) as $x) if (is_string($x) && ($x = post_slug($x)) !== '') $sel[$x] = true;
            if (!in_array($act, ['restore', 'purge'], true)) { $err = 'Выберите, что сделать с отмеченными.'; return null; }
            if (!$sel) { $err = 'Отметьте хотя бы один проект в корзине.'; return null; }
            $done = [];
            foreach (array_keys($sel) as $s) {
                [$gi, $pi] = pf_locate($groups, '', $s);
                if ($gi === null || empty($groups[$gi]['projects'][$pi]['trashed'])) continue;
                $w = $groups[$gi]['projects'][$pi];
                if ($act === 'restore') {
                    unset($groups[$gi]['projects'][$pi]['trashed']);
                } else {
                    array_splice($groups[$gi]['projects'], $pi, 1);
                    pf_forget($groups[$gi], $w, $purge);
                }
                $groups[$gi]['updated'] = $today;
                $done[] = $w['domain'];
            }
            if (!$done) { $err = 'Отмеченного в корзине уже нет — возможно, его изменили из другой вкладки.'; return null; }
            $msg = ($act === 'restore' ? 'Восстановлено (' : 'Удалено насовсем (') . count($done) . '): ' . implode(', ', $done) . '.';
            return $groups;
        }

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
            /* Считаем видимые: проекты из корзины переезжают вместе с ними
               (или в соседнюю категорию, если видимых нет), а не теряются. */
            $n = count(array_filter((array)$groups[$gi]['projects'], static fn($w) => empty($w['trashed'])));
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
            /* Список удалённых и проекты из корзины не теряем — переносим
               в соседнюю. См. works_merge_new(). */
            $ki = $ti ?? ($gi === 0 ? 1 : 0);
            if ($n === 0) foreach ((array)$groups[$gi]['projects'] as $w) $groups[$ki]['projects'][] = $w;
            if (!empty($groups[$gi]['gone'])) {
                $groups[$ki]['gone'] = array_values(array_unique(array_merge(
                    (array)($groups[$ki]['gone'] ?? []), (array)$groups[$gi]['gone'])));
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
        if ($pi !== null && !empty($groups[$gi]['projects'][$pi]['trashed'])) {
            $err = 'Проект в корзине. Сначала восстановите его.';
            return null;
        }

        if ($what === 'move') {
            if ($pi === null) { $err = 'Проект не найден.'; return null; }
            /* Проекты с датой добавления стоят по дате, стрелки на них не
               действуют: меняемся местами с ближайшим проектом без даты
               (и не из корзины — его в списке не видно). */
            $step = post_one($_POST['dir'] ?? '') === 'up' ? -1 : 1;
            $list = &$groups[$gi]['projects'];
            for ($to = $pi + $step; isset($list[$to]) && (!empty($list[$to]['added']) || !empty($list[$to]['trashed'])); $to += $step);
            if (isset($list[$to]) && empty($list[$pi]['added'])) [$list[$pi], $list[$to]] = [$list[$to], $list[$pi]];
            unset($list);
            $groups[$gi]['updated'] = $today;
            $msg = 'Порядок изменён — так проекты идут и на сайте.';
            $go  = admin_url('portfolio', ['cat' => $groups[$gi]['slug']]);
            return $groups;
        }

        /* ---------------------------------------------- удалить проект */
        if ($what === 'del-project') {
            if ($pi === null) { $err = 'Проект не найден.'; return null; }
            /* Не насовсем, а в корзину: оттуда проект можно вернуть, а через
               PF_TRASH_DAYS дней он удалится сам (pf_trash_expire). */
            $groups[$gi]['projects'][$pi]['trashed'] = date('Y-m-d H:i:s');
            $dom = $groups[$gi]['projects'][$pi]['domain'];
            $groups[$gi]['updated'] = $today;
            $msg = 'Проект ' . $dom . ' перемещён в корзину, на сайте его больше нет. Через ' . PF_TRASH_DAYS
                 . ' дней он удалится сам; до тех пор его можно восстановить.';
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
                   и два проекта с одним адресом открывали бы одну страницу.
                   Проект в корзине адрес тоже занимает: его могут вернуть. */
                [$xg, $xp] = pf_locate($groups, '', $slug);
                $err = $xg !== null && !empty($groups[$xg]['projects'][$xp]['trashed'])
                    ? 'Проект с адресом /' . $slug . '/ лежит в корзине. Восстановите его или удалите насовсем.'
                    : 'Проект с адресом /' . $slug . '/ уже есть в категории «' . $taken[$slug] . '».';
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

            /* Галерея: снимки в том порядке, в каком они стоят в форме, без
               отмеченных «Удалить», плюс только что загруженные — в конец.
               Блока галереи в форме нет — галерею не трогаем. */
            if (isset($_POST['gallery_form'])) {
                $del = [];
                foreach ((array)($_POST['gallery_del'] ?? []) as $x) if (is_string($x)) $del[$x] = true;
                $gal = [];
                foreach ((array)($_POST['gallery_list'] ?? []) as $x) {
                    if (!is_string($x)) continue;
                    if (isset($del[$x])) { $galDrop[] = $x; continue; }
                    $gp = post_image($x);
                    if ($gp !== null && is_file(ADMIN_WEBROOT . $gp) && !in_array($gp, $gal, true)) $gal[] = $gp;
                }
                $w['gallery'] = array_merge($gal, $galNew);
            }

            $w['domain']   = $dom;
            $w['image']    = $img;
            $w['archived'] = !empty($_POST['archived']);
            /* Логотип и брендбук — только там, где их правда делала студия:
               отмечает владелец, сама панель этого не решает. */
            $w['branding'] = !empty($_POST['branding']);
            if (!empty($_POST['draft'])) $w['draft'] = true; else unset($w['draft']);
            /* Дата добавления — по ней проекты идут на сайте, новые первыми.
               У нового проекта сегодняшняя дата — ставим и время: два
               проекта, добавленные в один день, тоже встанут новым вперёд.
               Дата не поменялась — оставляем как была, вместе со временем. */
            $add = post_one($_POST['added'] ?? '');
            $old = (string)($w['added'] ?? '');
            if ($add !== '' && (!preg_match('~^(\d{4})-(\d{2})-(\d{2})$~', $add, $dm) || !checkdate((int)$dm[2], (int)$dm[3], (int)$dm[1]))) {
                $err = 'Дата добавления записана неверно — нужен день, месяц и год.';
                return null;
            }
            if ($what === 'add-project' && $add === $today) {
                $w['added'] = date('Y-m-d H:i:s');
            } elseif ($add === '') {
                unset($w['added']);
            } elseif ($add !== substr($old, 0, 10)) {
                $w['added'] = $add;
            }
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

    if ($err !== null || !$ok) {
        /* Проект не сохранился — только что загруженные снимки не нужны. */
        foreach ($galNew as $gp) @unlink(ADMIN_WEBROOT . $gp);
    }
    if ($err !== null) {
        $keep();
        admin_flash('НЕ СОХРАНЕНО: ' . $err, 'err');
        admin_go($back);
    }
    if ($ok) {
        /* Удалённые из галереи снимки, загруженные через панель, стираем
           с диска. Снимки из репозитория (images/works/gallery) не трогаем:
           их вернёт следующая выкладка, а в галерею — только сама панель. */
        foreach ($galDrop as $gp) {
            if (strpos($gp, '/images/uploads/gallery/') === 0 && strpos($gp, '..') === false && is_file(ADMIN_WEBROOT . $gp)) {
                @unlink(ADMIN_WEBROOT . $gp);
            }
        }
        if ($galNew) $msg .= ' Добавлено снимков в галерею: ' . count($galNew) . '.';
        if ($galDrop) $msg .= ' Убрано из галереи: ' . count($galDrop) . '.';
        admin_note_edit('portfolio:' . $gs);
        pf_unlink_unused($purge, (array)(Store::read('works.json') ?? []));
        if ($galNotes) {
            admin_flash($msg . ' Не приняты: ' . implode('; ', $galNotes) . '.', 'warn');
        } else {
            admin_flash($msg);
        }
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
$view = in_array($_GET['view'] ?? '', ['cats', 'drafts', 'trash'], true) ? $_GET['view'] : '';

/* Корзина одним списком: [категория, проект]. Удалённые последними — сверху.
   У кого срок вышел, здесь уже не показываем, а из файла они уходят при
   ближайшем сохранении портфолио (pf_trash_expire в каждой записи).
   Просмотр страницы файл не меняет: иначе форма, открытая в соседней
   вкладке, сочла бы, что портфолио правили, и не сохранилась бы. */
$trash = [];
foreach (works_canon(true) as $g) {
    foreach ($g['projects'] as $w) {
        if (!empty($w['trashed']) && !pf_trash_expired($w)) $trash[] = [$g, $w];
    }
}
usort($trash, static fn($a, $b) => strcmp((string)$b[1]['trashed'], (string)$a[1]['trashed']));
$drafts = 0;
foreach ($groups as $g) foreach ($g['projects'] as $w) if (!empty($w['draft'])) $drafts++;

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
        /* Проект из корзины не правится: сначала его восстанавливают. */
        if (pf_locate(works_canon(true), '', $ps)[0] !== null) {
            admin_flash('Проект «' . $ps . '» в корзине. Восстановите его, чтобы править.', 'warn');
            admin_go(admin_url('portfolio', ['view' => 'trash']));
        }
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

/* Полоска над списками: все, категории, черновики, корзина. */
$chips = static function () use ($e, $groups, $cat, $view, $total, $drafts, $trash, $txt): void { ?>
    <nav class="chips" aria-label="Категории">
      <?php $on = $cat === '' && $view === ''; ?>
      <a href="<?= $e(admin_url('portfolio')) ?>"<?= $on ? ' class="on" aria-current="true"' : '' ?>>Все <span><?= $total ?></span></a>
      <?php foreach ($groups as $g): $on = $cat === $g['slug'] && $view === ''; ?>
        <a href="<?= $e(admin_url('portfolio', ['cat' => $g['slug']])) ?>"<?= $on ? ' class="on" aria-current="true"' : '' ?>><?= $e($txt($g['name'])) ?> <span><?= count($g['projects']) ?></span></a>
      <?php endforeach; ?>
      <?php if ($drafts > 0 || $view === 'drafts'): ?>
        <a href="<?= $e(admin_url('portfolio', ['view' => 'drafts'])) ?>"<?= $view === 'drafts' ? ' class="on" aria-current="true"' : '' ?>>Черновики <span><?= $drafts ?></span></a>
      <?php endif; ?>
      <a href="<?= $e(admin_url('portfolio', ['view' => 'trash'])) ?>"<?= $view === 'trash' ? ' class="on" aria-current="true"' : '' ?>>Корзина <span><?= count($trash) ?></span></a>
    </nav>
<?php };

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
        $w['branding'] = !empty($d['branding']);
        if (!empty($d['draft'])) $w['draft'] = true; else unset($w['draft']);
        if (array_key_exists('added', $d)) $w['added'] = $d['added'];
        $w['desc'][$L] = $d['desc'] ?? '';
        $w['text'][$L] = $d['text'] ?? '';
        $w['seo'][$L]  = ['title' => $d['seo_title'] ?? '', 'description' => $d['seo_desc'] ?? ''];
        if (isset($d['gallery_list'])) {
            $w['gallery'] = array_values(array_filter((array)$d['gallery_list'], static fn($gp) => is_file(ADMIN_WEBROOT . $gp)));
        }
        $moveTo = $d['move_to'] ?? $moveTo;
    }
    $galDel = array_flip((array)($d['gallery_del'] ?? []));
?>
  <p style="margin:0 0 16px;display:flex;gap:8px;flex-wrap:wrap">
    <a class="btn ghost sm" href="<?= $e(admin_url('portfolio')) ?>">← Все проекты</a>
    <?php if ($grp !== null): ?>
      <a class="btn ghost sm" href="<?= $e(admin_url('portfolio', ['cat' => $grp['slug']])) ?>">Проекты категории «<?= $e($txt($grp['name'])) ?>»</a>
    <?php endif; ?>
    <?php if (!$isNew && empty($prj['draft'])): ?>
      <a class="btn sm" style="margin-left:auto" href="<?= $e(portfolio_url($grp['slug'], $slug, $L)) ?>" target="_blank" rel="noopener">Посмотреть проект на сайте ↗</a>
    <?php elseif (!$isNew): ?>
      <span class="pill grey" style="margin-left:auto;align-self:center">черновик — на сайте не показывается</span>
    <?php endif; ?>
  </p>

  <form method="post" action="<?= $e(admin_url('portfolio')) ?>" enctype="multipart/form-data" data-guard="1">
    <?php $hidden($isNew ? 'add-project' : 'save-project', ['g' => $grp['slug'] ?? '', 'p' => $slug, 'lang' => $L]); ?>

    <div class="panel">
      <h3><?= $isNew ? 'Новый проект' : $inL($w['desc']) ?>
        <span class="lg full" style="vertical-align:3px;margin-left:6px"><?= $e(strtoupper($L)) ?></span></h3>
      <?php if (!$isNew && !empty($prj['draft'])): ?>
        <p class="muted" style="margin-top:6px">Черновик — страницы на сайте нет. Снимите галочку «Черновик»
          внизу и сохраните, чтобы опубликовать.</p>
      <?php elseif (!$isNew): ?>
        <p class="muted" style="margin-top:6px">Страница:
          <a class="path" href="<?= $e(portfolio_url($grp['slug'], $slug, $L)) ?>" target="_blank" rel="noopener"
             title="Открыть страницу проекта на сайте"><?= $e(portfolio_url($grp['slug'], $slug, $L)) ?> ↗</a>
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

      <?php /* Галерея на странице проекта: порядок — стрелками (admin.js),
               «Удалить» убирает снимок при сохранении, новые — загрузкой. */
            $galNow = (array)($w['gallery'] ?? []); ?>
      <input type="hidden" name="gallery_form" value="1">
      <label>Галерея на странице проекта <span class="hint">порядок — стрелками, лишнее — «Удалить»; всё применится по «Сохранить»</span></label>
      <?php if ($galNow): ?>
        <div class="gal-grid">
          <?php foreach ($galNow as $gp): ?>
            <?php $off = isset($galDel[$gp]); ?>
            <figure class="gal-item<?= $off ? ' off' : '' ?>">
              <a href="<?= $e($gp) ?>" target="_blank" rel="noopener" title="Открыть снимок целиком"><img src="<?= $e($gp) ?>" alt="" loading="lazy"></a>
              <input type="hidden" name="gallery_list[]" value="<?= $e($gp) ?>">
              <div class="gal-acts">
                <button type="button" class="btn sm" data-gal-move="-1" title="Левее" aria-label="Переставить левее">←</button>
                <button type="button" class="btn sm" data-gal-move="1" title="Правее" aria-label="Переставить правее">→</button>
                <label class="gal-del"><input type="checkbox" name="gallery_del[]" value="<?= $e($gp) ?>"<?= $off ? ' checked' : '' ?>> Удалить</label>
              </div>
            </figure>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p class="muted">Снимков пока нет — на странице проекта галереи не будет.</p>
      <?php endif; ?>
      <label for="pf-gal-new">Добавить фото <span class="hint">JPEG, PNG или WebP, можно выбрать несколько; <?= function_exists('admin_upload_cap') && admin_upload_cap() > 0 ? 'до ' . $e(admin_size(admin_upload_cap())) . ' за раз' : '' ?></span></label>
      <input type="file" id="pf-gal-new" name="gallery_new[]" accept="image/jpeg,image/png,image/webp" multiple>
      <p class="muted" style="margin-top:6px">Большие снимки панель уменьшит сама: до 1000 px по ширине, у полностраничных — верх страницы.</p>

      <?php /* У нового проекта — сегодня; у старых без даты поле пустое. */
            $addedNow = $isNew && !isset($w['added']) ? date('Y-m-d') : substr((string)($w['added'] ?? ''), 0, 10); ?>
      <label for="pf-added">Добавлен в портфолио <span class="hint">по этой дате проекты идут на сайте — новые первыми;
        пусто — проект стоит после всех проектов с датой, в порядке стрелок</span></label>
      <input type="date" id="pf-added" name="added" value="<?= $e($addedNow) ?>" style="max-width:220px">

      <label class="check">
        <input type="checkbox" name="draft" value="1"<?= !empty($w['draft']) ? ' checked' : '' ?>>
        Черновик — проект виден только в панели: на сайте нет ни карточки, ни страницы
      </label>
      <label class="check">
        <input type="checkbox" name="archived" value="1"<?= !empty($w['archived']) ? ' checked' : '' ?>>
        Архив — сайт не открывается: ссылку не ставим, проект остаётся в портфолио
      </label>
      <label class="check">
        <input type="checkbox" name="branding" value="1"<?= !empty($w['branding']) ? ' checked' : '' ?>>
        Логотип и брендбук сделала студия — на странице проекта появится строка об этом (ru, az, en)
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
      <?php if (!$isNew && empty($prj['draft'])): ?>
        <a class="btn ghost" href="<?= $e(portfolio_url($grp['slug'], $slug, $L)) ?>" target="_blank" rel="noopener">Открыть страницу ↗</a>
      <?php endif; ?>
    </div>
  </form>

  <?php if (!$isNew): ?>
  <form method="post" action="<?= $e(admin_url('portfolio')) ?>" style="margin-top:26px"
        data-confirm="Переместить проект <?= $e($w['domain']) ?> в корзину? На сайте его не будет; восстановить можно в течение <?= PF_TRASH_DAYS ?> дней.">
    <?php $hidden('del-project', ['g' => $grp['slug'], 'p' => $slug]); ?>
    <button class="btn red sm" type="submit">В корзину</button>
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
        <a class="path" href="<?= $e(portfolio_url($grp['slug'], null, $L)) ?>" target="_blank" rel="noopener"
           title="Открыть страницу категории на сайте"><?= $e(portfolio_url($grp['slug'], null, $L)) ?> ↗</a>
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
/* ============================================================ 4. КОРЗИНА */
elseif ($view === 'trash'):
?>
  <div class="panel">
    <?php admin_list_head(count($trash), 'В корзине'); ?>
    <?php $chips(); ?>
    <p class="muted">На сайте проектов из корзины нет. Через <?= PF_TRASH_DAYS ?> дней после удаления проект
       удаляется насовсем — вместе со снимками галереи, загруженными в панели. До тех пор его можно восстановить:
       он вернётся на своё место в своей категории.</p>

    <?php if ($trash): ?>
      <form id="pf-trash" method="post" action="<?= $e(admin_url('portfolio')) ?>"
            data-confirm-act="purge" data-confirm-text="Удалить насовсем отмеченные проекты ({n})? Вернуть их будет нельзя.">
        <?php $hidden('trash'); ?>
        <div class="bulk">
          <select name="act" aria-label="Что сделать с отмеченными">
            <option value="restore">Восстановить</option>
            <option value="purge">Удалить насовсем</option>
          </select>
          <button class="btn sm" type="submit">Применить к отмеченным</button>
          <span class="muted" data-check-count="pf-trash"></span>
        </div>
      </form>

      <div class="tablewrap">
        <table class="list">
          <tr>
            <th class="chk"><input type="checkbox" data-check-all="pf-trash" autocomplete="off" aria-label="Отметить все"></th>
            <th class="pic">Снимок</th><th>Проект</th><th>Категория</th><th>Удалён</th><th>Удалится насовсем</th><th class="right"></th>
          </tr>
          <?php foreach ($trash as [$g, $w]):
            $at   = strtotime((string)$w['trashed']) ?: time();
            $end  = $at + PF_TRASH_DAYS * 86400;
            $left = max(0, (int)ceil(($end - time()) / 86400));
            $slug = project_slug($w['domain']);
          ?>
          <tr>
            <td class="chk"><input type="checkbox" name="sel[]" value="<?= $e($slug) ?>" form="pf-trash" autocomplete="off" aria-label="Отметить <?= $e($w['domain']) ?>"></td>
            <td class="pic"><?= admin_thumb(project_cover($w, $g), $w['domain']) ?></td>
            <td><b class="clamp"><?= $inL((array)($w['desc'] ?? [])) ?></b>
                <span class="muted"><?= $e($w['domain']) ?></span></td>
            <td><?= $e($txt($g['name'])) ?></td>
            <td><?= $e(date('d.m.Y H:i', $at)) ?></td>
            <td><?= $e(date('d.m.Y', $end)) ?> <span class="muted">· осталось <?= $left ?> дн.</span></td>
            <td class="right"><div class="acts">
              <form method="post" action="<?= $e(admin_url('portfolio')) ?>">
                <?php $hidden('trash', ['act' => 'restore', 'sel[]' => $slug]); ?>
                <button class="btn sm" type="submit">Восстановить</button>
              </form>
              <form method="post" action="<?= $e(admin_url('portfolio')) ?>"
                    data-confirm="Удалить <?= $e($w['domain']) ?> насовсем? Вернуть будет нельзя.">
                <?php $hidden('trash', ['act' => 'purge', 'sel[]' => $slug]); ?>
                <button class="btn x sm" type="submit">Удалить насовсем</button>
              </form>
            </div></td>
          </tr>
          <?php endforeach; ?>
        </table>
      </div>
    <?php else: ?>
      <p class="muted" style="margin-top:12px">Корзина пуста.</p>
    <?php endif; ?>
  </div>

<?php
/* ===================================================== 5. ВСЕ ПРОЕКТЫ */
else:
    /* Строки списка: все проекты, одной категории или черновики — в том
       порядке, в каком они идут на сайте: по дате добавления, новые первыми.
       Внутри категории так уже упорядочил works_canon(), «все» — через все
       категории, как на странице портфолио. */
    $rows = [];
    foreach ($groups as $g) {
        if ($cat !== '' && $g['slug'] !== $cat) continue;
        foreach ($g['projects'] as $w) {
            if ($view === 'drafts' && empty($w['draft'])) continue;
            $rows[] = [$g, $w];
        }
    }
    if ($cat === '') $rows = works_by_date($rows, static fn(array $x): array => $x[1]);

    /* Стрелки — только внутри категории и только у проектов без даты:
       проекты с датой стоят по ней. Крайние считаем среди проектов без даты. */
    $arrows  = $cat !== '' && $view === '';
    $undated = array_keys(array_filter($rows, static fn(array $r): bool => empty($r[1]['added'])));
    $firstU  = $undated ? min($undated) : null;
    $lastU   = $undated ? max($undated) : null;
?>
  <div class="panel">
    <?php admin_list_head(count($rows), $view === 'drafts' ? 'Черновиков' : ($cat !== '' ? 'Проектов в категории' : 'Проектов'),
        'Добавить проект', admin_url('portfolio', array_filter(['p' => 'new', 'cat' => $cat]))); ?>
    <?php $chips(); ?>

    <div class="row" style="align-items:end;margin-top:6px">
      <div>
        <label for="texts-filter">Поиск по названию и домену</label>
        <input type="search" id="texts-filter" placeholder="например, itas или перевозки" autocomplete="off">
      </div>
      <div><p class="muted" id="texts-count" aria-live="polite" style="margin:0 0 10px"></p></div>
    </div>

    <p class="muted">Проекты идут по дате добавления — новые первыми. У проектов без даты порядок
      меняется стрелками внутри категории<?= $arrows ? '' : ' — откройте её выше' ?>.
      <?= $view === 'drafts' ? 'Черновики видны только здесь: на сайте их нет.' : '' ?></p>

    <?php /* Отметки строк привязаны к этой форме атрибутом form: в строках
             есть свои формы (стрелки), а формы не вкладываются друг в друга. */ ?>
    <form id="pf-bulk" method="post" action="<?= $e(admin_url('portfolio')) ?>"
          data-confirm-act="trash" data-confirm-text="Переместить в корзину отмеченные проекты ({n})? На сайте их не будет; восстановить можно в течение <?= PF_TRASH_DAYS ?> дней.">
      <?php $hidden('bulk', ['from_cat' => $cat, 'from_view' => $view]); ?>
      <div class="bulk">
        <select name="act" aria-label="Что сделать с отмеченными" required>
          <option value="">Действие с отмеченными…</option>
          <option value="draft">В черновики (скрыть с сайта)</option>
          <option value="publish">Опубликовать</option>
          <option value="trash">В корзину</option>
        </select>
        <button class="btn sm" type="submit">Применить</button>
        <span class="muted" data-check-count="pf-bulk"></span>
      </div>
    </form>

    <div class="tablewrap">
      <table class="list">
        <tr>
          <th class="chk"><input type="checkbox" data-check-all="pf-bulk" autocomplete="off" aria-label="Отметить все"></th>
          <th class="num">№</th><th class="pic">Снимок</th><th>Проект</th><th>Категория</th>
          <th>Адрес страницы</th><th>Текст</th><th>SEO</th><th>Языки</th><th class="right"></th>
        </tr>
        <?php foreach ($rows as $i => [$g, $w]):
          $slug  = project_slug($w['domain']);
          $draft = !empty($w['draft']);
          $fill  = [];
          foreach (langs() as $l) $fill[$l] = ($w['desc'][$l] ?? '') !== '' ? 1 : 0;
          $hay   = mb_strtolower($txt($w['desc']) . ' ' . tr($w['desc'], $DEF) . ' ' . $w['domain'] . ' ' . $txt($g['name']));
          $added = (string)($w['added'] ?? '');
          $ts    = $added !== '' ? strtotime($added) : false;
        ?>
        <tr data-text-row="<?= $e($hay) ?>"<?= $draft ? ' class="is-draft"' : '' ?>>
          <td class="chk"><input type="checkbox" name="sel[]" value="<?= $e($slug) ?>" form="pf-bulk" autocomplete="off" aria-label="Отметить <?= $e($w['domain']) ?>"></td>
          <td class="num"><?= admin_num($i) ?></td>
          <td class="pic"><?= admin_thumb(project_cover($w, $g), $w['domain']) ?></td>
          <td><a href="<?= $e(admin_url('portfolio', ['p' => $slug])) ?>"><b class="clamp"><?= $inL($w['desc']) ?></b></a>
              <span class="muted"><?= $e($w['domain']) ?><?= $ts ? ' · добавлен ' . $e(date('d.m.Y', $ts)) : '' ?><?= $draft ? ' · <span class="pill grey">черновик</span>' : '' ?><?= !empty($w['archived']) ? ' · <span class="pill grey">архив</span>' : '' ?></span></td>
          <td><a href="<?= $e(admin_url('portfolio', ['cat' => $g['slug']])) ?>"><?= $e($txt($g['name'])) ?></a></td>
          <td><?php if ($draft): ?><span class="path muted" title="Черновик: на сайте страницы нет">…/<?= $e($slug) ?>/</span>
              <?php else: ?><a class="path" href="<?= $e(portfolio_url($g['slug'], $slug, $L)) ?>" target="_blank" rel="noopener"
                 title="Открыть страницу проекта на сайте: <?= $e(portfolio_url($g['slug'], $slug, $L)) ?>">…/<?= $e($slug) ?>/ ↗</a><?php endif; ?></td>
          <td><?= admin_dot(($w['text'][$L] ?? '') !== '', 'текст страницы') ?></td>
          <td><?= admin_dot($hasSeo($w), 'свой заголовок для поиска') ?></td>
          <td><?= admin_lang_badges($fill, $draft ? null : '/portfolio/' . $g['slug'] . '/' . $slug . '/') ?></td>
          <td class="right"><div class="acts">
            <a class="btn sm" href="<?= $e(admin_url('portfolio', ['p' => $slug])) ?>">Изменить</a>
            <?php if ($arrows && $added === ''): foreach (['up' => '↑', 'down' => '↓'] as $dir => $arrow):
              $edge = $dir === 'up' ? $i === $firstU : $i === $lastU; ?>
              <form method="post" action="<?= $e(admin_url('portfolio')) ?>">
                <?php $hidden('move', ['dir' => $dir, 'g' => $g['slug'], 'p' => $slug]); ?>
                <button class="btn sm" type="submit" title="<?= $dir === 'up' ? 'Выше' : 'Ниже' ?>"<?= $edge ? ' disabled' : '' ?>><?= $arrow ?></button>
              </form>
            <?php endforeach; endif; ?>
            <?php if (!$draft): ?>
              <a class="btn sm" href="<?= $e(portfolio_url($g['slug'], $slug, $L)) ?>" target="_blank" rel="noopener" title="Открыть страницу на <?= $e(strtoupper($L)) ?>">↗</a>
            <?php endif; ?>
          </div></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <?php if (!$rows): ?>
      <p class="muted" style="margin-top:12px"><?= $view === 'drafts' ? 'Черновиков нет.' : 'В этой категории пока нет проектов.' ?></p>
    <?php endif; ?>
  </div>
<?php endif; ?>

<?php admin_foot(); ?>
