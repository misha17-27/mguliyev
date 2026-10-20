<?php
/* Строки страниц: весь текст сайта, кроме статей блога и карточек проектов.

   Строк под четыреста на каждый язык, поэтому они разбиты по страницам
   и есть поиск. Открывать тысячу полей сразу бессмысленно: ни найти в них
   ничего, ни сохранить без риска.

   СОХРАНЯЕМ ТОЛЬКО ОТЛИЧИЯ. В хранилище попадает лишь то, что правили в
   панели. Если записывать всё подряд, хранилище замораживает нынешние
   тексты: разработчик поправит опечатку в репозитории, а на сайт она
   не попадёт — её перекроет сохранённая копия прежнего текста. */

$e = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

/* Понятные названия разделов словаря вместо приставок в ключах. */
$GROUPS = [
    'nav'       => 'Меню и шапка',
    'footer'    => 'Подвал',
    'cta'       => 'Кнопки и призывы',
    'form'      => 'Форма заявки',
    'cat'       => 'Названия направлений',
    'units'     => 'Слова после чисел',
    'seo'       => 'Запасные заголовки',
    'home'      => 'Главная',
    'web'       => 'Услуги → Веб-сайты',
    'uslugi'    => 'Услуги → список',
    'portfolio' => 'Портфолио',
    'price'     => 'Цены',
    'about'     => 'О студии',
    'contacts'  => 'Контакты',
    'blog'      => 'Блог',
];

$all = texts_canon();

/* Раскладываем по разделам, сохраняя порядок ключей в словаре. */
$byGroup = [];
foreach ($all as $k => $v) {
    $g = explode('.', $k)[0];
    if (!isset($GROUPS[$g])) $g = 'other';
    $byGroup[$g][$k] = $v;
}
if (isset($byGroup['other'])) $GROUPS['other'] = 'Прочее';

/* Файлы разработчика — чтобы отличать правку от совпадения. */
$repo = [];
foreach (langs() as $l) {
    $p = __DIR__ . '/../../lang/' . $l . '.php';
    $d = is_file($p) ? (array) require $p : [];
    foreach ($d as $k => $v) if (is_string($v)) $repo[$k][$l] = $v;
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $in    = (array)($_POST['t'] ?? []);
    $store = Store::read('texts.json') ?? [];
    $changed = 0;

    foreach ($in as $k => $byLang) {
        /* Правим только существующие ключи: новый ключ в словаре — это
           новая строка в шаблоне, и появиться она должна из кода. */
        if (!isset($all[$k]) || !is_array($byLang)) continue;

        foreach (langs() as $l) {
            if (!array_key_exists($l, $byLang)) continue;       // раздел не показывал это поле
            $v    = post_one($byLang[$l], true);
            $orig = $repo[$k][$l] ?? '';

            if ($v === $orig || ($v === '' && $orig === '')) {
                if (isset($store[$k][$l])) { unset($store[$k][$l]); $changed++; }
            } elseif (($store[$k][$l] ?? null) !== $v) {
                $store[$k][$l] = $v;
                $changed++;
            }
        }
        if (isset($store[$k]) && !$store[$k]) unset($store[$k]);
    }

    if (Store::write('texts.json', $store)) {
        admin_flash($changed
            ? 'Сохранено. Изменено строк: ' . $changed . '.'
            : 'Изменений не было.');
    } else {
        admin_flash('Не удалось сохранить.', 'err');
    }
    admin_go(admin_url('texts', ['g' => (string)($_POST['g'] ?? 'nav')]));
}

/* Какой раздел открыт. Если пришли со сводки с конкретным ключом —
   открываем тот раздел, где он лежит, и подставляем его в поиск. */
$q = post_one($_GET['q'] ?? '');
$g = (string)($_GET['g'] ?? '');
if ($q !== '' && isset($all[$q])) {
    $gq = explode('.', $q)[0];
    $g = isset($GROUPS[$gq]) ? $gq : 'other';
}
if (!isset($byGroup[$g])) $g = array_key_first($byGroup);

$rows  = $byGroup[$g] ?? [];
$store = Store::read('texts.json') ?? [];

admin_head('texts');
?>

<div class="panel">
  <h3>Раздел словаря</h3>
  <p class="muted">Строки разбиты по страницам сайта. Сохраняется только открытый
     раздел, остальные не трогаются.</p>
  <div style="display:flex;flex-wrap:wrap;gap:8px;margin-top:12px">
    <?php foreach ($GROUPS as $key => $name):
      if (empty($byGroup[$key])) continue; ?>
      <a class="btn <?= $key === $g ? '' : 'ghost' ?> sm" href="<?= $e(admin_url('texts', ['g' => $key])) ?>">
        <?= $e($name) ?> <span class="muted" style="color:inherit;opacity:.7"><?= count($byGroup[$key]) ?></span>
      </a>
    <?php endforeach; ?>
  </div>
</div>

<div class="panel">
  <h3><?= $e($GROUPS[$g] ?? $g) ?> — <?= count($rows) ?> строк</h3>
  <label for="texts-filter">Поиск по этому разделу
    <span class="hint">по ключу или по тексту на любом языке</span></label>
  <input type="text" id="texts-filter" value="<?= $e($q) ?>" placeholder="например: заявка">
  <div class="muted" id="texts-count" style="margin-top:6px"></div>
</div>

<form method="post" action="<?= $e(admin_url('texts')) ?>" data-guard="1">
  <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
  <input type="hidden" name="g" value="<?= $e($g) ?>">

  <?php foreach ($rows as $k => $byLang):
      $hay = mb_strtolower($k . ' ' . implode(' ', $byLang));
      $own = !empty($store[$k]);
      $long = mb_strlen($byLang[deflang()] ?? '') > 90;
  ?>
    <div class="item" data-text-row="<?= $e($hay) ?>">
      <div style="display:flex;gap:10px;align-items:baseline;flex-wrap:wrap;margin-bottom:4px">
        <b class="mono"><?= $e($k) ?></b>
        <?php if ($own): ?><span class="pill">правлено в панели</span><?php endif; ?>
      </div>
      <div class="row3">
        <?php foreach (langs() as $l): ?>
          <div>
            <div class="muted" style="margin-bottom:4px"><b><?= $e(strtoupper($l)) ?></b></div>
            <?php if ($long): ?>
              <textarea rows="4" name="t[<?= $e($k) ?>][<?= $e($l) ?>]"
                        placeholder="<?= $l === deflang() ? '' : 'пусто — возьмётся русский' ?>"><?= $e($byLang[$l] ?? '') ?></textarea>
            <?php else: ?>
              <input type="text" name="t[<?= $e($k) ?>][<?= $e($l) ?>]"
                     value="<?= $e($byLang[$l] ?? '') ?>"
                     placeholder="<?= $l === deflang() ? '' : 'пусто — возьмётся русский' ?>">
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endforeach; ?>

  <div class="btnrow">
    <button class="btn" type="submit">Сохранить раздел</button>
    <a class="btn ghost" href="<?= $e(admin_url('texts', ['g' => $g])) ?>">Отменить</a>
  </div>
</form>

<?php admin_foot(); ?>
