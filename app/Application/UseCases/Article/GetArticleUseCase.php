<?php

namespace App\Application\UseCases\Article;

use App\Application\UseCases\Model\GetModelDetailsUseCase;
use App\Infrastructure\Repositories\Article\ArticleRepository;

class GetArticleUseCase extends GetModelDetailsUseCase
{
    public function __construct(ArticleRepository $repository)
    {
        parent::__construct( $repository);
    }

    public function setConditions(array $data): void
    {
        $this->conditions = ['id' => $data['id']];
    }
}
