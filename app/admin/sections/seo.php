<?php
/* Заголовки и описания страниц для поиска.

   Это то, что человек видит в выдаче Google раньше самой страницы, поэтому
   поля показываются сразу на трёх языках: заголовок на русском и его перевод
   должны решать одну задачу, а не быть дословным переводом друг друга.

   Счётчик знаков рядом с полем не случайный. Google обрезает заголовок
   примерно на 580 пикселях — это около 60 знаков, — а описание около 158.
   Длиннее не ошибка, но хвост в выдаче не покажут, поэтому главное
   должно стоять в начале. */

$e    = static fn($s) => htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$base = require __DIR__ . '/../../data/seo.php';
$seo  = seo_canon();

/* Понятные названия и настоящие адреса страниц. Ключи — те же, что
   в data/seo.php и в $page файлов страниц: «price», «about», «contacts»,
   у направлений — плоский адрес («veb-sayty»). Раньше таблица ждала
   «tseny», «o-studii», «uslugi/veb-sayty», и семь страниц из одиннадцати
   показывались голым ключом с несуществующим адресом вроде /price/. */
function seo_page_info(string $page): array
{
    static $map = null;
    if ($map === null) {
        $map = [
            'home'      => ['Главная',          '/'],
            'uslugi'    => ['Услуги — список',  '/uslugi/'],
            'portfolio' => ['Портфолио',        '/portfolio/'],
            'price'     => ['Цены',             '/tseny/'],
            'about'     => ['О студии',         '/o-studii/'],
            'contacts'  => ['Контакты',         '/kontakty/'],
            'blog'      => ['Блог — список',    '/blog/'],
        ];
        foreach (catalog_canon() as $slug => $c) {
            $map[$slug] = ['Услуги → ' . tr($c['title'], deflang()), '/uslugi/' . $slug . '/'];
        }
    }
    return $map[$page] ?? [$page, ''];
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    /* Форма собирает файл целиком, поэтому вкладка, открытая час
       назад, вернула бы всё к состоянию часовой давности — и панель
       сказала бы «Сохранено». Метка версии это ловит. */
    if (admin_stale('seo.json')) {
        admin_flash('«Заголовки для поиска» правили из другого места, пока эта страница была '
            . 'открыта. Чтобы не затереть ту правку, сохранение отменено: '
            . 'обновите страницу и внесите изменения заново.', 'err');
        admin_go(admin_url('seo'));
    }

    $in = (array)($_POST['seo'] ?? []);
    $n  = 0;

    /* Читаем и пишем под блокировкой: тот же файл правит раздел «Страницы».
       Прежние правки читаются внутри неё — чтобы языки, которых нет в
       форме, остались как были, а не такими, какими были при загрузке. */
    $same = false;
    $ok = Store::update('seo.json', static function (array $store) use ($in, $seo, $base, &$n, &$same) {
        $out = [];
        /* Страницы и из файлов разработчика, и из хранилища: запись,
           появившаяся после загрузки этой страницы, не должна пропасть. */
        foreach (array_keys($seo + $store) as $page) {
            $got = is_array($in[$page] ?? null) ? $in[$page] : [];
            foreach (langs() as $l) {
                foreach (['title', 'description'] as $f) {
                    /* Языка нет в форме — оставляем как было, а не стираем. */
                    if (!isset($got[$f]) || !is_array($got[$f]) || !array_key_exists($l, $got[$f])) {
                        if (isset($store[$page][$l][$f])) $out[$page][$l][$f] = $store[$page][$l][$f];
                        continue;
                    }
                    $v = post_one($got[$f][$l]);
                    /* Пишем только то, что отличается от файла разработчика.
                       Иначе хранилище замораживает нынешние тексты, и правка
                       в репозитории до сайта уже не доходит. */
                    $orig = $base[$page][$l][$f] ?? '';
                    if ($v !== '' && $v !== $orig) $out[$page][$l][$f] = $v;
                }
            }
        }
        foreach ($out as $p) foreach ($p as $l) $n += count($l);
        /* Без изменений файл не переписываем — см. texts.php. */
        if ($out == $store) { $same = true; return null; }
        return $out;
    }) || $same;

    if ($ok) {
        admin_flash($n
            ? 'Сохранено. Своих значений: ' . $n . '. Остальное берётся из файлов разработчика.'
            : 'Сохранено. Своих значений нет — всё совпадает с файлами разработчика.');
    } else {
        admin_flash('Не удалось сохранить.', 'err');
    }
    admin_go(admin_url('seo'));
}

$LIMIT = ['title' => 60, 'description' => 158];
$store = Store::read('seo.json') ?? [];

admin_head('seo');
?>

<div class="note">
  Показаны все три языка сразу: заголовок и его перевод должны решать одну
  задачу, а не быть дословным переводом. Пусто — страница возьмёт значение
  из файлов сайта, а если там его нет — русский вариант.
  Числа под полями — сколько знаков поместится в выдаче: длиннее не ошибка,
  но хвост не покажут, поэтому главное ставьте в начало.
</div>

<form method="post" action="<?= $e(admin_url('seo')) ?>" data-guard="1">
  <input type="hidden" name="_csrf" value="<?= $e(csrf_token()) ?>">
    <?= admin_ver_field('seo.json') ?>

  <?php foreach ($seo as $page => $byLang):
      $own = !empty($store[$page]);
  ?>
    <div class="panel">
      <?php [$pTitle, $pUrl] = seo_page_info($page); ?>
      <h3><?= $e($pTitle) ?>
        <?php if ($own): ?><span class="pill">правлено в панели</span><?php endif; ?>
      </h3>
      <?php if ($pUrl !== ''): ?><p class="muted mono"><?= $e($pUrl) ?></p><?php endif; ?>

      <?php foreach (['title' => 'Заголовок в выдаче', 'description' => 'Описание под заголовком'] as $f => $label): ?>
        <label><?= $e($label) ?>
          <span class="hint">до <?= $LIMIT[$f] ?> знаков</span>
        </label>
        <div class="row3">
          <?php foreach (langs() as $l): ?>
            <div>
              <div class="muted" style="margin-bottom:4px"><b><?= $e(strtoupper($l)) ?></b></div>
              <?php if ($f === 'title'): ?>
                <input type="text" data-max="<?= $LIMIT[$f] ?>"
                       name="seo[<?= $e($page) ?>][<?= $e($f) ?>][<?= $e($l) ?>]"
                       value="<?= $e($byLang[$l][$f] ?? '') ?>"
                       placeholder="<?= $l === deflang() ? '' : 'пусто — возьмётся русский' ?>">
              <?php else: ?>
                <textarea rows="3" data-max="<?= $LIMIT[$f] ?>"
                          name="seo[<?= $e($page) ?>][<?= $e($f) ?>][<?= $e($l) ?>]"
                          placeholder="<?= $l === deflang() ? '' : 'пусто — возьмётся русский' ?>"><?= $e($byLang[$l][$f] ?? '') ?></textarea>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>

  <div class="btnrow">
    <button class="btn" type="submit">Сохранить</button>
    <a class="btn ghost" href="<?= $e(admin_url('dashboard')) ?>">Отменить</a>
  </div>
</form>

<?php admin_foot(); ?>
