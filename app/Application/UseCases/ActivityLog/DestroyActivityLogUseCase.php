<?php

namespace App\Application\UseCases\ActivityLog;

use App\Application\UseCases\Model\DestroyModelUseCase;
use App\Infrastructure\Repositories\ActivityLog\ActivityLogRepository;

class DestroyActivityLogUseCase extends DestroyModelUseCase
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
