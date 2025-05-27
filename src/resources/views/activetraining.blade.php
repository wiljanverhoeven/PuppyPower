<x-app-layout>
    <h1>Active Training</h1>
    <ul>
        @foreach ($modules as $mymodule)
            <li class="flex flex-col mb-4 p-4 border rounded-lg">
                <div>Titel: {{ $mymodule->module->name }}</div>
                <div>description: {{ $mymodule->module->description }}</div>
                <form action="{{ route('mymodules.update', $mymodule->mymodule_id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <button class="bg-blue-600 p-4 text-white rounded-lg hover:bg-blue-700" type="submit">
                        Klaar
                    </button>
                </form>
            </li>
        @endforeach
    </ul>
</x-app-layout>
