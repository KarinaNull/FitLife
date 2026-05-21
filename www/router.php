<?php

declare(strict_types=1);

// Маршрутизатор для встроенного сервера PHP: php -S localhost:8080 router.php
if (php_sapi_name() === 'cli-server') {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $file = __DIR__ . $path;
    if ($path !== '/' && is_file($file)) {
        return false;
    }
}

require __DIR__ . '/index.php';
