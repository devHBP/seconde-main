<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Créer un nouvel utilisateur
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.user.create') }}" method="POST">
                    @csrf

                    <!-- Nom de l'utilisateur -->
                    <div class="mb-3">
                        <label for="name" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">Nom de l'utilisateur</label>
                        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <!-- E-mail -->
                    <div class="mb-3">
                        <label for="email" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">E-mail</label>
                        <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-3">
                        <label for="password" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">Mot de passe</label>
                        <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-3">
                        <label for="confirm_password" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">Confirmer le mot de passe</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>  

                    <!-- Rôles -->
                    <div class="mb-3">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold">Rôles</label>
                        <div class="flex flex-wrap gap-4">
                            @foreach($roles as $role)
                                <label class="flex items-center mr-4 mb-2">
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="form-checkbox h-4 w-4 text-indigo-600">
                                    <span class="ml-2 text-gray-700 dark:text-gray-300 flex">{{ $role->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-lime-600 hover:bg-lime-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Créer l'utilisateur
                        </button>
                        <a href="{{ route('admin.users') }}" class="text-gray-600 dark:text-gray-400 hover:underline">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>