<?php

namespace App\Application\UseCases\Auth;

use App\Application\UseCases\Model\DestroyModelUseCase;
use App\Infrastructure\Repositories\Auth\AuthRepository;

class DestroyAuthUseCase extends DestroyModelUseCase
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
