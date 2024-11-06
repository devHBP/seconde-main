<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SubSessionRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $roleNames = Role::pluck('name')->map(function ($name){
            return strtolower($name);
        });

        foreach($roleNames as $roleName){
            if($request->is("$roleName/*")){
                if(!Session::has('subsession')){
                    return redirect()->route('dashboard')->withErrors(['access' => "Vous devez sélectionner un rôle."]);
                }
                $subsession = Session::get('subsession');
                if($subsession['role_name'] !== ucfirst($roleName)){
                    return back();
                }
            }
        }

        return $next($request);
    }
}
