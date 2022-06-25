<?php

namespace App\Filters\Order;

use App\Interfaces\FilterInterface;
use Closure;

class OrderCardTypeFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('card_type')) {
            $query->where('card_type', request()->input('card_type'));
        }
        return $next($query);
    }
}
