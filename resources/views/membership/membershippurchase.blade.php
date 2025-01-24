<x-guest-layout>
    <div class="pt-40 sm:pt-32 md:pt-24 lg:pt-20 px-4">
        <div class="max-w-6xl mx-auto my-10 p-5 border-2 border-zeroskillroyalred backdrop-blur-md rounded-3xl shadow-lg">
            <h1 class="text-4xl font-bold text-red-500 text-center py-8">
                {{ $membershipTier->tier_name }}
            </h1>

            <!-- Main grid for tier information and payment section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                
                <!-- Left Side: Tier Information -->
                <div>
                    <p class="text-white text-3xl text-center mb-5">{{ $membershipTier->period }} Days</p>
                    <p class="text-white text-lg px-8 text-center mb-5">{{ $membershipTier->description }}</p>
                    <p class="text-white text-xl text-center">Price: 
                        <span class="text-green-500">Rs.{{ $membershipTier->price }}</span>
                    </p>
                </div>

                <!-- Right Side: Payment Form -->
                <div>
                    <!-- Payment Card Number -->
                    <div class="mb-4">
                        <label for="cardNumber" class="block text-sm font-medium text-white">Card Number:</label>
                        <input required
                            type="text"
                            id="cardNumber"
                            name="cardNumber"
                            maxlength="16"
                            pattern="\d{16}"
                            title="Card Number must be 16 digits"
                            class="mt-1 p-2 w-full bg-black text-white border border-gray-300 rounded-md"
                            oninput="validateCardNumber(this)">
                    </div>

                    <!-- Expiry Date -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="expiryDateMonth" class="block text-sm font-medium text-white">Expiry Month:</label>
                            <select id="expiryDateMonth" name="expiryDateMonth" required 
                                class="mt-1 p-2 w-full bg-black text-white border border-gray-300 rounded-md">
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
                            <label for="expiryDateYear" class="block text-sm font-medium text-white">Expiry Year:</label>
                            <select id="expiryDateYear" name="expiryDateYear" required 
                                class="mt-1 p-2 w-full bg-black text-white border border-gray-300 rounded-md">
                                @php
                                    $currentYear = date('Y');
                                @endphp
                                @for ($year = $currentYear; $year <= $currentYear + 5; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <!-- CVV Field -->
                    <div class="mb-4">
                        <label for="cvv" class="block text-sm font-medium text-white">CVV:</label>
                        <input type="tel" id="cvv" name="cvv" required maxlength="3" pattern="\d{3,4}"
                            class="mt-1 p-2 w-full bg-black text-white border border-gray-300 rounded-md"
                            inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                    </div>

                    <!-- Purchase Button -->
                    <div class="flex justify-center mt-6">
                        @auth
                            <!-- Show Purchase Button for Logged-in Users -->
                            <form method="POST" action="{{ route('membership.purchase.process') }}">
                                @csrf
                                <input type="hidden" name="tier_id" value="{{ $membershipTier->id }}">
                                <button id="payButton" type="submit" class="bg-zeroskill-green text-white font-bold px-4 py-2 border-2 border-white rounded-full hover:bg-zeroskill-royalred transition duration-300">
                                    Purchase
                                </button>
                            </form>
                        @else
                            <!-- Show Login/Register Message for Guests -->
                            <div class="text-center">
                                <p class="text-white font-semibold mb-4">Register or log in to purchase a membership.</p>
                                
                                <a href="{{ route('login') }}" class="bg-zeroskill-black text-white font-bold px-4 py-2 border-2 border-white rounded-full hover:bg-zeroskill-royalred transition duration-300 mr-2">
                                    Login
                                </a>
                                <a href="{{ route('register') }}" class="bg-zeroskill-black text-white font-bold px-4 py-2 border-2 border-white rounded-full hover:bg-zeroskill-royalred transition duration-300">
                                    Register
                                </a>
                            </div>
                        @endauth
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Script for Card Validation -->
    <script>
        function validateCardNumber(input) {
            input.value = input.value.replace(/\D/g, '').slice(0, 16);
        }

        document.getElementById('payButton').addEventListener('click', function(event) {
            const cardNumber = document.getElementById('cardNumber').value;
            const expiryMonth = document.getElementById('expiryDateMonth').value;
            const expiryYear = document.getElementById('expiryDateYear').value;
            const cvv = document.getElementById('cvv').value;

            if (!cardNumber || !expiryMonth || !expiryYear || !cvv) {
                alert('Please fill in all required fields.');
                event.preventDefault();
            }
        });
    </script>
</x-guest-layout>
