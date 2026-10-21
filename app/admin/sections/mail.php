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

    /* ------------------------------------------------------ сохранение */
    if ($what === 'save') {
        /* Форма несёт все настройки сразу. Вкладка, открытая утром, вернула
           бы прежние сервер, ящик и адрес заявок, оставив новый пароль из
           другой вкладки, — пара «старый ящик, новый пароль» не входит,
           и ни одно письмо не уходит. Метка версии это ловит. */
        if (admin_stale('mail.json')) {
            admin_flash('Почту правили из другого места, пока эта страница была открыта. '
                . 'Чтобы не затереть ту правку, сохранение отменено: обновите страницу '
                . 'и внесите изменения заново.', 'err');
            admin_go(admin_url('mail'));
        }

        /* Поле, которого НЕТ в запросе, — это «не дошло», а не «стёрли»:
           оно сохраняет прежнее значение. Раньше запрос с одним ключом
           защиты выключал SMTP и стирал сервер, ящик и отправителя. */
        $FIELDS = ['transport', 'to', 'host', 'port', 'enc', 'user', 'from', 'from_name'];
        $got    = array_values(array_filter($FIELDS,
            static fn($k) => array_key_exists($k, $_POST) && is_string($_POST[$k])));
        /* Пустое поле пароля — оставить прежний. Иначе каждое сохранение
           любой другой настройки стирало бы пароль. */
        $pass   = is_string($_POST['pass'] ?? null) && $_POST['pass'] !== '' ? $_POST['pass'] : null;
        if (!$got && $pass === null) {
            admin_flash('Форма пришла без полей — ничего не сохранено. Обновите страницу и повторите.', 'err');
            admin_go(admin_url('mail'));
        }

        /* Каждое поле проверяется само по себе. Неверное остаётся прежним
           и попадает в список «не приняты», остальные правки — вместе
           с вписанным паролем — сохраняются. Раньше одна опечатка в адресе
           отменяла всю форму, и пароль приходилось вписывать заново. */
        $set   = [];
        $bad   = [];
        $notes = [];
        $pasted = 0;
        foreach ($got as $k) {
            $v = post_one($_POST[$k]);
            if ($k === 'transport' || $k === 'enc') {
                $allowed = $k === 'transport' ? ['smtp', 'mail'] : ['ssl', 'tls', 'none'];
                if (in_array($v, $allowed, true)) $set[$k] = $v;
                else $bad[] = ($k === 'transport' ? 'способ отправки' : 'шифрование') . ': неизвестное значение';
            } elseif ($k === 'to' || $k === 'from') {
                if ($v === '' || filter_var($v, FILTER_VALIDATE_EMAIL)) $set[$k] = $v;
                else $bad[] = ($k === 'to' ? 'адрес для заявок' : 'адрес отправителя')
                            . ' «' . $v . '» — не похоже на адрес почты';
            } elseif ($k === 'port') {
                /* Только почтовые порты. Любой порт превращал раздел в сканер:
                   «соединиться с узлом X на порту Y» и показать весь ответ —
                   ровно то, чем ищут открытые службы во внутренней сети хостинга. */
                if (in_array((int)$v, [25, 465, 587, 2525], true) && (string)(int)$v === $v) $set[$k] = (int)$v;
                else $bad[] = 'порт «' . $v . '» — допустимы 25, 465, 587 и 2525';
            } elseif ($k === 'host') {
                /* Адрес сервера вставляют целиком: со схемой, портом, косой
                   в конце. Это снимаем, а остальное проверяем. Молча вырезать
                   знаки нельзя: «https://smtp.gmail.com» превращалось
                   в «httpssmtp.gmail.com» и сохранялось с «Сохранено». */
                $h = preg_replace('~^[a-z][a-z0-9+.-]*://~i', '', $v) ?? '';
                $h = explode('/', $h, 2)[0];
                if (preg_match('~^(.*):(\d{1,5})$~', $h, $m)) {
                    $h = $m[1];
                    $pasted = (int)$m[2];
                }
                $h = rtrim(strtolower($h), '.');
                if ($h === '' || filter_var($h, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)
                    || preg_match('~^(?=.{1,253}$)(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)*[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?$~', $h)) {
                    $set[$k] = $h;
                } else {
                    $pasted = 0;
                    $bad[] = 'SMTP-сервер «' . $v . '» — это не имя сервера, нужно вида smtp.gmail.com';
                }
            } else {
                $set[$k] = $v;                  // user, from_name: свободный текст
            }
        }
        if ($pass !== null) $set['pass'] = $pass;

        $lost = count($FIELDS) - count($got);
        if ($lost && $got) {
            $bad[] = 'не дошло полей — ' . $lost;
        }

        $res = [];
        $ok = Store::update('mail.json', static function (array $cur) use ($set, &$res): array {
            foreach ($set as $k => $v) $cur[$k] = $v;
            return $res = $cur;
        });

        if (!$ok) {
            admin_flash('Не удалось сохранить. Проверьте права на папку ' . Store::dir(), 'err');
            admin_go(admin_url('mail'));
        }

        /* Порт из вставленного адреса не применяем: порт выбирается
           в списке вместе с шифрованием, и одна только смена порта дала бы
           пару, которая не соединяется. Но и молча его не выбрасываем. */
        $port = (int)($res['port'] ?? 465);
        if ($pasted && $pasted !== $port) {
            $notes[] = 'Порт из адреса сервера (:' . $pasted . ') не применён — порт выбирается '
                     . 'в списке, сейчас ' . $port . '.';
        }

        $msg = ($res['transport'] ?? 'mail') === 'smtp'
            ? 'Сохранено. Отправьте проверочное письмо — без этого нельзя быть уверенным, что настройки верные.'
            : 'Сохранено. Отправка идёт встроенной функцией mail().';
        if ($bad) {
            $msg .= ' Не приняты, у них оставлены прежние значения: ' . implode('; ', $bad) . '.';
        }
        if ($notes) $msg .= ' ' . implode(' ', $notes);
        admin_flash($msg, $bad || $notes ? 'warn' : 'ok');
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
/* Выбран SMTP — ещё не значит, что письма идут через него: без адреса
   сервера отправка молча падает на mail(). Показываем то, что будет
   на самом деле, а не то, что выбрано в списке. */
$real   = mail_smtp_ready($c) ? 'SMTP' : 'встроенная mail()';
$halfway = $smtp && !mail_smtp_ready($c);

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
  <div class="panel" style="border-color:<?= $testResult['ok'] ? 'var(--ok-line)' : 'var(--err-line)' ?>">
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
      <pre class="mono" style="background:var(--ink);color:var(--side-text);padding:14px 16px;border-radius:10px;
                               overflow:auto;max-height:340px;line-height:1.55;font-size:12px"><?php
        foreach ($testResult['log'] as $line) echo $e($line) . "\n";
      ?></pre>
    <?php endif; ?>
  </div>
<?php endif; ?>

<div class="panel">
  <h3>Отправка почты <span class="muted" style="font-weight:400">— сейчас: <b><?= $e($real) ?></b></span></h3>
  <?php if ($halfway): ?>
    <div class="flash warn">Выбран SMTP, но не заполнен адрес сервера или отправителя —
      поэтому письма сейчас идут встроенной mail(). Заполните поля ниже.</div>
  <?php endif; ?>
  <?php if ($smtp && $c['enc'] === 'none'): ?>
    <div class="flash err">Выбрано «без шифрования»: пароль от ящика уходит на почтовый
      сервер открытым текстом, и его может прочитать любой, кто видит трафик между
      хостингом и почтой. Выберите SSL/TLS (порт 465) или STARTTLS (порт 587).</div>
  <?php endif; ?>
  <p class="muted">Встроенная отправка отдаёт письмо почтовой программе самого сервера.
     На виртуальном хостинге это обычно значит одно из двух: письмо не уходит вовсе
     либо уходит с адреса сервера и попадает в спам, потому что не проходит проверку SPF.
     Отправка через настоящий почтовый ящик решает обе беды.</p>

  <form method="post" action="<?= $e(admin_url('mail')) ?>" data-guard="1">
    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <?= admin_ver_field('mail.json') ?>
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
          <select id="port" name="port">
            <?php foreach ([465 => '465 — SSL/TLS', 587 => '587 — STARTTLS', 25 => '25 — без шифрования', 2525 => '2525 — запасной'] as $pv => $pl): ?>
              <option value="<?= $pv ?>"<?= (int)$c['port'] === $pv ? ' selected' : '' ?>><?= $e($pl) ?></option>
            <?php endforeach; ?>
          </select>
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
