<?php

namespace App\Http\Controllers;

use App\Mail\TicketRedit;
use App\Models\Account;
use App\Models\Brand;
use App\Models\Client;
use App\Models\Picture;
use App\Models\Product;
use App\Models\Role;
use App\Models\State;
use App\Models\TicketReprise;
use App\Models\Type;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Ticket;

use function PHPUnit\Framework\isNull;

class AdminController
{

    /**
     * @property session(subsession) $user , récupère l'user dans la session
     */
    private $user ;

    public function __construct()
    {
        $this->user = session('subsession.user');
    }


    /**
     * Settings
     */
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

            $account->compacted_mode = !$request->has("compacted_mode") ? false : true;

            $account->save();
            if($account->login === SUPER_ADMIN_LOGIN ){
                return redirect()->route('dashboard');
            }
            return redirect()->route('admin.dashboard');
        }

        return view('admin.settings', [ "account"=> $account, "user" => $this->user ]);
    }

    /**
     * Dashboard
     */
    public function dashboard(Request $request)
    {
        $roleName = session('subsession.role_name');
        
        // Petit clean session au cas où l'utilisateur viendrais d'un filtre sur produits.
        if(session('brand_filter') || session('type_filter')){
            if(session('brand_filter')){
                session()->forget('brand_filter');
            }
            if(session('type_filter')){
                session()->forget('type_filter');
            }
        }

        return view('admin.dashboard', ["user" => $this->user, "role" => $roleName]);
    }

    /**
     * Utilisateurs
     */
    public function getUsers()
    {
        return view('admin.users.users', ['users' => User::all(), "currentUser" => $this->user]);
    }
    
    public function createUser(Request $request)
    {
        $accountId = $this->user["account_id"];
        if($request->isMethod('post')){
            $account = $request->user();
            $validatedData = $request->validate([
                "name" => 'required|string|max:255',
                "email" => 'required|email|max:255',
                "password" => 'required|string|max:255',
                "confirm_password" => 'required|string|max:255|same:password',
                "roles" => 'required|array'
            ]);
            
            $existingUser = User::where('email', $validatedData['email'])->first();
            if($existingUser){
                return redirect()->route('admin.users')->with('error', 'Un utilisateur est déjà enregistré avec cette adresse mail : ' . $validatedData['email'] . ' .');
            }
            
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
        return view('admin.users.create-or-modify', ["roles" => Role::all(), "currentUser" => $this->user]);
}

    public function modifyUser(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        if($request->isMethod('put')){
            try {
                $validatedData = $request->validate([
                    "name" => 'required|string|max:255',
                    "email" => 'required|string|max:255|unique:users,email,NULL,id',
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
                return redirect()->route('admin.users')->with('error', $e->errors());
            }
        }
        return view('admin.users.create-or-modify',[
            "currentUser" => $this->user,
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
        return view('admin.brands.brands', ['brands' => Brand::all(), "user" => $this->user]);
    }

    public function createBrand(Request $request)
    {
        $pictures = Picture::all();
        if($request->isMethod('post')){
            $account = $request->user();
            $validatedData = $request->validate([
                "name" => "required|string|max:120",
                "icon_path" => "nullable|exists:pictures,id",
                "new_icon" => "nullable|file|mimes:png,svg|max:2048"
            ]);

            $brandName = strtoupper($validatedData['name']);
            $brand = new Brand();

            // Upload d'une icone
            if($request->has('new_icon')){
                $path = $request->file('new_icon')->store('icons', 'public');

                // Enregistrement de l'entité Picture et mise en place de la relation implicite
                $picture = new Picture();
                $picture->name = $request->file('new_icon')->getClientOriginalName();
                $picture->path = $path;
                $picture->type = 'icon';
                $picture->save();

                $brand->icon_path = $picture->id;
            }
            elseif($request->filled('icon_path')){
                $brand->icon_path = $validatedData['icon_path'];
            }

            $brand->account_id = $account->id;
            $brand->name = $brandName;
            $brand->save();

            return redirect()->route('admin.brands')->with('success', 'Marque créée avec succès.');
        }
        return view('admin.brands.create-or-modify', ["pictures" => $pictures, "user" => $this->user]);
    }

    public function modifyBrand(Request $request, $brand_id)
    {
        $brand = Brand::findOrFail($brand_id);
        $pictures = Picture::all();
        if($request->isMethod('put')){

            $validatedData = $request->validate([
                'name' => 'required|string|max:120',
                "icon_path" => "nullable|exists:pictures,id",
                "new_icon" => "nullable|file|mimes:png,svg|max:2048"
            ]);
            $validatedData['name'] = strtoupper($validatedData['name']);
            
            if($request->has('new_icon')){
                $path = $request->file('new_icon')->store('icons', 'public');
                // Enregistrement de l'entité Picture et mise en place de la relation implicite
                $picture = new Picture();
                $picture->name = $request->file('new_icon')->getClientOriginalName();
                $picture->path = $path;
                $picture->type = 'icon';
                $picture->save();

                $brand->icon_path = $picture->id;
            }            
            elseif($request->filled('icon_path')){
                $brand->icon_path = $validatedData['icon_path'];
            }
            
            $brand->name = $validatedData['name'];
            $brand->save();

            return redirect()->route('admin.brands')->with('success', 'Marque modifiée avec succès');
        }
        return view('admin.brands.create-or-modify', ['brand' => $brand, 'pictures' => $pictures, "user" => $this->user]);
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
        return view('admin.types.types', ['types' => Type::all(), "user" => $this->user]);
    }

    public function createType(Request $request)
    {
        $pictures = Picture::all();
        if($request->isMethod('post')){
            $account = $request->user();
            $validatedData = $request->validate([
                "name" => "required|string|max:120",
                "icon_path" => "nullable|exists:pictures,id",
                "new_icon" => "nullable|file|mimes:png,svg|max:2048"
            ]);
            $type = new Type();
            $type->account_id = $account->id;
            
            if($request->has('new_icon')){
                $path = $request->file('new_icon')->store('icons', 'public');
                // Enregistrement de l'entité Picture et mise en place de la relation implicite
                $picture = new Picture();
                $picture->name = $request->file('new_icon')->getClientOriginalName();
                $picture->path = $path;
                $picture->type = 'icon';
                $picture->save();

                $type->icon_path = $picture->id;
            }
            elseif($request->filled('icon_path')){
                $type->icon_path = $validatedData['icon_path'];
            }
            
            $type->name = strtoupper($validatedData['name']);
            $type->save();

            return redirect()->route('admin.types')->with('success', 'Type créé avec succès.');
        }
        return view('admin.types.create-or-modify', ["pictures" => $pictures, "user" => $this->user]);
    }

    public function modifyType(Request $request, $type_id)
    {
        $pictures = Picture::all();
        $type = Type::findOrFail($type_id);
        if($request->isMethod('put')){
            $validatedData = $request->validate([
                'name' => 'required|string|max:120',
                "icon_path" => "nullable|exists:pictures,id",
                "new_icon" => "nullable|mimes:png,svg|max:2048"
            ]);
            
            if($request->has('new_icon')){
                $path = $request->file('new_icon')->store('icons', 'public');
                $picture = new Picture();
                $picture->name = $request->file('new_icon')->getClientOriginalName();
                $picture->path = $path;
                $picture->type = 'icon';
                $picture->save();
                
                $type->icon_path = $picture->id; 
            }
            elseif($request->filled('icon_path')){
                $type->icon_path = $validatedData['icon_path'];
            }
            
            $type->name = strtoupper($validatedData['name']); 
            $type->save();

            return redirect()->route('admin.types')->with('success', 'Type modifié avec succès');
        }
        return view('admin.types.create-or-modify', ['type' => $type, 'pictures' => $pictures, "user" => $this->user]);
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
        return view('admin.states.states', ['states' => State::all(), "user" => $this->user]);
    }

    public function createState(Request $request)
    {
        if($request->isMethod('post')){
            $account = $request->user();
            $validatedData = $request->validate([
                "name" => "required|string|max:255",
                "definition" => "nullable|string",
                "infos" => 'nullable|string'
            ]);
            $state = new State();
            $state->account_id = $account->id;
            $state->name = strtoupper($validatedData['name']);
            $state->definition = $validatedData['definition'];
            $state->infos = $validatedData['infos'];
            $state->save();

            return redirect()->route('admin.states')->with('success', 'Etat créé avec succès.');
        }
        return view('admin.states.create-or-modify', ["user" => $this->user]);
    }

    public function modifyState(Request $request, $state_id)
    {
        $state = State::findOrFail($state_id);
        if($request->isMethod('put')){
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'definition' => 'nullable|string',
                'infos' => 'nullable|string'
            ]);
            $validatedData['name'] = strtoupper($validatedData['name']); 
            $state->update($validatedData);

            return redirect()->route('admin.states')->with('success', 'Etat modifié avec succès');
        }
        return view('admin.states.create-or-modify', ['state' => $state, "user" => $this->user]);
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
    public function getProducts(Request $request)
    {
        $typeId = $request->input('type');
        $brandId = $request->input('brand');

        if($brandId !== null){
            session(['brand_filter' => $brandId]);
        }
        if($typeId !== null){
            session(['type_filter' => $typeId]);
        }
        $brandFilter = session('brand_filter', null);
        $typeFilter = session('type_filter', null);
        
        switch (true) {
            case ($brandFilter && $typeFilter):
                $products = Product::where('brand_id', $brandFilter)
                    ->where('type_id', $typeFilter)
                    ->get();
                break;
            case ($brandFilter):
                $products = Product::where('brand_id', $brandFilter)
                    ->get();
                break;
            case ($typeFilter):
                $products = Product::where('type_id', $typeFilter)
                    ->get();
                break;
            default:
                $products = Product::all();
                break;
        }

        return view('admin.products.products', ['products' => $products, "user" => $this->user, "types" => Type::all(), "brands"=>Brand::all()]);
    }

    public function dropSessionFilters($filter_name){
        session()->forget($filter_name);
        return redirect()->route('admin.products');
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
                $codeCaisseKey = 'code_caisse_state_' . $state->id;
                if($request->has($prixRemboursementKey) || $request->has($prixBonAchatKey) || $request->has($codeCaisseKey)){
                    // Validation des données 
                    $validatedPrices = $request->validate([
                        $prixRemboursementKey => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
                        $prixBonAchatKey => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
                        $codeCaisseKey => 'nullable|string|max:13',
                    ]);

                    $prixRemboursement = $validatedPrices[$prixRemboursementKey] ?? null;
                    $prixBonAchat = $validatedPrices[$prixBonAchatKey] ?? null;
                    $codeCaisse = $validatedPrices[$codeCaisseKey] ?? null;
                    if($prixRemboursement !== null || $prixBonAchat !== null || $codeCaisse !== null ){
                        $product->states()->attach($state->id, [
                            'prix_remboursement' => $prixRemboursement,
                            'prix_bon_achat' => $prixBonAchat,
                            'code_caisse' => $codeCaisse,
                        ]);
                    }
                }
            }
            return redirect()->route('admin.products')->with('success', 'Produit ajouté avec succès');
        }
        return view('admin.products.create-or-modify', [
            "user" => $this->user,
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
                $codeCaisseKey = "code_caisse_state_{$state->id}";
                // Validation des données 
                $validatedPrices = $request->validate([
                    $prixRemboursementKey => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
                    $prixBonAchatKey => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
                    $codeCaisseKey => 'nullable|string|max:13',
                ]);
                $prixRemboursement = $validatedPrices[$prixRemboursementKey];
                $prixBonAchat = $validatedPrices[$prixBonAchatKey];
                $codeCaisse = $validatedPrices[$codeCaisseKey];

                if(is_null($prixRemboursement) && is_null($prixBonAchat) && is_null($codeCaisse)){
                    $product->states()->detach($state->id);
                }
                else if(!is_null($prixRemboursement || !is_null($prixBonAchat) || !is_null($codeCaisse))){
                    $stateData[$state->id] = [
                        'prix_remboursement' => $prixRemboursement,
                        'prix_bon_achat' => $prixBonAchat,
                        'code_caisse' => $codeCaisse,
                    ];
                }
            }
            $product->states()->sync($stateData);

            return redirect()->route('admin.products')->with('success', 'Poduit modifié avec succès.');
        }
        return view('admin.products.create-or-modify', [
            "user" => $this->user,
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
        session(['previous_url' => url()->current()]);
        $tickets = TicketReprise::orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.tickets.tickets', ['user' => $this->user, "tickets" => $tickets]);
    }

    public function searchTicket(Request $request)
    {
        session(['previous_url' => url()->current()]);
        $validatedData = $request->validate([
            "query" => 'string|nullable|max:80'
        ]);

        $query = $validatedData['query'] ?? '';

        $ticketsQuery = TicketReprise::where('is_activated', true);
        if(!empty($query)){
            $ticketsQuery = TicketReprise::where('is_activated', true)
                ->where(function($q) use ($query){
                    $q->where('uuid', $query)
                    ->orWhereHas('client', function($queryBuilder) use ($query){
                        $queryBuilder->where('firstname', 'LIKE', "%{$query}%")
                            ->orWhere('lastname', 'LIKE', "%{$query}%");
                    });
                }
            );
        }

        $tickets = $ticketsQuery->paginate(25)->withQueryString();

        return view('admin.tickets.tickets', ["user"=> $this->user, "tickets" => $tickets]);
    }

    public function showTicket($ticket_id)
    {
        $ticket = TicketReprise::where('uuid', $ticket_id)->first();
        return view('admin.tickets.ticket', ['user' => $this->user, 'ticket'=>$ticket]);
    }

    public function sendReditTicket($ticket_id)
    {
        $ticket = TicketReprise::where('uuid', $ticket_id)->first();
        if(!$ticket){
            return redirect()->route('admin.dashboard')->with('error', 'Erreur sur le Ticket: Introuvable');
        }
        
        if($ticket->client->email){
            Mail::to($ticket->client->email)->send(new TicketRedit($ticket));
            return redirect()->route('admin.ticket.show', ['ticket_id'=> $ticket->uuid])->with('success', 'Ticket Envoyé par mail à : ' . $ticket->client->email . ' .');
        }
        return redirect()->route('admin.ticket.show', ['user'=>$this->user, 'ticket'=> $ticket->uuid])->with('error', 'Le client n\'pas d\'adresse email dans son profil..');
    }

    public function printReditTicket($ticket_id)
    {
        session()->flash('print_ticket_uuid_redit', $ticket_id);
        return redirect()->route('admin.ticket.show', ['ticket_id'=>$ticket_id]);
    }

    public function printReditTicketView($ticket_id)
    {
        $ticket = TicketReprise::where('uuid', $ticket_id)->first();
        $data = ["ticket" => $ticket];
        $pdf = Pdf::loadView('pdf.ticket_redit', $data)
            ->setPaper([0, 0, 226, 600]);
        return $pdf->stream("Ticket-{$ticket->uuid}.pdf");
    }

    /**
    * Client <-> tickets , réimpression, recherches ect .
    */
    public function getClients()
    {
        $clients = Client::orderBy('created_at', 'desc')
            ->paginate(25)
            ->withQueryString();
        
        return view('admin.clients.clients', ["clients" => $clients, "user" => $this->user ]);
    }

    public function searchClients(Request $request)
    {
        $query = $request->input('query');

        $clientsQuery = Client::orderBy('created_at', 'desc');

        if(!empty($query)){
            $clientsQuery->where(function($q) use ($query){
                $q->where('firstname', 'LIKE', "%{$query}%")
                ->orWhere('lastname', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->orWhere('phone', 'LIKE', "%{$query}%");
            });
        }
        $clients = $clientsQuery->paginate(25)->withQueryString();

        return view('admin.clients.clients', ['user'=>$this->user, "clients"=>$clients]);
    }

    public function showClient($client_id)
    {
        session(['previous_url' => url()->current()]); // on vient stocker l'url actuel
        $client = Client::with('tickets')->findOrFail($client_id);
        return view('admin.clients.client', ['user' => $this->user, 'client'=>$client]);
    }

    /**
     * Methode lié à la modification à la volée d'un client dans la vue /clients/{client_id}
     */
    public function updateClient(Request $request, $client_id)
    {
        $client = Client::where('id', $client_id)->first();
        
        if(!$client){
            return response()->json([
                "message" => "Client non trouvé",
            ], 404);
        }

        $validatedData = $request->validate([
            'field' => 'required|in:firstname,lastname,email,phone',
            'value' => 'nullable|string|max:255',
        ]);

        $client->update([$validatedData['field'] => $validatedData['value']]);
        
        return response()->json(['message' => 'Ressource patché avec succès'], 200);
    }
    
    
    public function getStats()
    {
        return view('admin.stats.stats', ['user' => $this->user]);
    }

    public function getJsonStats()
    {

        //liste des exception, tests et reprise SAV
        $account = $this->user->account_id;
        $ignoreRaw = env('LIST_IGNORE_CLIENTS_' . $account);
        $clientIdsToIgnore = array_filter(explode(',', $ignoreRaw)); 

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $tickets = [
            "all" => TicketReprise::where('is_activated', true)
            ->whereIn('type_utilisation', ['remboursement', 'bon_achat'])
            ->count(),
            "monthly" => TicketReprise::where('is_activated', true)
            ->whereIn('type_utilisation', ['remboursement', 'bon_achat'])
            ->whereBetween('created_at',[
                $startOfMonth,
                $endOfMonth,
            ])
            ->count(),
            "weekly" => TicketReprise::where('is_activated', true)
            ->whereIn('type_utilisation', ['remboursement', 'bon_achat'])
            ->whereBetween('created_at',[
                $startOfWeek,
                $endOfWeek,
            ])
            ->count(),
        ];
        
        $clients = [
            'all' => Client::whereNotIn('id', $clientIdsToIgnore)->count(),
            'monthly' => Client::whereBetween('created_at', [
                $startOfMonth,
                $endOfMonth,
            ])
            ->whereNotIn('id', $clientIdsToIgnore)
            ->count(),
            'weekly' => Client::whereNotIn('id', $clientIdsToIgnore)
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count()
        ];

        $bons = [
            'all' => number_format($this->getTotalBon(null, null, $clientIdsToIgnore), 2),
            'monthly' => number_format($this->getTotalBon($startOfMonth, $endOfMonth, $clientIdsToIgnore), 2),
            'weekly' => number_format($this->getTotalBon($startOfWeek, $endOfWeek, $clientIdsToIgnore),2) 
        ];
        $cash = [
            'all' => number_format($this->getTotalRemboursement(null, null, $clientIdsToIgnore), 2),
            'monthly' => number_format($this->getTotalRemboursement($startOfMonth, $endOfMonth, $clientIdsToIgnore), 2),
            'weekly' => number_format($this->getTotalRemboursement($startOfWeek, $endOfWeek, $clientIdsToIgnore),2) 
        ];
        $articles = [
            'all' => $this->getTotalArticles(null, null, $clientIdsToIgnore),
            'monthly' => $this->getTotalArticles($startOfMonth, $endOfMonth, $clientIdsToIgnore),
            'weekly' => $this->getTotalArticles($startOfWeek, $endOfWeek, $clientIdsToIgnore)
        ];
        $periods = [
            'all' => [
                'start' => "Depuis le début",
                'end' => Carbon::now()->format('d/m/Y'),
            ],
            'monthly' => [
                'start' => $startOfMonth->format('d/m/Y'),
                'end' => $endOfMonth->format('d/m/Y'),
            ],
            'weekly' => [
                'start' => $startOfWeek->format('d/m/Y'),
                'end' => $endOfWeek->format('d/m/Y')
            ]
        ];
        return response()->json([
            "tickets" => $tickets,
            "clients" => $clients,
            "total_bon_achat" => $bons,
            "total_remboursement" => $cash,
            "articles" => $articles,
            "periods" => $periods
        ], 200);
    }


    function getTotalBon($start = null, $end = null, $clientIdsToIgnore=[])
    {
        $query = TicketReprise::with('panier')
            ->where('is_activated', true)
            ->where('type_utilisation', 'bon_achat')
            ->whereHas('panier', function ($q) use ($clientIdsToIgnore) {
                $q->whereNotIn('client_id', $clientIdsToIgnore);
            });
    

        if ($start && $end) {
            $query->whereBetween('created_at', [$start, $end]);
        }

        return $query->get()
            ->sum(fn($ticket) => $ticket->panier?->total_bon_achat ?? 0);
    }
    

    function getTotalRemboursement($start = null, $end = null, $clientIdsToIgnore=[])
    {
        $query = TicketReprise::with('panier')
            ->where('is_activated', true)
            ->where('type_utilisation', 'remboursement')
            ->whereHas('panier', function ($q) use ($clientIdsToIgnore) {
                $q->whereNotIn('client_id', $clientIdsToIgnore);
            });

        if ($start && $end) {
            $query->whereBetween('created_at', [$start, $end]);
        }

        return $query->get()
            ->sum(fn($ticket) => $ticket->panier?->total_remboursement ?? 0);
    }


    function getTotalArticles($start = null, $end = null, $clientIdsToIgnore=[])
    {
        $ticketQuery = TicketReprise::where('is_activated', true)
            ->whereIn('type_utilisation', ['bon_achat', 'remboursement'])
            ->whereHas('panier', function ($q) use ($clientIdsToIgnore) {
                $q->whereNotIn('client_id', $clientIdsToIgnore);
            });

        if ($start && $end) {
            $ticketQuery->whereBetween('created_at', [$start, $end]);
        }

        $panierIds = $ticketQuery->pluck('panier_id')->filter()->unique();

        return DB::table('product_panier')
            ->whereIn('panier_id', $panierIds)
            ->sum('quantity');
    }
}