<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Import / Export Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Import Section -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-cps-blue">
                    <div class="p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-8 h-8 text-cps-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">{{ __('Import Products') }}</h3>
                                <p class="text-sm text-gray-600">{{ __('Upload CSV file to import products') }}</p>
                            </div>
                        </div>

                        <!-- CSV Structure Info -->
                        <div class="bg-blue-50 border-l-4 border-cps-blue p-4 mb-6 rounded">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-cps-blue mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-900 mb-2">{{ __('Required CSV Structure:') }}</p>
                                    <code class="bg-white px-2 py-1 rounded text-xs font-mono block">
                                        No, Categories, Product, Unit, Price
                                    </code>
                                    <p class="text-gray-700 mt-2 text-xs">{{ __('Example: 1, Electronics, Laptop, Unit, 999.99') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Import Form -->
                        <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data" id="importForm">
                            @csrf
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-3">{{ __('Select CSV File') }}</label>
                                <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-cps-blue transition duration-300">
                                    <input 
                                        type="file" 
                                        name="file" 
                                        id="file" 
                                        accept=".csv,.xlsx,.xls"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                        required
                                        onchange="updateFileName(this)"
                                    >
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-600">
                                            <span class="font-semibold text-cps-blue">{{ __('Click to upload') }}</span> {{ __('or drag and drop') }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1" id="fileName">{{ __('CSV, XLSX, XLS (Max 10MB)') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Warning Alert -->
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-yellow-400 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <div class="text-sm">
                                        <p class="font-semibold text-yellow-800">{{ __('Warning') }}</p>
                                        <p class="text-yellow-700 text-xs mt-1">{{ __('Products with the same name will be updated. New products will be added.') }}</p>
                                    </div>
                                </div>
                            </div>

                            <button 
                                type="button"
                                onclick="confirmImport()"
                                class="w-full bg-cps-blue text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-800 transition duration-300 shadow-md inline-flex items-center justify-center"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                {{ __('Import Products') }}
                            </button>
                        </form>

                        @if(session('success'))
                            <div class="mt-4 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="font-medium">{{ session('success') }}</span>
                                </div>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mt-4 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="font-medium">{{ session('error') }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Export Section -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-green-500">
                    <div class="p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">{{ __('Export Products') }}</h3>
                                <p class="text-sm text-gray-600">{{ __('Download all products as CSV') }}</p>
                            </div>
                        </div>

                        <!-- Export Info -->
                        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-900 mb-2">{{ __('Export Format:') }}</p>
                                    <ul class="text-gray-700 space-y-1 text-xs">
                                        <li>• {{ __('CSV format with UTF-8 encoding') }}</li>
                                        <li>• {{ __('Includes all current products') }}</li>
                                        <li>• {{ __('Structure: No, Categories, Product, Unit, Price') }}</li>
                                        <li>• {{ __('Ready for re-import') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Export Stats -->
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-gray-50 p-4 rounded-lg text-center">
                                <p class="text-3xl font-bold text-cps-blue">{{ \App\Models\Product::count() }}</p>
                                <p class="text-sm text-gray-600 mt-1">{{ __('Total Products') }}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg text-center">
                                <p class="text-3xl font-bold text-green-600">{{ \App\Models\Category::count() }}</p>
                                <p class="text-sm text-gray-600 mt-1">{{ __('Categories') }}</p>
                            </div>
                        </div>

                        <a 
                            href="{{ route('products.export') }}"
                            class="block w-full bg-green-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-green-700 transition duration-300 shadow-md text-center"
                        >
                            <div class="inline-flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                {{ __('Download CSV') }}
                            </div>
                        </a>

                        <p class="text-xs text-gray-500 text-center mt-4">
                            {{ __('File will be named: products_export_YYYY-MM-DD_HHMMSS.csv') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-6 text-center">
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-cps-blue transition duration-200 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Back to Products') }}
                </a>
            </div>
        </div>
    </div>

    <script>
        function updateFileName(input) {
            const fileName = input.files[0]?.name || 'CSV, XLSX, XLS (Max 10MB)';
            document.getElementById('fileName').textContent = fileName;
        }

        function confirmImport() {
            const fileInput = document.getElementById('file');
            
            if (!fileInput.files.length) {
                alert('{{ __("Please select a file to import.") }}');
                return;
            }

            if (confirm('{{ __("Are you sure? Products with the same name will be updated, and new products will be added.") }}')) {
                document.getElementById('importForm').submit();
            }
        }
    </script>
</x-app-layout>
