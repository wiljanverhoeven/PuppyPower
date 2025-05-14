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
    <nav class="bg-gray-100 dark:bg-gray-900 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-xl font-semibold text-gray-100">
                    Logo
                </a>
            </div>

            <!-- Nav Links -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6">
                <a href="{{ route('contact') }}"
                   class="text-gray-100 hover:text-gray-300 font-medium {{ request()->routeIs('contact') ? 'underline' : '' }}">
                    Contact
                </a>
            </div>

            <!-- login and registration -->
            {{-- <div class="hidden sm:flex sm:items-center sm:space-x-4">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm text-gray-100 hover:text-gray-300">Log Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-100 hover:text-gray-300">Login</a>
                    <a href="{{ route('register') }}" class="text-sm text-gray-100 hover:text-gray-300">Register</a>
                @endauth
            </div> --}}
        </div>
    </div>
</nav>
    <main>
        {{ $slot }}                
    </main>

    @stack('scripts')
</body>
</html>