<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($brand) ? 'Modifier la marque' : 'Créer une nouvelle marque' }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ isset($brand) ? route('admin.brand.modify', ['brand_id' => $brand->id]) : route('admin.brand.create') }}" method="POST" enctype="multipart/form-data">
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

                    <div class="mb-4">
                        <label for="icon_path" class="block text-sm font-medium text-gray-700">Icône ou Image</label>
                
                        <!-- Liste des images existantes -->
                        <div class="mb-2">
                            <label class="block text-sm text-gray-600">Sélectionnez une image existante :</label>
                            <div class="flex flex-wrap gap-4 mt-2">
                                @foreach($pictures as $picture)
                                    <label class="block">
                                        <input type="radio" name="icon_path" value="{{ $picture->id }}" class="hidden">
                                        <img src="{{ asset('storage/' . $picture->path) }}" alt="{{ $picture->name }}" class="w-16 h-16 object-contain border rounded cursor-pointer hover:border-blue-500">
                                    </label>
                                @endforeach
                            </div>
                        </div>
                                <!-- Option d'import d'une nouvelle image -->
                        <div class="mt-4">
                            <label for="new_icon" class="block text-sm text-gray-600">Ou importez une nouvelle image :</label>
                            <input type="file" name="new_icon" id="new_icon" accept=".png,.svg" class="block w-full mt-2">
                        </div>
                        @if(isset($brand) && $brand->icon_path)
                            <div class="mt-4 mb-4">
                                Image actuelle
                                <img src="{{ asset('storage/' . $brand->picture->path) }}"  width="120px" alt="">
                            </div>
                        @endif
                    </div>

                    @error('new_icon')
                        <p>{{ $message }}</p>
                    @enderror


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