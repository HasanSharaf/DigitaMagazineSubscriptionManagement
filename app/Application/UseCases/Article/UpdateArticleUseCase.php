<?php

namespace App\Application\UseCases\Article;

use App\Application\UseCases\Model\UpdateModelUseCase;
use App\Infrastructure\Repositories\Article\ArticleRepository;

class UpdateArticleUseCase extends UpdateModelUseCase
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
