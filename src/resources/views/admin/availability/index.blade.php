<x-app-layout>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
    
    <div class="grid grid-cols-1 md:grid-cols-[1fr_350px] gap-5 my-5">
        <div class="min-h-[600px]">
            <h2 class="text-2xl font-semibold mb-2">Beschikbaarheid Kalender</h2>
            <p class="mb-4"><strong>Instructies:</strong> Klik en sleep op de kalender om een nieuwe beschikbaarheid te selecteren, of gebruik het formulier rechts.</p>
            <div id='calendar'></div>
        </div>
        
        <div class="bg-gray-100 p-5 rounded-lg h-fit">
            <h3 class="text-xl font-semibold mb-4">Nieuwe Beschikbaarheid</h3>
            
            <div id="selected-info" class="bg-blue-100 p-3 rounded mb-4 hidden">
                <strong>Geselecteerd:</strong>
                <div id="selected-details"></div>
            </div>
            
            <form method="POST" action="{{ route('admin.availability.store') }}" id="availability-form">
                @csrf
                
                <div class="mb-4">
                    <label for="date" class="block mb-1 font-semibold">Datum:</label>
                    <input type="date" name="date" id="date" required
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <div class="mb-4">
                    <label for="start_time" class="block mb-1 font-semibold">Starttijd:</label>
                    <input type="time" name="start_time" id="start_time" required
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <div class="mb-4">
                    <label for="end_time" class="block mb-1 font-semibold">Eindtijd:</label>
                    <input type="time" name="end_time" id="end_time" required
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                
                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="repeat_weekly" value="1" class="form-checkbox text-blue-600" />
                        <span class="ml-2">Herhaal meerdere weken</span>
                    </label>
                </div>

                <div class="mb-4 hidden" id="repeat_weeks_container">
                    <label for="repeat_weeks" class="block mb-1 font-semibold">Aantal weken herhalen:</label>
                    <input type="number" name="repeat_weeks" id="repeat_weeks" min="1" max="52" value="1"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded transition">
                    Beschikbaarheid Opslaan
                </button>
                <button type="button" onclick="clearForm()"
                    class="w-full mt-3 bg-gray-600 hover:bg-gray-700 text-white py-2 rounded transition">
                    Formulier Wissen
                </button>
            </form>
            
            <div class="mt-6 bg-white rounded-lg border border-gray-300 max-h-[400px] overflow-y-auto">
                <div class="sticky top-0 bg-gray-100 border-b border-gray-300 rounded-t-lg p-4 z-10">
                    <h4 class="m-0 text-lg font-semibold">Huidige Beschikbaarheden</h4>
                    @php
                        $totalAvailable = $availabilities->count();
                        $totalUnavailable = 0;
                    @endphp
                    <div class="bg-green-50 text-green-700 p-2 rounded mt-2 text-sm font-medium">
                        <strong>{{ $totalAvailable }}</strong> beschikbaar
                    </div>
                </div>
                
                <div>
                    @if($availabilities->count() > 0)
                        @php
                            $groupedAvailabilities = $availabilities->groupBy('date');
                        @endphp
                        
                        @foreach($groupedAvailabilities as $date => $dayAvailabilities)
                            <div class="border-b border-gray-200 last:border-0">
                                <div class="sticky top-[62px] bg-gray-100 border-b border-gray-300 p-3 font-semibold text-gray-700 z-5">
                                    {{ \Carbon\Carbon::parse($date)->locale('nl')->isoFormat('dddd D MMMM YYYY') }}
                                </div>
                                
                                @foreach($dayAvailabilities->sortBy('start_time') as $availability)
                                    <div class="flex justify-between items-center px-4 py-3 border-b last:border-0 hover:bg-gray-100 transition">
                                        <div class="flex-1">
                                            <div class="text-gray-600 text-sm mb-1">
                                                {{ \Carbon\Carbon::parse($availability->start_time)->format('H:i') }} - 
                                                {{ \Carbon\Carbon::parse($availability->end_time)->format('H:i') }}
                                            </div>
                                            <span class="inline-block text-xs px-3 py-1 rounded-full bg-green-100 text-green-800">
                                                ✓ Beschikbaar
                                            </span>
                                        </div>
                                        <form method="POST" action="{{ route('admin.availability.destroy', $availability->id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-xs transition"
                                                onclick="return confirm('Weet je zeker dat je deze beschikbaarheid wilt verwijderen?')" title="Verwijderen">
                                                🗑️
                                            </button>
                                        </form>
                                        
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    @else
                        <div class="py-10 text-center text-gray-500 italic">
                            Nog geen beschikbaarheden ingesteld
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-lg">
            <h3 class="text-xl font-bold mb-4">Beschikbaarheid Bewerken</h3>
            <form id="edit-form" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit-id">
                <div class="mb-4">
                    <label for="edit-date" class="block mb-1 font-semibold">Datum:</label>
                    <input type="date" id="edit-date" name="date" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="edit-start" class="block mb-1 font-semibold">Starttijd:</label>
                    <input type="time" id="edit-start" name="start_time" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="edit-end" class="block mb-1 font-semibold">Eindtijd:</label>
                    <input type="time" id="edit-end" name="end_time" class="w-full p-2 border rounded" required>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-500 text-white rounded">Annuleren</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Opslaan</button>
                </div>
            </form>
        </div>
    </div>
        @php
        $calendarEvents = $availabilities->map(function($availability) {
            return [
                'id' => $availability->id,
                'title' => 'Beschikbaar',
                'start' => $availability->date . 'T' . substr($availability->start_time, 0, 5),
                'end' => $availability->date . 'T' . substr($availability->end_time, 0, 5),
                'allDay' => false,
                'color' => '#34D399',
            ];
        });
        @endphp

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
        const availabilityEvents = @json($calendarEvents);

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function openEditFromList(id, date, start, end) {
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-date').value = date;
            document.getElementById('edit-start').value = start;
            document.getElementById('edit-end').value = end;
            document.getElementById('edit-form').action = `/admin/availability/${id}`;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function clearForm() {
            document.getElementById('availability-form').reset();
            document.getElementById('selected-info').classList.add('hidden');
            document.getElementById('selected-details').innerHTML = '';
        }

        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                selectable: true,
                selectMirror: true,
                editable: false,
                locale: 'nl',
                slotMinTime: '06:00:00',
                slotMaxTime: '22:00:00',
                allDaySlot: false,
                slotDuration: '00:30:00',
                snapDuration: '00:15:00',
                scrollTime: '08:00:00',
                weekends: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridWeek,timeGridDay'
                },
                selectConstraint: {
                    start: new Date().toISOString().split('T')[0],
                    end: '2100-01-01'
                },
                select: function (info) {
                    const start = info.start;
                    const end = info.end;

                    const dateStr = start.toLocaleDateString('en-CA');
                    const startTimeStr = start.toTimeString().substr(0, 5);
                    const endTimeStr = end.toTimeString().substr(0, 5);

                    document.getElementById('date').value = dateStr;
                    document.getElementById('start_time').value = startTimeStr;
                    document.getElementById('end_time').value = endTimeStr;

                    // Toon geselecteerde periode boven het formulier
                    const selectedInfo = document.getElementById('selected-info');
                    const selectedDetails = document.getElementById('selected-details');
                    selectedDetails.innerHTML = `<p><strong>Datum:</strong> ${dateStr}</p>
                                                <p><strong>Tijd:</strong> ${startTimeStr} - ${endTimeStr}</p>`;
                    selectedInfo.classList.remove('hidden');

                    setTimeout(() => {
                        calendar.unselect();
                    }, 1000);
                },
                selectAllow: function(selectInfo) {
                    return selectInfo.start >= new Date();
                },
                eventClick: function(info) {
                    const event = info.event;
                    const start = new Date(event.start);
                    const end = new Date(event.end);

                    document.getElementById('edit-id').value = event.id;
                    document.getElementById('edit-date').value = start.toISOString().split('T')[0];
                    document.getElementById('edit-start').value = start.toTimeString().substr(0, 5);
                    document.getElementById('edit-end').value = end.toTimeString().substr(0, 5);

                    document.getElementById('edit-form').action = `/admin/availability/${event.id}`;
                    document.getElementById('editModal').classList.remove('hidden');
                },
                events: availabilityEvents,
            });

            calendar.render();
        });

        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.querySelector('input[name="repeat_weekly"]');
            const weeksContainer = document.getElementById('repeat_weeks_container');

            function toggleWeeksInput() {
                if (checkbox.checked) {
                    weeksContainer.classList.remove('hidden');
                } else {
                    weeksContainer.classList.add('hidden');
                    // Optioneel: reset het aantal weken naar 1 als verbergen
                    document.getElementById('repeat_weeks').value = 1;
                }
            }

            // Initial check bij laden pagina
            toggleWeeksInput();

            // Luister naar veranderingen op checkbox
            checkbox.addEventListener('change', toggleWeeksInput);
        });
    </script>


</x-app-layout>
