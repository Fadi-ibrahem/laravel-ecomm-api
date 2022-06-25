<?php

namespace App\Filters\Cancellation;

use App\Interfaces\FilterInterface;
use Closure;

class CancellationDateFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('date')) {
            $query->where('date', request()->input('date'));
        }
        return $next($query);
    }
}
