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

final class I18n
{
    public static string $lang = 'ru';
    public static array  $cfg  = [];
    private static array $dict = [];
    private static array $base = [];

    public static function boot(array $cfg): void
    {
        self::$cfg = $cfg;
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
        return is_file($p) ? (array) require $p : [];
    }

    /** Строка по ключу без экранирования. Нужна там, где значение
        не попадает в разметку напрямую — например формам склонения. */
    public static function raw(string $key): string
    {
        return self::$dict[$key] ?? self::$base[$key] ?? $key;
    }

    /** Строка по ключу. Нет перевода — отдаём русский, нет и его — сам ключ. */
    public static function t(string $key): string
    {
        return self::raw($key);
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
function plural(int $n, string $key): string
{
    $forms = explode('|', I18n::raw($key));
    $lang  = I18n::$lang;
    if ($lang === 'az') return $forms[0];
    if ($lang !== 'ru') return $forms[$n === 1 ? 0 : (count($forms) > 1 ? 1 : 0)];
    $h = abs($n) % 100; $d = $h % 10;
    $i = ($h > 10 && $h < 20) ? 2 : (($d > 1 && $d < 5) ? 1 : (($d === 1) ? 0 : 2));
    return $forms[min($i, count($forms) - 1)];
}

/** Строка словаря с подстановками: tn('portfolio.all', ['n' => 55, 'u' => '...']). */
function tn(string $key, array $vars): string
{
    $s = t($key);
    foreach ($vars as $k => $v) $s = str_replace('{' . $k . '}', e((string)$v), $s);
    return $s;
}

/** Строка со склонением и подстановкой: форма выбирается по числу,
    затем в неё подставляются значения. Так правило согласования
    живёт в словаре языка, а шаблон страницы о нём не знает. */
function tp(int $n, string $key, array $vars = []): string
{
    $s = plural($n, $key);
    $vars += ['n' => $n];
    foreach ($vars as $k => $v) $s = str_replace('{' . $k . '}', e((string)$v), $s);
    return $s;
}
