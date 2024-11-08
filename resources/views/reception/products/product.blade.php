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
        </div>
    </x-slot>
    
        {{-- Étape 1 : Sélection du Type --}}
    @if (!session('type_id'))
        <div class="layout-container tiles">
            <form method="POST" action="{{ route('reception.selection.store') }}">
                @csrf
                @foreach ($types as $type)
                    <button type="submit" name="type_id" value="{{ $type->id }}" class="tile">
                        {{ $type->name }}
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
                    <button type="submit" name="brand_id" value="{{ $brand->id }}" class="tile">
                        {{ $brand->name }}
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
                </button>
            @endforeach
        </form>
    </div>
    @endif

    {{-- Validation finale --}}
    @if (session('type_id') && session('brand_id') && session('state_id'))
        <div class="layout-container tiles">
            <form method="POST" action="{{ route('finalize') }}">
                @csrf
                <button type="submit" class="btn bg-green-500">Valider le Panier</button>
            </form>
        </div>
    @endif
</x-app-layout>