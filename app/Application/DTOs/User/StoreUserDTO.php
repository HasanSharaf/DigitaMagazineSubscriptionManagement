<?php

namespace App\Application\DTOs\User;

use App\Application\DTOs\DTO;

class StoreUserDTO extends DTO
{

    public static function fromRequest($request): array
    {
        return [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'role' => $request['role'],
        ];
    }

}
