<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Picture;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GestionController extends Controller
{
    public function getSettings(Request $request)
    {
        $user = $request->user();
        $account = Account::findOrFail($user->id);
        if($request->isMethod('put')){
            
            $validatedData = $request->validate([
                "name" => 'nullable|string|max:255',
                "header_background" => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                "header_title" => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                "header_subtitle" => ['nullable','regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                "header_button_background" => ['nullable','regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                "header_button_font" => ['nullable','regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                "subheader_background" => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                "subheader_title" => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                "subheader_subtitle" => ['nullable','regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                "subheader_button" => ['nullable','regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                "subheader_button_font" => ['nullable','regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                "main_background" => ['nullable','regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                "main_cards_background" => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                "main_cards_title" => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                "main_cards_font" => ['nullable','regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                "main_cards_svg" => ['nullable','regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                "main_cards_button" => ['nullable','regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                "pattern_logo" => 'nullable|file|mimes:png,svg|max:2048',
            ]);
            if($request->has('pattern_logo')){
                $path = $request->file('pattern_logo')->store('customisation', 'public');
                $picture = new Picture();
                $picture->name = $request->file('pattern_logo')->getClientOriginalName();
                $picture->path = $path;
                $picture->type = 'icon';
                $picture->save();

                $account->pattern_logo = $picture->id;
            }

            $account->name = $validatedData['name'];
            $account->getSlugOptions();
            $account->header_background = $validatedData['header_background'];
            $account->header_title = $validatedData['header_title'];
            $account->header_subtitle = $validatedData['header_subtitle'];
            $account->header_button_background = $validatedData['header_button_background'];
            $account->header_button_font = $validatedData['header_button_font'];

            $account->subheader_background = $validatedData['subheader_background'];
            $account->subheader_title = $validatedData['subheader_title'];
            $account->subheader_subtitle = $validatedData['subheader_subtitle'];
            $account->subheader_button = $validatedData['subheader_button'];
            $account->subheader_button_font = $validatedData['subheader_button_font'];

            $account->main_background = $validatedData['main_background'];
            $account->main_cards_background = $validatedData['main_cards_background'];
            $account->main_cards_title = $validatedData['main_cards_title'];
            $account->main_cards_font = $validatedData['main_cards_font'];
            $account->main_cards_svg = $validatedData['main_cards_svg'];
            $account->main_cards_button = $validatedData['main_cards_button'];

            $account->save();
            if($account->login === SUPER_ADMIN_LOGIN ){
                return redirect()->route('dashboard');
            }
            return redirect()->route('dashboard');
        }

        return view('gestion.settings', [ "account"=> $account]);
    }

    public function createEnseigne(Request $request)
    {
        if($request->isMethod('post'))
        {
            // En cas de method post ( case creation d'enseigne )
            $validatedData = $request->validate([
                'login' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'password' => 'required|string|max:255',
                'confirm_password' => 'required|string|max:255|same:password',
                'custom_background_primary' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                'custom_background_secondary' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                'custom_font_primary' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                'custom_font_secondary' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                'pattern_logo' => 'nullable|file|mimes:.png,.svg|max:2048',
                'user_name' => 'required|string|max:255',
                'user_email' => 'required|email',
                'user_password' => 'required|string|max:255',
                'user_confirm_password' => 'required|string|max:255|same:user_password'
            ]);
            $account = new Account();
            
            if($request->has('pattern_logo')){
                $path = $request->file('pattern_logo')->store('customisation', 'public');
                $picture = new Picture();
                $picture->name = $request->file('pattern_logo')->getClientOriginalName();
                $picture->path = $path;
                $picture->type = 'icon';
                $picture->save();

                $account->pattern_logo = $picture->id;
            }
            $account->login = $validatedData['login'];
            $account->name = $validatedData['name'];
            $account->password = Hash::make($validatedData['password']);
            $account->getSlugOptions();
            $account->custom_background_primary = $validatedData['custom_background_primary'];
            $account->custom_background_secondary = $validatedData['custom_background_secondary'];
            $account->custom_font_primary = $validatedData['custom_font_primary'];
            $account->custom_font_secondary = $validatedData['custom_font_secondary'];
            $account->save();

            $user = new User();
            $user->email = $validatedData['user_email'];
            $user->name = $validatedData['user_name'];
            $user->password = Hash::make($validatedData['user_password']);
            $user->account_id = $account->id;
            $user->save();
            // Ici j'attache le role 3 à l'utilisateur crée à la volée, il correspond à "administrateur"
            $user->roles()->attach(['3']);

            return redirect()->route('dashboard')->with('success', 'Enseigne créee avec succès.');
        }
        return view('gestion.enseignes.create-or-modify');
    }

    // Formulaire de modification
    public function getEnseigne($enseigne_slug)
    {
        $enseigne = Account::where('slug', $enseigne_slug)->firstOrFail();
        return view('gestion.enseignes.enseigne', ['enseigne' => $enseigne]);
    }

    // Methode put , modifictaion des details de l'enseigne
    public function modifyEnseigneDetails($enseigne_slug, Request $request)
    {
        $enseigne = Account::where('slug', $enseigne_slug)->firstOrFail();
        if($request->isMethod('put')){
            $validatedData = $request->validate([
                'login' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'password' => 'nullable|string|max:255',
                'confirm_password' => 'required_with:password|same:password',
                'custom_background_primary' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                'custom_background_secondary' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                'custom_font_primary' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                'custom_font_secondary' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
                'pattern_logo' => 'nullable|file|mimes:.png,.svg|max:2048',
            ]);
            $updatedData = [
                'login' => $validatedData['login'],
                'name' => $validatedData['name'],
                'custom_background_primary' => $validatedData['custom_background_primary'],
                'custom_background_secondary' => $validatedData['custom_background_secondary'],
                'custom_font_primary' => $validatedData['custom_font_primary'],
                'custom_font_secondary' => $validatedData['custom_font_secondary'],
            ];
            
            if(!empty($validatedData['pattern_logo'])){
                $path = $request->file('pattern_logo')->store('customisation', 'public');
                $picture = new Picture();
                $picture->name = $request->file('pattern_logo')->getClientOriginalName();
                $picture->path = $path;
                $picture->type = 'icon';
                $picture->save();

                $enseigne->pattern_logo = $picture->id;
            }

            if(!empty($validatedData['password'])){
                $enseigne->password = Hash::make($validatedData['password']);
            }
            $enseigne->update($updatedData);
            return redirect()->route('dashboard')->with('success', 'Enseigne modifié avec succès.');
        }
        return view('gestion.enseignes.create-or-modify', ['enseigne' => $enseigne ]);
    }

    public function deleteEnseigne($enseigne_slug, Request $request)
    {
        $enseigne = Account::where('slug', $enseigne_slug)->firstOrFail();
        $enseigne->delete();
        return redirect()->route('dashboard')->with('success', 'Enseigne supprimée avec succès');
    }

    public function getUsers($enseigne_slug)
    {
        $enseigne = Account::where('slug', $enseigne_slug)->firstOrFail();
        return view('gestion.users.users', ['users' => User::withoutGlobalScopes()->where('account_id', $enseigne->id)->get(), 'enseigne' => $enseigne ]);
    }

    public function createUser(Request $request, $enseigne_slug)
    {   
        $enseigne = Account::where('slug', $enseigne_slug)->firstOrFail();

        if($request->isMethod('post')){
            $validatedData = $request->validate([
                "name" => 'required|string|max:255',
                "email" => 'required|email|max:255',
                "password" => 'required|string|max:255',
                "confirm_password" => 'required|string|max:255|same:password',
                "roles" => 'required|array'
            ]);
            $validatedData['password'] = Hash::make($validatedData['password']);
            $user = new User();
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->password = $validatedData['password'];
            $user->account_id = $enseigne->id;
            $user->save();
            $user->roles()->attach($validatedData['roles']);

            return redirect()->route('gestion.get.users', $enseigne->slug)->with('success', 'Utilisteur crée avec succès.');
        }

        return view('gestion.users.create-or-modify', [
            'enseigne' => $enseigne,
            'roles' => Role::all(),
        ]);
    }

    public function getOneUser($enseigne_slug, $user_id, Request $request)
    {
        $enseigne = Account::where('slug', $enseigne_slug)->firstOrFail();
        $user = User::withoutGlobalScopes()
            ->where('account_id', $enseigne->id)
            ->where('id', $user_id)
            ->firstOrFail();
        
        if ($request->isMethod('put')) {
            // Case envoi du formulaire de modif pour un user
            // return anticipé
        }

        return view('gestion.users.create-or-modify', ['user' => $user, 'enseigne' => $enseigne, 'roles' => Role::all()]); // Cas affichage du formulaire neutre
    }
}