<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Role;
use App\Models\State;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isNull;

class AdminController
{
    /**
     * Dashboard
     */
    public function dashboard(Request $request)
    {
        $user = session('subsession.user');
        $roleName = session('subsession.role_name');
        return view('admin.dashboard', ["user" => $user, "role" => $roleName]);
    }

    /**
     * Utilisateurs
     */
    public function getUsers()
    {
        return view('admin.users.users', ['users' => User::all()]);
    }
    
    public function createUser(Request $request)
    {
        if($request->isMethod('post')){
            $account = $request->user();
            $validatedData = $request->validate([
                "name" => 'required|string|max:255',
                "email" => 'required|email|max:255',
                "password" => 'required|string|max:255',
                "confirm_password" => 'required|string|max:255|same:password',
                "roles" => 'required|array'
            ]);
            $validatedData['password'] = Hash::make($validatedData['password']);
            // Pour la création de User je dois passer par ce systeme là
            // la methode User::create ne tolère que les propriété 'fillables', 
            // et je ne souhaite pas que par malice ou erreur l'on puisse modifier le account_id
            $user = new User();
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->password = $validatedData['password'];
            $user->account_id = $account->id;
            $user->save();
            // La relation many to many nécéssite d'être attachée après que l'User soit fraichement save()
            $user->roles()->attach($validatedData['roles']);

            return redirect()->route('admin.users')->with('success', 'Utilisateur créé avec succès');
        }
        return view('admin.users.create-or-modify', ["roles" => Role::all()]);
    }

    public function modifyUser(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        if($request->isMethod('put')){
            try {
                $validatedData = $request->validate([
                    "name" => 'required|string|max:255',
                    "email" => 'required|string|max:255',
                    "password" => 'nullable|string|max:255',
                    "confirm_password" => 'required_with:password|same:password',
                    "roles" => 'required|array'
                ]);
                $updatedData = [
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                ];

                if(!empty($validatedData['password'])){
                    $user->password = Hash::make($validatedData['password']);
                }

                $user->update($updatedData);
                $user->roles()->sync($validatedData['roles']);

                return redirect()->route('admin.users')->with('success', 'Utilisateur mis à jour');
            } catch (\Illuminate\Validation\ValidationException $e) {
                dd($e->errors());
            }
        }
        return view('admin.users.create-or-modify',[
            "user" => $user,
            "roles" => Role::all(),
        ]);
    }

    public function deleteUser($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé');
    }

    /**
     * Marques
     */
    public function getBrands()
    {
        return view('admin.brands.brands', ['brands' => Brand::all()]);
    }

    public function createBrand(Request $request)
    {
        if($request->isMethod('post')){
            $account = $request->user();
            $validatedData = $request->validate([
                "name" => "required|string|max:120",
            ]);
            $brand = new Brand();
            $brand->account_id = $account->id;
            $brand->name = strtoupper($validatedData['name']);
            $brand->save();

            return redirect()->route('admin.brands')->with('success', 'Marque créée avec succès.');
        }
        return view('admin.brands.create-or-modify');
    }

    public function modifyBrand(Request $request, $brand_id)
    {
        $brand = Brand::findOrFail($brand_id);
        if($request->isMethod('put')){

            $validatedData = $request->validate([
                'name' => 'required|string|max:120',
            ]);
            $validatedData['name'] = strtoupper($validatedData['name']);
            $brand->update($validatedData);

            return redirect()->route('admin.brands')->with('success', 'Marque modifiée avec succès');
        }
        return view('admin.brands.create-or-modify', ['brand' => $brand]);
    }

    public function deleteBrand($brand_id)
    {
        $brand = Brand::findOrFail($brand_id);
        $brand->delete();
        return redirect()->route('admin.brands');
    }

    /**
     * Types
     */ 
    public function getTypes()
    {
        return view('admin.types.types', ['types' => Type::all()]);
    }

    public function createType(Request $request)
    {
        if($request->isMethod('post')){
            $account = $request->user();
            $validatedData = $request->validate([
                "name" => "required|string|max:120",
            ]);
            $type = new Type();
            $type->account_id = $account->id;
            $type->name = strtoupper($validatedData['name']);
            $type->save();

            return redirect()->route('admin.types')->with('success', 'Type créé avec succès.');
        }
        return view('admin.types.create-or-modify');
    }

    public function modifyType(Request $request, $type_id)
    {
        $type = Type::findOrFail($type_id);
        if($request->isMethod('put')){
            $validatedData = $request->validate([
                'name' => 'required|string|max:120',
            ]);
            $validatedData['name'] = strtoupper($validatedData['name']); 
            $type->update($validatedData);

            return redirect()->route('admin.types')->with('success', 'Type modifié avec succès');
        }
        return view('admin.types.create-or-modify', ['type' => $type]);
    }

    public function deleteType($type_id)
    {
        $type = Type::findOrFail($type_id);
        $type->delete();
        return redirect()->route('admin.types')->with('success', 'Type supprimé avec succès.');
    }

    /**
     * Etats / States
     */
    public function getStates()
    {
        return view('admin.states.states', ['states' => State::all()]);
    }

    public function createState(Request $request)
    {
        if($request->isMethod('post')){
            $account = $request->user();
            $validatedData = $request->validate([
                "name" => "required|string|max:255",
                "definition" => "nullable|string",
            ]);
            $state = new State();
            $state->account_id = $account->id;
            $state->name = strtoupper($validatedData['name']);
            $state->definition = $validatedData['definition'];
            $state->save();

            return redirect()->route('admin.states')->with('success', 'Etat créé avec succès.');
        }
        return view('admin.states.create-or-modify');
    }

    public function modifyState(Request $request, $state_id)
    {
        $state = State::findOrFail($state_id);
        if($request->isMethod('put')){
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'definition' => 'nullable|string',
            ]);
            $validatedData['name'] = strtoupper($validatedData['name']); 
            $state->update($validatedData);

            return redirect()->route('admin.states')->with('success', 'Etat modifié avec succès');
        }
        return view('admin.states.create-or-modify', ['state' => $state]);
    }

    public function deleteState($state_id)
    {
        $state = State::findOrFail($state_id);
        $state->delete();
        return redirect()->route('admin.states')->with('success', 'Etat supprimé avec succès.');
    }

    /**
     * Produits / Products
     */
    public function getProducts()
    {
        return view('admin.products.products', ['products' => Product::all()]);
    }

    public function createProduct(Request $request)
    {
        $states = State::all();
        if($request->isMethod('post')){
            $account = $request->user();
            $validatedData = $request->validate([
                'type' => 'required|exists:types,id',
                'brand' => 'required|exists:brands,id',
            ]);

            $product = new Product();
            $product->type_id = $validatedData['type'];
            $product->brand_id = $validatedData['brand'];
            $product->account_id = $account->id;

            $product->save();

            foreach ($states as $state) {
                $prixRemboursementKey = 'prix_remboursement_state_' . $state->id;
                $prixBonAchatKey = 'prix_bon_achat_state_' . $state->id;
                if($request->has($prixRemboursementKey) || $request->has($prixBonAchatKey)){
                    
                    // Validation des données 
                    $validatedPrices = $request->validate([
                        $prixRemboursementKey => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
                        $prixBonAchatKey => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/'
                    ]);

                    $prixRemboursement = $validatedPrices[$prixRemboursementKey] ?? null;
                    $prixBonAchat = $validatedPrices[$prixBonAchatKey];
                    if($prixRemboursement !== null || $prixBonAchat !== null){
                        $product->states()->attach($state->id, [
                            'prix_remboursement' => $prixRemboursement,
                            'prix_bon_achat' => $prixBonAchat,
                        ]);
                    }
                }
            }
            return redirect()->route('admin.products')->with('success', 'Produit ajouté avec succès');
        }
        return view('admin.products.create-or-modify', [
            "types" => Type::all(),
            "brands" => Brand::all(),
            "states" => $states,
        ]);
    }

    public function modifyProduct(Request $request, $product_id)
    {   
        $states = State::all();
        $product = Product::findOrFail($product_id);
        if($request->isMethod('put')){
            $validatedData = $request->validate([
                'type' => 'required|exists:types,id',
                'brand' => 'required|exists:brands,id'
            ]);
            $updatedData = [
                'type_id' => $validatedData['type'],
                'brand_id' => $validatedData['brand'],
            ];
            $product->update($updatedData);

            $stateData = [];
            foreach ($states as $state) {
                $prixRemboursementKey = "prix_remboursement_state_{$state->id}";
                $prixBonAchatKey = "prix_bon_achat_state_{$state->id}";
                // Validation des données 
                $validatedPrices = $request->validate([
                    $prixRemboursementKey => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
                    $prixBonAchatKey => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/'
                ]);
                $prixRemboursement = $validatedPrices[$prixRemboursementKey];
                $prixBonAchat = $validatedPrices[$prixBonAchatKey];

                if(is_null($prixRemboursement) && is_null($prixBonAchat)){
                    $product->states()->detach($state->id);
                }
                else if(!is_null($prixRemboursement || !is_null($prixBonAchat))){
                    $stateData[$state->id] = [
                        'prix_remboursement' => $prixRemboursement,
                        'prix_bon_achat' => $prixBonAchat
                    ];
                }
            }
            $product->states()->sync($stateData);

            return redirect()->route('admin.products')->with('success', 'Poduit modifié avec succès.');
        }
        return view('admin.products.create-or-modify', [
            "product" => $product,
            "types" => Type::all(),
            "brands" => Brand::all(),
            "states" => $states,
        ]);
    }

    public function deleteProduct($product_id)
    {
        $product = Product::findorFail($product_id);
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Produit supprimé avec succès.');
    }

    /**
     * Tickets && Stats
     */
    public function getTickets()
    {
        //
    }

    public function getStats()
    {
        //
    }
}