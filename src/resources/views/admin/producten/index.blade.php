<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="w-full mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Producten overzicht</h1>
            <a href="{{ route('admin.producten.create') }}" class="bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] px-4 py-2 rounded-md transition-all ease-in-out duration-300">
                + Nieuw product
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-[#606C38] rounded-lg shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#283618] text-[#FEFAE0]">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Naam</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Prijs</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Categorie</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Acties</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#DDA15E]/20">
                        @foreach($products as $product)
                        <tr class="transition-colors duration-200 hover:bg-[#606C38]/90">
                            <td class="px-6 py-4 whitespace-nowrap text-[#FEFAE0]">{{ $product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-[#FEFAE0] font-bold">€ {{ number_format($product->price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-[#FEFAE0]">{{ $product->category }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-[#FEFAE0]">
                                <div class="flex space-x-3">
                                    <a href="{{ route('admin.producten.edit', $product) }}" class="text-[#DDA15E] hover:text-[#BC6C25] transition-colors duration-200">Bewerk</a>
                                    <form action="{{ route('admin.producten.destroy', $product) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Weet je zeker dat je dit product wilt verwijderen?')" class="text-red-300 hover:text-red-400 transition-colors duration-200">
                                            Verwijder
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>