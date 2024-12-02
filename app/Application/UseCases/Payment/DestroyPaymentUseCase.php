<?php

namespace App\Application\UseCases\Payment;

use App\Application\UseCases\Model\DestroyModelUseCase;
use App\Infrastructure\Repositories\Payment\PaymentRepository;

class DestroyPaymentUseCase extends DestroyModelUseCase
{
    public function __construct(PaymentRepository $repository)
    {
        parent::__construct( $repository);
    }

    public function setConditions(array $data): void
    {
        $this->conditions = ['id' => $data['id']];
    }
}
