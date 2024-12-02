<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum SubscriptionStatusEnum: string
{
    use EnumHelper;

    case ACTIVE = 'active';
    case EXPIRED = 'expired';
    case PENDING = 'pending';

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
            self::ACTIVE->value => 'active',
            self::EXPIRED->value => 'expired',
            self::PENDING->value => 'pending',
        ];
    }
}
