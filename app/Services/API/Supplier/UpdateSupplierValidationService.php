<?php

namespace App\Services\API\Supplier;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateSupplierValidationService
{
    public static function isValid(Request $request) 
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'address'  => 'string',
        ]);

        // Check if there are validation errors
        if($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}