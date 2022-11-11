<?php

namespace LaravelDm8\Dm8\Validation;

use Illuminate\Validation\DatabasePresenceVerifier;
use LaravelDm8\Dm8\Dm8Connection;

class Dm8DatabasePresenceVerifier extends DatabasePresenceVerifier
{
    /**
     * Count the number of objects in a collection having the given value.
     *
     * @param  string  $collection
     * @param  string  $column
     * @param  string  $value
     * @param  int|null  $excludeId
     * @param  string|null  $idColumn
     * @param  array  $extra
     * @return int
     */
    public function getCount($collection, $column, $value, $excludeId = null, $idColumn = null, array $extra = [])
    {
        $connection = $this->table($collection)->getConnection();

        if (! $connection instanceof Dm8Connection) {
            return parent::getCount($collection, $column, $value, $excludeId, $idColumn, $extra);
        }

        $connection->useCaseInsensitiveSession();
        $count = parent::getCount($collection, $column, $value, $excludeId, $idColumn, $extra);
        $connection->useCaseSensitiveSession();

        return $count;
    }

    /**
     * Count the number of objects in a collection with the given values.
     *
     * @param  string  $collection
     * @param  string  $column
     * @param  array  $values
     * @param  array  $extra
     * @return int
     */
    public function getMultiCount($collection, $column, array $values, array $extra = [])
    {
        $connection = $this->table($collection)->getConnection();

        if (! $connection instanceof Dm8Connection) {
            return parent::getMultiCount($collection, $column, $values, $extra);
        }

        $connection->useCaseInsensitiveSession();
        $count = parent::getMultiCount($collection, $column, $values, $extra);
        $connection->useCaseSensitiveSession();

        return $count;
    }
}
