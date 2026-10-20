<?php
/* Каталог услуг: четыре направления, внутри — услуги списком.

   Ключ направления участвует в адресе страницы (/uslugi/veb-sayty/),
   поэтому менять его из панели нельзя: файл страницы лежит в репозитории
   под этим же именем, и переименование оставило бы ссылку в никуда.
   Добавить направление тоже нельзя — для него нужен файл страницы.
   Это не недоделка, а граница: панель правит тексты, а не структуру сайта. */

$e   = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$cat = catalog_canon();
$cur = post_slug($_GET['c'] ?? '');

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $slug = post_slug($_POST['slug'] ?? '');
    if (!isset($cat[$slug])) {
        admin_flash('Направление не найдено.', 'err');
        admin_go(admin_url('uslugi'));
    }

    $cat[$slug]['title'] = post_langs($_POST['title'] ?? []);
    $cat[$slug]['h1']    = post_langs($_POST['h1'] ?? []);
    $cat[$slug]['lead']  = post_langs($_POST['lead'] ?? [], true);

    $del   = (array)($_POST['del'] ?? []);
    $rows  = (array)($_POST['i'] ?? []);
    $items = [];

    foreach ($rows as $idx => $row) {
        if (!is_array($row) || !empty($del[$idx])) continue;
        $name = post_langs($row['name'] ?? []);
        if (($name[deflang()] ?? '') === '') continue;      // услуга без названия не нужна
        $items[] = ['name' => $name, 'desc' => post_langs($row['desc'] ?? [], true)];
    }

    $new = (array)($_POST['new'] ?? []);
    $nn  = post_langs($new['name'] ?? []);
    if (($nn[deflang()] ?? '') !== '') {
        $items[] = ['name' => $nn, 'desc' => post_langs($new['desc'] ?? [], true)];
    }

    $cat[$slug]['items'] = $items;

    Store::write('catalog.json', $cat)
        ? admin_flash('Сохранено. Услуг в направлении: ' . count($items) . '.')
        : admin_flash('Не удалось сохранить.', 'err');
    admin_go(admin_url('uslugi', ['c' => $slug]));
}

admin_head('uslugi');

if (!isset($cat[$cur])):
?>
  <div class="note">
    Ключ направления — часть адреса страницы, поэтому он не правится отсюда:
    файл страницы лежит в репозитории под этим же именем, и переименование
    оставило бы ссылку в никуда. Новое направление тоже добавляется вместе
    со своей страницей, а не одной записью в списке.
  </div>

  <div class="panel">
    <h3>Направления — <?= count($cat) ?></h3>
    <div class="tablewrap">
      <table>
        <tr><th>Направление</th><th>Адрес</th><th>Услуг</th><th class="right"></th></tr>
        <?php foreach ($cat as $slug => $c): ?>
        <tr>
          <td><b><?= $e(tr($c['title'], deflang())) ?></b><br>
              <span class="muted"><?= $e(mb_strimwidth(tr($c['lead'], deflang()), 0, 80, '…', 'UTF-8')) ?></span></td>
          <td class="mono">/uslugi/<?= $e($slug) ?>/</td>
          <td><b><?= count($c['items']) ?></b></td>
          <td class="right"><a class="btn sm" href="<?= $e(admin_url('uslugi', ['c' => $slug])) ?>">Править</a></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>

<?php else: $c = $cat[$cur]; ?>
  <p style="margin:0 0 16px"><a class="btn ghost sm" href="<?= $e(admin_url('uslugi')) ?>">← Все направления</a></p>

  <form method="post" action="<?= $e(admin_url('uslugi')) ?>" data-guard="1">
    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <input type="hidden" name="slug" value="<?= $e($cur) ?>">

    <div class="panel">
      <h3><?= $e(tr($c['title'], deflang())) ?> <span class="pill grey mono">/uslugi/<?= $e($cur) ?>/</span></h3>
      <?php
      admin_field_langs('title', $c['title'], 'Название в меню и в списке',
          ['hint' => 'короткое: «Веб-сайты»']);
      admin_field_langs('h1', $c['h1'], 'Заголовок на самой странице',
          ['hint' => 'развёрнутый: «Разработка сайтов и интернет-магазинов в Баку»']);
      admin_field_langs('lead', $c['lead'], 'Вступление под заголовком', ['area' => true, 'rows' => 3]);
      ?>
    </div>

    <div class="panel">
      <h3>Услуги — <?= count($c['items']) ?></h3>
      <?php foreach ($c['items'] as $idx => $it): ?>
        <div class="item">
          <h4><?= $e(tr($it['name'], deflang())) ?></h4>
          <?php
          admin_field_langs('i[' . $idx . '][name]', $it['name'], 'Название');
          admin_field_langs('i[' . $idx . '][desc]', $it['desc'], 'Описание одной строкой', ['area' => true, 'rows' => 2]);
          ?>
          <label class="check">
            <input type="checkbox" name="del[<?= $idx ?>]" value="1">
            Удалить услугу
          </label>
        </div>
      <?php endforeach; ?>

      <div class="item" style="background:#f3f8f5;border-color:#cfe3d7">
        <h4>Добавить услугу</h4>
        <?php
        $blank = array_fill_keys(langs(), '');
        admin_field_langs('new[name]', $blank, 'Название');
        admin_field_langs('new[desc]', $blank, 'Описание одной строкой', ['area' => true, 'rows' => 2]);
        ?>
      </div>
    </div>

    <div class="btnrow">
      <button class="btn" type="submit">Сохранить направление</button>
      <a class="btn ghost" href="<?= $e(admin_url('uslugi')) ?>">Отменить</a>
      <a class="btn ghost" href="/uslugi/<?= $e($cur) ?>/" target="_blank" rel="noopener">Открыть страницу ↗</a>
    </div>
  </form>
<?php endif; ?>

<?php admin_foot(); ?>
