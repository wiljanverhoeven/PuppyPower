<x-app-layout>
    <div class="w-full my-6 text-center">
            <h1 class="text-2xl font-bold">Dagopvang Kennismakingsgesprek</h1>
    </div>
    <div class=" w-full flex flex-col md:flex-row items-start justify-center gap-6 p-6">
        <!-- Info Card -->
        <div class="bg-[#606C38] text-[#FEFAE0] w-full md:w-1/3 rounded-lg shadow-lg p-6 mb-6">
            <h2 class="text-xl font-semibold mb-3 flex justify-start items-center gap-2">Aanmelden voor de dagopvang <i class="fa-solid fa-circle-info"></i></h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Container -->
        <div class="bg-[#606C38] w-full md:w-1/2 rounded-lg shadow-lg p-6">
            <form method="POST" action="{{ route('dagopvang.store') }}">
                @csrf
                <h2 class="text-xl text-[#FEFAE0] font-semibold mb-3 flex justify-start items-center gap-2">Maak een afspraak</h2>

                <!-- Name Field -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-[#FEFAE0] mb-1">Naam</label>
                    <input type="text" name="name" required
                           class="w-full rounded-lg border-none bg-[#FEFAE0] focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] p-2">
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-[#FEFAE0] mb-1">E-mail</label>
                    <input type="email" name="email" required
                           class="w-full rounded-lg border-none bg-[#FEFAE0] focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] p-2">
                </div>

                <!-- Phone Field -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-[#FEFAE0] mb-1">Telefoonnummer</label>
                    <input type="text" name="phone" required
                           class="w-full rounded-lg border-none bg-[#FEFAE0] focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] p-2">
                </div>

                <!-- Date Selection -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-[#FEFAE0] mb-1">Kies een dag:</label>
                    <select name="date" id="date" required
                            class="w-full rounded-lg border-none bg-[#FEFAE0] focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] p-2">
                        @foreach($availableDates as $date)
                            <option value="{{ $date }}">{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Timeslot Selection -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-[#FEFAE0] mb-1">Kies een tijdslot:</label>
                    <select id="timeslot" name="timeslot" required
                            class="w-full rounded-lg border-none bg-[#FEFAE0] focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] p-2">
                        <!-- Filled with JS -->
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" 
                            class="w-full px-6 py-2 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] rounded-lg transition-all ease-in-out font-medium">
                        Plan afspraak
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const availabilityData = @json($groupedTimeslots);

        document.getElementById('date').addEventListener('change', function () {
            const selectedDate = this.value;
            const timeslotSelect = document.getElementById('timeslot');
            timeslotSelect.innerHTML = '';

            if (availabilityData[selectedDate]) {
                availabilityData[selectedDate].forEach(function (slot) {
                    const option = document.createElement('option');
                    option.value = slot.start;
                    option.text = `${slot.start_time} - ${slot.end_time}`;
                    timeslotSelect.appendChild(option);
                });
            }
        });

        // Trigger initial population
        document.getElementById('date').dispatchEvent(new Event('change'));
    </script>
</x-app-layout>