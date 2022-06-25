<?php

namespace App\Services\API\Order;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UpdateOrderValidationService
{
    public static function isValid(Request $request) 
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'order_number'      => 'numeric',
            'order_date'        => 'date',
            'shipped_date'      => 'date',
            'required_date'     => 'date',
            'customer_id'       => 'numeric',
            'shipper_id'        => 'numeric',
            'qty'               => 'integer',
            'discount'          => 'nullable|numeric',
            'price'             => 'numeric',
            'card_type'         => 'nullable|string',
            'card_number'       => 'nullable|numeric',
            'tax'               => 'nullable|numeric',
            'total_price'       => 'numeric',
            'coupon_id'         => 'nullable|numeric',
            'cancellation_id'   => 'nullable|numeric',
            'status'            => [
                Rule::in(['pending','shipping','accepted','rejected','cancelled']),
            ],
        ]);

        // Check if there are validation errors
        if($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}