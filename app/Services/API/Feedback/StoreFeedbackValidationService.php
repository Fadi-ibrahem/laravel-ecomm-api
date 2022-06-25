<?php

namespace App\Services\API\Feedback;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreFeedbackValidationService
{
    public static function isValid(Request $request) 
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'rating'        => 'numeric',
            'comment'       => 'string',
            'product_id'    => 'required|numeric',
            'customer_id'   => 'required|numeric',
        ]);

        // Check if there are validation errors
        if($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}