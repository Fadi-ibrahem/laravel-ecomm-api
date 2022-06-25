<?php

namespace App\Services\API\Phone;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddShipperPhonesValidationService
{
    public static function isValid(Request $request) 
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'phones'    => 'required|array',
        ]);

        // Check if there are validation errors
        if($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}