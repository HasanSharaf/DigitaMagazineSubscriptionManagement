<?php
namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class HttpClient
{
    public static function send($url,$method,$header=[],$query=[],$json=[],$microServiceToken=''){
        return Http::withHeaders($header)
            ->withOptions([
                'query' => $query,
                'json' => $json,
            ])
            ->send($method, $url);
    }

    /**
    * @throws GuzzleException
    */
    public static function sendGuzzlePostRequest($url, $body = [], $headers=[]): \Illuminate\Http\JsonResponse
    {
        $client = new Client();
        $postResponse = $client->post($url,['headers' => $headers, 'json' => $body]);
        $responseCode = $postResponse->getStatusCode();
        return response()->json(['response_code' => $responseCode]);
    }
}
