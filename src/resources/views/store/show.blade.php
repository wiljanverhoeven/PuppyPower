<x-app-layout>
    <div class="container flex flex-row justify-center gap-16 mx-auto px-4 py-6 space-x-6">
        {{-- item image --}}
        <div class="shrink-0 max-w-md lg:max-w-lg">
            {{-- Placeholder image, replace with actual product image --}}
            <img src="{{ asset('/images/placeholder.jpg') }}" alt="shop Image" class="w-[500px] h-[500px] object-cover rounded-lg shadow-lg">
        </div>
        {{-- item name, desc ect --}}
        <div class="w-1/3 flex flex-col space-y-4">
            {{-- product details --}}
            <div>
                <h1 class="text-xl font-bold">{{ $product->name }}</h1>
                <p class="text-[#DDA15E] text-sm">Categorie: {{ $product->category }}</p>
            </div>
            <p class="text-lg font-bold">${{ $product->price }}</p>

            <form method="POST" action="">
                @csrf
                <input type="number" name="min_aantal" placeholder="Minimum aantal" 
                class="w-1/2 mb-4 p-2 outline-none focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] rounded-md border-2 border-[#DDA15E] bg-[#FEFAE0] text-black" 
                value="1" min="1" max="100">
                <button type="submit" class="w-1/2 h-12 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] py-2 rounded-md transition">
                    <i class="fa-solid fa-cart-plus"></i> Toevoegen aan winkelwagen 
                </button>
            </form>

            <p>{{ $product->description }}</p>
        </div>
    </div>
    {{-- return to webshop --}}
    <a href="{{ route('store.index') }}">← Naar de webshop</a>
</x-app-layout>
