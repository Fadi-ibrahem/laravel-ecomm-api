<?php

namespace App\Filters\Feedback;

use App\Interfaces\FilterInterface;
use Closure;

class FeedbackRatingFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('rating')) {
            $query->where('rating', request()->input('rating'));
        }
        return $next($query);
    }
}
