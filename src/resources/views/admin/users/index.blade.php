<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="w-full mb-6 text-center">
            <h1 class="text-2xl font-bold">User Beheer</h1>
        </div>

        <div class="bg-[#606C38] rounded-lg shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#283618] text-[#FEFAE0]">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">ID</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Gemaakt Op</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Bekijk Trainingen</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#DDA15E]/20">
                        @foreach ($users as $user)
                        <tr class="hover:bg-[#606C38]/90 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-[#FEFAE0]">{{ $user->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-[#FEFAE0]">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-[#FEFAE0]">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-[#FEFAE0]">{{ $user->created_at->format('d-m-Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('admin.users.checkprogress', $user->id) }}"
                                   class="hover:text-[#BC6C25] text-[#DDA15E] px-3 py-1 rounded text-sm transition-all ease-in-out">
                                    Bekijk Trainingen
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class=" hover:text-red-400 text-red-300 px-3 py-1 rounded text-sm transition-all ease-in-out">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>