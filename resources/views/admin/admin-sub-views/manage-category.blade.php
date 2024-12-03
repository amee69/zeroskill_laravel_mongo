<x-guest-layout>
    <!-- Dashboard Layout -->
    <x-admin-layout>
        <x-adminCategory-layout>
            <x-slot:title>
                Manage Categories
            </x-slot:title>

            <h2 class="text-xl font-semibold mb-4">Manage Categories</h2>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Add Category Form -->
            <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
                @csrf
                <input type="text" name="name" placeholder="Category Name"
                    class="text-black border px-4 py-2 rounded w-full" required>
                <textarea name="description" placeholder="Category Description" class="text-black border px-4 py-2 rounded w-full"></textarea>
                <button type="submit" class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600">
                    Add Category
                </button>
            </form>

            <!-- Category Table -->
            <table class="w-full mt-6 border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">#</th>
                        <th class="border px-4 py-2">Category Name</th>
                        <th class="border px-4 py-2">Description</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">{{ $category->category_name }}</td>
                        <td class="border px-4 py-2">{{ $category->description }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-blue-500 hover:underline">
                                Edit
                            </a>
                            
                            <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this category?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $categories->links() }}
            </div>
        </x-adminCategory-layout>
    </x-admin-layout>
</x-guest-layout>
