<?php

namespace App\Filters\User;

use App\Interfaces\FilterInterface;
use Closure;

class UserTypeFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('type')) {
            $query->where('type', request()->input('type'));
        }
        return $next($query);
    }
}
