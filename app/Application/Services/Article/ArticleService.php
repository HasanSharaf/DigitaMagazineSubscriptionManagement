<?php

namespace App\Application\Services\Article;
use App\Application\UseCases\Article\DestroyArticleUseCase;
use App\Application\UseCases\Article\GetArticleUseCase;
use App\Application\UseCases\Article\IndexArticleUseCase;
use App\Application\UseCases\Article\StoreArticleUseCase;
use App\Application\UseCases\Article\UpdateArticleUseCase;
use App\Http\Resources\Article\ArticleResource;
use App\Traits\PaginationHelper;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ArticleService{

    use PaginationHelper;

    protected StoreArticleUseCase $storeArticleUseCase;
    protected UpdateArticleUseCase $updateArticleUseCase;
    protected GetArticleUseCase $getArticleUseCase;
    protected DestroyArticleUseCase $destroyArticleUseCase;
    protected IndexArticleUseCase $indexArticleUseCase;

    protected array $headers = ['id', 'name'];

    public function __construct(StoreArticleUseCase      $storeArticleUseCase,
                                UpdateArticleUseCase     $updateArticleUseCase,
                                GetArticleUseCase        $getArticleUseCase,
                                DestroyArticleUseCase    $destroyArticleUseCase,
                                IndexArticleUseCase     $indexArticleUseCase)
    {
        $this->storeArticleUseCase = $storeArticleUseCase;
        $this->updateArticleUseCase = $updateArticleUseCase;
        $this->getArticleUseCase = $getArticleUseCase;
        $this->destroyArticleUseCase = $destroyArticleUseCase;
        $this->indexArticleUseCase = $indexArticleUseCase;
    }

    public function index(array $data): AnonymousResourceCollection|array
    {
        $result = $this->indexArticleUseCase->execute($data);

        return !isset($data['per_page']) ? ArticleResource::collection($result) :
            $this->getPaginatedData($this->headers,$result, ArticleResource::class);
    }

     /**
     * @param array $data
     * @return ArticleResource
     */
    public function store(array $data): ArticleResource
    {
        $result = $this->storeArticleUseCase->execute($data);
        return new ArticleResource($result);
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        $data['id'] = $id;
        return $this->updateArticleUseCase->execute($data);
    }

    /**
     * @param int $id
     * @return ArticleResource
     */
    public function show(int $id): ArticleResource
    {
        $source = $this->getArticleUseCase->execute(['id' => $id]);
        return new ArticleResource($source);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id): mixed
    {
        return $this->destroyArticleUseCase->execute(['id' => $id]);
    }
}
