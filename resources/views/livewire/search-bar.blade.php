<div class="relative w-full max-w-xl mx-auto" x-data
    @click.away="$wire.clearSearch(); document.getElementById('search-input').value = '' ">
    <!-- Search Input -->
    <div class="flex items-center border border-gray-300 rounded-lg shadow-md bg-white">
        <input type="text" wire:model="query" placeholder="Search for products..."
            class="flex-grow px-4 py-2 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-red-500 text-black"
            id="search-input" />
        <button wire:click="searchProducts"
            class="bg-red-500 text-white px-4 py-2 rounded-r-lg transition hover:bg-red-800">
            Search
        </button>
    </div>

    <!-- Results Section -->
    @if (!empty($products))
    <div class="absolute top-full left-0 w-full bg-white rounded-lg shadow-lg border border-gray-300 z-50">
        <ul class="divide-y divide-gray-200">
            @foreach ($products as $product)
                <li class="p-4 hover:bg-gray-100 flex items-center space-x-4">
                    <!-- Product Image -->
                    <img 
                        src="{{ isset($product['images']) ? asset($product['images'][0]) : asset('storage/images/Noimage.jpg') }}" 
                        alt="{{ $product['product_name'] }}" 
                        class="w-16 h-16 object-cover rounded-md border border-gray-300">

                    


                    <!-- Product Details -->
                    <div>
                        <a href="{{ route('single.product.view', $product->_id) }}"  class="text-black font-semibold hover:underline block">
                            {{ $product['product_name'] }}
                        </a>
                        <span class="text-gray-600 text-sm block">
                            Rs. {{ number_format($product['price'], 2) }}
                        </span>
                    </div>

                
                </li>
            @endforeach
        </ul>
    </div>
@endif



</div>
