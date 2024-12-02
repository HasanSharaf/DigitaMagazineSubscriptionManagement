<?php

namespace App\Application\UseCases\Comment;

use App\Application\UseCases\Model\IndexModelUseCase;
use App\Infrastructure\Repositories\Comment\CommentRepository;

class IndexCommentUseCase extends IndexModelUseCase
{
    public function __construct(CommentRepository $repository)
    {
        parent::__construct( $repository);
    }
}
