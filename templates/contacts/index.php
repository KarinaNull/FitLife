<section class="page-block">
    <?php
    $introTitle = 'Тренеры и специалисты';
    $introText = 'Записная книжка для хранения контактов: добавляйте, редактируйте и удаляйте записи о тренерах и консультантах.';
    require __DIR__ . '/../partials/page-intro.php';
    ?>
    <div class="page-head">
        <span></span>
        <a href="/contacts/create" class="btn btn-primary">Добавить контакт</a>
    </div>

    <?php if (empty($contacts)): ?>
        <p>Контактов пока нет.</p>
    <?php else: ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Пол</th>
                    <th>Дата рождения</th>
                    <th>Телефон</th>
                    <th>Email</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?= htmlspecialchars($contact->getFullName()) ?></td>
                        <td><?= $contact->gender === 'female' ? 'Ж' : 'М' ?></td>
                        <td><?= htmlspecialchars($contact->birth_date) ?></td>
                        <td><?= htmlspecialchars($contact->phone) ?></td>
                        <td><?= htmlspecialchars($contact->email) ?></td>
                        <td class="actions">
                            <a href="/contacts/<?= $contact->id ?>/edit">Изменить</a>
                            <form method="post" action="/contacts/<?= $contact->id ?>/delete" class="inline-form" onsubmit="return confirm('Удалить контакт?');">
                                <button type="submit" class="link-btn">Удалить</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>
