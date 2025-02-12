<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="title-reminder">{{ $currentUser->name }}<span> * Connecté en rôle Administrateur</span></p>
                <h2 class="title">Liste des utilisateurs</h2>
            </div>
            <div class="header-right-button">
                <a href="{{ route('admin.user.create') }}" class="">
                    Nouveau Utilisateur
                </a>
                <a href="{{ route('admin.dashboard') }}" class="">
                    Retour au dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-2">
    </div>
    <div class="layout-liste max-w-7xl mx-auto sm:px-6 lg:px-8">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 text-left uppercase tracking-wider">
                        Nom de l'utilisateur
                    </th>
                    <th class="px-5 py-3 border-b-2 uppercase tracking-wider">
                        Rôles
                    </th>
                    <th class="px-5 py-3 border-b-2 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="px-5 py-5 border-b">
                        {{ $user->name }}
                    </td>
                    <td class="px-5 py-5 border-b">
                        {{ $user->roles->pluck('name')->join(', ') }}
                    </td>
                    <td class="px-5 py-5 border-b text-center">
                        <a href="{{ route('admin.user.modify', $user) }}" class="">Modifier</a>
                        <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>