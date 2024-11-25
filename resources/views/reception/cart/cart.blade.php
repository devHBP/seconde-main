<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="title-reminder">{{ $user->name }}<span> * Connecté en rôle Reception</span></p>
                <h2 class="title">Panier n°{{ $panier->id }} </h2>
            </div>
            <div class="header-right-button">
                <a href="{{ route('reception.dashboard') }}">Retour au dashboard</a>
            </div>
        </div>
    </x-slot>
    <div class="overflow-hidden rounded-lg m-8">
        <table class="min-w-full">
            <thead class="border-b">
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
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $product->type->name ?? 'Type non défini' }} | <span>{{ $product->brand->name }}</span></td>
                        <td class="py-3 px-4">{{ $product->pivot->state }}</td>
                        <td class="py-3 px-4">{{ number_format($product->pivot->prix_remboursement, 2) }} €</td>
                        <td class="py-3 px-4">{{ number_format($product->pivot->prix_bon_achat, 2) }} €</td>
                        <td class="py-3 px-4 text-center">
                            <!-- Boutons pour ajuster la quantité -->
                            <div class="flex items-center justify-center">
                                <!-- Bouton - -->
                                <form method="POST" action="{{ route('reception.cart.decrease') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="state" value="{{ $product->pivot->state }}">
                                    <button type="submit" class="px-2 py-1 button-decrease">-</button>
                                </form>
                                <span class="px-3">{{ $product->pivot->quantity }}</span>
                                <!-- Bouton + -->
                                <form method="POST" action="{{ route('reception.cart.increase') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="state" value="{{ $product->pivot->state }}">
                                    <button type="submit" class="px-2 py-1 button-increase">+</button>
                                </form>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <form method="POST" action="{{ route('reception.cart.drop.products') }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="state" value="{{ $product->pivot->state }}">
                                <button type="submit" class="button-substract">Retirer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <!-- Footer du tableau pour afficher les totaux -->
            <tfoot class="border-t">
                <tr>
                    <td class="text-center border-b-4 border-l-4 border-t-4 py-3 px-4">Total Remboursement : {{ number_format($total_remboursement, 2) }} €</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-center py-3 px-4 font-semibold border-b-4 border-r-4 border-t-4">Total Bon Achat : <span class="text-green-600">{{ number_format($total_bon_achat, 2) }} €</span></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="mt-6 flex justify-end space-x-10 m-8">
        <div class="text-lg font-semibold">
            <form action="{{ route('reception.cart.validate') }}" method="POST">
                @csrf
                <input type="hidden" name="panier_id" value="{{ $panier->id }}">
                <button class="font-bold py-2 px-4 validate-cart">Valider le panier</button>
            </form>
        </div>
        <div class="text-lg">
            <form action="{{ route('reception.cart.drop')}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="panier_id" value="{{ $panier->id }}">
                <button class="py-2 px-4 delete-cart">Supprimer le panier</a>
            </form>
        </div>
    </div>
</x-app-layout>