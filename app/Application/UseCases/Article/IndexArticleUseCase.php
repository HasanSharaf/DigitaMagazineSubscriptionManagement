<?php

namespace App\Application\UseCases\Article;

use App\Application\UseCases\Model\IndexModelUseCase;
use App\Infrastructure\Repositories\Article\ArticleRepository;

class IndexArticleUseCase extends IndexModelUseCase
{
    public function __construct(ArticleRepository $repository)
    {
        parent::__construct( $repository);
    }
}
