<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionExpiryNotification extends Mailable
{
    public $subscription;

    public function __construct($subscription)
    {
        $this->subscription = $subscription;
    }

    public function build()
    {
        return $this->subject('Your Subscription is About to Expire')
            ->view('emails.subscription_expiry')
            ->with([
                'userName' => $this->subscription->user->name,
                'magazineName' => $this->subscription->magazine->name,
                'endDate' => $this->subscription->end_date->format('Y-m-d'),
            ]);
    }
}
