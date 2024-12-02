<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Application\Services\Comment\CommentService;
use App\Application\DTOs\Comment\StoreCommentDTO;
use App\Application\DTOs\Comment\UpdateCommentDTO;
use App\Application\Services\ActivityLog\ActivityLogService;
use App\Infrastructure\Models\ActivityLog\ActivityLog;
use App\Infrastructure\Models\Comment\Comment;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{

    protected CommentService $service;
    protected ActivityLogService $activityLogService;

    public function __construct(CommentService $service, ActivityLogService $activityLogService)
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
     * @param StoreCommentRequest $request
     * @return JsonResponse
     */
    public function store(StoreCommentRequest $request): JsonResponse
    {
        if (!Gate::allows('create', Comment::class)) {
            abort(403, 'Unauthorized action.');
        }
        
        $result = $this->service->store(StoreCommentDTO::fromRequest($request->validated()));
        $this->activityLogService->log([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model' => 'Comment',
            'model_id' => $result->id,
            'details' => ['content' => $result->content],
        ]);
        return ApiResponse::success($result);
    }

    /**
     * @param UpdateCommentRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateCommentRequest $request, int $id): JsonResponse
    {
        $data = $this->service->update(UpdateCommentDTO::fromRequest($request->validated()), $id);
        return ApiResponse::success($data);
    }

     /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $data = $this->service->show($id);
        return ApiResponse::success($data);
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
    
    /**
     * Block a comment by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function block(int $id): JsonResponse
    {
        if (!Gate::allows('moderate', Comment::class)) {
            abort(403, 'Unauthorized action.');
        }

        $this->service->block($id);
        
        return ApiResponse::success(['message' => 'Comment blocked successfully.']);
    }

}
