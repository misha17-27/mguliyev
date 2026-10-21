<?php
/* Страницы сайта: список и правка одной страницы целиком.

   ЗАЧЕМ ОТДЕЛЬНЫЙ РАЗДЕЛ, ЕСЛИ ЕСТЬ «СТРОКИ СТРАНИЦ» И «ЗАГОЛОВКИ».
   Те разделы разложены по тому, как устроены данные: словарь отдельно,
   заголовки для поиска отдельно. Человек же думает страницами: «поправить
   страницу цен» — это и текст на ней, и заголовок в выдаче. Разнесённые
   по двум разделам, они расходятся: текст поправили, заголовок забыли,
   и в поиске страница обещает одно, а показывает другое.

   Поэтому здесь список всех страниц сайта, и у каждой сразу видно:
   есть ли текст, есть ли заголовок для поиска, на каких языках переведено.
   «Изменить» открывает это вместе.

   ЧТО ЗДЕСЬ НЕ ПРАВИТСЯ. Адрес страницы: он задан именем папки в
   репозитории, и переименование из панели оставило бы ссылку в никуда.
   Содержимое, у которого есть свой раздел — проекты портфолио, услуги
   в каталоге, пакеты цен, тексты статей, — правится там; здесь на него
   стоит ссылка, а не вторая форма для того же самого. */

$e = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

/** Все страницы сайта.

    key     — он же $page в файле страницы и ключ в data/seo.php
    prefix  — приставка строк словаря, которые принадлежат этой странице
    section — раздел, где правится её содержимое, если оно не в словаре */
function admin_pages(): array
{
    $list = [
        /* Не страница, а то, что есть на всех: меню, подвал, формы, кнопки.
           Раньше эти строки правились только в отдельном разделе «Строки
           страниц», который дублировал этот. */
        ['key' => 'common',    'name' => 'Общее: меню, подвал, формы', 'url' => '/',
         'prefix' => ['nav.', 'footer.', 'cta.', 'form.', 'cat.', 'units.', 'seo.'], 'section' => null],
        ['key' => 'home',      'name' => 'Главная',        'url' => '/',           'prefix' => 'home.',      'section' => null],
        ['key' => 'uslugi',    'name' => 'Услуги — список', 'url' => '/uslugi/',    'prefix' => 'uslugi.',    'section' => 'uslugi'],
    ];

    /* Страницы направлений: адреса берём из каталога, а не вписываем
       руками — иначе список разъедется при первом же изменении. */
    $prefixes = ['veb-sayty' => 'web.'];
    foreach (catalog_canon() as $slug => $c) {
        $list[] = [
            /* Ключ — ТОТ ЖЕ, что $page в файле страницы и в data/seo.php.
               У направлений он плоский («veb-sayty»), а не «uslugi/veb-sayty»:
               иначе заголовок для поиска не нашёлся бы и колонка SEO врала бы,
               показывая «не заполнено» там, где всё заполнено. */
            'key'     => $slug,
            'name'    => 'Услуги → ' . tr($c['title'], deflang()),
            'url'     => '/uslugi/' . $slug . '/',
            'prefix'  => $prefixes[$slug] ?? null,
            'section' => 'uslugi',
        ];
    }

    $list[] = ['key' => 'portfolio', 'name' => 'Портфолио',   'url' => '/portfolio/', 'prefix' => 'portfolio.', 'section' => 'portfolio'];
    $list[] = ['key' => 'price',     'name' => 'Цены',        'url' => '/tseny/',     'prefix' => 'price.',     'section' => 'packs'];
    $list[] = ['key' => 'about',     'name' => 'О студии',    'url' => '/o-studii/',  'prefix' => 'about.',     'section' => null];
    $list[] = ['key' => 'contacts',  'name' => 'Контакты',    'url' => '/kontakty/',  'prefix' => 'contacts.',  'section' => 'settings'];
    $list[] = ['key' => 'blog',      'name' => 'Блог — список', 'url' => '/blog/',    'prefix' => 'blog.',      'section' => 'blog'];

    foreach (articles_canon() as $a) {
        $list[] = [
            'key'     => 'blog/' . $a['slug'],
            'name'    => 'Блог → ' . tr($a['title'], deflang()),
            'url'     => '/blog/' . $a['slug'] . '/',
            'prefix'  => null,
            'section' => 'blog',
        ];
    }
    return $list;
}

/** Строки словаря, принадлежащие странице. Приставок может быть
    несколько: у «Общих элементов» это меню, подвал, формы и кнопки. */
function admin_page_keys($prefix): array
{
    if ($prefix === null) return [];
    $out = [];
    foreach (texts_canon() as $k => $v) {
        foreach ((array)$prefix as $pf) {
            if (strpos($k, $pf) === 0) { $out[$k] = $v; break; }
        }
    }
    return $out;
}

/** Принадлежит ли ключ странице — с учётом нескольких приставок. */
function admin_key_of_page(string $k, $prefix): bool
{
    foreach ((array)$prefix as $pf) {
        if ($pf !== null && strpos($k, $pf) === 0) return true;
    }
    return false;
}

/* Строки словаря из файлов разработчика, без правок панели: с ними
   сравнивается ввод, чтобы в хранилище попадали только отличия. */
$repoOf = static function (): array {
    $repo = [];
    foreach (langs() as $l) {
        $p = __DIR__ . '/../../lang/' . $l . '.php';
        $d = is_file($p) ? (array) require $p : [];
        foreach ($d as $k => $v) if (is_string($v)) $repo[$k][$l] = $v;
    }
    return $repo;
};

/* Сравнение без учёта пробелов и переносов. Строки в словаре перенесены
   как код («…сейчас.\n        Этого…»), а форма отдаёт их иначе: поле
   ввода переносы выбрасывает, очистка срезает пробел по краям. Строгое
   сравнение считало нетронутую строку правкой и навсегда замораживало
   её в хранилище. Сравниваем только пробелы ASCII: неразрывный пробел
   редактор ставит нарочно, и это правка. */
$norm = static fn(string $s): string => preg_replace('~[ \t\n\r]+~', ' ', clean_text($s, true)) ?? '';

/* Правленое значение получает края оригинала: у азербайджанской web.t45
   пробел в начале стоит сразу после ссылки, и без него на странице
   выходит «marketinqbölməsində». Очистка формы этот пробел срезает. */
$edges = static function (string $v, string $orig): string {
    if ($v === '' || $orig === '') return $v;
    preg_match('~^[ \t\n\r]*~', $orig, $a);
    preg_match('~[ \t\n\r]*\z~', $orig, $b);
    return (preg_match('~^\s~u', $v) ? '' : $a[0]) . $v . (preg_match('~\s\z~u', $v) ? '' : $b[0]);
};

/* Отпечаток значения, которое форма показала. По нему после отказа
   видно, какие поля человек правил, а какие пришли нетронутыми. */
$fp = static fn(string $s): string => substr(md5($norm($s)), 0, 8);

/* ------------------------------------------------------------ сохранение */
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $key  = post_one($_POST['page'] ?? '');
    $page = null;
    foreach (admin_pages() as $p) if ($p['key'] === $key) { $page = $p; break; }
    if ($page === null) {
        admin_flash('Страница не найдена.', 'err');
        admin_go(admin_url('pages'));
    }

    /* Язык правки — из формы: с ним черновик вернётся на тот же экран,
       даже если в другой вкладке тем временем переключили язык. */
    $L = post_one($_POST['lang'] ?? '');
    if (!in_array($L, langs(), true)) $L = admin_lang();
    $back = admin_url('pages', ['p' => $key, 'lang' => $L]);

    $tIn   = (array)($_POST['t'] ?? []);
    $seoIn = (array)($_POST['seo'] ?? []);

    /* Черновик — только то, что человек правил: поля, которые отличаются
       от показанного формой. Вернуть все поля значило бы следующим
       сохранением вернуть и старые значения поверх той правки, ради
       которой сохранение отменили. Отпечатка нет (вкладка открыта до того,
       как он появился) — берём всё, но так можно только при отказе записи:
       там хранилище никто не менял, и старых значений поверх новых не будет. */
    $shown = is_string($_POST['_shown'] ?? null) ? json_decode($_POST['_shown'], true) : null;
    $shown = is_array($shown) ? $shown : null;
    $keep  = static function (bool $withT, bool $withSeo) use ($tIn, $seoIn, $shown, $fp, $key, $L): int {
        $d = ['t' => [], 'seo' => []];
        if ($withT) {
            foreach ($tIn as $k => $byLang) {
                if (!is_array($byLang) || !is_string($byLang[$L] ?? null)) continue;
                $v = post_one($byLang[$L], true);
                if ($shown !== null && ($shown['t.' . $k] ?? null) === $fp($v)) continue;
                $d['t'][(string)$k] = $v;
            }
        }
        if ($withSeo) {
            foreach (['title', 'description'] as $f) {
                if (!is_array($seoIn[$f] ?? null) || !is_string($seoIn[$f][$L] ?? null)) continue;
                $v = post_one($seoIn[$f][$L]);
                if ($shown !== null && ($shown['seo.' . $f] ?? null) === $fp($v)) continue;
                $d['seo'][$f] = $v;
            }
        }
        $n = count($d['t']) + count($d['seo']);
        if ($n) admin_draft_keep('pages:' . $key . ':' . $L, $d);
        return $n;
    };

    /* Вкладка, открытая час назад, вернула бы страницу к состоянию часовой
       давности — и панель сказала бы «Сохранено». Метка версии это ловит.
       Меток две: форма пишет и тексты, и заголовки для поиска, а заголовки
       правит ещё и раздел «Заголовки для поиска», не трогая текстов. */
    $staleT = admin_stale('texts.json');
    $wasSeo = is_string($_POST['_ver_seo'] ?? null) ? $_POST['_ver_seo'] : '';
    $staleS = $wasSeo !== '' && $wasSeo !== Store::stamp('seo.json');
    if ($staleT || $staleS) {
        /* Без отпечатка не отличить правленое от нетронутого, а черновик
           из всех полей вернул бы старое поверх той самой правки. */
        $n = $shown !== null ? $keep(true, true) : 0;
        admin_flash(($staleT && $staleS ? '«Тексты страниц» и «Заголовки для поиска»'
                : ($staleT ? '«Тексты страниц»' : '«Заголовки для поиска»'))
            . ' правили из другого места, пока эта страница была открыта. Чтобы не '
            . 'затереть ту правку, сохранение отменено. '
            . ($n ? 'Ваши правки (' . $n . ') возвращены в форму поверх свежей версии — '
                  . 'проверьте их и сохраните ещё раз.'
                  : ($shown === null
                      ? 'Открыта свежая версия — внесите свои изменения заново.'
                      : 'Своих правок в форме не было — открыта свежая версия.')), 'err');
        admin_go($back);
    }

    /* Обе записи — под блокировкой: файл перечитывается внутри неё, и
       меняются только поля этой страницы. Иначе два сохранения, попавшие
       в одно мгновение, читали бы одно состояние, и второе стёрло бы первое.
       Ничего не изменилось — файл не переписываем: лишняя запись сдвинула
       бы метку версии и сделала устаревшими формы в других вкладках.
       Store::update тогда отвечает false, поэтому «записано» — это либо
       удачная запись, либо проход без изменений. */

    /* --- заголовки для поиска --- */
    $changedS = 0;
    $ranS     = false;
    $okSeo    = true;
    if ($seoIn) {
        $seoRepo = require __DIR__ . '/../../data/seo.php';
        $okSeo = Store::update('seo.json', static function (array $store) use ($seoIn, $seoRepo, $key, $norm, &$changedS, &$ranS) {
            $ranS = true;
            foreach (langs() as $l) {
                foreach (['title', 'description'] as $f) {
                    /* Языка нет в форме — его не трогаем. Форма показывает один
                       язык, и «нет значит пусто» стёрло бы два других. */
                    if (!isset($seoIn[$f]) || !is_array($seoIn[$f]) || !array_key_exists($l, $seoIn[$f])) continue;
                    $v    = post_one($seoIn[$f][$l]);
                    $orig = $seoRepo[$key][$l][$f] ?? '';
                    /* В хранилище пишем только отличия от файлов разработчика:
                       иначе оно заморозит нынешний текст, и правка в репозитории
                       до сайта уже не дойдёт. */
                    if ($v === '' || $norm($v) === $norm($orig)) {
                        if (isset($store[$key][$l][$f])) { unset($store[$key][$l][$f]); $changedS++; }
                    } elseif (($store[$key][$l][$f] ?? null) !== $v) {
                        $store[$key][$l][$f] = $v;
                        $changedS++;
                    }
                }
                if (isset($store[$key][$l]) && !$store[$key][$l]) unset($store[$key][$l]);
            }
            if (isset($store[$key]) && !$store[$key]) unset($store[$key]);
            return $changedS ? $store : null;
        }) || ($ranS && $changedS === 0);
    }

    /* --- строки страницы --- */
    $repo     = $repoOf();
    $all      = texts_canon();
    $prefix   = $page['prefix'];
    $changedT = 0;
    $ranT     = false;
    $okTexts  = !$tIn || Store::update('texts.json', static function (array $tstore) use ($tIn, $all, $repo, $prefix, $norm, $edges, &$changedT, &$ranT) {
        $ranT = true;
        foreach ($tIn as $k => $byLang) {
            /* Правим только существующие ключи и только те, что принадлежат
               этой странице: новая строка должна появляться из кода. */
            $k = (string)$k;
            if (!isset($all[$k]) || !is_array($byLang)) continue;
            if (!admin_key_of_page($k, $prefix)) continue;

            foreach (langs() as $l) {
                if (!array_key_exists($l, $byLang)) continue;
                $v    = post_one($byLang[$l], true);
                $orig = $repo[$k][$l] ?? '';
                if ($norm($v) === $norm($orig)) {
                    if (isset($tstore[$k][$l])) { unset($tstore[$k][$l]); $changedT++; }
                    continue;
                }
                $v = $edges($v, $orig);
                if (($tstore[$k][$l] ?? null) !== $v) {
                    $tstore[$k][$l] = $v;
                    $changedT++;
                }
            }
            if (isset($tstore[$k]) && !$tstore[$k]) unset($tstore[$k]);
        }
        return $changedT ? $tstore : null;
    }) || ($ranT && $changedT === 0);

    /* Отметка «правилась» — только если что-то действительно записалось. */
    if (($okSeo && $changedS) || ($okTexts && $changedT)) admin_note_edit('page:' . $key);

    /* Отказ записи важнее всего остального: «Сохранено» при несохранённом —
       это когда редактор узнаёт о потере через неделю и уже ничего
       не помнит. Несохранённое возвращается в форму: просить «скопируйте
       правки со страницы» после перехода на страницу, собранную заново
       из хранилища, бессмысленно — правок там уже нет. */
    if (!$okSeo || !$okTexts) {
        $n = $keep(!$okTexts, !$okSeo);
        /* «Сохранено» про вторую часть — только если она что-то записала:
           у «Общего» заголовков нет вовсе, а нетронутая часть не пишется. */
        admin_flash((!$okSeo && !$okTexts
                ? 'НЕ СОХРАНЕНО: ни текст страницы, ни заголовки для поиска записать не удалось.'
                : (!$okSeo
                    ? ($changedT ? 'Текст страницы сохранён, а заголовки для поиска — НЕТ: записать их не удалось.'
                                 : 'НЕ СОХРАНЕНО: заголовки для поиска записать не удалось.')
                    : ($changedS ? 'Заголовки для поиска сохранены, а текст страницы — НЕТ: записать его не удалось.'
                                 : 'НЕ СОХРАНЕНО: текст страницы записать не удалось.')))
            . ' Проверьте место на диске и права на папку ' . Store::dir() . '.'
            . ($n ? ' Несохранённые правки (' . $n . ') возвращены в форму — сохраните её ещё раз, '
                  . 'когда причина будет устранена.' : ''), 'err');
        admin_go($back);
    }

    /* Проверяем до сообщения об успехе: «сохранено» при обрезанной форме —
       худшее, что панель может сказать. */
    $cut = admin_form_truncated(admin_count_fields($_POST['t'] ?? []));
    $changed = $changedS + $changedT;
    if ($cut !== null) {
        admin_flash($cut, 'err');
    } else {
        admin_flash($changed ? 'Сохранено. Изменено значений: ' . $changed . '.' : 'Изменений не было.');
    }
    admin_go(admin_url('pages', ['p' => $key]));
}

/* ------------------------------------------------------------- отрисовка */
$open = post_one($_GET['p'] ?? '');
$cur  = null;
foreach (admin_pages() as $p) if ($p['key'] === $open) { $cur = $p; break; }

$seo   = seo_canon();
$edits = Store::read('edits.json') ?? [];

admin_head('pages');

if ($cur === null):
?>
  <div class="note">
    Тексты страницы, её заголовок для поиска и переводы открываются кнопкой
    «Изменить». Проекты портфолио, услуги, пакеты и тексты статей правятся
    в своих разделах — отсюда на них стоит ссылка, чтобы одно и то же
    не правилось в двух местах и не расходилось.
  </div>

  <div class="panel">
    <?php admin_list_head(count(admin_pages()), 'Страниц'); ?>
    <div class="tablewrap">
      <table class="list">
        <tr>
          <th class="num">№</th><th>Страница</th><th>Адрес</th>
          <th>Изменено</th><th>Текст</th><th>SEO</th><th>Языки</th>
          <th class="right"></th>
        </tr>
        <?php foreach (admin_pages() as $i => $p):
          $keys    = admin_page_keys($p['prefix']);
          $hasText = $keys !== [] || $p['section'] !== null;
          /* Заголовок для поиска и точка SEO — на языке, выбранном вверху. */
          $seoT    = array_map(static fn($x) => is_array($x) ? (string)($x['title'] ?? '') : '', (array)($seo[$p['key']] ?? []));
          $hasSeo  = ($seoT[admin_lang()] ?? '') !== '';
          $ed      = $edits['page:' . $p['key']] ?? null;

          /* Доля переведённого по каждому языку: у страницы без своих
             строк (статьи, направления) текст живёт в другом разделе,
             там и считается — здесь показываем её как заполненную. */
          $fill = [];
          foreach (langs() as $l) {
              if ($keys === []) { $fill[$l] = 1; continue; }
              $n = 0;
              foreach ($keys as $v) if (($v[$l] ?? '') !== '') $n++;
              $fill[$l] = $n / count($keys);
          }
        ?>
        <tr>
          <td class="num"><?= admin_num($i) ?></td>
          <td><b class="clamp" title="<?= $e($p['name']) ?>"><?= $e($p['name']) ?></b>
              <?php if ($p['key'] !== 'common' && implode('', $seoT) !== ''): ?>
                <span class="muted clamp" title="Заголовок в выдаче"><?= admin_in_lang($seoT, 80) ?></span>
              <?php endif; ?></td>
          <td><span class="path" title="<?= $e(admin_site_url($p['url'])) ?>"><?= $e(admin_site_url($p['url'])) ?></span></td>
          <?php /* Колонки «Добавил» нет намеренно: все страницы заведены
                   в репозитории, и во всех строках стояло бы одно и то же —
                   «разработчик». Ширина нужнее тем колонкам, где есть что читать. */ ?>
          <td class="who-when">
            <?php if ($ed): ?>
              <b><?= $e(date('d.m.Y, H:i', (int)$ed['at'])) ?></b>
              <span><?= $e($ed['by'] ?? '') ?></span>
            <?php else: ?>
              <b style="color:var(--muted)">—</b><span>не правилась</span>
            <?php endif; ?>
          </td>
          <td><?= admin_dot($hasText, 'текст страницы') ?></td>
          <td><?= $p['key'] === 'common'
                ? '<span class="muted" title="У общих элементов нет своего заголовка в выдаче">—</span>'
                : admin_dot($hasSeo, 'заголовок для поиска') ?></td>
          <td><?= admin_lang_badges($fill, $p['url']) ?></td>
          <td class="right"><div class="acts">
            <a class="btn sm" href="<?= $e($p['prefix'] !== null
                ? admin_url('pages', ['p' => $p['key']])
                : admin_url($p['section'] ?? 'texts')) ?>">Изменить</a>
            <a class="btn sm" href="<?= $e(admin_site_url($p['url'])) ?>" target="_blank" rel="noopener">Открыть ↗</a>
          </div></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>

<?php else:
  $keys   = admin_page_keys($cur['prefix']);
  $m      = $seo[$cur['key']] ?? [];
  $LIM    = ['title' => 60, 'description' => 158];
  $L      = admin_lang();
  $DEF    = deflang();
  $repo   = $repoOf();
  $withSeo = $cur['key'] !== 'common';

  /* Отпечаток сохранённого — до черновика: правкой считается то, что
     отличается от хранилища, а не от вписанного в прошлый раз. */
  $shown = [];
  foreach ($keys as $k => $byLang) $shown['t.' . $k] = $fp((string)($byLang[$L] ?? ''));
  if ($withSeo) {
      foreach (['title', 'description'] as $f) $shown['seo.' . $f] = $fp((string)($m[$L][$f] ?? ''));
  }

  /* Вписанное перед отказом сохранения — поверх сохранённого. */
  $draft = admin_draft_take('pages:' . $cur['key'] . ':' . $L);
  if ($draft !== null) {
      foreach ((array)($draft['t'] ?? []) as $k => $v) {
          if (isset($keys[$k]) && is_string($v)) $keys[$k][$L] = $v;
      }
      foreach ((array)($draft['seo'] ?? []) as $f => $v) {
          if (($f === 'title' || $f === 'description') && is_string($v)) $m[$L][$f] = $v;
      }
  }
?>
  <p style="margin:0 0 16px"><a class="btn ghost sm" href="<?= $e(admin_url('pages')) ?>">← Все страницы</a></p>

  <form method="post" action="<?= $e(admin_url('pages')) ?>" data-guard="1">
    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <?= admin_ver_field('texts.json') ?>
    <?php if ($withSeo): /* Вторая метка: форма пишет и заголовки для поиска. */ ?>
      <input type="hidden" name="_ver_seo" value="<?= $e(Store::stamp('seo.json')) ?>">
    <?php endif; ?>
    <input type="hidden" name="page" value="<?= $e($cur['key']) ?>">
    <input type="hidden" name="lang" value="<?= $e($L) ?>">
    <?php /* Сколько полей словаря отправляем. Поле стоит ПЕРВЫМ: PHP
             отбрасывает последние, значит объявление доедет в любом случае.
             Язык теперь один — тот, что выбран вверху. */ ?>
    <input type="hidden" name="_fields" value="<?= count($keys) ?>">
    <input type="hidden" name="_shown" value="<?= $e(json_encode($shown)) ?>">

    <?php
    $isT = $L !== $DEF;                       // правим перевод, а не оригинал
    $ph  = $isT ? ' placeholder="пусто — на сайте будет русский текст"' : '';
    /* У SEO пустой перевод значит другое: берётся перевод из файлов сайта
       (data/seo.php), а русский — только если там его нет. */
    $phSeo = $isT ? ' placeholder="пусто — перевод из файлов сайта, а если его нет — русский"' : '';
    /* Высота поля по объёму русского текста: короткая строка не сидит
       в огромном поле, длинная не прокручивается в крошечном. */
    $rowsFor = static fn(string $t): int => max(2, min(12, (int)ceil(mb_strlen($t) / 120) + 1));
    ?>

    <div class="panel">
      <h3><?= $e($cur['name']) ?>
        <span class="lg full" style="vertical-align:3px;margin-left:6px"><?= $e(strtoupper($L)) ?></span>
      </h3>
      <p class="muted" style="margin-top:6px">Адрес: <span class="path"><?= $e(($isT ? '/' . $L : '') . $cur['url']) ?></span>
        · язык переключается вверху, справа</p>
      <?php if ($cur['section']): ?>
        <p class="muted">Списки и карточки на этой странице правятся в разделе
          <a href="<?= $e(admin_url($cur['section'])) ?>"><b><?= $e(admin_sections()[$cur['section']][0] ?? $cur['section']) ?></b></a>.
          Здесь — её собственный текст и заголовок для поиска.</p>
      <?php endif; ?>
    </div>

    <?php if ($withSeo): ?>
    <div class="panel">
      <h3>SEO</h3>
      <p class="muted">Это человек видит в выдаче Google раньше самой страницы.
         Число под полем — сколько знаков поместится: длиннее не ошибка, но хвост не покажут.</p>

      <label>Заголовок в выдаче и на вкладке <span class="hint">до <?= $LIM['title'] ?> знаков</span></label>
      <input type="text" data-max="<?= $LIM['title'] ?>" name="seo[title][<?= $e($L) ?>]"
             value="<?= $e($m[$L]['title'] ?? '') ?>"<?= $phSeo ?>>
      <?php if ($isT && !empty($m[$DEF]['title'])): ?>
        <div class="src"><b><?= $e(strtoupper($DEF)) ?>:</b> <?= $e($m[$DEF]['title']) ?></div>
      <?php endif; ?>

      <label>Описание под заголовком <span class="hint">до <?= $LIM['description'] ?> знаков</span></label>
      <textarea rows="3" data-max="<?= $LIM['description'] ?>" name="seo[description][<?= $e($L) ?>]"<?= $phSeo ?>><?= $e($m[$L]['description'] ?? '') ?></textarea>
      <?php if ($isT && !empty($m[$DEF]['description'])): ?>
        <div class="src"><b><?= $e(strtoupper($DEF)) ?>:</b> <?= $e($m[$DEF]['description']) ?></div>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="panel">
      <h3>Содержание страницы — <?= count($keys) ?> строк</h3>
      <?php if (!$keys): ?>
        <p class="muted">У этой страницы нет собственных строк в словаре.</p>
      <?php else: ?>
        <p class="muted">Строки идут в том порядке, в котором стоят на странице.
          <?php if ($isT): ?>Под каждым полем — русский оригинал, с которого переводите.<?php endif; ?></p>
        <label for="texts-filter">Найти строку</label>
        <input type="text" id="texts-filter" placeholder="например: заявка">
        <div class="muted" id="texts-count" style="margin-top:6px"></div>

        <?php foreach ($keys as $k => $byLang):
          $hay = mb_strtolower($k . ' ' . implode(' ', $byLang));
          $src = (string)($byLang[$DEF] ?? '');
          $val = (string)($byLang[$L] ?? '');
          /* Перенос строки на любом языке — только поле в несколько строк:
             обычное поле ввода переносы молча выбрасывает. Смотрим и в файл
             разработчика: у строки, уже замороженной в хранилище без
             переноса, он остался только там. */
          $long = mb_strlen($src) > 90 || mb_strlen($val) > 90;
          foreach (langs() as $l) {
              if (strpos(($byLang[$l] ?? '') . ($repo[$k][$l] ?? ''), "\n") !== false) $long = true;
          }
        ?>
          <div class="field" data-text-row="<?= $e($hay) ?>">
            <div class="fkey"><?= $e($k) ?></div>
            <?php if ($long): ?>
              <textarea rows="<?= $rowsFor($src !== '' ? $src : $val) ?>" name="t[<?= $e($k) ?>][<?= $e($L) ?>]"<?= $ph ?>><?= $e($val) ?></textarea>
            <?php else: ?>
              <input type="text" name="t[<?= $e($k) ?>][<?= $e($L) ?>]" value="<?= $e($val) ?>"<?= $ph ?>>
            <?php endif; ?>
            <?php if ($isT && $src !== ''): ?>
              <div class="src"><b><?= $e(strtoupper($DEF)) ?>:</b> <?= $e($src) ?></div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <div class="btnrow">
      <button class="btn" type="submit">Сохранить страницу</button>
      <a class="btn ghost" href="<?= $e(admin_url('pages')) ?>">Отменить</a>
      <a class="btn ghost" href="<?= $e($cur['url']) ?>" target="_blank" rel="noopener">Открыть страницу ↗</a>
    </div>
  </form>
<?php endif; ?>

<?php admin_foot(); ?>
