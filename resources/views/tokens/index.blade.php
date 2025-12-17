<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Store Access Tokens') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-cps-blue mb-8">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ __('Generate New Token') }}</h3>
                        <p class="text-gray-600">{{ __('Generate a temporary access token for customers to view the store.') }}</p>
                    </div>
                    
                    <form action="{{ route('tokens.generate') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="captain_name" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Captain Name') }}
                            </label>
                            <input 
                                type="text" 
                                name="captain_name" 
                                id="captain_name"
                                required
                                placeholder="{{ __('Enter captain name...') }}"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-cps-blue focus:border-cps-blue"
                            >
                            @error('captain_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="vessel_name" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Vessel Name') }}
                            </label>
                            <input 
                                type="text" 
                                name="vessel_name" 
                                id="vessel_name"
                                placeholder="{{ __('Enter vessel name...') }}"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-cps-blue focus:border-cps-blue"
                            >
                            @error('vessel_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="bg-cps-blue text-white font-bold py-3 px-8 rounded-lg hover:bg-blue-800 transition duration-300 shadow-md inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            {{ __('Generate New Token') }}
                        </button>
                    </form>
                    
                    @if(session('success'))
                        <div class="mt-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <div class="flex-1">
                                    <p class="font-semibold mb-1">{{ __('Token Generated!') }}</p>
                                    <p class="text-sm">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-gray-300">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-gray-800">{{ __('Recent Tokens') }}</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Token') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Captain') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Vessel') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Created At') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($tokens as $token)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-mono font-bold text-cps-blue">{{ $token->token }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $token->captain_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $token->vessel_name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $token->created_at->diffForHumans() }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($token->is_active)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ __('Active') }}
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                {{ __('Inactive') }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
