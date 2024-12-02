<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

class MicroService
{
    public static function getServiceToken(){
        $service_token_key = config('microservice.cache_key');
        return Cache::get($service_token_key,'');
    }
    public static function getMicroserviceApiPrefix(){
        return config('microservice.service_name').config('microservice.service_instance');
    }

    public static function getMicroserviceName(){
        return config('microservice.service_name');
    }

    public static function getMicroserviceDbPrefix(){
        return config('microservice.service_name').'_';
    }
}
