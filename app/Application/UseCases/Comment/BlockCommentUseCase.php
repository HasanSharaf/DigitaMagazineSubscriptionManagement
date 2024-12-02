<?php

namespace App\Application\UseCases\Comment;

use App\Enums\CommentStatusEnum;
use App\Infrastructure\Repositories\Comment\CommentRepository;

class BlockCommentUseCase
{
    protected CommentRepository $repository;

    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id): bool
    {
        $comment = $this->repository->findOrFail($id);

        if (!$comment) {
            throw new \Exception('Comment not found.');
        }

        $comment->update(['status' => CommentStatusEnum::BLOCKED]);
        return true;
    }

}
