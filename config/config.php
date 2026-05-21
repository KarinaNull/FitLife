<?php

declare(strict_types=1);

return [
    'app_name' => 'FitLife',
    'default_title' => 'FitLife - блог о здоровье и фитнесе',
    'db' => [
        // СУБД: Open Server Panel → MySQL-5.7-Win10 (C:\OSPanel\modules\database\MySQL-5.7-Win10)
        'driver' => getenv('DB_DRIVER') ?: 'mysql',
        'sqlite_path' => dirname(__DIR__) . '/database/fitlife.sqlite',
        'host' => getenv('DB_HOST') ?: '127.0.0.1',
        'port' => getenv('DB_PORT') ?: '3306',
        'name' => getenv('DB_NAME') ?: 'fitlife',
        'user' => getenv('DB_USER') ?: 'root',
        'password' => getenv('DB_PASSWORD') ?: '',
        'charset' => 'utf8mb4',
    ],
];
