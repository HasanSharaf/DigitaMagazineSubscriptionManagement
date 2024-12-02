<?php

namespace App\Http\Controllers\ActivityLog;

use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ActivityLog\StoreActivityLogRequest;
use App\Http\Requests\ActivityLog\UpdateActivityLogRequest;
use App\Application\Services\ActivityLog\ActivityLogService;
use App\Application\DTOs\ActivityLog\StoreActivityLogDTO;
use App\Application\DTOs\ActivityLog\UpdateActivityLogDTO;

class ActivityLogController extends Controller
{

    protected ActivityLogService $service;

    public function __construct(ActivityLogService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $filters = $request->only(['action', 'model']);
        $logs = $this->service->getLogs($filters);

        return response()->json(['data' => $logs]);
    }

    /**
     * @param StoreActivityLogRequest $request
     * @return JsonResponse
     */
    public function store(StoreActivityLogRequest $request): JsonResponse
    {
        $result = $this->service->store(StoreActivityLogDTO::fromData($request->validated()));
        return ApiResponse::success($result);
    }

    /**
     * @param UpdateActivityLogRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateActivityLogRequest $request, int $id): JsonResponse
    {
        $data = $this->service->update(UpdateActivityLogDTO::fromRequest($request->validated()), $id);
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
