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
<body class="min-h-screen bg-gray-200">

    
    <div class="block min-h-screen">
        <header class="p-2 text-white bg-black max-h-16" >
            <div class="flex items-center col-span-3 text-left sm:h-16">
                <img src="{{ asset('images/AGLogo.jpg') }}" alt="AG Logo" class="object-cover w-12 h-12 rounded-full ">
                <div class="w-96">
                    <span class="ml-2 text-lg" style="color: #25e4e1"> Anthology Gateway</span>
                </div>
                <div class="w-full text-right">
                    @guest
                        <x-button.primary href="/register">Create Account</x-button.primary>
                    @endguest
                    <x-button.primary href="{{ route('dashboard') }}">Dashboard</x-button.primary>
                </div>
            </div>
        </header>

        <main class="p-4 bg-gray-200">
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

            <div class="h-screen ">
                <div class="flex items-center justify-center h-screen bg-center bg-cover" style="background-image: url({{ asset('images/DinoReadingHeroImage.webp') }});">
                    <div class="p-4 text-center text-white bg-black bg-opacity-50 rounded-lg shadow-xl">
                        <h1 class="mb-4 text-4xl font-bold md:text-6xl">Make your Anthology Project a Delight to Produce</h1>
                        <p class="mb-8 text-xl md:text-2xl">Simplify the Slush Pile, Streamline the Project, and Enhance Communication Effortlessly</p>
                        <x-button.primary-large color="blue" href="{{ route('dashboard') }}">Get Started with your Free Anthology Project</x-button.primary-large>
                        <x-button.primary-large color="purple" href="{{ route('anthology.list') }}">Browse Anthologies</x-button.primary-large>
                    </div>
                </div>
                
                <div class="my-5">
                    <x-content.page>
                        <x-content.column size="lg">
                            <x-content.box heading="<i class='{{ config('ag.icons.anthology') }}'></i> Anthology Production Made Delightfull">
                                <x-content.section>
                                    <x-content.paragraph>It's a lot of work to put together an anthology, and that work should be easy, fun, and delightful, not a headache.</x-content.paragraph>
                                </x-content.section>
                            </x-content.box>

                            <x-content.box heading='Simplify the Slush Pile'>

                                <x-content.section heading='Manage Submissions'>
                                    <x-content.paragraph>Managing the dozens of author submissions that come in for your project can be overwhelming. Anthology Gateway makes the slush pile easy to work through, starting with collecting all of the submissions into one place.</x-content.paragraph>
                                </x-content.section>

                                <x-content.section heading='Team Voting'>
                                    <x-content.paragraph>Let your team of editors and slush pile reviewers vote on the submissions and leave their feedback.</x-content.paragraph>
                                    <x-content.paragraph>The submissions with the highest scores are made obvious so you don't waste your time reading stories that are not likely to make it past the review process.</x-content.paragraph>
                                </x-content.section>

                                <x-content.section heading='Easy Submission Decisions'>
                                    <x-content.paragraph>Accept or decline each story with just a few clicks. With the help of your editor's notes you can craft a specific message to send with the acceptance or rejection email, or use a canned response.</x-content.paragraph>
                                </x-content.section>
                            </x-content.box>

                            <x-content.box heading='Simplify the Project'>
                                <x-content.section heading='Submission / Author Tracking'>
                                    <x-content.paragraph>There are a lot of steps involved in putting together an anthology. We make them simple.</x-content.paragraph>
                                    <x-content.paragraph>Track the status of each submission. See which authors you are waiting for work from, or which you need to respond to.</x-content.paragraph>
                                </x-content.section>

                                <x-content.section heading='Simple Contract Management'>
                                    <x-content.paragraph>Manage author contracts with a simple interface. Send the same contract to every author, or send custom contracts to specific authors.</x-content.paragraph>
                                    <x-content.paragraph>Easily sign the contracts and save them as a PDF backup.</x-content.paragraph>
                                    <x-content.paragraph>If you don't have a contract then don't fret, you can start with some contract templates that we have.</x-content.paragraph>
                                </x-content.section>

                                <x-content.section heading='Simple Draft & Revision Tracking'>
                                    <x-content.paragraph>Manage multiple draft copies of each story. Never lose track of which is the latest copy or who that copy came from.</x-content.paragraph>
                                </x-content.section>
                            </x-content.box>

                            <x-content.box heading='Simplify Team &amp; Author Communication'>
                                <x-content.section heading='Centralized Communication'>
                                    <x-content.paragraph>Keep communication simple. All communication messages will appear in one, neat, interface.</x-content.paragraph>
                                    <x-content.paragraph>Each thread can be private between your own team only, or sent to all of the accepted authors in the project. You can even make public announcements that anyone following your project will be able to see.</x-content.paragraph>
                                </x-content.section>
                                
                                <x-content.section heading='Notifications in Your Control'>
                                    <x-content.paragraph>Receive notifications when major events happen, such as authors submitting a story, uploading a new draft, or when a message is sent. You have full control over which notifications you want to see, or not, and how you will see them.</x-content.paragraph>
                                </x-content.section>
                            </x-content.box>
                        </x-content.column>
                    </x-content.page>
                </div>
            </div>
            
        </main>
    </div>

    
    @livewireScripts
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>
</html>
