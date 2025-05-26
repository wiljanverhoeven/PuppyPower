
<x-app-layout>
<div class="container">
    <h1>Store</h1>

    <form method="GET" action="{{ route('store.index') }}" class="mb-4">
        <div>
            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
        </div>
        <div>
            <select name="category">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <input type="number" name="min_price" placeholder="Min Price" value="{{ request('min_price') }}">
            <input type="number" name="max_price" placeholder="Max Price" value="{{ request('max_price') }}">
        </div>
        <button type="submit">Filter</button>
    </form>

    <div class="grid grid-cols-3 gap-4">
        @foreach($products as $product)
            <div class="border p-4">
                <h2>
                    <a href="{{ route('store.show', $product) }}">
                        {{ $product->name }}
                    </a>
                </h2>
                <p>{{ Str::limit($product->description, 100) }}</p>
                <p><strong>${{ $product->price }}</strong></p>
                <p><em>{{ $product->category }}</em></p>
            </div>
        @endforeach
    </div>


    <div class="mt-4">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
</x-app-layout>