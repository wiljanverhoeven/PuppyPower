<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="w-full mb-6 text-center">
            <h1 class="text-2xl font-bold">Mijn trainingen</h1>
            <p class="">Hieronder vind je een overzicht van alle trainingen die je hebt gekocht.</p>
        </div>

        {{-- if user has no trainings --}}
        @if ($mytrainings->isEmpty())
            <div class="bg-[#FEFAE0] rounded-lg p-6 text-center max-w-2xl mx-auto">
                <p>Je hebt nog geen trainingen gekocht.</p>
            </div>
        @else
        {{-- cards --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8 xl:px-40">
                @foreach($mytrainings as $mytraining)
                    <div class="bg-[#606C38] text-[#FEFAE0] w-full rounded-lg shadow-lg flex flex-col items-center hover:scale-105 transition-all ease-in-out duration-300 overflow-hidden">
                        {{-- training image --}}
                        <div class="w-full h-48 md:h-56 flex items-center justify-center p-4">
                            <img src="{{ asset('/images/placeholder.jpg') }}" alt="{{ $mytraining->training->name }}" class="w-full h-full object-cover rounded-lg">
                        </div>
                        
                        {{-- info --}}
                        <div class="w-full h-auto px-4 pb-3 flex-grow">
                            <h2 class="text-xl font-semibold">{{ $mytraining->training->name }}</h2>
                            <p>Aantal modules: {{ $mytraining->training->modules->count() }}</p>
                            <p class="text-sm italic truncate">{{ $mytraining->training->description }}</p>
                        </div>
                        
                        <div class="w-full pb-4 px-4">
                            <button onclick="window.location.href='{{ route('mytrainings.startTraining', ['id' => $mytraining->mytraining_id]) }}'" 
                                    class="flex flex-row items-center justify-center gap-2 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] w-full py-2 rounded-md transition-all ease-in-out duration-300">
                                <i class="fas fa-play"></i> Begin training
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>