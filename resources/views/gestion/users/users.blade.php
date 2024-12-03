<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="title-reminder">Enseigne:{{ $enseigne->name }}</p>
                <h2 class="title">Liste des utilisateurs</h2>
            </div>
            <div class="header-right-button">
                <a href="{{ route('gestion.create.user', ['enseigne_slug' => $enseigne->slug]) }}" class="">
                    Nouveau Utilisateur
                </a>
                <a href="{{ route('gestion.get.enseigne', $enseigne->slug) }}" class="">
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
        </div>
    </div>
    <div class="layout-liste max-w-7xl mx-auto sm:px-6 lg:px-8">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 text-left uppercase tracking-wider text-black">
                        Nom de l'utilisateur
                    </th>
                    <th class="px-5 py-3 border-b-2 uppercase tracking-wider text-black">
                        Rôles
                    </th>
                    <th class="px-5 py-3 border-b-2 uppercase tracking-wider text-black">
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
                        <a href="{{ route('gestion.modify.user', ["enseigne_slug" => $enseigne->slug , "user_id" => $user->id]) }}" class="">Modifier</a>
                        <form action="{{ route('gestion.delete.user', ["enseigne_slug" =>$enseigne->slug, "user_id" => $user->id]) }}" method="POST" class="inline">
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