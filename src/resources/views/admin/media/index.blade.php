<x-app-layout>
    <h1>Media</h1>
    <p>Deze media horen bij de module: <strong>{{ $module->name }}</strong></p>

    @if($media->count())
        <div class="grid grid-cols-1 gap-4">
            @foreach($media as $medium)
                <div class="card border-2 p-4">
                    <h2 class="text-lg font-bold">{{ $medium->title }}</h2>
                    <p>{{ $medium->description }}</p>
                    <a href="{{ route('trainings.modules.media.edit', [$training, $module, $medium]) }}">Edit</a>
                    <form action="{{ route('trainings.modules.media.destroy', [$training, $module, $medium]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                    <p><strong>Volgorde:</strong> {{ $medium->order }}</p>
                    @if(Str::startsWith($medium->path, 'http'))
{{--                        If link--}}
                        <a href="{{ $medium->path }}" target="_blank">Bekijk media</a>
                    @else
{{--                        If image--}}
                        <img src="{{ asset( $medium->path) }}" alt="{{ $medium->title }}" class="w-64">
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <p>Er zijn nog geen media voor deze module.</p>
    @endif

    <div class="py-4">
        <div>Maak een nieuw media item</div>
        <a href="{{ route('trainings.modules.media.create', [$training, $module]) }}">Nieuw</a>
    </div>
</x-app-layout>

