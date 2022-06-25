<?php

namespace App\Filters\Product;

use App\Interfaces\FilterInterface;
use Closure;

class ProductPriceFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('price')) {
            $priceRange = explode('-', request()->input('price'));
            $query->whereBetween('price', $priceRange);
        }
        return $next($query);
    }
}
