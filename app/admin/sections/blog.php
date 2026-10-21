<?php
/* Блог: список статей и правка одной.

   Текст статьи разбит на разделы: заголовок и текст под ним. Это не
   прихоть редактора — из этих заголовков собирается оглавление, и они же
   становятся h2 на странице. Абзацы внутри раздела разделяются пустой
   строкой, как в обычном письме; размечать текст вручную не нужно и нельзя:
   всё, что вы напишете, выводится как текст, а не как разметка.

   Адрес статьи (slug) участвует в ссылке и в файле страницы, поэтому
   новая статья отсюда не создаётся: для неё нужен файл в public/blog/.
   Панель правит содержимое существующих статей. */

$e    = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$arts = articles_canon();
$cur  = post_slug($_GET['a'] ?? '');
$lang = admin_lang();

/** Метка версии одной статьи на одном языке, вместе с общими датой
    и временем чтения.

    Не метка файла: в articles.json лежат все статьи на всех языках, и
    любое сохранение блога меняло бы её для всех открытых вкладок —
    перевод одной статьи отменялся бы из-за правки другой. Форма меняет
    только свою статью на своём языке, это и сверяем. */
function blog_ver(array $a, string $l): string
{
    $v = [$a['date'] ?? '', (int)($a['read'] ?? 0), $a['body'][$l] ?? []];
    foreach (['rubric', 'title', 'desc', 'lead', 'end', 'seoTitle', 'seoDesc'] as $k) $v[] = $a[$k][$l] ?? '';
    return substr(sha1((string)json_encode($v, JSON_UNESCAPED_UNICODE)), 0, 16);
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $slug = post_slug($_POST['slug'] ?? '');
    $i = null;
    foreach ($arts as $n => $a) if ($a['slug'] === $slug) { $i = $n; break; }
    if ($i === null) {
        admin_flash('Статья не найдена.', 'err');
        admin_go(admin_url('blog'));
    }

    /* Язык текста статьи берём из скрытого поля формы, а не из сессии:
       между открытием формы и сохранением язык могли переключить в другой
       вкладке, и тогда русский текст лёг бы в английскую версию. Без языка
       не сохраняем: русский «по умолчанию» лёг бы переводом поверх оригинала. */
    $l = post_one($_POST['lang'] ?? '');
    if (!in_array($l, langs(), true)) {
        admin_flash('НЕ СОХРАНЕНО: форма пришла без языка правки — похоже, страница '
            . 'устарела. Обновите её и внесите изменения заново.', 'err');
        admin_go(admin_url('blog', ['a' => $slug]));
    }
    /* Назад — к той же статье и той же версии, даже если язык вверху
       успели переключить в другой вкладке: черновик ждёт именно там. */
    $back = admin_url('blog', ['a' => $slug] + ($l !== $lang ? ['lang' => $l] : []));

    /* Поля текста на языке правки; true — многострочное. */
    $fields = ['rubric' => false, 'title' => false, 'desc' => true, 'lead' => true,
               'end' => true, 'seoTitle' => false, 'seoDesc' => true];

    /* Поле, которого НЕТ в запросе, — это не «стёрли», а «не дошло»:
       сервер обрезал форму или запрос собран не браузером. Такое поле
       остаётся прежним. Раньше оно становилось пустым, и запрос с одними
       slug и lang стирал версию статьи целиком. */
    if (!array_intersect(array_merge(array_keys($fields), ['date', 'read', 's', 'new']), array_keys($_POST))) {
        admin_flash('Форма пришла без полей — ничего не сохранено. Обновите страницу и повторите.', 'err');
        admin_go($back);
    }

    /* Текст статьи заменяется, только если пришёл целиком. Форма в самом
       начале объявляет, сколько полей текста отправляет: обрезая форму,
       сервер отбрасывает последние поля, и без этой сверки недошедшие
       разделы молча исчезли бы из статьи. */
    $want = (int)($_POST['_fields'] ?? 0);
    $sIn  = is_array($_POST['s'] ?? null) ? $_POST['s'] : [];
    $nIn  = is_array($_POST['new'] ?? null) ? $_POST['new'] : [];
    $full = $want > 0 && admin_count_fields($sIn) + count($nIn) >= $want;
    $del  = is_array($_POST['del'] ?? null) ? $_POST['del'] : [];
    $rows = [];                                  // как вписано: заголовок, текст, «удалить»
    foreach ($sIn as $idx => $row) {
        if (!is_array($row)) continue;
        $rows[] = [post_one($row['h'] ?? ''), post_one($row['t'] ?? '', true), !empty($del[$idx])];
    }
    $newS = [post_one($nIn['h'] ?? ''), post_one($nIn['t'] ?? '', true)];

    /* Отказ не должен стирать вписанное: форма откроется снова с этим
       текстом. Текст разделов кладём, только если он дошёл целиком, —
       иначе повторное сохранение черновика потеряло бы недошедшее. */
    $keep = static function () use ($slug, $l, $fields, $full, $rows, $newS): void {
        $f = [];
        foreach (array_merge(array_keys($fields), ['date', 'read']) as $k) {
            if (isset($_POST[$k]) && is_string($_POST[$k])) $f[$k] = post_one($_POST[$k], $fields[$k] ?? false);
        }
        admin_draft_keep('blog:' . $slug . ':' . $l,
            ['f' => $f, 'body' => $full ? ['rows' => $rows, 'new' => $newS] : null]);
    };

    $err  = null;
    $bad  = [];
    $lost = 0;
    $secs = 0;
    $ok = Store::update('articles.json', function () use ($slug, $l, $fields, $full, $want, $rows, $newS, $sIn, $nIn, &$err, &$bad, &$lost, &$secs) {
        /* Читаем заново под замком: два сохранения разных статей в одну
           секунду иначе стёрли бы одно другим. Пустое хранилище —
           articles_canon() отдаёт данные репозитория. */
        $arts = articles_canon();
        $i = null;
        foreach ($arts as $n => $x) if ($x['slug'] === $slug) { $i = $n; break; }
        if ($i === null) { $err = 'Статья не найдена.'; return null; }
        $a = $arts[$i];

        $was = (string)($_POST['_ver'] ?? '');
        if ($was !== '' && $was !== blog_ver($a, $l)) {
            $err = 'Эту статью (версию ' . strtoupper($l) . ', дату или время чтения) правили из другого '
                 . 'места, пока страница была открыта. Чтобы не затереть ту правку, сохранение отменено, '
                 . 'а вписанное вами возвращено в форму: сверьте его с тем, что сейчас на сайте '
                 . '(«Открыть статью»), и сохраните снова.';
            return null;
        }

        foreach ($fields as $k => $multi) {
            if (!array_key_exists($k, $_POST)) { $lost++; continue; }
            $a[$k][$l] = post_one($_POST[$k], $multi);
        }

        /* Русский заголовок — основа: без него у статьи пустые h1 и <title>,
           а в списке блога ссылка без текста. Переводам пустота простительна —
           на их месте покажется русский. */
        if ($l === deflang() && ($a['title'][$l] ?? '') === '') {
            $err = 'У статьи должен быть русский заголовок — он стоит в списке блога, '
                 . 'в заголовке страницы и во вкладке браузера. Вписанное вами возвращено в форму.';
            return null;
        }

        /* Дата и время чтения общие для всех языков: статья одна. Неверное
           значение не принимаем, но и не молчим: раньше оно отбрасывалось,
           а панель говорила «Сохранено». */
        if (array_key_exists('date', $_POST)) {
            $d = post_one($_POST['date']);
            if (preg_match('~^(\d{2})\.(\d{2})\.(\d{4})$~', $d, $m) && checkdate((int)$m[2], (int)$m[1], (int)$m[3])) {
                $a['date'] = $d;
            } elseif ($d !== (string)$a['date']) {
                $bad[] = ($d === '' ? 'дата пустая' : 'дата «' . $d . '»')
                       . ' — нужна настоящая дата вида дд.мм.гггг, оставлена прежняя: ' . $a['date'];
            }
        } else {
            $lost++;
        }
        if (array_key_exists('read', $_POST)) {
            $r = post_one($_POST['read']);
            if (preg_match('~^\d{1,2}$~', $r) && (int)$r >= 1 && (int)$r <= 90) {
                $a['read'] = (int)$r;
            } elseif ($r !== (string)(int)$a['read']) {
                $bad[] = ($r === '' ? 'время чтения пустое' : 'время чтения «' . $r . '»')
                       . ' — нужно целое число минут от 1 до 90, оставлено прежнее: ' . (int)$a['read'];
            }
        } else {
            $lost++;
        }

        if ($full) {
            $body = [];
            foreach ($rows as [$h, $t, $drop]) {
                if ($drop || ($h === '' && $t === '')) continue;
                $body[] = [$h, $t];
            }
            if ($newS[0] !== '' || $newS[1] !== '') $body[] = $newS;
            $a['body'][$l] = $body;
        } elseif ($sIn || $nIn || $want > 0) {
            $bad[] = 'текст статьи пришёл не целиком'
                   . ($want > 0 ? ' (полей ' . (admin_count_fields($sIn) + count($nIn)) . ' из ' . $want . ')' : '')
                   . ' — оставлен прежним';
        } else {
            $lost++;
        }

        $secs = count($a['body'][$l] ?? []);
        $arts[$i] = $a;
        return $arts;
    });

    if ($err !== null) {
        $keep();
        admin_flash('НЕ СОХРАНЕНО: ' . $err, 'err');
        admin_go($back);
    }
    if (!$ok) {
        $keep();
        admin_flash('НЕ СОХРАНЕНО: записать не удалось. Проверьте место на диске и права на папку '
            . Store::dir() . '. Вписанное вами возвращено в форму.', 'err');
        admin_go($back);
    }

    $msg = 'Сохранено: ' . strtoupper($l) . ', разделов в тексте ' . $secs . '.';
    if ($lost) $bad[] = 'не дошло полей — ' . $lost . ', у них оставлены прежние значения';
    $bad ? admin_flash($msg . ' Не приняты: ' . implode('; ', $bad) . '.', 'warn') : admin_flash($msg);
    admin_go($back);
}

$art = null;
foreach ($arts as $a) if ($a['slug'] === $cur) { $art = $a; break; }

/* Текст неудавшегося сохранения этой статьи на этом языке — вернуть в форму. */
$draft = $art !== null ? admin_draft_take('blog:' . $art['slug'] . ':' . $lang) : null;

admin_head('blog');

if ($art === null):
?>
  <div class="note">
    Сейчас статьи существуют только по-русски. На страницах /az/ и /en/
    список показывает их как есть — это честнее пустого блога, но перевод
    стоит дописать. Выберите язык в верхней строке и заполните поля:
    у статьи появится версия на этом языке.
  </div>

  <div class="panel">
    <?php admin_list_head(count($arts), 'Статей'); ?>
    <div class="tablewrap">
      <table class="list">
        <tr>
          <th class="num">№</th><th>Статья</th><th>Адрес</th>
          <th>Рубрика</th><th>Дата</th><th>Чтение</th><th>Текст есть на</th><th class="right"></th>
        </tr>
        <?php foreach ($arts as $i => $a): ?>
        <tr>
          <td class="num"><?= admin_num($i) ?></td>
          <td><b><?= $e(tr($a['title'], deflang())) ?></b><br>
              <span class="muted"><?= $e(mb_strimwidth(tr($a['desc'], deflang()), 0, 64, '…', 'UTF-8')) ?></span></td>
          <td><span class="path">/blog/<?= $e($a['slug']) ?>/</span></td>
          <td><?= $e(tr($a['rubric'], deflang())) ?></td>
          <td><?= $e($a['date']) ?></td>
          <td><?= (int)$a['read'] ?>&nbsp;мин</td>
          <td class="dotcell"><?= admin_lang_dots($a['body'], 'текст статьи') ?></td>
          <td class="right"><div class="acts">
            <a class="btn sm" href="<?= $e(admin_url('blog', ['a' => $a['slug']])) ?>">Изменить</a>
            <a class="btn sm" href="/blog/<?= $e($a['slug']) ?>/" target="_blank" rel="noopener">Открыть</a>
          </div></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>

  <div class="panel">
    <h3>Новая статья</h3>
    <p class="muted">Адрес статьи участвует в ссылке и в файле страницы,
       поэтому новая статья заводится вместе со своим файлом в public/blog/.
       Напишите мне — заведу, и дальше она правится отсюда, как остальные.</p>
  </div>

<?php else:
    $stored = $art['body'][$lang] ?? [];
    $empty  = !$stored && $lang !== deflang();

    /* Поля из черновика, если он есть; чего в нём нет — из хранилища. */
    $df  = (array)($draft['f'] ?? []);
    $val = static fn(string $k): string => (string)(array_key_exists($k, $df) ? $df[$k] : ($art[$k][$lang] ?? ''));
    $db  = is_array($draft['body'] ?? null) ? $draft['body'] : null;
    $rows = $db !== null ? (array)$db['rows']
        : array_map(static fn($sec) => [$sec[0] ?? '', $sec[1] ?? '', false], $stored);
    $newS = $db !== null ? (array)$db['new'] : ['', ''];

    /* Разделы удалили, а карточка осталась — так снимают текст перевода.
       Сказать над заполненными полями «поля пустые» было бы неправдой. */
    $card = false;
    foreach (['rubric', 'title', 'desc', 'lead', 'end', 'seoTitle', 'seoDesc'] as $f) {
        if (($art[$f][$lang] ?? '') !== '') $card = true;
    }
?>
  <p style="margin:0 0 16px"><a class="btn sm" href="<?= $e(admin_url('blog')) ?>">← Все статьи</a></p>

  <div class="note">
    Сейчас правится версия <b><?= $e(strtoupper($lang)) ?></b>.
    Язык переключается в верхней строке.
    <?php if ($empty && !$card): ?>
      На этом языке статьи ещё нет — поля пустые. Заполните и сохраните,
      и она появится в списке блога на /<?= $e($lang) ?>/.
    <?php elseif ($empty): ?>
      У этой версии нет текста статьи: на сайте под этим заголовком идёт
      русский текст, и в поиск страница не попадает. Допишите разделы —
      или очистите и карточку, чтобы снять перевод совсем.
    <?php endif; ?>
    Абзацы внутри раздела разделяйте пустой строкой. Разметку писать не нужно:
    всё выводится как текст.
    <?php if ($draft !== null): ?>
      <br><b>В полях — то, что вы отправили, и это ещё НЕ сохранено.</b>
      Сохраните снова или откройте статью заново, чтобы увидеть сохранённую версию.
    <?php endif; ?>
  </div>

  <form method="post" action="<?= $e(admin_url('blog')) ?>" data-guard="1">
    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <?php /* Сколько полей текста статьи уходит с формой: s[…][h], s[…][t] и два
             поля нового раздела. Стоит в начале — см. сверку при сохранении. */ ?>
    <input type="hidden" name="_fields" value="<?= count($rows) * 2 + 2 ?>">
    <input type="hidden" name="_ver" value="<?= $e(blog_ver($art, $lang)) ?>">
    <input type="hidden" name="slug" value="<?= $e($art['slug']) ?>">
    <input type="hidden" name="lang" value="<?= $e($lang) ?>">

    <div class="panel">
      <h3>Карточка статьи</h3>
      <div class="row3">
        <div>
          <label>Рубрика</label>
          <input type="text" name="rubric" value="<?= $e($val('rubric')) ?>">
        </div>
        <div>
          <label>Дата <span class="hint">дд.мм.гггг, общая для всех языков</span></label>
          <input type="text" name="date" value="<?= $e($df['date'] ?? $art['date']) ?>" class="mono"
                 pattern="\d{2}\.\d{2}\.\d{4}" title="Дата в виде дд.мм.гггг">
        </div>
        <div>
          <label>Время чтения, мин <span class="hint">общее для всех языков</span></label>
          <input type="number" name="read" min="1" max="90" value="<?= $e($df['read'] ?? (int)$art['read']) ?>">
        </div>
      </div>

      <label>Заголовок статьи</label>
      <input type="text" name="title" value="<?= $e($val('title')) ?>"<?= $lang === deflang() ? ' required' : '' ?>>

      <label>Короткое описание <span class="hint">видно в списке блога</span></label>
      <textarea rows="2" name="desc"><?= $e($val('desc')) ?></textarea>

      <label>Вступление <span class="hint">первый абзац на странице статьи</span></label>
      <textarea rows="4" name="lead"><?= $e($val('lead')) ?></textarea>
    </div>

    <div class="panel">
      <h3>Текст — разделов <?= count($rows) ?></h3>
      <p class="muted">Заголовок раздела становится подзаголовком на странице.
         Абзацы внутри текста разделяйте пустой строкой.</p>

      <?php foreach (array_values($rows) as $idx => $sec): ?>
        <div class="item">
          <label>Заголовок раздела</label>
          <input type="text" name="s[<?= $idx ?>][h]" value="<?= $e($sec[0] ?? '') ?>">
          <label>Текст</label>
          <textarea class="tall" name="s[<?= $idx ?>][t]"><?= $e($sec[1] ?? '') ?></textarea>
          <label class="check">
            <input type="checkbox" name="del[<?= $idx ?>]" value="1"<?= !empty($sec[2]) ? ' checked' : '' ?>>
            Удалить раздел
          </label>
        </div>
      <?php endforeach; ?>

      <div class="item" style="background:var(--ok-bg-2);border-color:var(--ok-line)">
        <h4>Добавить раздел</h4>
        <label>Заголовок раздела</label>
        <input type="text" name="new[h]" value="<?= $e($newS[0] ?? '') ?>">
        <label>Текст</label>
        <textarea rows="6" name="new[t]"><?= $e($newS[1] ?? '') ?></textarea>
      </div>
    </div>

    <div class="panel">
      <h3>Заключение</h3>
      <p class="muted">Последний блок статьи, без заголовка.</p>
      <textarea rows="5" name="end"><?= $e($val('end')) ?></textarea>
    </div>

    <div class="panel">
      <h3>Заголовок в выдаче Google</h3>
      <label>Заголовок <span class="hint">до 60 знаков; пусто — возьмётся заголовок статьи</span></label>
      <input type="text" name="seoTitle" data-max="60" value="<?= $e($val('seoTitle')) ?>">
      <label>Описание <span class="hint">до 158 знаков; пусто — возьмётся короткое описание</span></label>
      <textarea rows="3" name="seoDesc" data-max="158"><?= $e($val('seoDesc')) ?></textarea>
    </div>

    <div class="btnrow">
      <button class="btn" type="submit">Сохранить версию <?= $e(strtoupper($lang)) ?></button>
      <a class="btn ghost" href="<?= $e(admin_url('blog')) ?>">Отменить</a>
      <a class="btn ghost" href="<?= $e(($lang === deflang() ? '' : '/' . $lang) . '/blog/' . $art['slug'] . '/') ?>"
         target="_blank" rel="noopener">Открыть статью ↗</a>
    </div>
  </form>
<?php endif; ?>

<?php admin_foot(); ?>
