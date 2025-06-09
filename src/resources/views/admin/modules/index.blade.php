<x-app-layout>
    <h1>Modules</h1>
    <p>Deze modules horen bij de: <strong>{{ $training->name }}</strong> training</p>

    @if($modules->count())
        <div class="grid grid-cols-1 gap-4">
            @foreach($modules as $module)
                <div class="card border-2 p-4">
                    <h2 class="text-lg font-bold">{{ $module->name }}</h2>
                    <p>{{ $module->description }}</p>
                    <a href="{{ route('trainings.modules.edit', [$training, $module]) }}">Edit</a>
                    <form action="{{ route('trainings.modules.destroy', [$training, $module]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                    <p><strong>Aantal media:</strong> {{ $module->medias_count }}</p>
                    <div class="py-2">
                        <a href="{{ route('trainings.modules.media.index', [$training, $module]) }}" class="btn btn-primary">
                            Bekijk media
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Er zijn nog geen modules voor deze training.</p>
    @endif
    <div class="py-4">
        <div>Maak een nieuw module</div>
        <a href="{{ route('trainings.modules.create', [$training]) }}">Nieuw</a>
    </div>
</x-app-layout>

