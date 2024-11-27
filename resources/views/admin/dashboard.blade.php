<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <h2 class="title">Bonjour {{ $user->name }} <span> *connecté en tant que {{ $role }}</span></h2>
            </div>
            <div class="logout-dashboard">
                <a href="{{ route('role.logout')}}">
                    <div class="logout-dashboard">
                        <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 3V12M18.3611 5.64001C19.6195 6.8988 20.4764 8.50246 20.8234 10.2482C21.1704 11.994 20.992 13.8034 20.3107 15.4478C19.6295 17.0921 18.4759 18.4976 16.9959 19.4864C15.5159 20.4752 13.776 21.0029 11.9961 21.0029C10.2162 21.0029 8.47625 20.4752 6.99627 19.4864C5.51629 18.4976 4.36274 17.0921 3.68146 15.4478C3.00019 13.8034 2.82179 11.994 3.16882 10.2482C3.51584 8.50246 4.37272 6.8988 5.6311 5.64001" stroke="" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </div>
                </a>
            </div>
        </div>
    </x-slot>
    <div class="layout-container">
        <a href="{{ route('admin.users') }}">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                width="70.000000pt" height="65.000000pt" viewBox="0 0 512.000000 512.000000"
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
            <div class="dashboard-cards">Utilisateurs</div>
        </a>
        <a href="{{ route('admin.brands') }}">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
            width="70.000000pt" height="65.000000pt" viewBox="0 0 512.000000 512.000000"
            preserveAspectRatio="xMidYMid meet">
                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                fill="" stroke="none">
                <path d="M2752 4973 c-11 -10 -111 -171 -223 -358 -380 -639 -605 -989 -735
                -1145 -106 -127 -344 -377 -605 -636 -232 -229 -236 -232 -530 -442 -321 -229
                -381 -283 -442 -400 -202 -383 18 -843 443 -928 147 -29 289 -8 425 65 l71 38
                319 -446 c176 -245 338 -465 360 -489 21 -24 62 -56 90 -70 43 -23 62 -27 140
                -27 75 0 98 4 139 24 142 70 212 231 167 385 -11 36 -101 170 -349 514 -184
                256 -336 471 -339 478 -7 18 35 43 257 154 412 206 780 372 950 429 166 56
                671 176 1345 321 249 53 282 63 303 85 12 15 22 38 22 53 -1 19 -90 151 -310
                455 l-309 429 47 48 c195 198 136 524 -115 643 -62 29 -76 32 -168 32 -92 0
                -105 -3 -169 -33 -38 -18 -70 -31 -71 -30 -1 2 -134 188 -295 413 -161 226
                -302 420 -313 433 -25 27 -76 29 -105 5z m823 -1274 c418 -584 761 -1064 763
                -1069 1 -4 -17 -10 -40 -14 -66 -11 -781 -169 -988 -219 -513 -125 -649 -177
                -1324 -506 -148 -72 -270 -130 -271 -129 -27 35 -565 791 -565 795 0 3 109
                117 243 252 316 321 489 510 593 647 129 171 369 549 679 1072 76 127 141 232
                144 231 3 0 348 -477 766 -1060z m250 297 c48 -28 87 -73 105 -121 16 -41 14
                -136 -3 -177 -15 -36 -64 -98 -77 -98 -5 0 -70 86 -146 191 -90 126 -133 194
                -126 201 44 44 174 46 247 4z m-2570 -1868 c127 -177 251 -352 277 -389 l48
                -67 -273 -195 c-149 -107 -291 -204 -314 -216 -287 -144 -636 38 -686 359 -22
                142 31 305 130 402 42 41 569 428 583 427 3 0 109 -144 235 -321z m627 -1148
                c167 -234 312 -436 321 -450 63 -98 -14 -240 -130 -240 -91 0 -88 -3 -444 494
                -182 253 -333 466 -336 472 -2 6 53 52 123 103 l126 91 18 -23 c9 -12 154
                -213 322 -447z"/>
                <path d="M4027 4937 c-20 -19 -29 -58 -65 -277 -23 -140 -42 -263 -42 -273 0
                -29 45 -67 80 -67 64 0 72 19 118 300 23 140 42 263 42 273 0 10 -11 29 -25
                42 -31 32 -78 33 -108 2z"/>
                <path d="M4519 4470 c-184 -138 -340 -258 -346 -267 -35 -45 7 -123 65 -123
                22 0 107 59 363 250 184 138 340 258 347 267 34 45 -8 123 -66 123 -22 0 -107
                -59 -363 -250z"/>
                <path d="M4269 3891 c-16 -16 -29 -36 -29 -45 0 -30 24 -65 54 -80 130 -62
                575 -246 594 -246 57 0 92 84 55 128 -19 22 -594 272 -626 272 -10 0 -32 -13
                -48 -29z"/>
                </g>
            </svg>
            <div class="dashboard-cards">Marques</div>
        </a>
        <a href="{{ route('admin.types') }}">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                width="70.000000pt" height="65.000000pt" viewBox="0 0 512.000000 512.000000"
                preserveAspectRatio="xMidYMid meet">

                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                fill="" stroke="none">
                <path d="M1510 5103 c-14 -10 -197 -161 -407 -336 -334 -278 -383 -322 -389
                -352 -3 -19 -1 -43 7 -56 23 -44 421 -604 450 -633 40 -42 76 -38 197 23 l102
                51 0 -733 c0 -814 -4 -767 68 -787 40 -11 618 -14 670 -4 65 13 96 72 69 129
                -24 50 -56 55 -359 55 l-268 0 0 1240 0 1240 170 0 169 0 11 -42 c53 -206 197
                -359 395 -419 141 -43 325 -23 450 50 138 80 234 209 275 369 l11 42 169 0
                170 0 2 -711 3 -711 28 -24 c38 -33 86 -32 121 2 26 26 26 29 26 165 l0 139
                102 -51 c120 -60 157 -65 198 -22 29 29 426 589 449 632 8 13 10 37 7 56 -6
                30 -55 74 -389 352 -210 175 -393 326 -407 336 -23 16 -97 17 -1050 17 -953 0
                -1027 -1 -1050 -17z m1430 -180 c0 -33 -56 -127 -105 -175 -119 -117 -296
                -146 -450 -73 -66 32 -143 109 -177 177 -48 96 -80 88 352 88 346 0 380 -1
                380 -17z m-1470 -506 l0 -412 -105 -52 -104 -52 -167 236 c-120 170 -164 240
                -158 250 11 17 516 441 527 442 4 1 7 -185 7 -412z m2455 192 c146 -121 265
                -225 265 -230 0 -6 -74 -115 -165 -244 l-166 -234 -104 52 -105 52 0 412 c0
                227 2 413 5 413 3 0 125 -99 270 -221z"/>
                <path d="M2429 3331 l-29 -30 2 -1625 3 -1625 23 -23 23 -23 374 -3 c424 -3
                426 -3 444 66 6 20 36 515 68 1099 32 584 59 1060 61 1058 2 -2 30 -482 63
                -1067 32 -584 61 -1075 65 -1090 3 -15 17 -37 31 -48 25 -19 40 -20 395 -20
                416 0 419 0 437 68 7 25 11 554 11 1620 0 1697 2 1634 -48 1661 -15 8 -305 11
                -957 11 l-937 0 -29 -29z m441 -251 l0 -100 -145 0 -145 0 0 100 0 100 145 0
                145 0 0 -100z m880 0 l0 -100 -350 0 -350 0 0 100 0 100 350 0 350 0 0 -100z
                m470 0 l0 -100 -145 0 -145 0 0 100 0 100 145 0 145 0 0 -100z m-5 -1590 l0
                -1305 -257 -3 -258 -2 -4 22 c-3 13 -30 489 -60 1058 -31 569 -59 1063 -62
                1097 -5 46 -12 69 -30 88 -22 24 -28 25 -143 25 -110 0 -122 -2 -146 -23 -20
                -16 -28 -35 -31 -67 -3 -25 -29 -493 -59 -1040 -30 -547 -57 -1032 -61 -1078
                l-6 -82 -259 0 -259 0 0 1310 0 1310 818 -2 817 -3 0 -1305z"/>
                </g>
            </svg>
            <div class="dashboard-cards">Types</div>
        </a>
        <a href="{{ route('admin.states') }}">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                width="70.000000pt" height="65.000000pt" viewBox="0 0 512.000000 512.000000"
                preserveAspectRatio="xMidYMid meet">

                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                fill="" stroke="none">
                <path d="M3647 5104 c-217 -33 -428 -132 -601 -282 l-68 -59 -82 34 c-259 110
                -606 165 -900 143 -494 -37 -934 -232 -1280 -569 -321 -313 -519 -686 -597
                -1126 -30 -169 -33 -502 -6 -660 161 -930 875 -1608 1807 -1715 131 -16 422
                -8 545 14 298 54 571 163 806 321 l113 76 90 -90 c84 -84 89 -91 74 -108 -28
                -31 -39 -91 -26 -142 10 -42 42 -78 402 -439 215 -216 414 -408 441 -426 84
                -55 138 -71 245 -71 88 0 100 2 171 36 233 112 319 388 187 606 -20 33 -182
                202 -432 452 -352 350 -406 401 -443 411 -49 12 -115 0 -146 -28 -17 -15 -24
                -10 -108 75 l-91 90 65 94 c174 252 303 585 337 874 21 177 11 161 121 204
                275 108 495 311 632 581 108 215 149 507 103 743 -123 638 -721 1061 -1359
                961z m349 -169 c269 -47 492 -181 654 -397 335 -444 244 -1090 -199 -1423
                -420 -317 -995 -271 -1356 106 -129 136 -212 285 -258 469 -32 129 -30 359 5
                490 138 515 640 843 1154 755z m-1685 -165 c57 -6 155 -22 218 -36 113 -25
                308 -88 325 -104 6 -6 -40 -94 -78 -147 -1 -1 -40 12 -86 28 -428 153 -915
                122 -1325 -83 -180 -91 -317 -191 -461 -340 -140 -144 -216 -251 -303 -425
                -422 -844 -74 -1873 774 -2288 224 -109 431 -162 680 -172 298 -12 545 39 810
                167 503 243 852 708 941 1253 l17 105 45 6 c25 3 62 6 83 6 46 0 47 -2 24
                -136 -69 -400 -246 -747 -524 -1024 -450 -449 -1084 -638 -1712 -510 -392 80
                -761 297 -1026 605 -542 628 -612 1519 -175 2223 143 229 361 448 587 589 360
                225 777 324 1186 283z m-43 -340 c124 -13 228 -35 340 -72 101 -34 102 -34 77
                -109 -25 -76 -45 -217 -45 -323 0 -235 67 -461 196 -656 58 -90 194 -233 284
                -301 122 -92 318 -180 469 -210 71 -14 69 -6 42 -147 -27 -137 -71 -267 -137
                -397 -376 -752 -1297 -1059 -2049 -684 -290 145 -545 399 -690 689 -246 492
                -208 1082 101 1541 311 462 867 726 1412 669z m1457 -3000 l80 -80 -63 -62
                -62 -63 -82 82 -83 83 60 60 c33 33 62 60 65 60 3 0 41 -36 85 -80z m382 -142
                c29 -29 53 -57 53 -63 0 -13 -342 -355 -355 -355 -6 0 -35 25 -65 55 l-55 55
                180 180 c99 99 182 180 185 180 2 0 28 -23 57 -52z m245 -245 l58 -58 -177
                -177 c-98 -98 -182 -178 -188 -178 -6 0 -35 25 -65 55 l-55 55 180 180 c99 99
                182 180 185 180 2 0 30 -26 62 -57z m321 -321 c154 -155 179 -196 178 -291 0
                -32 -7 -77 -17 -100 -22 -55 -100 -125 -158 -141 -57 -16 -139 -9 -191 15 -22
                11 -103 81 -180 157 l-140 137 180 181 c99 99 182 180 185 180 3 0 67 -62 143
                -138z"/>
                <path d="M3988 3943 l-408 -408 -143 142 c-78 77 -152 146 -164 152 -36 18
                -63 13 -94 -18 -55 -56 -50 -64 169 -283 180 -181 201 -198 232 -198 32 0 65
                31 482 448 433 432 448 448 448 485 0 49 -35 87 -82 87 -29 0 -70 -37 -440
                -407z"/>
                <path d="M1983 4260 c-213 -23 -434 -102 -608 -220 -84 -57 -96 -70 -97 -107
                -1 -40 18 -72 50 -84 36 -14 58 -7 138 47 177 119 366 181 603 200 80 6 98 10
                118 30 35 35 31 85 -8 118 -33 28 -57 30 -196 16z"/>
                </g>
            </svg>
            <div class="dashboard-cards">Etats</div>
        </a>
        <a href="{{ route('admin.products') }}">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                width="70.000000pt" height="65.000000pt" viewBox="0 0 512.000000 512.000000"
                preserveAspectRatio="xMidYMid meet">

                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                fill="" stroke="none">
                <path d="M2410 4165 c-275 -67 -489 -333 -490 -608 0 -98 68 -171 160 -171 95
                0 153 65 163 180 9 115 73 209 179 266 36 19 58 23 138 23 80 0 102 -4 138
                -23 66 -35 119 -88 149 -150 38 -77 39 -190 4 -269 -28 -63 -98 -131 -172
                -168 -85 -43 -146 -92 -189 -152 -64 -90 -82 -149 -89 -297 l-6 -128 -893
                -344 c-491 -189 -915 -355 -942 -370 -102 -56 -193 -177 -225 -301 -20 -76
                -20 -251 0 -328 45 -172 179 -305 352 -350 86 -23 3660 -23 3746 0 173 45 307
                178 352 350 20 77 20 252 0 328 -33 126 -123 245 -227 302 -29 16 -453 183
                -943 371 l-890 342 -3 74 c-2 40 0 87 3 105 9 47 49 89 119 124 208 103 338
                302 353 539 18 300 -194 585 -489 655 -77 18 -224 18 -298 0z m1089 -2138
                c1076 -414 976 -359 976 -537 0 -118 -8 -139 -69 -184 l-27 -21 -1819 0 -1819
                0 -27 21 c-58 43 -69 68 -72 168 -4 105 8 149 54 186 34 27 1852 730 1874 724
                8 -2 426 -163 929 -357z"/>
                </g>
            </svg>
            <div class="dashboard-cards">Produits</div>
        </a>
        <a href="" class="disabled">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                width="70.000000pt" height="65.000000pt" viewBox="0 0 512.000000 512.000000"
                preserveAspectRatio="xMidYMid meet">

                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                fill="" stroke="none">
                <path d="M1870 4944 c-130 -28 -179 -61 -373 -253 -221 -218 -222 -222 -151
                -341 50 -83 68 -158 61 -257 -14 -236 -211 -407 -450 -390 -72 5 -92 11 -183
                57 -86 44 -108 51 -136 45 -42 -9 -341 -301 -399 -389 -110 -167 -110 -399 1
                -562 24 -36 533 -552 1317 -1335 1382 -1379 1303 -1306 1449 -1344 115 -30
                257 -14 368 42 40 19 207 181 759 731 389 389 721 727 737 751 60 89 75 144
                75 276 0 138 -13 189 -74 282 -25 37 -501 519 -1322 1339 -1252 1248 -1286
                1281 -1354 1312 -68 30 -169 53 -230 51 -16 0 -59 -7 -95 -15z m223 -254 c30
                -14 339 -318 1099 -1077 l1056 -1058 -850 -844 -849 -845 -1050 1050 c-1152
                1152 -1103 1097 -1103 1218 1 99 27 145 164 281 l118 118 54 -21 c109 -42 133
                -47 253 -47 106 0 131 3 209 29 364 120 551 518 409 875 l-25 63 113 115 c147
                147 201 177 307 167 29 -2 72 -13 95 -24z m2454 -2432 c140 -141 162 -179 163
                -278 0 -121 22 -95 -741 -856 -774 -772 -726 -731 -858 -722 -93 7 -130 30
                -274 175 l-118 119 845 842 c465 463 849 842 853 842 5 0 63 -55 130 -122z"/>
                </g>
            </svg>
            <div class="dashboard-cards">Tickets</div>
        </a>
        <a href="" class="disabled">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                width="60.000000pt" height="50.000000pt" viewBox="0 0 512.000000 512.000000"
                preserveAspectRatio="xMidYMid meet">

                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                fill="" stroke="none">
                <path d="M1575 4994 c-11 -2 -45 -9 -75 -15 -169 -33 -350 -176 -429 -340 -22
                -47 -41 -93 -41 -102 0 -16 -35 -17 -437 -17 -265 0 -452 -4 -475 -10 -74 -21
                -130 -114 -114 -192 7 -36 47 -92 79 -110 16 -10 137 -14 481 -18 l458 -5 23
                -62 c67 -176 209 -313 397 -381 65 -24 87 -27 203 -27 145 0 186 10 310 74
                130 66 259 221 305 364 l12 37 1360 0 c1511 0 1400 -5 1455 66 55 72 34 181
                -44 234 l-37 25 -1366 3 -1366 2 -32 78 c-76 185 -237 326 -427 377 -61 16
                -204 28 -240 19z m196 -351 c114 -50 189 -164 189 -285 0 -89 -29 -165 -84
                -222 -63 -64 -116 -88 -207 -94 -102 -6 -162 14 -233 79 -181 165 -116 459
                118 535 55 19 160 12 217 -13z"/>
                <path d="M3170 3199 c-90 -8 -143 -24 -230 -70 -138 -71 -245 -190 -301 -332
                l-28 -72 -1255 -5 c-1248 -5 -1255 -5 -1282 -26 -53 -39 -69 -71 -69 -134 0
                -63 16 -95 69 -134 27 -21 34 -21 1282 -26 l1255 -5 28 -72 c35 -88 103 -186
                173 -247 66 -57 182 -119 267 -141 81 -21 236 -21 316 0 199 51 380 214 447
                402 l23 63 571 0 571 0 33 23 c57 38 75 71 75 137 0 66 -18 99 -75 138 l-33
                22 -571 0 -571 0 -23 63 c-31 87 -90 173 -171 250 -134 126 -310 185 -501 166z
                m182 -345 c67 -22 135 -86 169 -159 24 -50 29 -73 29 -136 0 -65 -5 -85 -31
                -137 -119 -240 -453 -235 -568 8 -54 115 -27 262 65 353 91 91 207 115 336 71z"/>
                <path d="M1498 1395 c-206 -50 -379 -203 -453 -399 l-23 -61 -458 -5 c-344 -4
                -465 -8 -481 -18 -38 -22 -75 -79 -80 -126 -7 -58 24 -122 74 -156 l37 -25
                458 -3 c416 -3 458 -4 458 -19 0 -9 19 -55 41 -102 59 -120 171 -232 290 -289
                96 -46 149 -60 251 -68 143 -11 324 48 445 145 72 58 147 161 185 253 l32 78
                1366 2 1366 3 37 25 c80 54 99 162 42 236 -52 68 45 64 -1454 64 l-1359 0 -12
                38 c-49 152 -177 300 -320 370 -47 23 -112 49 -145 57 -73 18 -220 18 -297 0z
                m291 -344 c193 -100 231 -371 71 -515 -67 -60 -121 -81 -215 -81 -65 0 -89 5
                -130 24 -150 74 -221 244 -165 396 28 74 114 164 181 188 65 24 200 18 258
                -12z"/>
                </g>
            </svg>
            <div class="dashboard-cards">Stats</div>
        </a>
    </div>
</x-app-layout>