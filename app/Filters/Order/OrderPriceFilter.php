<?php

namespace App\Filters\Order;

use App\Interfaces\FilterInterface;
use Closure;

class OrderPriceFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('price')) {
            $query->where('price', request()->input('price'));
        }
        return $next($query);
    }
}
