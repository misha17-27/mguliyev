# MGuliyev Studio — сайт

Статический PHP-сайт без сборки и без зависимостей. Требуется PHP 8.1+.

## Раскладка

```
public/     корень сайта — только это должно быть доступно из сети
  index.php, blog/, portfolio/, uslugi/, o-studii/, tseny/, kontakty/
  assets/css/style.css, assets/js/app.js
  images/   brand/ home/ demo/ works/ groups/ placeholder/
  .htaccess robots.txt sitemap.xml
app/        шаблоны и данные, физически вне корня сайта
  partials/ head.php foot.php article.php
  data/     catalog.php works.php articles.php
_source/    исходники: скриншоты клиентских сайтов (127 МБ). На хостинг не выкладывается.
```

Папка каждой страницы и есть её адрес: `public/portfolio/index.php` → `/portfolio/`.

## Запуск

```bash
php -S localhost:5173 -t public
```

## Хостинг

Корнем сайта (document root) нужно назначить `public/`. Если такой возможности нет,
`app/` и `_source/` окажутся доступны из сети — тогда их надо закрыть правилами
в `.htaccess` или перенести `app/` выше корня.

`_source/` на сервер не загружается: это рабочие материалы, а не часть сайта.

## Где что менять

| Что | Файл |
|---|---|
| Услуги (4 направления, 24 услуги) | `app/data/catalog.php` |
| Проекты портфолио | `app/data/works.php` |
| Статьи блога | `app/data/articles.php` |
| Меню, шапка, подвал | `app/partials/` |
| Стили | `public/assets/css/style.css` |
| Скрипты | `public/assets/js/app.js` |

Обложки проектов кладутся в `public/images/works/<домен>.jpg`, 1200×750, и
прописываются третьим полем в `app/data/works.php`. Исходные снимки для нарезки
лежат в `_source/portfolio-screenshots/<домен>/`.

## Языки

Сейчас один язык — русский. Планируются `az` и `en`; основной остаётся русский.
Тексты страниц лежат прямо в файлах страниц — при добавлении языков их нужно
будет вынести в словари.
