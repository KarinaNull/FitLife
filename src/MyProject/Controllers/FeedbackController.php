<?php

declare(strict_types=1);

namespace MyProject\Controllers;

use MyProject\Models\FeedbackMessage;
use MyProject\View;

class FeedbackController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function form(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $message = new FeedbackMessage();
            $message->name = trim($_POST['name'] ?? '');
            $message->email = trim($_POST['email'] ?? '');
            $message->subject = trim($_POST['subject'] ?? '');
            $message->message = trim($_POST['message'] ?? '');
            $message->save();

            header('Location: /feedback/sent');
            exit;
        }

        $this->view->render('feedback/form', [
            'title' => 'Обратная связь',
        ]);
    }

    public function sent(): void
    {
        $this->view->render('feedback/sent', [
            'title' => 'Сообщение отправлено',
        ]);
    }
}
