<?php

namespace App\Filters\Customer;

use App\Interfaces\FilterInterface;
use Closure;

class UserCustomerZoneFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('zone')) {
            $query->where('zone', request()->input('zone'));
        }
        return $next($query);
    }
}
