<?php

namespace App\Application\Services\Magazine;
use App\Application\UseCases\Magazine\DestroyMagazineUseCase;
use App\Application\UseCases\Magazine\GetMagazineUseCase;
use App\Application\UseCases\Magazine\IndexMagazineUseCase;
use App\Application\UseCases\Magazine\StoreMagazineUseCase;
use App\Application\UseCases\Magazine\UpdateMagazineUseCase;
use App\Http\Resources\Magazine\MagazineResource;
use App\Traits\PaginationHelper;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MagazineService{

    use PaginationHelper;

    protected StoreMagazineUseCase $storeMagazineUseCase;
    protected UpdateMagazineUseCase $updateMagazineUseCase;
    protected GetMagazineUseCase $getMagazineUseCase;
    protected DestroyMagazineUseCase $destroyMagazineUseCase;
    protected IndexMagazineUseCase $indexMagazineUseCase;

    protected array $headers = ['id', 'name'];

    public function __construct(StoreMagazineUseCase      $storeMagazineUseCase,
                                UpdateMagazineUseCase     $updateMagazineUseCase,
                                GetMagazineUseCase        $getMagazineUseCase,
                                DestroyMagazineUseCase    $destroyMagazineUseCase,
                                IndexMagazineUseCase     $indexMagazineUseCase)
    {
        $this->storeMagazineUseCase = $storeMagazineUseCase;
        $this->updateMagazineUseCase = $updateMagazineUseCase;
        $this->getMagazineUseCase = $getMagazineUseCase;
        $this->destroyMagazineUseCase = $destroyMagazineUseCase;
        $this->indexMagazineUseCase = $indexMagazineUseCase;
    }

    public function index(array $data): AnonymousResourceCollection|array
    {
        $result = $this->indexMagazineUseCase->execute($data);

        return !isset($data['per_page']) ? MagazineResource::collection($result) :
            $this->getPaginatedData($this->headers,$result, MagazineResource::class);
    }

     /**
     * @param array $data
     * @return MagazineResource
     */
    public function store(array $data): MagazineResource
    {
        $result = $this->storeMagazineUseCase->execute($data);
        return new MagazineResource($result);
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        $data['id'] = $id;
        return $this->updateMagazineUseCase->execute($data);
    }

    /**
     * @param int $id
     * @return MagazineResource
     */
    public function show(int $id): MagazineResource
    {
        $source = $this->getMagazineUseCase->execute(['id' => $id]);
        return new MagazineResource($source);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id): mixed
    {
        return $this->destroyMagazineUseCase->execute(['id' => $id]);
    }
}
