<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="title-reminder"></p>
                <h2 class="title">
                    Modifier les réglages
                </h2>
            </div>
            <div class="header-right-button">
                <a href="{{ Auth::user()->login === SUPER_ADMIN_LOGIN ? route('dashboard') : route('admin.dashboard')}}">Retour Menu</a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 create-or-modify">
                <form action="{{ route("admin.settings.update") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Nom de la marque -->
                    <div class="mb-3">
                        <label for="name" class="block font-bold">Nom de l'enseigne</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $account->name ?? '')}}" class="shadow appearance-none border rounded w-full py-2 px-3">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <p>Slug : {{ $account->slug }}</p>
                    </div>
                    <div class="flex flex-col border p-4">
                        <!-- Couleur CSS header_background- -->
                        <div class="mb-3 flex justify-between items-center">
                            <label for="header_background" class="block font-bold">Header: Arriere plan</label>
                            <div class="flex gap-2 self-center">
                                <input type="color" name="header_background" id="header_background" value="{{ old('header_background', $account->header_background ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                                <div id="header_background_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('header_background', $account->header_background ?? '') }}"></div>
                            </div>
                            @error('header_background')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Couleur CSS header_title -->
                        <div class="mb-3 flex justify-between items-center">
                            <label for="header_title" class="block font-bold">Header: Titre</label>
                            <div class="flex gap-2">
                                <input type="color" name="header_title" id="header_title" value="{{ old('header_title', $account->header_title ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                                <div id="header_title_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('header_title', $account->header_title ?? '') }}"></div>
                            </div>
                            @error('header_title')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Couleur CSS header_subtitle -->
                        <div class="mb-3 flex justify-between items-center">
                            <label for="header_subtitle" class="block font-bold">Header: Second titre</label>
                            <div class="flex gap-2">
                                <input type="color" name="header_subtitle" id="header_subtitle" value="{{ old('header_subtitle', $account->header_subtitle ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                                <div id="header_subtitle_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('header_subtitle', $account->header_subtitle ?? '') }}"></div>
                            </div>
                            @error('header_subtitle')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Couleur CSS header_button_background -->
                        <div class="mb-3 flex justify-between items-center">
                            <label for="header_button_background" class="block font-bold">Header: Bouton navigation arriere plan</label>
                            <div class="flex gap-2">
                                <input type="color" name="header_button_background" id="header_button_background" value="{{ old('header_button_background', $account->header_button_background ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                                <div id="header_button_background_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('header_button_background', $account->header_button_background ?? '') }}"></div>
                            </div>
                            @error('header_button_background')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Couleur CSS header_button_font -->
                        <div class="mb-3 flex justify-between items-center">
                            <label for="header_button_font" class="block font-bold">Header: Bouton navigation police</label>
                            <div class="flex gap-2">
                                <input type="color" name="header_button_font" id="header_button_font" value="{{ old('header_button_font', $account->header_button_font ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                                <div id="header_button_font_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('header_button_font', $account->header_button_font ?? '') }}"></div>
                            </div>
                            @error('header_button_font')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-col border p-4 mt-2">
                        <!-- Couleur CSS subheader_background- -->
                        <div class="mb-3 flex justify-between items-center">
                            <label for="subheader_background" class="block font-bold">Sub-Header: Arriere plan</label>
                            <div class="flex gap-2 self-center">
                                <input type="color" name="subheader_background" id="subheader_background" value="{{ old('subheader_background', $account->subheader_background ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                                <div id="subheader_background_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('subheader_background', $account->subheader_background ?? '') }}"></div>
                            </div>
                            @error('subheader_background')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Couleur CSS subheader_title -->
                        <div class="mb-3 flex justify-between items-center">
                            <label for="subheader_title" class="block font-bold">Sub-Header: Titre</label>
                            <div class="flex gap-2">
                                <input type="color" name="subheader_title" id="subheader_title" value="{{ old('subheader_title', $account->subheader_title ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                                <div id="subheader_title_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('subheader_title', $account->subheader_title ?? '') }}"></div>
                            </div>
                            @error('subheader_title')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Couleur CSS subheader_subtitle -->
                        <div class="mb-3 flex justify-between items-center">
                            <label for="subheader_subtitle" class="block font-bold">Sub-Header: sous-titre</label>
                            <div class="flex gap-2">
                                <input type="color" name="subheader_subtitle" id="subheader_subtitle" value="{{ old('subheader_subtitle', $account->subheader_subtitle ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                                <div id="subheader_subtitle_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('subheader_subtitle', $account->subheader_subtitle ?? '') }}"></div>
                            </div>
                            @error('subheader_subtitle')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Couleur CSS subheader_button -->
                        <div class="mb-3 flex justify-between items-center">
                            <label for="subheader_button" class="block font-bold">Sub-Header: Bouton arriere plan</label>
                            <div class="flex gap-2">
                                <input type="color" name="subheader_button" id="subheader_button" value="{{ old('subheader_button', $account->subheader_button ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                                <div id="subheader_button_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('subheader_button', $account->subheader_button ?? '') }}"></div>
                            </div>
                            @error('subheader_button')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Couleur CSS subheader_button_font -->
                        <div class="mb-3 flex justify-between items-center">
                            <label for="subheader_button_font" class="block font-bold">Sub-Header: Bouton police</label>
                            <div class="flex gap-2">
                                <input type="color" name="subheader_button_font" id="subheader_button_font" value="{{ old('subheader_button_font', $account->subheader_button_font ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                                <div id="subheader_button_font_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('subheader_button_font', $account->subheader_button_font ?? '') }}"></div>
                            </div>
                            @error('subheader_button_font')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-wrap"></div>
                    <div class="flex flex-col border p-4 mt-2">
                        <!-- Couleur CSS main_background- -->
                        <div class="mb-3 flex justify-between items-center">
                            <label for="main_background" class="block font-bold">Main: Arriere plan</label>
                            <div class="flex gap-2 self-center">
                                <input type="color" name="main_background" id="main_background" value="{{ old('main_background', $account->main_background ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                                <div id="main_background_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('main_background', $account->main_background ?? '') }}"></div>
                            </div>
                            @error('main_background')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Couleur CSS main_cards_background -->
                        <div class="mb-3 flex justify-between items-center">
                            <label for="main_cards_background" class="block font-bold">Main: Cards arrière plan</label>
                            <div class="flex gap-2">
                                <input type="color" name="main_cards_background" id="main_cards_background" value="{{ old('main_cards_background', $account->main_cards_background ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                                <div id="main_cards_background_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('main_cards_background', $account->main_cards_background ?? '') }}"></div>
                            </div>
                            @error('main_cards_background')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Couleur CSS main_cards_title -->
                        <div class="mb-3 flex justify-between items-center">
                            <label for="main_cards_title" class="block font-bold">Main: Cards titres</label>
                            <div class="flex gap-2">
                                <input type="color" name="main_cards_title" id="main_cards_title" value="{{ old('main_cards_title', $account->main_cards_title ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                                <div id="main_cards_title_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('main_cards_title', $account->main_cards_title ?? '') }}"></div>
                            </div>
                            @error('main_cards_title')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Couleur CSS main_cards_font -->
                        <div class="mb-3 flex justify-between items-center">
                            <label for="main_cards_font" class="block font-bold">Main: Cards police</label>
                            <div class="flex gap-2">
                                <input type="color" name="main_cards_font" id="main_cards_font" value="{{ old('main_cards_font', $account->main_cards_font ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                                <div id="main_cards_font_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('main_cards_font', $account->main_cards_font ?? '') }}"></div>
                            </div>
                            @error('main_cards_font')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Couleur CSS main_cards_svg -->
                        <div class="mb-3 flex justify-between items-center">
                            <label for="main_cards_svg" class="block font-bold">Main: Cards svg</label>
                            <div class="flex gap-2">
                                <input type="color" name="main_cards_svg" id="main_cards_svg" value="{{ old('main_cards_svg', $account->main_cards_svg ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                                <div id="main_cards_svg_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('main_cards_svg', $account->main_cards_svg ?? '') }}"></div>
                            </div>
                            @error('main_cards_svg')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Couleur CSS main_cards_button -->
                        <div class="mb-3 flex justify-between items-center">
                            <label for="main_cards_button" class="block font-bold">Main: Cards bouton</label>
                            <div class="flex gap-2">
                                <input type="color" name="main_cards_button" id="main_cards_button" value="{{ old('main_cards_button', $account->main_cards_button ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                                <div id="main_cards_button_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('main_cards_button', $account->main_cards_button ?? '') }}"></div>
                            </div>
                            @error('main_cards_button')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="pattern_logo" class="block">Pattern ( motif d'arrière plan )</label>
                        <!-- Option d'import d'une nouvelle image -->
                        <div class="mt-4">
                            <label for="pattern_logo" class="block">Importez une nouvelle image :</label>
                            <input type="file" name="pattern_logo" id="pattern_logo" accept=".png,.svg" class="block w-full mt-2">
                        </div>
                        @if($account->pattern_logo)
                            <div class="mt-4 mb-4">
                                Image actuelle
                                <img src="{{ asset('storage/' . $account->picture->path) }}"  width="120px" alt="">
                            </div>
                        @endif 
                    </div>

                    @error('pattern_logo')
                        <p>{{ $message }}</p>
                    @enderror

                    <!-- Bouton de soumission -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="">
                            Valider
                        </button>
                        <a href="{{ Auth::user()->login === SUPER_ADMIN_LOGIN ? route('dashboard') : route('admin.dashboard') }}" class="cancel">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const elements = [
                { inputId: 'header_background', previewId: 'header_background_preview'},
                { inputId: 'header_title', previewId: 'header_title_preview'},
                { inputId: 'header_subtitle', previewId: 'header_subtitle_preview'},
                { inputId: 'header_button_background', previewId: 'header_button_background_preview'},
                { inputId: 'header_button_font', previewId: 'header_button_font_preview'},

                { inputId: 'subheader_background', previewId: 'subheader_background_preview'},
                { inputId: 'subheader_title', previewId: 'subheader_title_preview'},
                { inputId: 'subheader_subtitle', previewId: 'subheader_subtitle_preview'},
                { inputId: 'subheader_button', previewId: 'subheader_button_preview'},
                { inputId: 'subheader_button_font', previewId: 'subheader_button_font_preview'},

                { inputId: 'main_background', previewId: 'main_background_preview'},
                { inputId: 'main_cards_background', previewId: 'main_cards_background_preview'},
                { inputId: 'main_cards_title', previewId: 'main_cards_title_preview'},
                { inputId: 'main_cards_font', previewId: 'main_cards_font_preview'},
                { inputId: 'main_cards_svg', previewId: 'main_cards_svg_preview'},
                { inputId: 'main_cards_button', previewId: 'main_cards_button_preview'},
            ]
            const updatePreview = (input, preview) => {
                input.addEventListener('input', (evt) => {
                    preview.style.backgroundColor = evt.target.value;
                });
            };

            elements.forEach(({inputId, previewId}) => {
                const inputElement = document.querySelector(`#${inputId}`);
                const previewElement = document.querySelector(`#${previewId}`);

                if (inputElement && previewElement){
                    updatePreview(inputElement, previewElement);
                } 
                else{
                    console.warn(`Element non trouvé : ${inputId}, ${previewId}`);
                }
            });
        })
    </script>
</x-app-layout>