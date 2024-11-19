<?php

namespace App\Http\Controllers;

use App\Mail\TicketConsume;
use App\Models\TicketReprise;
use Barryvdh\DomPDF\Facade\Pdf;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            // Si mail , envoi du mail avec un récap de la comsommation du ticket 
            if($ticket->client->email){
                Mail::to($ticket->client->email)->send(new TicketConsume($ticket));
            }
            return redirect()->route('encaissement.dashboard')->with('success', "Ticket de reprise $ticket->uuid validé.");
        }
    }

    // Route Post de restitution.
    public function restituteTicket($ticket_uuid)
    {
        
        // Logique de deactivation && suppression du ticket && mail de retitution ou impression ?
        // bascule du panier en état Annulé && prévoir de passer le panier en Restitué ?
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
}
