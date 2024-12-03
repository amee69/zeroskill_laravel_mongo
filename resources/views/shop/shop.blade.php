<x-guest-layout>
    <x-shop-layout>
        <div class="relative min-h-screen flex flex-col justify-between">
            <div class="relative z-10 flex flex-col items-center">
                <!-- Header Section -->
                <div class="flex justify-start w-full max-w-screen-2xl px-4 py-2">
                    <h1 id="start" class="font-bold text-3xl sm:text-4xl md:text-5xl text-white tracking-wider">
                        {{ $categoryModel->category_name ?? 'All Products' }}
                    </h1>
                </div>

                <!-- Desktop Product Grid -->
                <div
                    class="hidden sm:grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 max-w-screen-2xl mt-8 mx-auto">
                    @forelse ($products as $product)
                        <a href="{{ route('single.product.view', $product->_id) }}"
                            class="shadow-lg rounded-xl overflow-hidden border border-gray-700 transition-transform transform hover:scale-105 mx-auto w-72 flex flex-col justify-between">
                            <div class="product-images">
                                @if (!empty($product->images) && count($product->images) > 0)
                                    <img src="{{ asset($product->images[0]) }}" alt="Product Image"
                                        class="w-full h-48 object-cover">
                                @else
                                    <img src="{{ asset('storage/images/Noimage.jpg') }}" alt="Default Image"
                                        class="w-full h-48 object-cover">
                                @endif
                            </div>
                            <div class="p-4 text-white flex-grow">
                                <h2 class="text-xl font-bold text-white-500 mb-4">{{ $product->product_name }}</h2>
                            </div>
                            <div class="flex justify-start items-center p-4">
                                <button
                                    class="bg-red-600 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-red-700 transition mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h18l-2 13H5L3 3zm3 16a2 2 0 100 4 2 2 0 000-4zm12 0a2 2 0 100 4 2 2 0 000-4z" />
                                    </svg>
                                </button>
                                @if ($product->stock > 0)
                                    <h2 class="text-green-700 font-semibold">In Stock</h2>
                                @else
                                    <h2 class="text-red-400 font-semibold">Out Of Stock</h2>
                                @endif
                            </div>
                        </a>
                    @empty
                        <p class="text-white">No products available in this category.</p>
                    @endforelse
                </div>

                <!-- Mobile Product Grid -->
                <div class="grid grid-cols-2 gap-4 sm:hidden mt-8 mx-auto">
                    @forelse ($products as $product)
                        <a href="{{ route('single.product.view', $product->_id) }}"
                            class="shadow-lg rounded-lg overflow-hidden border border-gray-700 transition-transform transform hover:scale-105 mx-auto w-full flex flex-col justify-between">
                            <div class="product-images">
                                @if (!empty($product->images) && count($product->images) > 0)
                                    <img src="{{ asset($product->images[0]) }}" alt="Product Image"
                                        class="w-full h-36 object-cover">
                                @else
                                    <img src="{{ asset('storage/images/Noimage.jpg') }}" alt="Default Image"
                                        class="w-full h-36 object-cover">
                                @endif
                            </div>
                            <div class="p-3 text-white">
                                <h2 class="text-base font-bold mb-2">{{ $product->product_name }}</h2>
                            </div>
                            <div class="flex justify-start items-center px-3 pb-3">
                                <button
                                    class="bg-red-600 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-red-700 transition mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h18l-2 13H5L3 3zm3 16a2 2 0 100 4 2 2 0 000-4zm12 0a2 2 0 100 4 2 2 0 000-4z" />
                                    </svg>
                                </button>
                                @if ($product->stock > 0)
                                    <h2 class="text-green-700 font-semibold text-sm">In Stock</h2>
                                @else
                                    <h2 class="text-red-400 font-semibold text-sm">Out Of Stock</h2>
                                @endif
                            </div>
                        </a>
                    @empty
                        <p class="text-white text-sm">No products available in this category.</p>
                    @endforelse
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </x-shop-layout>
</x-guest-layout>
