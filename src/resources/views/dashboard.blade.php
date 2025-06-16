<x-app-layout>
    <div class="p-8 w-full justify-center items-center flex flex-col">
        {{-- Page Title --}}
        <div class="w-full my-6 text-center">
            <h1 class="text-3xl font-bold mb-8">Mijn Bestellingen</h1>
        </div>
        
        @forelse ($orders as $order)
            {{-- Check if order has multiple items --}}
            @if($order->orderItems->count() > 1)
                {{-- Multi-item order styling --}}
                <div class="bg-[#606C38] text-[#FEFAE0] rounded-lg w-full max-w-4xl mb-6 p-4 shadow-lg transition-transform hover:scale-[1.01]">
                    {{-- Order header --}}
                    <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-4">
                        <div class="grid grid-cols-2 gap-4 w-full sm:w-1/2">
                            <div>
                                <p class="text-sm text-[#DDA15E]">Bestel Datum</p>
                                <p>{{ $order->created_at->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-[#DDA15E]">Bestelnummer</p>
                                <p>#{{ $order->id }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-[#DDA15E]">Totaal Aantal</p>
                                <p>{{ $order->orderItems->sum('amount') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-[#DDA15E]">Totale Prijs</p>
                                <p>€{{ number_format($order->orderItems->sum(function($item) {
                                    return $item->amount * $item->product->price;
                                }), 2) }}</p>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Items list --}}
                    <div class="space-y-4">
                        @foreach ($order->orderItems as $item)
                            <div class="bg-[#283618] rounded-lg p-4 flex flex-col sm:flex-row gap-4">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('/images/placeholder.jpg') }}" alt="Order Image" 
                                        class="w-full sm:w-32 h-32 object-cover rounded-lg">
                                </div>
                                <div class="w-full">
                                    <h2 class="text-xl font-semibold">{{ $item->product->name ?? 'Product not found' }}</h2>
                                    <div class="grid grid-cols-2 gap-2 mt-2">
                                        <div>
                                            <p class="text-sm text-[#DDA15E]">Aantal</p>
                                            <p>{{ $item->amount }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-[#DDA15E]">Prijs per stuk</p>
                                            <p>€{{ number_format($item->product->price, 2) }}</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-2 mt-4">
                                        <a href="{{ route('store.show', $item->product->id) }}" 
                                           class="flex-1 h-10 gap-2 flex items-center justify-center text-center bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] py-2 rounded-lg transition-all ease-in-out">
                                            <i class="fa-solid fa-circle-arrow-left"></i> Bekijk Item
                                        </a>
                                        <form method="POST" action="{{ route('cart.add', $item->product) }}" class="flex-1">
                                            @csrf
                                            <button type="submit" class="w-full h-10 gap-2 flex items-center justify-center text-center bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] py-2 rounded-lg transition-all ease-in-out">
                                                <i class="fa-solid fa-cart-plus"></i> Opnieuw bestellen
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                {{-- Single-item order styling (original) --}}
                <div class="bg-[#606C38] flex flex-col sm:flex-row text-[#FEFAE0] rounded-lg w-full max-w-4xl h-auto mb-6 p-4 gap-4 shadow-lg transition-transform hover:scale-[1.01]">
                    {{-- order img --}}
                    <div class="flex-shrink-0">
                        <img src="{{ asset('/images/placeholder.jpg') }}" alt="Order Image" 
                            class="w-full sm:w-40 h-40 object-cover rounded-lg">
                    </div>
                    
                    {{-- order info --}}
                    <div class="w-full">
                        <h2 class="text-2xl font-semibold">
                            {{ $order->orderItems->first()->product->name ?? 'Product not found' }}
                        </h2>
                        @foreach ($order->orderItems as $item)
                            <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-2 sm:gap-0">
                                <div class="grid grid-cols-2 w-full sm:w-1/2">
                                    <div>
                                        <p class="text-sm text-[#DDA15E]">Bestel Datum</p>
                                        <p>{{ $order->created_at->format('d M Y') }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-[#DDA15E]">Bestelnummer</p>
                                        <p>#{{ $order->id }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-[#DDA15E]">Totaal Aantal</p>
                                        <p>{{ $item->amount }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-[#DDA15E]">Totale Prijs</p>
                                        <p class="">€{{ number_format($item->amount * $item->product->price, 2) }}</p>
                                    </div>
                                </div>
                                
                                {{-- buttons --}}
                                <div class="flex flex-row sm:flex-col gap-2 w-full sm:w-1/3">
                                    <button class="w-full h-10 gap-2 flex items-center justify-center text-center bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] py-3 rounded-lg transition-all ease-in-out">
                                        <i class="fa-solid fa-circle-arrow-left"></i> <a href="{{ route('store.show', $item->product->id) }}">Bekijk Item</a>
                                    </button>
                                    
                                    <form method="POST" action="{{ route('cart.add', $item->product) }}" class="w-full">
                                        @csrf
                                        <button class="w-full h-10 gap-2 flex items-center justify-center text-center bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] py-3 rounded-lg transition-all ease-in-out">
                                            <i class="fa-solid fa-cart-plus"></i> Opnieuw bestellen
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @empty
            <div class="bg-[#606C38] rounded-lg p-8 text-center">
                <p class="text-[#FEFAE0] text-lg">You have no orders yet.</p>
                <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-[#DDA15E] text-[#FEFAE0] px-4 py-2 rounded-lg hover:bg-[#BC6C25] transition-colors">
                    Browse Products
                </a>
            </div>
        @endforelse
        
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    </div>
</x-app-layout>