<?php

namespace App\Application\DTOs\Payment;

use App\Application\DTOs\DTO;

class StorePaymentDTO extends DTO
{

    public static function fromRequest($request): array
    {
        return [
            'user_id' => $request['user_id'],
            'subscription_id' => $request['subscription_id'],
            'cost' => $request['cost'],
            'payment_method' => $request['payment_method'],
            'date_of_pay' => $request['date_of_pay'],
        ];
    }

}
