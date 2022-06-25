<?php

namespace App\Filters\Order;

use App\Interfaces\FilterInterface;
use Closure;

class OrderDiscountFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('discount')) {
            $query->where('discount', request()->input('discount'));
        }
        return $next($query);
    }
}
