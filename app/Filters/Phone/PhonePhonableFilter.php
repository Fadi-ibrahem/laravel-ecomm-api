<?php

namespace App\Filters\Phone;

use App\Interfaces\FilterInterface;
use Closure;

class PhonePhonableFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('phonable_id')) {
            $query->where('phonable_id', request()->input('phonable_id'));
        }
        return $next($query);
    }
}
