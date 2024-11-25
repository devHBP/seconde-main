<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="title-reminder">{{ $user->name }} <span> * Connecté en rôle Encaissement</span></p>
                <h2>Ticket n° {{ $ticket->uuid }}</h2>
            </div>
            <div class="header-right-button">
                <a href="{{ route('encaissement.dashboard') }}" class="hover:underline">Retour au tableau de bord</a>
            </div>
        </div>
    </x-slot>
    <div class="container mx-auto my-8 p-6 layout-ticket">
        <!-- Titre -->
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Détail du Ticket #{{ $ticket->uuid }}</h1>

        <!-- Informations du ticket -->
        <div class="mb-6 flex justify-between">
            <div>
                <p class="text-sm text-gray-500"><span class="font-semibold">Créé par :</span> {{ $ticket->created_by_name }}</p>
                <p class="text-sm text-gray-500"><span class="font-semibold">Date de création :</span> {{ $ticket->created_at->format('d/m/Y H:i') }}</p>
                <p class="text-sm text-gray-500"><span class="font-semibold">Valide jusqu'au :</span> {{ $ticket->date_limite->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500"><span class="font-semibold">Client : {{ $ticket->client->firstname }} {{ $ticket->client->lastname }}</span></p>
                <p class="text-sm text-gray-500"><span class="font-semibold">Email : {{ $ticket->client->email }}</span></p>
                <p class="text-sm text-gray-500"><span class="font-semibold">Téléphone : {{ $ticket->client->phone }}</span></p>
            </div>
        </div>

        <!-- Détails des produits -->
        <h2 class="text-lg font-semibold text-gray-600 mb-4">Produits</h2>
        <table class="w-full border-collapse border border-gray-200 mb-6">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-200 px-4 py-2 text-left text-sm font-semibold">Produit</th>
                    <th class="border border-gray-200 px-4 py-2 text-left text-sm font-semibold">Quantité</th>
                    <th class="border border-gray-200 px-4 py-2 text-left text-sm font-semibold">Prix Remboursement</th>
                    <th class="border border-gray-200 px-4 py-2 text-left text-sm font-semibold">Prix Bon d'Achat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ticket->panier->products as $product)
                <tr>
                    <td class="border border-gray-200 px-4 py-2">{{ $product->type->name }} - {{ $product->brand->name }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $product->pivot->quantity }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ number_format($product->pivot->prix_remboursement, 2, ',', ' ') }} €</td>
                    <td class="border border-gray-200 px-4 py-2">{{ number_format($product->pivot->prix_bon_achat, 2, ',', ' ') }} €</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Actions -->
        <div class="flex justify-between items-center mt-6">
            <!-- Boutons de consommation -->
            <div class="flex gap-4">
                <form method="POST" action="{{ route('encaissement.ticket.consume')}}" class="">
                    <div class="flex flex-col px-4 py-2 bg-slate-400 text-white rounded hover:bg-slate-500 cursor-pointer">
                        @csrf
                        <input type="hidden" name="type_utilisation" value="remboursement">
                        <input type="hidden" name="ticket_uuid" value="{{ $ticket->uuid }}">
                        <button type="submit" class="">Remboursement 
                            <span class="font-bold text-center text-xl block">{{ $ticket->panier->total_remboursement }} €</span>
                        </button>
                    </div>
                </form>
                <form method="POST" action="{{ route('encaissement.ticket.consume')}}" class="inline">
                    @csrf
                    <div class="flex flex-col px-4 py-2 bg-lime-600 text-white rounded hover:bg-lime-700 cursor-pointer">
                        <input type="hidden" name="type_utilisation" value="bon_achat">
                        <input type="hidden" name="ticket_uuid" value="{{ $ticket->uuid }}">
                        <button type="submit">Remise sur Achat 
                            <span class="font-bold text-center text-xl block">{{ $ticket->panier->total_bon_achat }} €</span>
                        </button>   
                    </div>
                </form>
            </div>
            <!-- Bouton de restitution -->
            <form method="POST" action="{{ route('encaissement.ticket.restitute')}}">
                @csrf
                <input type="hidden" name="ticket_uuid" value="{{ $ticket->uuid }}">
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Restitution</button>
            </form>
        </div>
    </div>

</x-app-layout>