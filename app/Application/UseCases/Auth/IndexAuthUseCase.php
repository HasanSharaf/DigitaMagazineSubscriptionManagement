<?php

namespace App\Application\UseCases\Auth;

use App\Application\UseCases\Model\IndexModelUseCase;
use App\Infrastructure\Repositories\Auth\AuthRepository;

class IndexAuthUseCase extends IndexModelUseCase
{
    public function __construct(AuthRepository $repository)
    {
        parent::__construct( $repository);
    }
}
