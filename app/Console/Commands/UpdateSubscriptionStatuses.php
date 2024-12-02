<?php

namespace App\Console\Commands;

use App\Infrastructure\Models\Subscription\Subscription;
use Illuminate\Console\Command;

class UpdateSubscriptionStatuses extends Command
{
    protected $signature = 'subscriptions:update-statuses';
    protected $description = 'Update subscription statuses based on end date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Subscription::where('end_date', '<', now())
            ->where('status', 'active')
            ->update(['status' => 'expired']);

        $this->info('Subscription statuses updated successfully.');
    }
}
