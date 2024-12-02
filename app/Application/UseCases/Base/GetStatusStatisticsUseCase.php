<?php

namespace App\Application\UseCases\Base;

class GetStatusStatisticsUseCase
{

    public static function execute(array $items, array $statuses): array
    {
        $statistics = [];
        foreach ($statuses as $status)
            $statistics[$status] = count($items[$status]);

        return $statistics;
    }
}
