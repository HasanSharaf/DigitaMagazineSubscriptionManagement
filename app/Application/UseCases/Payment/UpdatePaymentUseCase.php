<?php

namespace App\Application\UseCases\Payment;

use App\Application\UseCases\Model\UpdateModelUseCase;
use App\Infrastructure\Repositories\Payment\PaymentRepository;

class UpdatePaymentUseCase extends UpdateModelUseCase
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
