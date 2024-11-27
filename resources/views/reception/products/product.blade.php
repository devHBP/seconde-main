<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="title-reminder">{{ $user->name }} <span> * Connecté en {{ $role }}</span></p>
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
            <div>
                <a href="{{ route('reception.dashboard') }}">Retour</a>
            </div>
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
                {{-- @foreach ($states as $state)
                    <button type="submit" name="state_id" value="{{ $state->id }}" class="tile">
                        {{ $state->name }}
                        <p class="state-definition">{{ $state->definition }}</p>
                    </button>
                @endforeach --}}
                {{-- STATE PARFAIT ETAT  1 --}}
                <button type="submit" name="state_id" value="1" class="tile tile-state">
                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                        width="70.000000pt" height="70.000000pt" viewBox="0 0 512.000000 512.000000"
                        preserveAspectRatio="xMidYMid meet">

                        <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                        fill="" stroke="none">
                        <path d="M3569 3657 c-20 -12 -139 -132 -265 -267 -468 -502 -714 -761 -915
                        -964 -197 -199 -207 -208 -230 -196 -13 7 -154 143 -313 302 -172 173 -302
                        296 -322 304 -43 18 -96 18 -139 0 -39 -17 -189 -157 -229 -215 -35 -50 -43
                        -123 -19 -173 26 -52 918 -963 965 -984 52 -23 122 -20 168 8 43 26 1676 1744
                        1703 1791 21 40 22 118 1 160 -19 39 -198 223 -236 243 -42 22 -127 18 -169
                        -9z"/>
                        </g>
                    </svg>
                    PARFAIT ETAT
                    <p class="state-definition">Pas de trous, couture ok, flocage ok, pas de délavage, pas de tâches, pas de bouloches.</p>
                    <p class="state-wwd">Nous reprenons l'article avec une <span>rétribution maximum</span>.</p>
                </button>
                {{-- BON ETAT 4 --}}
                <button type="submit" name="state_id" value="4" class="tile tile-state">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="70px" height="70px" viewBox="0 0 70 70" version="1.1">
                        <defs>
                        <filter id="alpha" filterUnits="objectBoundingBox" x="0%" y="0%" width="100%" height="100%">
                        <feColorMatrix type="matrix" in="SourceGraphic" values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 1 0 0 0 1 0"/>
                        </filter>
                        <mask id="mask0">
                        <g filter="url(#alpha)">
                        <rect x="0" y="0" width="70" height="70" style="fill:rgb(0%,0%,0%);fill-opacity:0.988235;stroke:none;"/>
                        </g>
                        </mask>
                        <clipPath id="clip1">
                        <rect x="0" y="0" width="70" height="70"/>
                        </clipPath>
                        <g id="surface5" clip-path="url(#clip1)">
                        <path style=" stroke:none;fill-rule:evenodd;fill:;fill-opacity:1;" d="M 55.164062 19.617188 C 56.808594 19.597656 58.449219 19.617188 60.085938 19.6875 C 62.675781 20.554688 63.75 22.355469 63.300781 25.085938 C 62.867188 26.796875 61.796875 27.867188 60.085938 28.300781 C 58.449219 28.367188 56.808594 28.390625 55.164062 28.367188 C 57.011719 28.070312 58.21875 27.023438 58.789062 25.226562 C 59.296875 22.230469 58.089844 20.363281 55.164062 19.617188 Z M 55.164062 19.617188 "/>
                        </g>
                        <mask id="mask1">
                        <g filter="url(#alpha)">
                        <rect x="0" y="0" width="70" height="70" style="fill:rgb(0%,0%,0%);fill-opacity:0.862745;stroke:none;"/>
                        </g>
                        </mask>
                        <clipPath id="clip2">
                        <rect x="0" y="0" width="70" height="70"/>
                        </clipPath>
                        <g id="surface8" clip-path="url(#clip2)">
                        <path style=" stroke:none;fill-rule:evenodd;fill:;fill-opacity:1;" d="M 8.132812 20.578125 C 7.953125 20.851562 7.726562 21.078125 7.453125 21.257812 C 7.542969 20.894531 7.769531 20.667969 8.132812 20.578125 Z M 8.132812 20.578125 "/>
                        </g>
                        <mask id="mask2">
                        <g filter="url(#alpha)">
                        <rect x="0" y="0" width="70" height="70" style="fill:;fill-opacity:0.988235;stroke:none;"/>
                        </g>
                        </mask>
                        <clipPath id="clip3">
                        <rect x="0" y="0" width="70" height="70"/>
                        </clipPath>
                        <g id="surface11" clip-path="url(#clip3)">
                        <path style=" stroke:none;fill-rule:evenodd;fill:;fill-opacity:1;" d="M 55.164062 41.492188 C 56.808594 41.472656 58.449219 41.492188 60.085938 41.5625 C 62.675781 42.429688 63.75 44.230469 63.300781 46.960938 C 62.867188 48.671875 61.796875 49.742188 60.085938 50.175781 C 58.449219 50.242188 56.808594 50.265625 55.164062 50.242188 C 57.011719 49.945312 58.21875 48.898438 58.789062 47.101562 C 59.296875 44.105469 58.089844 42.238281 55.164062 41.492188 Z M 55.164062 41.492188 "/>
                        </g>
                        <mask id="mask3">
                        <g filter="url(#alpha)">
                        <rect x="0" y="0" width="70" height="70" style="fill:rgb(0%,0%,0%);fill-opacity:0.862745;stroke:none;"/>
                        </g>
                        </mask>
                        <clipPath id="clip4">
                        <rect x="0" y="0" width="70" height="70"/>
                        </clipPath>
                        <g id="surface14" clip-path="url(#clip4)">
                        <path style=" stroke:none;fill-rule:evenodd;fill:;fill-opacity:1;" d="M 8.132812 42.453125 C 7.953125 42.726562 7.726562 42.953125 7.453125 43.132812 C 7.542969 42.769531 7.769531 42.542969 8.132812 42.453125 Z M 8.132812 42.453125 "/>
                        </g>
                        </defs>
                        <g id="surface1">
                        <path style=" stroke:none;fill-rule:evenodd;fill:;fill-opacity:1;" d="M 55.164062 19.617188 C 58.089844 20.363281 59.296875 22.230469 58.789062 25.226562 C 58.21875 27.023438 57.011719 28.070312 55.164062 28.367188 C 40.035156 28.390625 24.90625 28.367188 9.773438 28.300781 C 7.1875 27.433594 6.113281 25.632812 6.5625 22.898438 C 6.683594 22.246094 6.980469 21.699219 7.453125 21.257812 C 7.726562 21.078125 7.953125 20.851562 8.132812 20.578125 C 8.574219 20.105469 9.121094 19.808594 9.773438 19.6875 C 24.90625 19.617188 40.035156 19.597656 55.164062 19.617188 Z M 55.164062 19.617188 "/>
                        <use xlink:href="#surface5" mask="url(#mask0)"/>
                        <use xlink:href="#surface8" mask="url(#mask1)"/>
                        <path style=" stroke:none;fill-rule:evenodd;fill:;fill-opacity:1;" d="M 55.164062 41.492188 C 58.089844 42.238281 59.296875 44.105469 58.789062 47.101562 C 58.21875 48.898438 57.011719 49.945312 55.164062 50.242188 C 40.035156 50.265625 24.90625 50.242188 9.773438 50.175781 C 7.1875 49.308594 6.113281 47.507812 6.5625 44.773438 C 6.683594 44.121094 6.980469 43.574219 7.453125 43.132812 C 7.726562 42.953125 7.953125 42.726562 8.132812 42.453125 C 8.574219 41.980469 9.121094 41.683594 9.773438 41.5625 C 24.90625 41.492188 40.035156 41.472656 55.164062 41.492188 Z M 55.164062 41.492188 "/>
                        <use xlink:href="#surface11" mask="url(#mask2)"/>
                        <use xlink:href="#surface14" mask="url(#mask3)"/>
                        </g>
                    </svg>
                    BON ETAT
                    <p class="state-definition">Petits trous ou defaut de coutures ou démodé</p>
                    <p class="state-wwd">Nous reprenons l'article avec une <span>rétribution minorée</span>.</p>
                </button>
                {{-- MAUVAIS ETAT 7 --}}
                <button type="submit" name="state_id" value="7" class="tile tile-state">
                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                        width="45.000000pt" height="60.000000pt" viewBox="0 0 512.000000 512.000000"
                        preserveAspectRatio="xMidYMid meet">

                        <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                        fill="darkred" stroke="none">
                        <path d="M575 4540 l-250 -250 865 -865 865 -865 -865 -865 -865 -865 253
                        -252 252 -253 865 865 865 865 865 -865 865 -865 252 253 253 252 -865 865
                        -865 865 865 865 865 865 -253 252 -252 253 -865 -865 -865 -865 -863 863
                        c-474 474 -864 862 -867 862 -3 0 -118 -113 -255 -250z"/>
                        </g>
                    </svg>
                    MAUVAIS ETAT
                    <p class="state-definition">Trous, déchirures, aspect très dégradé.</p>
                    <p class="state-wwd">Nous reprenons l'article à des fins de recyclage <span>sans rétribution</span>.</p>
                </button>
            </form>
        </div>
    @endif

    {{-- Afficher les prix et les options une fois l'état sélectionné --}}
    @if (session('state_id') && $selectedState)
        <div class="price-box">
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
    @else
        <div class="price-box">
            <p>Nous ne reprenons pas ce type d'articles ou l'article n'existe pas encore en base de données</p>
        </div>
    @endif

    <div class="annulation-container">
        <a href="{{ route('reception.product.cancel') }}" class="annulation">Annuler</a>
    </div>
    
</x-app-layout>