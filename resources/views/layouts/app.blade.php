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
        <!-- Ajout de la police Inter -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">


        <!-- Scripts Vite pour compiler CSS et JS -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles Livewire -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen bg-gray-100">
            <!-- Inclut la barre de navigation de Breeze -->
            @include('layouts.navigation')

            <!-- Section d'en-tête de page -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Contenu principal de la page -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <!-- Scripts Livewire -->
        @livewireScripts
    </body>
</html>