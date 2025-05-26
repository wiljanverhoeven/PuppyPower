<x-app-layout>
    <div class="container">
        <h1>{{ $product->name }}</h1>
        <p>{{ $product->description }}</p>
        <p><strong>Price:</strong> ${{ $product->price }}</p>
        <p><strong>Category:</strong> {{ $product->category }}</p>

        <a href="{{ route('store.index') }}">← Back to Store</a>
    </div>
</x-app-layout>
