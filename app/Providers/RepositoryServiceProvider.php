<?php


namespace App\Providers;

use App\Infrastructure\Models\ActivityLog\ActivityLog;
use App\Infrastructure\Models\Article\Article;
use App\Infrastructure\Models\Auth\Auth;
use App\Infrastructure\Models\Comment\Comment;
use App\Infrastructure\Models\Magazine\Magazine;
use App\Infrastructure\Models\Payment\Payment;
use App\Infrastructure\Models\Subscription\Subscription;
use App\Infrastructure\Models\User\User;
use App\Infrastructure\Repositories\ActivityLog\ActivityLogRepository;
use App\Infrastructure\Repositories\ActivityLog\EloquentActivityLogRepository;
use App\Infrastructure\Repositories\Article\ArticleRepository;
use App\Infrastructure\Repositories\Article\EloquentArticleRepository;
use App\Infrastructure\Repositories\Auth\AuthRepository;
use App\Infrastructure\Repositories\Auth\EloquentAuthRepository;
use App\Infrastructure\Repositories\Comment\CommentRepository;
use App\Infrastructure\Repositories\Comment\EloquentCommentRepository;
use App\Infrastructure\Repositories\Magazine\EloquentMagazineRepository;
use App\Infrastructure\Repositories\Magazine\MagazineRepository;
use App\Infrastructure\Repositories\Payment\EloquentPaymentRepository;
use App\Infrastructure\Repositories\Payment\PaymentRepository;
use App\Infrastructure\Repositories\Subscription\EloquentSubscriptionRepository;
use App\Infrastructure\Repositories\Subscription\SubscriptionRepository;
use App\Infrastructure\Repositories\User\EloquentUserRepository;
use App\Infrastructure\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function boot(): void
    {

        $this->app->bind(UserRepository::class, function () {
            return new EloquentUserRepository(new User());
        });

        $this->app->bind(MagazineRepository::class, function () {
            return new EloquentMagazineRepository(new Magazine());
        });

        $this->app->bind(SubscriptionRepository::class, function () {
            return new EloquentSubscriptionRepository(new Subscription());
        });

        $this->app->bind(PaymentRepository::class, function () {
            return new EloquentPaymentRepository(new Payment());
        });

        $this->app->bind(ArticleRepository::class, function () {
            return new EloquentArticleRepository(new Article());
        });

        $this->app->bind(CommentRepository::class, function () {
            return new EloquentCommentRepository(new Comment());
        });

        $this->app->bind(AuthRepository::class, function () {
            return new EloquentAuthRepository(new Auth());
        });

        $this->app->bind(ActivityLogRepository::class, function () {
            return new EloquentActivityLogRepository(new ActivityLog());
        });
        
        
    }
}
