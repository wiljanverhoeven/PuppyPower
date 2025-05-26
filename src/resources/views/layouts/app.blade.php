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
<body class="bg-[#FEFAE0] font-sans antialiased">
<nav class="bg-[#283618] text-[#FEFAE0] sticky top-0 z-50 transition-all duration-700 ease-in">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo + Nav Links -->
            <div class="flex items-center space-x-6">
                <a href="{{ url('/') }}" class="text-xl font-bold ">Logo</a>

                <!-- Desktop Links -->
                <div class="hidden sm:flex space-x-4">
                    <a href="{{ url('/') }}" class="hover:text-[#E8E0C8] transition-all duration-150 {{ request()->is('/') ? 'underline' : '' }}">
                        Homepage
                    </a>
                    <a href="{{ route('store.index') }}" class="hover:text-[#E8E0C8] transition-all duration-150 {{ request()->routeIs('store.index') ? 'underline' : '' }}">
                        Webshop
                    </a>
                     <a href="{{ route('trainings') }}" class="hover:text-[#E8E0C8] transition-all duration-150 {{ request()->routeIs('trainings') ? 'underline' : '' }}">
                        Trainingen
                    </a>
                    @auth
                        <a href="{{ route('mytrainings') }}" class="hover:text-[#E8E0C8] transition-all duration-150 {{ request()->routeIs('mytrainings') ? 'underline' : '' }}">
                            Mijn Trainingen
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Desktop Auth -->
            {{-- replace the path from "/" to login, register and logout when the routes are working --}}
            <div class="hidden sm:flex sm:items-center space-x-4">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm hover:text-[#E8E0C8] transition-all duration-150">Log Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm hover:text-[#E8E0C8] transition-all duration-150">Login</a>
                    <span class="text-sm">/</span>
                    <a href="{{ route('register') }}" class="text-sm hover:text-[#E8E0C8] transition-all duration-150">Register</a>
                @endauth
            </div>

            <!-- Mobile hamburger -->
            <div class="sm:hidden flex items-center">
                <button id="mobile-menu-toggle" class="text-gray-500 hover:text-gray-100 transition-all duration-150 focus:outline-none">
                    <svg class="h-6 w-6" id="hamburger-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6 hidden" id="close-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile navbar -->
    <div id="mobile-menu" class="sm:hidden hidden px-4 pb-4">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ url('/') }}" class="block px-4 py-2 text-gray-100 hover:bg-gray-800 transition-all duration-150 {{ request()->is('/') ? 'font-semibold' : '' }}">
                Homepage
            </a>
            <a href="{{ route('contact') }}" class="block px-4 py-2 text-gray-100 hover:bg-gray-800 transition-all duration-150 {{ request()->routeIs('contact') ? 'font-semibold' : '' }}">
                Contact
            </a>
        </div>
        {{-- replace the path from "/" to login, register and logout when the routes are working --}}
        <div class="border-t border-gray-700 pt-4">
            @auth
                <form method="POST" action="{{ url('/') }}">
                    @csrf
                    <button class="block w-full text-left px-4 py-2 text-gray-100 hover:bg-gray-800 transition-all duration-150">
                        Log Out
                    </button>
                </form>
            @else
                <a href="{{ url('/') }}" class="block px-4 py-2 text-gray-100 hover:bg-gray-800 transition-all duration-150">Register</a>
            @endauth
        </div>
    </div>
</nav>

{{-- content --}}
<main class="min-h-screen ">
    {{ $slot }}
</main>

@stack('scripts')

{{-- footer --}}
<footer class="bg-[#283618] text-[#FEFAE0]">
    <div class="flex justify-between items-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div>
            <a href="{{ url('/') }}" class="text-xl font-bold text-[#FEFAE0]">Logo</a>
            {{-- <p class="text-center text-gray-500 text-sm">© {{ date('Y') }} Puppy Power Academy. All rights reserved.</p> --}}
        </div>
        <div>
            <a href="{{ url('/contact') }}" class="hover:text-[#E8E0C8] transition-all duration-150">Contact</a>
            <span class="mx-2">|</span>
            <a href="{{ url('/') }}" class="hover:text-[#E8E0C8] transition-all duration-150">Privacy Policy</a>
        </div>
    </div>
</footer>

{{-- Scripts --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.getElementById('mobile-menu-toggle');
        const menu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        toggleBtn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            hamburgerIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    });

    //make navbar transparent on scroll
    window.addEventListener('scroll', () => {
        const nav = document.querySelector('nav');
        if (window.scrollY > 0) {
            nav.classList.add('bg-opacity-85');
        } else {
            nav.classList.remove('bg-opacity-85');
        }
    });
</script>
</body>

</html>
