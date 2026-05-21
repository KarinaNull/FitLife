<?php
/** @var string $content */
/** @var string|null $title */
$pageTitle = isset($title) ? $title . ' - ' . $appName : $defaultTitle;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="FitLife - блог о тренировках, питании и здоровом образе жизни. Статьи экспертов, калькулятор ИМТ, база тренеров.">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="header-inner">
        <a class="logo-block" href="/">
            <span class="logo"><?= htmlspecialchars($appName) ?></span>
            <span class="logo-tagline">здоровье · движение · баланс</span>
        </a>
        <nav class="main-nav" id="main-nav">
            <a href="/">Главная</a>
            <a href="/articles">Статьи</a>
            <a href="/calculator">Калькулятор</a>
            <a href="/contacts">Тренеры</a>
            <a href="/feedback">Связаться</a>
        </nav>
        <button type="button" class="nav-toggle" id="nav-toggle" aria-label="Меню">☰</button>
    </div>
</header>

<main class="container">
    <?= $content ?>
</main>

<footer class="site-footer">
    <div class="footer-grid">
        <div class="footer-col">
            <strong class="footer-brand"><?= htmlspecialchars($appName) ?></strong>
            <p>Онлайн-площадка о фитнесе и здоровом образе жизни: читайте материалы, считайте норму калорий и находите контакты тренеров.</p>
        </div>
        <div class="footer-col">
            <strong>Разделы</strong>
            <ul class="footer-links">
                <li><a href="/articles">Статьи и советы</a></li>
                <li><a href="/calculator">Калькулятор ИМТ</a></li>
                <li><a href="/contacts">Записная книжка</a></li>
                <li><a href="/feedback">Обратная связь</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <strong>О проекте</strong>
            <p class="footer-meta">Курсовой проект по серверной веб-разработке.<br>Московский Политех.</p>
            <p class="footer-dev">
                <a href="/headers">HTTP-заголовки</a> ·
                <a href="/hello/Гость">Приветствие</a>
            </p>
        </div>
    </div>
    <p class="footer-copy">© <?= date('Y') ?> <?= htmlspecialchars($appName) ?>. Все материалы носят ознакомительный характер.</p>
</footer>

<script src="/assets/js/app.js"></script>
</body>
</html>
