<?php

namespace App\Application\UseCases\Base;

use App\Traits\StringHelper;
use Illuminate\Support\Str;

class MergeStatusesUseCase
{


    public static function execute(array $data, string $status, array $relatedStatuses): array
    {

        $keys = array_flip($relatedStatuses);
        foreach ($data as $key => $value) {
            if(array_key_exists($key,$keys)){

                $value = AddItemToArrayUseCase::execute($value,'tag',self::prepareKey($key));
                $data[$status] = array_merge($data[$status],$value);
            }

        }

        return $data;
    }


    private static function prepareKey($key): string
    {
        $words = explode(' ', $key);
        $capitalizedWords = array_map('ucfirst', $words);

        return implode('_', $capitalizedWords);

    }


}
