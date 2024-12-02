<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum UserRoleEnum: string
{
    case SUBSCRIBER = 'subscriber';
    case PUBLISHER = 'publisher';
    case ADMIN = 'admin';
}
