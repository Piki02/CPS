@extends('layouts.public')

@section('content')
<div class="bg-gray-50 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-xl text-center">
        <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-100 mb-6">
            <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        
        <div>
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                {{ __('Order Placed Successfully!') }}
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                {{ __('Thank you for your order. Your order number is') }} <span class="font-bold text-gray-900">#{{ $order->id }}</span>.
            </p>
            <p class="mt-2 text-sm text-gray-600">
                {{ __('We have received your request and will process it shortly.') }}
            </p>
        </div>

        <div class="mt-8 space-y-4">
            <a href="{{ route('store') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-cps-blue hover:bg-blue-800 md:py-4 md:text-lg transition duration-300 shadow-md">
                {{ __('Return to Store') }}
            </a>
            
            @if(Auth::check() && Auth::user()->hasAnyRole(['Branch Store', 'Admin']))
                <a href="{{ route('dashboard') }}" class="w-full flex items-center justify-center px-8 py-3 border-2 border-gray-200 text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 md:py-4 md:text-lg transition duration-300">
                    {{ __('Go to Dashboard') }}
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
