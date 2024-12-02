<?php

namespace App\Helpers;

class StringHelper {

    public static function split($inputString, $delimiter = ',', $returnIndex = 0): string
    {
        $resultArray = explode($delimiter, $inputString);

        return $resultArray[$returnIndex]??'';

    }
}
