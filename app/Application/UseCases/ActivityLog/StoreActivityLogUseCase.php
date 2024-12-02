<?php

namespace App\Application\UseCases\ActivityLog;

use App\Application\UseCases\Model\StoreModelUseCase;
use App\Infrastructure\Repositories\ActivityLog\ActivityLogRepository;

class StoreActivityLogUseCase extends StoreModelUseCase
{
    public function __construct(ActivityLogRepository $repository)
    {
        parent::__construct( $repository);
    }

}
