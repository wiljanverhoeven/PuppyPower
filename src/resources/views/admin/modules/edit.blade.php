<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="w-full mb-6 text-center">
            <h1 class="text-2xl font-bold">Module aanpassen: {{ $module->name }}</h1>
        </div>

        <div class="bg-[#606C38] rounded-lg shadow-lg p-6 max-w-3xl mx-auto">
            <form method="POST" action="{{ route('trainings.modules.update', [$training, $module]) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-[#FEFAE0]">Naam</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $module->name) }}" required
                               class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] text-[#283618] shadow-sm focus:border-[#BC6C25] focus:ring focus:ring-[#BC6C25] focus:ring-opacity-50 p-2">
                        @error('name')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-[#FEFAE0]">Beschrijving</label>
                        <textarea name="description" id="description" rows="4"
                                  class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] text-[#283618] shadow-sm focus:border-[#BC6C25] focus:ring focus:ring-[#BC6C25] focus:ring-opacity-50 p-2">{{ old('description', $module->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="order" class="block text-sm font-medium text-[#FEFAE0]">Volgorde</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $module->order) }}" min="1" required
                               class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] text-[#283618] shadow-sm focus:border-[#BC6C25] focus:ring focus:ring-[#BC6C25] focus:ring-opacity-50 p-2">
                        @error('order')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <a href="{{ route('trainings.modules.index', $training) }}" class="px-4 py-2 text-[#FEFAE0] hover:text-[#DDA15E] transition-colors duration-200">
                        Annuleren
                    </a>
                    <button type="submit" class="px-4 py-2 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] rounded-md transition-colors duration-200 flex items-center">
                        <i class="fas fa-save mr-2"></i> Module opslaan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>