<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="title-reminder">{{ $user->name }}<span> * Connecté en rôle Reception</span></p>
                <h2 class="title">Paniers à restituer</h3>
            </div>
            <div class="header-right-button">
                <div class="logout-dashboard">
                    <a href="{{ route('reception.dashboard') }}">Retour au dashboard</a>
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 layout-search">
            <!-- Formulaire de recherche de panier via uuid-->
            <form method="GET" action="" class="mb-6">
                <div class="flex items-center gap-4">
                    <input type="text" name="query" placeholder="Scanner le code barre / Entrer le numéro de ticket de reprise"
                        @if(isset($query))
                            value="{{ $query }}"
                        @endif
                        class="w-full py-2 px-4 border">
                    <button type="submit" class="bg-lime-600 text-white px-4 py-2">
                        Rechercher
                    </button>
                </div>
            </form>
        </div>
        <div class="max-w-7xl mx-auto layout-liste">
            <ul>
                @if(count($tickets)>0)
                    @foreach ($tickets as $ticket)
                    <a href="{{ route('reception.cart.to-return', ['panier_id' => $ticket->panier->id] ) }}">
                        <li class="flex justify-between p-4 bg-white cursor-pointer border border-gray-300 hover:bg-slate-100">
                            <span>{{ $ticket->uuid }}</span>
                            <span>{{ $ticket->client->firstname }} {{ $ticket->client->lastname }}</span>
                        </li>
                    </a>
                    @endforeach
                @else
                    <li>Ticket non trouvé</li>
                @endif
            </ul>
        </div>
    </div>
</x-app-layout>