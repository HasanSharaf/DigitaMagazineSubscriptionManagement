<?php

namespace App\Application\UseCases\Base;

use App\Http\Resources\FileResource;
use App\Utilities\Files\FileUrlUtility;

class CastFilesFromStringToArrayUseCase
{

    public static function execute($files): array
    {
        $filesArray =explode(',', $files);
        foreach ($filesArray as $file){
            $filesArray[] = self::formatFile($file);
        }

        return $filesArray;
    }

    private static function formatFile($file): array
    {
        return [
        'id'=> null,
        'file_name' => '',
        'file_url' => FileUrlUtility::attachBaseUrl($file)
    ];
    }
}
