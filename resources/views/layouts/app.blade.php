<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/mattkingshott/iodine@3/dist/iodine.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="flex-none">
        @include('layouts.header')
    </div>
    <main class="flex-grow">
        @yield('content')
    </main>
    <footer class="flex-none">
        @include('layouts.footer')
    </footer>
    <div id="loader" style="display: none !important"></div>

    <script>
        setTimeout(() => {
            window.Echo.channel('trades')
                .listen('NewTrade', (e) => {
                    console.log(e.trade);
                });

        }, 1000);
    </script>

    @stack('modals')
    @livewireScripts
</body>

</html>
