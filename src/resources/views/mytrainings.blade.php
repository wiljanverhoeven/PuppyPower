<x-app-layout>
    <h1>Mijn trainingen</h1>
    <p>Hieronder vind je een overzicht van de trainingen die je hebt gekocht.</p>
    @if ($mytrainings->isEmpty())
        <p>Je hebt nog geen trainingen gekocht.</p>
    @else
        <div class="flex flex-row justify-around">
            @foreach($mytrainings as $mytraining)
                <div class="p-4 border rounded-lg">
                    <h2>{{ $mytraining->name }}</h2>
                    <p>Aantal modules: {{ $mytraining->modules_count }}</p>
                    <p>Beschrijving: {{ $mytraining->description }}</p>
                    <button class="bg-blue-600 p-4 text-white rounded-lg hover:bg-blue-700">
                        Begin training
                    </button>
                </div>
            @endforeach
        </div>
    @endif
</x-app-layout>
