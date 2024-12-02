<?php

namespace App\Http\Requests\Subscription;

use App\Enums\SubscriptionPeriodEnum;
use App\Enums\SubscriptionStatusEnum;
use App\Http\Requests\BaseRequest;
use App\Infrastructure\Models\Subscription\Subscription;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use NunoMaduro\Collision\Adapters\Phpunit\Subscribers\Subscriber;

class StoreSubscriptionRequest extends BaseRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // $canCreate = Gate::allows('create', Subscription::class);
        // return $canCreate;
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
            'magazine_id' => 'required|exists:magazines,id',
            // 'start_date' => 'required|date',
            // 'end_date' => 'required|date',
            'status' => ['required', Rule::in(SubscriptionStatusEnum::getValues())],
            'subscription_period' => ['required', Rule::in(SubscriptionPeriodEnum::getValues())],
        ];

    }

}
