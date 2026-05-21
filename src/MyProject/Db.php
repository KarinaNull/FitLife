<?php

declare(strict_types=1);

namespace MyProject;

use PDO;
use PDOException;

final class Db
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            $config = require dirname(__DIR__, 2) . '/config/config.php';
            $db = $config['db'];
            $driver = $db['driver'] ?? 'mysql';

            try {
                if ($driver === 'sqlite') {
                    $path = $db['sqlite_path'];
                    if (!is_file($path)) {
                        require dirname(__DIR__, 2) . '/database/init_sqlite.php';
                    }
                    self::$pdo = new PDO('sqlite:' . $path, null, null, [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]);
                } else {
                    $dsn = sprintf(
                        'mysql:host=%s;port=%s;dbname=%s;charset=%s',
                        $db['host'],
                        $db['port'],
                        $db['name'],
                        $db['charset']
                    );
                    self::$pdo = new PDO($dsn, $db['user'], $db['password'], [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]);
                    self::$pdo->exec('SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci');
                }
            } catch (PDOException $e) {
                http_response_code(500);
                echo 'Ошибка подключения к базе данных: ' . htmlspecialchars($e->getMessage());
                exit;
            }
        }

        return self::$pdo;
    }
}
