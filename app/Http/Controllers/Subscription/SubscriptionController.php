<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Subscription\StoreSubscriptionRequest;
use App\Http\Requests\Subscription\UpdateSubscriptionRequest;
use App\Application\Services\Subscription\SubscriptionService;
use App\Application\DTOs\Subscription\StoreSubscriptionDTO;
use App\Application\DTOs\Subscription\UpdateSubscriptionDTO;
use App\Application\Services\ActivityLog\ActivityLogService;
use App\Infrastructure\Models\Subscription\Subscription;
use Illuminate\Support\Facades\Gate;

class SubscriptionController extends Controller
{

    protected SubscriptionService $service;
    protected ActivityLogService $activityLogService;

    public function __construct(SubscriptionService $service, ActivityLogService $activityLogService)
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
     * @param StoreSubscriptionRequest $request
     * @return JsonResponse
     */
    public function store(StoreSubscriptionRequest $request): JsonResponse
    {
        if (!Gate::allows('create', Subscription::class)) {
            abort(403, 'Unauthorized action.');
        }

        $result = $this->service->store(StoreSubscriptionDTO::fromRequest($request->validated()));
        
        $this->activityLogService->log([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model' => 'Subscription',
            'model_id' => $result->id,
            'details' => ['status' => $result->status],
        ]);        
        
        return ApiResponse::success($result);
    }

    /**
     * @param UpdateSubscriptionRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateSubscriptionRequest $request, int $id): JsonResponse
    {
        $data = $this->service->update(UpdateSubscriptionDTO::fromRequest($request->validated()), $id);
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

}
