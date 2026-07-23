<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <div class="min-h-screen bg-cover bg-center flex items-center justify-center relative"
         style="background-image: url('{{ asset('images/prelogin.jpg') }}');">

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/50"></div>

        <!-- Login Card -->
        <div class="relative w-full max-w-md px-8 py-6 bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl">

            <div class="flex justify-center mb-6">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-70 h-70 object-contain">
                </a>
            </div>

            {{ $slot }}

        </div>

    </div>
</body>
</html>
