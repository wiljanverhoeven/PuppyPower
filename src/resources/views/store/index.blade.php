<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        {{-- Page Title --}}
        <div class="w-full mb-6 text-center">
            <h1 class="text-2xl font-bold">Webshop</h1>
        </div>

        <div class="flex flex-col lg:flex-row lg:space-x-6">
            {{-- Filter Sidebar --}}
            <form method="GET" action="{{ route('store.index') }}" class="mb-6 lg:mb-0 w-full lg:w-64 shrink-0 flex flex-col space-y-3 bg-[#606C38] p-4 rounded-lg shadow">
            <h2 class="text-[#FEFAE0] text-xl text-center font-bold">Filter</h2>
                <input type="text" name="search" placeholder="Search..." class="w-full p-2 focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] rounded-md border-none bg-[#FEFAE0] text-black" value="{{ request('search') }}">

                <select name="category" class="w-full p-2 bg-[#FEFAE0] text-black focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] rounded-md border-none">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>

                <input type="number" name="min_price" placeholder="Min Price" class="w-full p-2 focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] rounded-md border-none bg-[#FEFAE0] text-black" value="{{ request('min_price') }}">
                <input type="number" name="max_price" placeholder="Max Price" class="w-full p-2 focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] rounded-md border-none bg-[#FEFAE0] text-black" value="{{ request('max_price') }}">
                <button type="submit" class="w-full bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] py-2 rounded-md transition">
                    Filter
                </button>
            </form>

            {{-- Product Grid --}}
            <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-[#606C38] rounded-lg overflow-hidden shadow-lg p-2 h-96 flex flex-col justify-between hover:scale-105 transition-transform duration-300">
                        <div class="">
                            <img src="{{ asset('/images/placeholder.jpg') }}" alt="shop Image" class="w-full rounded-lg h-48 object-cover">
                        </div>
                        <div class="p-2">
                            <h2 class="w-fit text-lg text-[#FEFAE0] font-semibold mb-2 hover:text-[#DDA15E] transition">
                                <a href="{{ route('store.show', $product) }}">
                                    {{ $product->name }}
                                </a>
                            </h2>
                            <p class="text-sm text-white mb-2 h-12 text-ellipsis">
                                {{ Str::limit($product->description, 100) }}
                            </p>
                        </div>
                        <div class="flex flex-row justify-between items-center pl-2 pr-2 h-full">
                            <div class="p-2 w-1/2">
                                <p class="font-bold text-[#FEFAE0]">${{ $product->price }}</p>
                                <p class="italic text-sm text-white">{{ $product->category }}</p>
                            </div>
                            <form method="POST" action="" class="w-1/2 flex justify-center">
                                @csrf
                                <button type="submit" class="w-32 h-12 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] py-2 rounded-md transition">
                                    <i class="fa-solid fa-cart-plus text-xl"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $products->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>