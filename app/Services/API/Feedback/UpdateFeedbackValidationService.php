<?php

namespace App\Services\API\Feedback;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateFeedbackValidationService
{
    public static function isValid(Request $request) 
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'rating'        => 'numeric',
            'comment'       => 'string',
            'product_id'    => 'numeric',
            'customer_id'   => 'numeric',
        ]);

        // Check if there are validation errors
        if($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}