<?php

namespace App\Application\UseCases\Payment;

use App\Application\UseCases\Model\GetModelDetailsUseCase;
use App\Infrastructure\Repositories\Payment\PaymentRepository;

class GetPaymentUseCase extends GetModelDetailsUseCase
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
