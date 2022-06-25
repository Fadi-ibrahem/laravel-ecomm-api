<?php

namespace App\Filters\Order;

use App\Interfaces\FilterInterface;
use Closure;

class OrderCancellationFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('cancellation')) {
            $query->where('cancellation', request()->input('cancellation'));
        }
        return $next($query);
    }
}
