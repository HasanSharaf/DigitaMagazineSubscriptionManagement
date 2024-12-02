<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Application\Services\User\UserService;
use App\Application\DTOs\User\StoreUserDTO;
use App\Application\DTOs\User\UpdateUserDTO;

class UserController extends Controller
{

    protected UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
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
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $result = $this->service->store(StoreUserDTO::fromRequest($request->validated()));
        return ApiResponse::success($result);
    }

    /**
     * @param UpdateUserRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        $data = $this->service->update(UpdateUserDTO::fromRequest($request->validated()), $id);
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
