<?php

namespace App\Filters\Shipper;

use App\Interfaces\FilterInterface;
use Closure;

class ShipperNameFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('name')) {
            $query->where('name', request()->input('name'));
        }
        return $next($query);
    }
}
