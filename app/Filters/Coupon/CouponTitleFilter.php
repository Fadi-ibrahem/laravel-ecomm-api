<?php

namespace App\Filters\Coupon;

use App\Interfaces\FilterInterface;
use Closure;

class CouponTitleFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('title')) {
            $query->where('title', request()->input('title'));
        }
        return $next($query);
    }
}
