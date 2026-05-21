<section class="page-block">
    <h1>HTTP-заголовки запроса</h1>
    <p>Результат функции <code>getallheaders()</code> (лабораторная работа Feedback Form).</p>
    <table class="data-table">
        <thead>
            <tr><th>Заголовок</th><th>Значение</th></tr>
        </thead>
        <tbody>
            <?php if (empty($headers)): ?>
                <tr><td colspan="2">Заголовки недоступны в CLI-режиме. Откройте страницу через веб-сервер.</td></tr>
            <?php else: ?>
                <?php foreach ($headers as $name => $value): ?>
                    <tr>
                        <td><?= htmlspecialchars($name) ?></td>
                        <td><?= htmlspecialchars($value) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="/feedback" class="btn btn-secondary">К форме обратной связи</a>
</section>
