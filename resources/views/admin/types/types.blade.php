<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex justify-between">
            Liste des Types de vêtements
            <div>
                <a href="{{ route('admin.type.create') }}" class="ml-4 px-4 py-2 bg-lime-600 text-white rounded hover:bg-lime-700">
                    Nouveau Type
                </a>
                <a href="{{ route('admin.dashboard') }}" class="ml-4 px-4 py-2 bg-lime-600 text-white rounded hover:bg-lime-700">
                    Retour au dashboard
                </a>
            </div>
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Type de vêtement
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-gray-700 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($types as $type)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-800 text-sm">
                                {{ $type->name }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-800 text-sm text-center">
                                <a href="{{ route('admin.type.modify', $type) }}" class="text-lime-600 hover:text-lime-900 mr-2">Modifier</a>
                                <form action="{{ route('admin.type.delete', $type->id) }}" method="POST" class="inline">
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