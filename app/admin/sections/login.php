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
    } elseif (!($cap = ts_verify($_POST['cf-turnstile-response'] ?? null, 'admin-login'))['ok']) {
        /* Неудача капчи НЕ считается попыткой входа: иначе чужая страница,
           отправляющая форму без токена, выжигала бы владельцу все пять
           попыток и закрывала ему вход на пятнадцать минут. Пароль при
           этом не проверялся вовсе, так что и подбора здесь нет. */
        usleep(300000);
        $err = $cap['bucket'] === 'config'
            ? 'Капча настроена неверно (' . implode(', ', $cap['codes']) . '). '
              . 'Исправьте ключи в разделе «Безопасность» или уберите их, чтобы войти.'
            : 'Проверка «человек ли это» не пройдена. Обновите страницу и попробуйте ещё раз.';
    } else {
        $email = clean_text($_POST['email'] ?? '');
        $pw    = (string)($_POST['password'] ?? '');
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

    <button class="btn" style="width:100%;margin-top:18px" type="submit"
            <?= $left > 0 ? 'disabled' : '' ?>>Войти</button>

    <p class="muted" style="margin-top:14px;text-align:center">
      Забыли пароль — удалите файл <b class="mono">site-data/auth.json</b>
      на сервере и создайте учётную запись заново.
    </p>
  </form>
</div>
</body>
</html>
