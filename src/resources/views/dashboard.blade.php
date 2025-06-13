<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full text-center">
            <div class="bg-[#606C38] w-1/3 h-16 rounded-lg flex items-center justify-center mx-auto">
                <div class="text-[#FEFAE0]">
                    {{ __("Je bent ingelogd!") }}
                    {{-- redirect to homepage --}}
                    <a href="{{ route('home') }}" class="text-[#DDA15E] hover:text-[#BC6C25] transition-all ease-in-out">
                        {{ __('Naar de homepagina.') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
