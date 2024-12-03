<x-guest-layout>
    <!-- Hero Section -->
    <div class="relative">
        <!-- Desktop Video Section -->
        <video autoplay loop muted src="videos/indexbg.mp4" alt="Background Image" 
            class="hidden sm:block w-full h-auto"></video>

        <!-- Mobile Video Section -->
        <div class="sm:hidden text-white flex flex-col items-center">
            <video autoplay loop muted src="videos/indexbg.mp4" alt="Background Image" class="w-full h-auto"></video>
            <div class="p-4 text-center">
                <h1 class="font-bold text-xl mt-4">Start Your Journey</h1>
                <p class="text-sm mt-2 leading-normal">
                    We've been active since mid-2020, starting as an online course website during the pandemic. 
                    Since then, we have grown into our own gyms. Begin your journey today!!!
                </p>
                <a href="{{ auth()->check() ? '/membership' : '/login' }}" class="inline-block mt-4">
                    <button
                        oncontextmenu="return false;"
                        class="text-sm bg-black bg-opacity-50 text-white border-2 border-white rounded-lg px-6 py-2 transition-all duration-300 hover:bg-red-700 hover:border-gray-300">
                        {{ auth()->check() ? 'Membership' : 'Register' }}
                    </button>
                </a>
            </div>
        </div>

        <!-- Desktop Content Over Video -->
        <div
            class="absolute text-white z-40 bg-black/30 backdrop-blur-md p-6 rounded-3xl hidden sm:block left-1/4 top-[350px]">
            <h1 class="font-bold flex justify-center items-start text-3xl sm:text-2xl md:text-3xl lg:text-4xl">
                Start Your Journey
            </h1>
            <div class="flex flex-col sm:flex-row justify-start items-center p-2 text-center sm:text-left">
                <img src="images/zeroskills2.png" class="h-16 md:h-20 lg:h-20 mr-0 sm:mr-6 mb-4 sm:mb-0">
                <h2 class="text-xl sm:text-2xl font-bold italic">Start To Win, Join Now</h2>
            </div>
            <p class="text-center leading-none text-sm sm:text-base md:text-lg max-w-lg">
                We have been active since mid-2020, starting as an online course website during the pandemic. 
                Since then, we have grown into our own gyms. Check out the rest of the page!
            </p>
            <div class="flex justify-center mt-6 md:mt-10">
                <a href="{{ auth()->check() ? '/membership' : '/login' }}">
                    <button
                        oncontextmenu="return false;"
                        class="text-lg sm:text-xl bg-black bg-opacity-50 text-white border-2 border-white rounded-3xl px-10 sm:px-12 md:px-24 py-1 transition-all duration-300 hover:bg-red-700 hover:border-gray-300">
                        {{ auth()->check() ? 'Membership' : 'Register' }}
                    </button>
                </a>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="mt-10 px-4">
        <h1 class="text-red-600 text-3xl md:text-4xl text-center">Reviews</h1>
    </div>

    <div class="text-center my-6 px-4">
        <p class="mx-auto max-w-lg text-sm sm:text-lg leading-relaxed">
            We care about what our customers think and feel about us. These reviews show our commitment to creating an exceptional gym experience. Take a look!
        </p>
    </div>

    <!-- Static Review Cards -->
    <section class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 px-4 sm:px-6 md:px-24 mx-auto mb-20">
        <!-- Review Card 1 -->
        <div class="bg-red-600 text-white rounded-3xl p-6">
            <div class="flex items-center">
                <img src="images/user.png" alt="Profile" class="h-12 w-12 rounded-full">
                <div class="ml-4">
                    <h2 class="text-lg font-semibold">Member</h2>
                </div>
            </div>
            <p class="italic mt-4">“I never went to a gym and this is my first one. The staff were friendly, and it was a nice community in general.”</p>
        </div>

        <!-- Review Card 2 -->
        <div class="bg-gray-800 text-white rounded-3xl p-6">
            <div class="flex items-center">
                <img src="images/user2.png" alt="Profile" class="h-12 w-12 rounded-full">
                <div class="ml-4">
                    <h2 class="text-lg font-semibold">Member</h2>
                </div>
            </div>
            <p class="italic mt-4">“Wow, the gym is everything I could ask for!”</p>
        </div>

        <!-- Review Card 3 -->
        <div class="bg-gray-800 text-white rounded-3xl p-6">
            <div class="flex items-center">
                <img src="images/user2.png" alt="Profile" class="h-12 w-12 rounded-full">
                <div class="ml-4">
                    <h2 class="text-lg font-semibold">Member</h2>
                </div>
            </div>
            <p class="italic mt-4">“This has been a safe haven after my draft into Afghanistan. It’s simply perfect.”</p>
        </div>

        <!-- Review Card 4 -->
        <div class="bg-gray-800 text-white rounded-3xl p-6">
            <div class="flex items-center">
                <img src="images/user2.png" alt="Profile" class="h-12 w-12 rounded-full">
                <div class="ml-4">
                    <h2 class="text-lg font-semibold">Member</h2>
                </div>
            </div>
            <p class="italic mt-4">“The equipment is clean and well-maintained. I've been going for a while, and they always keep it in great shape.”</p>
        </div>
    </section>
</x-guest-layout>
