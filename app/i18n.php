<?php
/* Языки сайта.

   Русский живёт в корне и без префикса, остальные — на /az/ и /en/.
   Один комплект файлов страниц на все языки: префикс снимается на уровне
   сервера (public/.htaccess, а для локального сервера — router.php),
   сюда он приходит в переменной окружения SITE_LANG.

   Главное правило словаря: если перевода нет, отдаём русский оригинал.
   Непереведённая строка показывает русский текст, а не пустоту и не ключ, —
   значит, переводы можно добавлять по одному, и сайт ни в какой момент
   не оказывается сломанным.
*/

require_once __DIR__ . '/store.php';

final class I18n
{
    public static string $lang = 'ru';
    public static array  $cfg  = [];
    private static array $dict = [];
    private static array $base = [];
    private static array $other = [];

    public static function boot(array $cfg): void
    {
        self::$cfg = $cfg;
        Store::boot((string)($cfg['data_dir'] ?? ''));
        self::$lang = self::detect($cfg);
        self::$base = self::load($cfg['default_lang']);
        self::$dict = self::$lang === $cfg['default_lang'] ? self::$base : self::load(self::$lang);
    }

    private static function detect(array $cfg): string
    {
        /* Apache кладёт метку в SITE_LANG, после внутреннего редиректа —
           в REDIRECT_SITE_LANG. Локальный сервер передаёт её же через getenv. */
        $l = $_SERVER['SITE_LANG'] ?? $_SERVER['REDIRECT_SITE_LANG'] ?? getenv('SITE_LANG') ?: '';
        return in_array($l, $cfg['languages'], true) ? $l : $cfg['default_lang'];
    }

    private static function load(string $lang): array
    {
        $p = __DIR__ . '/lang/' . $lang . '.php';
        $d = is_file($p) ? (array) require $p : [];

        /* Поверх файла — правки из панели. Накладка, а не замена: панель
           правит отдельные строки, и новые ключи, добавленные разработчиком
           в словарь, должны появляться на сайте без пересохранения из панели. */
        $ov = Store::read('texts.json');
        if ($ov) {
            foreach ($ov as $k => $byLang) {
                if (!is_array($byLang) || !array_key_exists($lang, $byLang)
                    || !is_string($byLang[$lang])) {
                    continue;
                }
                if ($byLang[$lang] !== '') {
                    $d[$k] = $byLang[$lang];
                    continue;
                }
                /* Пустое значение — это намерение, а не отсутствие правки.
                   Раньше оно игнорировалось: редактор стирал строку, панель
                   показывала пустое поле, а сайт вечно показывал прежний
                   текст из репозитория. Теперь:
                     основной язык — строку убрали, показываем пустоту;
                     перевод — его убрали, показываем русский оригинал,
                     как у любой непереведённой строки. */
                if ($lang === (self::$cfg['default_lang'] ?? 'ru')) {
                    $d[$k] = '';
                } else {
                    unset($d[$k]);
                }
            }
        }
        return $d;
    }

    /** Строка по ключу без экранирования. Нужна там, где значение
        не попадает в разметку напрямую — например формам склонения. */
    public static function raw(string $key): string
    {
        return self::$dict[$key] ?? self::$base[$key] ?? $key;
    }

    /** Строка словаря на ЗАДАННОМ языке, без экранирования.

        Нужна панели: сама она работает на русском, а подсказку «что уйдёт
        в выдачу» должна показывать на том языке, который сейчас правят.
        Иначе редактор AZ видел бы русский заголовок и думал, что так
        страница и выйдет в поиске. */
    public static function rawIn(string $key, string $lang): string
    {
        if ($lang === self::$lang) return self::raw($key);
        if (!isset(self::$other[$lang])) {
            self::$other[$lang] = in_array($lang, self::$cfg['languages'] ?? [], true)
                ? ($lang === (self::$cfg['default_lang'] ?? 'ru') ? self::$base : self::load($lang))
                : [];
        }
        return self::$other[$lang][$key] ?? self::$base[$key] ?? $key;
    }

    /** Строка по ключу, ГОТОВАЯ К ВЫВОДУ В РАЗМЕТКУ.

        Экранирование здесь, а не у каждого вызова, — осознанный выбор.
        Раньше безопасным был только тот вывод, который кто-то обернул
        руками, и забыть обёртку было легко: проверка нашла несколько
        таких мест, включая вывод внутри атрибутов.

        Теперь наоборот: опасным может быть только то, что ЯВНО попросили
        не экранировать, через raw(). Цена ошибки поменялась местами —
        забыли raw(), увидели на экране лишние &amp;, и это заметно сразу;
        забыли экранирование — получили дыру, и это незаметно никогда.

        Строки словаря правятся из панели, то есть это ввод от человека.
        Сегодня в панель заходит один владелец, но полагаться на это,
        когда плата — одна строка кода, незачем. */
    public static function t(string $key): string
    {
        return htmlspecialchars(self::raw($key), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    /** Есть ли у ключа перевод именно на текущем языке. */
    public static function has(string $key): bool
    {
        return isset(self::$dict[$key]);
    }

    /** Адрес внутри сайта с префиксом текущего языка: '/tseny/' -> '/az/tseny/'. */
    public static function u(string $path, ?string $lang = null): string
    {
        $lang = $lang ?? self::$lang;
        if ($path === '' || $path[0] !== '/') return $path;          // внешние и якоря не трогаем
        return (self::$cfg['prefix'][$lang] ?? '') . $path;
    }

    /** Путь текущей страницы без языкового префикса — для hreflang и переключателя. */
    public static function path(): string
    {
        $p = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
        foreach (self::$cfg['prefix'] as $pre) {
            if ($pre !== '' && strpos($p, $pre . '/') === 0) { $p = substr($p, strlen($pre)); break; }
            if ($pre !== '' && $p === $pre) { $p = '/'; break; }
        }
        if (substr($p, -9) === 'index.php') $p = substr($p, 0, -9);
        if ($p === '' || substr($p, -1) !== '/') $p .= '/';
        return $p;
    }
}

function t(string $key): string { return I18n::t($key); }

/** Строка словаря БЕЗ экранирования. Нужна там, где значение не попадает
    в разметку напрямую: в формы склонения, в data-атрибуты, которые потом
    разбирает скрипт, в сравнения. Если сомневаетесь — вам нужна t(). */
function t_raw(string $key): string { return I18n::raw($key); }
function u(string $path, ?string $lang = null): string { return I18n::u($path, $lang); }
function lang(): string { return I18n::$lang; }

/** Экранирование вывода. Данные страниц и переводы правятся из панели,
    поэтому любой их вывод должен быть безопасным по умолчанию. */
function e(?string $s): string
{
    return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Форма слова после числа. Правила разные: в русском три формы,
    в азербайджанском после числительного форма не меняется вовсе,
    в английском две. Формы хранятся в словаре через вертикальную черту. */
function plural(int $n, string $key, ?string $lang = null): string
{
    $lang  = $lang ?? I18n::$lang;
    $forms = explode('|', I18n::rawIn($key, $lang));
    if ($lang === 'az') return $forms[0];
    if ($lang !== 'ru') return $forms[$n === 1 ? 0 : (count($forms) > 1 ? 1 : 0)];
    $h = abs($n) % 100; $d = $h % 10;
    $i = ($h > 10 && $h < 20) ? 2 : (($d > 1 && $d < 5) ? 1 : (($d === 1) ? 0 : 2));
    return $forms[min($i, count($forms) - 1)];
}

/** Дата статьи для вывода. В данных она дд.мм.гггг — так её вводят в панели;
    по-английски такая запись читается двояко, поэтому там «4 Sep 2026».
    '!' обнуляет время, иначе в объект попали бы текущие часы. */
function date_h(string $d): string
{
    $dt = DateTime::createFromFormat('!d.m.Y', $d);
    if (!$dt) return e($d);
    $txt = I18n::$lang === 'en' ? $dt->format('j M Y') : $dt->format('d.m.Y');
    return '<time datetime="' . $dt->format('Y-m-d') . '">' . e($txt) . '</time>';
}

/** Строка словаря с подстановками: tn('portfolio.all', ['n' => 55, 'u' => '...']). */
function tn(string $key, array $vars): string
{
    /* t() уже экранирована, подстановки экранируем отдельно: иначе
       значение из данных попало бы в разметку как есть. */
    $s = t($key);
    foreach ($vars as $k => $v) $s = str_replace('{' . $k . '}', e((string)$v), $s);
    return $s;
}

/** Строка со склонением и подстановкой: форма выбирается по числу,
    затем в неё подставляются значения. Так правило согласования
    живёт в словаре языка, а шаблон страницы о нём не знает. */
function tp(int $n, string $key, array $vars = []): string
{
    /* plural() берёт форму из raw(), поэтому экранируем здесь: формы
       разделены вертикальной чертой, и экранировать до разбора нельзя. */
    $s = e(plural($n, $key));
    $vars += ['n' => $n];
    foreach ($vars as $k => $v) $s = str_replace('{' . $k . '}', e((string)$v), $s);
    return $s;
}
