<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum PaymentMethodEnum: string
{
    use EnumHelper;

    case CASH = 'cash';
    case CARD = 'card';
    case TRANSFER = 'transfer';

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
            self::CASH->value => 'cash',
            self::CARD->value => 'card',
            self::TRANSFER->value => 'transfer',
        ];
    }
}
