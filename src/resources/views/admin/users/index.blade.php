<x-app-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">User Management</h1>

        <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded">
            <thead>
            <tr class="bg-gray-100 text-left text-sm uppercase tracking-wider">
                <th class="px-4 py-2 border-b">ID</th>
                <th class="px-4 py-2 border-b">Name</th>
                <th class="px-4 py-2 border-b">Email</th>
                <th class="px-4 py-2 border-b">Created At</th>
                <th class="px-4 py-2 border-b">Bekijk Trainingen</th>
                <th class="px-4 py-2 border-b">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b">{{ $user->id }}</td>
                    <td class="px-4 py-2 border-b">{{ $user->name }}</td>
                    <td class="px-4 py-2 border-b">{{ $user->email }}</td>
                    <td class="px-4 py-2 border-b">{{ $user->created_at->format('d-m-Y H:i') }}</td>
                    <td class="px-4 py-2 border-b">
                        <a href="{{ route('admin.users.checkprogress', $user->id) }}"
                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                            Bekijk Trainingen
                        </a>
                    </td>
                    <td class="px-4 py-2 border-b">
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
