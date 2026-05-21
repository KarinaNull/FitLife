<?php

declare(strict_types=1);

namespace MyProject\Controllers;

use MyProject\Models\Article;
use MyProject\Models\Comment;
use MyProject\Models\User;
use MyProject\View;

class CommentsController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function store(string $articleId): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /articles/' . $articleId);
            exit;
        }

        $article = Article::findById((int) $articleId);
        if ($article === null) {
            http_response_code(404);
            $this->view->render('errors/404', ['title' => 'Статья не найдена']);

            return;
        }

        $text = trim($_POST['text'] ?? '');
        $authorId = (int) ($_POST['author_id'] ?? 0);

        if ($text === '' || $authorId <= 0) {
            header('Location: /articles/' . $articleId . '?error=comment');
            exit;
        }

        $comment = new Comment();
        $comment->article_id = $article->id;
        $comment->author_id = $authorId;
        $comment->text = $text;
        $comment->save();

        header('Location: /articles/' . $articleId . '#comment' . $comment->id);
        exit;
    }

    public function edit(string $id): void
    {
        $comment = Comment::findById((int) $id);
        if ($comment === null) {
            http_response_code(404);
            $this->view->render('errors/404', ['title' => 'Комментарий не найден']);

            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comment->text = trim($_POST['text'] ?? '');
            $comment->author_id = (int) ($_POST['author_id'] ?? $comment->author_id);
            $comment->save();
            header('Location: /articles/' . $comment->article_id . '#comment' . $comment->id);
            exit;
        }

        $this->view->render('comments/edit', [
            'title' => 'Редактирование комментария',
            'comment' => $comment,
            'authors' => User::findAll('nickname ASC'),
        ]);
    }
}
