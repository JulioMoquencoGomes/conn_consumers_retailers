<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Home') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <link href="{{ config('app.url','') }}/build/assets/bootstrap-CB61jlRJ.css" rel="stylesheet"/>
        <script type="module" src="{{ config('app.url', '') }}/build/assets/bootstrap.bundle.min-BOEsi5Is.js"></script>
        <link href="{{ config('app.url', '') }}/build/assets/app-CnYWIchi.css" rel="stylesheet"/>
        <script type="module" src="{{ config('app.url', '') }}/build/assets/app-Cs0QkU1O.js"></script>

        <style>
            table { font-size: 2vw; }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <img width="150" src="/imgs/logo.png"/>
                </a>
            </div>

            <!--<div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">-->
            <div>
                {{ $slot }}
            </div>
        </div>

        <div class="py-12 bg-gray-100">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <img width="100%" src="/imgs/banner.png"/>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
