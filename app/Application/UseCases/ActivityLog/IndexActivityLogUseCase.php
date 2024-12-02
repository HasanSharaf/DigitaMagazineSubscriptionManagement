<?php

namespace App\Application\UseCases\ActivityLog;

use App\Application\UseCases\Model\IndexModelUseCase;
use App\Infrastructure\Repositories\ActivityLog\ActivityLogRepository;

class IndexActivityLogUseCase extends IndexModelUseCase
{
    public function __construct(ActivityLogRepository $repository)
    {
        parent::__construct( $repository);
    }
}
