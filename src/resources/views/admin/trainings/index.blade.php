<x-app-layout>
    <h1>Trainingen</h1>
    @foreach($trainings as $training)
        <div class="card border-2">
            <div class="py-4">
                <div >
                    <div>{{ $training->name }}</div>
                </div>
                <div>
                    <a href="{{ route('trainings.edit', $training) }}">Update</a>
                </div>
                <form action="{{ route('trainings.destroy', $training) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
            <div class="py-2">
                <div>Aantal modules: {{ $training->modules_count }}</div>
{{--                <div>--}}
{{--                    <a href="{{ route('modules.index', $training) }}">Bekijk modules</a>--}}
{{--                </div>--}}
            </div>
        </div>
    @endforeach
    <div class="py-4">
        <div>Maak een nieuw training</div>
        <a href="{{ route('trainings.create') }}">Nieuw</a>
    </div>
</x-app-layout>
