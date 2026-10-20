<?php
/* Заявки с сайта.

   ПОЧЕМУ ОНИ ВООБЩЕ ЗДЕСЬ. Письмо может уйти и потеряться по дороге:
   попасть в спам, быть удалённым случайно, не дойти из-за переполненного
   ящика. Без этого списка единственная история заявок — чужой почтовый
   ящик, и посмотреть «что было в прошлом месяце» с другого устройства
   невозможно.

   ЭТО ЛИЧНЫЕ ДАННЫЕ. Имя и телефон живого человека лежат на диске.
   Поэтому: папка вне корня сайта, доступ только по паролю, и удаление
   на виду — и одной заявки, и всех старше выбранного срока. Раздел прямо
   говорит об этом редактору, а не прячет в примечание: хранить чужие
   телефоны вечно не нужно никому, и решение сколько хранить — его. */

$e = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

/** Все заявки, свежие сверху. Имя файла начинается с даты и времени,
    поэтому сортировка по имени и есть сортировка по времени. */
function leads_all(int $limit = 0): array
{
    $dir = Store::dir() . '/leads';
    if (!is_dir($dir)) return [];

    /* Имена начинаются с даты и времени, поэтому сортировка имён — это
       сортировка по времени, и читать можно только нужное количество
       самых свежих. Раньше читались ВСЕ файлы на каждую отрисовку: при
       тысячах заявок раздел с кнопкой удаления переставал открываться —
       как раз тогда, когда она нужнее всего. */
    $files = glob($dir . '/*.json') ?: [];
    rsort($files, SORT_STRING);
    if ($limit > 0) $files = array_slice($files, 0, $limit);

    $out = [];
    foreach ($files as $p) {
        $d = json_decode((string)@file_get_contents($p), true);
        if (!is_array($d)) continue;
        $d['file'] = basename($p);
        $out[] = $d;
    }
    return $out;
}

/** Сколько заявок всего — по именам файлов, не открывая их. */
function leads_count(): int
{
    $dir = Store::dir() . '/leads';
    return is_dir($dir) ? count(glob($dir . '/*.json') ?: []) : 0;
}

/** Имя файла заявки сверяем целиком, а не «чистим»: так ../ не пролезет
    ни в каком виде, и удалить что-то за пределами папки нельзя. */
function leads_valid_name(string $n): bool
{
    return (bool)preg_match('~^\d{4}-\d{2}-\d{2}-\d{6}-[0-9a-f]{6}\.json$~', $n);
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $what = post_one($_POST['do'] ?? '');
    $dir  = Store::dir() . '/leads';

    if ($what === 'read') {
        $n = post_one($_POST['file'] ?? '');
        if (leads_valid_name($n) && is_file($dir . '/' . $n)) {
            $d = json_decode((string)file_get_contents($dir . '/' . $n), true);
            if (is_array($d)) {
                $d['new'] = false;
                Store::write('leads/' . $n, $d);
            }
        }
        admin_go(admin_url('leads'));
    }

    if ($what === 'del') {
        $n = post_one($_POST['file'] ?? '');
        if (leads_valid_name($n) && is_file($dir . '/' . $n)) {
            @unlink($dir . '/' . $n);
            admin_flash('Заявка удалена. Восстановить её нечем.');
        }
        admin_go(admin_url('leads'));
    }

    if ($what === 'purge') {
        $days = (int)($_POST['days'] ?? 0);
        if ($days < 1 || $days > 3650) {
            admin_flash('Срок указан неверно.', 'err');
            admin_go(admin_url('leads'));
        }
        $edge = time() - $days * 86400;
        $n = 0;
        foreach (leads_all(0) as $l) {        // все, а не только показанные
            if ((int)($l['ts'] ?? 0) > 0 && (int)$l['ts'] < $edge && leads_valid_name($l['file'])) {
                @unlink($dir . '/' . $l['file']);
                $n++;
            }
        }
        admin_flash($n
            ? 'Удалено заявок: ' . $n . '. Старше ' . $days . ' дней не осталось.'
            : 'Заявок старше ' . $days . ' дней нет.');
        admin_go(admin_url('leads'));
    }

}

const LEADS_SHOWN = 200;

$total = leads_count();
$leads = leads_all(LEADS_SHOWN);
$new   = count(array_filter($leads, static fn($l) => !empty($l['new'])));
$bad   = count(array_filter($leads, static fn($l) => empty($l['sent'])));
$open  = post_one($_GET['open'] ?? '');

admin_head('leads');
?>

<?php if ($bad): ?>
  <div class="flash err">
    Письмо не ушло по <b><?= $bad ?></b> <?= $bad === 1 ? 'заявке' : 'заявкам' ?>.
    Сами заявки сохранены и видны ниже, но в почте их нет — проверьте настройки
    в разделе <a href="<?= $e(admin_url('mail')) ?>" style="color:#fff;text-decoration:underline">«Почта»</a>.
  </div>
<?php endif; ?>

<div class="cards">
  <div class="card"><div class="n"><?= $total ?></div><div class="l">заявок всего</div></div>
  <div class="card"><div class="n"><?= $new ?></div><div class="l">не просмотрено</div></div>
  <div class="card"><div class="n"><?= count($leads) - $bad ?></div><div class="l">ушло письмом<?= $total > LEADS_SHOWN ? ' из ' . LEADS_SHOWN . ' последних' : '' ?></div></div>
</div>

<?php if ($total > LEADS_SHOWN): ?>
  <div class="note">
    Показаны <b><?= LEADS_SHOWN ?></b> последних заявок из <b><?= $total ?></b>.
    Старые лежат на сервере и видны через cPanel → File Manager, папка
    <b class="mono">site-data/leads/</b>. Если их не нужно хранить —
    ниже есть удаление по сроку.
  </div>
<?php endif; ?>

<div class="panel">
  <?php admin_list_head(count($leads), 'Заявок'); ?>

  <?php if (!$leads): ?>
    <p class="muted">Пока ни одной. Заявки попадают сюда сразу при отправке формы —
       и когда письмо ушло, и когда не ушло.</p>
  <?php else: ?>
    <div class="tablewrap">
      <table class="list">
        <tr>
          <th class="num">№</th><th>Когда</th><th>Имя и телефон</th>
          <th>Услуга</th><th>Язык</th><th>Письмо</th><th class="right"></th>
        </tr>
        <?php foreach ($leads as $i => $l):
          $f = (array)($l['fields'] ?? []);
          $isOpen = $open === $l['file'];
        ?>
        <tr<?= !empty($l['new']) ? ' style="background:var(--ok-bg-2)"' : '' ?>>
          <td class="num"><?= admin_num($i) ?></td>
          <td><?= $e($l['at'] ?? '') ?><?php if (!empty($l['new'])): ?><br><span class="pill">новая</span><?php endif; ?></td>
          <td>
            <b><?= $e($f['Имя'] ?? '—') ?></b><br>
            <?php $tel = preg_replace('~[^0-9+]~', '', (string)($f['Телефон'] ?? '')); ?>
            <?php if ($tel !== ''): ?>
              <a href="tel:<?= $e($tel) ?>" class="mono"><?= $e($f['Телефон']) ?></a>
            <?php else: ?><span class="muted">телефона нет</span><?php endif; ?>
          </td>
          <td><?= $e($f['Услуга'] ?? '') ?><?php if (!empty($f['Бюджет'])): ?><br>
              <span class="muted"><?= $e($f['Бюджет']) ?></span><?php endif; ?></td>
          <td><span class="pill grey"><?= $e(strtoupper((string)($l['lang'] ?? '—'))) ?></span></td>
          <td>
            <?php if (!empty($l['sent'])): ?>
              <span class="pill">ушло</span>
            <?php else: ?>
              <span class="pill red">не ушло</span>
            <?php endif; ?>
          </td>
          <td class="right"><div class="acts">
            <a class="btn sm" href="<?= $e(admin_url('leads', $isOpen ? [] : ['open' => $l['file']])) ?>#z"><?= $isOpen ? 'Свернуть' : 'Открыть' ?></a>
            <?php if (!empty($l['new'])): ?>
              <form method="post" action="<?= $e(admin_url('leads')) ?>">
                <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
                <input type="hidden" name="do" value="read">
                <input type="hidden" name="file" value="<?= $e($l['file']) ?>">
                <button class="btn sm" type="submit">Просмотрено</button>
              </form>
            <?php endif; ?>
            <form method="post" action="<?= $e(admin_url('leads')) ?>"
                  data-confirm="Удалить заявку от <?= $e($f['Имя'] ?? '') ?>? Восстановить её будет нечем.">
              <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
              <input type="hidden" name="do" value="del">
              <input type="hidden" name="file" value="<?= $e($l['file']) ?>">
              <button class="btn x" type="submit" title="Удалить">✕</button>
            </form>
          </div></td>
        </tr>
        <?php if ($isOpen): ?>
        <tr id="z">
          <td colspan="7" style="background:var(--field)">
            <div class="item" style="margin:0">
              <?php foreach ($f as $k => $v): if ($v === '') continue; ?>
                <div class="rowk" style="margin-bottom:8px">
                  <div class="muted"><?= $e($k) ?></div>
                  <div><?= nl2br($e($v)) ?></div>
                </div>
              <?php endforeach; ?>
              <div class="rowk" style="margin-bottom:8px">
                <div class="muted">Адрес посетителя</div>
                <div class="mono"><?= $e($l['ip'] ?? '—') ?></div>
              </div>
              <?php if (!empty($l['captcha'])): ?>
                <div class="rowk" style="margin-bottom:8px">
                  <div class="muted">Капча</div>
                  <div><span class="pill yellow"><?= $e($l['captcha']) ?></span></div>
                </div>
              <?php endif; ?>
              <?php if (!empty($l['error'])): ?>
                <div class="rowk">
                  <div class="muted">Почему письмо не ушло</div>
                  <div><?= $e($l['error']) ?></div>
                </div>
              <?php endif; ?>
            </div>
          </td>
        </tr>
        <?php endif; ?>
        <?php endforeach; ?>
      </table>
    </div>
  <?php endif; ?>
</div>

<?php if ($leads): ?>
<div class="panel">
  <h3>Удаление старых заявок</h3>
  <p class="muted">В заявках лежат имя и телефон живого человека. Это личные данные,
     и хранить их бессрочно не нужно никому: что не пригодилось за несколько месяцев,
     не пригодится и дальше. Папка лежит вне корня сайта и из сети недостижима,
     но лучший способ не потерять чужие данные — не держать их.</p>

  <form method="post" action="<?= $e(admin_url('leads')) ?>"
        data-confirm="Удалить все заявки старше указанного срока? Восстановить их будет нечем.">
    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <input type="hidden" name="do" value="purge">
    <div class="row">
      <div>
        <label for="days">Удалить заявки старше, дней</label>
        <input type="number" id="days" name="days" value="180" min="1" max="3650">
      </div>
      <div style="display:flex;align-items:flex-end">
        <button class="btn red" type="submit" style="margin-bottom:0">Удалить старые</button>
      </div>
    </div>
  </form>

  <p class="muted" style="margin-top:14px">Файлы лежат в
     <b class="mono"><?= $e(Store::dir()) ?>/leads/</b>. Их можно скачать целиком
     через cPanel → File Manager, если нужен архив до удаления.</p>
</div>
<?php endif; ?>

<?php admin_foot(); ?>
