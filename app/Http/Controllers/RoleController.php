<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
{
    public function showRoleLogin(Request $request)
    {
        $roleName = $request->input('role_name');
        $role = Role::whereRaw("LOWER(name) = ?", $roleName)->firstOrFail();
        return view('auth.sublogin', ['role' => $role]);
    }

    public function authenticate(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $role_id = $request->input('role_id');
        
        $role = Role::find($role_id);
        $role_name = strtolower($role->name);
        $user = User::where('name', $username)->first();

        // Authentication maison, on vérifie si il y a bien un User qui correspond, si le password est ok et si dans les roles de l'user 
        // il possède bien le rôle en question.
        if($user && Hash::check($password, $user->password) && $user->roles->contains('id', $role_id)){
            session([
                'subsession' => [
                    'user' => $user,
                    'role_id' => $role_id,
                    'role_name' => $role_name,
                ],
            ]);
            return redirect()->intended("/$role_name/dashboard");
        }
        return redirect()->route('dashboard')->withErrors(['auth' => 'Identifiants invalide ou rôle non autorisé.']);
    }

    public function destroy()
    {
        session()->forget('subsession');
        return redirect()->route('dashboard');
    }
}