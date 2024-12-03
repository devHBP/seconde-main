<x-app-layout>
    @php
        $isAdmin = Auth::user()->login === SUPER_ADMIN_LOGIN;
    @endphp
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <h2>
                    @if($isAdmin)
                        Vue des Enseignes
                    @else
                        Se connecter avec quel poste ?
                    @endif
                </h2>
            </div>
            @if ($isAdmin)
                <div class="header-right-button">
                    <a href="{{route('gestion.create.enseigne')}}">Créer une nouvelle enseigne</a>
                </div>
            @endif
        </div>
    </x-slot>
    @if($isAdmin)
        <div class="stores-cards">
            @foreach ($accounts as $accountToManage)
                @if($accountToManage->id !== $account->id)
                    <div class="store-card ">
                        <div>
                            <a href="{{ route('gestion.get.enseigne', $accountToManage->slug) }}">
                                <p class="store-name">{{ $accountToManage->name }}</p>
                                <p>({{ $accountToManage->login }})</p>
                            </a>
                        </div>
                        <div class="store-card-buttons">
                            <a href="{{route('gestion.modify.enseigne', $accountToManage->slug)}}">
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.4998 5.49994L18.3282 8.32837M3 20.9997L3.04745 20.6675C3.21536 19.4922 3.29932 18.9045 3.49029 18.3558C3.65975 17.8689 3.89124 17.4059 4.17906 16.9783C4.50341 16.4963 4.92319 16.0765 5.76274 15.237L17.4107 3.58896C18.1918 2.80791 19.4581 2.80791 20.2392 3.58896C21.0202 4.37001 21.0202 5.63634 20.2392 6.41739L8.37744 18.2791C7.61579 19.0408 7.23497 19.4216 6.8012 19.7244C6.41618 19.9932 6.00093 20.2159 5.56398 20.3879C5.07171 20.5817 4.54375 20.6882 3.48793 20.9012L3 20.9997Z" stroke="blue" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            </a>
                            <form action="{{ route('gestion.delete.enseigne', [ "enseigne_slug" => $accountToManage->slug ] )}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <svg width="30px" height="30px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#df2a2a"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.96967 16.4697C6.67678 16.7626 6.67678 17.2374 6.96967 17.5303C7.26256 17.8232 7.73744 17.8232 8.03033 17.5303L6.96967 16.4697ZM13.0303 12.5303C13.3232 12.2374 13.3232 11.7626 13.0303 11.4697C12.7374 11.1768 12.2626 11.1768 11.9697 11.4697L13.0303 12.5303ZM11.9697 11.4697C11.6768 11.7626 11.6768 12.2374 11.9697 12.5303C12.2626 12.8232 12.7374 12.8232 13.0303 12.5303L11.9697 11.4697ZM18.0303 7.53033C18.3232 7.23744 18.3232 6.76256 18.0303 6.46967C17.7374 6.17678 17.2626 6.17678 16.9697 6.46967L18.0303 7.53033ZM13.0303 11.4697C12.7374 11.1768 12.2626 11.1768 11.9697 11.4697C11.6768 11.7626 11.6768 12.2374 11.9697 12.5303L13.0303 11.4697ZM16.9697 17.5303C17.2626 17.8232 17.7374 17.8232 18.0303 17.5303C18.3232 17.2374 18.3232 16.7626 18.0303 16.4697L16.9697 17.5303ZM11.9697 12.5303C12.2626 12.8232 12.7374 12.8232 13.0303 12.5303C13.3232 12.2374 13.3232 11.7626 13.0303 11.4697L11.9697 12.5303ZM8.03033 6.46967C7.73744 6.17678 7.26256 6.17678 6.96967 6.46967C6.67678 6.76256 6.67678 7.23744 6.96967 7.53033L8.03033 6.46967ZM8.03033 17.5303L13.0303 12.5303L11.9697 11.4697L6.96967 16.4697L8.03033 17.5303ZM13.0303 12.5303L18.0303 7.53033L16.9697 6.46967L11.9697 11.4697L13.0303 12.5303ZM11.9697 12.5303L16.9697 17.5303L18.0303 16.4697L13.0303 11.4697L11.9697 12.5303ZM13.0303 11.4697L8.03033 6.46967L6.96967 7.53033L11.9697 12.5303L13.0303 11.4697Z" fill="#ce1c1c"></path> </g></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        
    
    @else
        <div class="py-12 flex flex-col space-y-6">
            <form action={{ route('role.sublogin')}} method="POST">
                @csrf
                <input type="hidden" name="role_name" value="encaissement">
                <div class="card-container">
                    <button type="submit" class="role-card flex justify-center">
                        <x-role-card />
                    </button>
                </div>
            </form>
            <form action={{ route('role.sublogin')}} method="POST">
                @csrf
                <input type="hidden" name="role_name" value="reception">
                <div class="card-container">
                    <button type="submit" class="role-card flex justify-center">
                        <x-role-card-reception />
                    </button>
                </div>
            </form>
            <form action={{ route('role.sublogin')}} method="POST">
                @csrf
                <div class="card-container">
                    <input type="hidden" name="role_name" value="administrateur">
                    <button type="submit" class="role-card flex justify-center">
                        <x-role-card-admin />
                    </button>
                </div>
            </form>
        </div>
    @endif
</x-app-layout>
