<?php

namespace App\Filters\Customer;

use App\Interfaces\FilterInterface;
use Closure;

class UserCustomerPhoneFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('phone')) {
            $query->where('phone', request()->input('phone'));
        }
        return $next($query);
    }
}
