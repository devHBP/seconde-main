<?php 

namespace App\Http\Controllers;

use App\Mail\TicketRepriseMail;
use App\Models\Brand;
use App\Models\Client;
use App\Models\Panier;
use App\Models\Product;
use App\Models\State;
use App\Models\TicketReprise;
use App\Models\Type;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Milon\Barcode\DNS1D;

class ReceptionController
{
    private $itemsInCart;
    private $cartInProgress;
    private $user;
    
    public function __construct()
    {
        $this->user = session("subsession");
        $panier = Panier::where('user_id', $this->user['user']->id)
        ->where('status', 'en_cours')
        ->with('products')
        ->first();

        if($panier){
            $this->cartInProgress = true;
            $this->itemsInCart = count($panier->products);
        }

        
    }

    public function dashboard()
    {
        $user = session('subsession.user');
        $roleName = session('subsession.role_name');
        $panierCount = count(Panier::where('status', 'annule')->get());
        return view('reception.dashboard', [
            'user' => $user,
            'role' => $roleName,
            'panierCount'=>$panierCount,
            'itemsInCart' => $this->itemsInCart,
            'cartInProgress' => $this->cartInProgress,
            'tickets' => TicketReprise::where('is_activated', false)->get()
        ]);
    }

    public function addProduct(Request $request)
    {
        $userId = session('subsession');
        $user = User::findOrFail($userId['user']->id);
        $role = session('subsession.role_name'); 
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

            if($typeId){
                $brands = Brand::whereHas('products', function($query) use ($typeId){
                    $query->where('type_id', $typeId);
                })->distinct()->get();
            }

            if($typeId && $brandId){
                $product = Product::where('type_id', $typeId)
                    ->where('brand_id', $brandId)
                    ->first();
                
                if($product){
                    $states = $product->states()->get();
                    if($stateId){
                        $selectedState = $states->firstWhere('id', $stateId);
                    }
                }
            }
            
            // Validation, Controle
            // Creation d'un panier ou retour en arrière 
            return view('reception.products.product', compact(
                'role',
                'user',
                'states',
                'product',
                'brands',
                'types',
                'selectedState',
            ));
        }
        return view('reception.products.product', [
            'role' => $role,
            'user' => $user,
            'types' => $types,
            'brands' => $brands,
            'product' => $product,
            'states' => $states,
            'selectedState' => $selectedState
        ]);
    }

    public function cancel()
    {
        $this->forgetMyProductInSession();
        return redirect()->route('reception.dashboard');
    }

    // Gestion des utilisateurs 
    public function getClient()
    {
        return view('reception.clients.clients', ["clients" => Client::all(), "user" => session('subsession.user')]);
    }

    public function createClient(Request $request)
    {
        if($request->isMethod('post')){
            $account = $request->user();
            $validatedData = $request->validate([
                "firstname" => 'required|string|max:255',
                "lastname" => 'required|string|max:255',
                "email" => 'nullable|email|required_without:phone|unique:users,email,NULL,id',
                "phone" => 'nullable|digits:10|required_without:email',
                "consent" => 'required|boolean'
            ]);
            
            $existingUser = User::where('email', $validatedData['email'])->first();
            if($existingUser){
                return redirect()->route('reception.clients')->with('error', 'Un client est déjà enregistré avec cette adresse mail : ' . $validatedData['email'] . ' .');
            }

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
        
        return view('reception.clients.create-or-modify', ['user'=>session('subsession.user')]);
    }

    public function modifyClient(Request $request, $client_id)
    {
        $client = Client::findOrFail($client_id);

        if($request->isMethod('put')){
            $validatedData = $request->validate([
                "firstname" => 'required|string|max:255',
                "lastname" => 'required|string|max:255',
                "email" => 'nullable|email|required_without:phone|unique:users,email,NULL,id',
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
        return view('reception.clients.create-or-modify', ['client' => $client, 'user' => session('subsession.user')]);
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
        return view('reception.clients.create-or-modify', ["client" => $client, 'user' => session('subsession.user')]);
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
                        ->where('status', 'en_cours')
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

        if($typeId){
            
        }
        $product = Product::where('type_id', $typeId)
                            ->where('brand_id', $brandId)
                            ->with('states')
                            ->first();

        $prixRemboursement = null;
        $prixBonAchat = null;
        $codeCaisse = null;

        // Recherche dans les states
        foreach($product->states as $state){
            if($state->id == $stateId){
                $prixRemboursement = $state->pivot->prix_remboursement;
                $prixBonAchat = $state->pivot->prix_bon_achat;
                $codeCaisse = $state->pivot->code_caisse;
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
                'code_caisse' => $codeCaisse,
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
                        ->where('status', 'en_cours')
                        ->with('products')
                        ->first();
        
        if(!$panier){
            return redirect()->route('reception.dashboard')->with('error', 'Auncun panier en cours');
        }
        $totalRemboursement = 0;
        $totalBonAchat = 0;

        foreach($panier->products as $product){
            $totalRemboursement += floatval($product->pivot->prix_remboursement) * $product->pivot->quantity;
            $totalBonAchat += floatval($product->pivot->prix_bon_achat) * $product->pivot->quantity;
        }

        $panier->total_remboursement = $totalRemboursement;
        $panier->total_bon_achat = $totalBonAchat;
        $panier->save();

        return view('reception.cart.cart', [
            "user" => $user['user'],
            "panier" => $panier,
            "total_remboursement" => $totalRemboursement,
            "total_bon_achat" => $totalBonAchat
        ]);
    }

    public function increaseQuantity(Request $request)
    {
        $user = session("subsession");
        $panier = Panier::where('user_id', $user['user']->id)
                        ->where('status', 'en_cours')
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
                        ->where('status', 'en_cours')
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
            ->where('status', 'en_cours')
            ->first();
        // Check des données envoyées dans la requête. 
        $validatedData = $request->validate([
            'product_id' => 'required|numeric|exists:products,id',
            'state' => 'required|string|exists:states,name'
        ]);
        // Récupération des input de la requete
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
        
        $panier = Panier::where('id', $panierId)->where('status', 'en_cours')->first();

        if($panier){
            $panier->products()->detach();
            $panier->delete();

            return redirect()->route('reception.dashboard')->with('success', 'Panier supprimé avec succès.');
        }
        return redirect()->route('reception.dashboard')->with('error', 'Impossible de trouver le panier');
    }
    
    public function validate(Request $request)
    {
        $user = session('subsession.user');
        $validatedData = $request->validate([
            'panier_id' => 'required|numeric|exists:paniers,id'
        ]);
        if($request->has('panier_id')){
            session(['panier_id' => $validatedData['panier_id']]);
        }
        return view('reception.cart.validate', ["panier_id" => $validatedData['panier_id'], "user" => $user]);
    }

    public function showClientSearch(Request $request){
        $user = session('subsession.user');
        $account = $request->user();
        $panier_id = session('panier_id');
        $query = $request->input('query');
        
        $clients = Client::where('account_id', $account->id)
            ->when($query, function($q) use ($query){
                return $q->where('email', 'LIKE', "%$query%")
                    ->orWhere('phone', 'LIKE', "%$query%")
                    ->orWhere('firstname', 'LIKE', "%$query%")
                ;
            })
            ->get();
        return view('reception.cart.validate', compact('clients', 'query', 'panier_id', 'user'));
    }

    public function associate(Request $request)
    {
        // Si le client id n'existe pas mais que nous sommes dans cette fonction c'est que nous avons créer un client à la volée
        if(!$request->has('client_id')){
            $account = $request->user();
            $validatedData = $request->validate([
                "firstname" => 'required|string|max:255',
                "lastname" => 'required|string|max:255',
                "email" => 'nullable|email|required_without:phone|unique:users,email,NULL,id',
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
        else{
            $validatedData = $request->validate([
                'client_id' => 'required|numeric|exists:clients,id',
                'panier_id' => 'required|numeric|exists:paniers,id',
                'print_ticket' => 'nullable'
            ]);
            $client_id = $validatedData['client_id'];
            $panier_id =$validatedData['panier_id'];
            $printTicket = $validatedData['print_ticket'] ?? null;

            $client = Client::findOrFail($client_id);
        }
        
        if(session("panier_id")){
            $panier_id = session()->pull('panier_id');
        }
        $panier = Panier::find($panier_id);
        if($panier){
            // Logique de transition/desactivation du panier <-> ticket
            $panier->client_id = $client_id;
            $panier->status = 'valide';
            $panier->save();
        }

        $ticket = $this->generateTicketReprise($panier->id);

        $barcodeGenerator = new DNS1D();
        
        $barcode = $barcodeGenerator->getBarcodeSVG($ticket->uuid, 'C128');
        dd($barcode);
        $barcodeBinary = base64_decode($barcode);
        $barcodeBase64 = base64_encode($barcodeBinary);
        $filename = $ticket->uuid . '.png';
        if($client->email){
            Mail::to($ticket->client->email)->send(new TicketRepriseMail($ticket, $barcode, $filename));
        }

        if(isset($printTicket) && (!$client->email || $printTicket === "on") || (!$client->email)){
            session()->flash('print_ticket_uuid', $ticket->uuid);
        }

        return redirect()->route('reception.dashboard')->with('success', 'Panier envoyé en encaissement.');
    }

    /**
     * Fonction de génération du TicketReprise
     *
     * @param PANIER $panier_id
     * @return TicketReprise $ticket
     */
    public function generateTicketReprise($panier_id)
    {
        $currentUser = session('subsession');
        $user = User::findOrFail($currentUser['user']->id);
        if(session("panier_id")){
            session()->forget('panier_id');
        }

        $panier = Panier::findOrFail($panier_id);
        if($panier->status !== 'valide'){
            return redirect()->route('reception.cart')->withErrors("Un problème à été détécté avec le status du panier.");
        }

        // Création du TicketReprise
        $ticket = new TicketReprise();
        $ticket->uuid = $this->generateCustomTicketCode($panier->account->id, $user->id);
        $ticket->panier_id = $panier->id;
        $ticket->client_id = $panier->client_id;
        $ticket->account_id = $panier->account_id;
        $ticket->created_by = $user->id;
        $ticket->created_by_name = $user->name;
        $ticket->deactivated_by_name = '';
        $ticket->save();
        
        return $ticket;
    }

    public function printTicket($ticket_uuid)
    {
        $ticket = TicketReprise::where('uuid', $ticket_uuid)->first();

        return view('reception.ticket.print', ["ticket" => $ticket]);
    }

    public function printTicketEmbededView($ticket_uuid)
    {
        $ticket = TicketReprise::where('uuid', $ticket_uuid)->first();

        $barcodeGenerator = new DNS1D();
        $barcode = $barcodeGenerator->getBarcodePNG($ticket->uuid, 'C128', 2, 70);
        $barcodeBinary = base64_decode($barcode);
        $barcodeBase64 = base64_encode($barcodeBinary);
        dd($barcodeBase64);
        $data = [
            'ticket' => $ticket,
            'barcode' => $barcodeBase64
        ];

        $pdf = Pdf::loadView('pdf.ticket_reprise', $data)
            ->setPaper([0, 0, 226, 600]);
        return $pdf->stream("Ticket-{$ticket->uuid}.pdf");
    }


    /**
     * Gestion des paniers retours
     */
    public function getAllCartsToReturn()
    {
        $ticketsAborted = TicketReprise::where('is_activated', true)
            ->whereHas('panier', function ($query){
                $query->where('status', 'annule');
            })->get();
        return view('reception.returns.carts', ["tickets" => $ticketsAborted, 'user'=>session('subsession.user')]);
    }

    public function cartToSearch(Request $request)
    {
        $account = $request->user();
        $validatedData = $request->validate([
            'query' => 'nullable|string|max:14',
        ]);

        $query = $validatedData['query'];
        if(!empty($query)){
            $ticket = TicketReprise::where('account_id', $account->id)
                ->where('uuid', $query)
                ->whereHas('panier', function($q){
                    $q->where('status', 'annule');
                })->get();
            if(!$ticket){
                $ticket = null;
            }
        }
        else{
            $ticket = TicketReprise::where('is_activated', true)
                ->whereHas('panier', function($q){
                    $q->where('status', 'annule');
                })->get();
        }

        return view('reception.returns.carts', ["tickets" => $ticket]);
    }

    public function cartToReturn(Request $request, $panier_id)
    {
        $panier = Panier::findOrFail($panier_id);
        if($request->isMethod('post')){
            $panier->status = 'restitue';
            $panier->save();
            //? Envisager une impression si besoin est.
            return redirect()->route('reception.dashboard')->with('success', 'Le panier à été correctement réstitué.');
        }

        // case où nous affichons le panier
        return view('reception.returns.cart', ["panier" => $panier, 'user'=>session('subsession.user')]);
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

    public function generateCustomTicketCode($accountId, $userId)
    {
        $ticketCount = TicketReprise::where('account_id', $accountId)->count();

        $ticketNumber = str_pad($ticketCount + 1, 7, '0', STR_PAD_LEFT);
        $formattedAccountId = str_pad($accountId, 2, '0', STR_PAD_LEFT);
        $formattedUserId = str_pad($userId, 3, '0', STR_PAD_LEFT);

        return "S{$formattedAccountId}{$formattedUserId}-{$ticketNumber}";
    }
}