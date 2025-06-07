<x-app-layout>
    <h1>Update Training</h1>
    <h1>Training aanpassen: {{ $training->name }}</h1>
    <form method="POST" action="{{ route('trainings.update', $training->training_id ) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Naam:</label><br>
            <input type="text" name="name" id="name" value="{{ old('name', $training->name) }}" required>
        </div>
        <div>
            <label for="description">Beschrijving:</label><br>
            <textarea name="description" id="description" required>{{ old('description', $training->description) }}</textarea>
        </div>
        <div>
            <label for="date">Datum:</label><br>
            <input type="date" name="date" id="date"
                   value="{{ old('date', $training->date ? \Carbon\Carbon::parse($training->date)->format('Y-m-d') : '') }}">
        </div>
        <div>
            <label for="type">Type:</label><br>
            <input type="text" name="type" id="type" value="{{ old('type', $training->type) }}" required>
        </div>
        <div>
            <label for="price">Prijs (€):</label><br>
            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $training->price) }}" required>
        </div>
        <div class="py-4">
            <button type="submit">Training opslaan</button>
        </div>
    </form>
</x-app-layout>

