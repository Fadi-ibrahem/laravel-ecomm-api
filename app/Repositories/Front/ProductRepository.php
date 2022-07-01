<?php

namespace App\Repositories\Front;

use App\Models\Product;
use Illuminate\Pipeline\Pipeline;
use App\Filters\Product\ProductSizeFilter;
use App\Filters\Product\ProductColorFilter;
use App\Filters\Product\ProductPriceFilter;
use App\Filters\Product\ProductCategoryFilter;
use \App\Interfaces\Front\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductRepository implements ProductRepositoryInterface
{
    public function index()
    {
        $products = app(Pipeline::class)
            ->send(Product::query())
            ->through([
                ProductCategoryFilter::class,
                ProductPriceFilter::class,
                ProductColorFilter::class,
                ProductSizeFilter::class,
            ])
            ->thenReturn()
            ->paginate(12);

        return $products;
    }

    public function create(Request $request)
    {

        // Create the new product
        $product = Product::create($request->all());

        if($request->has('image')) {
            // Handle Image
            $imgName = time().'_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images/products/'), $imgName);
            
            $product->image = $imgName;
            $product->save();
        }
    }

    public function update(Product $product, Request $request)
    {
        if($request->has('image')) {

            // Handle New Image
            $imgName = time().'_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images/products/'), $imgName);

            // Delete Old Image
            File::delete(public_path('images/products/' . $product->image));

            // Update Product
            $product->update($request->all());
            $product->image = $imgName;
            $product->save();

        } else {
            $product->update($request->all());
        }
    }

    public function delete(Product $product)
    {
        $product->delete();
    }

    public function show(Product $product)
    {
        return $product;
    }
}
