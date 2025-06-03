<x-app-layout>
    <div>Titel: {{ $mymodule->module->name }}</div>
    <div>description: {{ $mymodule->module->description }}</div>
    <form action="{{ route('mymodules.updateModuleStatus', $mymodule->mymodule_id) }}" method="POST" style="display: inline;">
        @csrf
        @method('PATCH')
        <button class="bg-blue-600 p-4 text-white rounded-lg hover:bg-blue-700" type="submit">
            Markeer als voltooid
        </button>
    </form>
</x-app-layout>
