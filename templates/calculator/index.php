<?php
$input = $input ?? ['weight' => '', 'height' => '', 'age' => '', 'gender' => 'male', 'activity' => 1.2];
?>
<section class="page-block">
    <?php
    $introTitle = 'Калькулятор ИМТ и калорий';
    $introText = 'Узнайте индекс массы тела и примерную суточную норму калорий. Можно рассчитать на сервере или обновить результат на странице без перезагрузки.';
    require __DIR__ . '/../partials/page-intro.php';
    ?>

    <form id="calc-form" class="form-card" action="/calculator/calculate" method="get">
        <label>Вес (кг) <input type="number" step="0.1" name="weight" id="weight" value="<?= htmlspecialchars((string) $input['weight']) ?>" required></label>
        <label>Рост (см) <input type="number" step="0.1" name="height" id="height" value="<?= htmlspecialchars((string) $input['height']) ?>" required></label>
        <label>Возраст <input type="number" name="age" id="age" value="<?= htmlspecialchars((string) $input['age']) ?>" required></label>
        <label>Пол
            <select name="gender" id="gender">
                <option value="male" <?= $input['gender'] === 'male' ? 'selected' : '' ?>>Мужской</option>
                <option value="female" <?= $input['gender'] === 'female' ? 'selected' : '' ?>>Женский</option>
            </select>
        </label>
        <label>Активность
            <select name="activity" id="activity">
                <option value="1.2" <?= (float) $input['activity'] === 1.2 ? 'selected' : '' ?>>Минимальная</option>
                <option value="1.375" <?= (float) $input['activity'] === 1.375 ? 'selected' : '' ?>>Лёгкая</option>
                <option value="1.55" <?= (float) $input['activity'] === 1.55 ? 'selected' : '' ?>>Умеренная</option>
                <option value="1.725" <?= (float) $input['activity'] === 1.725 ? 'selected' : '' ?>>Высокая</option>
            </select>
        </label>
        <button type="submit" class="btn btn-primary">Рассчитать на сервере</button>
        <button type="button" class="btn btn-secondary" id="calc-ajax">Рассчитать динамически</button>
    </form>

    <div id="calc-result" class="result-box">
        <?php if (!empty($error)): ?>
            <p class="alert alert-error"><?= htmlspecialchars($error) ?></p>
        <?php elseif (!empty($result)): ?>
            <h2>Результат</h2>
            <p>ИМТ: <strong><?= $result['bmi'] ?></strong> - <?= htmlspecialchars($result['bmi_category']) ?></p>
            <p>Базовый обмен: <?= $result['bmr'] ?> ккал/сутки</p>
            <p>Суточная норма: <strong><?= $result['calories'] ?> ккал</strong></p>
        <?php endif; ?>
    </div>
</section>
