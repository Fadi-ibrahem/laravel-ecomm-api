<?php

namespace App\Services\API\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateCategoryValidationService
{
    public static function isValid(Request $request) 
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'name'              => 'string',
            'description'       => 'string',
            'sub_category_id'   => 'nullable|numeric',
        ]);

        // Check if there are validation errors
        if($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}