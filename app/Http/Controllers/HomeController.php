<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Role;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getHomePage(Request $request)
    {
        $account = $request->user();
        $accounts = $account->login === SUPER_ADMIN_LOGIN ? Account::all() : '';
        $roles = Role::all();
        return view('dashboard', ["account" => $account, "roles" => $roles, "accounts" =>$accounts]);
    }
}