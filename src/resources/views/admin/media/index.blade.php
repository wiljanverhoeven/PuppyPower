<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="w-full mb-6 text-center">
            <h1 class="text-2xl font-bold">Media</h1>
            <a href="{{ route('trainings.modules.media.create', [$training, $module]) }}" class="inline-flex items-center px-4 py-2 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] rounded-md transition-colors duration-300">
                <i class="fas fa-plus mr-2"></i> Nieuw media item toevoegen
            </a>
            <p class="mt-2">Deze media horen bij de module: <strong class="text-[#BC6C25]">{{ $module->name }}</strong></p>
        </div>

        @if($media->count())
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach($media as $medium)
                    <div class="bg-[#606C38] text-[#FEFAE0] rounded-lg shadow-lg overflow-hidden hover:scale-[1.02] transition-all duration-300">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <h2 class="text-xl font-semibold">{{ $medium->title }}</h2>
                                <div class="flex space-x-2">
                                    <a href="{{ route('trainings.modules.media.edit', [$training, $module, $medium]) }}" class="text-[#DDA15E] hover:text-[#BC6C25] transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('trainings.modules.media.destroy', [$training, $module, $medium]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-300 hover:text-red-400 transition-colors" onclick="return confirm('Weet je zeker dat je dit media item wilt verwijderen?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <p class="mt-2">{{ $medium->description }}</p>
                            <p class="mt-2"><strong>Volgorde:</strong> {{ $medium->order }}</p>

                            <div class="mt-4">
                                @if(Str::startsWith($medium->path, 'http'))
                                    <a href="{{ $medium->path }}" target="_blank" class="text-[#DDA15E] hover:text-[#BC6C25] transition-colors flex items-center">
                                        <i class="fas fa-external-link-alt mr-2"></i> Bekijk externe media
                                    </a>
                                @else
                                    <div class="mt-4 bg-[#FEFAE0] p-2 rounded-md">
                                        <img src="{{ asset($medium->path) }}" alt="{{ $medium->title }}" class="w-full h-auto rounded-md">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-[#FEFAE0] rounded-lg p-6 text-center max-w-2xl mx-auto">
                <p>Er zijn nog geen media voor deze module.</p>
            </div>
        @endif

        <div class="mt-8 text-center">
        </div>
    </div>
</x-app-layout>