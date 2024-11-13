<?php 

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Client;
use App\Models\Product;
use App\Models\Type;
use Exception;
use Illuminate\Http\Request;

class ReceptionController
{
    public function dashboard()
    {
        $user = session('subsession.user');
        $roleName = session('subsession.role_name');
        return view('reception.dashboard', ['user' => $user, 'role' => $roleName]);
    }

    public function addProduct(Request $request)
    {
        $account = $request->user();
        $types = Type::all();
        $brands = Brand::all();
        $product = '';
        $states = [];
        $selectedState = null;

        if($request->isMethod('post')){
            // Cas du post de data 
            $product = null;
            $states = [];
            $stateId = null;
            //dd($request->all());
            if($request->has('type_id')){
                session(['type_id' => $request->input('type_id')]);
            }
            if($request->has('brand_id')){
                session(['brand_id' => $request->input('brand_id')]);
            }
            if($request->has('state_id')){
                session(['state_id' => $request->input('state_id')]);
            }
            $typeId = session('type_id');
            $brandId = session('brand_id');
            $stateId = session('state_id');

            if($typeId && $brandId){
                $product = Product::where('type_id', $typeId)
                    ->where('brand_id', $brandId)
                    ->first();
                
                    if($product){
                        $states = $product->states()->get();
                    }

                    if($stateId){
                        $selectedState = $states->firstWhere('id', $stateId);
                    }
            }
            
            // Validation, Controle
            // Creation d'un panier ou retour en arrière 
            return view('reception.products.product', compact(
                'states',
                'product',
                'brands',
                'types',
                'selectedState',
            ));
        }
        return view('reception.products.product', [
            'types' => $types,
            'brands' => $brands,
            'product' => $product,
            'states' => $states,
            'selectedState' => $selectedState
        ]);
    }

    public function storeProduct()
    {

    }

    public function cancel()
    {
        if(session('type_id')){
            session()->forget('type_id');
        }
        if(session('brand_id')){
            session()->forget('brand_id');
        }
        if(session('state_id')){
            session()->forget('state_id');
        }
        return redirect()->route('reception.dashboard');
    }

    // Gestion des utilisateurs 
    public function getClient()
    {
        return view('reception.clients.clients', ["clients" => Client::all()]);
    }

    public function createClient(Request $request)
    {
        if($request->isMethod('post')){
            $account = $request->user();
            $validatedData = $request->validate([
                "firstname" => 'required|string|max:255',
                "lastname" => 'required|string|max:255',
                "email" => 'nullable|email|required_without:phone',
                "phone" => 'nullable|digits:10|required_without:email',
                "consent" => 'required|boolean'
            ]);
            $client = new Client();
            $client->firstname = $validatedData['firstname'];
            $client->lastname = $validatedData['lastname'];
            $client->email = $validatedData['email'] ?? null;
            $client->phone = $validatedData['phone'] ?? null;
            $client->consent = $validatedData['consent'];
            $client->account_id = $account->id;

            $client->save();

            return redirect()->route('reception.clients')->with('success', 'Client ajouté avec succès');
        }
        
        return view('reception.clients.create-or-modify');
    }

    public function modifyClient(Request $request, $client_id)
    {
        $client = Client::findOrFail($client_id);

        if($request->isMethod('put')){
            $validatedData = $request->validate([
                "firstname" => 'required|string|max:255',
                "lastname" => 'required|string|max:255',
                "email" => 'nullable|email|required_without:phone',
                "phone" => 'nullable|digits:10|required_without:email',
                "consent" => 'required|boolean'
            ]);
            $updatedData = [
                "firstname" => $validatedData["firstname"],
                "lastname" => $validatedData["lastname"],
                "email" => $validatedData["email"] ?? null,
                "phone" => $validatedData["phone"] ?? null,
                "consent" => $validatedData["consent"],
            ];

            $client->update($updatedData);
            return redirect()->route('reception.clients')->with('success', "Client modifié avec succès");
        }
        return view('reception.clients.create-or-modify', ['client' => $client]);
    }

    public function deleteClient($client_id)
    {
        $client = Client::findOrFail($client_id);
        $client->delete();
        return redirect()->route('reception.clients')->with('success', 'Client supprimé avec succès.');
    }

    public function showClient($client_id)
    {
        if(!$client_id){
            return redirect()->back()->with('error', "Le client n'a pas été trouvé");
        }
        $client = Client::findOrFail($client_id);
        return view('reception.clients.client', ["client" => $client]);
    }
    
    /**
     * Gestion du Panier
     */
    public function addToCart(Request $request)
    {   
        // if(!$request->isMethod('post')){
        //     //
        // }
        // Receive data within array format as $user['user'=> User::class , 'role_id'=> "2", 'role_name' => 'reception']
        $user = session('subsession');
        
    }
}