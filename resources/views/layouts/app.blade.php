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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    
</head>
<body class="min-h-screen bg-black">

    
    <div class="flex flex-col min-h-screen sm:grid sm:grid-cols-12">
        <header class="grid grid-cols-4 p-2 text-white bg-black sm:grid-flow-row sm:auto-rows-max sm:grid-cols-1 min-h-16 max-h-16 sm:col-span-4 sm:min-h-screen lg:col-span-3 xl:col-span-2" >
            <div class="flex items-center col-span-3 text-left sm:h-16">
                <a href="{{ route('welcome') }}"><img src="{{ asset('images/AGLogo.jpg') }}" alt="AG Logo" class="object-cover w-12 h-12 rounded-full "></a>
                <a href="{{ route('welcome') }}"><span class="ml-2 text-lg" style="color: #25e4e1"> Anthology Gateway</span></a>
            </div>
            <nav class="flex items-center justify-end h-full col-span-1 pr-3 text-right sm:p-3 sm:text-center sm:flex-grow sm:row-span-1">
                <livewire:mobile-nav-menu />

                <div class="flex-col justify-between hidden w-full sm:flex">
                    <livewire:main-nav-menu />
                    <livewire:main-nav-profile />
                </div>
            </nav>
        </header>

        <main class="flex-1 p-4 bg-gray-200 sm:col-span-8 lg:col-span-9 xl:col-span-10">
            {{-- <div class="block sm:hidden">Default</div>
            <div class="hidden sm:block md:hidden">SM</div>
            <div class="hidden md:block lg:hidden">MD</div>
            <div class="hidden lg:block xl:hidden">LG</div>
            <div class="hidden xl:block">XL</div> --}}
            
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(session()->has($msg))
                    <div class="alert alert-{{ $msg }}">
                        {{ session($msg) }}
                    </div>
                @endif
            @endforeach        

            @yield('content')
        </main>
    </div>

    
    @livewireScripts
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>
</html>
