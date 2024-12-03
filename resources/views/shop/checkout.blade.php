<x-guest-layout>
    <div class="mx-auto flex flex-col items-center py-40 text-black">
        <div class="w-full max-w-6xl p-8 border rounded-lg shadow-lg bg-white">
            <h1 class="text-center font-bold text-4xl tracking-wider text-gray-800 mb-8">
                Checkout
            </h1>

            <!-- Two-column Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Left Side: Order Summary -->
                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Order Summary</h2>
                    <div class="space-y-4">
                        @php $total = 0; @endphp <!-- Initialize total -->
                        @foreach($cartItems as $item)
                            <div class="flex justify-between items-center bg-gray-100 p-4 rounded-lg">
                                <span class="text-lg font-semibold">{{ $item['product_name'] }}</span>
                                <span class="text-lg">Qty: {{ $item['quantity'] }}</span>
                                <span class="text-lg font-bold">Rs. {{ $item['price'] }}</span>
                            </div>
                            @php $total += $item['price']; @endphp <!-- Add each item's price to total -->
                        @endforeach
                    </div>
                    <div class="mt-8">
                        <h2 class="text-2xl font-bold text-gray-800">
                            Total: Rs. {{ $total }}
                        </h2>
                    </div>
                </div>

                <!-- Right Side: Payment and Shipping Form -->
                <div class="space-y-6">
                    <!-- Address Section -->
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Shipping Details</h2>
                    <form action="{{ route('checkout.process') }}" method="POST" class="space-y-6" x-data="{ cardPayment: false }">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label for="full_name" class="block font-bold text-gray-800">Full Name</label>
                                <input type="text" name="full_name" id="full_name" required class="w-full border p-3 rounded-lg">
                            </div>
                            <div>
                                <label for="city" class="block font-bold text-gray-800">City</label>
                                <input type="text" name="city" id="city" required class="w-full border p-3 rounded-lg">
                            </div>
                            <div>
                                <label for="house_number" class="block font-bold text-gray-800">House Number</label>
                                <input type="text" name="house_number" id="house_number" required class="w-full border p-3 rounded-lg">
                            </div>
                            <div class="col-span-2">
                                <label for="address" class="block font-bold text-gray-800">Address</label>
                                <input type="text" name="address" id="address" required class="w-full border p-3 rounded-lg">
                            </div>
                            <div>
                                <label for="phone_number" class="block font-bold text-gray-800">Phone Number</label>
                                <input type="text" name="phone_number" id="phone_number" required class="w-full border p-3 rounded-lg">
                            </div>
                        </div>

                        <!-- Payment Method Selection -->
                        <div class="mb-6">
                            <h2 class="text-xl font-bold mb-4">Choose Payment Method</h2>
                            <div class="flex space-x-6">
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="payment_method" value="cash_on_delivery" checked class="form-radio text-red-600"
                                        @click="cardPayment = false">
                                    <span class="text-gray-800 font-semibold">Cash on Delivery</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="payment_method" value="card_payment" class="form-radio text-red-600"
                                        @click="cardPayment = true">
                                    <span class="text-gray-800 font-semibold">Card Payment</span>
                                </label>
                            </div>
                        </div>

                        <!-- Card Payment Fields -->
                        <div x-show="cardPayment" id="card-payment-fields" class="space-y-4">
                            <div>
                                <label for="card_number" class="block font-bold text-gray-800">Card Number</label>
                                <input type="text" name="card_number" id="card_number" maxlength="16" class="w-full border p-3 rounded-lg"
                                    x-on:input="$event.target.value = $event.target.value.replace(/[^0-9]/g, '').slice(0, 16)" />
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="expiryDateMonth" class="block text-sm font-medium text-gray-800">Expiry Month</label>
                                    <select id="expiryDateMonth" name="expiryDateMonth" class="w-full border p-3 rounded-lg">
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="expiryDateYear" class="block text-sm font-medium text-gray-800">Expiry Year</label>
                                    <select id="expiryDateYear" name="expiryDateYear" class="w-full border p-3 rounded-lg">
                                        @php
                                            $currentYear = date('Y');
                                        @endphp
                                        @for ($year = $currentYear; $year <= $currentYear + 5; $year++)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label for="cvv" class="block font-bold text-gray-800">CVV</label>
                                <input type="text" name="cvv" id="cvv" maxlength="3" class="w-full border p-3 rounded-lg"
                                    x-on:input="$event.target.value = $event.target.value.replace(/[^0-9]/g, '').slice(0, 3)" />
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white text-lg font-semibold py-3 rounded-md transition">
                                Complete Purchase
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
