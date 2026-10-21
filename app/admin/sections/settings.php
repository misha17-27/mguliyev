<?php
/* Контакты, соцсети, цены вне прайса, документы.

   Форма строится из описания полей в app/data/settings.php, поэтому новое
   поле появляется здесь само — добавлять код не нужно.

   Телефон, почта и ссылки одинаковы на всех трёх языках. Часы работы,
   адрес, цены словами и способы оплаты — текст, и он переводится: такие
   поля (в описании 'i18n' => true) показаны на языке, выбранном вверху,
   с русским оригиналом под переводом. Остальные языки едут в форме
   скрытыми полями, поэтому сохранение одного языка другие не трогает. */

$e    = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$meta = settings_meta();

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    /* Форма собирает файл целиком, поэтому вкладка, открытая час
       назад, вернула бы всё к состоянию часовой давности — и панель
       сказала бы «Сохранено». Метка версии это ловит. */
    if (admin_stale('settings.json')) {
        admin_flash('«Контакты и цены» правили из другого места, пока эта страница была '
            . 'открыта. Чтобы не затереть ту правку, сохранение отменено: '
            . 'обновите страницу и внесите изменения заново.', 'err');
        admin_go(admin_url('settings'));
    }

    /* Файл пишется целиком, поэтому поле, которого НЕТ в запросе, —
       это не «стёрли», а «не дошло»: сервер обрезал длинную форму или
       запрос собран не браузером. Такое поле сохраняет прежнее значение.
       Раньше оно становилось пустым, и запрос с одним только ключом
       защиты молча стирал все контакты сайта. */
    $in = $_POST['f'] ?? null;
    if (!is_array($in) || !$in) {
        admin_flash('Форма пришла без полей — ничего не сохранено. Обновите страницу и повторите.', 'err');
        admin_go(admin_url('settings'));
    }
    $cur  = settings_canon();
    $out  = [];
    $bad  = [];
    $lost = 0;

    foreach ($meta as $k => $m) {
        if (!array_key_exists($k, $in)) {
            $out[$k] = $cur[$k];
            $lost++;
            continue;
        }

        if (!empty($m['i18n'])) {
            /* Переводимое поле приходит набором f[ключ][язык]. */
            $src = is_array($in[$k]) ? $in[$k] : [];
            $set = [];
            foreach (langs() as $l) {
                if (!array_key_exists($l, $src)) {
                    $set[$l] = (string)($cur[$k][$l] ?? '');
                    $lost++;
                    continue;
                }
                $set[$l] = clean_text(is_string($src[$l]) ? $src[$l] : '');
            }
            $out[$k] = $set;
            continue;
        }

        $v = clean_text(is_string($in[$k]) ? $in[$k] : '');
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
        $filled = count(array_filter($out, static fn($v) => is_array($v) ? ($v[deflang()] ?? '') !== '' : $v !== ''));
        $msg = 'Сохранено. Заполнено ' . $filled . ' из ' . count($meta) . ' полей.';
        if ($lost) {
            $bad[] = 'не дошло полей — ' . $lost . ', у них оставлены прежние значения';
        }
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

$vals  = settings(deflang());          // для пометок: на сайте их видно, пока пуст русский
$canon = settings_canon();
$L     = admin_lang();
$DEF   = deflang();

/* Группы в том порядке, в котором они описаны в файле настроек. */
$groups = [];
foreach ($meta as $k => $m) $groups[$m['group'] ?? 'Прочее'][$k] = $m;

$empty = count(array_filter($vals, static fn($v) => $v === ''));

admin_head('settings');
?>

<div class="note">
  Телефон, почта и ссылки одинаковы на всех языках. Часы работы, адрес и цены
  словами переводятся: они показаны на языке, выбранном вверху
  (<b><?= $e(strtoupper($L)) ?></b>), с русским оригиналом под переводом.
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
    <?= admin_ver_field('settings.json') ?>

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
          <?php if (!empty($m['i18n'])): ?>
            <span class="pill grey"><?= $e(strtoupper($L)) ?></span>
          <?php endif; ?>
          <?php if ($v === ''): ?>
            <span class="pill yellow">на сайте: [УТОЧНИТЬ: <?= $e($m['ask']) ?>]</span>
          <?php endif; ?>
        </label>
        <?php if (!empty($m['i18n'])):
          $set = (array)($canon[$k] ?? []); ?>
          <input type="text" id="f_<?= $e($k) ?>" name="f[<?= $e($k) ?>][<?= $e($L) ?>]"
                 value="<?= $e($set[$L] ?? '') ?>"
                 <?= $L !== $DEF ? 'placeholder="пусто — на сайте будет русский текст"' : '' ?>>
          <?php if ($L !== $DEF && ($set[$DEF] ?? '') !== ''): ?>
            <div class="src"><b><?= $e(strtoupper($DEF)) ?>:</b> <?= $e($set[$DEF]) ?></div>
          <?php endif; ?>
          <?php foreach (langs() as $l): if ($l === $L) continue; ?>
            <input type="hidden" name="f[<?= $e($k) ?>][<?= $e($l) ?>]" value="<?= $e($set[$l] ?? '') ?>">
          <?php endforeach; ?>
        <?php else: ?>
        <input type="<?= $e($html) ?>" id="f_<?= $e($k) ?>" name="f[<?= $e($k) ?>]"
               value="<?= $e($v) ?>"
               <?= $type === 'url' ? 'placeholder="https://…"' : '' ?>
               <?= $type === 'tel' ? 'inputmode="tel"' : '' ?>>
        <?php endif; ?>
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
