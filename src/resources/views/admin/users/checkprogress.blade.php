<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">Voortgang van {{ $user->name }}</h1>

    @if ($mymodules->isEmpty())
        <p class="text-gray-600">Deze gebruiker heeft nog geen modules.</p>
    @else
        <table class="min-w-full bg-white border">
            <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border">Training Name</th>
                <th class="px-4 py-2 border">Module Title</th>
                <th class="px-4 py-2 border">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($mymodules as $mymodule)
                <tr>
                    <td class="px-4 py-2 border">{{ $mymodule->module->training->name }}</td>
                    <td class="px-4 py-2 border">{{ $mymodule->module->name }}</td>
                    <td class="px-4 py-2 border">
                        @if ($mymodule->status === 'completed')
                            <span class="text-green-600 font-semibold">✔ Voltooid</span>
                        @elseif ($mymodule->status === 'started')
                            <span class="text-yellow-600 font-semibold">Started</span>
                        @else
                            <span class="text-red-600 font-semibold">✖ Niet voltooid</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</x-app-layout>





