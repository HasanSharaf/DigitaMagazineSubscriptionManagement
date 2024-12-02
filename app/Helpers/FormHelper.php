<?php

namespace App\Helpers;

class FormHelper {

    public static function buildExtraColumnsArray($extraColumnsIndexes){
        $extraColumns = [];
        foreach ($extraColumnsIndexes as $key => $value){
            $extraColumns[] = [
                'field_name' =>  $key,
                'field_value' => $value
            ];
        }
        return $extraColumns;

    }
}
