<x-app-layout>
    {{-- return to webshop --}}
    <div class="container mx-auto px-4 py-6">
        <a href="{{ route('store.index') }}" class="inline-block mb-6 text-[#DDA15E] hover:text-[#BC6C25] transition-all ease-in-out">← Naar de webshop</a>
        
        <div class="flex flex-col lg:flex-row justify-center gap-8 lg:gap-16">
            {{-- item image --}}
            <div class="w-full lg:w-1/2 xl:w-1/3">
                <img src="{{ asset('/images/placeholder.jpg') }}" alt="shop Image" class="w-full h-auto object-cover rounded-lg shadow-lg">
            </div>
            
            {{-- item name, desc etc --}}
            <div class="w-full lg:w-1/2 xl:w-1/3 flex flex-col space-y-4">
                {{-- product details --}}
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">{{ $product->name }}</h1>
                    <p class="text-[#DDA15E] text-sm md:text-base">Categorie: {{ $product->category }}</p>
                </div>
                <p class="text-xl md:text-2xl font-bold">€{{ $product->price }}</p>

                <form method="POST" action="" class="w-full">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-4 mb-4">
                        <input type="number" name="min_aantal" placeholder="Minimum aantal" 
                            class="flex-1 p-2 outline-none focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] rounded-md border-2 border-[#DDA15E] bg-[#FEFAE0] text-black shadow-md" 
                            value="1" min="1" max="100">
                        <button type="submit" class="flex-1 h-12 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] py-2 rounded-md transition shadow-md">
                            <i class="fa-solid fa-cart-plus"></i> Toevoegen aan winkelwagen 
                        </button>
                    </div>
                </form>

                <p class="text-base md:text-lg">{{ $product->description }}</p>
            </div>
        </div>
    </div>
</x-app-layout>