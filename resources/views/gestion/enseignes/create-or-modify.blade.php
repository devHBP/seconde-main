<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="title-reminder"></p>
                <h2 class="title">{{ isset($enseigne) ? 'Modifier une enseigne' : 'Créer une nouvelle enseigne' }}</h2>
            </div>
            <div class="header-right-button">
                <a href="{{ route('dashboard') }}" class="">
                    Retour au dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden p-6 create-or-modify">
                <form action="{{ isset($enseigne) ? route('gestion.modify.enseigne', ['enseigne_slug' => $enseigne->slug]) : route('gestion.store.enseigne') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($enseigne))
                        @method('PUT')
                    @endif
                    <!-- Login de l'enseigne -->
                    <div class="mb-3">
                        <label for="login" class="block">Login de l'enseigne</label>
                        <input type="text" name="login" id="login" value="{{ old('login', $enseigne->login ?? '')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-black" required>
                        @error('login')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Nom de l'enseigne -->
                    <div class="mb-3">
                        <label for="name" class="block">Nom de l'enseigne de l'enseigne</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $enseigne->name ?? '')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-black" required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password de l'enseigne -->
                    <div class="mb-3">
                        <label for="password" class="block">Mot de passe de l'enseigne</label>
                        <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-black" {{ isset($enseigne) ? '' : 'required'}}>
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password de l'enseigne -->
                    <div class="mb-3">
                        <label for="confirm_password" class="block">Confirmation du mot de passe de l'enseigne</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="shadow appearance-none border rounded w-full py-2 px-3 text-black" {{ isset($enseigne) ? '' : 'required'}}>
                        @error('confirm_password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Couleur Primaire -->
                    <div class="mb-3 flex gap-6 items-center">
                        <label for="custom_background_primary" class="block font-bold">Couleur primaire</label>
                        <input type="color" name="custom_background_primary" id="custom_background_primary" value="{{ old('custom_background_primary', $account->custom_background_primary ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                        <div id="custom_background_primary_preview" class="w-8 h-8 border rounded text-black" style="background-color: {{ old('custom_background_primary', $account->custom_background_primary ?? '') }}"></div>
                        @error('custom_background_primary')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Couleur Secondaire -->
                    <div class="mb-3 flex gap-6 items-center">
                        <label for="custom_background_secondary" class="block font-bold">Couleur secondaire</label>
                        <input type="color" name="custom_background_secondary" id="custom_background_secondary" value="{{ old('custom_background_secondary', $account->custom_background_secondary ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                        <div id="custom_background_secondary_preview" class="w-8 h-8 border rounded text-black" style="background-color: {{ old('custom_background_secondary', $account->custom_background_secondary ?? '') }}"></div>
                        @error('custom_background_secondary')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Couleur de police Primaire -->
                    <div class="mb-3 flex gap-6 items-center">
                        <label for="custom_font_primary" class="block font-bold">Couleur de police primaire</label>
                        <input type="color" name="custom_font_primary" id="custom_font_primary" value="{{ old('custom_font_primary', $account->custom_font_primary ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                        <div id="custom_font_primary_preview" class="w-8 h-8 border rounded text-black" style="background-color: {{ old('custom_font_primary', $account->custom_font_primary ?? '') }}"></div>
                        @error('custom_font_primary')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Couleur de police Primaire -->
                    <div class="mb-3 flex gap-6 items-center">
                        <label for="custom_font_secondary" class="block font-bold">Couleur de police secondaire</label>
                        <input type="color" name="custom_font_secondary" id="custom_font_secondary" value="{{ old('custom_font_secondary', $account->custom_font_secondary ?? '')}}" class="shadow appearance-none border rounded py-2 px-3">
                        <div id="custom_font_secondary_preview" class="w-8 h-8 border rounded text-black" style="background-color: {{ old('custom_font_secondary', $account->custom_font_secondary ?? '') }}"></div>
                        @error('custom_font_secondary')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="pattern_logo" class="block">Pattern ( motif d'arrière plan )</label>
                        <!-- Option d'import d'une nouvelle image -->
                        <div class="mt-4">
                            <label for="pattern_logo" class="block">Importez une nouvelle image :</label>
                            <input type="file" name="pattern_logo" id="pattern_logo" accept=".png,.svg" class="block w-full mt-2">
                        </div>
                        @if(isset($enseigne) && $enseigne->pattern_logo)
                            <div class="mt-4 mb-4">
                                Image actuelle
                                <img src="{{ asset('storage/' . $enseigne->picture->path) }}"  width="120px" alt="">
                            </div>
                        @endif 
                    </div>
                    @error('pattern_logo')
                        <p>{{ $message }}</p>
                    @enderror

                    @if (!isset($enseigne))
                        <div class="border-2 p-2 mb-6 mt-6">
                            <h3>Création de l'utilisateur Admin</h3>
                            <div class="mb-4">
                                <label for="user_name" class="block">Nom utilisateur Admin</label>
                                <input type="text" name="user_name" id="user_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-black">
                            </div>
                            <div class="mb-4">
                                <label for="user_email" class="block">Email utilisateur Admin</label>
                                <input type="text" name="user_email" id="user_email" class="shadow appearance-none border rounded w-full py-2 px-3 text-black">
                            </div>
                            <div class="mb-4">
                                <label for="user_password" class="block">Password utilisateur Admin</label>
                                <input type="password" name="user_password" id="user_password" class="shadow appearance-none border rounded w-full py-2 px-3 text-black">
                            </div>
                            <div class="mb-4">
                                <label for="user_confirm_password" class="block">Confirm password utilisateur Admin</label>
                                <input type="password" name="user_confirm_password" id="user_confirm_password" class="shadow appearance-none border rounded w-full py-2 px-3 text-black">
                            </div>
                        </div>
                    @endif

                    <!-- Bouton de soumission -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="py-2 px-4 rounded">
                            {{ isset($enseigne) ? "Modifier" : "Créer"}}
                        </button>
                        <a href="{{ route('dashboard') }}" class="cancel">Annuler</a>
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