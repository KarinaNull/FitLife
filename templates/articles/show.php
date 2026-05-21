<section class="page-block">
    <article class="article-full">
        <h1><?= htmlspecialchars($article->name) ?></h1>
        <p class="meta">
            Автор: <strong><?= $author ? htmlspecialchars($author->nickname) : '-' ?></strong>
            · <?= htmlspecialchars($article->created_at) ?>
        </p>
        <div class="article-text">
            <?= nl2br(htmlspecialchars($article->text)) ?>
        </div>
        <p><a href="/articles/<?= $article->id ?>/edit" class="btn btn-secondary">Редактировать статью</a></p>
    </article>

    <section class="comments-section">
        <h2>Комментарии</h2>

        <?php if (!empty($error)): ?>
            <p class="alert alert-error">Заполните текст и выберите автора комментария.</p>
        <?php endif; ?>

        <?php foreach ($comments as $comment): ?>
            <?php $commentAuthor = $comment->getAuthor(); ?>
            <div class="comment" id="comment<?= $comment->id ?>">
                <p class="comment-meta">
                    <?= $commentAuthor ? htmlspecialchars($commentAuthor->nickname) : 'Аноним' ?>
                    · <?= htmlspecialchars($comment->created_at) ?>
                    · <a href="/comments/<?= $comment->id ?>/edit">Редактировать</a>
                </p>
                <p><?= nl2br(htmlspecialchars($comment->text)) ?></p>
            </div>
        <?php endforeach; ?>

        <form method="post" action="/articles/<?= $article->id ?>/comments" class="form-card">
            <h3>Добавить комментарий</h3>
            <label>
                Автор
                <select name="author_id" required>
                    <?php foreach ($authors as $user): ?>
                        <option value="<?= $user->id ?>"><?= htmlspecialchars($user->nickname) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>
                Текст
                <textarea name="text" rows="4" required></textarea>
            </label>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </section>
</section>
