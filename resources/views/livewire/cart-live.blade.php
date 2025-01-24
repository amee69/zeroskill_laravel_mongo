<div class="mx-auto flex flex-col items-center py-40">
    <!-- Main Content Area -->
    <div class="w-full max-w-4xl p-8 border rounded-lg shadow-lg bg-white">
        <!-- Cart Header -->
        <div class="text-center mb-8">
            <h1 id="start" class="font-bold text-4xl tracking-wider text-gray-800">
                Your Shopping Cart
            </h1>
        </div>

        <div>
            <!-- Success Message -->
            @if (session()->has('success'))
                <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @endif
        
            <!-- Error Message -->
            @if (session()->has('error'))
                <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                    {{ session('error') }}
                </div>
            @endif
        
            <!-- Message for Cart -->
            {{-- @if ($message)
                <div class="bg-yellow-500 text-white p-4 rounded-md mb-4">
                    {{ $message }}
                </div>
            @endif --}}
        </div>
        

        <!-- Desktop View -->
        <div class="hidden md:block">
            <!-- Cart Items -->
            <div class="cart-container text-black bg-gray-100 p-6 rounded-lg">
                @if ($message)
                    <!-- Display the message if the cart is empty or doesn't exist -->
                    <div class="text-center py-16">
                        <p class="text-gray-600 text-lg font-semibold">{{ $message }}</p>
                        @if ($message === 'Your cart is empty.')
                            <p class="text-gray-500 mt-2">Add some products to your cart to get started!</p>
                        @endif
                    </div>
                @else
                    <div class="space-y-6">
                        @foreach ($products as $item)
                            <div class="cart-item flex items-center justify-between bg-white shadow-md p-6 rounded-lg">
                                <!-- Product Info -->
                                <div class="flex items-center space-x-4">
                                    {{-- <img src="{{ asset('storage/images/Noimage.jpg') }}"
                                        alt="{{ $item['product_name'] }}"
                                        class="w-20 h-20 object-cover rounded-lg border"> --}}
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800">Product :{{ $item['product_name'] }}</h3>
                                        <p class="text-gray-600">Quantity: {{ $item['quantity'] }}</p>
                                        <p class="text-gray-600">Price per item: Rs. {{ number_format($item['price'] / $item['quantity'], 2) }}</p>
                                        <p class="text-gray-600">Total Price: Rs. {{ $item['price'] }}</p>

                                    </div>
                                </div>
                                <!-- Add/Remove Buttons -->
                                <div class="flex space-x-2">
                                   
                                    <button wire:click="removeFromCart('{{ $item['product_id'] }}')"
                                        class="bg-red-600 text-white px-6 py-3 rounded shadow hover:bg-red-700 transition">
                                        -
                                    </button>
                                    <button wire:click="addToCart('{{ $item['product_id'] }}')"
                                    class="bg-green-600 text-white px-6 py-3 rounded shadow hover:bg-green-700 transition">
                                    +
                                </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total Section -->
                    <div class="mt-8 bg-white shadow-md p-6 rounded-lg">
                        <h1 class="text-2xl font-bold text-gray-800">Total: Rs. {{ $total }}</h1>
                    </div>
                @endif
            </div>

            <!-- Checkout Button -->
            @if (!$message)
                <div class="mt-8">
                    <a href="{{ route('checkout') }}"
                        class="w-full bg-red-600 hover:bg-red-700 text-white text-lg font-semibold py-3 rounded-md transition block text-center">
                        Proceed to Checkout
                    </a>

                </div>
            @endif
        </div>

        <!-- Mobile View -->
        <div class="block md:hidden">
            <!-- Cart Items -->
            <div class="cart-container text-black bg-gray-100 p-2 rounded-lg">
                @if ($message)
                    <!-- Display the message if the cart is empty or doesn't exist -->
                    <div class="text-center py-10">
                        <p class="text-gray-600 text-base font-semibold">{{ $message }}</p>
                        @if ($message === 'Your cart is empty.')
                            <p class="text-gray-500 mt-2">Add some products to your cart to get started!</p>
                        @endif
                    </div>
                @else
                    <div class="divide-y divide-gray-300">
                        @foreach ($products as $item)
                            <div class="cart-item flex items-center justify-between py-4">
                                <!-- Product Info -->
                                <div class="flex flex-col text-sm space-y-1 w-3/4">
                                    <span class="font-bold">{{ $item['product_name'] }}</span>
                                    <span>Quantity: {{ $item['quantity'] }}</span>
                                   
<p class="text-gray-600">Price per item: Rs. {{ number_format($item['price'] / $item['quantity'], 2) }}</p>
<p class="text-gray-600">Total Price: Rs. {{ $item['price'] }}</p>

                                  
                                </div>
                                <!-- Add/Remove Buttons -->
                                <div class="flex flex-col space-y-2 w-1/4">
                                    <button wire:click="addToCart('{{ $item['product_id'] }}')"
                                        class="bg-green-600 text-white text-sm py-1 rounded shadow hover:bg-green-700 transition">
                                        +
                                    </button>
                                    <button wire:click="removeFromCart('{{ $item['product_id'] }}')"
                                        class="bg-red-600 text-white text-sm py-1 rounded shadow hover:bg-red-700 transition">
                                        -
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total Section -->
                    <div class="mt-6 bg-white shadow-md p-4 rounded-lg">
                        <h1 class="text-lg font-bold text-gray-800">Total: Rs. {{ $total }}</h1>
                    </div>
                @endif
            </div>

            <!-- Checkout Button -->
            @if (!$message)
                <div class="mt-6">
                    <a href="{{ route('checkout') }}"
                        class="w-full bg-red-600 hover:bg-red-700 text-white text-lg font-semibold py-3 rounded-md transition block text-center">
                        Proceed to Checkout
                    </a>


                </div>
            @endif
        </div>
    </div>
</div>
