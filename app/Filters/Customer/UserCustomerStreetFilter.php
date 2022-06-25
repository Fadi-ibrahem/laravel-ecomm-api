<?php

namespace App\Filters\Customer;

use App\Interfaces\FilterInterface;
use Closure;

class UserCustomerStreetFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('street')) {
            $query->where('street', request()->input('street'));
        }
        return $next($query);
    }
}
