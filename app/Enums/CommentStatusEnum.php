<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum CommentStatusEnum: string
{
    use EnumHelper;

    case APPROVED = 'approved';
    case BLOCKED = 'blocked';

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
            self::APPROVED->value => 'approved',
            self::BLOCKED->value => 'blocked',
        ];
    }
}
