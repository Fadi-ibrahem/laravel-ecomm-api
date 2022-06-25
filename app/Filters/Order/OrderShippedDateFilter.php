<?php

namespace App\Filters\Order;

use App\Interfaces\FilterInterface;
use Closure;

class OrderShippedDateFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('shipped_date')) {
            $query->where('shipped_date', request()->input('shipped_date'));
        }
        return $next($query);
    }
}
