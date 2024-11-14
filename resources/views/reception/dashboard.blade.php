<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header h-4">
            <h2 class="title">Bonjour {{ $user->name }} <span> *connecté en tant que {{ $role }}</span></h2>
            <div class="header-right-button">
                <div class="cart">
                    <a href="{{ route('reception.cart') }}">
                        <div>
                            <svg width="30px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 4C10.4508 4 9.0799 5.00309 8.61115 6.47966L7.81104 9H8.49995H15.5H16.1889L15.3888 6.47966C14.92 5.00309 13.5491 4 12 4ZM18.2872 9L17.295 5.8745C16.5626 3.56734 14.4206 2 12 2C9.57933 2 7.43733 3.56734 6.7049 5.8745L5.71268 9H3.34789C2.00585 9 1.04464 10.2956 1.43384 11.58L2.55808 15.29L3.94596 19.87C4.32928 21.135 5.49529 22 6.81704 22H9.99995H14H17.1829C18.5046 22 19.6706 21.135 20.0539 19.87L21.4418 15.29L22.5661 11.58C22.9553 10.2956 21.9941 9 20.652 9H18.2872ZM6.4444 11H3.34789L4.25698 14H8.03615L7.62706 11H6.4444ZM9.64557 11L10.0547 14H13.9452L14.3543 11H9.64557ZM16.3728 11L15.9638 14H19.7429L20.652 11H17.5555H16.3728ZM19.1369 16H15.691L15.1456 20H17.1829C17.6235 20 18.0121 19.7117 18.1399 19.29L19.1369 16ZM13.1271 20L13.6725 16H10.3274L10.8728 20H13.1271ZM8.85434 20L8.30888 16H4.86304L5.86001 19.29C5.98778 19.7117 6.37646 20 6.81704 20H8.85434Z" fill="#000000"></path> </g></svg>
                        </div>
                    </a>
                </div>
                <div class="logout-dashboard">
                    <a href="{{ route('role.logout')}}">
                        <div>
                            <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 3V12M18.3611 5.64001C19.6195 6.8988 20.4764 8.50246 20.8234 10.2482C21.1704 11.994 20.992 13.8034 20.3107 15.4478C19.6295 17.0921 18.4759 18.4976 16.9959 19.4864C15.5159 20.4752 13.776 21.0029 11.9961 21.0029C10.2162 21.0029 8.47625 20.4752 6.99627 19.4864C5.51629 18.4976 4.36274 17.0921 3.68146 15.4478C3.00019 13.8034 2.82179 11.994 3.16882 10.2482C3.51584 8.50246 4.37272 6.8988 5.6311 5.64001" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </x-slot>
    <div>
        @if (session('success'))
            <div class="bg-lime-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="layout-container reception">
            <a href="{{ route('reception.add.product') }}">
                <div class="dashboard-cards">Reprise produit</div>
            </a>
            <a href="{{ route('reception.cart') }}">
                <div class="dashboard-cards">Panier</div>
            </a>
            <a href="{{ route('reception.clients')}}">
                <div class="dashboard-cards">Clients</div>
            </a>
        </div>
    </div>
</x-app-layout>