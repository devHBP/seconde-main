<x-app-layout>
    @php
        $user = Auth::user();
        $isCompactedMode = $user->compacted_mode
    @endphp
    <x-slot name="header">
        <div class="dashboard-header">
            <h2 class="title">Bonjour {{ $user->name }} <span> *connecté en tant que {{ $role }}</span></h2>
            <div>
                <p>Dashboard</p>
            </div>
            <div class="header-right-button">
                <div>
                    <a href="{{ route('reception.cart') }}">
                        <div class="cart-button flex">
                            <svg width="30px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 4C10.4508 4 9.0799 5.00309 8.61115 6.47966L7.81104 9H8.49995H15.5H16.1889L15.3888 6.47966C14.92 5.00309 13.5491 4 12 4ZM18.2872 9L17.295 5.8745C16.5626 3.56734 14.4206 2 12 2C9.57933 2 7.43733 3.56734 6.7049 5.8745L5.71268 9H3.34789C2.00585 9 1.04464 10.2956 1.43384 11.58L2.55808 15.29L3.94596 19.87C4.32928 21.135 5.49529 22 6.81704 22H9.99995H14H17.1829C18.5046 22 19.6706 21.135 20.0539 19.87L21.4418 15.29L22.5661 11.58C22.9553 10.2956 21.9941 9 20.652 9H18.2872ZM6.4444 11H3.34789L4.25698 14H8.03615L7.62706 11H6.4444ZM9.64557 11L10.0547 14H13.9452L14.3543 11H9.64557ZM16.3728 11L15.9638 14H19.7429L20.652 11H17.5555H16.3728ZM19.1369 16H15.691L15.1456 20H17.1829C17.6235 20 18.0121 19.7117 18.1399 19.29L19.1369 16ZM13.1271 20L13.6725 16H10.3274L10.8728 20H13.1271ZM8.85434 20L8.30888 16H4.86304L5.86001 19.29C5.98778 19.7117 6.37646 20 6.81704 20H8.85434Z" fill=""></path> </g></svg>
                            <p>{{ $itemsInCart }}</p>
                        </div>
                    </a>
                </div>
                <div>
                    <a href="{{ route('role.logout')}}">
                        <div class="logout-dashboard">
                            <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 3V12M18.3611 5.64001C19.6195 6.8988 20.4764 8.50246 20.8234 10.2482C21.1704 11.994 20.992 13.8034 20.3107 15.4478C19.6295 17.0921 18.4759 18.4976 16.9959 19.4864C15.5159 20.4752 13.776 21.0029 11.9961 21.0029C10.2162 21.0029 8.47625 20.4752 6.99627 19.4864C5.51629 18.4976 4.36274 17.0921 3.68146 15.4478C3.00019 13.8034 2.82179 11.994 3.16882 10.2482C3.51584 8.50246 4.37272 6.8988 5.6311 5.64001" stroke="" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </x-slot>
    <div>
        <div class="layout-container reception">
            <a href="{{ route('reception.add.product') }}">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                    width="70.000000pt" height="70.000000pt" viewBox="0 0 512.000000 512.000000"
                    preserveAspectRatio="xMidYMid meet">

                    <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                    fill="" stroke="none">
                    <path d="M1678 4596 c-312 -149 -576 -280 -588 -291 -20 -18 -20 -26 -20 -655
                    0 -493 3 -640 13 -653 6 -9 235 -124 507 -255 272 -132 533 -258 579 -281 46
                    -22 92 -41 102 -41 21 0 56 16 694 324 274 132 479 238 493 252 l22 25 0 633
                    c0 609 -1 634 -19 650 -17 15 -131 72 -576 286 -66 31 -224 107 -352 169 -132
                    63 -244 111 -260 110 -15 0 -283 -123 -595 -273z m807 30 l197 -95 -123 -59
                    c-68 -32 -287 -136 -487 -232 l-363 -173 -152 72 c-84 40 -173 83 -199 95 -26
                    11 -48 24 -48 27 0 8 941 457 961 458 9 1 106 -41 214 -93z m562 -268 c106
                    -51 189 -96 185 -100 -4 -4 -214 -107 -466 -228 -251 -121 -465 -224 -474
                    -229 -12 -6 -71 18 -217 89 l-200 97 215 104 c118 57 332 161 475 231 143 69
                    267 127 275 127 8 1 101 -40 207 -91z m-1735 -262 c51 -24 158 -75 238 -114
                    80 -38 258 -124 395 -191 l250 -120 3 -535 2 -535 -192 93 c-106 51 -329 157
                    -495 237 l-302 144 -1 533 c0 292 2 532 4 532 3 0 47 -20 98 -44z m2026 -488
                    l-3 -531 -493 -238 -492 -237 2 535 3 534 485 234 c267 129 488 234 493 235 4
                    0 6 -239 5 -532z"/>
                    <path d="M1487 3669 c-26 -15 -38 -54 -27 -85 8 -20 47 -43 195 -115 102 -49
                    193 -89 201 -89 47 0 81 51 64 96 -8 20 -47 43 -196 115 -102 49 -193 89 -202
                    89 -9 0 -25 -5 -35 -11z"/>
                    <path d="M1075 2453 c-48 -11 -182 -57 -202 -69 -30 -19 -31 -77 -3 -119 11
                    -16 20 -33 20 -36 0 -3 -39 10 -87 30 -84 34 -93 36 -208 36 -114 0 -123 -2
                    -187 -32 -44 -21 -88 -53 -131 -96 -84 -83 -100 -108 -91 -141 7 -29 -39 4
                    707 -510 l518 -356 943 -350 942 -350 372 0 372 0 0 -83 c0 -136 -22 -127 319
                    -127 266 0 289 1 304 18 22 25 21 75 -1 95 -16 15 -49 17 -250 17 l-232 0 0
                    715 0 715 350 0 c245 0 357 3 375 12 40 18 49 75 18 111 -15 16 -48 17 -430
                    17 -400 0 -414 -1 -433 -20 -18 -18 -20 -33 -20 -160 l0 -140 -87 1 -88 0
                    -254 225 -254 224 -688 0 c-782 0 -720 7 -732 -85 -14 -96 24 -229 93 -332
                    l22 -33 -64 0 -64 0 -164 253 c-90 138 -183 282 -207 319 -51 78 -139 162
                    -209 200 -85 46 -197 67 -269 51z m185 -165 c79 -38 138 -105 266 -300 67
                    -103 127 -196 133 -206 7 -13 -93 40 -257 135 l-269 156 -57 104 c-32 58 -54
                    109 -49 113 35 34 160 33 233 -2z m-553 -146 c32 -10 123 -57 203 -104 80 -47
                    326 -189 547 -317 l402 -231 627 0 c695 0 664 -3 664 64 -1 76 -2 76 -457 76
                    -364 0 -401 2 -438 19 -44 20 -114 90 -141 142 -15 30 -44 121 -44 142 0 4
                    278 7 618 7 l617 0 200 -176 c110 -97 226 -199 258 -225 l58 -49 110 0 109 0
                    0 -445 0 -445 -362 0 -363 1 -920 342 -920 342 -559 385 -559 384 44 38 c24
                    21 62 44 84 52 56 20 153 19 222 -2z"/>
                    </g>
                </svg>
                <div class="dashboard-cards">Reprise produit</div>
            </a>
            <a href="{{ route('reception.cart') }}">
                <div class="flex flex-col justify-center align-center">
                    @if ($cartInProgress)
                        <p class="self-center cart-in-progress">En cours</p>
                    @endif
                    <svg class="self-center" version="1.0" xmlns="http://www.w3.org/2000/svg"
                        width="60.000000pt" height="60.000000pt" viewBox="0 0 512.000000 512.000000"
                        preserveAspectRatio="xMidYMid meet">

                        <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                        fill="" stroke="none">
                        <path d="M1692 4943 c-18 -9 -44 -30 -57 -47 -12 -17 -156 -297 -319 -623
                        l-296 -592 -458 -3 -459 -3 -37 -29 c-67 -50 -67 -54 -64 -461 3 -349 4 -365
                        24 -391 46 -62 65 -69 202 -72 l127 -3 304 -1217 c170 -683 313 -1235 325
                        -1257 14 -27 35 -47 66 -62 l44 -23 1466 0 1466 0 44 23 c31 15 52 35 66 62
                        12 22 155 574 325 1257 l304 1217 127 3 c137 3 156 10 202 72 20 26 21 42 24
                        391 3 407 3 411 -64 461 l-37 29 -459 3 -458 3 -305 609 c-344 686 -330 665
                        -435 665 -47 0 -63 -5 -94 -29 -43 -32 -66 -78 -66 -130 0 -26 71 -178 270
                        -576 l270 -540 -1180 0 -1180 0 271 542 c260 521 271 545 267 590 -11 112
                        -128 180 -226 131z m3108 -1743 l0 -160 -2240 0 -2240 0 0 160 0 160 2240 0
                        2240 0 0 -160z m-370 -487 c0 -5 -124 -509 -277 -1120 l-278 -1113 -1315 0
                        -1315 0 -278 1113 c-153 611 -277 1115 -277 1120 0 4 841 7 1870 7 1029 0
                        1870 -3 1870 -7z"/>
                        <path d="M1695 2065 c-47 -25 -74 -56 -86 -94 -6 -24 -9 -216 -7 -553 3 -504
                        4 -517 24 -544 39 -53 71 -69 134 -69 63 0 95 16 134 69 21 27 21 40 24 551 3
                        582 4 570 -62 620 -46 35 -117 44 -161 20z"/>
                        <path d="M2495 2065 c-47 -25 -74 -56 -86 -94 -6 -24 -9 -216 -7 -553 3 -504
                        4 -517 24 -544 39 -53 71 -69 134 -69 63 0 95 16 134 69 21 27 21 40 24 551 3
                        582 4 570 -62 620 -46 35 -117 44 -161 20z"/>
                        <path d="M3295 2065 c-47 -25 -74 -56 -86 -94 -6 -24 -9 -216 -7 -553 3 -504
                        4 -517 24 -544 39 -53 71 -69 134 -69 63 0 95 16 134 69 21 27 21 40 24 551 3
                        582 4 570 -62 620 -46 35 -117 44 -161 20z"/>
                        </g>
                    </svg>
                </div>
                <div class="dashboard-cards">Panier</div>
            </a>
            <a href="{{ route('reception.clients')}}">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                    width="70.000000pt" height="70.000000pt" viewBox="0 0 512.000000 512.000000"
                    preserveAspectRatio="xMidYMid meet">
                    <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                    fill="" stroke="none">
                    <path d="M2360 4535 c-390 -87 -683 -382 -766 -770 -18 -83 -20 -268 -4 -355
                    17 -93 48 -186 91 -271 39 -79 135 -213 188 -263 l30 -29 -67 -32 c-80 -38
                    -189 -104 -251 -152 l-45 -34 -29 58 c-43 83 -145 181 -237 226 -134 66 -261
                    81 -394 47 -218 -56 -378 -224 -423 -445 -29 -143 5 -302 91 -428 l42 -61 -87
                    -58 c-106 -71 -216 -187 -283 -297 -125 -207 -173 -503 -102 -625 51 -87 124
                    -143 255 -196 208 -85 546 -119 881 -89 l125 11 135 -45 c269 -90 568 -136
                    950 -144 450 -10 829 37 1150 144 l135 44 148 -12 c544 -45 1003 82 1113 307
                    26 53 26 59 21 177 -15 333 -177 588 -492 772 -17 10 -15 15 16 56 68 89 109
                    218 109 344 0 259 -158 464 -415 541 -93 28 -250 25 -341 -8 -133 -47 -250
                    -146 -309 -263 l-27 -54 -51 37 c-77 56 -143 96 -227 138 -41 20 -77 38 -79
                    40 -2 2 26 35 61 73 302 320 342 825 93 1195 -131 197 -339 348 -560 407 -105
                    28 -348 36 -445 14z m365 -170 c325 -67 588 -341 646 -671 19 -111 7 -272 -30
                    -384 -190 -586 -933 -763 -1365 -325 -272 276 -314 708 -101 1030 51 77 153
                    179 230 230 79 52 193 100 280 119 93 19 248 20 340 1z m-1580 -1572 c117 -41
                    225 -149 259 -260 6 -19 -6 -38 -69 -106 -101 -110 -185 -229 -243 -345 l-47
                    -94 -61 5 c-267 24 -442 279 -364 530 68 219 311 345 525 270z m3090 0 c102
                    -35 197 -122 243 -221 34 -74 42 -202 18 -284 -46 -160 -192 -279 -360 -295
                    l-61 -5 -38 78 c-54 111 -151 253 -248 363 l-82 94 32 63 c95 182 309 272 496
                    207z m-2114 -108 c280 -131 583 -133 859 -4 l85 40 45 -17 c154 -58 340 -177
                    472 -302 273 -260 433 -589 468 -964 14 -147 5 -212 -40 -279 -40 -61 -48 -69
                    -110 -120 -155 -125 -446 -220 -845 -275 -160 -22 -664 -31 -846 -15 -593 52
                    -1005 206 -1124 422 -30 53 -30 56 -29 199 1 231 49 414 165 640 158 305 426
                    551 749 686 30 13 60 23 66 24 7 0 45 -16 85 -35z m-1213 -838 c37 -6 68 -12
                    70 -13 1 -1 -9 -45 -23 -99 -14 -53 -32 -149 -40 -212 -36 -277 -5 -403 137
                    -545 l66 -67 -44 -7 c-49 -7 -212 1 -339 17 -212 27 -423 106 -470 178 -35 53
                    -39 92 -21 198 45 259 194 463 422 578 l66 33 54 -25 c30 -14 85 -30 122 -36z
                    m3564 22 c117 -58 247 -186 316 -309 67 -121 116 -334 93 -410 -29 -98 -217
                    -187 -473 -224 -131 -19 -344 -30 -381 -19 l-29 9 50 42 c108 91 172 229 172
                    373 0 106 -25 284 -55 397 -14 51 -25 97 -25 101 0 5 28 14 62 21 34 6 89 22
                    123 35 64 24 69 23 147 -16z"/>
                    </g>
                </svg>
                <div class="dashboard-cards">Clients</div>
            </a>
            <a href="{{ route('reception.carts.to-return')}}" class="flex flex-col cart-returned">
                <div class="cart-returned">
                    <span>{{ $panierCount }}</span>
                    <svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="80px" height="80px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve" fill="">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier"> 
                            <polygon fill="none" stroke="" stroke-width="2" stroke-miterlimit="10" points="1,25 12,59 52,59 63,25 "></polygon>
                            <line fill="none" stroke="" stroke-width="2" stroke-miterlimit="10" x1="14" y1="25" x2="22" y2="5"></line> 
                            <line fill="none" stroke="" stroke-width="2" stroke-miterlimit="10" x1="50" y1="25" x2="42" y2="5"></line> 
                            <line fill="none" stroke="darkred" stroke-width="2" stroke-miterlimit="10" x1="39" y1="50" x2="25" y2="36"></line> 
                            <line fill="none" stroke="darkred" stroke-width="2" stroke-miterlimit="10" x1="25" y1="50" x2="39" y2="36"></line> 
                        </g>
                    </svg>
                </div>
                <div class="dashboard-cards">Paniers à rendre</div>
            </a>
        </div>
        @if($isCompactedMode)
            <div class="layout-merged-caisse">
                <h3>Interface de Caisse</h3>
                @include('components.partial-encaissement')
            </div>
        @endif
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const printTicketUuid = "{{ session('print_ticket_uuid') }}";
            if(printTicketUuid){
                const printUrl = "{{ route('reception.ticket.print', ':uuid')}}"
                    .replace(':uuid', printTicketUuid)
                window.open(printUrl, "_blank");
            } 
        });
        @if($isCompactedMode)
            document.addEventListener('DOMContentLoaded', () => {
                const printTicketUuid = "{{ session('print_ticket_uuid_encaissement') }}";
                const restituteTicketUuid = "{{ session('print_ticket_return')}}";
                const printSupplierDelivery = "{{ session('print_supplier_delivery') }}";
                if(printTicketUuid){
                    const printUrl = "{{ route('encaissement.ticket.print', ':uuid') }}".replace(':uuid', printTicketUuid);
                    window.open(printUrl, "_blank");
                }
                if(printSupplierDelivery){
                    const printDeliveryUrl = "{{ route('encaissement.ticket.supplier.print', ':uuid') }}".replace(':uuid', printSupplierDelivery);
                    window.open(printDeliveryUrl, "_blank");
                }
                if(restituteTicketUuid){
                    const printRestituteUrl = "{{ route('encaissement.ticket.restitute.print', ':uuid') }}".replace(':uuid', restituteTicketUuid);
                    window.open(printRestituteUrl, "_blank");
                }
            });
        @endif
    </script>
</x-app-layout>