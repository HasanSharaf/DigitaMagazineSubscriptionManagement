<?php

return [
    'api_gateway_url' => env('API_GATE_WAY_URL', 'http://auth.techtoks.com'),
    'cache_key'=>env('MICROSERVICE_CACHE_KEY', 'service_token_key'),
    'service_name'=>env('SERVICE_NAME', ''),
    'service_instance'=>env('SERVICE_INSTANCE', 1),
    'api_prefix'=>env('API_PREFIX', ''),
    'services'=>[
        'log_service'=>env('LOG_SERVICE', 'http://127.0.0.1:8001')
    ],
];
