<x-guest-layout :accountName="$accountName">
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <h2 class="title">
                    Simuler la reprise d'un Produit > Type
                    @if(session('type_id') && !session('brand_id'))
                    > Marque
                    @endif
                    @if(session('type_id') && session('brand_id') && !session('state_id'))
                    > Etat
                    @endif
                </h2>
            </div>
        </div>
    </x-slot>
    <main>
        {{-- Étape 1 : Sélection du Type --}}
        @if (!session('type_id'))
        
            <div class="layout-container tiles">
                <form method="POST" action="{{ route('simulateur.selection.store', $accountSlug) }}">
                    @csrf
                    @foreach ($types as $type)
                        <button type="submit" name="type_id" value="{{ $type->id }}" class="tile tiles-simulateur flex flex-col flex-nowrap {{ $type->icon_path ? 'justify-around' : 'justify-center' }}">
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
                <form method="POST" action="{{ route('simulateur.selection.store', $accountSlug) }}">
                    @csrf
                    @foreach ($brands as $brand)
                        <button type="submit" name="brand_id" value="{{ $brand->id }}" class="tile tiles-simulateur flex flex-col flex-nowrap {{ $brand->icon_path ? 'justify-around' : 'justify-center' }}">
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
                <form method="POST" action="{{ route('simulateur.selection.store', $accountSlug) }}">
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
            <div class="price-box simulateur">
                <div class="title-price-container">
                    <h3 class="title-simulateur">{{$product->type->name }} {{$product->brand->name}}</h3>
                    <p class="inversed">{{ $selectedState->name }}</p>
                </div>
                <div class='prices'>
                    <div class="prices-simulateur">
                        <div class="img-container">
                            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40px" height="40px" viewBox="0 0 512 512" xml:space="preserve" fill=""><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css">  .st0{fill:var(--main-cards-button);}  </style> <g> <path class="st0" d="M0,120v272h512V120H0z M32,313.813V198.156c22.969-3.875,40.844-22.703,43.188-46.156h132.938 c-30.016,20.375-50.313,59.25-50.313,104c0,44.734,20.281,83.625,50.297,104H75.188C72.844,336.547,54.969,317.688,32,313.813z M287.969,238.156l-3.313,15.969h-54.516c-0.063,0.906-0.109,1.844-0.109,2.75c0,2.281,0.203,4.609,0.594,6.953h52.063 l-3.281,15.969h-42.563c7.75,12.063,20.969,19.359,35.469,19.359c4.906,0,9.859-0.891,14.656-2.672l3.844-1.438v22.469 l-2.109,0.563c-5.391,1.453-10.922,2.188-16.391,2.188c-26.094,0-49.563-16.188-59.016-40.469h-13.5v-15.969h9.578 c-0.297-2.453-0.438-4.719-0.438-6.953c0-0.906,0.031-1.844,0.063-2.75h-9.203v-15.969h12.047 c8.188-26.391,32.734-44.656,60.469-44.656c7.375,0,14.594,1.313,21.531,3.844l2.297,0.828l-4.313,21.141l-3.219-1.344 c-5.266-2.219-10.75-3.344-16.297-3.344c-16.031,0-30.75,9.297-37.844,23.531H287.969z M303.875,152h132.906 c2.344,23.453,20.25,42.281,43.219,46.156v115.656c-22.969,3.891-40.875,22.734-43.219,46.188H303.891 c30.016-20.375,50.297-59.266,50.297-104C354.188,211.25,333.906,172.375,303.875,152z"></path> <circle class="st0" cx="125.125" cy="256" r="13.75"></circle> <circle class="st0" cx="386.875" cy="256" r="13.75"></circle> </g> </g></svg>
                        </div>
                        <h4>Prix Remboursement</h4>
                        <p><span>{{ $selectedState->prix_remboursement ?? 'N/A' }} €</span></p>
                        
                    </div>
                    <div class="prices-simulateur">
                        <div class="img-container">
                            <svg width="50px" height="50px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M17.817 16.063V14.721C17.817 14.3887 17.949 14.07 18.184 13.835L19.133 12.886C19.6223 12.3967 19.6223 11.6033 19.133 11.114L18.184 10.165C17.949 9.93001 17.817 9.61131 17.817 9.27899V7.93599C17.817 7.24398 17.256 6.68299 16.564 6.68299H15.221C14.8887 6.68299 14.57 6.55097 14.335 6.31599L13.386 5.36699C12.8967 4.87767 12.1033 4.87767 11.614 5.36699L10.665 6.31599C10.43 6.55097 10.1113 6.68299 9.77899 6.68299H8.43599C8.1035 6.68299 7.78464 6.81514 7.54963 7.05034C7.31462 7.28554 7.18273 7.6045 7.18299 7.93699V9.27899C7.18299 9.61131 7.05097 9.93001 6.81599 10.165L5.86699 11.114C5.37767 11.6033 5.37767 12.3967 5.86699 12.886L6.81599 13.835C7.05097 14.07 7.18299 14.3887 7.18299 14.721V16.063C7.18299 16.755 7.74398 17.316 8.43599 17.316H9.77899C10.1113 17.316 10.43 17.448 10.665 17.683L11.614 18.632C12.1033 19.1213 12.8967 19.1213 13.386 18.632L14.335 17.683C14.57 17.448 14.8887 17.316 15.221 17.316H16.563C16.8955 17.3163 17.2144 17.1844 17.4496 16.9493C17.6848 16.7143 17.817 16.3955 17.817 16.063Z" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M9.78202 10.641C9.50715 10.3662 9.42492 9.95286 9.57366 9.59375C9.7224 9.23464 10.0728 9.00049 10.4615 9.00049C10.8502 9.00049 11.2006 9.23464 11.3494 9.59375C11.4981 9.95286 11.4159 10.3662 11.141 10.641C10.7657 11.0163 10.1573 11.0163 9.78202 10.641Z" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M13.859 14.718C13.5841 14.4431 13.5019 14.0298 13.6506 13.6707C13.7994 13.3115 14.1498 13.0774 14.5385 13.0774C14.9272 13.0774 15.2776 13.3115 15.4263 13.6707C15.5751 14.0298 15.4928 14.4431 15.218 14.718C14.8427 15.0932 14.2343 15.0932 13.859 14.718Z" stroke="" stroke-width="1.5" stroke-linecap="round"></path> <path d="M15.218 9.28101L9.78101 14.719" stroke="" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                        </div>
                        <h4>Prix Bon Achat</h4>
                        <p class="price-focus"><span>{{ $selectedState->prix_bon_achat ?? 'N/A' }} €</span></p>
                    </div>
                </div>
            </div>
            <div class="notice-shop">
                <p>Rendez-vous en <span>magasin</span>!</p>
            </div>
        @endif
        
        <div class="annulation-container">
            <a href="{{ route('simulateur.clean', $accountSlug) }}" class="annulation">Recommencer</a>
        </div>
        <p class="notice">*Prix à titre indicatif, sous reserve de diagnostic produit.</p>
    </main>
    @if (isset($accountName))
        <style>
            /* TODO  Attention, les couleur sont envoyés par le controlleur ..*/
            :root{
                --header-background: {{ $customThemeColors['header_background'] }};
                --header-title: {{ $customThemeColors['header_title'] }};
                --header-subtitle: {{$customThemeColors['header_subtitle'] }};
                --header-button-background: {{ $customThemeColors['header_button_background'] }};
                --header-button-font: {{ $customThemeColors['header_button_font'] }};

                --subheader-background: {{ $customThemeColors['subheader_background'] }};
                --subheader-title: {{ $customThemeColors['subheader_title'] }};
                --subheader-subtitle: {{$customThemeColors['subheader_subtitle'] }};
                --subheader-button: {{ $customThemeColors['subheader_button'] }};
                --subheader-button-font: {{ $customThemeColors['subheader_button_font'] }};

                --main-background: {{ $customThemeColors['main_background'] }};
                --main-cards-background: {{ $customThemeColors['main_cards_background'] }};
                --main-cards-title: {{$customThemeColors['main_cards_title'] }};
                --main-cards-font: {{ $customThemeColors['main_cards_font'] }};
                --main-cards-svg: {{ $customThemeColors['main_cards_svg'] }};
                --main-cards-button: {{ $customThemeColors['main_cards_button'] }};

                --pattern-logo:{{$patternPath}};
            }
        </style> 
    @endif

    <script>
        const pattern = {

            init: () => {
                const headerNav = document.querySelector('nav.header__nav');
                const mainBloc = document.querySelector('main');
                const patternLogo = "{{ asset('/storage/'. $patternPath) }}";
                console.log( );
                if(patternLogo !== "{{asset('/storage/')}}"){
                    if(headerNav && patternLogo){
                    pattern.applyBackground(headerNav, patternLogo, 1);
                    }
                    if(mainBloc && patternLogo){
                        pattern.applyBackground(mainBloc, patternLogo, 1.3);
                    }
                }
            },

            applyBackground: (element, logoUrl, coeff) => {
                const elementWidth = element.offsetWidth ;
                const elementHeight = element.offsetHeight ;
                const spacingX = 120 * coeff + 50; // Intervalle horizontal entre chaque SVG (en px)
                const spacingY = 120 * coeff + 50; // Intervalle vertical entre chaque SVG (en px)

                for (let y = 0; y < elementHeight; y += spacingY) {
                    for (let x = 0; x < elementWidth; x += spacingX) {
                        const svgElement = document.createElement('img');
                        svgElement.src = logoUrl;
                        svgElement.classList.add("svg-pattern");

                        // Rotation aléatoire
                        const randomRotation = Math.random() * 120;

                        // Ajustement de la taille en fonction du coeff
                        svgElement.style.width = `${120 * coeff}px`;
                        svgElement.style.height = `${120 * coeff}px`;
                        // Placement à des intervalles réguliers
                        svgElement.style.left = `${x}px`;
                        svgElement.style.top = `${y}px`;
                        svgElement.style.transform = `rotate(${randomRotation}deg)`;

                        element.appendChild(svgElement);
                    }
                }
            }
        }
        document.addEventListener('DOMContentLoaded', pattern.init);
    </script>
</x-guest-layout>
