<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle($request, Closure $next, $permission)
    {
        // Check if user has the specified permission
        if (Gate::denies($permission)) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
