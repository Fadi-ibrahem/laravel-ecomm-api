<?php

namespace App\Filters\Shipper;

use App\Interfaces\FilterInterface;
use Closure;

class ShipperZoneFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('zone')) {
            $query->where('zone', request()->input('zone'));
        }
        return $next($query);
    }
}