<x-guest-layout>
    <div class="login-box">
        <form method="POST" action=" {{ route('auth.login.post') }}">
            @csrf
            <!-- Login field -->
            <div>
                <x-input-label for="login" :value="__('Login')" />
                <x-text-input id="login" type="text" name="login" :value="old('login')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('login')" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Mot de passe')" />
                <x-text-input id="password" type="password" name="password" :value="old('password')" required autocomplete="current-password "/>
                <x-input-error :messages="$errors->get('password')" />
            </div>

            <!-- Remember Me block -->
            <div>
                <label for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember_me">
                    <span>{{ __('Se Souvenir de moi?') }}</span>   
                </label>    
            </div> 

            <!-- Forgot password -->
            <div>
                @if (Route::has('password.request'))
                    <a href="#">
                        {{ __("J'ai oublié mon mot de passe") }}
                    </a>
                @endif
            </div>

            <!-- Login -->
            <x-primary-button>
                {{ __('Connexion') }}
            </x-primary-button>
        </form>
    <div>
</x-guest-layout>