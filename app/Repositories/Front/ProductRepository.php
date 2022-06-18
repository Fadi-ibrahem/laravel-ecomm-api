<?php

namespace App\Repositories\Front;

use App\Filters\Front\ProductCategoryFilter;
use App\Filters\Front\ProductColorFilter;
use App\Filters\Front\ProductPriceFilter;
use App\Filters\Front\ProductSizeFilter;
use \App\Interfaces\Front\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Pipeline\Pipeline;

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

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function show()
    {
        // TODO: Implement show() method.
    }
}
