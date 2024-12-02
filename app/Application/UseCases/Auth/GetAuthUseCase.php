<?php

namespace App\Application\UseCases\Auth;

use App\Application\UseCases\Model\GetModelDetailsUseCase;
use App\Infrastructure\Repositories\Auth\AuthRepository;

class GetAuthUseCase extends GetModelDetailsUseCase
{
    public function __construct(AuthRepository $repository)
    {
        parent::__construct( $repository);
    }

    public function setConditions(array $data): void
    {
        $this->conditions = ['id' => $data['id']];
    }
}
