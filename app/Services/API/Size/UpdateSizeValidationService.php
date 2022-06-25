<?php

namespace App\Services\API\Size;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UpdateSizeValidationService
{
    public static function isValid(Request $request) 
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'size_degree'  => [
                Rule::in(['small', 'medium', 'large', 'x_large', '2_x_large', '3_x_large']),
            ],
        ]);

        // Check if there are validation errors
        if($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}