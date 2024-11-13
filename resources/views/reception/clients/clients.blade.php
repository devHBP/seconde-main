<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header h-4">
            <h2 class="title">Gestion des clients</span></h2>
            <div>
                <a href="{{ route('reception.client.create') }}" class="ml-4 px-4 py-2 bg-lime-600 text-white rounded hover:bg-lime-700">Nouveau client</a>
                <a href="{{ route('reception.dashboard') }}" class="ml-4 px-4 py-2 bg-lime-600 text-white rounded hover:bg-lime-700">Retour au dashboard</a>
            </div>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-lime-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-gray-700 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Nom
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-gray-700 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Prenom
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-gray-700 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                mail
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-gray-700 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Télephone
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-gray-700 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-800 text-center text-sm">
                                {{ $client->firstname }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-800 text-center text-sm">
                                {{ $client->lastname }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-800 text-center text-sm">
                                {{ $client->email }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-800 text-center text-sm">
                                {{ $client->phone }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-800 text-sm text-center">
                                <a href="{{ route('reception.client.get', $client->id) }}" class="mr-2">Voir</a>
                                <a href="{{ route('reception.client.modify', $client) }}" class="text-lime-600 hover:text-lime-900 mr-2">Modifier</a>
                                <form action="{{ route('reception.client.delete', $client->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
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