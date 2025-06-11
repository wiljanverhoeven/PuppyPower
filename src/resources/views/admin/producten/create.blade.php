<x-app-layout>
    <h1>Nieuw product toevoegen</h1>

    @include('admin.producten._form', ['action' => route('admin.producten.store'), 'method' => 'POST', 'product' => null])
</x-app-layout>
