<?php

namespace App\Application\UseCases\ActivityLog;

use App\Application\UseCases\Model\GetModelDetailsUseCase;
use App\Infrastructure\Repositories\ActivityLog\ActivityLogRepository;

class GetActivityLogUseCase extends GetModelDetailsUseCase
{
    public function __construct(ActivityLogRepository $repository)
    {
        parent::__construct( $repository);
    }

    public function setConditions(array $data): void
    {
        $this->conditions = ['id' => $data['id']];
    }
}
