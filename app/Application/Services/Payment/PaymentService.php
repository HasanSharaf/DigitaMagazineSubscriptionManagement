<?php

namespace App\Application\Services\Payment;
use App\Application\UseCases\Payment\DestroyPaymentUseCase;
use App\Application\UseCases\Payment\GetPaymentUseCase;
use App\Application\UseCases\Payment\IndexPaymentUseCase;
use App\Application\UseCases\Payment\StorePaymentUseCase;
use App\Application\UseCases\Payment\UpdatePaymentUseCase;
use App\Http\Resources\Payment\PaymentResource;
use App\Traits\PaginationHelper;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaymentService{

    use PaginationHelper;

    protected StorePaymentUseCase $storePaymentUseCase;
    protected UpdatePaymentUseCase $updatePaymentUseCase;
    protected GetPaymentUseCase $getPaymentUseCase;
    protected DestroyPaymentUseCase $destroyPaymentUseCase;
    protected IndexPaymentUseCase $indexPaymentUseCase;

    protected array $headers = ['id', 'name'];

    public function __construct(StorePaymentUseCase      $storePaymentUseCase,
                                UpdatePaymentUseCase     $updatePaymentUseCase,
                                GetPaymentUseCase        $getPaymentUseCase,
                                DestroyPaymentUseCase    $destroyPaymentUseCase,
                                IndexPaymentUseCase     $indexPaymentUseCase)
    {
        $this->storePaymentUseCase = $storePaymentUseCase;
        $this->updatePaymentUseCase = $updatePaymentUseCase;
        $this->getPaymentUseCase = $getPaymentUseCase;
        $this->destroyPaymentUseCase = $destroyPaymentUseCase;
        $this->indexPaymentUseCase = $indexPaymentUseCase;
    }

    public function index(array $data): AnonymousResourceCollection|array
    {
        $result = $this->indexPaymentUseCase->execute($data);

        return !isset($data['per_page']) ? PaymentResource::collection($result) :
            $this->getPaginatedData($this->headers,$result, PaymentResource::class);
    }

     /**
     * @param array $data
     * @return PaymentResource
     */
    public function store(array $data): PaymentResource
    {
        $result = $this->storePaymentUseCase->execute($data);
        return new PaymentResource($result);
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        $data['id'] = $id;
        return $this->updatePaymentUseCase->execute($data);
    }

    /**
     * @param int $id
     * @return PaymentResource
     */
    public function show(int $id): PaymentResource
    {
        $source = $this->getPaymentUseCase->execute(['id' => $id]);
        return new PaymentResource($source);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id): mixed
    {
        return $this->destroyPaymentUseCase->execute(['id' => $id]);
    }
}
