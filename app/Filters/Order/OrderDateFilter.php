<?php

namespace App\Filters\Order;

use App\Interfaces\FilterInterface;
use Closure;

class OrderDateFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('order_date')) {
            $query->where('order_date', request()->input('order_date'));
        }
        return $next($query);
    }
}
