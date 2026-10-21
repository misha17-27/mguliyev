<?php
/* Безопасность: капча Cloudflare Turnstile и проверка заголовков.

   СЕКРЕТНЫЙ КЛЮЧ ОБРАТНО НЕ ВЫВОДИТСЯ. Пустое поле означает «оставить
   прежний». Иначе ключ лежал бы открытым текстом в разметке страницы —
   и в истории браузера, и в кеше, и на экране через чужое плечо.

   ПРОВЕРКА ЗАГОЛОВКОВ — не украшение. Самая дорогая ошибка в этой части
   невидима: политика безопасности из .htaccess перебивает ту, что шлёт
   PHP, а на LiteSpeed двухтабличная механика Apache не воспроизводится
   вовсе. Если в политике не окажется challenges.cloudflare.com, виджет
   молча не нарисуется, и понять это по виду страницы нельзя. Поэтому
   панель сама запрашивает свой адрес и показывает, что реально пришло. */

$e = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

/* Тестовые ключи Cloudflare — они работают с любого домена, включая
   локальный сервер, и нужны, чтобы проверить саму встройку до того,
   как заведён настоящий виджет. */
$TEST = [
    ['всегда проходит',   '1x00000000000000000000AA', '1x0000000000000000000000000000000AA'],
    ['всегда НЕ проходит', '2x00000000000000000000AB', '2x0000000000000000000000000000000AA'],
    ['всегда показывает задачу', '3x00000000000000000000FF', '1x0000000000000000000000000000000AA'],
];

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    /* Устаревшая вкладка с пустым полем секрета сохранила бы свой старый
       Site Key рядом с новым секретным ключом из другой вкладки. Ключи
       от разных виджетов Cloudflare не принимает: отбивалась бы каждая
       заявка, а после выхода — и вход в панель. */
    if (admin_stale('security.json')) {
        admin_flash('Ключи капчи правили из другого места, пока эта страница была открыта. '
            . 'Чтобы не затереть ту правку, сохранение отменено: обновите страницу '
            . 'и внесите изменения заново.', 'err');
        admin_go(admin_url('security'));
    }
    /* Поля нет вовсе — это «не дошло», а не «очистили»: пустой Site Key
       выключает капчу, и запрос без полей выключал бы её молча. */
    if (!array_key_exists('site', $_POST)) {
        admin_flash('Форма пришла без полей — ничего не сохранено. Обновите страницу и повторите.', 'err');
        admin_go(admin_url('security'));
    }

    $cur  = Store::read('security.json') ?? [];
    $site = post_one($_POST['site'] ?? '');
    $sec  = (string)($_POST['secret'] ?? '');

    /* Ключи — это строки, которые уйдут в разметку виджета и в запрос
       к Cloudflare. Пропускаем только то, из чего ключ вообще состоит. */
    $site = preg_replace('~[^A-Za-z0-9_-]~', '', $site) ?? '';
    $sec  = preg_replace('~[^A-Za-z0-9_-]~', '', $sec) ?? '';

    /* Новый Site Key без нового секрета — это пара от двух разных
       виджетов: прежний секретный ключ к новому не подойдёт. Подсказка
       «оставьте пустым» вела ровно к этому. */
    if ($site !== '' && $sec === '' && $site !== (string)($cur['site'] ?? '')
        && (string)($cur['secret'] ?? '') !== '') {
        admin_draft_keep('security', ['site' => $site]);
        admin_flash('Не сохранено: Site Key сменился, а Secret Key не вписан. У каждого виджета '
            . 'своя пара ключей, и прежний секретный к новому Site Key не подойдёт — '
            . 'Cloudflare отбивал бы каждую заявку. Впишите Secret Key вместе с Site Key.', 'err');
        admin_go(admin_url('security'));
    }

    /* Пустое поле секрета — оставить прежний. Пустой site key при этом
       выключает капчу целиком: это единственный способ её убрать. */
    if ($site === '') {
        $new = ['site' => '', 'secret' => ''];
        $msg = 'Капча выключена. Формы и вход работают без проверки.';
    } else {
        $new = ['site' => $site, 'secret' => $sec !== '' ? $sec : (string)($cur['secret'] ?? '')];
        $msg = $new['secret'] === ''
            ? 'Site Key сохранён, но без Secret Key капча не включится: нужны оба ключа.'
            : 'Сохранено. Проверьте: откройте страницу контактов — под формой должен появиться виджет.';
    }

    /* Пара «всегда НЕ проходит» отбивает все формы сайта. Об этом
       надо сказать сразу, а не когда кончатся заявки. */
    $failPair = $new['site'] !== '' && $new['secret'] !== ''
        && (preg_match('~^2x0{20}AB$~', $new['site']) || preg_match('~^2x0{31}AA$~', $new['secret']));

    if (Store::write('security.json', $new)) {
        Store::forget('security.json');
        if ($failPair) {
            admin_flash('Сохранено. Стоит пара «всегда НЕ проходит»: формы сайта отбивают всех, '
                . 'заявки не принимаются. Вход в панель на тестовых ключах отказ капчи пропускает '
                . 'и проверяет только пароль. Проверив, впишите свои ключи.', 'warn');
        } else {
            admin_flash($msg, $new['site'] !== '' && $new['secret'] === '' ? 'warn' : 'ok');
        }
    } else {
        admin_flash('Не удалось сохранить.', 'err');
    }
    admin_go(admin_url('security'));
}

$cfg    = Store::read('security.json') ?? [];
$site   = (string)($cfg['site'] ?? '');
$hasSec = ($cfg['secret'] ?? '') !== '';
$on     = ts_on();
/* Отказанный Site Key возвращается в поле, чтобы не искать его заново.
   Секретный ключ в черновик не попадает: обратно он не выводится. */
$draft  = admin_draft_take('security');
$siteIn = is_array($draft) && isset($draft['site']) ? (string)$draft['site'] : $site;

/* ----------------------------------------- что реально пришло в заголовках */
$seen = null;
$selfUrl = (I18n::$cfg['site_url'] ?? '');
if ($selfUrl !== '' && function_exists('curl_init')) {
    $ch = curl_init($selfUrl . '/');
    curl_setopt_array($ch, [
        CURLOPT_NOBODY => true, CURLOPT_HEADER => true, CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 6, CURLOPT_CONNECTTIMEOUT => 4, CURLOPT_FOLLOWLOCATION => true,
    ]);
    $raw = curl_exec($ch);
    $err = curl_error($ch);
    if (PHP_VERSION_ID < 80000) curl_close($ch);   // с PHP 8.0 не нужна, в 8.5 устарела

    if (is_string($raw)) {
        $found = [];
        foreach (preg_split('~\r?\n~', $raw) as $line) {
            if (stripos($line, 'content-security-policy:') === 0) {
                $found[] = trim(substr($line, strlen('content-security-policy:')));
            }
        }
        $seen = ['ok' => true, 'policies' => $found];
    } else {
        $seen = ['ok' => false, 'why' => $err !== '' ? $err : 'запрос не прошёл'];
    }
}

/* Неудачные входы за сутки — со всех адресов вместе. */
$fails = Store::read('locks/login-total.json') ?? [];
$hourNow = (int)floor(time() / 3600);
$fails24 = 0; $fails1 = 0;
foreach ($fails as $h => $n) {
    if ((int)$h > $hourNow - 24) $fails24 += (int)$n;
    if ((int)$h === $hourNow)    $fails1  += (int)$n;
}

admin_head('security');
?>
<?php if ($fails24 >= 20 && !ts_on()): ?>
  <div class="flash err">
    За сутки — <b><?= $fails24 ?></b> неудачных попыток входа в панель, за этот час — <?= $fails1 ?>.
    Похоже на подбор пароля с разных адресов: счётчик по адресу такой подбор не видит.
    Включите капчу ниже — это закрывает его полностью.
  </div>
<?php endif; ?>

<?php if (ts_is_test()): ?>
  <div class="flash warn">
    Сейчас стоят <b>тестовые ключи Cloudflare</b>. Они ничего не проверяют по-настоящему:
    пара «всегда проходит» пропускает кого угодно, пара «всегда НЕ проходит» отбивает
    все формы сайта. Вход в панель на тестовых ключах отказ капчи пропускает — пароль
    и счётчик попыток остаются. На боевом сайте так оставлять нельзя — заведите виджет
    и впишите свои ключи.
  </div>
<?php endif; ?>

<div class="panel">
  <h3>Cloudflare Turnstile (капча)
    <?php if ($on): ?><span class="pill">включена</span>
    <?php elseif ($site !== ''): ?><span class="pill yellow">не хватает Secret Key</span>
    <?php else: ?><span class="pill grey">выключена</span><?php endif; ?>
  </h3>
  <p class="muted">Защищает формы на сайте и вход в эту панель от ботов.
     Ключей нет — проверки нет, и всё работает как прежде: ловушка для ботов,
     время заполнения формы и ограничение частоты остаются в любом случае.</p>

  <form method="post" action="<?= $e(admin_url('security')) ?>" data-guard="1">
    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <?= admin_ver_field('security.json') ?>

    <label for="site">Site Key <span class="hint">публичный, он виден в разметке страницы</span></label>
    <input type="text" id="site" name="site" value="<?= $e($siteIn) ?>" class="mono"
           autocomplete="off" spellcheck="false" placeholder="0x4AAAAAAA…">

    <label for="secret">Secret Key
      <?php if ($hasSec): ?><span class="pill">сохранён</span><?php endif; ?>
      <span class="hint">секретный, наружу не отдаётся никогда</span>
    </label>
    <input type="password" id="secret" name="secret" class="mono" autocomplete="new-password"
           placeholder="<?= $hasSec ? 'сохранён — оставьте пустым, чтобы не менять' : '0x4AAAAAAA…' ?>">

    <p class="muted" style="margin-top:10px">Чтобы выключить капчу — очистите поле Site Key и сохраните.
       Меняете Site Key — впишите и Secret Key: ключи идут парой от одного виджета.</p>

    <div class="btnrow"><button class="btn" type="submit">Сохранить</button></div>
  </form>
</div>

<div class="panel">
  <h3>Где взять ключи</h3>
  <ol class="muted" style="line-height:1.9;padding-left:20px">
    <li>Зайдите на <b>dash.cloudflare.com</b> → раздел <b>Turnstile</b>.</li>
    <li>Нажмите <b>Add widget</b>.</li>
    <li>Domain — укажите <b><?= $e(ts_bare_host((string)(I18n::$cfg['site_url'] ?? ''))) ?></b>.
        Этого достаточно: поддомены и вариант с www покрываются автоматически.</li>
    <li>Widget Mode — <b>Managed</b>.</li>
    <li>Скопируйте Site Key и Secret Key в поля выше.</li>
  </ol>
  <p class="muted">Turnstile бесплатен и не показывает картинки с перекрёстками:
     обычный посетитель видит галочку и идёт дальше.</p>
</div>

<div class="panel">
  <h3>Проверить встройку, не заводя виджет</h3>
  <p class="muted">У Cloudflare есть пары ключей для проверки. Они работают с любого
     домена, включая локальный сервер. Вставьте пару «всегда НЕ проходит» — и убедитесь,
     что форма действительно отбивается, а не делает вид. Вход в панель с тестовыми
     ключами не запирается: отказ капчи он пропускает и проверяет пароль.
     <b>Не оставляйте их на боевом сайте.</b></p>
  <div class="tablewrap">
    <table>
      <tr><th>Пара</th><th>Site Key</th><th>Secret Key</th></tr>
      <?php foreach ($TEST as [$what, $sk, $ck]): ?>
      <tr>
        <td><b><?= $e($what) ?></b></td>
        <td><button type="button" class="copypath" data-copy="<?= $e($sk) ?>"><?= $e($sk) ?></button></td>
        <td><button type="button" class="copypath" data-copy="<?= $e($ck) ?>"><?= $e($ck) ?></button></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>

<div class="panel">
  <h3>Политика безопасности страниц</h3>
  <p class="muted">Виджет капчи живёт в окне с домена <b class="mono">challenges.cloudflare.com</b>.
     Если этого домена нет в политике, виджет молча не нарисуется — по виду страницы
     понять это нельзя. Поэтому панель запрашивает сайт и показывает, что пришло на самом деле.</p>

  <?php if ($seen === null): ?>
    <div class="note">Проверить не получилось: на сервере нет cURL либо не задан адрес сайта
      в <b class="mono">app/config.php</b>. Проверьте вручную:
      <b class="mono">curl -sI <?= $e($selfUrl) ?>/ | grep -i content-security-policy</b></div>
  <?php elseif (!$seen['ok']): ?>
    <div class="note">Сайт не ответил на запрос изнутри сервера: <?= $e($seen['why']) ?>.
      Это бывает, когда хостинг запрещает обращаться к себе по внешнему адресу —
      на работу сайта не влияет. Проверьте вручную той же командой.</div>
  <?php else:
    $n = count($seen['policies']);
    $hasHost = $n > 0 && strpos(implode(' ', $seen['policies']), 'challenges.cloudflare.com') !== false;
    $match = $n === 1 && $seen['policies'][0] === CSP_POLICY;
  ?>
    <div class="tablewrap">
      <table>
        <tr>
          <td>Заголовков пришло</td>
          <td class="right"><b><?= $n ?></b>
            <?php if ($n === 0): ?><span class="pill red">политики нет вовсе</span>
            <?php elseif ($n > 1): ?><span class="pill yellow">их два — браузер применит пересечение</span>
            <?php else: ?><span class="pill">как и ожидалось</span><?php endif; ?></td>
        </tr>
        <tr>
          <td>Домен капчи разрешён</td>
          <td class="right"><?= $hasHost
              ? '<span class="pill">да</span>'
              : '<span class="pill red">нет — виджет не нарисуется</span>' ?></td>
        </tr>
        <tr>
          <td>Совпадает со строкой в коде</td>
          <td class="right"><?= $match
              ? '<span class="pill">да</span>'
              : '<span class="pill yellow">нет</span>' ?></td>
        </tr>
      </table>
    </div>

    <?php if (!$hasHost): ?>
      <div class="flash err" style="margin-top:14px">
        В политике нет домена капчи. Правьте строку
        <b class="mono">Header always set Content-Security-Policy</b> в файле
        <b class="mono">public/.htaccess</b> — заголовок из PHP её не перебьёт,
        всё наоборот.
      </div>
    <?php endif; ?>

    <h4>Что пришло</h4>
    <?php foreach ($seen['policies'] as $i => $pol): ?>
      <pre class="mono" style="background:var(--paper);border:1px solid var(--line);padding:12px 14px;
                               border-radius:9px;overflow:auto;font-size:11.5px;line-height:1.6;
                               white-space:pre-wrap;word-break:break-word"><?= $e($pol) ?></pre>
    <?php endforeach; ?>

    <?php if (!$match): ?>
      <h4>Что ожидалось (константа CSP_POLICY в app/security.php)</h4>
      <pre class="mono" style="background:var(--paper);border:1px solid var(--line);padding:12px 14px;
                               border-radius:9px;overflow:auto;font-size:11.5px;line-height:1.6;
                               white-space:pre-wrap;word-break:break-word"><?= $e(CSP_POLICY) ?></pre>
      <p class="muted">Расхождение само по себе не ошибка — но если браузер получит две
         РАЗНЫЕ политики, он применит самую строгую из них, и сломается то, что разрешено
         только одной. Строки в <b class="mono">public/.htaccess</b> и в
         <b class="mono">app/security.php</b> должны совпадать дословно.</p>
    <?php endif; ?>
  <?php endif; ?>
</div>

<div class="panel">
  <h3>Что защищено и без капчи</h3>
  <p class="muted">Капча — не единственная защита, и выключить её не значит остаться без ничего.</p>
  <div class="tablewrap">
    <table>
      <tr><th>Где</th><th>Что стоит</th></tr>
      <?php /* Версию PHP сайт наружу не сообщает (заголовок X-Powered-By убран),
               поэтому сверить её после обновления на хостинге можно здесь. */ ?>
      <tr><td>PHP на сервере</td><td><b><?= $e(PHP_VERSION) ?></b>
        <span class="muted">— после выхода исправлений безопасности сверьте номер с php.net</span></td></tr>
      <tr><td>Форма заявки</td><td>поле-ловушка · время заполнения от 3 секунд · не чаще одной заявки в минуту с адреса</td></tr>
      <tr><td>Неудачных входов за сутки</td><td><b><?= $fails24 ?></b> · за этот час <?= $fails1 ?>
        <span class="muted">— со всех адресов вместе</span></td></tr>
      <tr><td>Вход в панель</td><td>bcrypt · <?= ADMIN_LOGIN_LIMIT ?> попытки, потом <?= (int)(ADMIN_LOGIN_LOCK / 60) ?> минут запрета · одинаковый ответ на неверную почту и пароль</td></tr>
      <tr><td>Все формы панели</td><td>разовый ключ формы · проверка источника запроса</td></tr>
      <tr><td>Загрузка картинок</td><td>тип по содержимому файла · имя собирается заново · SVG не принимается</td></tr>
    </table>
  </div>
</div>

<?php admin_foot(); ?>
