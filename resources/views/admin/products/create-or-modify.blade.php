<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="title-reminder">{{ $user->name }}<span> * Connecté en rôle Administrateur</span></p>
                <h2 class="title">{{ isset($product) ? 'Modifier le Produit' : 'Créer un nouveau Produit' }}</h2>
            </div>
            <div class="header-right-button">
                <a href="{{ route('admin.dashboard') }}">
                    Retour au dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm p-6 create-or-modify">
                <form action="{{ isset($product) ? route('admin.product.modify', ['product_id' => $product->id]) : route('admin.product.create') }}" method="POST">
                    @csrf
                    @if(isset($product))
                        @method('PUT')
                    @endif
                    <!-- Type Produit -->
                    <div class="mb-3">
                        <label for="type" class="block font-bold">Type de Produit</label>
                        <select name="type" id="type" class="appearance-none border rounded w-full py-2 px-3">
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ isset($product) && old('type', $product->type->id ) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Marque Produit -->
                    <div class="mb-3">
                        <label for="brand" class="block font-bold">Marque du Produit</label>
                        <select name="brand" id="brand" class="shadow appearance-none border rounded w-full py-2 px-3 ">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ isset($product) && old('brand', $product->brand->id ) == $brand->id ? 'selected' : ''}} >{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- États -->
                    @foreach ($states as $state)
                    <div class="mb-4 flex items-center space-x-4">
                        <!-- Nom de l'état -->
                        <span class="w-1/4">{{ $state->name }}</span>

                        <!-- Champ pour le prix de remboursement -->
                        <div class="flex items-center space-x-2 w-1/2">
                            <label for="prix_remboursement_state_{{ $state->id }}" class="text-sm">Remboursement :</label>
                            <input type="number" step="0.01" min="0" name="prix_remboursement_state_{{ $state->id }}" id="prix_remboursement_state_{{ $state->id }}" 
                                value="{{ isset($product) ? old("prix_remboursement_state_{$state->id}", $product->states->where('id', $state->id)->first()?->pivot->prix_remboursement) : '' }}"
                                class="shadow border rounded w-20 py-1 px-2 text-gray-700 dark:text-gray-300 focus:outline-none focus:shadow-outline">
                        </div>

                        <!-- Champ pour le prix du bon d'achat -->
                        <div class="flex items-center space-x-2 w-1/2">
                            <label for="prix_bon_achat_state_{{ $state->id }}" class="text-sm">Bon d'achat :</label>
                            <input type="number" step="0.01" min="0" name="prix_bon_achat_state_{{ $state->id }}" id="prix_bon_achat_state_{{ $state->id }}"
                                value="{{ isset($product) ? old("prix_bon_achat_state_{$state->id}", $product->states->where('id', $state->id)->first()?->pivot->prix_bon_achat) : 'NC'}}"
                                class="shadow border rounded w-20 py-1 px-2 focus:outline-none focus:shadow-outline">
                        </div>
                        @error('state')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    @endforeach

                    <!-- Bouton de soumission -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="">
                            {{ isset($product) ? "Modifier" : "Créer"}}
                        </button>
                        <a href="{{ route('admin.products') }}" class="cancel">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>