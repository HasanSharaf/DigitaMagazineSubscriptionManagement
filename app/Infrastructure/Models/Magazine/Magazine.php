<?php

namespace App\Infrastructure\Models\Magazine;

use App\Infrastructure\Models\Article\Article;
use App\Infrastructure\Models\BaseModel;
use App\Infrastructure\Models\Subscription\Subscription;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Magazine extends BaseModel
{
   use SoftDeletes;

   protected $guarded = ['id'];

   public function subscriptions(): HasMany
   {
      return $this->hasMany(Subscription::class);
   }

   public function articles()
   {
      return $this->hasMany(Article::class);
   }

}
