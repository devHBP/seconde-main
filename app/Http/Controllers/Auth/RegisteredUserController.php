<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string', 'max:255'],
            'password' =>['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $account = Account::create([
            'login' => $request->login,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($account));
        return redirect(route('auth.login', absolute: false));
    }
}