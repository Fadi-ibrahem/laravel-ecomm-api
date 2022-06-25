<?php

namespace App\Filters\Supplier;

use App\Interfaces\FilterInterface;
use Closure;

class UserSupplierAddressFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('address')) {
            $query->where('address', request()->input('address'));
        }
        return $next($query);
    }
}
