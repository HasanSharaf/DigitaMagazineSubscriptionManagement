<?php

namespace App\Application\UseCases\Auth;

use App\Application\UseCases\Model\UpdateModelUseCase;
use App\Infrastructure\Repositories\Auth\AuthRepository;

class UpdateAuthUseCase extends UpdateModelUseCase
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
