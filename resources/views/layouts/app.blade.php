<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

    <nav class="bg-blue-800 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <div class="flex items-center space-x-3">
    <img src="{{ asset('images/logo.png') }}" alt class="h24 object-scale-down">
</div>

                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('dashboard') }}"
                        class="px-4 py-2 rounded-md text-sm font-medium transition-colors
                               {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-blue-100 hover:bg-blue-700' }}">
                        Dashboard
                    </a>

                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('upload.index') }}"
                        class="px-4 py-2 rounded-md text-sm font-medium transition-colors
                               {{ request()->routeIs('upload.*') ? 'bg-blue-600 text-white' : 'text-blue-100 hover:bg-blue-700' }}">
                        Upload Data
                    </a>
                    @endif

                    <a href="{{ route('pol.index') }}"
                        class="px-4 py-2 rounded-md text-sm font-medium transition-colors
                               {{ request()->routeIs('pol.*') ? 'bg-blue-600 text-white' : 'text-blue-100 hover:bg-blue-700' }}">
                        Tabel POL
                    </a>
                </div>

                <div class="flex items-center space-x-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-blue-300 capitalize">
                            {{ auth()->user()->role === 'admin' ? 'Admin' : 'Sales' }}
                        </p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white text-sm font-medium px-4 py-2 rounded-md transition-colors">
                            Logout
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
