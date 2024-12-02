<?php

namespace App\Application\UseCases\Magazine;

use App\Application\UseCases\Model\StoreModelUseCase;
use App\Infrastructure\Repositories\Magazine\MagazineRepository;

class StoreMagazineUseCase extends StoreModelUseCase
{
    public function __construct(MagazineRepository $repository)
    {
        parent::__construct( $repository);
    }

}
