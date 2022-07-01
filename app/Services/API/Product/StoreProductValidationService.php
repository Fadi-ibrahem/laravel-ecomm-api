<?php

namespace App\Services\API\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreProductValidationService
{
    public static function isValid(Request $request) 
    {
        // Set default image if not sent
        $request->input('image', 'default.png');

        // Validate inputs
        $validator = Validator::make($request->all(), [
            'name'              => 'required|string',
            'status'            => 'boolean',
            'qty'               => 'required|integer',
            'image'             => 'required|file|image|max:5120',   // maximum image size is 5mb = 5120kb
            'description'       => 'string',
            'price'             => 'required|numeric',
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