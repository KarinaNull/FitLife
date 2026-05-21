# FitLife - курсовой проект

Блог о здоровье и фитнесе на **самописном PHP MVC-фреймворке** (тема 3 курса «Серверная веб-разработка», Московский Политех).

## Реализованные технологии из лабораторных работ

| Лабораторная | Реализация в проекте |
|--------------|----------------------|
| Роутинг (2.1) | Маршруты `/hello/{name}`, `/bye/{name}`, regex-роутер |
| Представления (2.2) | Переменная `$title` в шаблонах, заголовок по умолчанию |
| Статьи и автор (3.1) | `ArticlesController::show()`, nickname автора из `users` |
| Feedback Form (4.1) | Форма обратной связи, страница `/headers` с `getallheaders()` |
| Notebook (5.1) | Записная книжка контактов (CRUD) |
| Итоговая работа блока 3 | Комментарии к статьям, POST `/articles/{id}/comments`, редактирование |
| Калькулятор (курс) | Расчёт ИМТ и калорий по параметрам (сервер + AJAX) |
| Динамический элемент | Блок «Совет дня», мобильное меню, AJAX-калькулятор |

## Стек

- PHP 8.0+, PSR-4 autoload (Composer)
- MySQL
- MVC: Router, View, Controllers, Active Record

## Установка

1. Установите зависимости:

```bash
cd course-project
composer install
```

2. Запустите MySQL в Open Server Panel (модуль **MySQL-5.7-Win10**).

3. Создайте базу данных (клиент OSPanel):

```bash
"C:\OSPanel\modules\database\MySQL-5.7-Win10\bin\mysql.exe" -u root < database/schema.sql
```

4. Настройки в `config/config.php` по умолчанию: `127.0.0.1:3306`, пользователь `root`, пароль пустой, БД `fitlife`. Переопределение через переменные: `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASSWORD`.

5. Запустите встроенный сервер PHP (корень - папка `www`):

```bash
cd www
php -S localhost:8080 router.php
```

6. Откройте в браузере: http://localhost:8080

## Структура проекта

```
course-project/
├── www/              # Document root (index.php, assets)
├── src/MyProject/    # Фреймворк и приложение
├── templates/        # PHP-шаблоны
├── config/           # Конфигурация
└── database/         # schema.sql
```

## Основные URL

- `/` - главная
- `/articles`, `/articles/{id}` - статьи
- `/articles/{id}/comments` - добавление комментария (POST)
- `/comments/{id}/edit` - редактирование комментария
- `/contacts` - записная книжка
- `/feedback` - обратная связь
- `/calculator` - калькулятор ИМТ и калорий
- `/headers` - HTTP-заголовки
- `/hello/{name}`, `/bye/{name}` - демо роутинга
