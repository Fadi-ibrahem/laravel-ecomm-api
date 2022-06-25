<?php

namespace App\Filters\Order;

use App\Interfaces\FilterInterface;
use Closure;

class OrderQTYFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('qty')) {
            $query->where('qty', request()->input('qty'));
        }
        return $next($query);
    }
}
