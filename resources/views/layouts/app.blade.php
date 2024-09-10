
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"> 
        <title>JOB - OFFERS</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <style>
            html {
                scroll-behavior: smooth;
            }
            
            [x-cloak] {
                display: none !important;
            }
        </style>

        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        @livewireStyles
        <script src="//unpkg.com/alpinejs" defer></script>
    </head>
    <body>

        <div class="container mx-auto px-4">

            @include('partials.navbar')
            <livewire:flash />
            @yield('content')

        </div>

        @livewireScripts

        <script>
            window.User = {
                id: {{ optional(auth()->user())->id }}
            }
        </script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
