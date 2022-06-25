<?php

namespace App\Services\API\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateProductValidationService
{
    public static function isValid(Request $request) 
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'name'              => 'string',
            'status'            => 'boolean',
            'qty'               => 'integer',
            'image'             => 'file|image|max:5120',   // maximum image size is 5mb = 5120kb
            'description'       => 'string',
            'price'             => 'numeric',
            'category_id'       => 'numeric',
            'supplier_id'       => 'nullable|numeric',
            'admin_id'          => 'nullable|numeric',
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