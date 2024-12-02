<?php

namespace App\Infrastructure\Models\Subscription;

use App\Enums\SubscriptionPeriodEnum;
use App\Infrastructure\Models\BaseModel;
use App\Infrastructure\Models\Magazine\Magazine;
use App\Infrastructure\Models\Payment\Payment;
use App\Infrastructure\Models\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends BaseModel
{

   protected $guarded = ['id'];
   protected $fillable = [
      'user_id', 'magazine_id', 'start_date', 'end_date', 'status'
   ];
   protected $casts = [
      'subscription_period' => SubscriptionPeriodEnum::class,
   ];

   public function isExpired(): bool
   {
      return $this->end_date < now();
   }

   public function user(): BelongsTo
   {
      return $this->belongsTo(User::class);
   }

   public function magazine(): BelongsTo
   {
      return $this->belongsTo(Magazine::class);
   }

   public function payments()
   {
      return $this->hasMany(Payment::class);
   }

}
