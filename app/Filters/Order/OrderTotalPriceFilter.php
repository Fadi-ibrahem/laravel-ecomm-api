<?php

namespace App\Filters\Order;

use App\Interfaces\FilterInterface;
use Closure;

class OrderTotalPriceFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('total_price')) {
            $query->where('total_price', request()->input('total_price'));
        }
        return $next($query);
    }
}
