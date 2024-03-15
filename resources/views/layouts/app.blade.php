<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/daisyui@1.3.6/dist/full.js"></script>
    <script src="https://kit.fontawesome.com/0cc3b28aa8.js" crossorigin="anonymous"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        .main-grid {
            flex: 1;
            display: grid;
            grid-template-columns: auto 1fr;
            min-height: 0; /* Prevent flexbox items from overflowing */
        }
        .main-content {
            overflow-y: auto; /* Enables vertical scrolling if content overflows */
        }

        .dropdown-content {
            position: absolute;
            right: 0; /* Align the dropdown content to the right of its parent */
            z-index: 10; /* Ensure it's above other content */
        }

    </style>
    
</head>
<body class="grid h-full grid-cols-1 overflow-hidden sm:grid-cols-3 md:grid-cols-4">

    <!-- Sidebar -->
    <div class="hidden min-h-full col-span-1 px-2 text-white bg-gray-800 sidebar py-7 sm:grid">
        <livewire:layout.navigation />        
    </div>

    <!-- Main Content -->
    <div class="min-h-full col-span-1 p-8 text-gray-600 bg-gray-100 sm:col-span-2 md:grid-cols-3">
        @if (isset($header))
            <h1 class="mb-4 text-xl font-semibold text-gray-800">{{ $header }}</h1>
        @endif

        <!-- [Your Main Content] -->
        {{ $slot }}

    </div>

    @livewireScripts
</body>
</html>
