<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($brand) ? 'Modifier la marque' : 'Créer une nouvelle marque' }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ isset($brand) ? route('admin.brand.modify', ['brand_id' => $brand->id]) : route('admin.brand.create') }}" method="POST">
                    @csrf
                    @if(isset($brand))
                        @method('PUT')
                    @endif
                    <!-- Nom de la marque -->
                    <div class="mb-3">
                        <label for="name" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">Nom de la Marque</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $brand->name ?? '')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-lime-600 hover:bg-lime-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            {{ isset($brand) ? "Modifier" : "Créer"}}
                        </button>
                        <a href="{{ route('admin.brands') }}" class="text-gray-600 dark:text-gray-400 hover:underline">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>