<?php

namespace App\Console\Commands;

use App\Enums\SubscriptionStatusEnum;
use App\Infrastructure\Models\Subscription\Subscription;
use App\Infrastructure\Repositories\Subscription\SubscriptionRepository;
use Illuminate\Console\Command;

class ExpireSubscriptions extends Command
{
    protected $signature = 'subscriptions:expire';
    protected $description = 'Check and mark expired subscriptions';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $expiredSubscriptions = Subscription::where('end_date', '<', now())
                                             ->where('status', SubscriptionStatusEnum::ACTIVE)
                                             ->get();

        if ($expiredSubscriptions->isEmpty()) {
            $this->info('No expired subscriptions found.');
            return;
        }

        foreach ($expiredSubscriptions as $subscription) {
            $subscription->update(['status' => SubscriptionStatusEnum::EXPIRED]);
        }

        $this->info('Expired subscriptions processed successfully.');
    }
}
