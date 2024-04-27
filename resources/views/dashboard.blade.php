@extends('layouts.app')    

@section('content')
    <x-site.header>{{ __('Dashboard') }}</x-site.header>
 
        <div class="flex w-full">

            <div class="block p-2 text-gray-200 bg-gray-900 rounded-md">
                <h2 class="mx-2" style="color: #25e4e1">Business Profiles</h2>

                <div class="flex w-full">
                    @if ($user->publishers->count())
                        @foreach ($user->publishers as $publisher)
                            <a href="{{ route('publisher.view', $publisher->id) }}">
                                <x-content.section heading="Publisher Settings" heading_icon="{{ config('ag.icons.publisher') }}">
                                    <p class="m-2 text-sm font-bold">
                                        {{ $publisher->name }}
                                    </p>
                                </x-content.section>
                            </a>
                        @endforeach
                    @else
                        <a href="{{ route('publisher.create') }}">
                            <div class="w-48 p-2 m-2 text-black bg-gray-100 rounded-md hover:bg-gray-200">
                                <h2 class="font-bold text-red-900"><i class="{{ config('ag.icons.publisher') }}"></i> Publisher Settings</h2>
                                <p class="m-2 text-sm font-light">
                                    No Current Publisher
                                </p>
                            </div>
                        </a>
                    @endif


                </div>
            </div>
        </div>

    <x-content.page>
        <x-content.column size="full">
            <x-content.box heading="<i class='{{ config('ag.icons.anthology') }}'></i> Your Anthologies">
                <div class="flex w-full">

                    @forelse ($user->anthologies as $anthology)
                        <x-content.mini-box heading="{{ $anthology->name }}">
                            <div class="items-center h-96">
                                <a href="{{ route('anthology.view', $anthology->id) }}">
                                    @if ($anthology->cover)
                                        <img src="{{ $anthology->cover }}" class="mx-auto h-96"/>
                                    @else
                                        <img src="{{ $anthology->header }}" class="mx-auto max-h-96"/>
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
                        <x-button.primary-small icon="fa-solid fa-plus" href="{{ route('anthology.create') }}">{{ __('Create Anthology ') }}</x-button.primary-small>
                    </x-content.button-section>
                @endcan
            </x-content.box>
        </x-content.column>
    </x-content.page>

@endsection