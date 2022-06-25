<?php

namespace App\Services\API\Shipper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreShipperValidationService
{
    public static function isValid(Request $request) 
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string',
            'email'     => 'required|string',
            'reg_date'  => 'required|date',
            'zone'      => 'required|string',
            'street'    => 'required|string',
        ]);

        // Check if there are validation errors
        if($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}