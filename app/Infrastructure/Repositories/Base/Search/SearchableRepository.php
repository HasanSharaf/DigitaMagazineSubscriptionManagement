<?php

namespace App\Infrastructure\Repositories\Base\Search;

interface SearchableRepository
{
    public function search(string $keyword,
                           array $columns,
                           string $condition = 'like',
                           ?array $with = null,
                           array $order = null,
                           array $columnsToSelect = ['*'] ,
                           ?int $perPage = null);
}
