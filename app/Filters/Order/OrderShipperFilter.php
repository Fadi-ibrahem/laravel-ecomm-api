<?php

namespace App\Filters\Order;

use App\Interfaces\FilterInterface;
use Closure;

class OrderShipperFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('shipper_id')) {
            $query->where('shipper_id', request()->input('shipper_id'));
        }
        return $next($query);
    }
}
