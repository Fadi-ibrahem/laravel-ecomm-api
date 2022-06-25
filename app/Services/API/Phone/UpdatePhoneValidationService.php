<?php

namespace App\Services\API\Phone;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdatePhoneValidationService
{
    public static function isValid(Request $request) 
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'phone_number' => 'numeric',
            'phoneable_id' => 'numeric',
        ]);

        // Check if there are validation errors
        if($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}