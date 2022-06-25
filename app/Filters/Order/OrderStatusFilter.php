<?php

namespace App\Filters\Order;

use App\Interfaces\FilterInterface;
use Closure;

class OrderStatusFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('status')) {
            $query->where('status', request()->input('status'));
        }
        return $next($query);
    }
}
