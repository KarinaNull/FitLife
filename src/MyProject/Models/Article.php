<?php

declare(strict_types=1);

namespace MyProject\Models;

use MyProject\ActiveRecord\ActiveRecord;
use MyProject\Db;
use PDO;

class Article extends ActiveRecord
{
    public int $author_id = 0;
    public string $name = '';
    public string $text = '';
    public string $created_at = '';
    public ?string $updated_at = null;

    protected static function getTableName(): string
    {
        return 'articles';
    }

    /** @return Article[] */
    public static function findAllWithAuthors(): array
    {
        return self::findAll('created_at DESC');
    }

    public function getAuthor(): ?User
    {
        return User::findById($this->author_id);
    }
}
