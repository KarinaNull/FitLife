<section class="page-block">
    <h1>Новая статья</h1>
    <form method="post" class="form-card">
        <label>Заголовок <input type="text" name="name" required></label>
        <label>Автор
            <select name="author_id">
                <?php foreach ($authors as $user): ?>
                    <option value="<?= $user->id ?>"><?= htmlspecialchars($user->nickname) ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Текст <textarea name="text" rows="8" required></textarea></label>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</section>
