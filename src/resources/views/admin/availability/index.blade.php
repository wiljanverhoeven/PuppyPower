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
                        <span class="ml-2">Herhaal elke week (10 weken)</span>
                    </label>
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
                                    <div
                                        class="flex justify-between items-center px-4 py-3 border-b last:border-0 hover:bg-gray-100 transition">
                                        <div class="flex-1">
                                            <div class="text-gray-600 text-sm mb-1">
                                                {{ \Carbon\Carbon::parse($availability->start_time)->format('H:i') }} - 
                                                {{ \Carbon\Carbon::parse($availability->end_time)->format('H:i') }}
                                            </div>
                                            <span
                                                class="inline-block text-xs px-3 py-1 rounded-full bg-green-100 text-green-800">
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

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                events: {!! $events !!},
                selectable: true,
                selectMirror: true,
                editable: false,
                validRange: {
                    start: new Date()
                },
                select: function(info) {
                    fillFormFromSelection(info);
                    showSelectedInfo(info);
                    setTimeout(function() {
                        calendar.unselect();
                    }, 100);
                    switchToCreateMode();
                },
                eventClick: function(info) {
                    if (confirm('Wil je deze beschikbaarheid bewerken?')) {
                        fillFormFromEvent(info.event);
                        showSelectedInfo({
                            start: info.event.start,
                            end: info.event.end
                        });
                        switchToEditMode(info.event);
                    }
                },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                height: 'auto',
                slotMinTime: '00:00:00',
                slotMaxTime: '24:00:00',
                locale: 'nl',
                slotDuration: '00:30:00',
                snapDuration: '00:15:00',
                weekends: true,
                scrollTime: '08:00:00',
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                }
            });
            calendar.render();
        });

        function fillFormFromSelection(info) {
            var startDate = new Date(info.start);
            var endDate = new Date(info.end);
            var dateStr = startDate.getFullYear() + '-' + 
                        String(startDate.getMonth() + 1).padStart(2, '0') + '-' + 
                        String(startDate.getDate()).padStart(2, '0');
            var startTimeStr = String(startDate.getHours()).padStart(2, '0') + ':' + 
                            String(startDate.getMinutes()).padStart(2, '0');
            var endTimeStr = String(endDate.getHours()).padStart(2, '0') + ':' + 
                            String(endDate.getMinutes()).padStart(2, '0');
            document.getElementById('date').value = dateStr;
            document.getElementById('start_time').value = startTimeStr;
            document.getElementById('end_time').value = endTimeStr;

            document.querySelector('input[name="repeat_weekly"]').checked = false;

            clearHiddenInputs();
        }

        function fillFormFromEvent(event) {
            var startDate = event.start;
            var endDate = event.end;
            var dateStr = startDate.getFullYear() + '-' + 
                        String(startDate.getMonth() + 1).padStart(2, '0') + '-' + 
                        String(startDate.getDate()).padStart(2, '0');
            var startTimeStr = String(startDate.getHours()).padStart(2, '0') + ':' + 
                            String(startDate.getMinutes()).padStart(2, '0');
            var endTimeStr = String(endDate.getHours()).padStart(2, '0') + ':' + 
                            String(endDate.getMinutes()).padStart(2, '0');
            document.getElementById('date').value = dateStr;
            document.getElementById('start_time').value = startTimeStr;
            document.getElementById('end_time').value = endTimeStr;

            document.querySelector('input[name="repeat_weekly"]').checked = false;

            var form = document.getElementById('availability-form');
            var hiddenId = form.querySelector('input[name="availability_id"]');
            if (!hiddenId) {
                hiddenId = document.createElement('input');
                hiddenId.type = 'hidden';
                hiddenId.name = 'availability_id';
                form.appendChild(hiddenId);
            }
            hiddenId.value = event.id;
        }

        function switchToEditMode(event) {
            var form = document.getElementById('availability-form');
            form.action = `/admin/availability/${event.id}`;
            form.method = 'POST';

            var methodInput = form.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                form.appendChild(methodInput);
            }
            methodInput.value = 'PUT';

            var submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.textContent = 'Beschikbaarheid Bijwerken';

            if (!document.getElementById('cancel-edit')) {
                var cancelBtn = document.createElement('button');
                cancelBtn.type = 'button';
                cancelBtn.id = 'cancel-edit';
                cancelBtn.className = 'w-full mt-3 bg-gray-600 hover:bg-gray-700 text-white py-2 rounded transition';
                cancelBtn.textContent = 'Bewerking annuleren';
                cancelBtn.onclick = switchToCreateMode;
                form.appendChild(cancelBtn);
            }
        }

        function switchToCreateMode() {
            var form = document.getElementById('availability-form');
            form.action = "{{ route('admin.availability.store') }}";
            form.method = 'POST';

            var methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) {
                methodInput.remove();
            }

            clearHiddenInputs();

            form.reset();

            var submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.textContent = 'Beschikbaarheid Opslaan';

            document.getElementById('selected-info').classList.add('hidden');

            var cancelBtn = document.getElementById('cancel-edit');
            if (cancelBtn) {
                cancelBtn.remove();
            }
        }

        function clearHiddenInputs() {
            var form = document.getElementById('availability-form');
            var hiddenId = form.querySelector('input[name="availability_id"]');
            if (hiddenId) {
                hiddenId.remove();
            }
        }

        function showSelectedInfo(info) {
            var startDate = new Date(info.start);
            var endDate = new Date(info.end);
            var dateStr = startDate.toLocaleDateString('nl-NL');
            var startTimeStr = startDate.toLocaleTimeString('nl-NL', {hour: '2-digit', minute: '2-digit'});
            var endTimeStr = endDate.toLocaleTimeString('nl-NL', {hour: '2-digit', minute: '2-digit'});
            var el = document.getElementById('selected-info');
            document.getElementById('selected-details').innerHTML = 
                dateStr + ' van ' + startTimeStr + ' tot ' + endTimeStr;
            el.classList.remove('hidden');
        }

        function clearForm() {
            switchToCreateMode();
        }
    </script>

</x-app-layout>
``
