<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="title-reminder">{{ $user->name }}<span> * Connecté en rôle Reception</span></p>
                <h2 class="title">{{ isset($client) ? 'Modifier le Clients' : 'Créer un nouveau Client' }}</h2>
            </div>
            <div class="header-right-button">
                <a href="{{ route('reception.dashboard') }}">Retour au dashboard</a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden p-6 create-or-modify">
                <h3>Informations client</h3>
                <form action="{{ isset($client) ? route('reception.client.modify', ['client_id' => $client->id]) : route('reception.client.create') }}" method="POST">
                    @csrf
                    @if(isset($client))
                        @method('PUT')
                    @endif
                    <!-- Prénom -->
                    <div class="mb-3">
                        <label for="firstname" class="block text-sm font-bold">Prénom</label>
                        <input type="text" name="firstname" id="firstname" value="{{ old('firstname', $client->firstname ?? '')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" required>
                        @error('firstname')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Nom de famille -->
                    <div class="mb-3">
                        <label for="lastname" class="block text-sm font-bold">Nom de famille</label>
                        <input type="text" name="lastname" id="lastname" value="{{ old('lastname', $client->lastname ?? '')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" required>
                        @error('lastname')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- email -->
                    <div class="mb-3">
                        <label for="email" class="block text-sm font-bold">Adresse mail</label>
                        <input type="text" name="email" id="email" value="{{ old('email', $client->email ?? '')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- téléphone -->
                    <div class="mb-3">
                        <label for="phone" class="block text-sm font-bold">Téléphone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $client->phone ?? '')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
                        @error('phone')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Consentement -->
                    <div class="mb-4">
                        <label for="consent" class="block text-sm font-bold mb-2">
                            Consentement à l'usage des données à but interne
                        </label>
                        <div class="flex items-center space-x-4">
                            <!-- Option Oui -->
                            <label class="flex items-center">
                                <input 
                                    type="radio" 
                                    name="consent" 
                                    value="1" 
                                    {{ old('consent', $client->consent ?? '') == 1 ? 'checked' : '' }}
                                    class="form-radio h-4 w-4">
                                <span class="ml-2">Oui</span>
                            </label>
                            
                            <!-- Option Non -->
                            <label class="flex items-center">
                                <input 
                                    type="radio" 
                                    name="consent" 
                                    value="0" 
                                    {{ old('consent', $client->consent ?? '') == 0 ? 'checked' : '' }}
                                    class="form-radio h-4 w-4">
                                <span class="ml-2">Non</span>
                            </label>
                        </div>
                        @error('consent')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Bouton de soumission -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="font-bold">
                            {{ isset($client) ? "Modifier" : "Créer"}}
                        </button>
                        <a href="{{ route('reception.clients') }}" class="">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>