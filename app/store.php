<?php
/* Хранилище правок из панели управления.

   ПОЧЕМУ ОТДЕЛЬНАЯ ПАПКА, А НЕ app/data/
   Развёртывание из cPanel выполняет `cp -R public/. ~/public_html` и
   `cp -R app/. ~/app`. Любой файл, который панель записала бы внутрь app/,
   был бы переписан при следующем деплое, то есть правки заказчика пропадали
   бы ровно в тот момент, когда разработчик выкладывает мелкую правку вёрстки.
   Поэтому всё, что правится через панель, живёт в ~/site-data — рядом с
   ~/app и ~/public_html, но вне обеих команд копирования.

   Папка лежит выше корня сайта (~/public_html), поэтому из сети она
   недоступна в принципе: там нет ни .htaccess, который можно обойти,
   ни пути, по которому к ней можно обратиться.

   ФОРМАТ. JSON, а не PHP: панель записывает данные, и запись исполняемого
   кода из веб-интерфейса — это дыра размером во весь сервер. JSON максимум
   испортится, но не выполнится.

   ПОРЧА ФАЙЛА НЕ ЛОМАЕТ САЙТ. Если JSON не читается, read() возвращает null,
   и вызывающий код берёт значения из app/data/. Сайт покажет данные
   предыдущей версии, а не пустую страницу.
*/

final class Store
{
    private static string $dir = '';
    private static array  $cache = [];
    private static array  $broken = [];

    public static function boot(string $dir): void
    {
        self::$dir = rtrim(str_replace('\\', '/', $dir), '/');
    }

    public static function dir(): string
    {
        return self::$dir;
    }

    /** Полный путь внутри хранилища. Имя проверяется: наружу не выйти. */
    public static function path(string $rel): string
    {
        if (!preg_match('~^[a-z0-9]([a-z0-9._/-]*[a-z0-9])?$~', $rel) || strpos($rel, '..') !== false) {
            throw new InvalidArgumentException('Недопустимое имя файла хранилища: ' . $rel);
        }
        return self::$dir . '/' . $rel;
    }

    /** Данные из хранилища или null, если файла нет либо он испорчен. */
    public static function read(string $rel): ?array
    {
        if (array_key_exists($rel, self::$cache)) return self::$cache[$rel];

        $out = null;
        $p = self::path($rel);
        if (is_file($p) && is_readable($p)) {
            $raw = file_get_contents($p);
            if ($raw !== false && $raw !== '') {
                $d = json_decode($raw, true);
                /* Проверка кодировки до любого вывода: панель принимает текст
                   от человека, а битый UTF-8 ломает json_encode и экранирование. */
                if (is_array($d) && json_last_error() === JSON_ERROR_NONE) {
                    $out = $d;
                } else {
                    error_log('Store: не читается ' . $rel . ' — ' . json_last_error_msg());
                    self::$broken[$rel] = json_last_error_msg();
                }
            }
        }
        return self::$cache[$rel] = $out;
    }

    /** Запись одним куском: сначала во временный файл, потом подмена имени.
        Читатель в любой момент видит либо прежний файл целиком, либо новый
        целиком, но никогда — половину. */
    public static function write(string $rel, array $data): bool
    {
        $p = self::path($rel);
        $d = dirname($p);
        if (!is_dir($d) && !@mkdir($d, 0770, true) && !is_dir($d)) {
            error_log('Store: не создаётся папка ' . $d);
            return false;
        }

        /* Испорченный файл перед перезаписью копируем в сторону.

           Иначе первое же сохранение делает потерю необратимой: разбирать
           нечего, сайт показывает данные из репозитория, редактор решает,
           что правки «откатились», и сохраняет заново — поверх единственной
           копии того, что можно было бы восстановить руками. */
        if (is_file($p)) {
            $old = (string)@file_get_contents($p);
            if ($old !== '' && !is_array(json_decode($old, true))) {
                $copy = $p . '.broken-' . date('Ymd-His');
                @copy($p, $copy);
                error_log('Store: испорченный ' . $rel . ' сохранён как ' . basename($copy));
            }
        }

        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if ($json === false) {
            error_log('Store: не сериализуется ' . $rel . ' — ' . json_last_error_msg());
            return false;
        }

        $tmp = $p . '.' . bin2hex(random_bytes(6)) . '.tmp';
        $n = @file_put_contents($tmp, $json, LOCK_EX);

        /* Сверяем число записанных байт, а не только отказ.

           При переполнении диска file_put_contents возвращает НЕ false,
           а количество байт, которое успело записаться. Проверка «=== false»
           такую запись считает удачной, и обрезанный файл подменяет целый:
           правки в нём теряются навсегда, причём молча — панель покажет
           «Сохранено». Это худший из возможных исходов, поэтому оборванный
           временный файл убираем и честно отвечаем отказом. */
        if ($n === false || $n !== strlen($json)) {
            @unlink($tmp);
            error_log('Store: записано ' . var_export($n, true) . ' из '
                    . strlen($json) . ' байт в ' . $tmp . ' — вероятно, кончилось место');
            return false;
        }
        @chmod($tmp, 0660);

        /* rename поверх существующего файла на Windows не работает, поэтому
           при отказе убираем цель и повторяем. На боевом сервере (Linux)
           срабатывает первая попытка и подмена остаётся атомарной. */
        if (!@rename($tmp, $p)) {
            /* Прежний файл сначала отодвигаем, а не удаляем: если вторая
               попытка тоже не удастся, после удаления не осталось бы
               ни новых данных, ни старых. */
            $keep = is_file($p) ? $p . '.' . bin2hex(random_bytes(4)) . '.old' : null;
            if ($keep !== null && !@rename($p, $keep)) $keep = null;

            if (!@rename($tmp, $p)) {
                @unlink($tmp);
                if ($keep !== null) @rename($keep, $p);   // возвращаем как было
                error_log('Store: не подменяется ' . $p);
                return false;
            }
            if ($keep !== null) @unlink($keep);
        }

        unset(self::$cache[$rel]);
        return true;
    }

    /** Прочитать, изменить и записать — не дав никому вклиниться.

        Один и тот же файл правят разные разделы: texts.json — и «Строки
        страниц», и «Страницы». Без блокировки два сохранения, попавшие
        в одну секунду, читают одно и то же состояние, и то, что записалось
        первым, стирается вторым. Заметить это нельзя: оба увидели
        «Сохранено».

        Блокировка — отдельный файл .lock рядом: блокировать сам файл
        данных нельзя, его имя подменяется при каждой записи. */
    public static function update(string $rel, callable $fn): bool
    {
        $p = self::path($rel);
        $d = dirname($p);
        if (!is_dir($d) && !@mkdir($d, 0770, true) && !is_dir($d)) return false;

        $fh = @fopen($p . '.lock', 'c');
        if ($fh === false) {
            /* Не вышло взять блокировку — работаем без неё. Отказать было бы
               хуже: правка важнее защиты от совпадения, которое случается
               у сайта с одним редактором примерно никогда. */
            error_log('Store: не открывается замок для ' . $rel);
            self::forget($rel);
            $new = $fn(self::read($rel) ?? []);
            return is_array($new) ? self::write($rel, $new) : false;
        }

        @flock($fh, LOCK_EX);
        try {
            self::forget($rel);                     // читаем с диска, не из памяти
            $new = $fn(self::read($rel) ?? []);
            $ok = is_array($new) ? self::write($rel, $new) : false;
        } finally {
            @flock($fh, LOCK_UN);
            fclose($fh);
        }
        self::forget($rel);
        return $ok;
    }

    /** Метка версии файла: по ней видно, менялся ли он с тех пор,
        как панель показала форму.

        Нужна против устаревшей вкладки. Блокировка спасает от того, что
        два сохранения перепутаются между собой, но не от случая, когда
        вкладку открыли утром, днём правили из другой, а вечером нажали
        «Сохранить» в первой — и она вернула всё как было утром. */
    public static function stamp(string $rel): string
    {
        $p = self::path($rel);
        if (!is_file($p)) return 'none';
        return (string)@filemtime($p) . '-' . (string)@filesize($p);
    }

    /** Доступна ли папка на запись. Панель показывает это на видном месте:
        молча не сохранять — худшее, что может делать редактор. */
    public static function writable(): bool
    {
        if (self::$dir === '') return false;
        if (is_dir(self::$dir)) return is_writable(self::$dir);
        return @mkdir(self::$dir, 0770, true) || is_dir(self::$dir);
    }

    /** Какие из файлов хранилища не читаются.

        Проверяем не только то, что уже пытались прочитать на этой
        странице, а все известные файлы: испорченный раздел, который
        редактор сегодня не открывал, всё равно должен быть виден. */
    public static function broken(array $known): array
    {
        $out = self::$broken;
        foreach ($known as $rel) {
            if (isset($out[$rel])) continue;
            $p = self::path($rel);
            if (!is_file($p)) continue;
            $raw = (string)@file_get_contents($p);
            if ($raw === '') continue;
            json_decode($raw, true);
            if (json_last_error() !== JSON_ERROR_NONE) $out[$rel] = json_last_error_msg();
        }
        return $out;
    }

    public static function forget(?string $rel = null): void
    {
        if ($rel === null) self::$cache = [];
        else unset(self::$cache[$rel]);
    }
}
