<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @if (tenant() == true)
            <title>@yield('title') {{ tenant('company') }}</title>
        @else
            <title>@yield('title') {{ config('app.name', 'Laravel') }}</title>
        @endif

        <link rel="shortcut icon" href="/svgs/logo.svg" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow shadow-gray-200 dark:bg-gray-800">
                <div class="px-4 py-6 mx-auto sm:flex sm:items-center sm:justify-between max-w-7xl sm:px-6 lg:px-8">
                    <h2 class="text-xl font-semibold leading-tight text-gray-700 dark:text-gray-200">
                        @yield('header')
                    </h2>

                    <div class="mt-4 sm:mt-0">
                        @yield('action')
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <x-alert />
                @yield('content')
            </main>
        </div>
    </body>
</html>
