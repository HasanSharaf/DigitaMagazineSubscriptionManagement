<?php

namespace App\Policies;

use App\Enums\UserRoleEnum;
use App\Infrastructure\Models\User\User;

class SubscriptionPolicy
{
    public function manage(User $user): bool
    {
        return in_array($user->role, [UserRoleEnum::ADMIN], true);
    }

    /**
     * Determine if the user can create a subscription.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, [UserRoleEnum::SUBSCRIBER], true);
    }
}
