<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <style>
        .custom-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }

        .custom-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .custom-text {
            color: white !important;
        }

        .custom-logo {
            color: #667eea !important;
        }

        .custom-input {
            border-color: #667eea !important;
            background-color: white !important;
        }

        .custom-input:focus {
            border-color: #764ba2 !important;
            box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.2) !important;
        }

        .custom-size {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
        }

        .custom-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white !important;
        }

        .custom-button:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%) !important;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <a href="/" class="custom-size hover:text-[#764ba2]">
                Tun Rice Milling
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 custom-container shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
    
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>