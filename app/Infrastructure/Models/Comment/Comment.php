<?php

namespace App\Infrastructure\Models\Comment;

use App\Infrastructure\Models\Article\Article;
use App\Infrastructure\Models\BaseModel;
use App\Infrastructure\Models\User\User;

class Comment extends BaseModel
{

   protected $guarded = ['id'];

   public function article()
   {
      return $this->belongsTo(Article::class);
   }

   public function user()
   {
      return $this->belongsTo(User::class);
   }

}
