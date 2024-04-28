@extends('layouts.app')    

@section('content')
    <x-site.header>{{ __('Dashboard') }}</x-site.header>
 
        <div class="flex w-full">

            <div class="block p-2 text-gray-200 bg-gray-900 rounded-md">
                <h2 class="mx-2" style="color: #25e4e1">Business Profiles</h2>

                <div>
                    <div class="flex w-full align-bottom">
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
                                    <x-button.dim href="{{ route('author.edit', $user->author->id) }}">Edit Author Profile</x-button.primary>
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
            </div>
        </div>

    <x-content.page>
        <x-content.column size="full">
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
    </x-content.page>

@endsection