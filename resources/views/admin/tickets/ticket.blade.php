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
    <div class="container mx-auto my-8 p-6 layout-ticket">
        <!-- Titre -->
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Détail du Ticket #{{ $ticket->uuid }}</h1>

        <!-- Informations du ticket -->
        <div class="mb-6 flex justify-between">
            <div>
                <p class="text-sm text-gray-500"><span class="font-semibold">Créé par :</span> {{ $ticket->created_by_name }}</p>
                <p class="text-sm text-gray-500"><span class="font-semibold">Date de création :</span> {{ $ticket->created_at->format('d/m/Y H:i') }}</p>
                <p class="text-sm text-gray-500"><span class="font-semibold">Consommé le :</span> {{ $ticket->deactivation_date->format('d/m/Y H:i') }}</p>
                <p class="text-sm text-gray-500"><span class="font-semibold">Consommé par :</span> {{ $ticket->deactivated_by_name }}</p>
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
            
        </div>
    </div>

</x-app-layout>