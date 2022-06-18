<?php

namespace App\Interfaces\Front;

use Closure;

interface FilterInterface
{
    public function handle($data, Closure $next);
}
