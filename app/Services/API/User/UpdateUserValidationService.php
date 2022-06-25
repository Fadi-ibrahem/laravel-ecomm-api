<?php

namespace App\Services\API\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UpdateUserValidationService
{
    public static function isValid(Request $request) 
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'type'      => Rule::in(['super_admin', 'admin', 'supplier', 'customer']),
            'email'     => 'email',
            'password'  => 'string',
            'f_name'    => 'string|max:50',
            'l_name'    => 'string|max:50',
        ]);

        // Check if there are validation errors
        if($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}