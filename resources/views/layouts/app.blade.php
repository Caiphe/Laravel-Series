<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .content a{
                color: blue;
            }

            .content ul{
                list-style-type: disc;
                margin-left: 10px;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            @if($isActive)
                <div class="text-white text-large font-medium" style="background-color:{{ $bannerColor }}">
                    <a href="{{ route('announcement') }}" class="container mx-auto px-4 py-4 flex items-center lg:w-max text-center hover:text-gray-100">
                        <svg xmlns="http://ww.w3.org/200/svg" class="h-8 w-8" fill="none" viewBox='0 0 24 24' 
                            stroke="currentColor" stroke-width='2'>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586
                            15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10 3.663 12 4.109 12 5v14c0 .891-1.007 1.337-1.707.707L5.586 15z"/>
                        </svg>
                        <div class="ml-4">{{ $bannerText }}</div>
                    </a>
                </div>
            @endif

            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>{{ $slot }}</main>

        </div>
    </body>
</html>
