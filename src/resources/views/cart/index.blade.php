<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Winkelwagen</h1>
    <div class="container mx-auto px-4 py-6 border-2 border-red-600">
        @if(session('cart') && count(session('cart')))
            <div class="flex flex-row justify-between items-start">
                <div class="w-1/2 space-y-4">
                {{-- shopping cart items --}}
               @foreach($cart as $item)
               {{-- shopping cart item --}}
                    <div class="bg-[#606C38] w-full h-36 p-4 rounded-lg shadow text-[#FEFAE0] flex items-start">
                        <img src="{{ asset('/images/placeholder.jpg') }}" alt="Image" class="h-full rounded-lg object-cover">
                        {{-- item info (title, amount, ect) --}}
                        <div class="h-full flex flex-col ml-6 items-start justify-start">
                            {{-- item name, price and amount --}}
                            <h2 class="text-xl font-semibold mt-0">{{ $item['product']->name }}</h2>
                            <p class="font-semibold">Prijs: €{{ number_format($item['product']->price, 2) }}</p>
                            <form method="POST" action="{{ route('cart.update', $item['product']->id) }}" class="">
                                @csrf
                                <p>Aantal:</p>
                                <button type="button" onclick="updateQuantity(this, -1)" class="bg-[#BC6C25] text-[#FEFAE0] w-8 h-8 rounded-md">−</button>
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                    class="flex-1 p-2 outline-none focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] 
                                    rounded-md border-2 border-[#DDA15E] bg-[#FEFAE0] text-black
                                    w-12 h-8" readonly>
                                <button type="button" onclick="updateQuantity(this, 1)" class="bg-[#BC6C25] text-[#FEFAE0] w-8 h-8 rounded-md">+</button>
                            </form>
                            
                        </div>
                        {{-- price and remove button --}}
                        <div>
                            <p class="mt-1">Prijs: €{{ number_format($item['product']->price * $item['quantity'], 2) }}</p>
                            <form method="POST" action="{{ route('cart.remove', $item['product']->id) }}">
                                @csrf
                                <button type="submit" class="text-sm text-red-200 hover:text-red-400">Verwijderen</button>
                            </form>
                        </div>
                    </div>
                @endforeach
                </div>
                {{-- order box --}}
                <div class="bg-[#606C38] w-1/4 p-4 rounded-lg shadow text-[#FEFAE0]">
                    <form method="POST" action="{{ route('cart.checkout') }}">
                        @csrf
                        <button type="submit" class="w-full bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] py-3 rounded-md font-bold">
                            Bestellen
                        </button>
                    </form>
                </div>
            </div>
        @else
            <p class="text-lg text-black">De winkelwagen is leeg.</p>
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

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>