<x-guest-layout>
    {{-- <head>
        <link rel="stylesheet" href="/zeroskill4/public/css/output.css">
    </head> --}}

    <body class="text-white font-sans m-0 p-0" style="
            background-image: url('/zeroskill4/public/images/landingpage2.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
          ">

        <div class="pt-32">
            <h1 class="text-3xl font-bold mb-6 text-center text-white z-50">Registration</h1>
        </div>

        <div class="max-w-2xl mx-auto my-10 p-8 bg-black/50 border-2 border-white backdrop-blur-md rounded-3xl shadow-lg ">
            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}" class="text-black">
                @csrf

                <div>
                    <x-label class="text-white" for="name" value="{{ __('Name') }}" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div  class="mt-4">
                    <x-label class="text-white" for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label class="text-white" for="number" value="{{ __('Phone Number') }}" />
                    <x-input id="number" class="block mt-1 w-full" type="text" name="number" :value="old('number')" required autocomplete="tel" />
                </div>

                <div class="mt-4">
                    <x-label class="text-white" for="nic" value="{{ __('NIC') }}" />
                    <x-input id="nic" class="block mt-1 w-full" type="text" name="nic" :value="old('nic')" required autocomplete="off" />
                </div>

                <div class="mt-4">
                    <x-label class="text-white" for="address" value="{{ __('Address') }}" />
                    <textarea id="address" class="block mt-1 w-full bg-white text-black rounded-md" name="address" rows="3" required>{{ old('address') }}</textarea>
                </div>

                <div class="mt-4">
                    <x-label class="text-white" for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label class="text-white" for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />
                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-300 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-300 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-300 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button class="ml-4 bg-red-600 hover:bg-red-700 focus:ring-red-500">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </div>

        {{-- <footer class="rounded-t-full p-40 bg-black/50 backdrop-blur-md">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-10">
                <div class="w-full">
                    <h1 class="text-center text-2xl">Stay Connected</h1>
                    <div class="flex justify-center py-8">
                        <a href="#" class="fa fa-facebook mx-6" style="font-size: 40px"></a>
                        <a href="https://www.instagram.com/_ameer69/" class="fa fa-instagram mx-6" style="font-size: 40px"></a>
                        <a href="#" class="fa fa-twitter mx-6" style="font-size: 40px"></a>
                    </div>
                </div>

                <div class="w-full text-center">
                    <h1 class="text-4xl mb-[50px]">Our Mission</h1>
                    <p class="mx-auto">
                        ZeroSkill: Our mission is to build a community that considers themselves part of a family. A family that empowers each other to achieve their fitness goals that lead healthier, therefore happier lives. We strive to inspire the whole country to have this.
                    </p>
                </div>

                <div class="w-full text-center text-white">
                    <h1 class="text-2xl mb-6">Click Below Links</h1>
                    <ul class="space-y-2">
                        <li><a href="/" class="hover:text-red-500">Home</a></li>
                        <li><a href="/membership" class="text-white hover:text-red-500 py-1 px-4 rounded-3xl">Membership</a></li>
                        <li><a href="/contact" class="text-white py-1 px-4 hover:text-red-500 rounded-3xl">Contact</a></li>
                        <li><a href="/register" class="hover:text-red-500">Register</a></li>
                    </ul>
                </div>
            </div>
        </footer>

        <div>
            <p class="text-lg text-center bg-black/50 backdrop-blur-md text-white py-4">© 2024 Zeroskills. All rights reserved.</p>
        </div> --}}
    </body>
</x-guest-layout>
