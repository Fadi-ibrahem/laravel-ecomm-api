<?php

namespace App\Filters\Order;

use App\Interfaces\FilterInterface;
use Closure;

class OrderCardNumberFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('card_number')) {
            $query->where('card_number', request()->input('card_number'));
        }
        return $next($query);
    }
}
