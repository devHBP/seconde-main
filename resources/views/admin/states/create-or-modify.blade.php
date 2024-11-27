<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="title-reminder">{{ $user->name }}<span> * Connecté en rôle Administrateur</span></p>
                <h2 class="title">{{ isset($state) ? 'Modifier l\'état' : 'Créer un nouvel état' }}</h2>
            </div>
            <div class="header-right-button">
                <a href="{{ route('admin.dashboard') }}" class="">
                    Retour au dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg p-6 create-or-modify">
                <form action="{{ isset($state) ? route('admin.state.modify', ['state_id' => $state->id]) : route('admin.state.create') }}" method="POST">
                    @csrf
                    @if(isset($state))
                        @method('PUT')
                    @endif
                    <!-- Nom de l'état -->
                    <div class="mb-3">
                        <label for="name" class="block">Nom/Désignation de l'état</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $state->name ?? '')}}" class="shadow appearance-none border rounded w-full py-2 px-3" required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Définition de l'état -->
                    <div class="mb-3">
                        <label for="definition" class="block">Définition de l'état</label>
                        <input type="text" name="definition" id="definition" value="{{ old('definition', $state->definition ?? '')}}" class="shadow appearance-none border rounded w-full py-2 px-3">
                        @error('definition')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Définition des infos si besoin  -->
                    <div class="mb-3">
                        <label for="infos" class="block">Info de l'état</label>
                        <input type="text" name="infos" id="infos" value="{{ old('infos', $state->infos ?? '')}}" class="shadow appearance-none border rounded w-full py-2 px-3">
                        @error('infos')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Bouton de soumission -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="">
                            {{ isset($state) ? "Modifier" : "Créer"}}
                        </button>
                        <a href="{{ route('admin.states') }}" class="cancel">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>