<x-app-layout>
    <x-slot name="header">
            <div class="dashboard-header">
                <div>
                    <p class="title-reminder">{{ $user->name }}<span> * Connecté en rôle Administrateur</span></p>
                    <h2 class="title">
                        Liste des Tickets
                    </h2>
                </div>
                <div class="header-right-button">
                    <a href="{{ route('admin.dashboard') }}" class="">
                        Retour au dashboard
                    </a>
                </div>
            </div>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 layout-search">
            <!-- Formulaire de recherche tickets -->
            <form method="GET" action="{{ route('admin.search.tickets') }}" class="mb-6">
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
        <div class="max-w-7xl mx-auto list-header">
            <ul>
                <li class="flex justify-between p-4 bg-white cursor-pointer border border-gray-300 hover:bg-slate-100">
                    <span>N° Ticket</span>
                    <span>Prénom/Nom Client</span>
                </li>
            </ul>
        </div>
        <div class="max-w-7xl mx-auto layout-liste">
            <ul>
                @if(count($tickets)>0)
                    @foreach ($tickets as $ticket)
                    <a href="{{ route('admin.ticket.show', ['ticket_id' => $ticket->uuid] ) }}">
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
</x-app-layout>