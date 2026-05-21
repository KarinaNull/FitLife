<?php $c = $contact; ?>
<section class="page-block">
    <div class="page-intro page-intro--compact">
        <h1><?= $contact === null ? 'Добавление контакта' : 'Редактирование контакта' ?></h1>
        <p>Заполните данные специалиста - они появятся в общей записной книжке.</p>
    </div>
    <form method="post" action="<?= htmlspecialchars($action) ?>" class="form-card">
        <label>Фамилия <input type="text" name="last_name" value="<?= $c ? htmlspecialchars($c->last_name) : '' ?>" required></label>
        <label>Имя <input type="text" name="first_name" value="<?= $c ? htmlspecialchars($c->first_name) : '' ?>" required></label>
        <label>Отчество <input type="text" name="middle_name" value="<?= $c ? htmlspecialchars($c->middle_name) : '' ?>"></label>
        <label>Пол
            <select name="gender">
                <option value="male" <?= $c && $c->gender === 'male' ? 'selected' : '' ?>>Мужской</option>
                <option value="female" <?= $c && $c->gender === 'female' ? 'selected' : '' ?>>Женский</option>
            </select>
        </label>
        <label>Дата рождения <input type="date" name="birth_date" value="<?= $c ? htmlspecialchars($c->birth_date) : '' ?>" required></label>
        <label>Телефон <input type="tel" name="phone" value="<?= $c ? htmlspecialchars($c->phone) : '' ?>" required></label>
        <label>Адрес <input type="text" name="address" value="<?= $c ? htmlspecialchars($c->address) : '' ?>" required></label>
        <label>Email <input type="email" name="email" value="<?= $c ? htmlspecialchars($c->email) : '' ?>" required></label>
        <label>Комментарий <textarea name="comment" rows="3"><?= $c ? htmlspecialchars($c->comment) : '' ?></textarea></label>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="/contacts" class="btn btn-secondary">Отмена</a>
    </form>
</section>
