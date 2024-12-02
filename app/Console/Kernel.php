<?php

namespace App\Console;

use App\Http\Controllers\Subscription\SubscriptionController;
use App\Jobs\SendSubscriptionReminder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    // protected function schedule(Schedule $schedule): void
    // {
    //     // $schedule->command('inspire')->hourly();
    //     $schedule->call(function () {
    //         app(SubscriptionController::class)->updateStatuses();
    //     })->daily();
    // }
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('subscriptions:notify-expiry')->daily();
        $schedule->command('subscriptions:update-statuses')->daily();
        $schedule->command('subscriptions:expire')->daily();
        $schedule->command('admin:send-report')->weekly();
        $schedule->job(new SendSubscriptionReminder)->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
