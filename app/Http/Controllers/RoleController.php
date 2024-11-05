<?php

namespace App\Http\Controllers;

use App\Models\Role;

class RoleController extends Controller
{
    public function showRoleLogin($role_name)
    {
        $role = Role::whereRaw("LOWER(name) = ?", $role_name)->firstOrFail();
        return view('auth.sublogin', ['role' => $role]);
    }
}