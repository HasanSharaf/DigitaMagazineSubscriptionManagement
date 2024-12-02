<?php

namespace App\Application\UseCases\Article;

use App\Application\UseCases\Model\StoreModelUseCase;
use App\Infrastructure\Repositories\Article\ArticleRepository;

class StoreArticleUseCase extends StoreModelUseCase
{
    public function __construct(ArticleRepository $repository)
    {
        parent::__construct( $repository);
    }

}
