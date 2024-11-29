<x-app-layout>
    <div class="portal">
        <div class="portal-header">
            <div>
                <p>Portail</p>
                <h2>Seconde main</h2>
            </div>
            <img src="{{ asset('/storage/customisation/logoHbp.png') }}" width="120px" alt="">
        </div>
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
    </div>
    <style>
        main{
            .portal-header{
                display: flex;
                justify-content: space-between;
                align-items:center;
                img{
                    border-radius: 5px;
                }
            }
            h2{
                font-size: 35px;
                text-transform: uppercase;
                font-weight: bold;
            }
            display: flex,
            flex-direction: row;
            justify-content: center;
            align-content:center;
            height:100vh;
            .portal{
                position: relative;
                z-index:3;
                width:70%;
                justify-self: center;
                .login-box{
                    margin-top: 0;
                    padding-top:2em;
                }
            }
            input#login, input#password{
                color: black;
            }
        }
    </style>
</x-app-layout>