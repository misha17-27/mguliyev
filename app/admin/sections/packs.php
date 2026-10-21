<?php
/* Пакеты на странице цен.

   Сумма не переводится: ₼700 одинаково на всех трёх языках. Переводится
   приписка к ней («от», «-dən», «from») — именно она в разных языках
   стоит с разной стороны от числа, поэтому и вынесена отдельным полем.

   НОВЫЙ ПАКЕТ ЗАВОДИТСЯ НА РУССКОМ, какой бы язык ни был выбран вверху:
   пакет без русского названия — пустая карточка на русской странице цен.
   Переводы — после, в карточке пакета.

   КЛЮЧ У КАЖДОГО ПАКЕТА СВОЙ. Совпавший ключ — ошибка, а не повод
   выбросить один из пакетов: раньше второй молча пропадал вместе
   с текстами на трёх языках, а панель говорила «Сохранено». */

$e     = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$packs = packs_canon();
$DEF   = deflang();

/** Поля пакета из формы — одинаково для карточек и для нового. */
$read = static function ($r): array {
    $r = is_array($r) ? $r : [];
    return [
        'name'    => post_langs($r['name'] ?? []),
        'sum'     => post_one($r['sum'] ?? ''),
        'note'    => post_langs($r['note'] ?? []),
        'parts'   => post_langs($r['parts'] ?? [], true),
        'who'     => post_langs($r['who'] ?? [], true),
        'missing' => post_langs($r['missing'] ?? [], true),
    ];
};

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
    $new  = (array)($_POST['new'] ?? []);
    $nf   = $read($new);
    $nk   = post_one($new['key'] ?? '');
    $out  = [];
    $seen = [];                 // ключ => какой пакет его занял, для сообщения
    $badPacks = [];
    $noName   = false;

    /* Всё вписанное — на случай ошибки: форма одна на все пакеты, и отказ
       из-за одного поля не должен стирать правки в остальных. Метка версии —
       чтобы черновик не лёг поверх правки, сделанной из другого места. */
    $draft = ['ver' => Store::stamp('packs.json'), 'p' => [], 'del' => [], 'new' => $nf + ['key' => $nk]];

    foreach ($in as $key => $row) {
        if (!is_array($row)) continue;
        $f = $read($row);
        $draft['p'][$key] = $f + ['key' => post_one($row['key'] ?? (string)$key)];
        if (!empty($del[$key])) { $draft['del'][$key] = 1; continue; }   // отмечен на удаление

        $k   = post_slug($row['key'] ?? $key, (string)$key);
        $ru  = $f['name'][$DEF];
        $who = $ru !== '' ? '«' . $ru . '»' : $k;
        if ($k === '') { $badPacks[] = 'у пакета ' . $who . ' пустой ключ'; continue; }
        if (isset($seen[$k])) {
            /* Строку без флажка не выбрасываем никогда: второй пакет с тем же
               ключом раньше молча пропадал целиком. */
            $badPacks[] = 'ключ ' . $k . ' стоит у двух пакетов — ' . $seen[$k] . ' и ' . $who;
            continue;
        }
        $seen[$k] = $who;

        if ($ru === '') {
            /* Удаляет пакет только флажок: стёртое название — случайность. */
            $badPacks[] = 'у пакета ' . $k . ' пустое русское название';
            $noName = true;
            continue;
        }
        $out[] = ['key' => $k] + $f;
    }

    /* Новый пакет из нижней формы. Пустая форма просто не сохраняется,
       а вписанное без русского названия — ошибка: раньше оно пропадало
       под «Сохранено». */
    $typed = $nk !== '';
    foreach ($nf as $v) $typed = $typed || implode('', (array)$v) !== '';
    if ($typed) {
        $k = post_slug($nk);
        if ($nf['name'][$DEF] === '') {
            $badPacks[] = 'у нового пакета нет русского названия — новый пакет заводится '
                . 'на русском, переводы добавляются после';
        } elseif ($k !== '' && isset($seen[$k])) {
            $badPacks[] = 'ключ ' . $k . ' для нового пакета уже занят пакетом ' . $seen[$k];
        } else {
            if ($k === '') {
                /* Первый свободный номер: по одному числу пакетов он совпадал
                   с занятым, если раньше пакет удаляли, — и новый пропадал. */
                $n = count($out) + 1;
                while (isset($seen['paket-' . $n])) $n++;
                $k = 'paket-' . $n;
            }
            $out[] = ['key' => $k] + $nf;
        }
    }

    if ($badPacks || !$out) {
        admin_draft_keep('packs', $draft);
        admin_flash($badPacks
            ? 'НЕ СОХРАНЕНО: ' . implode('; ', $badPacks) . '.'
                . ($noName ? ' Пакет удаляется только флажком «Удалить этот пакет».' : '')
            : 'НЕ СОХРАНЕНО: нельзя удалить все пакеты — страница цен останется пустой.', 'err');
        admin_go(admin_url('packs'));
    }

    if (Store::write('packs.json', $out)) {
        admin_flash('Сохранено. Пакетов: ' . count($out) . '.');
    } else {
        admin_draft_keep('packs', $draft);
        admin_flash('Не удалось сохранить. Проверьте права на папку ' . Store::dir(), 'err');
    }
    admin_go(admin_url('packs'));
}

/* Вписанное перед ошибкой — обратно в форму. Только если файл с тех пор
   не меняли: иначе черновик вернул бы старое поверх чужой правки. */
$draft = admin_draft_take('packs');
$lost  = $draft !== null && ($draft['ver'] ?? '') !== Store::stamp('packs.json');
$dr    = ($draft !== null && !$lost) ? $draft : [];

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

admin_head('packs');
?>

<div class="note">
  Сумма одна на все языки — её переводить нечего. А вот приписка рядом
  («от», «başlanğıc», «from») в разных языках стоит по-разному, поэтому у неё
  своё поле на каждый язык. В азербайджанском лучше слово, а не окончание:
  -dan/-dən зависит от последнего слова числа (₼1 190-dan, ₼700-dən)
  и ломается при смене суммы.
</div>

<?php if ($lost): ?>
  <div class="flash warn">Вписанное перед ошибкой в форму не возвращено: «Пакеты» за это время
    правили из другого места. Ниже — то, что сохранено сейчас.</div>
<?php endif; ?>

<form method="post" action="<?= $e(admin_url('packs')) ?>" data-guard="1"
      data-confirm="Сохранить изменения в пакетах? Отмеченные на удаление исчезнут со страницы цен.">
  <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <?= admin_ver_field('packs.json') ?>

  <?php foreach ($packs as $p):
    $k    = $p['key'];
    $head = tr($p['name'], $DEF);          // заголовок — по сохранённому: так видно, какой это пакет
    $kv   = $k;
    $d    = $dr['p'][$k] ?? null;
    if (is_array($d)) {
        foreach (['name', 'sum', 'note', 'parts', 'who', 'missing'] as $f) {
            if (isset($d[$f])) $p[$f] = $d[$f];
        }
        $kv = (string)($d['key'] ?? $k);
    }
  ?>
    <div class="panel">
      <h3><?= $e($head) ?> <span class="pill grey mono"><?= $e($k) ?></span></h3>

      <div class="row">
        <div>
          <label>Сумма <span class="hint">как показывать: ₼700</span></label>
          <input type="text" name="p[<?= $e($k) ?>][sum]" value="<?= $e($p['sum']) ?>">
        </div>
        <div>
          <label>Ключ <span class="hint">латиницей, для ссылок и переводов</span></label>
          <input type="text" name="p[<?= $e($k) ?>][key]" value="<?= $e($kv) ?>" class="mono">
        </div>
      </div>

      <?php
      admin_field_langs('p[' . $k . '][name]', $p['name'], 'Название пакета');
      admin_field_langs('p[' . $k . '][note]', $p['note'], 'Приписка к сумме', ['hint' => 'от / başlanğıc / from']);
      admin_field_langs('p[' . $k . '][parts]', $p['parts'], 'Что входит',
          ['area' => true, 'rows' => 3, 'hint' => 'пункты через ·']);
      admin_field_langs('p[' . $k . '][who]', $p['who'], 'Кому подходит', ['area' => true, 'rows' => 4]);
      admin_field_langs('p[' . $k . '][missing]', $p['missing'], 'Чего в пакете нет',
          ['area' => true, 'rows' => 2, 'hint' => 'пусто — строки на странице не будет']);
      ?>

      <label class="check">
        <input type="checkbox" name="del[<?= $e($k) ?>]" value="1"<?= !empty($dr['del'][$k]) ? ' checked' : '' ?>>
        Удалить этот пакет при сохранении
      </label>
    </div>
  <?php endforeach; ?>

  <?php $nd = (array)($dr['new'] ?? []); ?>
  <div class="panel">
    <h3>Добавить пакет</h3>
    <p class="muted">Заполните хотя бы название по-русски — остальное можно дописать потом.
       Пустая форма просто не сохранится.</p>
    <?php if (admin_lang() !== $DEF): ?>
      <p class="muted">Новый пакет заводится на русском — он основа для переводов. Перевод
         на <?= $e(strtoupper(admin_lang())) ?> — сразу после сохранения, в карточке пакета выше.</p>
    <?php endif; ?>
    <div class="row">
      <div>
        <label>Сумма</label>
        <input type="text" name="new[sum]" value="<?= $e($nd['sum'] ?? '') ?>" placeholder="₼900">
      </div>
      <div>
        <label>Ключ <span class="hint">пусто — придумается сам</span></label>
        <input type="text" name="new[key]" value="<?= $e($nd['key'] ?? '') ?>" class="mono" placeholder="lending">
      </div>
    </div>
    <?php
    $nv = static fn(string $f): array => (array)($nd[$f] ?? []);
    $ruField('new[name]', $nv('name'), 'Название пакета');
    $ruField('new[note]', $nv('note'), 'Приписка к сумме');
    $ruField('new[parts]', $nv('parts'), 'Что входит', ['area' => true, 'rows' => 3]);
    $ruField('new[who]', $nv('who'), 'Кому подходит', ['area' => true, 'rows' => 3]);
    $ruField('new[missing]', $nv('missing'), 'Чего в пакете нет', ['area' => true, 'rows' => 2]);
    ?>
  </div>

  <div class="btnrow">
    <button class="btn" type="submit">Сохранить</button>
    <a class="btn ghost" href="<?= $e(admin_url('dashboard')) ?>">Отменить</a>
    <a class="btn ghost" href="/tseny/" target="_blank" rel="noopener">Открыть страницу цен ↗</a>
  </div>
</form>

<?php admin_foot(); ?>
