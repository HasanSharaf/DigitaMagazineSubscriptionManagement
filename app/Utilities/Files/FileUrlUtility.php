<?php

namespace App\Utilities\Files;

class FileUrlUtility
{
    /**
     * The base URL for the file server.
     *
     * @var string
     */
    private static string $baseUrl;

    /**
     * Initialize the base URL from the configuration.
     */
    public static function initialize(): void
    {
        self::$baseUrl = config('app.file_server_base_url');
    }

    /**
     * Get the base URL.
     *
     * @return string
     */
    public static function getBaseUrl(): string
    {
        // Make sure the base URL is initialized
        if (empty(self::$baseUrl)) {
            self::initialize();
        }

        return self::$baseUrl;
    }

    /**
     * Attach the base URL to the beginning of the file URL.
     *
     * @param string|null $fileUrl
     * @return string
     */
    public static function attachBaseUrl(string $fileUrl = null): string
    {

        // Use the getBaseUrl method to access the base URL
        return $fileUrl ? self::getBaseUrl() . "/" . $fileUrl : '';
    }

    /**
     * Trim the base URL from the beginning of the file URL.
     * if the file URL does not contain the base URL, return the file URL as is.
     *
     * @param string $fileUrl
     * @return string
     */
    public static function trimBaseUrl(string $fileUrl): string
    {
        // Use the getBaseUrl method to access the base URL
        $baseUrl = self::getBaseUrl();

        // Ensure that $baseUrl ends with a slash
        $baseUrl = rtrim($baseUrl, '/') . '/';

        // if the file URL does not contain the base URL, return the file URL as is
        if (!str_contains($fileUrl, $baseUrl)) {
            return $fileUrl;
        }

        // if the file URL contains the base URL, remove it
        return str_replace($baseUrl, '', $fileUrl);
    }
}
