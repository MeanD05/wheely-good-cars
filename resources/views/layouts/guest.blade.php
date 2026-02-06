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
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <a href="/">
                <x-application-logo />
            </a>
        </div>

        <!-- Back Button -->
        <div class="w-full sm:max-w-md flex justify-start mb-4">
            <a href="{{ route('home') }}" 
               class="text-white bg-black hover:bg-gray-800 font-semibold py-2 px-4 rounded shadow">
                &larr; Back
            </a>
        </div>

        <!-- Form / Page Content Slot -->
        <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
