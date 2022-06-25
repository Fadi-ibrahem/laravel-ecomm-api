<?php

namespace App\Filters\Order;

use App\Interfaces\FilterInterface;
use Closure;

class OrderCustomerFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('customer_id')) {
            $query->where('customer_id', request()->input('customer_id'));
        }
        return $next($query);
    }
}
