<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="title-reminder">Enseigne: {{ $enseigne->name }}</p>
                <h2 class="title">Options d'enseignes</h2>
            </div>
            <div class="header-right-button">
                <div>
                    <a href="{{ route('dashboard')}}">
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </x-slot>
    <div>
        @if (session('success'))
            <div class="bg-lime-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="layout-container reception gestion">
            <a href="{{ route('gestion.get.users', $enseigne->slug) }}">
                <div class="dashboard-cards">Utilisateurs</div>
            </a>
            <a href="{{ route('reception.cart') }}">
                <div class="dashboard-cards">Types</div>
            </a>
            <a href="{{ route('reception.clients')}}">
                <div class="dashboard-cards">Marques</div>
            </a>
            <a href="{{ route('reception.carts.to-return')}}" class="">
                <div class="dashboard-cards">Produits</div>
            </a>
            <a href="{{ route('reception.carts.to-return')}}" class="">
                <div class="dashboard-cards">Tickets</div>
            </a>
        </div>
    </div>
</x-app-layout>