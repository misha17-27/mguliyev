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
              && $cap['bucket'] !== 'config') {
        /* Неудача капчи НЕ считается попыткой входа: иначе чужая страница,
           отправляющая форму без токена, выжигала бы владельцу все пять
           попыток и закрывала ему вход на пятнадцать минут. Пароль при
           этом не проверялся вовсе, так что и подбора здесь нет.

           А при bucket='config' вход ПРОПУСКАЕТСЯ. Это не послабление,
           а единственный выход из ловушки: ключи правятся только из
           панели, и опечатка в секретном ключе иначе запирала бы
           владельца в его собственном сайте навсегда. Посетитель вызвать
           такую ошибку не может — она берётся из наших же настроек.
           Пароль, bcrypt и счётчик попыток при этом никуда не делись. */
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
            $n = attempts_fail('login', $key, ADMIN_LOGIN_LIMIT, ADMIN_LOGIN_WINDOW, ADMIN_LOGIN_LOCK);
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
