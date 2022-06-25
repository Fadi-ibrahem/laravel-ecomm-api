<?php

namespace App\Filters\Order;

use App\Interfaces\FilterInterface;
use Closure;

class OrderTaxFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('tax')) {
            $query->where('tax', request()->input('tax'));
        }
        return $next($query);
    }
}
