<?php

namespace App\Infrastructure\Models\Payment;

use App\Infrastructure\Models\BaseModel;
use App\Infrastructure\Models\Subscription\Subscription;
use App\Infrastructure\Models\User\User;

class Payment extends BaseModel
{

   protected $guarded = ['id'];

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function subscription()
   {
      return $this->belongsTo(Subscription::class);
   }

}
