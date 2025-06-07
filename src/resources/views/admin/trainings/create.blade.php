<x-app-layout>
    <h1>Create Training</h1>
    <form method="POST" action="{{ route('trainings.store') }}">
        @csrf
        @method('POST')
        <div>
            <label for="name">Naam:</label><br>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        </div>
        <div>
            <label for="description">Beschrijving:</label><br>
            <textarea name="description" id="description" required>{{ old('description') }}</textarea>
        </div>
        <div>
            <label for="date">Datum:</label><br>
            <input type="date" name="date" id="date" value="{{ old('date') }}">
        </div>
        <div>
            <label for="type">Type:</label><br>
            <input type="text" name="type" id="type" value="{{ old('type') }}" required>
        </div>
        <div>
            <label for="price">Prijs (€):</label><br>
            <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" required>
        </div>
        <div class="py-4">
            <button type="submit">Training opslaan</button>
        </div>
    </form>
</x-app-layout>
