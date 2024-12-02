<?php

namespace App\Application\UseCases\Subscription;

use App\Application\UseCases\Model\StoreModelUseCase;
use App\Infrastructure\Repositories\Subscription\SubscriptionRepository;

class StoreSubscriptionUseCase extends StoreModelUseCase
{
    public function __construct(SubscriptionRepository $repository)
    {
        parent::__construct( $repository);
    }

}
