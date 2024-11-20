<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Validation du Panier n°{{$panier_id}} - Recherche Client
        </h2>
        <a href="{{ route('reception.dashboard') }}">Retour</a>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <!-- Formulaire de recherche client -->
        <form method="GET" action="{{ route('reception.cart.search') }}" class="mb-6">
            <div class="flex items-center gap-4">
                <input type="text" name="query" placeholder="Rechercher par email ou téléphone" 
                    value="{{ old('query') }}" 
                    class="w-full py-2 px-4 border border-gray-300 dark:border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-lime-500">
                <button type="submit" class="bg-lime-600 text-white px-4 py-2 rounded hover:bg-lime-700">
                    Rechercher
                </button>
            </div>
        </form>

        <!-- Affichage des résultats de recherche -->
        @if(isset($clients) && count($clients) > 0)
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">Résultats de recherche :</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Téléphone</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imprimer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
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
                                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
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
            <p class="text-gray-500 dark:text-gray-400 mb-6">Aucun client trouvé.</p>
        @endif

        <!-- Formulaire de création de client -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">Créer un nouveau client :</h3>
            <form method="POST" action="{{ route('reception.cart.associate') }}">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <!-- Nom -->
                    <div>
                        <label for="firstname" class="block text-gray-700 dark:text-gray-300">Prénom</label>
                        <input type="text" name="firstname" id="firstname" required
                            class="w-full py-2 px-4 border rounded focus:outline-none focus:ring-2 focus:ring-lime-500">
                    </div>
                    <div>
                        <label for="lastname" class="block text-gray-700 dark:text-gray-300">Nom</label>
                        <input type="text" name="lastname" id="lastname" required
                            class="w-full py-2 px-4 border rounded focus:outline-none focus:ring-2 focus:ring-lime-500">
                    </div>
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" id="email"
                            class="w-full py-2 px-4 border rounded focus:outline-none focus:ring-2 focus:ring-lime-500">
                    </div>
                    <!-- Téléphone -->
                    <div>
                        <label for="phone" class="block text-gray-700 dark:text-gray-300">Téléphone</label>
                        <input type="tel" name="phone" id="phone" pattern="[0-9]{10}"
                            class="w-full py-2 px-4 border rounded focus:outline-none focus:ring-2 focus:ring-lime-500">
                    </div>
                </div>
                <!-- Consentement -->
                    <!-- Consentement -->
                    <div class="mb-4">
                        <label for="consent" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            Consentement à l'usage des données à but interne
                        </label>
                        <div class="flex items-center space-x-4">
                            <!-- Option Oui -->
                            <label class="flex items-center">
                                <input 
                                    type="radio" 
                                    name="consent" 
                                    value="1" 
                                    class="form-radio h-4 w-4 text-green-600 focus:ring focus:ring-green-300">
                                <span class="ml-2 text-gray-700 dark:text-gray-300">Oui</span>
                            </label>
                            
                            <!-- Option Non -->
                            <label class="flex items-center">
                                <input 
                                    type="radio" 
                                    name="consent" 
                                    value="0" 
                                    class="form-radio h-4 w-4 text-red-600 focus:ring focus:ring-red-300">
                                <span class="ml-2 text-gray-700 dark:text-gray-300">Non</span>
                            </label>
                        </div>
                        @error('consent')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                <button type="submit" class="bg-lime-600 text-white px-6 py-2 rounded hover:bg-lime-700">
                    Créer le client
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
