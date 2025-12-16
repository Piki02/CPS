<x-guest-layout>
    <div class="flex flex-col md:flex-row h-screen bg-gray-100">
        <!-- Left Side - Branding -->
        <div class="md:w-1/2 bg-cps-blue flex flex-col justify-center items-center text-white p-10 relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-20"></div>
            <div class="relative z-10 text-center">
                <a href="/" class="mb-8 inline-block">
                    <img src="{{ asset('img/Logo.png') }}" alt="CPS Logo" class="h-24 w-auto brightness-0 invert">
                </a>
                <h1 class="text-4xl font-serif font-bold mb-4">{{ __('Welcome Back') }}</h1>
                <p class="text-lg text-gray-200 max-w-md mx-auto">{{ __('Access your dashboard to manage orders, products, and more.') }}</p>
            </div>
            <!-- Decorative Circles -->
            <div class="absolute -top-20 -left-20 w-64 h-64 bg-blue-800 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
            <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-indigo-800 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="md:w-1/2 flex items-center justify-center p-10">
            <div class="w-full max-w-md">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">{{ __('Log In') }}</h2>
                
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full focus:border-cps-blue focus:ring-cps-blue" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full focus:border-cps-blue focus:ring-cps-blue" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-cps-blue shadow-sm focus:ring-cps-blue" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cps-blue" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-primary-button class="ml-4 bg-cps-blue hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-900">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
