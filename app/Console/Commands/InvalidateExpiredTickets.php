<?php

namespace App\Console\Commands;

use App\Models\TicketReprise;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class InvalidateExpiredTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:invalidate-expired-tickets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Marque les tickets passé de date et non encaissés, en périmé.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info("Lancement du traitement des tickets périmés.");
        $now = Carbon::now();
        // On dois désactiver ici le global scope la fonction est autonome personne n'est connecté et la vérification porte sur "tout" les tickets pas seulement
        // ceux limité au Scope account_id
        $expiredTickets = TicketReprise::withoutGlobalScopes()
            ->where('is_activated', false)
            ->whereNotNull('date_limite')
            ->where('date_limite', '<', $now)
            ->whereNull('deactivation_date')
            ->get();
        
        dump($expiredTickets);
        $count = 0;

        foreach($expiredTickets as $ticket){
            $ticket->deactivation_date = $now;
            $ticket->deactivated_by_name = "Invalidation Logicielle";
            $ticket->type_utilisation = "annule";
            $ticket->save();
            $count++;
        }
        Log::info("$count tickets ont été marqué comme périmés.");
    }
}
