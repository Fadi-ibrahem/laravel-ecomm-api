<?php

namespace App\Services\API\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderProductsValidationService
{
    public static function isValid(Request $request) 
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'order_id'      => 'required|numeric',
            'products_id'   => 'required|array',
        ]);

        // Check if there are validation errors
        if($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}