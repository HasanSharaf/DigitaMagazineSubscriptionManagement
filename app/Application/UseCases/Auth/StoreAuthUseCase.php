<?php

namespace App\Application\UseCases\Auth;

use App\Application\UseCases\Model\StoreModelUseCase;
use App\Infrastructure\Repositories\Auth\AuthRepository;

class StoreAuthUseCase extends StoreModelUseCase
{
    public function __construct(AuthRepository $repository)
    {
        parent::__construct( $repository);
    }

}
