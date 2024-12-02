<?php

namespace App\Jobs;

use App\Infrastructure\Models\Subscription\Subscription;
use App\Mail\SubscriptionReminder;
use Illuminate\Bus\Queueable;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendSubscriptionReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $subscriptions = Subscription::where('status', 'active')
        ->whereBetween('end_date', [now(), now()->addDays(7)])
        ->get();

        foreach ($subscriptions as $subscription) {
            Mail::to($subscription->user->email)->send(new SubscriptionReminder($subscription));
        }
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new SendSubscriptionReminder)->daily();
    }
}
