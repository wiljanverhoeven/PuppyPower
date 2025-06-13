<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="w-full mb-6 text-center">
            <h1 class="text-2xl font-bold text-[#606C38]">Nieuwe Training Aanmaken</h1>
        </div>

        <div class="bg-[#606C38] rounded-lg shadow-lg p-6 max-w-3xl mx-auto">
            <form method="POST" action="{{ route('trainings.store') }}" class="space-y-6">
                @csrf
                
                <div class="space-y-4">
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-[#FEFAE0]">Naam</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] text-[#283618] shadow-sm focus:border-[#BC6C25] focus:ring focus:ring-[#BC6C25] focus:ring-opacity-50 p-2">
                        @error('name')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-[#FEFAE0]">Beschrijving</label>
                        <textarea name="description" id="description" rows="4" required
                                  class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] text-[#283618] shadow-sm focus:border-[#BC6C25] focus:ring focus:ring-[#BC6C25] focus:ring-opacity-50 p-2">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date Field -->
                    <div>
                        <label for="date" class="block text-sm font-medium text-[#FEFAE0]">Datum</label>
                        <input type="date" name="date" id="date" value="{{ old('date') }}"
                               class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] text-[#283618] shadow-sm focus:border-[#BC6C25] focus:ring focus:ring-[#BC6C25] focus:ring-opacity-50 p-2">
                        @error('date')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Type Field -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-[#FEFAE0]">Type</label>
                        <input type="text" name="type" id="type" value="{{ old('type') }}" required
                               class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] text-[#283618] shadow-sm focus:border-[#BC6C25] focus:ring focus:ring-[#BC6C25] focus:ring-opacity-50 p-2">
                        @error('type')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price Field -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-[#FEFAE0]">Prijs (€)</label>
                        <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" required
                               class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] text-[#283618] shadow-sm focus:border-[#BC6C25] focus:ring focus:ring-[#BC6C25] focus:ring-opacity-50 p-2">
                        @error('price')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <a href="{{ route('trainings.index') }}" class="px-4 py-2 text-[#FEFAE0] hover:text-[#DDA15E] transition-colors duration-200">
                        Annuleren
                    </a>
                    <button type="submit" class="px-4 py-2 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] rounded-md transition-colors duration-200 flex items-center">
                        <i class="fas fa-save mr-2"></i> Training Aanmaken
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>