<?php

namespace App\Services\API\Order;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class StoreOrderValidationService
{
    public static function isValid(Request $request) 
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'order_number'      => 'required|numeric',
            'order_date'        => 'date',
            'shipped_date'      => 'date',
            'required_date'     => 'date',
            'customer_id'       => 'required|numeric',
            'shipper_id'        => 'required|numeric',
            'qty'               => 'required|integer',
            'discount'          => 'nullable|numeric',
            'price'             => 'required|numeric',
            'card_type'         => 'nullable|string',
            'card_number'       => 'nullable|numeric',
            'tax'               => 'nullable|numeric',
            'total_price'       => 'required|numeric',
            'coupon_id'         => 'nullable|numeric',
            'cancellation_id'   => 'nullable|numeric',
            'status'            => [
                'required',
                // Rule::in(['pending','shipping','accepted','rejected','cancelled']),
                'string'
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