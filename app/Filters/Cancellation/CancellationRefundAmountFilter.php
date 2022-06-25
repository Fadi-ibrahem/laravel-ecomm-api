<?php

namespace App\Filters\Cancellation;

use App\Interfaces\FilterInterface;
use Closure;

class CancellationRefundAmountFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('refund_amount')) {
            $query->where('refund_amount', request()->input('refund_amount'));
        }
        return $next($query);
    }
}
