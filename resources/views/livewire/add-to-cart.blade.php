<div class="flex flex-col items-start space-y-4">
    <div class="flex items-center space-x-4">

        <!-- Remove -->
        <button 
            wire:click="removeFromCart" 
            class="bg-red-600 text-white px-6 py-3 rounded shadow hover:bg-red-700 transition">
            -
        </button>
       

        <!-- Quantity Display -->
        <div class="border p-2 rounded text-center">
            <span class="text-lg font-semibold">
                {{ $quantity }}
            </span>
            <span class="text-sm ">
                in cart
            </span>
        </div>


         <!-- Add to Cart Button -->
         <button 
         wire:click="addToCart" 
         class="bg-green-600 text-white px-6 py-3 rounded shadow hover:bg-green-700 transition">
         +
     </button>

        
    </div>

    <!-- Flash Messages -->
    <div class="w-auto">
        @if (session('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded shadow-md">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-500 text-white px-4 py-2 rounded shadow-md">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>
