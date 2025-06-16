<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="w-full mb-6 text-center flex flex-row justify-between items-center">
            <h1 class="text-2xl font-bold">Trainingen</h1>
            <a href="{{ route('trainings.create') }}" class="inline-flex items-center px-4 py-2 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] rounded-md transition-colors duration-300">
                <i class="fas fa-plus mr-2"></i> Nieuwe training aanmaken
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($trainings as $training)
                <div class="bg-[#606C38] text-[#FEFAE0] rounded-lg shadow-lg overflow-hidden hover:scale-[1.02] transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <h2 class="text-xl font-semibold">{{ $training->name }}</h2>
                            <div class="flex space-x-2">
                                <a href="{{ route('trainings.edit', $training) }}" class="text-[#DDA15E] hover:text-[#BC6C25] transition-colors">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('trainings.destroy', $training) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-300 hover:text-red-400 transition-colors" onclick="return confirm('Weet je zeker dat je deze training wilt verwijderen?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t border-[#DDA15E]/30">
                            <div class="flex justify-between items-center">
                                <span>Aantal modules: {{ $training->modules_count }}</span>
                                <a href="{{ route('trainings.modules.index', $training) }}" class="text-[#DDA15E] hover:text-[#BC6C25] transition-colors flex items-center">
                                    Bekijk modules <i class="fas fa-arrow-right ml-1 text-sm"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 text-center">
        </div>
    </div>
</x-app-layout>