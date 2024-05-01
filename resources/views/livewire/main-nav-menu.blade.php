<div>
    <div class="hidden w-full px-3 py-2 my-2 overflow-auto text-left bg-gray-900 rounded-lg sm:block">
        <x-site.main-nav-link href="{{ route('dashboard') }}" icon="fa-light fa-table-columns">{{ __('Dashboard') }}</x-site.main-nav-link>
        <x-site.main-nav-link href="{{ route('anthology.list') }}" icon="{{ config('ag.icons.anthology') }}">{{ __('Browse Anthologies') }}</x-site.main-nav-link>
    </div>

    @if($authUser && $authUser->author)
        <div class="hidden w-full px-3 py-2 my-4 overflow-auto text-left bg-gray-900 rounded-lg sm:block">
            <h2>Your Author Profile</h2>
                <x-site.main-nav-link href="{{ route('author.view', $authUser->author->id) }}" icon="{{ config('ag.icons.author') }}">{{ $authUser->author->name }}</x-site.main-nav-link>
        </div>
    @endif

    @if($authUser && $authUser->publishers->count())
        <div class="hidden w-full px-3 py-2 my-4 overflow-auto text-left bg-gray-900 rounded-lg sm:block">
            <h2>Your Publishing Company</h2>
            @foreach ($authUser->publishers as $publisher)
                <x-site.main-nav-link href="{{ route('publisher.view', $publisher['id']) }}" icon="{{ config('ag.icons.publisher') }}">{{ $publisher['name'] }}</x-site.main-nav-link>
            @endforeach
        </div>
    @endif

    @if($authUser && $authUser->anthologies->count())
        <div class="hidden w-full px-3 py-2 my-4 overflow-auto text-left bg-gray-900 rounded-lg sm:block">
            <h2>Your Anthologies</h2>
            @foreach ($authUser->anthologies as $anthology)
                <x-site.main-nav-link href="{{ route('anthology.view', $anthology['id']) }}" icon="{{ config('ag.icons.anthology') }}">{{ $anthology['name'] }}</x-site.main-nav-link>
            @endforeach
        </div>
    @endif

    @can('viewAny', \App\Models\User::class)
        <div class="hidden w-full px-3 py-2 my-2 overflow-auto text-left bg-gray-900 rounded-lg sm:block">
            <x-site.main-nav-link href="{{ route('settings') }}" icon="fa-duotone fa-flask-gear">{{ __('AG Settings') }}</x-site.main-nav-link>
        </div>
    @endcan
</div>