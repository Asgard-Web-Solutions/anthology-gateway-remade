

<div>
    <button wire:click="toggleNavigation" class="focus:outline-none sm:hidden">
        <i class="text-2xl text-gray-400 fa-solid fa-bars"></i>
    </button>

    @if ($isOpen)
        @php $linkStyle = 'block text-xl'; @endphp
        <nav class="absolute right-0 z-10 items-center w-full text-center text-gray-300 bg-gray-900 shadow-md hover:text-gray-100 sm:hidden top-16">
            
            <div class="w-3/4 h-px mx-auto my-2 bg-purple-700"></div>
            <a href="{{ route('dashboard') }}" class="{{ $linkStyle }}">{{ __('Dashboard') }}</a>

            <a href="{{ route('profile') }}" class="{{ $linkStyle }}">{{ __('Profile') }}</a>
            <button wire:click="logout" class="{{ $linkStyle }} w-full">{{ __('Log Out') }}</button>
            
            <div class="w-3/4 h-px mx-auto my-2 bg-purple-700"></div>
        </nav>
    @endif

</div>
