<?php

declare(strict_types=1);

namespace MyProject\Models;

use MyProject\ActiveRecord\ActiveRecord;

class Contact extends ActiveRecord
{
    public string $last_name = '';
    public string $first_name = '';
    public string $middle_name = '';
    public string $gender = 'male';
    public string $birth_date = '';
    public string $phone = '';
    public string $address = '';
    public string $email = '';
    public string $comment = '';
    public string $created_at = '';

    protected static function getTableName(): string
    {
        return 'contacts';
    }

    public function getFullName(): string
    {
        return trim("{$this->last_name} {$this->first_name} {$this->middle_name}");
    }
}
