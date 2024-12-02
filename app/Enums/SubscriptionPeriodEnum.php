<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum SubscriptionPeriodEnum: string
{
    use EnumHelper;

    case MONTHLY = 'monthly';
    case YEARLY = 'yearly';

    /**
     * Get all enum values as an array.
     *
     * @return array
     */
    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get the human-readable names for roles.
     *
     * @return array
     */
    public static function getLabels(): array
    {
        return [
            self::MONTHLY->value => 'monthly',
            self::YEARLY->value => 'yearly',
        ];
    }
}
