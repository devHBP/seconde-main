<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="title-reminder">{{ $user->name }}<span> * Connecté en rôle Reception</span></p>
                <h2 class="title">
                    Validation du Panier n°{{$panier_id}} - Recherche Client
                </h2>
            </div>
            <div class="header-right-button">
                <a href="{{ route('reception.dashboard') }}">Retour</a>
            </div>
        </div>
    </x-slot>

    <div class="mx-auto sm:px-2 lg:px-6 py-8">
        <!-- Formulaire de recherche client -->
        <form method="GET" action="{{ route('reception.cart.search') }}" class="mb-6">
            <div class="flex items-center gap-4 layout-search">
                <input type="text" name="query" placeholder="Rechercher par email ou téléphone" 
                    value="{{ old('query') }}" 
                    class="w-full py-2 px-4">
                <button type="submit" class="button-search">
                    Rechercher
                </button>
            </div>
        </form>

        <!-- Affichage des résultats de recherche -->
        @if(isset($clients) && count($clients) > 0)
            <div class="mb-6">
                <h3 class="text-lg mb-4">Résultats de recherche :</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Téléphone</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Imprimer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($clients as $client)
                            <tr>
                                <td class="px-6 py-4">{{ $client->firstname }} {{ $client->lastname }}</td>
                                <td class="px-6 py-4">{{ $client->email ?? 'Non renseigné' }}</td>
                                <td class="px-6 py-4">{{ $client->phone ?? 'Non renseigné' }}</td>
                                <form method="POST" action="{{ route('reception.cart.associate') }}">
                                    @csrf
                                    <td>
                                        <label>
                                            <input type="checkbox" id="print_ticket" name="print_ticket" checked> Ticket Papier
                                        </label>
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                                        <input type="hidden" name="panier_id" value="{{ $panier_id }}">
                                        <button type="submit" class="px-3 py-1">
                                            Associer
                                        </button>
                                    </td>
                                    @error('print_ticket')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif(!isset($clients))
        @else
            <p class="mb-6">Aucun client trouvé.</p>
        @endif

        <!-- Formulaire de création de client -->
        <div class="p-6 cart-create-client">
            <h3 class="text-lg font-bold mb-4">Créer un nouveau client :</h3>
            <form method="POST" class="" action="{{ route('reception.cart.associate') }}">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <!-- Nom -->
                    <div>
                        <label for="firstname" class="block">Prénom</label>
                        <input type="text" name="firstname" id="firstname" required
                            class="w-full py-2 px-4 border rounded">
                    </div>
                    <div>
                        <label for="lastname" class="block">Nom</label>
                        <input type="text" name="lastname" id="lastname" required
                            class="w-full py-2 px-4 border rounded">
                    </div>
                    <!-- Email -->
                    <div>
                        <label for="email" class="block">Email</label>
                        <input type="email" name="email" id="email"
                            class="w-full py-2 px-4 border rounded">
                    </div>
                    <!-- Téléphone -->
                    <div>
                        <label for="phone" class="block">Téléphone</label>
                        <input type="tel" name="phone" id="phone" pattern="[0-9]{10}"
                            class="w-full py-2 px-4 border rounded">
                    </div>
                </div>
                <div class="flex justify-between">
                    <!-- Consentement -->
                    <div class="mb-4">
                        <label for="consent" class="block text-sm font-bold mb-2">
                            Consentement à l'usage des données à but interne (Groupe HBP)
                        </label>
                        <div class="flex items-center space-x-4">
                            <!-- Option Oui -->
                            <label class="flex items-center">
                                <input 
                                    type="radio" 
                                    name="consent" 
                                    value="1" 
                                    class="form-radio h-4 w-4">
                                <span class="ml-2">Oui</span>
                            </label>
                            
                            <!-- Option Non -->
                            <label class="flex items-center">
                                <input 
                                    type="radio" 
                                    name="consent" 
                                    value="0" 
                                    class="form-radio h-4 w-4">
                                <span class="ml-2">Non</span>
                            </label>
                        </div>
                        @error('consent')
                            <span class="text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="print_ticket" class="block text-sm font-bold mb-2">
                            Impression Ticket
                        </label>
                        <div class="flex items-center space-x-4">
                            <!-- Option Oui -->
                            <label class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    name="print_ticket" 
                                    value="on" 
                                    class="form-radio h-4 w-4">
                                <span class="ml-2">Oui</span>
                            </label>
                        </div>
                        @error('print_ticket')
                            <span class="text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="px-6 py-2 rounded">
                    Créer le client
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
