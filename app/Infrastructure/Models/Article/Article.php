<?php

namespace App\Infrastructure\Models\Article;

use App\Infrastructure\Models\BaseModel;
use App\Infrastructure\Models\Comment\Comment;
use App\Infrastructure\Models\Magazine\Magazine;

class Article extends BaseModel
{

   protected $guarded = ['id'];

   public function magazine()
   {
      return $this->belongsTo(Magazine::class);
   }

   public function comments()
   {
      return $this->hasMany(Comment::class);
   }

}
