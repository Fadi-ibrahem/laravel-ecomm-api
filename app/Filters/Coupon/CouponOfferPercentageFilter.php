<?php

namespace App\Filters\Coupon;

use App\Interfaces\FilterInterface;
use Closure;

class CouponOfferPercentageFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('offer_percentage')) {
            $query->where('offer_percentage', request()->input('offer_percentage'));
        }
        return $next($query);
    }
}
