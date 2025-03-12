<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Assuming you have an 'is_admin' field in the users table
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
