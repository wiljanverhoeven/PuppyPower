<x-app-layout>
    <div class="container mx-auto p-8">
        <div class="mb-8 bg-white p-6 rounded shadow">
            <h2 class="text-3xl font-semibold mb-4">Aanmelden voor de dagopvang</h2>
            <p class="text-gray-700">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </p>
        </div>
        <h1 class="text-4xl font-bold mb-6">Dagopvang Kennismakingsgesprek Inplannen</h1>
        
        <!--success message-->
        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('dagopvang.store') }}">
            @csrf

            <!--name text field-->
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Naam</label>
                <input type="text" name="name" class="w-full p-2 border rounded" required>
            </div>

            <!--email text field-->
            <div class="mb-4">
                <label class="block mb-1 font-semibold">E-mail</label>
                <input type="email" name="email" class="w-full p-2 border rounded" required>
            </div>

            <!--phone number text field-->
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Telefoonnummer</label>
                <input type="text" name="phone" class="w-full p-2 border rounded" required>
            </div>

            <!--available dates-->
            <div class="mb-4">
                <label for="date" class="block mb-2 font-semibold">Kies een dag:</label>
                <select id="date" name="date" class="w-full p-2 border rounded mb-4" required>
                    @foreach($availableDates as $date)
                        <option value="{{ $date }}">{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="timeslot" class="block mb-2 font-semibold">Kies een tijdslot:</label>
                <select id="timeslot" name="timeslot" class="w-full p-2 border rounded mb-4" required>
                    <!--Filled with JS-->
                </select>
            </div>

            <button type="submit" class="bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] py-2 px-4 rounded">
                Plan afspraak
            </button>
        </form>
    </div>

    <script>
        const availabilityData = @json($groupedTimeslots); //sort per day

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

        document.getElementById('date').dispatchEvent(new Event('change'));
    </script>
</x-app-layout>
