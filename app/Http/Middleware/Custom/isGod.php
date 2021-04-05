<?php

namespace App\Http\Middleware\Custom;

use Auth, Closure, Credentials;

class isGod
{
    public function handle($request, Closure $next, $role)
    {
        //Check for roles
        if (Credentials::id() === 1) {
            return $next($request);
        }

        return errorNotAllowedAccess();
    }
}
