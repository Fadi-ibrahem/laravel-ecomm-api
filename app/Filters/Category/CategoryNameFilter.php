<?php

namespace App\Filters\Category;

use App\Interfaces\FilterInterface;
use Closure;

class CategoryNameFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('name')) {
            $query->where('name', request()->input('name'));
        }
        return $next($query);
    }
}
