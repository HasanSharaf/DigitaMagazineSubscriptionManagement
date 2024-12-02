<?php

namespace App\Application\UseCases\Base;

use Illuminate\Support\Collection;
class AddItemToCollectionUseCase
{
    public static function execute($data, $newItem,$inFirstPlace= true)
    {
        if (!$data instanceof Collection) {
            $data = collect($data);
        }
        if ($inFirstPlace)
            $data->prepend($newItem);
        else
            $data->push($newItem);

        return $data;

    }
}
