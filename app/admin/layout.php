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
<link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:wght@600;700&family=Golos+Text:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/admin/assets/admin.css?v=3">
<link rel="icon" href="/admin/assets/favicon.ico?v=2" sizes="32x32">
<link rel="icon" href="/admin/assets/favicon.svg?v=2" type="image/svg+xml">
<link rel="apple-touch-icon" href="/admin/assets/apple-touch-icon.png?v=2">
<meta name="theme-color" content="#0A0A0A">
    <?php
}

/** Разделы: ключ => [заголовок, значок, группа]. Порядок определяет меню. */
function admin_sections(): array
{
    /* Три группы вместо шести. Было 14 пунктов, и два из них —
       «Заголовки для поиска» и «Строки страниц» — дублировали «Страницы»:
       у каждой страницы там правятся и текст, и заголовок в выдаче.
       Общие строки (меню, подвал, формы) теперь тоже в «Страницах»,
       отдельной строкой.

       Группа null — раздел работает по адресу, но в меню не показан:
       на него ведут ссылки со сводки, и ломать их незачем. */
    return [
        'dashboard' => ['Сводка',              '▦', 'Сайт'],
        'leads'     => ['Заявки с сайта',      '✉', 'Сайт'],

        'pages'     => ['Страницы',            '▤', 'Содержимое'],
        'portfolio' => ['Портфолио',           '▣', 'Содержимое'],
        'uslugi'    => ['Услуги',              '☰', 'Содержимое'],
        'packs'     => ['Пакеты и цены',       '₼', 'Содержимое'],
        'blog'      => ['Блог',                '✎', 'Содержимое'],
        'media'     => ['Изображения',         '▧', 'Содержимое'],

        'settings'  => ['Контакты',            '☎', 'Настройки'],
        'mail'      => ['Почта',               '@', 'Настройки'],
        'security'  => ['Безопасность',        '⛨', 'Настройки'],
        'account'   => ['Учётная запись',      '◉', 'Настройки'],

        'seo'       => ['Заголовки для поиска', '⌕', null],
        'texts'     => ['Строки страниц',      'Aa', null],
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
        /* В меню показываем НЕПРОСМОТРЕННЫЕ, а не все: счётчик нужен,
           чтобы заметить новую заявку, а не чтобы знать их общее число. */
        'leads'     => admin_new_leads(),
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
      <?php /* Логотип тот же, что в подвале сайта — белый вариант на тёмном.
               Ссылкой на сводку: в панели привычно, что знак ведёт на главную. */ ?>
      <a href="<?= $e(admin_url('dashboard')) ?>" aria-label="MGuliyev Studio — сводка">
        <img src="/images/brand/guliyev-white-logo.svg" alt="MGuliyev Studio" width="190" height="78">
      </a>
      <span>панель управления</span>
    </div>
    <nav aria-label="Разделы панели">
      <?php
      $group = null;
      foreach ($secs as $key => [$name, $icon, $g]):
          if ($g === null) continue;          // раздел без пункта в меню
          if ($g !== $group) { $group = $g; echo '<div class="navgroup">' . $e($g) . '</div>'; }
      ?>
        <a href="<?= $e(admin_url($key)) ?>"<?= $key === $section ? ' class="on" aria-current="page"' : '' ?>>
          <i aria-hidden="true"><?= $icon ?></i><?= $e($name) ?>
          <?php if (!empty($counts[$key])): ?><span class="badge"><?= (int)$counts[$key] ?></span><?php endif; ?>
        </a>
      <?php endforeach; ?>
      <a class="only-phone" href="/" target="_blank" rel="noopener"><i aria-hidden="true">↗</i>Открыть сайт</a>
    </nav>
    <?php if ($user): ?>
    <div class="who">
      <b><?= $e($user['email']) ?></b>
      <span class="role">редактор сайта</span>
      <?php /* Выход и здесь, и в верхней строке: на телефоне верхняя строка
               узкая, и кнопка оттуда убрана, иначе она уезжает за край. */ ?>
      <form method="post" action="<?= $e(admin_url('logout')) ?>" style="margin-top:12px">
        <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
        <button class="btn ghost sm" type="submit" style="color:var(--side-text);border-color:var(--side-line)">Выйти</button>
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
          <?php
          /* Переключение языка оставляет на той же записи: экраны правки
             говорят «язык переключается вверху», и переход к списку раздела
             выбрасывал редактора из статьи или проекта, который он переводит. */
          $keepQ = [];
          foreach ($_GET as $qk => $qv) {
              if ($qk === 'section' || $qk === 'lang' || !is_string($qv)
                  || !preg_match('~^[a-z_]{1,20}$~', (string)$qk)) continue;
              $keepQ[$qk] = $qv;
          }
          foreach (langs() as $l):
              $cls = $l === $lang ? 'on' : (($fill[$l] ?? 100) < 100 ? 'part' : '');
              $pc  = (int)($fill[$l] ?? 100);
          ?>
            <a href="<?= $e(admin_url($section, $keepQ + ['lang' => $l])) ?>"<?= $cls ? ' class="' . $cls . '"' : '' ?>
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

    /* Испорченный файл хранилища показываем на КАЖДОЙ странице панели.
       Сайт в этом случае молча берёт данные из репозитория, и редактор
       видит прежние тексты — легко решить, что правки «откатились»,
       и сохранить заново поверх единственной копии. */
    $broken = Store::broken(['works.json', 'catalog.json', 'packs.json', 'articles.json',
        'texts.json', 'seo.json', 'settings.json', 'mail.json', 'security.json', 'auth.json']);
    foreach ($broken as $rel => $why) {
        echo '<div class="flash err" role="alert">Файл <b class="mono">' . $e($rel) . '</b> '
           . 'в хранилище испорчен (' . $e($why) . '). Правки из него сейчас НЕ применяются — '
           . 'сайт показывает данные разработчика. При следующем сохранении в этом разделе '
           . 'испорченная копия будет отложена рядом с пометкой .broken, и её можно будет '
           . 'восстановить вручную через cPanel → File Manager.</div>';
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

/** Поле на языке, выбранном в верхней строке, — на всю ширину.

    Остальные языки уходят скрытыми полями с прежними значениями. Это не
    украшение: разделы портфолио, услуг и пакетов собирают файл целиком
    из формы, и язык, которого в форме нет, превратился бы в пустую строку —
    правка азербайджанского текста стёрла бы русский и английский.

    Под полем перевода виден русский оригинал: переводят с него, и держать
    его в голове, переключаясь туда-обратно, незачем. */
function admin_field_langs(string $name, array $vals, string $label, array $o = []): void
{
    $e    = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $area = !empty($o['area']);
    $rows = (int)($o['rows'] ?? 0);
    $hint = $o['hint'] ?? '';
    $max  = (int)($o['max'] ?? 0);
    $cur  = admin_lang();
    $def  = deflang();

    echo '<label>' . $e($label)
       . ' <span class="pill grey" style="vertical-align:1px">' . $e(strtoupper($cur)) . '</span>';
    if ($hint !== '') echo ' <span class="hint">' . $e($hint) . '</span>';
    echo '</label>';

    $v  = $vals[$cur] ?? '';
    $nm = $e($name) . '[' . $e($cur) . ']';
    $ph = $cur === $def ? '' : ' placeholder="пусто — на сайте будет русский текст"';
    if ($area) {
        /* Высота по объёму текста: короткая строка не должна сидеть
           в огромном поле, длинная — прокручиваться в крошечном. */
        $len = mb_strlen((string)($vals[$def] ?? $v));
        $r   = $rows ?: max(2, min(10, (int)ceil($len / 110) + 1));
        echo '<textarea name="' . $nm . '" rows="' . $r . '"'
           . ($max ? ' data-max="' . $max . '"' : '') . $ph . '>' . $e($v) . '</textarea>';
    } else {
        echo '<input type="text" name="' . $nm . '" value="' . $e($v) . '"'
           . ($max ? ' data-max="' . $max . '"' : '') . $ph . '>';
    }

    if ($cur !== $def && ($vals[$def] ?? '') !== '') {
        echo '<div class="src"><b>' . $e(strtoupper($def)) . ':</b> ' . $e($vals[$def]) . '</div>';
    }

    foreach (langs() as $l) {
        if ($l === $cur) continue;
        echo '<input type="hidden" name="' . $e($name) . '[' . $e($l) . ']" value="' . $e($vals[$l] ?? '') . '">';
    }
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

/** Сколько заявок ещё не просмотрено. Считаем по файлам, не разбирая их:
    список заявок открывается редко, а меню рисуется на каждой странице. */
function admin_new_leads(): int
{
    $dir = Store::dir() . '/leads';
    if (!is_dir($dir)) return 0;
    /* Меню рисуется на каждой странице панели, поэтому смотрим только
       последние 300 заявок: новые по определению свежие. Без потолка
       тысячи заявок замедлили бы каждую страницу панели. */
    $files = glob($dir . '/*.json') ?: [];
    rsort($files, SORT_STRING);
    $n = 0;
    foreach (array_slice($files, 0, 300) as $p) {
        /* Метка «new» стоит в конце файла, после полей заявки. Длинная
           заявка не помещалась в первые 4 КБ, и метку не находили —
           самые подробные обращения оставались незамеченными. */
        $d = json_decode((string)@file_get_contents($p), true);
        if (is_array($d) && !empty($d['new'])) $n++;
    }
    return $n;
}

/** Языки плашками: RU AZ EN. $fill — язык => доля заполненного, 0..1.
    Заполнено целиком — тёмная плашка, частично — жёлтая, пусто — рамка.
    Подпись в title: цвет сам по себе ничего не сообщает тому, кто его
    не различает. */
function admin_lang_badges(array $fill, ?string $url = null): string
{
    $out = '';
    foreach (langs() as $l) {
        $f = (float)($fill[$l] ?? 0);
        $cls = $f >= 1 ? 'full' : ($f > 0 ? 'part' : 'none');
        $txt = strtoupper($l) . ': ' . ($f >= 1 ? 'переведено' : ($f > 0
             ? 'переведено ' . (int)round($f * 100) . '%' : 'перевода нет'));
        $title = htmlspecialchars($txt . ($url !== null ? ' — открыть' : ''), ENT_QUOTES, 'UTF-8');

        if ($url !== null) {
            /* С адресом плашка становится ссылкой на эту версию страницы. */
            $href = ($l === deflang() ? '' : '/' . $l) . $url;
            $out .= '<a class="lg ' . $cls . '" href="' . htmlspecialchars($href, ENT_QUOTES, 'UTF-8')
                  . '" target="_blank" rel="noopener" title="' . $title . '">' . strtoupper($l) . '</a>';
        } else {
            $out .= '<span class="lg ' . $cls . '" title="' . $title . '">' . strtoupper($l) . '</span>';
        }
    }
    return '<span class="langs">' . $out . '</span>';
}
