<?php

namespace App\HttpServices;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Request;

/**
 * Class BaseService
 * Provides common functionality for making HTTP requests to other services.
 *
 * @package App\HTTPServices
 * @abstract
 * @author Ali Monther | ali.monther97@gmail.com
 */
abstract class BaseService implements ServiceInterface
{
    /**
     * The base URL of the Service.
     *
     * @var string
     */
    protected mixed $baseUrl;


    /**
     * Flag to determine if the service should be accessed directly.
     *
     * @var bool
     */
    protected bool $directAccess = false;

    /**
     * BaseService constructor.
     * Initializes the base URL.
     */
    public function __construct()
    {
        $this->baseUrl = $this->directAccess
            ? $this->getBaseUrl()
            : config('microservice.api_gateway_url').'/api';
    }

    /**
     * Make an HTTP request to the specified path.
     *
     * @param string $method
     * @param string $path
     * @param array $options
     * @return Response
     */
    protected function request(string $method, string $path, array $options = []): Response
    {
        $url = $this->baseUrl . '/' . $this->getServicePrefix() . '/' . ltrim($path, '/');
        
        return Http::withHeaders($this->getHeaders())->$method($url, $options);
    }

    /**
     * Get the headers for the HTTP request.
     *
     * @return array
     */
    protected function getHeaders(): array
    {
        return [
                 'Authorization'=>'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOGRjNzUwMDM3Yjk2MmNkY2E0NWUyYTIwOWE4YTVhNmU1NTI3OTU0OWJmOGU3OWMwZjZmNzRhYzYzMmU4MDVmZGNlYWI5YjI2MmYxYjlmMjgiLCJpYXQiOjE3MTcwNjI5NTEuMDc1MzcxLCJuYmYiOjE3MTcwNjI5NTEuMDc1MzczLCJleHAiOjE3NDg1OTg5NTEuMDcxNjM1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.MZ7p0RIn7L3G_JH7DvmPiOwH_HJJECnFH0UjMU48rCnmUbKvOMzJtC0vn8jqWy7OIEXoIUPgDF7t154nwbWtxLvh1lP5b8lNuhoAAKMTvdMBgRz2kwd6Vfukhz9AaEM-Am6_a0PNPYfKG2Y-6OzxyCGUEYfcwliTvCv5_ToV3d4YVt5mH2ago9c9VrAjDX13uaNLe4Mc2XkjNATUNJnj_ff6aDIoaRxrKCo8rpDu0txMBa1vvI9qV47w_NjFn8HfzlCUXRhbciTU2dOKbMhFweOoTJeu-IvpKz03cCKPZDcQ0Ss8Vk8G_xcmubq7vpafc9nJ1FGhrOKj-j_9nHsprHDzxuuQu57Tp7sSFiup4dDlCWEm0kD0gBl1Hjcd5ARGLQvfg4whoY3KBn2M63ljofGijoANqHd4dGhzk5LXSJhOD24ZMc9VWrF88hJUozGKlch7_UDpJmKI5d9zjzhiyMT84o9h1w9d4yCa4ODk8BClWvybOtRXBJ1mr9v5xhdX_QRiS01n81fiG1ok78tleI1N4zNwyeAL7d5b2I8e-FRyClBffUNVYfPx1x2QLLj_HvtVGMQRSC0pFWEzCigVdVOfy0C-QVXiQ1rPbpH1-RaX4T7Cyv8YnFwQ1LNxweB-Hpi9w-afb9TbO-SQOH503BkLkwXw7QMgWqcrjSs2wwM',
                 'Subdomain'=> Request::header('Subdomain') ?? 'dev',
        ];
    }

    /**
     * Get the service-specific URL prefix.
     *
     * @return string
     */
    abstract protected function getServicePrefix(): string;

    /**
     * Send a GET request.
     *
     * @param string $path
     * @param array $query
     * @return Response
     */
    public function get(string $path, array $query = []): Response
    {
        return $this->request('get', $path, ['query' => $query]);
    }

    /**
     * Send a POST request.
     *
     * @param string $path
     * @param array $data
     * @return Response
     */
    public function post(string $path, array $data = []): Response
    {
        return $this->request('post', $path, ['json' => $data]);
    }

    /**
     * Send a PUT request.
     *
     * @param string $path
     * @param array $data
     * @return Response
     */
    public function put(string $path, array $data = []): Response
    {
        return $this->request('put', $path, ['json' => $data]);
    }

    /**
     * Send a DELETE request.
     *
     * @param string $path
     * @return Response
     */
    public function delete(string $path): Response
    {
        return $this->request('delete', $path);
    }

    /**
     * Get the service-specific base URL.
     *
     * @return string
     */
    protected function getBaseUrl(): string
    {
        return '';
    }

}
