<?php
namespace App\Http\Middleware\Custom;

use Closure;
use Illuminate\Http\Request;

class NoFrames
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request)->header('X-Frame-Options', 'DENY');
    }
}
