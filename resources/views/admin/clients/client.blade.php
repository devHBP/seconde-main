<x-app-layout>
    <x-slot name="header">
            <div class="dashboard-header">
                <div>
                    <p class="title-reminder">{{ $user->name }}<span> * Connecté en rôle Administrateur</span></p>
                    <h2 class="title">
                        Client n°{{ $client->id}} 
                    </h2>
                </div>
                <div class="header-right-button">
                    <a href="{{ route('admin.clients') }}" class="">
                        Retour
                    </a>
                </div>
            </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-8">
        <!-- Infos Client -->
        <div class="p-6 mb-6">
            <h3 class="text-lg font-semibold">{{ $client->firstname }} {{ $client->lastname }}</h3>
            <p>Email : <strong>{{ $client->email ?? 'Non renseigné' }}</strong></p>
            <p>Téléphone : <strong>{{ $client->phone ?? 'Non renseigné' }}</strong></p>
        </div>

        <!-- Liste des Tickets Associés -->
        <h3 class="text-lg font-semibold mb-4">Tickets Associés</h3>
        <div class="rounded-md overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-gray-200">
                    <tr class="text-left border-b border-gray-300">
                        <th class="px-4 py-2">N° Ticket</th>
                        <th class="px-4 py-2">Type</th>
                        <th class="px-4 py-2">Statut</th>
                        <th class="px-4 py-2">Date de création</th>
                        <th class="px-4 py-2">Date de d'utilisation</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($client->tickets->count() > 0)
                        @foreach ($client->tickets as $ticket)
                        <tr class="border-b">
                            <td class="px-4 py-3">
                                {{ $ticket->uuid }}
                            </td>
                            <td class="px-4 py-3">{{ ucfirst($ticket->type_utilisation) }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded text-white 
                                    {{ $ticket->statut === 'périmé' ? 'bg-red-500' : ($ticket->statut === 'consommé' ? 'bg-gray-500' : 'bg-green-500') }}">
                                    {{ ucfirst($ticket->statut) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3">{{ $ticket->deactivation_date ? $ticket->deactivation_date->format('d/m/Y H:i') : "Pas encore utilisé"}}</td>
                            <td class="px-4 py-3 link">
                                <a href="{{ route('admin.ticket.show', ['ticket_id' => $ticket->uuid]) }}">
                                    <span>👁️</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center py-6">
                                Aucun ticket associé à ce client.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
