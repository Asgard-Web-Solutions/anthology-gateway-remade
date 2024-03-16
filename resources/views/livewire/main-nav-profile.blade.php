<div class="hidden w-full px-3 py-2 mx-auto my-2 text-left bg-gray-900 rounded-lg sm:block">
    <x-site.main-nav-link href="{{ route('profile') }}" icon="fa-regular fa-user">{{ __('Profile') }}</x-site.main-nav-link>
    <x-site.main-nav-link href="{{ route('logout') }}" icon="fa-solid fa-right-from-bracket">{{ __('Log Out') }}</x-site.main-nav-link>
</div>