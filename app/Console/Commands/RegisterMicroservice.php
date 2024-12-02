<?php

namespace App\Console\Commands;

use App\Helpers\HttpClient;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Psy\Util\Str;

class RegisterMicroservice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:register-microservice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $token = \Illuminate\Support\Str::random(20);
        $service_token_key = config('microservice.cache_key');
        Cache::forget($service_token_key);
        Cache::put($service_token_key,$token);
        $serviceName = config('microservice.service_name');
        $apiPrefix = config('microservice.service_name').config('microservice.service_instance');
        $serviceInstance = config('microservice.service_instance');
        $url = config('microservice.api_gateway_url').'/api/register-microservice/'.$serviceName.'/'.$apiPrefix.'/'.$serviceInstance;
        $response = HttpClient::send($url,'post',['X-TOKEN'=>$token,'X-APPURL'=>config('app.url')]);
        Log::info($response);
    }
}
