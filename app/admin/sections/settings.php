<?php
/* Контакты, соцсети, цены вне прайса, документы.

   Форма строится из описания полей в app/data/settings.php, поэтому новое
   поле появляется здесь само — добавлять код не нужно.

   Эти значения не переводятся: телефон, адрес профиля и сумма одинаковы
   на всех трёх языках. Переключатель языка в верхней строке на этот раздел
   не влияет, и об этом сказано прямо, чтобы редактор не искал подвох. */

$e    = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$meta = settings_meta();

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $in  = (array)($_POST['f'] ?? []);
    $out = [];
    $bad = [];

    foreach ($meta as $k => $m) {
        $v = clean_text($in[$k] ?? '');
        $type = $m['type'] ?? 'text';

        if ($v !== '') {
            if ($type === 'email' && !filter_var($v, FILTER_VALIDATE_EMAIL)) {
                $bad[] = $m['label'] . ': это не похоже на адрес почты';
                $v = s($k);                     // оставляем прежнее значение
            } elseif ($type === 'url') {
                /* Без схемы ссылка в href ведёт на страницу сайта, а не наружу:
                   дописываем https://, если человек вставил только домен. */
                if (!preg_match('~^https?://~i', $v)) $v = 'https://' . ltrim($v, '/');
                if (!filter_var($v, FILTER_VALIDATE_URL)) {
                    $bad[] = $m['label'] . ': это не похоже на адрес страницы';
                    $v = s($k);
                }
            } elseif ($type === 'tel' && !preg_match('/^[0-9+()\s-]{6,24}$/u', $v)) {
                $bad[] = $m['label'] . ': в номере есть лишние знаки';
                $v = s($k);
            }
        }
        $out[$k] = $v;
    }

    if (Store::write('settings.json', $out)) {
        $filled = count(array_filter($out, static fn($v) => $v !== ''));
        $msg = 'Сохранено. Заполнено ' . $filled . ' из ' . count($meta) . ' полей.';
        if ($bad) {
            admin_flash($msg . ' Не приняты: ' . implode('; ', $bad) . '.', 'warn');
        } else {
            admin_flash($msg);
        }
    } else {
        admin_flash('Не удалось сохранить. Проверьте права на папку ' . Store::dir(), 'err');
    }
    admin_go(admin_url('settings'));
}

$vals = settings();

/* Группы в том порядке, в котором они описаны в файле настроек. */
$groups = [];
foreach ($meta as $k => $m) $groups[$m['group'] ?? 'Прочее'][$k] = $m;

$empty = count(array_filter($vals, static fn($v) => $v === ''));

admin_head('settings');
?>

<div class="note">
  Эти значения одинаковы на всех языках, поэтому переключатель RU / AZ / EN
  на этот раздел не влияет.
  <?php if ($empty): ?>
    Не заполнено полей: <b><?= $empty ?></b>. На сайте вместо каждого стоит
    видимая пометка <b>[УТОЧНИТЬ: …]</b> — она исчезнет сама, как только
    появится значение.
  <?php else: ?>
    Заполнены все поля — пометок «уточнить» на сайте нет.
  <?php endif; ?>
</div>

<form method="post" action="<?= $e(admin_url('settings')) ?>" data-guard="1">
  <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">

  <?php foreach ($groups as $gname => $fields): ?>
    <div class="panel">
      <h3><?= $e($gname) ?></h3>
      <?php foreach ($fields as $k => $m):
        $v = $vals[$k] ?? '';
        $type = $m['type'] ?? 'text';
        $html = $type === 'email' ? 'email' : ($type === 'url' ? 'url' : 'text');
      ?>
        <label for="f_<?= $e($k) ?>">
          <?= $e($m['label']) ?>
          <?php if ($v === ''): ?>
            <span class="pill yellow">на сайте: [УТОЧНИТЬ: <?= $e($m['ask']) ?>]</span>
          <?php endif; ?>
        </label>
        <input type="<?= $e($html) ?>" id="f_<?= $e($k) ?>" name="f[<?= $e($k) ?>]"
               value="<?= $e($v) ?>"
               <?= $type === 'url' ? 'placeholder="https://…"' : '' ?>
               <?= $type === 'tel' ? 'inputmode="tel"' : '' ?>>
        <?php if (!empty($m['hint'])): ?>
          <div class="muted" style="margin-top:5px"><?= $e($m['hint']) ?></div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>

  <div class="btnrow">
    <button class="btn" type="submit">Сохранить</button>
    <a class="btn ghost" href="<?= $e(admin_url('dashboard')) ?>">Отменить</a>
  </div>
</form>

<?php admin_foot(); ?>
