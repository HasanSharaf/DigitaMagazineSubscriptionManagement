<?php

namespace App\Application\Services\ActivityLog;

use App\Application\DTOs\ActivityLog\StoreActivityLogDTO;
use App\Application\UseCases\ActivityLog\DestroyActivityLogUseCase;
use App\Application\UseCases\ActivityLog\GetActivityLogUseCase;
use App\Application\UseCases\ActivityLog\IndexActivityLogUseCase;
use App\Application\UseCases\ActivityLog\StoreActivityLogUseCase;
use App\Application\UseCases\ActivityLog\UpdateActivityLogUseCase;
use App\Http\Resources\ActivityLog\ActivityLogResource;
use App\Infrastructure\Models\ActivityLog\ActivityLog;
use App\Traits\PaginationHelper;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ActivityLogService{

    use PaginationHelper;

    protected StoreActivityLogUseCase $storeActivityLogUseCase;
    protected UpdateActivityLogUseCase $updateActivityLogUseCase;
    protected GetActivityLogUseCase $getActivityLogUseCase;
    protected DestroyActivityLogUseCase $destroyActivityLogUseCase;
    protected IndexActivityLogUseCase $indexActivityLogUseCase;

    protected array $headers = 
    [
        'id', 
        'user_id',
        'action',
        'model',
        'model_id',
        'details'
    ];

    public function __construct(StoreActivityLogUseCase      $storeActivityLogUseCase,
                                UpdateActivityLogUseCase     $updateActivityLogUseCase,
                                GetActivityLogUseCase        $getActivityLogUseCase,
                                DestroyActivityLogUseCase    $destroyActivityLogUseCase,
                                IndexActivityLogUseCase     $indexActivityLogUseCase)
    {
        $this->storeActivityLogUseCase = $storeActivityLogUseCase;
        $this->updateActivityLogUseCase = $updateActivityLogUseCase;
        $this->getActivityLogUseCase = $getActivityLogUseCase;
        $this->destroyActivityLogUseCase = $destroyActivityLogUseCase;
        $this->indexActivityLogUseCase = $indexActivityLogUseCase;
    }

    public function index(array $data): AnonymousResourceCollection|array
    {
        $result = $this->indexActivityLogUseCase->execute($data);

        return !isset($data['per_page']) ? ActivityLogResource::collection($result) :
            $this->getPaginatedData($this->headers,$result, ActivityLogResource::class);
    }

     /**
     * @param array $data
     * @return ActivityLogResource
     */
    public function store(array $data): ActivityLogResource
    {
        $result = $this->storeActivityLogUseCase->execute($data);
        return new ActivityLogResource($result);
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        $data['id'] = $id;
        return $this->updateActivityLogUseCase->execute($data);
    }

    /**
     * @param int $id
     * @return ActivityLogResource
     */
    public function show(int $id): ActivityLogResource
    {
        $source = $this->getActivityLogUseCase->execute(['id' => $id]);
        return new ActivityLogResource($source);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id): mixed
    {
        return $this->destroyActivityLogUseCase->execute(['id' => $id]);
    }

    public function log(array $data): void
    {
        ActivityLog::create([
            'user_id' => $data['user_id'],
            'action' => $data['action'],
            'model' => $data['model'],
            'model_id' => $data['model_id'],
            'details' => $data['details'],
        ]);
    }
}
