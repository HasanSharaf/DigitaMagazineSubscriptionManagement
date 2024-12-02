<?php

namespace App\Application\UseCases\Base;

class GroupItemsByStatusUseCase
{

    public static function execute($arrays):array
    {
        $statusArrays = [];

        foreach ($arrays as $array) {
            foreach ($array as $status => $items) {
                if (!isset($statusArrays[$status])) {
                    $statusArrays[$status] = [];
                }
                foreach ($items as $item) {
                    $statusArrays[$status][] = $item;
                }
            }
        }

        return $statusArrays;
    }
}
