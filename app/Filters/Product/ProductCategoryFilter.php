<?php

namespace App\Filters\Product;

use App\Interfaces\FilterInterface;
use Closure;

class ProductCategoryFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('category')) {
            $query->where('category_id', request()->input('category'));
        }
        return $next($query);
    }
}
