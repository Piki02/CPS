<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-cps-blue">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="page" value="{{ request('page') }}">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="category" value="{{ request('category') }}">

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name"
                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                value="{{ old('name', $product->name) }}" required autofocus>
                            @error('name') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-4">
                            <label for="category_id"
                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Category') }}</label>
                            <select name="category_id" id="category_id"
                                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                                <option value="">{{ __('Select Category') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('category_id') ?? $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <label for="price"
                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Price') }}</label>
                            <input type="number" step="0.01" name="price" id="price"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                value="{{ old('price', $product->price) }}" required>
                            @error('price') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                        </div>

                        <!-- Unit -->
                        <div class="mb-4">
                            <label for="unit"
                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Unit') }}</label>
                            <input type="text" name="unit" id="unit"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                value="{{ old('unit', $product->unit) }}" required>
                            @error('unit') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                        </div>

                        <!-- Image -->
                        <div class="mb-6">
                            <label for="image"
                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Product Image') }}</label>
                            @if($product->image_path)
                                <div class="mb-2">
                                    <img src="{{ asset($product->image_path) }}" alt="Current Image"
                                        class="h-20 w-20 object-cover rounded">
                                </div>
                            @endif
                            <input type="file" name="image" id="image"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <p class="text-gray-600 text-xs mt-1">{{ __('Leave blank to keep current image.') }}</p>
                            @error('image') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="bg-cps-blue text-white font-bold py-2 px-4 rounded hover:bg-blue-800 transition duration-300">
                                {{ __('Update Product') }}
                            </button>
                            <a href="{{ route('products.index') }}"
                                class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>