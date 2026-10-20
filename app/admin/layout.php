<?php
/* Обвязка страниц панели: боковая колонка, верхняя строка, подвал.

   Разделы выводят только своё содержимое, а шапку и меню рисует этот файл.
   Поэтому новый раздел добавляется одной строкой в ADMIN_SECTIONS и одним
   файлом в sections/, и меню с заголовком получаются сами.

   Мобильное меню — скрытый флажок и селектор #navtoggle:checked ~ .wrap,
   без скрипта. Это не экономия, а осознанный выбор: в панели правится
   текст, и чем меньше в ней исполняемого кода, тем лучше. */

/** Общая шапка всех страниц панели: шрифт, стили, значок вкладки.

    Значок у панели свой, в её цветах: вкладка панели и вкладка сайта
    не должны выглядеть одинаково — иначе при десятке открытых вкладок
    правка уходит не туда. Знак тот же — буква M из логотипа. */
function admin_assets(): void
{
    ?>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/admin/assets/admin.css?v=2">
<link rel="icon" href="/admin/assets/favicon.ico" sizes="32x32">
<link rel="icon" href="/admin/assets/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/admin/assets/apple-touch-icon.png">
<meta name="theme-color" content="#0e2f47">
    <?php
}

/** Разделы: ключ => [заголовок, значок, группа]. Порядок определяет меню. */
function admin_sections(): array
{
    return [
        'dashboard' => ['Сводка',              '▦', 'Сайт'],
        'settings'  => ['Контакты и цены',     '☎', 'Сайт'],
        'mail'      => ['Почта',               '✉', 'Сайт'],
        'portfolio' => ['Портфолио',           '▣', 'Содержимое'],
        'uslugi'    => ['Услуги',              '☰', 'Содержимое'],
        'packs'     => ['Пакеты и цены',       '₼', 'Содержимое'],
        'blog'      => ['Блог',                '✎', 'Содержимое'],
        'seo'       => ['Заголовки для поиска', '⌕', 'Поиск'],
        'texts'     => ['Строки страниц',      'Aa', 'Поиск'],
        'media'     => ['Изображения',         '▤', 'Файлы'],
        'security'  => ['Безопасность',        '⛨', 'Доступ'],
        'account'   => ['Учётная запись',      '◉', 'Доступ'],
    ];
}

function admin_head(string $section): void
{
    $secs = admin_sections();
    $title = $secs[$section][0] ?? 'Панель';
    $user  = admin_user();
    $lang  = admin_lang();
    $e     = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

    /* Счётчики в меню: редактор сразу видит объём, не открывая раздел. */
    $counts = [
        'portfolio' => array_sum(array_map(static fn($g) => count($g['projects']), works_canon())),
        'uslugi'    => count(catalog_canon()),
        'packs'     => count(packs_canon()),
        'blog'      => count(articles_canon()),
    ];

    /* Насколько заполнен каждый язык: редактор должен видеть, где дыры,
       до того как откроет раздел и начнёт искать их глазами. */
    $fill = admin_lang_fill();

    header('Content-Type: text/html; charset=utf-8');
    ?>
<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="robots" content="noindex,nofollow">
<title><?= $e($title) ?> — панель MGuliyev Studio</title>
<?php admin_assets(); ?>
</head>
<body>
<input type="checkbox" id="navtoggle" aria-hidden="true" tabindex="-1">
<div class="wrap">
  <label class="scrim" for="navtoggle" aria-label="Закрыть меню"></label>

  <aside class="side">
    <div class="brand">
      <b>MGuliyev Studio</b>
      <span>панель управления</span>
    </div>
    <nav aria-label="Разделы панели">
      <?php
      $group = null;
      foreach ($secs as $key => [$name, $icon, $g]):
          if ($g !== $group) { $group = $g; echo '<div class="navgroup">' . $e($g) . '</div>'; }
      ?>
        <a href="<?= $e(admin_url($key)) ?>"<?= $key === $section ? ' class="on" aria-current="page"' : '' ?>>
          <i aria-hidden="true"><?= $icon ?></i><?= $e($name) ?>
          <?php if (!empty($counts[$key])): ?><span class="badge"><?= (int)$counts[$key] ?></span><?php endif; ?>
        </a>
      <?php endforeach; ?>
      <div class="navgroup">Сайт</div>
      <a href="/" target="_blank" rel="noopener"><i aria-hidden="true">↗</i>Открыть сайт</a>
    </nav>
    <?php if ($user): ?>
    <div class="who">
      <b><?= $e($user['email']) ?></b>
      <span class="role">редактор сайта</span>
      <?php /* Выход и здесь, и в верхней строке: на телефоне верхняя строка
               узкая, и кнопка оттуда убрана, иначе она уезжает за край. */ ?>
      <form method="post" action="<?= $e(admin_url('logout')) ?>" style="margin-top:12px">
        <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
        <button class="btn ghost sm" type="submit" style="color:#b7cddc;border-color:#17415f">Выйти</button>
      </form>
    </div>
    <?php endif; ?>
  </aside>

  <main>
    <div class="bar">
      <label class="burger" for="navtoggle" aria-label="Открыть меню">
        <span></span><span></span><span></span>
      </label>
      <h1><?= $e($title) ?></h1>
      <div class="bar-r">
        <div class="langsw" role="group" aria-label="Язык, который правим">
          <?php foreach (langs() as $l):
              $cls = $l === $lang ? 'on' : (($fill[$l] ?? 100) < 100 ? 'part' : '');
              $pc  = (int)($fill[$l] ?? 100);
          ?>
            <a href="<?= $e(admin_url($section, ['lang' => $l])) ?>"<?= $cls ? ' class="' . $cls . '"' : '' ?>
               title="<?= $e(strtoupper($l) . ': заполнено ' . $pc . '%') ?>"><?= $e(strtoupper($l)) ?></a>
          <?php endforeach; ?>
        </div>
        <?php if ($user): ?>
          <?php /* Открываем сайт на том языке, который сейчас правим:
                   иначе редактор меняет азербайджанский текст, жмёт
                   «Открыть сайт» и видит русскую страницу. */ ?>
          <a class="btn ghost open-site" href="<?= $e(u('/', $lang)) ?>"
             target="_blank" rel="noopener">Открыть сайт</a>
          <form method="post" action="<?= $e(admin_url('logout')) ?>" style="margin:0">
            <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
            <button class="btn" type="submit">Выйти</button>
          </form>
        <?php endif; ?>
      </div>
    </div>
    <div class="body">
    <?php
    if ($f = admin_take_flash()) {
        $k = in_array($f['kind'], ['warn', 'err'], true) ? ' ' . $f['kind'] : '';
        echo '<div class="flash' . $k . '" role="status">' . $e($f['text']) . '</div>';
    }
    if ($p = admin_store_problem()) {
        echo '<div class="flash err" role="alert">' . $e($p) . '</div>';
    }
    ?>
<?php
}

function admin_foot(): void
{
    ?>
    </div>
  </main>
</div>
<script src="/admin/assets/admin.js?v=1"></script>
</body>
</html>
<?php
}

/** Доля заполненных строк по каждому языку, в процентах.
    Считается по словарю: это самая большая и самая показательная часть. */
function admin_lang_fill(): array
{
    $t = texts_canon();
    $total = count($t);
    $out = [];
    foreach (langs() as $l) {
        if ($total === 0) { $out[$l] = 100; continue; }
        $n = 0;
        foreach ($t as $byLang) {
            if (isset($byLang[$l]) && $byLang[$l] !== '') $n++;
        }
        $out[$l] = (int)round($n * 100 / $total);
    }
    return $out;
}

/** Поле с тремя языками сразу: редактор видит русский рядом с переводом
    и не держит его в голове, переключаясь между страницами. */
function admin_field_langs(string $name, array $vals, string $label, array $o = []): void
{
    $e    = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $area = !empty($o['area']);
    $rows = $o['rows'] ?? null;
    $hint = $o['hint'] ?? '';
    $max  = $o['max'] ?? 0;

    echo '<label>' . $e($label);
    if ($hint !== '') echo ' <span class="hint">' . $e($hint) . '</span>';
    echo '</label>';
    echo '<div class="row3">';
    foreach (langs() as $l) {
        $v  = $vals[$l] ?? '';
        $id = $name . '_' . $l;
        $ph = $l === deflang() ? '' : 'пусто — возьмётся русский';
        echo '<div>';
        echo '<div class="muted" style="margin-bottom:4px"><b>' . $e(strtoupper($l)) . '</b></div>';
        if ($area) {
            echo '<textarea id="' . $e($id) . '" name="' . $e($name) . '[' . $e($l) . ']"'
               . ($rows ? ' rows="' . (int)$rows . '"' : '')
               . ($max ? ' data-max="' . (int)$max . '"' : '')
               . ' placeholder="' . $e($ph) . '">' . $e($v) . '</textarea>';
        } else {
            echo '<input type="text" id="' . $e($id) . '" name="' . $e($name) . '[' . $e($l) . ']"'
               . ' value="' . $e($v) . '"'
               . ($max ? ' data-max="' . (int)$max . '"' : '')
               . ' placeholder="' . $e($ph) . '">';
        }
        echo '</div>';
    }
    echo '</div>';
}

/* ------------------------------------------------- части списков ----
   Три раздела показывают список записей, и выглядеть они должны
   одинаково. Поэтому номер, точка заполненности и шапка списка
   собираются здесь, а не повторяются в каждом разделе своими руками. */

/** Номер записи с ведущим нулём: 01, 02 … Глаз цепляется за колонку
    одинаковой ширины, а не за прыгающие 9 и 10. */
function admin_num(int $i): string
{
    return str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT);
}

/** Точка заполненности. Подпись обязательна: цвет сам по себе ничего
    не сообщает тому, кто его не различает, и читалке с экрана. */
function admin_dot(bool $on, string $what): string
{
    $title = $what . ': ' . ($on ? 'заполнено' : 'пусто');
    return '<span class="dot' . ($on ? ' on' : '') . '" title="'
         . htmlspecialchars($title, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')
         . '" role="img" aria-label="' . htmlspecialchars($title, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')
         . '"></span>';
}

/** Точки по языкам: сразу видно, где перевода нет. */
function admin_lang_dots(array $byLang, string $what): string
{
    $out = '';
    foreach (langs() as $l) {
        $v = $byLang[$l] ?? '';
        $on = is_array($v) ? !empty($v) : (is_string($v) && $v !== '');
        $out .= admin_dot($on, strtoupper($l) . ' — ' . $what);
    }
    return $out;
}

/** Шапка списка: сколько всего слева, кнопка добавления справа. */
function admin_list_head(int $total, string $word, ?string $addLabel = null, ?string $addHref = null): void
{
    $e = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    echo '<div class="listhead"><div class="total">' . $e($word) . ': <b>' . $total . '</b></div>';
    if ($addLabel !== null && $addHref !== null) {
        echo '<a class="btn" href="' . $e($addHref) . '">+ ' . $e($addLabel) . '</a>';
    }
    echo '</div>';
}

/** Миниатюра для строки списка; нет картинки — видимая заглушка,
    чтобы колонка не схлопывалась и было понятно, что снимка нет. */
function admin_thumb(?string $src, string $alt = ''): string
{
    $e = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    return $src
        ? '<img src="' . $e($src) . '" alt="' . $e($alt) . '" loading="lazy">'
        : '<span class="nopic" title="снимка нет">нет</span>';
}
