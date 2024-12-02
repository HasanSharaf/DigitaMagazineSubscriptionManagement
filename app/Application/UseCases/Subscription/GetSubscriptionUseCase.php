<?php

namespace App\Application\UseCases\Subscription;

use App\Application\UseCases\Model\GetModelDetailsUseCase;
use App\Infrastructure\Repositories\Subscription\SubscriptionRepository;

class GetSubscriptionUseCase extends GetModelDetailsUseCase
{
    public function __construct(SubscriptionRepository $repository)
    {
        parent::__construct( $repository);
    }

    public function setConditions(array $data): void
    {
        $this->conditions = ['id' => $data['id']];
    }
}
