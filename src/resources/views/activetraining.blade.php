<x-app-layout>
    <h1>Active Training</h1>
    <ul>
        @foreach ($modules as $mymodule)
            <li id="module" class="flex flex-col mb-4 p-4 border rounded-lg">
                <div>Titel: {{ $mymodule->module->name }}</div>
                <div>description: {{ $mymodule->module->description }}</div>
                <a href="{{ route('mymodules.startModule', $mymodule->mymodule_id) }}"
                   class="bg-blue-600 p-4 text-white rounded-lg hover:bg-blue-700 inline-block">
                    Start Module
                </a>
            </li>
        @endforeach
    </ul>
</x-app-layout>


