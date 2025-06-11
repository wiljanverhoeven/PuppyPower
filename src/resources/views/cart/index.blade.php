<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Winkelwagen</h1>

        @if(session('cart') && count(session('cart')))
            <div class="space-y-4">
               @foreach($cart as $item)
                    <div class="bg-[#606C38] p-4 rounded-md shadow text-[#FEFAE0] flex justify-between items-center">
                        <div>
                            <p class="text-xl font-semibold">{{ $item['product']->name }}</p>
                            <form method="POST" action="{{ route('cart.update', $item['product']->id) }}" class="flex items-center space-x-2 mt-2">
                                @csrf
                                <button type="button" onclick="updateQuantity(this, -1)" class="bg-[#BC6C25] text-white px-2 rounded">−</button>

                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                    class="w-12 text-center text-black rounded" readonly>

                                <button type="button" onclick="updateQuantity(this, 1)" class="bg-[#BC6C25] text-white px-2 rounded">+</button>

                            </form>
                            <p class="mt-1">Prijs: €{{ number_format($item['product']->price * $item['quantity'], 2) }}</p>
                        </div>
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('/images/placeholder.jpg') }}" alt="Image" class="h-16 w-16 rounded-lg object-cover mb-2">
                            <form method="POST" action="{{ route('cart.remove', $item['product']->id) }}">
                                @csrf
                                <button type="submit" class="text-sm text-red-200 hover:text-red-400">Verwijderen</button>
                            </form>
                        </div>
                    </div>
                @endforeach
                <form method="POST" action="{{ route('cart.checkout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] py-3 rounded-md font-bold mt-4">
                        Bestellen
                    </button>
                </form>
            </div>
        @else
            <p class="text-lg text-white">Je winkelwagen is leeg.</p>
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

