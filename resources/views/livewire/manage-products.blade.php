<div class="text-white">
    <h2 class="text-xl font-semibold mb-4 ">Add a New Product</h2>

   
    <form wire:submit.prevent="addProduct" enctype="multipart/form-data" class="space-y-4 text-white">
        
        <input type="text" wire:model="product_name" placeholder="Product Name" class="border px-4 py-2 rounded w-full text-black" required>
        @error('product_name') <span class="text-red-500">{{ $message }}</span> @enderror

       
        <textarea wire:model="description" placeholder="Product Description" class="border px-4 py-2 rounded w-full text-black"></textarea>
        @error('description') <span class="text-red-500">{{ $message }}</span> @enderror

      
        <input type="number" wire:model="price" placeholder="Price" class="border px-4 py-2 rounded w-full text-black" required>
        @error('price') <span class="text-red-500">{{ $message }}</span> @enderror

       
        <input type="number" wire:model="stock" placeholder="Stock" class="border px-4 py-2 rounded w-full text-black" required>
        @error('stock') <span class="text-red-500">{{ $message }}</span> @enderror

        <!-- Categories Dropdown -->
        <label for="category" class="block font-bold">Category:</label>
        <select wire:model="category_id" id="category" class="border px-4 py-2 rounded w-full text-black" required>
            <option value="">Select a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
        </select>
        
        @error('category_id') <span class="text-red-500">{{ $message }}</span> @enderror

        <label for="images" class="block text-white">Product Images:</label>
        <input type="file" wire:model="images" id="images" multiple accept="image/*" class="border px-4 py-2 rounded w-full text-white">
        @error('images.*') <span class="text-red-500">{{ $message }}</span> @enderror

        <!-- Loading Indicator -->
        <div wire:loading wire:target="images" class="mt-4 text-center">
            <p class="text-white">Uploading images...</p>
            <svg class="animate-spin h-8 w-8 text-white mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0116 0v0H4z"></path>
            </svg>
        </div>
{{-- check --}}
        <!-- Preview Section -->
        <div class="mt-4 flex flex-wrap gap-1">
            @if ($images)
                @foreach ($images as $image)
                    <div>
                        <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-16 h-16 object-cover rounded">
                    </div>
                @endforeach
            @endif
        </div>
        
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Add Product
        </button>
    </form>

    @if (session()->has('success'))
        <div class="mt-4 bg-green-500 text-white p-2 rounded">
            {{ session('success') }}
        </div>
    @endif
</div>
