<?php 

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Client;
use App\Models\Panier;
use App\Models\Product;
use App\Models\State;
use App\Models\Type;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $this->forgetMyProductInSession();
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
        // Receive data within array format as $user['user'=> User::class , 'role_id'=> "2", 'role_name' => 'reception']
        $account = $request->user();
        $user = session('subsession');
        $panier = Panier::where('user_id', $user['user']->id)
                        ->where('is_validated', false)
                        ->first();
        if(!$panier){
            $panier = new Panier();
            $panier->account_id = $account->id;
            $panier->user_id = $user['user']->id;
            $panier->save();
        }
        $typeId = session('type_id');
        $brandId = session('brand_id');
        $stateId = session('state_id');

        $product = Product::where('type_id', $typeId)
                            ->where('brand_id', $brandId)
                            ->with('states')
                            ->first();

        $prixRemboursement = null;
        $prixBonAchat = null;

        // Recherche dans les states
        foreach($product->states as $state){
            if($state->id == $stateId){
                $prixRemboursement = $state->pivot->prix_remboursement;
                $prixBonAchat = $state->pivot->prix_bon_achat;
                break;
            }
        }
        $existingProduct = $panier->products()->wherePivot('product_id', $product->id)
                                ->wherePivot('state', $state->name)
                                ->first();
        
        if($existingProduct){
            $panier->products()->updateExistingPivot($product->id,[
                'quantity' => $existingProduct->pivot->quantity + 1
            ]);
        }
        else{
            $panier->products()->attach($product->id, [
                'state' => $state->name,
                'prix_remboursement' => $prixRemboursement,
                'prix_bon_achat' => $prixBonAchat,
                'quantity' => 1,
            ]);
        }

        // Ici on appel une fonction utilitaire qui va supprimer les object qu'on ne souhaite plus en session, on viens de les save dans le panier.
        $this->forgetMyProductInSession();

        return redirect()->route('reception.dashboard');
    }

    public function getCart(Request $request)
    {
        $user = session('subsession');
        $panier = Panier::where('user_id', $user['user']->id)
                        ->where('is_validated', false)
                        ->with('products')
                        ->first();

        if(!$panier){
            return redirect()->route('reception.dashboard')->with('error', 'Auncun panier en cours');
        }
        $totalRemboursement = null;
        $totalBonAchat = null;

        foreach($panier->products as $product){
            $totalRemboursement += floatval($product->pivot->prix_remboursement) * $product->pivot->quantity;
            $totalBonAchat += floatval($product->pivot->prix_bon_achat) * $product->pivot->quantity;
        }

        return view('reception.cart.cart', [
            "panier" => $panier,
            "total_remboursement" => $totalRemboursement,
            "total_bon_achat" => $totalBonAchat
        ]);
    }

    public function increaseQuantity(Request $request)
    {
        $user = session("subsession");
        $panier = Panier::where('user_id', $user['user']->id)
                        ->where('is_validated', false)
                        ->first();

        // Check des données envoyées dans la requête. 
        $validatedData = $request->validate([
            'product_id' => 'required|numeric|exists:products,id',
            'state' => 'required|string|exists:states,name'
        ]);

        $productId = $validatedData['product_id'];
        $state = $validatedData['state'];

        $existingProduct = $panier->products()
            ->wherePivot('product_id', $productId)
            ->wherePivot('state', $state)
            ->first();
        
        if($existingProduct){
            $currentQuantity = $existingProduct->pivot->quantity;
            // Dans mon cas je viens chercher les multi clauses via une requete custom , je trouve cela plus lisible qu'avec eloquent
            // où les méthodes sont assez opaque, et où je dois envoyer un tas de données superflue
            DB::table('product_panier')
                ->where('product_id', $productId)
                ->where('state', $state)
                ->where('panier_id', $panier->id)
                ->update(['quantity' => $currentQuantity + 1])
            ;
        }
        return redirect()->route('reception.cart')->with('success', 'Produit ajouté.');
    }

    public function decreaseQuantity(Request $request)
    {
        // Récupération du Panier en cours
        $user = session('subsession');
        $panier = Panier::where('user_id', $user['user']->id)
                        ->where('is_validated', false)
                        ->first();

        // Check des données envoyées dans la requête. 
        $validatedData = $request->validate([
            'product_id' => 'required|numeric|exists:products,id',
            'state' => 'required|string|exists:states,name'
        ]);
        // Récupération es input de la requete
        $productId = $validatedData['product_id'];
        $state = $validatedData['state'];
        
        $existingProduct = $panier->products()->wherePivot('product_id', $productId)
                            ->wherePivot('state', $state)
                            ->first();
        if($existingProduct){
            $currentQuantity = $existingProduct->pivot->quantity ;
            if($currentQuantity > 1){
                DB::table('product_panier')
                    ->where('product_id', $productId)
                    ->where('state', $state)
                    ->where('panier_id', $panier->id)
                    ->update(['quantity' => $currentQuantity - 1])
                ;
            }
            else{
                DB::table('product_panier')
                    ->where('product_id', $productId)
                    ->where('state', $state)
                    ->where('panier_id', $panier->id)
                    ->delete()
                ;
            }
        }
        return redirect()->route('reception.cart')->with('success', 'Produit retiré');
    }

    public function dropProducts(Request $request)
    {
        $user = session('subsession');
        $panier = Panier::where('user_id', $user['user']->id)
            ->where('is_validated', false)
            ->first();
        
        // Check des données envoyées dans la requête. 
        $validatedData = $request->validate([
            'product_id' => 'required|numeric|exists:products,id',
            'state' => 'required|string|exists:states,name'
        ]);
        // Récupération es input de la requete
        $productId = $validatedData['product_id'];
        $state = $validatedData['state'];
        
        $existingProduct = $panier->products()->wherePivot('product_id', $productId)
            ->wherePivot('state', $state)
            ->first();

        if($existingProduct){
            DB::table('product_panier')
                ->where('product_id', $productId)
                ->where('state', $state)
                ->where('panier_id', $panier->id)
                ->delete()
            ;
        }
        return redirect()->route('reception.cart');
    }

    public function dropCart(Request $request)
    {
        $validatedData = $request->validate([
            'panier_id' => 'required|numeric|exists:paniers,id'
        ]);
        $panierId = $validatedData['panier_id'];
        
        $panier = Panier::where('id', $panierId)->where('is_validated', false)->first();
        if($panier){
            $panier->products()->detach();
            $panier->delete();

            return redirect()->route('reception.dashboard')->with('success', 'Panier supprimé avec succès.');
        }
        return redirect()->route('reception.dashboard')->with('error', 'Impossible de trouver le panier');
    }
    
    public function validate(Request $request)
    {
        $validatedData = $request->validate([
            'panier_id' => 'required|numeric|exists:paniers,id'
        ]);
        if($request->has('panier_id')){
            session(['panier_id' => $validatedData['panier_id']]);
        }
        return view('reception.cart.validate', ["panier_id" => $validatedData['panier_id']]);
    }

    public function showClientSearch(Request $request){
        $account = $request->user();
        $panier_id = session('panier_id');
        $query = $request->input('query');
        
        $clients = Client::where('account_id', $account->id)
            ->when($query, function($q) use ($query){
                return $q->where('email', 'LIKE', "%$query%")
                    ->orWhere('phone', 'LIKE', "%$query%")
                ;
            })
            ->get();
        return view('reception.cart.validate', compact('clients', 'query', 'panier_id'));
    }

    public function associate(Request $request)
    {
        if(session("panier_id")){
            $panier_id = session()->pull('panier_id');
        }

        // Si le client id n'existe pas mais que nous sommes dans cette fonction c'est que nous avons créer un client à la volée
        if(!$request->has('client_id')){
            //dd($request->all());
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
            // On viens chopper le client fraichement crée pour l'associer au panier.
            $client_id = $client->id;
        }
        
        $panier = Panier::find($panier_id);
        if($panier){
            // Logique de transition/dasactivation du panier <-> ticket
            $panier->client_id = $client_id;
            $panier->is_validated = true;
            $panier->save();
            // Logique de création du ticket_reprise
        }

        return redirect()->route('reception.cart.generate', ['panier_id' => $panier_id]);
    }

    public function generateTicketReprise($panier_id)
    {
        //TODO
    }
    
    /**
     * Fonction utilitaire pour supprimer un produit de la session
     * @return void
     */
    public function forgetMyProductInSession(): void
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
    }
}