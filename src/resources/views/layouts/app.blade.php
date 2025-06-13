<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- import font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                {{-- <a href="{{ url('/') }}" class="text-xl font-bold ">Logo</a> --}}
                <div>
                    <a href="{{ url('/') }}" class="text-xl font-bold ">
                        <img src="{{ asset('images/logo.svg') }}" alt="" class="h-20 w-auto">
                    </a>
                </div>

                <!-- Desktop Links -->
                <div class="hidden sm:flex space-x-4">
                    <a href="{{ url('/') }}" class="hover:text-[#DDA15E] transition-all duration-150 {{ request()->is('/') ? 'underline' : '' }}">
                        Homepage
                    </a>
                    <a href="{{ route('store.index') }}" class="hover:text-[#DDA15E] transition-all duration-150 {{ request()->routeIs('store.index') ? 'underline' : '' }}">
                        Webshop
                    </a>
                     <a href="{{ route('trainings') }}" class="hover:text-[#DDA15E] transition-all duration-150 {{ request()->routeIs('trainings') ? 'underline' : '' }}">
                        Trainingen
                    </a>
                </div>
            </div>

            <!-- Desktop Auth -->
            {{-- replace the path from "/" to login, register and logout when the routes are working --}}
            <div class="hidden sm:flex sm:items-center space-x-4 gap-4">
                <a href="{{ route('cart.index') }}" class="hover:text-[#DDA15E] text-xl transition-all duration-150" {{ request()->routeIs('cart.index') ? 'underline' : '' }}">
                        <i class="fa-solid fa-cart-shopping"></i>
                </a>
                @auth
                    <button class="hover:text-[#DDA15E] text-xl transition-all duration-150" onclick="toggleProfileDropdown()">
                        <i class="fa-solid fa-user"></i> <i id="arrow" class="fa fa-caret-up"></i>
                    </button>
                @else
                    <a href="{{ route('login') }}" class=" hover:text-[#DDA15E] text-xl transition-all duration-150">
                        <i class="fa-solid fa-user"></i>
                    </a>
                @endauth
            </div>

            <!-- Mobile hamburger -->
            <div class="sm:hidden flex items-center">
                <div class="space-x-4 gap-4 flex justify-center items-center">
                    <a href="{{ route('cart.index') }}" class="hover:text-[#DDA15E] text-xl transition-all duration-150" {{ request()->routeIs('cart.index') ? 'underline' : '' }}">
                            <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                    
                    {{-- Mobile menu toggle button --}}
                    <button id="mobile-menu-toggle" class="text-[#FEFAE0] text-xl transition-all duration-150 focus:outline-none">
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
    </div>

    <!-- Mobile navbar -->
    <div id="mobile-menu" class="sm:hidden hidden px-4 pb-4">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ url('/') }}" class="block px-4 py-2 text-[#FEFAE0] {{ request()->is('/') ? 'font-semibold' : '' }}">
                Homepage
            </a>
            <a href="{{ route('store.index') }}" class="block px-4 py-2 text-[#FEFAE0] {{ request()->routeIs('store.index') ? 'font-semibold' : '' }}">
                Webshop
            </a>
            <a href="{{ route('trainings')}}" class="block px-4 py-2 text-[#FEFAE0] {{ request()->routeIs('trainings') ? 'font-semibold' : '' }}">
                Trainingen
            </a>
            @auth
                @if (auth()->user()->role !== 'admin')
                    <a href="{{ route('mytrainings') }}" class="block px-4 py-2 text-[#FEFAE0] {{ request()->routeIs('mytrainings') ? 'font-semibold' : '' }}">
                        Mijn Trainingen
                    </a>
                @else
                    <a href="{{ route('admin') }}" class="block px-4 py-2 text-[#FEFAE0] {{ request()->routeIs('admin') ? 'font-semibold' : '' }}">
                        Admin dashboard
                    </a>
                @endif
            @endauth
        </div>
        {{-- replace the path from "/" to login, register and logout when the routes are working --}}
        <div class="border-t border-gray-700 pt-4 px-4 flex flex-row items-center justify-between">
            <a href="{{ route('contact') }}" class="block py-2 text-[#FEFAE0] {{ request()->routeIs('contact') ? 'font-semibold' : '' }}">
                Contact
            </a>
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class=" hover:text-[#DDA15E] transition-all duration-150 gap-2">Uitloggen <i class="fa-solid fa-right-from-bracket"></i></button>
                </form>
                @else
                    <a href="{{ route('login') }}" class=" hover:text-[#DDA15E] text-xl transition-all duration-150">
                        <i class="fa-solid fa-user"></i>
                    </a>
            @endauth
        </div>
    </div>
    {{-- profile dropdown --}}
    @auth
    <div id="profile-dropdown" class="hidden absolute right-0 mt-2 mr-2 w-48 bg-[#606C38] rounded-md shadow-lg z-50">
        <div class="py-1">
            <a href="{{route('profile.edit')}}" class="block px-4 py-2 text-sm text-[#FEFAE0] hover:text-[#DDA15E] transition-all hover:bg-[#283618]">Profiel</a>
            @if (auth()->user()->role !== 'admin')
            <a href="{{route('mytrainings')}}" class="block px-4 py-2 text-sm text-[#FEFAE0] hover:text-[#DDA15E] transition-all hover:bg-[#283618]">Mijn Trainingen</a>
            @else
            <a href="{{route('admin')}}" class="block px-4 py-2 text-sm text-[#FEFAE0] hover:text-[#DDA15E] transition-all hover:bg-[#283618]">Admin Dashboard</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2 text-sm text-[#FEFAE0] hover:text-[#DDA15E] transition-all hover:bg-[#283618]">
                @csrf
                <button class="gap-2"><i class="fa-solid fa-right-from-bracket"></i> Uitloggen</button>
            </form>
        </div>
    </div>
    @endauth
</nav>

{{-- content --}}
<main class="min-h-screen ">
    {{ $slot }}
</main>

@stack('scripts')

{{-- footer --}}
<footer class="bg-[#283618] text-[#FEFAE0]">
    <div class="flex justify-between items-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-full w-full items-center">
            <a href="{{ url('/') }}" class="">
                <img src="{{ asset('images/logo.svg') }}" alt="" class="h-24 w-auto">
            </a>
        </div>
        <div class="flex flex-col-reverse shrink-0 gap-2">
            <div>
                <a href="{{ url('/contact') }}" class="hover:text-[#DDA15E] transition-all duration-150">Contact</a>
                <span class="mx-2">|</span>
                <a href="{{ url('/') }}" class="hover:text-[#DDA15E] transition-all duration-150">Privacy Policy</a>
            </div>
            <div class="flex flex-row justify-between">
                {{-- Social Media Links --}}
                <a href="https://www.facebook.com" class="text-[#FEFAE0] hover:text-blue-600 transition-all duration-150 text-2xl" aria-label="Facebook">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="https://www.instagram.com/backtobalance.dogs" class="text-[#FEFAE0] hover:text-pink-500 transition-all duration-150 text-2xl" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://twitter.com" class="text-[#FEFAE0] hover:text-black transition-all duration-150 text-2xl" aria-label="X">
                    <i class="fab fa-x-twitter"></i>
                </a>
                <a href="https://www.linkedin.com" class="text-[#FEFAE0] hover:text-blue-700 transition-all duration-150 text-2xl" aria-label="LinkedIn">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
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

    // Profile dropdown toggle
    function toggleProfileDropdown() {
        const dropdown = document.getElementById('profile-dropdown');
        const arrow = document.getElementById('arrow');
        arrow.classList.toggle('fa-caret-up');
        arrow.classList.toggle('fa-caret-down');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        dropdown.classList.toggle('show');
    }
</script>
<style>
    .show {
        display: block;
    }
</style>
</body>

</html>
