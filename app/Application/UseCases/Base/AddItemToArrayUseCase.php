<?php

namespace App\Application\UseCases\Base;

class AddItemToArrayUseCase
{
    public static function execute(array $data, $newKey, $newValue): array
    {
        for ($i = 0; $i < count($data) ; $i++)
                $data[$i][$newKey] = $newValue;
        return $data;
    }

}
