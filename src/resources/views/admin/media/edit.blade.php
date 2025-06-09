<x-app-layout>
    <h1>Media bewerken: {{ $medium->title }}</h1>

    <form method="POST" action="{{ route('trainings.modules.media.update', [$training, $module, $medium]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Titel:</label><br>
            <input type="text" name="title" id="title" value="{{ old('title', $medium->title) }}" required>
        </div>
        <div>
            <label for="path">Youtube Link:</label><br>
            <input type="text" name="path" id="path" value="{{ old('path', $medium->path) }}" required>
        </div>
        <div>
            <label for="image">Of upload een nieuwe afbeelding (overschrijft bovenstaande indien ingevuld):</label><br>
            <input type="file" name="image" id="image" accept="image/*">
        </div>
        <div>
            <label for="description">Beschrijving:</label><br>
            <textarea name="description" id="description">{{ old('description', $medium->description) }}</textarea>
        </div>
        <div>
            <label for="order">Volgorde:</label><br>
            <input type="number" name="order" id="order" value="{{ old('order', $medium->order) }}" required min="0">
        </div>
        <div class="py-4">
            <button type="submit">Media opslaan</button>
        </div>
    </form>
</x-app-layout>

