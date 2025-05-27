<x-app-layout>
    <h1>Mijn trainingen</h1>
    <p>Hieronder vind je een overzicht van de trainingen die je hebt gekocht.</p>
    @if ($mytrainings->isEmpty())
        <p>Je hebt nog geen trainingen gekocht.</p>
    @else
        <div class="flex flex-row justify-around">
            @foreach($mytrainings as $mytraining)
                <div class="p-4 border rounded-lg">
                    <h2>{{ $mytraining->training->name }}</h2>
                    <p>Aantal modules: {{ $mytraining->training->modules->count() }}</p>
                    <p>Beschrijving: {{ $mytraining->training->description }}</p>
                    <button class="bg-blue-600 p-4 text-white rounded-lg hover:bg-blue-700" onclick="window.location.href='{{ route('mytrainings.startTraining', ['id' => $mytraining->mytraining_id]) }}'">
                        Begin training
                    </button>
                </div>
            @endforeach
        </div>
    @endif
</x-app-layout>
