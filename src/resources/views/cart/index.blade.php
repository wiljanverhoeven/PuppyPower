<x-app-layout>
    <div class="w-full my-6 text-center">
        <h1 class="text-2xl font-bold">Winkelwagen</h1>
    </div>
    <div class="container mx-auto px-4 py-6">
        @if(session('cart') && count(session('cart')))
            <div class="flex flex-col-reverse lg:flex-row gap-6">
                {{-- Shopping cart items --}}
                <div class="w-full lg:w-2/3 space-y-4">
                    @foreach($cart as $item)
                    <div class="bg-[#606C38] p-4 rounded-lg shadow text-[#FEFAE0] flex flex-col sm:flex-row gap-4">
                        <img src="{{ asset('/images/placeholder.jpg') }}" alt="{{ $item['product']->name }}" 
                             class="w-full sm:w-32 h-32 object-cover rounded-lg self-center sm:self-start">
                        
                        {{-- Item details --}}
                        <div class="flex-1 flex flex-col sm:flex-row gap-4">
                            {{-- Product info --}}
                            <div class="flex-1">
                                <h2 class="text-xl font-semibold">{{ $item['product']->name }}</h2>
                                <p class="font-semibold">Prijs: €{{ number_format($item['product']->price, 2) }}</p>
                                
                                {{-- Quantity controls --}}
                                <form method="POST" action="{{ route('cart.update', $item['product']->id) }}" class="mt-2">
                                    @csrf
                                    <p>Aantal:</p>
                                    <div class="flex items-center gap-1">
                                        <button type="button" onclick="updateQuantity(this, -1)" 
                                                class="bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] w-8 h-8 rounded-md transition-all ease-in-out">−</button>
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                            class="p-2 outline-none focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] 
                                            rounded-md border-2 border-[#DDA15E] bg-[#FEFAE0] text-black
                                            w-12 h-8" readonly>
                                        <button type="button" onclick="updateQuantity(this, 1)" 
                                                class="bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] w-8 h-8 rounded-md transition-all ease-in-out">+</button>
                                    </div>
                                </form>
                            </div>
                            
                            {{-- Price and remove --}}
                            <div class="flex flex-col justify-between sm:items-end">
                                <p class="font-semibold">Totale Prijs: €{{ number_format($item['product']->price * $item['quantity'], 2) }}</p>
                                <form method="POST" action="{{ route('cart.remove', $item['product']->id) }}" class="w-full sm:w-auto">
                                    @csrf
                                    <button type="submit" class="w-full bg-red-500 hover:bg-red-800 text-[#FEFAE0] py-2 px-4 rounded-lg font-bold mt-2 sm:mt-0 transition-all ease-in-out">
                                        Verwijderen
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                
                <div class="w-full lg:w-1/3">
                    <div class="bg-[#606C38] p-4 rounded-lg shadow text-[#FEFAE0] sticky top-4">
                        <h2 class="text-xl font-semibold mb-4">Bestelling Overzicht</h2>
                        <div class="space-y-2 mb-4">
                            <p>{{ $totalQuantity }} {{ $totalQuantity == 1 ? 'item' : 'items' }}</p>
                            <p class="text-lg font-bold">Totale prijs: €{{ number_format($totalPrice, 2) }}</p>
                        </div>
                        <form method="POST" action="{{ route('cart.checkout') }}">
                            @csrf
                            <button type="submit" class="w-full bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] py-3 rounded-md font-bold transition-all ease-in-out">
                                Bestellen
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-lg text-gray-700 mb-4">Je winkelwagen is leeg</p>
                <button class="w-48 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] py-3 rounded-md font-bold transition-all ease-in-out">
                    <a href="{{ route('store.index') }}">
                        Verder winkelen
                    </a>
                </button>
            </div>
        @endif
    </div>
</x-app-layout>

<script>
    function updateQuantity(button, delta) {
        const form = button.closest('form');
        const input = form.querySelector('input[name="quantity"]');
        let current = parseInt(input.value);
        if (isNaN(current)) current = 1;

        input.value = Math.max(1, current + delta);
        form.submit();
    }
</script>

<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>