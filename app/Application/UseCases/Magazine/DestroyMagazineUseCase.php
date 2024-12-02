<?php

namespace App\Application\UseCases\Magazine;

use App\Application\UseCases\Model\DestroyModelUseCase;
use App\Infrastructure\Repositories\Magazine\MagazineRepository;

class DestroyMagazineUseCase extends DestroyModelUseCase
{
    public function __construct(MagazineRepository $repository)
    {
        parent::__construct( $repository);
    }

    public function setConditions(array $data): void
    {
        $this->conditions = ['id' => $data['id']];
    }
}
