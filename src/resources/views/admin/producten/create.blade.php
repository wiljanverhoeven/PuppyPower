<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="w-full mb-6 text-center">
            <h1 class="text-2xl font-bold">Nieuw product toevoegen</h1>
        </div>

        <div class="bg-[#606C38] rounded-lg shadow-lg p-6 max-w-3xl mx-auto">
            @include('admin.producten._form', [
                'action' => route('admin.producten.store'),
                'method' => 'POST',
                'product' => new \App\Models\Product()
            ])
        </div>
    </div>
</x-app-layout>