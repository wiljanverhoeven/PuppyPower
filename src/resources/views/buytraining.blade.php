<x-app-layout>
    <div>
        <h1>Koop Training</h1>
        <div class="p-4 border rounded-lg">
            <h2>{{ $training->name }}</h2>
            <p>Aantal modules: {{ $training->modules_count }}</p>
            <p>Beschrijving: {{ $training->description }}</p>
        </div>
        <form action="{{ route('confirmPurchase', ['id' => $training->training_id]) }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="bg-blue-600 p-4 text-white rounded-lg hover:bg-blue-700">
                Bevestig aankoop
            </button>
        </form>
    </div>
</x-app-layout>
