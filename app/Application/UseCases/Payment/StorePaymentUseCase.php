<?php

namespace App\Application\UseCases\Payment;

use App\Application\UseCases\Model\StoreModelUseCase;
use App\Infrastructure\Repositories\Payment\PaymentRepository;

class StorePaymentUseCase extends StoreModelUseCase
{
    public function __construct(PaymentRepository $repository)
    {
        parent::__construct( $repository);
    }

}
