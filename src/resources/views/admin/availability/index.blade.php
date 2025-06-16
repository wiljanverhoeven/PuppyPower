<x-app-layout>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
    
    <div class="container mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-[1fr_350px] gap-6">
            {{-- calendar --}}
            <div class="min-h-[600px]">
                <div class="w-full mb-6">
                    <h2 class="text-2xl font-bold">Beschikbaarheid Kalender</h2>
                    <p class= mt-2"><strong>Instructies:</strong> Klik en sleep op de kalender om een nieuwe beschikbaarheid te selecteren, of gebruik het formulier rechts. Pas aan door op de gewilde beschikbaarheid te klikken in de kalender en verwijder in de lijst.</p>
                </div>
                <div id='calendar' class="bg-[#606C38] text-[#FEFAE0] rounded-lg shadow-lg p-4"></div>
            </div>
            
            {{-- beschikbaarhaid --}}
            <div class="bg-[#606C38] text-[#FEFAE0] p-6 rounded-lg shadow-lg h-fit">
                <h3 class="text-xl font-bold mb-4">Nieuwe Beschikbaarheid</h3>
                
                <div id="selected-info" class="bg-[#DDA15E] text-[#FEFAE0] p-3 rounded mb-4 hidden">
                    <strong>Geselecteerd:</strong>
                    <div id="selected-details"></div>
                </div>
                
                <form method="POST" action="{{ route('admin.availability.store') }}" id="availability-form" class="space-y-4">
                    @csrf
                    <div>
                        <label for="date" class="block text-sm font-medium">Datum:</label>
                        <input type="date" name="date" id="date" required
                            class="mt-1 block w-full rounded-lg border-none text-black bg-[#FEFAE0] shadow-sm focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] p-2" />
                    </div>
                    
                    <div>
                        <label for="start_time" class="block text-sm font-medium">Starttijd:</label>
                        <input type="time" name="start_time" id="start_time" required
                            class="mt-1 block w-full rounded-lg border-none text-black bg-[#FEFAE0] shadow-sm focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] p-2" />
                    </div>
                    
                    <div>
                        <label for="end_time" class="block text-sm font-medium">Eindtijd:</label>
                        <input type="time" name="end_time" id="end_time" required
                            class="mt-1 block w-full rounded-lg border-none text-black bg-[#FEFAE0] shadow-sm focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] p-2" />
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" name="repeat_weekly" value="1" id="repeat_weekly" 
                            class="h-4 w-4 rounded border-[#DDA15E] text-[#BC6C25] focus:ring-[#BC6C25]" />
                        <label for="repeat_weekly" class="ml-2 block text-sm">Herhaal meerdere weken</label>
                    </div>
                    
                    <div class="mb-4 hidden" id="repeat_weeks_container">
                        <label for="repeat_weeks" class="block text-sm font-medium">Aantal weken herhalen:</label>
                        <input type="number" name="repeat_weeks" id="repeat_weeks" min="1" max="52" value="1"
                            class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] shadow-sm focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] focus:ring-opacity-50 p-2" />
                    </div>
                    
                    <div class="space-y-3">
                        <button type="submit" class="w-full px-4 py-2 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] rounded-md transition-colors duration-200">
                            Beschikbaarheid Opslaan
                        </button>
                        <button type="button" onclick="clearForm()"
                            class="w-full px-4 py-2 bg-red-500 hover:bg-red-800 text-[#FEFAE0] rounded-md transition-colors duration-200">
                            Formulier Wissen
                        </button>
                    </div>
                </form>
                
                <div class="mt-6 bg-white rounded-lg border border-[#DDA15E] shadow-sm max-h-[400px] overflow-y-auto">
                    <div class="sticky top-0 bg-[#FEFAE0] border-b border-[#DDA15E] rounded-t-lg p-4 z-10">
                        <h4 class="m-0 text-lg font-semibold text-[#606C38]">Huidige Beschikbaarheden</h4>
                        @php
                            $totalAvailable = $availabilities->count();
                        @endphp
                        <div class="bg-green-100 text-green-800 p-2 rounded mt-2 text-sm font-medium">
                            <strong>{{ $totalAvailable }}</strong> beschikbaar
                        </div>
                    </div>
                    
                    {{-- baschikbaarhaid list --}}
                    <div>
                        @if($availabilities->count() > 0)
                            @php
                                $groupedAvailabilities = $availabilities->groupBy('date');
                            @endphp
                            
                            @foreach($groupedAvailabilities as $date => $dayAvailabilities)
                                <div class="border-b border-[#DDA15E]/30 last:border-0">
                                    <div class="sticky top-[62px] bg-[#FEFAE0] border-b border-[#DDA15E]/30 p-3 font-semibold text-[#606C38] z-5">
                                        {{ \Carbon\Carbon::parse($date)->locale('nl')->isoFormat('dddd D MMMM YYYY') }}
                                    </div>
                                    
                                    @foreach($dayAvailabilities->sortBy('start_time') as $availability)
                                        <div class="flex justify-between items-center px-4 py-3 border-b border-[#DDA15E]/20 last:border-0 hover:bg-[#FEFAE0]/50 transition">
                                            <div class="flex-1">
                                                <div class= text-sm mb-1">
                                                    {{ \Carbon\Carbon::parse($availability->start_time)->format('H:i') }} - 
                                                    {{ \Carbon\Carbon::parse($availability->end_time)->format('H:i') }}
                                                </div>
                                                <span class="inline-block text-xs px-3 py-1 rounded-full bg-green-100 text-green-800">
                                                    ✓ Beschikbaar
                                                </span>
                                            </div>
                                            <form method="POST" action="{{ route('admin.availability.destroy', $availability->id) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-[#FEFAE0] bg-[#BC6C25] hover:bg-[#283618] px-3 py-1 rounded text-xs transition"
                                                    onclick="return confirm('Weet je zeker dat je deze beschikbaarheid wilt verwijderen?')" title="Verwijderen">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        @else
                            <div class="py-10 text-center/50 italic">
                                Nog geen beschikbaarheden ingesteld
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- edit modal --}}
    <div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
        <div class="bg-[#FEFAE0] p-6 rounded-lg shadow-xl w-full max-w-md border border-[#DDA15E]">
            <h3 class="text-xl font-bold text-[#606C38] mb-4">Beschikbaarheid Bewerken</h3>
            
            <form id="edit-form" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit-id">
                <div>
                    <label for="edit-date" class="block text-sm font-medium">Datum:</label>
                    <input type="date" id="edit-date" name="date" required
                        class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] shadow-sm focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] focus:ring-opacity-50 p-2">
                </div>
                <div>
                    <label for="edit-start" class="block text-sm font-medium">Starttijd:</label>
                    <input type="time" id="edit-start" name="start_time" required
                        class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] shadow-sm focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] focus:ring-opacity-50 p-2">
                </div>
                <div>
                    <label for="edit-end" class="block text-sm font-medium">Eindtijd:</label>
                    <input type="time" id="edit-end" name="end_time" required
                        class="mt-1 block w-full rounded-md border-[#DDA15E] bg-[#FEFAE0] shadow-sm focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] focus:ring-opacity-50 p-2">
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeEditModal()" 
                        class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-[#FEFAE0] rounded-md transition-colors duration-200">
                        Annuleren
                    </button>
                    <button type="submit" 
                        class="px-4 py-2 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] rounded-md transition-colors duration-200">
                        Opslaan
                    </button>
                </div>
            </form>

            <form id="delete-form" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <input type="hidden" id="delete-id" name="availability_id">
                <button type="submit"
                        class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-[#FEFAE0] rounded-md transition-colors duration-200"
                        onclick="return confirm('Weet je zeker dat je deze beschikbaarheid wilt verwijderen?')">
                    <i class="fas fa-trash mr-2"></i> Verwijderen
                </button>
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
            'color' => '#606C38',
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
                    document.getElementById('delete-form').action = `/admin/availability/${event.id}`;

                    document.getElementById('editModal').classList.remove('hidden');
                },
                events: availabilityEvents,
            });

            calendar.render();

            // Toggle repeat weeks input
            const checkbox = document.querySelector('input[name="repeat_weekly"]');
            const weeksContainer = document.getElementById('repeat_weeks_container');
            
            function toggleWeeksInput() {
                if (checkbox.checked) {
                    weeksContainer.classList.remove('hidden');
                } else {
                    weeksContainer.classList.add('hidden');
                    document.getElementById('repeat_weeks').value = 1;
                }
            }

            toggleWeeksInput();
            checkbox.addEventListener('change', toggleWeeksInput);
        });
    </script>

    <style>
.fc-button {
    background-color: #DDA15E !important;
    border: none !important;
    color: #FEFAE0 !important;
    border-radius: 0.375rem !important;
}

.fc-button:hover {
    background-color: #BC6C25 !important;
    border: none !important;
}

.fc-button:disabled {
    background-color: #606C38 !important;
    opacity: 0.6 !important;
}

.fc-button-active {
    background-color: #BC6C25 !important;
    border: none !important;
}

.fc-toolbar-title {
    color: #FEFAE0 !important;
    font-weight: bold !important;
}

.fc-col-header {
    background-color: #283618 !important;
    color: #FEFAE0 !important;
}

.fc-timegrid-slot {
    border-color: #DDA15E !important;
}

.fc {
    background-color: #606C38 !important;
}
.fc-view-harness {
    background-color: #FEFAE0 !important;
}

.fc-scrollgrid {
    background-color: #FEFAE0 !important;
    color: #DDA15E !important;
}
</style>
</x-app-layout>