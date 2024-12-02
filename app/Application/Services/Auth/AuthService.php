<?php

namespace App\Application\Services\Auth;
use App\Application\UseCases\Auth\DestroyAuthUseCase;
use App\Application\UseCases\Auth\GetAuthUseCase;
use App\Application\UseCases\Auth\IndexAuthUseCase;
use App\Application\UseCases\Auth\StoreAuthUseCase;
use App\Application\UseCases\Auth\UpdateAuthUseCase;
use App\Http\Resources\Auth\AuthResource;
use App\Traits\PaginationHelper;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AuthService{

    use PaginationHelper;

    protected StoreAuthUseCase $storeAuthUseCase;
    protected UpdateAuthUseCase $updateAuthUseCase;
    protected GetAuthUseCase $getAuthUseCase;
    protected DestroyAuthUseCase $destroyAuthUseCase;
    protected IndexAuthUseCase $indexAuthUseCase;

    protected array $headers = ['id', 'name'];

    public function __construct(StoreAuthUseCase      $storeAuthUseCase,
                                UpdateAuthUseCase     $updateAuthUseCase,
                                GetAuthUseCase        $getAuthUseCase,
                                DestroyAuthUseCase    $destroyAuthUseCase,
                                IndexAuthUseCase     $indexAuthUseCase)
    {
        $this->storeAuthUseCase = $storeAuthUseCase;
        $this->updateAuthUseCase = $updateAuthUseCase;
        $this->getAuthUseCase = $getAuthUseCase;
        $this->destroyAuthUseCase = $destroyAuthUseCase;
        $this->indexAuthUseCase = $indexAuthUseCase;
    }

    public function index(array $data): AnonymousResourceCollection|array
    {
        $result = $this->indexAuthUseCase->execute($data);

        return !isset($data['per_page']) ? AuthResource::collection($result) :
            $this->getPaginatedData($this->headers,$result, AuthResource::class);
    }

     /**
     * @param array $data
     * @return AuthResource
     */
    public function store(array $data): AuthResource
    {
        $result = $this->storeAuthUseCase->execute($data);
        return new AuthResource($result);
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        $data['id'] = $id;
        return $this->updateAuthUseCase->execute($data);
    }

    /**
     * @param int $id
     * @return AuthResource
     */
    public function show(int $id): AuthResource
    {
        $source = $this->getAuthUseCase->execute(['id' => $id]);
        return new AuthResource($source);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id): mixed
    {
        return $this->destroyAuthUseCase->execute(['id' => $id]);
    }
}
