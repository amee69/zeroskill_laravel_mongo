<x-guest-layout>
    <!-- Top Padding to Avoid Floating Navbar -->
    <div class="pt-32 md:pt-40">
        <!-- Contact Us Header -->
        <div class="relative w-full flex justify-center items-center">
            <h1 class="text-3xl md:text-4xl text-center mt-10 px-4 text-white">Contact Us</h1>
        </div>

        <!-- Contact Details -->
        <div class="w-full flex justify-center items-center mt-8">
            <div class="grid grid-cols-1 gap-6 text-center">
                <div class="flex justify-center items-center">
                    <h1 class="text-lg md:text-3xl">Email: <span class="text-red-600">info@zeroskill.com</span></h1>
                </div>
                <div class="flex justify-center items-center">
                    <h1 class="text-lg md:text-3xl">Tele: <span class="text-red-600">+94 123 456 789</span></h1>
                </div>
            </div>
        </div>

        <!-- Location Header -->
        <div class="relative w-full flex justify-center items-center mt-12">
            <h1 class="text-3xl md:text-4xl text-center px-4">Location</h1>
        </div>

        <!-- Location Description and Google Maps -->
        <div class="w-full flex justify-center items-center p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 rounded-lg max-w-[1000px]">
                <!-- First Column: Location Description -->
                <div class="p-4 rounded-lg flex justify-center items-center border shadow-md">
                    <div class="text-center md:text-left">
                        <h1 class="text-2xl md:text-3xl mb-4">
                            Zeroskill <span class="text-red-600">Gym</span> Location
                        </h1>
                        <p class="text-sm md:text-lg">
                            Our gym is located in Bellanvilla, Boralasgamuwa, Dehiwala, Mount-Lavinia.
                            Opposite to Keels Super Mart.
                        </p>
                    </div>
                </div>

                <!-- Second Column: Google Maps -->
                <div class="flex justify-center items-center p-4 rounded-lg bg-red-700 shadow-md">
                    <iframe class="rounded-lg w-full h-[300px] md:h-[400px]"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2355.431462655722!2d79.8836639022499!3d6.848851841489052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25b04031ce533%3A0xd5a89a0e49ed3e9c!2sPower%20World%20Gym%20-%20Bellanthara!5e0!3m2!1sen!2slk!4v1724223603113!5m2!1sen!2slk"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
