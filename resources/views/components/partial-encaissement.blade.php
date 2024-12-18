<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 layout-search">
        <!-- Formulaire de recherche client -->
        <form method="GET" action="{{ route('encaissement.ticket.search') }}" class="mb-6">
            <div class="flex items-center gap-4">
                <input type="text" name="query" placeholder="Scanner le code barre / Entrer le numéro de ticket de reprise"
                    @if(isset($query))
                        value="{{ $query }}"
                    @endif
                    class="w-full py-2 px-4 rounded focus:outline-none">
                <button type="submit" class="text-white px-4 py-2 rounded">
                    Rechercher
                </button>
            </div>
        </form>
    </div>
    <div class="max-w-7xl mx-auto layout-liste">
        <ul>
            @if(count($tickets)>0)
                @foreach ($tickets as $ticket)
                <a href="{{ route('encaissement.ticket.show', ['ticket_uuid' => $ticket->uuid] ) }}">
                    <li class="flex justify-between p-4 bg-white cursor-pointer border border-gray-300 hover:bg-slate-100">
                        <span>{{ $ticket->uuid }}</span>
                        <span>{{ $ticket->client->firstname }} {{ $ticket->client->lastname }}</span>
                    </li>
                </a>
                @endforeach
            @else
                <li>Ticket non trouvé</li>
            @endif
        </ul>
    </div>
</div>