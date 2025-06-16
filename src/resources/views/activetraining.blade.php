<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="w-full mb-6 text-center">
            <h1 class="text-2xl font-bold">Active Trainingen</h1>
        </div>

        {{-- if there are no modules --}}
        @if($modules->isEmpty())
            <div class="bg-[#FEFAE0] rounded-lg p-6 text-center max-w-2xl mx-auto">
                <p>No active modules available.</p>
            </div>
        @else
            {{-- cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($modules as $mymodule)
                    <div class="bg-[#606C38] text-[#FEFAE0] rounded-lg shadow-lg overflow-hidden hover:scale-[1.02] transition-all duration-300">
                        <div class="w-full h-48 md:h-56 flex items-center justify-center p-4">
                            <img src="{{ asset('/images/placeholder.jpg') }}" class="w-full h-full object-cover rounded-lg">
                        </div>
                        <div class="px-6 pb-6">
                            <h2 class="text-xl font-semibold mb-2">{{ $mymodule->module->name }}</h2>
                            <p class="mb-4">{{ $mymodule->module->description }}</p>
                            {{-- <a href="{{ route('mymodules.startModule', $mymodule->mymodule_id) }}"
                               class="flex items-center justify-center gap-2 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] w-full py-2 rounded-md transition-colors duration-200">
                                <i class="fas fa-play"></i> Start Module
                            </a> --}}
                            {{-- there should be a different type of button if the module has been finished. JAY ADD IT!!!! --}}
                            @if($mymodule->status === 'completed')
                                
                            <a href="{{ route('mymodules.startModule', $mymodule->mymodule_id) }}"
                               class="flex items-center justify-center gap-2 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] w-full py-2 rounded-md transition-colors duration-200">
                                <i class="fa-solid fa-check"></i> module afgerond
                            </a>
                            @else
                            <a href="{{ route('mymodules.startModule', $mymodule->mymodule_id) }}"
                               class="flex items-center justify-center gap-2 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] w-full py-2 rounded-md transition-colors duration-200">
                                <i class="fas fa-play"></i> Start Module
                            </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>