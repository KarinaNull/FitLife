<?php

declare(strict_types=1);

namespace MyProject\ActiveRecord;

use MyProject\Db;
use PDO;
use ReflectionClass;

abstract class ActiveRecord
{
    public ?int $id = null;

    abstract protected static function getTableName(): string;

    public static function findById(int $id): ?static
    {
        $table = static::getTableName();
        $stmt = Db::getConnection()->prepare("SELECT * FROM {$table} WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? static::mapRow($row) : null;
    }

    /** @return static[] */
    public static function findAll(string $orderBy = 'id DESC'): array
    {
        $table = static::getTableName();
        $stmt = Db::getConnection()->query("SELECT * FROM {$table} ORDER BY {$orderBy}");
        $items = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $items[] = static::mapRow($row);
        }

        return $items;
    }

    public function save(): void
    {
        $properties = $this->getMappedProperties();
        unset($properties['id']);
        $properties = self::filterAutoTimestampFields($properties, $this->id === null);

        if ($this->id === null) {
            $columns = implode(', ', array_keys($properties));
            $placeholders = implode(', ', array_map(static fn ($k) => ':' . $k, array_keys($properties)));
            $sql = 'INSERT INTO ' . static::getTableName() . " ({$columns}) VALUES ({$placeholders})";
            $stmt = Db::getConnection()->prepare($sql);
            $stmt->execute($properties);
            $this->id = (int) Db::getConnection()->lastInsertId();
        } else {
            $sets = [];
            foreach (array_keys($properties) as $column) {
                $sets[] = "{$column} = :{$column}";
            }
            $properties['id'] = $this->id;
            $sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $sets) . ' WHERE id = :id';
            $stmt = Db::getConnection()->prepare($sql);
            $stmt->execute($properties);
        }
    }

    public function delete(): void
    {
        if ($this->id === null) {
            return;
        }

        $stmt = Db::getConnection()->prepare(
            'DELETE FROM ' . static::getTableName() . ' WHERE id = :id'
        );
        $stmt->execute(['id' => $this->id]);
    }

    protected static function mapRow(array $row): static
    {
        $object = new static();
        $reflection = new ReflectionClass($object);

        foreach ($row as $key => $value) {
            if (!$reflection->hasProperty($key)) {
                continue;
            }
            $property = $reflection->getProperty($key);
            $type = $property->getType();
            if ($type && $type->getName() === 'int' && $value !== null && $value !== '') {
                $value = (int) $value;
            }
            $property->setAccessible(true);
            $property->setValue($object, $value);
        }

        return $object;
    }

    /** @param array<string, mixed> $properties */
    private static function filterAutoTimestampFields(array $properties, bool $isInsert): array
    {
        foreach (['created_at', 'updated_at'] as $field) {
            if (!array_key_exists($field, $properties)) {
                continue;
            }
            $value = $properties[$field];
            if ($value === '' || $value === null) {
                unset($properties[$field]);
            }
        }

        if (!$isInsert && array_key_exists('created_at', $properties)) {
            unset($properties['created_at']);
        }

        return $properties;
    }

    /** @return array<string, mixed> */
    private function getMappedProperties(): array
    {
        $reflection = new ReflectionClass($this);
        $properties = [];

        foreach ($reflection->getProperties() as $property) {
            if ($property->isStatic()) {
                continue;
            }
            $name = $property->getName();
            $property->setAccessible(true);
            $properties[$name] = $property->getValue($this);
        }

        return $properties;
    }
}
