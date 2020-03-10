<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use MongoDB\BSON\ObjectID;
use InvalidArgumentException;

class ObjectIDCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Jenssegers\Mongodb\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return string
     */
    public function get($model, $key, $value, $attributes)
    {
        return (string) $value;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param \Jenssegers\Mongodb\Eloquent\Model $model
     * @param string $key
     * @param array $value
     * @param array $attributes
     * @return string
     * @throws InvalidArgumentException
     */
    public function set($model, $key, $value, $attributes)
    {
        switch ($value){

            case is_string($value):
                return new ObjectID($value);

            case $value instanceof ObjectID:
                return $value;

            default:
                throw new InvalidArgumentException('Invalid object ID passed');

        }
    }
}
