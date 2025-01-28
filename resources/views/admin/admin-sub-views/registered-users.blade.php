<x-guest-layout>
    <x-admin-layout>
        <h1 class="text-2xl font-bold mb-4">Registered Users</h1>
        <p class="mb-4">This is the list of registered users:</p>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 p-3 bg-green-500 text-white rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-auto w-full border-collapse border border-gray-300 rounded-lg">
            <thead>
                <tr class="bg-black text-white">
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Number</th>
                    <th class="border border-gray-300 px-4 py-2">NIC</th>
                    <th class="border border-gray-300 px-4 py-2">Address</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allusers as $user)
                    <tr class="hover:bg-red-400">
                        <td class="border border-gray-300 px-4 py-2">{{ $user->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->number }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->nic }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->address }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $allusers->links() }}
        </div>
    </x-admin-layout>
</x-guest-layout>
