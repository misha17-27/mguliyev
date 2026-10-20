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
    $cur  = Store::read('security.json') ?? [];
    $site = post_one($_POST['site'] ?? '');
    $sec  = (string)($_POST['secret'] ?? '');

    /* Ключи — это строки, которые уйдут в разметку виджета и в запрос
       к Cloudflare. Пропускаем только то, из чего ключ вообще состоит. */
    $site = preg_replace('~[^A-Za-z0-9_-]~', '', $site) ?? '';
    $sec  = preg_replace('~[^A-Za-z0-9_-]~', '', $sec) ?? '';

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

    if (Store::write('security.json', $new)) {
        Store::forget('security.json');
        admin_flash($msg, $new['site'] !== '' && $new['secret'] === '' ? 'warn' : 'ok');
    } else {
        admin_flash('Не удалось сохранить.', 'err');
    }
    admin_go(admin_url('security'));
}

$cfg    = Store::read('security.json') ?? [];
$site   = (string)($cfg['site'] ?? '');
$hasSec = ($cfg['secret'] ?? '') !== '';
$on     = ts_on();

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
    curl_close($ch);

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

admin_head('security');
?>

<?php if (ts_is_test()): ?>
  <div class="flash warn">
    Сейчас стоят <b>тестовые ключи Cloudflare</b>. Они ничего не проверяют по-настоящему:
    пара «всегда проходит» пропускает кого угодно, пара «всегда НЕ проходит» отбивает всех.
    На боевом сайте так оставлять нельзя — заведите виджет и впишите свои ключи.
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

    <label for="site">Site Key <span class="hint">публичный, он виден в разметке страницы</span></label>
    <input type="text" id="site" name="site" value="<?= $e($site) ?>" class="mono"
           autocomplete="off" spellcheck="false" placeholder="0x4AAAAAAA…">

    <label for="secret">Secret Key
      <?php if ($hasSec): ?><span class="pill">сохранён</span><?php endif; ?>
      <span class="hint">секретный, наружу не отдаётся никогда</span>
    </label>
    <input type="password" id="secret" name="secret" class="mono" autocomplete="new-password"
           placeholder="<?= $hasSec ? 'сохранён — оставьте пустым, чтобы не менять' : '0x4AAAAAAA…' ?>">

    <p class="muted" style="margin-top:10px">Чтобы выключить капчу — очистите поле Site Key и сохраните.</p>

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
     что форма действительно отбивается, а не делает вид.
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
      <pre class="mono" style="background:#f4f7f8;border:1px solid #e5ecef;padding:12px 14px;
                               border-radius:9px;overflow:auto;font-size:11.5px;line-height:1.6;
                               white-space:pre-wrap;word-break:break-word"><?= $e($pol) ?></pre>
    <?php endforeach; ?>

    <?php if (!$match): ?>
      <h4>Что ожидалось (константа CSP_POLICY в app/security.php)</h4>
      <pre class="mono" style="background:#f4f7f8;border:1px solid #e5ecef;padding:12px 14px;
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
      <tr><td>Форма заявки</td><td>поле-ловушка · время заполнения от 3 секунд · не чаще одной заявки в минуту с адреса</td></tr>
      <tr><td>Вход в панель</td><td>bcrypt · <?= ADMIN_LOGIN_LIMIT ?> попытки, потом <?= (int)(ADMIN_LOGIN_LOCK / 60) ?> минут запрета · одинаковый ответ на неверную почту и пароль</td></tr>
      <tr><td>Все формы панели</td><td>разовый ключ формы · проверка источника запроса</td></tr>
      <tr><td>Загрузка картинок</td><td>тип по содержимому файла · имя собирается заново · SVG не принимается</td></tr>
    </table>
  </div>
</div>

<?php admin_foot(); ?>
