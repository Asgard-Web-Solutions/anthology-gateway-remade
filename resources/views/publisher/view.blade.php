@extends('layouts.app')

@section('content')
    <div class="flex w-full">
        <div class="w-full sm:w-1/2">
            <x-site.header>{{ $publisher->name }}</x-site.header>
        </div>

        <div class="w-full my-auto text-right sm:w-1/2">
            @can('update', $publisher)
                <x-buttons.primary href="{{ route('publisher.edit', $publisher->id) }}" icon="fa-light fa-gear-complex">{{ __('Edit Publisher Details') }}</x-buttons.primary>
            @endcan
        </div>
    </div>

    <div class="grid w-full grid-cols-1 sm:grid-cols-3">
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
                    
                </div>
            </div>

        </div>

        <div class="block col-span-1">
            <div class="p-3 m-3 text-gray-300 bg-gray-900 rounded-lg">
                <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">{{ __('Team Members') }}</h2>
            </div>

            <div class="p-3 m-3 text-gray-300 bg-gray-900 rounded-lg">
                <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">{{ __('Websites') }}</h2>
            </div>
        </div>
    </div>
@endsection