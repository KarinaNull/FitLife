<?php

declare(strict_types=1);

namespace MyProject\Models;

use MyProject\ActiveRecord\ActiveRecord;
use MyProject\Db;
use PDO;

class User extends ActiveRecord
{
    public string $nickname = '';
    public string $email = '';
    public int $is_confirmed = 0;
    public string $role = 'user';
    public string $password_hash = '';
    public string $auth_token = '';
    public string $created_at = '';

    protected static function getTableName(): string
    {
        return 'users';
    }

    public static function findByNickname(string $nickname): ?self
    {
        $stmt = Db::getConnection()->prepare('SELECT * FROM users WHERE nickname = :nickname LIMIT 1');
        $stmt->execute(['nickname' => $nickname]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? self::mapRow($row) : null;
    }
}
