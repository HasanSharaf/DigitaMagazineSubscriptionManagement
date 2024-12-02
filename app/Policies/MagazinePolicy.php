<?php

namespace App\Policies;

use App\Enums\UserRoleEnum;
use App\Infrastructure\Models\User\User;

class MagazinePolicy
{
    public function create(User $user): bool
    {
        return in_array($user->role, [UserRoleEnum::PUBLISHER, UserRoleEnum::ADMIN], true);
    }

    public function manage(User $user): bool
    {
        return $user->role === UserRoleEnum::ADMIN;
    }
}
