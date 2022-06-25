<?php

namespace App\Interfaces\Front;

use App\Models\Product;
use Illuminate\Http\Request;

interface ProductRepositoryInterface
{
    public function index();

    public function create(Request $request);

    public function update(Product $product, Request $request);

    public function delete(Product $product);

    public function show(Product $product);

}
