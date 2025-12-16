@extends('layouts.public')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-cps-blue via-blue-800 to-indigo-900 py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: url('{{ asset('img/BARCO.jpg') }}'); background-size: cover; background-position: center;"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-8">
                <img src="{{ asset('img/Logo Dorado.png') }}" alt="CPS Logo" class="h-24 w-auto mx-auto">
            </div>
            <h1 class="text-6xl font-extrabold text-white mb-6">{{ __('About Us') }}</h1>
            <div class="max-w-4xl mx-auto">
                <p class="text-2xl text-blue-100 leading-relaxed">
                    {{ __('CPS Caribbean Port Supply is a specialized company dedicated to providing high-quality marine, port, and industrial supplies to vessels, terminals, and logistics operators throughout the Caribbean region.') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-gray-50">
        <!-- Company Description -->
        <div class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center">
                    <p class="text-xl text-gray-700 leading-relaxed mb-6">
                        {{ __('We combine operational experience, reliable sourcing, and customer-oriented service to ensure that every delivery meets international maritime standards and strict port schedules.') }}
                    </p>
                    <p class="text-xl text-gray-700 leading-relaxed">
                        {{ __('Our commitment is to become a trusted partner for shipowners, agents, terminals, and offshore operations by delivering efficiency, safety, and reliability in every operation.') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Mission -->
                    <div class="bg-white rounded-2xl shadow-xl p-10 border-l-4 border-cps-blue">
                        <div class="flex items-center mb-6">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center w-16 h-16 bg-cps-blue rounded-xl">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                    </svg>
                                </div>
                            </div>
                            <h2 class="ml-4 text-3xl font-bold text-gray-900">{{ __('Mission') }}</h2>
                        </div>
                        <p class="text-lg text-gray-700 leading-relaxed">
                            {{ __('To provide high-quality marine, port, and industrial supplies by delivering reliable, efficient, and timely solutions that support our clients\' operations in ports and terminals across the Caribbean.') }}
                        </p>
                    </div>

                    <!-- Vision -->
                    <div class="bg-white rounded-2xl shadow-xl p-10 border-l-4 border-indigo-600">
                        <div class="flex items-center mb-6">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-xl">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <h2 class="ml-4 text-3xl font-bold text-gray-900">{{ __('Vision') }}</h2>
                        </div>
                        <p class="text-lg text-gray-700 leading-relaxed">
                            {{ __('To be a leading port and marine supply company in the Caribbean region, recognized for reliability, operational excellence, and adaptability to the needs of the international maritime market.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Objectives -->
        <div class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ __('Objectives') }}</h2>
                    <div class="w-24 h-1 bg-cps-blue mx-auto"></div>
                </div>
                <div class="grid md:grid-cols-2 gap-6 max-w-5xl mx-auto">
                    <div class="flex items-start bg-gray-50 p-6 rounded-xl border-l-4 border-cps-blue">
                        <svg class="w-6 h-6 text-cps-blue mr-4 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-gray-700 text-lg">{{ __('Ensure timely and reliable supply of products and services for port and marine operations.') }}</p>
                    </div>
                    <div class="flex items-start bg-gray-50 p-6 rounded-xl border-l-4 border-cps-blue">
                        <svg class="w-6 h-6 text-cps-blue mr-4 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-gray-700 text-lg">{{ __('Maintain high quality standards and regulatory compliance.') }}</p>
                    </div>
                    <div class="flex items-start bg-gray-50 p-6 rounded-xl border-l-4 border-cps-blue">
                        <svg class="w-6 h-6 text-cps-blue mr-4 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-gray-700 text-lg">{{ __('Build strong and long-term commercial relationships with our clients.') }}</p>
                    </div>
                    <div class="flex items-start bg-gray-50 p-6 rounded-xl border-l-4 border-cps-blue">
                        <svg class="w-6 h-6 text-cps-blue mr-4 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-gray-700 text-lg">{{ __('Continuously expand our product portfolio and regional coverage.') }}</p>
                    </div>
                    <div class="flex items-start bg-gray-50 p-6 rounded-xl border-l-4 border-cps-blue col-span-full">
                        <svg class="w-6 h-6 text-cps-blue mr-4 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-gray-700 text-lg">{{ __('Optimize logistics processes to reduce operational time and costs.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Purpose -->
        <div class="py-20 bg-gradient-to-br from-cps-blue to-blue-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-white mb-4">{{ __('Purpose') }}</h2>
                    <div class="w-24 h-1 bg-cps-gold mx-auto"></div>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-white/20">
                        <div class="flex items-center justify-center w-12 h-12 bg-cps-gold rounded-lg mb-4">
                            <svg class="w-6 h-6 text-cps-blue" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <p class="text-white text-lg">{{ __('Support efficient port and maritime operations.') }}</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-white/20">
                        <div class="flex items-center justify-center w-12 h-12 bg-cps-gold rounded-lg mb-4">
                            <svg class="w-6 h-6 text-cps-blue" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <p class="text-white text-lg">{{ __('Act as a strategic partner for our clients.') }}</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-white/20">
                        <div class="flex items-center justify-center w-12 h-12 bg-cps-gold rounded-lg mb-4">
                            <svg class="w-6 h-6 text-cps-blue" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <p class="text-white text-lg">{{ __('Facilitate access to reliable products in demanding operational environments.') }}</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-white/20">
                        <div class="flex items-center justify-center w-12 h-12 bg-cps-gold rounded-lg mb-4">
                            <svg class="w-6 h-6 text-cps-blue" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <p class="text-white text-lg">{{ __('Contribute to safer, more organized port operations.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Core Values -->
        <div class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ __('Core Values') }}</h2>
                    <div class="w-24 h-1 bg-cps-blue mx-auto"></div>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="text-center p-8 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl border-2 border-blue-200 hover:shadow-xl transition">
                        <div class="flex items-center justify-center w-16 h-16 bg-cps-blue rounded-full mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('Commitment') }}</h3>
                        <p class="text-gray-700">{{ __('We deliver what we promise.') }}</p>
                    </div>
                    <div class="text-center p-8 bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-2xl border-2 border-indigo-200 hover:shadow-xl transition">
                        <div class="flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-full mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('Responsibility') }}</h3>
                        <p class="text-gray-700">{{ __('We act with ethics and professionalism.') }}</p>
                    </div>
                    <div class="text-center p-8 bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl border-2 border-purple-200 hover:shadow-xl transition">
                        <div class="flex items-center justify-center w-16 h-16 bg-purple-600 rounded-full mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('Quality') }}</h3>
                        <p class="text-gray-700">{{ __('We supply products that meet international standards.') }}</p>
                    </div>
                    <div class="text-center p-8 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl border-2 border-blue-200 hover:shadow-xl transition">
                        <div class="flex items-center justify-center w-16 h-16 bg-cps-blue rounded-full mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('Efficiency') }}</h3>
                        <p class="text-gray-700">{{ __('We understand the urgency of the maritime industry.') }}</p>
                    </div>
                    <div class="text-center p-8 bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-2xl border-2 border-indigo-200 hover:shadow-xl transition">
                        <div class="flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-full mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('Trust') }}</h3>
                        <p class="text-gray-700">{{ __('We build long-term relationships.') }}</p>
                    </div>
                    <div class="text-center p-8 bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl border-2 border-purple-200 hover:shadow-xl transition">
                        <div class="flex items-center justify-center w-16 h-16 bg-purple-600 rounded-full mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('Customer Focus') }}</h3>
                        <p class="text-gray-700">{{ __('We tailor solutions to real operational needs.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ __('Why Clients Choose Us') }}</h2>
                    <div class="w-24 h-1 bg-cps-blue mx-auto"></div>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                    @foreach([
                        'Proven experience in port and maritime operations.',
                        'Fast response and personalized service.',
                        'Reliable, high-quality products.',
                        'Strong operational knowledge of port environments.',
                        'Flexibility to adapt to each operation.',
                        'Results-driven and practical solutions.'
                    ] as $reason)
                    <div class="flex items-start bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-8 h-8 bg-cps-blue rounded-full">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="ml-4 text-gray-700 text-lg">{{ __($reason) }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Quality Commitment -->
        <div class="py-20 bg-gradient-to-br from-gray-900 to-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto">
                    <div class="text-center mb-12">
                        <div class="flex items-center justify-center w-20 h-20 bg-cps-gold rounded-full mx-auto mb-6">
                            <svg class="w-10 h-10 text-cps-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h2 class="text-4xl font-bold text-white mb-6">{{ __('Our Commitment to Quality') }}</h2>
                        <div class="w-24 h-1 bg-cps-gold mx-auto mb-8"></div>
                    </div>
                    <div class="space-y-6 text-gray-300 text-lg leading-relaxed">
                        <p>
                            {{ __('At CPS Caribbean Port Supply, quality is a fundamental pillar of every operation. We are committed to supplying products that comply with international standards and the operational requirements of the maritime and port industries.') }}
                        </p>
                        <p>
                            {{ __('We work with trusted suppliers and apply rigorous selection processes to ensure that every product delivered is safe, reliable, and suitable for demanding environments. We understand that time, safety, and accuracy are critical in port operations, which is why we ensure timely deliveries and continuous control throughout the supply chain.') }}
                        </p>
                        <p>
                            {{ __('Our focus on quality goes beyond products—it is reflected in our service through clear communication, prompt response, and solutions tailored to each client\'s needs. This approach allows us to position ourselves as a reliable and responsible partner within the maritime logistics chain.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
