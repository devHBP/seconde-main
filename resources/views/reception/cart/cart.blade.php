<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
        <h2 class="font-semibold text-xl">Panier n°{{ $panier->id }} </h2>
            <a href="{{ route('reception.dashboard') }}">Retour au dashboard</a>
        </div>
    </x-slot>
    <div class="bg-white shadow overflow-hidden rounded-lg m-8">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Produit</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">État</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Prix Remboursement</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Prix Bon Achat</th>
                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Quantité</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($panier->products as $product)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $product->type->name ?? 'Type non défini' }} | <span>{{ $product->brand->name }}</span></td>
                        <td class="py-3 px-4">{{ $product->pivot->state }}</td>
                        <td class="py-3 px-4">{{ number_format($product->pivot->prix_remboursement, 2) }} €</td>
                        <td class="py-3 px-4 text-green-600 font-semibold">{{ number_format($product->pivot->prix_bon_achat, 2) }} €</td>
                        <td class="py-3 px-4 text-center">
                            <!-- Boutons pour ajuster la quantité -->
                            <div class="flex items-center justify-center">
                                <!-- Bouton - -->
                                <form method="POST" action="{{ route('reception.cart.decrease') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="state" value="{{ $product->pivot->state }}">
                                    <button type="submit" class="px-2 py-1 text-red-500 hover:text-red-700">-</button>
                                </form>
                                <span class="px-3">{{ $product->pivot->quantity }}</span>
                                <!-- Bouton + -->
                                <form method="POST" action="{{ route('reception.cart.increase') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="state" value="{{ $product->pivot->state }}">
                                    <button type="submit" class="px-2 py-1 text-green-500 hover:text-green-700">+</button>
                                </form>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <form method="POST" action="{{ route('reception.cart.drop.products') }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="state" value="{{ $product->pivot->state }}">
                                <button type="submit" class="text-red-500 hover:text-red-700">Retirer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <!-- Footer du tableau pour afficher les totaux -->
            <tfoot class="bg-gray-100 border-t">
                <tr>
                    <td class="text-center border-b-4 border-l-4 border-t-4 border-slate-300 py-3 px-4">Total Remboursement : {{ number_format($total_remboursement, 2) }} €</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-center py-3 px-4 font-semibold border-b-4 border-r-4 border-t-4 border-green-400">Total Bon Achat : <span class="text-green-600">{{ number_format($total_bon_achat, 2) }} €</span></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="mt-6 flex justify-end space-x-10 m-8">
        <div class="text-lg font-semibold">
            <form action="{{ route('reception.cart.validate') }}" method="POST">
                @csrf
                <input type="hidden" name="panier_id" value="{{ $panier->id }}">
                <button class="bg-lime-600 hover:bg-lime-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Valider le panier</button>
            </form>
        </div>
        <div class="text-lg">
            <form action="{{ route('reception.cart.drop')}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="panier_id" value="{{ $panier->id }}">
                <button class="bg-red-600 py-2 px-4 rounded text-white">Supprimer le panier</a>
            </form>
        </div>
    </div>
</x-app-layout>