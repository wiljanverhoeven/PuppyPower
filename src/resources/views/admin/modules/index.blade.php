<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="w-full mb-6 text-center">
            <h1 class="text-2xl font-bold">Modules</h1>
            <p class="mt-2">Deze modules horen bij de: <strong class="text-[#BC6C25]">{{ $training->name }}</strong> training</p>
        </div>

        @if($modules->count())
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach($modules as $module)
                    <div class="bg-[#606C38] text-[#FEFAE0] rounded-lg shadow-lg overflow-hidden hover:scale-[1.02] transition-all duration-300">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <h2 class="text-xl font-semibold">{{ $module->name }}</h2>
                                <div class="flex space-x-2">
                                    <a href="{{ route('trainings.modules.edit', [$training, $module]) }}" class="text-[#DDA15E] hover:text-[#BC6C25] transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('trainings.modules.destroy', [$training, $module]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-300 hover:text-red-400 transition-colors" onclick="return confirm('Weet je zeker dat je deze module wilt verwijderen?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <p class="mt-2">{{ $module->description }}</p>

                            <div class="mt-4 pt-4 border-t border-[#DDA15E]/30">
                                <div class="flex justify-between items-center">
                                    <span><strong>Aantal media:</strong> {{ $module->medias_count }}</span>
                                    <a href="{{ route('trainings.modules.media.index', [$training, $module]) }}" class="text-[#DDA15E] hover:text-[#BC6C25] transition-colors flex items-center">
                                        Bekijk media <i class="fas fa-arrow-right ml-1 text-sm"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-[#FEFAE0] text-[#283618] rounded-lg p-6 text-center max-w-2xl mx-auto">
                <p>Er zijn nog geen modules voor deze training.</p>
            </div>
        @endif

        <div class="mt-8 text-center">
            <a href="{{ route('trainings.modules.create', [$training]) }}" class="inline-flex items-center px-4 py-2 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] rounded-md transition-colors duration-300">
                <i class="fas fa-plus mr-2"></i> Nieuwe module aanmaken
            </a>
        </div>
    </div>
</x-app-layout>