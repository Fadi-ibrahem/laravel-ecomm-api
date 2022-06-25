<?php

namespace App\Services\API\Coupon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateCouponValidationService
{
    public static function isValid(Request $request) 
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'title'             => 'string',
            'offer_percentage'  => 'numeric',
            'code'              => 'string|unique:coupons,code',
        ]);

        // Check if there are validation errors
        if($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}