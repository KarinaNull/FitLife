<?php

declare(strict_types=1);

namespace MyProject;

use MyProject\Controllers\ArticlesController;
use MyProject\Controllers\CalculatorController;
use MyProject\Controllers\CommentsController;
use MyProject\Controllers\ContactsController;
use MyProject\Controllers\FeedbackController;
use MyProject\Controllers\MainController;

final class Application
{
    public function run(): void
    {
        $router = new Router();
        $main = MainController::class;
        $articles = ArticlesController::class;
        $comments = CommentsController::class;
        $contacts = ContactsController::class;
        $feedback = FeedbackController::class;
        $calculator = CalculatorController::class;

        $router->add('~^/$~', [$main, 'index']);
        $router->add('~^/hello/([^/]+)$~', [$main, 'hello']);
        $router->add('~^/bye/([^/]+)$~', [$main, 'bye']);
        $router->add('~^/headers$~', [$main, 'headers']);

        $router->add('~^/articles$~', [$articles, 'index']);
        $router->add('~^/articles/create$~', [$articles, 'create']);
        $router->add('~^/articles/(\d+)$~', [$articles, 'show']);
        $router->add('~^/articles/(\d+)/edit$~', [$articles, 'edit']);
        $router->add('~^/articles/(\d+)/comments$~', [$comments, 'store']);

        $router->add('~^/comments/(\d+)/edit$~', [$comments, 'edit']);

        $router->add('~^/contacts$~', [$contacts, 'index']);
        $router->add('~^/contacts/create$~', [$contacts, 'create']);
        $router->add('~^/contacts/(\d+)/edit$~', [$contacts, 'edit']);
        $router->add('~^/contacts/(\d+)/delete$~', [$contacts, 'delete']);

        $router->add('~^/feedback$~', [$feedback, 'form']);
        $router->add('~^/feedback/sent$~', [$feedback, 'sent']);

        $router->add('~^/calculator$~', [$calculator, 'index']);
        $router->add('~^/calculator/calculate$~', [$calculator, 'calculate']);

        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $router->dispatch($uri, $method);
    }
}
