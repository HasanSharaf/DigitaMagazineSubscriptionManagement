<?php

namespace App\Application\DTOs\Article;

use App\Application\DTOs\DTO;

class StoreArticleDTO extends DTO
{

    public static function fromRequest($request): array
    {
        return [
            'title' => $request['title'],
            'content' => $request['content'],
            'magazine_id' => $request['magazine_id'],
            'published_at' => $request['published_at'],
        ];
    }

}
