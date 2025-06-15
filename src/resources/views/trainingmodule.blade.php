<x-app-layout>
    <div>Titel: {{ $mymodule->module->name }}</div>
    <div>description: {{ $mymodule->module->description }}</div>
    <div>
        @foreach ($medias as $media)
            <div>
                <h2>{{ $media->order }}</h2>
                <p>{{ $media->name }}</p>
                <p>{{ $media->description }}</p>
                @if (Str::contains($media->path, ['youtube.com', 'youtu.be']))
                    @php
                        preg_match('/(youtube\.com\/watch\?v=|youtu\.be\/)([^\&\?\/]+)/', $media->path, $matches);
                        $videoId = $matches[2] ?? null;
                    @endphp

                    @if ($videoId)
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen></iframe>
                    @else
                        <p>Invalid YouTube URL</p>
                    @endif
                @else
                    <img src="{{ asset('storage/' . $media->path) }}" alt="{{ $media->name }}" style="max-width: 100%; height: auto;">
                @endif
            </div>
        @endforeach
    </div>
    <form action="{{ route('mymodules.updateModuleStatus', $mymodule->mymodule_id) }}" method="POST" style="display: inline;">
        @csrf
        @method('PATCH')
        <button class="bg-blue-600 p-4 text-white rounded-lg hover:bg-blue-700" type="submit">
            Markeer als voltooid
        </button>
    </form>
</x-app-layout>
