<?php

namespace App\Application\DTOs\Comment;

use App\Application\DTOs\DTO;
use App\Enums\CommentStatusEnum;

class StoreCommentDTO extends DTO
{

    public static function fromRequest($request): array
    {
        return [
            'article_id' => $request['article_id'],
            'user_id' => $request['user_id'],
            'content' => $request['content'],
            'status' => CommentStatusEnum::APPROVED,
        ];
    }

}
