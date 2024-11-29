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
            <div class="overflow-visible shadow-sm">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="filter1 px-5 py-3 border-b-2 text-left uppercase tracking-wider z-10">
                                <div class="flex items-center justify-between">
                                    <span>Types</span>
                                    <div class="flex items-center">
                                        <div class="relative z-90">
                                            <!-- Bouton pour ouvrir la boîte de dialogue -->
                                            <button id="type-filter-toggle" class="p-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707L13 14.414V19a1 1 0 01-.293.707l-2 2A1 1 0 0110 21v-6.586L3.293 7.293A1 1 0 013 6.586V4z" />
                                                </svg>
                                            </button>
                                    
                                            <!-- Boîte de dialogue -->
                                            <div id="type-filter-dialog" class="absolute top-full mt-2 left-0 w-64 bg-white shadow-lg rounded-lg border border-gray-200 hidden z-50">
                                                <div class="max-h-48 overflow-y-auto z-20">
                                                    <!-- Liste déroulante des types -->
                                                    <form action="{{ route('admin.products') }}" method="GET">
                                                        @foreach($types as $type)
                                                            <button type="submit" name="type" value="{{ $type->id }}" class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                                                                {{ $type->name }}
                                                            </button>
                                                        @endforeach
                                                    </form>
                                                </div>
                                                <!-- Bouton pour fermer -->
                                                <button id="type-filter-close" class="w-full text-center px-4 py-2 text-sm text-gray-500 hover:bg-gray-100">
                                                    Fermer
                                                </button>
                                            </div>
                                        </div>
                                        @if (session('type_filter'))
                                            <span>
                                                <a href="{{ route('admin.products.drop.filters', "type_filter") }}" id="drop-session-type">
                                                    <svg width="40px" height="40px" viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.99486 7.00636C6.60433 7.39689 6.60433 8.03005 6.99486 8.42058L10.58 12.0057L6.99486 15.5909C6.60433 15.9814 6.60433 16.6146 6.99486 17.0051C7.38538 17.3956 8.01855 17.3956 8.40907 17.0051L11.9942 13.4199L15.5794 17.0051C15.9699 17.3956 16.6031 17.3956 16.9936 17.0051C17.3841 16.6146 17.3841 15.9814 16.9936 15.5909L13.4084 12.0057L16.9936 8.42059C17.3841 8.03007 17.3841 7.3969 16.9936 7.00638C16.603 6.61585 15.9699 6.61585 15.5794 7.00638L11.9942 10.5915L8.40907 7.00636C8.01855 6.61584 7.38538 6.61584 6.99486 7.00636Z" fill=""></path> </g></svg>
                                                </a>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                            </th>
                            <th class="filter2 px-5 py-3 border-b-2 text-left uppercase tracking-wider">
                                <div class="flex items-center gap-4">
                                    <span>Marques</span>
                                    <div class="flex items-center">
                                        <div class="relative">
                                            <!-- Bouton pour ouvrir la boîte de dialogue -->
                                            <button id="brand-filter-toggle" class="p-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707L13 14.414V19a1 1 0 01-.293.707l-2 2A1 1 0 0110 21v-6.586L3.293 7.293A1 1 0 013 6.586V4z" />
                                                </svg>
                                            </button>
                                            <!-- Boîte de dialogue -->
                                            <div id="brand-filter-dialog" class="absolute top-full mt-2 left-0 w-64 bg-white shadow-lg rounded-lg border border-gray-200 hidden z-50">
                                                <div class="max-h-48 overflow-y-auto">
                                                    <!-- Liste déroulante des brand -->
                                                    <form action="{{ route('admin.products') }}" method="GET">
                                                        @foreach($brands as $brand)
                                                            <button type="submit" name="brand" value="{{ $brand->id }}" class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                                                                {{ $brand->name }}
                                                            </button>
                                                        @endforeach
                                                    </form>
                                                </div>
                                                <!-- Bouton pour fermer -->
                                                <button id="brand-filter-close" class="w-full text-center px-4 py-2 text-sm text-gray-500 hover:bg-gray-100">
                                                    Fermer
                                                </button>
                                            </div>
                                        </div>
                                        @if (session('brand_filter'))
                                        <span>
                                            <a href="{{ route('admin.products.drop.filters', "brand_filter" )}}" id="drop-session-brand">
                                                <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.99486 7.00636C6.60433 7.39689 6.60433 8.03005 6.99486 8.42058L10.58 12.0057L6.99486 15.5909C6.60433 15.9814 6.60433 16.6146 6.99486 17.0051C7.38538 17.3956 8.01855 17.3956 8.40907 17.0051L11.9942 13.4199L15.5794 17.0051C15.9699 17.3956 16.6031 17.3956 16.9936 17.0051C17.3841 16.6146 17.3841 15.9814 16.9936 15.5909L13.4084 12.0057L16.9936 8.42059C17.3841 8.03007 17.3841 7.3969 16.9936 7.00638C16.603 6.61585 15.9699 6.61585 15.5794 7.00638L11.9942 10.5915L8.40907 7.00636C8.01855 6.61584 7.38538 6.61584 6.99486 7.00636Z" fill="darkred"></path> </g></svg>
                                            </a>
                                        </span>
                                        @endif
                                    </div>
                                </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', () => {   
            const brandFilterToggle =document.getElementById('brand-filter-toggle');
            const brandFilterDialog =document.getElementById('brand-filter-dialog');
            const brandFilterClose =document.getElementById('brand-filter-close');
            const typeFilterToggle = document.getElementById('type-filter-toggle');
            const typeFilterDialog = document.getElementById('type-filter-dialog');
            const typeFilterClose = document.getElementById('type-filter-close');

            // Ouvrir la boîte de dialogue
            typeFilterToggle.addEventListener('click', () => {
                typeFilterDialog.classList.toggle('hidden');
            });

            // Fermer la boîte de dialogue
            typeFilterClose.addEventListener('click', () => {
                typeFilterDialog.classList.add('hidden');
            });

            brandFilterToggle.addEventListener('click', ()=> {
                brandFilterDialog.classList.toggle('hidden');
            });
            brandFilterClose.addEventListener('click', ()=>{
                brandFilterDialog.classList.add('hidden');
            });

        });
    </script>
</x-app-layout>