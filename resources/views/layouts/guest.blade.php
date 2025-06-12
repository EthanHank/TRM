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

    <!-- Custom Styles -->
    <style>
        .custom-bg {
            background-color: #e8f5e9 !important;
        }

        .custom-container {
            background-color: rgb(1, 84, 95) !important;
            border: 1px solid #c5e1a5;
        }

        .custom-text {
            color: white !important;
        }

        .custom-logo{
            color: rgb(1, 84, 95) !important;
        }

        .custom-input {
            border-color: #81c784 !important;
        }

        .custom-input:focus {
            border-color: #2e7d32 !important;
            box-shadow: 0 0 0 2px rgba(46, 125, 50, 0.2) !important;
        }
        .custom-size {
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <a href="/" class="custom-size  hover:text-green-800">
                Tun Rice Milling
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 custom-container shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>