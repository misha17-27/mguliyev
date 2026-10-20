<?php
/* Пакеты на странице цен.

   Сумма не переводится: ₼700 одинаково на всех трёх языках. Переводится
   приписка к ней («от», «-dən», «from») — именно она в разных языках
   стоит с разной стороны от числа, поэтому и вынесена отдельным полем. */

$e     = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$packs = packs_canon();

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    /* Форма собирает файл целиком, поэтому вкладка, открытая час
       назад, вернула бы всё к состоянию часовой давности — и панель
       сказала бы «Сохранено». Метка версии это ловит. */
    if (admin_stale('packs.json')) {
        admin_flash('«Пакеты» правили из другого места, пока эта страница была '
            . 'открыта. Чтобы не затереть ту правку, сохранение отменено: '
            . 'обновите страницу и внесите изменения заново.', 'err');
        admin_go(admin_url('packs'));
    }

    $in   = (array)($_POST['p'] ?? []);
    $del  = (array)($_POST['del'] ?? []);
    $out  = [];
    $seen = [];
    $badPacks = [];

    foreach ($in as $key => $row) {
        if (!is_array($row)) continue;
        if (!empty($del[$key])) continue;                      // отмечен на удаление

        $k = post_slug($row['key'] ?? $key, (string)$key);
        if ($k === '' || isset($seen[$k])) continue;           // пустой или повторный ключ
        $seen[$k] = true;

        $name = post_langs($row['name'] ?? []);
        if (($name[deflang()] ?? '') === '') {
            /* Удаляет пакет только флажок: стёртое название — случайность. */
            $badPacks[] = 'у пакета ' . $k . ' пустое русское название';
            continue;
        }

        $out[] = [
            'key'     => $k,
            'name'    => $name,
            'sum'     => post_one($row['sum'] ?? ''),
            'note'    => post_langs($row['note'] ?? []),
            'parts'   => post_langs($row['parts'] ?? [], true),
            'who'     => post_langs($row['who'] ?? [], true),
            'missing' => post_langs($row['missing'] ?? [], true),
        ];
    }

    /* Новый пакет из нижней формы. */
    $new = (array)($_POST['new'] ?? []);
    $nn  = post_langs($new['name'] ?? []);
    if (($nn[deflang()] ?? '') !== '') {
        $k = post_slug($new['key'] ?? '', 'paket-' . (count($out) + 1));
        if (!isset($seen[$k])) {
            $out[] = [
                'key'     => $k,
                'name'    => $nn,
                'sum'     => post_one($new['sum'] ?? ''),
                'note'    => post_langs($new['note'] ?? []),
                'parts'   => post_langs($new['parts'] ?? [], true),
                'who'     => post_langs($new['who'] ?? [], true),
                'missing' => post_langs($new['missing'] ?? [], true),
            ];
        }
    }

    if ($badPacks) {
        admin_flash('НЕ СОХРАНЕНО: ' . implode('; ', $badPacks) . '. Пакет удаляется только '
            . 'флажком «Удалить этот пакет».', 'err');
        admin_go(admin_url('packs'));
    }

    if (!$out) {
        admin_flash('Нельзя удалить все пакеты: страница цен останется пустой.', 'err');
    } elseif (Store::write('packs.json', $out)) {
        admin_flash('Сохранено. Пакетов: ' . count($out) . '.');
    } else {
        admin_flash('Не удалось сохранить.', 'err');
    }
    admin_go(admin_url('packs'));
}

admin_head('packs');
?>

<div class="note">
  Сумма одна на все языки — её переводить нечего. А вот приписка рядом
  («от», «-dən», «from») в разных языках стоит по-разному, поэтому у неё
  своё поле на каждый язык.
</div>

<form method="post" action="<?= $e(admin_url('packs')) ?>" data-guard="1"
      data-confirm="Сохранить изменения в пакетах? Отмеченные на удаление исчезнут со страницы цен.">
  <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <?= admin_ver_field('packs.json') ?>

  <?php foreach ($packs as $p): $k = $p['key']; ?>
    <div class="panel">
      <h3><?= $e(tr($p['name'], deflang())) ?> <span class="pill grey mono"><?= $e($k) ?></span></h3>

      <div class="row">
        <div>
          <label>Сумма <span class="hint">как показывать: ₼700</span></label>
          <input type="text" name="p[<?= $e($k) ?>][sum]" value="<?= $e($p['sum']) ?>">
        </div>
        <div>
          <label>Ключ <span class="hint">латиницей, для ссылок и переводов</span></label>
          <input type="text" name="p[<?= $e($k) ?>][key]" value="<?= $e($k) ?>" class="mono">
        </div>
      </div>

      <?php
      admin_field_langs('p[' . $k . '][name]', $p['name'], 'Название пакета');
      admin_field_langs('p[' . $k . '][note]', $p['note'], 'Приписка к сумме', ['hint' => 'от / -dən / from']);
      admin_field_langs('p[' . $k . '][parts]', $p['parts'], 'Что входит',
          ['area' => true, 'rows' => 3, 'hint' => 'пункты через ·']);
      admin_field_langs('p[' . $k . '][who]', $p['who'], 'Кому подходит', ['area' => true, 'rows' => 4]);
      admin_field_langs('p[' . $k . '][missing]', $p['missing'], 'Чего в пакете нет',
          ['area' => true, 'rows' => 2, 'hint' => 'пусто — строки на странице не будет']);
      ?>

      <label class="check">
        <input type="checkbox" name="del[<?= $e($k) ?>]" value="1">
        Удалить этот пакет при сохранении
      </label>
    </div>
  <?php endforeach; ?>

  <div class="panel">
    <h3>Добавить пакет</h3>
    <p class="muted">Заполните хотя бы название по-русски — остальное можно дописать потом.
       Пустая форма просто не сохранится.</p>
    <div class="row">
      <div>
        <label>Сумма</label>
        <input type="text" name="new[sum]" placeholder="₼900">
      </div>
      <div>
        <label>Ключ <span class="hint">пусто — придумается сам</span></label>
        <input type="text" name="new[key]" class="mono" placeholder="lending">
      </div>
    </div>
    <?php
    $blank = array_fill_keys(langs(), '');
    admin_field_langs('new[name]', $blank, 'Название пакета');
    admin_field_langs('new[note]', $blank, 'Приписка к сумме');
    admin_field_langs('new[parts]', $blank, 'Что входит', ['area' => true, 'rows' => 3]);
    admin_field_langs('new[who]', $blank, 'Кому подходит', ['area' => true, 'rows' => 3]);
    admin_field_langs('new[missing]', $blank, 'Чего в пакете нет', ['area' => true, 'rows' => 2]);
    ?>
  </div>

  <div class="btnrow">
    <button class="btn" type="submit">Сохранить</button>
    <a class="btn ghost" href="<?= $e(admin_url('dashboard')) ?>">Отменить</a>
    <a class="btn ghost" href="/tseny/" target="_blank" rel="noopener">Открыть страницу цен ↗</a>
  </div>
</form>

<?php admin_foot(); ?>
