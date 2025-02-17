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
        $expiredTickets = TicketReprise::where('is_activated', false)
            ->whereNotNull('date_limite')
            ->where('date_limite', '<', $now)
            ->whereNull('deactivation_date')
            ->get();
        
        $count = 0;

        foreach($expiredTickets as $ticket){
            $ticket->deactivation_date = $now;
            $ticket->save();
            $count++;
        }
        Log::info("$count tickets ont été marqué comme périmés.");
    }
}
