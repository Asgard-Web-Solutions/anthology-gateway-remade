@extends('layouts.app')

@section('content')
    <div class="block w-full sm:flex">
        <div class="w-full sm:w-1/2">
            <x-site.header><i class="{{ config('ag.icons.publisher') }}"></i> {{ $publisher->name }}</x-site.header>
        </div>

        <div class="w-full my-auto text-right sm:w-1/2">
            @can('update', $publisher)
                <x-button.primary href="{{ route('publisher.edit', $publisher->id) }}" icon="fa-light fa-gear-complex">{{ __('Edit Publisher Details') }}</x-button.primary>
            @endcan
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="grid w-full grid-cols-1 sm:grid-cols-3">

        <!-- Left Column -->
        <div class="block col-span-1 sm:col-span-2">
            <div class="p-3 m-3 text-gray-300 bg-gray-900 rounded-lg">
                <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">{{ __('Description') }}</h2>
                <div class="p-3 text-gray-800 bg-gray-300 rounded-lg">
                    {{ $publisher->description }}
                </div>
            </div>

            <div class="p-3 m-3 text-gray-300 bg-gray-900 rounded-lg">
                <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">{{ __('Anthologies') }}</h2>
                <div class="p-3 text-gray-800 bg-gray-300 rounded-lg">
                    <div class="grid w-full grid-cols-1 xl:grid-cols-3">
                        @foreach ($publisher->anthologies as $anthology)
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="block col-span-1">
            <div class="p-3 m-3 text-gray-300 bg-gray-900 rounded-lg">
                <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">{{ __('Team Members') }}</h2>
                <div class="p-3 text-gray-800 bg-gray-300 rounded-lg">
                    <ul>
                        @foreach ($publisher->users as $teamMember)
                            <li>{{ $teamMember->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="p-3 m-3 text-gray-300 bg-gray-900 rounded-lg">
                <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">{{ __('Websites') }}</h2>
                <div class="p-3 text-gray-800 bg-gray-300 rounded-lg">
                    <ul>
                        @foreach ($publisher->socials as $social)
                            @php
                                $modifiedUrl = str_replace('{id}', $social->pivot->url, $social->base_url);
                            @endphp
    
                            <li><a href="{{ $modifiedUrl }}"><x-site.social-icon>{{ $social->image }}</x-site.social-icon> {{ $social->pivot->url }}</a></li>
                        @endforeach
                    </ul>
                </div>

                @can('update', $publisher)
                    <div class="w-full mt-6 mb-3 text-right">
                        <x-button.primary href="{{ route('publisher.socials', $publisher->id) }}">Manage Socials</x-button.primary>
                    </div>
                @endcan
            </div>
        </div>
    </div>
@endsection