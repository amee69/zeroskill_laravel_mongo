<x-guest-layout>
    <!-- resources/views/admin/dashboard.blade.php -->
    <x-admin-layout>
        <h1 class="text-2xl font-bold mb-4">Registered Users</h1>
        <p>This is the list of registered users:</p>
        
        <table class="table-auto w-full border-collapse border border-gray-300  rounded-lg">
            <thead>
                <tr class="bg-black">
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
                    <tr>
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
        <div class="mt-4">
            {{ $allusers->links() }}
        </div>
    </x-admin-layout>
</x-guest-layout>
