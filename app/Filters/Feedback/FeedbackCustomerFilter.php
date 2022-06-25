<?php

namespace App\Filters\Feedback;

use App\Interfaces\FilterInterface;
use Closure;

class FeedbackCustomerFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('customer')) {
            $query->where('customer', request()->input('customer'));
        }
        return $next($query);
    }
}
