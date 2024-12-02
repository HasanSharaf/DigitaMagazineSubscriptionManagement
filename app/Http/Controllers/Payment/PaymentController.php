<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Payment\StorePaymentRequest;
use App\Http\Requests\Payment\UpdatePaymentRequest;
use App\Application\Services\Payment\PaymentService;
use App\Application\DTOs\Payment\StorePaymentDTO;
use App\Application\DTOs\Payment\UpdatePaymentDTO;

class PaymentController extends Controller
{

    protected PaymentService $service;

    public function __construct(PaymentService $service)
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
     * @param StorePaymentRequest $request
     * @return JsonResponse
     */
    public function store(StorePaymentRequest $request): JsonResponse
    {
        $result = $this->service->store(StorePaymentDTO::fromRequest($request->validated()));
        return ApiResponse::success($result);
    }

    /**
     * @param UpdatePaymentRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdatePaymentRequest $request, int $id): JsonResponse
    {
        $data = $this->service->update(UpdatePaymentDTO::fromRequest($request->validated()), $id);
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
