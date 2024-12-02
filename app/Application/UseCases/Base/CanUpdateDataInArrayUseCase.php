<?php

namespace App\Application\UseCases\Base;

class CanUpdateDataInArrayUseCase
{

    public static function execute(array $data): bool
    {
        return count($data) > 0;
    }
}
