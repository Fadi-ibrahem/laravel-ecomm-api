<?php

namespace App\Filters\Shipper;

use App\Interfaces\FilterInterface;
use Closure;

class ShipperEmailFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('email')) {
            $query->where('email', request()->input('email'));
        }
        return $next($query);
    }
}
