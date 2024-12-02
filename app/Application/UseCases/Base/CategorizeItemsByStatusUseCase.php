<?php

namespace App\Application\UseCases\Base;

class CategorizeItemsByStatusUseCase
{

    /**
     * @param $data
     * @param array $defaultStatuses
     * @return array
     */
    public static function execute($data, array $defaultStatuses, ?string $flag = null): array
    {
        $data = self::addFlag($data, $flag);

        $categorizedItems = self::setCategorizedItems($data);
        return self::handleDefaultStatuses($categorizedItems,$defaultStatuses);
    }


    /**
     * @param array $data
     * @return mixed
     */
    private static function setCategorizedItems(array $data):array
    {
        return array_reduce($data, function ($carry, $item){
            $status = $item['status'] ?? 'Unknown';
            $carry[$status][] = $item;
            return $carry;
        }, []);
    }

    private static function handleDefaultStatuses($data,$defaultStatuses): array
    {
        foreach ($defaultStatuses as $defaultStatus) {
            $data[$defaultStatus] ??= [];
        }

        return $data;
    }

    private static function addFlag(array &$data, ?string $flag = null): array
    {
        if (!$flag)
            return $data;
        for ($i = 0 ; $i<count($data) ; $i++)
            $data[$i]['flag'] = $flag;

        return $data;
    }
}
