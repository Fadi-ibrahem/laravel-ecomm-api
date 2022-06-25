<?php

namespace App\Filters\Size;

use App\Interfaces\FilterInterface;
use Closure;

class SizeDegreeFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('size_degree')) {
            $query->where('size_degree', request()->input('size_degree'));
        }
        return $next($query);
    }
}
