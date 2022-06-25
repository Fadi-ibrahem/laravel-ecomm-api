<?php

namespace App\Filters\Shipper;

use App\Interfaces\FilterInterface;
use Closure;

class ShipperStreetFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('street')) {
            $query->where('street', request()->input('street'));
        }
        return $next($query);
    }
}