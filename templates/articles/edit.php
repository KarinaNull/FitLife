<section class="page-block">
    <h1>Редактирование статьи</h1>
    <form method="post" class="form-card">
        <label>Заголовок <input type="text" name="name" value="<?= htmlspecialchars($article->name) ?>" required></label>
        <label>Автор
            <select name="author_id">
                <?php foreach ($authors as $user): ?>
                    <option value="<?= $user->id ?>" <?= $user->id === $article->author_id ? 'selected' : '' ?>>
                        <?= htmlspecialchars($user->nickname) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Текст <textarea name="text" rows="8" required><?= htmlspecialchars($article->text) ?></textarea></label>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="/articles/<?= $article->id ?>" class="btn btn-secondary">Отмена</a>
    </form>
</section>
