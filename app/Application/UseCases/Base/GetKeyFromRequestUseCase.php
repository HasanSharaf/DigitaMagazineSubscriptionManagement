<?php

namespace App\Application\UseCases\Base;

use Illuminate\Support\Facades\Request;

class GetKeyFromRequestUseCase
{
    public static function execute($key){
        return Request::get($key);
    }

}
