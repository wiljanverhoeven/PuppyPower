<x-app-layout>
    <h1>Nieuwe media toevoegen aan module: {{ $module->name }}</h1>

    <form method="POST" action="{{ route('trainings.modules.media.store', [$training, $module]) }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">Titel:</label><br>
            <input type="text" name="title" id="title" value="{{ old('title') }}" >
        </div>
        <div>
            <label for="path">Youtube Link of bestandslocatie:</label><br>
            <input type="text" name="path" id="path" value="{{ old('path') }}" >
        </div>
        <div>
            <label for="image">Of upload een afbeelding:</label><br>
            <input type="file" name="image" id="image" accept="image/*">
        </div>
        <div>
            <label for="description">Beschrijving:</label><br>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
        </div>
        <div>
            <label for="order">Volgorde:</label><br>
            <input type="number" name="order" id="order" value="{{ old('order', 10) }}"  min="0">
        </div>
        <div class="py-4">
            <button type="submit">Media toevoegen</button>
        </div>
    </form>
</x-app-layout>

