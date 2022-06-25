<?php

namespace App\Services\API\Cancellation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateCancellationValidationService
{
    public static function isValid(Request $request) 
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'date'          => 'date',
            'refund_amount' => 'nullable|numeric',
            'notes'         => 'nullable|string',
        ]);

        // Check if there are validation errors
        if($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}