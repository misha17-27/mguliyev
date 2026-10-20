<?php
/* Учётная запись: почта и пароль.

   Смена того и другого требует текущего пароля. Это не формальность:
   если редактор отошёл от незакрытого ноутбука, без этой проверки любой
   прохожий меняет пароль и забирает панель себе насовсем.

   После смены пароля сессия перезаводится: номер сессии в cookie остаётся
   прежним и у того, кто мог её подсмотреть, поэтому смена пароля должна
   обрывать все прежние входы, включая текущий. */

$e    = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$auth = admin_auth();

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $cur   = (string)($_POST['current'] ?? '');
    $email = post_one($_POST['email'] ?? '');
    $pw    = (string)($_POST['password'] ?? '');
    $pw2   = (string)($_POST['password2'] ?? '');

    $key  = ip_key('account');
    $lock = attempts_get('account', $key);

    if ($lock['until'] > time()) {
        admin_flash('Слишком много попыток. Повторите через '
            . ceil(($lock['until'] - time()) / 60) . ' мин.', 'err');
    } elseif (!password_verify($cur, $auth['hash'])) {
        attempts_fail('account', $key, ADMIN_LOGIN_LIMIT, ADMIN_LOGIN_WINDOW, ADMIN_LOGIN_LOCK);
        usleep(400000);
        admin_flash('Текущий пароль не подошёл.', 'err');
    } elseif ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        admin_flash('Почта записана неверно.', 'err');
    } elseif ($pw !== '' && mb_strlen($pw) < ADMIN_PW_MIN) {
        admin_flash('Новый пароль короче ' . ADMIN_PW_MIN . ' знаков.', 'err');
    } elseif ($pw !== '' && $pw !== $pw2) {
        admin_flash('Новые пароли не совпали.', 'err');
    } elseif ($pw === '' && ($email === '' || $email === $auth['email'])) {
        admin_flash('Менять нечего: ни почта, ни пароль не изменились.', 'warn');
    } else {
        attempts_clear('account', $key);
        $new = $auth;
        if ($email !== '') $new['email'] = $email;
        if ($pw !== '') {
            $new['hash'] = password_hash($pw, PASSWORD_DEFAULT);
            $new['pw_changed'] = time();
        }

        if (Store::write('auth.json', $new)) {
            if ($pw !== '') {
                /* Пароль сменили — обрываем все прежние входы и входим заново
                   уже под новой записью. */
                admin_logout();
                admin_login($new);
                admin_flash('Пароль изменён. Все прежние входы закрыты.');
            } else {
                admin_login($new);                 // uid считается из почты и хэша
                admin_flash('Почта изменена.');
            }
        } else {
            admin_flash('Не удалось сохранить.', 'err');
        }
    }
    admin_go(admin_url('account'));
}

admin_head('account');
?>

<div class="row">
  <div class="panel">
    <h3>Почта и пароль</h3>
    <p class="muted">Текущий пароль нужен в обоих случаях — иначе панель заберёт
       себе любой, кто подойдёт к незакрытому компьютеру.</p>

    <form method="post" action="<?= $e(admin_url('account')) ?>">
      <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
      <input type="text" name="username" value="<?= $e($auth['email']) ?>"
             autocomplete="username" hidden>

      <label for="current">Текущий пароль</label>
      <input type="password" id="current" name="current" required autocomplete="current-password">

      <label for="email">Почта для входа</label>
      <input type="email" id="email" name="email" value="<?= $e($auth['email']) ?>">

      <label for="password">Новый пароль
        <span class="hint">пусто — оставить прежний; не короче <?= ADMIN_PW_MIN ?> знаков</span></label>
      <input type="password" id="password" name="password" autocomplete="new-password">

      <label for="password2">Новый пароль ещё раз</label>
      <input type="password" id="password2" name="password2" autocomplete="new-password">

      <div class="btnrow"><button class="btn" type="submit">Сохранить</button></div>
    </form>
  </div>

  <div>
    <div class="panel">
      <h3>Что хранится</h3>
      <table>
        <tr><td>Почта</td><td class="right mono"><?= $e($auth['email']) ?></td></tr>
        <tr><td>Пароль</td><td class="right">хэш bcrypt, сам пароль нигде не хранится</td></tr>
        <tr><td>Создана</td><td class="right"><?= $e(date('d.m.Y', (int)($auth['created'] ?? 0))) ?></td></tr>
        <tr><td>Пароль менялся</td><td class="right"><?= $e(date('d.m.Y', (int)($auth['pw_changed'] ?? 0))) ?></td></tr>
        <tr><td>Файл</td><td class="right mono"><?= $e(Store::dir()) ?>/auth.json</td></tr>
      </table>
    </div>

    <div class="panel">
      <h3>Если пароль забыт</h3>
      <p class="muted">Восстановления по почте здесь нет намеренно: оно требует
         отправки писем и само становится способом зайти. Вместо него —
         доступ к серверу.</p>
      <p class="muted">Удалите на сервере файл <b class="mono">site-data/auth.json</b>
         через cPanel → File Manager и откройте <b class="mono">/admin/</b>.
         Панель предложит создать запись заново и попросит код из нового файла
         <b class="mono">setup-code.txt</b>. Содержимое сайта при этом не трогается.</p>
    </div>

    <div class="panel">
      <h3>Сессия</h3>
      <table>
        <tr><td>Закроется без действий через</td><td class="right"><?= (int)(ADMIN_SESSION_IDLE / 3600) ?> ч</td></tr>
        <tr><td>Закроется в любом случае через</td><td class="right"><?= (int)(ADMIN_SESSION_MAX / 3600) ?> ч</td></tr>
        <tr><td>Попыток входа подряд</td><td class="right"><?= ADMIN_LOGIN_LIMIT ?>, потом <?= (int)(ADMIN_LOGIN_LOCK / 60) ?> мин запрета</td></tr>
      </table>
    </div>
  </div>
</div>

<?php admin_foot(); ?>
