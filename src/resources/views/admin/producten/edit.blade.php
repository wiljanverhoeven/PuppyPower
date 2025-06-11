<x-app-layout>
    <h1>Product bewerken: {{ $product->name }}</h1>

   @include('admin.producten._form', [
    'action' => route('admin.producten.update', $product),
    'method' => 'PUT',
    'product' => $product
    ])

</x-app-layout>
