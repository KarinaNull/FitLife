<?php

declare(strict_types=1);

namespace MyProject\Models;

use MyProject\ActiveRecord\ActiveRecord;

class FeedbackMessage extends ActiveRecord
{
    public string $name = '';
    public string $email = '';
    public string $subject = '';
    public string $message = '';
    public string $created_at = '';

    protected static function getTableName(): string
    {
        return 'feedback_messages';
    }
}
