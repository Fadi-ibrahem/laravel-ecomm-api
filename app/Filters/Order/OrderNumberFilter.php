<?php

namespace App\Filters\Order;

use App\Interfaces\FilterInterface;
use Closure;

class OrderNumberFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('order_number')) {
            $query->where('order_number', request()->input('order_number'));
        }
        return $next($query);
    }
}
