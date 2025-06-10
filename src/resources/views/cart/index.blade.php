<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Winkelwagen</h1>

        @if(session('cart') && count(session('cart')))
            <div class="space-y-4">
                @foreach($cart as $item)
                    <div class="bg-[#606C38] p-4 rounded-md shadow text-[#FEFAE0] flex justify-between items-center">
                        <div>
                            <p class="text-xl font-semibold">{{ $item['product']->name }}</p>
                            <p>Aantal: {{ $item['quantity'] }}</p>
                            <p>Prijs: €{{ number_format($item['product']->price * $item['quantity'], 2) }}</p>
                        </div>
                        <img src="{{ asset('/images/placeholder.jpg') }}" alt="Image" class="h-16 w-16 rounded-lg object-cover">
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
