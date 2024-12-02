<?php

namespace App\Application\UseCases\Payment;

use App\Application\UseCases\Model\IndexModelUseCase;
use App\Infrastructure\Repositories\Payment\PaymentRepository;

class IndexPaymentUseCase extends IndexModelUseCase
{
    public function __construct(PaymentRepository $repository)
    {
        parent::__construct( $repository);
    }
}
