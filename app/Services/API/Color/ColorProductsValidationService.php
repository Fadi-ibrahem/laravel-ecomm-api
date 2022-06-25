<?php

namespace App\Services\API\Color;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorProductsValidationService
{
    public static function isValid(Request $request) 
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'products_id'   => 'required|array',
            'color_id'      => 'required|numeric',
        ]);

        // Check if there are validation errors
        if($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}