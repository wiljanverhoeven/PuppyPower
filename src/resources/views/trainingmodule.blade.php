<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="my-6 text-center">
            <h1 class="text-2xl font-bold mb-2">{{ $mymodule->module->name }}</h1>
            <p class="italic">{{ $mymodule->module->description }}</p>
        </div>

        <div class="space-y-6 flex flex-col items-center justify-center">
            @foreach ($medias as $index => $media)
                <div class="bg-[#606C38] rounded-lg shadow-lg overflow-hidden w-2/3">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-2xl font-semibold text-[#FEFAE0]">{{ $media->title }}</h2>
                            <span class="bg-[#DDA15E] text-[#FEFAE0] px-3 py-1 rounded-full text-sm">
                               {{-- changed the way the steps are displayed, because the way it's ordered is dumb --}}
                                Stap {{ $index + 1 }} 
                            </span>
                        </div>
                        
                        @if($media->description)
                            <p class="text-[#FEFAE0] mb-4">{{ $media->description }}</p>
                        @endif

                        {{-- display yt videos --}}
                        <div class="mt-4">
                            @if (Str::contains($media->path, ['youtube.com', 'youtu.be']))
                                @php
                                    preg_match('/(youtube\.com\/watch\?v=|youtu\.be\/)([^\&\?\/]+)/', $media->path, $matches);
                                    $videoId = $matches[2] ?? null;
                                @endphp

                                @if ($videoId)
                                    <div class="aspect-w-16 aspect-h-9">
                                        <iframe class="w-full h-64 md:h-96 rounded-xl" 
                                                src="https://www.youtube.com/embed/{{ $videoId ?? 'dQw4w9WgXcQ' }}"
                                                frameborder="0" 
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                allowfullscreen>
                                        </iframe>
                                    </div>
                                @else
                                    <p class="text-red-500">Invalid YouTube URL</p>
                                @endif
                            @else
                                <img src="{{ asset('storage/' . $media->path) }}" 
                                     alt="{{ $media->name }}" 
                                     class="w-full h-auto rounded-lg shadow-md">
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 text-center">
            <form action="{{ route('mymodules.updateModuleStatus', $mymodule->mymodule_id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" 
                        class="px-6 py-3 gap-2 w-2/3 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] rounded-lg shadow-lg transition-all duration-300 font-semibold">
                    <i class="fas fa-check-circle"></i> Markeer als voltooid
                </button>
            </form>
        </div>
    </div>
</x-app-layout>