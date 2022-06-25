<?php

namespace App\Filters\Coupon;

use App\Interfaces\FilterInterface;
use Closure;

class CouponCodeFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('code')) {
            $query->where('code', request()->input('code'));
        }
        return $next($query);
    }
}
