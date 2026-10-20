<?php
/* Портфолио: отрасли и проекты внутри них.

   Два вида: список отраслей и правка одной отрасли. Всё портфолио на одной
   странице — это 55 проектов по четыре поля на три языка, около семисот
   полей; такую форму нельзя ни просмотреть, ни безопасно сохранить.

   Признак «архив» не удаляет проект. Домен может не открываться, но работа
   была сделана, и из портфолио она не исчезает — просто вместо ссылки
   появляется пометка. Это решение принято на сайте, панель его повторяет. */

$e      = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$groups = works_canon();
$slug   = post_slug($_GET['g'] ?? '');

/* ------------------------------------------------------------- сохранение */
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    /* Форма собирает файл целиком, поэтому вкладка, открытая час
       назад, вернула бы всё к состоянию часовой давности — и панель
       сказала бы «Сохранено». Метка версии это ловит. */
    if (admin_stale('works.json')) {
        admin_flash('«Портфолио» правили из другого места, пока эта страница была '
            . 'открыта. Чтобы не затереть ту правку, сохранение отменено: '
            . 'обновите страницу и внесите изменения заново.', 'err');
        admin_go(admin_url('portfolio'));
    }

    $what = post_one($_POST['do'] ?? '');

    /* --- новая отрасль --- */
    if ($what === 'add-group') {
        $name = post_langs($_POST['name'] ?? []);
        $k    = post_slug($_POST['slug'] ?? '', '');
        if (($name[deflang()] ?? '') === '' || $k === '') {
            admin_flash('Нужны и название по-русски, и ключ латиницей.', 'err');
        } elseif (array_filter($groups, static fn($g) => $g['slug'] === $k)) {
            admin_flash('Отрасль с ключом «' . $k . '» уже есть.', 'err');
        } else {
            $groups[] = ['slug' => $k, 'name' => $name,
                         'desc' => post_langs($_POST['desc'] ?? [], true), 'projects' => []];
            Store::write('works.json', $groups)
                ? admin_flash('Отрасль добавлена. Теперь можно складывать в неё проекты.')
                : admin_flash('Не удалось сохранить.', 'err');
            admin_go(admin_url('portfolio', ['g' => $k]));
        }
        admin_go(admin_url('portfolio'));
    }

    /* --- удаление отрасли целиком --- */
    if ($what === 'del-group') {
        $k = post_slug($_POST['slug'] ?? '');
        $groups = array_values(array_filter($groups, static fn($g) => $g['slug'] !== $k));
        if (!$groups) {
            admin_flash('Нельзя удалить последнюю отрасль: портфолио останется пустым.', 'err');
        } else {
            Store::write('works.json', $groups)
                ? admin_flash('Отрасль удалена вместе с проектами.')
                : admin_flash('Не удалось сохранить.', 'err');
        }
        admin_go(admin_url('portfolio'));
    }

    /* --- правка одной отрасли --- */
    $k = post_slug($_POST['slug'] ?? '');
    $i = null;
    foreach ($groups as $n => $g) if ($g['slug'] === $k) { $i = $n; break; }

    if ($i === null) {
        admin_flash('Отрасль не найдена.', 'err');
        admin_go(admin_url('portfolio'));
    }

    $groups[$i]['name'] = post_langs($_POST['name'] ?? []);
    $groups[$i]['desc'] = post_langs($_POST['desc'] ?? [], true);

    $del  = (array)($_POST['del'] ?? []);
    $rows = (array)($_POST['w'] ?? []);
    $out  = [];
    $seen = [];
    $bad  = [];
    $at   = [];    // номер строки в форме -> место в итоговом списке

    foreach ($rows as $idx => $row) {
        if (!is_array($row) || !empty($del[$idx])) continue;
        $dom  = post_domain($row['domain'] ?? '');
        $orig = post_domain($row['orig'] ?? '');

        /* Удаляет проект ТОЛЬКО флажок «Удалить». Раньше пустой или
           повторный домен молча выбрасывал запись вместе с описанием на
           трёх языках и путём к снимку, а панель писала «Сохранено».
           Стереть поле случайно в длинной форме легко, а заметить, что
           проектов стало 14 вместо 15, — почти невозможно. */
        if ($dom === '') {
            $bad[] = 'у проекта ' . ($orig !== '' ? $orig : '№' . ((int)$idx + 1))
                   . ' пустой или неверный домен';
            continue;
        }
        if (isset($seen[$dom])) {
            $bad[] = 'домен ' . $dom . ' встречается дважды';
            continue;
        }
        $seen[$dom] = true;
        $at[(int)$idx] = count($out);          // где строка формы оказалась в списке
        $out[] = [
            'domain'   => $dom,
            'desc'     => post_langs($row['desc'] ?? []),
            'image'    => post_image($row['image'] ?? ''),
            'archived' => !empty($row['archived']),
        ];
    }

    /* --- новый проект из нижней строки --- */
    $new = (array)($_POST['new'] ?? []);
    $nd  = post_domain($new['domain'] ?? '');
    if ($nd !== '' && !isset($seen[$nd])) {
        $out[] = [
            'domain'   => $nd,
            'desc'     => post_langs($new['desc'] ?? []),
            'image'    => post_image($new['image'] ?? ''),
            'archived' => !empty($new['archived']),
        ];
    }

    /* --- перестановка: кнопка приходит как mv=up:3 --- */
    $mv = post_one($_POST['mv'] ?? '');
    if (preg_match('~^(up|down):(\d+)$~', $mv, $m)) {
        /* Номер в кнопке — это номер строки в ФОРМЕ, а не в итоговом
           списке. Если в том же сохранении выше удалили проект, список
           сдвинулся, и прежний код переставлял соседа того проекта,
           на чью стрелку нажали. Переводим номер через $at. */
        $pos = $at[(int)$m[2]] ?? null;
        if ($pos !== null) {
            $to = $m[1] === 'up' ? $pos - 1 : $pos + 1;
            if (isset($out[$pos], $out[$to])) {
                [$out[$pos], $out[$to]] = [$out[$to], $out[$pos]];
            }
        }
    }

    if ($bad) {
        /* Ничего не пишем: лучше не сохранить всё, чем сохранить
           с молча пропавшим проектом. */
        admin_flash('НЕ СОХРАНЕНО: ' . implode('; ', $bad) . '. Проект удаляется только '
            . 'флажком «Удалить проект» — исправьте домен или поставьте флажок.', 'err');
        admin_go(admin_url('portfolio', ['g' => $groups[$i]['slug']]));
    }

    $groups[$i]['projects'] = $out;

    if (Store::write('works.json', $groups)) {
        admin_flash('Сохранено. Проектов в отрасли: ' . count($out) . '.');
    } else {
        admin_flash('Не удалось сохранить.', 'err');
    }
    admin_go(admin_url('portfolio', ['g' => $groups[$i]['slug']]));
}

/* ------------------------------------------------------------- отрисовка */
$cur = null;
foreach ($groups as $g) if ($g['slug'] === $slug) { $cur = $g; break; }

admin_head('portfolio');

if ($cur === null):
    /* ---- список отраслей ---- */
    $total = array_sum(array_map(static fn($g) => count($g['projects']), $groups));
?>
  <div class="note">
    На сайте сетка плоская: при заходе видны все <?= $total ?> проектов сразу,
    а отрасли работают кнопками-фильтрами сверху. Здесь они разделены,
    чтобы правка одной отрасли не открывала форму на семьсот полей.
  </div>

  <div class="panel">
    <?php admin_list_head(count($groups), 'Отраслей', 'Добавить отрасль', '#dobavit'); ?>
    <div class="tablewrap">
      <table class="list">
        <tr>
          <th class="num">№</th><th class="pic">Обложка</th><th>Отрасль</th>
          <th>Ключ</th><th>Проектов</th><th>Со снимком</th><th>Перевод</th><th class="right"></th>
        </tr>
        <?php foreach ($groups as $i => $g):
          $n = count($g['projects']);
          $a = count(array_filter($g['projects'], static fn($w) => !empty($w['archived'])));
          $c = count(array_filter($g['projects'], static fn($w) => !empty($w['image'])));
        ?>
        <tr>
          <td class="num"><?= admin_num($i) ?></td>
          <td class="pic"><?= admin_thumb('/images/groups/' . $g['slug'] . '.svg', '') ?></td>
          <td><b><?= $e(tr($g['name'], deflang())) ?></b><br>
              <span class="muted"><?= $e(mb_strimwidth(tr($g['desc'], deflang()), 0, 64, '…', 'UTF-8')) ?></span></td>
          <td class="mono"><?= $e($g['slug']) ?></td>
          <td><b><?= $n ?></b><?= $a ? ' <span class="pill grey">' . $a . ' в архиве</span>' : '' ?></td>
          <td><?= $c ?>&nbsp;из&nbsp;<?= $n ?></td>
          <td class="dotcell"><?= admin_lang_dots($g['name'], 'название отрасли') ?></td>
          <td class="right"><div class="acts">
            <a class="btn sm" href="<?= $e(admin_url('portfolio', ['g' => $g['slug']])) ?>">Изменить</a>
            <a class="btn sm" href="/portfolio/#<?= $e($g['slug']) ?>" target="_blank" rel="noopener">Открыть</a>
          </div></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>

  <div class="panel" id="dobavit">
    <h3>Добавить отрасль</h3>
    <form method="post" action="<?= $e(admin_url('portfolio')) ?>">
      <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <?= admin_ver_field('works.json') ?>
      <input type="hidden" name="do" value="add-group">
      <label>Ключ <span class="hint">латиницей: по нему отрасль находят переводы и фильтр</span></label>
      <input type="text" name="slug" class="mono" placeholder="obrazovanie" required>
      <?php
      $blank = array_fill_keys(langs(), '');
      admin_field_langs('name', $blank, 'Название отрасли');
      admin_field_langs('desc', $blank, 'Короткое описание', ['area' => true, 'rows' => 2]);
      ?>
      <div class="btnrow"><button class="btn" type="submit">Добавить</button></div>
    </form>
  </div>

<?php else:
    /* ---- правка одной отрасли ---- */
    $n = count($cur['projects']);
?>
  <p style="margin:0 0 16px"><a class="btn sm" href="<?= $e(admin_url('portfolio')) ?>">← Все отрасли</a></p>

  <form method="post" action="<?= $e(admin_url('portfolio')) ?>" data-guard="1">
    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <?= admin_ver_field('works.json') ?>
    <input type="hidden" name="slug" value="<?= $e($cur['slug']) ?>">

    <div class="panel">
      <h3><?= $e(tr($cur['name'], deflang())) ?> <span class="pill grey mono"><?= $e($cur['slug']) ?></span></h3>
      <?php
      admin_field_langs('name', $cur['name'], 'Название отрасли');
      admin_field_langs('desc', $cur['desc'], 'Короткое описание', ['area' => true, 'rows' => 2]);
      ?>
    </div>

    <div class="panel">
      <h3>Проекты — <?= $n ?></h3>
      <p class="muted">Домен — это ключ записи: по нему проект находят переводы.
         Сменить домен можно, но перевод описания придётся вписать заново.</p>

      <?php foreach ($cur['projects'] as $idx => $w): ?>
        <div class="item<?= !empty($w['archived']) ? ' dead' : '' ?>">
          <div style="display:flex;gap:12px;align-items:flex-start;flex-wrap:wrap">
            <?php if (!empty($w['image'])): ?>
              <img class="thumb" src="<?= $e($w['image']) ?>" alt="" loading="lazy">
            <?php endif; ?>
            <div style="flex:1;min-width:240px">
              <div class="row">
                <div>
                  <label>Домен</label>
                  <input type="text" name="w[<?= $idx ?>][domain]" value="<?= $e($w['domain']) ?>" class="mono">
                  <input type="hidden" name="w[<?= $idx ?>][orig]" value="<?= $e($w['domain']) ?>">
                </div>
                <div>
                  <label>Снимок <span class="hint">путь внутри сайта, пусто — отраслевая подложка</span></label>
                  <input type="text" name="w[<?= $idx ?>][image]" value="<?= $e($w['image'] ?? '') ?>"
                         class="mono" placeholder="/images/works/<?= $e($w['domain']) ?>.jpg">
                </div>
              </div>
            </div>
            <div style="flex:none;display:flex;flex-direction:column;gap:6px;padding-top:28px">
              <button class="btn ghost sm" type="submit" name="mv" value="up:<?= $idx ?>"
                      title="Выше"<?= $idx === 0 ? ' disabled' : '' ?>>↑</button>
              <button class="btn ghost sm" type="submit" name="mv" value="down:<?= $idx ?>"
                      title="Ниже"<?= $idx === $n - 1 ? ' disabled' : '' ?>>↓</button>
            </div>
          </div>

          <?php admin_field_langs('w[' . $idx . '][desc]', $w['desc'], 'Чем занимается заказчик'); ?>

          <div style="display:flex;gap:22px;flex-wrap:wrap;margin-top:10px">
            <label class="check" style="margin:0">
              <input type="checkbox" name="w[<?= $idx ?>][archived]" value="1"<?= !empty($w['archived']) ? ' checked' : '' ?>>
              Архив — домен не открывается, ссылку не ставим
            </label>
            <label class="check" style="margin:0">
              <input type="checkbox" name="del[<?= $idx ?>]" value="1">
              Удалить проект
            </label>
            <?php if (empty($w['archived'])): ?>
              <a class="muted" href="https://<?= $e($w['domain']) ?>" target="_blank" rel="noopener">проверить сайт ↗</a>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>

      <div class="item" style="background:var(--ok-bg-2);border-color:var(--ok-line)">
        <h4>Добавить проект</h4>
        <div class="row">
          <div>
            <label>Домен</label>
            <input type="text" name="new[domain]" class="mono" placeholder="example.az">
          </div>
          <div>
            <label>Снимок <span class="hint">необязательно</span></label>
            <input type="text" name="new[image]" class="mono" placeholder="/images/works/example.az.jpg">
          </div>
        </div>
        <?php admin_field_langs('new[desc]', array_fill_keys(langs(), ''), 'Чем занимается заказчик'); ?>
        <label class="check">
          <input type="checkbox" name="new[archived]" value="1">
          Сразу в архив — домен уже не открывается
        </label>
      </div>
    </div>

    <div class="btnrow">
      <button class="btn" type="submit">Сохранить отрасль</button>
      <a class="btn ghost" href="<?= $e(admin_url('portfolio')) ?>">Отменить</a>
      <a class="btn ghost" href="/portfolio/" target="_blank" rel="noopener">Открыть портфолио ↗</a>
    </div>
  </form>

  <form method="post" action="<?= $e(admin_url('portfolio')) ?>" style="margin-top:26px"
        data-confirm="Удалить отрасль «<?= $e(tr($cur['name'], deflang())) ?>» вместе с <?= $n ?> проектами? Отменить это будет нечем.">
    <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <?= admin_ver_field('works.json') ?>
    <input type="hidden" name="do" value="del-group">
    <input type="hidden" name="slug" value="<?= $e($cur['slug']) ?>">
    <button class="btn red sm" type="submit">Удалить отрасль вместе с проектами</button>
  </form>
<?php endif; ?>

<?php admin_foot(); ?>
