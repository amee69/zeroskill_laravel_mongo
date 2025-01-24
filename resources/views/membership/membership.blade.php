<x-guest-layout>
    <div class="relative min-h-screen flex flex-col justify-between">
        <!-- Background Video -->
        <div class="relative min-h-screen">
            <video autoplay muted loop src="{{ asset('videos/membershipbg2.mp4') }}" alt="Background Video"
                class="w-full h-full object-cover absolute inset-0 -z-10"></video>

            <!-- Desktop Layout -->
            <div class="hidden sm:flex relative z-10 flex-col items-center p-10">
                <div class="flex justify-center mt-36">
                    <h1 id="start" class="font-bold text-5xl text-white">
                        Choose your beginning
                    </h1>
                </div>

                <!-- Membership Status Messages -->
                @if (isset($membershipStatus) && $membershipStatus['status'] === 'Active')
                    <div
                        class="bg-zeroskill-green bg-opacity-75 text-white text-xl font-semibold px-6 py-4 mt-6 rounded-xl shadow-lg">
                        <p>You already have an Active Membership.</p>
                    </div>
                @elseif (isset($membershipStatus) && $membershipStatus['status'] === 'Expired')
                    <div
                        class="bg-red-600 bg-opacity-75 text-white text-xl font-semibold px-6 py-4 mt-6 rounded-xl shadow-lg">
                        <p>Your membership has expired. Would you like to renew?</p>
                    </div>
                @endif

                <!-- Membership Tiers for Desktop -->
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7 p-8 w-full max-w-screen-2xl mt-10 mx-auto">
                    @foreach ($membershipTiers as $tier)
                        <div class="flex flex-col gap-4">
                            <div
                                class="rounded-3xl bg-black/50 backdrop-blur-md border border-white h-full p-5 flex flex-col max-h-[500px] overflow-auto">
                                <div class="flex justify-center mb-4">
                                    <h1 class="text-4xl font-bold text-red-500">
                                        {{ $tier->tier_name }}
                                    </h1>
                                </div>
                                <div class="flex justify-center mb-4">
                                    <p class="text-white text-3xl">
                                        {{ $tier->period }} Days
                                    </p>
                                </div>
                                <div class="flex justify-center mb-4">
                                    <p class="text-zeroskillMossgreen text-3xl text-green-600">
                                        Rs.{{ $tier->price }}
                                    </p>
                                </div>
                                <div class="flex justify-center mb-4">
                                    <p class="text-white text-center text-xl">
                                        {{ $tier->description }}
                                    </p>
                                </div>
                            </div>

                            @if (empty($membershipStatus) || $membershipStatus['status'] === 'Expired')
                                <div class="flex justify-center mt-4">
                                    <a href="{{ route('membership.purchase', ['tier_id' => $tier->id]) }}"
                                        class="text-2xl bg-black bg-opacity-50 text-white border-2 border-white rounded-3xl px-24 py-2 transition-all duration-300 hover:bg-red-700 hover:border-gray-300 hover:scale-95 hover:shadow-xl">
                                        Select {{ $tier->tier_name }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Mobile Layout -->
            <div class="sm:hidden relative z-10 flex flex-col items-center p-6 pt-24">
                <h1 class="font-bold text-3xl text-white text-center mt-16">
                    Choose your beginning
                </h1>

                <!-- Membership Status Messages -->
                @if (isset($membershipStatus) && $membershipStatus['status'] === 'Active')
                    <div
                        class="bg-zeroskill-green bg-opacity-75 text-white text-lg font-semibold px-4 py-3 mt-6 rounded-xl shadow-lg">
                        <p>You already have an Active Membership.</p>
                    </div>
                @elseif (isset($membershipStatus) && $membershipStatus['status'] === 'Expired')
                    <div
                        class="bg-red-600 bg-opacity-75 text-white text-lg font-semibold px-4 py-3 mt-6 rounded-xl shadow-lg">
                        <p>Your membership has expired. Would you like to renew?</p>
                    </div>
                @endif

                <!-- Membership Tiers for Mobile -->
                <div class="grid grid-cols-1 gap-5 mt-8">
                    @foreach ($membershipTiers as $tier)
                        <div class="rounded-xl bg-black/50 backdrop-blur-md border border-white p-4">
                            <h2 class="text-2xl font-bold text-red-500 text-center">{{ $tier->tier_name }}</h2>
                            <p class="text-white text-lg text-center mt-2">{{ $tier->period }} Days</p>
                            <p class="text-green-600 text-lg text-center mt-2">Rs.{{ $tier->price }}</p>
                            <p class="text-white text-sm text-center mt-2">{{ $tier->description }}</p>

                            @if (empty($membershipStatus) || $membershipStatus['status'] === 'Expired')
                                <div class="flex justify-center mt-4">
                                    <a href="{{ route('membership.purchase', ['tier_id' => $tier->id]) }}"
                                        class="text-lg bg-black bg-opacity-50 text-white border-2 border-white rounded-lg px-10 py-2 transition-all duration-300 hover:bg-red-700 hover:border-gray-300 hover:scale-95 hover:shadow-xl">
                                        Select {{ $tier->tier_name }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
