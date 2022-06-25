<?php

namespace App\Filters\Color;

use App\Interfaces\FilterInterface;
use Closure;

class ColorValueFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('color_value')) {
            $query->where('color_value', request()->input('color_value'));
        }
        return $next($query);
    }
}
