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

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    /* Форма собирает файл целиком, поэтому вкладка, открытая час
       назад, вернула бы всё к состоянию часовой давности — и панель
       сказала бы «Сохранено». Метка версии это ловит. */
    if (admin_stale('articles.json')) {
        admin_flash('«Статьи» правили из другого места, пока эта страница была '
            . 'открыта. Чтобы не затереть ту правку, сохранение отменено: '
            . 'обновите страницу и внесите изменения заново.', 'err');
        admin_go(admin_url('blog'));
    }

    $slug = post_slug($_POST['slug'] ?? '');
    $i = null;
    foreach ($arts as $n => $a) if ($a['slug'] === $slug) { $i = $n; break; }
    if ($i === null) {
        admin_flash('Статья не найдена.', 'err');
        admin_go(admin_url('blog'));
    }

    /* Язык текста статьи берём из скрытого поля формы, а не из сессии:
       между открытием формы и сохранением язык могли переключить в другой
       вкладке, и тогда русский текст лёг бы в английскую версию. */
    $l = post_one($_POST['lang'] ?? '');
    if (!in_array($l, langs(), true)) $l = deflang();

    $arts[$i]['rubric'][$l]   = post_one($_POST['rubric'] ?? '');
    $arts[$i]['title'][$l]    = post_one($_POST['title'] ?? '');
    $arts[$i]['desc'][$l]     = post_one($_POST['desc'] ?? '', true);
    $arts[$i]['lead'][$l]     = post_one($_POST['lead'] ?? '', true);
    $arts[$i]['end'][$l]      = post_one($_POST['end'] ?? '', true);
    $arts[$i]['seoTitle'][$l] = post_one($_POST['seoTitle'] ?? '');
    $arts[$i]['seoDesc'][$l]  = post_one($_POST['seoDesc'] ?? '', true);

    /* Дата и время чтения общие для всех языков: статья одна. */
    $d = post_one($_POST['date'] ?? '');
    if (preg_match('~^\d{2}\.\d{2}\.\d{4}$~', $d)) $arts[$i]['date'] = $d;
    $r = (int)($_POST['read'] ?? 0);
    if ($r >= 1 && $r <= 90) $arts[$i]['read'] = $r;

    $del  = (array)($_POST['del'] ?? []);
    $rows = (array)($_POST['s'] ?? []);
    $body = [];
    foreach ($rows as $idx => $row) {
        if (!is_array($row) || !empty($del[$idx])) continue;
        $h = post_one($row['h'] ?? '');
        $t = post_one($row['t'] ?? '', true);
        if ($h === '' && $t === '') continue;
        $body[] = [$h, $t];
    }
    $new = (array)($_POST['new'] ?? []);
    $nh = post_one($new['h'] ?? '');
    $nt = post_one($new['t'] ?? '', true);
    if ($nh !== '' || $nt !== '') $body[] = [$nh, $nt];

    $arts[$i]['body'][$l] = $body;

    Store::write('articles.json', $arts)
        ? admin_flash('Сохранено: ' . strtoupper($l) . ', разделов в тексте ' . count($body) . '.')
        : admin_flash('Не удалось сохранить.', 'err');
    admin_go(admin_url('blog', ['a' => $slug]));
}

$art = null;
foreach ($arts as $a) if ($a['slug'] === $cur) { $art = $a; break; }

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
    $body = $art['body'][$lang] ?? [];
    $empty = !$body && $lang !== deflang();
?>
  <p style="margin:0 0 16px"><a class="btn sm" href="<?= $e(admin_url('blog')) ?>">← Все статьи</a></p>

  <div class="note">
    Сейчас правится версия <b><?= $e(strtoupper($lang)) ?></b>.
    Язык переключается в верхней строке.
    <?php if ($empty): ?>
      На этом языке статьи ещё нет — поля пустые. Заполните и сохраните,
      и она появится в списке блога на /<?= $e($lang) ?>/.
    <?php endif; ?>
    Абзацы внутри раздела разделяйте пустой строкой. Разметку писать не нужно:
    всё выводится как текст.
  </div>

  <form method="post" action="<?= $e(admin_url('blog')) ?>" data-guard="1">
    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <?= admin_ver_field('articles.json') ?>
    <input type="hidden" name="slug" value="<?= $e($art['slug']) ?>">
    <input type="hidden" name="lang" value="<?= $e($lang) ?>">

    <div class="panel">
      <h3>Карточка статьи</h3>
      <div class="row3">
        <div>
          <label>Рубрика</label>
          <input type="text" name="rubric" value="<?= $e($art['rubric'][$lang] ?? '') ?>">
        </div>
        <div>
          <label>Дата <span class="hint">дд.мм.гггг, общая для всех языков</span></label>
          <input type="text" name="date" value="<?= $e($art['date']) ?>" class="mono">
        </div>
        <div>
          <label>Время чтения, мин <span class="hint">общее для всех языков</span></label>
          <input type="number" name="read" min="1" max="90" value="<?= (int)$art['read'] ?>">
        </div>
      </div>

      <label>Заголовок статьи</label>
      <input type="text" name="title" value="<?= $e($art['title'][$lang] ?? '') ?>">

      <label>Короткое описание <span class="hint">видно в списке блога</span></label>
      <textarea rows="2" name="desc"><?= $e($art['desc'][$lang] ?? '') ?></textarea>

      <label>Вступление <span class="hint">первый абзац на странице статьи</span></label>
      <textarea rows="4" name="lead"><?= $e($art['lead'][$lang] ?? '') ?></textarea>
    </div>

    <div class="panel">
      <h3>Текст — разделов <?= count($body) ?></h3>
      <p class="muted">Заголовок раздела становится подзаголовком на странице.
         Абзацы внутри текста разделяйте пустой строкой.</p>

      <?php foreach ($body as $idx => $sec): ?>
        <div class="item">
          <label>Заголовок раздела</label>
          <input type="text" name="s[<?= $idx ?>][h]" value="<?= $e($sec[0] ?? '') ?>">
          <label>Текст</label>
          <textarea class="tall" name="s[<?= $idx ?>][t]"><?= $e($sec[1] ?? '') ?></textarea>
          <label class="check">
            <input type="checkbox" name="del[<?= $idx ?>]" value="1">
            Удалить раздел
          </label>
        </div>
      <?php endforeach; ?>

      <div class="item" style="background:var(--ok-bg-2);border-color:var(--ok-line)">
        <h4>Добавить раздел</h4>
        <label>Заголовок раздела</label>
        <input type="text" name="new[h]">
        <label>Текст</label>
        <textarea rows="6" name="new[t]"></textarea>
      </div>
    </div>

    <div class="panel">
      <h3>Заключение</h3>
      <p class="muted">Последний блок статьи, без заголовка.</p>
      <textarea rows="5" name="end"><?= $e($art['end'][$lang] ?? '') ?></textarea>
    </div>

    <div class="panel">
      <h3>Заголовок в выдаче Google</h3>
      <label>Заголовок <span class="hint">до 60 знаков; пусто — возьмётся заголовок статьи</span></label>
      <input type="text" name="seoTitle" data-max="60" value="<?= $e($art['seoTitle'][$lang] ?? '') ?>">
      <label>Описание <span class="hint">до 158 знаков; пусто — возьмётся короткое описание</span></label>
      <textarea rows="3" name="seoDesc" data-max="158"><?= $e($art['seoDesc'][$lang] ?? '') ?></textarea>
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
