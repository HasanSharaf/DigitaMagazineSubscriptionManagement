<?php

namespace App\Policies;

use App\Enums\UserRoleEnum;
use App\Infrastructure\Models\Article\Article;
use App\Infrastructure\Models\User\User;

class ArticlePolicy
{
    /**
     * Determine if the user can create an article.
     */
    public function create(User $user): bool
    {
        return $user->role === UserRoleEnum::PUBLISHER || $user->role === UserRoleEnum::ADMIN;
    }

    /**
     * Determine if the user can comment on articles.
     */
    public function comment(User $user): bool
    {
        return $user->role === UserRoleEnum::SUBSCRIBER;
    }

    /**
     * Determine if the user can view articles.
     */
    public function view(User $user, Article $article): bool
    {
        return $user->subscriptions()->active()->exists();
    }
}
