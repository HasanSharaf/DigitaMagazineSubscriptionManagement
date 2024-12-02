<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Infrastructure\Models\Article\Article;
use App\Infrastructure\Models\Comment\Comment;
use App\Infrastructure\Models\Magazine\Magazine;
use App\Infrastructure\Models\Subscription\Subscription;
use App\Infrastructure\Models\User\User;
use App\Policies\ArticlePolicy;
use App\Policies\CommentPolicy;
use App\Policies\MagazinePolicy;
use App\Policies\SubscriptionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Magazine::class => MagazinePolicy::class,
        Article::class => ArticlePolicy::class,
        Comment::class => CommentPolicy::class,
        Subscription::class => SubscriptionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
