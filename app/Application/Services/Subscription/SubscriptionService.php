<?php

namespace App\Application\Services\Subscription;
use App\Application\UseCases\Subscription\DestroySubscriptionUseCase;
use App\Application\UseCases\Subscription\GetSubscriptionUseCase;
use App\Application\UseCases\Subscription\IndexSubscriptionUseCase;
use App\Application\UseCases\Subscription\StoreSubscriptionUseCase;
use App\Application\UseCases\Subscription\UpdateSubscriptionUseCase;
use App\Http\Resources\Subscription\SubscriptionResource;
use App\Traits\PaginationHelper;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SubscriptionService{

    use PaginationHelper;

    protected StoreSubscriptionUseCase $storeSubscriptionUseCase;
    protected UpdateSubscriptionUseCase $updateSubscriptionUseCase;
    protected GetSubscriptionUseCase $getSubscriptionUseCase;
    protected DestroySubscriptionUseCase $destroySubscriptionUseCase;
    protected IndexSubscriptionUseCase $indexSubscriptionUseCase;

    protected array $headers = ['id', 'name'];

    public function __construct(StoreSubscriptionUseCase      $storeSubscriptionUseCase,
                                UpdateSubscriptionUseCase     $updateSubscriptionUseCase,
                                GetSubscriptionUseCase        $getSubscriptionUseCase,
                                DestroySubscriptionUseCase    $destroySubscriptionUseCase,
                                IndexSubscriptionUseCase     $indexSubscriptionUseCase)
    {
        $this->storeSubscriptionUseCase = $storeSubscriptionUseCase;
        $this->updateSubscriptionUseCase = $updateSubscriptionUseCase;
        $this->getSubscriptionUseCase = $getSubscriptionUseCase;
        $this->destroySubscriptionUseCase = $destroySubscriptionUseCase;
        $this->indexSubscriptionUseCase = $indexSubscriptionUseCase;
    }

    public function index(array $data): AnonymousResourceCollection|array
    {
        $result = $this->indexSubscriptionUseCase->execute($data);

        return !isset($data['per_page']) ? SubscriptionResource::collection($result) :
            $this->getPaginatedData($this->headers,$result, SubscriptionResource::class);
    }

     /**
     * @param array $data
     * @return SubscriptionResource
     */
    public function store(array $data): SubscriptionResource
    {
        $result = $this->storeSubscriptionUseCase->execute($data);
        return new SubscriptionResource($result);
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        $data['id'] = $id;
        return $this->updateSubscriptionUseCase->execute($data);
    }

    /**
     * @param int $id
     * @return SubscriptionResource
     */
    public function show(int $id): SubscriptionResource
    {
        $source = $this->getSubscriptionUseCase->execute(['id' => $id]);
        return new SubscriptionResource($source);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id): mixed
    {
        return $this->destroySubscriptionUseCase->execute(['id' => $id]);
    }
}
