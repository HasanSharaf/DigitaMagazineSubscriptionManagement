<?php

namespace App\Application\UseCases\Base;

use Illuminate\Support\Collection;

class RemoveItemFromCollectionUseCase
{

    public static function execute($data, int $id): Collection
    {

        if (!$data instanceof Collection) {

            $data = collect($data);
        }

        return $data->filter(function ($item) use ($id) {
            return $item['id'] !== $id;
        });
    }
}
