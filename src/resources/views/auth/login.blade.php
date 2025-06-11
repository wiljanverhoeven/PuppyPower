<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="bg-[#606C38] p-6 rounded-lg">
        <h1 class="text-xl font-bold text-[#FEFAE0] mb-4">Inloggen</h1>
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" class="text-[#FEFAE0]" />
            <x-text-input id="email" 
                          class="block mt-1 w-full bg-[#606C38] text-[#FEFAE0] border-[#BC6C25] focus:border-[#BC6C25] focus:ring-[#BC6C25] placeholder:text-[#FEFAE0]" 
                          type="email" 
                          name="email" 
                          :value="old('email')"
                          required 
                          autofocus 
                          autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[#FEFAE0]" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Wachtwoord')" class="text-[#FEFAE0]" />

            <x-text-input id="password" 
                          class="block mt-1 w-full bg-[#606C38] text-[#FEFAE0] border-[#BC6C25] focus:border-[#BC6C25] focus:ring-[#BC6C25] placeholder:text-[#FEFAE0]" 
                          type="password" 
                          name="password" 
                          required 
                          autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-[#FEFAE0]" />
        </div>

        <!-- Remember Me -->
        <div class="block mb-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" 
                       type="checkbox" 
                       class="rounded bg-[#DDA15E] border-[#BC6C25] text-[#BC6C25] shadow-sm focus:ring-[#BC6C25]" 
                       name="remember">
                <span class="ml-2 text-sm text-[#FEFAE0]">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-[#FEFAE0] hover:text-[#DDA15E] focus:outline-none focus:ring-2 focus:ring-[#BC6C25] rounded-md transition-all ease-in-out" href="{{ route('password.request') }}">
                    {{ __('Wachtwoord vergeten?') }}
                </a>
            @endif

            <x-primary-button class="ml-3 bg-[#BC6C25] hover:bg-[#BC6C25] text-[#FEFAE0] border-[#BC6C25] focus:ring-[#BC6C25]">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <a href="{{ route('register') }}" class="text-[#FEFAE0] hover:text-[#DDA15E] text-sm underline flex items-end w-full justify-end">Nog geen account? Ga naar registreren.</a>
    </form>
    {{-- <a href="" class="text-[#FEFAE0] hover:text-[#DDA15E] underline flex items-end w-full justify-end">Geen account? Ga naar registreren.</a> --}}
</x-guest-layout>
