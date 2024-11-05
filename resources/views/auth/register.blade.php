<x-guest-layout>
    <div class="login-box">
        <form method="POST" action="{{ route('auth.register') }}">
            @csrf
            <div>
                <x-input-label for="login" :value="__('Login')"/>
                <x-text-input id="login" type="text" :value="old('login')" name="login" required autofocus autocomplete="login" />
                <x-input-error :messages="$errors->get('login')" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" />
            </div>
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirmer Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')"/>
            </div>
            <x-primary-button>
                {{ __('Enregistrer') }}
            </x-primary-button>
        </form>
    </div>
</x-guest-layout>