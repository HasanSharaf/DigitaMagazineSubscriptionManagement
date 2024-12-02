<?php

namespace App\Application\Services\Comment;

use App\Application\UseCases\Comment\BlockCommentUseCase;
use App\Application\UseCases\Comment\DestroyCommentUseCase;
use App\Application\UseCases\Comment\GetCommentUseCase;
use App\Application\UseCases\Comment\IndexCommentUseCase;
use App\Application\UseCases\Comment\StoreCommentUseCase;
use App\Application\UseCases\Comment\UpdateCommentUseCase;
use App\Http\Resources\Comment\CommentResource;
use App\Traits\PaginationHelper;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommentService{

    use PaginationHelper;

    protected StoreCommentUseCase $storeCommentUseCase;
    protected UpdateCommentUseCase $updateCommentUseCase;
    protected GetCommentUseCase $getCommentUseCase;
    protected DestroyCommentUseCase $destroyCommentUseCase;
    protected IndexCommentUseCase $indexCommentUseCase;
    protected BlockCommentUseCase $blockCommentUseCase;

    protected array $headers = ['id', 'name'];

    public function __construct(StoreCommentUseCase      $storeCommentUseCase,
                                UpdateCommentUseCase     $updateCommentUseCase,
                                GetCommentUseCase        $getCommentUseCase,
                                DestroyCommentUseCase    $destroyCommentUseCase,
                                IndexCommentUseCase     $indexCommentUseCase,
                                BlockCommentUseCase $blockCommentUseCase)
    {
        $this->storeCommentUseCase = $storeCommentUseCase;
        $this->updateCommentUseCase = $updateCommentUseCase;
        $this->getCommentUseCase = $getCommentUseCase;
        $this->destroyCommentUseCase = $destroyCommentUseCase;
        $this->indexCommentUseCase = $indexCommentUseCase;
        $this->blockCommentUseCase = $blockCommentUseCase;
    }

    public function index(array $data): AnonymousResourceCollection|array
    {
        $result = $this->indexCommentUseCase->execute($data);

        return !isset($data['per_page']) ? CommentResource::collection($result) :
            $this->getPaginatedData($this->headers,$result, CommentResource::class);
    }

     /**
     * @param array $data
     * @return CommentResource
     */
    public function store(array $data): CommentResource
    {
        $result = $this->storeCommentUseCase->execute($data);
        return new CommentResource($result);
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        $data['id'] = $id;
        return $this->updateCommentUseCase->execute($data);
    }

    /**
     * @param int $id
     * @return CommentResource
     */
    public function show(int $id): CommentResource
    {
        $source = $this->getCommentUseCase->execute(['id' => $id]);
        return new CommentResource($source);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id): mixed
    {
        return $this->destroyCommentUseCase->execute(['id' => $id]);
    }

    public function block(int $id): bool
    {
        return $this->blockCommentUseCase->execute($id);
    }
}
