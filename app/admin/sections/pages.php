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

/** Строки словаря, принадлежащие странице. */
function admin_page_keys(?string $prefix): array
{
    if ($prefix === null) return [];
    $out = [];
    foreach (texts_canon() as $k => $v) {
        if (strpos($k, $prefix) === 0) $out[$k] = $v;
    }
    return $out;
}

/* ------------------------------------------------------------ сохранение */
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $key  = post_one($_POST['page'] ?? '');
    $page = null;
    foreach (admin_pages() as $p) if ($p['key'] === $key) { $page = $p; break; }
    if ($page === null) {
        admin_flash('Страница не найдена.', 'err');
        admin_go(admin_url('pages'));
    }

    $changed = 0;

    /* --- заголовки для поиска --- */
    $base  = require __DIR__ . '/../../data/seo.php';
    $store = Store::read('seo.json') ?? [];
    $in    = (array)($_POST['seo'] ?? []);
    foreach (langs() as $l) {
        foreach (['title', 'description'] as $f) {
            $v    = post_one($in[$f][$l] ?? '');
            $orig = $base[$key][$l][$f] ?? '';
            /* В хранилище пишем только отличия от файлов разработчика:
               иначе оно заморозит нынешний текст, и правка в репозитории
               до сайта уже не дойдёт. */
            if ($v === '' || $v === $orig) {
                if (isset($store[$key][$l][$f])) { unset($store[$key][$l][$f]); $changed++; }
            } elseif (($store[$key][$l][$f] ?? null) !== $v) {
                $store[$key][$l][$f] = $v;
                $changed++;
            }
        }
        if (isset($store[$key][$l]) && !$store[$key][$l]) unset($store[$key][$l]);
    }
    if (isset($store[$key]) && !$store[$key]) unset($store[$key]);
    $okSeo = Store::write('seo.json', $store);
    Store::forget('seo.json');

    /* --- строки страницы --- */
    $repo = [];
    foreach (langs() as $l) {
        $p2 = __DIR__ . '/../../lang/' . $l . '.php';
        $d  = is_file($p2) ? (array) require $p2 : [];
        foreach ($d as $k => $v) if (is_string($v)) $repo[$k][$l] = $v;
    }
    $all   = texts_canon();
    $tstore = Store::read('texts.json') ?? [];
    foreach ((array)($_POST['t'] ?? []) as $k => $byLang) {
        /* Правим только существующие ключи и только те, что принадлежат
           этой странице: новая строка должна появляться из кода. */
        if (!isset($all[$k]) || !is_array($byLang)) continue;
        if ($page['prefix'] === null || strpos($k, $page['prefix']) !== 0) continue;

        foreach (langs() as $l) {
            if (!array_key_exists($l, $byLang)) continue;
            $v    = post_one($byLang[$l], true);
            $orig = $repo[$k][$l] ?? '';
            if ($v === $orig || ($v === '' && $orig === '')) {
                if (isset($tstore[$k][$l])) { unset($tstore[$k][$l]); $changed++; }
            } elseif (($tstore[$k][$l] ?? null) !== $v) {
                $tstore[$k][$l] = $v;
                $changed++;
            }
        }
        if (isset($tstore[$k]) && !$tstore[$k]) unset($tstore[$k]);
    }
    $okTexts = Store::write('texts.json', $tstore);
    Store::forget('texts.json');

    admin_note_edit('page:' . $key);

    /* Проверяем до сообщения об успехе: «сохранено» при обрезанной форме —
       худшее, что панель может сказать. */
    $cut = admin_form_truncated(admin_count_fields($_POST['t'] ?? []));

    /* Отказ записи важнее всего остального: «Сохранено» при несохранённом —
       это когда редактор узнаёт о потере через неделю и уже ничего
       не помнит. */
    if (!$okSeo || !$okTexts) {
        admin_flash('НЕ СОХРАНЕНО: ' . (!$okSeo && !$okTexts ? 'ни заголовки, ни текст'
            : (!$okSeo ? 'заголовки для поиска' : 'текст страницы'))
            . ' записать не удалось. Проверьте место на диске и права на папку '
            . Store::dir() . '. Правки НЕ приняты — не закрывайте страницу, скопируйте их.', 'err');
    } elseif ($cut !== null) {
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
      <table>
        <tr>
          <th class="num">№</th><th>Страница</th><th class="addr">Адрес</th>
          <th>Правилось</th><th>Текст</th><th>SEO</th><th>Языки</th><th class="right"></th>
        </tr>
        <?php foreach (admin_pages() as $i => $p):
          $keys    = admin_page_keys($p['prefix']);
          $hasText = $keys !== [] || $p['section'] !== null;
          $hasSeo  = !empty($seo[$p['key']][deflang()]['title']);
          $ed      = $edits['page:' . $p['key']] ?? null;

          /* Переведена ли страница: доля заполненных строк по языку.
             Жёлтая точка — переведено не всё, и это видно до того,
             как человек откроет страницу и начнёт искать дыры глазами. */
          $dots = '';
          foreach (langs() as $l) {
              if ($keys === []) { $dots .= admin_dot(true, strtoupper($l)); continue; }
              $filled = 0;
              foreach ($keys as $v) if (($v[$l] ?? '') !== '') $filled++;
              $cls = $filled === count($keys) ? 'dot on' : ($filled ? 'dot half' : 'dot');
              $title = strtoupper($l) . ': ' . $filled . ' из ' . count($keys);
              $dots .= '<span class="' . $cls . '" title="' . $e($title) . '" role="img" aria-label="' . $e($title) . '"></span>';
          }
        ?>
        <tr>
          <td class="num"><?= admin_num($i) ?></td>
          <td><b><?= $e($p['name']) ?></b></td>
          <td class="addr mono"><?= $e($p['url']) ?></td>
          <td class="muted">
            <?php if ($ed): ?>
              <?= $e(date('d.m.Y, H:i', (int)$ed['at'])) ?><br>
              <span style="font-size:12px"><?= $e($ed['by'] ?? '') ?></span>
            <?php else: ?>
              —<br><span style="font-size:12px">из репозитория</span>
            <?php endif; ?>
          </td>
          <td><?= admin_dot($hasText, 'текст страницы') ?></td>
          <td><?= admin_dot($hasSeo, 'заголовок для поиска') ?></td>
          <td class="dotcell"><?= $dots ?></td>
          <td class="right"><div class="acts">
            <?php if ($p['prefix'] !== null): ?>
              <a class="btn sm" href="<?= $e(admin_url('pages', ['p' => $p['key']])) ?>">Изменить</a>
            <?php else: ?>
              <a class="btn sm" href="<?= $e(admin_url($p['section'] ?? 'texts')) ?>">Изменить</a>
            <?php endif; ?>
            <a class="btn ghost sm" href="<?= $e($p['url']) ?>" target="_blank" rel="noopener">Открыть</a>
            <span class="langlinks"><?php foreach (langs() as $l): if ($l === deflang()) continue; ?>
              <a href="<?= $e('/' . $l . $p['url']) ?>" target="_blank" rel="noopener"
                 title="<?= $e('Открыть на ' . strtoupper($l)) ?>"><?= $e(strtoupper($l)) ?>&nbsp;↗</a>
            <?php endforeach; ?></span>
          </div></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>

<?php else:
  $keys = admin_page_keys($cur['prefix']);
  $m    = $seo[$cur['key']] ?? [];
  $LIM  = ['title' => 60, 'description' => 158];
?>
  <p style="margin:0 0 16px"><a class="btn ghost sm" href="<?= $e(admin_url('pages')) ?>">← Все страницы</a></p>

  <form method="post" action="<?= $e(admin_url('pages')) ?>" data-guard="1">
    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <input type="hidden" name="page" value="<?= $e($cur['key']) ?>">
    <?php /* Сколько полей словаря отправляем. Поле стоит ПЕРВЫМ: PHP
             отбрасывает последние, значит объявление доедет в любом случае. */ ?>
    <input type="hidden" name="_fields" value="<?= count($keys) * count(langs()) ?>">

    <div class="panel">
      <h3><?= $e($cur['name']) ?> <span class="pill grey mono"><?= $e($cur['url']) ?></span></h3>
      <p class="muted">Адрес страницы отсюда не правится: он задан именем папки
         в репозитории, и переименование оставило бы ссылку в никуда.</p>
      <?php if ($cur['section']): ?>
        <p class="muted">Содержимое этой страницы — списки и карточки — правится
          в разделе <a href="<?= $e(admin_url($cur['section'])) ?>"><b><?= $e(admin_sections()[$cur['section']][0] ?? $cur['section']) ?></b></a>.
          Здесь только её собственный текст и заголовок для поиска.</p>
      <?php endif; ?>
    </div>

    <div class="panel">
      <h3>Заголовок в выдаче Google</h3>
      <p class="muted">Это человек видит раньше самой страницы. Числа под полями —
         сколько знаков поместится: длиннее не ошибка, но хвост не покажут.</p>
      <?php foreach (['title' => 'Заголовок', 'description' => 'Описание'] as $f => $label): ?>
        <label><?= $e($label) ?> <span class="hint">до <?= $LIM[$f] ?> знаков</span></label>
        <div class="row3">
          <?php foreach (langs() as $l): ?>
            <div>
              <div class="muted" style="margin-bottom:4px"><b><?= $e(strtoupper($l)) ?></b></div>
              <?php if ($f === 'title'): ?>
                <input type="text" data-max="<?= $LIM[$f] ?>" name="seo[<?= $e($f) ?>][<?= $e($l) ?>]"
                       value="<?= $e($m[$l][$f] ?? '') ?>"
                       placeholder="<?= $l === deflang() ? '' : 'пусто — возьмётся русский' ?>">
              <?php else: ?>
                <textarea rows="3" data-max="<?= $LIM[$f] ?>" name="seo[<?= $e($f) ?>][<?= $e($l) ?>]"
                          placeholder="<?= $l === deflang() ? '' : 'пусто — возьмётся русский' ?>"><?= $e($m[$l][$f] ?? '') ?></textarea>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="panel">
      <h3>Текст страницы — <?= count($keys) ?> строк</h3>
      <?php if (!$keys): ?>
        <p class="muted">У этой страницы нет собственных строк в словаре.</p>
      <?php else: ?>
        <label for="texts-filter">Поиск по строкам этой страницы</label>
        <input type="text" id="texts-filter" placeholder="например: заявка">
        <div class="muted" id="texts-count" style="margin-top:6px"></div>
      <?php endif; ?>
    </div>

    <?php foreach ($keys as $k => $byLang):
      $hay  = mb_strtolower($k . ' ' . implode(' ', $byLang));
      $long = mb_strlen($byLang[deflang()] ?? '') > 90;
    ?>
      <div class="item" data-text-row="<?= $e($hay) ?>">
        <b class="mono" style="display:block;margin-bottom:6px"><?= $e($k) ?></b>
        <div class="row3">
          <?php foreach (langs() as $l): ?>
            <div>
              <div class="muted" style="margin-bottom:4px"><b><?= $e(strtoupper($l)) ?></b></div>
              <?php if ($long): ?>
                <textarea rows="4" name="t[<?= $e($k) ?>][<?= $e($l) ?>]"
                          placeholder="<?= $l === deflang() ? '' : 'пусто — возьмётся русский' ?>"><?= $e($byLang[$l] ?? '') ?></textarea>
              <?php else: ?>
                <input type="text" name="t[<?= $e($k) ?>][<?= $e($l) ?>]" value="<?= $e($byLang[$l] ?? '') ?>"
                       placeholder="<?= $l === deflang() ? '' : 'пусто — возьмётся русский' ?>">
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>

    <div class="btnrow">
      <button class="btn" type="submit">Сохранить страницу</button>
      <a class="btn ghost" href="<?= $e(admin_url('pages')) ?>">Отменить</a>
      <a class="btn ghost" href="<?= $e($cur['url']) ?>" target="_blank" rel="noopener">Открыть страницу ↗</a>
    </div>
  </form>
<?php endif; ?>

<?php admin_foot(); ?>
