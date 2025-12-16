<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-cps-blue via-blue-800 to-blue-900 flex items-center justify-center p-6">
        <div class="w-full max-w-7xl">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <div class="grid lg:grid-cols-5">
                    <!-- Left Side - Branding (2 columns) -->
                    <div class="lg:col-span-2 bg-gradient-to-br from-cps-blue to-blue-900 p-16 flex flex-col items-center justify-center text-white relative overflow-hidden min-h-[600px]">
                        <!-- Decorative circles -->
                        <div class="absolute top-10 left-10 w-40 h-40 bg-cps-gold rounded-full opacity-20"></div>
                        <div class="absolute bottom-20 right-10 w-48 h-48 bg-blue-400 rounded-full opacity-10"></div>
                        <div class="absolute top-1/2 left-1/4 w-32 h-32 bg-indigo-400 rounded-full opacity-15"></div>
                        
                        <div class="relative z-10 text-center">
                            <!-- Logo -->
                            <div class="mb-10">
                                <img src="{{ asset('img/Logo Dorado.png') }}" alt="CPS Logo" class="h-40 w-auto mx-auto">
                            </div>
                            
                            <!-- Title -->
                            <h1 class="text-5xl font-extrabold mb-6">{{ __('Store Access') }}</h1>
                            <p class="text-2xl text-blue-100 mb-12 leading-relaxed max-w-lg">
                                {{ __('Enter your unique access token to browse our exclusive product catalog.') }}
                            </p>
                            
                            <!-- Icon -->
                            <div class="inline-flex items-center justify-center w-28 h-28 bg-white/10 backdrop-blur-sm rounded-full border-4 border-white/20 mb-8">
                                <svg class="w-14 h-14 text-cps-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                            </div>
                            
                            <p class="text-blue-200 text-lg">
                                {{ __('Secure Access') }} • {{ __('Premium Products') }}
                            </p>
                        </div>
                    </div>

                    <!-- Right Side - Form (3 columns) -->
                    <div class="lg:col-span-3 p-16 flex flex-col justify-center bg-gray-50">
                        <div class="max-w-xl mx-auto w-full">
                            <!-- Header -->
                            <div class="mb-10">
                                <h2 class="text-4xl font-bold text-gray-900 mb-3">{{ __('Enter Token') }}</h2>
                                <p class="text-xl text-gray-600">{{ __('Unlock access to our exclusive store') }}</p>
                            </div>

                            <!-- Error Message -->
                            @if(session('error'))
                                <div class="mb-8 bg-red-50 border-l-4 border-red-500 rounded-lg p-5 animate-shake">
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="font-medium text-red-800 text-lg">{{ session('error') }}</span>
                                    </div>
                                </div>
                            @endif

                            <!-- Form -->
                            <form method="POST" action="{{ route('token.validate') }}" class="space-y-8">
                                @csrf
                                
                                <!-- Token Input -->
                                <div>
                                    <label for="token" class="block text-lg font-bold text-gray-700 mb-4">
                                        {{ __('Access Token') }}
                                    </label>
                                    <div class="relative">
                                        <input 
                                            type="text" 
                                            name="token" 
                                            id="token" 
                                            class="block w-full px-8 py-5 text-2xl border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-cps-blue/20 focus:border-cps-blue transition duration-200 text-center tracking-widest font-mono uppercase placeholder-gray-400 bg-white shadow-sm"
                                            placeholder="XXXX-XXXX-XXXX"
                                            required 
                                            autofocus
                                            maxlength="14"
                                        >
                                        <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none">
                                            <svg class="h-7 w-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    @error('token')
                                        <p class="mt-3 text-base text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <button 
                                    type="submit" 
                                    class="w-full bg-gradient-to-r from-cps-blue to-blue-700 text-white font-bold py-5 px-8 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-4 group text-xl"
                                >
                                    <span>{{ __('Access Store') }}</span>
                                    <svg class="w-7 h-7 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </button>
                            </form>

                            <!-- Info Box -->
                            <div class="mt-10 bg-blue-50 border-l-4 border-cps-blue rounded-lg p-5">
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-cps-blue mt-0.5 mr-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    <div class="text-base">
                                        <p class="font-semibold text-gray-900 mb-2">{{ __('Need a token?') }}</p>
                                        <p class="text-gray-700">{{ __('Contact your branch administrator to receive an access token.') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Back Link -->
                            <div class="mt-8 text-center">
                                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-cps-blue transition duration-200 text-base font-medium">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    {{ __('Back to Home') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        .animate-shake {
            animation: shake 0.5s;
        }
    </style>
</x-guest-layout>
