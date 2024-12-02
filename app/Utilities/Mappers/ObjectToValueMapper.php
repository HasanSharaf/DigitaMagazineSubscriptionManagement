<?php

namespace App\Utilities\Mappers;

class ObjectToValueMapper
{
    public static function mapArray(array $objects, string $key): array
    {
        return array_map(function ($value) use ($key) {
            return $value[$key];
        }, $objects);
    }
}
