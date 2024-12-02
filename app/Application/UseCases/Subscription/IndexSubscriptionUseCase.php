<?php

namespace App\Application\UseCases\Subscription;

use App\Application\UseCases\Model\IndexModelUseCase;
use App\Infrastructure\Repositories\Subscription\SubscriptionRepository;

class IndexSubscriptionUseCase extends IndexModelUseCase
{
    public function __construct(SubscriptionRepository $repository)
    {
        parent::__construct( $repository);
    }
}
