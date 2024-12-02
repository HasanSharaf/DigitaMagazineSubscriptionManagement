<?php

namespace App\Application\UseCases\Base;

class AddSelectAllOptionUseCase
{

    public static function execute(array $data,string $label= 'Select all' , mixed $value= 'selected_all'): array
    {
        array_unshift($data,['label' => $label, 'value' => $value]);
        return $data;
    }
}
