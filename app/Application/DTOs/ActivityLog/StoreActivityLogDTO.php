<?php

namespace App\Application\DTOs\ActivityLog;

use App\Application\DTOs\DTO;

class StoreActivityLogDTO extends DTO
{

    public static function fromData(array $data): array
    {
        return [
            'user_id' => $data['user_id'],
            'action' => $data['action'],
            'model' => $data['model'],
            'model_id' => $data['model_id'] ?? null,
            'details' => $data['details'] ?? [],
        ];
    }

}
