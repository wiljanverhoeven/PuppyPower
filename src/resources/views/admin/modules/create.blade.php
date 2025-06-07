<x-app-layout>
    <h1>Nieuwe module toevoegen aan training: {{ $training->name }}</h1>

    <form method="POST" action="{{ route('trainings.modules.store', $training) }}">
        @csrf
        <div>
            <label for="name">Naam:</label><br>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        </div>
        <div>
            <label for="description">Beschrijving:</label><br>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
        </div>
        <div>
            <label for="order">Volgorde:</label><br>
            <input type="number" name="order" id="order" value="{{ old('order', 1) }}" min="1" required>
        </div>
        <div class="py-4">
            <button type="submit">Module opslaan</button>
        </div>
    </form>
</x-app-layout>
