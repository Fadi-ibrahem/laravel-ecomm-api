<?php

namespace App\Services\API\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateCustomerValidationService
{
    public static function isValid(Request $request) 
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'phone'     => 'string',
            'zone'      => 'string',
            'street'    => 'string',
        ]);

        // Check if there are validation errors
        if($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}