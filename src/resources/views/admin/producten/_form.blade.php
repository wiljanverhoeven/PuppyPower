<form action="{{ $action }}" method="POST" class="space-y-6" enctype="multipart/form-data">
    @csrf
    @method($method ?? 'POST')

    <div class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-[#FEFAE0]">Naam</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                   class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] text-[#283618] shadow-sm focus:border-[#BC6C25] focus:ring focus:ring-[#BC6C25] focus:ring-opacity-50">
            @error('name')
                <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price" class="block text-sm font-medium text-[#FEFAE0]">Prijs</label>
            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}"
                   class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] text-[#283618] shadow-sm focus:border-[#BC6C25] focus:ring focus:ring-[#BC6C25] focus:ring-opacity-50">
            @error('price')
                <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="category" class="block text-sm font-medium text-[#FEFAE0]">Categorie</label>
            <select name="category" id="category"
                    class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] text-[#283618] shadow-sm focus:border-[#BC6C25] focus:ring focus:ring-[#BC6C25] focus:ring-opacity-50">
                <option value="">Selecteer een categorie</option>
                @foreach(['Trainingen', 'Kussens', 'Speeltjes', 'Eten'] as $category)
                    <option value="{{ $category }}" @selected(old('category', $product->category) == $category)>{{ $category }}</option>
                @endforeach
            </select>
            @error('category')
                <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-[#FEFAE0]">Beschrijving</label>
            <textarea name="description" id="description" rows="3"
                      class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] text-[#283618] shadow-sm focus:border-[#BC6C25] focus:ring focus:ring-[#BC6C25] focus:ring-opacity-50">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
            @enderror
        </div>

    <div class="flex justify-end space-x-4">
        <a href="{{ route('admin.producten.index') }}" class="px-4 py-2 text-[#FEFAE0] hover:text-[#DDA15E] transition-colors duration-200">
            Annuleren
        </a>
        <button type="submit" class="px-4 py-2 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] rounded-md transition-colors duration-200">
            Opslaan
        </button>
    </div>
</form>