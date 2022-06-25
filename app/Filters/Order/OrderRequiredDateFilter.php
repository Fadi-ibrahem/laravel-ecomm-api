<?php

namespace App\Filters\Order;

use App\Interfaces\FilterInterface;
use Closure;

class OrderRequiredDateFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('required_date')) {
            $query->where('required_date', request()->input('required_date'));
        }
        return $next($query);
    }
}
