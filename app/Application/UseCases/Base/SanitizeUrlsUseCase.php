<?php

namespace App\Application\UseCases\Base;

use App\Utilities\Files\FileUrlUtility;

class SanitizeUrlsUseCase
{

    public static function execute(array $urls): array
    {
        $baseUrl = FileUrlUtility::getBaseUrl();
        return array_map(function ($url) use ($baseUrl) {
            if (str_contains($url, $baseUrl))
                $url = str_replace($baseUrl, '', $url);

            return $url;
        }, $urls);
    }
}
