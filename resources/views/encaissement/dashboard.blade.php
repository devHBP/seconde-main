<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <h2 class="title">Bonjour {{ $user->name }} <span>*Connecté en rôle Encaissement</span></h2>
            </div>
            <div>
                <h3>Tickets en Cours</h3>
            </div>
            <div class="header-right-button">
                <div class="logout-dashboard">
                    <a href="{{ route('role.logout')}}">
                        <div>
                            <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 3V12M18.3611 5.64001C19.6195 6.8988 20.4764 8.50246 20.8234 10.2482C21.1704 11.994 20.992 13.8034 20.3107 15.4478C19.6295 17.0921 18.4759 18.4976 16.9959 19.4864C15.5159 20.4752 13.776 21.0029 11.9961 21.0029C10.2162 21.0029 8.47625 20.4752 6.99627 19.4864C5.51629 18.4976 4.36274 17.0921 3.68146 15.4478C3.00019 13.8034 2.82179 11.994 3.16882 10.2482C3.51584 8.50246 4.37272 6.8988 5.6311 5.64001" stroke="" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 layout-search">
            <!-- Formulaire de recherche client -->
            <form method="GET" action="{{ route('encaissement.ticket.search') }}" class="mb-6">
                <div class="flex items-center gap-4">
                    <input type="text" name="query" placeholder="Scanner le code barre / Entrer le numéro de ticket de reprise"
                        @if(isset($query))
                            value="{{ $query }}"
                        @endif
                        class="w-full py-2 px-4 rounded focus:outline-none">
                    <button type="submit" class="text-white px-4 py-2 rounded">
                        Rechercher
                    </button>
                </div>
            </form>
        </div>
        <div class="max-w-7xl mx-auto layout-liste">
            <ul>
                @if(count($tickets)>0)
                    @foreach ($tickets as $ticket)
                    <a href="{{ route('encaissement.ticket.show', ['ticket_uuid' => $ticket->uuid] ) }}">
                        <li class="flex justify-between p-4 bg-white cursor-pointer border border-gray-300 hover:bg-slate-100">
                            <span>{{ $ticket->uuid }}</span>
                            <span>{{ $ticket->client->firstname }} {{ $ticket->client->lastname }}</span>
                        </li>
                    </a>
                    @endforeach
                @else
                    <li>Ticket non trouvé</li>
                @endif
            </ul>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const printTicketUuid = "{{ session('print_ticket_uuid') }}";
            const restituteTicketUuid = "{{ session('print_ticket_return')}}"
            if(printTicketUuid){
                const printUrl = "{{ route('encaissement.ticket.print', ':uuid') }}".replace(':uuid', printTicketUuid);
                window.open(printUrl, "_blank");
            }
            if(restituteTicketUuid){
                const printRestituteUrl = "{{ route('encaissement.ticket.restitute.print', ':uuid') }}".replace(':uuid', restituteTicketUuid);
                window.open(printRestituteUrl, "_blank");
            }
        });
    </script>
</x-app-layout>