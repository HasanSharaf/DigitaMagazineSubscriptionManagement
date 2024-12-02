<?php

namespace App\Http\Requests\Payment;

use App\Enums\PaymentMethodEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

class StorePaymentRequest extends BaseRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'subscription_id' => 'required|exists:subscriptions,id',
            'cost' => 'required|numeric',
            'payment_method' => ['required', Rule::in(PaymentMethodEnum::getValues())],
            'date_of_pay' => 'required|date',
        ];

    }

}
