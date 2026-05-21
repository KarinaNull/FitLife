<?php

declare(strict_types=1);

namespace MyProject\Controllers;

use MyProject\Models\Article;
use MyProject\Models\Comment;
use MyProject\Models\User;
use MyProject\View;

class ArticlesController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function index(): void
    {
        $this->view->render('articles/index', [
            'title' => 'Статьи',
            'articles' => Article::findAllWithAuthors(),
        ]);
    }

    public function show(string $id): void
    {
        $article = Article::findById((int) $id);
        if ($article === null) {
            http_response_code(404);
            $this->view->render('errors/404', ['title' => 'Статья не найдена']);

            return;
        }

        $author = $article->getAuthor();
        $comments = Comment::findByArticleId($article->id);
        $authors = User::findAll('nickname ASC');

        $this->view->render('articles/show', [
            'title' => $article->name,
            'article' => $article,
            'author' => $author,
            'comments' => $comments,
            'authors' => $authors,
            'error' => $_GET['error'] ?? null,
        ]);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $article = new Article();
            $article->author_id = (int) ($_POST['author_id'] ?? 1);
            $article->name = trim($_POST['name'] ?? '');
            $article->text = trim($_POST['text'] ?? '');
            $article->save();
            header('Location: /articles/' . $article->id);
            exit;
        }

        $this->view->render('articles/create', [
            'title' => 'Новая статья',
            'authors' => User::findAll('nickname ASC'),
        ]);
    }

    public function edit(string $id): void
    {
        $article = Article::findById((int) $id);
        if ($article === null) {
            http_response_code(404);
            $this->view->render('errors/404', ['title' => 'Статья не найдена']);

            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $article->name = trim($_POST['name'] ?? '');
            $article->text = trim($_POST['text'] ?? '');
            $article->author_id = (int) ($_POST['author_id'] ?? $article->author_id);
            $article->updated_at = date('Y-m-d H:i:s');
            $article->save();
            header('Location: /articles/' . $article->id);
            exit;
        }

        $this->view->render('articles/edit', [
            'title' => 'Редактирование статьи',
            'article' => $article,
            'authors' => User::findAll('nickname ASC'),
        ]);
    }
}
