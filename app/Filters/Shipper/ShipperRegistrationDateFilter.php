<?php

namespace App\Filters\Shipper;

use App\Interfaces\FilterInterface;
use Closure;

class ShipperRegistrationDateFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('reg_date')) {
            $query->where('reg_date', request()->input('reg_date'));
        }
        return $next($query);
    }
}