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
                        <select name="type" id="type">
                            @foreach ($types as $type)
                                <option value="{{ old('type', $product->type->name ?? '')}}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Marque Produit -->
                    <div class="mb-3">
                        <label for="brand" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">Marque du Produit</label>
                        <select name="brand" id="brand">
                            @foreach ($brands as $brand)
                                <option value="{{ old('brand', $product->brand->name ?? '')}}">{{ $brand }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Etats -->
                    @foreach ($states as $state)
                    <div class="mb-3">
                        <label for="states_{{ $state->id }}_prix_remboursement" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">{{ $state->name }} - Remboursement </label>
                        <input type="states_{{ $state->id }}_prix_remboursement" name="states_{{ $state->id }}_prix_remboursement" id="states_{{ $state->id }}_prix_remboursement" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-3">
                        <label for="states_{{ $state->id }}_prix_bon_achat" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">{{ $state->name }} - Bon d'achat </label>
                        <input type="states_{{ $state->id }}_prix_bon_achat" name="states_{{ $state->id }}_prix_bon_achat" id="states_{{ $state->id }}_prix_bon_achat" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
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