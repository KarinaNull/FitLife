<section class="page-block">
    <?php
    $introTitle = 'Связаться с нами';
    $introText = 'Задайте вопрос, предложите тему для статьи или оставьте отзыв - мы сохраним сообщение и свяжемся с вами по email.';
    require __DIR__ . '/../partials/page-intro.php';
    ?>
    <form method="post" action="/feedback" class="form-card">
        <label>Имя <input type="text" name="name" required></label>
        <label>Email <input type="email" name="email" required></label>
        <label>Тема <input type="text" name="subject" required></label>
        <label>Сообщение <textarea name="message" rows="5" required></textarea></label>
        <button type="submit" class="btn btn-primary">Отправить</button>
        <a href="/headers" class="btn btn-secondary">Страница заголовков</a>
    </form>
</section>
