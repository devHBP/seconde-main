<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
        <h2 class="font-semibold text-xl">Panier n°{{ $panier->id }} </h2>
            <a href="{{ route('reception.dashboard') }}">Retour au dashboard</a>
        </div>
    </x-slot>
    <div class="bg-white shadow overflow-hidden rounded-lg m-8">
        <div class="mb-3 ml-3">
            <h3 class="text-xl">Info Client :</h3>
            <p>{{ $panier->client->firstname }} {{ $panier->client->lastname }}</p>
            <p>{{ $panier->client->email }}</p>
            <p>{{ $panier->client->phone }}</p>
        </div>
        <table class="min-w-full bg-white">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Produit</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">État</th>
                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Quantité</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($panier->products as $product)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $product->type->name ?? 'Type non défini' }} | <span>{{ $product->brand->name }}</span></td>
                        <td class="py-3 px-4">{{ $product->pivot->state }}</td>
                        <td class="py-3 px-4">{{ $product->pivot->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-end space-x-10 m-8">
        <div class="text-lg font-semibold">
            <form action="{{ route('reception.cart.returned', ['panier_id' => $panier->id]) }}" method="POST">
                @csrf
                <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Restituer</button>
            </form>
        </div>
    </div>
</x-app-layout>