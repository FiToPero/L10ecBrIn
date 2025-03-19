<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (Gate::allows($permission)) {
            return $next($request);
        }
        abort(403, 'No tienes permiso para acceder a esta página. --> Gate ->'. $permission);
    }
}

///  ejemplo de un middleware
/* 
class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }
        abort(403, 'No tienes permiso para acceder a esta página.');
    }
}
*/