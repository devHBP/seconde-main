<?php

namespace App\Http\Controllers;

use App\Mail\TicketConsume;
use App\Mail\TicketRestitute;
use App\Models\TicketReprise;
use Barryvdh\DomPDF\Facade\Pdf;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Milon\Barcode\DNS1D;

use function PHPUnit\Framework\isEmpty;

class EncaissementController extends Controller
{
    private $user;

    public function __construct()
    {
        $sessionUserData = session('subsession');
        $this->user = $sessionUserData['user'];
    }

    // Route du dashbaboard
    public function dashboard()
    {
        $user = session('subsession');
        return view('encaissement.dashboard', [
            "tickets" => TicketReprise::where('is_activated', false)->get(),
            "user" => $this->user,
        ]);
    }
       
    // Route de recherche via BarCode
    public function searchTicket(Request $request)
    {
        $account = $request->user();
        $validatedData = $request->validate([
            "query" => 'nullable|string|min:8|max:14',
        ]);

        $query = $validatedData['query'];

        if(!empty($query)){
            $ticket = TicketReprise::where('account_id', $account->id)
            ->where('uuid', $query)
            ->where('is_activated', false)
            ->get();

            if(!$ticket){
                $ticket = null;
            }
        }
        else{
            $ticket = TicketReprise::all();
        }

        return view('encaissement.dashboard', ['tickets' => $ticket, "user"=> $this->user, "query" => $query ]);
    }
    // Route pour afficher un panier
    public function showTicket($ticket_uuid)
    {
        $ticket = TicketReprise::where('uuid', $ticket_uuid)->first();
        return view('encaissement.tickets.ticket', ["ticket" => $ticket, "user" => $this->user]);
    }

    // Route Post de validation.
    public function consumeTicket(Request $request)
    {
        if($request->has('ticket_uuid') && $request->has('type_utilisation')){
            $validatedData = $request->validate([
                'ticket_uuid' => 'required|string|max:14',
                'type_utilisation' => 'required|string|in:remboursement,bon_achat'
            ]);
            $ticket_uuid = $validatedData['ticket_uuid'];
            $type_utilisation = $validatedData['type_utilisation'];

            $ticket = TicketReprise::where('uuid', $ticket_uuid)->first();
            if(!$ticket){
                throw new Error('Une erreur est survenue, impossible de trouver le ticket');
            }

            $ticket->deactivated_by = $this->user->id;
            $ticket->deactivated_by_name = $this->user->name;
            $ticket->deactivation_date = now();
            $ticket->type_utilisation = $type_utilisation;
            $ticket->is_activated = true;
            $ticket->save();

            session()->flash('print_ticket_uuid', $ticket->uuid);
            session()->flash('print_supplier_delivery', $ticket_uuid);
            // Si mail , envoi du mail avec un récap de la comsommation du ticket 
            if($ticket->client->email){
                Mail::to($ticket->client->email)->send(new TicketConsume($ticket));
            }
            return redirect()->route('encaissement.dashboard')->with('success', "Ticket de reprise $ticket->uuid validé.");
        }
    }

    // Route Post de restitution.
    public function restituteTicket(Request $request)
    {
        $validatedData = $request->validate([
            'ticket_uuid' => 'required|string|max:14|exists:tickets_reprise,uuid',
        ], [
            "uuid.exists" => "Le code barre ne correspond à aucuns ticket valide",
        ]);

        $ticket = TicketReprise::where('uuid', $validatedData['ticket_uuid'])->first();
        $ticket->deactivated_by = $this->user->id;
        $ticket->deactivated_by_name = $this->user->name;
        $ticket->deactivation_date = now();
        $ticket->type_utilisation = 'annule';
        $ticket->is_activated = true;
        $ticket->save();

        $panier = $ticket->panier;
        $panier->status = 'annule';
        $panier->save();

        session()->flash('print_ticket_return', $ticket->uuid);
        if($ticket->client->email){
            Mail::to($ticket->client->email)->send(new TicketRestitute($ticket));
        }
        return redirect()->route('encaissement.dashboard')->with('success', "Le Ticket $ticket->uuid à bien été annulé.");
    }

    public function restituteIFrameRedirect($ticket_uuid)
    {
        $ticket = TicketReprise::where('uuid', $ticket_uuid);
        return view('pdf.print-restitute', ['ticket' => $ticket]);
    }

    public function printTicketOfRestitute($ticket_uuid)
    {
        $ticket = TicketReprise::where('uuid', $ticket_uuid)->first();

        $data = [
            'ticket' => $ticket,
        ];

        $pdf = Pdf::loadView('pdf.ticket_restitute', $data)
            ->setPaper(0, 0, 226, 600);
        return $pdf->stream('ticket-{ $ticket->uuid }.pdf');
    }
    
    // Tests et mise à l'épreuve du système.
    public function printTicket($ticket_uuid)
    {
        $ticket = TicketReprise::where('uuid', $ticket_uuid)->first();
        return view('pdf.print', [
            'ticket' => $ticket
        ]);
    }

    public function printTicketUsed($ticket_uuid)
    {
        $ticket = TicketReprise::where('uuid', $ticket_uuid)->first();
        $data = [
            'ticket' => $ticket
        ];

        $pdf = Pdf::loadView('pdf.ticket_consume', $data)
            ->setPaper([0, 0, 226, 600]);

        return $pdf->stream("ticket-{ $ticket->uuid }.pdf");
    }

    /**
     * Generation du BL avec le client comme fournisseur
     */
    public function printSupplierDelivery($ticket_uuid)
    {
        $ticket = TicketReprise::where('uuid', $ticket_uuid)->first();

        return view('pdf.supplier-print', [
            'ticket' => $ticket,
        ]);
    }

    public function generateSupplierDelivery($ticket_uuid)
    {
        $ticket = TicketReprise::where('uuid', $ticket_uuid)->first();
        // Sur le ticket , pour chaques produit du panier
        $productsList = [];
        foreach ($ticket->panier->products as $product) {
            // Récupéré les informations
            $productDesignation = $product->type->name;
            $productBrand = $product->brand->name;
            $productState = $product->pivot->state;
            $productQuantity = $product->pivot->quantity;
            $productCodeCaisse = $product->pivot->code_caisse ?? null;

            //Logique de création de code barre
            $barCodeGenerator = new DNS1D();
            if($productCodeCaisse){
                $productBarcode = $barCodeGenerator->getBarcodePNG($productCodeCaisse, 'C128', 2, 30);
            }

            $productsList[] = [
                'designation' => $productDesignation,
                'marque' => $productBrand,
                'etat' => $productState,
                'quantite'=> $productQuantity,
                'code_caisse'=> $productCodeCaisse,
                'base64' => $productBarcode ?? '',
            ];
        }
        $data = [
            'ticket' => $ticket,
            'products' => $productsList,
        ];
        $pdf = Pdf::loadView('pdf.supplier-generate', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream("ticket-{ $ticket->uuid }.pdf");
    }

}
