<x-guest-layout>
    
    <x-admin-layout>
        <x-adminCategory-layout>


<div class=" mx-auto  shadow-lg rounded p-6">
    <h2 class="text-xl font-bold mb-4">Edit Category</h2>
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block  font-bold">Category Name</label>
            <input type="text" name="category_name" id="name" value="{{ $category->category_name }}" class="border px-4 py-2 rounded w-full text-black" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block font-bold">Description</label>
            <textarea name="description" id="description" class="border px-4 py-2 rounded w-full text-black" required>{{ $category->description }}</textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Update Category
        </button>
    </form>
</div>

</x-adminCategory-layout>

</x-admin-layout>
</x-guest-layout>
