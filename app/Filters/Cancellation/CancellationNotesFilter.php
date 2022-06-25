<?php

namespace App\Filters\Cancellation;

use App\Interfaces\FilterInterface;
use Closure;

class CancellationNotesFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('notes')) {
            $query->where('notes', request()->input('notes'));
        }
        return $next($query);
    }
}
