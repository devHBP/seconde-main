<?php 

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FakeController extends Controller
{
    public function getUsers()
    {
        // TODO Vérifier que le cloisement via le scope est bon
        $users = User::all();
        return response()->json([
            "user" => $users,
        ]);
    }

    public function getUser($id)
    {
        $user = User::findOrFail($id);
        $user->roles;
        return response()->json([
            "user" => $user,
        ]);
    }

    public function createUser(Request $request)
    {
        $account = $request->user();
        $user = new User();
        $user->name = "Brigitte";
        $user->password = Hash::make('!Test123');
        $user->email = "brigitte@mail.com";
        $user->account_id = $account->id;
        //$user->save();

        $user->roles()->attach([1, 2, 3]);
        return redirect()->intended('/users');
    }
}