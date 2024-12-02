<?php

namespace App\Application\DTOs\Magazine;

use App\Application\DTOs\DTO;

class StoreMagazineDTO extends DTO
{

    public static function fromRequest($request): array
    {
        return [
            'name' => $request['name'],
            'description' => $request['description'],
            'date_of_release' => $request['date_of_release'],
        ];
    }

}
