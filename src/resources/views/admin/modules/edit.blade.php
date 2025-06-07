<x-app-layout>
    <h1>Module aanpassen: {{ $module->name }}</h1>
    <form method="POST" action="{{ route('trainings.modules.update', [$training, $module]) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Naam:</label><br>
            <input type="text" name="name" id="name" value="{{ old('name', $module->name) }}" required>
        </div>
        <div>
            <label for="description">Beschrijving:</label><br>
            <textarea name="description" id="description">{{ old('description', $module->description) }}</textarea>
        </div>
        <div>
            <label for="order">Volgorde:</label><br>
            <input type="number" name="order" id="order" value="{{ old('order', $module->order) }}" min="1" required>
        </div>
        <div class="py-4">
            <button type="submit">Module opslaan</button>
        </div>
    </form>
</x-app-layout>

