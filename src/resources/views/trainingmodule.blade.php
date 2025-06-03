<x-app-layout>
    <div>Titel: {{ $mymodule->module->name }}</div>
    <div>description: {{ $mymodule->module->description }}</div>
    <div>
        @foreach ($medias as $media)
            <div>
                <h2>{{ $media->order }}</h2>
                <p>{{ $media->name }}</p>
                <p>{{ $media->description }}</p>
                <a href="{{ $media->url }}" target="_blank" class="text-blue-600 hover:underline">View Media</a>
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
