<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     * @param \Illuminate\Http\Request $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return mixed 
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(! Auth::check() || Auth::user()->login !== SUPER_ADMIN_LOGIN){
            abort(403, "Accès refusé, vous n'avez pas les droits suffisants");
        }
        return $next($request);
    }
}
