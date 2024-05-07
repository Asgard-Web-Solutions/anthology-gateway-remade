@extends('layouts.app')    

@section('content')
    <x-site.header>{{ __('Dashboard') }}</x-site.header>

    <x-content.page>
        <x-content.column size="lg">
            <x-content.box heading="<i class='{{ config('ag.icons.anthology') }}'></i> Your Anthologies">
                <div class="flex w-full">

                    @forelse ($user->anthologies as $anthology)
                        <x-content.mini-box heading="{{ $anthology->name }}" href="{{ route('anthology.view', $anthology->id) }}">
                            <div class="items-center h-96">
                                <a href="{{ route('anthology.view', $anthology->id) }}">
                                    @if ($anthology->cover)
                                        <img src="{{ $anthology->cover }}" class="mx-auto h-96"/>
                                    @elseif ($anthology->header)
                                        <img src="{{ $anthology->header }}" class="mx-auto max-h-96"/>
                                    @else
                                        No Image Uploaded...
                                    @endif
                                </a>
                            </div>
                        </x-content.mini-box>
                    @empty
                        <x-content.section>
                            <x-content.paragraph>There are currently no anthology projects that will be opening soon. Consider starting one?</x-content.paragraph>
                        </x-content.section>
                    @endforelse
                </div>

                @can('create', App\Models\Anthology::class)
                    <x-content.button-section>
                        <x-button.primary icon="fa-solid fa-plus" href="{{ route('anthology.create') }}">{{ __('Create Anthology ') }}</x-button.primary>
                    </x-content.button-section>
                @endcan
            </x-content.box>
        </x-content.column>

        <x-content.column size='sm'>
            <x-content.box heading="Business Profiles">
                <div>
                    <div class="w-full align-bottom ">
                        @if ($user->publishers->count())
                            @foreach ($user->publishers as $publisher)
                                <x-content.section heading="{{ $publisher->name }}" heading_icon="{{ config('ag.icons.publisher') }}">
                                    <x-content.paragraph>
                                        <x-button.dim href="{{ route('publisher.view', $publisher->id) }}" icon="{{ config('ag.icons.publisher') }}">View Publisher Profile</x-button.dim>
                                    </x-content.paragraph>
                                </x-content.section>
                            @endforeach
                        @else
                            <x-content.section heading="Publisher Profile" heading_icon="{{ config('ag.icons.publisher') }}">
                                <x-content.paragraph>
                                    <x-button.dim href="{{ route('publisher.create') }}">Create Publisher Profile</x-button.primary>
                                </x-content.paragraph>
                            </x-content.section>
                        @endif

                        @if ($user->author)
                            <x-content.section heading="{{ $user->author->name }}" heading_icon="{{ config('ag.icons.author') }}">
                                <x-content.paragraph>
                                    <x-button.dim href="{{ route('author.view', $user->author->id) }}">View Author Profile</x-button.primary>
                                </x-content.paragraph>
                            </x-content.section>
                        @else
                            <x-content.section heading="Author Profile" heading_icon="{{ config('ag.icons.author') }}">
                                <x-content.paragraph>
                                    <x-button.primary href="{{ route('author.create') }}">Create Author Profile</x-button.primary>
                                </x-content.paragraph>
                            </x-content.section>
                        @endif

                    </div>
                </div>
            </x-content.box>

            <x-content.box heading="Bookmarks" heading_icon="{{ config('ag.icons.bookmarked') }}">
                @foreach ($user->anthologyBookmarks as $bookmark) 
                    <x-content.section heading="{{ $bookmark->name }}" href="{{ route('anthology.view', $bookmark->id) }}">
                        <div class="flex">
                            <a href="{{ route('anthology.view', $bookmark->id) }}" class="border-2 border-collapse border-gray-300 hover:border-purple-950"><img src="{{ $bookmark->cover }}" width="100px"></a>
                            <div class="px-2">
                                {!!  \Illuminate\Support\Str::limit($bookmark->description, 320, $end='...') !!}
                            </div>
                        </div>
                    </x-content.section>
                @endforeach
            </x-content.box>
        </x-content.column>
    </x-content.page>

@endsection