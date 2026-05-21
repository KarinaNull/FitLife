<section class="page-block">
    <h1>Редактирование комментария</h1>
    <form method="post" class="form-card">
        <label>Автор
            <select name="author_id">
                <?php foreach ($authors as $user): ?>
                    <option value="<?= $user->id ?>" <?= $user->id === $comment->author_id ? 'selected' : '' ?>>
                        <?= htmlspecialchars($user->nickname) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Текст <textarea name="text" rows="5" required><?= htmlspecialchars($comment->text) ?></textarea></label>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="/articles/<?= $comment->article_id ?>#comment<?= $comment->id ?>" class="btn btn-secondary">Назад</a>
    </form>
</section>
