<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="{{ asset('images/zeroskills2.png') }}" type="image/png"/>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="bg-zeroskill-black">
        <header >
            @if (Route::has('login'))
            @livewire('hamburger-menu')

            
                {{-- <nav x-data="{ open: false }" class="fixed z-50 w-full flex justify-center items-center">
                    <a href="{{ url('/') }}" class="flex-shrink-0 ml-4">
                        <img src="\images\zeroskills2.png" alt="Zero Skill Logo" class="h-[150px]">
                    </a>
                    <div class="bg-black/50 backdrop-blur-md rounded-3xl p-2 flex items-center space-x-8">
                
                        <!-- Navigation Links -->
                        <ul class="flex items-center space-x-12">
                            <li><a href="{{ route('home') }}" class="text-white font-semibold py-2 px-4 rounded hover:text-gray-300">Home</a></li>
                            <li><a href="/membership" class="text-white font-semibold py-2 px-4 rounded hover:text-gray-300">Membership</a></li>
                            <li><a href="/membership" class="text-white font-semibold py-2 px-4 rounded hover:text-gray-300">Shop</a></li>
                            <li><a href="{{ route('contact') }}" class="text-white font-semibold py-2 px-4 rounded hover:text-gray-300">Contact</a></li>
            
                            @auth
                                <!-- Profile and Logout Links for Authenticated Users -->
                                <li><a href="{{ route('profile.show') }}" class="text-white font-semibold py-2 px-4 rounded hover:text-gray-300">Profile</a></li>
                                
                                <!-- Dashboard Link Visible Only to Admin (role_id == 1) -->
                                @if (Auth::user()->role_id == 1)
                                    <li><a href="{{ route('dashboard') }}" class="text-white font-semibold py-2 px-4 rounded hover:text-gray-300">Dashboard</a></li>
                                @endif

                                <!-- Logout Form -->
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <button type="submit" class="text-white font-semibold py-2 px-4 rounded hover:text-gray-300">Logout</button>
                                    </form>
                                </li>
                            @else
                                <!-- Login and Register Links for Guests -->
                                <li><a href="{{ route('login') }}" class="text-white font-semibold py-2 px-4 rounded hover:text-gray-300">Login</a></li>
                                <li><a href="{{ route('register') }}" class="text-white font-semibold py-2 px-4 rounded hover:text-gray-300">Register</a></li>
                            @endauth
                        </ul>
                    </div>
                </nav>   --}}
            @endif
        </header>

        <div class="font-sans  text-white antialiased">
            {{ $slot }}
        </div>

        <footer class="p-10 md:p-20 bg-zeroskill-royalred text-white rounded-t-full">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Stay Connected Section -->
                <div class="text-center">
                    <h1 class="text-2xl font-semibold mb-6">Stay Connected</h1>
                    <div class="flex justify-center space-x-6">
                        <a href="#" class="fa fa-facebook" style="font-size: 40px"></a>
                        <a href="https://www.instagram.com/_ameer69/" class="fa fa-instagram" style="font-size: 40px"></a>
                        <a href="#" class="fa fa-twitter" style="font-size: 40px"></a>
                    </div>
                </div>
        
                <!-- Our Mission Section -->
                <div class="text-center">
                    <h1 class="text-2xl font-semibold mb-6">Our Mission</h1>
                    <p class="text-sm md:text-base leading-relaxed">
                        ZeroSkill: Our mission is to build a community that considers themselves part of a family. A family that empowers each other to achieve their fitness goals that lead to healthier, therefore happier lives. We strive to inspire the whole country to have this.
                    </p>
                </div>
        
                <!-- Click Below Links Section -->
                <div class="text-center">
                    <h1 class="text-2xl font-semibold mb-6">Quick Links</h1>
                    <ul class="space-y-4">
                        <li><a href="{{ url('/home') }}" class="hover:text-red-500 text-sm md:text-base">Home</a></li>
                        <li><a href="{{ url('/membership') }}" class="hover:text-red-500 text-sm md:text-base">Membership</a></li>
                        <li><a href="{{ url('/contact') }}" class="hover:text-red-500 text-sm md:text-base">Contact</a></li>
                        <li><a href="{{ url('/register') }}" class="hover:text-red-500 text-sm md:text-base">Register</a></li>
                    </ul>
                </div>
            </div>
            
        
            <!-- Additional Spacing for Small Screens -->
            <div class="mt-10 text-center text-sm md:hidden">
                &copy; {{ date('Y') }} ZeroSkill. All rights reserved.
            </div>
        </footer>
        
        
        

        @livewireScripts
    </body>
</html>
