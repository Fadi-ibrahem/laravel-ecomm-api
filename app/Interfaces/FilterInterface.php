<?php

namespace App\Interfaces;

use Closure;

interface FilterInterface
{
    public function handle($data, Closure $next);
}
