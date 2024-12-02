<?php

namespace App\Application\UseCases\Comment;

use App\Application\UseCases\Model\DestroyModelUseCase;
use App\Infrastructure\Repositories\Comment\CommentRepository;

class DestroyCommentUseCase extends DestroyModelUseCase
{
    public function __construct(CommentRepository $repository)
    {
        parent::__construct( $repository);
    }

    public function setConditions(array $data): void
    {
        $this->conditions = ['id' => $data['id']];
    }
}
