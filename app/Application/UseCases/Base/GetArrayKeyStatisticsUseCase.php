<?php

namespace App\Application\UseCases\Base;

class GetArrayKeyStatisticsUseCase
{

    /**
     * @param array $data
     * @param string $key
     * @return int[]
     */
    public static function execute(array $data, string $key):array
    {

        $values = self::extractValuesForTheSpecifiedKey($data, $key);
        return self::constructAndReturnTheStatisticsArray($key, count($data),self::countTrueItems($values));
    }

    /**
     * @param array $data
     * @return int
     */
    private static function countTrueItems(array $data): int {
        return array_sum(array_map(function ($item) {
            return $item === true ? 1 : 0;
        }, $data));
    }

    /**
     * @param array $data
     * @param string $key
     * @return array
     */
    private static function extractValuesForTheSpecifiedKey(array $data, string $key): array {
        return array_map(function ($item) use ($key) {
            return $item[$key] ?? null;
        }, $data);
    }

    /**
     * @param string $key
     * @param int $totalItems
     * @param int $trueItems
     * @return int[]
     */
    private static function constructAndReturnTheStatisticsArray(string $key, int $totalItems, int $trueItems): array
    {
        return [
            'total_items' => $totalItems,
            "{$key}_true_count" => $trueItems,
            "{$key}_false_count" => $totalItems - $trueItems,
        ];
    }
}
