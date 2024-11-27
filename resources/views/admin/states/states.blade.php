<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="title-reminder">{{ $user->name }}<span> * Connecté en rôle Administrateur</span></p>
                <h2 class="title">Liste des états de produit</h2>
            </div>
            <div class="header-right-button">
                <a href="{{ route('admin.state.create') }}" class="">
                    Nouvel état
                </a>
                <a href="{{ route('admin.dashboard') }}" class="">
                    Retour au dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 uppercase tracking-wider">
                                Nom/Désignation
                            </th>
                            <th class="px-5 py-3 border-b-2 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($states as $state)
                        <tr>
                            <td class="px-5 py-5 border-b text-sm">
                                {{ $state->name }}
                            </td>
                            <td class="px-5 py-5 border-b text-center">
                                <a href="{{ route('admin.state.modify', $state) }}" class="">Modifier</a>
                                <form action="{{ route('admin.state.delete', $state->id) }}" method="POST" class="inline">
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
        </div>
    </div>
</x-app-layout>