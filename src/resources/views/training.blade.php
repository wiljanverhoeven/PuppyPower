<x-app-layout>
    <div>
        <h1>Trainingen</h1>
        <div class="flex flex-row justify-around">
            @foreach($trainings as $training )
                <div class="">
                    <div>{{ $training->name }}</div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
