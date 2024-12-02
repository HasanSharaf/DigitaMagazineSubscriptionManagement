<?php

namespace App\Application\UseCases\Article;

use App\Application\UseCases\Model\DestroyModelUseCase;
use App\Infrastructure\Repositories\Article\ArticleRepository;

class DestroyArticleUseCase extends DestroyModelUseCase
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
