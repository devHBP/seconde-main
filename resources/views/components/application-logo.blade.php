<div class="header__store-logo">
    <p class="header__store-logo__app">Seconde Main</p>
    <div class="flex align-center gap-1 header__store-custom-container">
        <p class="p-1 rounded-full header__store-logo__by">by</p>
        @if (Auth::user())
            <p class="self-center header__store-logo__store-name">{{ Auth::user()->name}}</p>
        @elseif (isset($accountName))
            <p class="self-center header__store-logo__store-name">{{ $accountName }}</p>
        @endif
    </div>
</div>
