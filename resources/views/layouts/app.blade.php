<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- FavIcon -->
        <link rel="shortcut icon" href="{{ asset('favicon.webp') }}" type="image/x-icon">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @if(isset($theme))
            <style>
                :root {
                    --header-background: {{ $theme['header_background'] }};
                    --header-title: {{ $theme['header_title'] }};
                    --header-subtitle: {{ $theme['header_subtitle'] }};
                    --header-button-background: {{ $theme['header_button_background'] }};
                    --header-button-font: {{ asset($theme['header_button_font']) }};

                    --subheader-background: {{ $theme['subheader_background'] }};
                    --subheader-title: {{ $theme['subheader_title'] }};
                    --subheader-subtitle: {{ $theme['subheader_subtitle'] }};
                    --subheader-button: {{ $theme['subheader_button'] }};
                    --subheader-button-font: {{ asset($theme['subheader_button_font']) }};

                    --main-background: {{ $theme['main_background'] }};
                    --main-cards-background: {{ $theme['main_cards_background'] }};
                    --main-cards-title: {{ $theme['main_cards_title'] }};
                    --main-cards-font: {{ $theme['main_cards_font'] }};
                    --main-cards-svg: {{ asset($theme['main_cards_svg']) }};
                    --main-cards-button: {{ asset($theme['main_cards_button']) }};
                }
            </style>
        @else
            <style>
                :root {
                    --header-background: ;
                    --header-title: ;
                    --header-subtitle: ;
                    --header-button-background: ;
                    --header-button-font:  ;

                    --subheader-background: ;
                    --subheader-title: ;
                    --subheader-subtitle: ;
                    --subheader-button: ;
                    --subheader-button-font: ;

                    --main-background: #e7ebee;
                    --main-cards-background: #dee2e5;
                    --main-cards-title: ;
                    --main-cards-font: black;
                    --main-cards-svg: ;
                    --main-cards-button: whitesmoke;

                    --pattern-logo: "{{ asset('customisation/recycle-svgrepo-com.svg') }}";
                }
            </style>
        @endif
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @if (Auth::user())
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header>
                            {{ $header }}
                    </header>
                @endisset  
            @endif


            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script>
            const pattern = {

                init: () => {
                    const headerNav = document.querySelector('nav.header__nav');
                    const mainBloc = document.querySelector('main');
                    @if (!Auth::user())
                        const patternLogo = "{{ asset('storage/customisation/recycle-svgrepo-com.svg') }}";
                    @else
                        @if(Auth::user()->picture !== null )
                            const patternLogo = "{{ asset('storage/'. Auth::user()->picture->path)}}";
                        @else
                            const patternLogo = "{{ asset('storage/')}}"
                        @endif
                    @endif
                    
                    if(patternLogo !== "{{asset('/storage/')}}"){
                        if(headerNav && patternLogo){
                            pattern.applyBackground(headerNav, patternLogo);
                        }
                        if(mainBloc && patternLogo){
                            pattern.applyBackground(mainBloc, patternLogo);
                        }
                    }
                },

                applyBackground: (element, logoUrl) => {
                    const elementWidth = element.offsetWidth;
                    const elementHeight = element.offsetHeight;

                    const spacingX = 120; // Intervalle horizontal entre chaque SVG (en px)
                    const spacingY = 120; // Intervalle vertical entre chaque SVG (en px)

                    for (let y = 0; y < elementHeight; y += spacingY) {
                        for (let x = 0; x < elementWidth; x += spacingX) {
                            const svgElement = document.createElement('img');
                            svgElement.src = logoUrl;
                            svgElement.classList.add("svg-pattern");

                            // Rotation aléatoire
                            const randomRotation = Math.random() * 120;

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
    </body>
    


    @stack('scripts')
</html>