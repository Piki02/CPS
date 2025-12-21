<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('Img/Logo Dorado.png') }}" type="image/png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900">
    <div class="min-h-screen flex items-center justify-center relative overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('Img/Banner.png') }}" alt="Background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/50"></div>
        </div>

        <!-- Token Access Card -->
        <div class="relative z-10 w-full max-w-md px-6">
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-2xl p-8">
                <!-- Logo -->
                <div class="flex justify-center mb-8">
                    <a href="/">
                        <img src="{{ asset('Img/Logo sin Fondo.png') }}" alt="CPS Logo" class="h-32 w-auto drop-shadow-lg brightness-0 invert">
                    </a>
                </div>

                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-white mb-2">{{ __('Store Access') }}</h2>
                    <p class="text-gray-200 text-sm">{{ __('Enter your unique access token to browse our exclusive product catalog.') }}</p>
                </div>

                <!-- Error Message -->
                @if(session('error'))
                    <div class="mb-6 bg-red-500/20 border border-red-500/50 rounded-lg p-4 animate-shake">
                        <div class="flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-200 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-red-100 text-sm font-medium">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('token.validate') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Token Input -->
                    <div>
                        <label for="token" class="block text-sm font-medium text-gray-200 mb-1">{{ __('Access Token') }}</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                name="token" 
                                id="token" 
                                class="block w-full pl-10 pr-3 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 text-center tracking-widest font-mono uppercase text-lg"
                                placeholder="XXXX-XXXX-XXXX"
                                required 
                                autofocus
                                maxlength="14"
                            >
                        </div>
                        @error('token')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 transform hover:scale-[1.02]">
                        {{ __('Access Store') }}
                    </button>
                </form>

                <!-- Back Link -->
                <div class="mt-8 text-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-gray-300 hover:text-white transition duration-200 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        {{ __('Back to Home') }}
                    </a>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="mt-8 text-center text-gray-400 text-xs">
                &copy; {{ date('Y') }} Caribbean Port Supply. All rights reserved.
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
</body>
</html>
