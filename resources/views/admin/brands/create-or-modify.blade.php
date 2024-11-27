<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="title-reminder">{{ $user->name }}<span> * Connecté en rôle Administrateur</span></p>
                <h2 class="title">
                    {{ isset($brand) ? 'Modifier la marque' : 'Créer une nouvelle marque' }}
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 create-or-modify">
                <form action="{{ isset($brand) ? route('admin.brand.modify', ['brand_id' => $brand->id]) : route('admin.brand.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($brand))
                        @method('PUT')
                    @endif
                    <!-- Nom de la marque -->
                    <div class="mb-3">
                        <label for="name" class="block">Nom de la Marque</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $brand->name ?? '')}}" class="shadow appearance-none rounded w-full py-2 px-3" required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="icon_path" class="block">Icône ou Image</label>
                
                        <!-- Liste des images existantes -->
                        <div class="mb-2">
                            <label class="block">Sélectionnez une image existante :</label>
                            <div class="flex flex-wrap gap-4 mt-2">
                                @foreach($pictures as $picture)
                                    <label class="block">
                                        <input type="radio" name="icon_path" value="{{ $picture->id }}" class="hidden">
                                        <img src="{{ asset('storage/' . $picture->path) }}" alt="{{ $picture->name }}" class="w-16 h-16 object-contain border rounded cursor-pointer hover:border-lime-600">
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <!-- Option d'import d'une nouvelle image -->
                        <div class="mt-4">
                            <label for="new_icon" class="block">Ou importez une nouvelle image :</label>
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
                        <button type="submit" class="py-2 px-4 rounded focus:outline-none">
                            {{ isset($brand) ? "Modifier" : "Créer"}}
                        </button>
                        <a href="{{ route('admin.brands') }}" class="">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>