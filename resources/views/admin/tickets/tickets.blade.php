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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6 mb-4 layout-search">
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
        <!-- Tableau des tickets -->
        <div class="max-w-7xl p-2 mx-auto sm-:px-6 lg:px-8 mb-4">
            <table class="w-full">
                <thead class="bg-gray-200">
                    <tr class="text-left border-b border-gray-300">
                        <th class="px-4 py-2">N° Ticket</th>
                        <th class="px-4 py-2">Type d'Usage</th>
                        <th class="px-4 py-2">Statut</th>
                        <th class="px-4 py-2">Client</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($tickets->count() > 0)
                        @foreach ($tickets as $ticket)
                        <tr class="border-b hover:bg-gray-100 transition">
                            <td class="px-4 py-3">
                                    {{ $ticket->uuid }}
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded text-white 
                                    {{ $ticket->type_utilisation === 'annule' ? 'bg-red-500' : 'bg-green-500' }}">
                                    {{ ucfirst($ticket->type_utilisation) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded text-white 
                                    {{ $ticket->statut === 'périmé' ? 'bg-red-500' : ($ticket->statut === 'consommé' ? 'bg-gray-500' : 'bg-green-500') }}">
                                    {{ ucfirst($ticket->statut) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $ticket->client->firstname }} {{ $ticket->client->lastname }}</td>
                            <td class="link">
                                <a href="{{ route('admin.ticket.show', ['ticket_id' => $ticket->uuid]) }}" class="">
                                    <span>👁️</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 py-6">
                                Aucun ticket trouvé.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mb-6 flex justify-center relative z-10 text-black">
            {{ $tickets->links() }}
        </div>
    </div>
</x-app-layout>