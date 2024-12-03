<x-guest-layout>
   
    <br><br><br><br><br><br>
    <div class="relative w-full flex justify-center items-center">
        <h1 class="text-4xl text-center mt-10 px-4 text-red-600">Contact Us</h1>
    </div>
    <br><br><br>

    <div class="w-full flex justify-center items-center">
        <div class="grid grid-cols-1 gap-6">
            <div class="flex justify-center items-center">
                <h1 class="text-3xl text-center px-4">Email: info@zeroskill.com</h1>
            </div>
            <div class="flex justify-center items-center">
                <h1 class="text-3xl text-center px-4">Tele: +94 123 456 789</h1>
            </div>
        </div>
    </div>
    <br>

    <div class="p-10 bg-zeroskillroyalred mx-[600px] rounded-3xl">
        <h2 class="flex justify-center items-center text-2xl text-red-600 mb-6">Send a message!</h2>

        <form action="/submitmessageform" method="POST">
            <div>
                <label class="mr-2">Subject</label>
                <input required type="text" name="subject" class="w-full p-2 rounded-lg border-2 border-gray-300 bg-zeroskillblack" placeholder="Enter Subject">
            </div>
            <br>

            <div class="gap-3">
                <label class="mr-2">Email</label>
                <input type="email" name="email" class="w-full p-2 rounded-lg border-2 border-gray-300 bg-zeroskillblack" placeholder="Enter your email">
            </div>
            <br>
            <div class="mb-4">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" required class="mt-1 p-2 w-full bg-zeroskillblack text-white border border-gray-300 rounded-md" autocomplete="off" placeholder="Enter Your Message"></textarea>
            </div>

            <div class="flex justify-center mt-6">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-3xl">
                    Send
                </button>
            </div>
        </form>
    </div>

    <br><br>
    <div class="relative w-full flex justify-center items-center">
        <h1 class="text-4xl text-center mt-10 px-4">Location</h1>
    </div>

    <div class="w-full flex justify-center items-center p-6">
        <div class="grid grid-cols-2 gap-6 p-6 rounded-lg max-w-[1000px]">
            <!-- First Column: Location Description -->
            <div class="p-4 rounded-lg flex justify-center items-center">
                <div class="grid grid-cols-1 gap-4">
                    <h1 class="text-3xl px-4">
                        Zeroskill <span class="text-red-600">Gym</span> Location
                    </h1>
                    <p class="text-lg px-4">
                        Our gym is located in Bellanvilla, Boralasgumua, Dehiwala, Mount-Lavinia.
                        Opposite to Keels Super Mart
                    </p>
                </div>
            </div>

            <!-- Second Column: Google Maps -->
            <div class="flex justify-center items-center p-4 rounded-lg bg-red-700">
                <iframe class="rounded-lg w-full h-[400px]" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2355.431462655722!2d79.8836639022499!3d6.848851841489052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25b04031ce533%3A0xd5a89a0e49ed3e9c!2sPower%20World%20Gym%20-%20Bellanthara!5e0!3m2!1sen!2slk!4v1724223603113!5m2!1sen!2slk" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

    <br><br>
</x-guest-layout>
