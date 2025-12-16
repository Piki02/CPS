<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Bar -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-cps-blue mb-6">
                <div class="p-6">
                    <form action="{{ route('categories.index') }}" method="GET">
                        <div class="flex gap-4">
                            <!-- Search Input -->
                            <div class="flex-1">
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Search Categories') }}</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        name="search" 
                                        id="search"
                                        value="{{ request('search') }}"
                                        placeholder="{{ __('Search by category name...') }}"
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-cps-blue focus:border-cps-blue"
                                    >
                                </div>
                            </div>

                            <!-- Search Button -->
                            <div class="flex items-end">
                                <button type="submit" class="bg-cps-blue text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-800 transition duration-300 inline-flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    {{ __('Search') }}
                                </button>
                            </div>

                            @if(request('search'))
                            <!-- Clear Button -->
                            <div class="flex items-end">
                                <a href="{{ route('categories.index') }}" class="bg-gray-500 text-white font-bold py-2 px-6 rounded-lg hover:bg-gray-600 transition duration-300 inline-flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    {{ __('Clear') }}
                                </a>
                            </div>
                            @endif
                        </div>

                        <!-- Active Search Display -->
                        @if(request('search'))
                        <div class="mt-4 flex items-center gap-2">
                            <span class="text-sm text-gray-600 font-medium">{{ __('Searching for:') }}</span>
                            <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                "{{ request('search') }}"
                            </span>
                        </div>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Categories Table -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-cps-blue">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-800">{{ __('Category List') }}</h3>
                        <a href="{{ route('categories.create') }}" class="bg-cps-blue text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-800 transition duration-300 inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            {{ __('Add New Category') }}
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($categories as $category)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $category->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('categories.edit', $category) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">{{ __('Edit') }}</a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
