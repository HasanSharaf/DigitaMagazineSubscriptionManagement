<?php

namespace App\Policies;

use App\Enums\UserRoleEnum;
use App\Infrastructure\Models\User\User;

class CommentPolicy
{
    /**
     * Determine if the user can comment on articles.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, [UserRoleEnum::SUBSCRIBER], true);
    }

    /**
     * Determine if the user can moderate comments.
     */
    public function moderate(User $user): bool
    {
        return in_array($user->role, [UserRoleEnum::ADMIN], true);
    }

}
