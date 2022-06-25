<?php

namespace App\Filters\User;

use App\Interfaces\FilterInterface;
use Closure;

class UserLNameFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('l_name')) {
            $query->where('l_name', request()->input('l_name'));
        }
        return $next($query);
    }
}
