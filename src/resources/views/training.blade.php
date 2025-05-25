<x-app-layout>
    <div>
        <h1>Trainingen</h1>
        <div class="flex flex-row justify-around">
            @foreach($trainings as $training )
                <div class="">
                    <div>{{ $training->name }}</div>
                    <div>Aantal modules: {{ $training->modules_count }}</div>
                    @auth
                        @if($mytrainings->contains($training->training_id))
                            <button class="bg-red-600 p-4 text-white rounded-lg">
                                Al gekocht
                            </button>
                        @else
                            <button class="bg-green-600 p-4 text-white rounded-lg hover:bg-green-700" onclick="window.location.href='{{ route('buytraining', ['id' => $training->training_id]) }}'">
                                Koop training
                            </button>
                        @endif
                    @endauth
                    @guest
                    <button class="bg-gray-600 p-4 text-white rounded-lg hover:bg-gray-700" onclick="window.location.href='{{ route('login') }}'">
                        Log in om te kopen
                    </button>
                    @endguest
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
