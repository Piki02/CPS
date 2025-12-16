@extends('layouts.public')

@section('content')
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-4xl font-extrabold text-gray-900">{{ __('Our Services') }}</h1>
                <p class="mt-4 text-xl text-gray-500">{{ __('Comprehensive solutions for your business.') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('Product Sourcing') }}</h3>
                        <p class="text-gray-600">
                            {{ __('We help you find the right products at the right prices, ensuring quality and availability.') }}
                        </p>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('Order Management') }}</h3>
                        <p class="text-gray-600">
                            {{ __('Streamline your purchasing process with our intuitive order management system.') }}
                        </p>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('Logistics Support') }}</h3>
                        <p class="text-gray-600">
                            {{ __('We coordinate delivery and logistics to ensure your products arrive safely and on time.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
