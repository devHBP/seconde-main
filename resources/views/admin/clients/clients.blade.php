<x-app-layout>
    <x-slot name="header">
            <div class="dashboard-header">
                <div>
                    <p class="title-reminder">{{ $user->name }}<span> * Connecté en rôle Administrateur</span></p>
                    <h2 class="title">
                        Liste des clients
                    </h2>
                </div>
                <div class="header-right-button">
                    <a href="{{ route('admin.dashboard') }}" class="">
                        Retour au dashboard
                    </a>
                </div>
            </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-8">
        <!-- Barre de recherche -->
        <div class=" p-6 rounded-md layout-search">
            <form method="GET" action="{{ route('admin.clients.search') }}">
                <div class="flex items-center gap-4">
                    <input type="text" name="query"
                        placeholder="Rechercher par nom, email, téléphone..."
                        value="{{ request('query') }}"
                        class="w-full py-2 px-4 border rounded-md">
                    <button type="submit" class="px-4 py-2 rounded-md">
                        Rechercher
                    </button>
                </div>
            </form>
        </div>

        <!-- Liste des clients -->
        <div class="shadow-md rounded-md overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-gray-200">
                    <tr class="text-left border-b border-gray-300">
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Téléphone</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($clients->count() > 0)
                        @foreach ($clients as $client)
                        <tr class="border-b hover:bg-gray-100 transition">
                            <td class="px-4 py-3">{{ $client->firstname }} {{ $client->lastname }}</td>
                            <td class="px-4 py-3">{{ $client->email ?? 'Non renseigné' }}</td>
                            <td class="px-4 py-3">{{ $client->phone ?? 'Non renseigné' }}</td>
                            <td class="px-4 py-3 link">
                                <a href="{{ route('admin.clients.show', ['client_id' => $client->id]) }}">
                                    <span>👁️</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 py-6">
                                Aucun client trouvé.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $clients->links() }}
        </div>
    </div>
</x-app-layout>