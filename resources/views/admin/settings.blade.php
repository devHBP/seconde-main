<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Modifier les réglages
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route("admin.settings.update") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Nom de la marque -->
                    <div class="mb-3">
                        <label for="name" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">Nom de l'enseigne</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $account->name ?? '')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Couleur CSS background-primary -->
                    <div class="mb-3">
                        <label for="custom_background_primary" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">Couleur primaire</label>
                        <input type="color" name="custom_background_primary" id="custom_background_primary" value="{{ old('custom_background_primary', $account->custom_background_primary ?? '')}}" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
                        <div id="custom_background_primary_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('custom_background_primary', $account->custom_background_primary ?? '') }}"></div>
                        @error('custom_background_primary')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Couleur CSS background-secondary -->
                    <div class="mb-3">
                        <label for="custom_background_secondary" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">Couleur secondaire</label>
                        <input type="color" name="custom_background_secondary" id="custom_background_secondary" value="{{ old('custom_background_secondary', $account->custom_background_secondary ?? '')}}" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
                        <div id="custom_background_secondary_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('custom_background_secondary', $account->custom_background_secondary ?? '') }}"></div>
                        @error('custom_background_secondary')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Couleur CSS font-primary -->
                    <div class="mb-3">
                        <label for="custom_font_primary" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">Couleur de police primaire</label>
                        <input type="color" name="custom_font_primary" id="custom_font_primary" value="{{ old('custom_font_primary', $account->custom_font_primary ?? '')}}" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
                        <div id="custom_font_primary_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('custom_font_primary', $account->custom_font_primary ?? '') }}"></div>
                        @error('custom_font_primary')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Couleur CSS font-secondary -->
                    <div class="mb-3">
                        <label for="custom_font_secondary" class="block text-gray-700 dark:text-gray-300 text-sm font-bold">Couleur de police secondaire</label>
                        <input type="color" name="custom_font_secondary" id="custom_font_secondary" value="{{ old('custom_font_secondary', $account->custom_font_secondary ?? '')}}" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
                        <div id="custom_font_secondary_preview" class="w-8 h-8 border rounded" style="background-color: {{ old('custom_font_secondary', $account->custom_font_secondary ?? '') }}"></div>
                        @error('custom_font_secondary')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="pattern_logo" class="block text-sm font-medium text-gray-700">Pattern ( motif d'arrière plan )</label>
                        <!-- Option d'import d'une nouvelle image -->
                        <div class="mt-4">
                            <label for="pattern_logo" class="block text-sm text-gray-600">Importez une nouvelle image :</label>
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
                        <button type="submit" class="bg-lime-600 hover:bg-lime-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Valider
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 dark:text-gray-400 hover:underline">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const backgroundPrimary = document.querySelector('#custom_background_primary');
            const backgroundPrimaryPrev = document.querySelector('#custom_background_primary_preview');

            const backgroundSecondary = document.querySelector('#custom_background_secondary');
            const backgroundSecondaryPrev = document.querySelector('#custom_background_secondary_preview');

            const fontPrimary = document.querySelector('#custom_font_primary');
            const fontPrimaryPrev = document.querySelector('#custom_font_primary_preview');

            const fontSecondary = document.querySelector('#custom_font_secondary');
            const fontSecondaryPrev = document.querySelector('#custom_font_secondary_preview');

            backgroundPrimary.addEventListener('input', (evt)=>{
                backgroundPrimaryPrev.style.backgroundColor = evt.target.value;
            });
            backgroundSecondary.addEventListener('input', (evt)=>{
                backgroundSecondaryPrev.style.backgroundColor = evt.target.value;
            });
            fontPrimary.addEventListener('input', (evt)=>{
                fontPrimaryPrev.style.backgroundColor = evt.target.value;
            });
            fontSecondary.addEventListener('input', (evt)=>{
                fontSecondaryPrev.style.backgroundColor = evt.target.value;
            });
        })
    </script>
</x-app-layout>