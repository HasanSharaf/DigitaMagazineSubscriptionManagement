<?php

namespace App\Application\UseCases\Base;

use Illuminate\Support\Facades\Request;

class GetKeyFromHeaderUseCase
{
    public static function execute($key): array|string|null
    {
        return Request::header($key);
    }

}
