<?php

declare(strict_types=1);

namespace MyProject\Models;

use MyProject\ActiveRecord\ActiveRecord;
use MyProject\Db;
use PDO;

class Comment extends ActiveRecord
{
    public int $author_id = 0;
    public int $article_id = 0;
    public string $text = '';
    public string $created_at = '';

    protected static function getTableName(): string
    {
        return 'comments';
    }

    /** @return Comment[] */
    public static function findByArticleId(int $articleId): array
    {
        $stmt = Db::getConnection()->prepare(
            'SELECT * FROM comments WHERE article_id = :article_id ORDER BY created_at ASC'
        );
        $stmt->execute(['article_id' => $articleId]);
        $items = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $items[] = self::mapRow($row);
        }

        return $items;
    }

    public function getAuthor(): ?User
    {
        return User::findById($this->author_id);
    }
}
