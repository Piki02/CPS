<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset('Img/Logo Dorado.png') }}" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen bg-gray-100 flex">
            @include('layouts.sidebar')

            <div class="flex-1 flex flex-col md:ml-64 transition-all duration-300">
                <div class="md:hidden">
                    @include('layouts.navigation')
                </div>

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow border-b border-cps-blue">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
        </div>

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Toast Configuration
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            // Success Message
            @if(session('success'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('success') }}'
                });
            @endif

            // Error Message
            @if(session('error'))
                Toast.fire({
                    icon: 'error',
                    title: '{{ session('error') }}'
                });
            @endif

            // Validation Errors
            @if($errors->any())
                Toast.fire({
                    icon: 'error',
                    title: 'Please check the form for errors.'
                });
            @endif

            // Global Delete Confirmation
            document.addEventListener('DOMContentLoaded', function() {
                document.body.addEventListener('click', function(e) {
                    if (e.target.classList.contains('delete-btn')) {
                        e.preventDefault();
                        const button = e.target;
                        const form = button.closest('.delete-form');
                        
                        Swal.fire({
                            title: '{{ __("Are you sure?") }}',
                            text: '{{ __("You will not be able to recover this item!") }}',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: '{{ __("Yes, delete it!") }}',
                            cancelButtonText: '{{ __("Cancel") }}'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>
