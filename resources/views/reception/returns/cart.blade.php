<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="title-reminder">{{ $user->name }}<span> * Connecté en rôle Reception</span></p>
                <h2 class="title">Panier n°{{ $panier->id }} </h2>
            </div>
            <div>
                <p>A Restituer</p>
            </div>
            <div class="header-right-button">
                <a href="{{ route('reception.dashboard') }}">Retour au dashboard</a>
            </div>
        </div>
    </x-slot>
    <div class="overflow-hidden m-8 ">
        <div class="client-infos">
            <h3 class="text-xl">Info Client :</h3>
            <p>{{ $panier->client->firstname }} {{ $panier->client->lastname }}</p>
            <p>{{ $panier->client->email }}</p>
            <p>{{ $panier->client->phone }}</p>
        </div>
        <table class="min-w-full bg-white layout-ticket">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Produit</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">État</th>
                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Quantité</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($panier->products as $product)
                    <tr class="border-b">
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
                <button class="button-returned">Restituer</button>
            </form>
        </div>
    </div>
</x-app-layout>