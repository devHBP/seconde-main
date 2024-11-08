<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($product) ? 'Modifier le Produit' : 'Créer un nouveau Produit' }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ isset($product) ? route('admin.product.modify', ['product_id' => $product->id]) : route('admin.product.create') }}" method="POST">
                    @csrf
                    @if(isset($product))
                        @method('PUT')
                    @endif
                    <!-- Type Produit -->
                    <div class="mb-3">
                        <label for="type" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">Type de Produit</label>
                        <select name="type" id="type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:shadow-outline">
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ isset($product) && old('type', $product->type->id ) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Marque Produit -->
                    <div class="mb-3">
                        <label for="brand" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">Marque du Produit</label>
                        <select name="brand" id="brand" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:shadow-outline">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ isset($product) && old('brand', $product->brand->id ) == $brand->id ? 'selected' : ''}} >{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- États -->
                    @foreach ($states as $state)
                    <div class="mb-4 flex items-center space-x-4">
                        <!-- Nom de l'état -->
                        <span class="text-gray-700 dark:text-gray-300 font-medium w-1/4">{{ $state->name }}</span>

                        <!-- Champ pour le prix de remboursement -->
                        <div class="flex items-center space-x-2 w-1/2">
                            <label for="prix_remboursement_state_{{ $state->id }}" class="text-gray-500 text-sm">Remboursement :</label>
                            <input type="number" step="0.1" min="0" name="prix_remboursement_state_{{ $state->id }}" id="prix_remboursement_state_{{ $state->id }}" 
                                value="{{ isset($product) ? old("prix_remboursement_state_{$state->id}", $product->states->where('id', $state->id)->first()?->pivot->prix_remboursement) : '' }}"
                                class="shadow border rounded w-20 py-1 px-2 text-gray-700 dark:text-gray-300 focus:outline-none focus:shadow-outline">
                        </div>

                        <!-- Champ pour le prix du bon d'achat -->
                        <div class="flex items-center space-x-2 w-1/2">
                            <label for="prix_bon_achat_state_{{ $state->id }}" class="text-gray-500 text-sm">Bon d'achat :</label>
                            <input type="number" step="0.1" min="0" name="prix_bon_achat_state_{{ $state->id }}" id="prix_bon_achat_state_{{ $state->id }}"
                                value="{{ isset($product) ? old("prix_bon_achat_state_{$state->id}", $product->states->where('id', $state->id)->first()?->pivot->prix_bon_achat) : 'NC'}}"
                                class="shadow border rounded w-20 py-1 px-2 text-gray-700 dark:text-gray-300 focus:outline-none focus:shadow-outline">
                        </div>
                    </div>
                    @endforeach

                    <!-- Bouton de soumission -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-lime-600 hover:bg-lime-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            {{ isset($product) ? "Modifier" : "Créer"}}
                        </button>
                        <a href="{{ route('admin.products') }}" class="text-gray-600 dark:text-gray-400 hover:underline">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>