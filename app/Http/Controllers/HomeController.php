<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getHomePage(Request $request)
    {
        $account = $request->user();
        $roles = Role::all();
        return view('dashboard', ["account" => $account, "roles" => $roles]);
    } 
}