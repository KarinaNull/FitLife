<?php

declare(strict_types=1);

$dbPath = __DIR__ . '/fitlife.sqlite';
$sqlFile = __DIR__ . '/schema.sqlite.sql';

if (!extension_loaded('pdo_sqlite')) {
    fwrite(STDERR, "Расширение pdo_sqlite не установлено.\n");
    exit(1);
}

$pdo = new PDO('sqlite:' . $dbPath);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec(file_get_contents($sqlFile));

if (PHP_SAPI === 'cli' && realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === realpath(__FILE__)) {
    echo "SQLite база создана: {$dbPath}\n";
}
