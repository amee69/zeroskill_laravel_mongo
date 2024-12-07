<x-guest-layout>
    <x-admin-layout>
        <x-adminCategory-layout>
            <x-slot:title>
                Manage Products
            </x-slot:title>

            <h2 class="text-xl font-semibold mb-4">Manage Products</h2>

            <!-- Livewire Component for Managing Products -->
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
                            <td class="border px-4 py-2">Rs. {{ number_format($product->price, 2) }}</td>
                            <td class="border px-4 py-2">{{ $product->stock }}</td>
                            <td class="border px-4 py-2 space-x-2">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.products.edit', $product->_id) }}" class="text-blue-500 hover:underline">
                                    Edit
                                </a>

                                <!-- Delete Form with Alpine.js Confirmation -->
                                <form action="{{ route('admin.products.delete', $product->_id) }}" method="POST" x-data>
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" @click="if (confirm('Are you sure you want to delete this product? This action cannot be undone.')) $el.closest('form').submit();" class="text-red-500 hover:underline">
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
