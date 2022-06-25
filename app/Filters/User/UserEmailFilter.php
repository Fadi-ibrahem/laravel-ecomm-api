<?php

namespace App\Filters\User;

use App\Interfaces\FilterInterface;
use Closure;

class UserEmailFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('email')) {
            $query->where('email', request()->input('email'));
        }
        return $next($query);
    }
}
