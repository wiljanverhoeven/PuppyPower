<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="w-full mb-6 text-center">
            <h1 class="text-2xl font-bold">Admin Dashboard</h1>
        </div>

        <div class="bg-[#606C38] text-[#FEFAE0] rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
            <div class="flex flex-col gap-6">
                <!-- Trainingen Card -->
                <a href="{{ route('trainings.index') }}" class="bg-[#DDA15E] rounded-lg p-4 shadow-md hover:bg-[#BC6C25] transition-colors duration-300">
                    <div class="flex items-center gap-2">
                        <div class="">
                            <i class="fas fa-dumbbell text-xl"></i>
                        </div>
                        <h2 class="text-lg font-semibold">Trainingen</h2>
                    </div>
                </a>

                <!-- Producten Card -->
                <a href="{{ route('admin.producten.index') }}" class="bg-[#DDA15E] rounded-lg p-4 shadow-md hover:bg-[#BC6C25] hover:text-[#FEFAE0] transition-colors duration-300">
                    <div class="flex items-center gap-2">
                        <div class="">
                            <i class="fas fa-shopping-bag text-xl"></i>
                        </div>
                        <h2 class="text-lg font-semibold">Producten</h2>
                    </div>
                </a>

                <!-- Orders Card -->
                <a href="{{ route('admin.order.index') }}" class="bg-[#DDA15E] rounded-lg p-4 shadow-md hover:bg-[#BC6C25] hover:text-[#FEFAE0] transition-colors duration-300">
                    <div class="flex items-center gap-2">
                        <div class="">
                            <i class="fas fa-receipt text-xl"></i>
                        </div>
                        <h2 class="text-lg font-semibold">Orders</h2>
                    </div>
                </a>

                <!-- Beschikbaarheid Card -->
                <a href="{{ route('admin.availability.index') }}" class="bg-[#DDA15E] rounded-lg p-4 shadow-md hover:bg-[#BC6C25] hover:text-[#FEFAE0] transition-colors duration-300">
                    <div class="flex items-center gap-2">
                        <div class="">
                            <i class="fas fa-calendar-alt text-xl"></i>
                        </div>
                        <h2 class="text-lg font-semibold">Beschikbaarheid plannen</h2>
                    </div>
                </a>

                <a href="#" class="bg-[#DDA15E] rounded-lg p-4 shadow-md hover:bg-[#BC6C25] hover:text-[#FEFAE0] transition-colors duration-300">
                    <div class="flex items-center gap-2">
                        <div class="">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                        <h2 class="text-lg font-semibold">Users</h2>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>