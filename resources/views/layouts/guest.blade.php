<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="flex flex-row sm:justify-between pt-6 sm:pt-0">
            <div class="w-3/5">
                <img src="assets/img/high-angle-laptop-books.jpg" alt="" class="h-screen w-full object-cover">
            </div>

            <div class="w-2/5 px-[48px] py-4 bg-white overflow-hidden">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
