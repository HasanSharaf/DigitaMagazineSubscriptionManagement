<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\StoreAuthRequest;
use App\Http\Requests\Auth\UpdateAuthRequest;
use App\Application\Services\Auth\AuthService;
use App\Application\DTOs\Auth\StoreAuthDTO;
use App\Application\DTOs\Auth\UpdateAuthDTO;
use App\Infrastructure\Models\User\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    protected AuthService $service;

    public function __construct(AuthService $service)
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
     * @param StoreAuthRequest $request
     * @return JsonResponse
     */
    public function store(StoreAuthRequest $request): JsonResponse
    {
        $result = $this->service->store(StoreAuthDTO::fromRequest($request->validated()));
        return ApiResponse::success($result);
    }

    /**
     * @param UpdateAuthRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateAuthRequest $request, int $id): JsonResponse
    {
        $data = $this->service->update(UpdateAuthDTO::fromRequest($request->validated()), $id);
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

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

}
