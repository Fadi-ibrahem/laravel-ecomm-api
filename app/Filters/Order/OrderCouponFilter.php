<?php

namespace App\Filters\Order;

use App\Interfaces\FilterInterface;
use Closure;

class OrderCouponFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('coupon_id')) {
            $query->where('coupon_id', request()->input('coupon_id'));
        }
        return $next($query);
    }
}
