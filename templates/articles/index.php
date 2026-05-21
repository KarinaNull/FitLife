<section class="page-block">
    <?php
    $introTitle = 'Статьи и рекомендации';
    $introText = 'Материалы о тренировках, питании и восстановлении. Откройте запись, чтобы прочитать полностью и оставить комментарий.';
    require __DIR__ . '/../partials/page-intro.php';
    ?>
    <div class="page-head">
        <span></span>
        <a href="/articles/create" class="btn btn-primary">Добавить статью</a>
    </div>

    <div class="cards-grid">
        <?php foreach ($articles as $article): ?>
            <?php $author = $article->getAuthor(); ?>
            <article class="card">
                <h2><a href="/articles/<?= $article->id ?>"><?= htmlspecialchars($article->name) ?></a></h2>
                <p><?= htmlspecialchars(mb_substr($article->text, 0, 160)) ?>...</p>
                <p class="meta">Автор: <?= $author ? htmlspecialchars($author->nickname) : '-' ?></p>
            </article>
        <?php endforeach; ?>
    </div>
</section>
