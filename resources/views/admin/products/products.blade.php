<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="title-reminder">{{ $user->name }}<span> * Connecté en rôle Administrateur</span></p>
                <h2 class="title">Liste des Produits</h2>
            </div>
            <div class="header-right-button">
                <a href="{{ route('admin.product.create') }}">
                    Nouveau Produit
                </a>
                <a href="{{ route('admin.dashboard') }}">
                    Retour au dashboard
                </a>
            </div>
        </div>        
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <div class="overflow-hidden shadow-sm">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 text-left uppercase tracking-wider">
                                Type de Produit
                            </th>
                            <th class="px-5 py-3 border-b-2 text-left uppercase tracking-wider">
                                Marque du Produit
                            </th>
                            <th class="px-5 py-3 border-b-2 text-left uppercase tracking-wider">
                                Etats possible du Produit
                            </th>
                            <th class="px-5 py-3 border-b-2 text-left uppercase tracking-wider">
                                Prix Remboursement
                            </th>
                            <th class="px-5 py-3 border-b-2 text-center uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            {{-- Relation Type --}}
                            <td class="px-5 py-5 border-b">
                                {{ $product->type->name }}
                            </td>
                            {{-- Relation Marque --}}
                            <td class="px-5 py-5 border-b">
                                {{ $product->brand->name }}
                            </td>
                            {{-- Relation Etats --}}
                            <td class="px-5 py-5 border-b">
                                {{ $product->states->pluck('name')->join(' | ') }}
                            </td>
                            <td class="px-5 py-5 border-b">
                                {{ $product->states->pluck('pivot.prix_remboursement')->join(' | ') }}
                            </td>
                            <td class="px-5 py-5 border-b text-center form-actions">
                                <a href="{{ route('admin.product.modify', $product) }}">Modifier</a>
                                <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" class="">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>