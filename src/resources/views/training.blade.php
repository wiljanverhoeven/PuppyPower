<x-app-layout>
    <div>
        <h1>Trainingen</h1>
        <div class="flex flex-row justify-center gap-24 px-10">
            @foreach($trainings as $training )
                <div class="bg-[#606C38] text-[#FEFAE0] w-72 h-[400px] rounded-lg shadow-lg flex flex-col items-center hover:scale-105 transition-all ease-in-out">
                    <div class="w-full h-48 flex items-center justify-center p-4">
                        {{-- Placeholder for training image --}}
                        <img src="{{ asset('/images/placeholder.jpg') }}" class="w-full h-full object-cover rounded-lg">
                    </div>
                    {{-- training info --}}
                    <div class=" w-full h-48 px-4">
                        <h2 class="text-xl font-semibold">{{ $training->name }}</h2>
                        <p class="text-3xl font-bold">€{{ $training->price }}</p>
                        <p>Aantal modules: {{ $training->modules_count }}</p>
                        <p class="text-sm italic truncate">{{ $training->description }}</p>
                        
                    </div>
                    
                    {{-- Button to buy training --}}
                    <div class="w-full pb-4 px-4 flex justify-center items-center">
                        @auth
                            @if($mytrainings->contains($training->training_id))
                                <button class="flex flex-row items-center justify-center gap-2 bg-[#DDA15E] text-[#FEFAE0] w-full py-2 rounded-md transition-all ease-in-out hover:cursor-not-allowed">
                                    <i class="fa-solid fa-check"></i> Al gekocht
                                </button>
                            @else
                                <button class="flex flex-row items-center justify-center gap-2 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] w-full py-2 rounded-md transition-all ease-in-out" onclick="window.location.href='{{ route('buytraining', ['id' => $training->training_id]) }}'">
                                    <i class="fa-solid fa-cart-plus text-xl"></i> Training kopen
                                </button>
                            @endif
                        @endauth
                        @guest
                        <button class="flex flex-row items-center justify-center gap-2 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] w-full py-2 rounded-md transition-all ease-in-out" onclick="window.location.href='{{ route('login') }}'">
                            Login voor meer info
                        </button>
                        @endguest
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
