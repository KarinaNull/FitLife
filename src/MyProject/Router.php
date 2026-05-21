<?php

declare(strict_types=1);

namespace MyProject;

final class Router
{
    /** @var array<string, array{0: class-string, 1: string}> */
    private array $routes = [];

    /** @param array{0: class-string, 1: string} $handler */
    public function add(string $pattern, array $handler): void
    {
        $this->routes[$pattern] = $handler;
    }

    public function dispatch(string $uri, string $method): void
    {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';
        $path = '/' . trim($path, '/');
        if ($path !== '/') {
            $path = rtrim($path, '/');
        }

        foreach ($this->routes as $pattern => $handler) {
            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches);
                $controller = new $handler[0]();
                $action = $handler[1];
                $controller->$action(...$matches);

                return;
            }
        }

        http_response_code(404);
        (new View())->render('errors/404', ['title' => 'Страница не найдена']);
    }
}
