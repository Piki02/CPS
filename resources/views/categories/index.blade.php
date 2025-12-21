<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-3xl text-gray-800 leading-tight tracking-tight">
                    {{ __('Categories') }}
                </h2>
                <p class="text-sm font-medium text-gray-500 mt-1">
                    {{ __('Organize your inventory with custom product categories.') }}</p>
            </div>
            <a href="{{ route('categories.create') }}"
                class="bg-cps-blue text-white font-black py-2.5 px-6 rounded-2xl hover:bg-blue-800 transition-all duration-300 flex items-center shadow-lg shadow-blue-900/20 active:scale-95 text-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                {{ __('Add Category') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Search -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                <form action="{{ route('categories.index') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="md:col-span-3 relative group">
                            <label
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">{{ __('Search Categories') }}</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-cps-blue transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="{{ __('Search by name...') }}"
                                    class="block w-full pl-12 pr-4 py-3.5 bg-gray-50 border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-cps-blue transition-all font-medium text-gray-700 placeholder-gray-400 shadow-inner">
                            </div>
                        </div>

                        <div class="flex items-end gap-3">
                            <button type="submit"
                                class="flex-1 bg-gray-900 text-white font-bold py-3.5 px-6 rounded-2xl hover:bg-black transition-all shadow-lg active:scale-95">
                                {{ __('Filter') }}
                            </button>
                            @if(request('search'))
                                <a href="{{ route('categories.index') }}"
                                    class="p-3.5 bg-gray-100 text-gray-500 rounded-2xl hover:bg-red-50 hover:text-red-500 transition-all shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <!-- Categories List -->
            <div class="space-y-4">
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden px-4">
                    <table class="min-w-full divide-y-8 divide-white border-separate border-spacing-y-4">
                        <thead class="bg-white sticky top-0 z-10">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[2px]">
                                    {{ __('Category Name') }}</th>
                                <th
                                    class="px-6 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-[2px]">
                                    {{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr class="group hover:bg-blue-50/30 transition-all duration-300">
                                    <td
                                        class="px-6 py-5 bg-gray-50 group-hover:bg-white rounded-l-[1.5rem] border-y border-l border-transparent group-hover:border-blue-100 transition-all shadow-sm">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-12 h-12 rounded-xl bg-blue-50 text-cps-blue flex items-center justify-center font-black text-lg group-hover:bg-cps-blue group-hover:text-white transition-all shadow-sm">
                                                {{ substr($category->name, 0, 1) }}
                                            </div>
                                            <p class="text-base font-black text-gray-900 tracking-tight">
                                                {{ $category->name }}</p>
                                        </div>
                                    </td>
                                    <td
                                        class="px-6 py-5 bg-gray-50 group-hover:bg-white rounded-r-[1.5rem] border-y border-r border-transparent group-hover:border-blue-100 text-right transition-all shadow-sm">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('categories.edit', $category) }}"
                                                class="p-2.5 text-cps-blue bg-white rounded-xl border border-gray-200 hover:bg-cps-blue hover:text-white hover:border-cps-blue hover:shadow-lg transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                                class="inline-block delete-form" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2.5 text-red-500 bg-white rounded-xl border border-gray-200 hover:bg-red-500 hover:text-white hover:border-red-500 hover:shadow-lg transition-all delete-btn">
                                                    <svg class="w-5 h-5 pointer-events-none" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="py-20 text-center">
                                        <div
                                            class="bg-gray-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 border-2 border-dashed border-gray-200">
                                            <svg class="w-12 h-12 text-gray-200" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                        </div>
                                        <h4 class="text-xl font-black text-gray-800">{{ __('No categories found') }}</h4>
                                        <p class="text-gray-500 font-medium mt-2">
                                            {{ __('Create your first category to start organizing your products.') }}</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 px-4">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>