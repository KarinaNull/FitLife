<?php

declare(strict_types=1);

namespace MyProject\Controllers;

use MyProject\Models\Article;
use MyProject\View;

class MainController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function index(): void
    {
        $articles = array_slice(Article::findAllWithAuthors(), 0, 3);
        $this->view->render('main/index', [
            'title' => 'Главная',
            'articles' => $articles,
        ]);
    }

    public function hello(string $name): void
    {
        $decoded = urldecode($name);
        $this->view->render('main/hello', [
            'title' => 'Страница приветствия',
            'name' => htmlspecialchars($decoded, ENT_QUOTES, 'UTF-8'),
            'nameUrl' => rawurlencode($decoded),
        ]);
    }

    public function bye(string $name): void
    {
        $decoded = urldecode($name);
        $this->view->render('main/bye', [
            'title' => 'До встречи',
            'name' => htmlspecialchars($decoded, ENT_QUOTES, 'UTF-8'),
        ]);
    }

    public function headers(): void
    {
        $headers = getallheaders() ?: [];
        $this->view->render('main/headers', [
            'title' => 'HTTP-заголовки',
            'headers' => $headers,
        ]);
    }
}
