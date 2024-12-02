<?php

namespace App\Application\DTOs\Subscription;

use App\Application\DTOs\DTO;
use App\Enums\SubscriptionPeriodEnum;

class StoreSubscriptionDTO extends DTO
{

    public static function fromRequest($request): array
    {
        $subscriptionPeriod = strtolower(
            is_array($request) ? $request['subscription_period'] : $request->input('subscription_period')
        );

        try {
            $subscriptionPeriodEnum = SubscriptionPeriodEnum::from($subscriptionPeriod);
        } catch (\UnexpectedValueException $e) {
            throw new \InvalidArgumentException("Invalid subscription period: $subscriptionPeriod");
        }

        $startDate = now();
        $endDate = match ($subscriptionPeriodEnum) {
            SubscriptionPeriodEnum::MONTHLY => $startDate->copy()->addDays(30),
            SubscriptionPeriodEnum::YEARLY => $startDate->copy()->addDays(365),
            default => throw new \InvalidArgumentException("Invalid subscription period: $subscriptionPeriod"),
        };

        return [
            'user_id' => is_array($request) ? $request['user_id'] : $request->input('user_id'),
            'magazine_id' => is_array($request) ? $request['magazine_id'] : $request->input('magazine_id'),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => is_array($request) ? $request['status'] : $request->input('status'),
            'subscription_period' => $subscriptionPeriodEnum,
        ];
    }

}
