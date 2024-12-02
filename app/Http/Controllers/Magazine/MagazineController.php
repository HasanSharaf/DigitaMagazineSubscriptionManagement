<?php

namespace App\Http\Controllers\Magazine;

use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Magazine\StoreMagazineRequest;
use App\Http\Requests\Magazine\UpdateMagazineRequest;
use App\Application\Services\Magazine\MagazineService;
use App\Application\DTOs\Magazine\StoreMagazineDTO;
use App\Application\DTOs\Magazine\UpdateMagazineDTO;
use App\Application\Services\ActivityLog\ActivityLogService;
use App\Infrastructure\Models\Magazine\Magazine;
use Illuminate\Support\Facades\Gate;

class MagazineController extends Controller
{

    protected MagazineService $service;
    protected ActivityLogService $activityLogService;

    public function __construct(MagazineService $service, ActivityLogService $activityLogService)
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
     * @param StoreMagazineRequest $request
     * @return JsonResponse
     */
    public function store(StoreMagazineRequest $request): JsonResponse
    {
        if (!Gate::allows('create', Magazine::class)) {
            abort(403, 'Unauthorized action.');
        }
        
        $result = $this->service->store(StoreMagazineDTO::fromRequest($request->validated()));

        $this->activityLogService->log([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model' => 'Magazine',
            'model_id' => $result->id,
            'details' => ['name' => $result->name],
        ]);

        return ApiResponse::success($result);
    }

    /**
     * @param UpdateMagazineRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateMagazineRequest $request, int $id): JsonResponse
    {
        $data = $this->service->update(UpdateMagazineDTO::fromRequest($request->validated()), $id);
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
