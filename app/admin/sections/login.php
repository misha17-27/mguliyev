<?php
/* Вход в панель.

   Сообщение об ошибке одно на все случаи — «почта или пароль не подходят».
   Разные сообщения («такой почты нет» отдельно от «пароль неверен»)
   позволяют по одному запросу проверить, существует ли учётная запись.

   Пауза после неудачи и счётчик попыток по адресу: без них пароль
   подбирается перебором, и никакая его длина не поможет. */

$e   = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$err = '';
$email = '';
$key = ip_key('login');
$lock = attempts_get('login', $key);
$left = $lock['until'] - time();

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    admin_check_post();

    if ($left > 0) {
        $err = 'Слишком много попыток. Вход закрыт на ' . ceil($left / 60) . ' мин.';
    } elseif (!($cap = ts_verify($_POST['cf-turnstile-response'] ?? null, 'admin-login'))['ok']
              && $cap['bucket'] !== 'config' && !ts_is_test()) {
        /* Неудача капчи НЕ считается попыткой входа: иначе чужая страница,
           отправляющая форму без токена, выжигала бы владельцу все пять
           попыток и закрывала ему вход на пятнадцать минут. Пароль при
           этом не проверялся вовсе, так что и подбора здесь нет.

           А при bucket='config' вход ПРОПУСКАЕТСЯ. Это не послабление,
           а единственный выход из ловушки: ключи правятся только из
           панели, и опечатка в секретном ключе иначе запирала бы
           владельца в его собственном сайте навсегда. Посетитель вызвать
           такую ошибку не может — она берётся из наших же настроек.
           Пароль, bcrypt и счётчик попыток при этом никуда не делись.

           Так же — на тестовых ключах Cloudflare. Панель сама советует
           вставить пару «всегда НЕ проходит», и она отбивала бы и этот
           вход: выйдя из панели, владелец оставался бы снаружи. Защиты
           тестовые ключи не дают никакой, так что пропуск ничего не стоит. */
        usleep(300000);

        /* Токена нет вовсе — значит виджет не нарисовался. Чаще всего это
           неверный Site Key: он публичный, его легко перепутать с секретным.
           Правятся ключи только из панели, то есть в эту ловушку можно
           запереть себя насовсем — поэтому здесь не общая отговорка,
           а прямое указание, что делать на сервере. */
        $err = in_array('missing-input-response', $cap['codes'], true)
            ? 'Проверка не загрузилась — виджет не появился на странице. Если его не видно '
              . 'и после обновления, значит неверен Site Key. Удалите на сервере файл '
              . 'site-data/security.json (cPanel → File Manager) — капча выключится, '
              . 'и вход заработает по паролю.'
            : 'Проверка «человек ли это» не пройдена. Обновите страницу и попробуйте ещё раз.';
    } elseif (!($try = attempts_take('login', $key, ADMIN_LOGIN_LIMIT, ADMIN_LOGIN_WINDOW, ADMIN_LOGIN_LOCK))['ok']) {
        /* Попытка засчитывается ДО проверки пароля, под замком. Проверка
           в начале страницы — только быстрый отказ: одновременные запросы
           читали счётчик раньше, чем первый из них его поднимал, и
           проверялись все пароли пачки, а не пять. */
        $left = $try['until'] - time();
        $err = 'Слишком много попыток. Вход закрыт на ' . ceil($left / 60) . ' мин.';
    } else {
        /* is_string: поле можно прислать массивом (email[]=x), и функция
           с объявленным строковым типом роняла бы страницу входа с 500. */
        $email = clean_text(is_string($_POST['email'] ?? null) ? $_POST['email'] : '');
        $pw    = is_string($_POST['password'] ?? null) ? $_POST['password'] : '';
        $auth  = admin_auth();

        /* Проверяем хэш даже при несовпавшей почте: иначе ответ на чужую
           почту приходит заметно быстрее, и по времени видно, какая
           учётная запись существует. */
        $hash = $auth['hash'] ?? '$2y$10$invalidinvalidinvalidinvalidinvalidinvalidinvalidinvalidinv';
        $okPw = password_verify($pw, $hash);
        $okEm = $auth && hash_equals(mb_strtolower($auth['email']), mb_strtolower($email));

        if ($auth && $okPw && $okEm) {
            attempts_clear('login', $key);
            /* Пароль пересчитывается, если PHP с тех пор научился лучшему
               способу хранения: это бесплатно и делается при входе. */
            if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
                $auth['hash'] = password_hash($pw, PASSWORD_DEFAULT);
                Store::write('auth.json', $auth);
            }
            admin_login($auth);
            if (random_int(1, 20) === 1) attempts_sweep('login');
            admin_go(admin_url('dashboard'));
        } else {
            $n = $try['tries'];               // попытка уже засчитана выше

            /* Общий счётчик неудач — без адреса в ключе. Он НИЧЕГО НЕ
               ЗАПИРАЕТ: общий запрет позволил бы одному человеку держать
               владельца вне его же панели, просто тратя попытки. Он нужен,
               чтобы подбор с тысяч адресов, невидимый для счётчика по
               адресу, был виден в разделе «Безопасность». Под замком:
               одновременные неудачи иначе терялись — именно при том
               подборе, который счётчик должен показывать. */
            Store::update('locks/login-total.json', static function (array $all): array {
                $hour = (int)floor(time() / 3600);
                $all = array_filter($all, static fn($v, $h) => (int)$h > $hour - 24, ARRAY_FILTER_USE_BOTH);
                $all[$hour] = (int)($all[$hour] ?? 0) + 1;
                return $all;
            });
            usleep(400000);
            $rest = ADMIN_LOGIN_LIMIT - $n;
            $err = 'Почта или пароль не подходят.'
                 . ($rest > 0 && $rest <= 2 ? ' Осталось попыток: ' . $rest . '.' : '');
        }
    }
}

header('Content-Type: text/html; charset=utf-8');
$flash = admin_take_flash();
?>
<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="robots" content="noindex,nofollow">
<title>Вход — панель MGuliyev Studio</title>
<?php admin_assets(); ?>
<?= ts_script() ?>
</head>
<body>
<div class="login">
  <form class="box" method="post" action="/admin/index.php?section=login">
    <div class="brandline">MGuliyev Studio</div>
    <h2>Вход в панель</h2>
    <div class="sub">Управление содержимым сайта</div>

    <?php if ($flash): ?>
      <div class="flash<?= in_array($flash['kind'], ['warn','err'], true) ? ' ' . $e($flash['kind']) : '' ?>"><?= $e($flash['text']) ?></div>
    <?php endif; ?>
    <?php if ($err): ?><div class="flash err"><?= $e($err) ?></div><?php endif; ?>

    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">

    <label for="email">Почта</label>
    <input type="email" id="email" name="email" required autofocus
           autocomplete="username" value="<?= $e($email) ?>">

    <label for="password">Пароль</label>
    <input type="password" id="password" name="password" required autocomplete="current-password">

    <?php if (ts_on()): ?>
      <div style="margin-top:16px"><?= ts_widget('admin-login', 'light') ?></div>
    <?php endif; ?>
    <?php if (!empty($cap) && $cap['bucket'] === 'config'): ?>
      <div class="flash warn" style="margin-top:14px">
        Капча настроена неверно (<?= $e(implode(', ', $cap['codes'])) ?>), поэтому она
        сейчас не проверяется и вход работает по паролю. Зайдите и поправьте ключи
        в разделе «Безопасность».
      </div>
    <?php elseif (!empty($cap) && !$cap['ok'] && ts_is_test()): ?>
      <div class="flash warn" style="margin-top:14px">
        Стоят тестовые ключи Cloudflare, и проверка не пройдена
        (<?= $e(implode(', ', $cap['codes'])) ?>). Вход в панель такой отказ пропускает —
        иначе пара «всегда НЕ проходит» заперла бы вас снаружи; вход проверяется паролем.
        Формы сайта такой отказ не пропускают. Замените ключи в разделе «Безопасность».
      </div>
    <?php endif; ?>

    <button class="btn" style="width:100%;margin-top:18px" type="submit"
            <?= $left > 0 ? 'disabled' : '' ?>>Войти</button>

    <p class="muted" style="margin-top:14px;text-align:center">
      Забыли пароль — удалите файл <b class="mono">site-data/auth.json</b>
      на сервере и создайте учётную запись заново.<br>
      Мешает капча — удалите <b class="mono">site-data/security.json</b>:
      она выключится, остальное не изменится.
    </p>
  </form>
</div>
</body>
</html>
