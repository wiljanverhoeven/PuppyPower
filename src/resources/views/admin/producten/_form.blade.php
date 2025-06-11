<form action="{{ $action }}" method="POST">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div>
        <label for="name">Naam</label>
        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required>
        @error('name') <div style="color:red">{{ $message }}</div> @enderror
    </div>

    <div>
        <label for="description">Beschrijving</label>
        <textarea name="description">{{ old('description', $product->description ?? '') }}</textarea>
        @error('description') <div style="color:red">{{ $message }}</div> @enderror
    </div>

    <div>
        <label for="price">Prijs (€)</label>
        <input type="number" name="price" step="0.01" value="{{ old('price', $product->price ?? '') }}" required>
        @error('price') <div style="color:red">{{ $message }}</div> @enderror
    </div>

    <div>
        <label for="category">Categorie</label>
        <input type="text" name="category" value="{{ old('category', $product->category ?? '') }}" required>
        @error('category') <div style="color:red">{{ $message }}</div> @enderror
    </div>

    <button type="submit">Opslaan</button>
</form>
