<div class="hidden w-full px-3 py-2 mx-auto my-2 text-left bg-gray-900 rounded-lg sm:block">
    @auth
        <x-site.main-nav-link href="{{ route('profile') }}" icon="fa-regular fa-user">{{ __('Profile') }}</x-site.main-nav-link>
        <x-site.main-nav-link href="{{ route('logout') }}" icon="fa-solid fa-right-from-bracket">{{ __('Log Out') }}</x-site.main-nav-link>
    @endauth

    @guest
        <x-site.main-nav-link href="{{ route('login') }}" icon="fa-solid fa-right-from-bracket">{{ __('Log In') }}</x-site.main-nav-link>
    @endguest
</div>