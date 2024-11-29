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
                    --background-primary: {{ $theme['background_primary'] }};
                    --background-secondary: {{ $theme['background_secondary'] }};
                    --font-primary: {{ $theme['font_primary'] }};
                    --font-secondary: {{ $theme['font_secondary'] }};
                    --pattern-logo: "{{ asset($theme['pattern_logo']) }}";
                }
            </style>
        @else
            <style>
                :root {
                    --background-primary: #e7ebee ;
                    --background-secondary: red;
                    --font-primary: black;
                    --font-secondary: #dee2e5;
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
                        const patternLogo = "{{ asset('storage/'. Auth::user()->picture->path)}}";
                    @endif
                    
                    
                    if(headerNav && patternLogo){
                        pattern.applyBackground(headerNav, patternLogo);
                    }
                    if(mainBloc && patternLogo){
                        pattern.applyBackground(mainBloc, patternLogo);
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