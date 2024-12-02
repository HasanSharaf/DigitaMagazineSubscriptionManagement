<?php

namespace App\Http\Resources\Subscription;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd(parent::toArray($request));
        return parent::toArray($request);
        // return [
        //     'id' => $request->id ?? null,
        //     'user_id' => $request['user_id'] ?? null,
        //     'magazine_id' => $request['magazine_id'] ?? null,
        //     'start_date' => $request['start_date'] ?? null,
        //     'end_date' => $request['end_date'] ?? null,
        //     'status' => $request['status'] ?? null,
        //     'subscription_period' => $request['subscription_period'] ?? null,
        // ];
    }
}
