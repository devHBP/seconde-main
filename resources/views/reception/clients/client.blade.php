<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($client) ? 'Modifier le Client' : 'Créer un nouveau Client' }}
        </h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Prénom -->
                <div class="mb-3">
                    <label for="firstname" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">Prénom</label>
                    <input type="text" name="firstname" id="firstname" value="{{ $client->firstname ?? ''}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" disabled>
                </div>
                <!-- Nom -->
                <div class="mb-3">
                    <label for="lastname" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">Nom</label>
                    <input type="text" name="lastname" id="lastname" value="{{ $client->lastname ?? ''}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" disabled>
                </div>
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">Email</label>
                    <input type="text" name="email" id="email" value="{{ $client->email ?? ''}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" disabled>
                </div>
                <!-- Phone -->
                <div class="mb-3">
                    <label for="phone" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">Téléphone</label>
                    <input type="text" name="phone" id="phone" value="{{ $client->phone ?? ''}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" disabled>
                </div>
                <!-- Consentement -->
                <div class="flex items-center space-x-4">
                    <!-- Option Oui -->
                    <label class="flex items-center">
                        <input 
                            type="radio" 
                            name="consent" 
                            value="1" 
                            {{  $client->consent  == 1 ? 'checked' : '' }}
                            class="form-radio h-4 w-4 text-green-600 focus:ring focus:ring-green-300" disabled>
                        <span class="ml-2 text-gray-700 dark:text-gray-300">Oui</span>
                    </label>
                    <!-- Option Non -->
                    <label class="flex items-center">
                        <input 
                            type="radio" 
                            name="consent" 
                            value="0" 
                            {{ $client->consent == 0 ? 'checked' : '' }}
                            class="form-radio h-4 w-4 text-red-600 focus:ring focus:ring-red-300" disabled>
                        <span class="ml-2 text-gray-700 dark:text-gray-300">Non</span>
                    </label>
                </div>
                <div class="flex justify-between mt-6">
                    <a href="" class="bg-lime-600 hover:bg-lime-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Modifier</a>
                    <a href="{{ route('reception.clients') }}" class="bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Retour</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>