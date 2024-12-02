<?php

namespace App\Application\UseCases\Comment;

use App\Application\UseCases\Model\StoreModelUseCase;
use App\Infrastructure\Repositories\Comment\CommentRepository;

class StoreCommentUseCase extends StoreModelUseCase
{
    public function __construct(CommentRepository $repository)
    {
        parent::__construct( $repository);
    }

}
