<x-app-layout>
    {{-- return to training --}}
    <div class="container mx-auto px-4 py-6">
        <a href="{{ route('trainings') }}" class="inline-block mb-6 text-[#DDA15E] hover:text-[#BC6C25] transition-all ease-in-out">
            <i class="fa-solid fa-circle-arrow-left"></i> Naar Trainingen</a>
        
        <div class="flex flex-col lg:flex-row justify-center gap-8 lg:gap-16">
            {{-- item image --}}
            <div class="w-full lg:w-1/2 xl:w-1/3">
                <img src="{{ asset('/images/placeholder.jpg') }}" alt="shop Image" class="w-full h-auto object-cover rounded-lg shadow-lg">
            </div>
            
            {{-- item name, desc etc --}}
            <div class="w-full lg:w-1/2 xl:w-1/3 flex flex-col space-y-4">
                {{-- product details --}}
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">{{ $training->name }}</h1>
                    <p class="text-[#DDA15E] text-sm md:text-base">Aantal modules: {{ $training->modules_count }}</p>
                </div>
                <p class="text-xl md:text-2xl font-bold">€ {{ $training->price }}</p>

                <form method="POST" action="{{ route('confirmPurchase', ['id' => $training->training_id]) }}" class="w-full">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-4 mb-4 w-1/2">
                        <button type="submit" class="w-full flex justify-center items-center gap-2 h-12 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] py-2 rounded-md transition shadow-md">
                            <i class="fa-solid fa-cart-plus"></i> Training kopen
                        </button>
                    </div>
                </form>

                <p class="text-base md:text-lg">{{ $training->description }}</p>
            </div>
        </div>
    </div>
</x-app-layout>