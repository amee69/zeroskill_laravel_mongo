<x-guest-layout>
    <x-shop-layout>
        <div class="relative min-h-screen flex flex-col justify-between">
            <div class="relative z-10 flex flex-col items-center">
                <!-- Header Section -->
                <div class="flex justify-start w-full max-w-screen-2xl px-4 py-2">
                    <h1 id="start" class="font-bold text-4xl md:text-5xl text-white tracking-wider">
                        Get Your Protien In
                    </h1>
                </div>

                <!-- Product Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 max-w-screen-2xl mt-8 mx-auto">
                    <!-- Product Card -->
                    @foreach ($products as $product)
                    <div class="bg-black shadow-lg rounded-xl overflow-hidden border border-gray-700 transition-transform transform hover:scale-105 mx-auto w-72 flex flex-col justify-between"> <!-- Added flex layout -->
                        <!-- Product Image -->
                        <img class="w-full h-80 object-cover" src="{{ asset('images/products/protein/zeroskillprotien1.webp') }}" alt="{{ $product->product_name }}">

                    
                        <!-- Product Details -->
                        <div class="p-4 text-white flex-grow">
                            <!-- Product Title -->
                            <h2 class="text-xl font-bold text-white-500 mb-4">{{ $product->product_name }}</h2>
                        </div>
                    
                        <!-- Stock and Add to Cart Section -->
                        <div class="flex justify-start items-center  p-4">
                            
                    
                            <button class="bg-red-600 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-red-700 transition mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18l-2 13H5L3 3zm3 16a2 2 0 100 4 2 2 0 000-4zm12 0a2 2 0 100 4 2 2 0 000-4z" />
                                </svg>
                            </button>

                            @if ($product->stock > 0)
                                <h2 class="text-green-700 font-semibold">In Stock</h2>
                            @else
                                <h2 class="text-red-400 font-semibold">Out Of Stock</h2>
                            @endif
                        </div>
                    </div>
                    
                    @endforeach
                </div>
            </div>
            <div class="pagination">
                {{ $products->links() }}
            </div>
        </div>
    </x-shop-layout>
</x-guest-layout>
