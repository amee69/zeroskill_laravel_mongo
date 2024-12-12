<x-guest-layout>
    <br><br><br><br>
    <div class="m-2">
    <div class="max-w-md mx-auto mt-20 px-10 py-12 bg-black/50 border-2 border-white backdrop-blur-md rounded-3xl shadow-lg mb-9">
        <h1 class="text-3xl font-bold mb-6 text-center text-white">Login</h1>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Field -->
            <div class="flex flex-col">
                <x-label for="email" class="text-lg font-semibold mb-2 text-white" value="{{ __('Email') }}" />
                <x-input id="email" class="p-3 rounded bg-black/50 w-full text-white" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <!-- Password Field -->
            <div class="flex flex-col">
                <x-label for="password" class="text-lg font-semibold mb-2 text-white" value="{{ __('Password') }}" />
                <x-input id="password" class="p-3 rounded bg-black/50 w-full text-white" type="password" name="password" required autocomplete="current-password" />
            </div>

            <!-- Remember Me and Forgot Password -->
            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="flex items-center text-white">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-300">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-300 hover:text-gray-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <div class="text-center mt-6">
                <x-button class="bg-black/70 text-white px-6 py-2 rounded-3xl border-2 border-white hover:bg-red-700 transition-all duration-300">
                    {{ __('Login') }}
                </x-button>
            </div>

            <!-- Register Link -->
            <div class="text-center mt-4">
                <p class="text-white">Don't have an account? Make One</p>
                <a href="{{ route('register') }}" class="text-white px-6 py-2 mt-2 rounded-3xl border-2 border-red-700 hover:bg-red-700 transition-all duration-300 inline-block">
                    {{ __('Register') }}
                </a>
            </div>
        </form>
    </div>
</div>
</x-guest-layout>
