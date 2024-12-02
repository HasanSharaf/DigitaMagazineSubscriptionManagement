<?php

namespace App\Application\UseCases\Magazine;

use App\Application\UseCases\Model\IndexModelUseCase;
use App\Infrastructure\Repositories\Magazine\MagazineRepository;

class IndexMagazineUseCase extends IndexModelUseCase
{
    public function __construct(MagazineRepository $repository)
    {
        parent::__construct( $repository);
    }
}
