<x-app-layout>
    <h1>Producten overzicht</h1>
    <a href="{{ route('admin.producten.create') }}">+ Nieuw product</a>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Naam</th>
                <th>Prijs</th>
                <th>Categorie</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>€ {{ number_format($product->price, 2) }}</td>
                <td>{{ $product->category }}</td>
                <td>
                    <a href="{{ route('admin.producten.edit', $product) }}">Bewerk</a>
                    <form action="{{ route('admin.producten.destroy', $product) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Weet je zeker dat je dit product wilt verwijderen?')">Verwijder</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
</x-app-layout>
