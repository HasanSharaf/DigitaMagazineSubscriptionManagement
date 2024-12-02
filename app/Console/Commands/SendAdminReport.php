<?php

namespace App\Console\Commands;

use App\Infrastructure\Repositories\Payment\PaymentRepository;
use App\Infrastructure\Repositories\Subscription\SubscriptionRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendAdminReport extends Command
{
    protected $signature = 'admin:send-report';
    protected $description = 'Send a periodic report to the admin';

    protected SubscriptionRepository $subscriptionRepository;
    protected PaymentRepository $paymentRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository, PaymentRepository $paymentRepository)
    {
        parent::__construct();
        $this->subscriptionRepository = $subscriptionRepository;
        $this->paymentRepository = $paymentRepository;
    }

    public function handle()
    {
        $activeSubscriptions = $this->subscriptionRepository->getActiveSubscriptions();
        $totalPayments = $this->paymentRepository->getTotalPayments();

        $reportData = [
            'activeSubscriptions' => $activeSubscriptions->count(),
            'totalPayments' => $totalPayments,
        ];

        Mail::to(config('mail.admin_email'))->send(new \App\Mail\AdminReport($reportData));

        $this->info('Admin report sent successfully.');
    }
}
