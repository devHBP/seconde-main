<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header h-4">
            <h2 class="title">
                Reprise d'un Produit > Type
                @if(session('type_id') && !session('brand_id'))
                > Marque
                @endif
                @if(session('type_id') && session('brand_id') && !session('state_id'))
                > Etat
                @endif
            </h2>
            <a href="{{ route('reception.dashboard') }}">Retour</a>
        </div>
    </x-slot>
    
        {{-- Étape 1 : Sélection du Type --}}
    @if (!session('type_id'))
        <div class="layout-container tiles">
            <form method="POST" action="{{ route('reception.selection.store') }}">
                @csrf
                @foreach ($types as $type)
                    <button type="submit" name="type_id" value="{{ $type->id }}" class="tile flex flex-col flex-nowrap {{ $type->icon_path ? 'justify-around' : 'justify-center' }}">
                        @if($type->icon_path)
                            <img class="self-center content-baseline" width="100px" src="{{ asset('storage/' . $type->picture->path) }}" alt="{{ $type->picture->name }}">
                        @endif
                        <p class="text-xs self-center justify-self-center">{{ $type->name }}</p>
                    </button>
                @endforeach
            </form>
        </div>
    @endif
    
    {{-- Étape 2 : Sélection de la Marque --}}
    @if (session('type_id') && !session('brand_id'))
        <div class="layout-container tiles">
            <form method="POST" action="{{ route('reception.selection.store') }}">
                @csrf
                @foreach ($brands as $brand)
                    <button type="submit" name="brand_id" value="{{ $brand->id }}" class="tile flex flex-col flex-nowrap {{ $brand->icon_path ? 'justify-around' : 'justify-center' }}">
                            @if($brand->icon_path)
                                <img class="self-center content-baseline" width="100px" src="{{ asset('storage/' . $brand->picture->path) }}" alt="{{ $brand->picture->name }}">
                            @endif
                            <p class="text-xs self-center justify-self-center">{{ $brand->name }}</p>
                    </button>
                @endforeach
            </form>
        </div>
    @endif

    {{-- Étape 3 : Sélection de l'État --}}
    @if (session('type_id') && session('brand_id') && !session('state_id'))
        <div class="layout-container tiles">
        <form method="POST" action="{{ route('reception.selection.store') }}">
            @csrf
            @foreach ($states as $state)
                <button type="submit" name="state_id" value="{{ $state->id }}" class="tile">
                    {{ $state->name }}
                    <p class="state-definition">{{ $state->definition }}</p>
                </button>
            @endforeach
        </form>
    </div>
    @endif

    {{-- Afficher les prix et les options une fois l'état sélectionné --}}
    @if (session('state_id') && $selectedState)
        <div class="bg-gray-100 p-6 rounded shadow mt-6 price-box">
            <h3 class="text-xl font-bold">{{ $selectedState->name }}</h3>
            <div class='prices'>
                <p>Prix de remboursement : <span>{{ $selectedState->pivot->prix_remboursement ?? 'N/A' }} €</span></p>
                <p class="price-focus">Prix de bon d'achat : <span>{{ $selectedState->pivot->prix_bon_achat ?? 'N/A' }} €</span></p>
            </div>
            {{-- Boutons "Valider" et "Annuler" --}}
            <div class="validation">
                <form method="POST" action="{{ route('reception.cart.add') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="">Envoyer dans le Panier</button>
                </form>
            </div>
        </div>
    @endif

    <a href="{{ route('reception.product.cancel') }}" class="annulation">Annuler</a>

</x-app-layout>