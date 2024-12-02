<?php

namespace App\Infrastructure\Repositories\Subscription;

use App\Enums\SubscriptionStatusEnum;
use App\Infrastructure\Models\Subscription\Subscription;
use App\Infrastructure\Repositories\Base\BaseRepository;
use App\Infrastructure\Repositories\Base\EloquentBaseRepository;
use Illuminate\Database\Eloquent\Collection;

class EloquentSubscriptionRepository extends EloquentBaseRepository implements SubscriptionRepository
{
    public function getExpiredSubscriptions(): Collection
    {
        return Subscription::where('end_date', '<', now())
                           ->where('status', SubscriptionStatusEnum::ACTIVE)
                           ->get();
    }
}

