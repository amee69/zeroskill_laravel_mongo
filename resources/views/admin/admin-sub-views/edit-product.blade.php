<x-guest-layout>
    <x-admin-layout>
        <x-adminCategory-layout>

            <div class="mx-auto shadow-lg rounded p-6">
                <h2 class="text-xl font-bold mb-4">Edit Product</h2>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 border border-green-500 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-4 px-4 py-2 bg-red-100 text-red-700 border border-red-500 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.product.update', $product->_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Product Name -->
                    <div class="mb-4">
                        <label for="product_name" class="block font-bold">Product Name</label>
                        <input type="text" name="product_name" id="product_name" value="{{ old('product_name', $product->product_name) }}" class="border px-4 py-2 rounded w-full text-black" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="block font-bold">Description</label>
                        <textarea name="description" id="description" class="border px-4 py-2 rounded w-full text-black" required>{{ old('description', $product->description) }}</textarea>
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <label for="price" class="block font-bold">Price</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" class="border px-4 py-2 rounded w-full text-black" required>
                    </div>

                    <!-- Stock -->
                    <div class="mb-4">
                        <label for="stock" class="block font-bold">Stock</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" class="border px-4 py-2 rounded w-full text-black" required>
                    </div>

                    <!-- Category Dropdown -->
                    <div class="mb-4">
                        <label for="category_id" class="block font-bold">Category</label>
                        <select name="category_id" id="category_id" class="border px-4 py-2 rounded w-full text-black" required>
                            <option value="" disabled>Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->_id }}" {{ old('category_id', $product->category_id) == $category->_id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Display Existing Images -->
                    <div class="mb-4">
                        <label class="block font-bold mb-2">Current Images</label>
                        <div class="flex space-x-4">
                            @foreach ($product->images as $image)
                                <div>
                                    <img src="{{ asset($image) }}" alt="Product Image" class="w-32 h-32 object-cover rounded border">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Upload New Images -->
                    <div class="mb-4">
                        <label for="images" class="block font-bold mb-2">Upload New Images</label>
                        <input type="file" name="images[]" id="images" multiple accept="image/*" class="border px-4 py-2 rounded w-full text-white">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Update Product
                    </button>
                </form>
            </div>

        </x-adminCategory-layout>
    </x-admin-layout>
</x-guest-layout>
