<x-guest-layout>
    <div class="mb-4 text-sm text-[#FEFAE0]">
        {{ __('Wachtwoord vergeten? Geen probleem. Laat ons gewoon je e-mailadres weten en we sturen je een e-mail met een link om je wachtwoord te resetten, zodat je een nieuw wachtwoord kunt kiezen.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#FEFAE0]" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('wachtwoordherstellink per email') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
