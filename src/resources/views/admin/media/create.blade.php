<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="w-full mb-6 text-center">
            <h1 class="text-2xl font-bold">Nieuwe media toevoegen</h1>
            <p class="mt-2">Voor module: <strong class="text-[#BC6C25]">{{ $module->name }}</strong></p>
        </div>

        <div class="bg-[#606C38] rounded-lg shadow-lg p-6 max-w-3xl mx-auto">
            <form method="POST" action="{{ route('trainings.modules.media.store', [$training, $module]) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-[#FEFAE0]">Titel</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                               class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] shadow-sm focus:border-[#BC6C25] focus:ring focus:ring-[#BC6C25] focus:ring-opacity-50 p-2">
                        @error('title')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- path/youtube field --}}
                    <div>
                        <label for="path" class="block text-sm font-medium text-[#FEFAE0]">Youtube Link of bestandslocatie</label>
                        <input type="text" name="path" id="path" value="{{ old('path') }}"
                               class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] shadow-sm focus:border-[#BC6C25] focus:ring focus:ring-[#BC6C25] focus:ring-opacity-50 p-2">
                        @error('path')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- upload image --}}
                    <div>
                        <label for="image" class="block text-sm font-medium text-[#FEFAE0]">Of upload een afbeelding</label>
                        <input type="file" name="image" id="image" accept="image/*"
                               class="mt-1 block w-full text-sm text-[#FEFAE0] file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#DDA15E] file:text-[#FEFAE0] hover:file:bg-[#BC6C25]">
                        @error('image')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- desc --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-[#FEFAE0]">Beschrijving</label>
                        <textarea name="description" id="description" rows="4"
                                  class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] shadow-sm focus:border-[#BC6C25] focus:ring focus:ring-[#BC6C25] focus:ring-opacity-50 p-2">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- order --}}
                    <div>
                        <label for="order" class="block text-sm font-medium text-[#FEFAE0]">Volgorde</label>
                        <input type="number" name="order" id="order" value="{{ old('order', 10) }}" min="0"
                               class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] shadow-sm focus:border-[#BC6C25] focus:ring focus:ring-[#BC6C25] focus:ring-opacity-50 p-2">
                        @error('order')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <a href="{{ route('trainings.modules.media.index', [$training, $module]) }}" class="px-4 py-2 text-[#FEFAE0] hover:text-[#DDA15E] transition-colors duration-200">
                        Annuleren
                    </a>
                    <button type="submit" class="px-4 py-2 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] rounded-md transition-colors duration-200 flex items-center">
                        <i class="fas fa-plus-circle mr-2"></i> Media toevoegen
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>