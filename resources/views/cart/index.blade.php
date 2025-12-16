@extends('layouts.public')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">{{ __('Shopping Cart') }}</h1>
            <p class="text-lg text-gray-600">{{ __('Review your items before checkout') }}</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded-r shadow-sm" role="alert">
                <p class="font-bold">{{ __('Success') }}</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-8 rounded-r shadow-sm" role="alert">
                <p class="font-bold">{{ __('Error') }}</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if(count($cart) > 0)
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items -->
                <div class="flex-1">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="text-xl font-bold text-gray-800">{{ __('Items in Cart') }} ({{ count($cart) }})</h2>
                        </div>
                        
                        <!-- Desktop Table View -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-gray-50 text-gray-600 font-medium text-sm uppercase tracking-wider">
                                    <tr>
                                        <th class="px-6 py-4">{{ __('Product') }}</th>
                                        <th class="px-6 py-4 text-center">{{ __('Price') }}</th>
                                        <th class="px-6 py-4 text-center">{{ __('Quantity') }}</th>
                                        <th class="px-6 py-4 text-right">{{ __('Total') }}</th>
                                        <th class="px-6 py-4"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($cart as $id => $details)
                                        <tr class="hover:bg-gray-50 transition duration-150">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-4">
                                                    <div class="w-16 h-16 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                                                        @if($details['image'])
                                                            <img src="{{ asset($details['image']) }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                                                        @else
                                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <h3 class="font-bold text-gray-900">{{ $details['name'] }}</h3>
                                                        <p class="text-sm text-gray-500">{{ $details['unit'] ?? 'Unit' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-center text-gray-600">
                                                ${{ number_format($details['price'], 2) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex justify-center">
                                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-20 text-center border-gray-300 rounded-lg focus:ring-cps-blue focus:border-cps-blue shadow-sm" onchange="this.form.submit()">
                                                    </form>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right font-bold text-cps-blue">
                                                ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-400 hover:text-red-600 p-2 rounded-full hover:bg-red-50 transition" title="{{ __('Remove item') }}">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-2.133-1.958L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="md:hidden divide-y divide-gray-100">
                            @foreach($cart as $id => $details)
                                <div class="p-4 flex items-start gap-4">
                                    <!-- Image -->
                                    <div class="w-20 h-20 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                                        @if($details['image'])
                                            <img src="{{ asset($details['image']) }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex justify-between items-start mb-1">
                                            <h3 class="font-bold text-gray-900 truncate pr-4">{{ $details['name'] }}</h3>
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-400 hover:text-red-500 transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                        
                                        <p class="text-sm text-gray-500 mb-3">${{ number_format($details['price'], 2) }} / {{ $details['unit'] ?? 'Unit' }}</p>
                                        
                                        <div class="flex items-center justify-between">
                                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center">
                                                @csrf
                                                @method('PATCH')
                                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-16 text-center text-sm border-gray-300 rounded-lg focus:ring-cps-blue focus:border-cps-blue shadow-sm p-1" onchange="this.form.submit()">
                                            </form>
                                            
                                            <span class="font-bold text-cps-blue">
                                                ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <a href="{{ route('store') }}" class="inline-flex items-center text-cps-blue hover:text-blue-800 font-medium transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            {{ __('Continue Shopping') }}
                        </a>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:w-96">
                    <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">{{ __('Order Summary') }}</h2>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>{{ __('Subtotal') }}</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>{{ __('Tax') }} (0%)</span>
                                <span>$0.00</span>
                            </div>
                            <div class="border-t border-gray-100 pt-4 flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900">{{ __('Total') }}</span>
                                <span class="text-2xl font-bold text-cps-blue">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <form action="{{ route('cart.checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-gradient-to-r from-cps-blue to-blue-700 text-white font-bold py-4 px-6 rounded-xl hover:from-blue-700 hover:to-blue-800 transition duration-300 shadow-lg hover:shadow-xl flex items-center justify-center gap-2 group">
                                {{ __('Proceed to Checkout') }}
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart State -->
            <div class="bg-white rounded-2xl shadow-lg p-16 text-center max-w-2xl mx-auto">
                <div class="mb-6">
                    <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mx-auto">
                        <svg class="w-12 h-12 text-cps-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ __('Your cart is empty') }}</h2>
                <p class="text-gray-600 mb-8">{{ __('Looks like you haven\'t added any items to your cart yet.') }}</p>
                <a href="{{ route('store') }}" class="inline-flex items-center gap-2 bg-cps-blue text-white font-bold py-3 px-8 rounded-xl hover:bg-blue-800 transition duration-300 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Start Shopping') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
