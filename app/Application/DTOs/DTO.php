<?php

namespace App\Application\DTOs;

use Illuminate\Support\Facades\Request;

abstract class DTO
{

    /**
     * Create an array of DTO instances from the given request data.
     *
     * @param Request|array $requestData
     * @param string $dtoClass
     * @return array
     */
    protected static function createDTOArray($requestData, string $dtoClass): array
    {
        $dtoArray = [];

        foreach ($requestData as $data) {

            $dtoArray[] = $dtoClass::fromRequest($data);
        }

        return $dtoArray;
    }
    protected static function createDTOArrayWithKey($requestData, string $dtoClass,string $key): array
    {
        $dtoArray = [];

        foreach ($requestData as $data) {

            $dtoArray[] = $dtoClass::fromRequest($data[$key]);
        }

        return $dtoArray;
    }

    public static function removeNullValues($data): array
    {
        return array_filter($data, function ($value) {
            return $value !== null;
        });
    }
}
