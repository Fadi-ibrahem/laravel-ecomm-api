<?php

namespace App\Services\API\Shipper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateShipperValidationService
{
    public static function isValid(Request $request) 
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'name'      => 'string',
            'email'     => 'string',
            'reg_date'  => 'date',
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