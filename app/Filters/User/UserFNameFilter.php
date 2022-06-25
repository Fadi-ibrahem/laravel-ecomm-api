<?php

namespace App\Filters\User;

use App\Interfaces\FilterInterface;
use Closure;

class UserFNameFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('f_name')) {
            $query->where('f_name', request()->input('f_name'));
        }
        return $next($query);
    }
}
