<section class="hero">
    <p class="hero-badge">Ваш путь к здоровому образу жизни</p>
    <h1>Добро пожаловать в FitLife</h1>
    <p class="lead">Полезные статьи от тренеров и нутрициологов, расчёт нормы калорий и удобная записная книжка - всё в одном месте.</p>
    <div class="hero-actions">
        <a class="btn btn-primary" href="/articles">Читать статьи</a>
        <a class="btn btn-secondary" href="/calculator">Рассчитать ИМТ</a>
        <a class="btn btn-secondary" href="/contacts">Найти тренера</a>
    </div>
</section>

<section class="features-section">
    <h2 class="section-title">Что вы найдёте на сайте</h2>
    <div class="features-grid">
        <article class="feature-card">
            <span class="feature-icon" aria-hidden="true">📚</span>
            <h3>База знаний</h3>
            <p>Статьи о тренировках, питании и восстановлении. К каждой записи можно оставить комментарий и обсудить детали с автором.</p>
        </article>
        <article class="feature-card">
            <span class="feature-icon" aria-hidden="true">📊</span>
            <h3>Персональный расчёт</h3>
            <p>Калькулятор ИМТ и суточной нормы калорий с учётом пола, возраста и уровня активности - результат на сервере или без перезагрузки страницы.</p>
        </article>
        <article class="feature-card">
            <span class="feature-icon" aria-hidden="true">👥</span>
            <h3>Контакты специалистов</h3>
            <p>Записная книжка тренеров: храните и редактируйте контакты, чтобы быстро связаться с нужным человеком.</p>
        </article>
    </div>
</section>

<section class="about-strip">
    <div class="about-strip-inner">
        <h2>О FitLife</h2>
        <p>Мы собрали практические материалы для тех, кто хочет тренироваться осознанно: без лишней теории, с акцентом на привычки, питание и безопасную нагрузку. Начните с калькулятора или выберите статью из подборки ниже.</p>
    </div>
</section>

<section class="home-content-grid cards-grid">
    <article class="card highlight-card" id="promo-card">
        <h2>Совет дня</h2>
        <p id="promo-text">Нажмите кнопку - появится короткая рекомендация для тренировок и питания.</p>
        <button type="button" class="btn btn-primary" id="promo-btn">Показать совет</button>
    </article>

    <article class="card">
        <h2>Свежие публикации</h2>
        <p class="card-desc">Последние материалы от наших авторов:</p>
        <ul class="article-list">
            <?php foreach ($articles as $article): ?>
                <?php $author = $article->getAuthor(); ?>
                <li>
                    <a href="/articles/<?= $article->id ?>"><?= htmlspecialchars($article->name) ?></a>
                    <span class="meta"><?= $author ? htmlspecialchars($author->nickname) : '-' ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="/articles" class="card-link">Все статьи →</a>
    </article>
</section>

<section class="cta-banner">
    <h2>Остались вопросы?</h2>
    <p>Напишите нам через форму обратной связи - ответ придёт на указанный email.</p>
    <a href="/feedback" class="btn btn-primary">Написать сообщение</a>
</section>
