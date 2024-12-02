<?php

namespace App\Application\UseCases\Subscription;

use App\Application\UseCases\Model\DestroyModelUseCase;
use App\Infrastructure\Repositories\Subscription\SubscriptionRepository;

class DestroySubscriptionUseCase extends DestroyModelUseCase
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
