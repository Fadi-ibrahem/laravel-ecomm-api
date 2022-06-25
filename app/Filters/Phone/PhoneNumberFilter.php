<?php

namespace App\Filters\Phone;

use App\Interfaces\FilterInterface;
use Closure;

class PhoneNumberFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('phone_number')) {
            $query->where('phone_number', request()->input('phone_number'));
        }
        return $next($query);
    }
}
