<?php

namespace App\Console\Commands;

use App\Infrastructure\Models\Subscription\Subscription;
use App\Mail\SubscriptionExpiryNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NotifyExpiringSubscriptions extends Command
{
    protected $signature = 'subscriptions:notify-expiry';
    protected $description = 'Notify users about expiring subscriptions';

    public function handle()
    {
        $thresholdDate = Carbon::now()->addDays(5);
        $subscriptions = Subscription::where('end_date', '<=', $thresholdDate)
            ->where('status', 'active')
            ->get();

        foreach ($subscriptions as $subscription) {
            Mail::to($subscription->user->email)->send(
                new SubscriptionExpiryNotification($subscription)
            );
        }

        $this->info('Notifications sent for expiring subscriptions.');
    }
}
