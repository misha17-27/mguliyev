<?php
/* Сводка. Отвечает на три вопроса сразу: сколько всего содержимого,
   где дыры в переводах и что осталось уточнить.

   Список незаполненного здесь не для красоты. В текстах сайта намеренно
   стоят пометки [УТОЧНИТЬ: …] вместо выдуманных данных — адреса, цены
   продления, ссылки на соцсети. Пока их не заполнили, они видны
   посетителю, поэтому панель показывает их на первом же экране. */

$e = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

$works    = works_canon();
$cat      = catalog_canon();
$packs    = packs_canon();
$arts     = articles_canon();
$texts    = texts_canon();
$seo      = seo_canon();
$fill     = admin_lang_fill();

$projects = 0; $archived = 0; $covers = 0;
foreach ($works as $g) {
    foreach ($g['projects'] as $w) {
        $projects++;
        if (!empty($w['archived'])) $archived++;
        if (!empty($w['image'])) $covers++;   // так же, как на странице портфолио
    }
}

/* Незаполненные настройки: ровно они и показываются посетителю как
   «[УТОЧНИТЬ: …]». Список здесь — это список того, что ждёт ответа. */
$todo = [];
$vals = settings();
foreach (settings_meta() as $k => $m) {
    if (($vals[$k] ?? '') === '') {
        $todo[] = ['key' => $k, 'label' => $m['label'], 'group' => $m['group'] ?? '', 'hint' => $m['hint'] ?? ''];
    }
}

/* Пометки, если они всё же попали в словарь руками. */
foreach ($texts as $k => $byLang) {
    foreach ($byLang as $l => $v) {
        if ($v !== '' && stripos($v, 'УТОЧНИТЬ') !== false) {
            $todo[] = ['key' => $k, 'label' => 'строка ' . $k . ' (' . strtoupper($l) . ')',
                       'group' => 'Строки страниц', 'hint' => mb_strimwidth($v, 0, 90, '…', 'UTF-8')];
        }
    }
}

/* Незаполненные заголовки для поиска: страница без title в выдаче
   выглядит случайным набором слов. */
$seoGaps = [];
foreach ($seo as $page => $byLang) {
    foreach (langs() as $l) {
        foreach (['title', 'description'] as $f) {
            if (empty($byLang[$l][$f])) $seoGaps[] = $page . ' · ' . strtoupper($l) . ' · ' . $f;
        }
    }
}

/* Что уже сохранено через панель: редактор должен понимать, где правки
   уходят в хранилище, а где сайт пока работает на файлах разработчика. */
$saved = [];
foreach (['works' => 'Портфолио', 'catalog' => 'Услуги', 'packs' => 'Пакеты',
          'articles' => 'Блог', 'texts' => 'Строки', 'seo' => 'Заголовки'] as $f => $name) {
    $p = Store::dir() . '/' . $f . '.json';
    $saved[$name] = is_file($p) ? (int)filemtime($p) : 0;
}

admin_head('dashboard');
?>

<?php if (ts_is_test()): ?>
  <div class="flash warn">
    В разделе «Безопасность» стоят <b>тестовые ключи Cloudflare</b> — капча ничего
    не проверяет по-настоящему.
    <a href="<?= $e(admin_url('security')) ?>" style="color:#fff;text-decoration:underline">Заменить на свои</a>
  </div>
<?php endif; ?>

<div class="cards">
  <div class="card"><div class="n"><?= $projects ?></div><div class="l">проектов в портфолио</div></div>
  <div class="card"><div class="n"><?= count($works) ?></div><div class="l">отраслей</div></div>
  <div class="card"><div class="n"><?= count($arts) ?></div><div class="l">статей в блоге</div></div>
  <div class="card"><div class="n"><?= count($texts) ?></div><div class="l">строк в словаре</div></div>
</div>

<?php if ($todo): ?>
<div class="panel">
  <h3>Осталось уточнить — <?= count($todo) ?></h3>
  <p class="muted">Этого мы пока не знаем, поэтому на сайте вместо данных стоит
     видимая пометка <b>[УТОЧНИТЬ: …]</b>. Так сделано нарочно: лучше честная пометка,
     чем выдуманный адрес или цена. Заполните поле — пометка исчезнет сама,
     править вёрстку не нужно.</p>
  <div class="tablewrap">
    <table>
      <tr><th>Что</th><th>Раздел</th><th>Пояснение</th><th class="right"></th></tr>
      <?php foreach (array_slice($todo, 0, 30) as $t): ?>
      <tr>
        <td><b><?= $e($t['label']) ?></b></td>
        <td><span class="pill yellow"><?= $e($t['group']) ?></span></td>
        <td class="muted"><?= $e($t['hint']) ?></td>
        <td class="right">
          <a class="btn ghost sm" href="<?= $e($t['group'] === 'Строки страниц'
              ? admin_url('texts', ['q' => $t['key']])
              : admin_url('settings')) ?>">Заполнить</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <?php if (count($todo) > 30): ?>
    <p class="muted" style="margin-top:12px">Показаны первые 30 из <?= count($todo) ?>.</p>
  <?php endif; ?>
</div>
<?php endif; ?>

<div class="panel">
  <h3>Заполненность языков</h3>
  <p class="muted">Доля строк словаря, у которых есть перевод. Где перевода нет,
     сайт показывает русский текст, а не пустое место.</p>
  <div class="tablewrap">
    <table>
      <tr><th>Язык</th><th>Заполнено</th><th>Строк без перевода</th></tr>
      <?php foreach (langs() as $l):
        $miss = 0;
        foreach ($texts as $b) { if (($b[$l] ?? '') === '') $miss++; }
      ?>
      <tr>
        <td><b><?= $e(strtoupper($l)) ?></b><?= $l === deflang() ? ' <span class="pill">основной</span>' : '' ?></td>
        <td><b><?= (int)$fill[$l] ?>%</b></td>
        <td><?= $miss ?: '—' ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>

<div class="row">
  <div class="panel">
    <h3>Портфолио</h3>
    <table>
      <tr><td>Всего проектов</td><td class="right"><b><?= $projects ?></b></td></tr>
      <tr><td>Со снимком сайта</td><td class="right"><b><?= $covers ?></b></td></tr>
      <tr><td>В архиве (домен не открывается)</td><td class="right"><b><?= $archived ?></b></td></tr>
    </table>
    <div class="btnrow"><a class="btn" href="<?= $e(admin_url('portfolio')) ?>">Открыть портфолио</a></div>
  </div>

  <div class="panel">
    <h3>Заголовки для поиска</h3>
    <?php if ($seoGaps): ?>
      <p class="muted">Не заполнено: <b><?= count($seoGaps) ?></b> из <?= count($seo) * count(langs()) * 2 ?>.</p>
      <p class="muted mono"><?= $e(implode(', ', array_slice($seoGaps, 0, 8))) ?><?= count($seoGaps) > 8 ? '…' : '' ?></p>
    <?php else: ?>
      <p class="muted">Заполнены все страницы на всех языках — <?= count($seo) ?> × <?= count(langs()) ?>.</p>
    <?php endif; ?>
    <div class="btnrow"><a class="btn" href="<?= $e(admin_url('seo')) ?>">Открыть заголовки</a></div>
  </div>
</div>

<div class="panel">
  <h3>Где лежат правки</h3>
  <p class="muted">Панель пишет в <b class="mono"><?= $e(Store::dir()) ?></b>.
     Эта папка намеренно вне выкладки: разработчик обновляет код, а ваши правки
     остаются на месте. Пока раздел не сохранён ни разу, сайт берёт данные
     из файлов разработчика.</p>
  <div class="tablewrap">
    <table>
      <tr><th>Раздел</th><th>Последнее сохранение из панели</th></tr>
      <?php foreach ($saved as $name => $ts): ?>
      <tr>
        <td><?= $e($name) ?></td>
        <td><?= $ts ? $e(date('d.m.Y, H:i', $ts)) : '<span class="pill grey">файлы разработчика</span>' ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>

<?php admin_foot(); ?>
