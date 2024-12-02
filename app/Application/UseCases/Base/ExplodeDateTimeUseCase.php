<?php

namespace App\Application\UseCases\Base;

use App\Application\UseCases\Approvals\ApprovalItemsResources\ResolveEmployeeLeavesToApprovalUseCase;
use App\Traits\DateHandler;

class ExplodeDateTimeUseCase
{
    use DateHandler;
    public static function execute(string $dateTime): array
    {
        $dateTime = (new ResolveEmployeeLeavesToApprovalUseCase)->getFormattedDate($dateTime,true);
        return self::resolveDateTime($dateTime);
    }

    private static function resolveDateTime($dateTime): array
    {
        $parts = explode(" ", $dateTime);
        return ['date'=> $parts[0], 'time'=> $parts[1]];
    }

}
