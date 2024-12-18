<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if($request->routeIs('role.sublogin', 'role.authenticate', 'role.logout')){
            return $next($request);
        }

        $roleNames = Role::pluck('name')->map(function ($name){
            return strtolower($name);
        });

        foreach($roleNames as $roleName){
            if($request->is("$roleName/*")){
                if(!Session::has('subsession')){
                    return redirect()->route('dashboard')->withErrors(['access' => "Vous devez sélectionner un rôle."]);
                }
                
                $subsession = Session::get('subsession');
                
                // Ici Ajout de la règle qui vérifie si le mode est compact ou pas
                // si il l'est les utilisateurs qui possède reception et encaissement peuvent naviguer sur ces voies
                $account = Auth::user();
                if($account->compacted_mode){
                    if(in_array($roleName, ['reception', 'encaissement'])){
                        return $next($request);
                    }
                }

                if($subsession['role_name'] !== $roleName){
                    return back();
                }
            }
        }

        return $next($request);
    }
}
