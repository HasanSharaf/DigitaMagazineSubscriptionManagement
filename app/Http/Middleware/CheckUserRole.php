<?php 

namespace App\Http\Middleware;

use Closure;

class CheckUserRole
{
    public function handle($request, Closure $next, $role)
    {
        if (auth()->user() && auth()->user()->role === $role) {
            return $next($request);
        }
        abort(403, 'Unauthorized action.');
    }
}
