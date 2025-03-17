<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

        <title>薬約(やくやく) 予約アプリ</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
           {{-- @include('layouts.navigation') --}}

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-green-500">
                    <div class="mx-2 py-2 px-2 sm:px-3 lg:px-6 flex items-center justify-between">
                        <div class="flex items-center">
                            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                                <a href="{{ route('dashboard') }}"><img src="{{ asset('images/logo.png') }}" alt="logo" class="w-20 h-20"></a>
                            </h1>
                        </div>
                        <nav>
                            <ul class="flex items-center gap-6">
                                <li>
                                    <a href="{{ route('user.index') }}" class="text-white font-bold">
                                        <svg class="m-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" width="40" height="40" color="#FFFFFF"><defs><style>.cls-637b8170f95e86b59c57a033-1{fill:none;stroke:currentColor;stroke-miterlimit:10;}</style></defs><g id="drug"><rect class="cls-637b8170f95e86b59c57a033-1" x="4.34" y="0.3" width="6.74" height="14.83" rx="3.37" transform="translate(7.71 -3.19) rotate(45)"></rect><circle class="cls-637b8170f95e86b59c57a033-1" cx="16.76" cy="16.76" r="5.72"></circle><line class="cls-637b8170f95e86b59c57a033-1" x1="20.77" y1="20.77" x2="12.95" y2="12.95"></line><line class="cls-637b8170f95e86b59c57a033-1" x1="10.09" y1="10.09" x2="5.33" y2="5.33"></line></g></svg>
                                        <span class="block mt-2 text-white font-bold">患者</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.index') }}" class="text-white font-bold">
                                        <svg id="Layer_1" class="m-auto" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" width="40" height="40" color="#FFFFFF"><defs><style>.cls-6374f8d9b67f094e4896c670-1{fill:none;stroke:currentColor;stroke-miterlimit:10;}</style></defs><circle class="cls-6374f8d9b67f094e4896c670-1" cx="12" cy="7.25" r="5.73"></circle><path class="cls-6374f8d9b67f094e4896c670-1" d="M1.5,23.48l.37-2.05A10.3,10.3,0,0,1,12,13h0a10.3,10.3,0,0,1,10.13,8.45l.37,2.05"></path></svg>
                                        <span class="block mt-2 text-white font-bold">管理</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </header>

                <div class="bg-green-200 py-2 px-2 sm:px-3 lg:px-6 flex items-center justify-between">
                    <div class="text-gray-600 font-bold">
                                {{ Auth::user()->name }} さん
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="max-w-fit">
                        @csrf
                        <button type="submit" class="text-gray-600 font-bold underline hover:text-gray-900">ログアウト</button>
                    </form>
                </div>

            @endisset

            <!-- Page Content -->
            <main class="py-2 px-4 sm:px-4 lg:px-6">
                {{ $slot }}
            </main>
        </div>
        <script src="{{ asset('js/common.js') }}"></script>
    </body>
</html>
