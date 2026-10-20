<?php
/* Создание учётной записи при первом запуске.

   Пароля в репозитории нет и быть не может: репозиторий лежит на GitHub,
   а логин с паролем в истории коммитов — это навсегда. Поэтому учётная
   запись создаётся на самом сервере, через эту страницу.

   Страница открыта всем, пока учётной записи нет. Чтобы этим не
   воспользовался случайный посетитель, который наберёт /admin/ раньше
   владельца, она требует код из файла ~/site-data/setup-code.txt. Файл
   лежит выше корня сайта: открыть его можно только через cPanel File
   Manager или SSH, то есть имея доступ к серверу. */

$e    = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$err  = '';
$vals = ['email' => ''];

/* Проблема с хранилищем здесь важнее всего: без записи учётную запись
   создать невозможно, и надо сказать это прямо, а не показывать форму,
   которая молча ничего не сделает. */
$storeProblem = admin_store_problem();

if (!$storeProblem && ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    admin_check_post();

    $key  = ip_key('setup');
    $lock = attempts_get('setup', $key);
    if ($lock['until'] > time()) {
        $err = 'Слишком много попыток. Повторите через ' . ceil(($lock['until'] - time()) / 60) . ' мин.';
    } else {
        $code  = strtoupper(clean_text($_POST['code'] ?? ''));
        $email = clean_text($_POST['email'] ?? '');
        $pw    = (string)($_POST['password'] ?? '');
        $pw2   = (string)($_POST['password2'] ?? '');
        $vals['email'] = $email;

        $want = admin_setup_code();

        if (!hash_equals($want, $code)) {
            attempts_fail('setup', $key, ADMIN_LOGIN_LIMIT, ADMIN_LOGIN_WINDOW, ADMIN_LOGIN_LOCK);
            usleep(400000);
            $err = 'Код не совпал. Он лежит в файле site-data/setup-code.txt на сервере.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err = 'Почта записана неверно.';
        } elseif (mb_strlen($pw) < ADMIN_PW_MIN) {
            $err = 'Пароль короче ' . ADMIN_PW_MIN . ' знаков. Длина важнее сложности: '
                 . 'четыре обычных слова подряд надёжнее, чем «Pa$$w0rd».';
        } elseif ($pw !== $pw2) {
            $err = 'Пароли не совпали.';
        } else {
            $auth = [
                'email'      => $email,
                'hash'       => password_hash($pw, PASSWORD_DEFAULT),
                'created'    => time(),
                'pw_changed' => time(),
            ];
            if (!Store::write('auth.json', $auth)) {
                $err = 'Не удалось записать учётную запись. Проверьте права на папку ' . Store::dir();
            } else {
                attempts_clear('setup', $key);
                admin_setup_done();
                admin_login($auth);
                admin_flash('Учётная запись создана. Файл setup-code.txt больше не нужен и удалён.');
                admin_go(admin_url('dashboard'));
            }
        }
    }
}

/* Код создаётся при первом открытии страницы — тогда же появляется и файл. */
if (!$storeProblem) admin_setup_code();

header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="robots" content="noindex,nofollow">
<title>Первый вход — панель MGuliyev Studio</title>
<?php admin_assets(); ?>
<?= ts_script() ?>
</head>
<body>
<div class="login">
  <form class="box" method="post" action="/admin/index.php?section=setup">
    <div class="brandline">MGuliyev Studio</div>
    <h2>Первый вход</h2>
    <div class="sub">Учётной записи ещё нет — создадим её сейчас.</div>

    <?php if ($storeProblem): ?>
      <div class="flash err"><?= $e($storeProblem) ?></div>
      <p class="muted">Создайте папку и дайте веб-серверу право записи в неё.
         В cPanel это File Manager → Permissions, значение 750.</p>
    <?php else: ?>
      <?php if ($err): ?><div class="flash err"><?= $e($err) ?></div><?php endif; ?>

      <div class="note">
        Код лежит на сервере в файле<br>
        <b class="mono">site-data/setup-code.txt</b><br>
        Откройте его через cPanel → File Manager. Так панель убеждается,
        что учётную запись создаёт владелец сайта, а не случайный посетитель.
      </div>

      <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">

      <label for="code">Код из файла</label>
      <input type="text" id="code" name="code" required autofocus autocomplete="off"
             spellcheck="false" placeholder="XXXX-XXXX-XXXX" class="mono">

      <label for="email">Почта для входа</label>
      <input type="email" id="email" name="email" required autocomplete="username"
             value="<?= $e($vals['email']) ?>">

      <label for="password">Пароль <span class="hint">не короче <?= ADMIN_PW_MIN ?> знаков</span></label>
      <input type="password" id="password" name="password" required
             autocomplete="new-password" minlength="<?= ADMIN_PW_MIN ?>">

      <label for="password2">Пароль ещё раз</label>
      <input type="password" id="password2" name="password2" required
             autocomplete="new-password" minlength="<?= ADMIN_PW_MIN ?>">

      <button class="btn" style="width:100%;margin-top:18px" type="submit">Создать учётную запись</button>
    <?php endif; ?>
  </form>
</div>
</body>
</html>
