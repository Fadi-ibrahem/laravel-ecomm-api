<?php

namespace App\Filters\Feedback;

use App\Interfaces\FilterInterface;
use Closure;

class FeedbackCommentFilter implements FilterInterface
{
    public function handle($query, Closure $next)
    {
        if(request()->has('comment')) {
            $query->where('comment', request()->input('comment'));
        }
        return $next($query);
    }
}
