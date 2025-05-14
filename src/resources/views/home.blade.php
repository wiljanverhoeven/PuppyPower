<x-app-layout>
    <div class="">
        {{-- header image --}}
        <div class="relative h-96">
            <img src="{{ asset('/images/header-placeholder.png') }}" alt="Header Image" class="w-full h-full object-cover brightness-60">
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4">
                <h1 class="text-gray-100 text-4xl font-bold">Welkom bij Puppy Power Academy</h1>
                <p class="text-gray-100">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
        </div>
    </div>
</x-app-layout>