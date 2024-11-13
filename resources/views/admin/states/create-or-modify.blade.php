<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($state) ? 'Modifier l\'état' : 'Créer un nouvel état' }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ isset($state) ? route('admin.state.modify', ['state_id' => $state->id]) : route('admin.state.create') }}" method="POST">
                    @csrf
                    @if(isset($state))
                        @method('PUT')
                    @endif
                    <!-- Nom de l'état -->
                    <div class="mb-3">
                        <label for="name" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">Nom/Désignation de l'état</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $state->name ?? '')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Définition de l'état -->
                    <div class="mb-3">
                        <label for="definition" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">Définition de l'état</label>
                        <input type="text" name="definition" id="definition" value="{{ old('definition', $state->definition ?? '')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
                        @error('definition')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Bouton de soumission -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-lime-600 hover:bg-lime-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            {{ isset($state) ? "Modifier" : "Créer"}}
                        </button>
                        <a href="{{ route('admin.states') }}" class="text-gray-600 dark:text-gray-400 hover:underline">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>