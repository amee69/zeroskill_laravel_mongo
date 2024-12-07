<x-guest-layout>
    <x-shop-layout>
        <div class="container mx-auto p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                <!-- Product Images -->
                {{-- <div class="product-images">
                    <!-- Display the first image or a default image if no images exist -->
                    <img src="{{ isset($product->images[0]) ? asset($product->images[0]) : asset('storage/images/Noimage.jpg') }}"
                        alt="{{ $product->product_name }}" class="w-full rounded-lg shadow-md object-cover">

                    <!-- Thumbnails for additional images -->
                    <div class="flex space-x-4 mt-4">
                        @if (!empty($product->images) && is_array($product->images))
                            @foreach ($product->images as $image)
                                <img src="{{ asset($image) }}" alt="Thumbnail"
                                    class="w-20 h-20 object-cover border rounded cursor-pointer hover:opacity-75">
                            @endforeach
                        @else
                            <!-- Optional: If there are no images, display a placeholder thumbnail -->
                            <img src="{{ asset('storage/images/Noimage.jpg') }}" alt="No Image Available"
                                class="w-20 h-20 object-cover border rounded opacity-50">
                        @endif
                    </div>
                </div> --}}

                <div x-data="{
                    images: {{ json_encode(array_map(fn($image) => asset($image), is_array($product->images) ? $product->images : [])) }},
                    currentIndex: 0,
                    defaultImage: '{{ asset('storage/images/Noimage.jpg') }}'
                }" class="product-images">
                
                    <!-- Main Image Display -->
                    <div class="border rounded-lg">
                        <img :src="images.length ? images[currentIndex] : defaultImage" 
                             alt="{{ $product->product_name }}"
                             class="rounded-lg shadow-md object-cover h-96 w-auto mx-auto border">
                    </div>
                
                    <!-- Thumbnails -->
                    <div class="flex space-x-2 mt-4">
                        <template x-for="(image, index) in images" :key="index">
                            <img :src="image" @click="currentIndex = index"
                                 class="w-16 h-16 object-cover border rounded cursor-pointer hover:opacity-75">
                        </template>
                
                        <!-- Fallback Thumbnail if No Images Exist -->
                        <template x-if="images.length === 0">
                            <img :src="defaultImage" 
                                 alt="No Image Available"
                                 class="w-16 h-16 object-cover border rounded opacity-50">
                        </template>
                    </div>
                
                </div>
                



                <!-- Product Details -->
                <div class="product-details space-y-4">
                    <!-- Product Name -->
                    <h1 class="text-3xl font-bold">{{ $product->product_name }}</h1>


                    <!-- Product Price -->
                    <div class="text-2xl font-semibold text-red-600">Rs. {{ number_format($product->price, 2) }}</div>
                    {{-- //================================================================================================ --}}

                    <!-- Stock Information -->
                    @if ($product->stock > 0)
                        <span class="text-green-600 font-semibold">In Stock</span>

                        <!-- Add to Cart Button (Livewire Component) -->
                        @livewire('add-to-cart', [
                            'productId' => $product->_id,
                            'productName' => $product->product_name,
                            'price' => $product->price,
                        ])
                    @else
                        <!-- Out of Stock Button -->
                        <button class="bg-gray-400 text-white px-6 py-3 rounded shadow cursor-not-allowed" disabled>
                            Out of Stock
                        </button>
                    @endif
                    {{-- //================================================================================================ --}}

                    <!-- Product Description -->
                    <p class="text-xl">{{ $product->description }}</p>




                </div>
            </div>
        </div>
    </x-shop-layout>
</x-guest-layout>
