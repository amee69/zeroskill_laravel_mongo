<x-guest-layout>
    <!-- Dashboard Layout -->
    <x-admin-layout>
        <x-adminCategory-layout>
            <x-slot:title>
                Manage Products
            </x-slot:title>

            <h2 class="text-xl font-semibold mb-4">Manage Products</h2>

            <!-- Add Product Form -->
            {{-- <form method="POST" action="" enctype="multipart/form-data" class="space-y-4 text-black">
                @csrf
            
                <!-- Product Name -->
                <input type="text" name="name" placeholder="Product Name" class="border px-4 py-2 rounded w-full" required>
            
                <!-- Product Description -->
                <textarea name="description" placeholder="Product Description" class="border px-4 py-2 rounded w-full"></textarea>
            
                <!-- Product Price -->
                <input type="number" name="price" placeholder="Price" class="border px-4 py-2 rounded w-full" required>
            
                <!-- Product Stock -->
                <input type="number" name="stock" placeholder="Stock" class="border px-4 py-2 rounded w-full" required>
            
                <!-- Categories Dropdown -->
                <label for="category" class="block font-bold text-white">Category:</label>
                <select name="category_id" id="category" class="border px-4 py-2 rounded w-full" required>
                    <option value="" disabled selected>Select a category</option>
                    
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
                
            
                <!-- Image Upload Field -->
                <label for="images" class="block text-white">Product Images:</label>
                <input type="file" name="images[]" id="images" multiple accept="image/*" class="border px-4 py-2 rounded w-full text-black">
            
                <!-- Submit Button -->
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Add Product
                </button>
            </form> --}}

            <livewire:manage-products />

            
            
            <!-- Product Table -->
            <table class="w-full mt-6 border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">#</th>
                        <th class="border px-4 py-2">Category</th>
                        <th class="border px-4 py-2">Product Name</th>
                        <th class="border px-4 py-2">Description</th>
                        <th class="border px-4 py-2">Price</th>
                        <th class="border px-4 py-2">Stock</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
            <tr>
                
                <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                <td class="border px-4 py-2">
                    {{ $product->category ? $product->category->category_name : 'No Category' }}
                </td>
                <td class="border px-4 py-2">{{ $product->product_name }}</td>
                <td class="border px-4 py-2">{{ $product->description }}</td>
                <td class="border px-4 py-2">Rs.{{ number_format($product->price, 2) }}</td>
                <td class="border px-4 py-2">{{ $product->stock }}</td>
                <td class="border px-4 py-2">
                    <a href="" class="text-blue-500 hover:underline">
                        Edit
                    </a>
                    <form action="{{ route('admin.products.delete', $product->_id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE') <!-- Use DELETE method -->
                        <button type="submit" class="text-red-500 hover:underline">
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
    {{ $products->links() }}
</div>
        </x-adminCategory-layout>

    </x-admin-layout>
</x-guest-layout>
