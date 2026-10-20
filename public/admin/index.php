<?php
/* Единственная точка входа в панель управления.

   Все разделы открываются через ?section=…, а их код лежит в ../../app/admin/
   — выше корня сайта. Поэтому раздел невозможно открыть в обход проверки
   входа: по адресу его файла просто нет. Имя раздела сверяется со списком,
   а не подставляется в путь, поэтому ?section=../../config тоже ничего не даст. */

require __DIR__ . '/../../app/admin/boot.php';
require __DIR__ . '/../../app/admin/layout.php';

admin_boot();

/* Выход — только POST со своим ключом: иначе чужая картинка с адресом
   /admin/index.php?section=logout выкидывала бы редактора из панели. */
$section = (string)($_GET['section'] ?? 'dashboard');

if ($section === 'logout') {
    admin_check_post();
    admin_logout();
    admin_flash('Вы вышли из панели.');
    admin_go(admin_url('login'));
}

/* Нет учётной записи — только начальная настройка, что бы ни запросили. */
if (!admin_auth()) {
    require __DIR__ . '/../../app/admin/sections/setup.php';
    exit;
}

/* Не вошёл — только страница входа. */
if (!admin_user()) {
    require __DIR__ . '/../../app/admin/sections/login.php';
    exit;
}

/* Переключатель языка в верхней строке. Запоминаем в сессии, чтобы при
   переходе между разделами язык не сбрасывался. */
if (isset($_GET['lang'])) {
    admin_set_lang((string)$_GET['lang']);
    $q = $_GET;
    unset($q['lang']);
    admin_go('/admin/index.php?' . http_build_query($q ?: ['section' => 'dashboard']));
}

$known = array_keys(admin_sections());
if (!in_array($section, $known, true)) $section = 'dashboard';

admin_check_post();

$file = __DIR__ . '/../../app/admin/sections/' . $section . '.php';
if (!is_file($file)) {
    $section = 'dashboard';
    $file = __DIR__ . '/../../app/admin/sections/dashboard.php';
}
require $file;
