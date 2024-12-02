<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Application\Services\Article\ArticleService;
use App\Application\DTOs\Article\StoreArticleDTO;
use App\Application\DTOs\Article\UpdateArticleDTO;
use App\Application\Services\ActivityLog\ActivityLogService;
use App\Infrastructure\Models\ActivityLog\ActivityLog;
use App\Infrastructure\Models\Article\Article;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{

    protected ArticleService $service;
    protected ActivityLogService $activityLogService;

    public function __construct(ArticleService $service, ActivityLogService $activityLogService)
    {
        $this->service = $service;
        $this->activityLogService = $activityLogService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $result = $this->service->index($request->all());
        return ApiResponse::success($result);
    }

    /**
     * @param StoreArticleRequest $request
     * @return JsonResponse
     */
    public function store(StoreArticleRequest $request): JsonResponse
    {
        if (!Gate::allows('create', Article::class)) {
            abort(403, 'Unauthorized action.');
        }
    
        $result = $this->service->store(StoreArticleDTO::fromRequest($request->validated()));

        $this->activityLogService->log([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model' => 'Article',
            'model_id' => $result->id,
            'details' => ['title' => $result->title],
        ]);
    
        return ApiResponse::success($result);
    }

    /**
     * @param UpdateArticleRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateArticleRequest $request, int $id): JsonResponse
    {
        $data = $this->service->update(UpdateArticleDTO::fromRequest($request->validated()), $id);
        return ApiResponse::success($data);
    }

     /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $article = $this->service->find($id);

        if (!Gate::allows('view', $article)) {
            abort(403, 'Unauthorized action.');
        }

        return ApiResponse::success($article);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $data = $this->service->destroy($id);
        return ApiResponse::success($data);
    }

}
