<?php
/* Каталог услуг: четыре направления, внутри — услуги списком.

   Ключ направления участвует в адресе страницы (/uslugi/veb-sayty/),
   поэтому менять его из панели нельзя: файл страницы лежит в репозитории
   под этим же именем, и переименование оставило бы ссылку в никуда.
   Добавить направление тоже нельзя — для него нужен файл страницы.
   Это не недоделка, а граница: панель правит тексты, а не структуру сайта.

   НОВАЯ УСЛУГА ЗАВОДИТСЯ НА РУССКОМ, какой бы язык ни был выбран вверху:
   русский — основа, другие языки берут его, пока перевода нет. Поэтому же
   у направления обязательны русские название и заголовок страницы. */

$e   = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$cat = catalog_canon();
$cur = post_slug($_GET['c'] ?? '');
$DEF = deflang();

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $slug = post_slug($_POST['slug'] ?? '');

    /* Форма собирает файл целиком, поэтому вкладка, открытая час
       назад, вернула бы всё к состоянию часовой давности — и панель
       сказала бы «Сохранено». Метка версии это ловит. Возвращаем в то же
       направление, но без вписанного: оно собрано поверх старых данных. */
    if (admin_stale('catalog.json')) {
        admin_flash('«Услуги» правили из другого места, пока эта страница была '
            . 'открыта. Чтобы не затереть ту правку, сохранение отменено: '
            . 'обновите страницу и внесите изменения заново.', 'err');
        admin_go(admin_url('uslugi', isset($cat[$slug]) ? ['c' => $slug] : []));
    }

    if (!isset($cat[$slug])) {
        admin_flash('Направление не найдено.', 'err');
        admin_go(admin_url('uslugi'));
    }

    $title = post_langs($_POST['title'] ?? []);
    $h1    = post_langs($_POST['h1'] ?? []);
    $lead  = post_langs($_POST['lead'] ?? [], true);
    $del   = (array)($_POST['del'] ?? []);
    $rows  = (array)($_POST['i'] ?? []);
    $new   = (array)($_POST['new'] ?? []);
    $nn    = ['name' => post_langs($new['name'] ?? []), 'desc' => post_langs($new['desc'] ?? [], true)];
    $items = [];
    $back  = admin_url('uslugi', ['c' => $slug]);

    /* Всё вписанное — на случай ошибки: форма одна на всё направление,
       и отказ из-за одного поля не должен стирать правки в остальных.
       Метка версии — чтобы черновик не лёг поверх правки, сделанной
       из другого места. */
    $draft = ['ver' => Store::stamp('catalog.json'), 'title' => $title, 'h1' => $h1,
              'lead' => $lead, 'i' => [], 'del' => [], 'new' => $nn];

    $bad    = [];
    $noName = false;
    /* Пустой русский — пустой пункт меню и пустой H1 на русском сайте:
       чужой язык на его место не подставляется. */
    if ($title[$DEF] === '') $bad[] = 'пустое русское название направления';
    if ($h1[$DEF] === '')    $bad[] = 'пустой русский заголовок страницы';

    foreach ($rows as $idx => $row) {
        if (!is_array($row)) continue;
        $it = ['name' => post_langs($row['name'] ?? []), 'desc' => post_langs($row['desc'] ?? [], true)];
        $draft['i'][$idx] = $it;
        if (!empty($del[$idx])) { $draft['del'][$idx] = 1; continue; }
        /* Удаляет услугу только флажок: стёртое название — это скорее
           случайность, чем намерение, и молча терять из-за неё описание
           на трёх языках нельзя. */
        if ($it['name'][$DEF] === '') {
            $bad[] = 'у услуги №' . ((int)$idx + 1) . ' пустое русское название';
            $noName = true;
            continue;
        }
        $items[] = $it;
    }

    /* Новая услуга из нижней формы. Пустая форма просто не сохраняется,
       а вписанное без русского названия — ошибка: раньше оно пропадало
       под «Сохранено». */
    if (implode('', $nn['name']) . implode('', $nn['desc']) !== '') {
        if ($nn['name'][$DEF] === '') {
            $bad[] = 'у новой услуги нет русского названия — новая услуга заводится '
                . 'на русском, переводы добавляются после';
        } else {
            $items[] = $nn;
        }
    }

    if ($bad || !$items) {
        admin_draft_keep('uslugi:' . $slug, $draft);
        admin_flash($bad
            ? 'НЕ СОХРАНЕНО: ' . implode('; ', $bad) . '.'
                . ($noName ? ' Услуга удаляется только флажком «Удалить услугу».' : '')
            : 'Нельзя удалить все услуги направления: страница /uslugi/' . $slug
                . '/ останется с пустым списком. Оставьте хотя бы одну.', 'err');
        admin_go($back);
    }

    $cat[$slug]['title'] = $title;
    $cat[$slug]['h1']    = $h1;
    $cat[$slug]['lead']  = $lead;
    $cat[$slug]['items'] = $items;

    if (Store::write('catalog.json', $cat)) {
        admin_flash('Сохранено. Услуг в направлении: ' . count($items) . '.');
    } else {
        admin_draft_keep('uslugi:' . $slug, $draft);
        admin_flash('Не удалось сохранить. Проверьте права на папку ' . Store::dir(), 'err');
    }
    admin_go($back);
}

/** Поле формы добавления — всегда русское: новое заводится на русском.
    Другие языки едут скрытыми полями: обычно пустыми, а после ошибки —
    с тем, что уже успели вписать, и это видно под полем. */
$ruField = static function (string $name, array $vals, string $label, array $o = []) use ($e, $DEF): void {
    echo '<label>' . $e($label) . ' <span class="pill grey" style="vertical-align:1px">'
       . $e(strtoupper($DEF)) . '</span></label>';
    $nm = $e($name . '[' . $DEF . ']');
    $v  = (string)($vals[$DEF] ?? '');
    if (!empty($o['area'])) {
        echo '<textarea name="' . $nm . '" rows="' . (int)($o['rows'] ?? 2) . '">' . $e($v) . '</textarea>';
    } else {
        echo '<input type="text" name="' . $nm . '" value="' . $e($v) . '">';
    }
    foreach (langs() as $l) {
        if ($l === $DEF) continue;
        $t = (string)($vals[$l] ?? '');
        if ($t !== '') echo '<div class="src"><b>' . $e(strtoupper($l)) . ':</b> ' . $e($t) . '</div>';
        echo '<input type="hidden" name="' . $e($name . '[' . $l . ']') . '" value="' . $e($t) . '">';
    }
};

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
    <?php admin_list_head(count($cat), 'Направлений'); ?>
    <div class="tablewrap">
      <table class="list">
        <tr>
          <th class="num">№</th><th>Направление</th><th>Адрес</th>
          <th>Услуг</th><th>Перевод</th><th>SEO</th><th class="right"></th>
        </tr>
        <?php $seo = seo_canon(); $i = 0; foreach ($cat as $slug => $c):
          /* Ключ в seo.php плоский — «veb-sayty», а не «uslugi/veb-sayty»:
             тот же, что $page в файле страницы. С путём точка врала,
             показывая «не заполнено» у заполненных. */
          $hasSeo = !empty($seo[$slug][deflang()]['title']);
          $fill = [];
          foreach (langs() as $l) $fill[$l] = ($c['title'][$l] ?? '') !== '' ? 1 : 0; ?>
        <tr>
          <td class="num"><?= admin_num($i++) ?></td>
          <td><b><?= $e(tr($c['title'], deflang())) ?></b><br>
              <span class="muted"><?= $e(mb_strimwidth(tr($c['lead'], deflang()), 0, 72, '…', 'UTF-8')) ?></span></td>
          <td><span class="path">/uslugi/<?= $e($slug) ?>/</span></td>
          <td><b><?= count($c['items']) ?></b></td>
          <td><?= admin_lang_badges($fill, '/uslugi/' . $slug . '/') ?></td>
          <td><?= admin_dot($hasSeo, 'заголовок для поиска') ?></td>
          <td class="right"><div class="acts">
            <a class="btn sm" href="<?= $e(admin_url('uslugi', ['c' => $slug])) ?>">Изменить</a>
            <a class="btn sm" href="/uslugi/<?= $e($slug) ?>/" target="_blank" rel="noopener">Открыть</a>
          </div></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>

<?php else:
    $c    = $cat[$cur];
    $head = tr($c['title'], $DEF);         // заголовок — по сохранённому: так видно, что правим

    /* Вписанное перед ошибкой — обратно в форму. Только если файл с тех пор
       не меняли: иначе черновик вернул бы старое поверх чужой правки. */
    $draft = admin_draft_take('uslugi:' . $cur);
    $lost  = $draft !== null && ($draft['ver'] ?? '') !== Store::stamp('catalog.json');
    $dr    = ($draft !== null && !$lost) ? $draft : [];
    foreach (['title', 'h1', 'lead'] as $f) {
        if (is_array($dr[$f] ?? null)) $c[$f] = $dr[$f];
    }
?>
  <p style="margin:0 0 16px"><a class="btn sm" href="<?= $e(admin_url('uslugi')) ?>">← Все направления</a></p>

  <?php if ($lost): ?>
    <div class="flash warn">Вписанное перед ошибкой в форму не возвращено: «Услуги» за это время
      правили из другого места. Ниже — то, что сохранено сейчас.</div>
  <?php endif; ?>

  <form method="post" action="<?= $e(admin_url('uslugi')) ?>" data-guard="1">
    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <?= admin_ver_field('catalog.json') ?>
    <input type="hidden" name="slug" value="<?= $e($cur) ?>">

    <div class="panel">
      <h3><?= $e($head) ?> <span class="pill grey mono">/uslugi/<?= $e($cur) ?>/</span></h3>
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
      <?php foreach ($c['items'] as $idx => $it):
        $was = tr($it['name'], $DEF);
        if (is_array($dr['i'][$idx] ?? null)) $it = $dr['i'][$idx] + $it;
      ?>
        <div class="item">
          <h4><?= $e($was) ?></h4>
          <?php
          admin_field_langs('i[' . $idx . '][name]', $it['name'], 'Название');
          admin_field_langs('i[' . $idx . '][desc]', $it['desc'], 'Описание одной строкой', ['area' => true, 'rows' => 2]);
          ?>
          <label class="check">
            <input type="checkbox" name="del[<?= $idx ?>]" value="1"<?= !empty($dr['del'][$idx]) ? ' checked' : '' ?>>
            Удалить услугу
          </label>
        </div>
      <?php endforeach; ?>

      <div class="item" style="background:var(--ok-bg-2);border-color:var(--ok-line)">
        <h4>Добавить услугу</h4>
        <?php if (admin_lang() !== $DEF): ?>
          <p class="muted">Новая услуга заводится на русском — он основа для переводов. Перевод
             на <?= $e(strtoupper(admin_lang())) ?> — сразу после сохранения, в её карточке выше.</p>
        <?php endif; ?>
        <?php
        $nd = (array)($dr['new'] ?? []);
        $ruField('new[name]', (array)($nd['name'] ?? []), 'Название');
        $ruField('new[desc]', (array)($nd['desc'] ?? []), 'Описание одной строкой', ['area' => true, 'rows' => 2]);
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
