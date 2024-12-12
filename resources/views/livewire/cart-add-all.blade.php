<div class="flex items-center space-x-2">
    <!-- Remove from Cart Button -->
    <button 
        wire:click="removeFromCart" 
        class="bg-red-500 text-white px-4 py-1 rounded-full hover:bg-red-600 transition">
        −
    </button>

    <!-- Quantity Display -->
    <span class="text-lg font-semibold">{{ $quantity }}</span>

    <!-- Add to Cart Button -->
    <button 
        wire:click="addToCart" 
        class="bg-green-500 text-white px-4 py-1 rounded-full hover:bg-green-600 transition">
        +
    </button>

    <!-- Flash Messages -->
    <div>
        @if (session()->has('success'))
            <div class="text-green-500 text-sm mt-2">{{ session('success') }}</div>
        @endif

        @if (session()->has('error'))
            <div class="text-red-500 text-sm mt-2">{{ session('error') }}</div>
        @endif
    </div>
</div>
