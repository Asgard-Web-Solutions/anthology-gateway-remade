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
                                @php $heading = "<i class=\"{{ config('ag.icons.publisher') }}\"></i> Publisher Settings"; @endphp
                                <x-content.section heading="{{ $heading }}">
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
        <x-content.box heading="<i class='{{ config('ag.icons.anthology') }}'></i> Your Anthologies">
            @if ($user->anthologies->count())
                @foreach ($user->anthologies as $anthology)
                    <a href="{{ route('anthology.view', $anthology->id) }}">{{ $anthology->name }}</a>
                @endforeach
            @endif

            <div class="w-full text-right">
                <x-button.primary-small icon="fa-solid fa-plus">{{ __('Create Anthology ') }}</x-button.primary-small>
            </div>
        </x-content.box>
    </x-content.page>



    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
@endsection