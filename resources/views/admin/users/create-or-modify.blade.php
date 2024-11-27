<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="title-reminder">{{ $currentUser->name }}<span> * Connecté en rôle Administrateur</span></p>
                <h2 class="title">
                    {{ isset($user) ? 'Modifier l\'utilisateur' : 'Créer un nouvel utilisateur' }}
                </h2>
            </div>
            <div class="header-right-button">
                <a href="{{ route('admin.dashboard') }}" class="">
                    Retour au dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class=" p-6 create-or-modify">
                <h3>Informations Utilisateur</h3>
                <form action="{{ isset($user) ? route('admin.user.modify', ['user_id' => $user->id]) : route('admin.user.create') }}" method="POST">
                    @csrf
                    @if(isset($user))
                        @method('PUT')
                    @endif
                    <!-- Nom de l'utilisateur -->
                    <div class="mb-3">
                        <label for="name" class="block">Nom de l'utilisateur</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- E-mail -->
                    <div class="mb-3">
                        <label for="email" class="block">E-mail</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" required>
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-3">
                        <label for="password" class="block">Mot de passe</label>
                        <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" {{ isset($user) ? '' : 'required' }}>
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-3">
                        <label for="confirm_password" class="block">Confirmer le mot de passe</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" {{ isset($user) ? '' : 'required' }}>
                        @error('comfirm_password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>  

                    <!-- Rôles -->
                    <div class="mb-3">
                        <label class="block">Rôles</label>
                        <div class="flex flex-wrap gap-4">
                            @foreach($roles as $role)
                                <label class="flex items-center mr-4 mb-2">
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="form-checkbox h-4 w-4 text-indigo-600" {{ isset($user) && $user->roles->contains($role->id) ? 'checked' : ''}}>
                                    <span class="ml-2 flex">{{ $role->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('roles')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="">
                            {{ isset($user) ? "Modifier l'utilisateur" : "Créer l'utilisateur"}}
                        </button>
                        <a href="{{ route('admin.users') }}" class="cancel">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>