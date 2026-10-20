<?php
/* Почта: куда приходят заявки и как они отправляются.

   ПОЧЕМУ ОТДЕЛЬНЫЙ РАЗДЕЛ, А НЕ ПОЛЕ В НАСТРОЙКАХ. Здесь есть пароль.
   Общий раздел настроек выводит каждое значение обратно в поле формы —
   так он устроен, и для телефона с адресом это правильно. Для пароля
   это означало бы, что он лежит открытым текстом в разметке страницы
   и попадает в историю браузера, в кеш и на экран через чужое плечо.
   Поэтому пароль хранится отдельно, обратно не выводится никогда, а
   пустое поле означает «оставить прежний».

   ПРОВЕРОЧНАЯ ОТПРАВКА — не украшение. Настройки почты ошибаются в
   мелочах: не тот порт, не то шифрование, обычный пароль вместо пароля
   приложения. Без проверки это выясняется через неделю по неотвеченной
   заявке. Поэтому при отказе показываем весь обмен с сервером —
   по нему видно, на каком шаге всё встало. Пароль из обмена вырезан. */

require_once __DIR__ . '/../../mailer.php';

$e = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$testResult = null;

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $what = post_one($_POST['do'] ?? '');
    $cur  = Store::read('mail.json') ?? [];

    /* ------------------------------------------------------ сохранение */
    if ($what === 'save') {
        $port = (int)($_POST['port'] ?? 0);
        $enc  = post_one($_POST['enc'] ?? '');
        $to   = post_one($_POST['to'] ?? '');
        $from = post_one($_POST['from'] ?? '');

        $errors = [];
        if ($to !== '' && !filter_var($to, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'адрес для заявок записан неверно';
        }
        if ($from !== '' && !filter_var($from, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'адрес отправителя записан неверно';
        }
        if ($port !== 0 && ($port < 1 || $port > 65535)) {
            $errors[] = 'порт вне допустимых значений';
        }

        $new = [
            'transport' => post_one($_POST['transport'] ?? 'mail') === 'smtp' ? 'smtp' : 'mail',
            'to'        => $to,
            /* Имя узла идёт прямо в адрес соединения — оставляем только
               то, из чего имя узла вообще может состоять. */
            'host'      => preg_replace('~[^A-Za-z0-9._-]~', '', post_one($_POST['host'] ?? '')) ?? '',
            'port'      => $port > 0 && $port < 65536 ? $port : 465,
            'enc'       => in_array($enc, ['ssl', 'tls', 'none'], true) ? $enc : 'ssl',
            'user'      => post_one($_POST['user'] ?? ''),
            'from'      => $from,
            'from_name' => post_one($_POST['from_name'] ?? ''),
            /* Пустое поле пароля — оставить прежний. Иначе каждое
               сохранение любой другой настройки стирало бы пароль. */
            'pass'      => (string)($_POST['pass'] ?? '') !== ''
                ? (string)$_POST['pass']
                : (string)($cur['pass'] ?? ''),
        ];

        if ($errors) {
            admin_flash('Не сохранено: ' . implode('; ', $errors) . '.', 'err');
        } elseif (Store::write('mail.json', $new)) {
            Store::forget('mail.json');
            admin_flash($new['transport'] === 'smtp'
                ? 'Сохранено. Отправьте проверочное письмо — без этого нельзя быть уверенным, что настройки верные.'
                : 'Сохранено. Отправка идёт встроенной функцией mail().');
        } else {
            admin_flash('Не удалось сохранить.', 'err');
        }
        admin_go(admin_url('mail'));
    }

    /* ------------------------------------------------- проверка отправки */
    if ($what === 'test') {
        $addr = post_one($_POST['test_to'] ?? '');
        if (!filter_var($addr, FILTER_VALIDATE_EMAIL)) {
            admin_flash('Адрес получателя записан неверно.', 'err');
            admin_go(admin_url('mail'));
        }

        $key  = ip_key('mailtest');
        $lock = attempts_get('mailtest', $key);
        if ($lock['until'] > time()) {
            admin_flash('Слишком много проверок подряд. Подождите '
                . ceil(($lock['until'] - time()) / 60) . ' мин.', 'warn');
            admin_go(admin_url('mail'));
        }
        /* Ограничение не против взлома, а против того, чтобы почтовая
           служба не приняла нас за рассылку и не закрыла ящик. */
        attempts_fail('mailtest', $key, 10, 600, 600);

        $res = mail_send($addr,
            'Проверка почты — ' . (I18n::$cfg['site_name'] ?? 'сайт'),
            "Это проверочное письмо из панели управления сайтом.\n\n"
            . "Если вы его получили, настройки почты верные и заявки с сайта будут доходить.\n\n"
            . 'Сайт: ' . (I18n::$cfg['site_url'] ?? '') . "\n"
            . 'Отправлено: ' . date('d.m.Y H:i') . "\n");

        $_SESSION['mail_test'] = $res;
        admin_go(admin_url('mail'));
    }
}

if (!empty($_SESSION['mail_test'])) {
    $testResult = $_SESSION['mail_test'];
    unset($_SESSION['mail_test']);
}

$c      = mail_cfg();
$stored = Store::read('mail.json') ?? [];
$hasPw  = ($stored['pass'] ?? '') !== '';
$smtp   = $c['transport'] === 'smtp';

/* Подсказки по частым почтовым службам: половина ошибок — это порт
   и шифрование, выбранные наугад. */
$PRESETS = [
    ['Gmail',          'smtp.gmail.com',     465, 'SSL/TLS', 'нужен пароль приложения, обычный пароль Gmail не подойдёт'],
    ['Яндекс',         'smtp.yandex.ru',     465, 'SSL/TLS', 'нужен пароль приложения'],
    ['Mail.ru',        'smtp.mail.ru',       465, 'SSL/TLS', 'нужен пароль для внешних приложений'],
    ['Ящик на cPanel', 'mail.ваш-домен',     465, 'SSL/TLS', 'обычный пароль от ящика; порт 587 со STARTTLS тоже бывает'],
];

admin_head('mail');
?>

<?php if ($testResult !== null): ?>
  <div class="panel" style="border-color:<?= $testResult['ok'] ? '#cfe3d7' : '#f6dcdc' ?>">
    <h3><?= $testResult['ok'] ? 'Письмо отправлено' : 'Письмо не ушло' ?></h3>
    <?php if ($testResult['ok']): ?>
      <p class="muted">Способ отправки: <b><?= $e($testResult['via'] === 'smtp' ? 'SMTP' : 'встроенная функция mail()') ?></b>.
         Проверьте ящик — письмо могло попасть в «Спам». Если оно там,
         значит домену не хватает записей SPF и DKIM; это настраивается в DNS.</p>
    <?php else: ?>
      <div class="flash err"><?= $e($testResult['error']) ?></div>
    <?php endif; ?>

    <?php if (!empty($testResult['log'])): ?>
      <h4>Обмен с почтовым сервером</h4>
      <p class="muted">Пароль из записи вырезан. По этим строкам видно, на каком шаге всё встало.</p>
      <pre class="mono" style="background:#0e2f47;color:#cfe0ea;padding:14px 16px;border-radius:10px;
                               overflow:auto;max-height:340px;line-height:1.55;font-size:12px"><?php
        foreach ($testResult['log'] as $line) echo $e($line) . "\n";
      ?></pre>
    <?php endif; ?>
  </div>
<?php endif; ?>

<div class="panel">
  <h3>Отправка почты <span class="muted" style="font-weight:400">— сейчас: <b><?= $smtp ? 'SMTP' : 'встроенная mail()' ?></b></span></h3>
  <p class="muted">Встроенная отправка отдаёт письмо почтовой программе самого сервера.
     На виртуальном хостинге это обычно значит одно из двух: письмо не уходит вовсе
     либо уходит с адреса сервера и попадает в спам, потому что не проходит проверку SPF.
     Отправка через настоящий почтовый ящик решает обе беды.</p>

  <form method="post" action="<?= $e(admin_url('mail')) ?>" data-guard="1">
    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <input type="hidden" name="do" value="save">

    <label for="to">Куда приходят заявки с сайта</label>
    <input type="email" id="to" name="to" value="<?= $e($c['to']) ?>" placeholder="info@mguliyev.com">

    <label for="transport">Способ отправки</label>
    <select id="transport" name="transport">
      <option value="mail"<?= $smtp ? '' : ' selected' ?>>Встроенная функция mail() — ничего настраивать не нужно</option>
      <option value="smtp"<?= $smtp ? ' selected' : '' ?>>SMTP — через настоящий почтовый ящик</option>
    </select>

    <fieldset>
      <legend>Почтовый ящик, через который отправляем</legend>

      <div class="row3">
        <div>
          <label for="host">SMTP-сервер</label>
          <input type="text" id="host" name="host" value="<?= $e($c['host']) ?>"
                 class="mono" placeholder="smtp.gmail.com">
        </div>
        <div>
          <label for="port">Порт</label>
          <input type="number" id="port" name="port" value="<?= (int)$c['port'] ?>" min="1" max="65535">
        </div>
        <div>
          <label for="enc">Шифрование</label>
          <select id="enc" name="enc">
            <option value="ssl"<?= $c['enc'] === 'ssl'  ? ' selected' : '' ?>>SSL/TLS (обычно порт 465)</option>
            <option value="tls"<?= $c['enc'] === 'tls'  ? ' selected' : '' ?>>STARTTLS (обычно порт 587)</option>
            <option value="none"<?= $c['enc'] === 'none' ? ' selected' : '' ?>>Без шифрования — не рекомендуется</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div>
          <label for="user">Пользователь <span class="hint">обычно полный адрес ящика</span></label>
          <input type="text" id="user" name="user" value="<?= $e($c['user']) ?>"
                 autocomplete="off" class="mono">
        </div>
        <div>
          <label for="pass">Пароль
            <?php if ($hasPw): ?><span class="pill">сохранён</span><?php endif; ?>
          </label>
          <input type="password" id="pass" name="pass" autocomplete="new-password"
                 placeholder="<?= $hasPw ? 'сохранён — оставьте пустым, чтобы не менять' : 'пароль от ящика' ?>">
        </div>
      </div>

      <div class="row">
        <div>
          <label for="from">Адрес отправителя <span class="hint">почти всегда совпадает с пользователем</span></label>
          <input type="email" id="from" name="from" value="<?= $e($c['from']) ?>" class="mono">
        </div>
        <div>
          <label for="from_name">Имя отправителя</label>
          <input type="text" id="from_name" name="from_name" value="<?= $e($c['from_name']) ?>">
        </div>
      </div>
    </fieldset>

    <div class="btnrow"><button class="btn" type="submit">Сохранить</button></div>
  </form>
</div>

<div class="panel">
  <h3>Проверка отправки</h3>
  <p class="muted">Отправим тестовое письмо, чтобы убедиться, что настройки верные.
     Сохраните настройки до проверки — отправка идёт по сохранённым значениям, а не по тем,
     что набраны в полях выше.</p>

  <form method="post" action="<?= $e(admin_url('mail')) ?>">
    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <input type="hidden" name="do" value="test">
    <div class="row">
      <div>
        <label for="test_to">Адрес получателя</label>
        <input type="email" id="test_to" name="test_to"
               value="<?= $e($c['to'] !== '' ? $c['to'] : ($c['from'] ?? '')) ?>" required>
      </div>
      <div style="display:flex;align-items:flex-end">
        <button class="btn navy" type="submit" style="margin-bottom:0">Отправить тест</button>
      </div>
    </div>
  </form>
</div>

<div class="panel">
  <h3>Частые почтовые службы</h3>
  <p class="muted">Половина ошибок — порт и шифрование, выбранные наугад.</p>
  <div class="tablewrap">
    <table>
      <tr><th>Служба</th><th>Сервер</th><th>Порт</th><th>Шифрование</th><th>Чем отличается</th></tr>
      <?php foreach ($PRESETS as [$name, $host, $port, $enc, $note]): ?>
      <tr>
        <td><b><?= $e($name) ?></b></td>
        <td class="mono"><?= $e($host) ?></td>
        <td><?= (int)$port ?></td>
        <td><?= $e($enc) ?></td>
        <td class="muted"><?= $e($note) ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <h4>Если письма уходят, но попадают в спам</h4>
  <p class="muted">Значит домену не хватает записей SPF и DKIM — это настраивается
     в DNS домена, а не здесь. Разбор по шагам есть в статье блога
     «Почему письма компании уходят в спам».</p>
</div>

<?php admin_foot(); ?>
