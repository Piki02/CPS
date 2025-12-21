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
                            <label class="block text-gray-700 text-sm font-bold mb-2">{{ __('Product Image') }}</label>

                            <div x-data="imageUpload('{{ $product->image_path ? asset($product->image_path) : '' }}')"
                                @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false"
                                @drop.prevent="handleDrop($event)" @paste.window="handlePaste($event)"
                                class="relative border-2 border-dashed rounded-lg p-6 transition-colors duration-200"
                                :class="isDragging ? 'border-cps-blue bg-blue-50' : 'border-gray-300 hover:border-gray-400'">

                                <input type="file" name="image" id="image" class="hidden"
                                    @change="handleFileSelect($event)" accept="image/*">

                                <div class="text-center" x-show="!imageUrl">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48" aria-hidden="true">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="mt-4 flex text-sm text-gray-600 justify-center">
                                        <button type="button" @click="document.getElementById('image').click()"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-cps-blue hover:text-blue-500 focus-within:outline-none">
                                            <span>{{ __('Upload a file') }}</span>
                                        </button>
                                        <p class="pl-1">{{ __('or drag and drop') }}</p>
                                    </div>
                                    <p class="text-xs text-gray-500">{{ __('PNG, JPG, GIF up to 10MB') }}</p>
                                    <p class="text-xs text-gray-400 mt-2">
                                        {{ __('You can also paste an image from your clipboard') }}</p>
                                </div>

                                <div class="relative" x-show="imageUrl" x-cloak>
                                    <img :src="imageUrl" class="max-h-64 mx-auto rounded-lg shadow-md">
                                    <button type="button" @click="clearImage()"
                                        class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition shadow-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <p class="text-gray-600 text-xs mt-1">{{ __('Leave blank to keep current image.') }}</p>
                            @error('image') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                        </div>

                        <script>
                            function imageUpload(initialUrl) {
                                return {
                                    isDragging: false,
                                    imageUrl: initialUrl || null,
                                    handleFileSelect(event) {
                                        const file = event.target.files[0];
                                        this.previewFile(file);
                                    },
                                    handleDrop(event) {
                                        this.isDragging = false;
                                        const file = event.dataTransfer.files[0];
                                        if (file && file.type.startsWith('image/')) {
                                            const dataTransfer = new DataTransfer();
                                            dataTransfer.items.add(file);
                                            document.getElementById('image').files = dataTransfer.files;
                                            this.previewFile(file);
                                        }
                                    },
                                    handlePaste(event) {
                                        const items = (event.clipboardData || event.originalEvent.clipboardData).items;
                                        for (let index in items) {
                                            const item = items[index];
                                            if (item.kind === 'file' && item.type.startsWith('image/')) {
                                                const file = item.getAsFile();
                                                const dataTransfer = new DataTransfer();
                                                dataTransfer.items.add(file);
                                                document.getElementById('image').files = dataTransfer.files;
                                                this.previewFile(file);
                                                break;
                                            }
                                        }
                                    },
                                    previewFile(file) {
                                        if (!file) return;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            this.imageUrl = e.target.result;
                                        };
                                        reader.readAsDataURL(file);
                                    },
                                    clearImage() {
                                        this.imageUrl = null;
                                        document.getElementById('image').value = '';
                                    }
                                }
                            }
                        </script>

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