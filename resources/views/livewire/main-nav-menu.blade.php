<div>
    <div class="hidden w-full px-3 py-2 my-2 overflow-auto text-left bg-gray-900 rounded-lg sm:block">
        <x-site.main-nav-link href="{{ route('dashboard') }}" icon="fa-light fa-table-columns">{{ __('Dashboard') }}</x-site.main-nav-link>
    </div>

    @can('viewAny', \App\Models\User::class)
        <div class="hidden w-full px-3 py-2 my-2 overflow-auto text-left bg-gray-900 rounded-lg sm:block">
            <x-site.main-nav-link href="{{ route('settings') }}" icon="fa-duotone fa-flask-gear">{{ __('AG Settings') }}</x-site.main-nav-link>
        </div>
    @endcan
</div>