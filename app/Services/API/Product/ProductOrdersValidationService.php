<?php

namespace App\Services\API\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductOrdersValidationService
{
    public static function isValid(Request $request) 
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'product_id'                    => 'required|numeric',
            'orders_id'                     => 'required|array',
        ]);

        // Check if there are validation errors
        if($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}